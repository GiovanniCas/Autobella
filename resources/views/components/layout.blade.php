<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Link Swiper's CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.3.1/swiper-bundle.min.js" integrity="sha512-naEQG74IcOLQ6K/B1PmhIcZ4i3YE2FXs2zm603E1Q3shbron+PmYLg44/q+xAymD/RvskZ2H8l1Qa7I5qELlrg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.3.1/swiper-bundle.css" integrity="sha512-5TGRCl3hPoqtruhO+mubTuySHOfcEBvyIfiWHoCK8wDLmf6C1U73OUoNCU6ZvyT/8vfCcha1INDIo8dabDmQjw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Fonteawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Autobella</title>
</head>
<body class="mio-sfondo wh-100" style="background-image: url('/sfondo.jpg');  ">
    <x-navbar/>
    <div class="mt-5">

        {{$slot}}
    </div>

    
    @vite('resources/js/app.js')
</body>
</html>