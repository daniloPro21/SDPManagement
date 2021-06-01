<?php

namespace App\Http\Controllers;

use App\Trace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TraceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
     //   dd($request->all());
        $data = $request->validate(array(
            'num_dossier' => 'required',
            'nom_service' => 'required',
            'id_dossier' => 'required',
        ));

        if(auth()->user()->role == 'secretaire'){
            $prefix =   auth()->user()->general->name;
        }else {
            $prefix = auth()->user()->service->name;
        }
        $trace = new Trace();
        $trace->nom_service = $data['nom_service'];
        $trace->num_dossier = $data['num_dossier'];
        $trace->id_dossier = $data['id_dossier'];
        $trace->save();
        Toastr()->success("Affectation Enregistré");

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $data = $request->validate(array(
            'date_sortie' => 'required',
            'id_dossier'=> 'required'
        ));

        if(auth()->user()->role == 'secretaire')
        Trace::where('id_dossier', $data['id_dossier'])
            ->where('nom_service', auth()->user()->general->name)
            ->update($data);
        else{
            Trace::where('id_dossier', $data['id_dossier'])
                ->where('nom_service', auth()->user()->service->name)
                ->update($data);
        }
        Toastr()->success("Mise à jour Enregistré");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
