@extends("layouts.master")
@section("main")

    <form class="login100-form validate-form" method="post" action="{{url('post-login')}}">
        @csrf
        <span class="login100-form-title p-b-55">
						Login
					</span>
        <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="Email">
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
            <span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
        </div>
        <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="password">{{ $errors->first('password') }}</span>
            @endif
            <span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
			</span>
        </div>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <div class="container-login100-form-btn p-t-25">
            <button class="login100-form-btn">Login</button>
        </div>
        <div class="text-center w-full p-t-42 p-b-22">
						<span class="txt1">Or login with</span>
        </div>
        <a href="login/facebook" class="btn-face m-b-10">
            <i class="fa fa-facebook-official"></i>Facebook
        </a>
        <a href="redirect" class="btn-google m-b-10">
            <img src="{{ asset('public/images/icons/icon-google.png') }}" alt="GOOGLE">
            Google
        </a>
        <div class="text-center w-full p-t-115">
						<span class="txt1">Not a member?</span>
            <a class="txt1 bo1 hov1" href="#">Sign up now</a>
        </div>
    </form>
@endsection()