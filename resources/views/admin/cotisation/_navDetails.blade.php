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
                class="table table-striped table-colored-bordered table-bordered-info table_diphita">
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
                @foreach($cotisation->souscripteurs() as $souscripteur)
                    <tr>
                        {{-- <td>{{ $data->role }}</td> --}}
                        <td><a href="{{ route('admin.adhesion.show', $souscripteur) }}">{{ $souscripteur->num_adhesion }}</a></td>
                        <td>{{ $souscripteur->nom }} {{ $souscripteur->pnom }}</td>
                        <td>{{ $souscripteur->psCotisation($cotisation)->nbre_benef + 1 }}</td>
                        <td>{{ date_format(date_create($cotisation->date_assistance), 'd/m/Y') }}</td>
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
                                        <a class="dropdown-item" data-toggle="modal" data-target="#reglement{{ $identifiant }}Modal"> <i class="ti-money"></i> Faire un reglement</a>
                                        {{-- <a class="dropdown-item" href="{{ route('admin.adhesion.valider', ['id' => $souscripteur->id]) }}"> <i class="fas fa-edit"></i> Valider</a>
                                        
                                    <a class="dropdown-item" href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"> <i class="ti-trash"></i> Rejeter</a> --}}
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
    <div class="tab-pane fade" id="pills-{{ $identifiant }}-warning" role="tabpanel" aria-labelledby="warning-tab">
        <div class="QA_table mb_30">
            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita">
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
                @foreach($cotisation->souscripteurs("Regle") as $souscripteur)
                    <tr>
                        {{-- <td>{{ $data->role }}</td> --}}
                        <td><a href="{{ route('admin.adhesion.show', $souscripteur) }}">{{ $souscripteur->num_adhesion }}</a></td>
                        <td>{{ $souscripteur->nom }} {{ $souscripteur->pnom }}</td>
                        <td>{{ $souscripteur->psCotisation($cotisation)->nbre_benef }}</td>
                        <td>{{ date_format(date_create($cotisation->date_assistance), 'd/m/Y') }}</td>
                        <td>{{ 0 }}</td>
                        <td>{{ $souscripteur->isReglee($cotisation) ? "A Jour" : "Non A Jour" }}</td>
                        <td>
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Voir</a>
                                        <a class="dropdown-item" href="#"> <i class="ti-money"></i> Faire un reglement</a>
                                        {{-- <a class="dropdown-item" href="{{ route('admin.adhesion.valider', ['id' => $souscripteur->id]) }}"> <i class="fas fa-edit"></i> Valider</a>
                                        
                                    <a class="dropdown-item" href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"> <i class="ti-trash"></i> Rejeter</a> --}}
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
    <div class="tab-pane fade" id="pills-{{ $identifiant }}-errors" role="tabpanel" aria-labelledby="errors-tab">
        <div class="QA_table mb_30">
            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita">
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
                @foreach($cotisation->souscripteurs("Non Regle") as $souscripteur)
                    <tr>
                        {{-- <td>{{ $data->role }}</td> --}}
                        <td><a href="{{ route('admin.adhesion.show', $souscripteur) }}">{{ $souscripteur->num_adhesion }}</a></td>
                        <td>{{ $souscripteur->nom }} {{ $souscripteur->pnom }}</td>
                        <td>{{ $souscripteur->psCotisation($cotisation)->nbre_benef }}</td>
                        <td>{{ date_format(date_create($cotisation->date_assistance), 'd/m/Y') }}</td>
                        <td>{{ 0 }}</td>
                        <td>{{ $souscripteur->isReglee($cotisation) ? "A Jour" : "Non A Jour" }}</td>
                        <td>
                            <div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Voir</a>
                                        <a class="dropdown-item" href="#"> <i class="ti-money"></i> Faire un reglement</a>
                                        {{-- <a class="dropdown-item" href="{{ route('admin.adhesion.valider', ['id' => $souscripteur->id]) }}"> <i class="fas fa-edit"></i> Valider</a>
                                        
                                    <a class="dropdown-item" href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"> <i class="ti-trash"></i> Rejeter</a> --}}
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
