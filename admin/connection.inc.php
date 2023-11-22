<?php
    session_start();
    $hostname = "http://localhost/ecom";
    $conn = mysqli_connect("localhost", "root", "", "ecom") or die("connection Failed : " . mysqli_connect_error());

    define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].'/ecom/');
    define('SITE_PATH', 'http://localhost/ecom/');

    define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH.'/media/product/');
    define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH.'/media/product/');
    ?>