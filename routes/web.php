<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route; 

use App\Http\Controllers\PDFController;

Route::get('/send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);
// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('tipe-kamar')->name('tipe-kamar.')->group(function () {
    // Route untuk menghapus tipe kamar berdasarkan ID
    Route::delete('/{id}', [TipeKamarController::class, 'destroy'])->name('destroy');
});
Route::get('/kamar/export-pdf', [KamarController::class, 'exportPDF'])->name('kamar.export-pdf');
Route::get('/', [KamarController::class, 'index']);
Route::get('/pdf', [KamarController::class, 'exportPDF']);
Route::get('/export-pdf', [KamarController::class, 'exportPdf']);
Route::get('/kamar/export', [KamarController::class, 'exportPDF'])->name('kamar.export');
Route::get('kamar/export-excel', [KamarController::class, 'exportExcel'])->name('kamar.export.excel');
Route::get('kamar/export-pdf', [KamarController::class, 'exportPDF'])->name('kamar.export.pdf');
Route::get('/kamar', [KamarController::class, 'index']);
// Route::get('/indexexport', [ExportController::class, 'indexexport'])->name('indexexport');
// Route::get('/indexexport', [ExportController::class, 'indexexport'])->name('indexexport');
// Route::get('/exportKamar', [ExportController::class, 'exportKamar'])->name('exportKamar');
// Route::get('/indexexport', [ExportController::class, 'indexexport'])->name('indexexport');
// Route::get('kamar/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
// Route::get('kamar/export/pdf', [ExportController::class, 'exportPDF'])->name('export.pdf');
// Route::get('kamar/export', [KamarController::class, 'indexForExport']); // Menampilkan tabel kamar
// Route::get('kamar/export/excel', [KamarController::class, 'exportExcel'])->name('kamar.export.excel'); // Ekspor Excel
// Route::get('kamar/export/pdf', [KamarController::class, 'exportPDF'])->name('kamar.export.pdf'); // Ekspor PDF
// Route::get('/export/kamar', [ExportController::class, 'exportKamar'])->name('export.kamar');
// Route::get('/', function () {
//     return view('home');
// });ss
// Add this route for fetching rooms by floor
Route::get('/kamar/by-floor', [KamarController::class, 'getByFloor'])->name('kamar.byFloor');
// Route::get('/indexexport', [ExportController::class, 'index'])->name('indexexport');
Route::get('/kamar/export', [KamarController::class, 'export'])->name('kamar.export');
Route::post('/kamar/import', [KamarController::class, 'import'])->name('kamar.import');
// Kamar Management Routes
Route::delete('tipe-kamar/{id}', [TipeKamarController::class, 'destroy'])->name('tipe-kamar.destroy');
Route::get('/kamar', [KamarController::class, 'index'])->name('kamar');
Route::get('/kamar/create', [KamarController::class, 'create'])->name('kamar.create');
Route::post('/kamar', [KamarController::class, 'store'])->name('kamar.store');
Route::get('/kamar/{kamar}/edit', [KamarController::class, 'edit'])->name('kamar.edit');
Route::put('/kamar/{kamar}', [KamarController::class, 'update'])->name('kamar.update');
Route::delete('/kamar/{kamar}', [KamarController::class, 'destroy'])->name('kamar.destroy'); 
Route::get('/kamar/{kamar}', [KamarController::class, 'show'])->name('kamar.show');
Route::get('/kamar/available', [KamarController::class, 'getAvailableRooms'])->name('kamar.available');
Route::get('/kamar/{kamar}/history', [KamarController::class, 'history'])->name('kamar.history');
Route::patch('/kamar/{kamar}/update-status', [KamarController::class, 'updateStatus'])->name('kamar.updateStatus');
// Tipe Kamar Routes
Route::put('tipe-kamar/{tipe_kamar}', [TipeKamarController::class, 'update'])->name('tipe-kamar.update');
Route::resource('tipe-kamar', TipeKamarController::class);
Route::resource('tipe-kamar', TipeKamarController::class);
Route::get('/', [HomeController::class, 'index'])->name('home');