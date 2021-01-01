@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Alterar Vizualização do Relatório:</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('reports.index') }}" type="button" class="btn btn-warning" title="Voltar">
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

                    <h3>Grupo: {{ $role->name }}</h3>

                    <br />

                    <form method="POST" action="{{ route('reports.update', [$role]) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group">

                            <label>Campos para exibir</label>

                            @foreach ($fields as $field)

                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{ Str::kebab($field['field']) }}" name="{{ $field['field'] }}" value="1" {{ $field['checked'] ? 'checked' : null }}>
                                    <label class="form-check-label" for="{{ Str::kebab($field['field']) }}">{{ ucfirst($field['label']) }}</label>
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
