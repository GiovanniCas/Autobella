<x-layout>
    <div class="container">
        <h1 class="color-brown">Aggiungi nuova categoria</h1>
        <form action="{{route('aggiungiCategoria')}}" method="post" enctype="multipart/form-data">
            @csrf
  
            <div class="mb-3" style="width: 45%">
                <label for="exampleInputdescrizione" class="form-label">Descrizione:</label>
                <input type="text" class="form-control" id="exampleInputdescrizione" aria-describedby="emailHelp" name="descrizione">
            </div>
            <div style="width: 45%">
                <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" aria-describedby="emailHelp" name="img" >
            </div>
            <button type="submit" class="btn btn-primary mt-5">Aggiungi</button>
        </form>
    </div>
</x-layout>