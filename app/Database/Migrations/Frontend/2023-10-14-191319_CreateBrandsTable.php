<?php

/**
 *  Bảng `brands` ( 01 ) dùng để lưu thông tin thương hiệu:
 * 
 *  - Chạy lệnh để tạo file Migration:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:create Frontend/CreateBrandsTable
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate --path=App/Database/Migrations/Frontend --only=CreateBrandsTable
 *
 *  - Chạy lệnh: C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:rollback -g default -n App\Database\Migrations\Frontend\CreateBrandsTable nếu muốn Nạp lại
 */

namespace App\Database\Migrations\Frontend;

use CodeIgniter\Database\Migration;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'brand_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('brand_id', true);
        $this->forge->createTable('brands');
    }

    public function down()
    {
        $this->forge->dropTable('brands');
    }
}
