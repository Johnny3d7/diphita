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
                                        {{-- @if ($errors->has('csv'))
                                            <div class="container">
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                                <span class="help-block"><strong>{{ $errors->first('csv') }}</strong></span>
                                            </div>
                                        @endif --}}
                                    </div>
                                    <div class="col-md-4 offset-md-4">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-success btn-block py-2"><i class="fa fa-3x py-2 fa-upload"></i> <br> <span>Importer</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="row">
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
                                    @if (count($results['contrats']) > 0)
                                        <div class="row">
                                            <div class="col-md-12 m-t-10">
                                                <table id="datatable-buttons"
                                                    class="table table-striped table-colored-bordered table-bordered-info">
                                                    <thead>
                                                    <tr>
                                                        <th rowspan="2">N°</th>
                                                        <th rowspan="2">Date d'émission</th>
                                                        <th rowspan="2">Compagnie</th>
                                                        <th rowspan="2">N° Police</th>
                                                        <th rowspan="2">N° Emission</th>
                                                        <th rowspan="2">Client</th>
                                                        <th rowspan="2">Effet</th>
                                                        <th rowspan="2">Echéance</th>
                                                        <th rowspan="2">Risque</th>
                                                        <th rowspan="2">Prime nette</th>
                                                        <th rowspan="2">Acc</th>
                                                        <th rowspan="2">Taxes</th>
                                                        <th rowspan="2">FGA</th>
                                                        <th rowspan="2">Prime TTC</th>
                                                        <th colspan="2">Commissions</th>
                                                        <th rowspan="2">Statut</th>
                                                        <th rowspan="2">Ajouté le</th>
                                                        <th rowspan="2">Ajouté par</th>
                                                    </tr>
                                                    <tr>
                                                        <th>%</th>
                                                        <th>Montant</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($results['contrats'] as $key => $contrat)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ date('d/m/Y',strtotime($contrat->date_emission)) }}</td>
                                                            <td>{{ $contrat->nom_compagnie }}</td>
                                                            <td>{{ $contrat->numero_police }}</td>
                                                            <td>{{ $contrat->numero_emission }}</td>
                                                            <td>{{ $contrat->nom_client.' '.$contrat->prenom_client.' '.$contrat->raison_sociale }}</td>
                                                            <td>{{ date('d/m/Y',strtotime($contrat->effet)) }}</td>
                                                            <td>{{ date('d/m/Y',strtotime($contrat->echeance)) }}</td>
                                                            <td>{{ $contrat->nom_risque }}</td>
                                                            <td>{{ number_format($contrat->prime_nette,0,',',' ') }}</td>
                                                            <td>{{ number_format($contrat->frais_accessoire,0,',',' ') }}</td>
                                                            <td>{{ number_format($contrat->taxe,0,',',' ') }}</td>
                                                            <td>{{ number_format($contrat->fga,0,',',' ') }}</td>
                                                            <td>{{ number_format($contrat->prime_ttc,0,',',' ') }}</td>
                                                            <td>{{ ($contrat->prime_ttc <> 0) ? round($contrat->commission / $contrat->prime_ttc * 100, 2) . '%' : '0%' }}</td>
                                                            <td>{{ number_format($contrat->commission,0,',',' ') }}</td>
                                                            <td>
                                                                @if($contrat->statut == 0 and $contrat->etat == 0)
                                                                    <span class="label label-danger">non soldé</span>
                                                                @elseif($contrat->statut == 1 and $contrat->etat == 0)
                                                                    <span class="label label-success">prime soldé</span>
                                                                @else
                                                                    <span class="label label-warning">contrat résilié</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ date('d/m/Y à H:i:s', strtotime($contrat->created_at)) }}</td>
                                                            <td>{{ $contrat->prenom_user.' '.$contrat->nom_user }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="18">Aucune émission disponible</td>
                                                        </tr>
                                                    @endforelse 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    
                                @endisset
                            </div> --}}
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