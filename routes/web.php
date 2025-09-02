<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurahCairController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//Routing login dan logout
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Routing 4 menu
Route::get('/curah-cair', [CurahCairController::class, 'dashboard'])->name('curah.cair');
Route::get('/curah-kering', function () {
    return view('curahKering.app');
})->name('curah.kering');
Route::get('/peti-kemas', function () {
    return view('petiKemas.app');
})->name('peti.Kemas');
Route::get('/general-Cargo', function () {
    return view('generalCargo.app');
})->name('general.Cargo');

 
// ----------------------------
//Routing menu di curah cair
// -----------------------------
Route::get('/curah-cair/dashboard_CC', [CurahCairController::class, 'dashboard'])->name('dashboard_curah_cair');
Route::get('/curah-cair/Data_CC', [CurahCairController::class, 'Data_CC'])->name('Data_CC');
Route::get('/curah-cair/analisis/shipper', [CurahCairController::class, 'analisisShipper'])->name('analisis.shipper');
Route::get('/curah-cair/analisis/komoditas', [CurahCairController::class, 'analisisKomoditas'])->name('analisis.komoditas');
Route::get('/curah-cair/data/shipper', [CurahCairController::class, 'dataShipper'])->name('data.shipper');
Route::get('/curah-cair/data/commodity', [CurahCairController::class, 'dataCommodity'])->name('data.commodity');
// Halaman Data Produksi
//Route::get('/curah-cair/Data_CC', [CurahCairController::class, 'Data_CC'])->name('Data_CC');

// CRUD Nama Shipper
Route::get('/curah-cair/shippername/create', [CurahCairController::class, 'createShipperName'])->name('shippername.create');
Route::post('/curah-cair/shippername/store', [CurahCairController::class, 'storeShipperName'])->name('shippername.store');
Route::get('/curah-cair/shippername/{id}/edit', [CurahCairController::class, 'editShipperName'])->name('shippername.edit');
Route::put('/curah-cair/shippername/{id}', [CurahCairController::class, 'updateShipperName'])->name('shippername.update');
Route::delete('/curah-cair/shippername/{id}', [CurahCairController::class, 'destroyShipperName'])->name('shippername.destroy');

// CRUD Nama Komoditas
Route::get('/curah-cair/commodityname/create', [CurahCairController::class, 'createCommodityName'])->name('commodityname.create');
Route::post('/curah-cair/commodityname/store', [CurahCairController::class, 'storeCommodityName'])->name('commodityname.store');
Route::get('/curah-cair/commodityname/{id}/edit', [CurahCairController::class, 'editCommodityName'])->name('commodityname.edit');
Route::put('/curah-cair/commodityname/{id}', [CurahCairController::class, 'updateCommodityName'])->name('commodityname.update');
Route::delete('/curah-cair/commodityname/{id}', [CurahCairController::class, 'destroyCommodityName'])->name('commodityname.destroy');

// Shipper Production CRUD Routes
Route::get('/curah-cair/shipper/create', [CurahCairController::class, 'createShipper'])->name('shipper.create');
Route::post('/curah-cair/shipper/store', [CurahCairController::class, 'storeShipper'])->name('shipper.store');
Route::get('/curah-cair/shipper/{id}/edit', [CurahCairController::class, 'editShipper'])->name('shipper.edit');
Route::put('/curah-cair/shipper/{id}', [CurahCairController::class, 'updateShipper'])->name('shipper.update');
Route::delete('/curah-cair/shipper/destroy/{id}', [CurahCairController::class, 'destroyShipper'])->name('shipper.destroy');
// Commodity Production CRUD Routes
Route::get('/curah-cair/commodity/create', [CurahCairController::class, 'createCommodity'])->name('commodity.create');
Route::post('/curah-cair/commodity/store', [CurahCairController::class, 'storeCommodity'])->name('commodity.store');
Route::get('/curah-cair/commodity/{id}/edit', [CurahCairController::class, 'editCommodity'])->name('commodity.edit');
Route::put('/curah-cair/commodity/{id}', [CurahCairController::class, 'updateCommodity'])->name('commodity.update');
Route::delete('/curah-cair/commodity/destroy/{id}', [CurahCairController::class, 'destroyCommodity'])->name('commodity.destroy');
//chart
Route::get('/chart-data', [CurahCairController::class, 'chartData'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class, \Illuminate\Session\Middleware\StartSession::class])
    ->name('chart.data');


//Routing dashboard curah kering
Route::get('/curah-kering/dashboard_CK', function () {
    return view('curahKering.app');
})->name('dashboard_CK');
Route::get('/curah-kering/Data_CK', function () {
    return view('curahKering.Data');
})->name('Data_CK');
Route::get('/curah-kering/analisis_CK', function () {
    return view('curahKering.analisis');
})->name('analisis_CK');

//Routing dashboard general cargo
Route::get('/general-cargo/app_GC', function () {
    return view('generalCargo.app');
})->name('app_GC');
Route::get('/general-cargo/Data_GC', function () {
    return view('generalCargo.Data');
})->name('Data_GC');
Route::get('/general-cargo/analisis_GC', function () {
    return view('generalCargo.Data');
})->name('analisis_GC');

//Routing dashboard peti kemas
Route::get('/peti-kemas/dashboard_PK', function () {
    return view('petiKemas.app');
})->name('dashboard_PK');
Route::get('/peti-kemas/Data_PK', function () {
    return view('petiKemas.Data');
})->name('Data_PK');
Route::get('/peti-kemas/analisis_PK', function () {
    return view('petiKemas.analisis');
})->name('analisis_PK');