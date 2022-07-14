<x-layout>

    <h1>Marche</h1>
        <div class="container">
        <div class="row">
                @foreach($marche as $marca)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$marca->nome}}</h5>
                                
                                
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                
                            </div>
                        </div>
                        <div class="d-flex">
                            <form href="{{route('vistaModificaMarca' , compact('marca'))}}" method="get"> 
                                            
                                <a href="{{route('vistaModificaMarca' , compact('marca'))}}" class="btn btn-info">Modifica</a>
                            </form>
                            <form method="post" action="{{route('eliminaMarca' , compact('marca'))}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Elimina</button>
        
                            </form>
                        </div>
                    </div>
                @endforeach    
            </div>
            <a href="{{route('vistaAggiungiMarca')}}" class="btn btn-danger">Aggiungi Marca</a>
        </div>
        
</x-layout>