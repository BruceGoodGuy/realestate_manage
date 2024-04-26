<x-app-layout>
    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/css/Treant.css') }}">
        <style>
            /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .relation-chart .chart {
                height: 600px;
                margin: 5px;
                width: 900px;
                overflow: auto;
            }

            .relation-chart .Treant>.node {}

            .relation-chart .Treant>p {
                font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                font-weight: bold;
                font-size: 12px;
            }

            .relation-chart .node-name {
                font-weight: bold;
            }

            .relation-chart .nodeRelation1 {
                padding: 2px;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                background-color: #ffffff;
                border: 1px solid #000;
                width: 200px;
                font-family: Tahoma;
                font-size: 12px;
            }

            .relation-chart .nodeRelation1 img {
                margin-right: 10px;
            }

            .relation-chart .node-status,
            .relation-chart .node-current {
                display: inline-block;
            }
            .relation-chart .node-current {
                margin-right: 10px;
            }
        </style>
    @endsection
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Hồ sơ</h3>
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
                <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Hồ sơ</span>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 d-flex gap-3 mb-3">
            <a href="{{ route('client.edit', $client->id) }}">
                <button class="btn btn-warning text-white">Chỉnh sửa</button>
            </a>
        </div>
        @if (\Session::has('message'))
            <x-general-success :message="\Session::get('message')"></x-general-success>
        @endif
        <div class="col-xxl-4 col-sm-12">
            <div class="welcome-farol card bg-primary border-0 rounded-0 rounded-top-3 position-relative">
                <div class="card-body p-4 pb-5 my-2">
                    <div class="mw-350">
                        <h3 class="text-white fw-semibold fs-20 mb-2">Chào mừng tới hồ sơ người dùng!</h3>
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
                            <img src="{{ asset('assets/images/user-34.jpg') }}"
                                class="rounded-circle border-2 border-white wh-57 mb-4" alt="user">
                            <h4 class="fs-16 fw-semibold mb-1">{{ $client->lastname . ' ' . $client->firstname }}</h4>
                            <span class="fs-14">Đối tác @if ($client->created_from == config('constants.platform.mobile'))
                                    <i class="ri-smartphone-line" data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-title='Được tạo bằng app'></i>
                                @endif
                            </span>
                        </div>
                        <div class="text-end">
                            <div id="impression_share"></div>
                            <span class="fs-14 fw-semibold mt-minus d-block">{{ $client->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Thông tin cá nhân</h4>
                    </div>
                    @if (!empty($client->note))
                        <h4 class="fs-15 fw-semibold">Giới thiệu:</h4>
                        <p class="mb-4">{{ $client->note }}</p>
                    @endif
                    <ul class="ps-0 mb-0 list-unstyled">
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Họ tên :</span>
                            <span>{{ $client->lastname . ' ' . $client->firstname }}</span>
                        </li>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Trạng thái :</span>
                            <x-client-status :status="$client->status"></x-client-status>
                        </li>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Số điện thoại :</span>
                            <a href="tel:(123)1231234" class="text-decoration-none">{{ $client->phone }}</a>
                        </li>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Địa chỉ email :</span>
                            <a href="mailto:{{ $client->email }}" class="text-decoration-none"><span
                                    class="__cf_email__">{{ $client->email }}</span></a>
                        </li>
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Địa chỉ :</span>
                            <span>{{ trim($client->address . ', ' . $client->ward . ', ' . $client->district . ', ' . $client->province, ', ') }}</span>
                        </li>
                        @if (!empty($client->birthday))
                            <li class="border-bottom border-color-gray mb-3 pb-3">
                                <?php
                                \Carbon\Carbon::setLocale('es');
                                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $client->birthday);
                                ?>
                                <span class="fw-semibold text-dark w-130 d-inline-block">Sinh nhật: </span>
                                <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title='{{ "Ngày $date->day tháng $date->month năm $date->year" }}'>{{ $date->format('d - m - Y') }}</span>
                            </li>
                        @endif
                        <li class="border-bottom border-color-gray mb-3 pb-3">
                            <span class="fw-semibold text-dark w-130 d-inline-block">Mã giới thiệu :</span>
                            <span class="user-select-all">{{ $client->referral_code }}</span>
                        </li class="border-bottom border-color-gray mb-3 pb-3">
                        @if (isset($client->refuser))
                            <li>
                                <span class="fw-semibold text-dark w-130 d-inline-block">Người giới thiệu :</span>
                                <span><a
                                        href="{{ route('client.view', $client->refuser->id) }}">{{ $client->refuser->fullname }}</a></span>
                                <x-client-status :status="$client->refuser->status"></x-client-status>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Bất động sản</h4>
                    </div>
                    {{-- <div
                        class="d-sm-flex justify-content-between align-items-center border-bottom border-color-gray pb-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/pdf.svg') }}" alt="pdf">
                            </div>
                            <div class="flex-grow-1 ms-3 mw-300">
                                <h4 class="text-dark fs-15 fw-semibold text-body mb-0 lh-base">Donald updated
                                    the status of Refund #1234 to awaiting customer</h4>
                            </div>
                        </div>
                        <span class="text-gray-light mt-3 mt-sm-0 d-block">54 Min ago</span>
                    </div> --}}
                    <span>Chưa có</span>
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-sm-12">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-6 col-md-6 col-lg-12 col-xxxl-6">
                    <div class="stats-box style-four card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-md-flex justify-content-between align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-donut-chart"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                                    <span class="fs-15">Bất động sản</span>
                                    <div class="d-flex align-items-center justify-content-between mt-1 up-down">
                                        <h3 class="body-font fw-bold fs-3 mb-0">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-6 col-md-6 col-lg-12 col-xxxl-6">
                    <div class="stats-box style-four card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-md-flex justify-content-between align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-goal"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                                    <span class="fs-15">Kim cương</span>
                                    <div class="d-flex align-items-center justify-content-between mt-1 up-down">
                                        <h3 class="body-font fw-bold fs-3 mb-0">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-6 col-md-6 col-lg-12 col-xxxl-6">
                    <div class="stats-box style-four card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-md-flex justify-content-between align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-award"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                                    <span class="fs-15">Điểm</span>
                                    <div class="d-flex align-items-center justify-content-between mt-1 up-down">
                                        <h3 class="body-font fw-bold fs-3 mb-0">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-6 col-md-6 col-lg-12 col-xxxl-6">
                    <div class="stats-box style-four card bg-white border-0 rounded-10 mb-4">
                        <div class="card-body p-4">
                            <div class="d-md-flex justify-content-between align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="icon transition">
                                        <i class="flaticon-award"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-md-3 mt-3 mt-md-0">
                                    <span class="fs-15">Tổng tiền đã nhận</span>
                                    <div class="d-flex align-items-center justify-content-between mt-1 up-down">
                                        <h3 class="body-font fw-bold fs-3 mb-0">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Nhật kí hoạt động</h4>
                        <div class="dropdown action-opt">
                            <button class="btn bg-transparent p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-feather="chevron-down"></i>
                                <span>Tháng này</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="clock"></i>
                                        Hôm nay
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="pie-chart"></i>
                                        7 ngày trước
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="rotate-cw"></i>
                                        Tháng trước
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="calendar"></i>
                                        1 năm trước
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:;">
                                        <i data-feather="bar-chart"></i>
                                        Tất cả
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="default-table-area my-task-list">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-primary">Hành động</th>
                                        <th scope="col">Ngày thực hiện</th>
                                        <th scope="col">Người gởi</th>
                                        <th scope="col">Người nhận</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chưa có bản ghi</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexCheckDefault1">
                                                <label
                                                    class="form-check-label text-dark fw-semibold fs-16 heading-font"
                                                    for="flexCheckDefault1">
                                                    Public Beta Release
                                                </label>
                                            </div>
                                        </td>
                                        <td>14 Feb 2024</td>
                                        <td>15 Feb 2024</td>
                                        <td>
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold d-block">Active</span>
                                        </td>
                                        <td>$1250</td>
                                        <td>$1250</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="d-sm-flex justify-content-between align-items-center text-center">
                            <span class="fs-14">Showing 1 To 5 Of 20 Entries</span>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0 mt-3 mt-sm-0 justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link icon" href="profile-2.html#" aria-label="Previous">
                                            <i data-feather="arrow-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link active" href="profile-2.html#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="profile-2.html#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="profile-2.html#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link icon" href="profile-2.html#" aria-label="Next">
                                            <i data-feather="arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                        <h4 class="fw-semibold fs-18 mb-0">Mô hình quan hệ <span class="text-warning">(Beta)</span></h4>
                    </div>
                    <div class="default-table-area my-task-list mw-100 relation-chart">
                        <div class="chart mw-100" id="relation-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('javascript')
        <script src="{{ asset('assets/js/raphael.js') }}"></script>
        <script src="{{ asset('assets/js/Treant.js') }}"></script>
        <script>
            var nodeData = '@json($relations)';
            var chart_config = {
                chart: {
                    container: "#relation-chart",

                    connectors: {
                        type: 'step'
                    },
                    node: {
                        HTMLclass: 'nodeRelation1'
                    }
                },
                nodeStructure: JSON.parse(nodeData)
            };

            console.log(JSON.parse(nodeData));
            new Treant(chart_config);
        </script>
    @endsection
</x-app-layout>
