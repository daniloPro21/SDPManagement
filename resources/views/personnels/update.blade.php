@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <form action="{{route('personnel.update',$personnel->id)}}" method="POST">
      <div class="box">
        <div class="box-header">
          <h3 class="text-center text-uppercase">Modifiez le formulaire</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body col-sm-offset-3 col-sm-6 ">

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
              @csrf
              <div class="form-row">
                <div class="form-group">
                  <label for="nom">Nom</label>
                  <input type="text" value="{{ $personnel->nom }}" name="nom" required class="form-control"  id="nom">
                </div>
              </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom"  value="{{ $personnel->prenom }}" required class="form-control"  id="prenom">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="matricule">matricule</label>
                        <input type="text" name="matricule"  value="{{ $personnel->matricule }}" required class="form-control"  id="matricule">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" name="grade"   value="{{ $personnel->grade }}" required class="form-control"  id="grade">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" required id="sexe" class="form-control">
                            <option @if($personnel->sexe == "Masculin") selected @endif value="Masculin">Masculin</option>
                            <option @if($personnel->sexe == "Feminin") selected @endif value="Feminin">Feminin</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telephone">Contact</label>
                        <input type="text" name="telephone" value="{{ $personnel->telephone }}" required class="form-control"  id="telephone">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_naissance">Date de Naissance</label>
                        <input type="date" name="date_naissance" value="{{ $personnel->date_naissance }}" required class="form-control"  id="date_naissance">
                    </div>
                </div>
              <button class="btn btn-warning btn-block" type="submit">Enregistré</button>
        </div>
        <div class="box-footer">

        </div>
      </div>
      </form>
    </div>
      <!-- ./col -->
  </div>
@stop

@section('js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      //$('#dossiers').DataTable()
      $('#dossiers').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })
    })
  </script>
@stop
