<?php

/**
 *  Seeder `colors` ( 05 ) dùng để tạo các bản ghi Mã màu sản phẩm:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/ColorSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\ColorSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $colors = [
            ['name' => 'Red', 'hex_value' => '#FF0000'],
            ['name' => 'Blue', 'hex_value' => '#0000FF'],
            ['name' => 'Green', 'hex_value' => '#008000'],
            ['name' => 'Yellow', 'hex_value' => '#FFFF00'],
            // Thêm màu bạn muốn tại đây
        ];

        $this->db->table('colors')->insertBatch($colors);
    }
}
