<?php

/**
 *  Seeder `products` ( 08 ) dùng để tạo các bản ghi mẫu cho Sản phẩm:
 * 
 *  - Chạy lệnh để tạo file Seeder này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:seeder Frontend/UserSeeder
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark db:seed App\Database\Seeds\Frontend\UserSeeder
 */

namespace App\Database\Seeds\Frontend;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            // mật khẩu:
            $password       = 'user' . ($i + 1);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // mật khẩu đã được mã hóa

            // vai trò:
            // $roles      = ['superadmin', 'admin', 'moderator'];
            // $randomRole = $roles[array_rand($roles)];

            $data = [
                'username'   => 'user' . ($i + 1),
                'password'   => $hashedPassword,
                'email'      => 'tkuser' . ($i + 1) . '@gmail.com',
                'full_name'  => 'Người dùng số ' . ($i + 1),
                'avatar_path' => 'public/frontend/assets/images/avatar/a' . ($i + 1) . '.jpg',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('users')->insertBatch($data);
        }
    }
}
