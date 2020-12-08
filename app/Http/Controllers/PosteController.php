<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Toastr;

class PosteController extends Controller
{
    public  function  index(){
        $postes = Poste::orderBy("id","DESC")->get();
        return view("postes.index",compact("postes"));
    }

    public  function  store(Request $request){
        $poste = Poste::create($request->all());
        Toastr()->success("Enregistrement Effectué");
        return redirect()->back();
    }

    public  function  edit($id){
        $poste = Poste::findOrFail($id);
        return view("postes.update",compact("poste"));
    }

    public  function  update($id,Request $request){
        $poste = Poste::findOrFail($id);
        $poste->update($request->all());
        Toastr()->success("Modification Effectué");
        return redirect()->route("poste.index");
    }
}
