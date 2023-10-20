<?php

/**
 *  - Chạy lệnh tạo file Model này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:model Frontend/ReviewModel
 * 
 *  - Cấu hình Model khách hàng để nạp dl vào DB: `app/Config/Database.php`
 * 
 *  - Quy tắc tự viết trong: `App\CustomValidators\Models\CustomRules.php`
 *    và đăng kí nó ở: `App\Config\Validation.php` -> biến $ruleSets
 */

namespace App\Models\Frontend;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reviews';
    protected $primaryKey       = 'review_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';   // Kiểu dữ liệu trả về, có thể sử dụng 'object'
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'user_id', 'rating', 'comment', 'status', 'updated_at'];  // Các trường cho phép thao tác

    // Ngày giờ:
    protected $useTimestamps = false; // true thì tự động nạp giá trị vào db
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // =================================================================
    function __construct()
    {
        parent::__construct();
    }


    /**---------------------------------------
     * Lấy danh sách Review theo ID Sản phẩm
     */
    public function get_list_by_productID($product_ID, $where = [], $fields = '*', $orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' DESC';
        }
        $this->select($fields)->where('product_id', $product_ID)->where($where)->orderBy($orderBy);
        return $this->findAll();
    }


    /**----------------------------------
     * Lấy danh sách Review theo ID User
     */
    public function get_list_by_userID($user_ID, $where = [], $fields = '*', $orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' DESC';
        }
        $this->select($fields)->where('user_id', $user_ID)->where($where)->orderBy($orderBy);
        return $this->findAll();
    }


    /**-----------------------------------
     * Lấy Số SAO đánh giá trung bình (AVG)
     */
    public function get_average_rating($product_id)
    {
        $builder = $this->db->table($this->table);
        $builder->selectAvg('rating', 'average_rating');
        $builder->where('product_id', $product_id);
        $builder->where('status', 'active');
        $result = $builder->get()->getRow();

        return $result->average_rating;
    }
}
