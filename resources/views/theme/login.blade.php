@extends('theme.master')
@section('title','Login')
@section('content')

@include('theme.partials.hero')
<!-- ================ contact section start ================= -->
<section class="section-margin--small section-margin">
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="{{ route('login.store') }}" class="form-contact contact_form" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <input class="form-control border" name="email" id="email" type="email" value="{{ old('email') }}" placeholder="Enter email address">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control border" name="password" type="password" placeholder="Enter your password">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-center text-md-right mt-3">
                        <a href="{{ route('register') }}" class="mx-3">Signup instead ?</a>
                        <button type="submit" class="button button--active button-contactForm">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->
@endsection
