<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="d-flex align-items-center gap-4 mb-3">
            <h4 class="fs-3 mb-0">{{ __('Quên mật khẩu?') }}</h4>
            <a href="index.html">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
            </a>
        </div>
        <p class="fs-18 mb-5">
            {{ __('Điền email đã đăng kí và chúng tôi sẽ gởi hướng dẫn để cập nhật mật khẩu tới bạn') }}</p>
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="form-group">
                    <x-input-label for="email" class="label" :value="__('Email')" />
                    <div class="form-group">
                        <x-text-input id="email" class="form-control h-58" type="email" name="email"
                            :value="old('email')" required autofocus placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                    </div>
                </div>
            </div>
        </div>
        <x-primary-button type="submit"
            class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
            {{ __('Gởi liên kết') }}
        </x-primary-button>
        <a href="{{ route('login') }}" class="d-block text-center mt-3 text-decoration-none fs-16 text-primary">
            <i class="ri-arrow-left-s-line fs-16"></i>
            <span>{{ _('Quay lại trang đăng nhập') }}</span>
        </a>
    </form>
</x-guest-layout>
