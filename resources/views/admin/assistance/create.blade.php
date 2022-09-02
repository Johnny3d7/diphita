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
                            <form action="{{ route('admin.assistance.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    <div class="col-12 mt_30 mb_15">
                                        <h4 class="m-0 txt-color1 txt-upper txt-bold"> <a href="{{ route('admin.adhesion.show',['id' => $adherent->id]) }}" style="color: inherit; text-decoration: inherit;">Souscripteur</a></h4>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="souscript_num">Numéro d'identification <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $adherent->num_adhesion }}" readonly name="souscript_num" class="form-control @error('souscript_num') is-invalid @enderror" placeholder="Numéro d'identification" required>
                                        <input type="text" value="{{ $adherent->id }}" readonly name="souscript_id" style="display: none"  required>
                                        @error('souscript_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">

                                        <label for="souscript_nom">Nom & Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{ $adherent->nom.' '.$adherent->pnom }}" readonly name="souscript_nom" class="form-control @error('souscript_nom') is-invalid @enderror" placeholder="Nom & Prénom(s)" required>
                                        @error('souscript_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="souscript_contact">Contact <code class="highlighter-rouge">*</code></label>
                                        <input type="text" value="{{$adherent->contact }}" readonly name="souscript_contact" class="form-control @error('souscript_contact') is-invalid @enderror" placeholder="Contact" required>
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
                                        <select id="id_beneficiaire" class="form-control select2 @error('benef_num') is-invalid @enderror" name="benef_num" required>
                                            <option {{ isset($beneficiaire) ? '': 'selected'}}  value="0" disabled>--- Sélectionnez un bénéficiaire ---</option>
                                            @if ($adherent->is_not_cas() && $adherent->is_not_in_assistance())
                                                <option value="{{$adherent->num_adhesion}}">{{$adherent->num_adhesion}} </option>
                                            @endif

                                            @forelse ($adherent->beneficiaires() as $benef)
                                                @if ($benef->is_not_cas() && $benef->is_not_in_assistance())
                                                    <option {{ isset($beneficiaire) && $beneficiaire->id == $benef->id ? 'selected': '' }} value="{{$benef->num_adhesion}}">{{$benef->num_adhesion}}  </option>
                                                @endif
                                            @empty

                                            @endforelse

                                        </select>
                                        <input type="text" readonly value="{{ isset($beneficiaire) ? $beneficiaire->id : '' }}" name="benef_id" id="benef_id" style="display: none" required>
                                        @error('benef_num')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="benef_nom">Nom  <code class="highlighter-rouge">*</code></label>
                                        <input type="text" readonly id="benef_nom" value="{{ isset($beneficiaire) ? $beneficiaire->nom : '' }}" name="benef_nom" class="form-control @error('benef_nom') is-invalid @enderror" placeholder="Nom" required>
                                        @error('benef_nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="benef_pnom">Prénom(s) <code class="highlighter-rouge">*</code></label>
                                        <input type="text" readonly id="benef_pnom" value="{{ isset($beneficiaire) ? $beneficiaire->pnom : '' }}" name="benef_pnom" class="form-control @error('benef_pnom') is-invalid @enderror" placeholder="Prénom(s)" required>
                                        @error('benef_pnom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="date_deces">Date de décès <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('date_deces') is-invalid @enderror" type="text" data-language="en" placeholder="Date de décès *" name="date_deces" required>
                                        </div>
                                        @error('date_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="lieu_deces">Lieu de décès <code class="highlighter-rouge">*</code></label>
                                        <input type="text" name="lieu_deces" class="form-control @error('lieu_deces') is-invalid @enderror" placeholder="Lieu de décès" required>
                                        @error('lieu_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="date_obseques">Date des obsèques <code class="highlighter-rouge">*</code></label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('date_obseques') is-invalid @enderror" type="text" data-language="en" placeholder="Date des obsèques *" name="date_obseques" required>
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

                                    <div class="form-group col-lg-4">
                                        <label for="date_assistance">Date d'assistance </label>
                                        <div class="common_date_picker">
                                            <input class="datepicker-here digits this-bc @error('date_assistance') is-invalid @enderror" type="text" data-language="en" placeholder="Date d'assistance *" name="date_assistance">
                                        </div>
                                        @error('date_assistance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="moyen_assistance">Moyen d'assistance</label>
                                        <select id="moyen_paie" class="form-control @error('moyen_assistance') is-invalid @enderror" name="moyen_assistance" >
                                            <option selected value="0" disabled>-- Sélectionnez moyen de paiement --</option>
                                            <option value="Espèces">Espèces</option>
                                            <option value="Chèque">Chèque</option>
                                            <option value="Virement">Virement </option>
                                            <option value="Dépôt électronique">Dépôt électronique</option>
                                        </select>
                                        @error('moyen_assistance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div id="bloc_insert" class="form-group col-lg-4">

                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="enfant_defunt">Nom d'un enfant du défunt </label>
                                        <input type="text" name="enfant_defunt" class="form-control @error('enfant_defunt') is-invalid @enderror" placeholder="Nom et prénom(s)" >
                                        @error('enfant_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="enfant_contact">Contact de cet enfant du défunt</label>
                                        <input type="text" name="enfant_contact" class="form-control @error('enfant_contact') is-invalid @enderror" placeholder="Numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask>
                                        @error('enfant_contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="proche_defunt">Nom d'un proche du défunt</label>
                                        <input type="text" name="proche_defunt" class="form-control @error('proche_defunt') is-invalid @enderror" placeholder="Nom et prénom(s)">
                                        @error('proche_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="proche_contact">Contact de ce proche du défunt</label>
                                        <input type="text" name="proche_contact" class="form-control @error('proche_contact') is-invalid @enderror" placeholder="Numéro de téléphone" data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask>
                                        @error('proche_contact')
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
<script>
    $('[data-mask]').inputmask();
</script>
<script>
    $('#id_beneficiaire').on('change', function() {
            //console.log(e);

        let num_adhesion = $(this).val();

        $('#benef_nom').empty();
        $('#benef_pnom').empty();
        $('#benef_nom').val(`Chargement...`);
        $('#benef_pnom').val(`Chargement...`);

        $.ajax({
                type: 'GET',
                url: '/admin/get-benef-info/' + num_adhesion,
                success: function(response) {
                    var response = JSON.parse(response);
                        //console.log(response['id']);
                        $('#benef_nom').val(response['nom']);
                        $('#benef_pnom').val(response['pnom']);
                        $('#benef_id').attr("value",response['id']);

                }
            });
    });

    $('#moyen_paie').on('change', function() {

        console.log('bonjour');
        switch($(this).val()) {

        case 'Chèque':
            $('#bloc_insert').empty();
            $('#bloc_insert').append(`
                                        <label for="num_cheque">Numéro de chèque </label>
                                        <input type="text" name="num_cheque" class="form-control @error('num_cheque') is-invalid @enderror" placeholder="Saisir le numéro de chèque" >
                                        @error('num_cheque')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
            `);
            break;
        case 'Virement':
            $('#bloc_insert').empty();
            $('#bloc_insert').append(`
                                        <label for="num_compte">Numéro de compte </label>
                                        <input type="text" name="num_compte" class="form-control @error('num_compte') is-invalid @enderror" placeholder="Saisir le numéro de compte" >
                                        @error('num_compte')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
            `);
            break;
        case 'Dépôt électronique':
            $('#bloc_insert').empty();
            $('#bloc_insert').append(`
                                        <label for="num_depot">Numéro de téléphone du dépôt</label>
                                        <input type="text" name="num_depot" class="form-control @error('num_depot') is-invalid @enderror" placeholder="Saisir le numéro de téléphone " data-inputmask='"mask": "+(225) 99-99-99-99-99"' data-mask>
                                        @error('num_depot')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
            `);
            $('[data-mask]').inputmask();
            break;
        default:
            $('#bloc_insert').empty();

}

    });

</script>
@endsection
