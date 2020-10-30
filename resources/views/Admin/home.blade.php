@extends('layouts.app')


@section('content')
  <div class="row justify-content-center d-flex align-items-center">

    <div class="container" style="padding-top:2%;">
      <a href="{{ route('dossiers.list','non-coter')}}" class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-yellow-active">
                <h3 class="widget-user-username"><b>{{ __("Dossier(s) Non Quoté")}}</b></h3>
                <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('dist/img/2.png') }}" alt="User Avatar">
              </div>
              <div class="box-footer">
                <div class="row">
                  <!-- /.col -->
                <div class="col-sm-12">
                    <div class="description-block">
                      <h5 class="description-header">{{ $dossiers->where('service_id',null)->count() }}</h5>
                      <span class="description-text">Dossier(s)</span>
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

                    <a href="{{ route('dossiers.list','coter')}}" class="col-md-4">
                          <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-green-active">
                              <h3 class="widget-user-username"><b>{{ __("Dossier(s) Quoté")}}</b></h3>
                              <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                            </div>
                            <div class="widget-user-image">
                              <img class="img-circle" src="{{ asset('dist/img/3.jpeg') }}" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                              <div class="row">
                                <!-- /.col -->
                              <div class="col-sm-12">
                                  <div class="description-block">
                                    <h5 class="description-header">{{ $dossiers->where('service_id','!=',null)->where('traiter',false)->count() }}</h5>
                                    <span class="description-text">Dossier(s)</span>
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
                    <!-- ./col -->
                      <a href="{{ route('dossiers.list','traiter')}}" class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                              <!-- Add the bg color to the header aqua any of the bg-* classes -->
                              <div class="widget-user-header bg-aqua-active">
                                <h3 class="widget-user-username"><b>{{ __("Dossier(s) Traité")}}</b></h3>
                                <h5 class="widget-user-desc">{{ Carbon\Carbon::now()}}</h5>
                              </div>
                              <div class="widget-user-image">
                                <img class="img-circle" src="{{ asset('dist/img/index.png') }}" alt="User Avatar">
                              </div>
                              <div class="box-footer">
                                <div class="row">
                                  <!-- /.col -->
                                <div class="col-sm-12">
                                    <div class="description-block">
                                      <h5 class="description-header">{{ $dossiers->where('traiter',true)->count() }}</h5>
                                      <span class="description-text">Dossier(s)</span>
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
                   </div>
                   <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"><svg height="300" version="1.1" width="763.333" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; top: -0.633331px;"><desc>Created with Raphaël 2.2.0</desc><defs></defs><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="54.483333587646484" y="260" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4">0</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66.98333358764648,260H738.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="54.483333587646484" y="201.25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4">7,500</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66.98333358764648,201.25H738.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="54.483333587646484" y="142.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4">15,000</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66.98333358764648,142.5H738.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="54.483333587646484" y="83.75" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4">22,500</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66.98333358764648,83.75H738.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="54.483333587646484" y="25.00000000000003" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.000000000000028">30,000</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M66.98333358764648,25.00000000000003H738.333" stroke-width="0.5"></path><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="615.1570587748902" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)"><tspan dy="4">2013</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="316.59815487826637" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)"><tspan dy="4">2012</tspan></text><path style="fill-opacity: 1;" fill="#74a5c2" stroke="none" d="M66.98333358764648,218.23266666666666C85.74523191994798,218.74183333333332,123.26902858455098,221.7860625,142.03092691685248,220.26933333333335C160.79282524915396,218.75260416666669,198.31662191375696,208.35534699453552,217.07852024605845,206.09883333333335C235.63648490083492,203.86684699453554,272.7524142103879,204.11993750000002,291.31037886516435,202.31533333333334C309.8683435199408,200.51072916666666,346.9842728294938,194.192947859745,365.5422374842703,191.662C384.3041358165718,189.10323952641167,421.8279324811748,181.84977083333334,440.5898308134763,181.9565C459.35172914577777,182.06322916666667,496.87552581038074,203.4213315118397,515.6374241426822,192.51583333333332C534.1953887974587,181.72887317850635,571.3113181070116,101.61791988950276,589.8692827617881,95.18666666666667C608.2233137390396,88.82608655616943,644.9313756935426,134.67133653846153,663.285406670794,141.3485C682.0473050030955,148.17404487179488,719.5711016676985,147.23525,738.333,149.1975L738.333,260L66.98333358764648,260Z" fill-opacity="1"></path><path style="" fill="none" stroke="#3c8dbc" d="M66.98333358764648,218.23266666666666C85.74523191994798,218.74183333333332,123.26902858455098,221.7860625,142.03092691685248,220.26933333333335C160.79282524915396,218.75260416666669,198.31662191375696,208.35534699453552,217.07852024605845,206.09883333333335C235.63648490083492,203.86684699453554,272.7524142103879,204.11993750000002,291.31037886516435,202.31533333333334C309.8683435199408,200.51072916666666,346.9842728294938,194.192947859745,365.5422374842703,191.662C384.3041358165718,189.10323952641167,421.8279324811748,181.84977083333334,440.5898308134763,181.9565C459.35172914577777,182.06322916666667,496.87552581038074,203.4213315118397,515.6374241426822,192.51583333333332C534.1953887974587,181.72887317850635,571.3113181070116,101.61791988950276,589.8692827617881,95.18666666666667C608.2233137390396,88.82608655616943,644.9313756935426,134.67133653846153,663.285406670794,141.3485C682.0473050030955,148.17404487179488,719.5711016676985,147.23525,738.333,149.1975" stroke-width="3"></path><circle cx="66.98333358764648" cy="218.23266666666666" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="142.03092691685248" cy="220.26933333333335" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="217.07852024605845" cy="206.09883333333335" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="291.31037886516435" cy="202.31533333333334" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="365.5422374842703" cy="191.662" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="440.5898308134763" cy="181.9565" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="515.6374241426822" cy="192.51583333333332" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="589.8692827617881" cy="95.18666666666667" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="663.285406670794" cy="141.3485" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="738.333" cy="149.1975" r="4" fill="#3c8dbc" stroke="#ffffff" style="" stroke-width="1"></circle><path style="fill-opacity: 1;" fill="#eaf3f6" stroke="none" d="M66.98333358764648,239.11633333333333C85.74523191994798,238.897,123.26902858455098,240.43820833333334,142.03092691685248,238.239C160.79282524915396,236.03979166666667,198.31662191375696,222.49635428051002,217.07852024605845,221.52266666666668C235.63648490083492,220.55956261384335,272.7524142103879,232.3502916666667,291.31037886516435,230.49183333333335C309.8683435199408,228.633375,346.9842728294938,208.50817190346083,365.5422374842703,206.655C384.3041358165718,204.7814635701275,421.8279324811748,213.63645833333334,440.5898308134763,215.585C459.35172914577777,217.53354166666668,496.87552581038074,231.50074954462661,515.6374241426822,222.24333333333334C534.1953887974587,213.08654121129325,571.3113181070116,147.70467656537753,589.8692827617881,141.92816666666667C608.2233137390396,136.21513489871086,644.9313756935426,169.85397847985348,663.285406670794,176.28516666666667C682.0473050030955,182.85927014652015,719.5711016676985,189.53329166666668,738.333,193.94933333333336L738.333,260L66.98333358764648,260Z" fill-opacity="1"></path><path style="" fill="none" stroke="#a0d0e0" d="M66.98333358764648,239.11633333333333C85.74523191994798,238.897,123.26902858455098,240.43820833333334,142.03092691685248,238.239C160.79282524915396,236.03979166666667,198.31662191375696,222.49635428051002,217.07852024605845,221.52266666666668C235.63648490083492,220.55956261384335,272.7524142103879,232.3502916666667,291.31037886516435,230.49183333333335C309.8683435199408,228.633375,346.9842728294938,208.50817190346083,365.5422374842703,206.655C384.3041358165718,204.7814635701275,421.8279324811748,213.63645833333334,440.5898308134763,215.585C459.35172914577777,217.53354166666668,496.87552581038074,231.50074954462661,515.6374241426822,222.24333333333334C534.1953887974587,213.08654121129325,571.3113181070116,147.70467656537753,589.8692827617881,141.92816666666667C608.2233137390396,136.21513489871086,644.9313756935426,169.85397847985348,663.285406670794,176.28516666666667C682.0473050030955,182.85927014652015,719.5711016676985,189.53329166666668,738.333,193.94933333333336" stroke-width="3"></path><circle cx="66.98333358764648" cy="239.11633333333333" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="142.03092691685248" cy="238.239" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="217.07852024605845" cy="221.52266666666668" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="291.31037886516435" cy="230.49183333333335" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="365.5422374842703" cy="206.655" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="440.5898308134763" cy="215.585" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="515.6374241426822" cy="222.24333333333334" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="589.8692827617881" cy="141.92816666666667" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="663.285406670794" cy="176.28516666666667" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="738.333" cy="193.94933333333336" r="4" fill="#a0d0e0" stroke="#ffffff" style="" stroke-width="1"></circle></svg><div class="morris-hover morris-default-style" style="left: 392.106px; top: 129px; display: none;"><div class="morris-hover-row-label">2012 Q2</div><div class="morris-hover-point" style="color: #a0d0e0">
  Item 1:
  5,670
</div><div class="morris-hover-point" style="color: #3c8dbc">
  Item 2:
  4,293
</div></div></div>
    </div>
@stop
