@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Modifier une dépense
@endsection

@section('subtitle')
    Modifier une dépense   
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Formulaire de modification d'une dépense</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                            <form action="{{ route('admin.depense.update',['id' => $depense->id]) }}" method="PUT">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations</h4>
                                    </div>
                                    <div class="form-group mb-0 col-lg-6">
                                        <label for="date_depense">Date de la dépense <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input value="{{ ucwords((new Carbon\Carbon($depense->date_depense))->locale('fr')->isoFormat('DD-MM-YYYY'))}}" class="datepicker-here digits this-bc @error('date_depense') is-invalid @enderror" type="text" data-language="en" placeholder="Date de la dépense *" name="date_depense" required>
                                        </div>
                                        @error('date_depense')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="lib">Désignation <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $depense->lib }}" name="lib" class="form-control @error('lib') is-invalid @enderror" placeholder="Désignation" required>
                                        @error('lib')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="montant">Montant <code class="highlighter-rouge">*</code></label>
                                        <input type="number" value="{{ $depense->montant }}" name="montant" class="form-control @error('montant') is-invalid @enderror" placeholder="Montant" min="0" required>
                                        @error('montant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="id_ordonnateur">Ordonnateur <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('id_ordonnateur') is-invalid @enderror" name="id_ordonnateur" required>
                                            <option selected value="0" disabled>--- Liste des ordonnateurs ---</option>
                                            @if ($depense->id_ordonnateur == 1)
                                                <option  selected value="1">M. Gallaty KOUASSI BI </option>
                                                <option  value="2">Mme Judith N'GUESSAN</option>
                                                <option  value="3">M. Fabrice TCHOMAN</option>
                                            @elseif ($depense->id_ordonnateur == 2)
                                                <option value="1">M. Gallaty KOUASSI BI </option>
                                                <option selected value="2">Mme Judith N'GUESSAN</option>
                                                <option value="3">M. Fabrice TCHOMAN</option>
                                            @elseif ($depense->id_ordonnateur == 3)
                                                <option value="1">M. Gallaty KOUASSI BI </option>
                                                <option value="2">Mme Judith N'GUESSAN</option>
                                                <option selected value="3">M. Fabrice TCHOMAN</option>
                                            @endif
                                        </select>
                                        @error('id_ordonnateur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>         
                                    <div class="form-group col-lg-12">
                                        <label for="observation">Observations</label>
                                        <textarea class="form-control @error('id_ordonnateur') is-invalid @enderror" maxlength="225" rows="3" name="observation" id="maxlength-textarea" placeholder="Saisir vos observations ici">{{ $depense->observation }}</textarea>
                                        @error('observation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="col-lg-4  offset-lg-5">
                                       
                                    <button class="btn btn-primary btn-lg m-1 this-item-bg this-item-bc" type="submit">Mettre à jour</button>
         
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection