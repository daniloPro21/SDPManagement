@extends('layouts.app')

@section('title')
    Bordereaux
@endsection

@section('content')
    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-sm-offset-10 col-sm-2">
                    <a href="#" data-toggle="modal" data-target="#affectationModal"
                       class="d-flex btn btn-primary btn-sm mb-1">Nouvel Bordereau de Dossiers</a>
                </div>
            </div>
        @forelse($bordereaux as $bord)
            <!-- /.col -->
                <a href="{{route('bordreau.show',$bord->id)}}" style="text-decoration:none;color:black"
                   class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                        <div class="info-box-content">
                            <h4>{{ $bord->titre }}</h4>
                            <h4>{{ $bord->numero }}</h4>
                            <small class="text-muted">
                                {{ $bord->service->name }}</small>
                            <br>
                            <small class="text-muted">
                                {{ Carbon\Carbon::createFromFormat("Y-m-d",$bord->date)->format("d/m/Y") }}</small>
                            <br>
                            <small style="display: flex;justify-content: right;bottom: 0;">
                                @if($bord->etat=="ouvert")
                                    <i class="badge badge-green bg-green">{{  $bord->etat }}</i>
                                @else
                                    <i class="badge badge-red bg-red">Cloturé</i>
                                @endif
                            </small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            @empty
                <h1 align="center"
                    style="color:rgba(128, 128, 128, 0.781);font-size: 95px !important;position: absolute;top: 40%;left:35%;">
                    Aucune Données !</h1>
            @endforelse
        </div>
        <div class="col-sm-offset-4">   {{ $bordereaux->links() }}</div>
    </div>

    <div class="modal fade" id="affectationModal" tabindex="-1" aria-labelledby="AffectationModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveaux Bordereaux</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('bordreau.store') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="etat" value="ouvert">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="decision">Numéro de Décision</label>
                                <input type="text" name="numero" id="numero" class="form-control"
                                       autocomplete="false" placeholder="Numéro de Décision">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Titre</label>
                                <input type="text" name="titre" class="form-control" id="titre"
                                       autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="entete">Entête</label>
                                <input type="text" name="entete" class="form-control" id="entete"
                                       autocomplete="false" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="decision">Date</label>
                                <input type="date" name="date" id="date" class="form-control"
                                       autocomplete="false">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="titre">Service à Transmettre</label>
                                <textarea name="destinataire" class="form-control" rows="2" id="titre" autocomplete="false"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="decision">Observation</label>
                                <textarea name="observation" id="observation" rows="4"
                                          class="form-control textareaFeat"></textarea>
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
