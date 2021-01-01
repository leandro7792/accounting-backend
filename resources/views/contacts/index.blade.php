@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <h1 class="m-0 text-dark">Contatos</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)

                                <tr >
                                    <td scope="row">{{ $contact->name }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        <a href="{{ route("contacts.create", [$contact]) }}" onclick="popupWindow(this.href,'Nova empresa', window, 400, 700);return false;" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Criar empresa">
                                            <i class="fa fa-plus"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remover do sistema" onclick="remove('removecontact{{ $contact->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form method="POST" id="removecontact{{ $contact->id }}" action="{{ route('contacts.destroy', [$contact]) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
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
                text: 'Deseja realmente dar baixa neste Contato?',
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

        function popupWindow(url, windowName, win, w, h) {
            const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
            const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
            win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
        }
    </script>
@endsection
