<x-layout>
    @guest
    <div class="container ">
            <h1 class="color-brown">Categorie</h1>
            <div class="row mt-5">
                @foreach($categorie as $categoria)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="{{Storage::url($categoria->img)}}" class="card-img-top" style="height: 190px;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$categoria->descrizione}}</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Dettagli</a>
                            </div>
                        
                        </div>
                    </div>
                @endforeach    
            </div>
        
        </div>
    @endguest
    @if(Auth::user())
    <h1 class="color-brown">Categorie</h1>
        <div class="container-fluid">
            
            <table class="table">
                <thead>
                    <tr class="color-brown">
                        <th scope="col">Nome </th>
                        <th scope="col">Immagine </th>
                        
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorie as $categoria)
                        <tr>
                            <th scope="row">{{$categoria->descrizione}}</th>
                            <td>
                                @if($categoria->img)
                                    Si
                                @else 
                                    No
                                @endif        
                            </td>
                            <td>
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
                            </td>
                        </tr>    
                    @endforeach    
                </tbody>
            </table>
            <a href="{{route('vistaAggiungiCategoria')}}" class="btn btn-success mt-5">Aggiungi Categoria</a>
        </div>
    @endif    
</x-layout>