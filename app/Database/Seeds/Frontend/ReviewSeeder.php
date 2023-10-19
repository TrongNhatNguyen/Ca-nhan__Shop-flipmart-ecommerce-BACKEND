<?php

/**
 *  Seeder `reviews` ( 09 ) dùng để tạo các bản ghi mẫu cho thương hiệu:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/ReviewSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\ReviewSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'product_id' => ($i + 1),
                'user_id' => rand(1, 5),
                'rating' => rand(3, 5), // Đánh giá từ 3 đến 5 sao
                'comment' => 'Cảm ơn bạn đã đọc bình luận mẫu cho sản phẩm ' . ($i + 1),
                'created_at' => date("Y-m-d H:i:s"),
            ];
        }

        // Insert dữ liệu vào table Reviews
        $this->db->table('reviews')->insertBatch($data);
    }
}
