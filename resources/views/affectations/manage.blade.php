@extends('layouts.app')

@section('title')
{{ $fiche->type }}
@endsection

@section('content')


    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <div class="row">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-edit"></i> {{ $fiche->type }}
                                <small class="pull-right"> {{ Carbon\Carbon::createFromFormat("Y-m-d",$fiche->date)->format("d/m/Y") }}</small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col text-center">
                            {!! nl2br("REPUBLIQUE DU CAMEROUN
                            Paix-Travail-Patrie
                            --------------
                            MINISTERE DE LA SANTE PUBLIQUE
                            --------------
                            SECRETARIAT GENERAL
                            --------------
                            DIRECTION DES RESSOURCES HUMAINES
                            --------------
                            SOUS-DIRECTION DU PERSONNEL
                            ------------
                            SERVICE DU PERSONNEL MEDICO-SANITAIRE
                             ------------") !!}

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col text-center">
                            {!! nl2br("REPUBLIC OF CAMEROON
                            Peace-Work-Fatherland
                            --------------
                            MINISTRY OF PUBLIC HEALTH
                            --------------
                            SECRETARIAT GENERAL
                            --------------
                            DEPARTMENT OF HUMAN RESOURCES
                            --------------
                            SUB-DEPARTMENT OF PERSONNEL
                            ---------------
                            MEDICAL TECHNOLOGY PERSONNEL SERVICE
                            ---------------
") !!}
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <h2 align="center">Liste du personnel concerné</h2>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Poste</th>
                                    <th>District</th>
                                    <th>Region</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Need for Speed IV</td>
                                    <td>247-925-726</td>
                                    <td>Wes Anderson umami biodiesel</td>
                                    <td>$50.00</td>
                                </tr>
                                @foreach($fiche->affectations as $affectation)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>Need for Speed IV</td>
                                        <td>247-925-726</td>
                                        <td>Wes Anderson umami biodiesel</td>
                                        <td>$50.00</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="#" target="_blank" class="btn btn-default"><i class="fa fa-eye"></i> Visualiser</a>
                            <button type="button" class="btn btn-success pull-right"><i class="fa fa-print"></i> Imprimer
                            </button>
                            <button type="button" class="btn btn-primary pull-right mr-3" style="margin-right: 3% !important;" data-toggle="modal" data-target="#affectationModal"><i class="fa fa-plus-circle"></i> Nouvelle affectation
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="affectationModal" tabindex="-1" aria-labelledby="AffectationModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvel Affectation</h5>
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
                                <label for="titre">Nom</label>
                                <input type="hidden" id="personnel_id" value="">
                                <input type="text" name="nom" class="form-control" id="personnel_nom" autocomplete="false" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="titre">Prenom</label>
                                <input type="text" name="prenom" class="form-control" id="titre" autocomplete="false" required>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit"  class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
                </form>
        </div>
    </div>

@endsection
