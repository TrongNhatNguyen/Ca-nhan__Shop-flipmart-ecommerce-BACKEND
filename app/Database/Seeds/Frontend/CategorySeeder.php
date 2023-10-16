<?php

/**
 *  Seeder `brands` ( 02 ) dùng để tạo các bản ghi mẫu cho Danh mục:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/CategorySeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\CategorySeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $timeNow = date('Y-m-d H:i:s');
        $data = [
            ['name' => ' Áo thun (T-Shirts)',       'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Quần Jeans',                'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Giày (Shoes)',              'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Túi xách (Bags)',           'parent_id' => null,    'created_at' => $timeNow],
            ['name' => ' Phụ kiện (Accessories)',   'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Áo khoác (Jackets)',        'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Đầm (Dresses)',             'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Thể thao (Sportswear)',     'parent_id' => null,    'created_at' => $timeNow],
            ['name' => 'Nội y (Underwear)',         'parent_id' => null,    'created_at' => $timeNow],
        ];

        // Sử dụng Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
