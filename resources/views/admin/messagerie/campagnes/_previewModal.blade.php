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
                    <div class="text-center font-weight-bold text-uppercase h4 p-2">
                        <u>Point des cotisations dues</u>
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
                            <h5 class="text-center font-weight-bold text-uppercase">
                                <u>Informations générales</u>
                            </h5>
                            <h5>
                                <em>Nom :</em>
                                <span class="text-info" id="nom_pnom"></span>
                            </h5>
                            <h5>
                                <em>Annuel :</em>
                                <span class="text-info" id="montantAnnuel">%Montant Annuel%</span>
                            </h5>
                            <h5>
                                <em>Exceptionnel :</em>
                                <span class="text-info" id="montantExceptionnel">%Montant Exceptionnel%</span>
                            </h5>

                            <hr class="bg-danger w-25 my-4" style="border-width: 2px">
                            <h6 class="text-center font-weight-bold text-uppercase" style="color: #fd517d;">Message personnalisé</h6>
                            <div class="container-fluid rounded border p-2" id="previewPersonnalMessage" style="border-color: #fd517d !important;">
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
                    <div class="row mt-2">
                        <div class="container-fluid d-flex justify-content-end">
                            <a id="externalLink" href="#" class="btn btn-primary mr-2"><i class="fa fa-external-link-alt"></i> Consulter le souscripteur</a>
                            <button class="btn btn-secondary float-right" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
