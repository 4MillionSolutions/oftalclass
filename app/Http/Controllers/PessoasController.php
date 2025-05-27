<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;

class PessoasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id = !empty($request->input('id')) ? ($request->input('id')) : ( !empty($id) ? $id : false );

        $pessoas = new User();

        if ($id) {
            $pessoas = $pessoas->where('id', '=', $id);
        }

        if (!empty($request->input('status'))){
            $pessoas = $pessoas->where('status', '=', $request->input('status'));
        } else {
            $pessoas = $pessoas->where('status', '=', 'A');
        }

        if (!empty($request->input('documento'))) {
            $documento = preg_replace("/[^0-9]/", "", $request->input('documento'));
            $pessoas = $pessoas->where('documento', '=', $documento);
        }

        if (!empty($request->input('nome'))) {
            $pessoas = $pessoas->where('nome', 'like', '%'.$request->input('nome').'%');
        }

        $pessoas = $pessoas->get();
        $tela = 'pesquisa';
        $data = array(
            'tela' => $tela,
            'nome_tela' => 'pessoas',
            'estados' => collect($this->getEstados())->toBase(),
            'pessoas'=> $pessoas,
            'request' => $request,
            'rotaIncluir' => 'incluir-pessoas',
            'rotaAlterar' => 'alterar-pessoas'
        );

        return view('pessoas', $data);
    }

    public function incluir(Request $request)
    {
        $metodo = $request->method();

        if ($metodo == 'POST') {
            $paciente_id = $this->salva($request);
            return redirect()->route('pessoas', [ 'id' => $paciente_id ] );
        }

        // dd(collect($this->getEstados())->toBase());

        $tela = 'incluir';
        $data = array(
            'tela' => $tela,
            'nome_tela' => 'pessoas',
            'estados' => collect($this->getEstados())->toBase(),
            'request' => $request,
            'rotaIncluir' => 'incluir-pessoas',
            'rotaAlterar' => 'alterar-pessoas'
        );

        return view('pessoas', $data);
    }

    public function alterar(Request $request)
    {
        $pessoas = new User();
        $paciente = $pessoas->where('id', '=', $request->input('id'))->get();

        $metodo = $request->method();
        if ($metodo == 'POST') {
            $paciente_id = $this->salva($request);
            return redirect()->route('pessoas', [ 'id' => $paciente_id ] );
        }


        $tela = 'alterar';
        $data = array(
            'tela' => $tela,
            'nome_tela' => 'pessoas',
            'pessoas'=> $paciente,
            'estados' => collect($this->getEstados())->toBase(),
            'request' => $request,
            'rotaIncluir' => 'incluir-pessoas',
            'rotaAlterar' => 'alterar-pessoas'
        );

        return view('pessoas', $data);
    }

    public function salva($request) {
        $documento = preg_replace("/[^0-9]/", "", $request->input('documento'));
        $pessoas = pessoas::where('documento', $documento)->first();

        if (!$pessoas) {
            $pessoas = new User();
        }

        // Associar o paciente à clínica selecionada na sessão
        $clinica_id = session('clinica_id');
        if ($clinica_id) {
            $pessoas->clinica_id = $clinica_id;
        }


        $pessoas->nome = $request->input('nome');
        $pessoas->telefone = preg_replace("/[^0-9]/", "", $request->input('telefone'));
        $pessoas->documento = $documento;
        $pessoas->data_nascimento = $request->input('data_nascimento');
        $pessoas->genero = $request->input('genero');
        $pessoas->estado_civil = $request->input('estado_civil');
        $pessoas->numero = $request->input('numero');
        $pessoas->complemento = $request->input('complemento');
        $pessoas->telefone = preg_replace("/[^0-9]/", "", $request->input('telefone'));
        $pessoas->cep = $request->input('cep');
        $pessoas->endereco = $request->input('endereco');
        $pessoas->bairro = $request->input('bairro');
        $pessoas->cidade = $request->input('cidade');
        $pessoas->email = $request->input('email');
        $pessoas->status = $request->input('status');

        $pessoas->save();

        return $pessoas->id;
    }

    public function getEstados() {
       return [
            ['id' =>1,
            'sigla'=>'AC',
             'estado'=>'Acre',
       ],
            ['id' =>2,
            'sigla'=>'AL',
             'estado'=>'Alagoas',
       ],
            ['id' =>3,
            'sigla'=>'AP',
             'estado'=>'Amapá',
       ],
            ['id' =>4,
            'sigla'=>'AM',
             'estado'=>'Amazonas',
       ],
            ['id' =>5,
            'sigla'=>'BA',
             'estado'=>'Bahia',
       ],
            ['id' =>6,
            'sigla'=>'CE',
             'estado'=>'Ceará',
       ],
            ['id' =>7,
            'sigla'=>'DF',
             'estado'=>'Distrito Federal',
       ],
            ['id' =>8,
            'sigla'=>'ES',
             'estado'=>'Espírito Santo',
       ],
            ['id' =>9,
            'sigla'=>'GO',
             'estado'=>'Goiás',
       ],
            ['id' =>10,
            'sigla'=>'MA',
             'estado'=>'Maranhão',
       ],
       [
            'id' =>11,
            'sigla'=>'MT',
             'estado'=>'Mato Grosso',
       ],
            ['id' =>12,
            'sigla'=>'MS',
             'estado'=>'Mato Grosso do Sul',
       ],
            ['id' =>13,
            'sigla'=>'MG',
             'estado'=>'Minas Gerais',
       ],
            ['id' =>14,
            'sigla'=>'PA',
             'estado'=>'Pará',
       ],
            ['id' =>15,
            'sigla'=>'PB',
             'estado'=>'Paraíba',
       ],
            ['id' =>16,
            'sigla'=>'PR',
             'estado'=>'Paraná',
       ],
            ['id' =>17,
            'sigla'=>'PE',
             'estado'=>'Pernambuco',
       ],
            ['id' =>18,
            'sigla'=>'PI',
             'estado'=>'Piauí',
       ],
            ['id' =>19,
            'sigla'=>'RJ',
             'estado'=>'Rio de Janeiro',
       ],
            ['id' =>20,
            'sigla'=>'RN',
             'estado'=>'Rio Grande do Norte',
       ],
            ['id' =>21,
            'sigla'=>'RS',
             'estado'=>'Rio Grande do Sul',
       ],
            ['id' =>22,
            'sigla'=>'RO',
             'estado'=>'Rondônia',
       ],
            ['id' =>23,
            'sigla'=>'RR',
             'estado'=>'Roraima',
       ],
            ['id' =>24,
            'sigla'=>'SC',
             'estado'=>'Santa Catarina',
       ],
            ['id' =>25,
            'sigla'=>'SP',
             'estado'=>'São Paulo',
       ],
            ['id' =>26,
            'sigla'=>'SE',
             'estado'=>'Sergipe',
       ],
           [  'id' =>27,
           'sigla'=>'TO',
           'estado'=> 	'Tocantins'
           ]
        ];
    }

    public function getAllUser() {
        $pessoas = new User();
        $query = $pessoas->where('status', '=', 'A');

        return $query->get();
    }
}
