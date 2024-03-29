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
    <small>Détails de cotisation de l'année</small> {{ $cotisation->annee_cotis }}
@endsection

@section('subtitle')
    <small>Détails de cotisation de l'année</small> {{ $cotisation->annee_cotis }}
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
                            @php $ref = 2000; @endphp
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date de cotisation : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_cotis)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date d'annonce : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date butoire : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant par bénéficiaire : </small> <span class="float-right">{{ number_format($cotisation->montant, 0, ',', ' ') }} francs CFA</span></h3>
                            {{-- <h3 class="text-primary mt-3 mb-1"><small class="text-secondary">Montant Total : </small> <span class="float-right">{{ $cotisation->montant_total() }} francs CFA</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant collecté : </small> <span class="float-right">{{ $cotisation->montant_collecte() }} francs CFA</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant a recouvrer : </small> <span class="float-right">{{ $cotisation->montant_total() - $cotisation->montant_collecte() }} francs CFA</span></h3> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 mb-3 border rounded">
                        @php
                            $collected = $cotisation->montant_collecte();
                            $to_collect = $cotisation->montant_total() - $cotisation->montant_collecte();
                        @endphp
                        <div id="placeholder" class="chartsh" data-fields='[{"label":"Collecté","data":{{ $collected }}},{"label":"A recouvrer","data":{{ $to_collect }}}]'></div>
                        <h4 class="text-primary mb-3"><small class="text-secondary">Montant Total : </small> <span class="float-right">{{ number_format($cotisation->montant_total(), 0, ',', ' ') }} francs CFA</span></h4>
                        {{-- <button class="btn btn-info btn-block">Publier</button>
                        <button class="btn btn-success btn-block">Autre</button>
                        <button class="btn btn-secondary btn-block"data-toggle="modal" data-target="#configuration{{ $cotisation->annee_cotis }}Modal">
                            <i class="fa fa-cogs"></i> Configurer
                        </button> --}}
                    </div>
                </div>
                @include('admin.cotisation._navDetails')
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @include('admin.cotisation._reglementModalJS')
    @include('admin.cotisation._versementModalJS')
    {{-- @foreach ($cotisation->souscripteurs() as $souscripteur)
        @include('admin.cotisation._reglementModal')
        @include('admin.adherent._versementModal', ['id' => ($cotisation->type == 'annuelle' ? $cotisation->annee_cotis : $cotisation->code_deces) . $souscripteur->num_adhesion])
    @endforeach --}}
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
            // data= [
            //     {
            //         "label": "Collecté",
            //         "data": '{{ $cotisation->montant_collecte() }}'
            //     },
            //     {
            //         "label": "A Recouvrer",
            //         "data": '{{ $cotisation->montant_total() - $cotisation->montant_collecte() }}'
            //     }
            // ];
            // var o = $("#placeholder");
            //     o.unbind(),
            //     $.plot(o, data, {
            //         series: {
            //             pie: { show: !0 },
            //         },
            //         colors: ["#09ad95", "#f82649", "#6c5ffc", "#05c3fb", "#1170e4"],
            //         legend: { show: !1 }
            //     });


        });
    </script>
    <script>
        $(document).ready(function () {
            ajaxDiphita();
        });
    </script>
@endsection
