<x-layout>
    <div class="container">
        <form action="{{route('aggiungiRicambi')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputFronitore" class="form-label">Fornitore:</label>
        
                <select name="fornitore_id" id="">
                    @foreach($fornitori as $fornitore)
                        <option value="{{$fornitore->id}}">{{$fornitore->ragione_sociale}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputCategoria" class="form-label">Categoria:</label>
                <select name="categoria_id" id="">
                    @foreach($categorie as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->descrizione}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputCodice" class="form-label">Codice Pezzo:</label>
                <input type="text" class="form-control" id="exampleInputCodice" aria-describedby="emailHelp" name="codice_pezzo">
            </div>
            <div class="mb-3">
                <label for="exampleInputDescrizione" class="form-label">Descrizione:</label>
                <input type="text" class="form-control" id="exampleInputDescrizione" aria-describedby="emailHelp" name="descrizione">
            </div>
            <div class="mb-3">
                <label for="exampleInputPrezzo" class="form-label">Prezzo:</label>
                <input type="number" step="any" class="form-control" id="exampleInputPrezzo" aria-describedby="emailHelp" name="prezzo">
            </div>
          
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</x-layout>