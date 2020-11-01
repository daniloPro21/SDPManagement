@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <br><br><br><br><br>

        <h1 align="center">Recherche</h1>
  <div class=" col-sm-offset-3 col-sm-6">

    <form action="{{ route('dossier.result') }}" method="GET">
      {{ csrf_field() }}
      <input type="text" class="form-control" name="recherche" placeholder="Numero DRA ici" style="text-align: center">
      <br><br>
      <button class="btn btn-primary btn-lg center-block">Rechercher</button>
    </form>
  </div>
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
