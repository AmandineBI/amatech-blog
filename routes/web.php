<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\UsersController;

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
})->name('home');

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function() {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard'); //Use of "::inertia" because does not go through Controller.
});

Route::group(['prefix' => 'admin', 'middelware' => ['auth', 'is_admin']], function () {
    Route::patch('blog/adminPanel/{id}', [PostsController::class, 'publish'], ['adminFunctionality' => true])->name('adminPanel.publish');
    Route::patch('blog/adminPanel/archive/{id}', [PostsController::class, 'archive'], ['adminFunctionality' => true])->name('adminPanel.archive');
    Route::get('blog/adminPanel', [PostsController::class, 'indexAdmin'], ['adminFunctionality' => true])->name('adminPanel');
    Route::get('blog/adminPanel/category/{id}', [PostsController::class, 'indexAdminCategory'], ['adminFunctionality' => true])->name('adminPanel.category');
    Route::resource('blog', PostsController::class)->names('adminBlog');
    Route::resource('blog/adminPanel/categories', CategoriesController::class)->names('adminCategories');
    Route::resource('blog/adminPanel/languages', LanguagesController::class)->names('adminLanguages');
    Route::resource('blog/adminPanel/users', UsersController::class)->names('adminUsers');
});

Route::resource('blog', PostsController::class)->only(['index', 'show'])->names('blog');



/*Route::group(['middleware' => 'auth'], function() {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

    Route::group(['middleware' => 'is_admin'], function() {
        Route::inertia('/adminDashboard', 'AdminDashboard')->name('adminDashboard');
    });
    Route::inertia('/userDashboard', 'UserDashboard')->name('userDashboard');
});*/


/***********************/
/*** Guest Dashboard ***/
/***********************/
/*Route::get('/guestDashboard', function () {
    return Inertia::render('GuestDashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('guestDashboard');*/


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
| Other Blog Routes
|--------------------------------------------------------------------------
*/

// Blog Home Page - List of posts
//Route::get('/blog', function() {
//    return Inertia::render('Welcome');
//});

// Blog guests - List of Posts
//Route::get('/blog', [PostsController::class, 'index'], ['adminFunctionality' => false])
//    ->name('blog');

// Blog guests - View post
//Route::get('/blog/view/{id}', [PostsController::class, 'show'])
//        ->name('blogView');

// Blog admin resource pages - to adapt and add Middleware??
//Route::resource('posts', PostsController::class);

// Blog admin - List of Posts
//Route::middleware(['auth', 'is_admin'])
//    ->get('/blog/admin', [PostsController::class, 'indexAdmin'], ['adminFunctionality' => true])
//    ->name('adminBlog.indexAdmin');


// Blog admin - Edit page
/*Route::middleware(['auth', 'is_admin'])->group(function () {
    return Route::get('/blog/admin/edit/{id}', [PostsController::class, 'edit'])
        ->name('adminBlogEdit');
});*/

// Blog admin - View post
/*Route::middleware(['auth', 'is_admin'])->group(function () {
    return Route::get('/blog/admin/view/{id}', [PostsController::class, 'show'])
        ->name('adminBlogView');
});*/

// Blog admin - Create post
/*Route::middleware(['auth', 'is_admin'])->group(function () {
    return Route::get('/blog/admin/create', [PostsController::class, 'create'])
        ->name('adminBlogCreate');
});*/

/*Route::group(['middleware' => ['auth', 'is_admin']], function () {
    Route::resource('/blog/admin', PostsController::class)->name('*', 'adminBlog');
    //Route::get('/blog/admin/edit/{id}', [PostsController::class, 'edit'])->name('adminBlogEdit');
    //Route::get('/blog/admin/view/{id}', [PostsController::class, 'show'])->name('adminBlogView');
    //Route::get('/blog/admin/create', [PostsController::class, 'create'])->name('adminBlogCreate');
});*/

require __DIR__.'/auth.php';
