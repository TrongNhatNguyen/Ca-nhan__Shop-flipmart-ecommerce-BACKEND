<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Frontend\CategoryModel;
use App\Models\Frontend\ProductModel;
use CodeIgniter\Config\Services;

class HomeController extends BaseController
{
    protected $services;
    protected $time;
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        // Khởi tạo hàm svice:
        $this->services = new Services();

        // Khởi tạo hàm lấy, format thời gian:
        $this->time = \CodeIgniter\I18n\Time::now('Asia/Ho_Chi_Minh');

        // Khởi tạo lớp Model:
        $this->categoryModel = new CategoryModel();
        $this->productModel  = new ProductModel();
    }


    /**-------------------------------
     *  Hàm Trang chủ (index)
     */
    public function index()
    {
        $data['list_category'] = $this->show_sidebar_category();
        $data['new_products']  = $this->show_new_products();

        // Trả về giao diện index có: extend,section ở Views
        $view = $this->services->renderer(APPPATH . 'Views/frontend/home/', null, false);
        return $view->setData($data)->render('index');
    }


    /**----------------------------
     *  Hàm show sidebar danh mục
     */
    public function show_sidebar_category()
    {
        $list_category = $this->categoryModel->get_list();
        // $re = implode(',', array_column($list_category, 'name'));
        // var_dump($re);
        // exit;
        return $list_category;
    }


    /**----------------------------
     *  Hàm show Sản Phẩm mới
     */
    public function show_new_products()
    {
        $dieu_kien = ['is_new' => 1];
        $sap_xep   = 'created_at DESC';

        $new_products = $this->productModel->get_list_with_image_stars(where: $dieu_kien, orderBy: $sap_xep);
        // var_dump($new_products);
        // exit;
        return $new_products;
    }


    /**-------------------------------
     *  Hàm show Sản phẩm Tiêu Biểu
     */
    public function show_featured_products()
    {
        $featured_products = $this->productModel->get_top_rated_products();
        return $featured_products;
    }
}
