@extends('layouts.app')

@section('content')
    <section class="content">
    <div class="row">
      <div class="col-lg-12">
          <hr>
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Liste des Services</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm mt-3">AJouter un Service</a>
                    <hr>
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nom</th>
                <th>Description</th>
            
              </tr>
              </thead>
              <tbody>
                  @foreach ($services as $service)
                  <tr>
                      <td>{{ $service->name }}</td>
                      <td>{{ $service->description }} </td>
                    </tr>
                    @endforeach

            </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Un Services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <form action="{{ route('service.store') }}" method="POST">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" name="name" class="form-control" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="prenom">Description</label>
                    <input type="text" name="description" class="form-control" >
                  </div>
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
</div>   
@endsection