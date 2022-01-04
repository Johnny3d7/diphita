@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Ajouter une dépense
@endsection

@section('subtitle')
    Ajouter une dépense   
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Formulaire d'ajout d'une dépense</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                            <form action="{{ route('admin.depense.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations</h4>
                                    </div>
                                    <div class="form-group mb-0 col-lg-6">
                                        <label for="souscript_dnaiss">Date de la dépense <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('souscript_dnaiss') is-invalid @enderror" type="text" data-language="en" placeholder="Date de la dépense *" name="souscript_dnaiss" required>
                                        </div>
                                        @error('souscript_dnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="souscript_nom">Désignation <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_nom" class="form-control @error('souscript_nom') is-invalid @enderror" placeholder="Désignation" required>
                                        @error('souscript_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="souscript_pnom">Montant <code class="highlighter-rouge">*</code></label>
                                        <input type="number" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Montant" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="souscript_civilite">Ordonnateur <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('souscript_civilite') is-invalid @enderror" name="souscript_civilite" required>
                                            <option selected value="0" disabled>--- Liste des ordonnateurs ---</option>
                                            <option value="1">M. Gallaty KOUASSI BI </option>
                                            <option value="2">Mme Judith N'GUESSAN</option>
                                            <option value="3">M. Fabrice TCHOMAN</option>
                                        </select>
                                        @error('souscript_civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="form-group col-lg-12">
                                        <label for="souscript_lnaiss">Observations <code class="highlighter-rouge">*</code></label>
                                        <textarea class="form-control" maxlength="225" rows="3" name="maxlength-textarea" id="maxlength-textarea" placeholder="Saisir vos observations ici"></textarea>
                                        @error('souscript_lnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="col-lg-2  offset-lg-5">
                                       
                                    <button class="btn btn-primary btn-lg m-1 this-item-bg this-item-bc" type="submit">Ajouter</button>
         
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