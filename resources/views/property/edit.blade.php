<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Chỉnh sửa tài sản</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Tài sản</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fs-18 mb-4">Thông tin</h4>
                    <form method="POST" id="create-property" class="" novalidate
                        action="{{ route('property.update', $property->id) }}" id="save-client"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <x-general-error :generalerrors="[]"></x-general-error>
                            <div class="col-lg-8">
                                <div class="form-group mb-4">
                                    <label class="label">Tên tài sản <span class="text-danger">*</span></label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="name"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('name'))) is-invalid @endif"
                                            placeholder="BDS Hồ Tràm" value="{{ old('name', $property->name) }}">
                                        <i class="ri-building-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"
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
                                    <label class="label">Giới thiệu ngắn</label>
                                    <div class="form-group position-relative">
                                        <textarea class="form-control ps-5 text-dark" name="note" placeholder="Nội dung mô tả ngắn ... " cols="30"
                                            rows="5">{{ old('note', $property->note) }}</textarea>
                                        <i
                                            class="ri-information-line position-absolute top-0 start-0 fs-20 text-gray-light ps-20 pt-2"></i>
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
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label">Giá khuyến nghị</label>
                                    <div class="form-group position-relative">
                                        <input type="number" name="price"
                                            class="form-control text-dark ps-5 h-58 @if (!empty($errors->get('price'))) is-invalid @endif"
                                            placeholder="10000" value="{{ old('price', $property->price) }}">
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
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label">Địa chỉ</label>
                                    <div class="form-group position-relative">
                                        <input type="text" name="address" class="form-control text-dark ps-5 h-58"
                                            placeholder="Nhập địa chỉ" value="{{ old('address', $property->address) }}">
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label">Tỉnh </label>
                                    <div class="form-group position-relative">
                                        <select class="form-select form-control ps-5 h-58" aria-label="Chọn tỉnh thành"
                                            name="province">
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
                                        <select class="form-select form-control ps-5 h-58" aria-label="Chọn xã" disabled
                                            name="ward">
                                            <option value="" disabled selected>Chọn xã/Phường</option>
                                        </select>
                                        <i
                                            class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="form-group mb-0">
                                    <label class="label">Hình đại diện:</label>
                                    <div class="form-group position-relative">
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                                    <span
                                                        class="d-block fw-semibold text-body dz-message needsclick">Kéo
                                                        thả hình ở đây để upload</span>
                                                    @if (old('avatar', $property->avatar))
                                                        <div id="fake-avatar"
                                                            class="form-group p-4 bg-border-gray-light d-sm-flex justify-content-between align-items-center rounded-10">
                                                            <div
                                                                class="d-sm-flex align-items-center mb-3 mb-sm-0 me-lg-3">
                                                                <div class="me-md-5 pe-xxl-5 mb-3 mb-sm-0">
                                                                    <h4 class="body-font fs-15 fw-semibold text-body">
                                                                        Ảnh đại
                                                                        diện</h4>
                                                                    <p>Hình này sẽ hiển thị trên app</p>
                                                                </div>
                                                                <div>
                                                                    <img class="rounded-4 wh-78 ms-3 ms-lg-0"
                                                                        src="{{ asset('storage/' . old('avatar', $property->avatar)) }}" />
                                                                    <p class="name">
                                                                        {{ old('avatar_name', $property->avatar_name) }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex ms-sm-3 ms-md-0">
                                                                <button type="button"
                                                                    class="btn bg-danger bg-opacity-10 text-danger fw-semibold"
                                                                    data-dz-remove>Delete</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-0">
                                    <label class="label">Chi tiết</label>
                                    <div class="form-group position-relative">
                                        <textarea id="property-detail" name="content">{!! old('content', $property->content) !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="active" value="true"
                                        id="flexCheckDefault" @checked(!!$property->status)>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Xuất bản
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="province_value" value="">
                            <input type="hidden" name="district_value" value="">
                            <input type="hidden" name="avatar" value="{{ old('avatar', $property->avatar) }}">
                            <input type="hidden" name="avatar_name"
                                value="{{ old('avatar_name', $property->avatar_name) }}">
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
        <x-tiny-script :selector="'textarea#property-detail'"></x-tiny-script>
        <x-dropzone-script :selector="'div.product-upload'" :url="route('ajax.draftupload')" :previewtemplate="false" :oldpath="old('avatar', $property->avatar)" :oldname="old('avatar_name', $property->avatar_name)"
            :name="'avatar'"></x-dropzone-script>
        <x-location-script :province="old('province', $property->province)" :district="old('district', $property->district)" :ward="old('ward', $property->ward)" :selector="'create-property'"></x-location-script>
    @endsection
</x-app-layout>
