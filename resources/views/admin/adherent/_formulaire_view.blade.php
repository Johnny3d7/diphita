<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 txt-center">
            <div class="col-md-12"><img src="{{ asset('img/dl/diphita_logo_bleu.png') }}" style="height: 170px; width:auto;" alt="" class="img-responsive"></div>
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
                    <h3 class="font-cambria mt_10 mb_10">Tél. : {{ $sous->contact }} / E-mail : {{ $sous->email }}</h3>
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
                {{-- <div class="col" style="display: flex !important;"><div class="@if($adherent->civilite == 2) dot-orange @else dot-wh @endif  v-align-mid mt_10 mb_10"></div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;Mme</h3></div>
                <div class="col" style="display: flex !important;"><div class="@if($adherent->civilite == 3) dot-orange @else dot-wh @endif v-align-mid mt_10 mb_10"></div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;Mlle</h3></div>
                <div class="col" style="display: flex !important;"><div class="@if($adherent->civilite == 1) dot-orange @else dot-wh @endif v-align-mid mt_10 mb_10"></div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;M</h3></div> --}}
                <div class="col d-inline-flex"><div class="@if($adherent->civilite == 2 || $adherent->civilite == "Mme") '' @else dot-wh @endif v-align-mid mt_10 mb_10">{!! $adherent->civilite == 2 || $adherent->civilite == "Mme" ? '<i class="fa fa-2x fa-times-circle text-light"></i>' : '' !!}</div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;Mme</h3></div>
                <div class="col d-inline-flex"><div class="@if($adherent->civilite == 3 || $adherent->civilite == "Mlle") '' @else dot-wh @endif v-align-mid mt_10 mb_10">{!! $adherent->civilite == 3 || $adherent->civilite == "Mlle" ? '<i class="fa fa-2x fa-times-circle text-light"></i>' : '' !!}</div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;Mlle</h3></div>
                <div class="col d-inline-flex"><div class="@if($adherent->civilite == 1 || $adherent->civilite == "M.") '' @else dot-wh @endif v-align-mid mt_10 mb_10">{!! $adherent->civilite == 1 || $adherent->civilite == "M." ? '<i class="fa fa-2x fa-times-circle text-light"></i>' : '' !!}</div><h3 class="txt-color-wh my-auto font-cambria mt_10 mb_10">&nbsp;&nbsp;M.</h3></div>
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
                    <th scope="row" rowspan="3" class="v-align-mid">Somme à payer: <span style=" border:1.5px solid #2F5597; padding:5px 10px 5px 10px">{{ (int)$adherent->droit_inscription_montant + (int)$adherent->cot_annuelle_montant + (int)$adherent->kits_montant }} FCFA</span></th>
                    <td>
                        <div class="row">
                            <div class="col-md-7">Droit d'inscription:</div>
                            <div class="col-md-5 d-inline-flex"><div class="{{ !$adherent->isValide() ? 'dot ' : '' }}v-align-mid">{!! $adherent->isValide() ? '<i class="far fa-times-circle mr-2"></i>' : '' !!} </div> {{ $adherent->droit_inscription_montant }} frs CFA</td></div>
                        </div>
                  </tr>
                  <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-7">Cotisation annuelle:</div>
                            <div class="col-md-5 d-inline-flex"><div class="{{ !$adherent->isValide() ? 'dot ' : '' }}v-align-mid">{!! $adherent->isValide() ? '<i class="far fa-times-circle mr-2"></i>' : '' !!} </div> {{ $adherent->cot_annuelle_montant }} frs CFA</td></div>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-7">Traitement et kits d'inscription:</div>
                            <div class="col-md-5 d-inline-flex"><div class="{{ !$adherent->isValide() ? 'dot ' : '' }}v-align-mid">{!! $adherent->isValide() ? '<i class="far fa-times-circle mr-2"></i>' : '' !!} </div> {{ $adherent->kits_montant }} frs CFA</td></div>
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
    <div class="row justify-content-center">
        <h3 class="font-cambria mt_15 mb_15 txt-center">NB : La double inscription d’un même bénéficiaire est formellement interdite ; sa découverte annule la plus récente. Toute fausse déclaration annule l’inscription.</h3>
    </div>
    <div class="row ">
        {{-- <div class="font-cambria mt_15 mb_15"  style="font-size:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conseiller: {{ $adherent->conseiller_diph ? $adherent->conseiller_diph : 'Indisponible' }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fait à Abidjan, le {{ ucwords((new Carbon\Carbon($adherent->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div>--}}
        <div class="font-cambria mt_15 mb_15"  style="font-size:25px; float:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conseiller: 
            @if ($adherent->isSouscripteur())
                {{ $adherent->conseiller_diph ? $adherent->conseiller_diph : 'Indisponible' }}
            @else
                {{ $adherent->souscripteur()->conseiller_diph ? $adherent->souscripteur()->conseiller_diph : 'Indisponible' }}
            @endif
             
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fait à Abidjan, le {{ ucwords((new Carbon\Carbon($adherent->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <h3 class="font-cambria mt_15 mb_15 txt-center">SIGNATURE DU SOUSCRIPTEUR</h3> 
            <div class="font-cambria mt_15 mb_15 txt-center" style="font-size:21px;">{{ $adherent->isSouscripteur() ? $adherent->nom_pnom() : $adherent->souscripteur()->nom_pnom() }}</div>                                       
        </div>
        <div class="col">
            <h3 class="font-cambria mt_15 mb_15 txt-center">VISA DU BUREAU EXECUTIF</h3>
            <div class="font-cambria mt_15 mb_15 txt-center" style="font-size:21px;">{{ $adherent->admin->nom_pnom() }}</div>                                 
        </div>
        
    </div>
</div>