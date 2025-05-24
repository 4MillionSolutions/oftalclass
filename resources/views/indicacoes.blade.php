@extends('adminlte::page')

@section('title', 'Pro Effect')

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/bootstrap.4.6.2.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/main_custom.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@section('adminlte_css')    
    <link rel="stylesheet" href="{{ asset('css/adminlte-custom.css') }}">
@stop

@section('content_top_nav_left')
    @include('layouts.navbar_left')
@stop

@if(isset($tela) and $tela == 'pesquisa')
    @section('content_header')
    <div class="form-group row">
        <h1 class="m-0 text-dark col-sm-11 col-form-label">Pesquisa de {{ $nome_tela }}</h1>
        <div class="col-sm-1">
            @include('layouts.nav-open-incluir', ['rotaIncluir => $rotaIncluir'])
        </div>
    </div>
    @stop
    @section('content')
    @extends('layouts.extra-content')
    <div class="right_col" role="main">

        <form id="filtro" action="indicacoes" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <div class="form-group row">
                <label for="id" class="col-sm-1 col-form-label">Código</label>
                <div class="col-sm-2">
                    <input type="text" id="id" name="id" class="form-control" value="@if (isset($request) && $request->input('id') != ''){{$request->input('id')}}@else @endif">
                </div>
                
                <label for="status" class="col-sm-1 col-form-label">Situação</label>
                <select class="form-control col-md-1" id="status" name="status">
                    <option value="A" @if (isset($request) && $request->input('status') == 'A'){{ ' selected '}}@else @endif>Ativo</option>
                    <option value="I" @if (isset($request) && $request->input('status')  == 'I'){{ ' selected '}}@else @endif>Inativo</option>
                </select>
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
                    </tr>
                  </thead>
                  <tbody>
                  @if(isset($indicacoes))
                        @foreach ($indicacoes as $indicacao)
                            <tr>
                            <th scope="row"><a href={{ URL::route($rotaAlterar, array('id' => $indicacao->id )) }}>{{$indicacao->id}}</a></th>
                              <td>{{$indicacao->id}}</td>
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

    @stop
@else
@section('content')
        @if($tela == 'alterar')
            @section('content_header')
                <h1 class="m-0 text-dark">Alteração de {{ $nome_tela }}</h1>
            @stop
            <form id="alterar" action="{{$rotaAlterar}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
            <div class="form-group row">
                <label for="codigo" class="col-sm-2 col-form-label">Id</label>
                <div class="col-sm-2">
                <input type="text" id="id" name="id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($indicacoes[0]->id)){{$indicacoes[0]->id}}@else{{''}}@endif">
                </div>
            </div>
        @else
            @section('content_header')
                <h1 class="m-0 text-dark">Inclusão de {{ $nome_tela }}</h1>
            @stop
            <form id="incluir" action="{{$rotaIncluir}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
        @endif
            @csrf <!--{{ csrf_field() }}-->
            <div class="form-group row">
                <label for="link" class="col-sm-2 col-form-label">Link de indicação</label>
                <div class="col-sm-6">
                    <input type="text" id="link" name="link" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($link)){{$link}}@else{{''}}@endif">
                </div>
            </div>
            <div class="form-group row">
                <label for="codigo_indicacao" class="col-sm-2 col-form-label">Código de indicação</label>
                <div class="col-sm-6">
                    <input type="text" id="codigo_indicacao" name="codigo_indicacao" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($codigo_indicacao)){{$codigo_indicacao}}@else{{''}}@endif">
                </div>
            </div>

            <!-- botão para compartichar o link por whatsApp -->
            <div class="form-group row">
                <label for="compartilhar" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-success" id="compartilhar" onclick="compartilharLink()">
                        <i class="fas fa-share"></i> Compartilhar
                    </button>
                </div>



            </div>

            <div class="form-group row">
                <h2 class="m-0 text-dark">Meus cashbacks</h2>
            </div>

            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($indicacoes))
                        @foreach ($indicacoes as $indicacao)
                            <tr>
                            <th scope="row"><a href={{ URL::route($rotaAlterar, array('id' => $indicacao->id )) }}>{{$indicacao->id}}</a></th>
                              <td>{{$indicacao->id}}</td>
                              </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="form-group row">
                <div class="col-sm-5">
                    <button class="btn btn-danger" onclick="window.history.back();" type="button">Cancelar</button>
                </div>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>

    @stop
@endif
