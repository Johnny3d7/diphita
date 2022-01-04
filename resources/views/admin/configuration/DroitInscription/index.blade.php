@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Configuration de montant
@endsection

@section('subtitle')
    Configuration du montant Droit d'inscription     
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
                                <h3 class="m-0">Modifier le montant droit d'inscription</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Veuillez saisir le montant <code class="highlighter-rouge">sans espacement</code>.</h6>
                            <form action="{{ route('admin.droit-inscription.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    
                                    <div class="form-group col-lg-12">
                                        <label for="montant">Montant <code class="highlighter-rouge">*</code></label>
                                        <input type="number" name="montant" class="form-control @error('montant') is-invalid @enderror" placeholder="Ex: 2500" required min="100">
                                        @error('montant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>            
                                </div>
                    
                                <div class="col-lg-8 offset-lg-3">
                                       
                                    <button class="btn btn-primary btn-lg m-1 this-item-bg this-item-bc" type="submit">Mettre à jour</button>
                                           
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="white_card card_height_100 mb_30 user_crm_wrapper">
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="single_crm ">
                                <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between" >
                                    <div class="thumb">
                                        <img src="{{ url('img/crm/customer.svg') }}" alt="">
                                    </div>
                                    <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                </div>
                                
                             
                                    @if ($montant_actuel == null)
                                        <div class="crm_body">
                                            <h4>Aucun montant</h4>
                                            <p>Montant actuel</p>
                                        </div>
                                    @else
                                        <div class="crm_body">
                                            <h4>{{ $montant_actuel->montant }} Fcfa</h4>
                                            <p>Montant actuel</p>
                                        </div> 
                                    @endif
                           
                                
                                
                            </div>
                        </div>
                      
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Tableau</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Historique des montants fixés</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            {{-- <form Active="#">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Search content here...">
                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="add_button ml-10">
                                        <a href="#" data-toggle="modal" data-target="#addcategory" class="btn_1">Add New</a>
                                    </div> --}}
                                </div>
                            </div>
        
                            <div class="QA_table mb_30">
                                <!-- table-responsive -->
                                <table class="table display nowrap table-striped table_diphita">
                                    <thead>
                                        
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Montant</th>
                                            <th scope="col">Date ajout</th>
                                            <th scope="col">statut</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($montant_story as $mtt)
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> {{ $mtt->id }}</a></th>
                                            <td>{{ $mtt->montant }} Fcfa</td>
                                            <td>{{ ucwords((new Carbon\Carbon($mtt->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            @if ($mtt->status == 1)
                                                <td><a href="#" class="status_btn">Actif</a></td>
                                                
                                            @else
                                                <td><a href="#" class="status_btn" style="background-color: red">Non actif</a></td>
                                            @endif
                                        </tr>     
                                       @endforeach
                                        
                                       
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Formulaire d'ajout d'un adhérent</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6>
                            <form action="{{ route('admin.adhesion.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Souscripteur</h4>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_civilite">Civilité <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('souscript_civilite') is-invalid @enderror" name="souscript_civilite" required>
                                            <option selected value="0" disabled>--- Civilité du souscripteur ---</option>
                                            <option value="1">M. </option>
                                            <option value="2">Mme</option>
                                            <option value="3">Mlle</option>
                                        </select>
                                        @error('souscript_civilite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_nom">Nom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_nom" class="form-control @error('souscript_nom') is-invalid @enderror" placeholder="Nom du souscripteur" required>
                                        @error('souscript_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_pnom">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_pnom" class="form-control @error('souscript_pnom') is-invalid @enderror" placeholder="Prénom(s) du souscripteur" required>
                                        @error('souscript_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_lnaiss">Lieu de naissance <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_lnaiss" class="form-control @error('souscript_lnaiss') is-invalid @enderror" placeholder="Lieu de naissance du souscripteur" required>
                                        @error('souscript_lnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="souscript_dnaiss">Date de naissance <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('souscript_dnaiss') is-invalid @enderror" type="text" data-language="en" placeholder="Date de naissance *" name="souscript_dnaiss" required>
                                        </div>
                                        @error('souscript_dnaiss')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_lhab">Lieu de résidence <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_lhab" class="form-control @error('souscript_lhab') is-invalid @enderror" placeholder="Lieu de résidence du souscripteur" required>
                                        @error('souscript_lhab')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_contact">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_contact" class="form-control @error('souscript_contact') is-invalid @enderror" placeholder="Numéro de téléphone du souscripteur" required data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask>
                                        @error('souscript_contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_email">Email</label>
                                        <input type="email" name="souscript_email" class="form-control @error('souscript_email') is-invalid @enderror" placeholder="Email du souscripteur">
                                        @error('souscript_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_ncni">Numéro CNI <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="souscript_ncni" class="form-control @error('souscript_ncni') is-invalid @enderror" placeholder="Numéro CNI du souscripteur" required>
                                        @error('souscript_ncni')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 mt_30 mb_15 pr_0 pl_0">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaires</h4>
                                    <span>Vous pouvez inscrire au plus <code class="highlighter-rouge">5 personnes</code> y compris le souscripteur.</span>
                                </div>
                                <div class="form-row pr_0 pl_0" id="benef_bloc">
                                    
                                        <div id="benef-title-0" class="col-lg-12 mb_15">
                                            <h6 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaire N°1</h6>
                                        </div>
                                        <div class="form-group col-lg-4 benef_civilite" id="benef-civilite-0">
                                            <label for="benef_civilite[]">Civilité <code class="highlighter-rouge">*</code></label>
                                            <select class="form-control @error('benef_civilite[]') is-invalid @enderror" name="benef_civilite[]" required>
                                                <option selected value="0" disabled>--- Civilité du bénéficiaire ---</option>
                                                <option value="1">M. </option>
                                                <option value="2">Mme</option>
                                                <option value="3">Mlle</option>
                                            </select>
                                            @error('benef_civilite[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-4" id="benef-nom-0">
                                            <label for="benef_nom[]">Nom <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="benef_nom[]" class="form-control @error('benef_nom[]') is-invalid @enderror" placeholder="Nom du bénéficiaire" required>
                                            @error('benef_nom[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-4" id="benef-pnom-0">
                                            <label for="benef_pnom[]">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="benef_pnom[]" class="form-control @error('benef_pnom[]') is-invalid @enderror" placeholder="Prénom(s) du bénéficiaire" required>
                                            @error('benef_pnom[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-4" id="benef-lnaiss-0">
                                            <label for="benef_lnaiss[]">Lieu de naissance <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="benef_lnaiss[]" class="form-control @error('benef_lnaiss[]') is-invalid @enderror" placeholder="Lieu de naissance du bénéficiaire" required>
                                            @error('benef_lnaiss[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-0 col-lg-4" id="benef-dnaiss-0" >
                                            <label for="benef_dnaiss[]">Date de naissance <code class="highlighter-rouge">*</code></label>
                                            <div class="common_date_picker">
                                                <input class="datepicker-here digits this-bc @error('benef_dnaiss[]') is-invalid @enderror" type="text" data-language="en" placeholder="Date de naissance *" name="benef_dnaiss[]" required>
                                            </div>
                                            @error('benef_dnaiss[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-3" id="benef-ncni-0">
                                            <label for="benef_ncni[]">Numéro CNI <code class="highlighter-rouge">*</code></label>
                                            <input type="text" name="benef_ncni[]" class="form-control @error('benef_ncni[]') is-invalid @enderror" placeholder="Numéro CNI du souscripteur" required>
                                            @error('benef_ncni[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <div id="benef-supbloc-${$i}" class="col-lg-1 ">
                                            <label style="opacity: 0;"> Sup <code class="highlighter-rouge">*</code></label>
                                            <button onclick="supprimer(event)" id="benef-sup-${$i}" type="button" class="btn mb-3 btn-danger"><i class="ti-trash f_s_14"></i></button>
                                        </div> 
                                    
                                </div>
                                <div class="col-12 mt_15 pl_0">
                                    <button type="button" id="benef_btn" class="btn mb-3 btn-success"><i class="ti-plus f_s_14 mr-2"></i>Ajouter</button>
                                </div>
                                <div class="col-12 mt_30 mb_15 pr_0 pl_0">
                                    <h4 class="m-0 txt-color1 txt-upper txt-bold">Ayants-droit</h4>
                                    <span>Inscrivez <code class="highlighter-rouge">3 noms et contacts</code> d'ayants-droit.</span>
                                </div>
                                <div class="form-row pr_0 pl_0" id="ayant_bloc">
                                    <div id="ayant-title-0" class="col-lg-12 mb_15">
                                        <h6 class="m-0 txt-color1 txt-upper txt-bold">Ayant-droit N°1</h6>
                                    </div> 
                                    <div class="form-group col-lg-4 ayant_civilite" id="ayant-civilite-0">
                                        <label for="ayant_civilite[]">Civilité <code class="highlighter-rouge">*</code></label>
                                        <select class="form-control @error('ayant_civilite[]') is-invalid @enderror" name="ayant_civilite[]" required>
                                            <option selected value="0" disabled>--- Civilité de l'ayant-droit ---</option>
                                            <option value="1">M. </option>
                                            <option value="2">Mme</option>
                                            <option value="3">Mlle</option>
                                        </select>
                                        @error('ayant_civilite[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4" id="ayant-nom-0">
                                        <label for="ayant_nom[]">Nom <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="ayant_nom[]" class="form-control @error('ayant_nom[]') is-invalid @enderror" placeholder="Nom de l'ayant-droit" required>
                                        @error('ayant_nom[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4" id="ayant-pnom-0">
                                        <label for="ayant_pnom[]">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="ayant_pnom[]" class="form-control @error('ayant_pnom[]') is-invalid @enderror" placeholder="Prénom(s) de l'ayant-droit" required>
                                        @error('ayant_pnom[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4" id="ayant-contact-0">
                                        <label for="ayant_contact[]">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="ayant_contact[]" class="form-control ayantdroit_tel @error('ayant_contact[]') is-invalid @enderror" placeholder="Numéro de téléphone de l'ayant-droit" required data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask required>
                                        @error('ayant_contact[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div id="ayant-space-0" class="col-lg-8">
                                        <div class="common_input mb_15">
                                            
                                        </div>
                                    </div>
                                    {{-- <div id="ayant-supbloc-${$j}" class="col-lg-1">
                                        <label  style="opacity: 0;"> Sup <code class="highlighter-rouge">*</code></label>
                                        <button onclick="supprimer_ayant(event)" id="ayant-sup-${$j}" type="button" class="btn mb-3 btn-danger"><i class="ti-trash f_s_14"></i></button>
                                    </div> 
                                    
                                </div>
                                <div class="col-12 mt_15 pl_0">
                                    <button type="button" id="ayant_btn" class="btn mb-3 btn-success"><i class="ti-plus f_s_14 mr-2"></i>Ajouter</button>
                                </div>
                                {{-- <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                        Check me out
                                        </label>
                                    </div>
                                </div> 
                                <div class="col-lg-2  offset-lg-5">
                                       
                                    <button class="btn btn-primary btn-lg m-1 this-item-bg this-item-bc" type="submit">Valider</button>
                                           
                                     
                                        
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("").dataTable({
        });
    });
</script>
@endsection