<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\FicheAffectation;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Toastr;

class AffectationController extends Controller
{

    public function delete($id)
    {
        try {
            Affectation::destroy($id);
            Toastr()->success("Opération Terminée");
        } catch (\Exception $e) {
            Toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    public function new($id, Request $request)
    {
        $personnel = Personnel::where("matricule", $request->matricule)->first();
        $ficheAf = FicheAffectation::findOrFail($id);
        $present = false;
        if ($personnel) {
            foreach ($ficheAf->affectations as $affectation) {
                if ($affectation->personnel_id == $personnel->id) {
                    $present = true;
                }
            }
            if (!$present) {
                $affectation = new Affectation();
                $affectation->personnel_id = $personnel->id;
                $affectation->poste_id = $request->poste_id;
                $affectation->structure_id = $request->structure_id;
                $affectation->fiche_affectation_id = $id;
                $affectation->motif = $request->motif;
                $affectation->date = $request->date;
                try {
                    $affectation->save();
                    Toastr()->success("Affectation Enregistré");
                } catch (\Exception $e) {
                    Toastr()->error($e->getMessage());
                }
            } else {
                Toastr()->error("Erreur :  Une Affectation concernant ce matricule est déja present dans la liste actuelle");
            }
        } else {
            Toastr()->error("Erreur :  Ce matricule n'existe pas dans notre base de données");
        }
        return redirect()->back();
    }

    public function getPersonnelFromMat($mat, $fiche)
    {
        $pers = Personnel::where("matricule", $mat)->first();
        if ($pers) {
            $pers->lastaffectation = $pers->affectations->get($pers->affectations->count() - 1);
            if ($pers->lastaffectation) {
                $pers->lastaffectation->poste;
                $pers->lastaffectation->date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pers->lastaffectation->created_at)->format("d/m/Y");
                $pers->lastaffectation->structure;
            }
            $pers->present = false;
            $ficheAf = FicheAffectation::findOrFail($fiche);
            foreach ($ficheAf->affectations as $affectation) {
                if ($affectation->personnel_id == $pers->id) {
                    $pers->present = true;
                }
            }

        }
        return $pers;
    }
}
