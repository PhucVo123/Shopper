@extends('login.index_login')
@section('login')

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Login to your account</h2>
                <?php
                            use Illuminate\Support\Facades\Session;
                            $message_login = Session::get('message_login');
                            $message_logup = Session::get('message_logup');
                            if($message_login)
                            {
                                echo '<span class="text-danger w-100 text-center">'. $message_login .'</span>';
                                Session::put('message_login',null);
                            }
                ?>
                <form role="form" action="{{URL::to('save-login')}}" method="post">
                {{ csrf_field() }}
                    <input name="username" type="text" placeholder="Name" required/>
                    <input name="pwd" type="password" placeholder="Password" required />
                    <span>
                        <input type="checkbox" class="checkbox"> 
                        Keep me signed in
                    </span>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div><!--/login form-->
        </div>
        <div class="col-sm-1">
            <h2 class="or">OR</h2>
        </div>
        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->
                <h2>New User Signup!</h2>
                <?php
                    if($message_logup)
                    {
                        echo '<span class="text-danger w-100 text-center">'. $message_logup .'</span>';
                        Session::put('message_logup',null);
                    }
                ?>
                <form role="form" action="{{URL::to('save-logup')}}" method="post">
                {{ csrf_field() }}
                    <input name="username" type="text" placeholder="Name" required/>
                    <input name="email" type="email" placeholder="Email Address" required/>
                    <input name="pwd" type="password" placeholder="Password" required/>
                    <button type="submit" class="btn btn-default">Signup</button>
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
</div>

@endsection