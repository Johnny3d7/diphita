@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Modification de {{ $ayant->nom.' '.$ayant->pnom }}
@endsection

@section('subtitle')
    Modifier un bénéficiaire  
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
                                <h3 class="m-0">Modifier les informations de {{ $ayant->nom.' '.$ayant->pnom }}</h3>
                            </div>
                            <span class="float-right">
                                <a href="{{ route("admin.adhesion.show",['id'=>$ayant->id_adherent]) }}" class="btn btn-warning text-light"><i class="ti-arrow-circle-left"></i> Retour au contrat</a>
                            </span>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                            <form action="{{ route('admin.ayantdroit.update',['ayant'=>$ayant->id]) }}" method="PUT">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations Ayant Droit</h4>
                                    </div>
                                    <div class="form-group col-lg-4 ayant_civilite" id="ayant-civilite-0">
                                        <label for="civilite">Civilité <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('civilite') is-invalid @enderror" name="civilite" required>
                                            <option  value="0" disabled>--- Civilité du bénéficiaire ---</option>
                                            <option {{ $ayant->civilite == "M" ? 'selected' : '' }} value="M">M. </option>
                                            <option {{ $ayant->civilite == "Mme" ? 'selected' : '' }} value="Mme">Mme</option>
                                            <option {{ $ayant->civilite == "Mlle" ? 'selected' : '' }} value="Mlle">Mlle</option>
                                        </select>
                                        @error('civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="nom">Nom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $ayant->nom }}" name="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Saisir le nom" required>
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="pnom">Prénoms <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $ayant->pnom }}" name="pnom" class="form-control @error('pnom') is-invalid @enderror" placeholder="Saisir le prénom" required>
                                        @error('pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="contact">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $ayant->contact }}" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Saisir le numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask required>
                                        @error('contact')
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