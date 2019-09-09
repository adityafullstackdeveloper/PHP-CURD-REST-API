<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  $database = new Database();
  $db = $database->connect();
  $cat = new Category($db);
  $cat->id = isset($_GET['id']) ? $_GET['id'] : die('Request Failed');
  $cat->read_single();
  $cat_arr = array(
    'id' => $cat->id,
    'name' => $cat->name,
  );
  print_r(json_encode($cat_arr));
  die();