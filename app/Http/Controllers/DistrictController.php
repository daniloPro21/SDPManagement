<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\District;
use App\Region;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts =  District::all()->where('is_delete', '=', false);
        $regions = Region::all()->where('is_delete', '=', false);
        return view('District.index', compact('districts', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('District.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        District::create($request->all());
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
        $district = District::findOrfail($id);
        return view('District.a-region', compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::findOrfail($id);
        return view('District.edit', compact('district'));
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
        $district = District::findOrfail($id);
        $district->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        District::where('id', $id)->update(['is_delete' => true]);
        Toastr()->success("Suppression Effectué");

        return redirect()->back();
    }
}
