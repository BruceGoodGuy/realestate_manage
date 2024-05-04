<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Hợp đồng</h3>
        <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
            <li>
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="{{ route('contract.index') }}" class="text-decoration-none">
                    <span class="fs-14 ms-2">Danh sách</span>
                </a>
            </li>
            <li>
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Hợp đồng</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 d-flex gap-3 mb-3">
            @if ($contract->status !== 'cancel' && $contract->status !== 'done')
                <form method="post" action="{{ route('contract.delete', $contract->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-warning text-white">Ngưng kích hoạt</button>
                </form>
            @endif
        </div>
        @if (\Session::has('message'))
            <x-general-success :message="\Session::get('message')"></x-general-success>
        @endif
        <div class="col-xxl-4 col-sm-12">
            <div class="welcome-farol card bg-primary border-0 rounded-0 rounded-top-3 position-relative">
                <div class="card-body p-4 pb-5 my-2">
                    <div class="mw-350">
                        <h3 class="text-white fw-semibold fs-20 mb-2">Chào mừng tới hợp đồng!</h3>
                        <p class="text-white fs-15">Chúc một ngày mới tốt lành.</p>
                    </div>
                </div>
                <img src="{{ asset('assets/images/welcome-shape.png') }}" class="position-absolute bottom-0 end-')}}0"
                    style="right: 10px !important; bottom: 10px !important;" alt="welcome-shape">
            </div>
            <div class="stats-box style-eight bg-white card border-0 rounded-0 rounded-bottom-3 mb-4">
                <div class="card-body p-4 pt-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="profile-img">
                            <img src="{{ asset('assets/images/course-3.jpg') }}"
                                class="rounded-circle border-2 border-white wh-57 mb-4" alt="user">
                            <h4 class="fs-16 fw-semibold mb-1">{{ $contract->name }} | <span
                                    class="text-danger">{{ $contract->status }}</span></h4>
                            <span class="fs-14">Giá: {{ $contract->price }}</span>
                        </div>
                        <div class="text-end">
                            <div id="impression_share"></div>
                            <span class="fs-14 fw-semibold mt-minus d-block">{{ $contract->active_date }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Thông tin chung</h4>
                    </div>
                    @if (!empty($contract->note))
                        <h4 class="fs-15 fw-semibold">Mô tả:</h4>
                        <p class="mb-4">{{ $contract->note }}</p>
                    @endif
                    <ul class="ps-0 mb-0 list-unstyled">
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Khách hàng:</span>
                            <span>{{ $contract->client['lastname'] . ' ' . $contract->client['firstname'] }}</span>
                        </li>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Số điện thoại :</span>
                            <a href="{{ $contract->client['phone'] }}"
                                class="text-decoration-none">{{ $contract->client['phone'] }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Bất động sản</h4>
                    </div>
                    <div
                        class="d-sm-flex justify-content-between align-items-center border-bottom border-color-gray pb-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/real-estate.png') }}" alt="real estate">
                            </div>
                            <div class="flex-grow-1 ms-3 mw-300">
                                <h4 class="text-dark fs-15 fw-semibold text-body mb-0 lh-base">
                                    {{ $contract->property['name'] }}</h4>
                                <a href="{{ route('property.view', $contract->property['id']) }}">Xem</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-sm-12">
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Giao dịch</h4>
                    </div>
                    <div class="default-table-area my-task-list">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Người nhận</th>
                                        <th scope="col">Số tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày duyệt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contract->transactions as $key => $transaction)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexCheckDefault1">
                                                    <label
                                                        class="form-check-label text-dark fw-semibold fs-16 heading-font"
                                                        for="flexCheckDefault1">
                                                        {{ $transaction->client->lastname . ' ' . $transaction->client->firstname }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ rtrim(number_format($transaction->amount, 10), '.0') }} VND</td>
                                            <td><x-transaction-status :status="$transaction->status"></x-transaction-status></td>
                                            <td>{{ $transaction->approve_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($contract->status !== 'done' && $contract->status !== 'cancel')
                            <div class="mt-3 text-end">
                                <form method="post" action="{{ route('contract.transaction', $contract->id) }}">
                                    @csrf
                                    <button name="submit" type="submit" class="btn btn-success text-white"
                                        value="ok">Đồng ý giao
                                        dịch</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
