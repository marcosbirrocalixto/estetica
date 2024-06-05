@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $user->name ?? old('name')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email ?? old('email')}} ">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" class="form-control" placeholder="Senha" name="password">
</div>
<div>
    <label>Confirme Senha:</label>
    <input type="password" class="form-control" placeholder="Confirme Senha" name="password_confirmation">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
