<div class="modal fade versementModal" id="versementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Insérer un versement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.versement.store') }}" method="post" class="versement_form">
                @csrf
                @method('POST')
                <div class="form-row">
                    <div class="col-12 mt_15 mb_15">
                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Montant</h4>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="montant">Montant du versement <code class="highlighter-rouge">*</code></label>
                        <input type="text" name="montant" class="form-control versement @error('montant') is-invalid @enderror" placeholder="Ex: 50000" required>
                        <input type="text" id="id_souscripteur" class="id_souscripteur" value="" name="id_adherent" hidden required>
                        <div class="alert alert-danger text-center d-none mt-3"><span class="error"></span></div>
                        @error('montant')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                        <button type="submit" class="verser btn btn-primary">Enregistrer</button>
                    </div> --}}
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" id="verser" class="verser btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </div>
</div>
