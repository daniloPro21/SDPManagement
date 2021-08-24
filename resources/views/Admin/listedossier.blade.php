@extends('layouts.app')


@section('content')


          <div class="row justify-content-center d-flex align-items-center">

            <div class="container">
                    <table id="example" class="table table-bordered table-hover">

                        <thead>
                        <tr>
                            <th>Numero DRH</th>
                            <th>Appartien A</th>
                            <th>Status</th>
                            <th>Date entre</th>
                            <th>Date Sortie</th>
                            <th>Actions</th>


                        </tr>
                        </thead>
                        <tbody>
                        @forelse($dossiersTrie as $dossier)
                            <tr>
                                <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">{{ $dossier->num_drh }}</a></td>

                                <td><b>- Nom</b> : {{ $dossier->nom }} <br>
                                    - <b>Matricule</b> : {{ $dossier->matricule }} <br>
                                    - <b>Grade: &nbsp;</b> {{ $dossier->grade }} <br>

                                </td>
                                @if($dossier->statut == "traiter")
                                    <td class="badge bg-yellow-active"> {{ $dossier->statut }}</td>
                                @elseif ($dossier->statut == "encour")
                                    <td class="badge bg-green-active"> {{ $dossier->statut }}</td>
                                @else
                                    <td class="badge bg-secondary">En Attente</td>
                                @endif
                                <td> {{ $dossier->date_entre }}</td>
                                <td>{{ $dossier->date_sortie }} &nbsp;

                                </td>
                                <form action="{{ route('dossier.delete', ['id' => $dossier->id]) }}" method="post">
                                    <td><a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}" data-toggle="modal"  class="btn btn-primary btn-sm mb-3">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}"  class="btn btn-info btn-sm mb-3">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @csrf
                                        @method('patch')
                                        <button type="submit"  class="btn btn-danger btn-sm mb-3">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            @empty
                                <h1 align="center" style="color:rgba(128, 128, 128, 0.781);font-size: 95px !important;position: absolute;top: 40%;left:35%;">Aucun Resultat !</h1>
                        @endforelse
                    </table>

                <!-- /.col -->
            </div>
          </div>

@endsection
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

