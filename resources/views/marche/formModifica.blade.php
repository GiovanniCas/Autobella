<x-layout>
    <div class="container">
        <h1 class="color-brown">Modifica marca</h1>
        <form action="{{route('modificaMarca' , compact('marca'))}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
  
            <div class="my-3" style="width:45%">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" value="{{$marca->nome}}" name="nome" required>
            </div>
            <div style="width:45%">
                <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" aria-describedby="emailHelp" name="img" required>
            </div>
          
            <button type="submit" class="btn btn-primary mt-5">Modifica</button>
        </form>
        <div class="d-flex mt-5">
            <h3>Immagine copertina</h3><br>
            <div>
                <form action="{{route('eliminaImmagineMarca' , compact('marca'))}}" method="post">
                    <button class="btn text-danger">X</button>
                    @csrf
                    @method('delete')
                    <img src="{{Storage::url($marca->img)}}" style="height:150px; width: 200px;" alt="">
                </form>
            </div>
        </div>
    </div>
</x-layout>