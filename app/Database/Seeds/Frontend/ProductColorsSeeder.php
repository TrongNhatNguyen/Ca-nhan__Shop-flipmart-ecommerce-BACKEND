<?php

/**
 *  Seeder `product_colors` ( 06 ) dùng để tạo các bản ghi mẫu cho Sản phẩm:
 *  Đảm bảo đã Seed `colors` (5) `products` (3)
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/ProductColorsSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\ProductColorsSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class ProductColorsSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product_colors');

        // Lấy tất cả bản ghi product IDs và color IDs
        $productIDs = $db->table('products')->select('product_id')->get()->getResultArray();
        $colorIDs = $db->table('colors')->select('color_id')->get()->getResultArray();

        // chuyển bản ghi thành một mảng duy nhất
        $productIDs = array_column($productIDs, 'product_id');
        $colorIDs = array_column($colorIDs, 'color_id');

        foreach ($productIDs as $productID) {
            $num_colors = rand(1, 3); // Chỉ định 1 đến 3 danh mục cho mỗi sản phẩm

            // Lấy ID color ngẫu nhiên
            $assignedColors = array_rand(array_flip($colorIDs), $num_colors);

            // Đảm bảo $signedCategories luôn là một mảng, ngay cả khi nó chỉ có một phần tử
            $assignedColors = (array) $assignedColors;

            foreach ($assignedColors as $colorID) {
                $data = ['product_id' => $productID, 'color_id'   => $colorID];

                // Chèn dữ liệu relationship vào bảng ProductColors
                $builder->insert($data);
            }
        }
    }
}
