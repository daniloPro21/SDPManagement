<?php

namespace App\Http\Controllers;

use App\Borderaux;
use App\BorderauDossier;
use App\Dossier;
use App\Transmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BorderauController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return IlluminateContractsFoundationApplication|IlluminateContractsViewFactory|IlluminateHttpResponse|IlluminateViewView|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bordereaux = Borderaux::where('etat', 'ouvert')
            ->where('service_id', auth()->user()->service_id)
            ->where('is_delete', false)
            ->orWhere('etat', 'ferme')
            ->OrderBy('id')
            ->paginate(21);
        return  view('Bordereaux.bordereaux', compact('bordereaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return IlluminateHttpResponse
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  IlluminateHttpRequest  $request
     * @return IlluminateHttpRedirectResponse
     */
    public function store(Request $request)
    {

        $data = $request->validate(array(
            'titre' => 'required',
            'destinataire' => 'required',
            'numero' => 'required',
            'entete' => 'required',
            'observation' => 'required',
            'date' => 'required'
        ));
        $bordereau = new Borderaux();
        $bordereau->titre = $data['titre'];
        $bordereau->destinataire = $data['destinataire'];
        $bordereau->numero = $data['numero'];
        $bordereau->entete = $data['entete'];
        $bordereau->service_id = auth()->user()->service_id;
        $bordereau->observation = $data['observation'];
        $bordereau->date = $data['date'];
        $bordereau->etat = 'ouvert';
        $bordereau->is_delete = false;
        $bordereau->save();

        Toastr()->success("Enregistrement Effectué","terminé");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return IlluminateContractsFoundationApplication|IlluminateContractsViewFactory|IlluminateHttpResponse|IlluminateViewView|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $bordereau = Borderaux::findOrfail($id);
        $bordereauDossier = BorderauDossier::with('dossiers')
            ->where('id_borderaux', $id)->get();
        return view('Bordereaux.show', compact('bordereau', 'bordereauDossier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return IlluminateHttpResponse
     */
    public function edit($id)
    {
        //
    }

    public function lock($id){
        $fiche = Borderaux::findOrFail($id);
        $fiche->etat = "ferme";
        $fiche->update();
        Toastr()->success("Bordereau Cloturé");
        return redirect()->route("bordreau.index");
    }

    public function unlock($id)
    {
        $fiche = Borderaux::findOrFail($id);
        $fiche->etat = "ouvert";
        $fiche->update();
        Toastr()->success("Bordereau Ouvert");
        return redirect()->route("bordreau.index");
    }

    public function newossier(Request $request, $id)
    {
        $data = $request->validate(array(
            'num_drh' => 'required',
        ));
        $num_drh = $data['num_drh'];
        $dossier = Dossier::where('num_drh', $num_drh)->first();
        if($dossier){
            $bordereau = new BorderauDossier();
            $bordereau->id_dossier = $dossier->id;
            $bordereau->id_borderaux = $id;
            $bordereau->save();
            Toastr()->success("Dossier Ajouté");
            return redirect()->back();
        }else{
            Toastr()->error("Ce dossier n'exhiste pas");
            return redirect()->back();
        }
    }

    public function removedossier($id)
    {
        $trans = BorderauDossier::findOrFail($id);
        $trans->delete();
        Toastr()->success("Dossier Retiré");
        return redirect()->back();
    }

    public function delete($id)
    {
        $trans = Borderaux::findOrFail($id);
        $trans->is_delete = true;
        $trans->update();
        Toastr()->success("Borderaux Supprimer");
        return redirect()->back();
    }

    public function print($id)
    {
        $fiche = Borderaux::findOrFail($id);
        $transmissionDossier = BorderauDossier::with("dossiers")->where('id_borderaux', '=', $id)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("Bordereaux.exports.template",compact("fiche","transmissionDossier"));
        $pdf->setPaper('A4', 'portrait');
        //$pdf->render();
        //$pdf->download("Affectation-".Str::slug(substr($fiche->titre,0,30))."-".$fiche->date.".pdf");
        //View("nominations.exports.template",compact("fiche","donnees"))
        //View("nominations.exports.template",compact("fiche","donnees"));
        return $pdf->stream();
    }
}
