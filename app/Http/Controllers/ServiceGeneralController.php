<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceGeneral;
use Illuminate\Http\Request;

class ServiceGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  index(){
        $services=ServiceGeneral::all();
        $genral_service=ServiceGeneral::all();
        //dd($services);
        return view("General.servicegeneral",compact('services', 'genral_service'));
    }

}
