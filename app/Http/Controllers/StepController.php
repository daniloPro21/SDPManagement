<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Step;
use Nexmo\Laravel\Facade\Nexmo;

class StepController extends Controller
{
    public function store(Request $request){

        $step = new Step;
        $step->dossier_id=$request->dossier_id;
        $step->type=$request->type;
        $step->message=nl2br($request->message);
        $step->user_id=auth()->user()->id;
        $step->save();

        if ($step->type == "warning" || $step->type == "success") {

            $msg="Ministère de la santé publique \n \n Service Du Personnel  \n Monsieur".$step->dossier->prenom." ".$step->dossier->nom." \n".$request->message.
                " Le "
                .Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $step->created_at)->format("d/m/Y")." ";

            Nexmo::message()->send([
                'to'   => '237673151975',
                'from' => 'MINSANTE',
                'text' => $msg
            ]);
        }
        Toastr()->success("Enregistrement Effectué");

        return redirect()->back()->withMessage("Insertion Terminée");
    }

    public function destroy($id){
      Step::destroy($id);

      return redirect()->back()->withMessage("Supression Terminée");
    }
}
