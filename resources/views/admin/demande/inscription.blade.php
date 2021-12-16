<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:39:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Inscription | Diphita prévoyance</title>

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

    @yield('css')

    <!-- menu css  -->
    <link rel="stylesheet" href="{{ url('css/metisMenu.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('css/colors/default.css') }}" id="colorSkinCSS">
    <style>
        .main_content{
            padding-left:0px !important;
            padding-bottom: 0px !important;
        }
        .my-auto{
            margin-top: auto;
            margin-bottom: auto;
        }

        .txt-color1{
            color:#29235c !important;
        }

        .txt-color-wh{
            color:#ffffff !important;
        }
        .txt-upper{
            text-transform: uppercase !important;
        }

        .txt-lower{
            text-transform: lowercase !important;
        }

        .this-item-bg{
            background-color: #29235c !important;
        }

        .this-item-bc{
            border-color: #29235c !important;
        }

        .txt-center{
            text-align:center !important;
        }
        
        .txt-bold{
            font-weight: 900 !important;
        }

        .trans-bg{
            background-color: #fffffff5;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            padding: 5px 30px 25px 30px;
            
        }

        .mb_15 {
            margin-bottom: 15px !important;
        }
        .mb_40 {
            margin-bottom: 40px !important;
        }

        .mb_50 {
            margin-bottom: 50px !important;
        }

        .common_date_picker input{
            border-radius: 10px;
            background-color: #ffffff00;
            height: 47px;
            line-height: 47px;
            font-size: 15px;
        }

        .common_input input{
            color:#2A2A2A !important;
        }

        .bande{
            width: 100% !important;
            display: block !important;
            background-color: #29235c !important;
            /*height: 50px !important;*/
            padding: 0px 0px 0px 0px
        }

        .logo_dif{
            width: 100%;
            height: auto;
        }
        
    </style>
</head>
<body class="" >

<section class="main_content dashboard_part">
        <!-- menu  -->
    <!--/ menu  -->
    @include('admin.headclient')
    <div class="main_content_iner overly_inner" style="background-image: url({{ url('img/dl/Elderly-men-hugging-AA.jpg') }}); background-size:cover; background-repeat: no-repeat">
        <div class="container-fluid p-0 "> 
            <!-- page title  -->
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="trans-bg card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0 text-center">
                                <div class="main-title ">
                                    <h2 class="m-0 txt-color1 txt-upper txt-bold">Formulaire d'Inscription à Diphita Prévoyance </h2>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="row">
                                <div class="col-md-12 text-center mb_30">
                                    <span>Merci d'avoir considéré notre chaîne de solidarité. Pour enregistrer votre adhésion, veuillez compléter ce Formulaire d'Inscription. Les informations collectées via ce formulaire sont strictement confidentielles. Seuls les formulaires complets sont acceptés.</span>
                                </div>
                                <div class="col-12 mt_30 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">* Souscripteur</h4>
                                </div>
                                <div class="col-lg-4">
                                    <select class="nice_Select2 nice_Select_line wide" style="display: none;">
                                        <option value="1">Civilité <span>*</span></option>
                                        <option value="1">M. </option>
                                        <option value="1">Mme</option>
                                        <option value="1">Mlle</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Prénom *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Nom *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Lieu de naissance * (Ville, Village)">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group common_date_picker">
                                      <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *">
                                    </div>
                                  </div>
                                
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Résidence *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Téléphone *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="common_input mb_15">
                                        <input type="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12 mt_30 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">* Bénéficiaires</h4>
                                    <span>&nbsp;&nbsp;&nbsp;Vous pouvez inscrire au plus 5 personnes y compris vous-même.</span>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Nom & Prénoms *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Résidence *">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group common_date_picker">
                                        <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *">
                                      </div>
                                </div>
                                <div class="col-lg-1">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Nom & Prénoms *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Résidence *">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group common_date_picker">
                                        <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *">
                                      </div>
                                </div>
                                <div class="col-lg-1 my-auto">
                                    <button type="button" class="btn mb-3 btn-danger"><i class="ti-trash f_s_14"></i></button>
                                </div>
                                <div class="col-12 mt_15">
                                    <button type="button" class="btn mb-3 btn-success"><i class="ti-trash f_s_14 mr-2"></i>Ajouter</button>
                                </div>
                                <div class="col-12 mt_30 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">* Ayants-droit</h4>
                                    <span>&nbsp;&nbsp;&nbsp;Inscrivez 3 noms et contacts d'ayants-droit.</span>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Nom & Prénoms *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Résidence *">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group common_date_picker">
                                        <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *">
                                    </div>
                                </div>
                                <div class="col-lg-1 my-auto">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Nom & Prénoms *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" placeholder="Résidence *">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group common_date_picker">
                                        <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *">
                                    </div>
                                </div>
                                <div class="col-lg-1 my-auto">
                                    <button type="button" class="btn mb-3 btn-danger"><i class="ti-trash f_s_14"></i></button>
                                </div>
                                <div class="col-12 mt_15 mb_15">
                                    <button type="button" class="btn mb-3 btn-success"><i class="ti-trash f_s_14 mr-2"></i>Ajouter</button>
                                </div>
                                <div class="col-12">
                                    <div class="create_report_btn mt_30">
                                        <a href="#" class="btn_1 radius_btn d-block text-center this-item-bg this-item-bc">Envoyer mon inscription</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- footer part -->

</section>

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
@yield('js')
<!-- custom js -->
<script src="{{ url('js/dashboard_init.js') }}"></script>
<script src="{{ url('js/custom.js') }}"></script>
</body>

<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:40:27 GMT -->
</html>
