@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Modifier mon mot de passe
@endsection

@section('subtitle')
    Modifier mon mot de passe 
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
                                    <h3 class="m-0">Formulaire de modification du mot de passe</h3>
                                    <div class="col-md-12 text-center ">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                                <form action="{{ route('admin.user.update_password') }}" method="any">
                                    @csrf
                                    @method('ANY')
                                    <div class="form-row">
                                        <div class="col-12 mt_30 mb_15">
                                            <h4 class="m-0 txt-color1 txt-upper txt-bold">Mot de passe</h4>
                                        </div>
                                    
                                        <div class="form-group col-lg-12">
                                            <label for="old_password">Ancien mot de passe <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Ancien mot de passe" required>
                                            @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="new_password">Nouveau mot de passe <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Nouveau mot de passe" required>
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="confirm_password">Confirmation du mot de passe <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirmation du nouveau mot de passe" required>
                                            @error('confirm_password')
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