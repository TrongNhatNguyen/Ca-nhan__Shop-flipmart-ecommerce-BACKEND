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
    protected $productImageModel;
    protected $reviewModel;
    function __construct()
    {
        parent::__construct();

        // nạp thư viện kiểm tra Quy tắc:
        $this->validation = \Config\Services::validation();

        // Khởi tạo lớp Model:
        $this->productImageModel = new ProductImageModel();
        $this->reviewModel       = new ReviewModel();
    }


    /**----------------------------
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


    /**-----------------------------------------------
     * Lấy DS Sản Phẩm có Ảnh tiêu biểu và Sao rating
     */
    public function get_list_with_image_stars($where = [], $fields = '*', $orderBy = null, $limit = 10, $offset = 0)
    {
        if (!$orderBy) {
            $orderBy = $this->primaryKey . ' DESC';
        }

        // Lấy ra danh sách sản phẩm
        $products = $this->select($fields)->where($where)->orderBy($orderBy)->findAll($limit, $offset);

        // Lặp qua danh sách sản phẩm
        foreach ($products as &$product) {
            $product_id = $product['product_id'];

            // Lấy ảnh tiêu biểu cho từng sản phẩm
            $product['images'] = $this->productImageModel->get_primary_image($product_id);

            // Lấy SAO đánh giá trung bình cho từng sản phẩm
            $product['reviews'] = $this->reviewModel->get_average_rating($product_id);
        }

        return $products;
    }


    /**--------------------------------------
     * Lấy danh sách Sản Phẩm Bán Chạy
     */
    public function get_best_selling_products($limit = 10, $offset = 0)
    {
        $this->select('products.*, COUNT(orders.id) as total_orders')
            ->join('orders', 'products.product_id = orders.product_id')
            ->groupBy('products.product_id')
            ->orderBy('total_orders', 'DESC');

        return $this->findAll($limit, $offset);
    }


    /**-------------------------------------------
     * Lấy danh sách Sản Phẩm được Đánh Giá Cao
     */
    public function get_top_rated_products($limit = 10, $offset = 0)
    {
        $this->select('products.*, AVG(reviews.rating) as average_rating')
            ->join('reviews', 'products.product_id = reviews.product_id')
            ->where('reviews.status', 'active')
            ->groupBy('products.product_id')
            ->orderBy('average_rating', 'DESC');

        return $this->findAll($limit, $offset);
    }
}
