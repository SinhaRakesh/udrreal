@extends('layouts.master')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Log In &amp; Register</h2>
                
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Log In &amp; Register</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Contact
================================================== -->
<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!--Tab -->
            <div class="my-account style-1 margin-top-5 margin-bottom-40">
                <ul class="tabs-nav">
                    <li class=""><a href="#tab1">Log In</a></li>
                    <li><a href="#tab2">Register</a></li>
                </ul>
                <div class="tabs-container alt">
                    <!-- Login -->
                    <div class="tab-content" id="tab1" style="display: none;">
                        @if (count($errors))
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <a href="/login/google" class="button border margin-bottom-5" style="width:100%;text-align:center;">
                            <i class="icon-gplus" style="
                                font-family: Fontello;
                                font-style: normal;
                            "></i>
                            Login With Google
                        </a>
                        <hr>
                        <form method="post" class="login" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <p class="form-row form-row-wide">
                                <label for="email">Email:
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text" name="email" id="email" value="" />
                                </label>
                            </p>
                            <p class="form-row form-row-wide">
                                <label for="password">Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password" id="password"/>
                                </label>
                            </p>
                            <p class="form-row">
                                <label for="rememberme" class="rememberme">
                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
                                </p>
                                <input type="submit" class="button border margin-top-10" name="login" value="Login" />
                                <p class="lost_password">
                                    <a href="{{ route('password.request') }}" >Lost Your Password?</a>
                                </p>
                                
                            </form>
                        </div>
                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">
                            <a href="/login/google" class="button border margin-bottom-5" style="width:100%;text-align:center;">
                                <i class="icon-gplus" style="
                                    font-family: Fontello;
                                    font-style: normal;
                                "></i>
                                Login With Google
                            </a>
                            <hr>
                            <form method="post" class="register" action="{{ url('/register') }}">
                                {{ csrf_field() }}
                                <p class="form-row form-row-wide">
                                    <label for="username2">Name:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="name" id="name2" value="" />
                                    </label>
                                </p>
                                
                                <p class="form-row form-row-wide">
                                    <label for="email2">Email Address:
                                        <i class="im im-icon-Mail"></i>
                                        <input type="text" class="input-text" name="email" id="email2" value="" />
                                    </label>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="mobile">mobile:
                                        <i class="im im-icon-Smartphone-2"></i>
                                        <input class="input-text" type="number" name="mobile" id="mobile"/>
                                    </label>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password1">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password1"/>
                                    </label>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password2">Repeat Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password_confirmation" id="password2"/>
                                    </label>
                                </p>
                                <p class="form-row">
                                    <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container / End -->
    @endsection