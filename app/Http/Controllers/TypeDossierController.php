<?php

namespace App\Http\Controllers;

use App\TypeDossier;
use Illuminate\Http\Request;

class TypeDossierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function  index(){
        $typedossiers=TypeDossier::where("is_delete",false)->get();
        return view("Admin.typedossier",compact("typedossiers"));
    }

    public function  store(Request $request){
      
        TypeDossier::create($request->all());
        Toastr()->success("Enregistrement Effectué");
        return redirect()->back()->withMessage("Enregistrement Effectué");
    }
}
