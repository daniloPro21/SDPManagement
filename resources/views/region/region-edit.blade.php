@extends('layouts.app')

@section('content')
<div class="row justify-content-center d-flex align-items-center">

    <div class="container">
      <form action="{{route('region.store')}}" method="POST">
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
                  <input type="text" name="nom" required class="form-control"  id="nom">
                </div>
              <button class="btn btn-warning btn-block" type="submit">Enregistré</button>
        </div>
</div>
      </div>
      </form>
    </div>
</div>
@stop
