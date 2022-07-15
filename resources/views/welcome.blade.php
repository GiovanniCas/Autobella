<x-layout>
    
    <h1>Tutti i ricambi in un click!</h1>

    <div class=" container mt-3">
        <div class="row">
            <form method="post" action="{{route('cercaRicambiCompatibili')}}" class="d-flex">
                @csrf
                <div class="col-md-3">
                    @if(session('searchOrder'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaMarca')}}" aria-label="Search" name="cercaMarca">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Marca" aria-label="Search" style="height: 40px; width: 100%;" name="cercaMarca">
                    @endif 
                </div>
            
                <div class="col-md-3">
                    @if(session('cercaModello'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaModello')}}" aria-label="Search" name="cercaModello">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Modello" aria-label="Search" style="height: 40px; width: 100%;" name="cercaModello">
                    @endif 
                </div>
                <div class="col-md-3">
                    @if(session('cercaRicambio'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaRicambio')}}" aria-label="Search" name="cercaRicambio">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci Nome Ricambio" aria-label="Search" style="height: 40px; width: 100%;" name="cercaRicambio">
                    @endif 
                </div>
                <div class="col-md-3">
                    @if(session('cercaAnnoProduzione'))
                        <input class="form-control me-2" type="search" placeholder="{{session()->get('cercaAnnoProduzione')}}" aria-label="Search" name="cercaAnnoProduzione">
                        @else
                        <input class="form-control me-2" type="search" placeholder="Inserisci AnnoProduzione" aria-label="Search" style="height: 40px; width: 100%;" name="cercaAnnoProduzione">
                    @endif 
                </div>
                <button class="btn btn-outline-dark my-btn" style="height: 40px;" type="submit"><i class="fa-solid fa-magnifying-glass text-dark"></i></button>
            </form>
        </div>    
    </div>
    

</x-layout>