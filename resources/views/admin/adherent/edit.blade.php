@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Modification de {{ $souscripteur->nom_pnom() }}
@endsection

@section('subtitle')
    Modifier un souscripteur  
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
                                <h3 class="m-0">Modifier les informations de {{ $souscripteur->nom_pnom() }}</h3>
                            </div>
                            <span class="float-right">
                                <a href="{{ route("admin.adhesion.show",['id'=>$souscripteur->id]) }}" class="btn btn-warning text-light"><i class="ti-arrow-circle-left"></i> Retour au contrat</a>
                            </span>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                            <form action="{{ route('admin.souscripteur.update',['id'=>$souscripteur->id]) }}" method="PUT">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Souscripteur</h4>
                                    </div>
                                    <div class="form-group col-lg-4 ayant_civilite" id="ayant-civilite-0">
                                        <label for="civilite">Civilité <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('civilite') is-invalid @enderror" name="civilite" required>
                                            <option  value="0" disabled>--- Civilité de l'ayant-droit ---</option>
                                            <option {{ $souscripteur->civilite == 1 ? 'selected' : '' }} value="1">M. </option>
                                            <option {{ $souscripteur->civilite == 2 ? 'selected' : '' }} value="2">Mme</option>
                                            <option {{ $souscripteur->civilite == 3 ? 'selected' : '' }} value="3">Mlle</option>
                                        </select>
                                        @error('civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="nom">Nom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $souscripteur->nom }}" name="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Saisir le nom" required>
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="pnom">Prénom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $souscripteur->pnom }}" name="pnom" class="form-control @error('pnom') is-invalid @enderror" placeholder="Saisir le prénom" required>
                                        @error('pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="date_naiss">Date de naissance <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input value="{{ ucwords((new Carbon\Carbon($souscripteur->date_naiss))->locale('fr')->isoFormat('DD-MM-YYYY')) }}" class="datepicker-here digits this-bc @error('date_naiss') is-invalid @enderror" type="text" data-language="en" placeholder="Date de naissance *" name="date_naiss" required>
                                        </div>
                                        @error('date_naiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="lieu_naiss">Lieu de naissance <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $souscripteur->lieu_naiss }}" name="lieu_naiss" class="form-control @error('lieu_naiss') is-invalid @enderror" placeholder="Saisir le lieu de naissance" required>
                                        @error('lieu_naiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="num_cni">Numéro de CNI <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $souscripteur->num_cni }}" name="num_cni" class="form-control @error('num_cni') is-invalid @enderror" placeholder="Saisir le numéro de cni" required>
                                        @error('num_cni')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="lieu_hab">Lieu de résidence <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $souscripteur->lieu_hab }}" name="lieu_hab" class="form-control @error('lieu_hab') is-invalid @enderror" placeholder="Saisir le lieu de résidence svp" required>
                                        @error('lieu_hab')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="contact">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $souscripteur->contact }}" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Saisir le numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask required>
                                        @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4 mb_30">
                                        <label for="email">Email</label>
                                        <input type="text" value="{{ $souscripteur->email }}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Saisir l'adresse Email">
                                        @error('email')
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