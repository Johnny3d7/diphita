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
    <small>Détails de cotisation exceptionnelle</small> {{ $cotisation->code_deces }}
@endsection

@section('subtitle')
    <small>Détails de cotisation exceptionnelle</small> {{ $cotisation->code_deces }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_body">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 p-3">
                        <img src="{{ asset($cotisation->image) }}" alt="" class="d-block mx-auto w-100 rounded">
                    </div>
                    <div class="col-lg-5 p-3">
                        <div class="d-block mx-auto">
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date d'annonce : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date butoire : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant par cas: </small> <span class="float-right">{{ $cotisation->montant }} francs CFA</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Nombre de Cas : </small> <span class="float-right">{{ $cotisation->cas()->count() }} cas</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant par bénéficiaire : </small> <span class="float-right">{{ $cotisation->montant * $cotisation->cas()->count() }} francs CFA</span></h3>
                            {{-- <h3 class="text-primary mt-3 mb-1"><small class="text-secondary">Montant Total : </small> <span class="float-right">{{ $cotisation->montant_total() }} francs CFA</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant collecté : </small> <span class="float-right">{{ $cotisation->montant_collecte() }} francs CFA</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant a recouvrer : </small> <span class="float-right">{{ $cotisation->montant_total() - $cotisation->montant_collecte() }} francs CFA</span></h3> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 border mb-3 rounded">
                        <div id="placeholder" class="chartsh"></div>
                        <h4 class="text-primary mb-3"><small class="text-secondary">Montant Total : </small> <span class="float-right">{{ $cotisation->montant_total() }} francs CFA</span></h4>
                        {{-- <button class="btn btn-info btn-block">Publier</button>
                        <button class="btn btn-success btn-block">Autre</button> --}}
                        {{-- <button class="btn btn-secondary btn-block"><i class="fa fa-cogs"></i> Configurer</button> --}}
                        {{-- <div class="col-xl-6"> --}}
                            {{-- <div class="white_box mb_30">
                                <div class="box_header ">
                                    <div class="main-title">
                                        <h3 class="mb-0"> Pie Chart</h3>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <canvas style="height: 250px" id="pieChart"></canvas> --}}
                        {{-- </div> --}}
                    </div>
                </div>
                @include('admin.cotisation._navDetails')
            </div>
        </div>
    </div>    

</div>
{{-- @include('admin.cotisation._navDetails') --}}
@endsection

@section('modals')
    @foreach ($cotisation->souscripteurs() as $souscripteur)
        @include('admin.cotisation._reglementModal')
        @include('admin.adherent._versementModal', ['id' => ($cotisation->type == 'annuelle' ? $cotisation->annee_cotis : $cotisation->code_deces) . $souscripteur->num_adhesion])
    @endforeach
@endsection

@section('js')

    <!-- C3 CHART JS  -->
    <script src="{{ asset('vendors/sash/plugins/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ asset('vendors/sash/plugins/charts-c3/c3-chart.js') }}"></script>
    <!-- FLOT JS -->
    {{-- <script src="{{ asset('vendors/sash/js/flot.js') }}"></script> --}}
    <script src="{{ asset('vendors/sash/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendors/sash/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('vendors/sash/plugins/flot/jquery.flot.pie.js') }}"></script>

    <script>
        $(function () {
            // for (var t = [], a = Math.floor(4 * Math.random()) + 3, i = 0; i < a; i++) t[i] = { label: "Series" + (i + 1), data: Math.floor(100 * Math.random()) + 1 };
            data= [
                {
                    "label": "Collecté",
                    "data": '{{ $cotisation->montant_collecte() }}'
                },
                {
                    "label": "A Recouvrer",
                    "data": '{{ $cotisation->montant_total() - $cotisation->montant_collecte() }}'
                }
            ];
            var o = $("#placeholder");
                o.unbind(),
                $.plot(o, data, { 
                    series: { 
                        pie: { show: !0 },
                    }, 
                    colors: ["#09ad95", "#f82649", "#6c5ffc", "#05c3fb", "#1170e4"], 
                    legend: { show: !1 } 
                });
                
        });
    </script>
    <script>
        $(document).ready(function () {
            $("").dataTable({
            });

            let collecte = '{{ $cotisation->montant_collecte() }}';
            let recouvrer = '{{ $cotisation->montant_total() - $cotisation->montant_collecte() }}';

            let pieLabel0 = $('#pieLabel0').find('div:first')
            let pieLabel1 = $('#pieLabel1').find('div:first')

            $(pieLabel0).append(`<br>${collecte} Fcfa`)
            $(pieLabel1).append(`<br>${recouvrer} Fcfa`)

            $(pieLabel0).css({'font-size':'15px', 'background-color':'white'})
            $(pieLabel1).css({'font-size':'15px', 'background-color':'white'})
            $($(pieLabel1).parent()).css({'top':'10px', 'left':'10px'})
            $($(pieLabel0).parent()).css({'top':'10px', 'left':'auto', 'right':'10px'})
        });
    </script>
@endsection