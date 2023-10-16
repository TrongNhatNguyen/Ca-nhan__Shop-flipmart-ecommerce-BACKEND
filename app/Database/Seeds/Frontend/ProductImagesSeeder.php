<?php

/**
 *  Seeder `product_images` ( 07 ) dùng để tạo các bản ghi Đường dẫn Ảnh sản phẩm:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/ProductImagesSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\ProductImagesSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('product_images');

        // Lấy tất cả bản ghi product IDs
        $productIDs = $db->table('products')->select('product_id')->get()->getResultArray();

        // chuyển bản ghi thành một mảng duy nhất
        $productIDs = array_column($productIDs, 'product_id');

        foreach ($productIDs as $index => $productID) {
            $data = [
                'product_id'  => $productID,
                'image_path'  => 'public/frontend/assets/images/products/p' . ($index + 1) . '.jpg',
                'is_primary'  => true  // là ảnh được hiển thị ở các box sản phẩm
            ];

            // chèn vào bảng ProductImages
            $builder->insert($data);
        }
    }
}
