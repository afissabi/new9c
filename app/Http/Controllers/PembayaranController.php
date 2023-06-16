<?php

namespace App\Http\Controllers;

use App\Models\M_klinik;
use App\Models\M_pembayaran;
use App\Models\Master\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Pembayaran Pasien";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        // $bayar = M_pembayaran::orderByDesc('created_at')->get();
        $klinik = M_klinik::all();
        $data = [
            // 'bayar' => $bayar,
            'klinik' => $klinik,
        ];

        return view('pembayaran',$data);
    }

    public function datatable(Request $request)
    {
        // $datas = T_register::orderBy('tanggal_daftar','DESC')->get();
        
        $data_tables = [];
        
        $datas = collect(\App\Models\Master\Master::dataBayar($request));
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center>' . $value->tipe . '</center>';
            if($value->tipe == 'PROMO'){
                $data_tables[$key][] = '<center>' . $value->judul_promo . '</center>';
            }else{
                $data_tables[$key][] = '<center>' . $value->nama_layanan . '</center>';
            }
            $data_tables[$key][] = '<b>Nama :</b> ' . $value->nama_pasien . '<br><b>Telp :</b> ' . $value->telp_pasien . '<br><b> Email :</b>' . $value->email_pasien;
            
            if($value->status == 0){
                $data_tables[$key][] = '<center><span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Menunggu Pembayaran</span></center>';
            } else if ($value->status == 1){
                $data_tables[$key][] = '<span class="badge badge-primary mb-1 mt-3 text-dark" style="border-radius: 10px;">Menunggu Konfirmasi Admin</span><br>
                Tanggal Bayar : ' . \Carbon\Carbon::parse($value->tgl_bayar)->format('d-m-Y') . '<br>
                <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-success bukti" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-file-invoice-dollar"></i> Bukti Bayar</a>'; 
            }else if ($value->status == 2){
                $data_tables[$key][] = '<center><span class="badge badge-success mb-1 mt-3 text-dark" style="border-radius: 10px;">Pembayaran Diterima</span><br>
                <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-success bukti" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-file-invoice-dollar"></i> Bukti Bayar</a></center>'; 
            }

            $data_tables[$key][] = '<center>Rp' . number_format($value->nilai, 0,",",".") . '<br>' . $value->keterangan . '</center>';

            $aksi = '';
            $aksi .= '<center>';
            $aksi .= '&nbsp;<a href="#!" onClick="Terima(' . $value->id_pembayaran . ')" class="btn btn-success" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-check-circle"></i> Diterima</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="Tolak(' . $value->id_pembayaran . ')" class="btn btn-warning" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-hand-paper"></i> Ditolak</a>';
            // $aksi .= '&nbsp; <a href="#!" onClick="Hapus(' . $value->id_pembayaran . ')" class="btn btn-danger" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-trash-alt"></i> Hapus</a>';
            $aksi .= '</center>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function BuktiBayar(Request $request)
    {
        $cek = M_pembayaran::findOrFail($request->pembayaran);

        $data = [
            'bukti' => asset('img/bayar/thumbnail/' . $cek->bukti),
            'id_pembayaran' => $cek->id_pembayaran,
        ];

        return response()->json($data);
    }

    public function Terima(Request $request)
    {
        $data = M_pembayaran::where('id_pembayaran', $request->id)->first();

        $data->status = 2;
        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pembayaran Diterima!',
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
        $data = M_pembayaran::where('id_pembayaran', $request->id)->first();

        $data->status = 0;
        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pembayaran Ditolak!',
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
