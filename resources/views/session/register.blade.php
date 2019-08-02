<!DOCTYPE html>
<html>

<!-- Mirrored from dreamguys.co.in/smarthr/blue/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Oct 2018 21:02:20 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('assets/img/favicon.png')}}">
    <title>Tenga Now</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/style.css')}}">
    <!--[if lt IE 9]-->
    <script src="{{URL::to('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{URL::to('assets/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
<div class="main-wrapper">
    <div class="account-page">
        <div class="container">
            <h3 class="account-title">Register Here</h3>
            <div class="account-box">
                <div class="account-wrapper">
                    <div class="account-logo">
                        <a href="index-2.html"><img src="{{URL::to('assets/img/logo2.png')}}" alt="Tenga Now"></a>
                    </div>
                    @if(Session::has('message'))
                        <div class="alert alert-success">  {{Session::get('message')}}        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-success">  {{Session::get('error')}}        </div>
                    @endif
                    <form method="post" action="{{route('register')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group form-focus">
                            <label class="control-label"> Name</label>
                            <input class="form-control floating" type="text" name="name" required>
                        </div>
                        <div class="form-group form-focus">
                            <label class="control-label"> Surname</label>
                            <input class="form-control floating" type="text" name="surname" required>
                        </div>

                        <div class="form-group form-focus">
                            <label class="control-label">Email</label>
                            <input class="form-control floating" type="email" name="email" required>
                        </div>
                        <div class="form-group form-focus">
                            <label class="control-label">Phonenumber</label>
                            <input class="form-control floating" type="number" name="phonenumber" required>
                        </div>
                        <div class="form-group form-focus">
                            <label class="control-label">Token</label>
                            <input class="form-control floating" type="text" name="token" required>
                        </div>

                        <div class="form-group form-focus">
                            <label class="control-label">Password</label>
                            <input class="form-control floating" type="password" name="password" required>
                        </div>
                        <div class="form-group form-focus">
                            <label class="control-label">Confirm Password</label>
                            <input class="form-control floating" type="password" name="confirm_password" required>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block account-btn" type="submit">Register</button>
                        </div>
                        <div class="text-center">
                            <a href="{{route('login')}}">Back To Login?</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>
<script type="text/javascript" src="{{URL::to('assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/app.js')}}"></script>
</body>

<!-- Mirrored from dreamguys.co.in/smarthr/blue/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Oct 2018 21:02:20 GMT -->
</html>
