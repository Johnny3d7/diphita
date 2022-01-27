<div class="modal fade" id="details{{ $cotisation->code_deces }}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Détails de cotisation : </small> {{ $cotisation->code_deces }}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 p-3">
                            <img src="{{ asset('img/Femme stressé.webp') }}" alt="" class="d-block mx-auto w-100 rounded">
                        </div>
                        <div class="col-lg-7 p-3">
                            <div class="d-block mx-auto">
                                @php $ref = rand(1,10)*500; $casNbre = $nbreCas[$cotisation->code_deces]; $base = $casNbre*$ref @endphp
                                <h3 class="text-primary mb-1"><small class="text-secondary">Date d'annonce : </small> {{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Date butoire : </small> {{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Montant reférentiel : </small> {{ $ref }} francs CFA</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Nombre de Cas : </small> {{ $casNbre }}</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Montant de base : </small> {{ $base }} francs CFA</h3>
                            </div>
                        </div>
                        <div class="col-lg-2 p-3">
                            <button class="btn btn-info btn-block">Publier</button>
                            <button class="btn btn-success btn-block">Autre</button>
                        </div>
                    </div>

                    <ul class="nav nav-pills nav-justified mb-3" id="pills-{{ $cotisation->code_deces }}-tab" role="tablist">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" id="pills-{{ $cotisation->code_deces }}-success-tab" data-toggle="pill" href="#pills-{{ $cotisation->code_deces }}-success" role="tab" aria-controls="pills-{{ $cotisation->code_deces }}-success" aria-selected="true">Cas</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="pills-{{ $cotisation->code_deces }}-warning-tab" data-toggle="pill" href="#pills-{{ $cotisation->code_deces }}-warning" role="tab" aria-controls="pills-{{ $cotisation->code_deces }}-warning" aria-selected="false">Avertissements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-{{ $cotisation->code_deces }}-errors-tab" data-toggle="pill" href="#pills-{{ $cotisation->code_deces }}-errors" role="tab" aria-controls="pills-{{ $cotisation->code_deces }}-errors" aria-selected="false">Erreurs</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" style="overflow-x: auto;">
                        <div class="tab-pane fade show active" id="pills-{{ $cotisation->code_deces }}-success" role="tabpanel" aria-labelledby="success-tab">
                            @if (count(App\Models\Assistance::all()) > 0)
                                <table id="datatable-buttons"
                                    class="table table-striped table-colored-bordered table-bordered-info table_diphita">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date de Décès</th>
                                            <th>Date des Obsèques</th>
                                            <th>Date d'Assistance</th>
                                            <th>Souscripteur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(App\Models\Assistance::all() as $data)
                                        <tr>
                                            {{-- <td>{{ $data->role }}</td> --}}
                                            <td><a href="{{ route('admin.adhesion.show', $data->beneficiaire) }}">{{ $data->beneficiaire->num_adhesion }}</a></td>
                                            <td>{{ date_format(date_create($data->date_deces), 'd/m/Y') }}</td>
                                            <td>{{ date_format(date_create($data->date_obseques), 'd/m/Y') }}</td>
                                            <td>{{ date_format(date_create($data->date_assistance), 'd/m/Y') }}</td>
                                            <td><a href="{{ route('admin.adhesion.show', $data->adherent) }}">{{ $data->adherent->num_adhesion }}</a></td>
                                        </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            @else
                                <h6 class="text-center">Aucun Cas</h6>
                            @endif
                        </div>
                        {{-- <div class="tab-pane fade bg-danger p-5" id="pills-{{ $cotisation->code_deces }}-warning" role="tabpanel" aria-labelledby="warning-tab">

                        </div>
                        <div class="tab-pane fade bg-secondary p-5" id="pills-{{ $cotisation->code_deces }}-errors" role="tabpanel" aria-labelledby="errors-tab">

                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>