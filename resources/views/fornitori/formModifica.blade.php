<x-layout>
    <div class="container">
        <h1 class="color-brown">Modifica fornitore :</h1>
        <form action="{{route('modificaFornitore' , compact('fornitore'))}}" method ="post">
            @method('put')
            @csrf
            <div class="my-3" style="width:45%">
                <label for="exampleInputRagioneSociale" class="form-label">Ragione Sociale:</label>
                <input type="text" class="form-control" id="exampleInputRagioneSociale" aria-describedby="emailHelp" value="{{$fornitore->ragione_sociale}}" name="ragione_sociale">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInputIndirizzo" class="form-label">Indirizzo:</label>
                <input type="text" class="form-control" id="exampleInputIndirizzo" aria-describedby="emailHelp" value="{{$fornitore->indirizzo}}" name="indirizzo">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInput" class="form-label">Comune:</label>
                <input type="text" class="form-control" id="exampleInputComune" aria-describedby="emailHelp" value="{{$fornitore->comune}}" name="comune">
            </div>
            <div class="mb-3" style="width:45%">
                <label for="exampleInpuCap" class="form-label">C.A.P.</label>
                <input type="text" class="form-control" id="exampleInpuCap" aria-describedby="emailHelp" value="{{$fornitore->cap}}" name="cap">
            </div> 
            <div class="mb-3" style="width:45%">
                <label for="exampleInputProvincia" class="form-label">Provincia:</label>
                <input type="text" class="form-control" id="exampleInputProvincia" aria-describedby="emailHelp" value="{{$fornitore->provincia}}" name="provincia">
            </div> 
            <div class="mb-3" style="width:45%">
                <label for="exampleInputIva" class="form-label">Partita IVA:</label>
                <input type="text" class="form-control" id="exampleInputIva" aria-describedby="emailHelp" value="{{$fornitore->partita_iva}}" name="partita_iva">
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</x-layout>