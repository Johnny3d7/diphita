@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Cotisations
@endsection

@section('subtitle')
    Cotisations
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="overflow-x: auto; flex-wrap: nowrap;">
            {{-- @for ($i = 2018; $i <= date_format(date_create(), 'Y'); $i++)
                <li class="nav-item">
                    <a class="nav-link {{ $i == date_format(date_create(), 'Y') ? 'active' : '' }}" id="pills-{{ $i }}-tab" data-toggle="pill" href="#pills-{{ $i }}" role="tab" aria-controls="pills-{{ $i }}" aria-selected="true">{{ $i }}</a>
                </li>
            @endfor --}}
                
            @foreach ($cotisations as $key => $cotisation)
                @php $year = $cotisation['year'] @endphp
                <li class="nav-item">
                    <a class="nav-link {{ $year == date_format(date_create(), 'Y') ? 'active' : '' }}" id="pills-{{ $year }}-tab" data-toggle="pill" href="#pills-{{ $year }}" role="tab" aria-controls="pills-{{ $year }}" aria-selected="true">{{ $year }}</a>
                </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link" id="pills-annuelles-tab" data-toggle="pill" href="#pills-annuelles" role="tab" aria-controls="pills-annuelles" aria-selected="true">Annuelles</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            @php $nbreCas = [] @endphp
            @foreach ($cotisations as $key => $cots)
                @php $year = $cots['year']; $cotis = $cots['cotisations'];@endphp
                <div class="tab-pane fade {{ $year == date_format(date_create(), 'Y') ? 'show active' : '' }}" id="pills-{{ $year }}" role="tabpanel" aria-labelledby="pills-{{ $year }}-tab">
                    <div class="row">
                        @foreach ($cotis as $cotisation)
                            @php $nbreCas[$cotisation->code_deces] = rand(0, 20) @endphp
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="white_card position-relative mb_20 ">
                                    <div class="card-body p-0">
                                        <div class="ribbon1 rib1-primary"><span class="text-white text-center rib1-primary">{{ ucwords(Carbon\Carbon::create($cotisation->date_butoire)->locale('fr')->isoFormat('DD MMM')) }}</span></div>
                                        <img src="{{ asset('img/Femme stressé.webp') }}" alt="" class="d-block mx-auto my-3 w-100">
                                        <div class="p-2">
                                            <h6 class="text-info text-center">Annonce du {{ ucwords(Carbon\Carbon::create($cotisation->date_annonce)->locale('fr')->isoFormat('DD MMM YYYY')) }}</h6>
                                            <div class="row my-4">
                                                <div class="col">
                                                    <span class="badge_btn_3  mb-1">{{ $cotisation->code_deces }}</span>
                                                    <a class="f_w_400 color_text_3 f_s_14 d-block">Code Décès</a>
                                                </div>
                                                <div class="col-auto">
                                                    <h4 class="text-dark mt-0">{{ $nbreCas[$cotisation->code_deces] }} <small class="text-muted font-14">Cas</small></h4>
                                                </div>
                                            </div>
                                            <button class="btn_2 btn-block" data-toggle="modal" data-target="#details{{ $cotisation->code_deces }}Modal">Détails</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            {{-- @php $index = 0; @endphp
            @for ($i = 2018; $i <= date_format(date_create(), 'Y'); $i++)
                <div class="tab-pane fade {{ $i == date_format(date_create(), 'Y') ? 'show active' : '' }}" id="pills-{{ $i }}" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        @for ($j = 1; $j <= 12; $j++)
                            @php $index ++; @endphp
                            <div class="col-lg-3 col-md-3">
                                <div class="white_card position-relative mb_20 ">
                                    <div class="card-body p-0">
                                        <div class="ribbon1 rib1-primary"><span class="text-white text-center rib1-primary">{{ ucwords((new Carbon\Carbon(date_create("05-$j-$i")))->addMonths(2)->locale('fr')->isoFormat('DD MMM')) }}</span></div>
                                        <img src="{{ asset('img/Femme stressé.webp') }}" alt="" class="d-block mx-auto my-3 w-100">
                                        <div class="p-2">
                                            <h6 class="text-info text-center">Annonce du {{ date_format(date_create("25-$j-$i"), 'd/m/Y') }}</h6>
                                            <div class="row my-4">
                                                <div class="col">
                                                    <span class="badge_btn_3  mb-1">{{ 'AD-00'.$index }}</span>
                                                    <a class="f_w_400 color_text_3 f_s_14 d-block">Code Décès</a>
                                                </div>
                                                <div class="col-auto">
                                                    <h4 class="text-dark mt-0">{{ rand(0, 99) }} <small class="text-muted font-14">Cas</small></h4>
                                                </div>
                                            </div>
                                            <button class="btn_2 btn-block">Détails</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor --}}
            <div class="tab-pane fade" id="pills-annuelles" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="white_card position-relative mb_20 ">
                            <div class="card-body p-0">
                                <div class="ribbon1 rib1-primary"><span class="text-white text-center rib1-primary">{{ '05 Mars' }}</span></div>
                                <img src="{{ asset('img/Femme stressé.webp') }}" alt="" class="d-block mx-auto my-3 w-100">
                                <div class="p-2">
                                    <h6 class="text-info text-center">Annonce du 25/01/{{ $year }}</h6>
                                    <div class="row my-4">
                                        <div class="col"><span class="badge_btn_3  mb-1">{{ 'AD-0001' }}</span> <a class="f_w_400 color_text_3 f_s_14 d-block">Code Décès</a></div>
                                        <div class="col-auto">
                                            <h4 class="text-dark mt-0">3 <small class="text-muted font-14">Cas</small></h4>

                                        </div>
                                    </div>
                                    <button class="btn_2 btn-block">Détails</button>
                                </div>
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
    @foreach (App\Models\Cotisation::all() as $cotisation)
        @include('admin.cotisation._details')
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