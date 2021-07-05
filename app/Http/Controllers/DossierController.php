<?php

namespace App\Http\Controllers;

use App\Cotation;
use App\Delegue;
use App\Dossier;
use App\Models\Personnel;
use App\Notifications\DelegueNorification;
use App\Notifications\QuottationNorification;
use App\Trace;
use App\TypeDossier;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;
use Yoeunes\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Repositories\DossierRepository;
use App\Service;
use Illuminate\Support\Facades\DB;

class DossierController extends Controller
{
    public $dossierRepository;

    public function __construct(DossierRepository $dossierRepository)
    {
        $this->dossierRepository = $dossierRepository;
        $this->middleware('auth');
    }

    public function listeDossier($type)
    {
        //$dossiersTrie;
        switch ($type) {
            case 'non-coter':
                $dossiersTrie = $this->dossierRepository->getNewDossiers();
                break;
            case 'signe-admin':
                $dossiersTrie = $this->dossierRepository->getSignesAdmin();
                break;
            case 'rejete-admin':
                $dossiersTrie = $this->dossierRepository->getRejetesAdmin();
                break;
            case 'transmi-admin':
                $dossiersTrie = $this->dossierRepository->getTransmissAdmin();
                break;
            case 'non-general-service':
                $dossiersTrie = $this->dossierRepository->getNonCoterDossiers();
                break;
            case 'coter':
                $dossiersTrie = $this->dossierRepository->getAssignDossiers();
                break;
            case 'coteradmin':
                $dossiersTrie = $this->dossierRepository->getAssignAdminDossiers();
                break;
            case 'traiter':
                $dossiersTrie = $this->dossierRepository->getDossiersTraiter();
                break;
            case 'signed':
                $dossiersTrie = $this->dossierRepository->getAdminDossierSigne();
                break;
            case 'transmis':
                $dossiersTrie = $this->dossierRepository->getAdminDossierTransmis();
                break;
            case 'rejete':
                $dossiersTrie = $this->dossierRepository->getAdminDossierRejete();
                break;
            case 'traiterSuper':
                $dossiersTrie = $this->dossierRepository->getDossiersTraiterSuper();
                break;
            case 'traiterAdmin':
                $dossiersTrie = $this->dossierRepository->getDossiersTraiterAdministrator();
                break;

            default:
                $dossiersTrie = $this->dossierRepository->getDossiers();
                break;
        }
        // dd($dossiersTrie);
        return view("Admin.listedossier", compact('dossiersTrie'));
    }

    public function shownoncoter()
    {
        $dossiersTrie1 = Dossier::with('type', 'service', 'services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('sous_service_id', '=', null)
            ->where('statut', '=', 'encour')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);
        // dd($dossiersTrie1);
        return view('Admin.noncoter', compact('dossiersTrie1'));
    }

    public function showtraiteradmin()
    {
        $dossiersTrie2 = Dossier::with('type', 'service', 'services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('statut', '=', 'traiter')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);

        return view('Admin.TraiterDossier', compact('dossiersTrie2'));
    }

    public function showcotedossier()
    {
        $dossiersTrie3 = Dossier::with('type', 'service', 'services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('sous_service_id', '!=', null)
            ->where('statut', '=', 'encour')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);
        return view('Admin.admincoter', compact('dossiersTrie3'));
    }


    public function dossiers()
    {
        $d2 = Dossier::with('type', 'service', 'services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('sous_service_id', '!=', null)
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);
        $d3 = Dossier::with('type', 'service', 'services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('sous_service_id', '!=', null)
            ->where('statut', '=', 'encour')
            ->where('is_delete', false)
            ->orderByDesc('id')->count();
        $types = TypeDossier::all();
        // dd($d3);
        return view('Admin.dossiers', compact('d2','d3', 'types'));
    }

    public function detail($id)
    {
        $dossier = Dossier::findOrFail($id);
        $delegue = Delegue::with('dossiers', 'users')
            ->where('id_dossier', $id)
            ->first();
        $types = TypeDossier::all();
        $trace = Trace::where('id_dossier', $id)->get();
        $trace2 = Trace::where('id_dossier', $id)->where('nom_service', auth()->user()->general->name)->get();
        $trace3 = Trace::where('id_dossier', $id)->where('nom_service', auth()->user()->service->name)->get();
       // dd($trace2);
        $serviceslier = Service::all()->where('servicegeneral_id', auth()->user()->service_id);

        return view('Admin.details', compact('delegue', 'dossier', 'trace', 'trace2', 'trace3','types', 'serviceslier'));
    }

    public function find()
    {
        return view('Admin.search');
    }

    public function store(Request $request)
    {

        $data = $request->validate(array(
            'num_drh' => 'required',
            'type_id' => 'required',
            'note' => 'required',
            'date_entre' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'grade' => 'required',
            'matricule' => 'required',
            'telephone' => 'required'
        ));


        try {
            $dossier = new Dossier();
            $dossier->num_drh = $data['num_drh'];
            $dossier->date_entre = $data['date_entre'];
            $dossier->nom = $data['nom'];
            $dossier->prenom = $data['prenom'];
            $dossier->grade = $data['grade'];
            $dossier->telephone = $data['telephone'];
            $dossier->matricule = $data['matricule'];
            $dossier->type_id = $data['type_id'];
            $dossier->note = $data['note'];


            $verification = Personnel::where("matricule", $data['matricule'])->count();


            if ($verification <= 0) {
                $personnel = new Personnel();
                $personnel->nom = $data['nom'];
                $personnel->prenom = $data['prenom'];
                $personnel->matricule = $data['matricule'];
                $personnel->sexe = $request->sexe;
                $personnel->grade = $data['grade'];
                $personnel->telephone = $data['telephone'];
                $personnel->save();
            }

            $dossier->save();
            Toastr()->success("Enregistrement Effectué", "terminé");
        } catch (\Exception  $exception) {
            Toastr()->error("Erreur durant la sauvegarde " . $exception->getMessage(), "Echec");
        }


        return redirect()->back();

    }

    public function update(Request $request, $id)
    {

        $data = $request->validate(array(
            'num_dra' => 'required',
            'type_id' => 'required',
            'note' => 'required',
            'date_entre' => 'required',
            'date_sortie' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'grade' => 'required',
            'matricule' => 'required'
        ));


        Dossier::where('id', $id)->update($data);

        Toastr()->success("Modification Effectué");


        return redirect()->back();

    }

    public function delete($id)
    {
        Dossier::where('id', $id)->update(['is_delete' => true]);
        Toastr()->success("Suppression Effectué");

        return redirect()->back();

    }

    public function quotation($id, $dossier_id)
    {
        $dossier = Dossier::findOrFail($dossier_id);
        $dossier->service_id = $id;
        $dossier->statut = 'encour';
        $dossier->update();
        $user = User::all()->where('role', '=', 'admin')->where('service_id', '=', $id)->first();
        $user->notify(new QuottationNorification($dossier->num_drh, $dossier->id));
        Toastr()->success("Affectation Enregistré");
        return redirect()->back();

    }

    public function getIn(Request $request)
    {

        $data = $request->validate(array(
            'num_dossier' => 'required',
        ));
        Toastr()->success("Affectation Enregistré");

        return redirect()->back();

    }

    public function markRead($id){
        auth()->user()->unreadNotifications->first()->markAsRead();
        return redirect()->route('dossier.detail', ['id' => $id]);
    }

    public function servicequotation($id_service, $dossier_id)
    {

        $dossier = Dossier::findOrFail($dossier_id);
        $dossier->sous_service_id = $id_service;
        $dossier->update();
        $user = User::all()->where('role', '=', 'service')->where('sous_service_id', '=', $id_service)->first();
        $user->notify(new QuottationNorification($dossier->num_drh, $dossier->id));
        Toastr()->success("Affectation Enregistré");

        return redirect()->back();

    }

    public function traiter($id)
    {
        $dossier = Dossier::findOrFail($id);
        $dossier->statut = 'traiter';
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function rejete($id)
    {
        $dossier = Dossier::findOrFail($id);
        $dossier->statut = 'rejete';
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function delegue($dossier_id, $id_user)
    {

        $delegues = new Delegue();
        $delegues->id_user = $id_user;
        $delegues->id_dossier = $dossier_id;
        $user = User::findOrfail($id_user);
        $dossier = Dossier::findOrFail($dossier_id);
        $delegues->save();
        $user->notify(new DelegueNorification($dossier->num_drh, $dossier->id));
        Toastr()->success("Dossier Délégue");

        return redirect()->back();

    }

    public function transmis($id)
    {
        $dossier = Dossier::findOrFail($id);
        $dossier->statut = 'transmis';
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function getbackdossier($id)
    {
        $dossier = Dossier::findOrFail($id);
        $dossier->statut = 'encour';
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function signed($id)
    {
        $dossier = Dossier::findOrFail($id);
        $dossier->statut = 'signe';
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function findresult(Request $request)
    {
        $data = "%" . $request->recherche . "%";
        $dossiersTrie = Dossier::where('num_drh', $request->recherche)->orWhere('nom', "LIKE", $data)->orWhere('matricule', "LIKE", $data)->paginate(21);
        return view("Admin.listedossier", compact('dossiersTrie'));
    }

    public function group()
    {
        $typedossiers = TypeDossier::where("is_delete", false)->get();
        return view("typedossiers.liste", compact("typedossiers"));
    }

    public function ShowGroup($id)
    {
        $dossiersFiltrer = Dossier::where('is_delete', false)->where('type_id', $id)->get();
        $typeDossier = TypeDossier::findOrFail($id);
        return view("typedossiers.dossiers", compact("dossiersFiltrer", "typeDossier"));
    }
}