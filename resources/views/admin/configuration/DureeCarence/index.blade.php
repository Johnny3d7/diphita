@extends('admin.main')

@section('css')
    <link rel="stylesheet" href="{{ url('css/main.css') }}" />
@endsection

@section('title')
    Nombre de mois de carence
@endsection

@section('subtitle')
    Configuration du nombre de mois de carence     
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
                                <h3 class="m-0">Modifier la durée de carence</h3>
                                <div class="col-md-12 text-center mt_15">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Veuillez saisir la durée de carence (Mois) <code class="highlighter-rouge">sans espacement</code>.</h6>
                            <form action="{{ route('admin.duree-carence.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    <div class="form-group col-lg-12">
                                        <label for="duree">Durée <code class="highlighter-rouge">*</code></label>
                                        <input type="number" name="duree" class="form-control @error('duree') is-invalid @enderror" placeholder="Ex: 5" required max="12" min="1">
                                        @error('duree')
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
                                
                             
                                    @if ($duree_actuel == null)
                                        <div class="crm_body">
                                            <h4>Aucune durée</h4>
                                            <p>Durée actuelle</p>
                                        </div>
                                    @else
                                        <div class="crm_body">
                                            <h4>{{ $duree_actuel->duree }} Mois de carence</h4>
                                            <p>Durée actuelle</p>
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
                                <h4>Historique des durées de carence</h4>
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
                                            <th scope="col">Durée</th>
                                            <th scope="col">Date ajout</th>
                                            <th scope="col">statut</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($duree_story as $duree)
                                        <tr>
                                            <th scope="row"> <a href="#" class="question_content"> {{ $duree->id }}</a></th>
                                            <td>{{ $duree->duree }} Mois de carence</td>
                                            <td>{{ ucwords((new Carbon\Carbon($duree->created_at))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                            @if ($duree->status == 1)
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