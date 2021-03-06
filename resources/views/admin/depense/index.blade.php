@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Historique des dépenses
@endsection

@section('subtitle')
    Historique des dépenses
@endsection

@section('content')
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
                        <h4>Liste des dépenses</h4>
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
                                    <th scope="col">Désignation</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Date dépense</th>
                                    <th scope="col">Ordonnateur</th>
                                    <th scope="col">Observation</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depenses as $depense)
                                <tr>
                                    <td>{{ $depense->lib }}</td>
                                    <td>{{ number_format($depense->montant, 0, '', ' ') }}</td>
                                    <td>{{ ucwords((new Carbon\Carbon($depense->date_depense))->locale('fr')->isoFormat('DD/MM/YYYY')) }}</td>
                                    <td>
                                        @if ($depense->id_ordonnateur == 1)
                                            M. Gallaty KOUASSI BI
                                        @elseif($depense->id_ordonnateur == 2)
                                            Mme Judith N'GUESSAN
                                        @elseif($depense->id_ordonnateur == 3)
                                            M. Fabrice TCHOMAN
                                        @endif
                                    </td>
                                    <td>
                                        @if ($depense->observation == null)
                                            Aucune observation
                                        @else
                                            {{ $depense->observation }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.depense.edit',['id' => $depense->id]) }}"> <i class="ti-pencil"></i> Modifier</a>
                                                    <a class="dropdown-item" href="{{ route('admin.depense.destroy', ['id' => $depense->id]) }}"> <i class="ti-trash"></i> Supprimer</a>
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