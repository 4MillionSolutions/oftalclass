<?php

namespace App\Http\Controllers;

use App\Models\Indicacoes;
use Illuminate\Http\Request;
use Str;

class IndicacoesControleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $indicacoes = new Indicacoes();
        $indicacoes = $indicacoes->join('users', 'indicacoes.user_id', '=', 'users.id')
        ->join('status_indicacao', 'indicacoes.status_indicacao_id', '=', 'status_indicacao.id')
            ->select('indicacoes.*', 'users.name as user_name', 'status_indicacao.nome as status_nome');

        $id = !empty($request->input('codigo_indicacao')) ? ($request->input('codigo_indicacao')) : NULL ;

        if ($id) {
            $indicacoes = $indicacoes->where('users.id', '=', $id);
        }

        if ($request->input('nome') != '') {
        	$indicacoes = $indicacoes->where('users.name', 'like', '%'.$request->input('nome').'%');
        }

        if ($request->input('status_indicacao_id') != '') {

            $indicacoes = $indicacoes->where('indicacoes.status_indicacao_id', '=', $request->input('status_indicacao_id'));
        }

        if ($request->input('data_inicio') != '' && $request->input('data_fim') == '') {
            $indicacoes = $indicacoes->where('indicacoes.created_at', '>=', $request->input('data_inicio'). ' 00:00:00');
        }
        if ($request->input('data_fim') != '' && $request->input('data_inicio') == '') {
            $indicacoes = $indicacoes->where('indicacoes.created_at', '<=', $request->input('data_fim'). ' 23:59:59');
        }
        if ($request->input('data_inicio') != '' && $request->input('data_fim') != '') {
            $indicacoes = $indicacoes->whereBetween('indicacoes.created_at', [$request->input('data_inicio'). ' 00:00:00', $request->input('data_fim'). ' 23:59:59']);
        }

        $indicacoes = $indicacoes->get();
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
                'nome_tela' => 'indicações',
             	'indicacoes'=> $indicacoes,
				'request' => $request,
				'rotaIncluir' => 'incluir-indicacoes',
				'rotaAlterar' => 'alterar-indicacoes'
			);

        return view('indicacoes-controle', $data);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function incluir(Request $request)
    {

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function alterar(Request $request)
    {

    }

    public function salva($request) {
        $indicacoes = new Indicacoes();

        if($request->input('id')) {
            $indicacoes = $indicacoes::find($request->input('id'));
        }

        $indicacoes->nome = $request->input('nome');

        $indicacoes->save();


        return $indicacoes->id;

    }
}
