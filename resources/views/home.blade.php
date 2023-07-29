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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body style="background-color: #120238;">
    <div class="container">
        <div class="row">
            @foreach ($seniors as $senior)
                {{-- Card Petuah --}}
                <div class="col-md-6 p-3 p-md-4">
                    <div class="card">
                        <div class="row g-0">
                            <div class="d-flex col-4">
                                <img src="{{ asset('img/petuah_placeholder.jpg') }}" style="object-fit: cover"
                                    class="img-fluid rounded-start"">
                            </div>
                            <div class="col-8">
                                <div class="card-body h-100 d-flex align-items-center">
                                    <div class="w-100">
                                        <h5 class="card-title text-mob mb-2">{{ $senior->name }}</h5>
                                        <p class="card-text mb-2">{{ $senior->senior->major }}</p>
                                        @if($senior->senior->is_available == 1)
                                            <p class=" badge rounded-pill m-0 text-bg-success">Available</p>
                                            <div class="d-flex flex-row-reverse">
                                                <button class="btn btn-rounded btn-outline-info" onclick="location.href='{{ url('detail/'. $senior->senior->id) }}'">
                                                    Detail
                                                </button>
                                            </div>
                                        @else
                                            <p class=" badge rounded-pill m-0 text-bg-danger">Not Available</p>
                                            <div class="d-flex flex-row-reverse" disabled>
                                                <button disabled="disabled" class="btn btn-rounded btn-outline-secondary" onclick="location.href='{{ url('detail/'. $senior->senior->id) }}'">
                                                    Detail
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
