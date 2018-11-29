<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog category object
    $category = new Category($db);

    // Get Id
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get Category
    $category->read_single();

    // Create array
    $cat_arr = array(
        'name' => $category->name
    );
   // Make Json
   print_r(json_encode($cat_arr));