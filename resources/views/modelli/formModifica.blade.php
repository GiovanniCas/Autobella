<x-layout>
    <div class="container">
        <h1>Modifica Modello</h1>
        <form action="{{route('modificaModello' , compact('modello'))}}" method="post">
            @csrf
            @method('put')
  
            <div class="mb-3">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" value="{{$modello->nome}}" name="nome">
            </div>
            <div class="mb-3">
                <label for="exampleInputProduzione" class="form-label">Anno di Produzione:</label>
                <select class="form-control" value="{{$modello->anno_produzione}}" name="anno_produzione">
                    <?php
                    for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                        <option value="<?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
                <!-- <input type="number" class="form-control" id="exampleInputProduzione" aria-describedby="emailHelp" value="{{$modello->anno_produzione}}" name="anno_produzione"> -->
            </div>
            <div class="mb-3">
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
            <div class="mb-3">
                <label for="exampleInputMarca" class="form-label">Marca:</label>
                <select  name="marca_id" id="">
                    <option value="{{$modello->marche->id}}">{{$modello->marche->nome}}</option>
                    @foreach($marche as $marca)
                        <option value="{{$marca->id}}">{{$marca->nome}}</option>
                    @endforeach
                </select>
            </div>
          
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
</x-layout>