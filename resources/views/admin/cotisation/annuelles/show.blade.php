@extends('admin.main')

@section('css')
    
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
                    <div class="col-lg-6 p-3">
                        <div class="d-block mx-auto">
                            @php $ref = 2000; @endphp
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date de cotisation : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_cotis)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date d'annonce : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date butoire : </small> <span class="float-right">{{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</span></h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant par bénéficiaire : </small> <span class="float-right">{{ $cotisation->montant }} francs CFA</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-2 offset-lg-1 p-3">
                        {{-- <button class="btn btn-info btn-block">Publier</button>
                        <button class="btn btn-success btn-block">Autre</button> --}}
                        <button class="btn btn-secondary btn-block"data-toggle="modal" data-target="#configuration{{ $cotisation->annee_cotis }}Modal">
                            <i class="fa fa-cogs"></i> Configurer
                        </button>
                    </div>
                </div>
                @include('admin.cotisation._navDetails')
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @foreach ($cotisation->souscripteurs() as $souscripteur)
        @include('admin.cotisation._reglementModal')
    @endforeach
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // $('.nav-link:first()').click();
            $("").dataTable({
            });
        });
    </script>
@endsection