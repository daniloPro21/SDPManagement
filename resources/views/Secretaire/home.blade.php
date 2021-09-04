@extends('layouts.app')


@section('title')
    Dossiers
@endsection

@section('content')
<div class="row justify-content-center d-flex align-items-center">

    <div class="container" style="padding-top:2%;">
                    <a href="{{ route('dossiers.list','non-coter')}}" class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow-active">
                            <h3 class="widget-user-username"><b>{{ __("Couriel(s)")}}</b></h3>
                            <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                            </div>
                            <div class="widget-user-image">
                            <img class="img-circle" src="{{ asset('dist/img/2.png') }}" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                            <div class="row">
                                <!-- /.col -->
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $d1->count() }}</h5>
                                    <span class="description-text">Dossier(s)</span>
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

                      <a href="{{ route('dossiers.list','coter')}}" class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                              <!-- Add the bg color to the header using any of the bg-* classes -->
                              <div class="widget-user-header bg-green-active">
                                <h3 class="widget-user-username"><b>{{ __("Dossier(s) Coté(s)")}}</b></h3>
                                <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                              </div>
                              <div class="widget-user-image">
                                <img class="img-circle" src="{{ asset('dist/img/3.jpeg') }}" alt="User Avatar">
                              </div>
                              <div class="box-footer">
                                <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12">
                                    <div class="description-block">
                                      <h5 class="description-header">{{ $d3->count() }}</h5>
                                      <span class="description-text">Dossier(s)</span>
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
                      <!-- ./col -->
                        <a href="{{ route('dossiers.list','traiter')}}" class="col-md-4">
                              <!-- Widget: user widget style 1 -->
                              <div class="box box-widget widget-user">
                                <!-- Add the bg color to the header aqua any of the bg-* classes -->
                                <div class="widget-user-header bg-aqua-active">
                                  <h3 class="widget-user-username"><b>{{ __("Dossier(s) Aboutie(s)")}}</b></h3>
                                  <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                                </div>
                                <div class="widget-user-image">
                                  <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                                </div>
                                <div class="box-footer">
                                  <div class="row">
                                    <!-- /.col -->
                                  <div class="col-sm-12">
                                      <div class="description-block">
                                        <h5 class="description-header">{{ $dossiers->where('service_id', auth()->user()->service_id)->where('statut','traiter')->count() }}</h5>
                                        <span class="description-text">Dossier(s)</span>
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
        <a href="{{ route('dossiers.list','signe-admin')}}" class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header aqua any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username"><b>{{ __("Dossier(s) Signe(s)")}}</b></h3>
                    <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-sm-12">
                            <div class="description-block">
                                <h5 class="description-header">{{ $dossiers->where('service_id', auth()->user()->service_id)->where('statut','signe')->count() }}</h5>
                                <span class="description-text">Dossier(s)</span>
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
        <a href="{{ route('dossiers.list','rejete-admin')}}" class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header aqua any of the bg-* classes -->
                <div class="widget-user-header bg-danger">
                    <h3 class="widget-user-username"><b>{{ __("Dossier(s) Rejeté(s)")}}</b></h3>
                    <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-sm-12">
                            <div class="description-block">
                                <h5 class="description-header">{{ $dossiers->where('service_id', auth()->user()->service_id)->where('statut','rejete')->count() }}</h5>
                                <span class="description-text">Dossier(s)</span>
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

        <a href="{{ route('dossiers.list','transmi-admin')}}" class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header aqua any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username"><b>{{ __("Dossier(s) Transmis(s)")}}</b></h3>
                    <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-sm-12">
                            <div class="description-block">
                                <h5 class="description-header">{{ $dossiers->where('service_id', auth()->user()->service_id)->where('statut','transmis')->count() }}</h5>
                                <span class="description-text">Dossier(s)</span>
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
                     </div>
         <!-- Main content -->
    <section class="container">
        <div class="row">
          <div class="col-lg-12">
              <div class="row">
                  <button data-toggle="modal" data-target="#modifier"
                          class="btn btn-bitbucket">Ajouté un dossier

                  </button>
              </div>
            <hr>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Liste des Dossiers</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <br>
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Numero Courrier</th>
                    <th>{{ auth()->user()->general->name }}</th>
                    <th>Propriétaire</th>
                    <th>Date entrée</th>
                    <th>Date sortie</th>
                    <th>Actions</th>


                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($dossierssecre as $dossier)
                      <tr>
                          <td><a href="{{ route('dossier.detail', ['id' => $dossier->dossier->id]) }}">{{ $dossier->dossier->num_courrier }}</a></td>
                          <td>{{ $dossier->num_dossier }}</td>
                            <td>
                              <div><b>- Nom</b> : {{ $dossier->dossier->nom }}</div>
                              <div><b>- Matricule</b> : {{ $dossier->dossier->matricule }} </div>
                              <div><b>- Grade: &nbsp;</b> {{ $dossier->dossier->grade }}</div>
                            </td>
                            <td> {{ $dossier->created_at }}</td>
                            <td>{{ $dossier->date_sortie }} &nbsp;

                            </td>
                            <form action="{{ route('dossier.delete', ['id' => $dossier->dossier->id]) }}" method="post">
                            <td><a href="{{ route('dossier.detail', ['id' => $dossier->dossier->id]) }}" data-toggle="modal"  class="btn btn-primary btn-sm mb-3">
                                <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('dossier.detail', ['id' => $dossier->dossier->id]) }}"  class="btn btn-info btn-sm mb-3">
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
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
                                    <input type="text"  readonly  class="form-control"  autocomplete="false" id="DHR" required>
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


        <div class="modal fade" id="typedossier" tabindex="-1" aria-labelledby="typedossierm" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="typedossierm">Ajouter Un type de  Dossier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('typedossier.store') }}">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="numero">Nom</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                           @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="DHR">description</label>
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                           @enderror
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Save changes</button>
                    </form>
                    </div>
            </div>
            </div>
        </div>
      </section>
      <!-- /.content -->
    </div>

    @endsection
