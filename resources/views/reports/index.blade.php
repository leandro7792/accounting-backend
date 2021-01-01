@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Gerenciar Relatórios</h1>
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
                                <th scope="col">Grupo</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr >
                                    <td scope="row">{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route("reports.edit", [$role]) }}" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Alterar dados">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
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

        $(document).ready(function() {
            $('#table').DataTable({
                order : [],
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json'
                },
            });

            $('[data-toggle="tooltip"]').tooltip({ delay: { "show": 700, "hide": 100 } });
        });
    </script>
@endsection
