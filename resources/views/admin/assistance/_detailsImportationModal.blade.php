<div class="modal fade" id="importationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Résultat d'importation :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-success-tab" data-toggle="pill" href="#pills-success" role="tab" aria-controls="pills-success" aria-selected="true">Succès <div class="badge badge-info rounded-circle">{{ count($results["data"]) }}</div></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-warning-tab" data-toggle="pill" href="#pills-warning" role="tab" aria-controls="pills-warning" aria-selected="false">Avertissements <div class="badge badge-warning rounded-circle">{{ count($results["warns"]) }}</div></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-errors-tab" data-toggle="pill" href="#pills-errors" role="tab" aria-controls="pills-errors" aria-selected="false">Erreurs <div class="badge badge-danger rounded-circle">{{ count($results["errs"]) }}</div></a>
                        </li>
                    </ul>
                    <div class="tab-content" style="overflow-x: auto;">
                        <div class="tab-pane fade show active" id="pills-success" role="tabpanel" aria-labelledby="success-tab">
                            @if (count($results["data"]) > 0)
                                <table id="datatable-buttons"
                                    class="table table-striped table-colored-bordered table-bordered-info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date de Décès</th>
                                            <th>Lieu de Décès</th>
                                            <th>Date des Obsèques</th>
                                            <th>Date d'Assistance</th>
                                            <th>Moyen d'Assistance</th>
                                            <th>Souscripteur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results['data'] as $data)
                                        <tr>
                                            {{-- <td>{{ $data->role }}</td> --}}
                                            <td>{{ $data->beneficiaire->num_adhesion }}</td>
                                            <td>{{ date_format(date_create($data->date_deces), 'd/m/Y') }}</td>
                                            <td>{{ $data->lieu_deces }}</td>
                                            <td>{{ date_format(date_create($data->date_obseques), 'd/m/Y') }}</td>
                                            <td>{{ date_format(date_create($data->date_assistance), 'd/m/Y') }}</td>
                                            <td>{{ $data->moyen_assistance }}</td>
                                            <td>{{ $data->adherent->num_adhesion }}</td>
                                        </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            @else
                                <h6 class="text-center">Aucun importé</h6>
                            @endif
                            
                        </div>
                        <div class="tab-pane fade" id="pills-warning" role="tabpanel" aria-labelledby="warning-tab">
                            @if (count($results['warns']) > 0)
                                <ul class="list-group">
                                    @foreach($results['warns'] as $warn)
                                        <li class="list-group-item">
                                            {{ $warn['title'] }}
                                            <ul class="m-2 ml-3">
                                                @foreach($warn['msg'] as $wrn)
                                                    <li class="text-muted"><i class="fa fa-angle-right"></i> {{ $wrn }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach 
                                </ul>
                            @else
                                <h6 class="text-center">Aucun Avertissement</h6>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-errors" role="tabpanel" aria-labelledby="errors-tab">
                            @if (count($results['errs']) > 0)
                                <ul class="list-group">
                                    @foreach($results['errs'] as $err)
                                        <li class="list-group-item">
                                            {{ $err['title'] }}
                                            <ul class="m-2 ml-3">
                                                @foreach($err['msg'] as $error)
                                                    <li class="text-muted"><i class="fa fa-angle-right"></i> {{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach 
                                </ul>
                            @else
                                <h6 class="text-center">Aucune Erreur</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>