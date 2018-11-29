<?php
   // Headers
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');

   include_once '../../config/Database.php';
   include_once '../../models/Category.php';

   // Intitate DB & Connect
   $database = new Database();
   $db =  $database->connect();

  // Instantiate blog category object
  $category =  new Category($db);

  // Blog Category query
  $result = $category->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any category
  if($num > 0){
     // Category array
     $cats_arr = array();
     $cats_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item =  array(
              'id' => $id,
              'name' => $name
          );

         // Push to "data"
         array_push($cats_arr['data'], $cat_item);

     }
       
         // Turn to JSON & output
         echo json_encode($cats_arr);

  } else {
       // No Category
       echo json_encode(
        array('message' => 'No Category Found')
       );
  }


