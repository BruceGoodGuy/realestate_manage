<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Thêm mới bài viết</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Bài viết</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fs-18 mb-4">Thông tin</h4>
                    <form method="POST" class="" novalidate action="{{ route('client.store') }}"
                        id="save-client">
                        @method('post')
                        @csrf
                        <div class="row">
                            <x-general-error :generalerrors="[]"></x-general-error>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Họ <span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="lastname"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('lastname'))) is-invalid @endif"
                                            placeholder="Nguyen Van" value="{{ old('lastname') }}">
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
                                        <input type="text" name="firstname" value="{{ old('firstname') }}"
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
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('phone'))) is-invalid @endif"
                                            placeholder="03xxxxxx">
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
                                        <label class="label">Mật khẩu <span class="text-danger">*</span></label>
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
                                            placeholder="bob@company.com" value="{{ old('email') }}">
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
                                                name="birthday"
                                                value="@if (!old('birthday')) {{ '1995-11-11' }}@else{{ old('birthday', date('Y-m-d')) }} @endif">
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
                                            placeholder="Nhập địa chỉ" value="{{ old('address') }}">
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
                                            placeholder="Nhập mã giới thiệu" value="{{ old('referral_code') }}">
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
                                            rows="5">{{ old('note') }}</textarea>
                                        <i
                                            class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="active" value="true"
                                        id="flexCheckDefault" checked disabled>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kích hoạt
                                    </label>
                                </div>
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
        <script defer type="text/javascript">
            const loadingElement = `<option value="" disabled class="text-dark option-loading">Đang tải...</option>`,
                provinceElement = document.querySelector('select[name="province"]'),
                districtElement = document.querySelector('select[name="district"]'),
                wardElement = document.querySelector('select[name="ward"]'),
                formElement = document.getElementById('save-client'),
                referralElement = document.querySelector('input[name="referral_code"]'),
                btnReferral = document.getElementById('btn-check-referral'),
                referralInformElement = document.querySelector('.referral-inform'),
                addressData = {
                    province: '',
                    district: '',
                    ward: ''
                };
            let oldProvince = "{{ old('province', $client->province ?? '') }}",
                oldDistrict = "{{ old('district', $client->district ?? '') }}",
                oldWard = "{{ old('ward', $client->ward ?? '') }}";

            provinceElement.addEventListener('click', populateOptions.bind(null, 'provinces'));
            provinceElement.addEventListener('change', updateDistricts);
            districtElement.addEventListener('click', populateOptions.bind(null, 'districts'));
            districtElement.addEventListener('change', updateWards);
            wardElement.addEventListener('click', populateOptions.bind(null, 'wards'));
            btnReferral.addEventListener('click', checkReferralCode);

            const clickEvent = new Event('click');
            if (oldProvince !== '') {
                provinceElement.dispatchEvent(clickEvent);
                districtElement.removeAttribute('disabled');
            }


            formElement.addEventListener('submit', function(e) {
                e.preventDefault();
                const province = provinceElement.value !== '' ? provinceElement.options[provinceElement.selectedIndex]
                    .text : '';
                const district = districtElement.value !== '' ? districtElement.options[districtElement.selectedIndex]
                    .text : '';
                const ward = wardElement.value !== '' ? wardElement.options[wardElement.selectedIndex]
                    .text : '';
                document.querySelector('input[name="province_value"]').value = province;
                document.querySelector('input[name="district_value"]').value = district;
                document.querySelector('input[name="ward_value"]').value = ward;
                this.submit();
            });

            function populateOptions(dataType, event) {
                const targetElement = event.target;
                if (targetElement.options.length > 1) {
                    return;
                }
                targetElement.insertAdjacentHTML('beforeend', loadingElement);

                let url = '';
                if (dataType === 'provinces') {
                    url = '{{ env('PUBLIC_API') }}provinces';
                } else if (dataType === 'districts') {
                    url = '{{ env('PUBLIC_API') }}districts?' + new URLSearchParams({
                        province_code: provinceElement.value === "" ? oldProvince : provinceElement.value,
                    });
                } else if (dataType === 'wards') {
                    url = '{{ env('PUBLIC_API') }}wards?' + new URLSearchParams({
                        district_code: districtElement.value === "" ? oldDistrict : districtElement.value,
                    });
                }

                callAPI(url, function(data) {
                    let optionTemplate = '';
                    const items = data.data;
                    if (dataType === 'provinces') {
                        provicesData = data.data;
                    }
                    items.map(item => {
                        let name = item.name,
                            isSelected = false;
                        if (dataType === 'provinces') {
                            name = name.replace('Tỉnh ', '').replace('Thành phố ', '');
                            isSelected = oldProvince !== '' && (oldProvince === item.code || oldProvince ===
                                name);
                            if (isSelected) {
                                if (!(/^-?\d*\.?\d+$/.test(oldDistrict))) {
                                    oldProvince = item.code;
                                }
                                districtElement.dispatchEvent(clickEvent);
                                wardElement.removeAttribute('disabled');
                            }
                        } else if (dataType === 'districts') {
                            isSelected = oldDistrict !== '' && (oldDistrict === item.code || oldDistrict ===
                                item.name);
                            if (isSelected) {
                                if (!(/^-?\d*\.?\d+$/.test(oldDistrict))) {
                                    oldDistrict = item.code;
                                }
                                wardElement.dispatchEvent(clickEvent);
                            }
                        } else if (dataType === 'wards') {
                            isSelected = oldWard !== '' && (oldWard === item.code || oldWard === item.name);
                        }
                        optionTemplate +=
                            `<option value="${item.code}" ${isSelected ? 'selected' : ''}  class="text-dark">${name}</option>`;
                    });
                    targetElement.insertAdjacentHTML('beforeend', optionTemplate);
                }, function() {
                    targetElement.querySelector('option.option-loading').remove();
                });
            }

            function checkReferralCode(e) {
                const referralCode = referralElement.value.trim();
                if (referralCode.length === 0 || referralCode.length < 10 || referralCode.length > 40) {
                    referralInformElement.classList.remove('d-none');
                    referralInformElement.classList.add('text-danger');
                    e.target.disabled = false;
                    referralInformElement.querySelector('span').innerText = 'Mã giới thiệu không hợp lệ.'
                    return;
                }
                referralInformElement.classList.add('d-none');
                e.target.disabled = true;

                const url = '{{ route('ajax.checkreferral') }}?' + new URLSearchParams({
                    code: referralCode,
                });

                callAPI(url, function(data) {
                    console.log(data.success);
                    if (data.success) {
                        referralInformElement.classList.remove('text-danger');
                        referralInformElement.classList.add('text-success');
                        referralInformElement.querySelector('span').innerText =
                            `Mã giới thiệu hợp lệ. (${data.data.firstname} ${data.data.lastname})`;
                    } else {
                        referralInformElement.classList.add('text-danger');
                        referralInformElement.classList.remove('text-success');
                        referralInformElement.querySelector('span').innerText =
                            `${data.message} | Nếu tiếp tục, bạn vẫn có thể tạo khách hàng này mà không cần mã giới thiệu.`
                    }
                    referralInformElement.classList.remove('d-none');
                    e.target.disabled = false;
                });

                console.log(url);

            }

            function updateDistricts(event) {
                const selectValue = event.target.value;
                if (selectValue === '') {
                    districtElement.setAttribute('disabled', true);
                } else {
                    districtElement.removeAttribute('disabled');
                }
                resetSelectElement(districtElement);
                wardElement.setAttribute('disabled', true);
                resetSelectElement(wardElement);
            }

            function updateWards(event) {
                const selectValue = event.target.value;
                if (selectValue === '') {
                    wardElement.setAttribute('disabled', true);
                } else {
                    wardElement.removeAttribute('disabled');
                }
                resetSelectElement(wardElement);
            }

            function resetSelectElement(element) {
                if (element.options.length > 1) {
                    element.querySelectorAll('option').forEach(option => {
                        if (!option.disabled) {
                            option.remove();
                        }
                    });
                    element.value = '';
                }
            }

            function callAPI(url, callBack, finallyCallback = null) {
                fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    .then(response => response.json())
                    .then(data => callBack(data))
                    .catch(error => console.error(error))
                    .finally(() => {
                        if (finallyCallback) {
                            finallyCallback();
                        }
                    });
            }
        </script>
    @endsection
</x-app-layout>
