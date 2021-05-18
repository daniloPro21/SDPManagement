@extends('layouts.app')


@section('title')
    Dossiers
@endsection

@section('content')
    <div class="row justify-content-center d-flex align-items-center">

        <div class="container" style="padding-top:2%;">
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
                                    <th>{{ $service_name->name }}</th>
                                    <th>DRH</th>
                                    <th>Proprietaire</th>
                                    <th>Date entre</th>
                                    <th>Date Sortie</th>
                                    <th>Actions</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($dossiersTraiters as $dossier)
                                    <tr>
                                        <td><a href="{{ route('dossier.detail', ['id' => $dossier->id_dossier]) }}">{{ $dossier->num_dossier }}</a></td>
                                        <td>{{ $dossier->num_drh }} </td>
                                        <td>
                                            <div><b>- Nom</b> : {{ $dossier->nom }}</div>
                                            <div><b>- Matricule</b> : {{ $dossier->matricule }} </div>
                                            <div><b>- Grade: &nbsp;</b> {{ $dossier->grade }}</div>
                                        </td>
                                        <td> {{ $dossier->date_entre }}</td>
                                        <td>{{ $dossier->date_sortie }} &nbsp;

                                        </td>
                                        <td>
                                            <a href="{{ route('dossier.detail', ['id' => $dossier->id_dossier]) }}"  class="btn btn-info btn-sm mb-3">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
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
