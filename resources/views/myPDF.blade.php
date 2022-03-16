<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'adhésion</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css" />
    <style>
        /* @font-face { font-family: 'Nunito'; font-style: normal; font-weight: 400; font-display: swap; src: url('Nunito/static/Nunito-Regular.ttf') format('ttf'); } */
        /* @font-face {
            font-family: 'Copperplate';
            src: url('copperplate/Copperplate.ttf');
        }

        @font-face {
            font-family: 'arialblack';
            src: url('ArialBlack/arial-black.ttf');
        }

        @font-face {
            font-family: 'Cambria';
            src: url('cambria/Cambria.ttf');
        }

        @font-face {
            font-family: 'ms-reference-sans-serif';
            src: url('ms-reference-sans-serif/MS_Reference_Sans_Serif.ttf');
        } */
    </style>
    <style>
        body, h1, h2, h3, h4, h5, h6,td,th{
            color:#2F5597 !important;
        }
        .table td,.table th{
            font-family: Cambria !important;
            font-size: 14px !important;
            padding-top: 0rem !important;
            padding-bottom: 0rem !important;
        }

        #bl{
            background-repeat: no-repeat;
            background-position-x: center;
            background-position-y: center;
            background-size: 25%;
            background-image:url('images/totem_obp.png') ;
        }
        table th, table td {
            text-align: left !important;
        }

        .s-img{
            font-family: ms-reference-sans-serif !important;
            font-size: 10px;
        }
        .h-title{
            text-transform:capitalize !important;
            font-size:30px !important;
            font-weight: 500px !important;
            color:#2F5597 !important;
        }
        .sh-title{
            font-size:10px !important;
        }
        .h-subtitle{
            font-size:20px !important;
        }

        .dot-wh{
            height: 15px;
            width: 15px;
        } 
        
        
    </style>

</head>
<body>
    <div class="container-fluid" style="width: 97% !important;">
        <table class="table">
            <tr>
                <td class="border-top-0" style="width: 20%">
                    <div class="txt-center">
                        <div><img src="img/dl/diphita_logo_bleu.png" style="height: 90px; width:auto;" alt="" class=""></div>
                        <div class="s-img" style="">www.diphita.org</div>
                    </div>
                </td>
                <td class="border-top-0">
                    <div class="col-12 ">
                        <div class="col-12 txt-center">
                            <span class="m-0 h-title" style="font-family: Copperplate !important;">Diphita Prévoyance </span>
                        </div>
                        <div class="col-12 txt-center font-ms-reference-sans-serif sh-title">Siège social : Yopougon – Entre l’Hôtel Assonvon et l’Eglise Baptiste Œuvres et Missions
                            <br>Tél. : (00225) 0576017601 / 0566040004 | Email : info.diphita@gmail.com 
                        </div>
                        <div class="col-12 txt-bold txt-center h-auto" style=" border:2px solid; border-radius: 5px; width:80%; margin-left: 2rem; margin-top: 10px; padding: 0px;">
                            <span class="h-title" style="font-family: arialblack !important; font-size:20px !important; line-height: 20px !important;">FORMULAIRE D’ADHÉSION</span>
                            {{-- <span class="h-subtitle" style="color:#2F5597 !important; font-family: Copperplate !important;"></span> --}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="border-0">
                    <div class="row justify-content-center" style="margin-top: 15px;">
                        <div class="col-12" style="border:1.5px solid #2F5597; width:95% !important; padding: 5px 15px; background-color:#2F5597">
                            <h6 class="txt-color-wh my-auto font-cambria">SOUSCRIPTEUR</h6>
                        </div>
                        <div class="col-12" style=" border:1.5px solid #2F5597; width:95% !important; background-color:#DAE3F3">
                            @php
                                // Contient le souscripteur au cas ou le bénéficiaire != du souscripteur
                                $sous = $adherent->isSouscripteur() ? $adherent : $adherent->souscripteur(); // Adherents::where(['status'=> 1, 'role'=>1,'id'=>$adherent->parent])->first();
                            @endphp
                            <table class="table">
                                <tr>
                                    <td>
                                        <p class="font-cambria pb-0 mb-0">Nom : <span class="h6">{{ $sous->nom }}</span></p>
                                        <p class="font-cambria pb-0 mb-0">Prénom(s) : <span class="h6">{{ $sous->pnom }}</span></p>
                                        <p class="font-cambria pb-0 mb-0">Numéro CNI : <span class="h6">{{ $sous->num_cni }}</span></p>
                                        {{-- <p class="font-cambria pb-0 mb-0">Tél. : <span class="h6">{{ $sous->contact }}</span> / E-mail : <span class="h6">{{ $sous->email }}</span></p> --}}
                                        <p class="font-cambria pb-0 mb-0">Tél. : <span class="h6">{{ $sous->contact }}</span></p>
                                        <p class="font-cambria pb-0 mb-0">E-mail : <span class="h6">{{ $sous->email }}</span></p>
                                        <p class="font-cambria pb-0 mb-0">Résidence : <span class="h6">{{ $sous->lieu_hab }}</span></p>
                                    </td>
                                    <td style="width: 23%;">
                                        <div class="font-cambria mt_10 mb_10 py-4 txt-center" style=" border:1.5px solid #2F5597; font-size:14px; background-color:white !important;">Photo du bénéficiaire (Facultatif) </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </td>
            </tr>
            <tr>
                <td colspan="2" class="border-0">
                    <div class="row justify-content-center" style="margin-top: 15px;">
                        <div class="col-12" style="border:1.5px solid #2F5597; width:95% !important; padding: 5px 15px; background-color:#2F5597">
                            <div class="txt-color-wh my-auto font-cambria">
                                <table class="table m-0">
                                    <tr>
                                        <td class="border-0">
                                            <h6 class="txt-color-wh">BÉNÉFICIAIRE</h6>
                                        </td>
                                        <td class="txt-color-wh border-0">
                                            @if($adherent->civilite == 2 || $adherent->civilite == "Mme")
                                                <i class="fa fa-times-circle text-light v-align-mid" style="font-size: 20px"></i> &nbsp;&nbsp;Mme
                                            @else
                                                <div class="dot-wh v-align-mid"></div> &nbsp;&nbsp; Mme
                                            @endif
                                        </td>
                                        <td class="txt-color-wh border-0">
                                            @if($adherent->civilite == 3 || $adherent->civilite == "Mlle")
                                                <i class="fa fa-times-circle text-light v-align-mid"></i> &nbsp;&nbsp;Mlle
                                            @else
                                                <div class="dot-wh v-align-mid"></div> &nbsp;&nbsp; Mlle
                                            @endif
                                        </td>
                                        <td class="txt-color-wh border-0">
                                            @if($adherent->civilite == 1 || $adherent->civilite == "M.")
                                                <i class="fa fa-times-circle text-light v-align-mid"></i> &nbsp;&nbsp;M.
                                            @else
                                                <div class="dot-wh v-align-mid"></div> &nbsp;&nbsp; M.
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                
                            </div>
                        </div>
                        <div class="col-12 p-0" style=" border:1.5px solid #2F5597; width:99.2% !important; background-color:white">
                            <table class="table table-bordered p-0 m-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Numéro d’Identification</th>
                                        <td>{{ $adherent->num_adhesion }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nom et prénom(s)</th>
                                        <td>{{ $adherent->nom }} {{ $adherent->pnom }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date et lieu de naissance</th>
                                        <td> {{ ucwords((new Carbon\Carbon($adherent->date_naiss))->locale('fr')->isoFormat('DD/MM/YYYY')) }} à {{ $adherent->lieu_naiss }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Numéro CNI</th>
                                        <td>{{ $adherent->num_cni }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lieu de résidence</th>
                                        <td>{{ $adherent->lieu_hab }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date d’inscription</th>
                                        <td>{{ ucwords((new Carbon\Carbon($adherent->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fin de carence</th>
                                        <td>{{ ucwords((new Carbon\Carbon($adherent->date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="3" class="v-align-mid">Somme à payer: <span style=" border:1.5px solid #2F5597; padding:5px 10px 5px 10px">{{ (int)$adherent->droit_inscription_montant + (int)$adherent->cot_annuelle_montant + (int)$adherent->kits_montant }} FCFA</span></th>
                                        <td>
                                            <span>
                                                Droit d'inscription:
                                                <span style="position: absolute; right: 10px;">
                                                    @if(!$adherent->isValide())
                                                        <div class="dot v-align-mid"></div>
                                                    @else
                                                        <i class="far fa-times-circle mx-1 pt-2"></i>
                                                    @endif
                                                    {{ $adherent->droit_inscription_montant ?? 0 }} frs CFA
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                Cotisation annuelle:
                                                <span style="position: absolute; right: 10px;">
                                                    @if(!$adherent->isValide())
                                                        <div class="dot v-align-mid"></div>
                                                    @else
                                                        <i class="far fa-times-circle mx-1 pt-2"></i>
                                                    @endif
                                                    {{ $adherent->cot_annuelle_montant ?? 0 }} frs CFA
                                                </span>
                                            </span>                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                Traitement et kits d'inscription:
                                                <span style="position: absolute; right: 10px;">
                                                    @if(!$adherent->isValide())
                                                        <div class="dot v-align-mid"></div>
                                                    @else
                                                        <i class="far fa-times-circle mx-1 pt-2"></i>
                                                    @endif
                                                    {{ $adherent->kits_montant ?? 0 }} frs CFA
                                                </span>
                                            </span>
                                            {{-- <div class="row">
                                                <div class="col-md-7">Traitement et kits d'inscription:</div>
                                                <div class="col-md-5 d-inline-flex"><div class="{{ !$adherent->isValide() ? 'dot ' : '' }}v-align-mid">{!! $adherent->isValide() ? '<i class="far fa-times-circle mr-2"></i>' : '' !!} </div> {{ $adherent->kits_montant }} frs CFA</td></div>
                                            </div> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </td>
            </tr>
            <tr>
                <td colspan="2" class="border-0">
                    <div class="row justify-content-center" style="margin-top: 15px;">
                        <div class="col-12" style="border:1.5px solid #2F5597; width:95% !important; padding: 5px 15px; background-color:#2F5597">
                            <div class="txt-color-wh my-auto font-cambria">
                                <table class="table m-0">
                                    <tr>
                                        <td class="border-0">
                                            <h6 class="txt-color-wh">Ayants-droit désignés par ordre de priorité</h6>
                                        </td>
                                        <td class="border-0">
                                            <h6 class="txt-color-wh">Contacts</h6>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 p-0" style=" border:1.5px solid #2F5597; width:99.2% !important; background-color:white">
                            <table class="table table-bordered p-0 m-0">
                                <tbody>
                                    @if ($adherent->role == 2)
                                        <tr>
                                            <th scope="row" style="width: 5%">{{ '1' }}</th>
                                            <td style="width: 65%">{{ $adherent->souscripteur()->nom }} {{ $adherent->souscripteur()->pnom }}</td>
                                            <td style="width: auto">{{ $adherent->souscripteur()->contact }}</td>
                                        </tr>
                                        @foreach ($sous->ayants as $ayant)
                                            <tr>
                                                <th scope="row" style="width: 5%">{{ $ayant->priorite+1 }}</th>
                                                <td style="width: 65%">{{ $ayant->nom }} {{ $ayant->pnom }}</td>
                                                <td style="width: auto">{{ $ayant->contact }}</td>
                                            </tr>
                                        @endforeach
                                    @elseif($adherent->role == 1)
                                        @foreach ($adherent->ayants as $ayant)
                                            <tr>
                                                <th scope="row" style="width: 5%">{{ $ayant->priorite }}</th>
                                                <td style="width: 65%">{{ $ayant->nom }} {{ $ayant->pnom }}</td>
                                                <td style="width: auto">{{ $ayant->contact }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </td>
            </tr>
        </table>


        <div class="row justify-content-center">
            <h6 class="font-cambria my-1 txt-center">NB : La double inscription d’un même bénéficiaire est formellement interdite ; sa découverte annule la plus récente. Toute fausse déclaration annule l’inscription.</h6>
        </div>

        <table class="table my-2 mt-3">
            <tr>
                <td class="font-cambria border-0"  style="font-size:15px;">
                    Conseiller: 
                    @if ($adherent->isSouscripteur())
                        {{ $adherent->conseiller_diph ? $adherent->conseiller_diph : 'Indisponible' }}
                    @else
                        {{ $adherent->souscripteur()->conseiller_diph ? $adherent->souscripteur()->conseiller_diph : 'Indisponible' }}
                    @endif
                </td>
                <td class="border-0 text-right">
                    Fait à Abidjan, le {{ ucwords((new Carbon\Carbon($adherent->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}                                                                                                          
                </td>
            </tr>
            <tr>
                <td class="border-0">
                    <h6 class="font-cambria mt-4 txt-center">SIGNATURE DU SOUSCRIPTEUR</h6> 
                    <div class="font-cambria txt-center" style="font-size:14px;">{{ $adherent->isSouscripteur() ? $adherent->nom_pnom() : $adherent->souscripteur()->nom_pnom() }}</div>
                </td>
                <td class="border-0">
                    <h6 class="font-cambria mt-4 txt-center">VISA DU BUREAU EXECUTIF</h6>
                    <div class="font-cambria txt-center" style="font-size:14px;">{{ $adherent->admin->nom_pnom() }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>