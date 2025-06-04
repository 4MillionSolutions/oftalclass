@extends('adminlte::page')

@section('title', 'OftalClass')

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
        <h1 class="m-0 text-dark col-sm-11 col-form-label">Consulta de Indicações e cashbacks</h1>
    </div>
    @stop
    @section('content')
    @extends('layouts.extra-content')
    <div class="right_col" role="main">

        @csrf <!--{{ csrf_field() }}-->
            <form id="filtro" action="indicacoes-controle" method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <div class="form-group row">
                {{-- <label for="codigo_indicacao" class="col-sm-2 col-form-label text-right">Código de indicação</label>
                <div class="col-sm-1">
                    <input type="text" id="codigo_indicacao" name="codigo_indicacao" class="form-control" value="@if (isset($codigo_indicacao)){{$codigo_indicacao}}@else{{''}}@endif">
                </div> --}}
                <label for="nome" class="col-sm-1 col-form-label text-right">Nome</label>
                <div class="col-sm-3">
                    <input type="text" id="nome" name="nome" class="form-control" value="@if (isset($request) && trim($request->input('nome')) != ''){{$request->input('nome')}}@else @endif">
                </div>
                 <label for="status_indicacao_id" class="col-sm-2 col-form-label text-right">Status pagamento</label>
                <select class="form-control col-md-1" id="status_indicacao_id" name="status_indicacao_id">
                    <option value="" @if (isset($request) && $request->input('status_indicacao_id') == ''){{ ' selected '}}@else @endif>Selecione</option>
                    <option value="1" @if (isset($request) && $request->input('status_indicacao_id') == '1'){{ ' selected '}}@else @endif>Pendente</option>
                    <option value="2" @if (isset($request) && $request->input('status_indicacao_id')  == '2'){{ ' selected '}}@else @endif>Pago</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="data_inicio" class="col-sm-2 col-form-label text-right">Data inicial</label>
                <div class="col-sm-2">
                    <input type="date" id="data_inicio" name="data_inicio" class="form-control" value="@if (isset($request) && $request->input('data_inicio') != ''){{$request->input('data_inicio')}}@else @endif">
                </div>
                <label for="data_fim" class="col-sm-1 col-form-label text-right">Data final</label>
                <div class="col-sm-2">
                    <input type="date" id="data_fim" name="data_fim" class="form-control" value="@if (isset($request) && $request->input('data_fim') != ''){{$request->input('data_fim')}}@else @endif">
                </div>
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

            <div class="form-group row">
                <h2 class="m-0 text-dark">Encontrados</h2>
            </div>

            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Nome</th>
                        <th>Quem indicou?</th>
                        <th>Valor</th>
                        <th>Status pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($indicacoes))
                        @foreach ($indicacoes as $indicacao)
                            <tr>
                                <th scope="row"><a href={{ URL::route($rotaAlterar, array('id' => $indicacao->id )) }}>
                                    {{ $indicacao->created_at->format('d/m/Y') }}
                                </a></th>
                                <td>{{$indicacao->user_name}}</td>
                                <td>{{$indicacao->indicador_nome}}</td>
                                <td>{{ number_format($indicacao->valor, 2, ',', '.') }}</td>
                                <td class="@if($indicacao->status_id == 1) text-warning @elseif($indicacao->status_id == 2) text-success @endif text-bold">{{$indicacao->status_nome}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

    @stop
@else
    @section('content')
        @if($tela == 'alterar')
            @section('content_header')
                <h1 class="m-0 text-dark">Alteração de {{ $nome_tela }}</h1>
            @stop
            <form id="alterar" action="{{$rotaAlterar}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">

                <input type="hidden" id="id" name="id" class="form-control col-md-7 col-xs-12" value="@if (isset($indicacoes->id)){{$indicacoes->id}}@else{{''}}@endif">
                <div class="form-group row">
                    <label for="indicador_id" class="col-sm-2 col-form-label text-right">Código de indicação</label>
                    <div class="col-sm-2">
                    <input type="text" id="indicador_id" name="indicador_id" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($indicacoes->indicador_id)){{$indicacoes->indicador_id}}@else{{''}}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nome_indicador" class="col-sm-2 col-form-label text-right">Nome do indicador</label>
                    <div class="col-sm-6">
                        <input type="text" id="nome_indicador" name="nome_indicador" class="form-control" readonly="true" value="@if (isset($indicacoes->indicador_nome)){{$indicacoes->indicador_nome}}@else{{''}}@endif">
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
                <label for="data_indicacao" class="col-sm-2 col-form-label text-right">Data indicação</label>
                <div class="col-sm-3">
                    <input type="date" id="data_indicacao" name="data_indicacao" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($indicacoes->created_at)){{$indicacoes->created_at->format('Y-m-d')}}@else{{''}}@endif">
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label text-right">Nome</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nome"  name="nome" readonly="true" value="@if (isset($indicacoes->user_name)){{$indicacoes->user_name}}@else{{''}}@endif">
                </div>
            </div>
            <div class="form-group row">
                <label for="valor" class="col-sm-2 col-form-label text-right ">Valor</label>
                <div class="col-sm-2">
                    <input type="text" id="valor" name="valor" class="form-control col-md-7 col-xs-12 mask_valor" value="@if (isset($indicacoes->valor)){{number_format($indicacoes->valor, 2, ',', '.')}}@else{{''}}@endif">
                </div>
            </div>


            <div class="form-group row">
                <label for="status_indicacao_id" class="col-sm-2 col-form-label text-right">Status pagamento</label>
                <div class="col-sm-2">
                    <select class="form-control col-md-12" id="status_indicacao_id" name="status_indicacao_id">
                        <option value="" @if (isset($indicacoes->status_indicacao_id) && $indicacoes->status_indicacao_id == ''){{ ' selected '}}@else @endif>Selecione</option>
                        <option value="1" @if (isset($indicacoes->status_indicacao_id) && $indicacoes->status_indicacao_id == '1'){{ ' selected '}}@else @endif>Pendente</option>
                        <option value="2" @if (isset($indicacoes->status_indicacao_id) && $indicacoes->status_indicacao_id == '2'){{ ' selected '}}@else @endif>Pago</option>
                    </select>
                </div>
            </div>
             <div class="form-group row">
                <label for="observacao" class="col-sm-2 col-form-label text-right">Observação</label>
                <div class="col-sm-6">
                    <textarea id="observacao" name="observacao" class="form-control col-md-7 col-xs-12">@if (isset($indicacoes->observacao)){{$indicacoes->observacao}}@else{{''}}@endif</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
                <div class="col-sm-1">
                    <select class="form-control col-md-12" id="status" name="status">
                        <option value="A" @if (isset($indicacoes->status) && $indicacoes->status == 'A'){{ ' selected '}}@else @endif>Ativo</option>
                        <option value="I" @if (isset($indicacoes->status) && $indicacoes->status =='I'){{ ' selected '}}@else @endif>Inativo</option>
                    </select>
                </div>
            </div>
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
