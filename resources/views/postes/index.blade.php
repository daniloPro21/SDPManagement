@extends('layouts.app')

@section('title')
    Postes
@endsection

@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <form action="{{route('poste.store')}}" method="POST">
      <div class="box">
        <div class="box-header">
          <h3 class="text-center text-uppercase">Remplissez le formulaire</h3>
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
                  <label for="nom">Dénomination du poste</label>
                  <input type="text" name="nom" required class="form-control"  id="name">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" class="form-control" id="description" placeholder="Votre texte Ici"></textarea>
                </div>
              </div>
              <button class="btn btn-warning btn-block" type="submit">Enregistrer</button>
        </div>
        <div class="box-footer">

        </div>
      </div>
      </form>
      <div class="box">
            <div class="box-header">
              <h3 class="text-center text-uppercase">Liste des postes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Dénomination du poste</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($postes as $poste)
                <tr>
                  <td>{{$poste->id}}</td>
                  <td>{{ $poste->nom }}</td>
                  <td>{{ $poste->description }}</td>
                  <td><a class="btn btn-warning" href="{{route('poste.edit',$poste->id)}}">Modifier</a></td>
                </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
