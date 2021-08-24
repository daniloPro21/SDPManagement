<?php

namespace App\Http\Controllers;

use App\Cotation;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class CotationController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

}
