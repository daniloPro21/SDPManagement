@extends('layouts.app')

@section("title")
    TYPES DE DOCUMENTS
@endsection

@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <form action="{{route('type.store')}}" method="POST">
      <div class="box">
        <div class="box-header">
          <h3 class="text-center text-uppercase">Veuillez remplir le formulaire</h3>
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
                  <label for="name">Nom</label>
                  <input type="text" name="name" required class="form-control"  id="name">
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
              <h3 class="text-center text-uppercase">Types de documents</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($typedossiers as $type)
                <tr>
                  <td>{{$type->id}}</td>
                  <td>{{ $type->name }}</td>
                  <td>{{ $type->description }}</td>
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
