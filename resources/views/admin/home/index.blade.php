@extends('admin.main')

@section('css')
    <style>
        .chartsh {
            height: 16rem;
            overflow: hidden;
            width: 100%;
        }
    </style>
@endsection

@section('title')
    Tableau de bord
@endsection

@section('subtitle')
    Tableau de bord
@endsection

@section('content')
<div class="row ">
    <div class="col-xl-4">
        <div class="white_card mb_30 card_height_100">
            <div class="white_card_header">
                <div class="row align-items-center justify-content-between flex-wrap">
                    <div class="col-lg-8">
                        <div class="main-title">
                            <h3 class="m-0">Cotisations Exceptionnelles</h3>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right d-flex justify-content-end">
                        <select class="nice_Select2 max-width-220" >
                            <option value="1">Show by month</option>
                            <option value="1">Show by year</option>
                            <option value="1">Show by day</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                @php
                    $collected = $cotisation_exp->montant_collecte();
                    $to_collect = $cotisation_exp->montant_total() - $cotisation_exp->montant_collecte();
                @endphp
                <div id="point_exceptionnel" class="chartsh" data-fields='[{"label":"Collecté","data":{{ $collected }}},{"label":"A recouvrer","data":{{ $to_collect }}}]'></div>
                <h4 class="text-primary mb-3"><small class="text-secondary">Montant Total : </small> <span class="float-right">{{ number_format($cotisation_exp->montant_total(), 0, ',', ' ') }} francs CFA</span></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="white_card mb_30 card_height_100">
            <div class="white_card_header">
                <div class="row align-items-center justify-content-between flex-wrap">
                    <div class="col-lg-8">
                        <div class="main-title">
                            <h3 class="m-0">Cotisations annuelles</h3>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right d-flex justify-content-end">
                        <select class="nice_Select2 max-width-220" >
                            <option value="1">Show by month</option>
                            <option value="1">Show by year</option>
                            <option value="1">Show by day</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                @php
                    $collected = $cotisation_an->montant_collecte();
                    $to_collect = $cotisation_an->montant_total() - $cotisation_an->montant_collecte();
                @endphp
                <div id="point_annuel" class="chartsh" data-fields='[{"label":"Collecté","data":{{ $collected }}},{"label":"A recouvrer","data":{{ $to_collect }}}]'></div>
                <h4 class="text-primary mb-3"><small class="text-secondary">Montant Total : </small> <span class="float-right">{{ number_format($cotisation_an->montant_total(), 0, ',', ' ') }} francs CFA</span></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-4 ">
        <div class="white_card card_height_100 mb_30 user_crm_wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single_crm">
                        <div class="crm_head d-flex align-items-center justify-content-between" >
                            <div class="thumb">
                                <img src="{{ url('img/crm/businessman.svg') }}" alt="">
                            </div>
                            <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                        </div>
                        <div class="crm_body">
                            <h4>{{ $data->nbre_souscripteurs }}</h4>
                            <p>Souscripteur(s)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single_crm ">
                        <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between" >
                            <div class="thumb">
                                <img src="{{ url('img/crm/customer.svg') }}" alt="">
                            </div>
                            <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                        </div>
                        <div class="crm_body">
                            <h4>{{ $data->nbre_beneficiaires }}</h4>
                            <p>Bénéficiaire(s)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single_crm">
                        <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between" >
                            <div class="thumb">
                                <img src="{{ url('img/crm/infographic.svg') }}" alt="">
                            </div>
                            <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                        </div>
                        <div class="crm_body">
                            <h4>{{ number_format($data->point_caisse, 0, ',', ' ')  }} FCFA</h4>
                            <p>Point de la caisse</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single_crm">
                        <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between" >
                            <div class="thumb">
                                <img src="{{ url('img/crm/sqr.svg') }}" alt="">
                            </div>
                            <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                        </div>
                        <div class="crm_body">
                            <h4>{{ number_format($data->point_depense, 0, ',', ' ')  }} FCFA</h4>
                            <p>Point des dépenses</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="single_crm">
                        <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between" >
                            <div class="thumb">
                                <img src="{{ url('img/crm/sqr.svg') }}" alt="">
                            </div>
                            <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                        </div>
                        <div class="crm_body">
                            <h4>{{ number_format($data->point_depense, 0, ',', ' ')  }} FCFA</h4>
                            <p>Point des dépenses</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single_crm">
                        <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between" >
                            <div class="thumb">
                                <img src="{{ url('img/crm/infographic.svg') }}" alt="">
                            </div>
                            <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                        </div>
                        <div class="crm_body">
                            <h4>{{ number_format($data->point_caisse, 0, ',', ' ')  }} FCFA</h4>
                            <p>Point de la caisse</p>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="crm_reports_bnner">
                <div class="row justify-content-end ">
                    <div class="col-lg-6">
                        <h4>Create CRM Reports</h4>
                        <p>Outlines keep you and honest
                            indulging honest.</p>
                        <a href="#">Read More <i class="fas fa-arrow-right"></i> </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="col-xl-6">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="main-title">
                            <h3 class="m-0">Paiement de cotisations</h3>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row justify-content-end">
                            <div class="col-lg-8 d-flex justify-content-end">
                                <select class="nice_Select2 wide" >
                                    <option value="1">Show by All</option>
                                    <option value="1">Show by A</option>
                                    <option value="1">Show by B</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="apex-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="main-title">
                            <h3 class="m-0">Assistances de cas</h3>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row justify-content-end">
                            <div class="col-lg-8 d-flex justify-content-end">
                                <select class="nice_Select2 wide" >
                                    <option value="1">Show by All</option>
                                    <option value="1">Show by A</option>
                                    <option value="1">Show by B</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white_card_body ">
                <div class="apex-chart" data-series='["Annuelles", "Exceptionnelles"]'></div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="white_card card_height_100 mb_20 ">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Cas à assister</h3>
                    </div>
                    <div class="header_more_tool">
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                              <i class="ti-more-alt"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                              <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                              <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                              <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                              <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="white_card_body QA_section">
                <div class="QA_table ">
                    <!-- table-responsive -->
                    <table class="table lms_table_active2 p-0">
                        <thead>
                            <tr>
                                <th scope="col">Nom et Prénoms Défunt</th>
                                <th scope="col">Date de dècès</th>
                                <th scope="col">Lieu de décès</th>
                                <th scope="col">Souscripteur</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assistances as $assistance)
                                <tr>
                                    <th scope="row"> <a href="{{ route('admin.adherent.formulaire-print',['id'=>$assistance->beneficiaire->id]) }}" class="question_content"> {{ $assistance->beneficiaire->nom_pnom() }}</a></th>
                                    <td>{{ ucwords((new Carbon\Carbon($assistance->date_deces))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td>{{ $assistance->lieu_deces }}</td>
                                    <td>   <a href="{{ route('admin.adhesion.show',['id'=>$assistance->adherent->id]) }}">{{ $assistance->adherent->nom_pnom() }}</a></td>
                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.assistance.show', ['id' => $assistance->id]) }}"> <i class="ti-eye"></i> Voir</a>
                                                    @if (!$assistance->code_deces)
                                                    <a class="dropdown-item" href="{{ route('admin.assistance.publier',['id' => $assistance->id]) }}">
                                                        <i class="ti-money"></i> Attribuer Code Décès
                                                    </a>
                                                    @endif
                                                    {{-- <a class="dropdown-item" href="{{ route('admin.adhesion.valider', ['id' => $souscripteur->id]) }}"> <i class="fas fa-edit"></i> Valider</a>

                                                  <a class="dropdown-item" href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"> <i class="ti-trash"></i> Rejeter</a> --}}
                                                </div>
                                              </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <p class="text-center">Aucune donnée</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card custom-card">
            <div class="card-header">
                <img class="img-fluid" src="{{ asset('img/tilt/4.jpg') }}" alt="" data-original-title="" title="">
            </div>
            <div class="card-profile">
                <img class="rounded-circle" src="{{ asset('img/'.auth()->user()->image_name.'.png') }}" alt="" data-original-title="" title="">
            </div>
            <div class="text-center profile-details">
                <h4>{{ auth()->user()->nom_pnom() }}</h4>
                <h6>Super Admin</h6>
                <a class="btn btn-primary" href="{{ route('admin.user.show_profile') }}"><i class="fa fa-eye"></i> Voir mon profil</a>
            </div>
            {{-- <div class="card-footer row">
                <div class="col-4 col-sm-4">
                    <h6>Follower</h6>
                    <h3 class="counter">9564</h3>
                </div>
                <div class="col-4 col-sm-4">
                    <h6>Following</h6>
                    <h3><span class="counter">49</span>K</h3>
                </div>
                <div class="col-4 col-sm-4">
                    <h6>Total Post</h6>
                    <h3><span class="counter">96</span>M</h3>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('js')

<!-- C3 CHART JS  -->
<script src="{{ asset('vendors/sash/plugins/charts-c3/d3.v5.min.js') }}"></script>
<script src="{{ asset('vendors/sash/plugins/charts-c3/c3-chart.js') }}"></script>
<!-- Apex CHART JS  -->
<script src="{{ asset('vendors/apex_chart/apexcharts.js') }}"></script>
<!-- FLOT JS -->
{{-- <script src="{{ asset('vendors/sash/js/flot.js') }}"></script> --}}
<script src="{{ asset('vendors/sash/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('vendors/sash/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('vendors/sash/plugins/flot/jquery.flot.pie.js') }}"></script>

<script>
    $(function () {
        // for (var t = [], a = Math.floor(4 * Math.random()) + 3, i = 0; i < a; i++) t[i] = { label: "Series" + (i + 1), data: Math.floor(100 * Math.random()) + 1 };


    });
</script>
<script>
    $(document).ready(function () {


        $('.apex-chart').each(function(){
            $this = $(this);
            // apex_3
            var options = {
                series: [
                    {
                        name: 'series1',
                        data: [31, 51, 28, 42, 109, 40, 100]
                    }, {
                        name: 'series2',
                        data: [11, 34, 32, 32, 45, 52, 41]
                    }
                ],
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        "2018-09-19T00:00:00.000Z",
                        "2018-09-19T01:30:00.000Z",
                        "2018-09-19T02:30:00.000Z",
                        "2018-09-19T03:30:00.000Z",
                        "2018-09-19T04:30:00.000Z",
                        "2018-09-19T05:30:00.000Z",
                        "2018-09-19T06:30:00.000Z"
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(this, options);
            chart.render();
        })
    })
</script>
@endsection
