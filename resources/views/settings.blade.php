@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('content_header')

        <div class="form-group row">
            <h1 class="m-0 text-dark col-sm-11 col-form-label">Conta</h1>
        </div>

    <script src="../vendor/jquery/jquery.min.js?cache={{time()}}"></script>
    <script src="../js/jquery.mask.js?cache={{time()}}"></script>
    <script src="{{ asset('js/main_custom.js') }}"></script>
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
        <div class="right_col" role="main">
            <form action="alterar-senha" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                <div class="container">
                    <div class="row row-cols-md-3 g-3">
                        <div class="col-md-4">
                            <label for="pessoa" class="form-label">Nome*</label>
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="200" required value="{{ $user->name ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="documento" class="form-label">CPF*</label>
                            <input type="text" class="form-control mask_cpf_cnpj" id="documento" name="documento" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required placeholder="000.000.000-00" value="{{ $user->documento ?? '' }}" >
                            <small id="cpf-error" class="text-danger" style="display:none;">CPF inválido</small>
                        </div>
                        <div class="col-md-4">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control mask_phone" id="telefone" name="telefone" maxlength="11" value="{{ $user->telefone ?? '' }}">
                        </div>
                    </div>
                    <div class="row row-cols-md-3 g-3 mt-2">
                        <div class="col-md-4">
                            <label for="chave_pix" class="form-label" title="Seu pix para depósitos de cashback">Seu pix</label>
                            <input type="text" class="form-control" id="chave_pix" name="chave_pix" maxlength="11" value="{{ $user->chave_pix ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ $user->data_nascimento ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label for="genero" class="form-label">Gênero</label>
                            <select class="form-control" id="genero" name="genero">
                                <option value="" {{ !isset($user->genero) ? 'selected' : '' }}>Selecione</option>
                                <option value="0" {{ isset($user->genero) && $user->genero == '0' ? 'selected' : '' }}>Masculino</option>
                                <option value="1" {{ isset($user->genero) && $user->genero == '1' ? 'selected' : '' }}>Feminino</option>
                                <option value="2" {{ isset($user->genero) && $user->genero == '2' ? 'selected' : '' }}>Outro</option>
                            </select>
                        </div>



                    </div>

                    <div class="row row-cols-md-3 g-3 mt-2">

                        <div class="col-md-8">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control " id="endereco" name="endereco" maxlength="500" value="{{ $user->endereco ?? '' }}">
                        </div>
                        <div class="col-md-1">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control " id="numero" name="numero" maxlength="20" value="{{ $user->numero ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control " id="complemento" name="complemento" maxlength="100" value="{{ $user->complemento ?? '' }}">
                        </div>
                    </div>
                    <div class="row row-cols-md-3 g-3 mt-2">
                        <div class="col-md-4">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control " id="bairro" name="bairro" maxlength="100" value="{{ $user->bairro ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" maxlength="150" value="{{ $user->cidade ?? '' }}">
                        </div>
                    </div>
                    <div class="row row-cols-md-3 g-3 mt-2">
                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="0" {{ isset($user->estado) && $user->estado == '' ? 'selected' : '' }}>Selecione</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado['id'] }}" {{ isset($user->estado) && $user->estado == $estado['id'] ? 'selected' : '' }}>{{ $estado['estado'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control cep" id="cep" name="cep" maxlength="8" value="{{ $user->cep ?? '' }}">
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="A" {{ isset($user->status) && $user->status == 'A' ? 'selected' : '' }}>Ativo</option>
                                <option value="I" {{ isset($user->status) && $user->status == 'I' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" readonly name="email" value='{{ $user->email }}' placeholder="Email">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="password" value='' placeholder="Senha">
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
        </div>
    </div>
    @stop
