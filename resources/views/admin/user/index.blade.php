@extends('admin.main')

@section('css')
    
@endsection

@section('title')
    Liste des administrateurs
@endsection

@section('subtitle')
    Liste des administrateurs
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
                        <h4>Administrateurs(s)</h4>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                  
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div class="QA_table mb_30">
                        <!-- table-responsive -->
                        <table class="table table_diphita ">
                            <thead>
                                
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">statut</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <th scope="row"> <a href="#" class="question_content"> {{ $admin->name }}</a></th>
                                    <td>{{ $admin->pnom }}</td>
                                    <td>{{ $admin->contact }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->role }}</td>
                    
                                    <td><a href="#" style="{{ $admin->status==1 ? '' : 'background-color:red'  }}" class="status_btn" >{{ $admin->status==1 ? 'Actif' : 'Inactif' }}</a></td>

                                    <td>
                                        <div class="header_more_tool">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                  <i class="ti-more-alt"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    {{-- <a class="dropdown-item" href="route('admin.adhesion.show',['id'=>$souscripteur->id])"> <i class="ti-eye"></i> Gérer les accès</a> --}}
                                                    <a class="dropdown-item" href="{{ route('admin.user.reinitialiser_password', ['id'=>$admin->id]) }}"> <i class="ti-eye"></i> Réinitialiser mot de passe</a>
                                                    @if ($admin->active == 0)
                                                    <a class="dropdown-item" href="{{ route('admin.user.active_account',['id'=>$admin->id]) }}"> <i class="ti-eye"></i> Activer compte</a>
                                                        
                                                    @else
                                                    <a class="dropdown-item" href="{{ route('admin.user.deactive_account',['id'=>$admin->id]) }}"> <i class="ti-eye"></i> Désactiver compte</a> 
                                                    @endif
                                                    {{-- <a class="dropdown-item" href="route('admin.adhesion.show',['id'=>$souscripteur->id])"> <i class="ti-eye"></i> Supprimer compte</a> --}}
                                                    
                                                    
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