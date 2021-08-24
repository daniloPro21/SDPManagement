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
                                <a href="#" data-toggle="modal" data-target="#affectationModal1" class="fa fa-edit"></a> {{ $transmissions->numero }} | {{ Carbon\Carbon::createFromFormat("Y-m-d",$transmissions->date)->format("d/m/Y") }}
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
                                <label for="matricule">Numéro de la DRH</label>
                                <input type="text" name="num_drh" class="form-control" id="matricule"
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
    </div>
    <div class="modal fade" id="affectationModal1" tabindex="-1" aria-labelledby="AffectationModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier Transmission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('transmission.store') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="etat" value="ouvert">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="decision">Numéro de Décision</label>
                                <input type="text" readonly name="numero" value="{{ $transmissions->numero }}" id="numero" class="form-control"
                                       autocomplete="false" placeholder="Numéro de Décision"></div>
                            <div class="form-group col-md-6">
                                <label for="date">Date</label>
                                <input type="date" name="date" value="{{ $transmissions->date }}" class="form-control"
                                       style="padding: 0 !important; padding-left: 4% !important;" id="date"
                                       autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="titre">Service à Transmettre</label>
                                <textarea name="service"  class="form-control" rows="2" id="titre" autocomplete="false"
                                          required>{{ $transmissions->service }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="entete">Entête</label>
                                <input type="text" name="entete" value="{{ $transmissions->entete }}"  class="form-control" id="entete"
                                       autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="decrets">Analyse</label>
                                <textarea name="analyse" id="numero" rows="6"
                                          class="form-control textareaFeat">{{ $transmissions->analyse }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="decision">Observation</label>
                                <textarea name="observation" id="observation" rows="4"
                                          class="form-control textareaFeat">{{ $transmissions->observation }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
