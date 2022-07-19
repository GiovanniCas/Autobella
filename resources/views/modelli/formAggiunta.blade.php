<x-layout>
    <div class="container">
        <h1>Aggiungi nuovo Modello</h1>
        <form action="{{route('aggiungiModello')}}" method="post" enctype="multipart/form-data">
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" name="nome">
            </div>
            <div class="mb-3">
                <label for="exampleInputProduzione" class="form-label">Anno di Produzione:</label>
                <select class="form-control"  name="anno_produzione">
                    <?php
                    for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                        <option value="<?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputRitiro" class="form-label">Anno Ritiro Dal Commercio:</label>
                <select class="form-control"  name="anno_ritiro">
                    <option value="">Ancora in Commercio</option>
                    <?php
                    for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                        <option value="<?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputCategoria" class="form-label">Marca:</label>
                <select class="form-select" name="marca_id"  aria-label="Default select example" >
                @foreach($marche as $marca)
                        <option value="{{$marca->id}}">{{$marca->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="exampleInputImg" class="form-label">Immagine:</label>
                <input type="file" class="form-control" id="exampleInputImg" aria-describedby="emailHelp" name="img">
            </div>
          
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</x-layout>