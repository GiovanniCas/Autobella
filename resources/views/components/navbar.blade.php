@php
    use App\Models\RicambioOrdinato;
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-1">

        <a class="navbar-brand" href="{{route('welcome')}}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="col-8">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{route('vistaRicambi')}}">Ricambi</a>
            </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('vistaCategorie')}}">Categorie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('vistaModelli')}}">Modelli</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('vistaMarche')}}">Marche</a>
          </li>
         
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('register')}}">Registrati</a>
            </li>
          @endguest  
          @can('Utente')
            <a class="nav-link" href="{{route('storicoOrdini')}}">I Miei Ordini</a>
          @endcan  
          @can('Gestore')
            <li class="nav-item">
              <a class="nav-link" href="{{route('listaFornitori')}}">Fornitori</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('listaOrdini')}}">Ordini</a>
            </li>
          @endcan
         
        </div>
      </div>
      <div class="col-3 d-flex justify-content-end align-items-center" >
        @if(Auth::user())
           <a class="nav-link mx-3" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endif  
        @cannot('Gestore')
          <a class="nav-link" href="{{route('carrello')}}"><i class="fa-solid fa-cart-shopping"></i><span> {{count(RicambioOrdinato::where('testata_id' , session('testata_id'))->get())}}</span></a>
        @endcannot
      </div>
    </div>
  </div>
</nav>