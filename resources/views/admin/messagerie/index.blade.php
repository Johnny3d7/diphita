@extends('admin.main')

@section('css')

@endsection

@section('title')
    Espace Messagerie
@endsection

@section('subtitle')
    Espace Messagerie
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-8">
            <div class="white_card mb_30 card_height_100">
                <div class="white_card_header">
                    <div class="row align-items-center justify-content-between flex-wrap">
                        <div class="col-lg-8">
                            <div class="main-title">
                                <h3 class="m-0">Campagnes</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right d-flex justify-content-end">
                            <a href="{{ route('admin.messages.campagnes.avertissement') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Nouvelle campagne d'avertissement</a>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <table class="table table_diphita ">
                        <thead>

                            <tr>
                                <th scope="col">Num</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Destinataires</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campagnes as $campagne)
                            @php $num = $num ?? 0; $num++ @endphp
                            <tr>
                                <td>{{ $num }}</td>
                                <td>{{ $campagne->titre }}</td>
                                <td>{{ $campagne->nbre_destinataires }}</td>
                                <td>{{ $campagne->status }}</td>

                                {{-- <td><a href="#" style="{{ $souscripteur->status==1 ? '' : 'background-color:red'  }}" class="status_btn" >{{ $souscripteur->status==1 ? 'Actif' : 'Inactif' }}</a></td> --}}

                                <td>
                                    <div class="header_more_tool">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="javascript:void(0);"> <i class="ti-eye"></i> Voir</a>
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // $("").dataTable({
            // });

            // setInterval(() => {
            //     $('.montant_du').each(function(){
            //         $this = $(this)
            //         num = $this.data('souscripteur')

            //         $.ajax({
            //             url: "{{ route('apiGetMontantDuSouscripteur') }}",
            //             type: 'POST',
            //             data:{
            //                 'num_souscripteur':num,
            //                 'id_user':"{{ Auth::user()->id }}"
            //             },
            //             success: function(res){
            //                 // $this.append(`<span>${res.data}</span>`);
            //                 console.log($this);
            //             },
            //             error: function(e){
            //                 console.log(e);
            //             }
            //         });
            //     })

            // }, 10000);
        });
    </script>
@endsection
