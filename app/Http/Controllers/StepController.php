<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;

class StepController extends Controller
{
    public function store(Request $request){
        $step = new Step;
        $step->dossier_id=$request->dossier_id;
        $step->type=$request->type;
        $step->message=nl2br($request->message);
        $step->user_id=auth()->user()->id;
        $step->save();

        return redirect()->back()->withMessage("Insertion Terminée");
    }

    public function destroy($id){
      Step::destroy($id);

      return redirect()->back()->withMessage("Supression Terminée");
    }
}
