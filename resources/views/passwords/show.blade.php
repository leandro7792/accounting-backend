@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Senhas</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('companies.show', [$company]) }}" type="button" class="btn btn-warning" title="Voltar">
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

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h4><b>Empresa</b> - <i>{{ $company->fancy_name }}</i></h4>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group" id="passwords-list" >
                        @foreach ($company->passwords as $pass)
                            <dl class="row border p-2">

                                <dt class="col-sm-3">Nome:</dt>
                                <dd class="col-sm-9">{{ $pass->identification }}</dd>

                                <dt class="col-sm-3">Usuário:</dt>
                                <dd class="col-sm-9">{{ $pass->user }}</dd>

                                <dt class="col-sm-3">Senha:</dt>
                                <dd class="col-sm-9">{{ $pass->password }}</dd>

                                <dt class="col-sm-3">Observações:</dt>
                                <dd class="col-sm-9">
                                    <p>{{ $pass->comments }}</p>
                                </dd>
                            </dl>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-around mt-4">
                        <a href="{{ route('companies.show', [$company]) }}" type="button" class="btn btn-warning" title="Voltar">
                            <i class="fa fa-backward"> Voltar</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function addPassword() {
            const contactyList = document.getElementById('passwords-list');
            const hash = Date.now();
            contactyList.insertAdjacentHTML(
                'beforeend',
                `<li id="password-item${hash}" class="list-group-item list-group-item-action">
                    <button type="button" class="close" aria-label="Close" onclick="remove('password-item${hash}')">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="form-group">
                        <label for="identification${hash}">Nome</label>
                        <input type="text" class="form-control" id="identification${hash}" name="password[${hash}][identification]" value="" aria-describedby="identification${hash}Help" required>
                        <small id="identification${hash}Help" class="form-text text-muted">Descrição do sistema</small>
                    </div>

                    <div class="form-group">
                        <label for="user${hash}">Usuário</label>
                        <input type="text" class="form-control" id="user${hash}" name="password[${hash}][user]" value="" aria-describedby="user${hash}Help" required>
                        <small id="user${hash}Help" class="form-text text-muted">Usuário de acesso ao sistema</small>
                    </div>

                    <div class="form-group">
                        <label for="password${hash}">Senha</label>
                        <input type="text" class="form-control" id="password${hash}" name="password[${hash}][password]" value="" aria-describedby="password${hash}Help" required>
                        <small id="password${hash}Help" class="form-text text-muted">Senha de acesso ao sistema</small>
                    </div>

                    <div class="form-group">
                        <label for="comments${hash}">Observações</label>
                        <textarea class="form-control" name="password[${hash}][comments]" id="comments${hash}" rows="3" aria-describedby="comments${hash}Help" required></textarea>
                        <small id="password${hash}Help" class="form-text text-muted">Observações</small>
                    </div>
                </li>`
            );
        }

        function remove(listID) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir esta senha?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                denyButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(listID).remove();
                }
            });
        }
    </script>
@endsection
