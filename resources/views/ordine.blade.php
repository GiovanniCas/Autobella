<x-layout>
<div class="container mt-5">
        <h2>Procedi con il tuo ordine:</h2>
        <div class="row">
            <div class="col-12 col-md-6 mt-5">
                <form method="POST" action="{{route('confermaOrdine')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Nome :</label>
                        <input type="text" class="form-control" name="nome" aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputSurname" class="form-label">Cognome :</label>
                        <input type="text" class="form-control" name="cognome" aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputCitta" class="form-label">Città :</label>
                        <input type="text" class="form-control" name="citta" aria-describedby="emailHelp" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputIndirizzo" class="form-label">Indirizzo :</label>
                        <input type="text" class="form-control" name="indirizzo" aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputCap" class="form-label">C.A.P. :</label>
                        <input type="text" class="form-control" name="cap" aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email :</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-3">Ordina</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>