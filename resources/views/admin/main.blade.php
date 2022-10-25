<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:39:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> | Diphita prévoyance</title>

    <link rel="icon" href="{{ url('img/mini_logo.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="{{ url('vendors/themefy_icon/themify-icons.css') }}" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="{{ url('vendors/niceselect/css/nice-select.css') }}" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('vendors/owl_carousel/css/owl.carousel.css') }}" />
    <!-- gijgo css -->
    <link rel="stylesheet" href="{{ url('vendors/gijgo/gijgo.min.css') }}" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('vendors/font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('vendors/tagsinput/tagsinput.css') }}" />

    <!-- date picker -->
     <link rel="stylesheet" href="{{ url('vendors/datepicker/date-picker.css') }}" />

     <link rel="stylesheet" href="{{ url('vendors/vectormap-home/vectormap-2.0.2.css') }}" />

     <!-- scrollabe  -->
     <link rel="stylesheet" href="{{ url('vendors/scroll/scrollable.css') }}" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{ url('vendors/datatable/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ url('vendors/datatable/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ url('vendors/datatable/css/buttons.dataTables.min.css') }}" />
    <!-- text editor css -->
    <link rel="stylesheet" href="{{ url('vendors/text_editor/summernote-bs4.css') }}" />
    <!-- morris css -->
    <link rel="stylesheet" href="{{ url('vendors/morris/morris.css') }}">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="{{ url('vendors/material_icon/material-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendors/HoldOn/HoldOn.min.css') }}">
    <link rel="stylesheet" href="{{ asset('myplugins/select2/css/select2.min.css') }}">

    @yield('css')

    <!-- menu css  -->
    <link rel="stylesheet" href="{{ url('css/metisMenu.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('css/colors/default.css') }}" id="colorSkinCSS">
    <style>
        /* table th, table td{
            text-align: center;
        } */
        /*.main_content .main_content_iner{
            background: linear-gradient(rgba(246,247,251,0.9),
     rgba(246,247,251,0.95)),
        url("http://web.medcare-ci.com/wp-content/uploads/2021/06/pexels-jep-gambardella-7689757-scaled.jpg") !important;

        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        }*/
    </style>
</head>
<body class="crm_body_bg">

<!-- main content part here -->

 <!-- sidebar  -->
@include('admin.partials.sidebar')
 <!--/ sidebar  -->


<section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
    @include('admin.partials.header')
    <!--/ menu  -->
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                        <div class="page_title_left d-flex align-items-center">
                            <h3 class="f_s_25 f_w_700 dark_text mr_30" >@yield('title')</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">@yield('subtitle')</li>
                            </ol>
                        </div>

                        <div class="page_title_right">
                            <div class="page_date_button d-flex align-items-center">
                                <img src="{{ url('img/icon/calender_icon.svg') }}" alt="">
                                {{ ucwords((new Carbon\Carbon(Now()))->locale('fr')->isoFormat('DD MMMM YYYY')) }}</td>
                            </div>
                        </div>
                        {{-- <a href="{{ url()->previous() }}" class="white_btn3">Retour</a> --}}

                        @if (Route::currentRouteName() != 'admin.index')
                            <a href="{{ route('backStack') }}" class="white_btn3">Retour</a>
                        @endif
                    </div>
                </div>
            </div>
             @include('admin.partials.message')
            @yield('content')
        </div>
    </div>

<!-- footer part -->
@include('admin.partials.footer')
</section>
<!-- main content part end -->

<!-- ### CHAT_MESSAGE_BOX   ### -->

<div class="CHAT_MESSAGE_POPUPBOX">
    <div class="CHAT_POPUP_HEADER">
    <div class="MSEESAGE_CHATBOX_CLOSE">
    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M7.09939 5.98831L11.772 10.661C12.076 10.965 12.076 11.4564 11.772 11.7603C11.468 12.0643 10.9766 12.0643 10.6726 11.7603L5.99994 7.08762L1.32737 11.7603C1.02329 12.0643 0.532002 12.0643 0.228062 11.7603C-0.0760207 11.4564 -0.0760207 10.965 0.228062 10.661L4.90063 5.98831L0.228062 1.3156C-0.0760207 1.01166 -0.0760207 0.520226 0.228062 0.216286C0.379534 0.0646715 0.578697 -0.0114918 0.777717 -0.0114918C0.976738 -0.0114918 1.17576 0.0646715 1.32737 0.216286L5.99994 4.889L10.6726 0.216286C10.8243 0.0646715 11.0233 -0.0114918 11.2223 -0.0114918C11.4213 -0.0114918 11.6203 0.0646715 11.772 0.216286C12.076 0.520226 12.076 1.01166 11.772 1.3156L7.09939 5.98831Z" fill="white"/>
    </svg>

    </div>
        <h3>Chat with us</h3>
        <div class="Chat_Listed_member">
            <ul>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{ url('img/staf/1.png') }}" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{ url('img/staf/2.png') }}" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{ url('img/staf/3.png') }}" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{ url('img/staf/4.png') }}" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                         <img src="{{ url('img/staf/5.png') }}" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="member_thumb">
                            <div class="more_member_count">
                                <span>90+</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="CHAT_POPUP_BODY">
        <p class="mesaged_send_date">
        Sunday, 12 January
        </p>

    <div class="CHATING_SENDER">
        <div class="SMS_thumb">
            <img src="{{ url('img/staf/1.png') }}" alt="">
        </div>
        <div class="SEND_SMS_VIEW">
            <P>Hi! Welcome .
            How can I help you?</P>
        </div>
    </div>

    <div class="CHATING_SENDER CHATING_RECEIVEr">

        <div class="SEND_SMS_VIEW">
            <P>Hello</P>
        </div>
        <div class="SMS_thumb">
            <img src="{{ url('img/staf/1.png') }}" alt="">
        </div>
    </div>

    </div>
    <div class="CHAT_POPUP_BOTTOM">
        <div class="chat_input_box d-flex align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Write your message" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn " type="button">
                        <!-- svg      -->
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.7821 3.21895C14.4908 -1.07281 7.50882 -1.07281 3.2183 3.21792C-1.07304 7.50864 -1.07263 14.4908 3.21872 18.7824C7.50882 23.0729 14.4908 23.0729 18.7817 18.7815C23.0726 14.4908 23.0724 7.50906 18.7821 3.21895ZM17.5813 17.5815C13.9525 21.2103 8.04773 21.2108 4.41871 17.5819C0.78907 13.9525 0.789485 8.04714 4.41871 4.41832C8.04752 0.789719 13.9521 0.789304 17.5817 4.41874C21.2105 8.04755 21.2101 13.9529 17.5813 17.5815ZM6.89503 8.02162C6.89503 7.31138 7.47107 6.73534 8.18131 6.73534C8.89135 6.73534 9.46739 7.31117 9.46739 8.02162C9.46739 8.73228 8.89135 9.30811 8.18131 9.30811C7.47107 9.30811 6.89503 8.73228 6.89503 8.02162ZM12.7274 8.02162C12.7274 7.31138 13.3038 6.73534 14.0141 6.73534C14.7241 6.73534 15.3002 7.31117 15.3002 8.02162C15.3002 8.73228 14.7243 9.30811 14.0141 9.30811C13.3038 9.30811 12.7274 8.73228 12.7274 8.02162ZM15.7683 13.2898C14.9712 15.1332 13.1043 16.3243 11.0126 16.3243C8.8758 16.3243 6.99792 15.1272 6.22834 13.2744C6.09642 12.9573 6.24681 12.593 6.56438 12.4611C6.64238 12.4289 6.72328 12.4136 6.80293 12.4136C7.04687 12.4136 7.27836 12.5577 7.37772 12.7973C7.95376 14.1842 9.38048 15.0799 11.0126 15.0799C12.6077 15.0799 14.0261 14.1836 14.626 12.7959C14.7625 12.4804 15.1288 12.335 15.4441 12.4717C15.7594 12.6084 15.9048 12.9745 15.7683 13.2898Z" fill="#707DB7"/>
                        </svg>

                        <!-- svg      -->
                    </button>
                    <button class="btn" type="button">
                         <!-- svg  -->
                         <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 0.289062C4.92455 0.289062 0 5.08402 0 10.9996C0 16.9152 4.92455 21.7101 11 21.7101C17.0755 21.7101 22 16.9145 22 10.9996C22 5.08472 17.0755 0.289062 11 0.289062ZM11 20.3713C5.68423 20.3713 1.375 16.1755 1.375 10.9996C1.375 5.82371 5.68423 1.62788 11 1.62788C16.3158 1.62788 20.625 5.82371 20.625 10.9996C20.625 16.1755 16.3158 20.3713 11 20.3713ZM15.125 10.3302H11.6875V6.98314C11.6875 6.61363 11.3795 6.31373 11 6.31373C10.6205 6.31373 10.3125 6.61363 10.3125 6.98314V10.3302H6.875C6.4955 10.3302 6.1875 10.6301 6.1875 10.9996C6.1875 11.3691 6.4955 11.669 6.875 11.669H10.3125V15.016C10.3125 15.3855 10.6205 15.6854 11 15.6854C11.3795 15.6854 11.6875 15.3855 11.6875 15.016V11.669H15.125C15.5045 11.669 15.8125 11.3691 15.8125 10.9996C15.8125 10.6301 15.5045 10.3302 15.125 10.3302Z" fill="#707DB7"/>
                        </svg>

                         <!-- svg  -->
                         <input type="file">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/### CHAT_MESSAGE_BOX  ### -->

<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>

@yield('modals')

<!-- footer  -->
<script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ url('js/popper.min.js') }}"></script>
<!-- bootstarp js -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<!-- sidebar menu  -->
<script src="{{ url('js/metisMenu.js') }}"></script>
<!-- waypoints js -->
<script src="{{ url('vendors/count_up/jquery.waypoints.min.js') }}"></script>
<!-- waypoints js -->
<script src="{{ url('vendors/chartlist/Chart.min.js') }}"></script>
<!-- counterup js -->
<script src="{{ url('vendors/count_up/jquery.counterup.min.js') }}"></script>

<!-- nice select -->
<script src="{{ url('vendors/niceselect/js/jquery.nice-select.min.js') }}"></script>
<!-- owl carousel -->
<script src="{{ url('vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('vendors/HoldOn/HoldOn.min.js') }}"></script>
<script src="{{ asset('myplugins/select2/js/select2.min.js') }}"></script>

<!-- responsive table -->
<script src="{{ url('vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/buttons.flash.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/jszip.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ url('vendors/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('vendors/datatable/js/buttons.print.min.js') }}"></script>

<!-- datepicker  -->
<script src="{{ url('vendors/datepicker/datepicker.js') }}"></script>
<script src="{{ url('vendors/datepicker/datepicker.en.js') }}"></script>
<script src="{{ url('vendors/datepicker/datepicker.custom.js') }}"></script>

<script src="{{ url('js/chart.min.js') }}"></script>
<script src="{{ url('vendors/chartjs/roundedBar.min.js') }}"></script>

<!-- progressbar js -->
<script src="{{ url('vendors/progressbar/jquery.barfiller.js') }}"></script>
<!-- tag input -->
<script src="{{ url('vendors/tagsinput/tagsinput.js') }}"></script>
<!-- text editor js -->
<script src="{{ url('vendors/text_editor/summernote-bs4.js') }}"></script>
<script src="{{ url('vendors/am_chart/amcharts.js') }}"></script>

<!-- scrollabe  -->
<script src="{{ url('vendors/scroll/perfect-scrollbar.min.js') }}"></script>
<script src="{{ url('vendors/scroll/scrollable-custom.js') }}"></script>

<!-- vector map  -->
<script src="{{ url('vendors/vectormap-home/vectormap-2.0.2.min.js') }}"></script>
<script src="{{ url('vendors/vectormap-home/vectormap-world-mill-en.js') }}"></script>

<!-- apex chrat  -->
<script src="{{ url('vendors/apex_chart/apex-chart2.js') }}"></script>
<script src="{{ url('vendors/apex_chart/apex_dashboard.js') }}"></script>

<!-- <script src="{{ url('vendors/echart/echarts.min.js') }}"></script> -->


<script src="{{ url('vendors/chart_am/core.js') }}"></script>
<script src="{{ url('vendors/chart_am/charts.js') }}"></script>
<script src="{{ url('vendors/chart_am/animated.js') }}"></script>
<script src="{{ url('vendors/chart_am/kelly.js') }}"></script>
<script src="{{ url('vendors/chart_am/chart-custom.js') }}"></script>
<script src="{{ url('js/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
@yield('js')
<!-- custom js -->
<script src="{{ url('js/dashboard_init.js') }}"></script>
<script src="{{ url('js/custom.js') }}"></script>
<script>
    $('[data-mask]').inputmask();
</script>
<script>
    function jqueryBtnPaie (){
        $('.btnReglementJS').click(function(){
            HoldOn.open();
            let souscripteur = $(this).data('souscripteur')
            let cotisation = $(this).data('cotisation')
            let type = $(this).data('type')

            $('#num_adherent').html(souscripteur)
            console.log(souscripteur);

            $.ajax({
                url: "{{ route('apiGetInfosSouscripteur') }}",
                type: 'POST',
                data:{
                    'num_souscripteur':souscripteur,
                    'cotisation':cotisation,
                    'type':type,
                    'id_user':"{{ Auth::user()->id }}"
                },
                success: function(res){
                    $('#nom_pnom').html(res.nom_pnom);

                    $('#versementModal').find('#id_souscripteur').val(res.id_adherent)
                    $('#versementModal').find('input.versement').val(0)

                    $('.PaiementForm').find('#id_adherent').val(res.id_adherent)
                    $('.PaiementForm').find('#id_cotisation').val(res.id_cotisation)

                    $('.PaiementForm').find('.solde:first').val(res.solde)
                    $('.PaiementForm').find('.aRegler:first').val(res.reste_a_payer)

                    // $('.PaiementForm').find('#nom_pnom').html(res.nom_pnom)
                    $('.PaiementForm').find('#montant').val(res.montant)

                    $('.PaiementForm').find('#montantPaye').val(res.deja_payer)
                    $('.PaiementForm').find('#montantReste').val(res.reste_a_payer)

                    $('.PaiementForm').find('.displayExcept').removeClass('d-none');
                    $('.PaiementForm').find('.displayAnn').removeClass('d-none');

                    if(res.annuelle == true) {
                        $('.PaiementForm').find('.displayExcept').addClass('d-none');
                        $('.PaiementForm').find('#aPayer').val(res.reste_a_payer) // Annuelle
                        $('.PaiementForm').find('#montantRegle').attr('disabled', true).attr('readonly', true)
                    } else {
                        $('.PaiementForm').find('.displayAnn').addClass('d-none');
                    }
                    $('.PaiementForm').find('#montantRegle').val(res.reste_a_payer).change()
                    // $('#reglementModalFooter').removeClass('alert-danger').removeClass('alert-success').removeClass('alert-warning').removeClass('d-none')

                    HoldOn.close();
                },
                error: function(e){
                    HoldOn.close();
                    console.log(e);
                }
            });
            // console.log($(this));
        });

        // setInterval(() => {
        // }, 500);
    }
    function ajaxDiphita () {
        $('.table_diphita_ajax').each( function(){
            let fields = $(this).data('fields') ?? {};
            let url = $(this).data('url') ?? '';
            let type = $(this).data('type') ?? 'get';
            $(this).DataTable({
                // "processing": true,
                // "serverSide": true,
                "fnInitComplete": function(oSettings, json) {
                    jqueryBtnPaie()
                },
                "search": function() {
                    console.log('Searching')
                    jqueryBtnPaie()
                },
                "filter": true,
                "ajax": {
                    "url": url,
                    "type": type,
                    "data": fields,
                    "datatype": "json",
                },
                "columns": [
                    {
                        "data": "identifiant"
                    },
                    {
                        "data": "nom_prenoms"
                    },
                    {
                        "data": "nbre_benef"
                    },
                    {
                        "data": "date_paiement"
                    },
                    {
                        "data": "montant"
                    },
                    {
                        "data": "etat"
                    },
                    {
                        "data": "identifiant",
                        "render": function (data, type, row) {
                            btnPaie = '';
                            if(row.etat == "Non A Jour") {
                                btnPaie = `<a class="dropdown-item btnReglementJS" data-toggle="modal" data-target="#reglementModal"
                                    data-souscripteur="${row.identifiant}" data-type="${row.cotisation_type}"
                                    data-cotisation="${row.cotisation_identifiant}" href="javascript:void(0);">
                                    <i class="ti-money"></i> Faire un reglement
                                </a>`
                            }

                            res = `<div class="header_more_tool">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"><i class="ti-more-alt"></i></span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Voir</a>${btnPaie}
                                    </div>
                                </div>
                            </div>`;

                            return res;
                        }
                    }
                ],
            }).on('search.dt page.dt', function(){
                jqueryBtnPaie();
            });
        });

        $('#reglementModal').find('.close:first').click(function(){
            jqueryBtnPaie();
        })
    }

    $(document).ready(function () {
        $('.table_diphita').DataTable({
            paging: true,
            "language": {
                "url": "{{ url('js/language/french_json.json')}}"
            },
            ordering:false,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('.select2').select2();

        $(".verser").on('click', function(e) {
            $this = $(this);
            modalParent = $this.parents('.modal')[0];

            span = $(modalParent).find('span.error')[0]
            versement = $(modalParent).find('.versement');
            id_souscripteur = $(modalParent).find('.id_souscripteur');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.versement.store')}}",
                data: {
                    'api':true,
                    'montant':$(versement).val(),
                    'id_adherent':$(id_souscripteur).val(),
                },
                success: function(msg) {
                    if(!$($(span).parent()).hasClass('d-none')) $($(span).parent()).addClass('d-none')

                    if(msg.status && msg.status == 'success'){
                        $(modalParent).find(".close").click()
                        modalReglement = $('.reglementModal.show:first')
                        if(modalReglement.length){
                            console.log($($(modalReglement).find('.solde:first')));
                            $($(modalReglement).find('.solde:first')).val(msg.data)
                            $($(modalReglement).find('.montant')).change()
                        } else {
                            console.log("recharger la page")
                            $($(document).find('.solde:first')).html(msg.data)
                        }
                    } else {
                        $(span).html(msg.message)
                        if($($(span).parent()).hasClass('d-none')) $($(span).parent()).removeClass('d-none')
                    }
                },
                error: function(error){
                    console.log(error)
                }
            });
        });

        $(".PaiementForm .montant").on('change keyup', function(){
            $this = $(this);
            formParent = $this.parents('form')[0];
            modalParent = $this.parents('.modal')[0];

            identifiant = $(modalParent).attr('id');
            btnSubmit = $(formParent).find('#' + identifiant + 'Submit')
            btnDocker = $(btnSubmit).parent()

            solde = $($(formParent).find('.solde')[0]).val();
            aRegler = $($(formParent).find('.aRegler')[0]).val();

            if($this.val() - aRegler > 0 || $this.val() < 0) $this.val(aRegler)

            $($(modalParent).find('#'+identifiant+'Footer')).remove()

            if($this.val() < 0 || ($this.val() % 50 != 0)){
                btnSubmit.attr('disabled')
                if(!btnDocker.hasClass('d-none')) btnDocker.addClass('d-none');
                $($(modalParent).find('.modal-content')[0]).append(`
                    <div id="${identifiant}Footer" class="modal-footer alert-warning text-center" style="justify-content: center; display: block;">
                        <span class="h5 pb-3"> &#129300; Montant saisi Incorrect !</span>
                        <div class="row mt-2 h6">
                            <div class="container">
                                <span>Veuillez saisir un montant multiple de 50 et supérieur à 50 FCFA</span>
                            </div>
                        </div>
                    </div>
                `)
            } else {
                if($this.val() >= 50 && (solde - $this.val() >= 0)){
                    btnSubmit.removeAttr('disabled')
                    if(btnDocker.hasClass('d-none')) btnDocker.removeClass('d-none');
                    let residuel = solde - $this.val();
                    $($(modalParent).find('.modal-content')[0]).append(`
                        <div id="${identifiant}Footer" class="modal-footer alert-success text-center" style="justify-content: center; display: block;">
                            <span class="h5 pb-3"> &#128578; Solde suffisant !</span>
                            <div class="row mt-2 h6">
                                <div class="col">
                                    <span>Solde Actuel : ${solde} FCFA</span>
                                </div>
                                <div class="col">
                                    <span>Solde Résiduel : ${residuel} FCFA</span>
                                </div>
                            </div>
                        </div>
                    `)
                } else {
                    btnSubmit.attr('disabled','disabled')
                    if(!btnDocker.hasClass('d-none')) btnDocker.addClass('d-none');
                    $($(modalParent).find('.modal-content')[0]).append(`
                        <div id="${identifiant}Footer" class="modal-footer alert-danger text-center" style="justify-content: center; display: block;">
                            <span class="h5 pb-3"> &#128577; Solde insuffisant !</span>
                            <div class="row mt-2 h6">
                                <div class="container">
                                    <span>Solde Actuel : ${solde} FCFA</span> <div class="py-1"></div>
                                    <a href="#" class="pt-2 btn btn-sm btn-info" data-toggle="modal" data-target="#versementModal"><i class="fa fa-plus"></i> <span> <span>Versement</span>  </span> </a>
                                </div>
                            </div>
                        </div>
                    `)
                }
            }
        })

        $('.chartsh').each(function(){
            data=$(this).data('fields');
            $.plot($(this), data, {
                series: {
                    pie: { innerRadius: 0.5, show: !0 },
                },
                grid:{
                    hoverable:true,
                },
                colors: ["#09ad95", "#f82649", "#6c5ffc", "#05c3fb", "#1170e4"],
                legend: { show: !1 }
            });
        })


        $('.chartsh').each(function(){
            let data=$(this).data('fields');
            let collecte = data[0]['data'];
            let recouvrer = data[1]['data'];

            let pieLabel0 = $(this).find('#pieLabel0').find('div:first')
            let pieLabel1 = $(this).find('#pieLabel1').find('div:first')

            let converter = Intl.NumberFormat();
            $(pieLabel0).append(`<br>${converter.format(collecte)} Fcfa`)
            $(pieLabel1).append(`<br>${converter.format(recouvrer)} Fcfa`)

            $(pieLabel0).css({'font-size':'15px', 'background-color':'white'})
            $(pieLabel1).css({'font-size':'15px', 'background-color':'white'})
            $($(pieLabel1).parent()).css({'top':'10px', 'left':'10px'})
            $($(pieLabel0).parent()).css({'top':'10px', 'left':'auto', 'right':'10px'})
        })
    });
</script>
</body>

<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:40:27 GMT -->
</html>
