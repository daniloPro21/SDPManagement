@extends('layouts.app')

@section('title')
    Dossiers
@endsection

@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container"><br><br>


        <a href="{{ route('dossiers.list','coter')}}">
            <div class="col-md-offset-2 col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username"><b>Dossiers en cours</b></h3>
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
                                    <h5 class="description-header">{{ $dossiers->where('service_id','!=',null)->where('service_id',auth()->user()->service_id)->where('traiter',false)->count() }}</h5>
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
        </a>
        <a href="{{ route('dossiers.list','traiter')}}">

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
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('service_id',auth()->user()->service_id)->where('traiter',true)->count() }}</h5>
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

        </a>
        <br><br>
    <section>

        <table id="example" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>{{ auth()->user()->general->name }}</th>
              <th>Coter au </th>
              <th>Appartien A</th>
              <th>Date entre</th>
              <th>Date Sortie</th>
              <th>Actions</th>


            </tr>
            </thead>
            <tbody>
                @foreach ($d2 as $dossier)
                <tr>
                    <td><a href="{{ route('dossier.detail', ['id' => $dossier->id_dossier]) }}">{{ $dossier->num_drh }}</a></td>
                    <td>{{ $dossier->name }}</td>

                      <td><b>- Nom</b> : {{ $dossier->nom }} <br>
                          - <b>Matricule</b> : {{ $dossier->matricule }} <br>
                          - <b>Grade: &nbsp;</b> {{ $dossier->grade }} <br>

                      </td>
                      <td> {{ $dossier->date_entre }}</td>
                      <td>{{ $dossier->date_sortie }} &nbsp;

                      </td>
                      <form action="{{ route('dossier.delete', ['id' => $dossier->id_dossier]) }}" method="post">
                      <td><a href="{{ route('dossier.detail', ['id' => $dossier->id_dossier]) }}" data-toggle="modal"  class="btn btn-primary btn-sm mb-3">
                          <i class="fa fa-edit"></i>
                          </a>
                          <a href="{{ route('dossier.detail', ['id' => $dossier->id_dossier]) }}"  class="btn btn-info btn-sm mb-3">
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
    </section>
    </div>
                <!-- ./col -->
            </div>
@stop
