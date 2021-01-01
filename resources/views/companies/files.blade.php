@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Arquivos:</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('companies.index') }}" type="button" class="btn btn-warning" title="Voltar">
                    <i class="fa fa-backward"> Voltar</i>
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
                    <div class="container-fluid mb-4">
                        <div class="row">
                            <div class="col">
                                <h4><b>Empresa</b> - <i>{{ $company->fancy_name }}</i></h4>
                            </div>
                        </div>
                    </div>

                <iframe src="/laravel-filemanager?company={{ $company->id }}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
    </script>
@endsection
