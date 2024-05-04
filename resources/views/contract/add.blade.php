<x-app-layout>
    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2.select2-container {
                width: 100% !important;
            }

            .select2.select2-container .select2-selection {
                border: 1px solid #ccc;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                height: inherit;
                /* margin-bottom: 15px; */
                outline: none !important;
                transition: all .15s ease-in-out;
            }

            .select2.select2-container .select2-selection .select2-selection__rendered {
                color: #333;
                line-height: 58px;
                padding-right: 33px;
            }

            .select2.select2-container .select2-selection .select2-selection__arrow {
                background: #f8f8f8;
                border-left: 1px solid #ccc;
                -webkit-border-radius: 0 3px 3px 0;
                -moz-border-radius: 0 3px 3px 0;
                border-radius: 0 3px 3px 0;
                height: 58px;
                width: 33px;
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            .select2.select2-container .select2-selection.select2-selection--single {
                border-radius: 10px;
            }

            .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
                background: #f8f8f8;
            }

            .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
                -webkit-border-radius: 0 3px 0 0;
                -moz-border-radius: 0 3px 0 0;
                border-radius: 0 10px 0 0;
            }

            .select2-container .select2-dropdown {
                background: transparent;
                border: none;
                margin-top: -5px;
            }

            .select2-container .select2-dropdown .select2-search {
                padding: 0;
            }

            .select2-container .select2-dropdown .select2-search input {
                outline: none !important;
                border: 1px solid #34495e !important;
                border-bottom: none !important;
                padding: 4px 6px !important;
            }

            .select2-container .select2-dropdown .select2-results {
                padding: 0;
            }

            .select2-container .select2-dropdown .select2-results ul {
                background: #fff;
                border: 1px solid #34495e;
            }

            .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
                background-color: #3498db;
            }
        </style>
    @endsection
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Thêm mới hợp đồng</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Hợp đồng</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fs-18 mb-4">Thông tin</h4>
                    <form method="POST" class="" novalidate action="{{ route('contract.store') }}"
                        id="save-contract">
                        @method('post')
                        @csrf
                        <div class="row">
                            <x-general-error :generalerrors="[]"></x-general-error>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Tên hợp đồng <span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="name"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('name'))) is-invalid @endif"
                                            placeholder="HD" value="{{ old('name') }}">
                                        <i class="ri-user-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('name')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('name') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mb-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Bất động sản <span class="text-danger">*</span></label>
                                        <div class="form-group position-relative">
                                            <select
                                                class="form-select form-control ps-5 h-58 @if (!empty($errors->get('property_id_value'))) is-invalid @endif"
                                                name="property_id">
                                                <option value="{{ null }}">Chọn bất động sản</option>
                                                @foreach ($properties as $key => $areas)
                                                    <optgroup label="{{ $key === '' ? 'Khác' : $key }}">
                                                        @foreach ($areas as $area)
                                                            <option value="{{ $area->pid }}"
                                                                data-price="{{ $area->price }}">
                                                                {{ $area->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            @if (!empty($errors->get('property_id_value')))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('property_id_value') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mb-4">
                                    <div class="form-group mb-4">
                                        <label class="label">Khách hàng <span class="text-danger">*</span></label>
                                        <div class="form-group position-relative">
                                            <select
                                                class="form-select form-control ps-5 h-58 @if (!empty($errors->get('client_id_value'))) is-invalid @endif"
                                                name="client_id">
                                                <option value="{{ null }}">Chọn khách hàng</option>
                                                @foreach ($clients as $key => $client)
                                                    <option value="{{ $client }}">
                                                        {{ $client->lastname . ' ' . $client->firstname . ' (' . $client->phone . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if (!empty($errors->get('client_id_value')))
                                                <div class="invalid-feedback">
                                                    @foreach ($errors->get('client_id_value') as $error)
                                                        {{ $error }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Số tiền <span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input name="price" type="number"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('price'))) is-invalid @endif"
                                            placeholder="0" value="{{ old('price') }}">
                                        <i class="ri-money-cny-circle-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('price')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('price') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label">Số điểm nhận được tương ứng <a tabindex="0"
                                            class="text-decoration-none" role="button" data-bs-toggle="popover"
                                            data-bs-trigger="focus" data-bs-title="Điểm thưởng"
                                            data-bs-content="Số điển sẽ được hoàn vào tài khoản của khách hàng. Thay đổi ở cài đặt để điều chỉnh tỉ lệ điểm thưởng."><i
                                                class="ri-questionnaire-line"></i></a></label>
                                    <div class="form-group position-relative">
                                        <input name="point" type="number" readonly
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('point'))) is-invalid @endif"
                                            placeholder="0" value="{{ old('point') }}">
                                        <i class="ri-verified-badge-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
                                            style="top: 28px !important;"></i>
                                        @if (!empty($errors->get('point')))
                                            <div class="invalid-feedback">
                                                @foreach ($errors->get('point') as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                        <small>Được tạo tự động dựa trên giá bất động sản.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <div class="form-group position-relative">
                                        <label class="label">Ngày tạo</label>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control text-dark ps-5 h-58"
                                                name="active_date">
                                            <i
                                                class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                        </div>
                                    </div>
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
                            <input type="hidden" name="ratio" value="{{ $setting->values }}">
                            <input type="hidden" name="client_id_value" value="{{ old('client_id_value') }}">
                            <input type="hidden" name="property_id_value" value="{{ old('property_id_value') }}">
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
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('*[name="property_id"]').select2();
                $('*[name="client_id"]').select2();
            });
            const ratio = parseInt($('input[name="ratio"]').val());

            $('*[name="property_id"]').on('select2:select', function(e) {
                const value = $('*[name="property_id"]').select2('data').pop();
                const price = value.element.dataset.price;
                $('input[name="point"]').val(parseInt(price) * ratio);
                $('input[name="price"]').val(price);
            });

            $('*[name="price"]').on('input', function(e) {
                $('input[name="point"]').val(this.value * ratio);
            });

            $("#save-contract").on('submit', function(e) {
                e.preventDefault();
                const pselect = $('*[name="property_id"]').select2('data').pop();
                $('input[name="property_id_value"]').val(pselect.element.value);
                const cselect = $('*[name="client_id"]').select2('data').pop();
                $('input[name="client_id_value"]').val(cselect.element.value !== "" ? JSON.parse(cselect.element.value)
                    .id : '');
                this.submit();
            })
        </script>
    @endsection
</x-app-layout>
