@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
    <style>
        body, h1, h2, h3, h4, h5, h6,td,th{
            color:#2F5597 !important;
        }
        .table td,.table th{
            font-family: Cambria !important;
            font-size: 24px !important;
            padding-top: 0rem !important;
            padding-bottom: 0rem !important;
        }

        #bl{
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 25%;
        background-image:url({{ url('images/totem_obp.png') }}) ;
    }
        table th, table td {
            text-align: left !important;
        }
    </style>
@endsection

@section('title')
    Formulaire d'adhésion
@endsection

@section('subtitle')
    Formulaire d'adhésion      
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                {{-- <h3 class="m-0">Formulaire d'ajout d'un adhérent</h3> --}}
                                <div class="col-md-12 text-center mt_15">
                                    @include('admin.partials.message')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body" id="logo_fond">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-3 txt-center">
                                        <div class="col-md-12"><img src="{{ url('img/dl/diphita_logo_bleu.png') }}" style="height: 170px; width:auto;" alt="" class="img-responsive"></div>
                                        <div class="col-md-12" style="font-family: ms-reference-sans-serif !important;">www.diphita.org</div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="col-md-12 txt-center"><h1 class="m-0 txt-upper txt-bold" style="font-family: Copperplate !important; text-transform:capitalize !important; font-size:65px !important; color:#2F5597 !important;">Diphita Prévoyance </h1></div>
                                        <div class="col-md-12 txt-center font-ms-reference-sans-serif">Siège social : Yopougon – Entre l’Hôtel Assonvon et l’Eglise Baptiste Œuvres et Missions
                                            <br>Tél. : (00225) 0576017601 / 0566040004 | Email : info.diphita@gmail.com 
                                        </div>
                                        <div class="col-md-12 txt-bold txt-center mt_5 h-auto" style=" border:3px solid; border-radius: 8px; width:90%;"><h1 class="font-arialblack" style="color:#2F5597 !important;">FORMULAIRE D’ADHÉSION</h1></div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt_30">
                                    <div class="col-md-12" style=" border:1.5px solid #2F5597;  width:70% !important; background-color:#2F5597">
                                        <h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">SOUSCRIPTEUR</h3>
                                    </div>
                                    <div class="col-md-12" style=" border:1.5px solid #2F5597;  width:70% !important; background-color:#DAE3F3">
                                        @if ($adherent->role == 1)
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h3 class="font-cambria mt_10 mb_10">Nom : {{ $adherent->nom }}</h3>
                                                    <h3 class="font-cambria mt_10 mb_10">Prénom(s) : {{ $adherent->pnom }}</h3>
                                                    <h3 class="font-cambria mt_10 mb_10">Numéro CNI : {{ $adherent->num_cni }}</h3>
                                                    <h3 class="font-cambria mt_10 mb_10">Tél. : {{ $adherent->contact }} / E-mail : {{ $adherent->email }}</h3>
                                                    <h3 class="font-cambria mt_10 mb_10">Résidence : {{ $adherent->lieu_hab }}</h3>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="col-md-12">
                                                        <div class="font-cambria mt_10 mb_10 pb_50 pt_50 txt-center" style=" border:1.5px solid #2F5597; font-size:25px; background-color:white !important;">Photo du bénéficiaire (Facultatif) </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @elseif($adherent->role == 2)
                                        @php
                                            // Contient le souscripteur au cas ou le bénéficiaire != du souscripteur
                                            $sous = Adherents::where(['status'=> 1, 'role'=>1,'id'=>$adherent->parent])->first();
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h3 class="font-cambria mt_10 mb_10">Nom : {{ $sous->nom }}</h3>
                                                <h3 class="font-cambria mt_10 mb_10">Prénom(s) : {{ $sous->pnom }}</h3>
                                                <h3 class="font-cambria mt_10 mb_10">Numéro CNI : {{ $sous->num_cni }}</h3>
                                                <h3 class="font-cambria mt_10 mb_10">Tél. : {{ $sous->contact }} E-mail : {{ $sous->email }}</h3>
                                                <h3 class="font-cambria mt_10 mb_10">Résidence : {{ $sous->lieu_hab }}</h3>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <div class="font-cambria mt_10 mb_10 pb_50 pt_50 txt-center" style=" border:1.5px solid #2F5597; font-size:25px; background-color:white !important;">Photo du bénéficiaire (Facultatif) </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif                
                                    </div>
                                </div>
                                <div class="row justify-content-center mt_30">
                                    <div class="col-md-12" style=" border:1.5px solid #2F5597;  width:70% !important; background-color:#2F5597">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">BÉNÉFICIAIRE</h3>
                                            </div>
                                            <div class="col" style="display: flex !important;"><div class="@if($adherent->civilite == 2) dot-orange @else dot-wh @endif  v-align-mid mt_10 mb_10"></div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;Mme</h3></div>
                                            <div class="col" style="display: flex !important;"><div class="@if($adherent->civilite == 3) dot-orange @else dot-wh @endif v-align-mid mt_10 mb_10"></div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;Mlle</h3></div>
                                            <div class="col" style="display: flex !important;"><div class="@if($adherent->civilite == 1) dot-orange @else dot-wh @endif v-align-mid mt_10 mb_10"></div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;M</h3></div>
                                        </div>
                                    </div>
                                        <table class="table table-bordered">
                                            
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
                                                <th scope="row" rowspan="3" class="v-align-mid">Somme à payer: <span style=" border:1.5px solid #2F5597; padding:5px 10px 5px 10px">10000 Fcfa</span></th>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-7">Droit d'inscription:</div>
                                                        <div class="col-md-5"><div class="dot v-align-mid"></div> 7000 frs CFA</td></div>
                                                    </div>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-7">Cotisation annuelle:</div>
                                                        <div class="col-md-5"><div class="dot v-align-mid"></div> 2000 frs CFA</td></div>
                                                    </div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-7">Traitement et kits d'inscription:</div>
                                                        <div class="col-md-5"><div class="dot v-align-mid"></div> 1000 frs CFA</td></div>
                                                    </div>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                </div>
                                <div class="row justify-content-center mt_30">
                                    <div class="col-md-12" style=" border:1.5px solid #2F5597;  width:70% !important; background-color:#2F5597">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">Ayants-droit désignés par ordre de priorité</h3>
                                            </div>
                                            <div class="col">
                                                <h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">Contacts</h3>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                        <table class="table table-bordered">
                                            
                                            <tbody>
                                            @if ($adherent->role == 2)
                                            @foreach ($sous->ayants as $ayant)
                                                <tr>
                                                    <th scope="row" style="width: 5%">{{ $ayant->priorite }}</th>
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
                                <div class="row justify-content-center">
                                    <h3 class="font-cambria mt_15 mb_15 txt-center">NB : La double inscription d’un même bénéficiaire est formellement interdite ; sa découverte annule la plus récente. Toute fausse déclaration annule l’inscription.</h3>
                                </div>
                                <div class="row ">
                                    <div class="font-cambria mt_15 mb_15"  style="font-size:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conseiller: {{ $adherent->conseiller_diph ? $adherent->conseiller_diph : 'Indisponible' }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fait à Abidjan, le {{ ucwords((new Carbon\Carbon($adherent->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col">
                                        <h3 class="font-cambria mt_15 mb_15 txt-center">SIGNATURE DU SOUSCRIPTEUR</h3> 
                                        <div class="font-cambria mt_15 mb_15 txt-center" style="font-size:21px;">{{ $adherent->nom_pnom() }}</div>                                       
                                    </div>
                                    <div class="col">
                                        <h3 class="font-cambria mt_15 mb_15 txt-center">VISA DU BUREAU EXECUTIF</h3>
                                        <div class="font-cambria mt_15 mb_15 txt-center" style="font-size:21px;">Lawrence Gallaty Kouassi Bi</div>                                 
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 txt-center">
                <a href="#" class="white_btn_1 btnblprint">Imprimer</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.btnblprint').on('click', function(event) {
        event.preventDefault();
        // window.print();
        var prtContent = document.getElementById("logo_fond");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
 </script>
@endsection