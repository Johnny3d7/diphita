@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Créer un cas à assister
@endsection

@section('subtitle')
    Créer un cas à assister   
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
                                <h3 class="m-0">Formulaire de création d'un cas à assiter</h3>
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
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Souscripteur</h4>
                                    </div>
                        
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_nom">Numéro d'identification <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_nom" class="form-control @error('souscript_nom') is-invalid @enderror" placeholder="Numéro d'identification" required>
                                        @error('souscript_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_pnom">Nom & Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Nom & Prénom(s)" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_pnom">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Contact" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaires</h4>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_nom">Numéro d'identification <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('souscript_civilite') is-invalid @enderror" name="souscript_civilite" required>
                                            <option selected value="0" disabled>--- Sélectionnez un bénéficiaire ---</option>
                                            <option value="1">DIP010812B000074 </option>
                                            <option value="2">DIP010817B000045</option>
                                        </select>
                                        @error('souscript_civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_pnom">Nom  <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Nom" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_pnom">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Prénom(s)" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_dnaiss">Date de décès <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('souscript_dnaiss') is-invalid @enderror" type="text" data-language="en" placeholder="Date de décès *" name="souscript_dnaiss" required>
                                        </div>
                                        @error('souscript_dnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_pnom">Lieu de décès <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Lieu de décès" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_dnaiss">Date des obsèques <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('souscript_dnaiss') is-invalid @enderror" type="text" data-language="en" placeholder="Date des obsèques *" name="souscript_dnaiss" required>
                                        </div>
                                        @error('souscript_dnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations générales</h4>
                                    </div>
                                   
                                    <div class="form-group col-lg-6">
                                        <label for="souscript_dnaiss">Date d'assistance <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('souscript_dnaiss') is-invalid @enderror" type="text" data-language="en" placeholder="Date d'assistance *" name="souscript_dnaiss" required>
                                        </div>
                                        @error('souscript_dnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="souscript_nom">Moyen d'assistance <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('souscript_civilite') is-invalid @enderror" name="souscript_civilite" required>
                                            <option selected value="0" disabled>--- Sélectionnez un moyen de paiement ---</option>
                                            <option value="1">Espèces </option>
                                            <option value="2">Chèque</option>
                                            <option value="1">Virement </option>
                                            <option value="2">Dépôt électronique</option>
                                        </select>
                                        @error('souscript_civilite')
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