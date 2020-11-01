<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function  index(){
        $services=Service::all();
        return view("Admin.service",compact('services'));
    }

    public function  store(Request $request){
        Service::create($request->all());
        return redirect()->back()->withMessage("Enregistrement Effectué");
    }
}
