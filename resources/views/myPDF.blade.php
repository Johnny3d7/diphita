<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'adhésion</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css" />
    {{-- <style>
        .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        }
        .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
        }
        .justify-content-center {
        justify-content: center;
        }
        .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        }
        .txt-center {
        text-align: center;
        }
        img {
        vertical-align: middle;
        border-top-style: none;
        border-right-style: none;
        border-bottom-style: none;
        border-left-style: none;
        }
        h1, h2, h3, h4, h5, h6 {
        margin-top: 0px;
        margin-bottom: 0.5rem;
        color: rgb(71, 77, 88);
        font-family: Mulish, sans-serif;
        font-weight: 600;
        line-height: 1.2;
        }
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        margin-bottom: 0.5rem;
        font-weight: 500;
        line-height: 1.2;
        }
        .h1, h1 {
        font-size: 2.5rem;
        }
        .m-0 {
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 0px;
        }
        .txt-upper {
        text-transform: uppercase;
        }
        .txt-bold {
        font-weight: 900;
        }
        body, h1, h2, h3, h4, h5, h6, td, th {
        color: rgb(47, 85, 151);
        }
        .font-ms-reference-sans-serif {
        font-family: ms-reference-sans-serif;
        }
        .h-auto {
        height: auto;
        margin-left: auto;
        margin-right: auto;
        }
        .mt_5 {
        margin-top: 5px;
        }
        .font-arialblack {
        font-family: arialblack;
        }
        .mt_30 {
        margin-top: 30px;
        }
        .h3, h3 {
        font-size: 1.75rem;
        }
        .mt-auto, .my-auto {
        margin-top: auto;
        }
        .mb-auto, .my-auto {
        margin-bottom: auto;
        }
        .my-auto {
        margin-top: auto;
        margin-bottom: auto;
        }
        .txt-color-wh {
        color: rgb(255, 255, 255);
        }
        .mt_10 {
        margin-top: 10px;
        }
        .mb_10 {
        margin-bottom: 10px;
        }
        .font-cambria {
        font-family: Cambria;
        }
        h3 {
        font-size: 26px;
        }
        .pt_50 {
        padding-top: 50px;
        }
        .pb_50 {
        padding-bottom: 50px;
        }
        .col {
        flex-basis: 0px;
        flex-grow: 1;
        max-width: 100%;
        }
        .d-inline-flex {
        display: inline-flex;
        }
        .v-align-mid {
        vertical-align: middle;
        }
        .dot-wh {
        height: 25px;
        width: 25px;
        background-color: white;
        border-top-left-radius: 50%;
        border-top-right-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
        border-top-width: 2px;
        border-right-width: 2px;
        border-bottom-width: 2px;
        border-left-width: 2px;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: white;
        border-right-color: white;
        border-bottom-color: white;
        border-left-color: white;
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        display: inline-block;
        }
        .text-light {
        color: rgb(248, 249, 250);
        }
        .fa, .fab, .fal, .far, .fas {
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant-ligatures: normal;
        font-variant-caps: normal;
        font-variant-numeric: normal;
        font-variant-east-asian: normal;
        text-rendering: auto;
        line-height: 1;
        }
        .fa-2x {
        font-size: 2em;
        }
        .fa-times-circle::before {
        content: "";
        }
        .fa, .far, .fas {
        font-family: "Font Awesome 5 Free";
        }
        .fa, .fas {
        font-weight: 900;
        }
        table {
        border-collapse: collapse;
        }
        .table {
        width: 100%;
        margin-bottom: 1rem;
        color: rgb(33, 37, 41);
        }
        .table-bordered {
        border-top-width: 1px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: rgb(222, 226, 230);
        border-right-color: rgb(222, 226, 230);
        border-bottom-color: rgb(222, 226, 230);
        border-left-color: rgb(222, 226, 230);
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        }
        th {
        text-align: inherit;
        }
        .table td, .table th {
        padding-top: 0.75rem;
        padding-right: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 0.75rem;
        vertical-align: top;
        border-top-width: 0px;
        border-top-style: initial;
        border-top-color: initial;
        font-family: Cambria;
        font-size: 24px;
        }
        .table-bordered td, .table-bordered th {
        border-top-width: 1px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: rgb(222, 226, 230);
        border-right-color: rgb(222, 226, 230);
        border-bottom-color: rgb(222, 226, 230);
        border-left-color: rgb(222, 226, 230);
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        }
        table th, table td {
        text-align: left;
        }
        .mr-2, .mx-2 {
        margin-right: 0.5rem;
        }
        .far {
        font-weight: 400;
        }
        .mb_15 {
        margin-bottom: 15px;
        }
        .mt_15 {
        margin-top: 15px;
        }
    </style> --}}
    <style>
        @font-face {
            font-family: Copperplate;
            src: url('/copperplate/Copperplate.ttf');
        }

        @font-face {
            font-family: arialblack;
            src: url('/ArialBlack/arial-black.ttf');
        }

        @font-face {
            font-family: Cambria;
            src: url('/cambria/Cambria.ttf');
        }

        @font-face {
            font-family: ms-reference-sans-serif;
            src: url('/ms-reference-sans-serif/MS_Reference_Sans_Serif.ttf');
        }
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
            font-family: Copperplate !important;
            text-transform:capitalize !important;
            font-size:30px !important;
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
    {{-- <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> --}}

    <div class="container-fluid">

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
                        <div class="col-12 txt-center"><h1 class="m-0 txt-upper txt-bold h-title" style="">Diphita Prévoyance </h1></div>
                        <div class="col-12 txt-center font-ms-reference-sans-serif sh-title">Siège social : Yopougon – Entre l’Hôtel Assonvon et l’Eglise Baptiste Œuvres et Missions
                            <br>Tél. : (00225) 0576017601 / 0566040004 | Email : info.diphita@gmail.com 
                        </div>
                        <div class="col-12 txt-bold txt-center mt_5 h-auto" style=" border:3px solid; border-radius: 8px; width:80%; margin-left: 2rem;"><h1 class="font-arialblack h-subtitle" style="color:#2F5597 !important;">FORMULAIRE D’ADHÉSION</h1></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="border-0">
                    <div class="row justify-content-center" style="margin-top: 25px;">
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
                                        <p class="font-cambria pb-0 mb-0">Tél. : <span class="h6">{{ $sous->contact }}</span> / E-mail : <span class="h6">{{ $sous->email }}</span></p>
                                        <p class="font-cambria pb-0 mb-0">Résidence : <span class="h6">{{ $sous->lieu_hab }}</span></p>
                                    </td>
                                    <td style="width: 20%;">
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
                                <table class="table">
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
                                            @if($adherent->civilite == 1 || $adherent->civilite == "M")
                                                <i class="fa fa-times-circle text-light v-align-mid"></i> &nbsp;&nbsp;M
                                            @else
                                                <div class="dot-wh v-align-mid"></div> &nbsp;&nbsp; M
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
                                                        <i class="far fa-times-circle mx-2 pt-2"></i>
                                                    @endif
                                                    {{ $adherent->droit_inscription_montant }} frs CFA
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
                                                        <i class="far fa-times-circle mx-2 pt-2"></i>
                                                    @endif
                                                    {{ $adherent->cot_annuelle_montant }} frs CFA
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
                                                        <i class="far fa-times-circle mx-2 pt-2"></i>
                                                    @endif
                                                    {{ $adherent->kits_montant }} frs CFA
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
                                <table class="table">
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

        <table class="table my-2 mt-4">
            <tr>
                <td class="font-cambria border-0 txt-center"  style="font-size:15px;">
                    Conseiller: 
                    @if ($adherent->isSouscripteur())
                        {{ $adherent->conseiller_diph ? $adherent->conseiller_diph : 'Indisponible' }}
                    @else
                        {{ $adherent->souscripteur()->conseiller_diph ? $adherent->souscripteur()->conseiller_diph : 'Indisponible' }}
                    @endif
                </td>
                <td class="border-0 txt-center">
                    Fait à Abidjan, le {{ ucwords((new Carbon\Carbon($adherent->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}                                                                                                          
                </td>
            </tr>
            <tr>
                <td class="border-0">
                    <h6 class="font-cambria mt-5 txt-center">SIGNATURE DU SOUSCRIPTEUR</h6> 
                    <div class="font-cambria txt-center" style="font-size:14px;">{{ $adherent->isSouscripteur() ? $adherent->nom_pnom() : $adherent->souscripteur()->nom_pnom() }}</div>
                </td>
                <td class="border-0">
                    <h6 class="font-cambria mt-5 txt-center">VISA DU BUREAU EXECUTIF</h6>
                    <div class="font-cambria txt-center" style="font-size:14px;">{{ $adherent->admin->nom_pnom() }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>