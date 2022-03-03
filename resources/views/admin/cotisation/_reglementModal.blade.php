@php
    $id = $cotisation->type == 'annuelle' ? $cotisation->annee_cotis : $cotisation->code_deces;
    $identifiant = $id . $souscripteur->num_adhesion;
@endphp
<div class="modal fade reglementModal" id="reglement{{ $identifiant }}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none; background-color:rgba(10, 10, 10, 0.5)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Reglement de cotisation </small> : {{ $souscripteur->nom_pnom() }}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="PaiementForm" action="{{ route('admin.adherent.cotisation.paiement') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_adherent" value="{{ $souscripteur->id }}">
                        <input type="hidden" name="id_cotisation" value="{{ $cotisation->id }}">
                        
                        @php
                            $aPayer = $souscripteur->psCotisation($cotisation)->montant();
                            $dejaPaye = $cotisation->reglements($souscripteur)->sum('montant');
                            $aRegler = $aPayer - $dejaPaye
                        @endphp

                        <input type="hidden" class="solde" value="{{ $souscripteur->solde() }}">
                        <input type="hidden" class="aRegler" value="{{ $aRegler }}">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 py-2">
                                    <label for="#montant{{ $identifiant }}" class="control-label">Montant à payer</label>
                                    <input type="text" class="form-control" id="montant{{ $identifiant }}" placeholder="Montant" value="{{ $aPayer }} FCFA" readonly disabled>
                                </div>
                                @if ($cotisation->type == "exceptionnelle")
                                    <div class="col-md-6 py-2">
                                        <label for="#montantPaye{{ $identifiant }}" class="control-label">Déjà Payé</label>
                                        <input type="text" class="form-control" id="montantPaye{{ $identifiant }}" placeholder="Montant" value="{{ $dejaPaye }} FCFA" readonly disabled>
                                    </div>
                                    <div class="col-md-6 py-2">
                                        <label for="#montantReste{{ $identifiant }}" class="control-label">Reste à Payer</label>
                                        <input type="text" class="form-control" id="montantReste{{ $identifiant }}" placeholder="Montant" value="{{ $aRegler }} FCFA" readonly disabled>
                                    </div>
                                @else
                                    <input type="hidden" name="montant" value="{{ $aPayer }}">
                                @endif
                                <div class="col-md-6 py-2">
                                    <label for="#montantRegle{{ $identifiant }}" class="control-label">Montant du règlement</label>
                                    <input type="number" step="50" max="{{ $aRegler }}" class="form-control montant" id="montantRegle{{ $identifiant }}" name="montant" placeholder="Montant" value="{{ $aRegler }}" {{ $cotisation->type == "annuelle" ? "readonly disabled" : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-8 offset-md-2 {{ $souscripteur->solde() < ($aRegler) ? 'd-none' : '' }}">
                            <button type="submit" id="reglement{{ $identifiant }}ModalSubmit" class="btn_2 btn-block" {{ $aRegler < 50 || $souscripteur->solde() < ($aRegler) ? 'disabled' : '' }}>Valider</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($aRegler < 50)
                <div id="reglement{{ $identifiant }}ModalFooter" class="modal-footer alert-warning text-center" style="justify-content: center; display: block;">
                    <span class="h5 pb-3"> &#129300; Montant Incorrect !</span>
                    <div class="row mt-2 h6">
                        <div class="container">
                            <span>Le montant à regler est incorrect !</span>
                        </div>
                    </div>
                </div>
            @else
                @if ($souscripteur->solde() < ($aRegler))
                    <div id="reglement{{ $identifiant }}ModalFooter" class="modal-footer alert-danger text-center" style="justify-content: center; display: block;">
                        <span class="h5 pb-3"> &#128577; Solde insuffisant !</span>
                        <div class="row mt-2 h6">
                            <div class="container">
                                <span>Solde Actuel : {{ number_format($souscripteur->solde(), 0, '', ' ') }} FCFA</span> <div class="py-1"></div>
                                <a href="#" class="pt-2 btn btn-sm btn-info" data-toggle="modal" data-target="#versementModal{{ $identifiant }}"><i class="fa fa-plus"></i> <span> <span>Versement</span>  </span> </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div id="reglement{{ $identifiant }}ModalFooter" class="modal-footer alert-success text-center" style="justify-content: center; display: block;">
                        <span class="h5 pb-3"> &#128578; Solde suffisant !</span>
                        <div class="row mt-2 h6">
                            <div class="col">
                                <span>Solde Actuel : {{ number_format($souscripteur->solde(), 0, '', ' ') }} FCFA</span>
                            </div>
                            <div class="col">
                                <span>Solde Résiduel : {{ number_format($souscripteur->solde() - ($aRegler), 0, '', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>