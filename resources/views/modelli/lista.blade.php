<x-layout>

    <h1>Modelli</h1>
        <div class="container">
        <div class="row">
                @foreach($modelli as $modello)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$modello->anno_produzione}}</h5>
                                <h5 class="card-title">{{$modello->anno_ritiro}}</h5>
                                <h5 class="card-title">{{$modello->nome}}</h5>
                               
                            </div>
                            <form href="{{route('vistaModificaModello' , compact('modello'))}}" method="get"> 
                                            
                                <a href="{{route('vistaModificaModello' , compact('modello'))}}" class="btn btn-info">Modifica</a>
                            </form>
                            <form method="post" action="{{route('eliminaModello' , compact('modello'))}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Elimina</button>
        
                            </form>
                        </div>
                    </div>
                @endforeach    
            </div>
            <a href="{{route('vistaAggiungiModello')}}" class="btn btn-danger">Aggiungi Modello</a>
        </div>
        
</x-layout>