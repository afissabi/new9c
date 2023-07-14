<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlinikController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\MemberLoginController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Website\ArtikelController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\SectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pencarian-kata-kunci', [FrontController::class, 'CariKunci'])->name('pencarian-kata-kunci');

Route::get('/', [FrontController::class, 'index']);
// Route::get('/', function () {
//     return view('front.maintenance');
// });
Route::get('/tim-dokter', [FrontController::class, 'timDokter'])->name('tim-dokter');
Route::get('/tim-dokter/jadwal/{slug}', [FrontController::class, 'jadwalDokter'])->name('jadwal-dokter');
Route::get('/layanan/klinik/pusat', [FrontController::class, 'showLayanan'])->name('layanan');
Route::get('/pilih-dokter/scaling-gigi', [FrontController::class, 'pilihDokter'])->name('pilih-dokter');
Route::get('/pilih-jadwal', [FrontController::class, 'pilihJadwal'])->name('pilih-jadwal');

// LAYANAN
Route::get('/layanan', [FrontController::class, 'layanan'])->name('daftar-layanan');

Route::get('/promo', [FrontController::class, 'promo'])->name('promo');
Route::get('/promo/{slug}', [FrontController::class, 'promoDetail'])->name('promo');
Route::get('/register/promo/{slug}', [FrontController::class, 'regpromo'])->name('promo-register');
Route::get('/register/{slug}/{layanan}', [FrontController::class, 'pendaftaran'])->name('pendaftaran');
// Route::post('daftar-promo', [FrontController::class, 'promoDaftar'])->name('promo-daftar');
Route::get('/thanks', [FrontController::class, 'thanks'])->name('thanks');
Route::post('simpan-register/promo', [FrontController::class, 'promoDaftar'])->name('promo-daftar');
Route::post('simpan-register/layanan', [FrontController::class, 'layananDaftar'])->name('layanan-daftar');
Route::post('simpan-pesan', [FrontController::class, 'sendPesan'])->name('kirim-pesan');

Route::get('/misi-sosial', [FrontController::class, 'misiSosial'])->name('misi-sosial');
Route::get('/event', [FrontController::class, 'Event'])->name('event');
Route::get('/fasilitas', [FrontController::class, 'Fasilitas'])->name('fasilitas');

Route::get('/artikel', [FrontController::class, 'artikel'])->name('pilih-artikel');
Route::get('/read-artikel/{tipe}/{slug}', [FrontController::class, 'artikelRead'])->name('baca-artikel');
Route::get('/klinik-kami', [FrontController::class, 'kami'])->name('pilih-kami');
Route::get('/cabang', [FrontController::class, 'cabang'])->name('pilih-cabang');
Route::get('/cabang/{id}', [FrontController::class, 'cabangDetail'])->name('detail-cabang');
Route::get('/hubungi-kami', [FrontController::class, 'hubkami'])->name('pilih-kami');
Route::get('/email-register', [FrontController::class, 'sendRegister'])->name('kirim-registrasi');
// AJAX FRONT
Route::get('/summary-group', [FrontController::class, 'summaryTotal'])->name('group-summary');
Route::get('/get-blog', [FrontController::class, 'getBlog'])->name('get-blog');
Route::get('/get-blog', [FrontController::class, 'getBlog'])->name('get-blog');

// PENDAFTARAN PROMO
Route::get('/get-promo', [FrontController::class, 'getPromo'])->name('get-promo');
Route::get('/get-promo-all', [FrontController::class, 'allPromo'])->name('all-promo');
Route::get('/get-promo-klinik', [FrontController::class, 'klinikPromo'])->name('klinik-promo');
Route::get('/get-promo-tanggal', [FrontController::class, 'tanggalPromo'])->name('tanggal-promo');
Route::get('/get-promo-jam', [FrontController::class, 'jamPromo'])->name('jam-promo');
Route::get('/get-promo-register', [FrontController::class, 'formPromo'])->name('register-promo');
Route::get('/get-metode-bayar-promo', [FrontController::class, 'getMetodeBayarPromo'])->name('metode-bayar-promo');

// PENDAFTARAN REGULER
Route::get('/register/{slug}/{layanan}', [FrontController::class, 'pendaftaran'])->name('pendaftaran');
Route::get('/get-reg-klinik', [FrontController::class, 'klinikLayanan'])->name('klinik-layanan');
Route::get('/get-reg-layanan', [FrontController::class, 'listLayanan'])->name('klinik-layanan');
Route::get('/get-reg-tanggal', [FrontController::class, 'tanggalLayanan'])->name('tanggal-layanan');
Route::get('/get-reg-jam', [FrontController::class, 'jamLayanan'])->name('jam-layanan');
Route::get('/get-layanan-register', [FrontController::class, 'formLayanan'])->name('register-layanan');
Route::get('/get-metode-bayar-layanan', [FrontController::class, 'getMetodeBayarLayanan'])->name('metode-bayar-layanan');


Route::get('/all-blog', [FrontController::class, 'allBlog'])->name('get-blog');
Route::get('/recent-blog', [FrontController::class, 'recentBlog'])->name('get-blog');
Route::get('/press-release', [FrontController::class, 'pressRelease'])->name('press-release');

Route::get('/all-misol', [FrontController::class, 'allMisol'])->name('get-misol');
Route::get('/recent-misol', [FrontController::class, 'recentMisol'])->name('get-misol');
Route::get('/all-event', [FrontController::class, 'allEvent'])->name('get-event');
Route::get('/recent-event', [FrontController::class, 'recentEvent'])->name('get-event');

// Route::get('/get-vendor', [FrontController::class, 'getVendor'])->name('get-vendor');

// HALAMAN ADMIN WEBSITE
Route::get('/web-admin', [LoginController::class, 'showLoginForm'])->name('web-admin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::middleware('auth')->group(function () {
Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', [DashboardController::class, 'home'])->name('home');
    Route::post('/pilih-kota', [DashboardController::class, 'pilihKota'])->name('list-klinik');
    
    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
    ], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('home');
        Route::post('/promo', [DashboardController::class, 'promoRekap'])->name('promo-datatable');
        Route::post('/layanan', [DashboardController::class, 'layananRekap'])->name('layanan-datatable');
    });

    /* Route untuk global global */
    Route::group([
        'prefix' => 'master',
        'as' => 'master.',
    ], function () {
        Route::group([
            'prefix' => 'section',
            'as' => 'section.',
        ], function () {
            Route::get('/', [SectionController::class, 'indexMaster'])->name('section-index');
            Route::post('/simpan', [SectionController::class, 'storeMaster'])->name('section-store');
            Route::post('/edit', [SectionController::class, 'editMaster'])->name('section-edit');
            Route::post('/ubah', [SectionController::class, 'ubahMaster'])->name('section-ubah');
            Route::post('/datatable', [SectionController::class, 'datatableMaster'])->name('section-datatable');
            Route::post('/destroy', [SectionController::class, 'destroyMaster'])->name('section-destroy');
        });

        Route::group([
            'prefix' => 'menu',
            'as' => 'menu.',
        ], function () {
            Route::get('/', [MenuController::class, 'index'])->name('menu-index');
            Route::post('/simpan', [MenuController::class, 'store'])->name('menu-store');
            Route::post('/edit', [MenuController::class, 'edit'])->name('menu-edit');
            Route::post('/ubah', [MenuController::class, 'ubah'])->name('menu-ubah');
            Route::post('/datatable', [MenuController::class, 'datatable'])->name('menu-datatable');
            Route::post('/destroy', [MenuController::class, 'destroy'])->name('menu-destroy');
        });

        Route::group([
            'prefix' => 'role',
            'as' => 'role.',
        ], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('update');
            Route::post('/destroy', [RoleController::class, 'destroy'])->name('destroy');
            Route::post('/datatable', [RoleController::class, 'datatable'])->name('datatable');
        });

        Route::group([
            'prefix' => 'user',
            'as' => 'user.',
        ], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('user-store');
            Route::post('/edit', [UserController::class, 'edit'])->name('user-edit');
            Route::post('/ubah', [UserController::class, 'ubah'])->name('user-ubah');
            Route::post('/datatable', [UserController::class, 'datatable'])->name('user-datatable');
            Route::post('/destroy', [UserController::class, 'destroy'])->name('user-destroy');
        });

        Route::group([
            'prefix' => 'pegawai',
            'as' => 'pegawai.',
        ], function () {
            Route::get('/', [pegawaiController::class, 'index'])->name('index');
            Route::post('/datatable', [pegawaiController::class, 'datatable'])->name('datatable');
            // Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [pegawaiController::class, 'store'])->name('store');
            Route::post('/edit', [pegawaiController::class, 'edit'])->name('edit');
            Route::post('/ubah', [pegawaiController::class, 'ubah'])->name('store');
            Route::post('/destroy', [pegawaiController::class, 'destroy'])->name('destroy');
            Route::post('/klinik', [pegawaiController::class, 'klinik'])->name('klinik');
            Route::post('/mapping-klinik', [pegawaiController::class, 'saveklinik'])->name('mapping-klinik');
            
        });

        Route::group([
            'prefix' => 'jabatan',
            'as' => 'jabatan.',
        ], function () {
            Route::post('/', [pegawaiController::class, 'jabatan'])->name('index');
            Route::post('/store', [pegawaiController::class, 'storeJabatan'])->name('store');
            Route::post('/destroy', [pegawaiController::class, 'destroyJabatan'])->name('menu-destroy');
            Route::post('/edit', [pegawaiController::class, 'editJabatan'])->name('store');
            Route::post('/ubah', [pegawaiController::class, 'ubahJabatan'])->name('store');
        });

        Route::group([
            'prefix' => 'layanan',
            'as' => 'layanan.',
        ], function () {
            Route::get('/', [LayananController::class, 'index'])->name('index');
            Route::post('/datatable', [LayananController::class, 'datatable'])->name('datatable');
            Route::post('/store', [LayananController::class, 'store'])->name('store');
            Route::post('/edit', [LayananController::class, 'edit'])->name('edit');
            Route::post('/ubah', [LayananController::class, 'ubah'])->name('store');
            Route::post('/destroy', [LayananController::class, 'destroy'])->name('destroy');

            Route::post('/aktif', [LayananController::class, 'aktif'])->name('aktif-klinik');
            Route::post('/tidak-aktif', [LayananController::class, 'tidakaktif'])->name('aktif-klinik');
            
            Route::post('/klinik', [LayananController::class, 'klinik'])->name('klinik');
            Route::post('/mapping-klinik', [LayananController::class, 'saveklinik'])->name('mapping-klinik');

            Route::post('/dokter', [LayananController::class, 'dokter'])->name('dokter');
            Route::post('/mapping-dokter', [LayananController::class, 'savedokter'])->name('mapping-dokter');

            Route::get('/select-layanan', [LayananController::class, 'selectLayanan'])->name('select-layanan');
            Route::get('/select-layanan-corporate', [LayananController::class, 'selectLayananCorp'])->name('select-layanan-corp');
            Route::post('/metode-bayar', [LayananController::class, 'metodeBayar'])->name('klinik');
            Route::post('/tambah-metode-bayar', [LayananController::class, 'tambahmetodeBayar'])->name('klinik');
            Route::post('/destroyMetode', [LayananController::class, 'destroyMetode'])->name('destroy-metode');
        });

        Route::group([
            'prefix' => 'perusahaan',
            'as' => 'perusahaan.',
        ], function () {
            Route::post('/', [pegawaiController::class, 'jabatan'])->name('index');
            Route::post('/store', [pegawaiController::class, 'storeJabatan'])->name('store');
            Route::post('/destroy', [pegawaiController::class, 'destroyJabatan'])->name('menu-destroy');
            Route::post('/edit', [pegawaiController::class, 'editJabatan'])->name('store');
            Route::post('/ubah', [pegawaiController::class, 'ubahJabatan'])->name('store');
        });

    });

    Route::group([
        'prefix' => 'data-registrasi',
        'as' => 'data-registrasi.',
    ], function () {
        Route::get('/', [RegisterController::class, 'index'])->name('index');
        Route::post('/datatable', [RegisterController::class, 'datatable'])->name('store');
        Route::post('/terima', [RegisterController::class, 'Terima'])->name('approve');
        Route::post('/tolak', [RegisterController::class, 'Tolak'])->name('cancel');
        Route::post('/hapus', [RegisterController::class, 'Hapus'])->name('destroy');
        Route::post('/reschedule', [RegisterController::class, 'Reschedule'])->name('rejadwal');
        Route::post('/simpan-reschedule', [RegisterController::class, 'SimpanReschedule'])->name('save-rejadwal');
    });

    Route::group([
        'prefix' => 'pembayaran',
        'as' => 'pembayaran.',
    ], function () {
        Route::get('/', [PembayaranController::class, 'index'])->name('index');
        Route::post('/datatable', [PembayaranController::class, 'datatable'])->name('store');
        Route::post('/terima', [PembayaranController::class, 'Terima'])->name('approve');
        Route::post('/tolak', [PembayaranController::class, 'Tolak'])->name('cancel');
        Route::post('/bukti-bayar', [PembayaranController::class, 'BuktiBayar'])->name('view-bukti');
        // Route::post('/hapus', [RegisterController::class, 'Hapus'])->name('destroy');
    });

    Route::group([
        'prefix' => 'promo-master',
        'as' => 'promo-master.',
    ], function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
        Route::post('/datatable', [PromoController::class, 'datatable'])->name('datatable');
        Route::post('/store', [PromoController::class, 'store'])->name('store');
        Route::post('/edit', [PromoController::class, 'edit'])->name('edit');
        Route::post('/ubah', [PromoController::class, 'ubah'])->name('store');
        Route::post('/destroy', [PromoController::class, 'destroy'])->name('destroy');

        Route::post('/aktif', [PromoController::class, 'aktif'])->name('aktif-klinik');
        Route::post('/tidak-aktif', [PromoController::class, 'tidakaktif'])->name('aktif-klinik');
        
        Route::post('/klinik', [PromoController::class, 'klinik'])->name('klinik');
        Route::post('/mapping-klinik', [PromoController::class, 'saveklinik'])->name('mapping-klinik');
        Route::post('/metode-bayar', [PromoController::class, 'metodeBayar'])->name('klinik');
        Route::post('/tambah-metode-bayar', [PromoController::class, 'tambahmetodeBayar'])->name('klinik');
        Route::post('/destroyMetode', [PromoController::class, 'destroyMetode'])->name('destroy-metode');

        Route::get('/select-promo', [PromoController::class, 'selectPromo'])->name('select-promo');
        // Route::post('/dokter', [LayananController::class, 'dokter'])->name('dokter');
        // Route::post('/mapping-dokter', [LayananController::class, 'savedokter'])->name('mapping-dokter');
    });

    Route::group([
        'prefix' => 'klinik',
        'as' => 'klinik.',
    ], function () {
        Route::get('/', [KlinikController::class, 'index'])->name('index');
        Route::post('/list', [KlinikController::class, 'list'])->name('list-klinik');
        Route::post('/pilih-kota', [KlinikController::class, 'pilihKota'])->name('list-klinik');
        Route::post('/simpan', [KlinikController::class, 'store'])->name('simpan-klinik');
        Route::post('/edit', [KlinikController::class, 'edit'])->name('klinik-edit');
        Route::post('/ubah', [KlinikController::class, 'ubah'])->name('klinik-ubah');
        Route::post('/destroy', [KlinikController::class, 'destroy'])->name('klinik-destroy');

        Route::post('/jam-operasional', [KlinikController::class, 'jamOperasi'])->name('jam-klinik');
        Route::post('/tambah-jam', [KlinikController::class, 'tambahJam'])->name('jam-tambah');
        Route::post('/destroy-jam', [KlinikController::class, 'destroyJam'])->name('klinik-destroy-jam');

        Route::post('/dokter', [KlinikController::class, 'dokter'])->name('dokter');
        Route::get('/jadwal-dokter/{id_pegawai}/{id_dokter}', [KlinikController::class, 'JadwalDokter'])->name('jadwal-klinik');
        Route::post('/jadwal/dokter', [KlinikController::class, 'JadwalData'])->name('jadwal-dokter');
        Route::post('/jadwal/store', [KlinikController::class, 'JadwalStore'])->name('jadwal-simpan');
        Route::post('/jadwal/edit', [KlinikController::class, 'JadwalEdit'])->name('jadwal-edit');
        Route::post('/jadwal/ubah', [KlinikController::class, 'JadwalUbah'])->name('jadwal-ubah');
        Route::post('/jadwal/hapus', [KlinikController::class, 'JadwalHapus'])->name('jadwal-hapus');

        Route::post('/galeri', [KlinikController::class, 'galeri'])->name('galeri');
        Route::post('/simpan-galeri', [KlinikController::class, 'SimpanGaleri'])->name('simpan-galeri');
        Route::post('/destroy-galeri', [KlinikController::class, 'destroyGaleri'])->name('klinik-destroy-galeri');


        Route::post('/layanan', [KlinikController::class, 'layanan'])->name('layanan');

        Route::post('/aktif', [KlinikController::class, 'aktif'])->name('aktif-klinik');
        Route::post('/tidak-aktif', [KlinikController::class, 'tidakaktif'])->name('aktif-klinik');

        Route::get('/detail-layanan/{klinik}', [KlinikController::class, 'detailLayanan'])->name('detail-layanan');
        Route::post('/detail/data-layanan', [KlinikController::class, 'tabelLayanan'])->name('tabel-layanan');
    });

    Route::group([
        'prefix' => 'website',
        'as' => 'website.',
    ], function () {
        Route::group([
            'prefix' => 'section',
            'as' => 'section.',
        ], function () {
            Route::get('/', [SectionController::class, 'index'])->name('index');
            Route::post('/datatable', [SectionController::class, 'datatable'])->name('datatable');
            Route::post('/store', [SectionController::class, 'store'])->name('store');
            Route::post('/edit', [SectionController::class, 'edit'])->name('edit');
            Route::post('/destroy', [SectionController::class, 'destroy'])->name('destroy');
            Route::post('/ubah', [SectionController::class, 'ubah'])->name('edit');
        });

        Route::group([
            'prefix' => 'artikel',
            'as' => 'artikel.',
        ], function () {
            Route::get('/{kategori}', [ArtikelController::class, 'index'])->name('index');
            Route::get('/create/{kategori}', [ArtikelController::class, 'create'])->name('create');
            Route::post('/datatable', [ArtikelController::class, 'datatable'])->name('datatable');
            Route::post('/store', [ArtikelController::class, 'store'])->name('store');
            Route::post('/destroy', [ArtikelController::class, 'destroy'])->name('destroy');

            Route::post('/aktif', [ArtikelController::class, 'aktif'])->name('artikel-klinik');
            Route::post('/tidak-aktif', [ArtikelController::class, 'tidakaktif'])->name('artikel-klinik');
            Route::get('/edit/{slug}', [ArtikelController::class, 'edit'])->name('edit');
            Route::post('/ubah', [ArtikelController::class, 'ubah'])->name('edit');
        });
    });

});

// HALAMAN MEMBER AREA
// Route::get('/member-area', [LoginController::class, 'showLoginMember'])->name('member-area');
Route::post('/login-member', [LoginController::class, 'loginMember'])->name('login-member');
Route::post('/logout-member', [LoginController::class, 'logoutMember'])->name('logout-member');

Route::group([
    'prefix' => 'member-area',
    'as' => 'member-area.',
], function () {
    Route::get('/', [LoginController::class, 'showLoginMember'])->name('member-area');
    Route::get('/forget-password', [LoginController::class, 'cekEmail'])->name('cek-email');
    Route::post('/cari-email', [LoginController::class, 'cariEmail'])->name('cari-email');
    Route::get('/reset-password/{email}', [FrontController::class, 'ResetPassword'])->name('reset-password-email');
    Route::post('/simpan-password', [FrontController::class, 'simpanPass'])->name('simpan-pass');
});

Route::group(['middleware' => 'member'], function () {
    Route::get('/home-member', [MemberController::class, 'dashboard'])->name('home-member');
    Route::get('/last-register', [MemberController::class, 'lastRegis'])->name('last-register');
    Route::get('/last-pay', [MemberController::class, 'lastPay'])->name('last-pembayaran');
    Route::get('/bayar', [MemberController::class, 'Bayar'])->name('last-bayar');
    Route::post('/konfirmasi-pembayaran', [MemberController::class, 'konfirBayar'])->name('konfirmasi-bayar');
});


// HALAMAN CORPORATE AREA
// Route::get('/member-area', [LoginController::class, 'showLoginMember'])->name('member-area');
Route::post('/login-corporate', [LoginController::class, 'loginCorporate'])->name('login-corporate');
Route::post('/logout-corporate', [LoginController::class, 'logoutCorporate'])->name('logout-corporate');

Route::group([
    'prefix' => 'corporate-area',
    'as' => 'corporate-area.',
], function () {
    Route::get('/', [LoginController::class, 'showLoginCorporate'])->name('corporate-area');
    Route::get('/forget-password', [LoginController::class, 'cekEmail'])->name('cek-email');
    Route::post('/cari-email', [LoginController::class, 'cariEmail'])->name('cari-email');
    Route::get('/reset-password/{email}', [FrontController::class, 'ResetPassword'])->name('reset-password-email');
    Route::post('/simpan-password', [FrontController::class, 'simpanPass'])->name('simpan-pass');
});

Route::group(['middleware' => 'corporate'], function () {
    Route::get('/home-corporate', [CorporateController::class, 'dashboard'])->name('home-corporate');
    Route::get('/layanan-corporate', [CorporateController::class, 'Layanan'])->name('layanan-corporate');
    Route::get('/last-register', [CorporateController::class, 'lastRegis'])->name('last-register');
    Route::get('/last-pay', [CorporateController::class, 'lastPay'])->name('last-pembayaran');
    Route::get('/bayar', [CorporateController::class, 'Bayar'])->name('last-bayar');
    Route::post('/konfirmasi-pembayaran', [CorporateController::class, 'konfirBayar'])->name('konfirmasi-bayar');

    Route::group([
        'prefix' => 'corporate',
        'as' => 'corporate.',
    ], function () {
        Route::get('/daftar-pegawai', [CorporateController::class, 'pegawai'])->name('corporate-pegawai');
        Route::post('/list-pegawai', [CorporateController::class, 'pegawaidatatable'])->name('list-datatable');
        Route::post('/store-pegawai', [CorporateController::class, 'pegawaistore'])->name('store');
        Route::post('/edit-pegawai', [CorporateController::class, 'pegawaiedit'])->name('edit');
        Route::post('/ubah-pegawai', [CorporateController::class, 'pegawaiubah'])->name('store');
        Route::post('/destroy-pegawai', [CorporateController::class, 'pegawaidestroy'])->name('destroy');

        // Pendaftaran Pasien
        Route::get('/register/{slug}/{layanan}', [CorporateController::class, 'pendaftaran'])->name('pendaftaran');
        Route::get('/get-reg-klinik', [CorporateController::class, 'klinikLayanan'])->name('klinik-layanan');
        Route::get('/get-reg-layanan', [CorporateController::class, 'listLayanan'])->name('klinik-layanan');
        Route::get('/get-reg-tanggal', [CorporateController::class, 'tanggalLayanan'])->name('tanggal-layanan');
        Route::get('/get-reg-jam', [CorporateController::class, 'jamLayanan'])->name('jam-layanan');
        Route::get('/get-layanan-register', [CorporateController::class, 'formLayanan'])->name('register-layanan');
        Route::get('/get-metode-bayar-layanan', [CorporateController::class, 'getMetodeBayarLayanan'])->name('metode-bayar-layanan');
        Route::post('simpan-register/layanan', [CorporateController::class, 'layananDaftar'])->name('layanan-daftar');
        Route::get('/thanks', [CorporateController::class, 'thanks'])->name('thanks');
    });
    
});

