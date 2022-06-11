<x-guest-layout>
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('img/app-logo.png') }}" alt="login">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">TAU CMS Login</p>
                @if (session('status'))
                <div class="login-box-msg">
                    {{ session('status') }}
                </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password"  placeholder="Password"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <label for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col-12 my-2">
                            <x-jet-button class="btn btn-primary btn-block">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </div>
                    <x-jet-validation-errors class="alert alert-danger mt-1 mb-1" />
                    @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a class="underline text-sm" href="{{ route('password.request') }}">
                            {{ __('I forgot my password') }}
                        </a>
                    </p>
                    @endif
                    @if (Route::has('register'))
                    <p class="mb-1">
                        <a class="underline text-sm " href="{{ route('register') }}">
                            {{ __('Register a new user') }}
                        </a>
                    </p>
                    @endif
                </form> 
            </div>
        </div>
    </div>
</x-guest-layout>
