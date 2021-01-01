@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Editar Senhas</h1>
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

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h4><b>Empresa</b> - <i>{{ $company->fancy_name }}</i></h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-primary mb-2" title="Incluir CNAE" onclick="addPassword()">
                                    <i class="fa fa-plus"> Incluir</i>
                                </button>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="frm_update" action="{{ route('passwords.update', [$company]) }}" method="post">
                        @csrf
                        @method("PUT")

                        <ul class="list-group" id="passwords-list" >
                            @foreach ($company->passwords as $pass)
                                <li id="password-item{{ $pass->id }}" class="list-group-item list-group-item-action">
                                    <input type="hidden" name="password[{{ $pass->id }}][id]" value={{ $pass->id }}>

                                    <button type="button" class="close" aria-label="Close" onclick="remove('password-item{{ $pass->id }}')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="form-group">
                                        <label for="identification{{ $pass->id }}">Nome</label>
                                        <input type="text" class="form-control" id="identification{{ $pass->id }}" name="password[{{ $pass->id }}][identification]" value="{{ $pass->identification }}" aria-describedby="identification{{ $pass->id }}Help" required>
                                        <small id="identification{{ $pass->id }}Help" class="form-text text-muted">Descrição do sistema</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="user{{ $pass->id }}">Usuário</label>
                                        <input type="text" class="form-control" id="user{{ $pass->id }}" name="password[{{ $pass->id }}][user]" value="{{ $pass->user }}" aria-describedby="user{{ $pass->id }}Help" required>
                                        <small id="user{{ $pass->id }}Help" class="form-text text-muted">Usuário de acesso ao sistema</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="password{{ $pass->id }}">Senha</label>
                                        <input type="text" class="form-control" id="password{{ $pass->id }}" name="password[{{ $pass->id }}][password]" value="{{ $pass->password }}" aria-describedby="password{{ $pass->id }}Help" required>
                                        <small id="password{{ $pass->id }}Help" class="form-text text-muted">Senha de acesso ao sistema</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments{{ $pass->id }}">Observações</label>
                                        <textarea class="form-control" name="password[{{ $pass->id }}][comments]" id="comments{{ $pass->id }}" rows="3" aria-describedby="comments{{ $pass->id }}Help" required>{{ $pass->comments }}</textarea>
                                        <small id="password{{ $pass->id }}Help" class="form-text text-muted">Observações</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="d-flex justify-content-around mt-4">
                            @can('editar cliente')
                                <button type="submit" class="btn btn-primary" title="Salvar">
                                    <i class="fa fa-save"> Salvar</i>
                                </button>
                            @endcan

                            <a href="{{ route('companies.index') }}" type="button" class="btn btn-warning" title="Voltar">
                                <i class="fa fa-backward"> Voltar</i>
                            </a>
                        </div>
                    </form>

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
