<?php 

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home page route
Route::get('/', [PagesController::class, 'index'])->name('home');

Route::post('/compare', [ProductController::class, 'compare'])->name('compare');
Route::match(['get', 'post'], '/compare', [ProductController::class, 'compare'])->name('compare');



// Authentication and profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Product-related routes
Route::get('/compare', [PagesController::class, 'compare'])->name('compare'); // Updated to match PagesController
Route::get('/pages/create', [ProductController::class, 'create'])->name('pages.create');
Route::post('/pages/store', [ProductController::class, 'store'])->name('pages.store');

require __DIR__.'/auth.php';
