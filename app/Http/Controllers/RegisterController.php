<?php

namespace App\Http\Controllers;

use App\Models\M_klinik;
use App\Models\Master\Master;
use App\Models\T_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Register Pasien";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        $klinik = M_klinik::all();

        $data = [
            'klinik' => $klinik,
        ];

        return view('register',$data);
    }

    public function datatable(Request $request)
    {
        // $datas = T_register::orderBy('tanggal_daftar','DESC')->get();
        
        $data_tables = [];
        
        if($request->filter){
            $datas = collect(\App\Models\Master\Master::dataRegister($request));
            foreach ($datas as $key => $value) {
                $data_tables[$key][] = $key + 1;
                $data_tables[$key][] = '<center>' . $value->tipe . '</center>';
                $data_tables[$key][] = '<center>' . $value->nama_klinik . '</center>';
                $data_tables[$key][] = '<center>' . \Carbon\Carbon::parse($value->tanggal_daftar)->format('d-m-Y') . '</center>';
                if($value->tipe == 'PROMO'){
                    $data_tables[$key][] = '<center>' . $value->judul_promo . '</center>';
                }else{
                    $data_tables[$key][] = '<center>' . $value->nama_layanan . '</center>';
                }
                
                $data_tables[$key][] = '<b>Tanggal :</b> ' . \Carbon\Carbon::parse($value->tanggal)->format('d-m-Y') . '<br>
                <b>Jam :</b> ' . $value->jam;
                $data_tables[$key][] = '<b>Nama :</b> ' . $value->nama_pasien . '<br><b>Telp :</b> ' . $value->telp_pasien . '<br><b> Email :</b>' . $value->email_pasien;

                if($value->jenis_pembayaran == 'CASH'){
                    $data_tables[$key][] = '<center>' . $value->jenis_pembayaran . '</center>';
                }else{
                    $data_tables[$key][] = '<center>' . $value->jenis_pembayaran . '<br>TENOR : ' . $value->tenor . '</center>';
                }

                if($value->status == 0){
                    $data_tables[$key][] = '<center><span class="badge badge-info">Menunggu</span></center>';
                }else if ($value->status == 1){
                    $data_tables[$key][] = '<center><span class="badge badge-info">Approved</span></center>';
                }else if ($value->status == 2){
                    $data_tables[$key][] = '<center><span class="badge badge-danger">Ditolak</span></center>';
                }
                
                $aksi = '';
                $aksi .= '<center>';
                $aksi .= '&nbsp;<a href="#!" onClick="Terima(' . $value->id_t_register . ')" class="btn btn-success" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-check-circle"></i> Approve</a>';
                $aksi .= '&nbsp; <a href="#!" onClick="Tolak(' . $value->id_t_register . ')" class="btn btn-warning" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-hand-paper"></i> Tolak</a>';
                $aksi .= '&nbsp; <a href="javascript:void(0)" class="btn btn-primary rejadwal" data-id_reg="' . $value->id_t_register . '" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-calendar-week"></i> Reschedule</a>';
                $aksi .= '&nbsp; <a href="#!" onClick="Hapus(' . $value->id_t_register . ')" class="btn btn-danger" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-trash-alt"></i> Hapus</a>';
                $aksi .= '</center>';

                $data_tables[$key][] = $aksi;
            }

        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function Terima(Request $request)
    {
        $data = T_register::where('id_t_register', $request->id)->first();

        $data->status = 1;
        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pendaftaran Diterima!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function Tolak(Request $request)
    {
        $data = T_register::where('id_t_register',$request->id)->first();

        $data->status = 2;
        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pendaftaran Ditolak!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function Hapus(Request $request)
    {
        $data = T_register::where('id_t_register',$request->id)->first();

        try {
            $data->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pendaftaran Dihapus!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function Reschedule(Request $request)
    {
        $cek = T_register::where('id_t_register',$request->reg)->first();
        
        $data = [
            'nama' => $cek->pasien->nama_pasien,
            'klinik' => $cek->klinik->nama,
            'tanggal' => \Carbon\Carbon::parse($cek->tanggal)->format('d-m-Y'),
            'jam' => substr($cek->jam,0,5),
            'cek' => $cek,
        ];

        return response()->json($data);
    }

    public function SimpanReschedule(Request $request)
    {
        $data = T_register::where('id_t_register',$request->id_register)->first();

        $data->id_klinik = $request->klinik;
        $data->tanggal   = $request->tanggal;
        $data->jam       = $request->jam;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }


}
