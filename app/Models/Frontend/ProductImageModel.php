<?php

/**
 *  - Chạy lệnh tạo file Model này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:model Frontend/ProductImageModel
 * 
 *  - Cấu hình Model khách hàng để nạp dl vào DB: `app/Config/Database.php`
 * 
 *  - Quy tắc tự viết trong: `App\CustomValidators\Models\CustomRules.php`
 *    và đăng kí nó ở: `App\Config\Validation.php` -> biến $ruleSets
 */

namespace App\Models\Frontend;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_images';
    protected $primaryKey       = 'image_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';   // Kiểu dữ liệu trả về, có thể sử dụng 'object'
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'image_path', 'is_primary'];  // Các trường cho phép thao tác

    // =================================================================
    function __construct()
    {
        parent::__construct();
    }


    /**-------------------------------------
     * Lấy danh sách image theo ID sản phẩm
     */
    public function get_list($product_ID, $where = [], $fields = '*', $orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' DESC';
        }
        $this->select($fields)->where('product_id', $product_ID)->where($where)->orderBy($orderBy);
        return $this->findAll();
    }


    /**-------------------------------------
     * Lấy image tiêu biểu theo ID sản phẩm
     */
    public function get_primary_image($product_ID, $where = [], $fields = '*')
    {
        $this->select($fields)->where(['product_id' => $product_ID, 'is_primary' => 1])->where($where);
        return $this->findAll();
    }
}
