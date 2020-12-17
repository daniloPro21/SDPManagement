@extends('layouts.app')


@section('content')
    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <form action="{{route('district.store')}}" method="POST">
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
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" required class="form-control" id="nom">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Selectionnez la region</label>
                                <select name="region_id" class="form-control">
                                    @foreach($regions as $region)
                                    <option value="{{$region->id}}">{{$region->nom}}</option>
                                    @endforeach
                                </select>
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
                    <h3 class="text-center text-uppercase">Liste Des Districts</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Region</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($districts as $district)
                            <tr>
                                <td>{{$district->id}}</td>
                                <td>{{ $district->nom }}</td>
                                <td>{{ $district->region->nom }}</td>
                                <form action="{{route('district.delete',$district->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button class="btn btn-warning">Supprimer</button></td>
                                </form>
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
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            })
        })
    </script>
@stop
