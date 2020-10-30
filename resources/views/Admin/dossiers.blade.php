@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container"><br><br><br><br> <br><br><br>

      <div class="col-md-offset-2 col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username"><b>Dossier(s) En Cours</b></h3>
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
                      <span class="description-text">Requete(s)</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
      </div>

          <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username"><b>Dossier(s) Traité</b></h3>
                    <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-12 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{ $dossiers->where('traiter',true)->count() }}</h5>
                          <span class="description-text">Requete(s)</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
                <!-- /.widget-user -->
              </div>
    </div>
                <!-- ./col -->
            </div>
@stop
