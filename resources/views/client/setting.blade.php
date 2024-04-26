<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Thiết lập khách hàng</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Thiết lập</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <x-general-error :generalerrors="$generalerrors ?? []"></x-general-error>
        @if (\Session::has('message'))
            <x-general-success :message="\Session::get('message')"></x-general-success>
        @endif

        <div class="col-lg-12">

            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                   <p>Tính năng đang được xây dựng.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
