<?php

namespace Modules\Orders\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Orders\src\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Đang chờ thanh toán', 'type' => 'info'],
            ['name' => 'Đã thanh toán', 'type' => 'success'],
            ['name' => 'Thanh toán thất bại', 'type' => 'danger'],
            ['name' => 'Hủy thanh toán', 'type' => 'warning'],
        ];

        OrderStatus::insert($statuses);
    }
}