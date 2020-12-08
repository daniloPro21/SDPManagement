<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Faker\Provider\Person;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public  function  index(){
        $personnels = Personnel::orderBy("id","DESC")->get();
        return view("personnels.index",compact("personnels"));
    }

    public  function  store(Request $request){
        $personnel = Personnel::create($request->all());
        Toastr()->success("Enregistrement Effectué");
        return redirect()->back();
    }

    public  function  edit($id){
        $personnel = Personnel::findOrFail($id);
        return view("personnels.update",compact("personnel"));
    }

    public  function  update($id,Request $request){
        $personnel = Personnel::findOrFail($id);
        $personnel->update($request->all());
        Toastr()->success("Modification Effectué");
        return redirect()->route("personnel.index");
    }
}
