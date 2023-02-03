<div class="modal fade progressModal" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none; background-color:rgba(10, 10, 10, 0.5)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    {{-- span#nom_pnom --}}
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Envoi de message</small></h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="text-center">
                        {{-- <div class="loader--default colord_bg_3"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> --}}
                        <div class="loader--ellipsis colord_bg_2">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <h6 class=" pt-3">Chargement</h6>
                        <p class="">Veuillez patienter pendant que nous chargeons le message personnalisé</p>

                        <h6>
                            <span id="progress_index">0</span> sur <span id="progress_total">0</span>
                        </h6>
                        <h6 id="progress_num_adherent"></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
