@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Importation de données
@endsection

@section('subtitle')
    Importation de données
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
                                <h3 class="m-0">Etat d'importation de contrats</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            {{-- <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6> --}}
                            
                            <div class="col-md-8 offset-md-2">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.adhesion.importationPost') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('csv') ? ' has-error has-feedback' : '' }}">
                                        <label class="form-control my-1" for="csv" id="csvLabel" style="cursor: pointer;">Selectionnez un fichier à importer</label>
                                        <input type="file" name="csv" id="csv" class="form-control d-none" placeholder="Selectionnez un fichier à importer" required="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        @if ($errors->has('csv'))
                                            <div class="container">
                                                <span class="fa fa-remove form-control-feedback"></span>
                                                <span class="help-block"><strong>{{ $errors->first('csv') }}</strong></span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 offset-md-4">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-success btn-block py-2"><i class="fa fa-3x py-2 fa-upload"></i> <br> <span>Importer</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                @php
                                    $results = Session::get('results');
                                @endphp
                                @isset ($results)
                                    <div class="col-md-12">
                                        <div class="alert alert-dismissible alert-{{ count($results["errs"]) > 0 ? 'danger' : (count($results["warns"]) > 0 ? 'warning' : 'success') }}" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="text-center">{{ $results['msg'] }}</h4>
                                            <ul>
                                                @foreach ($results['errs'] as $err)
                                                    <li class="text-dark">
                                                        {{ $err['title'] }} : 
                                                        @foreach ($err['msg'] as $msg)
                                                            {{ $msg }};
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @if (count($results['data']) > 0)
                                        <div class="row">
                                            <div class="col-md-12 m-t-10">
                                                <table id="datatable-buttons"
                                                    class="table table-striped table-colored-bordered table-bordered-info">
                                                    <thead>
                                                        <tr>
                                                            <th>idbeneficiaire</th>
                                                            <th>civilite</th>
                                                            <th>nomprenom</th>
                                                            <th>nomprenom</th>
                                                            <th>email</th>
                                                            <th>cni</th>
                                                            <th>datenaissance</th>
                                                            <th>lieunaissance</th>
                                                            <th>lieuhabitation</th>
                                                            <th>contact</th>
                                                            <th>Cas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($results['data'] as $key => $contrat)
                                                        <tr>
                                                            {{-- <td>{{ $data->role }}</td> --}}
                                                            <td>{{ $data->num_adhesion }}</td>
                                                            <td>{{ $data->civilite }}</td>
                                                            <td>{{ $data->nom }}</td>
                                                            <td>{{ $data->pnom }}</td>
                                                            <td>{{ $data->email }}</td>
                                                            <td>{{ $data->num_cni }}</td>
                                                            <td>{{ $data->date_naiss }}</td>
                                                            <td>{{ $data->lieu_naiss }}</td>
                                                            <td>{{ $data->lieu_hab }}</td>
                                                            <td>{{ $data->contact }}</td>
                                                            <td>{{ $data->cas }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="11">Aucune émission disponible</td>
                                                        </tr>
                                                    @endforelse 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    
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

@section('js')
<script>
    $(function(){
        $('#csv').change(function(){
            $('#csvLabel').html(this.files[0].name)
        })
    })
</script>
@endsection