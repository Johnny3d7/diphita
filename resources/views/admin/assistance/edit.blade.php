@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Modifier le cas {{ $assistance->beneficiaire->nom_pnom() }}
@endsection

@section('subtitle')
    Modifier un cas   
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
                            <form action="{{ route('admin.assistance.update',['id'=>$assistance->id]) }}" method="put">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold"> <a href="{{ route('admin.adhesion.show',['id' => $assistance->adherent->id]) }}" style="color: inherit; text-decoration: inherit;">Souscripteur</a></h4>
                                    </div>
                        
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_num">Numéro d'identification <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $assistance->adherent->num_adhesion }}" readonly name="souscript_num" class="form-control @error('souscript_num') is-invalid @enderror" placeholder="Numéro d'identification" required>
                                        <input type="text" value="{{ $assistance->adherent->id }}" readonly name="souscript_id" style="display: none"  required>
                                        @error('souscript_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">

                                        <label for="souscript_nom">Nom & Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $assistance->adherent->nom.' '.$assistance->adherent->pnom }}" readonly name="souscript_nom" class="form-control @error('souscript_nom') is-invalid @enderror" placeholder="Nom & Prénom(s)" required>
                                        @error('souscript_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_contact">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{$assistance->adherent->contact }}" readonly name="souscript_contact" class="form-control @error('souscript_contact') is-invalid @enderror" placeholder="Contact" required>
                                        @error('souscript_contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Bénéficiaires</h4>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        
                                        <label for="benef_num">Numéro d'identification <code class="highlighter-rouge">*</code></label>
                                        <select id="id_beneficiaire" class="form-control @error('benef_num') is-invalid @enderror" name="benef_num" required>
                                            <option selected value="0" disabled>--- Sélectionnez un bénéficiaire ---</option>

                                            @if ($assistance->adherent->is_not_cas())
                                                <option {{ $assistance->adherent->id == $assistance->id_benef ? 'selected' : '' }} value="{{$assistance->adherent->num_adhesion}}">{{$assistance->adherent->num_adhesion}} </option>
                                            @endif
                                            
                                            @forelse ($assistance->adherent->beneficiaires() as $benef)

                                                @if ($benef->is_not_cas())
                                                    <option {{ $benef->id == $assistance->id_benef ? 'selected' : '' }}  value="{{$benef->num_adhesion}}">{{$benef->num_adhesion}}  </option>
                                                @endif 
                                            @empty
                                                
                                            @endforelse
                               
                                        </select>
                                        <input type="text" readonly name="benef_id" value="{{ $assistance->beneficiaire->id }}" id="benef_id" style="display: none" required>
                                        @error('benef_num')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="benef_nom">Nom  <code class="highlighter-rouge">*</code></label>
                                        <input type="text" readonly id="benef_nom" name="benef_nom" class="form-control @error('benef_nom') is-invalid @enderror" placeholder="Nom" required>
                                        @error('benef_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="benef_pnom">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" readonly id="benef_pnom" name="benef_pnom" class="form-control @error('benef_pnom') is-invalid @enderror" placeholder="Prénom(s)" required>
                                        @error('benef_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="date_deces">Date de décès <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input value="{{ ucwords((new Carbon\Carbon($assistance->date_deces ))->locale('fr')->isoFormat('DD-MM-YYYY')) }}" class="datepicker-here digits this-bc @error('date_deces') is-invalid @enderror" type="text" data-language="en" placeholder="Date de décès *" name="date_deces" required>
                                        </div>
                                        @error('date_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="lieu_deces">Lieu de décès <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $assistance->lieu_deces }}" name="lieu_deces" class="form-control @error('lieu_deces') is-invalid @enderror" placeholder="Lieu de décès" required>
                                        @error('lieu_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="date_obseques">Date des obsèques <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input value="{{ ucwords((new Carbon\Carbon($assistance->date_obseques ))->locale('fr')->isoFormat('DD-MM-YYYY')) }}" class="datepicker-here digits this-bc @error('date_obseques') is-invalid @enderror" type="text" data-language="en" placeholder="Date des obsèques *" name="date_obseques" required>
                                        </div>
                                        @error('date_obseques')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold">Informations générales</h4>
                                    </div>
                                   
                                    <div class="form-group col-lg-6">
                                        <label for="date_assistance">Date d'assistance </label>
                                        <div class="common_date_picker">
                                            <input value="{{ ucwords((new Carbon\Carbon($assistance->date_assistance ))->locale('fr')->isoFormat('DD-MM-YYYY')) }}" class="datepicker-here digits this-bc @error('date_assistance') is-invalid @enderror" type="text" data-language="en" placeholder="Date d'assistance *" name="date_assistance">
                                        </div>
                                        @error('date_assistance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="moyen_assistance">Moyen d'assistance</label>
                                        <select class="form-control @error('moyen_assistance') is-invalid @enderror" name="moyen_assistance" >
                                            <option  value="0" disabled>--- Sélectionnez un moyen de paiement ---</option>
                                            <option {{ $assistance->moyen_assistance == 1 ? 'selected' : '' }} value="1">Espèces </option>
                                            <option {{ $assistance->moyen_assistance == 2 ? 'selected' : '' }} value="2">Chèque</option>
                                            <option {{ $assistance->moyen_assistance == 3 ? 'selected' : '' }} value="3">Virement </option>
                                            <option {{ $assistance->moyen_assistance == 4 ? 'selected' : '' }} value="4">Dépôt électronique</option>
                                        </select>
                                        @error('moyen_assistance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="enfant_defunt">Nom d'un enfant du défunt </label>
                                        <input type="text" value="{{ $assistance->enfant_defunt }}" name="enfant_defunt" class="form-control @error('enfant_defunt') is-invalid @enderror" placeholder="Nom et prénom(s)" >
                                        @error('enfant_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="enfant_contact">Contact de cet enfant du défunt</label>
                                        <input type="text" value="{{ $assistance->enfant_contact }}" name="enfant_contact" class="form-control @error('enfant_contact') is-invalid @enderror" placeholder="Numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask>
                                        @error('enfant_contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="proche_defunt">Nom d'un proche du défunt</label>
                                        <input type="text" value="{{ $assistance->proche_defunt }}" name="proche_defunt" class="form-control @error('proche_defunt') is-invalid @enderror" placeholder="Nom et prénom(s)">
                                        @error('proche_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="proche_contact">Contact de ce proche du défunt</label>
                                        <input type="text" name="proche_contact" value="{{ $assistance->proche_contact }}" class="form-control @error('proche_contact') is-invalid @enderror" placeholder="Numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask>
                                        @error('proche_contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-3  offset-lg-5">
                                       
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
<script>
    $('[data-mask]').inputmask();
</script>
<script>
    $('#id_beneficiaire').on('change', function() {

        get_nom_pnom($(this).val());

    });

    $( document ).ready(function() {

        get_nom_pnom($('#id_beneficiaire').val());
        
    });
        
    function get_nom_pnom(num_adhe){
        $('#benef_nom').empty();
        $('#benef_pnom').empty();
        $('#benef_nom').val(`Chargement...`);
        $('#benef_pnom').val(`Chargement...`);
        
        $.ajax({
                type: 'GET',
                url: '/admin/get-benef-info/' + num_adhe,
                success: function(response) {
                    var response = JSON.parse(response);
                        //console.log(response['id']);
                        $('#benef_nom').val(response['nom']);
                        $('#benef_pnom').val(response['pnom']);
                        $('#benef_id').attr("value",response['id']);
                        
                }
            });
    }

</script>
@endsection