@extends('layouts.app')

    @section('content')
            <div class="container">
                <div class=" col-sm-offset-3 col-sm-6">
                    <form action="{{ route('dossier.result') }}" method="GET">
                        <div class="box">
                        <div class="box-header">
                        <h3 class="text-center text-uppercase">Rechercher</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body col-sm-offset-2 col-sm-8">

                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" class="form-control"  name="recherche" placeholder="Mot Clé" style="text-align: center; height: 50px;">
                        </div>
                            <button class="btn btn-primary btn-block">Rechercher</button>
                        </div>
                    </div>
                    <div class="box-footer">
                    </form>
                 </div>
            </div>
    @endsection

<div class="row justify-content-center d-flex align-items-center">
</div>
 {{--  <div class="row justify-content-center d-flex align-items-center">
    <div class="container">
        <div class=" col-sm-offset-3 col-sm-6">
            <form action="{{ route('dossier.result') }}" method="GET">
            <div class="box">
                <div class="box-header">
                <h3 class="text-center text-uppercase">Rechercher</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body col-sm-offset-2 col-sm-8">

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" class="form-control"  name="recherche" placeholder="Mot Clé" style="text-align: center; height: 50px;">
                </div>
                    <button class="btn btn-primary btn-block">Rechercher</button>
                </div>
            </div>
            <div class="box-footer">

            </div>
  </div>
    </div>
                <!-- ./col -->
            </div> --}}
