<?php

/**
 *  Bảng `product_colors` ( 07 ) dùng để relationship(nhiều-nhiều) 2 bảng:
 * 
 *  - Chạy lệnh để tạo file Migration:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:create Frontend/CreateProductColorsTable
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate --path=App/Database/Migrations/Frontend --only=CreateProductColorsTable
 *
 *  - Chạy lệnh: C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:rollback -g default -n App\Database\Migrations\Frontend\CreateProductColorsTable nếu muốn Nạp lại
 */

namespace App\Database\Migrations\Frontend;

use CodeIgniter\Database\Migration;

class CreateProductColorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'color_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey(['product_id', 'color_id']);
        $this->forge->addForeignKey('product_id', 'products', 'product_id', 'CASCADE', 'CASCADE'); // relationship
        $this->forge->addForeignKey('color_id', 'colors', 'color_id', 'CASCADE', 'CASCADE'); // relationship
        $this->forge->createTable('product_colors');
    }

    public function down()
    {
        $this->forge->dropTable('product_colors');
    }
}
