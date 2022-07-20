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
                <input type="file" class="form-control" id="exampleInputImg" value="{{$categoria->img}}" aria-describedby="emailHelp" name="img" >
            </div>
          
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
</x-layout>