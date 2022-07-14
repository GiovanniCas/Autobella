<x-layout>
    <div class="container">
        <h1>Aggiungi nuova categoria</h1>
        <form action="{{route('aggiungiMarca')}}" method="post">
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" name="nome">
            </div>
          
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</x-layout>