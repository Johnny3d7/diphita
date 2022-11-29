<div class="modal fade previewModal" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none; background-color:rgba(10, 10, 10, 0.5)" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    {{-- span#nom_pnom --}}
                    <h3 class="text-center" id="exampleModalLongTitle"><small>Aperçu de message</small> : <span id="num_adherent"></span></h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="text-center text-primary h5">
                        <i class="fa fa-user pr-2"></i> <span id="nom_pnom"></span>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 border rounded p-0" style="height: 50vh; overflow-y:auto">
                            <table id="tableCotisationsDues" class="table table-striped">
                                <thead class="thead bg-danger" style="position: sticky; top: 0; z-index: 1;">
                                    <th>#</th>
                                    <th>Identifiant</th>
                                    <th>Type</th>
                                    <th>Nbre Benef</th>
                                    <th>Montant</th>
                                </thead>
                                <tbody class="tbody">
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <i class="fa fa-spinner fa-spin fa-3x"></i>
                                            <h6 class="pt-3">Chargement</h6>
                                            <p>Veuillez patienter pendant que nous chargeons les cotisations</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xl-4">
                            <h6 class="text-center">Message personnalisé</h6>
                            <div class="container-fluid rounded border p-2" id="previewPersonnalMessage">
                                <div class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                                    <h6 class=" pt-3">Chargement</h6>
                                    <p class="">Veuillez patienter pendant que nous chargeons le message personnalisé</p>
                                </div>
                                {{-- Ceci est un message test qui comporte les informations concernant chaque souscripteur.
    Chacun pour sa part recevra en particulier le montant qu'il doit payer et des détails seront disponibles.
    Certaines variables sont disponibles.

    Comme %Nom% %Prénoms% %Montant% --}}
                            </div>
                            <center>
                                {{-- <button type="button" class="" aria-label="Close">Fermer</button> --}}
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container-fluid">
                            <button class="btn btn-light float-right" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
