@extends('layouts.app')

@section("title")
    Données Statistiques
@endsection

@section('content')
  <div class="row justify-content-center d-flex align-items-center">
    <h1 align="center">Données Statistiques</h1>

    <div class="container" style="padding-top:2%;">
      <a href="{{ route('dossiers.noncoter_admin')}}" class="col-md-4">
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

                    <a href="{{ route('dossiers.coter-admin')}}" class="col-md-4">
                          <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-green-active">
                              <h3 class="widget-user-username"><b>{{ __("Dossier(s) Coter(s)")}}</b></h3>
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
                                    <h5 class="description-header">{{ $d2->count() }}</h5>
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
                      <a href="{{ route('dossiers.traiter-admin')}}" class="col-md-4">
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
                     <h2 align="center">Graphes Statistiques</h2>
                   <div class="container">
                        <div class="col-sm-6">
                            {!! $dossierChart->container() !!}

                        </div>
                        <div class="col-sm-6">
                            {!! $dossier2Chart->container() !!}

                        </div>
                   </div>
                   <h2 align="center">Evolution Temporelle</h2>
                 <div class="container">
                      <div class="col-sm-12">
                          {!! $yearChart->container() !!}
                      </div>
                 </div>
    </div>
@stop

@section("javascript")
  @isset($dossierChart)
    {!! $dossierChart->script() !!}
  @endisset
  @isset($dossier2Chart)
    {!! $dossier2Chart->script() !!}
  @endisset
  @isset($yearChart)
    {!! $yearChart->script() !!}
  @endisset
@stop
