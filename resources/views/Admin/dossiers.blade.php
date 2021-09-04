@extends('layouts.app')

@section('title')
    Dossiers
@endsection

@section('content')
  <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            @secdrh
            <div class="row">
                <button data-toggle="modal" data-target="#modifier"
                        class="btn btn-bitbucket">Ajouté un dossier

                </button>
            </div>
            @endsecdrh
            @secretaire
            <div class="row">
                <button data-toggle="modal" data-target="#modifier"
                        class="btn btn-bitbucket">Ajouté un dossier

                </button>
            </div>
            @endsecretaire
            <div class="modal fade" id="modifier" tabindex="-1" aria-labelledby="modifierD" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifierD">Ajouter Un Dossier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('dossier.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="DHR">Numero Courier</label>
                                        <input type="text" name="num_courrier" class="form-control"  autocomplete="false" id="DHR" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="DHR">Numero Service</label>
                                        <input type="text" readonly class="form-control"  autocomplete="false" id="DHR" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Nom du destinataire</label>
                                        <input type="text" name="nom" id="" class="form-control" placeholder="entre le nom du proprietaire" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Prénom</label>
                                        <input type="text" name="prenom" id="" class="form-control" placeholder="entre le prenom du proprietaire" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Matricule</label>
                                        <input type="text" name="matricule" id="" class="form-control" placeholder="entre le matricule du proprietaire">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Telephone</label>
                                        <input type="text" name="telephone" id="" class="form-control" placeholder="entre le telephone du proprietaire" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Grade</label>
                                        <input type="text" name="grade" id="" class="form-control" placeholder="entre le grade du proprietaire" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Date d entrée</label>
                                        <input type="date" name="date_entre" class="form-control" id="inputPassword4" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sexe">Sexe</label>
                                        <select class="form-control" name="sexe">
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Type</label>
                                        <select class="custom-select form-control" name="type_id">
                                            {{-- <option selected>Choisir le type</option> --}}
                                            @foreach ($types as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="inputPassword4">Constitution du dossier</label>
                                            <textarea name="constitution" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="inputPassword4">Mention</label>
                                            <textarea name="note" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit"  class="btn btn-primary">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        @superadmin
        <a href="{{ route('dossiers.list','coter')}}">
            @endsuperadmin
            @secdrh
            <a href="{{ route('dossiers.list','coter')}}">
                @endsecdrh
            @admin
            <a href="{{ route('dossiers.coter-admin')}}">
                @endadmin
            <div class="col-md-offset-2 col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username"><b>Dossiers Quotés</b></h3>
                        <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('dist/img/3.jpeg') }}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-sm-12">
                               @superadmin
                                <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('service_id','!=',null)->where('statut','encour')->count() }}</h5>
                                    <span class="description-text">Requete(s)</span>
                                </div>
                                @endsuperadmin
                                @secdrh
                                <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('service_id','!=',null)->where('statut','encour')->count() }}</h5>
                                    <span class="description-text">Requete(s)</span>
                                </div>
                                @endsecdrh
                                @admin <div class="description-block">
                                    <h5 class="description-header">{{ $d3 }}</h5>
                                    <span class="description-text">Requete(s)</span>
                                </div>
                                @endadmin
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </a>
        @superadmin
        <a href="{{ route('dossiers.list','traiterSuper')}}">
            @endsuperadmin
            @secdrh
        <a href="{{ route('dossiers.list','traiterSuper')}}">
            @endsecdrh
            @admin
            <a href="{{ route('dossiers.traiter-admin')}}">
                @endadmin

            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-green">
                        <h3 class="widget-user-username"><b>Dossiers traités</b></h3>
                        <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            @superadmin
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('statut','traiter')->count() }}</h5>
                                    <span class="description-text">Requete(s)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            @endsuperadmin
                            @secdrh
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('statut','traiter')->count() }}</h5>
                                    <span class="description-text">Requete(s)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            @endsecdrh
                            @admin
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('service_id',auth()->user()->service_id)->where('statut','traiter')->count() }}</h5>
                                    <span class="description-text">Requete(s)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            @endadmin
                        </div>
                        <!-- /.row -->

                    </div>
                </div>
                <!-- /.widget-user -->
            </div>

        </a>

            <br><br>

    <section>

        <table id="example" class="table table-bordered table-hover">

            <thead>
            <tr>
              <th>Numero DRH</th>
              <th>Appartien A</th>
              <th>Status</th>
              <th>Date entre</th>
              <th>Date Sortie</th>
              <th>Actions</th>


            </tr>
            </thead>
            @admin
            <tbody>
                @foreach ($d2 as $dossier)
                <tr>
                    <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_drh }}</a></td>

                      <td><b>- Nom</b> : {{ $dossier->nom }} <br>
                          - <b>Matricule</b> : {{ $dossier->matricule }} <br>
                          - <b>Grade: &nbsp;</b> {{ $dossier->grade }} <br>

                      </td>
                    @if($dossier->statut == "traiter")
                      <td class="badge bg-yellow-active"> {{ $dossier->statut }}</td>
                    @elseif ($dossier->statut == "encour")
                        <td class="badge bg-green-active"> {{ $dossier->statut }}</td>
                    @else
                        <td class="badge bg-aqua-active"> {{ $dossier->statut }}</td>
                    @endif

                    <td> {{ $dossier->date_entre }}</td>
                      <td>{{ $dossier->date_sortie }} &nbsp;</td>
                      <form action="{{ route('dossier.delete', ['id' => $dossier->id]) }}" method="post">
                      <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}" data-toggle="modal"  class="btn btn-primary btn-sm mb-3">
                          <i class="fa fa-edit"></i>
                          </a>
                          <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}"  class="btn btn-info btn-sm mb-3">
                              <i class="fa fa-eye"></i>
                          </a>
                              @csrf
                              @method('patch')
                              <button type="submit"  class="btn btn-danger btn-sm mb-3">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </td>
                      </form>
                  </tr>
                  @endforeach

          </tbody>
            @endadmin
            @superadmin
            <tbody>
            @foreach ($dossiers->where('service_id','!=',null) as $dossier)
                <tr>
                    <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_drh }}</a></td>
                    <td>{{ $dossier->service->name }}</td>

                    <td><b>- Nom</b> : {{ $dossier->nom }} <br>
                        - <b>Matricule</b> : {{ $dossier->matricule }} <br>
                        - <b>Grade: &nbsp;</b> {{ $dossier->grade }} <br>

                    </td>
                    @if($dossier->statut == "traiter")
                        <td class="badge bg-yellow-active"> {{ $dossier->statut }}</td>
                    @elseif ($dossier->statut == "encour")
                        <td class="badge bg-green-active"> {{ $dossier->statut }}</td>
                    @else
                        <td class="badge bg-aqua-active"> {{ $dossier->statut }}</td>
                    @endif
                    <td> {{ $dossier->date_entre }}</td>
                    <td>{{ $dossier->date_sortie }} &nbsp;

                    </td>
                    <form action="{{ route('dossier.delete', ['id' => $dossier->id]) }}" method="post">
                        <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}" data-toggle="modal"  class="btn btn-primary btn-sm mb-3">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}"  class="btn btn-info btn-sm mb-3">
                                <i class="fa fa-eye"></i>
                            </a>
                            @csrf
                            @method('patch')
                            <button type="submit"  class="btn btn-danger btn-sm mb-3">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </form>
                </tr>
            @endforeach

            </tbody>
            @endsuperadmin

            @secdrh
            <tbody>
            @foreach ($dossiers->where('service_id','!=',null)->where('statut','encour') as $dossier)
                <tr>
                    <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_drh }}</a></td>
                    <td>{{ $dossier->service->name }}</td>

                    <td><b>- Nom</b> : {{ $dossier->nom }} <br>
                        - <b>Matricule</b> : {{ $dossier->matricule }} <br>
                        - <b>Grade: &nbsp;</b> {{ $dossier->grade }} <br>

                    </td>
                    @if($dossier->statut == "traiter")
                        <td class="badge bg-yellow-active"> {{ $dossier->statut }}</td>
                    @elseif ($dossier->statut == "encour")
                        <td class="badge bg-green-active"> {{ $dossier->statut }}</td>
                    @else
                        <td class="badge bg-aqua-active"> {{ $dossier->statut }}</td>
                    @endif
                    <td> {{ $dossier->date_entre }}</td>
                    <td>{{ $dossier->date_sortie }} &nbsp;

                    </td>
                    <form action="{{ route('dossier.delete', ['id' => $dossier->id]) }}" method="post">
                        <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}" data-toggle="modal"  class="btn btn-primary btn-sm mb-3">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}"  class="btn btn-info btn-sm mb-3">
                                <i class="fa fa-eye"></i>
                            </a>
                            @csrf
                            @method('patch')
                            <button type="submit"  class="btn btn-danger btn-sm mb-3">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </form>
                </tr>
            @endforeach

            </tbody>
            @endsecdrh

        </table>
    </section>
    </div>
                <!-- ./col -->
            </div>
@stop
