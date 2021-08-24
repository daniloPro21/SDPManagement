<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Repositories\DossierRepository;
use App\Repositories\PersonneRepository;
use App\Trace;
use App\TypeDossier;
use App\Charts\DossierChart;
use App\Cotation;
use App\Service;
use App\ServiceGeneral;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $dossierRepository;
    public $personneRepository;

    public function __construct(DossierRepository $dossierRepository)
    {
        $this->dossierRepository=$dossierRepository;

        $this->middleware('auth');
    }


    public function admin()
    {
       // dd(auth()->user()->unreadNotifications);
      $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(22,160,133, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.6)",
            "rgba(255, 205, 86, 0.6)",
            "rgba(22,160,133, 0.6)"

        ];

        $d1 =  Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("cotations.servicegeneral_id", "=", auth()->user()->service_id)
            ->where("cotations.service_id", "=", null)
            ->select('dossiers.*')
            ->distinct()
            ->get();

        $d2 =  Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("cotations.servicegeneral_id", "=", auth()->user()->service_id)
            ->where("cotations.service_id", "!=", null)
            ->select('dossiers.*')
            ->distinct()
            ->get();
        //dd($d2);
        $d3 = Dossier::all()->where('statut', 'traiter')->where('service_id', auth()->user()->service_id);


      $dossierChart = new DossierChart;
        $dossierChart->labels(['Nouveaux', 'En cours de traitement','Traités']);
        //$dossierChart->minimalist(true);
        $dossierChart->dataset('Statistiques', 'doughnut', [$d1->count(), $d2->count(),$d3->count()])->color($borderColors)->backgroundcolor($fillColors);



        $dossier2Chart = new DossierChart;
        $dossiers=Dossier::where('is_delete', false)->where('service_id', '=',auth()->user()->service_id)->get()->groupBy(function($d) {
          return Carbon::parse($d->date_entre)->format('m');
          });
          for ($i=1; $i<=12 ; $i++) {
            $key="0".$i;
           $dossier2Data[] = ($i>=10) ? $dossiers->get($i,collect([]))->count() : $dossiers->get($key,collect([]))->count() ;
          }
        $dossier2Chart->labels(['Jan', 'Fev', 'Mar','Avr','Mai','Juin','Juillet','Août','Sept','Oct','Nov','Dec']);
        $dossier2Chart->dataset('Dossiers Reçus', 'line', $dossier2Data)->color("rgb(0,122,94)");



        $yearChart = new DossierChart;
        $yearsData=Dossier::all()->where('is_delete', false)->where('service_id', '=', auth()->user()->service_id)->groupBy(function($d) {
            return \Illuminate\Support\Carbon::parse($d->date_entre)->format('Y');
        });
        for ($i=(int) date("Y")-10; $i<=date("Y") ; $i++) {
            $years[0][]=$i;
            $years[1][]=$yearsData->get($i,collect([]))->count();
        }
        //dd($years);
        array_reverse($years[0]);
        $yearChart->labels($years[0]);
        $yearChart->dataset('Dossiers Reçus', 'line', $years[1])->color("rgb(219,139,11)")->backgroundcolor("rgb(219,139,60)");


      /*  $test = Cotation::where('service_generals_id', '=', auth()->user()->service_id)
            ->join('dossiers', 'cotations.id_dossier', '=', 'dossiers.id')
            ->where('statut', '=', null)
            ->get();
        dd($test);*/
        return view('Admin.home',compact("dossierChart","dossier2Chart","yearChart","d1","d2","d3") );
    }

    public function secretaire()
    {
        $dossierssecre = Trace::with('dossier')
            ->where('nom_service', '=', auth()->user()->general->name)
            ->get();
        //dd($dossierssecre);
        $d2 =  Dossier::with('type','service','services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('sous_service_id', '!=', null)
            ->where('statut', '=', 'encour')
            ->where('is_delete', false)
            ->orderByDesc('id')->get();
        $types = TypeDossier::all();
        return view('Secretaire.home', compact('types','dossierssecre', 'd2'));
    }

    public function service()
    {
        $cotation_service = Trace::with('dossier')
            ->where('nom_service', '=', auth()->user()->service->name)
            ->get();
        //dd($cotation_service);
        $service_name = ServiceGeneral::findOrfail(auth()->user()->service_id);
        return view('Services.home', compact('service_name','cotation_service'));
    }

    public function index()
    {
        $users = User::all()->where('is_delete', '=', false);
        $services = Service::all();

        return view('Admin.users', compact('users', 'services'));
    }

    public function saveUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'service_id' => 'required',
            'sous_service_id' => 'required'
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = $data['role'];
        $user->service_id  = $data['service_id'];
        $user->sous_service_id  = $data['sous_service_id'];

        $user->save();

        toastr()->success('Utilisateur ajouter avec succès');

            return back();
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'service_id' => 'required',
            'sous_service_id' => 'required'
        ]);

        $data['password'] = bcrypt($request->input('password'));
        User::where('id', $id)->update($data);
        toastr()->success('Mise a jour effectué  avec succès');

            return back();
    }

    public function deletetUser($id)
    {
        User::where('id', $id)->update(['is_delete' => true]);

        Toastr()->success("Suppression Effectué");

        return back();
    }

    public function edit(User $user)
    {
        return view('Admin.editUser', compact('user'));
    }
}
