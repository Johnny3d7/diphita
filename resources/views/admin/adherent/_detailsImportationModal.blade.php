<div class="modal fade" id="importation{{ $key }}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Historique de transactions : {{ $key }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab-{{ $key }}" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-success-{{ $key }}-tab" data-toggle="pill" href="#pills-success-{{ $key }}" role="tab" aria-controls="pills-success-{{ $key }}" aria-selected="true">Succès <div class="badge badge-info rounded-circle">{{ count($results["data"]) }}</div></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-warning-{{ $key }}-tab" data-toggle="pill" href="#pills-warning-{{ $key }}" role="tab" aria-controls="pills-warning-{{ $key }}" aria-selected="false">Avertissements <div class="badge badge-warning rounded-circle">{{ count($results["warns"]) }}</div></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-errors-{{ $key }}-tab" data-toggle="pill" href="#pills-errors-{{ $key }}" role="tab" aria-controls="pills-errors-{{ $key }}" aria-selected="false">Erreurs <div class="badge badge-danger rounded-circle">{{ count($results["errs"]) }}</div></a>
                        </li>
                    </ul>
                    <div class="tab-content" style="overflow-x: auto;">
                        <div class="tab-pane fade show active" id="pills-success-{{ $key }}" role="tabpanel" aria-labelledby="success-tab">
                            @if (count($results["data"]) > 0)
                                <table id="datatable-buttons"
                                    class="table table-striped table-colored-bordered table-bordered-info">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Civilite</th>
                                            <th>Nom</th>
                                            <th>Prénoms</th>
                                            <th>Email</th>
                                            <th>CNI</th>
                                            <th>Date Naissance</th>
                                            <th>Lieu Naissannce</th>
                                            <th>Lieu Habitation</th>
                                            <th>Contact</th>
                                            <th>Cas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results['data'] as $data)
                                        <tr>
                                            {{-- <td>{{ $data->role }}</td> --}}
                                            <td>{{ $data->num_adhesion }}</td>
                                            <td>{{ $data->civilite }}</td>
                                            <td>{{ $data->nom }}</td>
                                            <td>{{ $data->pnom }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->num_cni }}</td>
                                            <td>{{ date_format(date_create($data->date_naiss), 'd/m/Y') }}</td>
                                            <td>{{ $data->lieu_naiss }}</td>
                                            <td>{{ $data->lieu_hab }}</td>
                                            <td>{{ $data->contact }}</td>
                                            <td>{{ $data->cas ? "Oui" : "Non" }}</td>
                                        </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            @else
                                <h6 class="text-center">Aucun {{ $key }} importé</h6>
                            @endif
                            
                        </div>
                        <div class="tab-pane fade" id="pills-warning-{{ $key }}" role="tabpanel" aria-labelledby="warning-tab">
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
                        <div class="tab-pane fade" id="pills-errors-{{ $key }}" role="tabpanel" aria-labelledby="errors-tab">
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