<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
// use App\Http\Controllers\admin;
use App\Http\Controllers\AdminController;
use App\Models\Listing; 

Route::get('/', [Controllers\ListingController::class, 'index'])
    ->name('listings.index');

// Route::get('/', [Controllers\ListingController::class, 'adminind'])
//     ->name('listings.adminind');

Route::get('/new', [Controllers\ListingController::class, 'create'])
    ->name('listings.create');

Route::post('/new', [Controllers\ListingController::class, 'store'])
    ->name('listings.store');

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    return view('dashboard', [
        'listings' => $request->user()->listings
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/Admindashboard', function () {
    $listings = Listing::all(); // Fetch all listings from the database
    return view('Admindashboard', ['listings' => $listings]);
})
->middleware(['auth'])->name('Admindashboard');

// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


// Admin Dashboard Routes
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         // Logic for displaying admin dashboard
//     })->name('admin.dashboard');

    // Define other admin routes here
// });
// 

// Route::get('/admin/Admindashboard', [AdminController::class, 'Admindashboard'])->name('admin.dashboard');

require __DIR__.'/auth.php';
// use App\Http\Controllers\ListingController;

Route::get('/listings/{slug}/edit', [Controllers\ListingController::class, 'edit'])->name('listings.edit');
Route::put('/listings/{id}', [Controllers\ListingController::class, 'update'])->name('listings.update');
Route::delete('/admin/listings/{id}', [Controllers\AlistingController::class, 'delete'])->name('admin.listings.delete');

// Route::delete('/listings/{id}', [Controllers\AlistingController::class, 'delete'])->name('listings.delete');
Route::delete('/listings/{id}', [Controllers\ListingController::class, 'destroy'])->name('listings.destroy');
// Route::delete('/listings/{id}', [Controllers\ListingController::class, 'delete'])->name('listings.delete');
// Route::delete('/listings/{slug}', [Controllers\ListingController::class, 'Adestroy'])->name('listings.Adestroy');

// Route::get('/listings/{slug}', [ListingController::class, 'show'])->name('listings.show');

Route::get('/{listing}', [Controllers\ListingController::class, 'show'])
    ->name('listings.show');
    // Route::get('/{id}', [Controllers\ListingController::class, 'Ashow'])
    // ->name('listings.Ashow');

Route::get('/{listing}/apply', [Controllers\ListingController::class, 'apply'])
    ->name('listings.apply');