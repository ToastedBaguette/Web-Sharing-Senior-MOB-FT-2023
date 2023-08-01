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
                    @if($group == "")
                        <h3 class="title">NO REQUEST</h3>
                    @else
                        <h3 class="title" id="user">{{ $group->user->name }}</h3>
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
                            @if($group == "")
                                <button disabled class="red-button" id="button-a"><h2>A</h2></button>
                                <button disabled class="red-button" id="button-b"><h2>B</h2></button>
                            @else
                                <input type="hidden" name="group_id" id = "group_id" value="{{ $group->id }}">
                                <input type="hidden" name="senior_id" id = "senior_id" value="{{ $senior->id }}">
                                <input type="hidden" name="senior_status" id = "senior_status" value="{{ $senior->is_available }}">
                                <button class="red-button" id="button-a" onclick="response(1, '{{ $group->user->name }}')"><h2>A</h2></button>
                                <button class="red-button" id="button-b" onclick="response(0, '{{ $group->user->name }}')"><h2>B</h2></button>
                            @endif
                        </div>
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

        const response = (res,name) =>{
            let status = ''
            let group_id = $('#group_id').val()
            let senior_id = $('#senior_id').val()
            let senior_status = $('#senior_status').val()

            
            if(res == 1){
                status = 'ACCEPTED'
                if (!confirm("Are you sure to ACCEPT " + name + "?")) return
                
                if(senior_status == 0){
                    alert('You have accepted a group before, if you want to accept this group, then cancel the previous one')
                    return
                }
            }else{
                status = 'REJECTED'
                if (!confirm("Are you sure to REJECT " + name + "?")) return
            }

            $.ajax({
                type: 'POST',
                url: '{{ route("send.response") }}',
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
</body>
</html>