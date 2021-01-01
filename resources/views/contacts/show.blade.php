@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Contato:</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('contacts.index') }}" type="button" class="btn btn-warning" title="Voltar">
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

                    <h4>Dados:</h4>
                    <dl class="row border p-2">
                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9">{{ $contact->name }}</dd>

                        <dt class="col-sm-3">Telefone</dt>
                        <dd class="col-sm-9">{{ $contact->phone }}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $contact->email }}</dd>
                    </dl>

                    <dl class="row border p-2 d-flex justify-content-around">
                        <a href="{{ route("contacts.create", [$contact]) }}" onclick="popupWindow(this.href,'Nova empresa', window, 400, 700);return false;" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Criar empresa">
                            <i class="fa fa-plus"> Criar Empresa</i>
                        </a>
                    </dl>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function popupWindow(url, windowName, win, w, h) {
            const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
            const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
            win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
        }
    </script>
@endsection
