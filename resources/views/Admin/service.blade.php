@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <form action="{{route('service.store')}}" method="POST">
        <div class="box">
          <div class="box-header">
            <h3 class="text-center text-uppercase">Veuillez remplir le formulaire</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body col-sm-offset-3 col-sm-6">

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
              <div class="form-group">
                <label for="pet-select">Choisi le service Superieur</label>
                <select name="servicegeneral_id" id="pet-select" class="form-control">
                    <option value="">--Choissisez le service superieur--</option>
                    @foreach ($genral_service as $general )
                    <option value="{{ $general->id }}">{{ $general->name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" placeholder="Votre texte Ici"></textarea>

              </div>
            </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Description Englaise</label>
                        <textarea name="english" class="form-control" id="description" placeholder="Votre texte Ici"></textarea>

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
          <h3 class="text-center text-uppercase">Liste des services</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Description</th>
              <th>Service Superieur</th>
              <th>Dossier Quotter</th>
            </tr>
            </thead>
            <tbody>
            @superadmin
            @foreach($services as $service)
              <tr>
                <td>{{$service->id}}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->description }}</td>
                <td>{{ $service->servicegenerals->name }}</td>
              </tr>
            @endforeach
            @endsuperadmin
            @admin
            @foreach($services->where('servicegeneral_id', auth()->user()->service_id) as $service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->servicegenerals->name }}</td>
                    <td><a href="{{ route('service.showGroup', $service->id) }}" class="btn btn-bitbucket">Voir Dossiers</a></td>
                </tr>
            @endforeach
            @endadmin
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
