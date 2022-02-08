@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Liste des cas 
@endsection

@section('subtitle')
    Liste des cas 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
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
                        <h4>Cas</h4>
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
                        <table class="table table_diphita ">
                            <thead>
                                
                                <tr>
                                    <th scope="col">Nom et Prénoms Défunt</th>
                                    <th scope="col">Date de dècès</th>
                                    <th scope="col">Lieu de décès</th>
                                    <th scope="col">Souscripteur</th>
                                    <th scope="col">Code Décès</th>
                                    <th scope="col">statut</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assistances as $assistance)
                                <tr>
                                    <th scope="row"> <a href="{{ route('admin.adherent.formulaire-print',['id'=>$assistance->beneficiaire->id]) }}" class="question_content"> {{ $assistance->beneficiaire->nom_pnom() }}</a></th>
                                    <td>{{ ucwords((new Carbon\Carbon($assistance->date_deces))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td>{{ $assistance->lieu_deces }}</td>
                                    <td>   <a href="{{ route('admin.adhesion.show',['id'=>$assistance->adherent->id]) }}">{{ $assistance->adherent->nom_pnom() }}</a></td>
                                    <td>{{ $assistance->code_deces ?? "Non défini" }}</td>
                        
                                    <td><a href="#" class="status_btn" style="{{ $assistance->assiste == 0 ? 'background-color:orangered' : '' }}" >{{ $assistance->assiste == 0 ? 'Non assisté' : 'Assisté' }}</a></td>
                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.assistance.show', ['id' => $assistance->id]) }}"> <i class="ti-eye"></i> Voir</a>
                                                    @if (!$assistance->code_deces)
                                                    <a class="dropdown-item" href="{{ route('admin.assistance.publier',['id' => $assistance->id]) }}">
                                                        <i class="ti-money"></i> Attribuer Code Décès
                                                    </a>
                                                    @endif
                                                    {{-- <a class="dropdown-item" href="{{ route('admin.adhesion.valider', ['id' => $souscripteur->id]) }}"> <i class="fas fa-edit"></i> Valider</a>
                                                    
                                                  <a class="dropdown-item" href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"> <i class="ti-trash"></i> Rejeter</a> --}}
                                                </div>
                                              </div>
                                        </div>
                                    </td>
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("").dataTable({
            });
        });
    </script>
@endsection