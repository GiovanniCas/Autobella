<x-layout>
    <h1>Categorie</h1>
    <div class="container ">
    <div class="row ">
            @foreach($categorie as $categoria)
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$categoria->descrizione}}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Dettagli</a>
                        </div>
                        <div class="d-flex">
                            <form href="{{route('vistaModificaCategoria' , compact('categoria'))}}" method="get"> 
                                            
                                <a href="{{route('vistaModificaCategoria' , compact('categoria'))}}" class="btn btn-info">Modifica</a>
                            </form>
                            <form method="post" action="{{route('eliminaCategoria' , compact('categoria'))}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Elimina</button>
        
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach    
        </div>
        <a href="{{route('vistaAggiungiCategoria')}}" class="btn btn-success">Aggiungi Categoria</a>
    </div>
</x-layout>