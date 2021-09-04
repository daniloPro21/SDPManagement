@extends('layouts.app')

@section('content')
<div class="row">

    <div class="container">
      @foreach ($newDossiers as $dossier)
        <!-- /.col -->
        <a href="{{route('dossier.detail',$dossier->id)}}" style="text-decoration:none;color:black" class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-number" style="font-size: 12px;">{{ $dossier->prenom }} {{ $dossier->nom }}</span>
              <small class="text-mu">{{ $dossier->date_entre}}</small><br>
              <small class="text-mu">{{ $dossier->track }}</small><br>
            @if ($dossier->service_id != null)
                <small><i class="text-truncate" style="font-size: 12px"> {{ $dossier->services->name }}</i></small>
            @endif
                @if ($dossier->trace != null)
                    <small><i class="text-truncate" style="font-size: 12px"> {{ $dossier->trace }}</i></small>
                @endif
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
      @endforeach
    </div>
  </div>
<center>  {{ $newDossiers->links() }}</center>
@endsection