<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pplController;
use App\Http\Controllers\desaController;
use App\Http\Controllers\petaniController;
use App\Http\Controllers\panenController;
use App\Http\Controllers\ujiController;
use App\Http\Controllers\performanceController;
use App\Http\Controllers\prediksiController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\loginController;
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


Route::get('/login',[loginController::class,'login'])->name('login');
Route::get('/register',[loginController::class,'register'])->name('register');
Route::post('/simpan',[loginController::class,'simpan'])->name('simpan');
Route::post('/post-login',[loginController::class,'postLogin'])->name('Post-Login');
Route::get('/logout',[loginController::class,'logout']);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return app()->call('App\Http\Controllers\loginController@jumlah');
        } elseif ($user->role === 'user') {
            return view('user');
        } else {
            return redirect('login')->with('error', 'Unexpected user role');
        }
    });
});
   
Route::group(['middleware'=>['auth','cekrole:admin']], function(){ 

//petani
Route::get('/data-petani',[petaniController::class,'petani']);
Route::get('/tambah-data-petani',[petaniController::class,'Tambahpetani']);
Route::post('/simpan-data-petani',[petaniController::class,'Simpanpetani']);
Route::get('/edit-data-petani/{id}',[petaniController::class,'Editpetani']);
Route::post('/perubahan-data-petani/{id}',[petaniController::class,'Perubahanpetani']);
Route::get('/hapus-data-petani/{id}',[petaniController::class,'Hapuspetani']);
//panen
Route::get('/data-panen',[panenController::class,'panen']);
Route::get('/tambah-data-panen',[panenController::class,'Tambahpanen']);
Route::post('/simpan-data-panen',[panenController::class,'Simpanpanen']);
Route::get('/edit-data-panen/{id}',[panenController::class,'Editpanen']);
Route::post('/perubahan-data-panen/{id}',[panenController::class,'Perubahanpanen']);
Route::get('/hapus-data-panen/{id}',[panenController::class,'Hapuspanen']);
//data Uji
Route::get('/data-uji',[ujiController::class,'uji']);
Route::get('/tambah-data-uji',[ujiController::class,'Tambahuji']);
Route::post('/simpan-data-uji',[ujiController::class,'Simpanuji']);
Route::get('/edit-data-uji/{id}',[ujiController::class,'Edituji']);
Route::post('/perubahan-data-uji/{id}',[ujiController::class,'Perubahanuji']);
Route::get('/hapus-data-uji/{id}',[ujiController::class,'Hapusuji']);
//performance
Route::get('/performance',[performanceController::class,'performance']);
//ppl
Route::get('/data-ppl',[pplController::class,'ppl']);
Route::get('/tambah-data-ppl',[pplController::class,'Tambahppl']);
Route::post('/simpan-data-ppl',[pplController::class,'Simpanppl']);
Route::get('/edit-data-ppl/{id}',[pplController::class,'Editppl']);
Route::post('/perubahan-data-ppl/{id}',[pplController::class,'Perubahanppl']);
Route::get('/hapus-data-ppl/{id}',[pplController::class,'Hapusppl']);

//desa
Route::get('/data-desa',[desaController::class,'desa']);
Route::get('/tambah-data-desa',[desaController::class,'Tambahdesa']);
Route::post('/simpan-data-desa',[desaController::class,'Simpandesa']);
Route::get('/edit-data-desa/{id}',[desaController::class,'Editdesa']);
Route::post('/perubahan-data-desa/{id}',[desaController::class,'Perubahandesa']);
Route::get('/hapus-data-desa/{id}',[desaController::class,'Hapusdesa']);

//prediksi
Route::get('/prediksi',[prediksiController::class,'prediksiadmin']);
Route::post('/hasil-prediksi',[prediksiController::class,'hasilPrediksiAdmin']);
Route::get('/lihat-detail',[prediksiController::class,'lihatDetail']);
//laporan
Route::get('/laporan-prediksi',[laporanController::class,'laporan']);
Route::get('/chart-prediksi',[laporanController::class,'chart']);
Route::get('/laporan-panen',[laporanController::class,'Laporanpanen']);
Route::get('/cetak-data-panen',[laporanController::class,'Cetakpanen']);
Route::get('/cetak-laporan',[laporanController::class,'Cetaklaporan']);
Route::get('/cetak-laporan/{tanggal_awal}/{tanggal_akhir}/{nama_petani?}/{desa_id?}', [LaporanController::class, 'Cetak']);
Route::get('/hapus-data-laporan/{id}',[laporanController::class,'Hapuslaporan']);
});

Route::group(['middleware'=>['auth','cekrole:user']], function(){ 
//prediksi
Route::get('/prediksi-user',[prediksiController::class,'prediksi']);
Route::post('/hasil-prediksi-user',[prediksiController::class,'hasilPrediksi']);
Route::get('/lihat-detail-user',[prediksiController::class,'lihatDetailUser']);
Route::get('/riwayat-prediksi',[prediksiController::class,'riwayatPrediksi']);
Route::get('/lihat-detail-riwayat/{id}',[prediksiController::class,'detailriwayat']);
});