@php 
    use App\Models\Testata;
@endphp
<body>
    <h3>
        
        Buongiorno {{$nome}}, <br>
        con la presente vi informo che durante la settimana, <br>
        il guadagno è stato di : <br>
        @php 
            $from = date('Y-m-d',strtotime("-7 days"));
            $to = date('Y-m-d',strtotime("-1 days"));
            $totale = Testata::all()->whereBetween('data' , [$from , $to])->where('stato' , '<>' , 0 )->sum('totale');
        @endphp
        ${{$totale}}
    </h3>
</body>