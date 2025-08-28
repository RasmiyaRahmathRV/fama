@extends('layout.login_master')


@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('images/fg.png') }}" height="100px">
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if ($errors->any())
                    <div id="toast-container" class="toast-top-right" data-bs-delay="2000" data-bs-autohide="true">
                        <div class="toast toast-error" aria-live="polite" style="">
                            @foreach ($errors->all() as $error)
                                <div class="toast-message">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (session()->has('message'))
                    <div id="toast-container" class="toast-top-right" data-bs-delay="2000" data-bs-autohide="true">
                        <div class="toast {{ session()->get('status') == 'success' ? 'toast-success' : 'toast-error' }}"
                            aria-live="polite" style="">
                            <div class="toast-message">{{ session()->get('message') }}
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('do.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-info btn-block">Sign In</button>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{ route('forgot.password') }}">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
