@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Ajouter un ayant-droit 
@endsection

@section('subtitle')
    Ajouter un ayant-droit  
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
                                <h3 class="m-0">Formulaire d'ajout d'un ayant-droit</h3>
                            </div>
                            <span class="float-right">
                                <a href="{{ route("admin.adhesion.show",['id'=>$sous]) }}" class="btn btn-warning text-light"><i class="ti-arrow-circle-left"></i> Retour au contrat</a>
                            </span>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                            <form action="{{ route('admin.ayantdroit.store',['sous'=>$sous]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations</h4>
                                    </div>
                                    <div class="form-group col-lg-4 ayant_civilite" id="ayant-civilite-0">
                                        <label for="civilite">Civilité <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('civilite') is-invalid @enderror" name="civilite" required>
                                            <option value="0" selected disabled>--- Civilité de l'ayant droit ---</option>
                                            <option value="M">M. </option>
                                            <option value="Mme">Mme</option>
                                            <option value="Mlle">Mlle</option>
                                        </select>
                                        @error('civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="nom">Nom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Saisir le nom" required>
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="pnom">Prénom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="pnom" class="form-control @error('pnom') is-invalid @enderror" placeholder="Saisir le prénom" required>
                                        @error('pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="contact">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Saisir le numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask required>
                                        @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="col-lg-4  offset-lg-5">
                                       
                                    <button class="btn btn-primary btn-lg m-1 this-item-bg this-item-bc" type="submit">Valider</button>
         
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