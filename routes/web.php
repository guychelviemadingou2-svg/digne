<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login-bg', function() { return view('auth.login_bg'); })->name('login.bg');
Route::get('/login-chic', function() { return view('auth.login_chic'); })->name('login.chic');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Page d'accueil publique — rediriger vers la page de connexion
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Routes protégées (nécessitent authentification)
// Add `autologin.local` so in local env a demo admin is auto-authenticated
Route::middleware(['autologin.local','auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Products
    Route::resource('products', ProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Stock Movements
    Route::resource('movements', StockMovementController::class);

    // Alerts
    Route::resource('alerts', AlertController::class);
    Route::post('alerts/{alert}/resolve', [AlertController::class, 'resolve']);

    // Exports (Admin & Manager)
    Route::middleware(['role:admin|manager'])->group(function () {
        Route::get('exports/stock/excel', [\App\Http\Controllers\ExportController::class, 'exportStockExcel'])->name('exports.stock.excel');
        Route::get('exports/movements/excel', [\App\Http\Controllers\ExportController::class, 'exportMovementsExcel'])->name('exports.movements.excel');
        // XLSX endpoints (tries real .xlsx, falls back to CSV)
        Route::get('exports/stock/xlsx', [\App\Http\Controllers\ExportController::class, 'exportStockExcel'])->name('exports.stock.xlsx');
        Route::get('exports/movements/xlsx', [\App\Http\Controllers\ExportController::class, 'exportMovementsExcel'])->name('exports.movements.xlsx');
        // PDF download (generates PDF file when possible)
        Route::get('exports/report/download-pdf', [\App\Http\Controllers\ExportController::class, 'exportReportPdfDownload'])->name('exports.report.download_pdf');
        // Legacy HTML printable report
        Route::get('exports/report/pdf', [\App\Http\Controllers\ExportController::class, 'exportReportPdf'])->name('exports.report.pdf');
    });

    // API Exports (JSON — pour intégration programmatique)
    Route::prefix('api/exports')->middleware(['role:admin|manager'])->group(function () {
        Route::get('stock', [\App\Http\Controllers\ExportController::class, 'apiExportStock'])->name('api.exports.stock');
        Route::get('movements', [\App\Http\Controllers\ExportController::class, 'apiExportMovements'])->name('api.exports.movements');
    });
});
