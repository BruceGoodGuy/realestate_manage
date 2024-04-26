<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Chỉnh sửa khách hàng</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="{{ route('client.index') }}" class="text-decoration-none">
                    <span class="fs-14 ms-2">Khách hàng</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Chỉnh sửa</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fs-18 mb-4">Thông tin</h4>
                    <form method="POST" class="" novalidate action="{{ route('client.update', $client->id) }}"
                        id="save-client">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <x-general-error :generalerrors="[]"></x-general-error>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Họ <span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="lastname"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('lastname'))) is-invalid @endif"
                                            placeholder="Nguyen Van" value="{{ old('lastname', $client->lastname) }}">
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('lastname')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('lastname') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Tên<span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="firstname"
                                            value="{{ old('firstname', $client->firstname) }}"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('firstname'))) is-invalid @endif"
                                            placeholder="A">
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('firstname')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('firstname') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Số điện thoại <span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="phone" value="{{ old('phone', $client->phone) }}"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('phone'))) is-invalid @endif"
                                            placeholder="03xxxxxx" disabled>
                                        <i class="ri-phone-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('phone')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('phone') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <div class="form-group position-relative">
                                        <label class="label">Mật khẩu (Điền vào để cập nhật)</label>
                                        <div class="form-group position-relative">
                                            <div class="password-wrapper position-relative">
                                                <input type="password" name="password" id="password"
                                                    class="form-control h-58 text-dark ps-5 @if (!empty($errors->get('password'))) is-invalid @endif">
                                                <i style="color: #A9A9C8; font-size: 16px; right: @if (!empty($errors->get('password'))) 30px !important; @else 15px !important; @endif"
                                                    class="password-toggle-icon translate-middle-y top-50 end-0 position-absolute ri-eye-off-line"
                                                    aria-hidden="true"></i>
                                                @if (!empty($errors->get('password')))
                                                    <div class="invalid-feedback">
                                                        @foreach ($errors->get('password') as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <i class="ri-lock-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                                style="top: 28px !important;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Email</label>
                                    <div class="form-group position-relative">
                                        <input name="email" type="email"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('email'))) is-invalid @endif"
                                            placeholder="bob@company.com" value="{{ old('email', $client->email) }}">
                                        <i class="ri-mail-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('email')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('email') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <div class="form-group position-relative">
                                        <label class="label">Sinh nhật</label>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control text-dark ps-5 h-58"
                                                name="birthday" value="{{ old('birthday', $client->birthday) }}">
                                            <i
                                                class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label">Địa chỉ</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="address" class="form-control text-dark ps-5 h-58"
                                            placeholder="Nhập địa chỉ"
                                            value="{{ old('address', $client->address) }}">
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label">Tỉnh </label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58"
                                            aria-label="Chọn tỉnh thành" name="province">
                                            <option value="" disabled selected>Chọn tỉnh thành</option>
                                        </select>
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label class="label">Huyện</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Chọn huyện"
                                            disabled name="district">
                                            <option value="" disabled selected>Chọn huyện</option>
                                        </select>
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label class="label">Xã/Phường</label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Chọn xã"
                                            disabled name="ward">
                                            <option value="" disabled selected>Chọn xã/Phường</option>
                                        </select>
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="form-group">
                                    <span class="text-success">Địa chỉ dùng để gợi ý bất động sản</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="form-group mb-0">
                                    <label class="label">Mã giới thiệu:</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="referral_code"
                                            class="form-control text-dark ps-5 pe-5 h-58" maxlength="40"
                                            placeholder="Nhập mã giới thiệu"
                                            value="{{ old('referral_code', $client->refuser->referral_code ?? '') }}">
                                        <button type="button" id="btn-check-referral"
                                            class="position-absolute top-50 end-0 translate-middle-y bg-primary p-0 border-0 text-center text-white rounded-pill px-3 py-2 me-2 fw-semibold">
                                            Kiểm tra
                                        </button>
                                        <i
                                            class="ri-pass-valid-fill position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                    <p class="referral-inform d-none">
                                        <span></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="label">Ghi chú :</label>
                                    <div class="form-group position-relative">
                                        <textarea class="form-control ps-5 text-dark" name="note" placeholder="Ghi chú bất kì ... " cols="30"
                                            rows="5">{{ old('note', $client->note) }}</textarea>
                                        <i
                                            class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 mt-3">
                                <label class="label">Trạng thái :</label>
                                <x-client-status :status="$client->status"></x-client-status>
                                <select class="form-select form-control ps-5 h-58" aria-label="Trạng thái"
                                    name="status">
                                    {{-- lazy --}}
                                    <option value="0" @if ($client->status == 0) selected @endif>Chưa kích
                                        hoạt</option>
                                    <option value="1" @if ($client->status == 1) selected @endif>Kích hoạt
                                    </option>
                                    <option value="2" @if ($client->status == 2) selected @endif>Chặn
                                    </option>
                                </select>
                            </div>
                            <input type="hidden" name="province_value" value="">
                            <input type="hidden" name="district_value" value="">
                            <input type="hidden" name="ward_value" value="">
                            <div class="col-lg-12 mt-3">
                                <button type="submit"
                                    class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">Lưu</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('javascript')
        <x-referral-script></x-referral-script>
        <x-location-script :province="old('province', $client->province ?? '')" :district="old('district', $client->district ?? '')" :ward="old('ward', $client->ward ?? '')" :selector="'save-client'"></x-location-script>
    @endsection
</x-app-layout>
