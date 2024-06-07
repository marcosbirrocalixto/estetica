<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    ProfileController, PermissionController, PermissionProfileController, UserController, TipoServicoController, GrupoController, SubgrupoController, UnidadeController, SubgrupoGrupoController, FuncionarioController
};

/**
 * Router Funcionario
 */
Route::any('admin/funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search')->middleware('auth');
Route::resource('admin/funcionarios', FuncionarioController::class)->middleware('auth');

/*
    Routes SubGrupos x Grupos
*/
Route::get('grupos/{id}/subgrupos', [SubgrupoGrupoController::class, 'subgrupos'])->name('grupos.subgrupos')->middleware('auth');

/**
 * grupos X Subgrupo
 */
Route::get('subgrupos/{id}/grupo', [SubgrupoGrupoController::class, 'grupos'])->name('subgrupo.grupos')->middleware('auth');

/**
 * Subgrupo X Grupo
 */
Route::get('grupos/{id}/subgrupo/{idSubgrupo}/detach', [SubgrupoGrupoController::class, 'detachSubgrupoGrupo'])->name('grupos.subgrupo.detach')->middleware('auth');
Route::post('grupos/{id}/subgrupos/store', [SubgrupoGrupoController::class, 'attachSubgruposGrupo'])->name('grupos.subgrupos.attach')->middleware('auth');
Route::any('grupos/{id}/subgrupos/create', [SubgrupoGrupoController::class, 'subgruposAvailable'])->name('grupos.subgrupos.available')->middleware('auth');
Route::get('grupos/{id}/subgrupos', [SubgrupoGrupoController::class, 'subgrupos'])->name('grupos.subgrupos')->middleware('auth');

/**
 * Router Unidades
 */
Route::any('admin/unidades/search', [UnidadeController::class, 'search'])->name('unidades.search')->middleware('auth');
Route::resource('admin/unidades', UnidadeController::class)->middleware('auth');

/**
 * Router Subgrupos
 */
Route::any('admin/subgrupos/search', [SubgrupoController::class, 'search'])->name('subgrupos.search')->middleware('auth');
Route::resource('admin/subgrupos', SubgrupoController::class)->middleware('auth');

/**
 * Router Grupos
 */
Route::any('admin/grupos/search', [GrupoController::class, 'search'])->name('grupos.search')->middleware('auth');
Route::resource('admin/grupos', GrupoController::class)->middleware('auth');


/**
 * Router Tiposervicos
 */
Route::any('admin/tiposervicos/search', [TipoServicoController::class, 'search'])->name('tiposervicos.search')->middleware('auth');
Route::resource('admin/tiposervicos', TipoServicoController::class)->middleware('auth');


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

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/', function () {
    return view('welcome');
});




