<?php

use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\KontrakKerjaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\pengadaantahap1\BOQController;

use App\Http\Controllers\pengadaantahap1\HPSController;
use App\Http\Controllers\pengadaantahap1\RKSController;
use App\Http\Controllers\pengadaantahap1\UndanganController;
use App\Http\Controllers\pengadaantahap2\BANegoController;
use App\Http\Controllers\pengadaantahap2\CoverController;
use App\Http\Controllers\pengadaantahap2\LampNegoController;
use App\Http\Controllers\pengadaantahap2\LspkController;
use App\Http\Controllers\pengadaantahap2\SampulController;
use App\Http\Controllers\pengadaantahap2\SPKBJController;
use App\Http\Controllers\SubKontrak\BarJasController;
use App\Http\Controllers\SubKontrak\SubBarJasController;
use App\Http\Controllers\SubKontrak\SubKontrakController;
use App\Http\Controllers\SuratVendor\DataPengalamanController;
use App\Http\Controllers\SuratVendor\FormPenawaranHargaController;
use App\Http\Controllers\SuratVendor\LampiranPenawaranHargaController;
use App\Http\Controllers\SuratVendor\NeracaController;
use App\Http\Controllers\SuratVendor\PaktavendorController;
use App\Http\Controllers\SuratVendor\PernyataanGaransiController;
use App\Http\Controllers\SuratVendor\PernyataanKesanggupanController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorKelengkapanDokumenController;
use App\Http\Controllers\VendorKontrakKerjaController;
use App\Http\Controllers\VendorTandaTangan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
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

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', 'LoginController@dashboard')->name('dashboard');
// });

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [LoginController::class, 'login'])->name('authenticate');
// Vendor Registrasi
Route::get('/registrasi-vendor', [LoginController::class, 'registrasiVendor'])->name('registrasi.vendor');
Route::post('/simpan-vendor', [LoginController::class, 'simpanVendor'])->name('simpan.vendor');


Route::middleware('auth')->group(function () {

    Route::post('/{id}/{status}/{routeName}/changeStatus', [KontrakKerjaController::class, 'changeStatus'])->name('changestatus');
    Route::get('/usersetting', [LoginController::class, 'usersetting'])->name('usrsetting');
    Route::post('/gantipassword', [LoginController::class, 'gantipass'])->name('gantipass');
    Route::post('/ubahuser', [LoginController::class, 'ubahuser'])->name('ubahuser');
    Route::post('/ubahtandatangan', [LoginController::class, 'ubahanTandaTangan'])->name('ubahtandatangan');


    // Dokumen Vendor dan Pengadaan 

    Route::prefix('und')->group(function () {
        Route::get('undangan/{id}/{isDownload}', [UndanganController::class, 'Undangan'])->name('pengajuankontrak.undangan');
        Route::get('tandatangan/{id}/{jenis}', [UndanganController::class, 'tandatangan'])->name('undangan.tandatangan');
    });
    Route::prefix('rks')->group(function () {
        Route::get('show/{id}/{isDownload}', [RKSController::class, 'showrks'])->name('pengajuankontrak.rks');
        Route::get('isi/{id}', [RKSController::class, 'isirks'])->name('rks.isi');

        Route::put('update/{id}', [RKSController::class, 'updaterks'])->name('rks.update');
        Route::get('tandatangan/{id}/{jenis}', [RKSController::class, 'tandatangan'])->name('rks.tandatangan');
    });
    Route::prefix('boq')->group(function () {
        Route::get('{id}/{isDownload}/detail', [BOQController::class, 'detail'])->name('pengajuankontrak.boq.detail');
        Route::get('{id}/isi', [BOQController::class, 'isi'])->name('pengajuankontrak.boq.isi');
        Route::put('update/{id}', [BOQController::class, 'update'])->name('pengajuankontrak.boq.update');
        Route::get('tandatanganvendor/{id}', [BOQController::class, 'tandatanganvendor'])->name('boqtandatanganvendor');
        Route::post('simpantandatangan', [BOQController::class, 'simpantandatangan'])->name('simpantandatanganboq');

        // Route::get('{id}/boq', [BOQController::class, 'index'])->name('pengajuankontrak.boq');
        // Route::post('{id}/boq/create', [BOQController::class, 'store'])->name('pengajuankontrak.boq.create');
    });

    Route::prefix('hps')->group(function () {
        Route::get('{id}/{isDownload}/detail', [HPSController::class, 'detail'])->name('pengajuankontrak.hps.detail');
        Route::get('isi/{id}', [HPSController::class, 'isi'])->name('pengajuankontrak.hps.isi');
        Route::put('update/{id}', [HPSController::class, 'update'])->name('pengajuankontrak.hps.update');
        Route::get('/hpstandatangan/{id}/{jenis}', [HPSController::class, 'tandatangan'])->name('hps.tandatangan');
        // Route::get('/hpstandatanganmanager/{id}', [HPSController::class, 'tandatanganmanager'])->name('hpstandatanganmanager');
        // Route::post('/simpantandatangan', [HPSController::class, 'simpantandatangan'])->name('simpantandatanganhps');
    });


    // Route::prefix('formpenawaran')->group(function () {
    //     Route::get('/', [FormpenawaranController::class, 'index'])->name('formpenawaran.index');
    //     Route::get('/create', [FormpenawaranController::class, 'create'])->name('formpenawaran.create');
    //     Route::post('/store', [FormpenawaranController::class, 'store'])->name('formpenawaran.store');
    //     Route::get('/edit/{id}', [FormpenawaranController::class, 'edit'])->name('formpenawaran.edit');
    //     Route::put('/update/{id}', [FormpenawaranController::class, 'update'])->name('formpenawaran.update');
    //     Route::delete('/destroy/{id}', [FormpenawaranController::class, 'destroy'])->name('formpenawaran.destroy');
    // });


    Route::prefix('banego')->group(function () {

        // Route::get('/', [BANegoController::class, 'index'])->name('banego.index');
        // Route::get('/create', [BANegoController::class, 'create'])->name('banego.create');
        // Route::post('/', [BANegoController::class, 'store'])->name('banego.store');
        Route::get('/{id}/{isDownload}', [BANegoController::class, 'show'])->name('banego.show');
        // Route::get('/{id}/edit', [BANegoController::class, 'edit'])->name('banego.edit');
        // Route::put('/{id}', [BANegoController::class, 'update'])->name('banego.update');
        // Route::delete('/{id}', [BANegoController::class, 'destroy'])->name('banego.destroy');
    });


    // Routing untuk CoverController
    Route::prefix('cover')->group(function () {
        // Route::get('/', [CoverController::class, 'index'])->name('cover.index');
        // Route::get('/create', [CoverController::class, 'create'])->name('cover.create');
        // Route::post('/', [CoverController::class, 'store'])->name('cover.store');
        Route::get('/{id}/{isDownload}', [CoverController::class, 'show'])->name('cover.show');
        // Route::get('/{id}/edit', [CoverController::class, 'edit'])->name('cover.edit');
        // Route::put('/{id}', [CoverController::class, 'update'])->name('cover.update');
        // Route::delete('/{id}', [CoverController::class, 'destroy'])->name('cover.destroy');
    });

    // Routing untuk LampNegoController
    Route::prefix('lampnego')->group(function () {
        // Route::get('/', [LampNegoController::class, 'index'])->name('lampnego.index');
        Route::get('/create/{id}', [LampNegoController::class, 'create'])->name('lampnego.create');
        // Route::post('/', [LampNegoController::class, 'store'])->name('lampnego.store');
        Route::get('/{id}/{isDownload}', [LampNegoController::class, 'show'])->name('lampnego.show');
        // Route::get('/{id}/edit', [LampNegoController::class, 'edit'])->name('lampnego.edit');
        Route::put('/update/{id}', [LampNegoController::class, 'update'])->name('lampnego.update');
        // Route::delete('/{id}', [LampNegoController::class, 'destroy'])->name('lampnego.destroy');
    });

    // Routing untuk SampulController
    Route::prefix('sampul')->group(function () {
        // Route::get('/', [SampulController::class, 'index'])->name('sampul.index');
        // Route::get('/create', [SampulController::class, 'create'])->name('sampul.create');
        // Route::post('/', [SampulController::class, 'store'])->name('sampul.store');
        Route::get('/{id}/{isDownload}', [SampulController::class, 'show'])->name('sampul.show');
        // Route::get('/{id}/edit', [SampulController::class, 'edit'])->name('sampul.edit');
        // Route::put('/{id}', [SampulController::class, 'update'])->name('sampul.update');
        // Route::delete('/{id}', [SampulController::class, 'destroy'])->name('sampul.destroy');
    });

    // Routing untuk SPKBJController
    Route::prefix('spkbj')->group(function () {
        // Route::get('/', [SPKBJController::class, 'index'])->name('spkbj.index');
        // Route::get('/create', [SPKBJController::class, 'create'])->name('spkbj.create');
        // Route::post('/', [SPKBJController::class, 'store'])->name('spkbj.store');
        Route::get('/{id}/{isDownload}', [SPKBJController::class, 'show'])->name('spkbj.show');
        // Route::get('/{id}/edit', [SPKBJController::class, 'edit'])->name('spkbj.edit');
        // Route::put('/{id}', [SPKBJController::class, 'update'])->name('spkbj.update');
        // Route::delete('/{id}', [SPKBJController::class, 'destroy'])->name('spkbj.destroy');
    });
    // Routing untuk SPKBJController

    Route::prefix('lspk')->group(function () {

        // Route::get('/', [LspkController::class, 'index'])->name('lspk.index');
        // Route::get('/create', [LspkController::class, 'create'])->name('lspk.create');
        // Route::post('/', [LspkController::class, 'store'])->name('lspk.store');
        Route::get('/{id}/{isDownload}', [LspkController::class, 'show'])->name('lspk.show');
        // Route::get('/{id}/edit', [LspkController::class, 'edit'])->name('lspk.edit');
        // Route::put('/{id}', [LspkController::class, 'update'])->name('lspk.update');
        // Route::delete('/{id}', [LspkController::class, 'destroy'])->name('lspk.destroy');

    });



































    // User 
    // Route untuk index page
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('users');
        // Route untuk halaman create user
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        // Route untuk menyimpan data user baru dari halaman create user
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        // Route untuk halaman edit user
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route untuk menyimpan data user yang telah diedit dari halaman edit user
        Route::post('/{id}/update', [UserController::class, 'update'])->name('users.update');
        // Route untuk menghapus data user berdasarkan ID
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    });


    // Vendor 
    // Route untuk index page
    Route::prefix('vendor')->group(function () {
        Route::get('/', [VendorController::class, 'show'])->name('vendor');
        // Route untuk halaman create user

        Route::get('/create', [VendorController::class, 'create'])->name('vendor.create');
        // Route untuk menyimpan data user baru dari halaman create user
        Route::post('/store', [VendorController::class, 'store'])->name('vendor.store');
        // Route untuk halaman edit user
        Route::get('/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
        // Route untuk menyimpan data user yang telah diedit dari halaman edit user
        Route::post('/{id}/update', [VendorController::class, 'update'])->name('vendor.update');
        // Route untuk menghapus data user berdasarkan ID
        Route::delete('/{id}/destroy', [VendorController::class, 'destroy'])->name('vendor.destroy');

        // Route untuk halaman kelengkapan dokumen
        Route::get('/{idvendor}/kelengkapandokumen', [VendorKelengkapanDokumenController::class, 'kelengkapandokumeninternal'])->name('vendor.kelengkapandokumen');
        Route::prefix('kelengkapan_dokumen')->group(function () {
            Route::get('/pdf/{id}/{jenis}', [VendorKelengkapanDokumenController::class, 'pdf'])->name('vendor.kelengkapan-dokumen.pdf');

            // Route untuk menyimpan data user baru dari halaman create user
            Route::post('/store/{id}/{id_kontrakkerja}', [VendorKelengkapanDokumenController::class, 'store'])->name('vendor.kelengkapandok.store');
            // Route untuk menyimpan data user yang telah diedit dari halaman edit user
            Route::put('/update/{id}/{id_kontrakkerja}', [VendorKelengkapanDokumenController::class, 'update'])->name('vendor.kelengkapandok.update');
            // Route untuk menghapus data user berdasarkan ID
            Route::delete('/destroy/{id}/{id_kontrakkerja}', [VendorKelengkapanDokumenController::class, 'destroy'])->name('vendor.kelengkapandok.destroy');
        });
    });

    // Pegawai 
    // Route untuk index page
    Route::prefix('pegawai')->group(function () {
        Route::get('/', [PegawaiController::class, 'index'])->name('pegawai');
        // Route untuk halaman create user
        Route::get('/create', [PegawaiController::class, 'create'])->name('pegawai.create');



        // Route untuk menyimpan data user baru dari halaman create user
        Route::post('/store', [PegawaiController::class, 'store'])->name('pegawai.store');

        // Route untuk halaman edit user
        Route::get('/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        // Route untuk menyimpan data user yang telah diedit dari halaman edit user
        Route::post('/{id}/update', [PegawaiController::class, 'update'])->name('pegawai.update');
        // Route untuk menghapus data user berdasarkan ID
        Route::delete('/{id}/destroy', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    });



    // Jenis Dokumen 
    // Route untuk index page
    Route::prefix('jenisdokumen')->group(function () {
        Route::get('/', [JenisDokumenController::class, 'index'])->name('jenisdokumen');
        // Route untuk halaman create user
        Route::get('/create', [JenisDokumenController::class, 'create'])->name('jenisdokumen.create');
        // Route untuk menyimpan data user baru dari halaman create user
        Route::post('/store', [JenisDokumenController::class, 'store'])->name('jenisdokumen.store');
        // Route untuk halaman edit user
        Route::get('/{id}/edit', [JenisDokumenController::class, 'edit'])->name('jenisdokumen.edit');
        // Route untuk menyimpan data user yang telah diedit dari halaman edit user
        Route::post('/{id}/update', [JenisDokumenController::class, 'update'])->name('jenisdokumen.update');
        // Route untuk menghapus data user berdasarkan ID
        Route::delete('/{id}/destroy', [JenisDokumenController::class, 'destroy'])->name('jenisdokumen.destroy');
    });



    // Bagian Pengadaan
    Route::prefix('pengadaan')->middleware( 'role:pengadaan')->group(function () {

        Route::get('/dashboard', [LoginController::class, 'dashboardpln'])->name('dashboard.pengadaan');

        Route::prefix('kontrakthp1')->group(function () {
            Route::get('/pengajuankontrak', [KontrakKerjaController::class, 'index'])->name('pengajuankontrak.index');
            // Route untuk upload file excel memudahkan pengguna
            Route::post('/kontrak/upload', [KontrakKerjaController::class, 'uploadFileExcel'])->name('kontrak.upload');
            // Route untuk download file template
            Route::get('/kontrak/download-template', [KontrakKerjaController::class, 'downloadTemplate'])->name('kontrak.downloadTemplate');

            // Route untuk halaman create user
            Route::get('/create', [KontrakKerjaController::class, 'create'])->name('pengajuankontrak.create');
            // Route untuk menyimpan data user baru dari halaman create user
            Route::post('/store', [KontrakKerjaController::class, 'store'])->name('pengajuankontrak.store');
            // Route untuk halaman edit user
            Route::get('/{id}/edit', [KontrakKerjaController::class, 'edit'])->name('pengajuankontrak.edit');
            // Route untuk menyimpan data user yang telah diedit dari halaman edit user
            Route::post('/{id}/update', [KontrakKerjaController::class, 'update'])->name('pengajuankontrak.update');
            // Route untuk menghapus data user berdasarkan ID
            Route::delete('/{id}/destroy', [KontrakKerjaController::class, 'destroy'])->name('pengajuankontrak.destroy');

            Route::get('/{id}/detail', [KontrakKerjaController::class, 'detailkontrak'])->name('pengajuankontrak.detail');



            Route::get('{id}/downloadall', [KontrakKerjaController::class, 'DownloadVendorDoc'])->name('pengajuankontrak.downloadvendor');
        });
        Route::prefix('/subkontrak')->group(function () {
            Route::get('show/{id_kontrakkerja}/{id_jenis}', [SubKontrakController::class, 'show'])->name('subkontrak.show');

            Route::prefix('barjas')->group(function () {
                // Rute untuk menampilkan form create
                Route::get('/create/{id_kontrakkerja}/{id_jenis_kontrak}', [BarJasController::class, 'create'])->name('barjas.create');

                // Rute untuk menyimpan data dari form create
                Route::post('/{id_kontrakkerja}', [BarjasController::class, 'store'])->name('barjas.store');

                // Rute untuk menampilkan data berdasarkan id
                Route::get('/show/{id}', [BarjasController::class, 'show'])->name('barjas.show');

                // Rute untuk menampilkan form edit
                Route::get('/{id}/edit', [BarjasController::class, 'edit'])->name('barjas.edit');

                // Rute untuk mengupdate data dari form edit
                Route::put('/{id}', [BarjasController::class, 'update'])->name('barjas.update');

                // Rute untuk menghapus data
                Route::delete('/{id}', [BarjasController::class, 'destroy'])->name('barjas.destroy');
            });
            Route::prefix('subbarjas')->group(function () {
                // Rute untuk menampilkan halaman tambah data
                Route::get('/create/{id_barjas}', [SubBarJasController::class, 'create'])->name('subbarjas.create');

                // Rute untuk menampilkan halaman edit data
                Route::get('/edit/{id}', [SubBarJasController::class, 'edit'])->name('subbarjas.edit');

                // Rute untuk menyimpan data
                Route::post('/', [SubBarJasController::class, 'store'])->name('subbarjas.store');

                // Rute untuk mengupdate data
                Route::put('/update/{id}', [SubBarJasController::class, 'update'])->name('subbarjas.update');

                // Rute untuk menghapus data
                Route::delete('/delete/{id}', [SubBarJasController::class, 'destroy'])->name('subbarjas.destroy');
            });
        });

        Route::prefix('kontrakthp2')->group(function () {
            Route::get('/negoharga', [KontrakKerjaController::class, 'negoharga'])->name('negoharga');
            Route::get('{id}/detail', [KontrakKerjaController::class, 'detailnego'])->name('negoharga.detail');
        });
        Route::prefix('tandatangan')->group(function () {
            Route::get('{id}/detail', [KontrakKerjaController::class, 'detailttd'])->name('tandatangan.detail');

            Route::get('/tandatangan', [KontrakKerjaController::class, 'tandatanganpengadaan'])->name('tandatangan.pengadaan');

            Route::post('/simpanttd', [KontrakKerjaController::class, 'simpanttd'])->name('tandatangan.pengadaan.simpanttd');
        });
    });


    // Bagian Manager
    Route::prefix('manager')->middleware('role:manager')->group(function () {

        Route::get('/dashboard', [LoginController::class, 'dashboardpln'])->name('dashboard.manager');

        Route::get('/kontrakkerja', [KontrakKerjaController::class, 'tandatanganmanager'])->name('tandatangan.manager');
        Route::get('{id}/detail', [KontrakKerjaController::class, 'detailkontrakmanager'])->name('tandatangan.manager.detail');



        Route::prefix('kelengkapandokumen')->group(function () {
            Route::get('/pdfviewer/{name}', [VendorKelengkapanDokumenController::class, 'pdfviewer'])->name('kelengkapandok.view');
            // Route untuk menyimpan data user baru dari halaman create user
            Route::post('/store', [VendorKelengkapanDokumenController::class, 'store'])->name('kelengkapandok.store');
            // Route untuk menyimpan data user yang telah diedit dari halaman edit user
            Route::put('/{id}/update', [VendorKelengkapanDokumenController::class, 'update'])->name('kelengkapandok.update');
            // Route untuk menghapus data user berdasarkan ID
            Route::delete('/{id}/destroy', [VendorKelengkapanDokumenController::class, 'destroy'])->name('kelengkapandok.destroy');
        });
    });



    // Bagian Vendor
    Route::prefix('vendor')->middleware( 'role:vendor')->group(function () {
        Route::get('/dashboard', [LoginController::class, 'dashboardvendor'])->name('dashboard.vendor');





        Route::prefix('dokumen')->group(function () {
            // Route untuk menampilkan daftar produk
            Route::get('/kelengkapandok', [VendorKelengkapanDokumenController::class, 'index'])->name('kelengkapandok');


            // Route untuk menampilkan form tambah produk
            
            Route::get('/pengisiankontrakkerja', [VendorKontrakKerjaController::class, 'pengisiankontrakkerja'])->name('isikontrak');
            // Route untuk menampilkan form tambah produk
            Route::get('kontrakkerjadetail/{id}', [VendorKontrakKerjaController::class, 'detail'])->name('vendor.kontrakkerja.detail');



            Route::get('/kontrakkerja', [VendorKontrakKerjaController::class, 'index'])->name('vendor.kontrakkerja');
            Route::get('/kontrakkerjadetailtandatangan/{id}', [VendorKontrakKerjaController::class, 'detailttd'])->name('vendor.kontrakkerja.detail.tandatangan');


            Route::get('/tandatangan', [VendorTandaTangan::class, 'index'])->name('tandatangan');
        });


        Route::prefix('form_penawaran')->group(function () {
            Route::get('formpenawaranharga/{id}/create', [FormPenawaranHargaController::class, 'create'])->name('vendor.formpenawaranharga.create');
            Route::post('formpenawaranharga/simpan/{id}', [FormPenawaranHargaController::class, 'store'])->name('vendor.formpenawaranharga.store');
            Route::get('formpenawaranharga/{id}/halamanttd', [FormPenawaranHargaController::class, 'halamanttd'])->name('vendor.formpenawaranharga.halamanttd');
            Route::post('formpenawaranharga/simpanttd', [FormPenawaranHargaController::class, 'simpanttd'])->name('vendor.formpenawaranharga.simpanttd');
            Route::get('formpenawaranharga/pdf/{id}/{jenis}', [FormPenawaranHargaController::class, 'pdf'])->name('vendor.formpenawaranharga.pdf');


            // Route::get('lampiranpenawaranharga/create/{id}', [LampiranPenawaranHargaController::class, 'create'])->name('vendor.lampiranpenawaranharga.create');
            Route::put('lampiranpenawaranharga/update/{id}', [LampiranPenawaranHargaController::class, 'update'])->name('vendor.lampiranpenawaranharga.update');
            Route::get('lampiranpenawaranharga/halamanttd/{id}', [LampiranPenawaranHargaController::class, 'halamanttd'])->name('vendor.lampiranpenawaranharga.halamanttd');
            Route::post('lampiranpenawaranharga/simpanttd/{id}', [LampiranPenawaranHargaController::class, 'simpanttd'])->name('vendor.lampiranpenawaranharga.simpanttd');
            Route::get('lampiranpenawaranharga/pdf/{id}/{jenis}', [LampiranPenawaranHargaController::class, 'pdf'])->name('vendor.lampiranpenawaranharga.pdf');

            Route::get('paktavendor/create/{id}', [PaktavendorController::class, 'create'])->name('vendor.paktavendor.create');
            Route::post('paktavendor/update/{id}', [PaktavendorController::class, 'update'])->name('vendor.paktavendor.update');
            Route::get('paktavendor/halamanttd/{id}', [PaktavendorController::class, 'halamanttd'])->name('vendor.paktavendor.halamanttd');
            Route::post('paktavendor/simpanttd/{id}', [PaktavendorController::class, 'simpanttd'])->name('vendor.paktavendor.simpanttd');
            Route::get('paktavendor/pdf/{id}/{jenis}', [PaktavendorController::class, 'pdf'])->name('vendor.paktavendor.pdf');

            Route::get('pernyataan_garansi/create/{id}', [PernyataanGaransiController::class, 'create'])->name('vendor.pernyataan.garansi.create');
            Route::post('pernyataan_garansi/update/{id}', [PernyataanGaransiController::class, 'update'])->name('vendor.pernyataan.garansi.update');
            Route::get('pernyataan_garansi/halamanttd/{id}', [PernyataanGaransiController::class, 'halamanttd'])->name('vendor.pernyataan.garansi.halamanttd');
            Route::post('pernyataan_garansi/simpanttd/{id}', [PernyataanGaransiController::class, 'simpanttd'])->name('vendor.pernyataan.garansi.simpanttd');
            Route::get('pernyataan_garansi/pdf/{id}/{jenis}', [PernyataanGaransiController::class, 'pdf'])->name('vendor.pernyataan.garansi.pdf');

            Route::get('pernyataan_sangup/create/{id}', [PernyataanKesanggupanController::class, 'create'])->name('vendor.pernyataan.sangup.create');
            Route::post('pernyataan_sangup/update/{id}', [PernyataanKesanggupanController::class, 'update'])->name('vendor.pernyataan.sangup.update');
            Route::get('pernyataan_sangup/halamanttd/{id}', [PernyataanKesanggupanController::class, 'halamanttd'])->name('vendor.pernyataan.sangup.halamanttd');
            Route::post('pernyataan_sangup/simpanttd/{id}', [PernyataanKesanggupanController::class, 'simpanttd'])->name('vendor.pernyataan.sangup.simpanttd');
            Route::get('pernyataan_sangup/pdf/{id}/{jenis}', [PernyataanKesanggupanController::class, 'pdf'])->name('vendor.pernyataan.sangup.pdf');


            Route::get('datapengalaman/{id}', [DataPengalamanController::class, 'index'])->name('vendor.datapengalaman.index');
            Route::get('datapengalaman/create/{id}', [DataPengalamanController::class, 'create'])->name('vendor.datapengalaman.create');
            Route::post('datapengalaman/store/{id}', [DataPengalamanController::class, 'store'])->name('vendor.datapengalaman.store');
            Route::get('datapengalaman/edit/{id}/{id_data}', [DataPengalamanController::class, 'edit'])->name('vendor.datapengalaman.edit');

            Route::put('datapengalaman/update/{id}/{id_data}', [DataPengalamanController::class, 'update'])->name('vendor.datapengalaman.update');
            Route::put('datapengalaman/updateDataPengalaman/{id}/{id_data}', [DataPengalamanController::class, 'updateDataPengalaman'])->name('vendor.datapengalaman.updateDatapengalaman');

            Route::delete('datapengalaman/hapus/{id}/{id_data}', [DataPengalamanController::class, 'destroy'])->name('vendor.datapengalaman.destroy');
            Route::get('datapengalaman/halamanttd/{id}', [DataPengalamanController::class, 'halamanttd'])->name('vendor.datapengalaman.halamanttd');
            Route::post('datapengalaman/simpanttd/{id}', [DataPengalamanController::class, 'simpanttd'])->name('vendor.datapengalaman.simpanttd');
            Route::get('datapengalaman/pdf/{id}/{jenis}', [DataPengalamanController::class, 'pdf'])->name('vendor.datapengalaman.pdf');

            Route::get('neraca/create/{id}', [NeracaController::class, 'create'])->name('vendor.neraca.create');
            Route::post('neraca/update/{id}', [NeracaController::class, 'update'])->name('vendor.neraca.update');
            Route::get('neraca/halamanttd/{id}', [NeracaController::class, 'halamanttd'])->name('vendor.neraca.halamanttd');
            Route::post('neraca/simpanttd/{id}', [NeracaController::class, 'simpanttd'])->name('vendor.neraca.simpanttd');
            Route::get('neraca/pdf/{id}/{jenis}', [NeracaController::class, 'pdf'])->name('vendor.neraca.pdf');
        });
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
