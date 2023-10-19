<?php

/**
 *  Bảng `products` ( 02 ) dùng để lưu thông tin sản phẩm:
 * 
 *  - Chạy lệnh để tạo file Migration:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:create Frontend/CreateProductsTable
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate --path=App/Database/Migrations/Frontend --only=CreateProductsTable
 *
 *  - Chạy lệnh: C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:rollback -g default -n App\Database\Migrations\Frontend\CreateProductsTable nếu muốn Nạp lại
 */

namespace App\Database\Migrations\Frontend;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 1000,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'discount_price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'currency' => [
                'type' => 'ENUM',
                'constraint' => ['VND', 'USD'],
                'default' => 'VND',
            ],
            'brand_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'is_hot' => [
                'type' => 'BOOLEAN',
            ],
            'is_new' => [
                'type' => 'BOOLEAN',
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

        $this->forge->addKey('product_id', true);
        $this->forge->addForeignKey('brand_id', 'brands', 'brand_id', 'CASCADE', 'CASCADE'); // relationship
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
