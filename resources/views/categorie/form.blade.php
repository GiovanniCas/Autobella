<x-layout>
    <div class="container">
        <h1>Aggiungi nuova categoria</h1>
        <form action="{{route('aggiungiCategoria')}}" method="post">
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputdescrizione" class="form-label">Descrizione:</label>
                <input type="text" class="form-control" id="exampleInputdescrizione" aria-describedby="emailHelp" name="descrizione">
            </div>
          
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</x-layout>