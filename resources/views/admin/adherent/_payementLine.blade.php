<ul class="list-group">
    @foreach($cotisations->sortByDesc('created_at') as $cotisation)
        <li class="list-group-item">
            {{ $cotisation->code_deces ?? $cotisation->annee_cotis  }} : {{ $cotisation->montant() }} francs
            <span class="float-right">
                <button class="btn btn-sm btn-outline-success"><i class="fa fa-money-bill"></i> Payer</button>
            </span>
        </li>
    @endforeach 
</ul>