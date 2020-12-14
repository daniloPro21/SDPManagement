@extends('layouts.app')


@section('content')
    <div class="row justify-content-center d-flex align-items-center">

        <div class="container">
            <form action="{{route('categorie.store')}}" method="POST">
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
                                <label for="prenom">Description</label>
                                <input type="text" name="description" required class="form-control" id="description">
                            </div>
                        </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Selectionnez le groupe</label>
                                    <select name="groupe_id" class="form-control" required>
                                        @foreach($groupes as $groupe)
                                            <option value="{{$groupe->id}}">{{$groupe->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <button class="btn btn-warning btn-block" type="submit">Enregistré</button>
                    </div>

                    <div class="box-footer">

                    </div>
                </div>
            </form>
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center text-uppercase">Liste Du Personnel</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>description</th>
                            <th>groupe</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $categorie)
                            <tr>
                                <td>{{$categorie->id}}</td>
                                <td>{{ $categorie->nom }}</td>
                                <td>{{ $categorie->description }}</td>
                                <td>{{ $categorie->groupe->nom }}</td>
                                <form action="{{ route('categorie.delete', $categorie->id)  }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td>
                                        <button type="submit" class="btn btn-warning">Supprimer</button>
                                    </td>
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
