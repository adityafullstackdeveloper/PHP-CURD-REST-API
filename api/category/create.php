<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type: Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  $database = new Database();
  $db = $database->connect();
  $cat = new Category($db);
  $data = json_decode(file_get_contents("php://input"));
  $cat->name = @$data->name;
  
  $return = $cat->name ? $cat->create() ? array('status' => true, 'message' => 'Category Created Successfully...') : array('status' => false, 'message' => 'Category Not Created') : array('status' => false, 'message' => 'Category Name Is Empty');
  echo json_encode($return);