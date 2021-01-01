@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Arquivos</h1>
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
                                <h4>Gerenciar Pastas</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-primary mb-2" title="Adicionar Pasta" onclick="addPassword()">
                                    <i class="fa fa-plus"> Incluir</i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <form id="frm_update" action="{{ route('files.update') }}" method="post">
                        @csrf
                        @method("PUT")

                        <ul class="list-group" id="files-list" >
                            @foreach ($files as $file)
                                <li id="files-item{{ $file->id }}" class="list-group-item list-group-item-action">
                                    <input type="hidden" name="files[{{ $file->id }}][id]" value={{ $file->id }}>

                                    <button type="button" class="close" aria-label="Close" onclick="remove('files-item{{ $file->id }}')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="form-group">
                                        <label for="name{{ $file->id }}">Nome</label>
                                        <input type="text" readonly class="form-control-plaintext" id="name{{ $file->id }}" name="files[{{ $file->id }}][name]" value="{{ $file->name }}" aria-describedby="files{{ $file->id }}Help"  required>
                                        <small id="name{{ $file->id }}Help" class="form-text text-muted">Nome da pasta</small>
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
            const filesList = document.getElementById('files-list');
            const hash = Date.now();
            filesList.insertAdjacentHTML(
                'beforeend',
                `<li id="files-item${hash}" class="list-group-item list-group-item-action">
                    <button type="button" class="close" aria-label="Close" onclick="remove('files-item${hash}')">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="form-group">
                        <label for="name${hash}">Nome</label>
                        <input type="text" class="form-control" id="name${hash}" name="files[${hash}][name]" value="" aria-describedby="name${hash}Help" required>
                        <small id="name${hash}Help" class="form-text text-muted">Nome da pasta</small>
                    </div>
                </li>`
            );
        }

        function remove(listID) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir esta pasta?',
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
