@extends('admin.main')

@section('css')
    
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
                    <div class="col-lg-7 p-3">
                        <div class="d-block mx-auto">
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date d'annonce : </small> {{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Date butoire : </small> {{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMMM YYYY')) }}</h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant par cas: </small> {{ $cotisation->montant }} francs CFA</h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Nombre de Cas : </small> {{ $cotisation->cas()->count() }}</h3>
                            <h3 class="text-primary mb-1"><small class="text-secondary">Montant par bénéficiaire : </small> {{ $cotisation->montant * $cotisation->cas()->count() }} francs CFA</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 p-3">
                        {{-- <button class="btn btn-info btn-block">Publier</button>
                        <button class="btn btn-success btn-block">Autre</button> --}}
                        <button class="btn btn-secondary btn-block"><i class="fa fa-cogs"></i> Configurer</button>
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