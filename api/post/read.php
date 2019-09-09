<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';
  $database = new Database();
  $db = $database->connect();
  $post = new Post($db);
  $result = $post->read();
  $num = $result->rowCount();
  $return = array();
  if ($num > 0) {
    $return['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $post_item = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'body' => html_entity_decode($row['body']),
        'author' => $row['author'],
        'category_id' => $row['category_id'],
        'category_name' => $row['category_name']
      );
      array_push($return['data'], $post_item);
    }
  } else {
    $return = array('status' => true, 'message' => 'No Posts Found...', 'data' => false);
  }
  echo json_encode($return);
  die();