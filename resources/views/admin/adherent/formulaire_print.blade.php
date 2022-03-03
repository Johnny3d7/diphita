@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
    <style>
        body, h1, h2, h3, h4, h5, h6,td,th{
            color:#2F5597 !important;
        }
        .table td,.table th{
            font-family: Cambria !important;
            font-size: 24px !important;
            padding-top: 0rem !important;
            padding-bottom: 0rem !important;
        }

        #bl{
        background-repeat: no-repeat;
        background-position-x: center;
        background-position-y: center;
        background-size: 25%;
        background-image:url({{ url('images/totem_obp.png') }}) ;
    }
        table th, table td {
            text-align: left !important;
        }
    </style>
@endsection

@section('title')
    Formulaire d'adhésion
@endsection

@section('subtitle')
    Formulaire d'adhésion      
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                {{-- <h3 class="m-0">Formulaire d'ajout d'un adhérent</h3> --}}
                                <div class="col-md-12 text-center mt_15">
                                    @include('admin.partials.message')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body" id="logo_fond">
                            @include('admin.adherent._formulaire_view')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 txt-center">
                <a href="{{ route('admin.adherent.print', ['id'=>$adherent->id]) }}" target="_blank" class="white_btn_1">Imprimer</a>
                {{-- <a href="#" class="white_btn_1 btnblprint">Imprimer</a> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.btnblprint').on('click', function(event) {
        event.preventDefault();
        // window.print();
        var prtContent = document.getElementById("logo_fond");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
 </script>
@endsection