@extends('layouts.app')

@section('css')

@endsection
@section('content')
    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <div class="col-sm-offset-1 col-md-5">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <div
                        class="widget-user-header @if($dossier->status == 'traiter')  bg-green-active @else  bg-aqua-active @endif">
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
                                        <td>Numéro Courrier</td>
                                        <td><b>{{ $dossier->num_courrier }}</b></td>
                                    </tr>
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
                                    @else
                                        <tr>
                                            <td>Status</td>
                                            <td><b>En Attente de Quotation </b></td>
                                        </tr>
                                    @endif
                                    @if ($cotations2 != null)

                                        @if($dossier->statut == 'traiter')
                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.signed',$dossier->id) }}"
                                                                   onclick="return confirm('Le dossier sera considéré comme traité')"
                                                                   class="btn btn-bitbucket btn-block">Marque comme
                                                        signe</a></td>
                                            </tr>
                                        @elseif($dossier->statut == 'encour')
                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.rejete',$dossier->id) }}"
                                                                   onclick="return confirm('Le dossier sera considéré comme rejeté')"
                                                                   class="btn btn-danger btn-block">Marquer comme
                                                        rejeté</a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.traiter',$dossier->id) }}"
                                                                   onclick="return confirm('Le d    ossier sera considéré comme traité')"
                                                                   class="btn btn-success btn-block">Marquer comme
                                                        traité</a></td>
                                            </tr>
                                        @endif
                                        @if($dossier->statut == 'rejete')
                                            <tr>
                                                <td colspan="2"><a href="{{ route('dossier.getback',$dossier->id) }}"
                                                                   onclick="return confirm('Le dossier sera remis encour de traitement')"
                                                                   class="btn btn-bitbucket btn-block">Remettre dans le
                                                        circuit</a></td>
                                            </tr>

                                                <tr>
                                                    <td colspan="2">
                                                        <button data-toggle="modal" data-target="#quotationModal"
                                                                class="btn btn-success text-white  btn-block">Modifier La cotation
                                                        </button>
                                                    </td>
                                                </tr>
                                        @endif

                                    @else

                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#qutationgeneral"
                                                        class="btn btn-success text-white  btn-block">Quoter à un
                                                    service
                                                </button>
                                            </td>
                                        </tr>
                                    @endif


                                    @admin
                                    @if($cotations2->service_id == null)
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#quotationModal"
                                                        class="btn btn-success text-white  btn-block">Quoter
                                                    à un sous service
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#quotationModal"
                                                        class="btn btn-success text-white  btn-block">Transmission
                                                </button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#quotationModal"
                                                        class="btn btn-success text-white  btn-block">Modifier La cotation
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @endadmin


                                    @secretaire
                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#modifier"
                                                    class="btn btn-info btn-block">Modifier
                                            </button>
                                        </td>
                                    </tr>
                                    @if($cotations == null)
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#quotationModal"
                                                        class="btn btn-success text-white  btn-block">Quoter
                                                    à un sous service
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($trace2->isEmpty())
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#givenumber"
                                                        class="btn btn-primary btn-block">Enregistré

                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @endsecretaire


                                    @cardre
                                    @if($trace3->isEmpty())
                                        <tr>
                                            <td colspan="2">
                                                <button data-toggle="modal" data-target="#givenumber"
                                                        class="btn btn-primary btn-block">Enregistré
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @endcardre


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


                                    @secdrh
                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#modifier"
                                                    class="btn btn-info btn-block">Modifier
                                            </button>
                                        </td>
                                    </tr>
                                    @endsecdrh


                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#exampleModal"
                                                    class="btn btn-primary btn-block">Nouvelle étiquette
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button data-toggle="modal" data-target="#transmis"
                                                    class="btn btn-primary btn-block">Nouvelle Transmission
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @superadmin
                <table class="table caption-top table-active table-bordered">
                    <caption class="text-bold h2">Informatoin de Cotation</caption>
                    <thead class="bg-aqua">
                    <tr>
                        <th scope="col">Sous Direction</th>
                        <th scope="col">Service</th>
                        <th scope="col">Attribuer à</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotations as $item)
                        <tr>
                            <td>{{$item->servicegeneral->name}}</td>
                            @if($item->services == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->services->name}}</td>
                            @endif
                            @if($item->users == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->users->name}}</td>
                            @endif
                            <td>
                                <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}"
                                   class="btn btn-info btn-sm mb-3">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}"
                                   class="btn btn-danger btn-sm mb-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endsuperadmin
                @secdrh
                <table class="table caption-top table-active table-bordered">
                    <caption class="text-bold h2">Informatoin de Cotation</caption>
                    <thead class="bg-aqua">
                    <tr>
                        <th scope="col">Sous Direction</th>
                        <th scope="col">Service</th>
                        <th scope="col">Attribuer à</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotations as $item)
                        <tr>
                            <td>{{$item->servicegeneral->name}}</td>
                            @if($item->services == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->services->name}}</td>
                            @endif
                            @if($item->users == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->users->name}}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endsecdrh
                @admin
                <table class="table caption-top table-active table-bordered">
                    <caption class="text-bold h2">Informatoin de Cotation</caption>
                    <thead class="bg-aqua">
                    <tr>
                        <th scope="col">Sous Direction</th>
                        <th scope="col">Service</th>
                        <th scope="col">Attribuer à</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotations->where("servicegeneral_id", auth()->user()->service_id) as $item)
                        <tr>
                            <td>{{$item->servicegeneral->name}}</td>
                            @if($item->services == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->services->name}}</td>
                            @endif
                            @if($item->users == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->users->name}}</td>
                            @endif
                            <td>
                                <button data-toggle="modal" data-target="#giveto"
                                        class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="{{ route('dossier.delete.cotation',['id' => $item->id ]) }}"
                                   class="btn btn-danger btn-sm mb-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endadmin
                @service
                <table class="table caption-top table-active table-bordered">
                    <caption class="text-bold h2">Informatoin de Cotation</caption>
                    <thead class="bg-aqua">
                    <tr>
                        <th scope="col">Sous Direction</th>
                        <th scope="col">Service</th>
                        <th scope="col">Attribuer à</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotations->where("service_id", auth()->user()->sous_service_id) as $item)
                        <tr>
                            <td>{{$item->servicegeneral->name}}</td>
                            @if($item->services == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->services->name}}</td>
                            @endif
                            @if($item->users == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->users->name}}</td>
                            @endif
                            <td>
                                <button data-toggle="modal" data-target="#giveto" data-user="{{$item->id}}"
                                        class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="{{ route('dossier.delete.cotation',['id' => $item->id ]) }}"
                                   class="btn btn-danger btn-sm mb-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endservice
                @cardre
                <table class="table caption-top table-active table-bordered">
                    <caption class="text-bold h2">Informatoin de Cotation</caption>
                    <thead class="bg-aqua">
                    <tr>
                        <th scope="col">Sous Direction</th>
                        <th scope="col">Service</th>
                        <th scope="col">Attribuer à</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotations->where("servicegeneral_id", auth()->user()->service_id) as $item)
                        <tr>
                            <td>{{$item->servicegeneral->name}}</td>
                            @if($item->services == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->services->name}}</td>
                            @endif
                            @if($item->users == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->users->name}}</td>
                            @endif
                            <td>
                                <button data-toggle="modal" data-target="#giveto" data-user="{{$item->id}}"
                                        class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="{{ route('dossier.delete.cotation',['id' => $item->id ]) }}"
                                   class="btn btn-danger btn-sm mb-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endcardre
                @secretaire
                <table class="table caption-top table-active table-bordered">
                    <caption class="text-bold h2">Informatoin de Cotation</caption>
                    <thead class="bg-aqua">
                    <tr>
                        <th scope="col">Sous Direction</th>
                        <th scope="col">Service</th>
                        <th scope="col">Attribuer à</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotations->where("servicegeneral_id", auth()->user()->service_id) as $item)
                        <tr>
                            <td>{{$item->servicegeneral->name}}</td>
                            @if($item->services == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->services->name}}</td>
                            @endif
                            @if($item->users == null)
                                <td>Non Assigne</td>
                            @else
                                <td>{{$item->users->name}}</td>
                            @endif
                            <td>
                                <button data-toggle="modal" data-target="#giveto"
                                        class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="{{ route('dossier.delete.cotation',['id' => $item->id ]) }}"
                                   class="btn btn-danger btn-sm mb-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endsecretaire

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
                        <span class="time"><i class="fa fa-clock-o"></i>
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $step->created_at)->format("d/m/Y") }}</span>

                                <h3 class="timeline-header"><a
                                        href="#">{{ $step->user->name }}<small>{{ $step->user->service->name }}</small>
                                    </a> à signaler</h3>

                                <div class="timeline-body row">
                                    <div class="col-sm-10">
                                        {!! $step->message !!}
                                    </div>
                                    <div class="col-sm-2">
                                        <a title="Supprimer" data-toggle="tooltip" href="{{ route('step.destroy',$step->id)}}"
                                           onclick="return confirm('voulez vous vraiment effecué cet action?')"
                                           class="btn pull-right btn-sm btn-danger"><span class="fa fa-trash"></span></a>
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
        </div>
        <div class="container">
            <h2>Informations du dossier sur le service</h2>
            <hr>
            <h3><u>Registre</u></h3>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Date d'entre</th>
                    <th>date sortir</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                @admin
                @foreach($trace as $item)
                    <tr>
                        <td>{{ $item->num_dossier }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->date_sortie }}</td>
                        <td><button data-toggle="modal" data-target="#modifier_sortire"
                                    class="btn btn-info btn-secondary">Modifier
                            </button></td>
                    </tr>
                @endforeach
                @endadmin
                @secretaire
                @foreach($trace2 as $item)
                    <tr>
                        <td>{{ $item->num_dossier }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->date_sortie }}</td>
                        <td><button data-toggle="modal" data-target="#modifier_sortire"
                                    class="btn btn-info btn-secondary">Modifier
                            </button></td>
                    </tr>
                @endforeach
                @endsecretaire
                @service
                @foreach($trace3 as $item)
                    <tr>
                        <td>{{ $item->num_dossier }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->date_sortie }}</td>
                        <td><button data-toggle="modal" data-target="#modifier_sortire"
                                    class="btn btn-info btn-secondary">Modifier
                            </button></td>
                    </tr>
                @endforeach
                @endservice
                @cardre
                @foreach($trace3 as $item)
                    <tr>
                        <td>{{ $item->num_dossier }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->date_sortie }}</td>
                        <td><button data-toggle="modal" data-target="#modifier_sortire"
                                    class="btn btn-info btn-secondary">Modifier
                            </button></td>
                    </tr>
                @endforeach
                @endcardre
                </tbody>
            </table>
            <h2>Parcours</h2>
            <hr>
            <h3><u>Trace</u></h3>
            <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Service A</th>
                    <th>Service B</th>
                    <th>Motif</th>
                    <th>date</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tracages as $item)
                    <tr>
                        <td>{{ $item->serviceA }}</td>
                        <td>{{ $item->serviceB }}</td>
                        <td>{{ $item->motif }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td><button data-toggle="modal" data-target="#transmisedit"
                                    class="btn btn-info btn-secondary">Modifier
                            </button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
                        @cardre
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="nom_service" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endcardre
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>`

    {{--Transmission Service--}}
    <div class="modal fade" id="transmis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel">Effectuer une transmission</h3>
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
                    <form action="{{ route('tracage.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="dossier_id" value="{{$dossier->id}}">
                        @secretaire
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->general->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endsecretaire
                        @service
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endservice
                        @cardre
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endcardre
                        @chefB
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endchefB
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="message">Motif</label>
                                <select class="selectpicker" name="motif">
                                        <option value="en attente de completude">en attente de completude</option>
                                        <option value="transmis pour visa">transmis pour visa</option>
                                        <option value="transmis pour completude">transmis pour completude</option>
                                </select>
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

    {{--Transmission Service edit --}}
    <div class="modal fade" id="transmisedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel">Effectuer une transmission</h3>
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
                    <form action="{{ route('tracage.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="dossier_id" value="{{$dossier->id}}">
                        @secretaire
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->general->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endsecretaire
                        @service
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endservice
                        @cardre
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endcardre
                        @chefB
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" name="serviceA" id="message" value="{{ auth()->user()->service->name }}" class="form-control"></input>
                            </div>
                        </div>
                        @endchefB
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="message">Motif</label>
                                <select class="selectpicker" name="motif">
                                    <option value="en attente de completude">en attente de completude</option>
                                    <option value="transmis pour visa">transmis pour visa</option>
                                    <option value="transmis pour completude">transmis pour completude</option>
                                </select>
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
                <form action="{{ route("dossier.quotation_service", ['id' => $dossier->id]) }}" method = "POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <select class="selectpicker" name="sous_service_id[]" multiple data-live-search="true">
                                @foreach($services->where('servicegeneral_id', auth()->user()->service_id) as $item )
                                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
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
            <form action="{{ route("dossier.quotation", ['dossier_id' => $dossier->id]) }}" method = "POST" >
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quotationModalLabel">Selectionnez un Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <select class="selectpicker" name="servicegeneral_id[]" multiple data-live-search="true">
                                @foreach ($servicesgenerals as $item )
                                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- service delegue cardre  --}}
    <div class="modal fade" id="giveto" tabindex="-1" aria-labelledby="quotationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-@title" id="quotationModalLabel">Selectionnez un cardre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($cotations2 != null )
                <form action="{{ route("dossier.cotation.update", ['id' => $item->id ]) }}" method = "POST" >
                    @endif
                    @csrf
                    <div class="modal-body">
                        <div class="col-sm-12">
                            @service
                            <div class="box box-widget widget-user">
                                <div class="row">
                                    <label> Choisir le cardre
                                        <select class="selectpicker" name="user_id">
                                            @foreach($users->where('sous_service_id', auth()->user()->sous_service_id)->where('role', 'cardre') as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                            @endservice
                            @admin
                            <div class="box box-widget widget-user">
                                <div class="row">
                                    <label> Choisir le cardre
                                        <select class="selectpicker" name="user_id">
                                            @foreach($users->where('sous_service_id', auth()->user()->sous_service_id)->where('role', 'cardre') as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                            @endadmin
                            @secretaire
                            <div class="box box-widget widget-user">
                                <div class="row">
                                    <label> Choisir le cardre
                                        <select class="selectpicker" name="user_id">
                                            @foreach($users->where('sous_service_id', auth()->user()->sous_service_id)->where('role', 'cardre') as $item )
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                            @endsecretaire
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    {{--  //Modifier Dossier  --}}
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
                                <label for="DHR">Numéro Courrier</label>
                                <input type="text" name="num_courrier" value="{{ $dossier->num_courrier }}"
                                       class="form-control" id="DHR" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="DHR">Numéro Service</label>
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
@section('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            //$('#dossiers').DataTable()
            $('#dossiers').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })

       $
    </script>
@stop

