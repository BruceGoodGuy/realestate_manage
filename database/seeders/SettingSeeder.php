<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('settings')->insert([
            [
                'name' => 'ratio',
                'label' => 'Tỉ lệ chuyển đổi (VNĐ/Điểm):',
                'note' => 'Thiết lập tỉ lệ chuyển đổi giữa VNĐ và điểm. Mặc định: 1:1. \n Ví dụ: Khi người dùng mua BĐS 1.000.000.  000 VNĐ. Thì số điểm nhận được sẽ là 1.000.000.000 Điểm',
                'values' => 1,
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
                'values' => 0.001,
            ],
            [
                'name' => 'earn2',
                'label' => 'Cấp 2',
                'note' => 'Người giới thiệu cấp 2',
                'values' => 0.0005,
            ],
            [
                'name' => 'earn3',
                'label' => 'Cấp 3',
                'note' => 'Người giới thiệu cấp 3',
                'values' => 0,
            ], [
                'name' => 'earn4',
                'label' => 'Cấp 4',
                'note' => 'Người giới thiệu cấp 4',
                'values' => 0,
            ],
            [
                'name' => 'earn5',
                'label' => 'Cấp 5',
                'note' => 'Người giới thiệu cấp 5',
                'values' => 0,
            ],
        ]);
    }
}
