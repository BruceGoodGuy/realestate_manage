<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Thiết lập điểm thưởng</h3>
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
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <h4 class="fs-18 mb-4">Thiết lập</h4>
                    @if (\Session::has('message'))
                        <x-general-success :message="\Session::get('message')"></x-general-success>
                    @endif
                    <form method="POST" class="" novalidate action="{{ route('setting.update') }}"
                        id="save-client">
                        @method('put')
                        @csrf
                        <div class="row">
                            <x-general-error :generalerrors="[]"></x-general-error>
                            @foreach ($settings as $key => $setting)
                                <div class="col-lg-8">
                                    <div class="form-group mb-4">
                                        <label class="label">{{ $setting['label'] }} </label>
                                        <div class="form-group position-relative">
                                            @if (!is_null($setting['values']))
                                                <input type="number" name="{{ $setting['name'] }}"
                                                    class="form-control text-dark h-58 @if (!empty($errors->get($setting['name']))) is-invalid @endif"
                                                    placeholder=""
                                                    value="{{ old($setting['name'], $setting['values']) }}">
                                                <small>{{ $setting['note'] }}</small>
                                                @if ($errors->get($setting['name']))
                                                    <div class="invalid-feedback">
                                                        @foreach ($errors->get($setting['name']) as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @else
                                                <small>{{ $setting['note'] }}</small>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
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
</x-app-layout>
