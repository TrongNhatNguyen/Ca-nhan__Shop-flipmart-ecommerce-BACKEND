<?php

/**
 *  Bảng `product_categories` ( 05 ) dùng để relationship(nhiều-nhiều) 2 bảng:
 * 
 *  - Chạy lệnh để tạo file Migration:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:create Frontend/CreateProductCategoriesTable
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate --path=App/Database/Migrations/Frontend --only=CreateProductCategoriesTable
 *
 *  - Chạy lệnh: C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:rollback -g default -n App\Database\Migrations\Frontend\CreateProductCategoriesTable nếu muốn Nạp lại
 */

namespace App\Database\Migrations\Frontend;

use CodeIgniter\Database\Migration;

class CreateProductCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey(['product_id', 'category_id']);
        $this->forge->addForeignKey('product_id', 'products', 'product_id', 'CASCADE', 'CASCADE'); // relationship
        $this->forge->addForeignKey('category_id', 'categories', 'category_id', 'CASCADE', 'CASCADE'); // relationship
        $this->forge->createTable('product_categories');
    }

    public function down()
    {
        $this->forge->dropTable('product_categories');
    }
}
