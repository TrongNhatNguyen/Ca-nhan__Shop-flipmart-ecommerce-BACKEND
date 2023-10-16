<?php

/**
 *  Seeder `brands` ( 01 ) dùng để tạo các bản ghi mẫu cho thương hiệu:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/BrandSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\BrandSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $timeNow = date('Y-m-d H:i:s');
        $data = [
            ['name' => 'Nike',      'created_at' => $timeNow],
            ['name' => 'Adidas',    'created_at' => $timeNow],
            ['name' => 'Zara',      'created_at' => $timeNow],
            ['name' => 'H&M',       'created_at' => $timeNow],
            ['name' => 'Gucci',     'created_at' => $timeNow],
            ['name' => 'Levi\'s',   'created_at' => $timeNow],
        ];

        // Sử dụng Query Builder
        $this->db->table('brands')->insertBatch($data);
    }
}
