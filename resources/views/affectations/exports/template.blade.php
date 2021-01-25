<html>

<head>
    <!-- CSRF Token -->
    <style type="text/css">
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
        .table {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .table th,
        .table td {
            padding: 0.10rem;
            vertical-align: top;
            border-top: 1px solid #222;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #222;
        }

        .table tbody + tbody {
            border-top: 2px solid #222;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.1rem;
        }

        .table-bordered {
            border: 1px solid #222;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #222;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody + tbody {
            border: 0;
        }

        #listeP {
            border-collapse: collapse;
            text-align: center;
        }

        #listeP {
            padding: 0 !important;
        }

        #listeP .firsthead {
            background-color: rgb(148, 138, 84) !important;
        }

        #listeP .secondhead {
            background-color: rgb(196, 188, 150) !important;
        }
    </style>
    <title>{{ "Affectations_".substr($fiche->titre,0,20)."_".$fiche->date }}</title>


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
                <div class="nominations">
                    @foreach($donnees as $key => $donnee)
                        <table style='font-size: 12px;font-family:"Tahoma",sans-serif;width: 100%;border: 1px solid #222;' id="listeP"
                               class="table table-bordered">
                            <thead>
                            <tr class="firsthead">
                                <td colspan="3" style="font-weight: bold;">
                                    {{ $key }}
                                </td>
                            </tr>
                            <tr class="secondhead" style="text-transform: uppercase">
                                <th>N°</th>
                                <th>Nom et Prenom</th>
                                <th>Structure d'Affectation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($donnee as $key => $affectations)
                                <tr><th colspan="4" class="secondhead">{{ $key }}</th></tr>
                               @foreach($affectations as $affectation)
                                   <tr>
                                       <td>{{ $loop->index+1 }}</td>
                                       <td style="text-align: left !important; padding-left: 2%">@if($affectation->personnel->sexe == "Feminin")
                                               Madame @else Monsieur @endif <b
                                               style="text-transform: uppercase"> {{ $affectation->personnel->nom }} {{ $affectation->personnel->prenom }}</b>
                                       </td>
                                       <td style="text-align: left !important; padding-left: 2%">{{ $affectation->structure->nom }}</td>
                                   </tr>
                                   @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
                    <!--edit ici -->
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
  /* $("html").print({
       globalStyles: true,
       mediaPrint: true,
       stylesheet: "{{ asset('css/print.css') }}",
       noPrintSelector: ".no-print",
       doctype: '<!doctype html>'
    });*/
  window.print();

  setInterval(function () {
       window.history.back();
   },5000)
</script>


</body>

</html>
