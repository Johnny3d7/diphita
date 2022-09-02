<div class="modal fade reglementModal" id="reglementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none; background-color:rgba(10, 10, 10, 0.5)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    {{-- span#nom_pnom --}}
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Reglement de cotisation </small> : <span id="num_adherent"></span></h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="text-center text-primary h5"><i class="fa fa-user pr-2"></i><span id="nom_pnom"></span></div>
                    <form class="PaiementForm" action="{{ route('admin.adherent.cotisation.paiement') }}" method="post">
                        @csrf
                        {{-- input#id_adherent --}}
                        <input type="hidden" id="id_adherent" name="id_adherent" value="">
                        {{-- input#id_cotisation --}}
                        <input type="hidden" id="id_cotisation" name="id_cotisation" value="">

                        {{-- @php
                            $aPayer = $souscripteur->psCotisation($cotisation)->montant();
                            $dejaPaye = $cotisation->reglements($souscripteur)->sum('montant');
                            $aRegler = $aPayer - $dejaPaye
                        @endphp --}}

                        {{-- input.solde getSouscripteurSolde() --}}
                        <input type="hidden" class="solde" value="">
                        {{-- input.aRegler = $souscripteur->psCotisation($cotisation)->montant() - $cotisation->reglements($souscripteur)->sum('montant') --}}
                        <input type="hidden" class="aRegler" value="">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 py-2">
                                    <label for="#montant" class="control-label">Montant à payer</label>
                                    {{-- input#montant $souscripteur->psCotisation($cotisation)->montant() --}}
                                    <input type="text" class="form-control" id="montant" placeholder="Montant" value="" readonly disabled>
                                </div>

                                {{-- if(exceptionnelle) --}}
                                <div class="col-md-6 py-2">
                                    <label for="#montantPaye" class="control-label">Déjà Payé</label>
                                    {{-- input#montantPaye $cotisation->reglements($souscripteur)->sum('montant') --}}
                                    <input type="text" class="form-control" id="montantPaye" placeholder="Montant" value="" readonly disabled>
                                </div>
                                <div class="col-md-6 py-2">
                                    <label for="#montantReste" class="control-label">Reste à Payer</label>
                                    {{-- input.#montantReste = $souscripteur->psCotisation($cotisation)->montant() - $cotisation->reglements($souscripteur)->sum('montant') --}}
                                    <input type="text" class="form-control" id="montantReste" placeholder="Montant" value="" readonly disabled>
                                </div>
                                {{-- if(annuelle) --}}
                                {{-- input#aPayer $souscripteur->psCotisation($cotisation)->montant() --}}
                                <input type="hidden" id="aPayer" name="montant" value="">
                                {{-- EndIf --}}

                                <div class="col-md-6 py-2">
                                    <label for="#montantRegle" class="control-label">Montant du règlement</label>
                                    {{-- input#montantRegle [max:aRegler, value:aRegler, @if("annuelle") disable & readonly ] --}}
                                    <input type="number" step="50" max="" class="form-control montant" id="montantRegle" name="montant" placeholder="Montant" value="">
                                </div>
                            </div>
                        </div>
                        {{-- div#submitPaiementForm [@if($souscripteur->solde() < ($aRegler)) '.d-none'] --}}
                        <div id="submitPaiementForm" class="form-group col-md-8 offset-md-2">
                            {{-- btn#reglementModalSubmit [@if($souscripteur->solde() < ($aRegler)) || $aRegler < 50 '.disabled'] --}}
                            <button type="submit" id="reglementModalSubmit" class="btn_2 btn-block">Valider</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- #reglementModalFooter [@if(aRegler < 50) '.alert-warning']  [@if($souscripteur->solde() < ($aRegler)) '.alert-danger'] [@else '.alert-success'] --}}
            <div id="reglementModalFooter" class="modal-footer alert-warning text-center d-none" style="justify-content: center; display: block;">
                <span class="title h5 pb-3"> &#129300; Montant Incorrect !</span> {{-- .title  &#129300; Montant Incorrect !  //  &#128577; Solde insuffisant !  //  &#128578; Solde suffisant ! --}}
                <div class="row mt-2 h6">
                    {{-- aRegler < 50 --}}
                    <div class="container">
                        <span>Le montant à regler est incorrect !</span>
                    </div>

                    {{-- $souscripteur->solde() < ($aRegler) --}}
                    <div class="container">
                        <span>Solde Actuel : {{-- number_format($souscripteur->solde(),0,'','') --}} FCFA</span> <div class="py-1"></div>
                        <a href="#" class="pt-2 btn btn-sm btn-info" data-toggle="modal" data-target="#versementModal"><i class="fa fa-plus"></i> <span> <span>Versement</span>  </span> </a>
                    </div>

                    {{-- else --}}
                    <div class="col">
                        <span>Solde Actuel : {{-- number_format($souscripteur->solde(),0,'','') --}} FCFA</span>
                    </div>
                    <div class="col">
                        <span>Solde Résiduel : {{-- number_format($souscripteur->solde()-($aRegler),0,'','') --}} FCFA</span>
                    </div>
                </div>
            </div>

            {{-- @if ($aRegler < 50)
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
            @endif --}}
        </div>
    </div>
</div>
