@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Usuários</h1>
            </div>
            <div class="col text-right">
            <a href="{{ route('users.create') }}" type="button" class="btn btn-primary" title="Alterar">
                    <i class="fa fa-plus"> Criar Novo</i>
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

                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Email</th>
                                <th>Grupo(S)</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route("users.edit", [$user]) }}" type="button" class="btn btn-success" title="Alterar">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" title="Excluir" onclick="remove('removeuser{{ $user->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form method="POST" id="removeuser{{ $user->id }}" action="{{ route('users.destroy', [$user]) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Usuário</th>
                                <th>Email</th>
                                <th>Grupo(s)</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

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
