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
    <link href="https://unpkg.com/nes.css@2.3.0/css/nes.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        @import url('https://fonts.cdnfonts.com/css/montserrat');

        * {
            font-family: 'Montserrat', sans-serif;

        }

        .card-kelompok .badge {
            width: 100px;
        }

        .nes-input {
            width: 200px;
            border-image-repeat: stretch !important;
            background-clip: unset !important;
            border-width: 6px !important;
            height: 30px;

        }

        .nes-dialog.is-rounded,
        .nes-btn,
        .nes-textarea {
            border-image-repeat: stretch !important;
        }

        .nes-btn {
            font-family: 'Broken Console', sans-serif !important;
            height: 30px;
            font-size: 14px;
            padding: 0 6px;
        }
    </style>
</head>

<body style="background-color: #120238;">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6 p3 p-md-4">
                <div class="card card-kelompok">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <p class="card-text">Nama : {{ $group->user->name }}</p>
                                @if ($group->is_success == 1 && $group->is_waiting == 0)
                                    <p>Status : <span class="badge bg-success">Accepted</span></p>
                                @elseif($group->is_success == 0 && $group->is_waiting == 0)
                                    <p>Status : <span class="badge bg-danger">Not Accepted</span></p>
                                @else
                                    <p>Status : <span class="badge bg-warning">Waiting</span></p>
                                @endif
                                <p class="card-text">Senior : {{ $info }}</p>
                            </div>
                            <div class="col d-flex justify-content-center align-items-center" style="flex-direction: column; gap:16px">
                                <button class="nes-btn is-error" id="btn-logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>
                                
                                    @if($accepted_id!="")
                                    <button class="btn btn-rounded btn-outline-info"
                                                onclick="location.href='{{ url('detail/' . $accepted_id) }}'">
                                                Detail
                                            </button>
                                    @endif   
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-2">
        @foreach ($seniors as $senior)
            {{-- Card Petuah --}}
            <div class="col-md-6 p-3 p-md-4">
                <div class="card">
                    <div class="row g-0">
                        <div class="d-flex col-4">
                            <img src="{{ asset('img/petuah/' . $senior->senior->photo . '') }}" style="object-fit: cover;"
                                class="img-fluid rounded-start">
                        </div>
                        <div class="col-8">
                            <div class="card-body h-100 d-flex align-items-center">
                                <div class="w-100">
                                    <p class="card-title text-mob mb-2 fs-10">{{ $senior->name }}</p>
                                    {{-- <p class="card-text mb-2">{{ $senior->senior->major }}</p> --}}
                                    @if (($group->is_waiting == 1) | ($group->is_success == 1))
                                        <p class=" badge rounded-pill m-0 text-bg-warning">Available</p>
                                        <div class="d-flex flex-row-reverse" disabled>
                                            <button class="btn btn-success" onclick="tes({{ $senior->senior->id }})" disabled>Request</button>
                                        </div>
                                    @elseif($senior->senior->is_available == 1)
                                        <p class=" badge rounded-pill m-0 text-bg-success">Available</p>
                                        <div class="d-flex flex-row-reverse">
                                            <button class="btn btn-success" onclick="tes({{ $senior->senior->id }})">Request</button>
                                        </div>
                                    @else
                                        <p class=" badge rounded-pill m-0 text-bg-danger">Not Available</p>
                                        <div class="d-flex flex-row-reverse" disabled>
                                            <button class="btn btn-success" onclick="tes({{ $senior->senior->id }})" disabled>Request</button>
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

    <script src="../js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        window.Echo.channel('send-response').listen('.response', (e) => {
            location.reload()
        })

        const tes = (id) => {
            let senior_id = id
            $.ajax({
                type: 'POST',
                url: '{{ route('request') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'senior_id': senior_id,
                },
                success: function(data) {
                    window.location.href = "{{ route('home')}}"
                }
            }) 
        }

    </script>
</body>

</html>
