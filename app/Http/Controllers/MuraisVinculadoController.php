<?php

namespace App\Http\Controllers;

use App\Models\MuraisVinculado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MuraisVinculadoController extends Controller
{

    public function store(Request $request)
    {
        try {

            $exist = DB::table('murais_vinculados')->where('idmural', '=', $request->idmural)->where('idusuario', '=', $request->idusuario)->get();

            if (sizeof($exist) == 0) {

                $vinculo = new MuraisVinculado();
                $vinculo->fill($request->all());
                $vinculo->save();

                return response()->json($vinculo, 201);
            }

            return response()->json($exist, 400);
        } catch (\Throwable $th) {

            return response()->json($th, 500);
        }
    }

    public function destroy(Request $request)
    {
        try {

            DB::table('murais_vinculados')->where('idmural', '=', $request->idmural)->where('idusuario', '=', $request->idusuario)->delete();

            return response()->json(['Desvinculado']);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
