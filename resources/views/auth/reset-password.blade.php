<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

        <div class="d-flex align-items-center gap-4 mb-3">
            <h4 class="fs-3 mb-0">Đặt lại mật khẩu</h4>
            {{-- <a href="index.html">
                <img src="assets/images/logo.svg" alt="logo">
            </a> --}}
        </div>
        <p class="fs-18 mb-5">Mật khẩu mới phải khác với những mật khẩu trước đó của bạn.</p>
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="form-group mb-4">
                    <x-input-label class="label" for="password" :value="__('Mật khẩu mới')" />
                    <div class="form-group">
                        <div class="password-wrapper position-relative">
                            <x-text-input id="password" class="form-control h-58 text-dark" type="password"
                                name="password" required autocomplete="new-password" value="@password#" />
                            <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                                class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                aria-hidden="true"></i>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="form-group mb-0">
                    <x-input-label for="password_confirmation" class="label" :value="__('Xác nhận mật khẩu')" />

                    <div class="form-group">
                        <div class="password-wrapper position-relative">
                            <x-text-input id="password" class="form-control h-58 text-dark" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                                class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                aria-hidden="true"></i>
                        </div>
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>
        <x-primary-button type="submit"
            class="btn btn-primary fs-16 fw-semibold text-dark heading-fornt py-2 py-md-3 px-4 text-white w-100">
            {{ __('Cập nhật mật khẩu') }}
        </x-primary-button>
        <a href="{{route('login')}}" class="d-block text-center mt-3 text-decoration-none fs-16 text-primary">
            <i class="ri-arrow-left-s-line fs-16"></i>
            <span>{{ __('Trở lại đăng nhập') }}</span>
        </a>
    </form>
</x-guest-layout>
