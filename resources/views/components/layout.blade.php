<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Autobella</title>
</head>
<body>
    <x-navbar/>
    {{$slot}}
    @vite('resources/js/app.js')
</body>
</html>