@extends('admin.main')

@php
    $assistance = $beneficiaire->assistance;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Détails de l'assistance
@endsection

@section('subtitle')
    Détails de l'assistance  
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col">
                                    <div class="card mb-3 widget-chart">
                                        <div class="icon-wrapper rounded-circle">
                                            <div class="icon-wrapper-bg bg-primary"></div>
                                            <i class="ti-settings text-primary"></i>
                                        </div>
                                            @if ($souscripteur->num_contrat==null || $souscripteur->status==0)
                                                <div class="widget-numbers"><span>INACTIF</span></div>
                                                
                                            @else
                                            <div class="widget-numbers"><span>{{ $souscripteur->num_contrat }}</span></div>
                                            @endif
                                            
                                            <div class="widget-subheading">Numéro du contrat</div>
                                        <div class="widget-description text-success">
                                            <i class="fa fa-angle-up ">
                
                                            </i>
                                           
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col">
                                    <div class="card mb-3 widget-chart">
                                        <div class="icon-wrapper rounded-circle">
                                            <div class="icon-wrapper-bg bg-primary"></div>
                                            <i class="ti-settings text-primary"></i>
                                        </div>
                                            
                                            <div class="widget-numbers"><span>{{ Adherents::where(['status'=>1,'role'=>2,'parent'=>$souscripteur->id])->orderBy('created_at', 'DESC')->count() + 1;  }}</span></div>
                                            <div class="widget-subheading">Nombre de bénéficiaires</div>
                                        <div class="widget-description text-success">
                                            <i class="fa fa-angle-up ">
                
                                            </i>
                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card mb-3 widget-chart">
                                        <div class="icon-wrapper rounded-circle">
                                            <div class="icon-wrapper-bg bg-primary"></div>
                                            <i class="ti-settings text-primary"></i>
                                        </div>
                                            <div class="widget-numbers"><span>{{ AyantDroit::where(['status'=>1,'id_adherent'=>$souscripteur->id])->orderBy('created_at', 'DESC')->count() }}</span></div>
                                            <div class="widget-subheading">Nombre d'ayants-droit</div>
                                        <div class="widget-description text-success">
                                            <i class="fa fa-angle-up ">
                
                                            </i>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card mb-3 widget-chart">
                                        <div class="icon-wrapper rounded-circle">
                                            <div class="icon-wrapper-bg bg-primary"></div>
                                            <i class="ti-settings text-primary"></i>
                                        </div>
                                            <div class="widget-numbers"><span>{{ $souscripteur->assistances->where('valide',1)->count() }}</span></div>
                                            <div class="widget-subheading">Nombre d'assistances</div>
                                        <div class="widget-description text-success">
                                            <i class="fa fa-angle-up">
                
                                            </i>
                                            
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-12 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Souscripteur</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">
                                        Numéro d'identification:&nbsp;&nbsp;&nbsp;
                                        <div class=" f_w_600 color_text_5">
                                            <a href="{{ route('admin.adhesion.show',['id'=>$beneficiaire->souscripteur()->id]) }}">
                                                {{ $beneficiaire->souscripteur()->num_adhesion }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Civilité:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">
                                                        @if ($beneficiaire->souscripteur()->civilite == 1)
                                                            Monsieur
                                                        @elseif($beneficiaire->souscripteur()->civilite == 2)
                                                            Madame
                                                        @elseif($beneficiaire->souscripteur()->civilite == 3)
                                                            Mademoiselle
                                                        @endif

                                                        {{ $beneficiaire->souscripteur()->civilite }}
                                    </div>
                                </div>
                                </div>
                            </div>   
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Nom:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->souscripteur()->nom }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Prénom(s):&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->souscripteur()->pnom }}</div></div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Téléphone:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->souscripteur()->contact != null ? $beneficiaire->souscripteur()->contact : 'Indisponible'}}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Email:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->souscripteur()->email != null ? $beneficiaire->souscripteur()->email : 'Indisponible' }}</div></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt_30 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaire</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">
                                        Numéro d'identification:&nbsp;&nbsp;&nbsp;
                                        <div class=" f_w_600 color_text_5">
                                            <a href="{{ route('admin.adhesion.show',['id'=>$beneficiaire->id]) }}">
                                                {{ $beneficiaire->num_adhesion }}
                                            </a>
                                         </div></div>
                                </div>
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Civilité:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">
                                                        @if ($beneficiaire->civilite == 1)
                                                            Monsieur
                                                        @elseif($beneficiaire->civilite == 2)
                                                            Madame
                                                        @elseif($beneficiaire->civilite == 3)
                                                            Mademoiselle
                                                        @endif

                                                        {{ $beneficiaire->civilite }}
                                    </div>
                                </div>
                                </div>
                            </div>   
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Nom:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->nom }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Prénom(s):&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->pnom }}</div></div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Téléphone:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->contact != null ? $beneficiaire->contact : 'Indisponible'}}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Email:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $beneficiaire->email != null ? $beneficiaire->email : 'Indisponible' }}</div></div>
                                </div>
                            </div>

                                                   
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                 <div class="email-sidebar white_box">
                   
                    <div class="card mb-3 widget-chart border-0">
                        <div class="icon-wrapper rounded-circle">
                            @if ($assistance->assiste == 0)
                                <div class="icon-wrapper-bg bg-danger"></div>
                                <i class="ti-face-sad text-danger"></i>
                            @else
                            <div class="icon-wrapper-bg bg-success"></div>
                            <i class="ti-face-smile text-sucess"></i>
                            @endif
                            
                        </div>
                            @if ($assistance->assiste == 1 )
                                <div class="widget-numbers"><span style="font-size: 1.5rem !important;"> Cas assisté</span></div>
                            @else
                                <div class="widget-numbers"><span style="font-size: 1.5rem !important;">Non assisté </span></div>
                            @endif
                            
                            <div class="widget-subheading">État</div>
                    </div>
                    @if ($assistance->assiste == 0)
                    <a href="{{ route('admin.assistance.assister',['id' => $assistance->id]) }}">
                        <button class="btn_1 w-100 mb-2 btn-lg email-gradient gradient-9-hover email__btn waves-effect"><i class="ti-money"></i> Assister le cas</button>
                    </a>
                    @endif
                    
                    <ul class="text-left mt-2">
                        @if ($assistance->valide == 0)
                        <li><a href="{{ route('admin.assistance.valider', ['id' => $assistance->id]) }}"><i class="ti-check"></i> <span> <span>Valider</span> </span> </a></li>
                        <li><a href="{{ route('admin.assistance.rejeter', ['id' => $assistance->id]) }}"><i class="ti-trash"></i> <span> <span>Rejeter</span>  </span> </a></li>
                        @endif

                        @if ($beneficiaire->status == 0 && $souscripteur->valide == 1)
                            <li><a href="{{ route('admin.adherent.debloquer',['id' => $souscripteur->id]) }}"><i class="ti-unlock"></i> <span> <span>Activer compte</span>  </span> </a></li>
                            
                        @elseif ($assistance->valide == 1)
                            @if ($assistance->assiste == 0)
                                <li><a href="#"><i class="ti-save"></i> <span> <span>Modifier infos</span> </span> </a></li>
                            @endif
                            
                            {{-- <li><a href="{{ route('admin.assistance.souscripteur.index',['id' => $assistance->id]) }}"><i class="ti-list"></i> <span> <span>Liste des assistances</span> </span> </a></li>   --}}
                            <li><a href="{{ route('admin.assistance.index') }}"><i class="ti-list"></i> <span> <span>Liste des assistances</span> </span> </a></li>  
                         
                        @endif
                        
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="row">
             <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb_30">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations de l'assistance</h4>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date de décès:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ ucwords((new Carbon\Carbon($assistance->date_deces))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Lieu de décès:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $assistance->lieu_deces}}</div></div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date des obsèques:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ ucwords((new Carbon\Carbon($assistance->date_obseques))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date d'assistance:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ ucwords((new Carbon\Carbon($assistance->date_assistance))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div></div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Valide:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $assistance->valide == 1 ? 'Oui': 'Non'}}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Moyen d'assistance:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">
                                        @if ($assistance->moyen_assistance == 1)
                                            Espèces
                                        @elseif($assistance->moyen_assistance == 2)
                                            Chèque
                                        @elseif($assistance->moyen_assistance == 3)
                                            Virement
                                        @elseif($assistance->moyen_assistance == 4)
                                            Dépôt électronique
                                        @endif

                                        {{ $assistance->moyen_assistance }}
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Enfant du défunt:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $assistance->enfant_defunt }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Téléphone:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $assistance->enfant_contact}}</div></div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Proche du défunt:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $assistance->proche_defunt }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Téléphone:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $assistance->proche_contact}}</div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endsection

@section('js')
    
@endsection