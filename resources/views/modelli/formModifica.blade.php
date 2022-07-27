<x-layout>
    <div class="container">
        <h1 class="color-brown">Modifica Modello</h1>
        <form action="{{route('modificaModello' , compact('modello'))}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
  
            <div class="my-3" style="width:45%">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" value="{{$modello->nome}}" name="nome">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputProduzione" class="form-label">Anno di Produzione:</label>
                <select class="form-control" value="{{$modello->anno_produzione}}" name="anno_produzione">
                    <?php
                    for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                        <option value="<?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
                <!-- <input type="number" class="form-control" id="exampleInputProduzione" aria-describedby="emailHelp" value="{{$modello->anno_produzione}}" name="anno_produzione"> -->
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputRitiro" class="form-label">Anno Ritiro Dal Commercio:</label>
                <select class="form-control" value="{{$modello->anno_ritiro}}" name="anno_ritiro">
                    <option value="">Ancora in Commercio</option>
                    <?php
                    for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                        <option value="<?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
                <!-- <input type="date" class="form-control" id="exampleInputRitiro" aria-describedby="emailHelp" value="{{$modello->anno_ritiro}}" name="anno_ritiro"> -->
            </div>
          
            <div class="mb-3" style="width:45%">
                <label for="exampleInputCategoria" class="form-label">Marca:</label>
                    <select class="form-select" name="marca_id"  aria-label="Default select example" >
                        <option value="{{$modello->marche->id}}">{{$modello->marche->nome}}</option>
                        @foreach($marche as $marca)
                            <option value="{{$marca->id}}">{{$marca->nome}}</option>
                        @endforeach 
                </select>
            </div>
            <div style="width:45%">
                <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" aria-describedby="emailHelp" name="img">
            </div>
          
            <button type="submit" class="btn btn-primary mt-5">Modifica</button>
        </form>
        
            <div class="d-flex mt-5">
                <h3 class="color-brown">Immagine copertina</h3>
                <br>
                <form action="{{route('eliminaImmagineModello' , compact('modello'))}}" method="post">
                    <button class="btn text-danger">X</button>
                    @csrf
                    @method('delete')
                    <img src="{{Storage::url($modello->img)}}" style="height:150px; width: 200px;" alt="">
                </form>
            </div>
      
    </div>
</x-layout>