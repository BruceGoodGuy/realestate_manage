<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="d-flex align-items-center gap-4 mb-3">
            <h4 class="fs-3 mb-0 text-center">Đăng Chánh Group.</h4>
            {{-- <a href="#">
                <img src="{{asset('assets/images/logo.svg')}}" alt="logo">
            </a> --}}
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="form-group mb-4">
                    <x-input-label for="email" class="label" :value="__('Email')" />
                    <x-text-input id="email" class="form-control h-58" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="form-group mb-0">
                    <x-input-label class="label" for="password" :value="__('Password')" />
                    <div class="form-group">
                        <div class="password-wrapper position-relative">
                            <x-text-input id="password" class="form-control h-58 text-dark"
                                type="password" name="password" required autocomplete="current-password" />
                            <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                            class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                            aria-hidden="true"></i>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-sm-flex justify-content-between mb-4">
            <div class="form-check">
                <x-text-input class="form-check-input position-relative" style="top: 1.1px;" type="checkbox" value
                id="flexCheckDefault" name="remember" />
                <x-input-label class="form-check-label fs-16 text-gray-light" for="flexCheckDefault" :value="__('Remember')" />
            </div>
            @if (Route::has('password.request'))
                <a class="fs-16 text-primary text-decoration-none mt-2 mt-sm-0 d-block" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif
        </div>
        <x-primary-button class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
