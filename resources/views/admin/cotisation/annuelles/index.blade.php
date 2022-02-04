@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Cotisations annuelles
@endsection

@section('subtitle')
    Cotisations annuelles
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="row">
            @forelse($cotisations as $cotisation)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="white_card position-relative mb_20 ">
                        <div class="card-body p-0">
                            <div class="ribbon1 rib1-primary"><span class="text-white text-center rib1-primary">{{ $cotisation->annee_cotis }}</span></div>
                            <img src="{{ asset($cotisation->image) }}" alt="" class="d-block mx-auto my-3 w-100">
                            <div class="p-2">
                                <h6 class="text-info text-center">Date de cotisation : {{ ucwords(Carbon\Carbon::create($cotisation->date_cotis)->locale('fr')->isoFormat('DD MMM YYYY')) }}</h6>
                                <button class="btn_2 btn-block" data-toggle="modal" data-target="#details{{ $cotisation->annee_cotis }}Modal">Détails</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center">Aucune cotisation !</h5>
            @endforelse     
        </div>
    </div>
</div>
@endsection

@section('modals')
    @foreach (App\Models\Cotisation::selectAll('annuelles') as $cotisation)
        @include('admin.cotisation.annuelles._details')
        @include('admin.cotisation.annuelles._configuration')
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