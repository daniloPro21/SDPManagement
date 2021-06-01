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
                    <div class="widget-user-header @if($dossier->status == 'traiter')  bg-green-active @else  bg-aqua-active @endif">
                        <h3 class="widget-user-username text-capitalize">{{ $dossier->prenom }} {{ $dossier->nom }}</h3>
                        <h5 class="widget-user-desc"> @if($dossier->status =='traiter')  Dossier
                            Traité @else {{ $dossier->date_entre }} @endif</h5>
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
                                        <td>Numéro DRH</td>
                                        <td><b>{{ $dossier->num_drh }}</b></td>
                                    </tr>
                                    @if($dossier->sous_service_id != null)
                                            <tr>
                                                <td>Cotéé à</td>
                                                <td><b> {{ $dossier->services->name }} </b></td>
                                            </tr>
                                        @else
                                                <tr>
                                                    <td>Cotéé à</td>
                                                    <td><b> Aucun </b></td>
                                                </tr>
                                    @endif
                                    @if ($dossier->num_service != null)
                                        <tr>
                                            <td>Numéro Service</td>
                                            <td><b>{{ $dossier->num_service }}</b></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Nom</td>
                                        <td><b>{{ $dossier->nom }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Prénom</td>
                                        <td><b>{{ $dossier->prenom }}</b></td>
                                    </tr>

                                    <tr>
                                        <td>Objet</td>
                                        <td><b>{{ $dossier->type->name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Date d Entrée</td>
                                        <td><b>{{ $dossier->date_entre }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Note</td>
                                        <td><b>{{ $dossier->note }}</b></td>
                                    </tr>
                                    @if($dossier->statut)
                                        <tr>
                                            <td>Status</td>
                                            <td><b class="@if($dossier->statut == 'traiter') btn-success
                                                    @elseif($dossier->statut == 'rejete') btn-danger
                                                    @elseif($dossier->statut == 'signed') btn-primary
                                                    @elseif($dossier->statut == 'encour') btn-bitbucket
                                                    @else
                                                    btn-aqua
                                                    @endif">{{ $dossier->statut }}</b></td>
                                        </tr>
                                    @endif

                                    @superadmin
                                    @if($dossier->service_id == NULL)
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#qutationgeneral"
                                                        class="btn btn-success text-white  btn-block">Quoter à un
                                                    service
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @endsuperadmin



                                    @if ($dossier->service_id != null)
                                        <tr>
                                            <td>Service_Principale</td>
                                            <td><b>{{ $dossier->service->name }}</b></td>
                                        </tr>
                                        @if($dossier->statut == 'traiter')
                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.signed',$dossier->id) }}"
                                                                   onclick="return confirm('Le dossier sera considéré comme traité')"
                                                                   class="btn btn-bitbucket btn-block">Marque comme signe</a></td>
                                            </tr>
                                        @elseif($dossier->statut == 'encour')
                                        <tr>
                                            <td colspan="2"><a href="{{ route('dossier.rejete',$dossier->id) }}"
                                                               onclick="return confirm('Le dossier sera considéré comme rejeté')"
                                                               class="btn btn-danger btn-block">Marquer comme rejeté</a></td>
                                        </tr>

                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.traiter',$dossier->id) }}"
                                                                   onclick="return confirm('Le d    ossier sera considéré comme traité')"
                                                                   class="btn btn-success btn-block">Marquer comme traité</a></td>
                                            </tr>

                                        @endif
                                        @if($dossier->statut == 'rejete')
                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.getback',$dossier->id) }}"
                                                                   onclick="return confirm('Le dossier sera remis encour de traitement')"
                                                                   class="btn btn-bitbucket btn-block">Remettre dans le circuit</a></td>
                                            </tr>
                                                @endif

                                        {{--  @else  --}}






                                        @admin
                                        @if($dossier->sous_service_id == null)
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#quotationModal"
                                                        class="btn btn-success text-white  btn-block">Quoter
                                                    à un sous service
                                                </button>
                                            </td>
                                        </tr>
                                        @endif
                                        @endadmin
                                    @endif
                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#exampleModal"
                                                    class="btn btn-primary btn-block">Nouvelle étiquette
                                            </button>
                                        </td>
                                    </tr>
                                    @secretaire

                                    @if($trace->isEmpty())
                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#givenumber"
                                                    class="btn btn-primary btn-block">Enregistré

                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endsecretaire

                                    @service
                                    @if($trace2->isEmpty())
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#givenumber"
                                                        class="btn btn-primary btn-block">Enregistré
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($trace2)
                                        @if(!$delegue)
                                            <tr>
                                                <td colspan="2">
                                                    <button data-toggle="modal" data-target="#giveto"
                                                            class="btn btn-secondary btn-block">Delegue à
                                                    </button>
                                                </td>
                                            </tr>
                                            @endif
                                    @endif
                                    @endservice

    <!--                                    <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#transition"
                                                        class="btn btn-bitbucket btn-block">Transmettre
                                                </button>
                                            </td>
                                        </tr>-->
                                    @secdrh
                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#modifier"
                                                    class="btn btn-info btn-block">Modifier
                                            </button>
                                        </td>
                                    </tr>
                                    @endsecdrh
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
                                <ia title="Problème" data-toggle="tooltip" class="fa fa-warning bg-red"></ia>
                            @elseif ($step->type=="success")
                                <i title="Succès" data-toggle="tooltip" class="fa fa-check bg-green"></i>
                            @elseif($step->type=="move")
                                <i title="Deplacement" data-toggle="tooltip" class="fa fa-arrows bg-aqua"></i>
                            @endif


                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $step->created_at)->format("d/m/Y") }}</span>

                                <h3 class="timeline-header"><a href="#">{{ $step->user->name }}<small>{{ $step->user->service->name }}</small>
                                    </a> à signaler</h3>

                                <div class="timeline-body row">
                                    <div class="col-sm-10">
                                        {!! $step->message !!}
                                    </div>
                                    <div class="col-sm-2">
                                        <a title="Supprimer" data-toggle="tooltip"
                                           href="{{ route('step.destroy',$step->id)}}"
                                           onclick="return confirm('voulez vous vraiment effecué cet action?')"
                                           class="btn pull-right btn-sm btn-danger"><span
                                                class="fa fa-trash"></span></a>
                                        <div class="clearfix">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                @endforeach


                <!-- END timeline item -->

                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <h2>Informations du dossier sur le service</h2>
                @if($delegue)
                    <h4>Dossier Delegue à <i class="btn btn-bitbucket">{{ $delegue->users->name}}</i></h4>
                    <small>le {{ $delegue->created_at }}</small>
                    @endif
                <hr>
                @admin
                @foreach ($trace as $item)
                    <div class="row">
                       <div class="col-sm-12">
                           <div class="card" style="width: 20rem;">
                               <ul class="list-group list-group-flush">
                                   <li class="list-group-item">Numero : {{ $item->num_dossier }} </li>
                                   <li class="list-group-item">Date D'Entrée : {{ $item->created_at }}</li>
                                   <li class="list-group-item">Date Sortie  : {{ $item->date_sortie }}</li>
                                   <li class="list-group-item">
                                       <button data-toggle="modal" data-target="#modifier_sortire"
                                               class="btn btn-info btn-secondary">Modifier
                                       </button>
                                   </li>
                               </ul>
                           </div>
                       </div>
                    </div>
                    @endforeach
                @endadmin
            </div>
            <div class="col-md-12">
                @secretaire
                @foreach ($trace2 as $item)
                    <div class="card" style="width: 20rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Numero {{auth()->user()->general->name}} : {{ $item->num_dossier }} </li>
                            <li class="list-group-item">Date D'Entrée : {{ $item->created_at }}</li>
                            <li class="list-group-item">Date Sortie  : {{ $item->date_sortie }}</li>
                            <li class="list-group-item">
                                <button data-toggle="modal" data-target="#modifier_sortire"
                                        class="btn btn-info btn-secondary">Modifier
                                </button>
                            </li>
                        </ul>
                    </div>
                @endforeach
                @endsecretaire
                @service
                @foreach ($trace2 as $item)
                    <div class="card" style="width: 20rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Numero {{auth()->user()->service->name}} : {{ $item->num_dossier }} </li>
                            <li class="list-group-item">Date D'Entrée : {{ $item->created_at }}</li>
                            <li class="list-group-item">Date Sortie  : {{ $item->date_sortie }}</li>
                            <li class="list-group-item">
                                <button data-toggle="modal" data-target="#modifier_sortire"
                                        class="btn btn-info btn-secondary">Modifier
                                </button>
                            </li>
                        </ul>
                    </div>
                @endforeach
                @endservice
                @cardre
                @foreach ($trace2 as $item)
                    <div class="card" style="width: 20rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Numero {{auth()->user()->service->name}} : {{ $item->num_dossier }} </li>
                            <li class="list-group-item">Date D'Entrée : {{ $item->created_at }}</li>
                            <li class="list-group-item">Date Sortie  : {{ $item->date_sortie }}</li>
                            <li class="list-group-item">
                                <button data-toggle="modal" data-target="#modifier_sortire"
                                        class="btn btn-info btn-secondary">Modifier
                                </button>
                            </li>
                        </ul>
                    </div>
                @endforeach
                @endcardre
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
                        <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel">Ajouter une
                            étiquette</h3>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--give numbers--}}
        <div class="modal fade" id="givenumber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel">Enregistre Pour mon service</h3>
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
                        <form action="{{ route('trace.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_dossier" value="{{$dossier->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="message">Numero</label>
                                    <input type="text" name="num_dossier"  id="message" class="form-control">
                                </div>
                            </div>
                            @secretaire
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="nom_service" id="message" value="{{ auth()->user()->general->name }}" class="form-control"></input>
                                </div>
                            </div>
                            @endsecretaire
                            @service
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="nom_service" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                                </div>
                            </div>
                            @endservice
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--give outside date--}}
        <div class="modal fade" id="modifier_sortire" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title text-uppercase text-center" id="exampleModalLabel">Modifier Date de Sortie</h5>
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
                        <form action="{{ route('trace.update') }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="id_dossier" value="{{$dossier->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="message">Date de sortie</label>
                                    <input type="date" name="date_sortie" id="message" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--  //Coter a un sous service  --}}
        <div class="modal fade" id="quotationModal" tabindex="-2" aria-labelledby="quotationModalLabel"
             aria-hidden="true">
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
                            @foreach ($services->where('servicegeneral_id', auth()->user()->service_id) as $item )
                                <a onclick="return confirm('Transferé le dossier a ce service ?');"
                                   href="{{ route('dossier.quotation_service',['id_service' => $item->id, 'dossier_id' => $dossier->id]) }}" class="col-sm-4">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-green-active">
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ asset('dist/img/armoirie.png') }}"
                                                 width="50px" height="30px" alt="Service">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <!-- /.col -->
                                                <div class="col-sm-12">
                                                    <div class="description-block">
                                                        <small>{{ $item->name }}</small>
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
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

        {{--  //Coter a un sous service  --}}
        <div class="modal fade" id="transition" tabindex="-2" aria-labelledby="quotationModalLabel"
             aria-hidden="true">
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
                            @foreach ($services->where('servicegeneral_id', auth()->user()->service_id) as $item )
                                <a onclick="return confirm('Transferé le dossier a ce service ?');"
                                   href="{{ route('dossier.transmis',['id_service' => $item->id, 'dossier_id' => $dossier->id]) }}" class="col-sm-4">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-green-active">
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ asset('dist/img/armoirie.png') }}"
                                                 width="50px" height="30px" alt="Service">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <!-- /.col -->
                                                <div class="col-sm-12">
                                                    <div class="description-block">
                                                        <small>{{ $item->name }}</small>
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
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- // Cote numero --}}
        <div class="modal fade" id="attribureNumero" tabindex="-2" aria-labelledby="quotationModalLabel"
             aria-hidden="true">
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
                            <form method="POST" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Attribuer un Numero au Dossier</label>
                                        <input type="text" name="num_dossier" id="" class="form-control"
                                               placeholder="example SDP-34632" required>
                                    </div>
                                </div>
                                </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                            </form>
                </div>
            </div>
        </div>

        {{-- Admin cotation  --}}
        <div class="modal fade" id="qutationgeneral" tabindex="-2" aria-labelledby="quotationModalLabel"
             aria-hidden="true">
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
                                <a onclick="return confirm('Transferé le dossier a ce service ?');"
                                   href="{{ route('dossier.quotation',[$item->id,$dossier->id])}}" class="col-sm-4">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-green-active">
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ asset('dist/img/armoirie.png') }}"
                                                 width="50px" height="30px" alt="Service">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <!-- /.col -->
                                                <div class="col-sm-12">
                                                    <div class="description-block">
                                                        <small class="text-amber-lighter">{{ $item->name }}</small>
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
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- service delegue cardre  --}}
        <div class="modal fade" id="giveto" tabindex="-2" aria-labelledby="quotationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quotationModalLabel">Selectionnez un cardre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            @foreach ($users->where('sous_service_id', auth()->user()->sous_service_id)->where('role', 'cardre') as $item )
                                <a onclick="return confirm('Delegue le dossier à ?');"
                                   href="{{ route('dossier.delegue',[$dossier->id,$item->id])}}" class="col-sm-4">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-green-active">
                                        </div>
                                        <div class="widget-user-image">
                                            <img class="img-circle" src="{{ asset('dist/img/armoirie.png') }}"
                                                 width="50px" height="30px" alt="Service">
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <!-- /.col -->
                                                <div class="col-sm-12">
                                                    <div class="description-block">
                                                        <small class="text-amber-lighter">{{ $item->name }}</small>
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
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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
                                    <input type="text" name="num_drh" value="{{ $dossier->num_drh }}"
                                           class="form-control" id="DHR" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nom du Propriétaire</label>
                                    <input type="text" name="nom" id="" value="{{ $dossier->nom }}" class="form-control"
                                           placeholder="entre le nom du proprietaire" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Prénom du Propriétaire</label>
                                    <input type="text" name="prenom" id="" value="{{ $dossier->prenom }}"
                                           class="form-control" placeholder="entre le prenom du proprietaire" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Matricule</label>
                                    <input type="text" name="matricule" id="" value="{{ $dossier->matricule }}"
                                           class="form-control" placeholder="entre le matricule du proprietaire"
                                           required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Grade</label>
                                    <input type="text" name="grade" id="" value="{{ $dossier->grade }}"
                                           class="form-control" placeholder="entre le grade du proprietaire" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Date Entrée</label>
                                    <input type="date" name="date_entre" value="{{ $dossier->date_entre }}"
                                           class="form-control" id="inputPassword4" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Date de sortie</label>
                                    <input type="date" name="date_sortie" class="form-control"
                                           value="{{ $dossier->date_sortie }}" id="inputPassword4" required>
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
                                <textarea name="note" id="" cols="30" placeholder="{{ $dossier->note }}"
                                          rows="10"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection
