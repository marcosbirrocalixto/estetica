<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    ProfileController, PermissionController, PermissionProfileController, UserController, TipoServicoController, GrupoController, SubgrupoController, UnidadeController, SubgrupoGrupoController, FuncionarioController, ServicoController, AcompanhamentoServicoController, TipoUsuarioController, DetalheAcompanhamentoController, UfController, ClienteController, TipoPessoaController, TipoLogradouroController
};

/**
 * Router Tipo Logradouro
 */
Route::any('admin/tipologradouros/search', [TipoLogradouroController::class, 'search'])->name('tipologradouros.search')->middleware('auth');
Route::resource('admin/tipologradouros', TipoLogradouroController::class)->middleware('auth');

/**
 * Router Tipo Pessoa
 */
Route::any('admin/tipopessoas/search', [TipoPessoaController::class, 'search'])->name('tipopessoas.search')->middleware('auth');
Route::resource('admin/tipopessoas', TipoPessoaController::class)->middleware('auth');

/**
 * Router Cliennes
 */
Route::any('admin/clientes/search', [ClienteController::class, 'search'])->name('clientes.search')->middleware('auth');
Route::resource('admin/clientes', ClienteController::class)->middleware('auth');


/**
 * Router UF
 */
Route::any('admin/ufs/search', [UfController::class, 'search'])->name('ufs.search')->middleware('auth');
Route::resource('admin/ufs', UfController::class)->middleware('auth');

/**
 * Router Detalhes Acompanhamento
 */
Route::delete('/acompanhamentos/{id}/detalhes/{idDetalhe}/delete', [DetalheAcompanhamentoController::class, 'delete'])->name('detalhes.acompanhamento.delete')->middleware('auth');
Route::get('/acompanhamentos/{id}/detalhes/{idDetalhe}/show', [DetalheAcompanhamentoController::class, 'show'])->name('detalhes.acompanhamento.show')->middleware('auth');
Route::put('/acompanhamentos/{id}/detalhes/{idDetalhe}/update', [DetalheAcompanhamentoController::class, 'update'])->name('detalhes.acompanhamento.update')->middleware('auth');
Route::get('/acompanhamentos/{id}/detalhes/{idDetalhe}/edit', [DetalheAcompanhamentoController::class, 'edit'])->name('detalhes.acompanhamento.edit')->middleware('auth');
Route::post('/acompanhamentos/{id}/detalhes/store', [DetalheAcompanhamentoController::class, 'store'])->name('detalhes.acompanhamento.store')->middleware('auth');
Route::get('/acompanhamentos/{id}/detalhes/create', [DetalheAcompanhamentoController::class, 'create'])->name('detalhes.acompanhamento.create')->middleware('auth');
Route::get('acompanhamentos/{id}/detalhes', [DetalheAcompanhamentoController::class, 'index'])->name('detalhes.acompanhamento.index')->middleware('auth');


/**
 * Router Tipo Usuário
 */
Route::any('admin/tipousuarios/search', [TipoUsuarioController::class, 'search'])->name('tipousuarios.search')->middleware('auth');
Route::resource('admin/tipousuarios', TipoUsuarioController::class)->middleware('auth');

/**
 * Router Aconphamento servicos
 */
Route::delete('/servicos/{id}/acompanhamentos/{idAcompanhamento}/delete', [AcompanhamentoServicoController::class, 'delete'])->name('acompanhamentos.servico.delete')->middleware('auth');
Route::get('/servicos/{id}/acompanhamentos/{idAcompanhamento}/show', [AcompanhamentoServicoController::class, 'show'])->name('acompanhamentos.servico.show')->middleware('auth');
Route::put('/servicos/{id}/acompanhamentos/{idAcompanhamento}/update', [AcompanhamentoServicoController::class, 'update'])->name('acompanhamentos.servico.update')->middleware('auth');
Route::get('/servicos/{id}/acompanhamentos/{idAcompanhamento}/edit', [AcompanhamentoServicoController::class, 'edit'])->name('acompanhamentos.servico.edit')->middleware('auth');
Route::post('/servicos/{id}/acompanhamentos/store', [AcompanhamentoServicoController::class, 'store'])->name('acompanhamentos.servico.store')->middleware('auth');
Route::get('/servicos/{id}/acompanhamentos/create', [AcompanhamentoServicoController::class, 'create'])->name('acompanhamentos.servico.create')->middleware('auth');
Route::get('servicos/{id}/acompanhamentos', [AcompanhamentoServicoController::class, 'index'])->name('acompanhamentos.servico.index')->middleware('auth');

/**
 * Router Servicos
 */
Route::any('admin/servicos/search', [ServicoController::class, 'search'])->name('servicos.search')->middleware('auth');
Route::resource('admin/servicos', ServicoController::class)->middleware('auth');

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




