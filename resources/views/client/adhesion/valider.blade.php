@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Liste des adhésions validées
@endsection

@section('subtitle')
    Liste des adhésions validées
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
                        <h4>Adhésions validées</h4>
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
                                @foreach ($adhesions as $adhesion)
                                <tr>
                                    <th scope="row"> <a href="{{ route('admin.adhesion.show', ['id' => $adhesion->id]) }}" class="question_content"> {{ $adhesion->nom }}</a></th>
                                    <td>{{ $adhesion->pnom }}</td>
                                    <td>{{ $adhesion->email }}</td>
                                    <td>{{ $adhesion->contact }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($adhesion->date_naiss))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                        
                                    <td><a href="#" class="status_btn">Validé</a></td>
                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.adhesion.show', ['id' => $adhesion->id]) }}"> <i class="ti-eye"></i> Voir</a>
                                                    
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
    
@endsection