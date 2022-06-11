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
                <p class="login-box-msg">Register a new membership</p>
                @if (session('status'))
                <div class="login-box-msg">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" autocomplete="name" placeholder="Name" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="New Password"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Retype Password"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <x-jet-validation-errors class="alert alert-danger mt-1 mb-1" />

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms"/>

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif
                    <div class="col-12 my-2">
                        <x-jet-button class="btn btn-primary btn-block">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                    <p class="mt-1">
                        <a class="text-sm" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </p>
                </div>
            </form>
            </div>
        </div>
    </div>
</x-guest-layout>
