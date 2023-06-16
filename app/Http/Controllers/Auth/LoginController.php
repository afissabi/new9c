<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Mail\ResetEmail;
use App\Mail\SendEmail;
use App\Models\ModelHasRoles;
use App\Models\User;
use Faker\Extension\Helper as ExtensionHelper;
use ReCaptcha;
use DB;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Helper\Helper as HelperHelper;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showLoginMember()
    {
        return view('auth.memberlogin');
    }

    public function home()
    {
        return view('home');
    }

    protected function validator(array $data)
    {
        
    }

    public function login(Request $request)
    {
        try {
            // $request->validate([
            //     'g-recaptcha-response' => 'required|captcha'
            // ]);
            if(!$request['g-recaptcha-response']){
                return $this->successJson("Oops, captchanya diisi dulu dong", 'Captcha Salah', 199);
            }

            $this->checkRegistered($request->username);
            
            $credentials = $request->only('username', 'password');
            
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                Session::put('admin', $user);
                Session::put('menu', Helper::menuAllowTo());
                
                $data = [
                    'url' => route($this->checkRedirectDashboard('dashboard_index')),
                ];
                
                return $this->successJson("Yayy, Anda berhasil login", $data, 222);
            }

            return $this->successJson("Oops, username atau password anda salah", 199);
        }catch (BadResponseException $e) {
            if($e->getCode() == 429){
                return $this->successJson("Oops, Anda melakukan request yang tidak wajar", $e->getMessage(), 199);
            }
            return $this->successJson("Oops, username atau password anda salah", $e->getMessage(), 199);
        }catch (Exception $ex) {
            if($ex->getCode() == 999){
                return $this->successJson("Oops, Data Anda tidak ditemukan, silahkan menghubungi Admin anda...", $ex->getMessage(), 199);
            }
            if($ex->getCode() == 789){
                return $this->successJson($ex->getMessage(), $ex->getMessage(), 199);
            }
        }

    }

    // public function logout(Request $request)
    // {
    //     $request->session()->invalidate();
    //     Auth::logout();

    //     return redirect('/login');
    // }

    public function logout(Request $request)
    {
        try{
            Session::flush('admin');
            Auth::logout();

            $data = [
                "nextURL" => url('web-admin')
            ];

            return $this->successJson("Yayy, Anda berhasil logout", $data, 222);
        }catch(Exception $e){
            return $this->failedJson("Oops, ada masalah di sistem, mohon hubungi Admin", $e->getMessage(), 199);
        }
    }

    private function checkRegistered($username){
        $data = User::join('model_has_roles as mhr','mhr.model_id','users.id')->select('name')->where(['username' => $username,'is_aktif' => null])->where('role_id','!=', 4)->first();

        if(!$data){
            throw new Exception('Username / Email belum terdaftar', 999);
        }
    }

    private function checkRedirectDashboard($permissionName){
        return 'home';
    }

    public function loginMember(Request $request)
    {
        try {
            if(!$request['g-recaptcha-response']){
                return $this->successJson("Oops, captchanya diisi dulu dong", 'Captcha Salah', 199);
            }
            
            $this->checkRegisteredMember($request->username);
            
            $credentials = $request->only('username', 'password');
            
            if (Auth::attempt($credentials)) {

                $user = Auth::user();            
                Session::put('member', $user);
                
                $data = [
                    'url' => route($this->checkRedirectMember('dashboard_member')),
                ];
                
                return $this->successJson("Yayy, Anda berhasil login", $data, 222);
            }

            return $this->successJson("Oops, username atau password anda salah", 199);
        }catch (BadResponseException $e) {
            if($e->getCode() == 429){
                return $this->successJson("Oops, Anda melakukan request yang tidak wajar", $e->getMessage(), 199);
            }
            return $this->successJson("Oops, username atau password anda salah", $e->getMessage(), 199);
        }catch (Exception $ex) {
            if($ex->getCode() == 999){
                return $this->successJson("Oops, Data Anda tidak ditemukan, silahkan menghubungi Admin anda...", $ex->getMessage(), 199);
            }
            if($ex->getCode() == 789){
                return $this->successJson($ex->getMessage(), $ex->getMessage(), 199);
            }
        }
        
    }

    private function checkRegisteredMember($username){
        $data = User::join('model_has_roles as mhr','mhr.model_id','users.id')->select('name')->where(['username' => $username,'is_aktif' => null])->where('role_id', 4)->first();
        
        if(!$data){
            throw new Exception('Username / Email belum terdaftar', 999);
        }
    }

    private function checkRedirectMember($permissionName){
        return 'home-member';
    }

    public function logoutMember(Request $request)
    {
        try{
            Session::flush('member');
            Auth::logout();

            $data = [
                "nextURL" => url('/')
            ];

            return $this->successJson("Yayy, Anda berhasil logout", $data, 222);
        }catch(Exception $e){
            return $this->failedJson("Oops, ada masalah di sistem, mohon hubungi Admin", $e->getMessage(), 199);
        }
    }

    public function cekEmail()
    {
        return view('auth.cekemail');
    }

    public function cariEmail(Request $request)
    {
        $email = User::where('username',$request->email)->first();
        $pesan = 'Email tidak ditemukan pastikan email yang anda masukan benar dan terdaftar sebagai member klinik 9Corthodontics';
        $status = false;

        if($email){
            $pesan = 'Silahkan cek email ' . $request->email . ' untuk mendapatkan link reset password. Jika email tidak ada harap cek di menu Spam.';
            $status = true;

            // KIRIM EMAIL REGISTRASI PASIEN BARU
            $email = $request->email;
            
            $data = [
                'link' => $request->email,
            ];
        
            Mail::to($email)->send(new ResetEmail($data));
        }


        try {
            DB::commit();

            return response()->json([
                'status' => $status,
                'pesan'  => $pesan,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Email Tidak Terdaftar!',
                'err'    => $e->getMessage()
            ]);
        }
    }


}
