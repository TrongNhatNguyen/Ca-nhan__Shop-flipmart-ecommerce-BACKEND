<?php

/**
 *  - Chạy lệnh tạo file Model này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:model Frontend/CategoryModel
 * 
 *  - Cấu hình Model khách hàng để nạp dl vào DB: `app/Config/Database.php`
 * 
 *  - Quy tắc tự viết trong: `App\CustomValidators\Models\CustomRules.php`
 *    và đăng kí nó ở: `App\Config\Validation.php` -> biến $ruleSets
 */

namespace App\Models\Frontend;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';   // Kiểu dữ liệu trả về, có thể sử dụng 'object'
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'parent_id', 'status', 'updated_at'];  // Các trường cho phép thao tác

    // Ngày giờ:
    protected $useTimestamps = false; // true thì tự động nạp giá trị vào db
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // =================================================================
    protected $validation;
    function __construct()
    {
        parent::__construct(); // cho phép viết câu truy vấn ở controller

        // nạp thư viện kiểm tra Quy tắc:
        $this->validation = \Config\Services::validation();
    }


    /**------------------------------
     * Lấy danh sách Danh Mục
     */
    public function get_list($where = [], $fields = '*', $orderBy = null, $limit = 10, $offset = 0)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' ASC';
        }
        $this->select($fields)->where($where)->orderBy($orderBy);
        return $this->findAll($limit, $offset);
    }

    /**------------------------------
     * Lấy Danh Mục theo ID
     */
}
