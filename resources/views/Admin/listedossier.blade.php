@extends('layouts.app')


@section('content')


          <div class="row justify-content-center d-flex align-items-center">

            <div class="container">
              @forelse($dossiersTrie as $dossier)
                <!-- /.col -->
                <a href="{{route('dossier.detail',$dossier->id )}}" style="text-decoration:none;color:black" class="col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-number" style="font-size: 12px;">{{ $dossier->prenom }} {{ $dossier->nom }}</span>
                          <span class="info-box-text">{{ $dossier->Type->name ?? '' }}</span>
                      <small class="text-mu">{{ $dossier->date_entre}}</small><br>
                    @if ($dossier->service_id != null)
                        <small><i class="text-truncate" style="font-size: 12px">{{  $dossier->service->name }}</i></small>
                    @endif
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
                @empty
                <h1 align="center" style="color:rgba(128, 128, 128, 0.781);font-size: 95px !important;position: absolute;top: 40%;left:35%;">Aucun Resultat !</h1>
              @endforelse
            </div>
            {{ $dossiersTrie->links() }}
          </div>

@endsection
