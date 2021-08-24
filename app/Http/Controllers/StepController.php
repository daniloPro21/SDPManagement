<?php

namespace App\Http\Controllers;

use App\Dossier;
use http\Client;
use Illuminate\Http\Request;
use App\Step;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Exceptions\ConfigurationException;

class StepController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

        $dossier = Dossier::find($request->dossier_id);
        $step = new Step;
        $step->dossier_id=$request->dossier_id;
        $step->type=$request->type;
        $step->message=nl2br($request->message);
        $step->user_id=auth()->user()->id;
        $step->save();

        if ($step->type == "warning" || $step->type == "success") {

            $msg=strtoupper("SDP MINSANTE")."\n \n".strtoupper("Service Du Personnel")  ."\n \n".strtoupper("Notification sur votre dossier"). " \n  M\Mme  ".$step->dossier->prenom."".$step->dossier->nom."  \n".$request->message.
                " Le "
                .\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $step->created_at)->format("d/m/Y")."  \n \n";

            /*Nexmo::message()->send([
                'to'   => $dossier->telephone,
                'from' => 'MINSANTE',
                'text' => $msg
            ]);*/
            $this->sendMessage($msg, "+237693468041");
        }
        Toastr()->success("Enregistrement Effectué");

        return redirect()->back();
    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        try {
            $client = new \Twilio\Rest\Client($account_sid, $auth_token);
        } catch (ConfigurationException $e) {
            return $e->getMessage();
        }
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message] );
    }
    public function destroy($id){
      Step::destroy($id);
      Toastr()->success("Supression Terminée");
      return redirect()->back();
    }
}
