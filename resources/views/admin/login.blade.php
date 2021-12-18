<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:39:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Connexion | Diphita prévoyance</title>

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

        .ml_30{
            margin-left:30px;
        }
        @font-face {
            font-family: Copperplate;
            src: url({{ url('copperplate/Copperplate.ttf') }});
        }


    </style>
</head>
<body class="crm_body_bg" style="background-image: url({{ url('img/dl/Elderly-men-hugging-AA.jpg') }}); background-size:cover; background-repeat: no-repeat">
    
   
    @include('admin.headclient')
    <div class="container-fluid p-0 ">
                <div class="row" >
                    <div class="col-lg-8"><img src="{{ url('img/dl/Elderly-men-hugging-AA.jpg') }}" style="opacity:0;" alt="" class="img-fluid"></div>
                    <div class="col-lg-4 my-auto" style="padding-right:30px">
                        <div class="modal-content cs_modal " >
                            <div class="modal-header justify-content-center theme_bg_4" style="background-color: #bfc8e2 !important;">
                                        <img src="{{ url('img/logo1.png') }}" alt="">
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nom d'utilisateur">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Mot de passe">
                                    </div>
                                    <a href="#" class="btn_1 full_width text-center" style="background-color: #29235c !important;border-color:#152040">Connexion</a>
                                        <p>Devenir un souscripteur ? <a href="{{ route('client.adhesion') }}"> Inscrivez-vous ici</a></p>
                                        {{-- <div class="text-center">
                                            <a href="#" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
                                        </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
 
<!-- footer  -->
<script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ url('js/popper.min.js') }}"></script>
<!-- bootstarp js -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>

</body>

<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:40:27 GMT -->
</html>
