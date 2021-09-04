<?php

namespace App\Http\Controllers;

use App\Cotation;
use App\Delegue;
use App\Dossier;
use App\Notifications\DelegueNorification;
use App\Notifications\QuottationNorification;
use App\Tracage;
use App\Trace;
use App\TypeDossier;
use App\User;
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
        $dossiersTrie1 =  Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("cotations.servicegeneral_id", "=", auth()->user()->service_id)
            ->where("cotations.service_id", "=", null)
            ->select('dossiers.*')
            ->distinct()
            ->get();
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
        $dossiersTrie3 = Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("cotations.servicegeneral_id", "=", auth()->user()->service_id)
            ->where("cotations.service_id", "!=", null)
            ->select('dossiers.*')
            ->distinct()
            ->get();
        return view('Admin.admincoter', compact('dossiersTrie3'));
    }


    public function dossiers()
    {
        $d2 = Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("cotations.servicegeneral_id", "=", auth()->user()->service_id)
            ->where("cotations.service_id", "!=", null)
            ->select('dossiers.*')
            ->distinct()
            ->get();
        $d3 = Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("cotations.servicegeneral_id", "=", auth()->user()->service_id)
            ->where("cotations.service_id", "!=", null)
            ->where("dossiers.statut", "=", 'traiter')
            ->select('dossiers.*')
            ->distinct()
            ->get();
        $types = TypeDossier::all();
        // dd($d3);
        return view('Admin.dossiers', compact('d2', 'd3', 'types'));
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
        $cotations = Cotation::with('dossiers', 'services', 'servicegeneral')->where("dossier_id", '=', $id)->get();

        $cotations2 = DB::table('cotations')
            ->join('dossiers', 'dossiers.id', '=' , 'cotations.dossier_id')
            ->where('cotations.servicegeneral_id', '=', auth()->user()->service_id)
            ->where('cotations.dossier_id', '=',$id)
            ->select('cotations.*')
            ->distinct()
            ->first();
       // dd($cotations2);
        $tracages = Tracage::all()->where("dossier_id", $id);
        return view('Admin.details', compact('delegue', 'dossier','tracages', 'cotations','cotations2','trace', 'trace2', 'trace3', 'types', 'serviceslier'));
    }

    public function find()
    {
        return view('Admin.search');
    }

    public function store(Request $request)
    {
        //dd($request->input("matricule"));
        $data = $request->validate(array(
            'num_courrier' => 'required',
            'type_id' => 'required',
            'note' => 'required',
            'date_entre' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'grade' => 'required',
            'matricule' => 'nullable',
            'telephone' => 'required'
        ));

    $latest =DB::table('dossiers')->latest('id')->first();;

        try {
            if(auth()->user()->role == "secretaire"){
                $dossier = new Dossier();
                $num = $latest->id ;
                $dossier->num_service = auth()->user()->general->name.'-'.$num ;
                $dossier->num_courrier = $data['num_courrier'];
                $dossier->date_entre = $data['date_entre'];
                $dossier->nom = $data['nom'];
                $dossier->prenom = $data['prenom'];
                $dossier->grade = $data['grade'];
                $dossier->telephone = $data['telephone'];
                $dossier->matricule = $data['matricule'];
                $dossier->type_id = $data['type_id'];
                $dossier->note = $data['note'];
                $dossier->statut = "encour";
                $dossier->save();
                $cotation = new Cotation();
                $cotation->dossier_id = $dossier->id;
                $cotation->servicegeneral_id = auth()->user()->service_id;
                $cotation->save();
            }else{
                $dossier = new Dossier();
                $dossier->num_service = auth()->user()->general->name + 1;
                $dossier->num_courrier = $data['num_courrier'];
                $dossier->date_entre = $data['date_entre'];
                $dossier->nom = $data['nom'];
                $dossier->prenom = $data['prenom'];
                $dossier->grade = $data['grade'];
                $dossier->telephone = $data['telephone'];
                $dossier->matricule = $data['matricule'];
                $dossier->type_id = $data['type_id'];
                $dossier->note = $data['note'];
                $dossier->save();
            }
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

    public function servicequotation(Request $request, $dossier_id)
    {
        $data = $request->validate(array(
            'sous_service_id' => 'required',
        ));
        $cotation = Cotation::all()->where('dossier_id',$dossier_id)
            ->where('servicegeneral_id', auth()->user()->service_id);
        $dossier = Dossier::findOrFail($dossier_id);
        $taille = count($data['sous_service_id']);
        if($taille < 1){
            foreach ($cotation as $c){
                foreach ($data['sous_service_id'] as $service) {
                    $c->update(['sous_service_id'=> $service]);
                    $user = User::all()->where('role', '=', 'service')
                        ->where('sous_service_id', '=', $service);
                }
                foreach ($user as $u){
                    $u->notify(new QuottationNorification($dossier->num_drh, $dossier->id));
                }
            }
            die();
        }else{
            foreach ($data['sous_service_id'] as $service) {
                $cotation = new Cotation();
                $cotation->servicegeneral_id = auth()->user()->service_id;
                $cotation->dossier_id = $dossier->id;
                $cotation->service_id = $service;
                $cotation->save();
                $user = User::all()->where('role', '=', 'service')
                    ->where('sous_service_id', '=', $service);
            }
            foreach ($user as $u){
                $u->notify(new QuottationNorification($dossier->num_drh, $dossier->id));
            }
        }

        Toastr()->success("Affectation Enregistré");

        return redirect()->back();

    }

    public function quotation(Request $request, $dossier_id)
    {
        $data = $request->validate(array(
            'servicegeneral_id' => 'required',
        ));
        $dossier = Dossier::findOrFail($dossier_id);
        foreach ($data['servicegeneral_id'] as $general_id){
            $cotation = new Cotation();
            $cotation->servicegeneral_id = $general_id;
            $cotation->dossier_id = $dossier->id;
            $cotation->save();
            $user = User::where('role', '=', 'admin')->where('service_id', '=', $general_id)->first();
            $user->notify(new QuottationNorification($dossier->num_service, $dossier->id));
            $dossier->statut = 'encour';
            $dossier->update();
        }
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

    public function markRead($id)
    {
        auth()->user()->unreadNotifications->first()->markAsRead();
        return redirect()->route('dossier.detail', ['id' => $id]);
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

    public function destroyCotation($id){
        $co =  Cotation::findOrFail($id);
        $co->delete();
        Toastr()->success("Suppression avec Success");
        return redirect()->back();
    }
    public function updateacotation(Request $request){
        $data = $request->validate(array(
            'user_id' => 'required',
            "cotation_id" => 'required'
        ));
            $cotation = Cotation::findOrFail($data["cotation_id"]);
            $cotation->update(['user_id' => $data['user_id']]);
        Toastr()->success("Affectation Enregistré");
        return redirect()->back();
    }
}
