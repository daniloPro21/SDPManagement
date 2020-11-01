@extends('layouts.app')




@section('content')
<div class="row justify-content-center d-flex align-items-center">

    <div class="container" style="padding-top:5%;">
      <a href="{{ route('dossiers.list','non-coter')}}" class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-yellow-active">
                <h3 class="widget-user-username">{{ __("Dossier(s) Non Quoté")}}</h3>
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
                      <h5 class="description-header">{{ $ncote }}</h5>
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
                              <h3 class="widget-user-username">{{ __("Dossier(s) Quoté")}}</h3>
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
                                    <h5 class="description-header">{{ $coter }}</h5>
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
                                <h3 class="widget-user-username">{{ __("Dossier(s) Traité")}}</h3>
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
                                      <h5 class="description-header">{{ $traiter }}</h5>
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
    </div>
         <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg mb-3">AJouter un Dossier</a>
            <a href="#" data-toggle="modal" data-target="#exampleModale" class="btn btn-primary btn-lg mb-3">AJouter un Type de Dossier</a>
            <hr>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Liste des Dossiers</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <br>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SDP</th>
                    <th>DRH</th>
                    <th>Appartien A</th>
                    <th>Date entre</th>
                    <th>Date Sortie</th>

                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($dossiers as $dossier)
                      <tr>
                          <td>{{ $dossier->num_sdp }}</td>
                          <td>{{ $dossier->num_dra }} </td>
                            <td><b>Nom</b> : {{ $dossier->personne->nom }} &nbsp;&nbsp;
                                - <b>Matricule</b> : {{ $dossier->personne->matricule }} &nbsp;&nbsp;
                                - <b>Grade: &nbsp;</b> {{ $dossier->personne->grade }}

                            </td>
                            <td> {{ $dossier->date_entre }}</td>
                            <td>{{ $dossier->date_sortie }}</td>
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
                            <input type="text" name="num_sdp" class="form-control" id="numero">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="DHR">Numero DRH</label>
                            <input type="text" name="num_dra" class="form-control" id="DHR">
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Personne</label>
                              <select class="custom-select" name="personne_id">
                                {{-- <option selected>Choisir le type</option> --}}
                                @foreach ($personnes as $item)
                                <option value="{{ $item->id }}">{{ $item->nom }} : {{ $item->matricule }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputPassword4">date Entre</label>
                              <input type="date" name="date_entre" class="form-control" id="inputPassword4">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">Date sortie</label>
                              <input type="date" name="date_sortie" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Type</label>
                                <select class="custom-select" name="type_id">
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
        <div class="modal fade" id="exampleModale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Un type de  Dossier</h5>
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
