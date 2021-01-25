<?php

namespace App\Http\Controllers;

use App\District;
use App\Groupe;
use App\Models\Affectation;
use App\Models\FicheAffectation;
use App\Models\Personnel;
use App\Models\Poste;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\Exception\Exception;
use Yoeunes\Toastr\Toastr;

class FicheAffectationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $affectations = FicheAffectation::where("intituler","affectation")->orderByDesc("id")->paginate(21);
        return view("affectations.index", compact('affectations'));
    }

    public function store(Request $request)
    {
        try {
            $fiche = FicheAffectation::create($request->all());
            $fiche->intituler = "affectation";
            $fiche->update();
            Toastr()->success("Enregistrement effectuer Enregistré");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr()->error("Erreur durant la sauvegarde :  ".$e->getMessage(),"Echec");
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $fiche = FicheAffectation::FindOrFail($id);
        dd($fiche);
    }

    public function manage($id)
    {
        $fiche = FicheAffectation::FindOrFail($id);
        $districts = District::all();
        $postes = Poste::all();
        return view("affectations.manage", compact("fiche", "districts", "postes"));
    }


    public function delete($id)
    {
        try {
            FicheAffectation::Destroy($id);
            Toastr()->success("Suppression Terminé","Terminé");
            return redirect()->route("nominations.index");
        } catch (\Exception $e) {
            Toastr()->error("Vous devez au préalable supprimer toutes les affectations liées à cette fiche avant de la supprimer","Echec");
            return redirect()->route("nominations.index");
        }

    }

    public function update($id, Request $request)
    {
        try{
            $fiche = FicheAffectation::findOrFail($id);
            $fiche = $fiche->update($request->all());
            Toastr()->success("Enregistrement effectuer Enregistré");
        }catch (\Exception $exception){
            Toastr()->error("Erreur durant la sauvegarde : ".$exception->getMessage(),"Echec");
        }
        return redirect()->back();
    }

    public  function  print($id){
        $fiche = FicheAffectation::findOrFail($id);
        //dd($data);
        $groupes = Groupe::all();
        $donnees = array();
       // dd($fiche->affectations->first()->structure->categorie->groupe->id);
       foreach ($groupes as $groupe){
           $concerner = collect();
           foreach ($fiche->affectations as $affectation){
               if ($affectation->structure->categorie->groupe->id == $groupe->id){
                   $concerner->add($affectation);
               }
           }
           if ($concerner->count()>0){
               $donnees[$groupe->nom] = $concerner;
           }
       }
        //dd($donnees);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("affectations.pdf",compact("fiche","donnees"));
        //
        $pdf->setPaper('A4', 'portrait');
        //$pdf->render();

        return $pdf->stream();
            //$pdf->download("Affectation-".Str::slug(substr($fiche->titre,0,30))."-".$fiche->date.".pdf");

    }

    public  function  printAnnexe($id){
        $fiche = FicheAffectation::findOrFail($id);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("nominations.annexe",compact('fiche'));
        //
        $pdf->setPaper('A4', 'portrait');
        //$pdf->render();

        return $pdf->stream();
        //$pdf->download("Affectation-".Str::slug(substr($fiche->titre,0,30))."-".$fiche->date.".pdf");

    }

    public function  lock($id){
        $fiche = FicheAffectation::findOrFail($id);
        $fiche->etat = "cloturer";
        $fiche->update();
        Toastr()->success("Fiche D'affectation Cloturé");
        return redirect()->route("affectation.index");
    }

    public function  unlock($id){
        $fiche = FicheAffectation::findOrFail($id);
        $fiche->etat = "ouvert";
        $fiche->update();
        Toastr()->success("Operation éffectuer");
        return redirect()->back();
    }

}
