@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Détails d'un souscripteur
@endsection

@section('subtitle')
    Détails du souscripteur {{ $souscripteur->nom }} {{ $souscripteur->pnom }}   
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
                                <div class="col">
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
                                            {{-- <span class="pl-1"><span>176%</span></span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
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
                                            {{-- <span class="pl-1"><span>176%</span></span> --}}
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
                                            {{-- <span class="pl-1"><span>176%</span></span> --}}
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
                                            {{-- <span class="pl-1"><span>176%</span></span> --}}
                                        </div>
                                    </div>
                                </div>
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
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Numéro d'identification:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5"><a href="{{ route('admin.adherent.formulaire-print',['id'=>$souscripteur->id]) }}" {{ $souscripteur->cas == 1 ? 'text-danger' : 'text-success'  }}>{{ $souscripteur->num_adhesion }}</a> </div></div>
                                </div>
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Civilité:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">
                                                        @if ($souscripteur->civilite == 1)
                                                            Monsieur
                                                        @elseif($souscripteur->civilite == 2)
                                                            Madame
                                                        @elseif($souscripteur->civilite == 3)
                                                            Mademoiselle
                                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>   
                            <div class="row">
                                
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Nom:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $souscripteur->nom }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Prénom(s):&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $souscripteur->pnom }}</div></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Lieu de naissance:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">
                                        {{ $souscripteur->lieu_naiss }}                
                                    </div>
                                </div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date de naissance:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">
                                        {{ ucwords((new Carbon\Carbon($souscripteur->date_naiss))->locale('fr')->isoFormat('DD/MM/YYYY')) }}
                                    </div>
                                </div>
                                </div>
                                
                            </div>  
                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Lieu de résidence:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $souscripteur->lieu_hab }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Email:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $souscripteur->email }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Contact:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ $souscripteur->contact }}</div></div>
                                </div>
                            </div>
                            @if ($souscripteur->valide == 1)
                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date d'adhésion:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ ucwords((new Carbon\Carbon($souscripteur->date_adhesion))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div></div>
                                </div>
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date de fin de carence:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ ucwords((new Carbon\Carbon($souscripteur->date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</div></div>
                                </div>
                                
                            </div>    
                            <div class="row">
                                <div class="col mb_15" style="font-size:16px !important">
                                    <div class="m-0 txt-color1 txt-bold" style="display:flex">Date de début de cotisation:&nbsp;&nbsp;&nbsp;<div class=" f_w_600 color_text_5">{{ ucwords((new Carbon\Carbon($souscripteur->date_debutcotisation))->locale('fr')->isoFormat('Do MMMM YYYY')) }}</div></div>
                                </div>
                            </div>
                            <div class="row mt_30 justify-content-center">
                                <a href="{{ route('admin.souscripteur.edit',['id'=>$souscripteur->id]) }}">
                                    <button type="button" class="btn mb-3 btn-primary"><i class="ti-pencil f_s_14 mr-2"></i>Modifier infos souscripteur</button>
                                </a>
                            </div>
                            @endif
                                                   
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="email-sidebar white_box">
                    {{-- <div class="card mb-3 widget-chart border-0">
                        <div class="widget-subheading">Solde</div>
                        <div class="widget-numbers"><span>50 000 FCFA</span></div>
                    </div> --}}
                    <div class="card mb-3 widget-chart border-0">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg bg-primary"></div>
                            <i class="ti-money text-primary"></i>
                        </div>
                            @if ($souscripteur->versements->count() == 0)
                                <div class="widget-numbers"><span>0 FCFA</span></div>
                            @else
                                <div class="widget-numbers"><span style="font-size: 1.5rem !important;">{{ number_format($souscripteur->versements->where('parcouru',0)->sum('montant'), 0, '', ' ') }} FCFA</span></div>
                            @endif
                            
                            <div class="widget-subheading">Solde</div>
                    </div>
                    <a href="{{ route('admin.adherent.formulaire-print',['id'=>$souscripteur->id]) }}">
                        <button class="btn_1 w-100 mb-2 btn-lg email-gradient gradient-9-hover email__btn waves-effect"><i class="ti-eye"></i>Voir la fiche</button>
                    </a>
                    <ul class="text-left mt-2">
                        @if ($souscripteur->valide != 1)
                        <li><a href="{{ route('admin.adhesion.valider', ['id' => $souscripteur->id]) }}"><i class="ti-check"></i> <span> <span>Valider</span> </span> </a></li>
                        <li><a href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"><i class="ti-trash"></i> <span> <span>Rejeter</span>  </span> </a></li>
                        @endif

                        @if ($souscripteur->status == 0 && $souscripteur->valide == 1)
                            <li><a href="{{ route('admin.adherent.debloquer',['id' => $souscripteur->id]) }}"><i class="ti-unlock"></i> <span> <span>Activer compte</span>  </span> </a></li>
                            
                        @elseif ($souscripteur->status == 1 && $souscripteur->valide == 1)
                            <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="ti-money"></i> <span> <span>Ajouter versement</span>  </span> </a></li>
                            <li><a href="#" data-toggle="modal" data-target="#cotisationsModal"><i class="ti-new-window"></i> <span> <span>Cotisations impayées</span>  </span> </a></li>
                            <li><a href="#" data-toggle="modal" data-target="#transactionsModal"><i class="ti-new-window"></i> <span> <span>Historique des transactions</span>  </span> </a></li>
                            
                            <li><a href="{{ route('admin.adherent.bloquer', ['id' => $souscripteur->id]) }}"><i class="ti-lock"></i> <span> <span>Désactiver compte</span>  </span> </a></li>
                            <li><a href="{{ route('admin.assistance.create',['id' => $souscripteur->id]) }}"><i class="ti-save"></i> <span> <span>Ajouter une assistance</span> </span> </a></li>
                            {{-- @if ($souscripteur->assistances->count() != 0) --}}
                                <li><a href="{{ route('admin.assistance.souscripteur.index',['id' => $souscripteur->id]) }}"><i class="ti-list"></i> <span> <span>Liste des assistances</span> </span> </a></li>  
                            {{-- @endif --}}
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
                                <div class="col-9 mb_30">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaires</h4>
                                </div>
                                <div class="col-3 mb_15">
                                    @if ($souscripteur->add_benef_is_possible())
                                        <a href="{{ route('admin.beneficiaire.create',['sous'=>$souscripteur->id]) }}">
                                            <button type="button" class="btn mb-3 btn-primary fr"><i class="ti-plus f_s_14 mr-2"></i>Ajouter un bénéficiaire</button>
                                        </a>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table display nowrap table-striped table_diphita">
                                            <thead>
                                                
                                                <tr>
                                                    @if ($souscripteur->num_contrat)
                                                    <th scope="col">Numéro d'identification</th>
                                                    @endif
                                                    <th scope="col">Civilité</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Date naissance</th>
                                                    @if ($souscripteur->valide == 1 && $souscripteur->status == 1)
                                                        <th scope="col">statut</th>
                                                    @endif
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($benefs as $benef)
                                                <tr>
                                                    @if ($souscripteur->num_contrat)
                                                    <th scope="row"> <a href="{{ route('admin.adherent.formulaire-print',['id'=>$benef->id]) }}" class="question_content {{ $benef->cas == 1 ? 'text-danger' : 'text-success'  }}"> {{ $benef->num_adhesion }}</a></th>
                                                    @endif
                                                    
                                                    <td>
                                                        @if ($benef->civilite == 1)
                                                            Monsieur
                                                        @elseif($benef->civilite == 2)
                                                            Madame
                                                        @elseif($benef->civilite == 3)
                                                            Mademoiselle
                                                        @endif
                                                    </td>
                                                    <td>{{ $benef->nom }}</td>
                                                    <td>{{ $benef->pnom }}</td>
                                                    <td>{{ ucwords((new Carbon\Carbon($benef->date_naiss))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                                    @if ($souscripteur->valide == 1 && $souscripteur->status == 1)
                                                    <td><a href="#" class="status_btn">Actif</a></td>
                                                    @endif
                                                    
                                                    <td>
                                                        <div class="header_more_tool">
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                                  <i class="ti-more-alt"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="{{ route('admin.adherent.formulaire-print',['id'=>$benef->id]) }}"> <i class="ti-eye"></i> Voir fiche</a>
                                                                    <a class="dropdown-item" href="{{ route('admin.beneficiaire.edit',['benef'=>$benef->id]) }}"> <i class="ti-pencil"></i> Modifier bénéficiaire</a>
                                                                </div>
                                                              </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
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
                                <div class="col-9 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Ayants-droit</h4>
                                </div>
                                <div class="col-3 mb_15">
                                    @if ($souscripteur->add_ayant_droit_is_possible())
                                        <a href="{{ route('admin.ayantdroit.create',['sous'=>$souscripteur->id]) }}">
                                            <button type="button" class="btn mb-3 btn-primary fr"><i class="ti-plus f_s_14 mr-2"></i>Ajouter un ayant-droit</button>
                                        </a>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="QA_table mb_30">
                                        <!-- table-responsive -->
                                        <table class="table display nowrap table-striped table_diphita">
                                            <thead>
                                                
                                                <tr>
                                                    <th scope="col">Priorité</th>
                                                    <th scope="col">Civilité</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ayants as $ayant)
                                                <tr>
                                                    <td>{{ $ayant->priorite }}</td>
                                                    <td>
                                                        @if ($ayant->civilite == 1)
                                                            Monsieur
                                                        @elseif($ayant->civilite == 2)
                                                            Madame
                                                        @elseif($ayant->civilite == 3)
                                                            Mademoiselle
                                                        @endif
                                                    </td>
                                                    <td>{{ $ayant->nom }}</td>
                                                    <td>{{ $ayant->pnom }}</td>
                                                    <td>{{ $ayant->contact }}</td>
                                                    <td>
                                                        <div class="header_more_tool">
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                                  <i class="ti-more-alt"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        
                                                                    <a class="dropdown-item" href="{{ route('admin.ayantdroit.edit',['ayant'=>$ayant->id]) }}"> <i class="ti-pencil"></i>Modifier ayant-droit</a>
                                                                </div>
                                                              </div>
                                                        </div>

                                                    </td>
                                                    {{-- <td>
                                                        <div class="header_more_tool">
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                                  <i class="ti-more-alt"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="{{ route('admin.adhesion.show', ['id' => $ayant->id]) }}"> <i class="ti-eye"></i> Voir</a>
                                                                </div>
                                                              </div>
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

@section('modals')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Insérer un versement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.versement.store') }}" method="post" id="versement_form">
                @csrf
                @method('POST')
                <div class="form-row">
                    <div class="col-12 mt_15 mb_15">
                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Montant</h4>
                    </div>
        
                    <div class="form-group col-lg-12">
                        <label for="montant">Montant du versement <code class="highlighter-rouge">*</code></label>
                        <input type="text"  name="montant" class="form-control @error('montant') is-invalid @enderror" placeholder="Ex: 50000" required>
                        <input type="text" value="{{ $souscripteur->id }}" name="id_adherent" hidden required>
                        @error('montant')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" id="verser" class="btn btn-primary" data-dismiss="modal">Enregistrer</button>
        </div>
      </div>
    </div>
</div>

@include('admin.adherent._transactionsHistory')
@include('admin.adherent._cotisationsImpayees')
@endsection

@section('js')
    <script>
        $( "#verser" ).click(function() {
            $( "#versement_form" ).submit();
        });
    </script>
@endsection