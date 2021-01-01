@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <h1 class="m-0 text-dark">Empresas</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Nome Fantasia</th>
                                <th scope="col">CNPJ</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)

                            @if($company->approved)
                                <tr >
                            @else
                                <tr class="table-info" title="Aguardando Aprovação" data-toggle="tooltip">
                            @endif
                                    <th scope="row">{{ $company->code }}</th>
                                    <td>{{ $company->fancy_name }}</td>
                                    <td>{{ $company->cnpj }}</td>
                                    <td>{{ $company->company_type->initials }}</td>
                                    <td>
                                        <a href="{{ route("companies.show", [$company]) }}" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Mais informações">
                                            <i class="fa fa-info-circle"></i>
                                        </a>

                                        @if($company->approved)
                                            @can('editar cliente')
                                            <a href="{{ route("companies.edit", [$company]) }}" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Alterar dados">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan

                                            @can('editar senhas do cliente')
                                            <a href="{{ route("passwords.edit", [$company]) }}" type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Editar Senhas">
                                                <i class="fa fa-key"></i>
                                            </a>
                                            @endcan

                                            @can('ver arquivos do cliente')
                                            <a href="{{ route("companies.files", [$company]) }}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Arquivos">
                                                <i class="fa fa-file"></i>
                                            </a>
                                            @endcan

                                            @can('excluir cliente')
                                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remover do sistema" onclick="remove('removecompany{{ $company->id }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <form method="POST" id="removecompany{{ $company->id }}" action="{{ route('companies.destroy', [$company]) }}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            @endcan
                                        @endif
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
