<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => 'auth'], function() {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

    Route::group(['middleware' => 'is_admin'], function() {
        Route::inertia('/adminDashboard', 'AdminDashboard')->name('adminDashboard');
    });
    Route::inertia('/userDashboard', 'UserDashboard')->name('userDashboard');
});


Route::get('/guestDashboard', function () {
    return Inertia::render('GuestDashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('guestDashboard');


/*Route::get('/admin', function () {
    return Inertia::render('Welcome_title');
})->middleware(['auth', 'is_admin'])->name('admin');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
    Route::middleware(['is_admin'])->name('admin.')->prefix('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
    });
});*/


/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
*/

Route::get('/blog', function() {
    return Inertia::render('Welcome');
});

Route::resource('posts', PostsController::class);

Route::middleware(['auth', 'is_admin'])
    ->get('/blog/admin', [PostsController::class, 'index'])
    ->name('blogAdmin');

Route::middleware(['auth', 'is_admin'])->group(function () {
    return Route::get('/blog/admin/edit/{id}', [PostsController::class, 'edit'])
        ->name('blogAdminEdit');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    return Route::get('/blog/admin/view/{id}', [PostsController::class, 'show'])
        ->name('blogAdminView');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    return Route::get('/blog/admin/create', [PostsController::class, 'create'])
        ->name('blogAdminCreate');
});

require __DIR__.'/auth.php';
