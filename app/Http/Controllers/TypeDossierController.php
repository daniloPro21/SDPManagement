<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeDossier;

class TypeDossierController extends Controller
{


    public function store(Request $request)
    {
      //dd($request->all());
      $data = $request->validate([
        'name' => 'required',
        'description' => 'required'
      ]);

      $type = new TypeDossier();
      $type->name = $data['name'];
      $type->description = $data['description'];
      $type->save();
      toastr()->success('Type de dossier ajouter avec success');
      return back();
    }
}
