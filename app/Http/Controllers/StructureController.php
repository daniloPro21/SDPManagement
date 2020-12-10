<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\District;
use App\Region;
use App\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $structures =  Structure::all()->where('is_delete', '=', false);
        $categories =  Categorie::all()->where('is_delete', '=', false);
        $districts =  District::all()->where('is_delete', '=', false);

        return view('Structure.index', compact('structures','districts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Structure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Structure::create($request->all());
        Toastr()->success("Effectué");

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
        $structure = Structure::findOrfail($id);
        return view('Structure.a-region', compact('structure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $structure = Structure::findOrfail($id);
        return view('Structure.edit', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $structure = Structure::findOrfail($id);
        $structure->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Structure::where('id', $id)->update(['is_delete' => true]);
        Toastr()->success("Suppression Effectué");

        return redirect()->back();
    }
}
