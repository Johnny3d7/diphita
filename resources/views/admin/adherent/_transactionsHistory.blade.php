<div class="modal fade" id="transactionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Historique des transactions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab-transaction" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-success-transaction-tab" data-toggle="pill" href="#pills-success-transaction" role="tab" aria-controls="pills-success-transaction" aria-selected="true">Toutes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-warning-transaction-tab" data-toggle="pill" href="#pills-warning-transaction" role="tab" aria-controls="pills-warning-transaction" aria-selected="false">Versements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-errors-transaction-tab" data-toggle="pill" href="#pills-errors-transaction" role="tab" aria-controls="pills-errors-transaction" aria-selected="false">Cotisations</a>
                        </li>
                    </ul>

                    <div class="tab-content" style="overflow-x: auto;">
                        <div class="tab-pane fade show active" id="pills-success-transaction" role="tabpanel" aria-labelledby="success-tab">
                            @if (count($souscripteur->transactions()) > 0)
                                <ul class="list-group">
                                    @foreach($souscripteur->transactions()->sortByDesc('created_at') as $transaction)
                                        <li class="list-group-item">
                                            {{ ucwords((new Carbon\Carbon($transaction->created_at))->locale('fr')->isoFormat('DD MMM YYYY à HH:mm'))  }} : {{ $transaction->type ? $transaction->montant() : $transaction->montant }} francs
                                        </li>
                                    @endforeach 
                                </ul>
                            @else
                                <h6 class="text-center">Aucune transaction</h6>
                            @endif
                            
                        </div>
                        <div class="tab-pane fade" id="pills-warning-transaction" role="tabpanel" aria-labelledby="warning-tab">
                            @if (count($souscripteur->versements) > 0)
                                <ul class="list-group">
                                    @foreach($souscripteur->versements->sortByDesc('created_at') as $versement)
                                        <li class="list-group-item">
                                            {{ ucwords((new Carbon\Carbon($versement->created_at))->locale('fr')->isoFormat('DD MMM YYYY à HH:mm'))  }} : {{ $versement->montant }} francs
                                        </li>
                                    @endforeach 
                                </ul>
                            @else
                                <h6 class="text-center">Aucun versement</h6>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-errors-transaction" role="tabpanel" aria-labelledby="errors-tab">
                            @if (count($souscripteur->cotisations()) > 0)
                                <ul class="list-group">
                                    @foreach($souscripteur->cotisations()->sortByDesc('created_at') as $cotisation)
                                        <li class="list-group-item">
                                            {{ $cotisation->code_deces ?? $cotisation->annee_cotis  }} : {{ $cotisation->montant() }} francs
                                        </li>
                                    @endforeach 
                                </ul>
                            @else
                                <h6 class="text-center">Aucune cotisation</h6>
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