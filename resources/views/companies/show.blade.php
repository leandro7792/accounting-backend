@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Informações:</h1>
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

                    <h4>Empresa</h4>
                    <dl class="row border p-2">
                        <dt class="col-sm-3">Enquadramento:</dt>
                        <dd class="col-sm-9">{{ $company->company_type->initials }}</dd>

                        @if ($company->company_size)
                            <dt class="col-sm-3">Porte:</dt>
                            <dd class="col-sm-9">{{ $company->company_size->initials }}</dd>
                        @endif

                        @if ($company->tax)
                            <dt class="col-sm-3">Tributação:</dt>
                            <dd class="col-sm-9">{{ $company->tax->name }}</dd>
                        @endif

                        @if ($company->administration_type)
                            <dt class="col-sm-3">Administração:</dt>
                            <dd class="col-sm-9">{{ $company->administration_type->name }}</dd>
                        @endif

                        <dt class="col-sm-3">Código:</dt>
                        <dd class="col-sm-9">{{ $company->code }}</dd>

                        <dt class="col-sm-3">CNPJ:</dt>
                        <dd class="col-sm-9">{{ $company->cnpj }}</dd>

                        <dt class="col-sm-3">Razão Social:</dt>
                        <dd class="col-sm-9">{{ $company->corporate_name }}</dd>

                        <dt class="col-sm-3">Nome Fantasia:</dt>
                        <dd class="col-sm-9">{{ $company->fancy_name }}</dd>

                        <dt class="col-sm-3">Telefone:</dt>
                        <dd class="col-sm-9">{{ $company->phone }}</dd>

                        <dt class="col-sm-3">Email:</dt>
                        <dd class="col-sm-9">{{ $company->email }}</dd>

                        <dt class="col-sm-3">Capital Social:</dt>
                        <dd class="col-sm-9">{{ $company->share_capital }}</dd>

                        <dt class="col-sm-3">Endereço:</dt>
                        <dd class="col-sm-9">{{ $company->address }}</dd>

                        <dt class="col-sm-3">Bairro:</dt>
                        <dd class="col-sm-9">{{ $company->neighborhood }}</dd>

                        <dt class="col-sm-3">Cidade:</dt>
                        <dd class="col-sm-9">{{ $company->city }}</dd>

                        <dt class="col-sm-3">Estado:</dt>
                        <dd class="col-sm-9">{{ $company->state }}</dd>

                        <dt class="col-sm-3">CEP:</dt>
                        <dd class="col-sm-9">{{ $company->zip_code }}</dd>

                        <dt class="col-sm-3">CNAE(s):</dt>
                        <dd class="col-sm-9">
                            @foreach ($company->activities as $activity)
                                <p>{{ $activity->cnae->code }}/{{ $activity->cnae->description }}</p>
                            @endforeach
                        </dd>
                    </dl>


                    <h4>Contato</h4>
                    @foreach ($company->contacts as $contact)
                        <dl class="row border p-2">
                            <dt class="col-sm-3">Nome:</dt>
                            <dd class="col-sm-9">{{ $contact->name }}</dd>

                            <dt class="col-sm-3">Telefone:</dt>
                            <dd class="col-sm-9">{{ $contact->phone }}</dd>

                            <dt class="col-sm-3">Email:</dt>
                            <dd class="col-sm-9">{{ $contact->email }}</dd>
                        </dl>
                    @endforeach

                    <h4>Sócio(s)/Proprietário</h4>
                    @foreach ($company->partners as $partner)
                        <dl class="row border p-2">
                            <dt class="col-sm-3">Nome:</dt>
                            <dd class="col-sm-9">{{ $partner->name }}</dd>

                            <dt class="col-sm-3">Telefone:</dt>
                            <dd class="col-sm-9">{{ $partner->phone }}</dd>

                            <dt class="col-sm-3">Email:</dt>
                            <dd class="col-sm-9">{{ $partner->email }}</dd>

                            <dt class="col-sm-3">Estado Civíl:</dt>
                            <dd class="col-sm-9">{{ $partner->marital_status }}</dd>

                            <dt class="col-sm-3">Tipo de Casamento:</dt>
                            <dd class="col-sm-9">{{ $partner->wedding_type }}</dd>

                            <dt class="col-sm-3">Cartório(s) com Firma:</dt>
                            <dd class="col-sm-9">{{ $partner->notary_public }}</dd>

                            <dt class="col-sm-3">Naturalidade:</dt>
                            <dd class="col-sm-9">{{ $partner->naturalness }}</dd>

                            @if (!is_null($partner->pro_labore))
                                <dt class="col-sm-3">Pro Labore:</dt>
                                <dd class="col-sm-9">{{ $partner->pro_labore }}</dd>
                            @endif

                            @if (!is_null($partner->registered_federal_revenue))
                                <dt class="col-sm-3">Representante na RF:</dt>
                                <dd class="col-sm-9">{{ $partner->registered_federal_revenue ? "Sim": "Não" }}</dd>
                            @endif
                        </dl>
                    @endforeach

                    <div class="d-flex justify-content-around">

                        @if(auth()->user()->can('aprovar cliente') && !$company->approved)
                            <button type="button" class="btn btn-success" title="Aprovar" onclick="approve()">
                                <i class="fa fa-check"> Aprovar</i>
                            </button>
                        @endif

                        <a href="{{ route("passwords.show", [$company]) }}" type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Editar Senhas">
                            <i class="fa fa-key"> Senhas</i>
                        </a>

                        @can('excluir cliente')
                            <button type="button" class="btn btn-danger" title="Excluir" onclick="remove()">
                                <i class="fa fa-trash"> Excluir</i>
                            </button>
                        @endcan

                        <a href="{{ route('companies.index') }}" type="button" class="btn btn-warning" title="Voltar">
                            <i class="fa fa-backward"> Voltar</i>
                        </a>

                    </div>

                    @if(auth()->user()->can('aprovar cliente') && !$company->approved)
                        <form method="POST" id="approvecompany" action="{{ route('companies.approve', [$company]) }}">
                            @method('PATCH')
                            @csrf
                        </form>
                    @endif

                    @can('excluir cliente')
                        <form method="POST" id="removecompany" action="{{ route('companies.destroy', [$company]) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endcan

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @if(auth()->user()->can('aprovar cliente') && !$company->approved)
            function approve() {
                document.querySelector('#approvecompany').submit();
            }
        @endif

        @can('excluir cliente')
        function remove() {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir este cadastro?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                denyButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('#removecompany').submit();
                }
            });
        }
        @endcan
    </script>
@endsection
