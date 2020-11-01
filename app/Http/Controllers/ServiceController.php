<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

  public $serviceRepository;

  public function __construct(ServiceRepository $serviceRepository){

      $this->serviceRepository = $serviceRepository;
  }


    public function index()
    {
      $services = $this->serviceRepository->getAllService();

      return view('Secretaire.services', compact('services'));

    }
}
