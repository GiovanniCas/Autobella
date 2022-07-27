<x-layout>
    <div class="container">
        <h1 class="color-brown">Modifica Ricambio:</h1>
        <div class="row">
            <div class="col-12 col-md-6">

                <form action="{{route('modificaRicambio' , compact('ricambio'))}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputNome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp"  value="{{$ricambio->nome}}" name="nome">
                    </div>
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
                
                        <select class="form-select" name="fornitore_id"  aria-label="Default select example" >
                            <option value="{{$ricambio->fornitori->id}}">{{$ricambio->fornitori->ragione_sociale}}</option>
                            @foreach($fornitori as $fornitore)
                                <option value="{{$fornitore->id}}">{{$fornitore->ragione_sociale}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="mb-3">
                        <label for="exampleInputCategoria" class="form-label">Categoria:</label>
                        <select class="form-select" name="categoria_id"  aria-label="Default select example" >
                            <option value="{{$ricambio->categorie->id}}">{{$ricambio->categorie->descrizione}}</option>
                            @foreach($categorie as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->descrizione}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputCategoria" class="form-label">Modelli Compatibili:</label>
                        <select class="form-select" name="modelli_id[]" multiple aria-label="Default select example" >
                            @foreach($modelli as $modello)
                                <option value="{{$modello->id}}">{{$modello->marche->nome}} {{$modello->nome}} del {{$modello->anno_produzione}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="exampleInputImg" class="form-label">Immagini:</label>
                        <input type="file" class="form-control" name="immagini[]" placeholder="Aggiungi qui le tue Immagini" multiple> 
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Modifica</button>
                
            </form>
            </div>
            <div class="col-12 col-md-6">
                
                <h4 class="mt-3">Immagini presenti:</h4>
                <div class="d-flex">
                    @foreach($immagini as $immagine)
                    <form action="{{route('eliminaImmagine' , compact('immagine'))}}" method="post">
                        <button class="btn text-danger">X</button>
                        @csrf
                        @method('delete')
                        <img src="/storage/img/{{$immagine->nome}}" style="height:150px; width: 200px;" alt="">
                    </form>
                    @endforeach
                </div>
                <br>
                <h4 class="mt-3">Modelli Compatibili:</h4>
                <div >
                    @foreach($modelli_compatibili as $modello_compatibile)
                        <form action="{{route('eliminaModelloCompatibile' , compact('modello_compatibile'))}}" method="post">
                            @csrf
                            @method('delete')
                                    <li>{{$modello_compatibile->nome}} , {{$modello_compatibile->anno_produzione}} <button class="btn text-danger">X</button></li>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>