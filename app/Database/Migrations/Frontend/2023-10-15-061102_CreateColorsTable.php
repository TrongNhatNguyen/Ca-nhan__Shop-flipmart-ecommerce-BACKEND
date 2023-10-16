<?php

/**
 *  Bảng `colors` ( 06 ) dùng để lưu thông tin màu sản phẩm:
 * 
 *  - Chạy lệnh để tạo file Migration:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate:create Frontend/CreateColorsTable
 * 
 *  - Vào `app/Config/Database.php` để kết nối với CSDL localhost
 * 
 *  - Chạy lệnh để nạp duy nhất file này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark migrate --path=App/Database/Migrations/Frontend --only=CreateColorsTable
 *    chạy lệnh: php spark migrate:rollback nếu muốn chạy lại lệnh trên
 */

namespace App\Database\Migrations\Frontend;

use CodeIgniter\Database\Migration;

class CreateColorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'color_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'hex_value' => [
                'type' => 'VARCHAR',
                'constraint' => 7, // VD: #FFFFFF
            ],
        ]);
        $this->forge->addKey('color_id', true);
        $this->forge->createTable('colors');
    }

    public function down()
    {
        $this->forge->dropTable('colors');
    }
}
