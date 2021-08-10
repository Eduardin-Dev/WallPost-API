<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Auth;

class AuthController extends Controller
{

    public function index()
    {
        $usuario = Auth::all();
        return response()->json($usuario);

    }

    public function store(Request $request){

        try{
            $usuario = $request->validate([
                'ds_email' => 'required',
                'cd_senha' => 'required'
                ]);

                $usuario = DB::table('usuario')->where('ds_email', $request['ds_email'])->first();
                if($usuario == null)
                {
                    $erro = 'Não há Dados Cadastrados';
                    return response()->json($erro, 404);
                }else{
                    if (Hash::check($request->cd_senha, $usuario->cd_senha)) 
                    {
                        return response()-> json($usuario);
                       
                    }else
                    {
                        $erro = 'Erro senha inválida';
                        return response()->json($erro, 500);
                    }
                    
                }
               
    
        } catch ( \Throwable $th){

            return response()->json($th, 500);
        }
    }

}
