<?php

/**
 *  Seeder `products` ( 03 ) dùng để tạo các bản ghi mẫu cho Sản phẩm:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/ProductSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\ProductSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $descriptions = [
            'Thoải mái và phong cách,',
            'Được làm từ những chất liệu cao cấp,',
            'Hoàn hảo cho mọi dịp,',
            'Một sự bổ sung tuyệt vời cho bất kỳ tủ quần áo nào,',
            'Chất liệu và đường may chất lượng cao,'
        ];

        $additional_words = [
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, sẽ làm bạn nổi bật.',
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, giúp tạo nên vẻ đẹp riêng.',
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, mang lại cảm giác thoải mái suốt cả ngày.',
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, đảm bảo sự thoải mái và tiện lợi.',
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, được thiết kế độc đáo và tinh tế.',
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, là lựa chọn hoàn hảo cho mọi người.',
            'đây sẽ là một sự lựa chọn tuyệt vời cho bạn thoả sức sáng tạo, mang lại phong cách và sự tự tin.',
        ];

        $names = ['Áo thun T-Shirt ', 'Quần Jeans ', 'Áo khoác Jacket ', 'Đồ mỏng Sweater ', 'Quần Shorts hoa ', 'Giày thể thao Nike '];
        $prices = [100000, 250000, 450000, 500000, 790000, 990000, 1250000];
        $timeNow = date('Y-m-d H:i:s');
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $name = $names[array_rand($names)] . ($i + 1);
            $description = $descriptions[array_rand($descriptions)] . ' ' . $additional_words[array_rand($additional_words)];
            $price = $prices[array_rand($prices)];
            $discount_price = [null, $price - 50000];

            $data[] = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'discount_price' => $discount_price[array_rand($discount_price)],
                'brand_id' => rand(1, 5),
                'is_hot' => (bool)rand(0, 1),
                'is_new' => (bool)rand(0, 1),
                'created_at' => $timeNow,
            ];
        }

        // Sử dụng Query Builder
        $this->db->table('products')->insertBatch($data);
    }
}
