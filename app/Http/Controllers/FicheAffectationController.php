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
        $affectations = FicheAffectation::orderByDesc("id")->paginate(21);
        return view("affectations.index", compact('affectations'));
    }

    public function store(Request $request)
    {
        try {
            $fiche = FicheAffectation::create($request->all());
            Toastr()->success("Enregistrement effectuer Enregistré");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr()->error($e->getMessage());
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
        return view("affectations.manage", compact("fiche", "personnels", "districts", "postes"));
    }


    public function delete($id)
    {
        try {
            FicheAffectation::Destroy($id);
            Toastr()->success("Enregistrement effectuer Enregistré");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function update($id, Request $request)
    {
        $fiche = FicheAffectation::findOrFail($id);
        $fiche = $fiche->update($request->all());
        Toastr()->success("Enregistrement effectuer Enregistré");
        return redirect()->back();
    }

    public  function  print($id){
        $fiche = FicheAffectation::findOrFail($id);
        //dd($fiche);
        $groupes = Groupe::all();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("affectations.pdf",compact("fiche","groupes"));
        //return $pdf->download("Affectation-".Str::slug(substr($fiche->titre,0,30))."-".$fiche->date.".pdf");
        return $pdf->stream();
    }

}
