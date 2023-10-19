<?php

/**
 *  - Chạy lệnh tạo file Model này:
 *     C:\wamp64\bin\php\php8.0.26\php.exe spark make:model Frontend/ProductModel
 * 
 *  - Cấu hình Model khách hàng để nạp dl vào DB: `app/Config/Database.php`
 * 
 *  - Quy tắc tự viết trong: `App\CustomValidators\Models\CustomRules.php`
 *    và đăng kí nó ở: `App\Config\Validation.php` -> biến $ruleSets
 */

namespace App\Models\Frontend;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';   // Kiểu dữ liệu trả về, có thể sử dụng 'object'
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'price', 'discount_price', 'currency', 'brand_id', 'is_hot', 'is_new', 'status', 'updated_at'];  // Các trường cho phép thao tác

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
        parent::__construct(); // hàm này cho phép viết câu truy vấn ở controller

        // nạp thư viện kiểm tra Quy tắc:
        $this->validation = \Config\Services::validation();
    }


    /**------------------------------
     * Lấy danh sách Sản Phẩm
     */
    public function get_list($where = [], $fields = '*', $orderBy = null, $limit = 10, $offset = 0)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' DESC';
        }
        $this->select($fields)->where($where)->orderBy($orderBy);
        return $this->findAll($limit, $offset);
    }


    /**----------------------------------------------
     * Lấy danh sách Sản Phẩm có IMAGES & Đánh Giá
     * 
     * @param bool|null $isPrimary - Lọc hình ảnh dựa trên is_primary. Mặc định là null (lấy tất cả hình ảnh).
     */
    public function get_list_with_image_and_reviews($where = [], $fields = '*', $orderBy = null, $limit = 10, $offset = 0, $isPrimary = null)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' DESC';
        }

        // Lấy ra danh sách sản phẩm
        $products = $this->select($fields)->where($where)->orderBy($orderBy)->findAll($limit, $offset);

        // Lặp qua danh sách sản phẩm
        foreach ($products as &$product) {
            $product_id = $product['product_id'];

            // Lấy hình ảnh cho sản phẩm
            $imageQuery = $this->db->table('product_images')->where('product_id', $product_id);
            if (is_bool($isPrimary)) {
                $imageQuery->where('is_primary', $isPrimary);
            }
            $product['images'] = $imageQuery->get()->getResultArray();

            // Lấy đánh giá cho sản phẩm
            $product['reviews'] = $this->db->table('reviews')->where('product_id', $product_id)->get()->getResultArray();
        }

        return $products;
    }
}
