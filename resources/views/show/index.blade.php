<!-- resources/views/show/index.blade.php -->
@extends('layouts.main')

@section('title', 'Liste des spectacles')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <!-- Champ de recherche par tag -->
    <form method="GET" action="{{ route('show.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="tag" class="form-control" placeholder="Rechercher par tag" value="{{ request('tag') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
    <!-- Message de résultats de recherche -->
    @if(request('tag'))
        <div class="alert alert-info">
            @if($shows->count() > 0)
                {{ $shows->count() }} résultat(s) trouvé(s) pour le tag: <strong>{{ request('tag') }}</strong>
            @else
                Aucun résultat trouvé pour le tag: <strong>{{ request('tag') }}</strong>
            @endif
        </div>
    @endif

    <!-- Tableau Bootstrap pour les spectacles -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Spectacle <button class="btn btn-light btn-sm sort" onclick="sortTable(0)">↕</button></th>
                <th scope="col">Prix <button class="btn btn-light btn-sm sort" onclick="sortTable(1)">↕</button></th>
                <th scope="col">Représentation</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($shows as $show)
            <tr>
                <td><a href="{{ route('show.show', $show->id) }}">{{ $show->title }}</a></td>
                <td>@if($show->bookable){{ $show->price }} €@endif</td>
                <td>
                    @if($show->representations->count() == 1)
                        1 représentation
                    @elseif($show->representations->count() > 1)
                        {{ $show->representations->count() }} représentations
                    @else
                        <em>aucune représentation</em>
                    @endif
                </td>
                <td><a href="{{ route('show.show', $show->id) }}"><button class="btn btn-primary">Infos</button></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('extra-js')
<script>
    function sortTable(columnIndex, isNumeric) {
        var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
        table = document.querySelector(".table"); // Utiliser querySelector pour plus de spécificité
        switching = true;
        // Définir la direction du tri comme ascendante initialement :
        var dir = "asc";

        // Faire une boucle jusqu'à ce que aucun échange n'a été fait :
        while (switching) {
            // Commencer par dire qu'aucun échange n'est fait :
            switching = false;
            rows = table.rows;

            // Boucler à travers toutes les lignes du tableau (sauf la première, qui contient les en-têtes) :
            for (i = 1; i < (rows.length - 1); i++) {
                // Supposer qu'il ne faut pas d'échange :
                shouldSwitch = false;

                // Prendre deux éléments à comparer, un de la ligne actuelle et un de la suivante :
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

                // Vérifier si les deux lignes doivent échanger de place, selon la direction, ascendant ou descendant :
                if (dir == "asc") {
                    if (isNumeric ? parseFloat(x.innerHTML) > parseFloat(y.innerHTML) : x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // Si oui, marquer qu'un échange a eu lieu et sortir de la boucle :
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (isNumeric ? parseFloat(x.innerHTML) < parseFloat(y.innerHTML) : x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                // Si un échange a été marqué, faire l'échange et marquer que l'échange a été fait :
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;      
            } else {
                // Si aucun échange n'a été fait ET que la direction est "asc",
                // définir la direction à "desc" et faire de nouveau un passage de la boucle.
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
@endsection
