@extends('admin.main')

@section('css')

@endsection

@section('title')
    Nouvelle campagne d'avertissement
@endsection

@section('subtitle')
    Nouvelle campagne d'avertissement
@endsection

@section('content')
    <form action="#" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="white_card mb_30 card_height_100">
                    <div class="white_card_header">
                        <div class="row align-items-center justify-content-between flex-wrap">
                            <div class="col-lg-6">
                                <div class="main-title">
                                    <h3 class="m-0">Liste des souscripteurs à avertir</h3>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" id="textToSearch" class="form-control" placeholder="Rechercher">
                            </div>
                            <div class="col-lg-2 text-right d-flex justify-content-end">
                                <a href="javascript:void(0);" id="reloadBtn" class="btn btn-outline-secondary"><i class="ti ti-reload"></i> <i class="fa fa-spinner fa-spin d-none"></i> Actualiser</a>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="container-fluid border rounded p-0" style="height: 50vh; overflow-y:auto">
                            {{-- <div class="bg-danger p-5">
                                <div class="bg-warning p-5 m-5">
                                    <div class="bg-primary p-5 m-5"></div>
                                    <div class="bg-success p-5 m-5"></div>
                                </div>
                                <div class="bg-warning p-5 m-5">
                                    <div class="bg-info p-5 m-5"></div>
                                </div>
                            </div> --}}

                            <table class="table tableSouscripteur">
                                <thead class="thead bg-danger" style="position: sticky; top: 0; z-index: 1;">
                                    <th style="max-width: 1rem;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll"></label>
                                        </div>
                                    </th>
                                    <th>Numero</th>
                                    <th>Nom & prénoms</th>
                                    <th>Action</th>
                                </thead>
                                <tbody class="tbody" id="tableBody">
                                    {{-- <tr>
                                        <td colspan="4" class="text-center">
                                            <i class="fa fa-spinner fa-spin fa-3x"></i>
                                            <h6 class="pt-3">Chargement</h6>
                                            <p>Veuillez patienter pendant que nous chargeons les informations</p>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>

                        <h6 class="pt-2"><span id="nbreSelected">%nbre%</span> sélectionnés sur <span id="totalToSelect">%total%</span></h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="white_card mb_30 card_height_100">
                    <div class="white_card_header">
                        <div class="row align-items-center justify-content-between flex-wrap">
                            <div class="col-lg-8">
                                <div class="main-title">
                                    <h3 class="m-0">Message à envoyer</h3>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right d-flex justify-content-end">
                                {{-- <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-exclamation-triangle"></i> Nouvelle campagne d'avertissement</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <button class="btnVarMessage mb-1 btn btn-sm btn-info" data-value="%Nom%" type="button">Nom</button>
                        <button class="btnVarMessage mb-1 btn btn-sm btn-info" data-value="%Prénoms%" type="button">Prénoms</button>
                        <button class="btnVarMessage mb-1 btn btn-sm btn-info" data-value="%MontantTotal%" type="button">Montant Total</button>
                        <button class="btnVarMessage mb-1 btn btn-sm btn-info" data-value="%MontantCotisationAnnuelle%" type="button">Montant Annuel</button>
                        <button class="btnVarMessage mb-1 btn btn-sm btn-info" data-value="%MontantCotisationExceptionnelle%" type="button">Montant Exceptionnel</button>
                        <textarea id="message_sample" class="form-control" name="message_sample" cols="30" rows="15">
Ceci est un message test qui comporte les informations concernant chaque souscripteur.
Chacun pour sa part recevra en particulier le montant qu'il doit payer et des détails seront disponibles.
Certaines variables sont disponibles.

Comme %Nom% %Prénoms% %MontantTotal% FCFA</textarea>
                        <center>
                            <button id="sendMessage" type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#progressModal">
                                <i class="fa fa-paper-plane"></i> <span>Envoyer</span>
                                <div class="loader loader--ring Ring_4 d-none" style="width: 1.5rem; height: 1.5rem;">
                                    <div style="width: 1.5rem; height: 1.5rem; border-width: 2px;"></div>
                                    <div style="width: 1.5rem; height: 1.5rem; border-width: 2px;"></div>
                                    <div style="width: 1.5rem; height: 1.5rem; border-width: 2px;"></div>
                                    <div style="width: 1.5rem; height: 1.5rem; border-width: 2px;"></div>
                                </div>
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('modals')
    @include('admin.messagerie.campagnes._previewModal')
    @include('admin.messagerie.campagnes._progressModal')
@endsection

@section('js')
    <script>
        let processing = false;

        function sendAjax({url, type = 'POST', data = {}, success = function(res){}, error = function(e){console.log(e)}, options = {}, api = false}){
            settings = { url: url, type: type, data: data, success: success, error: error}
            if(api === true) $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({ ...settings, ...options });
        }

        function selectPuprose() {
            $('#selectAll').change(function(){
                $this = $(this);
                console.log($this);
                console.log($this.is(':checked'))
                $('.selectSous').each(function(){
                    $(this).prop('checked', $this.is(':checked')); $(this).change();
                })
            })

            $('.selectSous').change(function(){
                // Désélectionner si un seul est désélectionné
                if(!$(this).is(':checked')) $('#selectAll').prop('checked', false);

                // Sélectionner si tous sont sélectionnés
                $true = true; $nbre = 0;
                $('.selectSous').each(function() {
                    if($(this).is(':checked')) { $nbre++ } else { $true = false; }
                })
                if($true) $('#selectAll').prop('checked', true);

                $('#nbreSelected').html($nbre);
            })
        }

        function callCotisationsDues(souscripteur) {
            $('#tableCotisationsDues').find('.tbody').html('<tr><td colspan="5" class="text-center"><div class="loader--default colord_bg_4"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><h6 class="pt-3">Chargement</h6><p>Veuillez patienter pendant que nous chargeons les informations</p></td></tr>');
            var url = "{{ route('apiGetCotisationsDues') }}";
            var data = {
                'num_adhesion':souscripteur,
                'id_user':"{{ Auth::user()->id }}"
            };
            var success = function(res){
                index = 0;
                $('#tableCotisationsDues').find('.tbody').html('');
                res.data.forEach(cotisation => {
                    index++;
                    $('#tableCotisationsDues').find('.tbody').append(`
                        <tr>
                            <td>
                                ${index}
                            </td>
                            <td>
                                ${cotisation.identifiant}
                            </td>
                            <td>
                                ${cotisation.type}
                            </td>
                            <td>
                                ${cotisation.nbre_benef}
                            </td>
                            <td>
                                ${cotisation.montant}
                            </td>
                        </tr>
                    `);
                });

                $('#montantAnnuel').html(res.total.annuel + " F CFA");
                $('#montantExceptionnel').html(res.total.exceptionnel + " F CFA");
            }

            var error = function(e){
                $('#tableCotisationsDues').find('.tbody').html('Une erreur est survenue <br>' + e.responseText);
                console.log(e);
            }

            sendAjax({url: url, data: data, success: success, error: error, api: true })
        }

        function callPersonnalMessage(souscripteur) {
            $('#previewPersonnalMessage').html('<div class="text-center"><div class="loader--default colord_bg_4"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><h6 class="pt-3">Chargement</h6><p>Veuillez patienter pendant que nous chargeons les informations</p></div>');
            var url = "{{ route('apiGetPersonnalMessage') }}";
            var data = {
                'num_adhesion':souscripteur,
                'message':$('#message_sample').val(),
                'id_user':"{{ Auth::user()->id }}"
            };
            var success = function(res){
                $('#previewPersonnalMessage').html(res);
            }
            var error = function(e){
                console.log(e);
            }

            sendAjax({url: url, data: data, success: success, error: error, api: true })
        }

        function callSouscripteurs(){
            var url = "{{ route('apiGetSouscripteurAvertir') }}";
            var data = {
                'id_user':"{{ Auth::user()->id }}"
            };
            var success = function(res){
                $($('#reloadBtn').find('.fa-spinner:first')).addClass('d-none')
                $($('#reloadBtn').find('.ti-reload:first')).removeClass('d-none')
                $('.tableSouscripteur:first').find('.tbody').html('');
                res.forEach(souscripteur => {
                    $('.tableSouscripteur:first').find('.tbody').append(`
                        <tr class="toHide border">
                            <td style="max-width: 1rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="adherents[]" value="${souscripteur.num_adhesion}" class="custom-control-input selectSous" id="selectSous${souscripteur.num_adhesion}">
                                    <label class="custom-control-label" for="selectSous${souscripteur.num_adhesion}"></label>
                                </div>
                            </td>
                            <td>
                                ${souscripteur.num_adhesion}
                            </td>
                            <td>
                                ${souscripteur.nom} ${souscripteur.pnom}
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="btnPreviewModal" data-toggle="modal" data-target="#previewModal" data-souscripteur="${souscripteur.num_adhesion}" data-id="${souscripteur.id}" data-nom="${souscripteur.nom} ${souscripteur.pnom}"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    `)
                });
                $('#nbreSelected').html(0);
                $('#totalToSelect').html(res.length);
                selectPuprose();
                previewModal();
            }
            var error = function(e){
                $($('#reloadBtn').find('.fa-spinner:first')).addClass('d-none')
                $($('#reloadBtn').find('.ti-reload:first')).removeClass('d-none')
                $('.tableSouscripteur:first').find('.tbody').html('<tr><td colspan="4" class="text-center"><h5>Une erreur est survenue</h5><p>' + e.responseJSON.message + '</p> </td></tr>');
                console.log(e);
            }

            sendAjax({url: url, data: data, success: success, error: error, api: true })
        }

        function previewModal() {
            $('.btnPreviewModal').click(function(){
                // HoldOn.open();
                let souscripteur = $(this).data('souscripteur')
                $('#num_adherent').html(souscripteur)
                $('#nom_pnom').html($(this).data('nom'));

                var url = '{{ route("admin.adhesion.show", ":id") }}';
                var id = $(this).data('id');
                url = url.replace(':id', id);
                $('#externalLink').attr('href', url);

                callCotisationsDues(souscripteur);
                callPersonnalMessage(souscripteur);
            })
        }

        function refresh() {
            $('.tableSouscripteur:first').find('.tbody').html('<tr><td colspan="4" class="text-center"><div class="loader--default colord_bg_4"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div><h6 class="pt-3">Chargement</h6><p>Veuillez patienter pendant que nous chargeons les informations</p></td></tr>');
            $($('#reloadBtn').find('.fa-spinner:first')).removeClass('d-none')
            $($('#reloadBtn').find('.ti-reload:first')).addClass('d-none')

            callSouscripteurs();
        }

        function collectInformations() {
            message = $('#message_sample').val();
            adherents = [];
            $('.selectSous').each(function(){
                if($(this).is(':checked')) adherents.push($(this).val());
            });
            alert(message);
            console.log(adherents);
        }

        function sendMessage(message, adherent, next = null, index = 1, total = 1) {

            var url = "{{ route('apiPostSendMessages') }}";
            // async:false,
            var data = {
                'num_adhesion':adherent,
                'message':message,
                'id_user':"{{ Auth::user()->id }}"
            };
            var success = function(res){
                $('#progress_num_adherent').html(res.msg);
                $('#progress_index').html(index);
                $('#progress_total').html(total);

                setTimeout(() => {
                    if(next) {
                        $('#progress_num_adherent').html(`Envoi de message à ${next}`);
                    } else {
                        $('#progress_num_adherent').html(`Opération terminée`);
                        processing = false;
                        $(btnSend.find('span:first')).html('Envoyer')
                        $(btnSend.find('.loader:first')).addClass('d-none')
                    }
                }, 800);
            }
            var error = function(e){
                console.log(e);
            }

            sendAjax({url: url, data: data, success: success, error: error, api: true })
        }

        $(document).ready(function() {
            refresh();

            $('#reloadBtn').click(function() {
                refresh();
            });

            $('#textToSearch').keyup(function(){
                var value = this.value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim(); // normalize('NFD').replace(/[\u0300-\u036f]/g, '') replaces accented letters
                $("#tableBody .toHide").show().filter(function() {
                    return $(this).text().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim().indexOf(value) == -1;
                }).hide();
            })

            $('.btnVarMessage').click(function(){
                textarea = $('#message_sample')
                pos = textarea.prop('selectionStart');
                posEnd = textarea.prop('selectionEnd');
                value = textarea.val();

                addon = $(this).data('value')

                textarea.val(value.substring(0, pos) + addon + value.substring(posEnd));

                newPos = pos + addon.length
                textarea.focus()
                textarea.prop('selectionStart', newPos)
                textarea.prop('selectionEnd', newPos)
            });

            $('#sendMessage').click(function(){
                btnSend = $(this);
                if(!processing) {
                    message = $('#message_sample').val();
                    adherents = [];
                    $('.selectSous').each(function(){
                        if($(this).is(':checked')) adherents.push($(this).val());
                    });

                    if(adherents.length) {
                        processing = true;
                        $(btnSend.find('span:first')).html('Envoi en cours')
                        $(btnSend.find('.loader:first')).removeClass('d-none')
                        $('#progress_num_adherent').html(`Envoi de message à ${adherents[0]}`);

                        for (let index = 0; index < adherents.length; index++) {
                            const adherent = adherents[index];
                            var next = index < adherents.length ? adherents[index+1] : null;
                            sendMessage(message, adherent, next, index+1, adherents.length);
                        }
                    }
                }
            })
        });
    </script>
@endsection
