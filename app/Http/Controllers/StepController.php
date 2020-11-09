<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use Nexmo\Laravel\Facade\Nexmo;

class StepController extends Controller
{
    public function store(Request $request){
      if ($request->type == "warning" || $request->type == "success") {
        Nexmo::message()->send([
          'to'   => '237673151975',
          'from' => 'SDP MINSANTE',
          'text' => $request->message
      ]);
      }

        $step = new Step;
        $step->dossier_id=$request->dossier_id;
        $step->type=$request->type;
        $step->message=nl2br($request->message);
        $step->user_id=auth()->user()->id;
        $step->save();
        Toastr()->success("Enregistrement Effectué");

        return redirect()->back()->withMessage("Insertion Terminée");
    }

    public function destroy($id){
      Step::destroy($id);

      return redirect()->back()->withMessage("Supression Terminée");
    }
}
