<x-layout>
    <div class="container">
        <h1>Aggiungi nuova marca</h1>
        <form action="{{route('aggiungiMarca')}}" method="post" enctype="multipart/form-data">
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" name="nome" required>
            </div>
            <div>
            <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" aria-describedby="emailHelp" name="img" required>
            </div>
          
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</x-layout>