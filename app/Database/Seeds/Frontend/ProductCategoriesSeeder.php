<?php

/**
 *  Seeder `product_categories` ( 04 ) dùng để tạo các bản ghi mẫu cho Sản phẩm:
 *  Đảm bảo đã Seed `categories` (2) `products` (3)
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/ProductCategoriesSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\ProductCategoriesSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('product_categories');

        // Lấy tất cả bản ghi product IDs và category IDs
        $productIDs = $db->table('products')->select('product_id')->get()->getResultArray();
        $categoryIDs = $db->table('categories')->select('category_id')->get()->getResultArray();

        // chuyển bản ghi thành một mảng duy nhất
        $productIDs = array_column($productIDs, 'product_id');
        $categoryIDs = array_column($categoryIDs, 'category_id');

        foreach ($productIDs as $productID) {
            $num_categories = rand(1, 3); // Chỉ định 1 đến 3 danh mục cho mỗi sản phẩm

            // Lấy ID danh mục ngẫu nhiên
            $assignedCategories = array_rand(array_flip($categoryIDs), $num_categories);

            // Đảm bảo $signedCategories luôn là một mảng, ngay cả khi nó chỉ có một phần tử
            $assignedCategories = (array) $assignedCategories;

            foreach ($assignedCategories as $categoryID) {
                $data = ['product_id'  => $productID, 'category_id' => $categoryID];

                // Chèn dữ liệu relationship vào bảng ProductCategories
                $builder->insert($data);
            }
        }
    }
}
