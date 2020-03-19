<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #69C6FF;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                position: absolute;
                top: 0;
                left: 0;
                font-size: 35px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            label{
                display: block;
            }
            input{
                margin:10px 0;
            }
            .addchat{
                position: absolute;
                left: 10px;
                top: 80px;
            }
            .mychats{
                position: absolute;
                font-size: 33px;
                border: 1px dashed;
                padding: 0px 60px;
                top: 55px;

            }
            .mychats p{
                position: relative;
                bottom: 30px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <!-- <a href="/chat">Chat</a> -->
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/chat') }}">Chat</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Hello {{ Auth::user()->name }}
                </div>
                <form class="addchat">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Creat chate name</label>
                        <input id="text" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                    </div>
                    <button onclick="myFunction()" id="create" type="submit" class="btn btn-primary create">New Chat</button>
                </form>
            </div>
            <div class="mychats">
                <p >My chats</p>
            </div>
        </div>
        <script src="js/my.js"></script>
    </body>
</html>
