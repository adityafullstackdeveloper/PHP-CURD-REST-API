<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type:Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once('../../models/Post.php');
  $database = new Database();
  $db = $database->connect();
  $post = new Post($db);
  $data = json_decode(file_get_contents("php://input"));
  $post->title = ($data->title) ? $data->title : false;
  $post->body = ($data->body) ? $data->body : false;
  $post->author = ($data->author) ? $data->author : false;
  $post->category_id = ($data->category_id) ? $data->category_id : false;
  $return = (!empty($post->title) || !empty($post->category_id)) ? $post->create() ? array('status' => true, 'message' => 'Post Created Successfully...') : array('status' => false, 'message' => 'Post Not Created') : array('status' => false, 'message' => 'Post Title And Post Category Is Required.');
  echo json_encode($return);
  die();