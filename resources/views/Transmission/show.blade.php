@extends('layouts.app')

@section('content')


    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <div class="row">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <a onclick="return confirm('voulez vous vraiment effectuer cette action ?')" href="{{ route("transmission.delete",$transmissions->id) }}" class="btn btn-danger pull-right">Supprimer</a>
                            <h2 class="page-header">
                                <i class="fa fa-edit"></i> {{ $transmissions->numero }} | {{ Carbon\Carbon::createFromFormat("Y-m-d",$transmissions->date)->format("d/m/Y") }}
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
                    <h2 align="center" class="text-uppercase">Soit Transmis</h2>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom et Prénom</th>
                                    <th>Matriule</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($transmissionDossier as $transmission)
                                    <tr>
                                        <td>{{ $loop->index+1}}</td>
                                        <td>{{ $transmission->dossiers->nom." ".$transmission->dossiers->prenom}}</td>
                                        <td>{{ $transmission->dossiers->matricule}}</td>
                                        <td><a href="{{route('transmission.removedossier',$transmission->id)}}" onclick="return confirm('Voulez vous vraiment éffectuer cette action ?')" class="btn btn-sm btn-danger">Supprimer</a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-xs-12">
                                        <a href="{{ route('transmission.print',$transmissions->id) }}"  class="btn btn-success"><i class="fa fa-print"></i> Imprimer</a>
                                    @if($transmissions->etat == "ouvert")
                                        <button type="button" class="btn btn-primary pull-right mr-3"
                                                style="margin-right: 3% !important;" data-toggle="modal"
                                                data-target="#affectationModal"><i class="fa fa-plus-circle"></i>
                                            Ajouter un dossier
                                        </button>
                                        <a href="{{ route("transmission.lock",$transmissions->id) }}" onclick="return confirm('Souhaitez-vous vraiment cloturer ce dossier ?');" class="btn btn-warning pull-right mr-3"
                                           style="margin-right: 3% !important;"
                                        ><i class="fa fa-lock"></i> Clôturer la transmission
                                        </a>
                                    @else
                                        <a href="{{ route("transmission.lock",$transmissions->id) }}" onclick="return confirm('Souhaitez-vous vraiment cloturer ce dossier ?');" class="btn btn-warning pull-right mr-3"
                                           style="margin-right: 3% !important;"
                                        ><i class="fa fa-lock"></i> Re-ouvrir la transmission
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- /.row -->
                    <!-- this row will not appear when printing -->


                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="affectationModal" tabindex="-1" aria-labelledby="AffectationModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un dossier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('transmission.new',$transmissions->id) }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="matricule">Matricule</label>
                                <input type="text" name="matricule" class="form-control" id="matricule"
                                       autocomplete="false" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" readonly="true" id="submit"
                                    class="btn btn-primary">Ajoute
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
