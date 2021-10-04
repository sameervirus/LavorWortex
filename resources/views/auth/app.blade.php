<!DOCTYPE html> 
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RainDesigner Control Panel</title> 

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('vendors/build/css/custom.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style type="text/css">
        .login_content h1:after, .login_content h1:before {
            content: "";
            height: 1px;
            position: absolute;
            margin-top: 10px;
            width: 15%;
            top: inherit;
        }
    </style>
</head>
<body class="login">
    <div>
        <div id="register" class="animate form login_form">
            <section class="login_content" style="width: 350px;">

                <img src="http://raindesigner.com/images/logo.png">
                <h1>Website Control Panel</h1>
                <div class="separator"></div>
                
                <div class="clearfix"></div>
                
            </section>
            <div id="app">
                @yield('content')
            </div>
            <div class="separator">
                <div class="clearfix"></div>
                <br />                    
            </div>
            <div class="text-center">                 
                <p>©2020 All Rights Reserved. <a href="http://raindesigner.com" target="_blank">RainDesigner.com</a></p>
            </div>
        </div>
      </div>
    </div>


</body>
</html>