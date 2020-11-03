@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">
    <br><br><br><br><br>
    <div class="container bg-info">


        <h1 align="center"  style="font-size: 80px;color: #FFF !important;">Recherche</h1>
  <div class=" col-sm-offset-3 col-sm-6">

    <form action="{{ route('dossier.result') }}" method="GET">
      {{ csrf_field() }}
      <input type="text" class="form-control"  name="recherche" placeholder="Numero DRA ici" style="text-align: center; height: 50px; border-radius: 10px;">
      <br>
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
