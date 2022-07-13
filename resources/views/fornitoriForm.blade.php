<x-layout>
    <div class="container">
        <form action="{{route('aggiungiNuovoFornitore')}}" method ="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputRagioneSociale" class="form-label">Ragione Sociale:</label>
                <input type="text" class="form-control" id="exampleInputRagioneSociale" aria-describedby="emailHelp" name="ragione_sociale">
            </div>
            <div class="mb-3">
                <label for="exampleInputIndirizzo" class="form-label">Indirizzo:</label>
                <input type="text" class="form-control" id="exampleInputIndirizzo" aria-describedby="emailHelp" name="indirizzo">
            </div>
            <div class="mb-3">
                <label for="exampleInput" class="form-label">Comune:</label>
                <input type="text" class="form-control" id="exampleInputComune" aria-describedby="emailHelp" name="comune">
            </div>
            <div class="mb-3">
                <label for="exampleInpuCap" class="form-label">C.A.P.</label>
                <input type="text" class="form-control" id="exampleInpuCap" aria-describedby="emailHelp" name="cap">
            </div> 
            <div class="mb-3">
                <label for="exampleInputProvincia" class="form-label">Provincia:</label>
                <input type="text" class="form-control" id="exampleInputProvincia" aria-describedby="emailHelp" name="provincia">
            </div> 
            <div class="mb-3">
                <label for="exampleInputIva" class="form-label">Partita IVA:</label>
                <input type="text" class="form-control" id="exampleInputIva" aria-describedby="emailHelp" name="partita_iva">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-layout>