<x-guest-layout>
    <div class="login-box">
        <div class="login-logo">
            <div class="login-logo">
                <img src="{{ asset('img/app-logo.png') }}" alt="login">
            </div>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if (session('status'))
                <div class="login-box-msg">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-1">
                        <x-jet-button class="btn btn-warning btn-block">
                            {{ __('Email Password Reset Link') }}
                        </x-jet-button>
                    </div>
                    <p class="mb-1">
                        <a class="text-sm" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </p>
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
