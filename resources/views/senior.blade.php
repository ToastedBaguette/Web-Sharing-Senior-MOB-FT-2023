<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sharing Senior MOB FT 2023</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/broken-console" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/04b30" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/senior.css') }}">
    <link href="https://unpkg.com/nes.css@2.3.0/css/nes.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body style="background-color: #40128b">
    <div class="container p-3">
        <div class="gameboy">
            <div class="screen-container">
                <div class="green-dot-socket">
                    <div class="green-dot"></div>
                </div>
                <div class="screen">
                    <h3 class="title">Kelompok 1</h3>
                </div>
            </div>
            <div class="control-container mt-5">
                <div class="row">
                    <div class="col">
                        <div class="control-wrapper">
                            <div class="control-btn" id="up"></div>
                            <div class="control-btn" id="right"></div>
                            <div class="control-btn" id="down"></div>
                            <div class="control-btn" id="center">
                                <div class="center-dot"></div>
                            </div>
                            <div class="control-btn" id="left"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="button-wrapper">
                            <button class="red-button" id="button-a"><h2>A</h2></button>
                            <button class="red-button" id="button-b"><h2>B</h2></button>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        
    </div>
</body>
</html>