@extends('auth.panel')

@section('head')
    <title>laundryku - Login your account</title>
@endsection

@section('body')
    <form action="{{ route('signup.post')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="login-container">
            <div class="login-head">
                <div class="text-start">
                    <h2>SIGNUP</h2>
                    <p class="mb-0">Welcome in register form</p>
                </div>
            </div>
            <div class="login-body">
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror">
                    @error('username')
                        <span class="invalid-feedback text-capitalize">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback text-capitalize">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback text-capitalize">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password_confirmation" class="form-label">Confirmed Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <span class="invalid-feedback text-capitalize">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary form-control">SUBMIT</button>
            </div>
            <div class="login-footer">
                <div class="d-block text-center">
                    <p class="mb-0">Already have an account? Click here</p>
                    <a href="{{ route('login') }}" style="text-decoration: none;">LOGIN</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection
