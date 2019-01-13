@extends('layouts.master')

@section('title', 'Home - UdaipurRealtors.com')

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Dashboard</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>My Profile</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Content
================================================== -->
<div class="container">
    <div class="row">
        <!-- Widget -->
        @include('partials.dashboard-sidebar')
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 my-profile">
                    <h4 class="margin-top-0 margin-bottom-30">My Account</h4>
                    @if (count($errors))
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('profile.update') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <label>Your Name</label>
                        <input value="{{ $user->name }}" name="name" type="text">
                        <label>Mobile</label>
                        <input value="{{ $user->mobile }}" name="mobile" type="text">
                        <label>Email</label>
                        <input value="{{ $user->email }}" name="email" type="text">
                        <label>Password</label>
                        <input type="password" name="password">
                        <label>Password Confirmation</label>
                        <input type="password" name="password_confirmation">
                        <button class="button margin-top-20 margin-bottom-20" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection