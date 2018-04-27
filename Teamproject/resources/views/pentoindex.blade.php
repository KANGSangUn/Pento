<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11; IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pento</title>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>
<body>
<div id="app">

</div>

<script>

    window.Laravel =<?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

</script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>