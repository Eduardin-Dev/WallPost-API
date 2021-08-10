<?php

namespace App\Http\Controllers;

use App\Models\MuraisVinculado;
use App\Models\Mural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MuralController extends Controller
{
    public function index()
    {
        $murais = Mural::all();

        return response()->json($murais);
    }

    public function store(Request $request)
    {

        try {

            $mural = DB::table('mural')->where('cd_chave', $request['cd_chave'])->first();

            $mural = $mural->idmural;

            return response()->json($mural);
        } catch (\Throwable $th) {

            return response()->json($th, 500);
        }
    }

    public function show($id)
    {

        $murais = Mural::find($id);
        if (!$murais) {
            return response()->json(['message' => 'Mural não encontrado - id:' . $id], 404);
        }
        return response()->json($murais);
    } //show


    public function muralPosts($id)
    {

        $posts = Mural::with(['usuario', 'posts'])->get()->find($id);

        return response()->json($posts);
    } //Posts do Mural
    
        public function muralQr(Request $request)
    {

        try {

            $id = base64_decode($request->idmural);

            $mural = Mural::find($id);

            if ($mural->ic_public == 1) {
                return response()->json($id);
            }

            if ($mural->ic_public == 2) {
                return ['privado'];
            }

        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    } //Mural QrCode

}
