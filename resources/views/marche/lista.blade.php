@php
    use App\Models\Modello;
@endphp
<x-layout>

    @guest
    <div class="container" style="margin-top:160px">
            <h1 class="color-brown">Marche</h1>
            <div class="row">
                @foreach($marche as $marca)
                    <div class="col-12 col-sm-6 col-md-3 mt-5">
                        <div class="card" style="width: 18rem; ">
                            <img src="{{Storage::url($marca->img)}}" class="card-img-top" style="height: 190px;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$marca->nome}}</h5>
                                
                                
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                
                            </div>
                        </div>
                        
                    </div>
                @endforeach    
            </div>
            
        </div>
    @endguest    
    @if(Auth::user())
        <h1 class="color-brown">Marche</h1>
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr class="color-brown">
                        <th scope="col">Nome </th>
                        <th scope="col">Numero Modelli</th>
                        <th scope="col">Immagine</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marche as $marca)
                        <tr>
                            <th scope="row">{{$marca->nome}}</th>
                            <td>{{count(Modello::all()->where('marca_id' , $marca->id))}}</td>
                            <td>
                                @if($marca->img)
                                    Si
                                @else 
                                    No
                                @endif        
                            </td>
                            <td>
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
                            </td>
                        </tr>    
                    @endforeach    
                </tbody>
            </table>
            <a href="{{route('vistaAggiungiMarca')}}" class="btn btn-danger mt-5">Aggiungi Marca</a>
        </div>
    @endif    
</x-layout>