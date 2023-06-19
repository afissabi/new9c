<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\front\Helper;
use App\Mail\SendEmail;
use App\Models\BankPencarian;
use App\Models\DetailUser;
use App\Models\M_klinik;
use App\Models\M_operasional;
use App\Models\M_pembayaran;
use App\Models\Master\JadwalDokter;
use App\Models\Master\M_jabatan;
use App\Models\Master\M_layanan;
use App\Models\Master\M_pasien;
use App\Models\Master\M_pegawai;
use App\Models\Master\M_promo;
use App\Models\Master\Mapping_layanan;
use App\Models\Master\Mapping_pegawai;
use App\Models\Master\Mapping_promo;
use App\Models\Master\Master;
use App\Models\Master\MetodeBayar;
use App\Models\ModelHasRoles;
use App\Models\T_pesan;
use App\Models\T_register;
use App\Models\Umum\Umum;
use App\Models\User;
use App\Models\Website\Konten_section;
use App\Models\Website\M_artikel;
use App\Models\Website\M_section;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function CariKunci(Request $request)
    {
        $hasil = '';
        $bank = BankPencarian::where('judul', 'LIKE', '%'.$request->kata.'%')->get();

        foreach ($bank as $value) {
            $hasil .= '<a href="' . url($value->url) . '"><h5 style="color:#ffff;background: #06a3da4f;padding: 10px;"> ' . $value->kategori . ' <i class="fas fa-arrow-alt-circle-right"></i> ' . $value->judul . '</h5></a>';
        }

        echo $hasil;
    }

    public function index()
    {
        $slide1 = Konten_section::where('id_section',1)->first();
        $sliderother = collect(Umum::Slider());
        $testi = Konten_section::where('id_section',6)->get();
        $vendor = Konten_section::where('id_section',7)->get();

        $data = [
            'menu_active'   => 'Home',
            'parent_active' => '',
            'slider' => $sliderother,
            'slide1' => $slide1,
            'testi' => $testi,
            'vendor' => $vendor,
        ];

        return view('front.index', $data);
    }

    public function summaryTotal()
    {
        $klinik = M_klinik::count();
        $jabatan = M_jabatan::where('nama_jabatan', 'dokter')->first();
        $dokter = M_pegawai::where('m_pegawai.jabatan',$jabatan->id_jabatan)->count();
        $layanan = M_layanan::count();
        // $testi = Konten_section::where('id_section',6)->get();

        // $testimoni  = '';

        // foreach ($testi as $value) {
        //     $testimoni .= '
        //     <div class="testimonial-item bg-light my-4" style="border-radius: 170px 0px 0px 0px;">
        //         <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5" >
        //             <img class="img-fluid" src="'.asset($value->path, $value->gambar) .'" style="width: 150px; height: 150px; border-radius: 50%;margin-top:-70px;border: 7px solid #0545f5;
        //             ">
        //             <div class="ps-4">
        //                 <h4 class="text-primary mb-1">' . $value->judul . '</h4>
        //             </div>
        //         </div>
        //         <div class="pt-4 pb-5 px-5">
        //         ' . $value->konten . '
        //         </div>
        //     </div>';
        // }

        $data = [
            'klinik' => $klinik,
            'layanan' => $layanan,
            'dokter' => $dokter,
            // 'testimoni' => $testimoni,
        ];

        return response()->json($data);
    }

    public function getBlog(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','blog')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="blog-img position-relative overflow-hidden">
                        <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" alt="" style="max-height: 205px;width: -webkit-fill-available;">
                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Blog</a>
                    </div>
                    <div class="p-4" style="max-height: 245px;min-height: 245px;">
                        <div class="d-flex mb-3">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                        <h6 class="mb-3"><a class="" href="' . url('read-artikel/blog/' . $value->slug_judul) . '">' . substr($value->judul, 0, 50) . '...</a></h6>
                        <div style="font-size: 10px !important;" class="get-blog">' . substr($value->konten, 0, 250) . '...</div>
                        <a class="" href="' . url('read-artikel/blog/' . $value->slug_judul) . '">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>';
        }

        echo $blog;
    }

    public function getPromo(Request $request)
    {
        $blog  = '';
        $promo = M_promo::where('status',1)->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($promo as $value) {
            $blog .= '
            <div class="col-lg-4 wow slideInUp mb-3" data-wow-delay="0.6s">
                <div class="bg-light rounded" style="margin-right: 5px;border-radius: 5px !important;box-shadow: 0px 3px 2px 1px;">
                    <img class="img-fluid rounded" src="' . asset('img/promo/' . $value->gambar) . '" style="border-radius: 5px 5px 0px 0px !important;">
                    <div>
                        <a href="' . url('register/promo/' . $value->slug_judul) . '" class="btn btn-warning py-2 px-4" style="width: -webkit-fill-available;">Pesan Sekarang</a>
                    </div>
                </div>
            </div>';
        }

        echo $blog;
    }

    public function allPromo(Request $request)
    {
        $blog  = '';
        $promo = M_promo::where('status',1)->orderBy('tgl_awal')->get();

        foreach ($promo as $value) {
            $blog .= '
            <div class="col-lg-4 wow slideInUp mb-3" data-wow-delay="0.6s">
                <div class="bg-light rounded" style="margin-right: 5px;border-radius: 5px !important;box-shadow: 0px 3px 2px 1px;">
                    <img class="img-fluid rounded" src="' . asset('img/promo/' . $value->gambar) . '" style="border-radius: 5px 5px 0px 0px !important;">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="' . url('promo/' . $value->slug_judul) . '" class="btn btn-block btn-info py-2 px-4" style="width: -webkit-fill-available;color: #fff;background: #08277c;border: 1px solid #08277c;">Detail Promo</a>
                        </div>
                        <div class="col-md-6">
                            <a href="' . url('register/promo/' . $value->slug_judul) . '" class="btn btn-block btn-warning py-2 px-4" style="width: -webkit-fill-available;">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>';
        }

        echo $blog;
    }

    public function getDokter(Request $request)
    {
        $dokter  = '';
        $page = $request->input('page', 1);
        $perPage = 1;
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $jabatan = M_jabatan::where('nama_jabatan', 'dokter')->first();
        $data = M_pegawai::where('jabatan',$jabatan->id_jabatan)->paginate(2);

        foreach ($data as $value) {
            $dokter .= '
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                <img class="img-fluid rounded" src="' . asset('front/img/logo_bulat.png') . '" style="height: 70px;position: absolute;margin-top: -19px;border-radius: 50% !important;border: 3px dashed #1574c0;" >
                <div class="team-item rounded overflow-hidden" style="background-image: url('. asset('front/img/bg-team.png') . ');background-size: cover;background-repeat: no-repeat;">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="' . asset($value->path . $value->foto) . '" alt="">
                        <div class="team-social">
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-twitter fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-instagram fw-normal"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a href="#">
                            <h4 class="text-primary">'. $value->nama_pegawai .'</h4>
                        </a>
                        <p class="text-uppercase m-0">'. $value->spesialis .'</p>
                    </div>
                </div>
            </div>';
        }

        // Mengganti view factory default menjadi view factory menggunakan Bootstrap
        View::share('paginator', $data->appends(request()->except('page')));

        // Render tampilan data dengan view yang sesuai
        // $content = view('data.index', compact('data'))->render();

        // Mengembalikan data halaman dan tautan pagination dalam format JSON
        
        $response = [
            'dokter' => $dokter,
            'pagination' => $data->links()
        ];

        return response()->json($response);
    }

    public function allBlog(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','blog')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="col-md-6 wow slideInUp v_cari" data-wow-delay="0.1s" data-filter-name="' . strtolower($value->judul) . '">
                <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="blog-img position-relative overflow-hidden">
                        <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" alt="" style="max-height: 205px;width: -webkit-fill-available;">
                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Blog</a>
                    </div>
                    <div class="p-4" style="max-height: 225px;min-height: 225px;">
                        <div class="d-flex mb-3">
                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small>
                        <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                        <h6 class="mb-3"><a class="" href="' . url('read-artikel/blog/' . $value->slug_judul) . '">' . substr($value->judul, 0, 50) . '...</a></h6>
                        <div class="get-blog" style="font-size: 10px !important;">
                            <p>' . substr($value->konten, 0, 150) . '</p>
                        </div>
                        <a class="text-uppercase" href="' . url('read-artikel/blog/' . $value->slug_judul) . '">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>';
        }

        echo $blog;
    }

    public function recentBlog(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','blog')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="d-flex rounded overflow-hidden mb-3">
                <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" style="width: 100px; height: 100px; object-fit: cover;z-index: 1;" alt="">
                <div class="row" style="background: #0545f529;min-width: -webkit-fill-available;">
                    <div class="mt-3">
                        <a href="' . url('read-artikel/blog/' . $value->slug_judul) . '" class="h6 fw-semi-bold mb-0" style="margin-left: 16px;display: block;font-size: 10px;width: 220px;">' . substr($value->judul, 0, 150) . '...</a>
                        <div class="ml-3" style="margin-left: 16px;font-size: 12px;">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small><br>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                    </div>
                </div>
                
            </div>';
        }

        echo $blog;
    }

    public function pressRelease(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','press')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="d-flex rounded overflow-hidden mb-3">
                <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" style="width: 100px; height: 100px; object-fit: cover;z-index: 1;" alt="">
                <div class="row" style="background: #0545f529;min-width: -webkit-fill-available;">
                    <div class="mt-3">
                        <a href="' . $value->link . '" class="h6 fw-semi-bold mb-0" style="margin-left: 16px;display: block;font-size: 20px;width: 220px;">' . substr($value->judul, 0, 150) . '...</a>
                        <div class="ml-3" style="margin-left: 16px;display: block;font-size: 12px;width: 220px;">
                            <small class="me-3"><i class="fas fa-link text-primary me-2"></i>' . substr($value->link, 0, 50) . '...</small><br>
                        </div>
                    </div>
                </div>
                
            </div>';
        }

        echo $blog;
    }

    public function allMisol(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','misi-sosial')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="col-md-6 wow slideInUp v_cari" data-wow-delay="0.1s" data-filter-name="' . strtolower($value->judul) . '">
                <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="blog-img position-relative overflow-hidden">
                        <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" alt="" style="max-height: 205px;width: -webkit-fill-available;">
                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Misi Sosial</a>
                    </div>
                    <div class="p-4" style="max-height: 225px;min-height: 225px;">
                        <div class="d-flex mb-3">
                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small>
                        <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                        <h6 class="mb-3">' . $value->judul . '</h6>
                        <div class="get-blog" style="font-size: 10px !important;">
                            <p>' . substr($value->konten, 0, 150) . '</p>
                        </div>
                        <a class="text-uppercase" href="' . url('read-artikel/misi-sosial/' . $value->slug_judul) . '">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>';
        }

        echo $blog;
    }

    public function recentMisol(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','misi-sosial')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="d-flex rounded overflow-hidden mb-3">
                <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" style="width: 100px; height: 100px; object-fit: cover;z-index: 1;" alt="">
                <div class="row" style="background: #0545f529;min-width: -webkit-fill-available;">
                    <div class="col-md-12 mt-3">
                        <a href="' . url('read-artikel/misi-sosial/' . $value->slug_judul) . '" class="h6 fw-semi-bold align-items-center px-3 mb-0" style="width: 230px;">' . $value->judul . '</a>
                        <div class="ml-3" style="margin-left: 16px;font-size: 12px;">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small><br>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                    </div>
                </div>
                
            </div>';
        }

        echo $blog;
    }

    public function allEvent(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','event')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="col-md-6 wow slideInUp v_cari" data-wow-delay="0.1s" data-filter-name="' . strtolower($value->judul) . '">
                <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="blog-img position-relative overflow-hidden">
                        <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" alt="" style="max-height: 205px;width: -webkit-fill-available;">
                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Misi Sosial</a>
                    </div>
                    <div class="p-4" style="max-height: 225px;min-height: 225px;">
                        <div class="d-flex mb-3">
                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small>
                        <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                        <h6 class="mb-3">' . $value->judul . '</h6>
                        <div class="get-blog" style="font-size: 10px !important;">
                            <p>' . substr($value->konten, 0, 150) . '</p>
                        </div>
                        <a class="text-uppercase" href="' . url('read-artikel/misi-sosial/' . $value->slug_judul) . '">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>';
        }

        echo $blog;
    }

    public function recentEvent(Request $request)
    {
        $blog  = '';
        $artikel = M_artikel::where('kategori','event')->orderBy('updated_at','DESC')->limit($request->need)->get();

        foreach ($artikel as $value) {
            $blog .= '
            <div class="d-flex rounded overflow-hidden mb-3">
                <img class="img-fluid" src="' . asset($value->path . $value->gambar) . '" style="width: 100px; height: 100px; object-fit: cover;z-index: 1;" alt="">
                <div class="row" style="background: #0545f529;min-width: -webkit-fill-available;">
                    <div class="col-md-12 mt-3">
                        <a href="' . url('read-artikel/misi-sosial/' . $value->slug_judul) . '" class="h6 fw-semi-bold align-items-center px-3 mb-0" style="width: 230px;">' . $value->judul . '</a>
                        <div class="ml-3" style="margin-left: 16px;font-size: 12px;">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin 9C Orthodontics</small><br>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>' . \Carbon\Carbon::parse($value->updated_at)->format('d-m-Y') . '</small>
                        </div>
                    </div>
                </div>
                
            </div>';
        }

        echo $blog;
    }

    // public function getVendor(Request $request)
    // {
    //     $vendor = Konten_section::where('id_section',7)->get();

    //     $blog = '<div class="owl-carousel vendor-carousel" >';
    //     foreach ($vendor as $value) {
    //         $blog .= '<img src="' . asset($value->path . $value->gambar) . '" alt="">';
    //     }
    //     $blog  .= '</div>';

    //     echo $blog;
    // }


    public function misiSosial()
    {
        // $plain = Konten_section::where('id_section',10)->first();
        $galeri = M_artikel::where('kategori','galeri')->where('kategori_galeri','MISOL')->orderBy('updated_at','Desc')->get();

        $data = [
            'menu_active'   => 'Artikel',
            'parent_active' => '',
            'galeri' => $galeri,
        ];

        return view('front.misol', $data);
    }

    public function Event()
    {
        // $plain = Konten_section::where('id_section',10)->first();
        $galeri = M_artikel::where('kategori','galeri')->where('kategori_galeri','EVENT')->orderBy('updated_at','Desc')->get();

        $data = [
            'menu_active'   => 'Artikel',
            'parent_active' => '',
            'galeri' => $galeri,
        ];

        return view('front.event', $data);
    }


    public function artikel()
    {
        $plain = Konten_section::where('id_section',10)->first();

        $data = [
            'menu_active'   => 'Artikel',
            'parent_active' => '',
            'plain' => $plain,
        ];

        return view('front.artikel', $data);
    }

    public function promo()
    {
        $data = [
            'menu_active'   => 'Promo',
            'parent_active' => '',
        ];

        return view('front.promo', $data);
    }

    public function promoDetail($slug)
    {
        $promo = M_promo::where('slug_judul',$slug)->first();
        $metode = MetodeBayar::where('id_promo',$promo->id_m_promo)->get();

        $data = [
            'menu_active'   => 'Promo',
            'parent_active' => '',
            'promo'         => $promo,
            'metode'         => $metode
        ];

        return view('front.detailpromo', $data);
    }

    public function regpromo($slug)
    {
        $promo = M_promo::where('slug_judul',$slug)->first();
        
        $data = [
            'menu_active'   => 'Promo',
            'parent_active' => '',
            'promo'         => $promo
        ];

        return view('front.regpromo', $data);
    }

    public function klinikPromo(Request $request)
    {
        $datas = Mapping_promo::where('id_promo',decrypt($request->promo))->get();
        
        $klinik = '';

        foreach ($datas as $value) {
            $klinik .= '
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #2F3A60 !important;color: #fff;">
                    <div class="">
                        <img src="' . asset('front/img/maps.png') .'" style="width: 90px;background: #fff;border-radius: 50%;">
                    </div>
                    <h4 class="mb-3" style="color:#fff">' . $value->klinik->nama . '</h4>
                    <p class="m-0">' . $value->klinik->alamat . '<br>' . $value->klinik->kota .'</p>
                    <a class="btn btn-lg btn-primary rounded tanggal" href="javascript:void(0)" data-id_klinik="' . $value->id_klinik . '" data-id_promo="' . $value->id_promo . '" style="width: -webkit-fill-available !important;border-radius: 40px 0px 0px 40px !important;">
                        <i class="bi bi-arrow-right"></i> PILIH
                    </a>
                </div>
                <svg viewBox="0 0 500 200">
                    <path d="M 0 30 C 150 100 280 0 500 20 L 500 0 L 0 0" fill="#2F3A60"></path>
                </svg>
            </div>';
        }

        echo $klinik;
    }

    public function tanggalPromo(Request $request)
    {
        $promo = M_promo::where('id_m_promo',$request->promo)->first();
        
        // SETTING TANGGAL
        $begin = new DateTime($promo->tgl_awal);
        
        $akhir = date('d-m-Y', strtotime($promo->tgl_akhir . "+1 days"));
        // $akhir = \Carbon\Carbon::parse($promo->tgl_akhir)->format('d-m-Y');

        $end = new DateTime($akhir);
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        
        $tanggal = [];
        $hari = [];

        $html = '';

        foreach ($period as $dt) {
            $is_disabled = false;
            // $tanggal[] = $dt->format("d");
            // $hari[] = \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))));
            $tutup = $this->Tutup($request->klinik, \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))));
            if($tutup){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
                $a = '';
            }else{
                $bg = 'bg-green-turquoise';
                $a = '<a class="jam" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_promo="' . $request->promo . '" data-tanggal="'.$dt->format('Y-m-d').'" data-hari="' . strtoupper(\App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))))) . '">';
            }

            $html .= '
                <div class="tile '.$bg.' jadwal" style="background: #8ACCFF; width:130px; height:110px;" data-tanggal="'.$dt->format('Y-m-d').'" data-disabled="' . $is_disabled . '">
                    '. $a .'
                        <div class="corner" style="float: left; font-weight: bold; color:#fff">
                            <span>' . \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))) . '</span>
                        </div>
                        <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                            <i style="font-style:normal;">' . $dt->format("d") . '</i>
                        </div>
                        <div class="tile-object">
                            <div class="name">' . \App\Helpers\Helper::bulansort($dt->format("m")) . '</div>
                            <div class="number">'.$dt->format("Y").'</div>
                        </div>
                    </a>
                </div>
            ';
        }

        $kembali = '<a href="javascript:void(0)" onClick="promo()" class="menu-link px-3 btn-warning mb-1" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function jamPromo(Request $request)
    {
        $klinik = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->first();
        $html = '';
        $starttime = $klinik->jam_buka;
        $endtime = $klinik->jam_tutup;
        // $duration = $promo->waktu_layanan;

        $array_of_time = array ();
        $start_time    = strtotime ($starttime);
        $nyartime	   = date("H:i", strtotime('-30 minutes', strtotime($endtime)));
        $end_time      = strtotime($nyartime);
        $add_mins  = 30 * 60;

        while ($start_time <= $end_time)
        {
            $array_of_time[] = date ("H:i", $start_time);
            $start_time += $add_mins;
        }
        
        foreach($array_of_time as $value){
            $start_time    = strtotime($value);
            $add_mins  = 30 * 60;
            $plus = $start_time + $add_mins;
            $estimasi = date("H:i", $plus);
            $is_disabled = false;

            $penuh = $this->Penuh($request->promo, $request->klinik, $request->tanggal, $value);
            if($penuh == 'penuh'){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
                $a = '';
                $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
            }else{
                $bg = 'bg-green-turquoise';
                $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_promo="' . $request->promo . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
                $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
            }

            $html .= '<div class="tile '. $bg .'" style="width:130px; height:110px;" data-disabled="' . $is_disabled . '">
                '.$a.'
                    <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                        '.$i.'
                    </div>
                    <div class="tile-object" style="background: #2F3A60;">
                        <h5 style="text-align:center;color:#ffff;margin-bottom: 0px !important;margin-top: 4px;">'. $value . ' WIB</h5>
                    </div>
                </a>
            </div>';
        }

        $kembali = '<a href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_promo="' . $request->promo . '" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    private function penuh($promo, $klinik, $tanggal, $jam){
        $waktu = $jam.':00';
        $cek = T_register::where('id_promo',$promo)->where('id_klinik',$klinik)->where('tanggal',$tanggal)->where('jam',$waktu)->where('status',1)->count();
        
        $penuh = '';

        if($cek >= 2){
            $penuh = 'penuh';
        }

        return $penuh;

    }

    public function formPromo(Request $request)
    {
        $klinik = M_klinik::where('id_klinik',$request->klinik)->first();
        $promo = M_promo::where('id_m_promo',$request->promo)->first();
        $metode = MetodeBayar::where('id_promo',$request->promo)->get();

        $html = '';
        $tabel = '';
        $tabel .= '
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr style="background: #2F3A60;color: #fff;">
                        <th colspan="4"><center>DETAIL PENDAFTARAN ANDA</center></th>
                    </tr>
                    <tr style="background: #2F3A60;color: #fff;">
                        <th scope="col"><center>PROMO</center></th>
                        <th scope="col"><center>KLINIK</center></th>
                        <th scope="col"><center>TANGGAL</center></th>
                        <th scope="col"><center>JAM</center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="">
                        <td scope="col"><center>' . $promo->judul_promo . '</center></td>
                        <td scope="col"><center>' . $klinik->nama . '<br>' . $klinik->alamat . '</center></td>
                        <td scope="col"><center>' . \App\Helpers\Helper::hariIndo(\Carbon\Carbon::parse($request->tanggal)->format('D')) . '<br>' . \Carbon\Carbon::parse($request->tanggal)->format('d-m-Y'). '</center></td>
                        <td scope="col"><center>' . $request->jam . ' WIB</center></td>
                    </tr>
                </tbody>
            </table>';
        
        $html .= '
            <input type="hidden" class="form-control" name="promo" value="' . $request->promo . '">
            <input type="hidden" class="form-control" name="klinik" value="' . $request->klinik . '">
            <input type="hidden" class="form-control" name="tanggal" value="' . $request->tanggal . '">
            <input type="hidden" class="form-control" name="jam" value="'. $request->jam .'">
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Nama :</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="nama" placeholder="Nama Pasien" required>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Email :</label>
                <div class="col-lg-4">
                    <input type="email" class="form-control" name="email" placeholder="Email Pasien" required>
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="telp" placeholder="No.hp / WA" required>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Tipe Pembayaran :</label>
                <div class="col-lg-6">
                    <select class="form-select" name="tipe_bayar" id="tipe_bayar" onchange="pilihMetode();" required>
                    <option value="">-Pilih Metode Pembayaran-</option>
                    ';
                    foreach($metode as $value){
                        if($value->jenis_pembayaran == 'CASH'){
                            $html .= '<option value="' . $value->id_metode_pembayaran . '">' . $value->jenis_pembayaran . '</option>';
                        }else{
                            $html .= '<option value="' . $value->id_metode_pembayaran . '">' . $value->jenis_pembayaran . ' ' . $value->tenor . 'x </option>';
                        }
                        
                    }
            $html .= '</select>
                </div>
            </div>
            <div class="row mb-2" id="total_bayar">
                
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Catatan :</label>
                <div class="col-lg-6" style="text-align: justify;color: #fff;background: #2F3A60;">
                    <p>Jika pembayaran segera dilakukan maka jadwal akan dikeep untuk anda. Namun jika pembayaran di klinik jadwal dapat berubah sewaktu-waktu...</p>
                    <p>Konfirmasi pembayaran ke admin klinik di : ' . $klinik->admin . '</p>
                </div>
            </div>';
    

        $kembali = '<a href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_promo="' . $request->promo . '" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "tabel" => $tabel,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function getMetodeBayarPromo(Request $request)
    {
        $bayar  = '';
        $tipe = MetodeBayar::where('id_metode_pembayaran',$request->tipe)->first();

        if($tipe->jenis_pembayaran == 'CASH'){
            $bayar .= '<label class="col-lg-3 col-form-label text-lg-end required">Total :</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" name="total" placeholder="Total" value="'. number_format($tipe->promo->harga, 0,",",".") .'" readonly>
            </div>';
        }else{
            $bayar .= '<label class="col-lg-3 col-form-label text-lg-end required">Total :</label>
            <div class="col-lg-3">
                <p>Total DP</p>
                <input type="text" class="form-control" name="dp" placeholder="Total DP" value="'.number_format($tipe->dp, 0,",",".").'" readonly>
            </div>
            <div class="col-lg-2">
                <p>Tenor</p>
                <input type="text" class="form-control" name="tenor" placeholder="Tenor" value="'.number_format($tipe->tenor, 0,",",".").'" readonly>
            </div>
            <div class="col-lg-3">
                <p>Cicilan</p>
                <input type="text" class="form-control" name="cicilan" placeholder="Cicilan" value="'.number_format($tipe->cicilan, 0,",",".").'" readonly>
            </div>';
        }
        

        echo $bayar;
    }

    // public function promoDaftar(Request $request)
    // {
    //     $cek = M_pasien::where('email',$request->email)->first();
        
    //     if($cek){
    //         $pasien = $cek;
    //         $id_pasien = $cek->id_pasien;
    //     }else{
    //         $pasien = new M_pasien;
    //         $id_pasien = M_pasien::max('id_pasien') + 1;
    //     }

    //     $pasien->nama_pasien = $request->nama;
    //     $pasien->email = $request->email;
    //     $pasien->telp = $request->telp;
        

    //     $reg = new T_register();
    //     $id_reg = T_register::max('id_t_register') + 1;
    //     $reg->tipe = 'PROMO';
    //     $reg->id_promo = $request->promo;
    //     $reg->id_pasien = $id_pasien;
    //     $reg->id_klinik = $request->klinik;
    //     $reg->tanggal_daftar = date('Y-m-d');
    //     $reg->tanggal = $request->tanggal;
    //     $reg->jam = $request->jam;
    //     $reg->tipe_pembayaran = $request->tipe_bayar;
        

    //     $bayar = new M_pembayaran();
    //     $bayar->id_t_register = $id_reg;
    //     $bayar->jenis_pembayaran = $request->tipe_bayar;
    //     $bayar->nilai = $request->nilai;
    //     $bayar->status = 0;
        
    //     $pasien->save();
    //     $reg->save();
    //     $bayar->save();

    //     return redirect('/thanks');
    // }

    public function promoDaftar(Request $request)
    {
        $cek = M_pasien::where('email',$request->email)->first();
        $id_reg = DB::table('t_register')->max('id_t_register') + 1;
        // $jam = $request->jam.':00';
        // $cekreg = T_register::where('id_promo',$request->promo)->where('id_klinik',$request->klinik)->where('id_pasien',$cek->id_pasien)->where('tanggal',$request->tanggal)->where('jam',$jam)->first();

        if($cek){
            $jam = $request->jam.':00';
            $cekreg = T_register::where('id_promo',$request->promo)->where('id_klinik',$request->klinik)->where('id_pasien',$cek->id_pasien)->where('tanggal',$request->tanggal)->where('jam',$jam)->first();
            $pasien = $cek;
            $id_pasien = $cek->id_pasien;
        }else{
            $pasien = new M_pasien;
            $id_pasien = DB::table('m_pasien')->max('id_pasien') + 1;

            // NAMBAH USER UNTUK MEMBER BARU
            // $member = new User();
            // $id = User::max('id') + 1;
            // $pas = $this->RandomPass();
            // $member->name = $request->nama;
            // $member->username = $request->email;
            // $member->is_aktif = null;
            // $member->password_see = $pas;
            // $member->password = Hash::make($pas);
            // $member->save();

            // NAMBAH MODEL HAS ROLE
            // $has = new ModelHasRoles();
            // $has->model_id = $id;
            // $has->model_type = 'App\Models\User';
            // $has->role_id  = 4;
            // $has->save();

            // NAMBAH DETAIL USER
            // $detail = new DetailUser();
            // $detail->user_id = $id;
            // $detail->id_pasien = $id_pasien;
            // $detail->telp = $request->telp;
            // $detail->save();


            // KIRIM EMAIL REGISTRASI PASIEN BARU
            // $email = $request->email;
            // $data = [
            //     'user' => $request->email,
            //     'kunci' => $pas,
            // ];
        
            // Mail::to($email)->send(new SendEmail($data));
        }

        $pasien->nama_pasien = $request->nama;
        $pasien->email = $request->email;
        $pasien->telp = $request->telp;
        
        if($cek){
            if($cekreg){
                $reg = $cekreg;
                // $id_reg = $cekreg->id_t_register;
            }else{
                $reg = new T_register();
                // $id_reg = T_register::max('id_t_register') + 1;
                $reg->status = 0;
            }
        }else{
            $reg = new T_register();
            // $id_reg = T_register::max('id_t_register') + 1;
            $reg->status = 0;
        }
        
        $reg->tipe = 'PROMO';
        $reg->id_promo = $request->promo;
        $reg->id_pasien = $id_pasien;
        $reg->id_klinik = $request->klinik;
        $reg->tanggal_daftar = date('Y-m-d');
        $reg->tanggal = $request->tanggal;
        $reg->jam = $request->jam;
        $reg->id_metode = $request->tipe_bayar;
        
        
        $metode = MetodeBayar::where('id_metode_pembayaran',$request->tipe_bayar)->first();

        $bayar = new M_pembayaran();
        $bayar->id_t_register =  $id_reg;
        $bayar->tipe = $request->tipe_bayar;
        $bayar->id_pasien = $id_pasien;
        $bayar->jenis_pembayaran = $metode->jenis_pembayaran;
        if($metode->jenis_pembayaran == 'CASH'){
            $bayar->nilai = str_replace('.', '', trim($request->total));
            $bayar->keterangan = 'Pembayaran Cash Promo ' . $metode->promo->judul_promo;
        }else{
            $bayar->nilai = str_replace('.', '', trim($request->dp));
            $bayar->is_dp = 't';
            $bayar->keterangan = 'Pembayaran DP Cicilan Promo ' . $metode->promo->judul_promo;
        }
        
        $bayar->status = 0;

        try {
            $pasien->save();
            $reg->save();
            $bayar->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pendaftaran Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Pendaftaran Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    private function RandomPass(){
        $n=10;
        function getName($n) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
        
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
        
            return $randomString;
        }
        
        return getName($n);
    }

    private function Tutup($id_klinik, $hari){
        $cek = M_operasional::where('id_klinik',$id_klinik)->where('hari',$hari)->where('status','TUTUP')->first();

        return $cek;
    }


    public function thanks()
    {
        return view('front.thanks');
    }

    public function sendRegister(Request $request)
    {
        // $email = 'afissabimas@gmail.com';

        // $data = [
        //     'name' => 'Afis',
        //     'body' => 'Testing Kirim Email Najah Tech'
        // ];
       
        // Mail::to($email)->send(new SendEmail($data));
        // dd("Email Berhasil dikirim.");

        return view('front.emailregister');

    }

    public function artikelRead(Request $request)
    {
        $read = M_artikel::where('kategori',$request->tipe)->where('slug_judul',$request->slug)->first();
        $plain = Konten_section::where('id_section',10)->first();

        $data = [
            'read' => $read,
            'tipe' => $request->tipe,
            'plain' => $plain,
            'menu_active'   => 'Artikel',
            'parent_active' => '',
        ];

        return view('front.readartikel', $data);
    }

    public function kami()
    {
        $kami = Konten_section::where('id_section',8)->first();
        $vendor = Konten_section::where('id_section',7)->get();

        $data = [
            'menu_active'   => 'Tentang Kami',
            'parent_active' => '',
            'vendor' => $vendor,
            'kami' => $kami,
        ];

        return view('front.kami', $data);
    }

    public function cabang()
    {
        $klinik = collect(Master::Klinik());
        $vendor = Konten_section::where('id_section',7)->get();
        $data = [
            'menu_active'   => 'cabang',
            'parent_active' => '',
            'vendor' => $vendor,
            'klinik' => $klinik,
        ];

        return view('front.cabang', $data);
    }

    public function cabangDetail($id)
    {
        $klinik = M_klinik::where('id_klinik',decrypt($id))->first();
        $jam = M_operasional::where('id_klinik',decrypt($id))->get();

        $data = [
            'menu_active'   => 'cabang',
            'parent_active' => '',
            'klinik' => $klinik,
            'jam' => $jam,
        ];

        return view('front.cabangdetail', $data);
    }

    public function timDokter()
    {
        $jabatan = M_jabatan::where('nama_jabatan', 'dokter')->first();
        $dokter = M_pegawai::where('jabatan',$jabatan->id_jabatan)->paginate(16);
        $vendor = Konten_section::where('id_section',7)->get();

        $data = [
            'menu_active'   => 'dokter',
            'parent_active' => '',
            'dokter' => $dokter,
            'vendor' => $vendor,
        ];

        return view('front.timdokter', $data);
    }

    public function jadwalDokter($slug)
    {
        $dokter = M_pegawai::where('slug',$slug)->first();
        $klinik = Mapping_pegawai::where('id_pegawai',$dokter->id_pegawai)->get();
        foreach($klinik as $value){
            $value->jadwal = JadwalDokter::where('id_pegawai', $dokter->id_pegawai)->where('id_klinik',$value->id_klinik)->get();
        }

        $data = [
            'menu_active'   => 'jadwal-dokter',
            'parent_active' => '',
            'dokter' => $dokter,
            'klinik' => $klinik,
        ];

        return view('front.jadwaldokter', $data);
    }

    public function showLayanan()
    {
        $data = [
            'menu_active'   => 'Layanan',
            'parent_active' => '',
        ];

        return view('front.layanan', $data);
    }

    public function pilihDokter()
    {
        $data = [
            'menu_active'   => 'Layanan',
            'parent_active' => '',
        ];

        return view('front.dokter', $data);
    }

    public function pilihJadwal()
    {
        $data = [
            'menu_active'   => 'Layanan',
            'parent_active' => '',
        ];

        return view('front.jadwal', $data);
    }

    public function hubkami()
    {
        $vendor = Konten_section::where('id_section',7)->get();

        $data = [
            'menu_active'   => 'Layanan',
            'parent_active' => '',
            'vendor' => $vendor,
        ];

        return view('front.hubkami', $data);
    }

    public function sendPesan(Request $request)
    {
        
        $reg = new T_pesan();

        $reg->nama = $request->nama;
        $reg->email = $request->email;
        $reg->subject = $request->subject;
        $reg->pesan = $request->pesan;
       
        try {
            $reg->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pesan Berhasil Terkirim!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Pesan Gagal Terkirim!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function Layanan()
    {
        $layanan = M_layanan::where('status',1)->get();
        $vendor = Konten_section::where('id_section',7)->get();
        
        $data = [
            'menu_active'   => 'dokter',
            'parent_active' => '',
            'layanan' => $layanan,
            'vendor' => $vendor,
        ];

        return view('front.layanan', $data);
    }

    // PENDAFTARAN LAYANAN REGULER
    public function pendaftaran(Request $request)
    {
        $nama_layanan = '';
        $id_layanan = '';
        
        if($request->slug != 'zero-service'){
            $layanan = M_layanan::where('slug_layanan', $request->slug)->first();
            $nama_layanan = $layanan->nama_layanan;
            $id_layanan = $layanan->id_layanan;
        }
        // $promo = M_promo::where('slug_judul',$slug)->first();
        
        $data = [
            'menu_active'   => 'Promo',
            'parent_active' => '',
            'nama_layanan'  => $nama_layanan,
            'id_layanan'  => $id_layanan,
        ];

        return view('front.regumum', $data);
    }

    public function klinikLayanan(Request $request)
    {
        $klinik = '';

        if($request->layanan){
            $datas = Mapping_layanan::where('id_layanan',$request->layanan)->get();
            
            foreach ($datas as $value) {
                $klinik .= '
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #2F3A60 !important;color: #fff;">
                        <div class="">
                            <img src="' . asset('front/img/maps.png') .'" style="width: 90px;background: #fff;border-radius: 50%;">
                        </div>
                        <h4 class="mb-3" style="color:#fff">' . $value->klinik->nama . '</h4>
                        <p class="m-0">' . $value->klinik->alamat . '<br>' . $value->klinik->kota .'</p>
                        <a class="btn btn-lg btn-primary rounded tanggal" href="javascript:void(0)" data-id_klinik="' . $value->id_klinik . '" data-id_layanan="' . $value->id_layanan . '" style="width: -webkit-fill-available !important;border-radius: 40px 0px 0px 40px !important;">
                            <i class="bi bi-arrow-right"></i> PILIH
                        </a>
                    </div>
                    <svg viewBox="0 0 500 200">
                        <path d="M 0 30 C 150 100 280 0 500 20 L 500 0 L 0 0" fill="#2F3A60"></path>
                    </svg>
                </div>';
            }
        }else{
            $datas = M_klinik::all();
            
            foreach ($datas as $value) {
                $klinik .= '
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #2F3A60 !important;color: #fff;">
                        <div class="">
                            <img src="' . asset('front/img/maps.png') .'" style="width: 90px;background: #fff;border-radius: 50%;">
                        </div>
                        <h4 class="mb-3" style="color:#fff">' . $value->nama . '</h4>
                        <p class="m-0">' . $value->alamat . '<br>' . $value->kota .'</p>
                        <a class="btn btn-lg btn-primary rounded layanan" href="javascript:void(0)" data-id_klinik="' . $value->id_klinik . '" style="width: -webkit-fill-available !important;border-radius: 40px 0px 0px 40px !important;">
                            <i class="bi bi-arrow-right"></i> PILIH
                        </a>
                    </div>
                    <svg viewBox="0 0 500 200">
                        <path d="M 0 30 C 150 100 280 0 500 20 L 500 0 L 0 0" fill="#2F3A60"></path>
                    </svg>
                </div>';
            }
        }
        
        echo $klinik;
    }

    public function listLayanan(Request $request)
    {
        $layanan = '';

        $layanan .= '';

        $datas = Mapping_layanan::where('id_klinik',$request->klinik)->get();
        
        foreach ($datas as $item) {
            $layanan .= '
            <div class="col-lg-3 col-md-6 v_cari_layanan" data-filter-name="'. strtolower($item->layan->nama_layanan) .'" style="margin-right:10px;margin-bottom:10px;">
                <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #00378b;border-radius: 55px 30px !important;">
                    <div class="service-icon" style="transform: none;">
                        <img src="' . asset($item->layan->path . $item->layan->icon) .'" style="width: 100px;border-radius: 50%;">
                    </div>
                    <h4 class="mb-3" style="color: #fff;">' . $item->layan->nama_layanan .'</h4>
                    <p class="m-0" style="color: #d8ff00;">' . $item->layan->keterangan .'</p>
                    <a class="btn btn-lg btn-primary rounded tanggal" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $item->id_layanan . '">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>';
        }
        
        $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';

        $data = [
            "html" => $layanan,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function tanggalLayanan(Request $request)
    {
        $layan = M_layanan::where('id_layanan',$request->layanan)->first();
        
        // SETTING TANGGAL
        $begin = new DateTime('now');
        $akhir = date('d-m-Y', strtotime('now' . "+20 days"));

        $end = new DateTime($akhir);
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        
        $tanggal = [];
        $hari = [];

        $html = '';

        foreach ($period as $dt) {
            $is_disabled = false;
            // $tanggal[] = $dt->format("d");
            // $hari[] = \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))));
            $tutup = $this->Tutup($request->klinik, \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))));
            if($tutup){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
                $a = '';
            }else{
                $bg = 'bg-green-turquoise';
                $a = '<a class="jam" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="'.$dt->format('Y-m-d').'" data-hari="' . strtoupper(\App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))))) . '">';
            }

            $html .= '
                <div class="tile '.$bg.' jadwal" style="background: #8ACCFF; width:130px; height:110px;" data-tanggal="'.$dt->format('Y-m-d').'" data-disabled="' . $is_disabled . '">
                    '. $a .'
                        <div class="corner" style="float: left; font-weight: bold; color:#fff">
                            <span>' . \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))) . '</span>
                        </div>
                        <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                            <i style="font-style:normal;">' . $dt->format("d") . '</i>
                        </div>
                        <div class="tile-object">
                            <div class="name">' . \App\Helpers\Helper::bulansort($dt->format("m")) . '</div>
                            <div class="number">'.$dt->format("Y").'</div>
                        </div>
                    </a>
                </div>
            ';
        }

        $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "rawat" => $layan->nama_layanan,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function jamLayanan(Request $request)
    {
        $klinik = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->first();
        $layan = M_layanan::where('id_layanan',$request->layanan)->first();
        $html = '';
        $starttime = $klinik->jam_buka;
        $endtime = $klinik->jam_tutup;
        // $duration = $promo->waktu_layanan;

        $array_of_time = array ();
        $start_time    = strtotime ($starttime);
        $nyartime	   = date("H:i", strtotime('-30 minutes', strtotime($endtime)));
        $end_time      = strtotime($nyartime);
        $add_mins  = 30 * 60;

        while ($start_time <= $end_time)
        {
            $array_of_time[] = date ("H:i", $start_time);
            $start_time += $add_mins;
        }
        
        foreach($array_of_time as $value){
            $start_time    = strtotime($value);
            $add_mins  = 30 * 60;
            $plus = $start_time + $add_mins;
            $estimasi = date("H:i", $plus);
            $is_disabled = false;

            $penuh = $this->PenuhLayanan($request->layanan, $request->klinik, $request->tanggal, $value);
            if($penuh == 'penuh'){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
                $a = '';
                $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
            }else{
                $bg = 'bg-green-turquoise';
                $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
                $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
            }

            $html .= '<div class="tile '. $bg .'" style="width:130px; height:110px;" data-disabled="' . $is_disabled . '">
                '.$a.'
                    <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                        '.$i.'
                    </div>
                    <div class="tile-object" style="background: #2F3A60;">
                        <h5 style="text-align:center;color:#ffff;margin-bottom: 0px !important;margin-top: 4px;">'. $value . ' WIB</h5>
                    </div>
                </a>
            </div>';
        }

        $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "rawat" => $layan->nama_layanan,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    private function penuhLayanan($layanan, $klinik, $tanggal, $jam){
        $waktu = $jam.':00';
        $cek = T_register::where('id_layanan',$layanan)->where('id_klinik',$klinik)->where('tanggal',$tanggal)->where('jam',$waktu)->where('status',1)->count();
        
        $penuh = '';

        if($cek >= 2){
            $penuh = 'penuh';
        }

        return $penuh;

    }

    public function formLayanan(Request $request)
    {
        $klinik = M_klinik::where('id_klinik',$request->klinik)->first();
        $layanan = M_layanan::where('id_layanan',$request->layanan)->first();
        $metode = MetodeBayar::where('id_layanan',$request->layanan)->get();

        $html = '';
        $tabel = '';
        $tabel .= '
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr style="background: #2F3A60;color: #fff;">
                        <th colspan="4"><center>DETAIL PENDAFTARAN ANDA</center></th>
                    </tr>
                    <tr style="background: #2F3A60;color: #fff;">
                        <th scope="col"><center>LAYANAN</center></th>
                        <th scope="col"><center>KLINIK</center></th>
                        <th scope="col"><center>TANGGAL</center></th>
                        <th scope="col"><center>JAM</center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="">
                        <td scope="col"><center>' . $layanan->nama_layanan . '</center></td>
                        <td scope="col"><center>' . $klinik->nama . '<br>' . $klinik->alamat . '</center></td>
                        <td scope="col"><center>' . \App\Helpers\Helper::hariIndo(\Carbon\Carbon::parse($request->tanggal)->format('D')) . '<br>' . \Carbon\Carbon::parse($request->tanggal)->format('d-m-Y'). '</center></td>
                        <td scope="col"><center>' . $request->jam . ' WIB</center></td>
                    </tr>
                </tbody>
            </table>';
        
        $html .= '
            <input type="hidden" class="form-control" name="layanan" value="' . $request->layanan . '">
            <input type="hidden" class="form-control" name="klinik" value="' . $request->klinik . '">
            <input type="hidden" class="form-control" name="tanggal" value="' . $request->tanggal . '">
            <input type="hidden" class="form-control" name="jam" value="'. $request->jam .'">
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Nama :</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="nama" placeholder="Nama Pasien" required>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Email :</label>
                <div class="col-lg-4">
                    <input type="email" class="form-control" name="email" placeholder="Email Pasien" required>
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="telp" placeholder="No.hp / WA" required>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Tipe Pembayaran :</label>
                <div class="col-lg-6">
                    <select class="form-select" name="tipe_bayar" id="tipe_bayar" onchange="pilihMetode();" required>
                    <option value="">-Pilih Metode Pembayaran-</option>
                    ';
                    foreach($metode as $value){
                        if($value->jenis_pembayaran == 'CASH'){
                            $html .= '<option value="' . $value->id_metode_pembayaran . '">' . $value->jenis_pembayaran . '</option>';
                        }else{
                            $html .= '<option value="' . $value->id_metode_pembayaran . '">' . $value->jenis_pembayaran . ' ' . $value->tenor . 'x </option>';
                        }
                        
                    }
            $html .= '</select>
                </div>
            </div>
            <div class="row mb-2" id="total_bayar">
                
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Catatan :</label>
                <div class="col-lg-6" style="text-align: justify;color: #fff;background: #2F3A60;">
                    <p>Jika pembayaran segera dilakukan maka jadwal akan dikeep untuk anda. Namun jika pembayaran di klinik jadwal dapat berubah sewaktu-waktu...</p>
                    <p>Konfirmasi pembayaran ke admin klinik di : ' . $klinik->admin . '</p>
                </div>
            </div>';
    

        $kembali = '<a href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_promo="' . $request->promo . '" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "tabel" => $tabel,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function getMetodeBayarLayanan(Request $request)
    {
        $bayar  = '';
        $tipe = MetodeBayar::where('id_metode_pembayaran',$request->tipe)->first();

        if($tipe->jenis_pembayaran == 'CASH'){
            $bayar .= '<label class="col-lg-3 col-form-label text-lg-end required">Total :</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" name="total" placeholder="Total" value="'. number_format($tipe->layanan->harga, 0,",",".") .'" readonly>
            </div>';
        }else{
            $bayar .= '<label class="col-lg-3 col-form-label text-lg-end required">Total :</label>
            <div class="col-lg-3">
                <p>Total DP</p>
                <input type="text" class="form-control" name="dp" placeholder="Total DP" value="'.number_format($tipe->dp, 0,",",".").'" readonly>
            </div>
            <div class="col-lg-2">
                <p>Tenor</p>
                <input type="text" class="form-control" name="tenor" placeholder="Tenor" value="'.number_format($tipe->tenor, 0,",",".").'" readonly>
            </div>
            <div class="col-lg-3">
                <p>Cicilan</p>
                <input type="text" class="form-control" name="cicilan" placeholder="Cicilan" value="'.number_format($tipe->cicilan, 0,",",".").'" readonly>
            </div>';
        }
        

        echo $bayar;
    }

    public function layananDaftar(Request $request)
    {
        $cek = M_pasien::where('email',$request->email)->first();
        $id_reg = DB::table('t_register')->max('id_t_register') + 1;
        
        // $jam = $request->jam.':00';
        // $cekreg = T_register::where('id_promo',$request->promo)->where('id_klinik',$request->klinik)->where('id_pasien',$cek->id_pasien)->where('tanggal',$request->tanggal)->where('jam',$jam)->first();

        if($cek){
            $jam = $request->jam.':00';
            $cekreg = T_register::where('id_layanan',$request->layanan)->where('id_klinik',$request->klinik)->where('id_pasien',$cek->id_pasien)->where('tanggal',$request->tanggal)->where('jam',$jam)->first();
            $pasien = $cek;
            $id_pasien = $cek->id_pasien;
        }else{
            $pasien = new M_pasien;
            $id_pasien = DB::table('m_pasien')->max('id_pasien') + 1;

            // NAMBAH USER UNTUK MEMBER BARU
            // $member = new User();
            // $id = User::max('id') + 1;
            // $pas = $this->RandomPass();
            // $member->name = $request->nama;
            // $member->username = $request->email;
            // $member->is_aktif = null;
            // $member->password_see = $pas;
            // $member->password = Hash::make($pas);
            // $member->save();

            // NAMBAH MODEL HAS ROLE
            // $has = new ModelHasRoles();
            // $has->model_id = $id;
            // $has->model_type = 'App\Models\User';
            // $has->role_id  = 4;
            // $has->save();

            // NAMBAH DETAIL USER
            // $detail = new DetailUser();
            // $detail->user_id = $id;
            // $detail->id_pasien = $id_pasien;
            // $detail->telp = $request->telp;
            // $detail->save();


            // KIRIM EMAIL REGISTRASI PASIEN BARU
            // $email = $request->email;
            // $data = [
            //     'user' => $request->email,
            //     'kunci' => $pas,
            // ];
        
            // Mail::to($email)->send(new SendEmail($data));
        }

        $pasien->nama_pasien = $request->nama;
        $pasien->email = $request->email;
        $pasien->telp = $request->telp;
        
        if($cek){
            if($cekreg){
                $reg = $cekreg;
                // $id_reg = T_register::max('id_t_register') + 1;
            }else{
                $reg = new T_register();
                // $id_reg = T_register::max('id_t_register') + 1;
                $reg->status = 0;
            }
        }else{
            $reg = new T_register();
            // $id_reg = T_register::max('id_t_register') + 1;
            $reg->status = 0;
        }
        
        $reg->tipe = 'LAYANAN';
        $reg->id_layanan = $request->layanan;
        $reg->id_pasien = $id_pasien;
        $reg->id_klinik = $request->klinik;
        $reg->tanggal_daftar = date('Y-m-d');
        $reg->tanggal = $request->tanggal;
        $reg->jam = $request->jam;
        $reg->id_metode = $request->tipe_bayar;
        
        
        $metode = MetodeBayar::where('id_metode_pembayaran',$request->tipe_bayar)->first();
        
        $bayar = new M_pembayaran();
        $bayar->id_t_register = $id_reg;
        $bayar->id_pasien = $id_pasien;
        $bayar->tipe = $request->tipe_bayar;
        $bayar->jenis_pembayaran = $metode->jenis_pembayaran;
        if($metode->jenis_pembayaran == 'CASH'){
            $bayar->nilai = str_replace('.', '', trim($request->total));
            $bayar->keterangan = 'Pembayaran Cash Layanan ' . $metode->layanan->nama_layanan;
        }else{
            $bayar->nilai = str_replace('.', '', trim($request->dp));
            $bayar->is_dp = 't';
            $bayar->keterangan = 'Pembayaran DP Cicilan Layanan ' . $metode->layanan->nama_layanan;
            for ($j = 1; $j <= $request->tenor; $j++) {
                $cicil = new M_pembayaran;
                $cicil->id_t_register = $id_reg;
                $cicil->id_pasien = $id_pasien;
                $cicil->tipe = $request->tipe_bayar;
                $cicil->jenis_pembayaran = $metode->jenis_pembayaran;
                $cicil->nilai = str_replace('.', '', trim($request->cicilan));
                $cicil->is_dp = 'f';
                $cicil->status = 0;
                $cicil->keterangan = 'Pembayaran Cicilan Ke-' . $j . ' Layanan ' . $metode->layanan->nama_layanan;
                $cicil->cicilan_ke = $j;
                $cicil->save();
            }
        }
        
        $bayar->status = 0;

        try {
            $pasien->save();
            $reg->save();
            $bayar->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pendaftaran Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Pendaftaran Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function ResetPassword($email)
    {        
        $data = [
            'email' => $email,
        ];

        return view('auth.resetpass',$data);
    }

    public function simpanPass(Request $request)
    {
        $data = User::where('username',$request->email)->first();
        
        $data->password = Hash::make($request->password);

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
