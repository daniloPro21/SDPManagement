@extends('layouts.app')


@section('title')
    {{ $typeDossier->name }}
@endsection


@section('content')
<div class="row justify-content-center d-flex align-items-center">

    <section class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="box">
              <div class="box-header">
              <h3 class="box-title">Liste des Dossiers : <b>{{ $typeDossier->name}}</b></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <br>
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SDP</th>
                    <th>DRH</th>
                    <th>Propriétaire</th>
                    <th>Date entre</th>
                    <th>Date Sortie</th>
                    <td>Etat</td>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($dossiersFiltrer as $dossier)
                      <tr>
                          <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_sdp }}</a></td>
                          <td>{{ $dossier->num_dra }} </td>
                            <td><b>- Nom</b> : {{ $dossier->nom }} <br>
                                - <b>Matricule</b> : {{ $dossier->matricule }} <br>
                                - <b>Grade: &nbsp;</b> {{ $dossier->grade }} <br>

                            </td>
                            <td> {{ $dossier->date_entre }}</td>
                            <td>{{ $dossier->date_sortie }} 
                            </td>
                            <td style="vertical-align: center">
                            @if ($dossier->traiter)
                                <b class="badge badge-primary bg-theme">Traité</b> 
                            @else
                                <b class="badge badge-warning bg-warning">Non Traité</b> 
                            @endif
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
      <!-- /.content -->
    </div>

    @endsection
