<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    ProfileController, PermissionController, PermissionProfileController, UserController
};

/**
 * Router Users
 */
Route::any('/admin/users/search', [UserController::class, 'search'])->name('users.search')->middleware('auth');
Route::resource('/admin/users', UserController::class)->middleware('auth');


/*
    Routes Permission x Profile
*/
Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions')->middleware('auth');

/**
 * Profiles X Permission
 */
Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permission.profiles')->middleware('auth');

/**
 * Permission X Profile
 */
Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach')->middleware('auth');
Route::post('profiles/{id}/permissions/store', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach')->middleware('auth');
Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available')->middleware('auth');
Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions')->middleware('auth');

/**
 * Router Permission
 */
Route::any('/permissions/search', [PermissionController::class, 'search'])->name('permissions.search')->middleware('auth');
Route::resource('permissions', PermissionController::class)->middleware('auth');

/*
    Routes Permissions
*/
Route::any('/admin/permission/search', [PermissionController::class, 'search'])->name('permissions.search')->middleware('auth');
Route::resource('/admin/permissions', PermissionController::class)->middleware('auth');

/*
    Routes Profiles
*/
Route::any('/admin/profiles/search', [ProfileController::class, 'search'])->name('profiles.search')->middleware('auth');
Route::resource('/admin/profiles', ProfileController::class)->middleware('auth');

Route::get('/admin', [ProfileController::class, 'index'])->name('admin.index');

//Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});




