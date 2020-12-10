@extends('layouts.app')

@section('title')
Affectation
@endsection

@section('content')


    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-sm-offset-10 col-sm-2">
                    <a href="#" data-toggle="modal" data-target="#affectationModal" class="d-flex btn btn-primary btn-sm mb-1">Nouvel Ordre d'affetation</a>
                </div>
            </div>
        @forelse($affectations as $affectation)
            <!-- /.col -->
                <a href="{{route('affectation.manage',$affectation->id)}}" style="text-decoration:none;color:black" class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number" style="font-size: 12px;">{{ $affectation->type }}</span>
                            <span class="info-box-text">{{ $affectation->numero_decision}}</span>
                            <small class="text-mu">{{ $affectation->date}}</small><br>
                            <small><i class="text-truncate" style="font-size: 12px">{{  $affectation->etat }}</i></small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            @empty
                <h1 align="center" style="color:rgba(128, 128, 128, 0.781);font-size: 95px !important;position: absolute;top: 40%;left:35%;">Aucune Données !</h1>
            @endforelse
        </div>
        <div class="col-sm-offset-4">   {{ $affectations->links() }}</div>
    </div>

    <div class="modal fade" id="affectationModal" tabindex="-1" aria-labelledby="AffectationModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvel Ordre D'affectation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('affectation.store') }}">
                <div class="modal-body">
                        @csrf
                    <input type="hidden" name="etat" value="ouvert">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="titre">Titre</label>
                                <input type="text" name="num_sdp" class="form-control" id="titre" autocomplete="false" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control" id="date"  autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="decision">Numero de Decision</label>
                                <input type="text" name="nom" id="" class="form-control" autocomplete="false" placeholder="entre le nom du proprietaire">
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="type">Type</label>
                            <select name="type" class="form-control" id="type">
                                <option value="AFFECTATION LAUREAT Concours Direct">AFFECTATION LAUREAT Concours Direct</option>
                                <option value="AFFECTATION MOTIFS DIVERS">AFFECTATION MOTIFS DIVERS</option>
                                <option value="AFFECTATION DE PERSONNELS DE RETOUR DE STAGE">AFFECTATION DE PERSONNELS DE RETOUR DE STAGE</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="decision">Decision</label>
                            <textarea name="note" id="decision"  rows="10" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit"  class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection