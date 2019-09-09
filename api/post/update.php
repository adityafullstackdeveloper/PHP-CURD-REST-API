<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type:Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';
  $database = new Database();
  $db = $database->connect();
  $post = new Post($db);
  $data = json_decode(file_get_contents("php://input"));
  $post->id = @$data->id;
  $post->title = @$data->title;
  $post->body = @$data->body;
  $post->author = @$data->author;
  $post->category_id = @$data->category_id;
  $return = $post->id ? $post->update() ? array('status' => true, 'message' => 'Post Updated Successfully...') : array('status' => false, 'message' => 'Post Not Updated') : array('status' => false, 'message' => 'Post Id Is Required.');
  echo json_encode($return);
  die();