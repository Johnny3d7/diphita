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
    <link rel="stylesheet" href="{{ url('css/stylechild.css') }}" />
    <link rel="stylesheet" href="{{ url('css/colors/default.css') }}" id="colorSkinCSS">
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
   
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
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Souscripteur</h4>
                                </div>
                                <div class="col-lg-4">
                                    <select class="nice_Select2 nice_Select_line wide" name="souscript_civilite">
                                        <option value="0">Civilité <span>*</span></option>
                                        <option value="1">M. </option>
                                        <option value="2">Mme</option>
                                        <option value="3">Mlle</option>
                                    </select>
                                </div>
                                <div class="col-lg-4" >
                                    <div class="common_input mb_15">
                                        <input type="text" name="souscript_nom" placeholder="Nom *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" name="souscript_pnom" placeholder="Prénom *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" name="souscript_lnaiss" placeholder="Lieu de naissance * (Ville, Village)">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group common_date_picker">
                                      <input class="datepicker-here  digits" name="souscript_dnaiss" type="text" data-language="en" placeholder="Date de naissance *">
                                    </div>
                                  </div>
                                
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" name="souscript_lhab" placeholder="Lieu d'habitation *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="text" name="souscript_contact" placeholder="Contact *">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="email" name="souscript_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="common_input mb_15">
                                        <input type="email" name="souscript_ncni" placeholder="Numéro CNI">
                                    </div>
                                </div>
                                <div class="col-12 mt_30 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaires</h4>
                                    <span>Vous pouvez inscrire au plus 5 personnes y compris vous-même.</span>
                                </div>
                                
                                <div id="benef_bloc" class="row">
                                    <div id="benef-title-0" class="col-lg-12 mb_15">
                                        <h6 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaire 1</h6>
                                    </div>
                                    <div id="benef-civilite-0" class="col-lg-4 benef_civilite">
                                        <select  name="benef_civilite[]" class="nice_Select2 nice_Select_line wide">
                                            <option value="0" >Civilité <span>*</span></option>
                                            <option value="1">M. </option>
                                            <option value="2">Mme</option>
                                            <option value="3">Mlle</option>
                                        </select>
                                    </div>
                                    
                                    <div id="benef-nom-0" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Nom *" name="benef_nom[]">
                                        </div>
                                    </div>
                                    <div id="benef-pnom-0" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Prénoms *" name="benef_pnom[]">
                                        </div>
                                    </div>
                                    <div id="benef-lnaiss-0" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Lieu de naissance *" name="benef_lnaiss[]">
                                        </div>
                                    </div>
                                    <div id="benef-dnaiss-0" class="col-lg-4">
                                        <div class="input-group common_date_picker">
                                            <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *" name="benef_dnaiss[]">
                                          </div>
                                    </div>
                                    <div id="benef-ncni-0" class="col-lg-3">
                                        <div class="common_input mb_15">
                                            <input type="email" placeholder="Numéro CNI" name="benef_ncni[]">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="col-12 mt_15">
                                    <button type="button" id="benef_btn" class="btn mb-3 btn-success"><i class="ti-trash f_s_14 mr-2"></i>Ajouter</button>
                                </div>
                                <div class="col-12 mt_30 mb_15">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Ayants-droit</h4>
                                    <span>Inscrivez 3 noms et contacts d'ayants-droit.</span>
                                </div>
                                <div id="ayant_bloc" class="row">
                                    <div id="ayant-title-0" class="col-lg-12 mb_15">
                                        <h6 class="m-0 txt-color1 txt-upper txt-bold">Ayant-droit 1</h6>
                                    </div>
                                    <div id="ayant-civilite-0" class="col-lg-4 ayant_civilite">
                                        <select  class="nice_Select2 nice_Select_line wide" name="ayant_civilite[]">
                                            <option value="0" >Civilité <span>*</span></option>
                                            <option value="1">M. </option>
                                            <option value="2">Mme</option>
                                            <option value="3">Mlle</option>
                                        </select>
                                    </div>
                                    <div id="ayant-nom-0" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Nom *" name="ayant_nom[]">
                                        </div>
                                    </div>
                                    <div id="ayant-pnom-0" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Prénoms *" name="ayant_pnom[]">
                                        </div>
                                    </div>
                                    <div id="ayant-contact-0" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Contact *" name="ayant_contact[]">
                                        </div>
                                    </div>
                                    <div id="ayant-space-0" class="col-lg-8">
                                        <div class="common_input mb_15">
                                            
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-12 mt_15 mb_15">
                                    <button type="button" id="ayant_btn" class="btn mb-3 btn-success"><i class="ti-trash f_s_14 mr-2"></i>Ajouter</button>
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

<script>
    var $i = 0;

    $("#benef_btn").click(function (e) {

        if ($('.benef_civilite').length <= 3) {
        
        $i++;
        $nb_benef = $('.benef_civilite').length + 1;
        e.preventDefault();
        $('#benef_bloc').append(`
        
                                    <div id="benef-title-${$i}" class="col-lg-12 mb_15">
                                        <h6 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaire N°${$nb_benef}</h6>
                                    </div>
                                    <div id="benef-civilite-${$i}" class="col-lg-4 benef_civilite">
                                        <select  name="benef_civilite[]" class="nice_Select2 nice_Select_line wide">
                                            <option value="0" >Civilité <span>*</span></option>
                                            <option value="1">M. </option>
                                            <option value="2">Mme</option>
                                            <option value="3">Mlle</option>
                                        </select>
                                    </div>
                                    
                                    <div id="benef-nom-${$i}" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Nom *" name="benef_nom[]">
                                        </div>
                                    </div>
                                    <div id="benef-pnom-${$i}" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Prénoms *" name="benef_pnom[]">
                                        </div>
                                    </div>
                                    <div id="benef-lnaiss-${$i}" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Lieu de naissance *" name="benef_lnaiss[]">
                                        </div>
                                    </div>
                                    <div id="benef-dnaiss-${$i}" class="col-lg-4">
                                        <div class="input-group common_date_picker">
                                            <input class="datepicker-here  digits" type="text" data-language="en" placeholder="Date de naissance *" name="benef_dnaiss[]">
                                          </div>
                                    </div>
                                    <div id="benef-ncni-${$i}" class="col-lg-3">
                                        <div class="common_input mb_15">
                                            <input type="email" placeholder="Numéro CNI" name="benef_ncni[]">
                                        </div>
                                    </div>
                                    <div id="benef-supbloc-${$i}" class="col-lg-1 my-auto">
                                        <button onclick="supprimer(event)" id="benef-sup-${$i}" type="button" class="btn mb-3 btn-danger"><i class="ti-trash f_s_14"></i></button>
                                    </div>`); 
        //alert("Je suis près à fonctionner");
        console.log($('.benef_civilite').length);
        } else {
            
        }
        
    });

    

</script>

<script>
    var $j = 0;

$("#ayant_btn").click(function (e) {

    if ($('.ayant_civilite').length <= 2) {
    
    $j++;
    $nb_ayant = $('.ayant_civilite').length + 1;
    e.preventDefault();
    $('#ayant_bloc').append(`
                                    <div id="ayant-title-${$j}" class="col-lg-12 mb_15">
                                        <h6 class="m-0 txt-color1 txt-upper txt-bold">Ayant-droit N°${$nb_ayant}</h6>
                                    </div>
                                    <div id="ayant-civilite-${$j}" class="col-lg-4 ayant_civilite">
                                        <select  class="nice_Select2 nice_Select_line wide" name="ayant_civilite[]">
                                            <option value="0" >Civilité <span>*</span></option>
                                            <option value="1">M. </option>
                                            <option value="2">Mme</option>
                                            <option value="3">Mlle</option>
                                        </select>
                                    </div>
                                    <div id="ayant-nom-${$j}" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Nom *" name="ayant_nom[]">
                                        </div>
                                    </div>
                                    <div id="ayant-pnom-${$j}" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Prénoms *" name="ayant_pnom[]">
                                        </div>
                                    </div>
                                    <div id="ayant-contact-${$j}" class="col-lg-4">
                                        <div class="common_input mb_15">
                                            <input type="text" placeholder="Contact *" name="ayant_contact[]">
                                        </div>
                                    </div>
                                    <div id="ayant-space-${$j}" class="col-lg-7">
                                        <div class="common_input mb_15">
                                            
                                        </div>
                                    </div>
                                    <div id="ayant-supbloc-${$j}" class="col-lg-1 my-auto">
                                        <button onclick="supprimer_ayant(event)" id="ayant-sup-${$j}" type="button" class="btn mb-3 btn-danger"><i class="ti-trash f_s_14"></i></button>
                                    </div>`); 
  
    console.log($('.ayant_civilite').length);
    } else {
        
    }
    
});

</script>


<script>
    //supression bloc

    //Bénef sup
    function supprimer(e){
   e.preventDefault();
   //alert('bonjour');
   //console.log(e.target.id);
   var res = e.target.id.split('-');
   var id = res[2];

   $('#benef-title-'+id).remove();
   $('#benef-civilite-'+id).remove();
   $('#benef-nom-'+id).remove();
   $('#benef-pnom-'+id).remove();
   $('#benef-lnaiss-'+id).remove();
   $('#benef-dnaiss-'+id).remove();
   $('#benef-ncni-'+id).remove();
   $('#benef-supbloc-'+id).remove();
   $('#benef-space-'+id).remove();
 
}

//ayant droit sup
function supprimer_ayant(e){
   e.preventDefault();
   //alert('bonjour');
   //console.log(e.target.id);
   var res = e.target.id.split('-');
   var id = res[2];
   
   $('#ayant-title-'+id).remove();
   $('#ayant-civilite-'+id).remove();
   $('#ayant-nom-'+id).remove();
   $('#ayant-pnom-'+id).remove();
   $('#ayant-contact-'+id).remove();
   $('#ayant-supbloc-'+id).remove();
   $('#ayant-space-'+id).remove();
}
</script>
</body>

<!-- Mirrored from demo.dashboardpack.com/user-management-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Oct 2021 10:40:27 GMT -->
</html>
