<?php

namespace App\Http\Controllers;

use App\Cotation;
use App\Dossier;
use App\Models\Personnel;
use App\TypeDossier;
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
        $this->dossierRepository=$dossierRepository;
        $this->middleware('auth');
    }

    public function listeDossier($type)
    {
        //$dossiersTrie;
        switch ($type) {
            case 'non-coter':
                $dossiersTrie= $this->dossierRepository->getNonCoterDossiers();
                break;
            case 'non-genral-service':
                $dossiersTrie= $this->dossierRepository->getNewDossiers();
                break;
            case 'coter':
                $dossiersTrie= $this->dossierRepository->getAssignDossiers();
                break;
            case 'traiter':
                $dossiersTrie= $this->dossierRepository->getDossiersTraiter();
                break;

            default:
                $dossiersTrie=$this->dossierRepository->getDossiers();
                break;
        }
       // dd($dossiersTrie);
        return view("Admin.listedossier", compact('dossiersTrie'));
    }

    public function dossiers()
    {
        $d2 = DB::table('dossiers')
        ->join('cotations', 'cotations.id_dossier', '=', 'dossiers.id')
        ->join('services', 'services.id', '=', 'cotations.id_service')
        ->where('dossiers.service_id', '=', auth()->user()->service_id)
        ->where('dossiers.traiter', '=', false)
        ->where('dossiers.is_delete', '=', false)
        ->select('dossiers.*', 'services.*', 'cotations.*')
        ->get();
        return view('Admin.dossiers',compact('d2'));
    }

    public function detail($id)
    {
        $dossier=Dossier::findOrFail($id);
        $types = TypeDossier::all();
        $serviceslier = Service::all()->where('servicegeneral_id', auth()->user()->service_id);
        $cotationDossier =  DB::table('cotations')
        ->join('dossiers', 'cotations.id_dossier', '=', 'dossiers.id')
        ->join('services', 'services.id', '=', 'cotations.id_service')
        ->where('cotations.id_dossier', '=', $id)
        ->select('services.name', 'cotations.num_dossier','cotations.id_service')
        ->get();
       //  dd($cotationDossier);
        //die();
        return view('Admin.details', compact('dossier','types','serviceslier','cotationDossier'));
    }

    public function find()
    {
        return view('Admin.search');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate(array(
            'num_drh' => 'required',
            'type_id' => 'required',
            'note' => 'required',
            'date_entre' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'grade' => 'required',
            'matricule'=> 'required',
            'telephone' => 'required'
        ));



       try{
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


           $verification = Personnel::where("matricule",$data['matricule'])->count();


           if($verification<=0){
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
           Toastr()->success("Enregistrement Effectué","terminé");
       }catch (\Exception  $exception){
           Toastr()->error("Erreur durant la sauvegarde ".$exception->getMessage(),"Echec");
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
            'matricule'=> 'required'
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

    public function quotation($id,$dossier_id){
        $dossier = Dossier::findOrFail($dossier_id);
        $dossier->service_id=$id;
        $dossier->update();

        Toastr()->success("Affectation Enregistré");

        return redirect()->back();

    }
    public function servicequotation(Request $request){
       // dd($request->all());
        //die();
        $data = $request->validate(array(
            'num_dossier' => 'required',
            'id_dossier' => 'required',
            'id_service' => 'required',
        ));

        $cotation = new Cotation();
        $cotation->num_dossier = $data["num_dossier"];
        $cotation->id_service = $data["id_service"];
        $cotation->id_dossier = $data["id_dossier"];
        $cotation->save();

        Toastr()->success("Affectation Enregistré");

        return redirect()->back();

    }

    public function traiter($id){
        $dossier = Dossier::findOrFail($id);
        $dossier->traiter=true;
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function findresult(Request $request){
        $data="%".$request->recherche."%";
        $dossiersTrie= Dossier::where('num_drh',$request->recherche)->orWhere('nom',"LIKE",$data)->orWhere('matricule',"LIKE",$data)->paginate(21);
        return view("Admin.listedossier", compact('dossiersTrie'));
    }

    public function group(){
        $typedossiers=TypeDossier::where("is_delete",false)->get();
        return view("typedossiers.liste",compact("typedossiers"));
    }

    public function ShowGroup($id){
        $dossiersFiltrer=Dossier::where('is_delete',false)->where('type_id',$id)->get();
        $typeDossier=TypeDossier::findOrFail($id);
        return view("typedossiers.dossiers",compact("dossiersFiltrer","typeDossier"));
    }
}
