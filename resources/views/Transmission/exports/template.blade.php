<html>

<head>
    <!-- CSRF Token -->
    <style type="text/css">
        @font-face {
            font-family: "Tahoma";
            src: {{ asset('css/tahoma.ttf') }} format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        *{
            font-family: Tahoma, serif;
        }
        .sceau {
            display: inline-block;
        }
        table tr{
            padding: 0 !important;
            height: content-box !important;
            line-height: 1.25 !important;
        }
    </style>
    <title>{{ "Transmission".substr($fiche->numero,0,20)."_".$fiche->date }}</title>


</head>

<body>
<div id="container">
    <div style="display: block;margin-top: 2%">
        <div class="sceau"
             style="width: 48%;margin-right: 1%;position: relative;text-align: center">
            <div style="font-weight: bold !important;">REPUBLIQUE DU CAMEROUN</div>
            <div> Paix-Travail-Patrie</div>
            <div>--------------</div>
            <div style="font-weight: bold !important;"> MINISTERE DE LA SANTE PUBLIQUE</div>
            <div>--------------</div>
            <div> SECRETARIAT GENERAL</div>
            <div>--------------</div>
            <div>DIRECTION DES RESSOURCES HUMAINES</div>
            <div>--------------</div>
            <div>{{auth()->user()->general->description}}</div>
            <div>--------------</div>
            <div>{{auth()->user()->service->description}}</div>
            <div>--------------</div>
        </div>
        <div class="sceau" style="width: 49%;position: relative;text-align: center">
            <div style="font-weight: bold !important;">REPUBLIC OF CAMEROON</div>
            <div> Peace-Work-Fatherland</div>
            <div>--------------</div>
            <div style="font-weight: bold !important;">MINISTRY OF PUBLIC HEALTH</div>
            <div>--------------</div>
            <div> SECRETARIAT GENERAL</div>
            <div>--------------</div>
            <div>DEPARTMENT OF HUMAN RESOURCES</div>
            <div>--------------</div>
            <div>{{auth()->user()->general->english}}</div>
            <div>--------------</div>
            <div>{{auth()->user()->service->english}}</div>
            <div>--------------</div>
        </div>
    </div>
    <div style="margin-bottom: 20px;margin-top: 5%">
        <div style="text-align: left">
            <small> N°{{ $fiche->numero }}{{ $fiche->entete }}</small>
            <small>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Yaoundé Le {{ $fiche->date }}</small>
        </div>


    </div>
    <div class="row mt-2">
        <div class="col-sm d-flex justify-content-center">
            <h2><strong>
                    <center><u>SOIT-TRANSMIS</u></center>
                </strong></h2>
        </div>
        <div class="col-sm d-flex justify-content-center">
            <h2><strong>
                    <center>A</center>
                </strong></h2>
        </div>
        <div class="col-sm d-flex justify-content-center">
            <h2><strong>
                    <center>{{ $fiche->service }}</center>
                </strong></h2>
        </div>
    </div>
    <div style="margin-bottom: 10px;margin-top: 2%">
        <div style="text-align: left">
            <b><u>Analyse :&nbsp;</u></b><small>{{$fiche->analyse}}</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">


        </div>
        <br>
    </div>
    <br>

    <table class="table table-striped" style="width:100%; border: 1px;" border="1">
        <thead>
        <tr>
            <th>N°</th>
            <th>Nom et Prénom</th>
            <th>Matriule</th>
        </tr>
        </thead>
        <tbody>

        @foreach($transmissionDossier as $transmission)
            <tr>
                <td>{{ $loop->index+1}}</td>
                <td>{{ $transmission->dossiers->nom." ".$transmission->dossiers->prenom}}</td>
                <td>{{ $transmission->dossiers->matricule}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div style="margin-bottom: 10px;margin-top: 2%">
        <div style="text-align: left">
            <b><u>Observation : &nbsp;</u></b><small>{{$fiche->observation}}</small>
        </div>
    </div>
    <div style="margin-bottom: 10px;margin-top: 2%">
        <div style="text-align: left">
            <b><u>Nombre : &nbsp;</u></b><small>{{$transmissionDossier->count()}} dossier(s)</small>
        </div>
    </div>


</div>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/jQuery.print.min.js') }}"></script>
<script type="text/javascript">
    window.print();
    setInterval(function () {
        window.history.back();
    },5000)
</script>

</body>

</html>
