<?php

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
// routes/web.php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/getStates', [AdminController::class, 'getStates'])->name('getStates');
// Admin Dashboard
// routes/web.php

Route::middleware(['auth', 'role:admin', 'auth.check'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit.user');
    Route::post('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('update.user');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('delete.user');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/admin/export-user/{id}', [AdminController::class, 'exportUser'])->name('export.user');
    Route::get('/admin/exportUsers', [AdminController::class, 'exportUsersWithRoleTwo'])->name('exportUsers');


});

 Route::middleware(['auth'])->group(function () {

Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');

});
Route::get('/user_images/{filename}', function ($filename) {
    $path = storage_path("app/user_images/$filename");

    if (!file_exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where('filename', '.*');

Route::get('/', function () {
    return view('welcome');
});
