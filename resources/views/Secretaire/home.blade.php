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
                            <h3 class="widget-user-username"><b>{{ __("Dossier(s) Non Quoté(s)")}}</b></h3>
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
                                    <h5 class="description-header">{{ $dossiers->where('service_id',null)->count() }}</h5>
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
                                <h3 class="widget-user-username"><b>{{ __("Dossier(s) Quoté(s)")}}</b></h3>
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
                                      <h5 class="description-header">{{ $dossiers->where('service_id','!=',null)->where('traiter',false)->count() }}</h5>
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
                                  <h3 class="widget-user-username"><b>{{ __("Dossier(s) Traité(s)")}}</b></h3>
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
                                        <h5 class="description-header">{{ $dossiers->where('traiter',true)->count() }}</h5>
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
            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg mb-3">AJouter un Dossier</a>
            <a href="#" data-toggle="modal" data-target="#typedossier" class="btn btn-primary btn-lg mb-3">AJouter un type de dossier</a>
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
                    <th>SDP</th>
                    <th>DRH</th>
                    <th>Proprietaire</th>
                    <th>Date entre</th>
                    <th>Date Sortie</th>
                    <th>Actions</th>


                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($dossierssecre as $dossier)
                      <tr>
                          <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_sdp }}</a></td>
                          <td>{{ $dossier->num_dra }} </td>
                            <td>
                              <div><b>- Nom</b> : {{ $dossier->nom }}</div>
                              <div><b>- Matricule</b> : {{ $dossier->matricule }} </div>
                              <div><b>- Grade: &nbsp;</b> {{ $dossier->grade }}</div>
                            </td>
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
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Un Dossier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dossier.store') }}">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="numero">Numero DSP</label>
                            <input type="text" name="num_sdp" class="form-control" id="numero" autocomplete="false" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="DHR">Numero DRH</label>
                            <input type="text" name="num_dra" class="form-control" id="DHR"  autocomplete="false" required>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Nom du Proprietaire</label>
                              <input type="text" name="nom" id="" class="form-control" placeholder="entre le nom du proprietaire" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Prenom</label>
                                <input type="text" name="prenom" id="" class="form-control" placeholder="entre le prenom du proprietaire" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="inputEmail4">Matricule</label>
                                <input type="text" name="matricule" id="" class="form-control" placeholder="entre le matricule du proprietaire" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="inputEmail4">grade</label>
                                <input type="text" name="grade" id="" class="form-control" placeholder="entre le grade du proprietaire" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="inputEmail4">telephone</label>
                                <input type="text" name="telephone" id="" class="form-control" placeholder="entre le telephone du proprietaire" required>
                              </div>
                            <div class="form-group col-md-6">
                              <label for="inputPassword4">date Entre</label>
                              <input type="date" name="date_entre" class="form-control" id="inputPassword4" required>
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
                            <label for="inputPassword4">note</label>
                            <textarea name="note" id="" cols="30" rows="10"></textarea>
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
                            <label for="numero">Numero DSP</label>
                            <input type="text" name="num_sdp" class="form-control"  autocomplete="false" id="numero" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="DHR">Numero DRH</label>
                            <input type="text" name="num_dra" class="form-control"  autocomplete="false" id="DHR" required>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Nom du Proprietaier</label>
                              <input type="text" name="nom" id="" class="form-control" placeholder="entre le nom du proprietaire" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Prenom</label>
                                <input type="text" name="prenom" id="" class="form-control" placeholder="entre le prenom du proprietaire" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="inputEmail4">Matricule</label>
                                <input type="text" name="matricule" id="" class="form-control" placeholder="entre le matricule du proprietaire" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="inputEmail4">grade</label>
                                <input type="text" name="grade" id="" class="form-control" placeholder="entre le grade du proprietaire" required>
                              </div>
                            <div class="form-group col-md-6">
                              <label for="inputPassword4">date Entre</label>
                              <input type="date" name="date_entre" class="form-control" id="inputPassword4" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">date de sortie</label>
                                <input type="date" name="date_sortie" class="form-control" id="inputPassword4" required>
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
                            <label for="inputPassword4">note</label>
                            <textarea name="note" id="" cols="30" rows="10"></textarea>
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
