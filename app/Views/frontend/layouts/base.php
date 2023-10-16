<?php

/**
 *  Đây là file chứa bộ khung của webstie, nơi chứa
 *  các đường link CSS, JS,.. và các link khác, bất kỳ 
 *  nội dung chính nào khi được khai báo section
 *  ở index dều phải được khai báo vị trí hiển thị renderSection ở đây.
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Flipmart Shop Hugo</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/bootstrap.min.css'); ?>">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/main.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/blue.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/owl.carousel.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/owl.transitions.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/rateit.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/bootstrap-select.min.css'); ?>">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="<?= base_url('public/frontend/assets/css/font-awesome.css'); ?>">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <?= view('frontend/layouts/header') ?>
    <!-- ============================================== HEADER : END ======================================== -->


    <!-- === KHAI BÁO CONTENT PAGES ===  -->
    <?= $this->renderSection('MAIN_CONTENT') ?>


    <!-- ============================================== FOOTER ============================================== -->
    <?= view('frontend/layouts/footer') ?>
    <!-- ============================================== FOOTER : END ======================================== -->


    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('public/frontend/assets/js/jquery-1.11.1.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/bootstrap-hover-dropdown.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/echo.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/jquery.easing-1.3.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/bootstrap-slider.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/jquery.rateit.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('public/frontend/assets/js/lightbox.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/bootstrap-select.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/wow.min.js'); ?>"></script>
    <script src="<?= base_url('public/frontend/assets/js/scripts.js'); ?>"></script>

    <!-- === KHAI BÁO CONTENT PAGES ===  -->
    <?= $this->renderSection('JS_CUSTOM') ?>
</body>

</html>
