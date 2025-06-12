@extends('adminlte::page')

@section('title', 'OftalClass')

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/bootstrap.4.6.2.js"></script>
<script src="js/main_custom.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/adminlte-custom.css') }}">
@stop

@section('content_top_nav_left')
    @include('layouts.navbar_left')
@stop

@section('content')
    <div class="right_col" role="main">
        <div class="form-group row">
            <h1 class="m-0 text-dark col-sm-11 col-form-label">Bem-vindo ao OftalClass</h1>
            <div class="col-sm-1">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid">
            </div>
        </div>


<div class="form-group row">
    @if(!empty($indicacoes[0]->chave_pix))
            <label for="link" class="col-sm-2 col-form-label  text-right">Link de indicação</label>
                <div class="col-sm-6">
                    <input type="text" id="link" name="link" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($link)){{$link}}@else{{''}}@endif">
                </div>
            </div>
            <div class="form-group row">
                <label for="codigo_indicacao" class="col-sm-2 col-form-label  text-right">Código de indicação</label>
                <div class="col-sm-6">
                    <input type="text" id="codigo_indicacao" name="codigo_indicacao" class="form-control col-md-7 col-xs-12" readonly="true" value="@if (isset($codigo_indicacao)){{$codigo_indicacao}}@else{{''}}@endif">
                </div>
            </div>            <div class="form-group row">
                <label for="compartilhar" class="col-sm-4 col-form-label text-right">Compartilhe com seu amigos e familiares</label>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-success" id="compartilhar" onclick="compartilharLink()">
                        <i class="fas fa-share"></i> Compartilhar
                    </button>
                </div>
            </div>
        @else
        {{-- link para cadastro na rota admin/settings --}}
        <a href="{{ route('settings') }}" class="btn btn-primary mb-3">
            <i class="fas fa-cog"></i> Cadastre seu Pix para poder compartilhar
        </a>
    @endif
    </div>
@stop
