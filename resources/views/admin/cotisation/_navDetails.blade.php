@php
    $identifiant = $cotisation->code_deces ?? $cotisation->annee_cotis;
@endphp

<ul class="nav nav-pills nav-justified mb-3" id="pills-{{ $identifiant }}-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-{{ $identifiant }}-success-tab" data-toggle="pill" href="#pills-{{ $identifiant }}-success" role="tab" aria-controls="pills-{{ $identifiant }}-success" aria-selected="true">Bilan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-{{ $identifiant }}-warning-tab" data-toggle="pill" href="#pills-{{ $identifiant }}-warning" role="tab" aria-controls="pills-{{ $identifiant }}-warning" aria-selected="false">A jour</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-{{ $identifiant }}-errors-tab" data-toggle="pill" href="#pills-{{ $identifiant }}-errors" role="tab" aria-controls="pills-{{ $identifiant }}-errors" aria-selected="false">Non à jour</a>
    </li>
</ul>
<div class="tab-content" style="overflow-x: auto;">
    <div class="tab-pane fade show active" id="pills-{{ $identifiant }}-success" role="tabpanel" aria-labelledby="success-tab">
        <div class="QA_table mb_30">
            <table id="datatable-buttons"
                class="table table-striped table-colored-bordered table-bordered-info table_diphita_ajax"
                data-url="{{ route('apiGetInfosCotisation') }}" data-type="post" data-fields='{"cotisation_id":{{ $cotisation->id }}}'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom et prénoms</th>
                        <th>Nbre Bénéf.</th>
                        <th>Date de paiement</th>
                        <th>Montant payé</th>
                        <th>Etat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                {{-- @foreach($cotisation->souscripteurs()->sortBy('nom') as $souscripteur)
                    <tr>
                        <td><a href="{{ route('admin.adhesion.show', $souscripteur) }}">{{ $souscripteur->num_adhesion }}</a></td>
                        <td>{{ $souscripteur->nom }} {{ $souscripteur->pnom }}</td>
                        <td>{{ $souscripteur->psCotisation($cotisation)->nbre_benef }}</td>
                        <td>{{ $cotisation->date_payement($souscripteur) ? date_format(date_create($cotisation->date_payement($souscripteur)), 'd/m/Y') : '-' }}</td>
                        <td>{{ $cotisation->reglements($souscripteur)->sum('montant') }}</td>
                        <td>{{ $souscripteur->isReglee($cotisation) ? "A Jour" : "Non A Jour" }}</td>
                        <td>
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Voir</a>
                                        @if(!$souscripteur->isReglee($cotisation))
                                            <a class="dropdown-item" data-toggle="modal" data-target="#reglement{{ $identifiant }}{{ $souscripteur->num_adhesion }}Modal" href="#"> <i class="ti-money"></i> Faire un reglement</a>
                                            <a class="dropdown-item btnReglementJS" data-toggle="modal" data-target="#reglementModal" data-souscripteur="{{ $souscripteur->num_adhesion }}" data-type="{{ $cotisation->type }}" data-cotisation="{{ $identifiant }}" href="javascript:void(0);"> <i class="ti-money"></i> Faire un reglement JS</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-{{ $identifiant }}-warning" role="tabpanel" aria-labelledby="warning-tab">
        <div class="QA_table mb_30">
            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita_ajax"
                data-url="{{ route('apiGetInfosCotisation') }}" data-type="post"
                data-fields='{"cotisation_id":{{ $cotisation->id }}, "filter":"Regle"}'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom et prénoms</th>
                        <th>Nbre Bénéf.</th>
                        <th>Date de paiement</th>
                        <th>Montant payé</th>
                        <th>Etat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                {{-- @foreach($cotisation->souscripteurs("Regle") as $souscripteur)
                    <tr>
                        <td><a href="{{ route('admin.adhesion.show', $souscripteur) }}">{{ $souscripteur->num_adhesion }}</a></td>
                        <td>{{ $souscripteur->nom }} {{ $souscripteur->pnom }}</td>
                        <td>{{ $souscripteur->psCotisation($cotisation)->nbre_benef }}</td>
                        <td>{{ $cotisation->date_payement($souscripteur) ? date_format(date_create($cotisation->date_payement($souscripteur)), 'd/m/Y') : '-' }}</td>
                        <td>{{ $cotisation->reglements($souscripteur)->sum('montant') }}</td>
                        <td>{{ $souscripteur->isReglee($cotisation) ? "A Jour" : "Non A Jour" }}</td>
                        <td>
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Voir</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-{{ $identifiant }}-errors" role="tabpanel" aria-labelledby="errors-tab">
        <div class="QA_table mb_30">
            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita_ajax"
                data-url="{{ route('apiGetInfosCotisation') }}" data-type="post"
                data-fields='{"cotisation_id":{{ $cotisation->id }}, "filter":"Non Regle"}'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom et prénoms</th>
                        <th>Nbre Bénéf.</th>
                        <th>Date de paiement</th>
                        <th>Montant payé</th>
                        <th>Etat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                {{-- @foreach($cotisation->souscripteurs("Non Regle") as $souscripteur)
                    <tr>
                        <td><a href="{{ route('admin.adhesion.show', $souscripteur) }}">{{ $souscripteur->num_adhesion }}</a></td>
                        <td>{{ $souscripteur->nom }} {{ $souscripteur->pnom }}</td>
                        <td>{{ $souscripteur->psCotisation($cotisation)->nbre_benef }}</td>
                        <td>{{ $cotisation->date_payement($souscripteur) ? date_format(date_create($cotisation->date_payement($souscripteur)), 'd/m/Y') : '-' }}</td>
                        <td>{{ $cotisation->reglements($souscripteur)->sum('montant') }}</td>
                        <td>{{ $souscripteur->isReglee($cotisation) ? "A Jour" : "Non A Jour" }}</td>
                        <td>
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Voir</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#reglement{{ $identifiant }}{{ $souscripteur->num_adhesion }}Modal" href="#"> <i class="ti-money"></i> Faire un reglement</a>
                                        <a class="dropdown-item btnReglementJS" data-toggle="modal" data-target="#reglementModal" data-souscripteur="{{ $souscripteur->num_adhesion }}" data-type="{{ $cotisation->type }}" data-cotisation="{{ $identifiant }}" href="javascript:void(0);"> <i class="ti-money"></i> Faire un reglement JS</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
