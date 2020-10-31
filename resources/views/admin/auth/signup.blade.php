@extends('layouts.app')
@section('main')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Sign Up</h1>
                        </div>

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <span class="small">{!! implode('', $errors->all(':message <br />')) !!}</span>
                        </div>
                        @endif

                        <form class="user" action="{{ route('signup') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-user" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name='email' class="form-control form-control-user" placeholder="Email Address" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Repeat Password" required>
                                </div>
                            </div>
                            <input type='submit' value='Register Account' class="btn btn-primary btn-user btn-block">
                            </a>
                            <hr/>
                        </form>


                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="admin/login">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
