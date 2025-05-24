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
        <h1 class="m-0 text-dark col-sm-11 col-form-label">Indicações OftalClass</h1>
        <div class="col-sm-1">
            @include('layouts.nav-open-incluir', ['rotaIncluir => $rotaIncluir'])
        </div>
    </div>
    @stop
    @section('content')
    @extends('layouts.extra-content')
    <div class="right_col" role="main">

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
                <label for="compartilhar" class="col-sm-2 col-form-label">Compartilhe com seu amigos e familiares</label>
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

    @stop
@else
@section('content')
        
    @stop
@endif
