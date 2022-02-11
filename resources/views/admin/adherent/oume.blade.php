@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Liste des souscripteurs de OUMÉ
@endsection

@section('subtitle')
    Liste des souscripteurs de OUMÉ
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
                        <h4>Souscripteur(s)</h4>
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
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Date naissance</th>
                                    <th scope="col">statut</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($souscripteurs as $souscripteur)
                                <tr>
                                    <th scope="row"> <a href="{{ route('admin.adhesion.show', ['id' => $souscripteur->id]) }}" class="question_content"> {{ $souscripteur->nom }}</a></th>
                                    <td>{{ $souscripteur->pnom }}</td>
                                    <td>{{ $souscripteur->email }}</td>
                                    <td>{{ $souscripteur->contact }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($souscripteur->date_naiss))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                        
                                    <td><a href="#" style="{{ $souscripteur->status==1 ? '' : 'background-color:red'  }}" class="status_btn" >{{ $souscripteur->status==1 ? 'Actif' : 'Inactif' }}</a></td>
                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.adhesion.show', ['id' => $souscripteur->id]) }}"> <i class="ti-eye"></i> Voir</a>
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