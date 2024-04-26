<x-app-layout>
    <div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
        <h3 class="mb-sm-0 mb-1 fs-18">Danh sách tài sản</h3>
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
        <x-general-error :generalerrors="$generalerrors ?? []"></x-general-error>
        @if (\Session::has('message'))
            <x-general-success :message="\Session::get('message')"></x-general-success>
        @endif

        <div class="col-lg-12">
            <a href="{{ route('property.add') }}" class="text-no-decoration">
                <button class="btn btn-success mb-3 text-white">Thêm mới tài sản</button>
            </a>

            <div class="card bg-white border-0 rounded-10 mb-4">
                <div class="card-body p-4">
                    <div class="default-table-area members-list">
                        <div class="table-responsive">
                            <table class="table align-middle" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-primary">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label ms-2" for="flexCheckDefault">Tên</label>
                                            </div>
                                        </th>
                                        <th scope="col">Vị trí</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Công Cụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $key => $property)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check pe-2">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault{{ $key }}">
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 lh-1">
                                                            <img src="{{ $property->avatar ? asset('storage/' . $property->avatar) : asset('assets/images/default-house.png' . $property->avatar) }}"
                                                                class="wh-44 rounded" alt="user">
                                                        </div>
                                                        <div class="flex-grow-1 ms-10">
                                                            <h4 class="fw-semibold fs-16 mb-0">{{ $property->name }}
                                                            </h4>
                                                            <span class="text-gray-light">{{ $property->note }}</span>
                                                            @if (\Session::has('pid') && \Session::get('pid') === $property->id)
                                                                <span class="text-danger">(Mới thêm)</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $property->province }}
                                            </td>
                                            <td>
                                                <span> {{ $property->price }}</span>
                                            </td>
                                            <td>
                                                <x-client-status :status="$property->status"></x-client-status>
                                            </td>
                                            <td>
                                                <div class="dropdown action-opt">
                                                    <button class="btn bg p-0" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i data-feather="more-horizontal"></i>
                                                    </button>
                                                    <ul
                                                        class="dropdown-menu dropdown-menu-end bg-white border box-shadow">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('client.view', $property->id) }}">
                                                                <i data-feather="eye"></i>
                                                                Xem
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('client.edit', $property->id) }}">
                                                                <i data-feather="edit-3"></i>
                                                                Chỉnh sửa
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3 p-3">
                    <button class="btn btn-primary text-white" disabled>Tải xuống</button>
                    <button class="btn btn-success text-white" disabled>Tải xuống toàn bộ</button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
