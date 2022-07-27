<x-layout>
    <div class="container">
        <h1 class="color-brown">Aggiungi nuova marca</h1>
        <form action="{{route('aggiungiMarca')}}" method="post" enctype="multipart/form-data">
            @csrf
  
            <div class="my-3" style="width:45%">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" name="nome" required>
            </div>
            <div style="width:45%">
            <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" aria-describedby="emailHelp" name="img" required>
            </div>
          
            <button type="submit" class="btn btn-primary mt-5">Aggiungi</button>
        </form>
    </div>
</x-layout>