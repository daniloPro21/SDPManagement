@extends('layouts.app')


@section('content')
  <div class="row">
    <div class="col-md-5">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
          <h3 class="widget-user-username text-capitalize">{{ $dossier->prenom }} {{ $dossier->nom }}</h3>
          <h5 class="widget-user-desc">{{ $dossier->date_entre }}</h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle" src="{{ asset('dist/img/3.jpeg') }}" alt="User Avatar">
        </div>
        <div class="box-footer">
          <div class="row">
            <!-- /.col -->
          <div class="col-sm-12">
            <table class="table table-responsive table-striped text-capitalize">
              <tr>
                <td>Nom </td><td><b>{{ $dossier->nom }}</b></td>
              </tr>
              <tr>
                <td>Prenom</td><td><b>{{ $dossier->prenom }}</b></td>
              </tr>
                <tr>
                  <td>Objet</td><td><b>{{ $dossier->type->name }}</b></td>
                </tr>
                <tr>
                  <td>Date D'Entrée</td><td><b>{{ $dossier->date_entre }}</b></td>
                </tr>
                <tr>
                  <td>Note</td><td><b>{{ $dossier->note }}</b></td>
                </tr>
                @if ($dossier->service_id != null)
                  <tr>
                    <td>Service</td><td><b>{{ $dossier->service->name }}</b></td>
                  </tr>
                    @if (!$dossier->traiter)
                        <tr>
                            <td colspan="2"><a href="{{ route('dossier.traiter',$dossier->id) }}" onclick="return confirm('Le Dossier a t\'il réelement aboutie?')"  class="btn btn-success btn-block">Marquer comme craité</a> </td>
                        </tr>
                        @endif
                @else
                  @admin
                  <tr>
                    <td colspan="2"><button data-toggle="modal" data-target="#quotationModal" class="btn btn-success btn-block">Quoter à un service</button> </td>
                  </tr>
                  @endadmin
                @endif
                <tr>
                  <td colspan="2"><button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-block">Nouvelle étiquette</button> </td>
                </tr>
            </table>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
              <div class="col-md-7">
                <!-- The time line -->
                <ul class="timeline">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          {{ Carbon\Carbon::createFromFormat("Y-m-d",$dossier->date_entre)->format("d/m/Y") }}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->

                  @foreach ($dossier->steps as $step)

                    <li>
                      @if ($step->type=="info")
                          <i title="Information" data-toggle="tooltip" class="fa fa-info bg-blue"></i>
                      @elseif ($step->type=="warning")
                          <i title="Problème" data-toggle="tooltip" class="fa fa-warning bg-red"></i>
                      @elseif ($step->type=="success")
                          <i title="Succèes" data-toggle="tooltip" class="fa fa-check bg-green"></i>
                      @elseif($step->type=="move")
                          <i title="Deplacement" data-toggle="tooltip" class="fa fa-arrows bg-aqua"></i>
                      @endif


                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $step->created_at)->format("d/m/Y") }}</span>

                        <h3 class="timeline-header"><a href="#">{{ $step->user->name }}</a> a signaler</h3>

                        <div class="timeline-body row">
                        <div class="col-sm-10">
                            {!! $step->message !!}
                        </div>
                        <div class="col-sm-2">
                              <a title="Supprimer" data-toggle="tooltip" href="{{ route('step.destroy',$step->id)}}" onclick="return confirm('voulez vous vraiment effecué cet action?')" class="btn pull-right btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                              <div class="clearfix">
                        </div>
                        </div>
                        </div>
                      </div>
                    </li>

                  @endforeach

                  <!-- END timeline item -->

                  <!-- timeline item -->  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.col -->
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  <h3 class="modal-title text-uppercase text-center" id="exampleModalLabel">Ajouter une étiquette</h3>
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
                      <form action="{{ route('step.store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="dossier_id" value="{{$dossier->id}}">
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="type">Type d étiquette</label>
                              <select class="form-control" name="type">
                                <option value="info">Information</option>
                                <option value="warning">Probleme</option>
                                <option value="move">Deplacement</option>
                                <option value="success">Succèes</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="message">Message</label>
                              <textarea required name="message" id="message" class="form-control"></textarea>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          <button type="submit"  class="btn btn-primary">Enregistrer</button>
                      </form>
                      </div>
              </div>
              </div>
            </div>


              <div class="modal fade" id="quotationModal" tabindex="-2" aria-labelledby="quotationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="quotationModalLabel">Selectionnez un Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="col-sm-12">
                      @foreach ($services as $service)
                        <a onclick="return confirm('Transferé le dossier a ce service ?');" href="{{ route('dossier.quotation',[$service->id,$dossier->id])}}" class="col-sm-4">
                              <!-- Widget: user widget style 1 -->
                              <div class="box box-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-green-active">
                                </div>
                                <div class="widget-user-image">
                                  <img class="img-circle" src="{{ asset('dist/img/2.png') }}" width="50px" height="30px" alt="Service">
                                </div>
                                <div class="box-footer">
                                  <div class="row">
                                    <!-- /.col -->
                                  <div class="col-sm-12">
                                      <div class="description-block">
                                        <h5 class="description-header">{{ $service->name }}</h5>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                </div>
                              </div>
                              <!-- /.widget-user -->
                        </a>
                      @endforeach
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-primary">Enregistrer</button>
                          </div>
                        </div>
                </div>
                </div>

@stop
