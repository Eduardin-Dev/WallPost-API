<?php

namespace App\Http\Controllers;

use App\Models\MuraisVinculado;
use App\Models\Mural;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }

    public function store(Request $request)
    {

        try {

            $usuario = $request->validate([
                'ds_email' => 'unique:Usuario,ds_email'
            ]);

            $usuario = new Usuario();

            $usuario->fill($request->all());
            $usuario['cd_senha'] = Hash::make($usuario['cd_senha']);
            $usuario->save();


            return response()->json($usuario, 201);
        } catch (\Throwable $th) {

            return response()->json($th, 500);
        }
    } //store

    public function show($id)
    {

        $user = Usuario::all()->find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario não encontrado - id:' . $id], 404);
        }
        return response()->json($user);
    } //show



    public function update(Request $request, $id)
    {

        try {

            if(Usuario::where('ds_email', '=', $request->ds_email)->count() == 2){
                return ['retorno' => 'Email ja existe!'];
            }

            if($request->imagem_user == '' || $request->imagem_user == null){



                $user = Usuario::find($id);

                $user->nm_usuario = $request->nm_usuario;
                $user->ds_email = $request->ds_email;
                $user->ds_celular = $request->ds_celular;

                $user->save();

                $usuarioAtualizado = Usuario::find($id);

                return ['Atualizado' => $usuarioAtualizado];
    
            }

            Usuario::findOrFail($id)->update($request->all());

            $usuarioAtualizado = Usuario::find($id);


            return ['Atualizado' => $usuarioAtualizado];
        } catch (\Throwable $th) {

            return response()->json($th, 500);
        }
    } //Update
    
    
        public function updateSenha(Request $request, $id){

        try {

            $usuario = Usuario::all()->find($id);

            if(!Hash::check($request->cd_senha, $usuario->cd_senha)){
                return response()->json(['Senha errada'], 400);
            }
            
            $novaSenha = Hash::make($request->cd_novasenha);

            Usuario::findOrFail($id)->update(['cd_senha' => $novaSenha]);

            return response()->json(['Senha alterada!']);

        } catch (\Throwable $th) {
            
            return response()->json($th, 400);
        }
    }// UPDATE DA SENHA


    public function muraisVinculados($id)
    {

        $muraisVinculados = MuraisVinculado::with('mural')->where('idusuario', $id)->get();

        if (!$muraisVinculados) {
            return response()->json(['message' => 'Erro ao buscar murais vinculados']);
        }

        return response()->json(['murais_vinculados' => $muraisVinculados]);
    } // Murais Vinculados

}
