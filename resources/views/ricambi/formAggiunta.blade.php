<x-layout>
    <div class="container">
        <h1 class="color-brown">Aggiungi Ricambio:</h1>
        <form action="{{route('aggiungiRicambi')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3" style="width:45%">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" name="nome">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputCodice" class="form-label">Codice Pezzo:</label>
                <input type="text" class="form-control" id="exampleInputCodice" aria-describedby="emailHelp" name="codice_pezzo">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputDescrizione" class="form-label">Descrizione:</label>
                <input type="text" class="form-control" id="exampleInputDescrizione" aria-describedby="emailHelp" name="descrizione">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputPrezzo" class="form-label">Prezzo:</label>
                <input type="number" step="any" class="form-control" id="exampleInputPrezzo" aria-describedby="emailHelp" name="prezzo">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputFronitore" class="form-label">Fornitore:</label>
                <select class="form-select" name="fornitore_id"  aria-label="Default select example" >
                    @foreach($fornitori as $fornitore)
                        <option value="{{$fornitore->id}}">{{$fornitore->ragione_sociale}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputCategoria" class="form-label">Categoria:</label>
                <select class="form-select" name="categoria_id"  aria-label="Default select example" >
                    @foreach($categorie as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->descrizione}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputCategoria" class="form-label">Modelli Compatibili:</label>
                <select class="form-select" name="modelli_id[]" multiple aria-label="Default select example" >
                    @foreach($modelli as $modello)
                        <option value="{{$modello->id}}">{{$modello->nome}} , {{$modello->anno_produzione}}</option>
                    @endforeach
                </select>
            </div>
            <div style="width:45%">
                <label for="exampleInputImg" class="form-label color-brown">Immagini:</label>
                <input type="file" class="form-control" name="immagini[]" placeholder="Aggiungi qui le tue Immagini" multiple> 
                <button type="submit" class="btn btn-primary mt-3">Aggiungi</button>
            </div>
            </div>
          
        </form>
    </div>
</x-layout>