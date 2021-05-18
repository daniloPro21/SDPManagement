@extends('layouts.app')

@section('css')

@endsection
@section('content')
  <div class="row justify-content-center d-flex align-items-center">
      <div class="container">
        <div class="col-sm-offset-1 col-md-5">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header @if($dossier->traiter)  bg-green-active @else  bg-aqua-active @endif">
                <h3 class="widget-user-username text-capitalize">{{ $dossier->prenom }} {{ $dossier->nom }}</h3>
                <h5 class="widget-user-desc"> @if($dossier->traiter)  Dossier Traité @else {{ $dossier->date_entre }} @endif</h5>
                </div>
                <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('dist/img/3.jpeg') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                <div class="row">
                    <!-- /.col -->
                <div class="col-sm-12">
                    <table class="table table-responsive table-striped text-capitalize">
                    <tr>
                        <td>Numéro DRH </td><td><b>{{ $dossier->num_drh }}</b></td>
                    </tr>
                    @if($cotationDossier)
                    @foreach ($cotationDossier as $concerne )
                    <tr>
                        <td>Cotéé à </td><td><b> {{ $concerne->name }} </b></td>
                    </tr>

                    <tr>
                        <td>Numero du Service</td><td><b>{{ $concerne->num_dossier }}</b></td>
                    </tr>
                    @endforeach
                    @endif
                    @if ($dossier->num_service != null)
                    <tr>
                        <td>Numéro Service </td><td><b>{{ $dossier->num_service }}</b></td>
                    </tr>
                    @endif
                    <tr>
                        <td>Nom </td><td><b>{{ $dossier->nom }}</b></td>
                    </tr>
                    <tr>
                        <td>Prénom</td><td><b>{{ $dossier->prenom }}</b></td>
                    </tr>

                    <tr>
                        <td>Objet</td><td><b>{{ $dossier->type->name }}</b></td>
                    </tr>
                        <tr>
                        <td>Date d Entrée</td><td><b>{{ $dossier->date_entre }}</b></td>
                        </tr>
                        <tr>
                        <td>Note</td><td><b>{{ $dossier->note }}</b></td>
                        </tr>
                        @if ($dossier->service_id != null)
                        <tr>
                            <td>Service_Principale</td><td><b>{{ $dossier->service->name }}</b></td>
                        </tr>

                            @if (!$dossier->traiter)
                                <tr>
                                    <td colspan="2"><a href="{{ route('dossier.traiter',$dossier->id) }}" onclick="return confirm('Le dossier sera considéré comme traité')"  class="btn btn-success btn-block">Marquer comme Traité</a> </td>
                                </tr>
                                @endif
                        {{--  @else  --}}
                        @admin
                        @if($cotationDossier)
                         @foreach ($cotationDossier as $concerne )
                                @if (is_null($concerne->id_service))
                        <tr>
                            <td colspan="2"><button data-toggle="modal" data-target="#quotationModal" class="btn btn-success text-white  btn-block">Quoter à un sous service</button> </td>
                        </tr>
                        @endif

                        @endforeach
                        @endif
                        @endadmin
                        @endif
                        @superadmin
                            @if(is_null($dossier->service_id))
                        <tr>
                            <td colspan="2"><button data-toggle="modal" data-target="#qutationgeneral" class="btn btn-success text-white  btn-block">Quoter à un service</button> </td>
                        </tr>
                        @endif
                        @endsuperadmin
                        <tr>
                        <td colspan="2"><button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-block">Nouvelle étiquette</button> </td>
                        </tr>
                        <tr>
                            <td colspan="2"><button data-toggle="modal" data-target="#modifier" class="btn btn-info btn-block">Modifier</button> </td>
                        </tr>
                    </table>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
            </div>
                    <div class="col-md-5">
                        <!-- The time line -->
                        <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                                <span class="bg-red">
                                {{ Carbon\Carbon::createFromFormat("Y-m-d",$dossier->date_entre)->format("d/m/Y") }}
                                </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->

                        @foreach ($dossier->steps as $step)

                            <li>
                            @if ($step->type=="info")
                                <i title="Information" data-toggle="tooltip" class="fa fa-info bg-blue"></i>
                            @elseif ($step->type=="warning")
                                <i title="Problème" data-toggle="tooltip" class="fa fa-warning bg-red"></i>
                            @elseif ($step->type=="success")
                                <i title="Succès" data-toggle="tooltip" class="fa fa-check bg-green"></i>
                            @elseif($step->type=="move")
                                <i title="Deplacement" data-toggle="tooltip" class="fa fa-arrows bg-aqua"></i>
                            @endif


                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $step->created_at)->format("d/m/Y") }}</span>

                                <h3 class="timeline-header"><a href="#">{{ $step->user->name }}</a> à signaler</h3>

                                <div class="timeline-body row">
                                <div class="col-sm-10">
                                    {!! $step->message !!}
                                </div>
                                <div class="col-sm-2">
                                    <a title="Supprimer" data-toggle="tooltip" href="{{ route('step.destroy',$step->id)}}" onclick="return confirm('voulez vous vraiment effecué cet action?')" class="btn pull-right btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                                    <div class="clearfix">
                                </div>
                                </div>
                                </div>
                            </div>
                            </li>

                        @endforeach


                        <!-- END timeline item -->

                        <!-- timeline item -->  <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                        </ul>
                    </div>
                    <!-- /.col -->
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel">Ajouter une étiquette</h3>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                            <form action="{{ route('step.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="dossier_id" value="{{$dossier->id}}">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="type">Type d étiquette</label>
                                    <select class="form-control" name="type">
                                        <option value="info">Information</option>
                                        <option value="warning">Problème</option>
                                        <option value="move">Déplacement</option>
                                        <option value="success">Succès</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="message">Message</label>
                                    <textarea required name="message" id="message" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit"  class="btn btn-primary">Enregistrer</button>
                            </form>
                            </div>
                    </div>
                    </div>
                    </div>

                    {{--  //Coter a un sous service  --}}
                    <div class="modal fade" id="quotationModal" tabindex="-2" aria-labelledby="quotationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="quotationModalLabel">Selectionnez un Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                 <div class="col-sm-12">
                                        <form method="POST" action="{{ route('dossier.quotation-service') }}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                <label for="inputEmail4">Attribuer un Numero au Dossier</label>
                                                <input type="text" name="num_dossier" id="" class="form-control" placeholder="example SDP-34632" required>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="service">Service à transmettre</label>
                                                    <select class="custom-select form-control" name="id_service">
                                                        {{-- <option selected>Choisir le type</option> --}}
                                                        @foreach ($serviceslier as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                     <input type="hidden" name="id_dossier" value="{{ $dossier->id }}" class="form-control" placeholder="example SDP-34632" required>
                                                </div>
                                            </div>

                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    <button type="submit"  class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                            </div>
                     </div>
                 </div>

{{--
                 Admin cotation  --}}
                 <div class="modal fade" id="qutationgeneral" tabindex="-2" aria-labelledby="quotationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="quotationModalLabel">Selectionnez un Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                             <div class="col-sm-12">
                               @foreach ($servicesgenerals as $item )
                               <a onclick="return confirm('Transferé le dossier a ce service ?');" href="{{ route('dossier.quotation',[$item->id,$dossier->id])}}" class="col-sm-4">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-green-active">
                                    </div>
                                    <div class="widget-user-image">
                                    <img class="img-circle" src="{{ asset('dist/img/armoirie.png') }}" width="50px" height="30px" alt="Service">
                                    </div>
                                    <div class="box-footer">
                                    <div class="row">
                                        <!-- /.col -->
                                    <div class="col-sm-12">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $item->name }}</h5>
                                        </div>
                                        <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                                 </a>
                               @endforeach
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit"  class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                 </div>
             </div>



                {{--  //Modifier User  --}}
                <div class="modal fade" id="modifier" tabindex="-1" aria-labelledby="modifierD" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modifierD">Modification du Dossier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('dossier.update', ['id' => $dossier->id]) }}">
                                @csrf
                                @method('patch')
                                <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="DHR">Numéro DRH</label>
                                    <input type="text" name="num_drh" value="{{ $dossier->num_drh }}" class="form-control" id="DHR" required>
                                </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nom du Propriétaire</label>
                                    <input type="text" name="nom" id="" value="{{ $dossier->nom }}" class="form-control" placeholder="entre le nom du proprietaire" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Prénom du Propriétaire</label>
                                        <input type="text" name="prenom" id="" value="{{ $dossier->prenom }}" class="form-control" placeholder="entre le prenom du proprietaire" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Matricule</label>
                                        <input type="text" name="matricule" id="" value="{{ $dossier->matricule }}" class="form-control" placeholder="entre le matricule du proprietaire" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Grade</label>
                                        <input type="text" name="grade" id="" value="{{ $dossier->grade }}" class="form-control" placeholder="entre le grade du proprietaire" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputPassword4">Date Entrée</label>
                                    <input type="date" name="date_entre" value="{{ $dossier->date_entre }}" class="form-control" id="inputPassword4" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Date de sortie</label>
                                        <input type="date" name="date_sortie" class="form-control" value="{{ $dossier->date_sortie }}" id="inputPassword4" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Type</label>
                                        <select class="custom-select form-control" name="type_id">
                                            {{-- <option selected>Choisir le type</option> --}}
                                            @foreach ($types as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Note</label>
                                    <textarea name="note" id="" cols="30" placeholder="{{ $dossier->note }}"  rows="10"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit"  class="btn btn-primary">Enregistrer</button>
                            </form>
                            </div>
                    </div>

                    </div>
                </div>


      </div>

@endsection
