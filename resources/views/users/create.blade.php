@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Novo Usúario:</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('users.index') }}" type="button" class="btn btn-warning" title="Voltar">
                    <i class="fa fa-backward"></i>&nbsp;&nbsp;Voltar
                </a>
            </div>
        </div>
    </div>

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" aria-describedby="nameHelp" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="nameHelp" class="form-text text-muted">Sugerimos o nome completo para melhor identificação.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" aria-describedby="emailHelp" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="emailHelp" class="form-text text-muted">Informe um email válido.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Senha de Primeiro Acesso</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('name')}}" aria-describedby="passwordHelp" minlength="6" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="passwordHelp" class="form-text text-muted">Preencha uma senha com no minimo 6 digitos.</small>
                            @enderror
                        </div>


                        <div class="form-group">

                            <label>Grupos</label>

                            @error('roles')
                                <div class="alert alert-danger" role="alert">
                                    Marque ao menos um grupo
                                </div>
                            @enderror

                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="{{ Str::kebab($role->name) }}" name="roles[]" value="{{ $role->name }}">
                                    <label class="form-check-label" for="{{ Str::kebab($role->name) }}">{{ ucfirst($role->name) }}</label>
                                </div>
                            @endforeach

                            <small class="form-text text-muted">Você pode marcar mais de um grupo se for o caso.</small>

                        </div>

                        <button type="submit" class="btn btn-primary float-right">Gravar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
