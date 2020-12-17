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
                            <a onclick="return confirm('voulez vous vraiment effectuer cette action ?')" href="{{ route("ficheaffectation.delete",$fiche->id) }}" class="btn btn-danger pull-right">Supprimer</a>
                            <h2 class="page-header">
                                <i class="fa fa-edit"></i> {{ $fiche->type }} | {{ Carbon\Carbon::createFromFormat("Y-m-d",$fiche->date)->format("d/m/Y") }}
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
                    <h2 align="center" class="text-uppercase">Liste du personnel concerné</h2>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom et Prénom</th>
                                    <th>Poste</th>
                                    <th>Structure</th>
                                    <th>Région</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fiche->affectations as $affectation)
                                    <tr>
                                        <td>{{ $loop->index+1}}</td>
                                        <td>{{ $affectation->personnel->nom." ".$affectation->personnel->prenom }}</td>
                                        <td>{{ $affectation->poste->nom }}</td>
                                        <td>{{ $affectation->structure->nom }}</td>
                                        <td>{{ $affectation->structure->district->region->nom }}</td>
                                        <td><a href="{{route('affectation.delete',$affectation->id)}}" onclick="return confirm('Voulez vous vraiment éffectuer cette action ?')" class="btn btn-sm btn-danger">Supprimer</a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row" id="no-print">
                        <div class="col-xs-12">
                            <a href="{{ route('affectation.print',$fiche->id) }}"  class="btn btn-success"><i class="fa fa-print"></i> Imprimer</a>
                            @if($fiche->etat == "ouvert")
                                <button type="button" class="btn btn-primary pull-right mr-3"
                                        style="margin-right: 3% !important;" data-toggle="modal"
                                        data-target="#affectationModal"><i class="fa fa-plus-circle"></i> Nouvelle
                                    Affectation
                                </button>
                                <a href="{{ route("affectation.lock",$fiche->id) }}" onclick="return confirm('Souhaitez-vous vraiment cloturer ce dossier ?');" class="btn btn-warning pull-right mr-3"
                                   style="margin-right: 3% !important;"
                                ><i class="fa fa-lock"></i> Clôturer la liste
                                </a>
                                @else
                                <a href="{{ route("affectation.unlock",$fiche->id) }}" onclick="return confirm('Souhaitez-vous vraiment Ré-ouvrir ce dossier ?');" class="btn btn-primary pull-right mr-3"
                                   style="margin-right: 3% !important;"
                                ><i class="fa fa-unlock"></i>  Ré-ouvrir le dossier
                                </a>
                            @endif
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
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle Affectation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('affectation.new',$fiche->id) }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="etat" value="ouvert">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="titre">Matricule</label>
                                <input type="text" name="matricule" class="form-control" id="matricule"
                                       autocomplete="false" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="titre">statut</label>
                                <input type="text" disabled name="nom" class="form-control" id="statut"
                                       autocomplete="false" required>
                            </div>
                        </div>
                        <div class="col-sm-12" style="height: 200px">
                            <table class="table table-bordered table-striped" style="height: 100% !important;">
                                <tr>
                                    <td>Nom</td>
                                    <td id="zone_nom"></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td id="zone_contact"></td>
                                </tr>
                                <tr>
                                    <td>Dernière affectation</td>
                                    <td id="zone_affectation"></td>
                                </tr>
                                <tr>
                                    <td>Note</td>
                                    <td><span style="border-radius:  0px !important;" class="badge bg-red"
                                              id="zone_note">En Attente de vérification</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="poste">Poste</label>
                                <select name="poste_id" class="form-control" required id="poste">
                                    @foreach($postes as $poste)
                                        <option value="{{ $poste->id }}">{{$poste->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="structure">Structure</label>
                                <select name="structure_id" class="form-control" required id="structure">
                                    @foreach($districts as $district)
                                        <optgroup label="{{ $district->nom }}">
                                            @foreach($district->structures as $structure)
                                                <option value="{{ $structure->id }}">{{$structure->nom}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="verifier()" class="btn btn-outline-primary">Vérifier</button>
                            <button type="submit" disabled onautocomplete="false" readonly="true" id="submit"
                                    class="btn btn-primary">Enregistrer
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @endsection

        @section("extra-js")
            <script>
                function verifier() {
                    var mat = $("#matricule").val();
                    if (mat.length < 1) {
                        mat = "0";
                    }
                    $("#statut").val("Verification en Cours ..")
                    $.get(`/personnel/verificate/${mat}/{{$fiche->id}}`, function (data) {
                        if (data.id) {
                            $("#zone_nom").text(data.nom + " " + data.prenom);
                            $("#zone_contact").text(data.telephone);
                            $("#statut").val("Verification Terminée");
                            $("#statut").css("background-color", "green").css("color", "white");
                            if (data.lastaffectation) {
                                $("#zone_affectation").html("<b> Poste : " + data.lastaffectation.poste.nom + " | Structure : " + data.lastaffectation.structure.nom + " | Fait le " + data.lastaffectation.date + "</b>");
                            } else {
                                $("#zone_affectation").html("Aucune Affectation Trouvé pour <b>" + data.nom + " " + data.prenom + "</b>").addClass("text-uppercase");
                            }
                            if (!data.present) {
                                $("#zone_note").text("Vérification éffectuer, cliquez sur enregistré").removeClass("bg-red").addClass("bg-green");
                                $("#submit").removeAttr("disabled").removeClass("btn-primary").addClass("btn-success");
                            } else {
                                $("#zone_note").html("<b>Impossible de traiter cette requête.</b><br>le concerné fait déja partie de la liste actuel d'affectation");
                            }
                            console.log(data);
                        } else {
                            $("#statut").val("Matricule Incorrect");
                            $("#statut").css("background-color", "red").css("color", "white")
                        }
                    });
                }
            </script>
@endsection
