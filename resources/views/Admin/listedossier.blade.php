@extends('layouts.app')


@section('content')


          <div class="row">

            <div class="container">
              @foreach ($dossiersTrie as $dossier)
                <!-- /.col -->
                <a href="{{route('dossier.detail',$dossier->id)}}" style="text-decoration:none;color:black" class="col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-number" style="font-size: 12px;">{{ $dossier->personne->prenom }} {{ $dossier->personne->nom }}</span>
                      <span class="info-box-text">{{ $dossier->type->name}}</span>
                      <small class="text-mu">{{ $dossier->date_entre}}</small><br>
                    @if ($dossier->service_id != null)
                        <small>Service en Charge : {{ $dossier->service->name }}</small>
                    @endif
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </a>
              @endforeach
            </div>
         <div class="col-sm-offset-4">   {{ $dossiersTrie->links() }}</div>
          </div>

@stop
