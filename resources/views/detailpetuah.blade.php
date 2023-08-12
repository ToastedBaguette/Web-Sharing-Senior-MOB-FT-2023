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
    <link rel="stylesheet" href="{{ asset('/css/detail.css') }}">
    <link href="https://unpkg.com/nes.css@2.3.0/css/nes.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body style="background-color: #120238;">
    <div class="container my-2 px-3 py-4 h-100">
        <div class="card text-center">
            <div class="card-body text-center">
                <img src="{{ asset('img/petuah/' . $senior->photo . '') }}" style="object-fit: cover"
                    class="img-fluid rounded mw-100 mb-3">
                <h5 class="card-title text-mob">{{ $senior->user->name }}</h5>
                <p class="card-text text-secondary">{{ $senior->major }}</p>
                <p class="card-text fw-bold">Lokasi: {{ $senior->location }}</p>
                <div class="desc-container mb-3">
                    <p class="card-text" style="text-align: justify">{{ $senior->description }}</p>
                </div>
                <button class="nes-btn is-warning w-100"  onclick="location.href='{{ url('home' ) }}'">Back</button>
                {{-- <a class="btn btn-success" onclick="tes({{ $senior->id }})">Request</a> --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">
        // const tes = (id) => {
        //     let senior_id = id
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route('request') }}',
        //         data: {
        //             '_token': '<?php echo csrf_token(); ?>',
        //             'senior_id': senior_id,
        //         },
        //         success: function(data) {
        //             window.location.href = "{{ route('home')}}"
        //         }
        //     }) 
        // }
    </script>
</body>

</html>
