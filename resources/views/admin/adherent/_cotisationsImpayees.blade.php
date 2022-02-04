<div class="modal fade" id="cotisationsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Cotisations impayées</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab-cotisation" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-success-cotisation-tab" data-toggle="pill" href="#pills-success-cotisation" role="tab" aria-controls="pills-success-cotisation" aria-selected="true">Toutes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-warning-cotisation-tab" data-toggle="pill" href="#pills-warning-cotisation" role="tab" aria-controls="pills-warning-cotisation" aria-selected="false">Exceptionnelles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-errors-cotisation-tab" data-toggle="pill" href="#pills-errors-cotisation" role="tab" aria-controls="pills-errors-cotisation" aria-selected="false">Annuelles</a>
                        </li>
                    </ul>

                    <div class="tab-content" style="overflow-x: auto;">
                        <div class="tab-pane fade show active" id="pills-success-cotisation" role="tabpanel" aria-labelledby="success-tab">
                            @if (count($souscripteur->cotisations(null, false)) > 0)
                                @include('admin.adherent._payementLine', ['cotisations' => $souscripteur->cotisations()])
                            @else
                                <h6 class="text-center">Aucune cotisation</h6>
                            @endif
                            
                        </div>
                        <div class="tab-pane fade" id="pills-warning-cotisation" role="tabpanel" aria-labelledby="warning-tab">
                            @if (count($souscripteur->cotisations('exceptionnelle', false)) > 0)
                                @include('admin.adherent._payementLine', ['cotisations' => $souscripteur->cotisations('exceptionnelle')])
                            @else
                                <h6 class="text-center">Aucune cotisation exceptionnelle</h6>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-errors-cotisation" role="tabpanel" aria-labelledby="errors-tab">
                            @if (count($souscripteur->cotisations('annuelle', false)) > 0)
                                @include('admin.adherent._payementLine', ['cotisations' => $souscripteur->cotisations('annuelle')])
                            @else
                                <h6 class="text-center">Aucune cotisation annuelle</h6>
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