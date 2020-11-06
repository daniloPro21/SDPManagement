@extends('layouts.app')




@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <div class="box">
            <div class="box-header">
              <h3 class="text-center text-uppercase">Types de documents</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Description</th>
                  <th>Voir les dossiers</th>
                </tr>
                </thead>
                <tbody>
                @foreach($typedossiers as $type)
                <tr>
                  <td>{{$type->id}}</td>
                  <td>{{ $type->name }}</td>
                  <td>{{ $type->description }}</td>
                <td><a href="{{ route("dossier.group.show",$type->id)}}"><button class="btn btn-sm">Voir les dossiers</button></a></td>
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
