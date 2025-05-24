<?php

namespace App\Http\Controllers;

use App\Models\Indicacoes;
use Illuminate\Http\Request;
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
        $indicacoes = new Indicacoes();

        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        if ($id) {
            $indicacoes = $indicacoes->where('id', '=', $id);
        }

        if ($request->input('nome') != '') {
        	$indicacoes = $indicacoes->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $logged_user = \Auth::user();
        $logged_user_id = $logged_user->id;
        $logged_user_name = $logged_user->name;
        $codigo_indicacao = $logged_user_id;
        $url_do_site = env('APP_URL');

        $indicacoes = $indicacoes->get();
        $tela = 'pesquisa';
    	$data = array(
				'tela' => $tela,
                'nome_tela' => 'indicações',
                'link' => $url_do_site.'/indicacoes/'.$logged_user_name.'/'.$logged_user_id,
                'codigo_indicacao' => $codigo_indicacao,
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
