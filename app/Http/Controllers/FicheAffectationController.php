<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use Illuminate\Http\Request;

class FicheAffectationController extends Controller
{
    public function index(){
        $affectations = Affectation::orderByDesc("id")->paginate(21);
        return view("affectations.index",compact('affectations'));
    }
}
