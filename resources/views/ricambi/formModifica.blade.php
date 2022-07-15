<x-layout>
    <div class="container">
        <h1>Modifica Ricambio:</h1>
        <form action="{{route('modificaRicambio' , compact('ricambio'))}}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="exampleInputCodice" class="form-label">Codice Pezzo:</label>
                <input type="text" class="form-control" id="exampleInputCodice" aria-describedby="emailHelp" value="{{$ricambio->codice_pezzo}}" name="codice_pezzo">
            </div>
            <div class="mb-3">
                <label for="exampleInputDescrizione" class="form-label">Descrizione:</label>
                <input type="text" class="form-control" id="exampleInputDescrizione" aria-describedby="emailHelp" value="{{$ricambio->descrizione}}" name="descrizione">
            </div>
            <div class="mb-3">
                <label for="exampleInputPrezzo" class="form-label">Prezzo:</label>
                <input type="number" step="any" class="form-control" id="exampleInputPrezzo" aria-describedby="emailHelp" value="{{$ricambio->prezzo}}" name="prezzo">
            </div>
            <div class="mb-3">
                <label for="exampleInputFronitore" class="form-label">Fornitore:</label>
        
                <select  name="fornitore_id" id="">
                    <option value="{{$ricambio->fornitori->ragione_sociale}}">{{$ricambio->fornitori->ragione_sociale}}</option>
                    @foreach($fornitori as $fornitore)
                        <option value="{{$fornitore->id}}">{{$fornitore->ragione_sociale}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputCategoria" class="form-label">Categoria:</label>
                <select name="categoria_id" id="">
                <option value="{{$ricambio->categorie->descrizione}}">{{$ricambio->categorie->descrizione}}</option>
                    @foreach($categorie as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->descrizione}}</option>
                    @endforeach
                </select>
            </div>
          
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
</x-layout>