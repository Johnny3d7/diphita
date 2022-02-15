<ul class="list-group">
    @foreach($cotisations->sortByDesc('created_at') as $cotisation)
        @php $identifiant = $cotisation->code_deces ?? $cotisation->annee_cotis; @endphp
        <li class="list-group-item">
            {{ $identifiant  }} : {{ $souscripteur->psCotisation($cotisation)->montant() }} francs
            <span class="float-right">
                <a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#reglement{{ $identifiant }}{{ $souscripteur->num_adhesion }}Modal" href="#"><i class="fa fa-money-bill"></i> Payer</a>
            </span>
        </li>
    @endforeach 
</ul>