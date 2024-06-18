<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tipousuario;

class UserController extends Controller
{
    protected $repository, $tipousuario;

    public function  __construct(User $user, Tipousuario $tipousuario)
    {
        $this->repository = $user;
        $this->tipousuario = $tipousuario;
    }

    public function index()
    {
        $tipousuarios = $this->tipousuario->get();

        $users = $this->repository->with('tipousuario')->paginate();

        return view('admin.pages.users.index', [
            'users' => $users,
            'tipousuarios' => $tipousuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipousuarios = $this->tipousuario->get();

        return view('admin.pages.users.create', [
            'tipousuarios' => $tipousuarios,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->where('id', $id)->first();

        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipousuarios = $this->tipousuario->get();

        $user = $this->repository->where('id', $id)->first();

        if (!$user)
            return redirect()->back();

        return view('admin.pages.users.edit', [
            'user' => $user,
            'tipousuarios' => $tipousuarios,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserRequest $request, $id)
    {
        $user = $this->repository->where('id', $id)->first();

        if (!$user)
            return redirect()->back();

        $data = $request->only(['tipousuario_id', 'name', 'email']); //Verificar se vai poder trocar de empresa e tipo de usuário

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        //dd($data);

        $this->repository->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository
                ->where('id', $id)
                ->first();

        if (!$user)
            return redirect()->back();

        $user->delete();

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters,
        ]);
    }
}
