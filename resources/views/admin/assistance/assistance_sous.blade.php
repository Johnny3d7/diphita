@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Liste des assistances
@endsection

@section('subtitle')
    Liste des assistances
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0"><a style="color: inherit; text-decoration: inherit;" class="unstyled-a" href="">Tableau</a></h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>Assistances</h4>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
    
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
                                    <th scope="col">Nom & Prénom(s)</th>
                                    <th scope="col">Date de décès</th>
                                    <th scope="col">Souscripteur</th>
                                    <th scope="col">Contact Souscripteur</th>
                                    <th scope="col">Assisté</th>
                                    <th scope="col">Statut</th>
                                   
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assistances as $assistance)
                                <tr>
                                    <td>{{ $assistance->beneficiaire->nom.' '.$assistance->beneficiaire->pnom }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($assistance->date_deces))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    
                                    <td>
                                        <a href="{{ route('admin.adhesion.show',['id'=>$souscripteur->id]) }}">{{ $assistance->souscripteur->nom.' '.$assistance->souscripteur->pnom }}</a>
                                    </td>
                                    <td>
                                        {{ $assistance->souscripteur->contact }}
                                    </td>
                                    <td>
                                        {{ $assistance->assiste == 1 ? 'Oui': 'Non' }}
                                    </td>
                                    <td>
                                        @if ($assistance->valide == 0)
                                            <a href="#" class="status_btn" style="background-color: #101038">En cours de validation</a>
                                        @elseif ($assistance->valide == 1)
                                            <a href="#" class="status_btn">Validée</a>
                                        @elseif ($assistance->valide == 2)
                                            <a href="#" class="status_btn" style="background-color: red">Rejetée</a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.assistance.show',['id' => $assistance->id]) }}"> <i class="fas fa-eye"></i> Voir</a>
                                                    <a class="dropdown-item" href="{{ route('admin.assistance.edit',['id' => $assistance->id]) }}"> <i class="ti-pencil"></i> Modifier</a>
                                                    {{-- <a class="dropdown-item" href="{{ route('admin.depense.destroy', ['id' => $assistance->id]) }}"> <i class="ti-trash"></i> Supprimer</a> --}}
                                                    
                                                  {{-- <a class="dropdown-item" href="{{ route('admin.adhesion.rejeter', ['id' => $souscripteur->id]) }}"> <i class="ti-trash"></i> Rejeter</a> --}}
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