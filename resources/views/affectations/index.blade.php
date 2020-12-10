@extends('layouts.app')


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
                <a href="{{route('dossier.detail',$affectation->id)}}" style="text-decoration:none;color:black" class="col-md-4 col-sm-6 col-xs-12">
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
                <form method="POST" action="{{ route('dossier.store') }}">
                <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="numero">Numéro SDP</label>
                                <input type="text" name="num_sdp" class="form-control" id="numero" autocomplete="false" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="DHR">Numéro DRH</label>
                                <input type="text" name="num_dra" class="form-control" id="DHR"  autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nom du Propriétaire</label>
                                <input type="text" name="nom" id="" class="form-control" placeholder="entre le nom du proprietaire" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Prénom</label>
                                <input type="text" name="prenom" id="" class="form-control" placeholder="entre le prenom du proprietaire" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Matricule</label>
                                <input type="text" name="matricule" id="" class="form-control" placeholder="entre le matricule du proprietaire" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Grade</label>
                                <input type="text" name="grade" id="" class="form-control" placeholder="entre le grade du proprietaire" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Téléphone</label>
                                <input type="text" name="telephone" id="" class="form-control" placeholder="entre le telephone du proprietaire" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Date D'entrée</label>
                                <input type="date" name="date_entre" class="form-control" id="inputPassword4" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Type</label>
                                <select class="custom-select form-control" name="type">
                                        <option value="Test">Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Note</label>
                            <textarea name="note" id="" cols="30" rows="10"></textarea>
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
