@extends('admin.main')

@section('css')

@endsection

@section('title')
    Liste des messages
@endsection

@section('subtitle')
    Liste des messages
@endsection

@section('content')

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
