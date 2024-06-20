<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteUserController extends Controller
{
    protected $user, $cliente;

    public function __construct(User $user, Cliente $cliente)
    {
        $this->user = $user;
        $this->cliente = $cliente;
    }

    public function clientes($idUser)
    {
        $user = $this->user->with('clientes')->find($idUser);

        if (!$user) {
            return redirect()->back();
        }

        $clientes = $user->clientes()->paginate();

        return view('admin.pages.users.clientes.index', [
            'user' => $user,
            'clientes' => $clientes,
        ]);
    }

    public function users($idCliente)
    {
        if (!$cliente = $this->cliente->find($idCliente)) {
            return redirect()->back();
        }

        $users = $cliente->users()->paginate();

        return view('admin.pages.clientes.users.index', [
            'users' => $users,
            'cliente' => $cliente,
        ]);
    }

    public function clientesAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $clientes = $user->clientesAvailable($request->filter);

        return view('admin.pages.users.clientes.available', [
            'user' => $user,
            'clientes' => $clientes,
            'filters' => $filters,
        ]);
    }

    public function attachClientesUser(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        $clientes = $user->clientesAvailable();

        if (!$request->clientes || count($request->clientes) === 0) {
            return redirect()
                    ->back()
                    ->with('info', 'É necessário selecionar pelo menos um cliente!');
        }
        //dd($request->clientes);

        $user->clientes()->attach($request->clientes);

        return redirect()->route('users.clientes', $user->id);
    }

    public function detachClienteUser(Request $request, $idUser, $idCliente)
    {
        $user = $this->user->find($idUser);
        $cliente = $this->cliente->find($idCliente);

        if (!$user || !$cliente)
            return redirect()
                    ->back()
                    ->with('info', 'Não existe o Usuário ou o Cliente!');

        $user->clientes()->detach($cliente);

        return redirect()->route('users.clientes', $user->id);
    }
}
