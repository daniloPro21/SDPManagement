@extends('layouts.app')




@section('content')
<div class="row justify-content-center d-flex align-items-center">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
         <!-- Main content -->
         <div class="container" style="padding-top:5%;">
            <a href="{{ route('service.coter')}}" class="col-md-4">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow-active">
                      <h3 class="widget-user-username">{{ __("Dossier(s) Quoté")}}</h3>
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
                         </div>
          </div>
        <div class="row">
    <section class="content">

          <div class="col-lg-12">

            {{-- <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg mb-3">AJouter un Dossier</a> --}}
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
                          <td><a href="{{ route("dossier.detail", ['id' => $dossier->id]) }}">{{ $dossier->num_sdp }}</a></td>
                          <td>{{ $dossier->num_dra }} </td>
                            <td><b>Nom</b> : {{ $dossier->nom }} &nbsp;&nbsp;
                                - <b>Matricule</b> : {{ $dossier->matricule }} &nbsp;&nbsp;
                                - <b>Grade: &nbsp;</b> {{ $dossier->grade }}

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

      </section>
      <!-- /.content -->
    </div>

    @endsection
