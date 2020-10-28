@extends('layouts.app')


@section('content')
<section class="content">
    <div class="row">
      <div class="col-lg-12">
          <hr>
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Liste des Personnes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm mt-3">AJouter une Personne</a>
                    <hr>
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Matricule</th>
                <th>Grade</th>
                <th>Dossier Lier</th>
                {{-- <th>Date Sortie</th> --}}

              </tr>
              </thead>
              <tbody>
                  @foreach ($personnes as $personne)
                  <tr>
                      <td>{{ $personne->nom }}</td>
                      <td>{{ $personne->prenom }} </td>
                        <td>{{ $personne->matricule }}</td>
                        <td> {{ $personne->grade }}</td>
                            @if ($personne->dossiers != null)
                            <td>
                                @foreach ($personne->dossiers as $dossier )
                                    {{ json_decode($dossier->num_sdp) }},
                                @endforeach
                            </td>
                            @endif
                            @if($personne->dossiers ==  null)
                            <td>Pas de dossier</td>
                            @endif
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Un Personnel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <form action="{{ route('personne.store') }}" method="POST">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" class="form-control" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" class="form-control" >
                  </div>
                </div>
               <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="matricule">Matricule</label>
                    <input type="text" name="matricule" class="form-control" id="matricule" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="grade">Grade</label>
                    <input type="text" name="grade" class="form-control" id="grade">
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
  <!-- /.content -->
</div>
@endsection
