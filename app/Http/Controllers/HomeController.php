<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Repositories\DossierRepository;
use App\Repositories\PersonneRepository;
use App\TypeDossier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $dossierRepository;
    public $personneRepository;

    public function __construct(DossierRepository $dossierRepository, PersonneRepository $personneRepository)
    {
        $this->dossierRepository=$dossierRepository;
        $this->personneRepository = $personneRepository;
        $this->middleware('auth');
    }


    public function admin()
    {
        return view('Admin.home');
    }

    public function secretaire()
    {
        $dossiers = Dossier::all()->where('service_id', '=', auth()->user()->service_id);
        $coter = $this->dossierRepository->getAssignDossiers()->count();
        // dd($coter);
        $ncote = $this->dossierRepository->getNewDossiers()->count();
        $traiter = $this->dossierRepository->getDossiersTraiter()->count();
        $personnes = $this->personneRepository->getAllPersonne();
        $types = TypeDossier::all();
        return view('Secretaire.home', compact('dossiers', 'coter', 'ncote', 'traiter', 'personnes', 'types'));
    }

    public function service()
    {
        $dossiers = Dossier::all()->where('service_id', '=', auth()->user()->service_id);

        return view('Services.home', compact('dossiers'));
    }
}