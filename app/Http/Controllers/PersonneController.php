<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Personne;
use App\Repositories\PersonneRepository;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    public $personneRepository;

    public function __construct(PersonneRepository $personneRepository)
    {
        $this->personneRepository = $personneRepository;
        $this->middleware('auth');
    }

    public function create()
    {
        $personnes = $this->personneRepository->getAllPersonne();
        // dd($personnes);
        return view('Secretaire.personneCreate', compact('personnes'));
    }


    public function store(Request $request)
    {
        $data = $request->validate(array(
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required',
            'grade' => 'required'
        ));

        $personne = new Personne();

        $personne->nom = $data['nom'];
        $personne->prenom = $data['prenom'];
        $personne->matricule = $data['matricule'];
        $personne->grade = $data['grade'];

        $personne->save();
        // Personne::firstOrCreate([
        //     'nom' => $data['nom'],
        //     'prenom' => $data['prenom'],
        // 'matricule' => $data['matricule'],
        //     'grade' => $data['grade']
        // ]);

        return back();
    }

    // public function aboutDossier($idpersonne)
    // {
    //     $dossier= $this->personneRepository->getDossierbyPersonneID($idpersonne);
    //     dd($dossier);
    //     return view('Admin.details', compact('dossier'));
    // }
}
