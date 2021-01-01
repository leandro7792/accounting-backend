@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Novo Grupo:</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('roles.index') }}" type="button" class="btn btn-warning" title="Voltar">
                    <i class="fa fa-backward"></i>&nbsp;&nbsp;Voltar
                </a>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="form-group">

                            <label for="groupName">Nome do Grupo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="groupName" name="name" value="{{old('name')}}" aria-describedby="groupHelp" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="groupHelp" class="form-text text-muted">Defina um nome único para o novo grupo.</small>
                            @enderror
                        </div>


                        <div class="form-group">

                            <label>Permissões</label>

                            @error('permissions')
                                <div class="alert alert-danger" role="alert">
                                    Marque ao menos uma permissão para o Grupo.
                                </div>
                            @enderror

                            @foreach ($permissions as $permission)

                                <div class="form-check">
                                    <input class="form-check-input @error('permissions') is-invalid @enderror" type="checkbox" id="{{ Str::kebab($permission->name) }}" name="permissions[]" value="{{ $permission->name }}">
                                    <label class="form-check-label" for="{{ Str::kebab($permission->name) }}">{{ ucfirst($permission->name) }}</label>
                                </div>

                            @endforeach

                        </div>

                        <button type="submit" class="btn btn-primary float-right">Gravar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
