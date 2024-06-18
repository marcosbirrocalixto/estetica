@include('admin.includes.alerts')

@csrf

@if ($user->id ?? '')
<div class="form-group">
    <label for="tipousuario_id">Tipo Usuário</label>
    <select class="form-control" name="tipousuario_id">
        @foreach ( $tipousuarios as $tipousuario )
            @if ($user->tipousuario_id == $tipousuario->id )
                <option selected value="{{ $tipousuario->id }}">{{ $tipousuario->description }}</option>
            @else
                <option value="{{ $tipousuario->id }}">{{ $tipousuario->description }}</option>
            @endif
        @endforeach
    </select>
</div>
@else
<div class="form-group">
    <label for="tipousuario_id">Tipo Usuário</label>
    <select class="form-control" name="tipousuario_id">
        @foreach ( $tipousuarios as $tipousuario )
            <option value="{{ $tipousuario->id }}">{{ $tipousuario->description }}</option>
        @endforeach
    </select>
</div>
@endif
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
