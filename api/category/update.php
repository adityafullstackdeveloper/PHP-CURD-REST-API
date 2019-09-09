<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type:Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  $database = new Database();
  $db = $database->connect();
  $cat = new Category($db);
  $data = json_decode(file_get_contents("php://input"));
  $cat->id = isset($_GET['id']) ? $_GET['id'] : die('Request Failed');
  $cat->name = $data->name;
  $return = $cat->update() ? array('status' => true, 'message' => 'Category Updated Successfully...') : array('status' => false, 'message' => 'Category Not Updated');
  echo json_encode($return);