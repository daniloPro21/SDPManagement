@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">
    <br><br><br><br><br>
    <div class="container" style="background-color:#eee">
  <div class=" col-sm-offset-3 col-sm-6">
    <form action="{{ route('dossier.result') }}" method="GET">
      <div class="box">
        <div class="box-header">
          <h3 class="text-center text-uppercase">Rechercher</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body col-sm-offset-2 col-sm-8">

          <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control"  name="recherche" placeholder="Numero DRA ici" style="text-align: center; height: 50px;">
          </div>
            <button class="btn btn-primary btn-block">Rechercher</button>
        </div>
      </div>
      <div class="box-footer">

      </div>
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
