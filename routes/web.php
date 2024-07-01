<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    ProfileController, PermissionController, PermissionProfileController, UserController, TipoServicoController, GrupoController, SubgrupoController, UnidadeController, SubgrupoGrupoController, FuncionarioController, ServicoController, AcompanhamentoServicoController, TipoUsuarioController, DetalheAcompanhamentoController, UfController, ClienteController, TipoPessoaController, TipoLogradouroController, ClienteUserController, VeiculoClienteController, OrdemServicoController, ServicosOrdemServicoController
};

/*
    Routes Permission x Servico
*/

Route::get('ordemservicos/{id}/servicos', [ServicosOrdemServicoController::class, 'servicos'])->name('ordemservicos.servicos')->middleware('auth');

/**
 * ordemservicos X servico
 */
Route::get('servicos/{id}/ordemservico', [ServicosOrdemServicoController::class, 'ordemservicos'])->name('servico.ordemservicos')->middleware('auth');

/**
 * servico X ordemservico
 */
Route::get('ordemservicos/{id}/servico/{idServico}/detach', [ServicosOrdemServicoController::class, 'detachServicoOrdemservico'])->name('ordemservicos.servico.detach')->middleware('auth');
Route::post('ordemservicos/{id}/servicos/store', [ServicosOrdemServicoController::class, 'attachServicosOrdemServico'])->name('ordemservicos.servicos.attach')->middleware('auth');
Route::any('ordemservicos/{id}/servicos/create', [ServicosOrdemServicoController::class, 'servicosAvailable'])->name('ordemservicos.servicos.available')->middleware('auth');
Route::get('ordemservicos/{id}/servicos', [ServicosOrdemServicoController::class, 'servicos'])->name('ordemservicos.servicos')->middleware('auth');


/**
 * Router Ordem serviço x veiculo
 */

Route::any('admin/ordemservicos/search', [OrdemServicoController::class, 'search'])->name('ordemservicos.search')->middleware('auth');
Route::delete('/ordemservicos/{id}/veiculos/{idVeiculo}/delete', [OrdemServicoController::class, 'delete'])->name('ordemservicos.veiculo.delete')->middleware('auth');
Route::get('/ordemservicos/{id}/veiculos/{idVeiculo}/show', [OrdemServicoController::class, 'show'])->name('ordemservicos.veiculo.show')->middleware('auth');
Route::put('/ordemservicos/{id}/veiculos/{idVeiculo}/update', [OrdemServicoController::class, 'update'])->name('ordemservicos.veiculo.update')->middleware('auth');
Route::get('/ordemservicos/{id}/veiculos/{idVeiculo}/edit', [OrdemServicoController::class, 'edit'])->name('ordemservicos.veiculo.edit')->middleware('auth');
Route::post('/ordemservicos/{id}/veiculos/store', [OrdemServicoController::class, 'store'])->name('ordemservicos.veiculo.store')->middleware('auth');
Route::get('/ordemservicos/{id}/veiculos/create', [OrdemServicoController::class, 'create'])->name('ordemservicos.veiculo.create')->middleware('auth');
Route::get('ordemservicos/{id}/veiculos', [OrdemServicoController::class, 'index'])->name('ordemservicos.veiculo.index')->middleware('auth');
Route::get('/ordemservicos/{id}', [OrdemServicoController::class, 'executar'])->name('ordemservicos.veiculo.executar')->middleware('auth');
Route::post('/ordemservicos/{id}/gravarOrdemServico', [OrdemServicoController::class, 'gravarOrdemServico'])->name('ordemservicos.gravarOrdemServico')->middleware('auth');



/**
 * Router Clientes veiculo
 */
Route::any('admin/veiculos/search', [VeiculoClienteController::class, 'search'])->name('veiculos.search')->middleware('auth');
Route::delete('/veiculos/{id}/clientes/{idCliente}/delete', [VeiculoClienteController::class, 'delete'])->name('veiculos.cliente.delete')->middleware('auth');
Route::get('/veiculos/{id}/clientes/{idCliente}/show', [VeiculoClienteController::class, 'show'])->name('veiculos.cliente.show')->middleware('auth');
Route::put('/veiculos/{id}/clientes/{idCliente}/update', [VeiculoClienteController::class, 'update'])->name('veiculos.cliente.update')->middleware('auth');
Route::get('/veiculos/{id}/clientes/{idCliente}/edit', [VeiculoClienteController::class, 'edit'])->name('veiculos.cliente.edit')->middleware('auth');
Route::post('/veiculos/{id}/clientes/store', [VeiculoClienteController::class, 'store'])->name('veiculos.cliente.store')->middleware('auth');
Route::get('/veiculos/{id}/clientes/create', [VeiculoClienteController::class, 'create'])->name('veiculos.cliente.create')->middleware('auth');
Route::get('veiculos/{id}/clientes', [VeiculoClienteController::class, 'index'])->name('veiculos.cliente.index')->middleware('auth');
Route::get('admin/veiculos', [VeiculoClienteController::class, 'indexVeiculos'])->name('veiculos.indexVeiculos')->middleware('auth');


/*
    Routes Cliente x User
*/
Route::get('users/{id}/clientes', [ClienteUserController::class, 'clientes'])->name('users.clientes')->middleware('auth');

/**
 * USers X Cliente
 */
Route::get('clientes/{id}/user', [ClienteUserController::class, 'users'])->name('cliente.users')->middleware('auth');

/**
 * User X Cliente
 */
Route::get('users/{id}/cliente/{idCliente}/detach', [ClienteUserController::class, 'detachClienteUser'])->name('users.cliente.detach')->middleware('auth');
Route::post('users/{id}/clientes/store', [ClienteUserController::class, 'attachClientesUser'])->name('users.clientes.attach')->middleware('auth');
Route::any('users/{id}/clientes/create', [ClienteUserController::class, 'clientesAvailable'])->name('users.clientes.available')->middleware('auth');
Route::get('users/{id}/clientes', [ClienteUserController::class, 'clientes'])->name('users.clientes')->middleware('auth');

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




