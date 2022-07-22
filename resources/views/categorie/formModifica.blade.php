<x-layout>
    <div class="container">
        <h1>Modifica  categoria</h1>
        <form action="{{route('modificaCategoria' , compact('categoria'))}}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputdescrizione" class="form-label">Descrizione:</label>
                <input type="text" class="form-control" id="exampleInputdescrizione" aria-describedby="emailHelp" value="{{$categoria->descrizione}}" name="descrizione">
            </div>
            <div>
                <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" value="{{$categoria->img}}" aria-describedby="emailHelp" name="img" required>
            </div>
          
            <button type="submit" class="btn btn-primary mt-3">Modifica</button>
        </form>
        
            <div class="d-flex mt-5">
                <h3>Immagine copertina</h3><br>
                <div>
                    <form action="{{route('eliminaImmagineCategoria' , compact('categoria'))}}" method="post">
                        <button class="btn text-danger">X</button>
                        @csrf
                        @method('delete')
                        <img src="{{Storage::url($categoria->img)}}" style="height:150px; width: 200px;" alt="">
                    </form>
                </div>
            </div>
       
    </div>
</x-layout>