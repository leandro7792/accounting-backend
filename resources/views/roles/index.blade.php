@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Grupos</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('roles.create') }}" type="button" class="btn btn-primary" title="Criar Novo Grupo">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Criar Novo
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

                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Grupo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                @if($role->name !== 'super-admin' || auth()->user()->can('super-admin'))
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @if($role->name !== 'super-admin')
                                                <a href="{{ route('roles.edit', ['role' => $role->id]) }}" type="button" class="btn btn-success" title="Alterar">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger" title="Excluir" onclick="remove('removerole{{ $role->id }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <form method="POST" id="removerole{{ $role->id }}" action="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>

                                            @else
                                                Todos Privilégios Garantido
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Grupo</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        function remove(form) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir este cadastro?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                denyButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(form).submit();
                }
            });
        }

        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json'
                },
            });
        });
    </script>
@endsection
