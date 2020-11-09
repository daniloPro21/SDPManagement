@extends('layouts.app')

@section('content')
<div class="row justify-content-center d-flex align-items-center">

    <div class="container">
        <a href="#" href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg mb-3">Ajouter un utilisateur</a>
        <hr>
        <div class="row">
            <!-- /.col -->
            @foreach ($users as $item)
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{ $item->name }}</h3>
                      @if($item->service != null)
                    <h5 class="widget-user-desc">{{ $item->service->name }}</h5>
                      @endif
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('dist/img/armoirie.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">

                        <a href="{{ route('user.edit', ['user' => $item]) }}" type="submit" class="btn btnn-info">Modifier</a>

                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{ $item->role }}</h5>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                            <form action="{{ route('user.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
                <!-- /.widget-user -->
              </div>
            @endforeach

            <!-- /.col -->
            <!-- /.col -->
          </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="numero">Nom</label>
                    <input type="text" name="name" class="form-control" id="name" autocomplete="false" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="DHR">Email</label>
                    <input type="email" name="email" class="form-control" id="email"  autocomplete="true" required>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Mot de passe</label>
                      <input type="password" name="password" id="" class="form-control" placeholder="entre le mot de passe" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="role" >choisir le role:</label>
                            <select name="role" id="role" class="form-control">
                            <option value="admin">Administrateur</option>
                            <option value="secretaire">Secretaire</option>
                            <option value="service">Service</option>
                            </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="service">Choisir le service:</label>
                            <select name="service_id" id="service" class="form-control">
                                @foreach ($services as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                      </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Save changes</button>
            </form>
            </div>
    </div>
    </div>
</div>


@endsection

