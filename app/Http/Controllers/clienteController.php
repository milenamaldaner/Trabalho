<?php
namespace App\Http\Controllers;
use App\Cliente;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //checa se o usuário está cadastrado
        if( Auth::check() ){   
            //retorna somente as Clientes cadastradas pelo usuário cadastrado
            $listaClientes = Cliente::where('id', Auth::id() )
                                                ->paginate(3);     
        }else{
            //retorna todas as atividades
            $listaClientes = Cliente::all();
        }
        
        return view('cliente.list',['clientes' => $listaClientes]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        }
    public function edit($id)
    {
        //busco os dados do obj Atividade que o usuário deseja editar
        $obj_Cliente = Cliente::find($id);
        
        //verifico se o usuário logado é o dono da Atividade
        if( Auth::id() == $obj_Cliente->id ){
            //retorno a tela para edição
            return view('cliente.edit',['cliente' => $obj_Cliente]);    
        }else{
            //retorno para a rota /atividades com o erro
            return redirect('/clientes')->withErrors("Você não tem permissão para editar este item");
        }
           
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //faço as validações dos campos
        //vetor com as mensagens de erro
        $messages = array(
            'nome.required' => 'É obrigatório um nome para o cliente',
            'cpf.required' => 'É obrigatória um cpf para a cliente',
            'telefone' => 'É obrigatório um telefone para o cliente',
            'endereço' => 'É obrigatório um endereço para o cliente',
            
        );
        //vetor com as especificações de validações
        $regras = array(
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:255',
            'telefone' => 'required|string|max:255'
            'endereço' => 'required|string|max:255',
            'scheduledto' => 'required|string',
        );
        //cria o objeto com as regras de validação
        $validador = Validator::make($request->all(), $regras,);
        //executa as validações
        if ($validador->fails()) {
            return redirect('clientes/$id/edit')
            ->withErrors($validador)
            ->withInput($request->all);
        }
        //se passou pelas validações, processa e salva no banco...
        $obj_atividade = Cliente::findOrFail($id);
        $obj_atividade->nome =       $request['nome'];
        $obj_atividade->cpf = $request['cpf'];
        $obj_atividade->telefone = $request['telefone'];
        $obj_atividade->endereço = $request['endereço'];
        
        $obj_atividade->id     = Auth::id();
        $obj_atividade->save();
        return redirect('/clientes')->with('success', 'CLiente alterado com sucesso!!');
    }
    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $obj_Cliente = Cliente::find($id);
        
        //verifico se o usuário logado é o dono da Cliente
        if( Auth::id() == $obj_Cliente->id ){
            //retorno o formulário questionando se ele tem certeza
            return view('cliente.delete',['cliente' => $obj_CLiente]);    
        }else{
            //retorno para a rota /atividades com o erro
            return redirect('/cliente')->withErrors("Você não tem permissão para deletar este item");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj_Cliente = CLiente::findOrFail($id);
        $obj_Cliente->delete($id);
        return redirect('/Clientes')->with('sucess','Cliente excluído com Sucesso!!');
    }
}