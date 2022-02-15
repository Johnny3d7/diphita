@php
    $identifiant = ($cotisation->type == 'annuelle' ? $cotisation->annee_cotis : $cotisation->code_deces) . $souscripteur->num_adhesion;
@endphp
<div class="modal fade" id="reglement{{ $identifiant }}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none; background-color:rgba(10, 10, 10, 0.5)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Reglement de cotisation</small></h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('admin.adherent.cotisation.paiement') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_adherent" value="{{ $souscripteur->id }}">
                        <input type="hidden" name="id_cotisation" value="{{ $cotisation->id }}">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 py-2">
                                    <label for="#montant{{ $identifiant }}" class="control-label">Montant à payer</label>
                                    <input type="text" class="form-control" id="montant{{ $identifiant }}" placeholder="Montant" value="{{ $souscripteur->psCotisation($cotisation)->montant() }} FCFA" readonly disabled>
                                </div>
                                @if ($cotisation->type == "exceptionnelle")
                                    <div class="col-md-6 py-2">
                                        <label for="#montantPaye{{ $identifiant }}" class="control-label">Déjà Payé</label>
                                        <input type="text" class="form-control" id="montantPaye{{ $identifiant }}" placeholder="Montant" value="{{ $cotisation->reglements($souscripteur)->sum('montant') }} FCFA" readonly disabled>
                                    </div>
                                    <div class="col-md-6 py-2">
                                        <label for="#montantReste{{ $identifiant }}" class="control-label">Reste à Payer</label>
                                        <input type="text" class="form-control" id="montantReste{{ $identifiant }}" placeholder="Montant" value="{{ $souscripteur->psCotisation($cotisation)->montant() - $cotisation->reglements($souscripteur)->sum('montant') }} FCFA" readonly disabled>
                                    </div>
                                @else
                                    <input type="hidden" name="montant" value="{{ $souscripteur->psCotisation($cotisation)->montant() }}">
                                @endif
                                <div class="col-md-6 py-2">
                                    <label for="#montantRegle{{ $identifiant }}" class="control-label">Montant du règlement</label>
                                    <input type="number" step="50" max="{{ $souscripteur->psCotisation($cotisation)->montant() - $cotisation->reglements($souscripteur)->sum('montant') }}" class="form-control" id="montantRegle{{ $identifiant }}" name="montant" placeholder="Montant" value="{{ $souscripteur->psCotisation($cotisation)->montant() - $cotisation->reglements($souscripteur)->sum('montant') }}" {{ $cotisation->type == "annuelle" ? "readonly disabled" : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-8 offset-md-2">
                            <button type="submit" class="btn_2 btn-block">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button> --}}
            </div>
        </div>
    </div>
</div>