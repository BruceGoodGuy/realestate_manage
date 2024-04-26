<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Tài khoản</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Tài khoản</span>
            </li>
        </ul>
    </div>
    @php
        $isprofile = request()->setting !== 'password';
    @endphp
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-semibold fs-18 border-bottom pb-20 mb-20">Tài khoản</h4>
                    <ul class="ps-0 mb-4 list-unstyled d-sm-flex gap-3">
                        <li>
                            <a href="{{ route('profile.edit', ['setting' => 'profile']) }}"
                                class="btn btn-primary bg-primary py-2 px-3 border-0 fw-semibold w-sm-100 d-inline-block @if (!$isprofile) text-primary bg-opacity-10 @else text-white @endif">Thông
                                tin</a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit', ['setting' => 'password']) }}"
                                class="btn btn-primary bg-primary  py-2 px-3 border-0 fw-semibold w-sm-100 d-inline-block mt-2 mt-sm-0 @if ($isprofile) text-primary bg-opacity-10 @else text-white @endif">Mật
                                khẩu</a>
                        </li>
                    </ul>

                    @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                        <div class="alert alert-success text-success" role="alert">
                            <i class="ri-play-circle-line fs-18 me-1"></i>
                            Đã cập nhật thành công
                        </div>
                    @endif

                    @if (request()->setting !== 'password')
                        <div class="border-bottom pb-3 mb-3">
                            <h4 class="fs-18 fw-semibold mb-1">Profile</h4>
                            <p class="fs-15">Cập nhật thông tin tài khoản.</p>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Tên</label>
                                        <div class="form-group position-relative">
                                            <input name="name" type="text"
                                                class="form-control text-dark ps-5 h-58" placeholder="Nhập tên"
                                                value="{{ old('name', $user->name) }}" required autofocus
                                                autocomplete="name">
                                            <i
                                                class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                        @if (!empty($errors->get('name')))
                                            <div class="alert alert-danger text-danger mt-3" role="alert">
                                                @foreach ($errors->get('name') as $error)
                                                    <p class="mb-1">
                                                        <i class="ri-service-line fs-18 me-1"></i>
                                                        {{ $error }}
                                                    </p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Địa chỉ email</label>
                                        <div class="form-group position-relative">
                                            <input name="email" type="email"
                                                class="form-control text-dark ps-5 h-58"
                                                placeholder="Nhập địa chỉ email"
                                                value="{{ old('email', $user->email) }}" required
                                                autocomplete="username">
                                            <i
                                                class="ri-mail-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                            @if (!empty($errors->get('email')))
                                                <div class="alert alert-danger text-danger mt-3" role="alert">
                                                    @foreach ($errors->get('email') as $error)
                                                        <p class="mb-1">
                                                            <i class="ri-service-line fs-18 me-1"></i>
                                                            {{ $error }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="border-bottom pb-3 mb-3">
                            <h4 class="fs-18 fw-semibold mb-1">Bảo mật</h4>
                            <p class="fs-15">Cập nhật mật khẩu.</p>
                        </div>
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Mật khẩu cũ</label>
                                        <div class="form-group">
                                            <div class="password-wrapper position-relative">
                                                <input type="password" id="password" name="current_password"
                                                    class="form-control h-58 text-dark">
                                                <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                                                    class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($errors->updatePassword->get('current_password')))
                                        <div class="alert alert-danger text-danger mt-3" role="alert">
                                            @foreach ($errors->updatePassword->get('current_password') as $error)
                                                <p class="mb-1">
                                                    <i class="ri-service-line fs-18 me-1"></i>
                                                    {{ $error }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label">Mật khẩu mới</label>
                                        <div class="form-group">
                                            <div class="password-wrapper position-relative">
                                                <input type="password" id="password"
                                                    class="form-control h-58 text-dark" name="password">
                                                <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                                                    class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($errors->updatePassword->get('password')))
                                        <div class="alert alert-danger text-danger mt-3" role="alert">
                                            @foreach ($errors->updatePassword->get('password') as $error)
                                                <p class="mb-1">
                                                    <i class="ri-service-line fs-18 me-1"></i>
                                                    {{ $error }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label">Xác nhận mật khẩu</label>
                                        <div class="form-group">
                                            <div class="password-wrapper position-relative">
                                                <input type="password" id="password"
                                                    class="form-control h-58 text-dark" name="password_confirmation">
                                                <i style="color: #A9A9C8; font-size: 16px; right: 15px !important;"
                                                    class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 end-0 position-absolute"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($errors->updatePassword->get('password_confirmation')))
                                        <div class="alert alert-danger text-danger mt-3" role="alert">
                                            @foreach ($errors->updatePassword->get('password_confirmation') as $error)
                                                <p class="mb-1">
                                                    <i class="ri-service-line fs-18 me-1"></i>
                                                    {{ $error }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group d-flex gap-3">
                                        <button class="btn btn-primary py-3 px-5 fw-semibold text-white">Cập nhật mật
                                            khẩu</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
