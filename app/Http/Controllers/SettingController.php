<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    //
    public function index()
    {
        $settings = Setting::all()->toArray();
        return view('setting.index', ['settings' => $settings]);
    }

    public function update(\App\Http\Requests\Setting $request)
    {
        $data = $request->only(['earn1', 'earn2', 'earn3', 'earn4', 'earn5', 'ratio']);
        Setting::truncate();
        Setting::insert([
            [
                'name' => 'ratio',
                'label' => 'Tỉ lệ chuyển đổi (VNĐ/Điểm):',
                'note' => 'Thiết lập tỉ lệ chuyển đổi giữa VNĐ và điểm. Mặc định: 1:1. \n Ví dụ: Khi người dùng mua BĐS 1.000.000.  000 VNĐ. Thì số điểm nhận được sẽ là 1.000.000.000 Điểm',
                'values' => $data['ratio'],
            ],
            [
                'name' => 'info',
                'label' => 'Tỉ lệ nhận hoa hồng',
                'note' => 'Tỉ lệ phần trăm số điểm sẽ nhận được mỗi khi người được giới thiệu mua bất động sản.',
                'values' => null,
            ],
            [
                'name' => 'earn1',
                'label' => 'Cấp 1',
                'note' => 'Người giới thiệu cấp 1',
                'values' => $data['earn1'],
            ],
            [
                'name' => 'earn2',
                'label' => 'Cấp 2',
                'note' => 'Người giới thiệu cấp 2',
                'values' => $data['earn2'],
            ],
            [
                'name' => 'earn3',
                'label' => 'Cấp 3',
                'note' => 'Người giới thiệu cấp 3',
                'values' => $data['earn3'],
            ], [
                'name' => 'earn4',
                'label' => 'Cấp 4',
                'note' => 'Người giới thiệu cấp 4',
                'values' => $data['earn4'],
            ],
            [
                'name' => 'earn5',
                'label' => 'Cấp 5',
                'note' => 'Người giới thiệu cấp 5',
                'values' => $data['earn5'],
            ],
        ]);

        return redirect()->back()->with(['message' => 'Cập nhật thành công']);
    }
}
