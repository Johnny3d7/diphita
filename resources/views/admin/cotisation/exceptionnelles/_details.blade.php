<div class="modal fade" id="details{{ $cotisation->code_deces }}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                            <img src="{{ asset($cotisation->image) }}" alt="" class="d-block mx-auto w-100 rounded">
                        </div>
                        <div class="col-lg-7 p-3">
                            <div class="d-block mx-auto">
                                <h3 class="text-primary mb-1"><small class="text-secondary">Date d'annonce : </small> {{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Date butoire : </small> {{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Montant par cas: </small> {{ $cotisation->montant }} francs CFA</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Nombre de Cas : </small> {{ $cotisation->cas()->count() }}</h3>
                                <h3 class="text-primary mb-1"><small class="text-secondary">Montant par bénéficiaire : </small> {{ $cotisation->montant * $cotisation->cas()->count() }} francs CFA</h3>
                            </div>
                        </div>
                        <div class="col-lg-2 p-3">
                            {{-- <button class="btn btn-info btn-block">Publier</button>
                            <button class="btn btn-success btn-block">Autre</button> --}}
                            <button class="btn btn-secondary btn-block"><i class="fa fa-cogs"></i> Configurer</button>
                        </div>
                    </div>

                    @include('admin.cotisation._navDetails')

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>