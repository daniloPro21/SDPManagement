@extends('layouts.app')




@section('content')

         <!-- Main content -->
    <section class="content">
        <div class="row">
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
                          <td>
                            <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_sdp }}</a>
                          </td>
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

      </section>
      <!-- /.content -->
    </div>

    @endsection
