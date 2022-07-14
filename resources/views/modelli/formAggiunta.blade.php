<x-layout>
    <div class="container">
        <h1>Aggiungi nuovo Modello</h1>
        <form action="{{route('aggiungiModello')}}" method="post">
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" name="nome">
            </div>
            <div class="mb-3">
                <label for="exampleInputProduzione" class="form-label">Anno di Produzione:</label>
                <input type="number" class="form-control" id="exampleInputProduzione" aria-describedby="emailHelp" name="anno_produzione">
            </div>
            <div class="mb-3">
                <label for="exampleInputRitiro" class="form-label">Anno Ritiro Dal Commercio:</label>
                <input type="number" class="form-control" id="exampleInputRitiro" aria-describedby="emailHelp" name="anno_ritiro">
            </div>
            <div class="mb-3">
                <label for="exampleInputMarca" class="form-label">Marca:</label>
                <select name="marca_id" id="">
                    @foreach($marche as $marca)
                        <option value="{{$marca->id}}">{{$marca->nome}}</option>
                    @endforeach
                </select>
            </div>
          
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</x-layout>