<?php

namespace App\Http\Controllers;

use App\Models\Filmes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FilmesController extends Controller
{

    public function showHome(){
        return view('Home');
    }

    //cadastrar
    function CadastrarFilme(Request $request){

        $registros = $request->validate([
            'nomeFilme'=>'string|required',
            'duracaoFilme'=>'string|required',
            'roteiristaFilme'=>'string|required',
            'clssidadeFilme'=>'string|required'
        ]);

        Filmes::create($registros);
        return Redirect::route('/');
    }

    //deletar
    public function destroy(Filmes $id){
        $id->delete();
        return view('Home');
    }

    //alterar
    public function update(Filmes $id, Request $request){
        $registros = $request->validate([
            'nomeFilme'=>'string|required',
            'duracaoFilme'=>'string|required',
            'roteiristaFilme'=>'string|required',
            'clssidadeFilme'=>'string|required'
        ]);
        $id->fill($registros);
        $id->save();
        return view('');
    }

    //mostra os Filmes
    public function ShowFilmes(Request $request){
        $registros = Filmes::query();
        $registros->when($request->nome,function($query,$valor){
            $query->where('nome','like','%'.$valor.'%');
        });
        $todosRegistros = $registros->get();
        return view('',['registrosFilmes'=>$todosRegistros]);
    }

    public function mostrarAgendaId(Agenda $id){
        return view('',['registrosFilmes'=>$id]);
    }
}
