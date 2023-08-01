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
        <button class="nes-btn is-error" id="btn-logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <div class="gameboy mt-5">
            <div class="screen-container">
                <div class="green-dot-socket">
                    <div class="green-dot"></div>
                </div>
                <div class="screen">
                    @if ($group == '')
                        <h3 class="title">NO REQUEST</h3>
                    @else
                        <h3 class="title" id="user">{{ $group->user->name }}</h3>
                        <ul>
                            <li class="screen-text">Press A to Accept</li>
                            <li class="screen-text">Press B to Decline</li>
                        </ul>
                    @endif
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
                            @if ($group == '')
                                <button disabled class="red-button" id="button-a">
                                    <h2>A</h2>
                                </button>
                                <button disabled class="red-button" id="button-b">
                                    <h2>B</h2>
                                </button>
                            @else
                                <input type="hidden" name="group_id" id="group_id" value="{{ $group->id }}">
                                <input type="hidden" name="senior_id" id="senior_id" value="{{ $senior->id }}">
                                <input type="hidden" name="senior_status" id="senior_status"
                                    value="{{ $senior->is_available }}">
                                <button class="red-button" id="button-a"
                                    onclick="response(1, '{{ $group->user->name }}')">
                                    <h2>A</h2>
                                </button>
                                <button class="red-button" id="button-b"
                                    onclick="response(0, '{{ $group->user->name }}')">
                                    <h2>B</h2>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="history-wrapper">
                        <button type="button" class="gray-button" id="history-button" data-toggle="modal" data-target="#staticBackdrop"></button>
                        <label for="history-button" id="history-text">History</label>
                    </div>
                </div>

            </div>
        </div>
    </div>
    

    <script src="../js/app.js"></script>
    <script type="text/javascript">
        window.Echo.channel('send-request.' + {{ $senior->id }}).listen('.request', (e) => {
            alert('There is an incoming request')
            location.reload()
        })

        const response = (res, name) => {
            let status = ''
            let group_id = $('#group_id').val()
            let senior_id = $('#senior_id').val()
            let senior_status = $('#senior_status').val()


            if (res == 1) {
                status = 'ACCEPTED'
                if (!confirm("Are you sure to ACCEPT " + name + "?")) return

                if (senior_status == 0) {
                    alert(
                        'You have accepted a group before, if you want to accept this group, then cancel the previous one')
                    return
                }
            } else {
                status = 'REJECTED'
                if (!confirm("Are you sure to REJECT " + name + "?")) return
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('send.response') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'group_id': group_id,
                    'senior_id': senior_id,
                    'status': status,
                },
                success: function(data) {
                    location.reload()
                }
            })
        }
    </script>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <section class="accepted-section">
                <h4>=== Accepted ===</h4>
                @if($accepted != '')
                    <div class="row">
                        <div class="col">
                            {{$accepted_user->name}}
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>              
                @endif
            </section>
            <section class="rejected-section">
                <h4>=== Rejected ===</h4>
                <ul>
                    <li>Kelompok 2</li>
                    <li>Kelompok 3</li>
                </ul>
            </section>
          
        </div>
        <div class="modal-footer">
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
