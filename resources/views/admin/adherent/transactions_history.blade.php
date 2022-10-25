@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Historique de Transactions
@endsection

@section('subtitle')
    Historique de Transaction {{ $souscripteur->nom }} {{ $souscripteur->pnom }}
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

                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <div class="container-fluid">
                                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab-transaction" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-success-transaction-tab" data-toggle="pill" href="#pills-success-transaction" role="tab" aria-controls="pills-success-transaction" aria-selected="true">Cotisations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-warning-transaction-tab" data-toggle="pill" href="#pills-warning-transaction" role="tab" aria-controls="pills-warning-transaction" aria-selected="false">Versements</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-errors-transaction-tab" data-toggle="pill" href="#pills-errors-transaction" role="tab" aria-controls="pills-errors-transaction" aria-selected="false">Toutes</a>
                                    </li>
                                </ul>

                                <div class="tab-content" style="overflow-x: auto;">
                                    <div class="tab-pane fade show active" id="pills-success-transaction" role="tabpanel" aria-labelledby="success-tab">
                                        @if (count($souscripteur->reglements()) > 0)
                                            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita">
                                                <thead>
                                                    <tr>
                                                        <th>Date - heure</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Montant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($souscripteur->reglements()->sortByDesc('created_at') as $reglement)
                                                    <tr>
                                                        <td>{{ ucwords((new Carbon\Carbon($reglement->created_at))->locale('fr')->isoFormat('DD MMM YYYY à HH:mm')) }}</td>
                                                        <td>{{ $reglement->type }}</td>
                                                        <td>{{ $reglement->description }}</td>
                                                        <td>{{ $reglement->montant }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <h6 class="text-center">Aucun règlement</h6>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="pills-warning-transaction" role="tabpanel" aria-labelledby="warning-tab">
                                        @if (count($souscripteur->versements()) > 0)
                                            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita">
                                                <thead>
                                                    <tr>
                                                        <th>Date - heure</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Montant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($souscripteur->versements()->sortByDesc('created_at') as $versement)
                                                    <tr>
                                                        <td>{{ ucwords((new Carbon\Carbon($versement->created_at))->locale('fr')->isoFormat('DD MMM YYYY à HH:mm')) }}</td>
                                                        <td>{{ $versement->type ?? 'Versement' }}</td>
                                                        <td>{{ $versement->description }}</td>
                                                        <td>{{ $versement->montant }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <h6 class="text-center">Aucun versement</h6>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="pills-errors-transaction" role="tabpanel" aria-labelledby="errors-tab">
                                        @if (count($souscripteur->transactions()) > 0)
                                            <table class="table table-striped table-colored-bordered table-bordered-info table_diphita">
                                                <thead>
                                                    <tr>
                                                        <th>Date - heure</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Montant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($souscripteur->transactions()->sortByDesc('created_at') as $transaction)
                                                    <tr>
                                                        <td>{{ ucwords((new Carbon\Carbon($transaction->created_at))->locale('fr')->isoFormat('DD MMM YYYY à HH:mm')) }}</td>
                                                        <td>{{ $transaction->type ?? 'Versement' }}</td>
                                                        <td>{{ $transaction->description }}</td>
                                                        <td>{{ $transaction->montant }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <h6 class="text-center">Aucune transaction</h6>
                                        @endif
                                    </div>
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
    @include('admin.adherent._versementModal')
@endsection

@section('js')
@endsection
