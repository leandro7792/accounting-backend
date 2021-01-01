@extends('adminlte::page')

@section('title', '7mais')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Editar:</h1>
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
                    <form method="POST" id="frm_update" action="{{ route('companies.update', [$company]) }}">
                        @csrf
                        @method('PUT')

                        <h4>Empresa</h4>
                        <div class="form-group">
                            <label for="company_type">Enquadramento</label>
                            <select class="form-control @error('company_type') is-invalid @enderror" id="company_type" name="company_type_id" aria-describedby="company_typeHelp">
                                @foreach ($company_types as $type)
                                    <option value="{{ $type->id }}" @if ($company->company_type->id === $type->id) selected @endif>{{ $type->initials }}</option>
                                @endforeach
                            </select>

                            @error('company_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="company_typeHelp" class="form-text text-muted">Selecione da lista acima.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_size">Porte</label>
                            <select class="form-control @error('company_size') is-invalid @enderror" id="company_size" name="company_size_id" aria-describedby="company_sizeHelp">
                                @foreach ($company_sizes as $size)
                                    @if ($company->company_size)
                                        <option value="{{ $size->id }}" @if ($company->company_size->id === $size->id) selected @endif>{{ $size->initials }}</option>
                                    @else
                                        <option value="{{ $size->id }}">{{ $size->initials }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('company_size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="company_sizeHelp" class="form-text text-muted">Selecione da lista acima.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tax">Tributação</label>
                            <select class="form-control @error('tax') is-invalid @enderror" id="tax" name="tax_id" aria-describedby="taxHelp">
                                @foreach ($taxes as $tax)
                                    @if ($company->tax)
                                        <option value="{{ $tax->id }}" @if ($company->tax->id === $tax->id) selected @endif>{{ $tax->name }}</option>
                                    @else
                                        <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('tax')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="taxHelp" class="form-text text-muted">Selecione da lista acima.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="administration_type">Administração</label>
                            <select class="form-control @error('administration_type') is-invalid @enderror" id="administration_type_id" name="administration_type" aria-describedby="administration_typeHelp">
                                @foreach ($administration_types as $type)
                                    @if ($company->administration_type)
                                        <option value="{{ $tax->id }}" @if ($company->administration_type->id === $type->id) selected @endif>{{ $tax->name }}</option>
                                    @else
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('administration_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="administration_typeHelp" class="form-text text-muted">Selecione da lista acima.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ $company->code }}" aria-describedby="codeHelp" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="codeHelp" class="form-text text-muted">Código da empresa.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" value="{{ $company->cnpj }}" aria-describedby="cnpjHelp" required>
                            @error('cnpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="cnpjHelp" class="form-text text-muted">Número do CNPJ da empresa.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="corporate_name">Razão Social</label>
                            <input type="text" class="form-control @error('corporate_name') is-invalid @enderror" id="corporate_name" name="corporate_name" value="{{ $company->corporate_name }}" aria-describedby="corporate_nameHelp" required>
                            @error('corporate_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="corporate_nameHelp" class="form-text text-muted">Nome legal da empresa.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fancy_name">Nome Fantasia</label>
                            <input type="text" class="form-control @error('fancy_name') is-invalid @enderror" id="fancy_name" name="fancy_name" value="{{ $company->fancy_name }}" aria-describedby="fancy_nameHelp" required>
                            @error('fancy_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="fancy_nameHelp" class="form-text text-muted">Nome comercial da empresa.</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="share_capital">Capital Social</label>
                            <input type="text" class="form-control @error('share_capital') is-invalid @enderror" id="share_capital" name="share_capital" value="{{ $company->share_capital }}" aria-describedby="share_capitalHelp" required>
                            @error('share_capital')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="share_capitalHelp" class="form-text text-muted">Matenha atualizado</small>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Telefone</label>
                                <input type="tel" maxlength="15" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $company->phone }}" aria-describedby="phoneHelp" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="phoneHelp" class="form-text text-muted">Número principal: (XX) XXXXX-XXXX.</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $company->email }}" aria-describedby="emailHelp" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="emailHelp" class="form-text text-muted">Email principal: meu@email.com</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="zip_code">CEP</label>
                                <input type="text" pattern="[0-9]{5}-[0-9]{3}" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" value="{{ $company->zip_code }}" aria-describedby="zip_codeHelp" required>
                                @error('zip_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="zip_codeHelp" class="form-text text-muted">Número do CEP: XXXXX-XXX.</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address">Endereço</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $company->address }}" aria-describedby="addressHelp" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="addressHelp" class="form-text text-muted">Matenha atualizado</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhood" name="neighborhood" value="{{ $company->neighborhood }}" aria-describedby="neighborhoodHelp" required>
                                @error('neighborhood')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="neighborhoodHelp" class="form-text text-muted">Matenha atualizado</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-5">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $company->city }}" aria-describedby="cityHelp" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="cityHelp" class="form-text text-muted">Matenha atualizado</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-2">
                                <label for="state">Estado</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ $company->state }}" aria-describedby="stateHelp" required>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="stateHelp" class="form-text text-muted">Matenha atualizado</small>
                                @enderror
                            </div>
                        </div>




                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <h4>CNAE(s)</h4>
                                </div>
                                <div class="col text-right">
                                    <button type="button" class="btn btn-primary mb-2" title="Incluir CNAE"  data-toggle="modal" data-target="#modal-activities">
                                        <i class="fa fa-plus"> Incluir</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table id="table" class="table table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%">
                            <thead>
                                <th scope="col">Código</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Açoes</th>
                            </thead>
                            <tbody>
                                @foreach ($company->activities as $activity)
                                    <tr id="activity{{ $activity->cnae->id }}">
                                        <td>{{ $activity->cnae->code }}</td>
                                        <td>{{ $activity->cnae->description }}</td>
                                        <td>
                                            <input type="hidden" name="activities[]" value="{{ $activity->cnae->id }}">
                                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remover CNAE" onclick="removeActivity('activity{{ $activity->cnae->id }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>




                        <div class="container-fluid mt-3 mb-2">
                            <div class="row">
                                <div class="col">
                                    <h4>Contato(s)</h4>
                                </div>
                                <div class="col text-right">
                                    <button type="button" class="btn btn-primary" title="Adicionar Contato" onclick="addContacty()">
                                        <i class="fa fa-plus"> Adicionar</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <ul id="contacty-list" class="list-group mb-4">
                            @foreach ($company->contacts as $contact)
                                <li id="contacty{{ $contact->id }}" class="list-group-item list-group-item-action">

                                    <input type="hidden" name="contacts[{{ $contact->id }}][id]" value="{{ $contact->id }}">

                                    <button type="button" class="close" aria-label="Close" onclick="removeContacty('contacty{{ $contact->id }}')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="contactname{{ $contact->id }}">Nome</label>
                                                <input type="text" class="form-control" id="contactname{{ $contact->id }}" name="contacts[{{ $contact->id }}][name]" value="{{ $contact->name }}" aria-describedby="contactname{{ $contact->id }}Help" required>
                                                <small id="contactname{{ $contact->id }}Help" class="form-text text-muted">Nome completo, sem abreviações.</small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="contactphone{{ $contact->id }}">Telefone</label>
                                                <input type="tel" maxlength="15" class="form-control" id="contactphone{{ $contact->id }}" name="contacts[{{ $contact->id }}][phone]" value="{{ $contact->phone }}" aria-describedby="contactphone{{ $contact->id }}Help" required>
                                                <small id="contactphone{{ $contact->id }}Help" class="form-text text-muted">Ex: (xx) xxxxx-xxxx</small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="contactemail{{ $contact->id }}">Email</label>
                                                <input type="email" class="form-control" id="contactemail{{ $contact->id }}" name="contacts[{{ $contact->id }}][email]" value="{{ $contact->email }}" aria-describedby="contactemail{{ $contact->id }}Help" required>
                                                <small id="contactemail{{ $contact->id }}Help" class="form-text text-muted">Ex: meu@email.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>


                        <div class="container-fluid mt-3 mb-2">
                            <div class="row">
                                <div class="col">
                                    <h4>Proprietário/Sócio(s)</h4>
                                </div>
                                <div class="col text-right">
                                    <button type="button" class="btn btn-primary" title="Adicionar Contato" onclick="addPartner()">
                                        <i class="fa fa-plus"> Adicionar</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <ul id="partners-list" class="list-group mb-4">
                        @foreach ($company->partners as $partner)
                            <li id="partiner{{ $partner->id }}" class="list-group-item list-group-item-action">

                                <input type="hidden" name="partners[{{ $partner->id }}][id]" value="{{ $partner->id }}">

                                <button type="button" class="close" aria-label="Close" onclick="removePartiner('partiner{{ $partner->id }}')">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                <div class="form-group">
                                    <label for="partinername{{ $partner->id }}">Nome</label>
                                    <input type="text" class="form-control" id="partinername{{ $partner->id }}" name="partners[{{ $partner->id }}][name]" value="{{ $partner->name }}" aria-describedby="partinername{{ $partner->id }}Help" required>
                                    <small id="partinername{{ $partner->id }}Help" class="form-text text-muted">Informe o nome completo e sem abreviações</small>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partinerphone{{ $partner->id }}">Telefone</label>
                                            <input type="tel" class="form-control" id="partinerphone{{ $partner->id }}" name="partners[{{ $partner->id }}][phone]" value="{{ $partner->phone }}" aria-describedby="partinerphone{{ $partner->id }}Help" required>
                                            <small id="partinerphone{{ $partner->id }}Help" class="form-text text-muted">(xx) xxxxx-xxxx</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partineremail{{ $partner->id }}">Email</label>
                                            <input type="email" class="form-control" id="partineremail{{ $partner->id }}" name="partners[{{ $partner->id }}][email]" value="{{ $partner->email }}" aria-describedby="partineremail{{ $partner->id }}Help" required>
                                            <small id="partineremail{{ $partner->id }}Help" class="form-text text-muted">Ex: (xx) xxxxx-xxxx</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partinermarital_status{{ $partner->id }}">Estado Civíl</label>
                                            <input type="text" class="form-control" id="partinermarital_status{{ $partner->id }}" name="partners[{{ $partner->id }}][marital_status]" value="{{ $partner->marital_status }}" aria-describedby="partinermarital_status{{ $partner->id }}Help" required>
                                            <small id="partinermarital_status{{ $partner->id }}Help" class="form-text text-muted">Mantenha Atualizado</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partinerwedding_type{{ $partner->id }}">Tipo de Casamento</label>
                                            <input type="text" class="form-control" id="partinerwedding_type{{ $partner->id }}" name="partners[{{ $partner->id }}][wedding_type]" value="{{ $partner->wedding_type }}" aria-describedby="partinerwedding_type{{ $partner->id }}Help">
                                            <small id="partinerwedding_type{{ $partner->id }}Help" class="form-text text-muted">Ex: Comunhão parcial... Obs: Se não casado deixe em branco</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="partinernotary_public{{ $partner->id }}">Cartório(s) com Firma</label>
                                    <input type="text" class="form-control" id="partinernotary_public{{ $partner->id }}" name="partners[{{ $partner->id }}][notary_public]" value="{{ $partner->notary_public }}" aria-describedby="partinernotary_public{{ $partner->id }}Help" required>
                                    <small id="partinernotary_public{{ $partner->id }}Help" class="form-text text-muted">Informo todos os cartórios, separadoros por vírgula.</small>
                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partinernaturalness{{ $partner->id }}">Naturalidade</label>
                                            <input type="text" class="form-control" id="partinernaturalness{{ $partner->id }}" name="partners[{{ $partner->id }}][naturalness]" value="{{ $partner->naturalness }}" aria-describedby="partinernaturalness{{ $partner->id }}Help" required>
                                            <small id="partinernaturalness{{ $partner->id }}Help" class="form-text text-muted">Lugar de nascimento.</small>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partinerpro_labore{{ $partner->id }}">Pro Labore</label>
                                            <input type="text" class="form-control" id="partinerpro_labore{{ $partner->id }}" name="partners[{{ $partner->id }}][pro_labore]" value="{{ $partner->pro_labore }}" aria-describedby="partinerpro_labore{{ $partner->id }}Help">
                                            <small id="partinerpro_labore{{ $partner->id }}Help" class="form-text text-muted">Mantenha Atualizado</small>
                                        </div>
                                    </div>

                                </div>

                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" name="partners[{{ $partner->id }}][registered_federal_revenue]" value="1" id="partinerregistered_federal_revenue{{ $partner->id }}" {{ $partner->registered_federal_revenue ? 'checked' : null }}>
                                    <label class="custom-control-label" for="partinerregistered_federal_revenue{{ $partner->id }}">
                                        Representante na Receita Federal
                                    </label>
                                </div>
                            </li>
                        @endforeach
                        </ul>

                        @can('dados financeiro')

                        <div class="container-fluid mt-3 mb-2">
                            <div class="row">
                                <div class="col">
                                    <h4>Financeiro</h4>
                                </div>
                            </div>
                        </div>
                        <ul id="partners-list" class="list-group mb-4">

                            <li class="list-group-item">

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="f1">Data de Vencimento</label>
                                            <input type="text" class="form-control" id="f1" name="f1" value="{{ $company->f1 }}" aria-describedby="f1Help">
                                            <small id="f1Help" class="form-text text-muted">preencha</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="f2">Valor</label>
                                            <input type="text" class="form-control" id="f2" name="f2" value="{{ $company->f2 }}" aria-describedby="f2Help">
                                            <small id="f2Help" class="form-text text-muted">preencha</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="f3">Telefone</label>
                                            <input type="text" class="form-control" id="f3" name="f3" value="{{ $company->f3 }}" aria-describedby="f3Help">
                                            <small id="f3Help" class="form-text text-muted">preencha</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="f4">Email</label>
                                            <input type="text" class="form-control" id="f4" name="f4" value="{{ $company->f4 }}" aria-describedby="f4Help">
                                            <small id="f4Help" class="form-text text-muted">preencha</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-switch">
                                <input class="custom-control-input" type="checkbox" name="f5" value="1" id="f5" {{ $company->f5 ? 'checked' : null }}>
                                    <label class="custom-control-label" for="f5">
                                        Checar Faturamento
                                    </label>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label for="comments">Observações</label>
                                    <textarea class="form-control" id="comments" name="comments"rows="4">{{ $company->comments }}</textarea>
                                  </div>
                            </li>

                        </ul>

                        @endcan



                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <h4>Responsáveis(s)</h4>
                                </div>
                            </div>
                        </div>

                        <div>
                            @can('atribuir responsável')
                                <div class="inline">
                                    <div class="input-group">
                                        <select class="form-control" id="responsibleSelect">
                                            @foreach ($users as $user)
                                                <option value="{{ json_encode($user) }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="input-group-prepend">
                                            <button id="addButonResponsible" onclick="addSelectedResponsible()" class="btn btn-primary" type="button" class="btn btn-primary mb-2">Adicionar</button>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <table id="responsibleTable" class="table table-striped table-bordered table-hover dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Grupo</th>
                                    @can('atribuir responsável')
                                        <th scope="col">Açoes</th>
                                    @endcan
                                </thead>
                                <tbody>
                                    @foreach ($company->responsibles as $responsible)
                                        <tr id="responsible{{ $responsible->id }}">
                                            <td>{{ $responsible->user->name }}</td>
                                            <td>
                                                @foreach ($responsible->user->roles as $role)
                                                    {{ "{$role->name}, " }}
                                                @endforeach
                                            </td>

                                            @can('atribuir responsável')
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remover Responsável" onclick="removeResponsible('responsible{{ $responsible->id }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            @endcan

                                            <input type="hidden" name="responsibles[{{ $responsible->id }}][id]" value="{{ $responsible->id }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <br /><br />

                        <div class="d-flex justify-content-around">
                            @can('editar cliente')
                                <button type="submit" class="btn btn-primary" title="Salvar">
                                    <i class="fa fa-save"> Salvar</i>
                                </button>
                            @endcan

                            @can('excluir cliente')
                                <button type="button" class="btn btn-danger" title="Excluir" onclick="remove()">
                                    <i class="fa fa-trash"> Excluir</i>
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







    @can('excluir cliente')
        <form method="POST" id="removecompany" action="{{ route('companies.destroy', [$company]) }}">
            @method('DELETE')
            @csrf
        </form>
    @endcan


    <div class="modal fade" id="modal-activities" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">CNAE - Incluir Atividades</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group">
                        <input type="text" placeholder="Pesquisar..." class="form-control" id="searchcnae" name="searchcnae" aria-describedby="searchcnaeHelp">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="btn-searchcnae">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <small id="searchcnaeHelp" class="form-text text-muted mb-3">Pesquisa por código do CNAE ou termo</small>

                    <div class="input-group">
                        <select id="cnaelist" class="form-control" style="overflow-x:scroll" multiple size="7"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" id="btn-includecnae" class="btn btn-primary">Incluir</button>
                </div>
            </div>
        </div>
    </div>

    {{-- @if($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif --}}


@endsection

@section('js')
    <script>
        let tableCNAE = null;
        let tableResponsible = null;

        document.addEventListener("DOMContentLoaded", () => {

            tableCNAE = $('#table').DataTable({
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json'
                },
            });

            tableResponsible = $('#responsibleTable').DataTable({
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json'
                },
            });

            const form = document.querySelector('#frm_update');
            const sl_company_type = form.querySelector('#company_type');
            const sl_company_size = form.querySelector('#company_size');
            const sl_tax = form.querySelector('#tax');
            const sl_administration_type = form.querySelector('#administration_type_id');

            function typeTrigger() {
                const type_id = sl_company_type.value

                const disabler_sl = (cs, t, at) => {

                    const disable = (el, toggle) => el.disabled = toggle;
                    const hide = (el, toggle) => el.parentElement.style.display = toggle ? 'none' : 'block'

                    if (sl_company_size) {
                        disable(sl_company_size, cs)
                        hide(sl_company_size, cs);
                    }

                    if(sl_tax) {
                        disable(sl_tax, t)
                        hide(sl_tax, t);
                    }

                    if(sl_administration_type) {
                        disable(sl_administration_type, at)
                        hide(sl_administration_type, at);
                    }
                }

                if (type_id === '1') {
                    disabler_sl(true, true, true)
                } else if (['2', '3', '4', '5'].some(tId => tId === type_id)) {
                    disabler_sl(false, false, false);
                } else if (type_id === '6') {
                    disabler_sl(true, false, false);
                }
            }

            sl_company_type.addEventListener('change', typeTrigger);

            typeTrigger();

            $('#modal-activities').on('show.bs.modal', function() {

                const input = this.querySelector("#searchcnae");
                const btnSearch = this.querySelector("#btn-searchcnae");
                const btnInclude = this.querySelector("#btn-includecnae");
                const select = this.querySelector('#cnaelist');

                const searchCnae = () => {
                    const term = input.value.trim();

                    if(term.length < 3) { return; }

                    Swal.fire({
                        title: 'Pesquisando...',
                        toast: true,
                        didOpen: () => {
                            Swal.showLoading();

                            const headers = new Headers({Authorization: `Bearer {{ $token }}`});

                            fetch(`/api/cnaes/${term}`, { headers })
                                .then(response => response.json())
                                .then(({ data }) => {
                                    select.options.length = 0;

                                    data.map(({ id, code, description }) => {
                                        const option = new Option(
                                            `${code} - ${description}`,
                                            JSON.stringify({ id, code, description })
                                        );
                                        select.add(option);
                                    });

                                    Swal.close();
                                })
                                .catch(() => Swal.close());
                        },
                    });
                }

                const addSelectedCnae = () => {
                    if(select.value) {
                        const { id, code, description } = JSON.parse(select.value);

                        const newRow = tableCNAE
                                        .row
                                        .add([
                                            code,
                                            description,
                                            `<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remover CNAE" onclick="removeActivity('activity${id}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <input type="hidden" name="activities[]" value="${id}">`
                                        ])
                                        .draw()
                                        .node()
                                        .setAttribute('id', `activity${id}`);

                        select.value = null;
                        $(this).modal('hide');
                    }
                }

                select.addEventListener('dblclick', addSelectedCnae);
                btnInclude.addEventListener('click', addSelectedCnae);
                btnSearch.addEventListener('click', searchCnae);
                input.addEventListener('keydown', event => {
                    if (event.keyCode === 13) {
                        searchCnae();
                    }
                });
            });
        });

        @can('excluir cliente')
        function remove() {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir esta empresa?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                denyButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('removecompany').submit();
                }
            });
        }
        @endcan

        function removeActivity(rowID) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                denyButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    tableCNAE
                        .row(document.getElementById(rowID))
                        .remove()
                        .draw();
                }
            });
        }

        function removeResponsible(rowID) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Sim`,
                denyButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    tableResponsible
                        .row(document.getElementById(rowID))
                        .remove()
                        .draw();
                }
            });
        }

        function removeContacty(listID) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir este contato?',
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

        function addContacty() {
            const contactyList = document.getElementById('contacty-list');
            const hash = Date.now();
            contactyList.insertAdjacentHTML(
                'beforeend',
                `<li id="contacty${hash}" class="list-group-item list-group-item-action">
                    <button type="button" class="close" aria-label="Close" onclick="removeContacty('contacty${hash}')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="contactname${hash}">Nome</label>
                                <input type="text" class="form-control" id="contactname${hash}" name="contacts[${hash}][name]" value="" aria-describedby="contactname${hash}Help" required>
                                <small id="contactname${hash}Help" class="form-text text-muted">Nome completo, sem abreviações.</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="contactphone${hash}">Telefone</label>
                                <input type="tel" maxlength="15" class="form-control" id="contactphone${hash}" name="contacts[${hash}][phone]" value="" aria-describedby="contactphone${hash}Help" required>
                                <small id="contactphone${hash}Help" class="form-text text-muted">Ex: (xx) xxxxx-xxxx</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="contactemail${hash}">Email</label>
                                <input type="email" class="form-control" id="contactemail${hash}" name="contacts[${hash}][email]" value="" aria-describedby="contactemail${hash}Help" required>
                                <small id="contactemail${hash}Help" class="form-text text-muted">Ex: meu@email.com</small>
                            </div>
                        </div>
                    </div>
                </li>`
            );
        }

        function removePartiner(listID) {
            Swal.fire({
                title: 'Confirma?',
                text: 'Deseja realmente excluir este Proprietário/Sócio?',
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

        function addPartner() {
            const partnersList = document.getElementById('partners-list');
            const hash = Date.now();
            partnersList.insertAdjacentHTML(
                'beforeend',
                `<li id="partiner${hash}" class="list-group-item list-group-item-action">

                    <button type="button" class="close" aria-label="Close" onclick="removePartiner('partiner${hash}')">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="form-group">
                        <label for="partinername${hash}">Nome</label>
                        <input type="text" class="form-control" id="partinername${hash}" name="partners[${hash}][name]" value="" aria-describedby="partinername${hash}Help" required>
                        <small id="partinername${hash}Help" class="form-text text-muted">Informe o nome completo e sem abreviações</small>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="partinerphone${hash}">Telefone</label>
                                <input type="tel" class="form-control" id="partinerphone${hash}" name="partners[${hash}][phone]" value="" aria-describedby="partinerphone${hash}Help" required>
                                <small id="partinerphone${hash}Help" class="form-text text-muted">(xx) xxxxx-xxxx</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="partineremail${hash}">Email</label>
                                <input type="email" class="form-control" id="partineremail${hash}" name="partners[${hash}][email]" value="" aria-describedby="partineremail${hash}Help" required>
                                <small id="partineremail${hash}Help" class="form-text text-muted">Ex: (xx) xxxxx-xxxx</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="partinermarital_status${hash}">Estado Civíl</label>
                                <input type="text" class="form-control" id="partinermarital_status${hash}" name="partners[${hash}][marital_status]" value="" aria-describedby="partinermarital_status${hash}Help" required>
                                <small id="partinermarital_status${hash}Help" class="form-text text-muted">Mantenha Atualizado</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="partinerwedding_type${hash}">Tipo de Casamento</label>
                                <input type="text" class="form-control" id="partinerwedding_type${hash}" name="partners[${hash}][wedding_type]" value="" aria-describedby="partinerwedding_type${hash}Help">
                                <small id="partinerwedding_type${hash}Help" class="form-text text-muted">Ex: Comunhão parcial... Obs: Se não casado deixe em branco</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="partinernotary_public${hash}">Cartório(s) com Firma</label>
                        <input type="text" class="form-control" id="partinernotary_public${hash}" name="partners[${hash}][notary_public]" value="" aria-describedby="partinernotary_public${hash}Help" required>
                        <small id="partinernotary_public${hash}Help" class="form-text text-muted">Informo todos os cartórios, separadoros por vírgula.</small>
                    </div>

                    <div class="form-row">

                        <div class="col">
                            <div class="form-group">
                                <label for="partinernaturalness${hash}">Naturalidade</label>
                                <input type="text" class="form-control" id="partinernaturalness${hash}" name="partners[${hash}][naturalness]" value="" aria-describedby="partinernaturalness${hash}Help" required>
                                <small id="partinernaturalness${hash}Help" class="form-text text-muted">Lugar de nascimento.</small>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="partinerpro_labore${hash}">Pro Labore</label>
                                <input type="text" class="form-control" id="partinerpro_labore${hash}" name="partners[${hash}][pro_labore]" value="" aria-describedby="partinerpro_labore${hash}Help">
                                <small id="partinerpro_labore${hash}Help" class="form-text text-muted">Mantenha Atualizado</small>
                            </div>
                        </div>

                    </div>

                    <div class="custom-control custom-switch">
                        <input class="custom-control-input" type="checkbox" name="partners[${hash}][registered_federal_revenue]" value="1" id="partinerregistered_federal_revenue${hash}">
                        <label class="custom-control-label" for="partinerregistered_federal_revenue${hash}">
                            Representante na Receita Federal
                        </label>
                    </div>
                </li>`
            );
        }



        const addSelectedResponsible = () => {
            const selectResponsible = document.querySelector('#responsibleSelect');

            if(selectResponsible.value) {
                const { id, name, roles } = JSON.parse(selectResponsible.value);

                let rolesName = '';

                roles.forEach(role => {
                    rolesName += `${role.name}, `;
                })

                const hash = Date.now();

                const newRow = tableResponsible
                                .row
                                .add([
                                    name,
                                    rolesName,
                                    `<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remover Responsável" onclick="removeResponsible('responsible${hash}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <input type="hidden" name="responsibles[][user_id]" value="${id}">`
                                ])
                                .draw()
                                .node()
                                .setAttribute('id', `responsible${hash}`);
            }
        }

    </script>
@endsection
