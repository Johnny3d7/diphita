@php
    $results = session('resultsCas');
@endphp

@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
    <style>
        .modal-backdrop {
            /* z-index: -1;
            background-color: aqua; */
        }
    </style>
@endsection

@section('title')
    Importation de cas assistés
@endsection

@section('subtitle')
    Importation de cas assistés
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Etat d'importation de cas assistés</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            {{-- <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6> --}}
                            
                            <div class="col-md-8 offset-md-2">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.assistance.importationPost') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('csv') ? ' has-error has-feedback' : '' }}">
                                        <label class="form-control my-1" for="csv" id="csvLabel" style="cursor: pointer;">Selectionnez un fichier à importer</label>
                                        <input type="file" name="csv" id="csv" class="form-control d-none" placeholder="Selectionnez un fichier à importer" required="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        @if ($errors->has('csv'))
                                            <div class="alert alert-danger alert-dismissible">
                                                <span class="fa fa-remove form-control-feedback"></span>
                                                <span class="help-block"><strong>{{ $errors->first('csv') }}</strong></span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 offset-md-4">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-info btn-block py-2"><i class="fa fa-3x py-2 fa-upload"></i> <br> <span>Importer</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row my-3">
                                
                                @isset ($results)
                                    <div class="col-md-12">
                                        <div class="alert alert-dismissible alert-{{ count($results["errs"]) > 0 ? 'danger' : (count($results["warns"]) > 0 ? 'warning' : 'success') }}" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h6 class="text-center text-info"><b>Cas assistés</b></h6>
                                            <h4 class="text-center">{{ $results['msg'] }} <a href="javascript:void(0)" data-toggle="modal" data-target="#importationModal">Details <i class="fa fa-info-circle"></i></a></h4>
                                            
                                        </div>
                                    </div>                                        
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @isset ($results)
        @include('admin.assistance._detailsImportationModal')
    @endisset
@endsection

@section('js')
<script>
    $(function(){
        $('#csv').change(function(){
            $('#csvLabel').html(this.files[0].name)
        })
    })
</script>
@endsection

@php
session()->forget('resultsCas');
@endphp
