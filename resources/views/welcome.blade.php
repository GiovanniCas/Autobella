<x-layout>
    
    
    <h1 class="text-center color-brown" style="margin-top:160px">{{__('profile.Tutti i ricambi in un click')}}!</h1>
    <div class=" container mt-5">
        <div class="row mt-5">
            <form method="post" action="{{route('cercaRicambiCompatibili')}}" class="d-flex mt-5">
                @csrf
                <div class="col-md-6 ">
                    <h5>{{__('profile.Marca')}} :</h5>
                    @if(session('searchOrder'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaMarca')}}" aria-label="Search" name="cercaMarca">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Marca" aria-label="Search" style="height: 40px; width: 100%;" name="cercaMarca">
                    @endif 
                </div>
            
                <div class="col-md-6">
                    <h5>{{__('profile.Modello')}} :</h5>
                    @if(session('cercaModello'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaModello')}}" aria-label="Search" name="cercaModello">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Modello" aria-label="Search" style="height: 40px; width: 100%;" name="cercaModello">
                    @endif 
                </div>
                
                <button class="btn btn-outline-dark my-btn" style="height: 40px; margin-top: auto;" type="submit"><i class="fa-solid fa-magnifying-glass text-dark"></i></button>
            </form>
        </div>    
    </div>
    

</x-layout>