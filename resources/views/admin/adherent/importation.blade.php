@php
    $resultsImportation = [
        'Bénéficiaires' => session('resultsBenef'),
        'Souscripteurs' => session('resultsSousc'),
        'AyantDroits' => session('resultsAyant'),
    ];

    // $results = session('resultsSousc');
    // dd($results['errs']);

@endphp

@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
    <style>
        .modal-backdrop {
            /* z-index: -1;
            background-color: aqua; */
        }
    </style>
@endsection

@section('title')
    Importation de contrats
@endsection

@section('subtitle')
    Importation de contrats
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
                                <h3 class="m-0">Etat d'importation de contrats</h3>
                                <div class="col-md-12 text-center mt_15">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            {{-- <h6 class="card-subtitle mb-2">Les champs marqués du signe <code class="highlighter-rouge">(*)</code> sont tous obligatoires.</h6> --}}

                            <div class="col-md-8 offset-md-2">
                                <form id="adherentForm" class="form-horizontal" role="form" method="POST" action="{{ route('admin.adhesion.importationPost') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('csv') ? ' has-error has-feedback' : '' }}">
                                        <label class="form-control my-1" for="csv" id="csvLabel" style="cursor: pointer;">Selectionnez un fichier à importer</label>
                                        <input type="file" name="csv" id="csv" class="form-control d-none" placeholder="Selectionnez un fichier à importer" required="required" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        @if ($errors->has('csv'))
                                            <div class="alert alert-danger alert-dismissible">
                                                <span class="fa fa-remove form-control-feedback"></span>
                                                <span class="help-block"><strong>{{ $errors->first('csv') }}</strong></span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 offset-md-4">
                                        <div class="input-group">
                                            <button id="btnSubmit" type="button" class="btn btn-info btn-block py-2">
                                                <i class="fa fa-3x py-2 fa-upload"></i> <br> <span>Importer</span>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div class="container mt-5">
                                        <h6 class="text-center"><span class="text-uppercase">é</span>tape 1 sur 3</h6>
                                        <h6 class="text-center">(Importation des bénéficiaires)</h6>
                                        <div class="progress progress-md mb-3">
                                            <div class="text-center progress-bar progress-bar-striped progress-bar-animated bg-blue-1" id="myBar" style="width: 0%;">0%</div>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>

                            <div class="row my-3">

                                @foreach ($resultsImportation as $key => $results)
                                    @isset ($results)
                                        <div class="col-md-12">
                                            <div class="alert alert-dismissible alert-{{ count($results["errs"]) > 0 ? 'danger' : (count($results["warns"]) > 0 ? 'warning' : 'success') }}" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h6 class="text-center text-info"><b>{{ $key }}</b></h6>
                                                <h4 class="text-center">{{ $results['msg'] }} <a href="javascript:void(0)" data-toggle="modal" data-target="#importation{{ $key }}Modal">Details <i class="fa fa-info-circle"></i></a></h4>

                                            </div>
                                        </div>
                                    @endisset
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @foreach ($resultsImportation as $key => $results)
        @isset ($results)
            @include('admin.adherent._detailsImportationModal')
        @endisset
    @endforeach
@endsection

@section('js')
<script>
    $(function(){
        $('#csv').change(function(){
            $('#csvLabel').html(this.files[0].name)
        })
        /*
        const element = document.getElementById("myBar");
        let width = 0;
        const id = setInterval(frame, 100);
        function frame() {
            if (width == 10) {
                clearInterval(id);
            } else {
                width++;
                element.style.width = width + '%';
                $(element).html(width+'%')
            }
        }
        */
        $('#btnSubmit').click(function(){
            url = $($(this).parents('form:first')).attr('action');
            file = $('#csv').prop('files')[0];

            var formData = new FormData();

            formData.append("csv", file);
            formData.append("api", true);

            verifyStatus();

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});
            $.ajax({
                url: url, //script qui traitera l'envoi du fichier
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                //Traitements AJAX
                beforeSend: ()=>{
                    // verifyStatus();
                },
                success:(msg)=>{
                    console.log('Success')
                    console.log(msg)
                    // verifyStatus();
                },
                error: ()=>{
                    console.log('error')
                },
                //Données du formulaire envoyé
                //Options signifiant à jQuery de ne pas s'occuper du type de données
            });
            console.log('verify');
        })

        $('#adherentForm').submit(function(e){
            e.preventDefault();
            $this = $(this);

            var file = document.getElementById('csv').files[0];
            var formData = new FormData(document.getElementById('adherentForm'));

            formData.append("csv", file, file.name);
            formData.append("api", true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: $this.attr('action'), //script qui traitera l'envoi du fichier
                type: 'POST',
                // xhr: function() { // xhr qui traite la barre de progression
                //     myXhr = $.ajaxSettings.xhr();
                //     if(myXhr.upload){ // vérifie si l'upload existe
                //         myXhr.upload.addEventListener('progress',afficherAvancement, false); // Pour ajouter l'évènement progress sur l'upload de fichier
                //     }
                //     return myXhr;
                // },
                //Traitements AJAX
                beforeSend: ()=>{
                    // verifyStatus();
                },
                success:(msg)=>{
                    console.log('Success')
                    console.log(msg)
                    verifyStatus();
                },
                error: ()=>{
                    console.log('error')
                },
                //Données du formulaire envoyé
                data: formData,
                //Options signifiant à jQuery de ne pas s'occuper du type de données
                cache: false,
                contentType: false,
                processData: false
            });
        });

        // function verifyStatut() async {
        //     const { data } = await axios.get('/import-status');

        //     if (data.finished) {
        //         this.current_row = this.total_rows
        //         this.progress = 100
        //         return;
        //     };

        //     this.total_rows = data.total_rows;
        //     this.current_row = data.current_row;
        //     this.progress = Math.ceil(data.current_row / data.total_rows * 100);
        //     this.trackProgress();
        // }

        function verifyStatus(count = 0) {
            count++;
            let statut;

            $.ajax({
                url: "{{ route('admin.verifyStatus') }}",
                type: 'GET',
                success: function(res){
                    console.log(res);
                    if(res.statut != "Terminé" && count < 10) verifyStatus(count);
                    // if(res.current_row <= res.total_rows) verifyStatus();
                }
            });
        }

        function afficherAvancement(e){
            if(e.lengthComputable){
                $('progress').attr({value:e.loaded,max:e.total});
            }
        }
    })
</script>
@endsection

@php
session()->forget(['resultsBenef', 'resultsSousc', 'resultsAyant']);
@endphp
