@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Modifier mes informations
@endsection

@section('subtitle')
    Modifier mes informations
@endsection

@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">

                <div class="col-md-6 col-lg-6">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Formulaire de modification </h3>
                                    <div class="col-md-12 text-center ">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                                <form action="{{ route('admin.user.update_infos') }}" method="any">
                                    @csrf
                                    @method('ANY')
                                    <div class="form-row">
                                        <div class="col-12 mt_30 mb_15">
                                            <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations</h4>
                                        </div>
                                    
                                        <div class="form-group col-lg-12">
                                            <label for="nom">Nom <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="nom" value="{{ $user->name }}" class="form-control @error('nom') is-invalid @enderror" placeholder="Entrez votre nom " required>
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="pnom">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="pnom" value="{{ $user->pnom }}" class="form-control @error('pnom') is-invalid @enderror" placeholder="Ancien mot de passe" required>
                                            @error('pnom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="contact">Contact <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="contact" value="{{ $user->contact }}" class="form-control @error('contact') is-invalid @enderror" placeholder="Nouveau mot de passe" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask required>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="email">Email<code class="highlighter-rouge">*</code></label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Confirmation du nouveau mot de passe">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6  offset-lg-4">
                                           
                                        <button class="btn btn-primary btn-lg m-1 this-item-bg this-item-bc" type="submit">Mettre à jour</button>
             
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!--end col-->
           
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection