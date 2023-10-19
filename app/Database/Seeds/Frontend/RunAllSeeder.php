<?php

/**
 *  SEEDER `RUN ALL` ( 00 ) DÙNG ĐỂ NẠP TẤT CẢ SEEDER THEO THỨ TỰ:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/RunAllSeeder
 * 
 *  - Vào `app/Config/Database.php` để kiểm tra kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\RunAllSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class RunAllSeeder extends Seeder
{
    public function run()
    {
        $path = 'App\Database\Seeds\Frontend';

        $this->call($path . '\BrandSeeder');             // Thương hiệu      (1)
        $this->call($path . '\CategorySeeder');          // Danh mục         (2)
        $this->call($path . '\ProductSeeder');           // Sản phẩm         (3)
        $this->call($path . '\ProductCategoriesSeeder'); // Relationship     (4) (2~3)
        $this->call($path . '\ColorSeeder');             // Màu Sản phẩm     (5)
        $this->call($path . '\ProductColorsSeeder');     // Relationship     (6) (2~5)
        $this->call($path . '\ProductImagesSeeder');     // Ảnh Sản phẩm     (7)
        $this->call($path . '\UserSeeder');              // Khách hàng       (8)
        $this->call($path . '\ReviewSeeder');            // Đánh giá         (9)
    }
}
