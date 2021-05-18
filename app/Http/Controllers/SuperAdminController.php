<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Charts\DossierChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;

class SuperAdminController extends Controller
{


   public function __construct()
   {
       $this->middleware('auth');
   }

   public function index()
   {
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

  $dossierChart = new DossierChart;
    $dossierChart->labels(['Nouveaux', 'En cours de traitement','Traités']);
    //$dossierChart->minimalist(true);
    $dossierChart->dataset('Statistiques', 'doughnut', [Dossier::where('is_delete', false)->where('service_id',null)->count(), Dossier::where('service_id','!=',null)->where('traiter',false)->count(), Dossier::where('traiter',true)->count()])->color($borderColors)->backgroundcolor($fillColors);

    $dossier2Chart = new DossierChart;
    $dossiers=Dossier::where('is_delete', false)->get()->groupBy(function($d) {
      return Carbon::parse($d->date_entre)->format('m');
      });
      for ($i=1; $i<=12 ; $i++) {
        $key="0".$i;
       $dossier2Data[] = ($i>=10) ? $dossiers->get($i,collect([]))->count() : $dossiers->get($key,collect([]))->count() ;
      }
    $dossier2Chart->labels(['Jan', 'Fev', 'Mar','Avr','Mai','Juin','Juillet','Août','Sept','Oct','Nov','Dec']);
    $dossier2Chart->dataset('Dossiers Reçus', 'line', $dossier2Data)->color("rgb(0,122,94)");

    $yearChart = new DossierChart;
    $yearsData=Dossier::where('is_delete', false)->get()->groupBy(function($d) {
      return Carbon::parse($d->date_entre)->format('Y');
      });
    for ($i=(int) date("Y")-10; $i<=date("Y") ; $i++) {
      $years[0][]=$i;
      $years[1][]=$yearsData->get($i,collect([]))->count();
    }
    //dd($years);
    array_reverse($years[0]);
    $yearChart->labels($years[0]);
    $yearChart->dataset('Dossiers Reçus', 'line', $years[1])->color("rgb(219,139,11)")->backgroundcolor("rgb(219,139,60)");
    return view('SuperAdmin.home',compact("dossierChart","dossier2Chart","yearChart") );

   }
}