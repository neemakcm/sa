<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impex Admin</title>
    <link rel="stylesheet" href="{{asset('public/admins/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admins/login/css/style.css')}}">

     <link rel="icon" href="{{asset('public/admins/images/favicon.png')}}" type="image/gif" sizes="16x16">

</head>

<body>

    <section class="login-panel">

        <div class="d-md-flex h-100 ">

            <!-- First Half -->
            <div class="panel-left p-0 bg-indigo h-md-100">
                <div class="inner-wrap">
                    <div class="logoarea pt-5 pb-5">
                        <div class="logo-wrap">
                            <img src="{{asset('public/admins/login/img/logo/IMPEX-Logo-without-tag@2x.png')}}" class="img-fluid" alt="logo">
                        </div>
                        <div class="form-wrap">
                            <h4 class="wraper-title">Sign In <span class="text-narrow">To Admin</span></h4>

                            <form method="POST" name="loginForm" id="loginForm" action="{{ URL('admin/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-icon">
                                        <img src="{{asset('public/admins/login/img/icon/mail.png')}}" alt="icon">
                                    </div>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email Address">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="input-icon">
                                        <img src="{{asset('public/admins/login/img/icon/lock.png')}}" alt="icon">
                                    </div>
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                    @if($errors->any())
                                        <div class="has-danger text-danger">
                                            <strong class="form-control-feedback small muted">{{$errors->first()}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="btn-wrap">
                                    <button type="submit" class="btn-block sign-in-btn">Sign In</button>
                                </div>

                                <!-- <div class="text-center">
                                    <a href="" class="forgot-password">Forgot Password</a>
                                </div> -->
                            </form>
                        </div>
                        <div class="developer">
                            <div class="d-flex">
                                <div class="left-text align-self-center">
                                    <p>Powered By</p>
                                </div>
                                <div class="icon-right align-self-center">
                                    <a href="https://webcastletech.com" target="_blank">
                                        <img src="{{asset('public/admins/images/webcastle.svg')}}" width="100" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Half -->

            <div class="panel-right p-0 bg-white h-md-100 loginarea">
                <div style="background-image: url(../public/admins/login/img/bg/login.png);" class="bg-layer">
                    <div class="overlay"></div>
                </div>
            </div>

        </div>


    </section>

    <style>
        #loginForm input
        {
            color: black;
        }
    </style>

</body>

</html>