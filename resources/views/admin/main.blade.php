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


@include('admin.partials.chatbox')

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
                paging: true,
                "language": {
                    "url": "{{ url('js/language/french_json.json')}}"
                },
                // ordering:false,
                // searching: true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
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
