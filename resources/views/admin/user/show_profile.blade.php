@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Mon compte
@endsection

@section('subtitle')
    Mon compte utilisateur 
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">

                <div class="col-md-9 col-lg-9">
                    <div class="white_card position-relative mb_20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self-center"><img src="{{ url('img/'.auth()->user()->image_name.'.png') }}" alt="" class="mx-auto d-block admin_profil" height="300" /></div>
                                <!--end col-->
                                <div class="col-lg-6 align-self-center">
                                    <div class="single-pro-detail">
                                        <p class="mb-1">Informations</p>
                                        <div class="custom-border mb-3"></div>
                                        <h4 class="pro-title">{{ auth()->user()->nom_pnom() }} 
                                            <span class="text-danger font-weight-bold ml-2">
                                                @if (auth()->user()->role == 'super_admin')
                                                    (Super Admin)
                                                @elseif(auth()->user()->role == 'admin')
                                                    (Administrateur)
                                                @elseif(auth()->user()->role == 'admin_ouele')
                                                    (Administrateur Ouellé)
                                                @elseif(auth()->user()->role == 'admin_oume')
                                                    (Administrateur Oumé)
                                                @endif
                                                
                                            </span>
                                        </h4>
                                        
                                        <div class="single_plan d-flex align-items-center justify-content-between mt_30">
                                                <div class="plan_left d-flex align-items-center">
                                                    <div class="thumb icon_flat_success">
                                                        <img src="{{ url('img/icon2/email.svg') }}" alt="">
                                                    </div>
                                                    <div>
                                                        <h4>{{ auth()->user()->email }}</h4>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="single_plan d-flex align-items-center justify-content-between mt_15">
                                            <div class="plan_left d-flex align-items-center">
                                                <div class="thumb icon_flat_success">
                                                    <img src="{{ url('img/icon2/contact.svg') }}" alt="">
                                                </div>
                                                <div>
                                                    <h4>{{ auth()->user()->contact }}</h4>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 mt_40" style="padding-left: 0px !important;">
                                            <a href="{{ route('admin.user.edit_password') }}">
                                                <button class="btn btn-primary btn-lg  this-item-bg this-item-bc">Modifier Mot de passe</button>
                                            </a>
                                            
                 
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="email-sidebar white_box">
                        <a href="{{ route('admin.user.edit_infos') }}">
                            <button class="btn_1 w-100 mb-2 btn-lg email-gradient gradient-9-hover email__btn waves-effect"><i class="ti-pencil"></i>Modifier infos</button>
                        </a>
                        {{-- <ul class="text-left mt-2">
                            
                            <li><a href="#"><i class="ti-check"></i> <span> <span>Désactiver compte</span> </span> </a></li>
                            <li><a href="#"><i class="ti-trash"></i> <span> <span>Rejeter</span>  </span> </a></li>
                            
                        </ul> --}}
                    </div>
                </div>  
                <!--end col-->
           
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection