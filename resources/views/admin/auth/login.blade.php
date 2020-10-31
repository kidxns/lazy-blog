@extends('layouts.app')
@section('main')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="{{ route('login') }}" method="POST" name="loginForm">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name='email' aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required />
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <span class="small">{!! implode('', $errors->all(':message <br />'))
                                            !!}</span>
                                    </div>
                                    @endif
                                    <input type='submit' class="btn btn-primary btn-user btn-block bnt-login" value="Login" />


                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="admin/signup">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
{{-- <script>
        $(document).ready(function() {
            const csrf = $('meta[name="csrf-token"]').attr('content');
            $(document).on('click', '.bnt-login', function(e) {
                const email = $('#email').val();
                const password = $('#password').val();
                $.ajax({
                    url: '{{ route('
                    login ') }}',
method: 'POST',
data: {
'email': email,
'password': password,
'_token': csrf
},
success: function(res) {
console.log(res);

}
})

});

});

</script> --}}
@endsection
