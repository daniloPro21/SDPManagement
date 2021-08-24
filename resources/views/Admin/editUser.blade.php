@extends('layouts.app')

@section('content')
<div class="row justify-content-center d-flex align-items-center">
    <div class="container">
          <h2>Modifier {{ $user->name }}</h2>
        <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
            @csrf
            @method('patch')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="numero">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" autocomplete="false" required>
              </div>
              <div class="form-group col-md-6">
                <label for="DHR">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}"  autocomplete="true" required>
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Mot de passe</label>
                  <input type="password" name="password" value="" class="form-control" placeholder="entre le mot de passe" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="role" >choisir le role:</label>
                        <select name="role" id="role" class="form-control">
                            @admin
                            <option value="secretaire">Secretaire</option>
                            <option value="service">Service</option>
                            <option value="cardre">Cardre</option>
                            @endadmin
                            @superadmin
                            <option value="superadmin">Super Administrateur</option>
                            <option value="admin">Administrateur</option>
                            <option value="secretaire">Secretaire</option>
                            <option value="service">Service</option>
                            <option value="secdrh">Seretaire Drh</option>
                            @endsuperadmin
                            @secdrh
                            <option value="secdrh">Seretaire Drh</option>
                            @endsecdrh
                            @secretaire
                            <option value="secretaire">Secretaire</option>
                            <option value="service">Service</option>
                            <option value="cardre">Cadre</option>
                            @endsecretaire
                            @service
                            <option value="service">Service</option>
                            <option value="cardre">Cadre</option>
                            @endservice
                            @cardre
                            <option value="cardre">Cadre</option>
                            @endcardre
                        </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="service">Choisir le service:</label>
                        <select name="sous_service_id" id="service" class="form-control">
                            @foreach ($servicesgenerals->where('id', auth()->user()->service_id) as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @superadmin
                            @foreach ($servicesgenerals as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endsuperadmin
                            @secdrh
                            @foreach ($servicesgenerals as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endsecdrh
                        </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="service">Choisir le service General:</label>
                        <select name="service_id" id="service" class="form-control">
                           @service
                            @foreach ($services->where('id', auth()->user()->sous_service_id) as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endservice
                            @superadmin
                            @foreach ($services as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endsuperadmin
                            @admin
                            @foreach ($services->where('servicegeneral_id', auth()->user()->service_id) as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endadmin
                            @cardre
                            @foreach ($services->where('id', auth()->user()->sous_service_id) as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endcardre
                            @secdrh
                            @foreach ($services->where('id', auth()->user()->sous_service_id) as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            @endsecdrh
                        </select>
                  </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-primary">Save changes</button>
        </form>
    </div>
</div>

@endsection
