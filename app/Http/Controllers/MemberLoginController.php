<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Member;
use Faker\Extension\Helper as ExtensionHelper;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Helper\Helper as HelperHelper;

class MemberLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.memberlogin');
    }

    public function home()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        try {

            $this->checkRegistered($request->username);

            $credentials = $request->only('username', 'password');
            
            if (Auth::attempt($credentials)) {
                $user = Auth::user();       
                $token = $user->createToken('member')->accessToken;

                // Session::put('menu', Helper::menuAllowTo());

                $data = [
                    'url' => route($this->checkRedirectDashboard('dashboard_index')),
                ];
                
                return $this->successJson("Yayy, Anda berhasil login", $data, 222);
            }

            return $this->successJson("Oops, username atau password anda salah", 199);
        }
        catch (BadResponseException $e) {
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
            Session::flush();
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
        $data = Member::select('nama')->where(['username' => $username,'is_aktif' => null])->first();
        
        if(!$data){
            throw new Exception('Email belum terdaftar', 999);
        }
    }

    private function checkRedirectDashboard($permissionName){
        $user = Auth::user();
        return 'home';
    }
}
