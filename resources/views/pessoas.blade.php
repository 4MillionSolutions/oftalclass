@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('content_header')
    @if(isset($tela) and $tela == 'pesquisa')
        <div class="form-group row">
            <h1 class="m-0 text-dark col-sm-11 col-form-label">Pesquisa de {{ $nome_tela }}</h1>
            <div class="col-sm-1">
                @include('layouts.nav-open-incluir', ['rotaIncluir' => $rotaIncluir])
            </div>
        </div>
    @endif
    <script src="../vendor/jquery/jquery.min.js?cache={{time()}}"></script>
    <script src="js/jquery.mask.js?cache={{time()}}"></script>
    <script src="js/main_custom.js?cache={{time()}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/adminlte-custom.css') }}">
@stop

@section('content_top_nav_left')
    @include('layouts.navbar_left')
@stop

@section('content')
@extends('layouts.extra-content')
@if(isset($tela) and $tela == 'pesquisa')
    <div class="right_col" role="main">
        <form id="filtro" action="pessoas" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Nome pessoa</label>
                <div class="col-sm-3">
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ $request->input('nome') ?? '' }}">
                </div>
                <label for="documento" class="col-sm-1 col-form-label">CPF</label>
                <div class="col-sm-2">
                    <input type="text" id="documento" name="documento" class="form-control mask_cpf_cnpj" value="{{ $request->input('documento') ?? '' }}">
                </div>
                <label for="status" class="col-sm-1 col-form-label">Situação</label>
                <div class="col-sm-2">
                    <select class="form-control" id="status" name="status">
                        <option value="A" {{ $request->input('status') == 'A' ? 'selected' : '' }}>Ativo</option>
                        <option value="I" {{ $request->input('status') == 'I' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
                <div class="col-sm-5">
                </div>
            </div>
        </form>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""></label>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h4>Encontrados</h4>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table class="table table-striped text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Email</th>
                      <th>Nascimento</th>
                      <th>Manutenção</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(isset($pessoas))
                        @foreach ($pessoas as $pessoa)
                            <tr>
                            <th scope="row" title="Editar pessoa"><a href={{ URL::route($rotaAlterar, array('id' => $pessoa->id )) }}>{{$pessoa->id}}</a></th>
                              <td>{{$pessoa->name}}</td>
                              <td class='mask_phone'>{{$pessoa->telefone}}</td>
                              <td>{{$pessoa->email}}</td>
                              <td>{{\Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y')}}</td>
                              <td title="Ir para atendimentos"><a href={{ URL::route('alterar-pessoas', array('id' => $pessoa->id )) }}><i class="fa fa-clipboard"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
@else
    <h1 class="m-0 text-dark">{{ $tela == 'alterar' ? 'Alteração de' : 'Inclusão de' }} {{ $nome_tela }}</h1>
    <form id="{{ $tela }}" action="{{ $tela == 'alterar' ? $rotaAlterar : $rotaIncluir }}" method="post">
        @csrf
        <div class="container">
            <div class="row row-cols-md-3 g-3">
                <div class="col-md-4">
                    <label for="pessoa" class="form-label">Nome*</label>
                    <input type="text" class="form-control" id="nome" name="nome" maxlength="200" required value="{{ $pessoas[0]->nome ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="documento" class="form-label">CPF*</label>
                    <input type="text" class="form-control mask_cpf_cnpj" id="documento" name="documento" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required placeholder="000.000.000-00" value="{{ $pessoas[0]->documento ?? '' }}" >
                    <small id="cpf-error" class="text-danger" style="display:none;">CPF inválido</small>
                </div>
                <div class="col-md-4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control mask_phone" id="telefone" name="telefone" maxlength="11" value="{{ $pessoas[0]->telefone ?? '' }}">
                </div>
            </div>
            <div class="row row-cols-md-3 g-3 mt-2">
                <div class="col-md-2">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ $pessoas[0]->data_nascimento ?? '' }}">
                </div>
                <div class="col-md-2">
                    <label for="genero" class="form-label">Gênero</label>
                    <select class="form-control" id="genero" name="genero">
                        <option value="0" {{ isset($pessoas[0]->genero) && $pessoas[0]->genero == '0' ? 'selected' : '' }}>Masculino</option>
                        <option value="1" {{ isset($pessoas[0]->genero) && $pessoas[0]->genero == '1' ? 'selected' : '' }}>Feminino</option>
                        <option value="2" {{ isset($pessoas[0]->genero) && $pessoas[0]->genero == '2' ? 'selected' : '' }}>Outro</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength="200" placeholder="Digite um email válido" value="{{ $pessoas[0]->email ?? '' }}">
                </div>

            </div>

            <div class="row row-cols-md-3 g-3 mt-2">
                <div class="col-md-4">
                    <label for="estado_civil" class="form-label">Estado civil</label>
                    <select class="form-control" id="estado_civil" name="estado_civil">
                        <option value="0" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '0' ? 'selected' : '' }}>Solteiro(a)</option>
                        <option value="1" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '1' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="2" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '2' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="3" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '3' ? 'selected' : '' }}>Viúvo(a)</option>
                        <option value="4" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '4' ? 'selected' : '' }}>Separado(a)</option>
                        <option value="5" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '5' ? 'selected' : '' }}>União Estável</option>
                        <option value="6" {{ isset($pessoas[0]->estado_civil) && $pessoas[0]->estado_civil == '6' ? 'selected' : '' }}>Outros</option>
                    </select>

                </div>
            </div>

            <div class="row row-cols-md-3 g-3 mt-2">

                <div class="col-md-8">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control " id="endereco" name="endereco" maxlength="500" value="{{ $pessoas[0]->endereco ?? '' }}">
                </div>
                <div class="col-md-1">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control " id="numero" name="numero" maxlength="20" value="{{ $pessoas[0]->numero ?? '' }}">
                </div>
                <div class="col-md-2">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control " id="complemento" name="complemento" maxlength="100" value="{{ $pessoas[0]->complemento ?? '' }}">
                </div>
            </div>
            <div class="row row-cols-md-3 g-3 mt-2">
                <div class="col-md-4">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control " id="bairro" name="bairro" maxlength="100" value="{{ $pessoas[0]->bairro ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" maxlength="150" value="{{ $pessoas[0]->cidade ?? '' }}">
                </div>
            </div>
            <div class="row row-cols-md-3 g-3 mt-2">
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="0" {{ isset($pessoas[0]->estado) && $pessoas[0]->estado == '' ? 'selected' : '' }}>Selecione</option>
                        @foreach ($estados as $estado)
                            <option value="{{ $estado['id'] }}" {{ isset($pessoas[0]->estado) && $pessoas[0]->estado == $estado['id'] ? 'selected' : '' }}>{{ $estado['estado'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control cep" id="cep" name="cep" maxlength="8" value="{{ $pessoas[0]->cep ?? '' }}">
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="A" {{ isset($pessoas[0]->status) && $pessoas[0]->status == 'A' ? 'selected' : '' }}>Ativo</option>
                        <option value="I" {{ isset($pessoas[0]->status) && $pessoas[0]->status == 'I' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>
            </div>
            <div class="row mt-4 text-center">
                <div class="col-md-12">
                    <button class="btn btn-danger mx-2" onclick="window.history.back();" type="button">Cancelar</button>
                    <button type="submit" class="btn btn-primary mx-2">Salvar</button>
                </div>
            </div>
        </div>
    </form>
@endif
@stop

@section('scripts')
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/main_custom.js"></script>
    <script src="{{ asset('js/validarAno.js') }}"></script>
@endsection
