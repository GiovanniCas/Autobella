<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('welcome')}}">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
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
      <li class="nav-item">
          <a class="nav-link" href="{{route('carrello')}}"><i class="fa-solid fa-cart-shopping"></i></a>
        </li>
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">Login</a>
      </li>
      @endguest
      @if(Auth::user())
        <li class="nav-item">
          <a class="nav-link" href="{{route('listaFornitori')}}">Fornitori</a>
        </li>
      
        <li>
          <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
        @endif
   
        
    </div>
  </div>
</nav>