<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\DossierTransmi;
use App\Models\FicheAffectation;
use App\Transmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class TransmissionController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $transmission = Transmission::where('etat', 'ouvert')
            ->where('service_id', auth()->user()->service_id)
            ->where('is_delete', false)
            ->OrderBy('id')
            ->paginate(21);
        return  view('Transmission.transmission', compact('transmission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $data = $request->validate(array(
            'service' => 'required',
            'analyse' => 'required',
            'entete' => 'required',
            'numero' => 'required',
            'observation' => 'required',
            'date' => 'required'
        ));
        $transmission = Transmission::where("numero", $data["numero"])->first();
        if($transmission){
            Transmission::where("numero", $data["numero"])->update($data);
            Toastr()->success("Mise a Effectué","Terminé");
        }else{
            $transmission = new Transmission();
            $transmission->service = $data['service'];
            $transmission->analyse = $data['analyse'];
            $transmission->numero = $data['numero'];
            $transmission->entete = $data['entete'];
            $transmission->service_id = auth()->user()->service_id;
            $transmission->observation = $data['observation'];
            $transmission->date = $data['date'];
            $transmission->etat = 'ouvert';
            $transmission->is_delete = false;
            $transmission->save();

            Toastr()->success("Enregistrement Effectué","terminé");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $transmissions = Transmission::findOrfail($id);
        $transmissionDossier = DossierTransmi::with('dossiers')
                                ->where('transmission_id', $id)->get();
        return view('Transmission.show', compact('transmissions', 'transmissionDossier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function lock($id){
        $fiche = Transmission::findOrFail($id);
        $fiche->etat = "cloturer";
        $fiche->update();
        Toastr()->success("Fiche de nominations Cloturé");
        return redirect()->route("transmission.index");
    }

    public function unlock($id)
    {
        $fiche = FicheAffectation::findOrFail($id);
        $fiche->etat = "ouvert";
        $fiche->update();
        Toastr()->success("Fiche de nominations Ouvert");
        return redirect()->route("transmission.index");
    }

    public function newossier(Request $request, $id)
    {
        $data = $request->validate(array(
            'num_drh' => 'required',
        ));
        $drh = $data['num_drh'];
        $dossier = Dossier::where('num_drh', $drh)->first();
        if($dossier){
            $dossier->statut = 'transmis';
            $dossier->update();
            $dossierTrans = new DossierTransmi();
            $dossierTrans->id_dossier = $dossier->id;
            $dossierTrans->transmission_id = $id;
            $dossierTrans->save();
            Toastr()->success("Dossier Ajouté");
            return redirect()->back();
        }else{
            Toastr()->error("Ce dossier n'exhiste pas");
            return redirect()->back();
        }
    }

    public function removedossier($id)
    {
        $trans = DossierTransmi::findOrFail($id);
        $trans->delete();
        Toastr()->success("Dossier Retiré");
        return redirect()->back();
    }
    public function delete($id)
    {
        $trans = Transmission::findOrFail($id);
        $trans->is_delete = true;
        $trans->update();
        Toastr()->success("Transmission Supprimer");
        return redirect()->back();
    }

    public function print($id)
    {
        $fiche = Transmission::findOrFail($id);
        $transmissionDossier = DossierTransmi::with("dossiers")->where('transmission_id', '=', $id)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("transmission.exports.template",compact("fiche","transmissionDossier"));
        $pdf->setPaper('A4', 'portrait');
        //$pdf->render();
        //$pdf->download("Affectation-".Str::slug(substr($fiche->titre,0,30))."-".$fiche->date.".pdf");
        //View("nominations.exports.template",compact("fiche","donnees"))
        //View("nominations.exports.template",compact("fiche","donnees"));
        return $pdf->stream();
    }
}
