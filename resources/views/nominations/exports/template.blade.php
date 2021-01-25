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
    <title>{{ "Nominations_".substr($fiche->titre,0,20)."_".$fiche->date }}</title>


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
            <div>SOUS-DIRECTION DU PERSONNEL</div>
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
            <div>SUB-DEPARTMENT OF PERSONNEL</div>
            <div>--------------</div>
        </div>
    </div>
    <div style="margin-bottom: 20px;margin-top: 5%">
        <div style="text-align: center">
            <b>DECISION N°_________/D/MINSANTE/SG/DRH/SDP du _____________</b>
                <span> <strong>MINSANTE.</strong>
                    <div>{{ $fiche->titre }}</div>
</span>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm d-flex justify-content-center">
            <h4><strong>
                    <center>LE MINISTRE DE LA SANTE PUBLIQUE,</center>
                </strong></h4>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm">
                {!! str_replace("</p>","</span>",str_replace("<p>","<span>",$fiche->decrets)) !!}
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm d-flex justify-content-center">
            <h4><strong>
                    <center>ARRÊTE :</center>
                </strong></h4>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <strong>Article 1er </strong> : {!! $fiche->decision !!}

        </div>
        <br>
    </div>
    <br>
    <div id="nominations">
        <div class="all">
            @foreach($donnees as $key => $districts)
                <h4 align="center" style="margin-bottom: 0 !important;">
                    <u>
                        {{ $key }}
                    </u>
                </h4>
                <div class="nominations">
                    @foreach($districts as  $key => $district)
                        <h4 align="center" style="margin-bottom: 0 !important;">
                            <u>
                                {{ $key }}
                            </u>
                        </h4>
                        @foreach($district as  $key => $structure)
                            <h5 align="left">
                                <u>
                                    {{ $key }}
                                </u>
                            </h5>
                            @foreach($structure as $affectation)
                                <p style="text-align: justify">
                                    <strong>{{ $affectation->poste->nom  }}</strong>: &nbsp; @if($affectation->personnel->sexe == "Feminin")
                                        Madame @else Monsieur @endif <b>{{ $affectation->personnel->nom }} {{ $affectation->personnel->prenom }}</b>
                                    , matricule <b>{{ $affectation->personnel->matricule }}</b>,{{ $affectation->personnel->grade }}, {{ $affectation->motif }}</h5>
                                </p>
                            @endforeach
                        @endforeach
                        @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <p><strong>Article 2</strong><strong>:</strong> Les int&eacute;ress&eacute;s auront droit aux avantages de toute nature pr&eacute;vus par la r&eacute;glementation en vigueur.</p>

    <p><strong>Article 3</strong><strong>:</strong> La pr&eacute;sente D&eacute;cision sera enregistr&eacute;e, publi&eacute;e puis communiqu&eacute;e partout o&ugrave; besoin sera./-</p>

    <table style="width:100%">
        <tbody>
        <tr>
            <td>
                <p><strong>Ampliations:</strong></p>

                <p>&nbsp;</p>

                <ul style="list-style-type: symbols('-') !important;" type="square">
                    <li>CAB/MINSANTE/SESP</li>
                    <li>SG</li>
                    <li>DRH</li>
                    <li>DRSP/CE/ES/LT/NO/OU/SU/SW</li>
                    <li>SDP/CSIGIPES</li>
                    <li>SPMS/ FCP</li>
                    <li>Intéressés</li>
                    <li>Chrono/Affichage/Archives</li>
                    <li>Observatoire RH</li>
                </ul>

                <p>&nbsp;</p>
            </td>
        </tr>
        </tbody>
    </table>

    <p align="right"><strong>LE MINISTRE DE LA SANTE PUBLIQUE</strong></p>

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
