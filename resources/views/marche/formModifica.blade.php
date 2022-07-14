<x-layout>
    <div class="container">
        <h1>Modifica categoria</h1>
        <form action="{{route('modificaMarca' , compact('marca'))}}" method="post">
            @method('put')
            @csrf
  
            <div class="mb-3">
                <label for="exampleInputNome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="exampleInputNome" aria-describedby="emailHelp" value="{{$marca->nome}}" name="nome">
            </div>
          
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
</x-layout>