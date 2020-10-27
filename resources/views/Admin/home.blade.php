@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container" style="padding-top:10%;">
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
            </div>
@stop
