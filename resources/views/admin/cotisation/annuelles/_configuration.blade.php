<div class="modal fade" id="configuration{{ $cotisation->annee_cotis }}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Configuration du montant cotisation de l'année</small> {{ $cotisation->annee_cotis }}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post">
                        <label for="#montant{{ $cotisation->annee_cotis }}" class="control-label">Montant</label>
                        <input type="text" class="form-control" id="montant{{ $cotisation->annee_cotis }}" placeholder="Montant" value="{{ $cotisation->montant }}">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>