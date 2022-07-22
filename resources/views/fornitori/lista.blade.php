<x-layout>
    <h1>Fornitori:</h1>
    <div class="container-fluid">
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ragione Sociale</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Comune</th>
                    <th scope="col">C.A.P.</th>
                    <th scope="col">Provincia</th>
                    <th scope="col">Partita IVA</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fornitori as $fornitore)
                    <tr>
                    <th scope="row">{{$fornitore->ragione_sociale}}</th>
                    <td>{{$fornitore->indirizzo}}</td>
                    <td>{{$fornitore->comune}}</td>
                    <td>{{$fornitore->cap}}</td>
                    <td>{{$fornitore->provincia}}</td>
                    <td>{{$fornitore->partita_iva}}</td>
                    <td>
                        <div class="d-flex">
                            <form href="{{route('vistaModificaFornitore' , compact('fornitore'))}}" method="get"> 
                                            
                                <a href="{{route('vistaModificaFornitore' , compact('fornitore'))}}" class="btn btn-info">Modifica</a>
                            </form>
                            <form method="post" action="{{route('eliminaFornitore' , compact('fornitore'))}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Elimina</button>
        
                            </form>
                        </div>
                    </td>
                    </tr>    
                @endforeach    
            </tbody>
        </table>
        <a href="{{route('aggiungiFornitore')}}" class="btn btn-danger">Aggiungi Fornitore</a>
    </div>
</x-layout>