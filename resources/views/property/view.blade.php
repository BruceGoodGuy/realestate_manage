<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Thông tin</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="{{ route('property.index') }}" class="text-decoration-none">
                    <span class="fs-14 ms-2">Bất động sản</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Thông tin</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 d-flex gap-3 mb-3">
            <a href="{{ route('property.edit', $property->id) }}">
                <button class="btn btn-warning text-white">Chỉnh sửa</button>
            </a>
        </div>
        @if (\Session::has('message'))
            <x-general-success :message="\Session::get('message')"></x-general-success>
        @endif
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <h4 class="fs-18 mb-4">Thông tin</h4>
                <div>
                    <p>Tên bất động sản: {{ $property['name'] }}</p>
                </div>
                @if (!empty($property['avatar']))
                    <div>
                        <p>Avatar: {{ $property->avatar_name }}</p>
                        <img src="{{ asset('storage/' . $property->avatar) }}" class="mw-300 rounded-10"
                            alt="user">
                    </div>
                @endif
                <div class="card-content">
                    {!! $property['content'] !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
