<?php

namespace App\Http\Controllers;

use App\Models\Indicacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class IndicacoesController extends Controller
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

        $logged_user = Auth::user();
        $logged_user_id = $logged_user->id;

        $indicacoes = new Indicacoes();
        $indicacoes = $indicacoes->join('users', 'indicacoes.user_id', '=', 'users.id')
            ->join('status_indicacao', 'indicacoes.status_indicacao_id', '=', 'status_indicacao.id')
            ->select('indicacoes.*', 'users.name as user_name', 'status_indicacao.nome as status_nome');

        $indicacoes = $indicacoes->where('user_id', '=', $logged_user_id);
        $url_do_site = env('APP_URL');

        $indicacoes = $indicacoes->get();
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
                'nome_tela' => 'indicações',
                'link' => $url_do_site.'/register?codigo='.$logged_user_id,
                'codigo_indicacao' => $logged_user_id,
				'indicacoes'=> $indicacoes,
				'request' => $request,
				'rotaIncluir' => 'incluir-indicacoes',
				'rotaAlterar' => 'alterar-indicacoes'
			);

        return view('indicacoes', $data);
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
