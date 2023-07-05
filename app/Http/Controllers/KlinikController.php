<?php

namespace App\Http\Controllers;

use App\Models\GaleriKlinik;
use App\Models\M_klinik;
use App\Models\M_operasional;
use App\Models\Master\Dokter_layanan;
use App\Models\Master\JadwalDokter;
use App\Models\Master\M_jabatan;
use App\Models\Master\M_kota;
use App\Models\Master\M_layanan;
use App\Models\Master\M_pegawai;
use App\Models\Master\M_provinsi;
use App\Models\Master\Mapping_layanan;
use App\Models\Master\Mapping_pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class KlinikController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Klinik";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        $prov = M_provinsi::orderBy('nm_prop')->get();
        $kota = M_kota::join('m_setup_prop', 'm_setup_prop.id_m_setup_prop', '=', 'm_setup_kab.id_m_setup_prop')->get();
        $datas = M_klinik::all();

        $data = [
            'prov' => $prov,
            'kota' => $kota,
            'datas' => $datas,
        ];

        return view('klinik', $data);
    }

    // public function list(){
    //     $datas = M_klinik::all();
    //     $html  = '';

    //     $html .= '
    //         <div class="col-md-4">
    //             <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-info btn-active-light-info btn-tambah" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
    //                 <i class="fas fa-plus" style="color: #7239eb;"></i><br>Klinik
    //             </button>
    //         </div>';
    //     foreach ($datas as $value) {
    //         $kota = strtolower($value->kota);
    //         $prov = strtolower($value->prov);

    //         $html .= '
    //         <div class="col-md-4">
    //             <div class="card card-xl-stretch mb-xl-8">
    //                 <div class="card-body">
    //                     <div class="d-flex flex-stack">
    //                         <div class="d-flex align-items-center">
    //                             <div class="symbol symbol-60px me-5">
    //                                 <span class="symbol-label bg-danger-light">
    //                                     <i class="fas fa-clinic-medical" style="color: #009ef7;font-size: 35px;" class="h-80 align-self-center"></i>
    //                                 </span>
    //                             </div>
    //                             <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
    //                                 <a href="#" class="text-dark fw-bolder text-hover-primary fs-5">' . $value->nama . '</a>
    //                                 <span class="text-muted fw-bold">' . $value->tipe . '</span>
    //                             </div>
    //                         </div>
    //                         <div class="ms-2">
    //                             <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    //                                 <span class="svg-icon svg-icon-2">
    //                                     <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
    //                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    //                                             <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
    //                                             <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
    //                                             <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
    //                                             <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
    //                                         </g>
    //                                     </svg>
    //                                 </span>
    //                             </button>
    //                             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
    //                                 <div class="separator mb-3 opacity-75"></div>
    //                                 <div class="menu-item px-3">
    //                                     <a href="#" class="menu-link px-3">Jam Operasional</a>
    //                                 </div>
    //                                 <div class="menu-item px-3 mb-3">
    //                                     <a href="#" class="menu-link px-3">Pegawai</a>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                     <div class="d-flex flex-column mb-2">
    //                         <div class="text-dark me-2 fw-bolder pb-4"></div>
    //                         <div class="d-flex text-muted">
    //                             <table>
    //                                 <tr>
    //                                     <td valign="top">Alamat</td>
    //                                     <td valign="top">:</td>
    //                                     <td>' . $value->alamat . ' ' . ucwords($kota)  . ' ' . ucwords($prov) . '</td>
    //                                 </tr>
    //                                 <tr>
    //                                     <td>Telp</td>
    //                                     <td>:</td>
    //                                     <td>' . $value->telp . '</td>
    //                                 </tr>
    //                                 <tr>
    //                                     <td>Email</td>
    //                                     <td>:</td>
    //                                     <td>' . $value->email . '</td>
    //                                 </tr>
    //                             </table>
    //                         </div>
    //                     </div>
    //                     <div class="d-flex flex-column mb-2">
    //                         <div class="text-dark me-2 fw-bolder pb-4">Jam Operasional</div>
    //                         <div class="d-flex">
    //                             <ul>
    //                                 <li>Senin - Jumat | 08:00 - 16:00 WIB</li>
    //                                 <li>Sabtu - Minggu | 08:00 - 16:00 WIB</li>
    //                             </ul>
    //                         </div>
    //                     </div>
    //                     <div class="d-flex flex-column mb-2">
    //                         <div class="text-dark me-2 fw-bolder pb-4">Tim Dokter</div>
    //                         <div class="d-flex">
    //                             <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" title="Ana Stone">
    //                                 <img src="assets/media/avatars/150-1.jpg" alt="" />
    //                             </a>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>';
    //     }

    //     echo $html;
    // }

    public function store(Request $request)
    {
        $data = new M_klinik();
        
        $data->tipe = $request->tipe;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->id_prov = $request->provinsi;
        $data->prov = \App\Helpers\Helper::Provinsi($request->provinsi)->nm_prop;
        $data->id_kota = $request->kota;
        // $data->kota = \App\Helpers\Helper::Kota($request->provinsi, $request->kota)->nm_kab;
        $data->telp = $request->telp;
        $data->admin = $request->admin;
        $data->email= $request->email;
        $data->maps = $request->maps;
        $data->catatan = $request->catatan;

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

    public function edit(Request $request)
    {
        $data   = M_klinik::findOrFail($request->klinik);
        
        return response()->json($data);
    }

    public function jamOperasi(Request $request)
    {
        $jam = M_operasional::where('id_klinik', $request->klinik)->get();

        $html  = '';
        foreach ($jam as $value) {
            $html .= '
            <div class="col-lg-4">
                <span class="badge badge-info">' . $value->hari . ' - ' . $value->status . ' ( ' . substr($value->jam_buka,0,5) . ' - ' . substr($value->jam_tutup,0,5) . ') &nbsp;&nbsp;&nbsp; <a href="#!" onClick="hapusjam(' . $value->id_jam_operasi . ')"><i class="fa fa-trash"></i></a></span>
            </div>';
        }

        $data = [
            'id_klinik' => $request->klinik,
            'html' => $html,
        ];

        return response()->json($data);
    }

    public function dokter(Request $request)
    {
        $jabatan = M_jabatan::where('nama_jabatan', 'dokter')->first();
        $dokter = M_pegawai::JOIN('mapping_pegawai as mp','mp.id_pegawai','=','m_pegawai.id_pegawai')->where('mp.deleted_at',null)->where('id_klinik', $request->klinik)->where('m_pegawai.jabatan',$jabatan->id_jabatan)->get();
        
        $html  = '';
        foreach ($dokter as $value) {
            $html .= '
            <div class="col-lg-4">
                <div class="d-flex bg-light-info align-items-center mb-7" style="padding: 5px;border-radius: 5px;">
                    <div class="symbol symbol-50px me-5">
                        <img src="' . asset($value->path . $value->foto) . '" class="" alt="" style="border: 1px dashed #5738a1;"/>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="text-dark fw-bolder text-hover-primary fs-6">' . $value->nama_pegawai . '</h4>
                        <span class="text-muted d-block fw-bold">' . $value->spesialis . '</span>
                        <a href="' . url('klinik/jadwal-dokter/'. $value->id_pegawai . '/' . $request->klinik) . '" class="btn btn-info" style="font-size: 10px;padding: 5px;">Jadwal Dokter</a>
                    </div>
                </div>
            </div>';
        }

        $data = [
            'id_klinik' => $request->klinik,
            'html' => $html,
        ];

        return response()->json($data);
    }

    public function galeri(Request $request)
    {
        $galeri = GaleriKlinik::where('id_klinik', $request->klinik)->get();
        
        $html  = '';
        foreach ($galeri as $value) {
            $html .= '
            <div class="col-lg-4">
                <img src="' . asset($value->path . $value->gambar) . '" class="" alt="" style="border: 1px dashed #5738a1;width:100%;"/><br>
                <center><a href="#!" class="btn btn-danger" onClick="hapusGaleri(' . $value->id_galeri_klinik . ')"><i class="fa fa-trash"></i></a></center>
            </div>';
        }

        $data = [
            'id_klinik' => $request->klinik,
            'html' => $html,
        ];

        return response()->json($data);
    }

    public function SimpanGaleri(Request $request)
    {
        $data = new GaleriKlinik();
        $id = GaleriKlinik::max('id_galeri_klinik') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/klinik/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'kl-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.png';

            $img->resize(200, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/klinik/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/klinik/thumbnail/";
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
        }

        $data->id_klinik   = $request->klinik;
        $data->gambar      = $imageName;
        $data->path        = $destinationPathori;
        $data->keterangan  = $request->keterangan;

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

    public function destroyGaleri(Request $request)
    {

        $data = GaleriKlinik::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }

    public function layanan(Request $request)
    {
        $layanan = Mapping_layanan::where('id_klinik', $request->klinik)->get();
        
        $html  = '';

            foreach ($layanan as $value) {
                $html .= '
                <div class="col-lg-4">
                    <div class="d-flex bg-danger align-items-center mb-7" style="padding: 5px;border-radius: 5px;">
                    <div class="symbol symbol-50px me-5">
                        <img src="' . asset($value->layan->path . $value->layan->icon) . '" class="" alt="" style="border: 1px dashed #5738a1;"/>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bolder text-hover-primary fs-6" style="color: #fff;">' . $value->layan->nama_layanan . '</h4>
                    </div>
                    </div>
                </div>';
            }
        
        

        $data = [
            'id_klinik' => encrypt($request->klinik),
            'html' => $html,
        ];

        return response()->json($data);
    }

    public function tambahJam(Request $request)
    {
        $data = new M_operasional();
        
        $data->id_klinik = $request->id_klinik;
        $data->hari = $request->hari;
        $data->status = $request->status;
        $data->jam_buka = $request->jam_buka;
        $data->jam_tutup = $request->jam_tutup;
        $data->catatan = $request->catatan;

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

    public function ubah(Request $request)
    {
        $data = M_klinik::findOrFail($request->id_klinik);

        $data->tipe = $request->tipe;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->id_prov = $request->provinsi;
        $data->prov = \App\Helpers\Helper::Provinsi($request->provinsi)->nm_prop;
        $data->id_kota = $request->kota;
        // $data->kota = \App\Helpers\Helper::Kota($request->provinsi, $request->kota)->nm_kab;
        $data->telp = $request->telp;
        $data->email= $request->email;
        $data->admin = $request->admin;
        $data->maps = $request->maps;
        $data->catatan = $request->catatan;

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

    public function pilihKota(Request $request)
    {
        $datas = M_kota::where('id_m_setup_prop', $request->prov)->get();
        $see = M_klinik::findOrFail($request->klinik);
        
        $html  = '';
        $html .= '<option value="">- Pilih Kota -</option>';
        foreach ($datas as $value) {
            if($value->id_kab == $see->id_kota){
                $html .= '<option value="' . $value->id_kab . '" selected>' . $value->nm_kab . '</option>';
            }else{
                $html .= '<option value="' . $value->id_kab . '" >' . $value->nm_kab . '</option>';
            }
            
        }
        echo $html;
    }

    public function destroy(Request $request)
    {

        $data = M_klinik::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }

    public function destroyJam(Request $request)
    {

        $data = M_operasional::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }

    public function aktif(Request $request)
    {
        $data = M_klinik::findOrFail($request->id);
        $data->is_aktif = null;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Status Klinik Aktif..',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Perubahan Gagal!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function tidakaktif(Request $request)
    {
        $data = M_klinik::findOrFail($request->id);
        $data->is_aktif = 1;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Status Klinik Tidak Aktif..',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Perubahan Gagal!',
                'err'    => $e->getMessage()
            ]);
        }
    }


    public function detailLayanan(Request $request)
    {
        $klinik = M_klinik::findOrFail(decrypt($request->klinik));

        $data = [
            'klinik' => $klinik,
        ];

        return view('klinik.detail-layanan', $data);
    }

    public function tabelLayanan(Request $request)
    {
        $datas = Mapping_layanan::where('id_klinik',$request->klinik)->orderBy('updated_at','DESC')->get();
        
        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center>' . $value->layan->nama_layanan . '</center>';

            $dokter = Dokter_layanan::where('id_layanan',$value->id_layanan)->where('id_klinik',$request->klinik)->get();
            $list = '<ul>';
            foreach($dokter as $value){
                $list .= '<li>' . $value->dokter->nama_pegawai . '</li>';
            }
            $list .= '</ul>';
            $data_tables[$key][] = $list;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }


    // JADWAL DOKTER
    public function JadwalDokter($id_pegawai,$id_klinik)
    {
        $pegawai = M_pegawai::where('id_pegawai',$id_pegawai)->first();
        $klinik = M_klinik::where('id_klinik',$id_klinik)->first();

        $data = [
            'pegawai' => $pegawai,
            'klinik' => $klinik,
        ];

        return view('master.jadwaldokter',$data);
    }

    public function JadwalData(Request $request)
    {
        $datas = JadwalDokter::orderBy('hari')->where('id_pegawai',$request->pegawai)->where('id_klinik',$request->klinik)->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center>' . $value->hari . '</center>';
            $data_tables[$key][] = '<center>' . $value->jam_buka . '</center>';
            $data_tables[$key][] = '<center>' . $value->jam_tutup . '</center>';
            $data_tables[$key][] = '<center>' . $value->estimasi . '</center>';

            $aksi = '';
            $aksi .= '<center>';
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_jadwal="' . $value->id_jadwal_dokter . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="hapusJadwal(' . $value->id_jadwal_dokter . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $aksi .= '</center>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function JadwalStore(Request $request)
    {
        $data = new JadwalDokter();

        $data->id_pegawai   = $request->id_pegawai;
        $data->id_klinik    = $request->id_klinik;
        $data->hari         = $request->hari;
        $data->jam_buka     = $request->jam_buka;
        $data->jam_tutup    = $request->jam_tutup;
        $data->estimasi     = $request->estimasi;

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

    public function JadwalEdit(Request $request)
    {
        $edit = JadwalDokter::findOrFail($request->jadwal);
        
        return response()->json($edit);
    }

    public function JadwalUbah(Request $request)
    {
        $data = JadwalDokter::findOrfail($request->id_jadwal);

        $data->id_pegawai   = $request->id_pegawai;
        $data->id_klinik    = $request->id_klinik;
        $data->hari         = $request->hari;
        $data->jam_buka     = $request->jam_buka;
        $data->jam_tutup    = $request->jam_tutup;
        $data->estimasi     = $request->estimasi;

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

    public function JadwalHapus(Request $request)
    {

        $data = JadwalDokter::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }

}
