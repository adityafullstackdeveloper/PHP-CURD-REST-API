<?php
  
  class  Post
  {
    public $id;
    public $catergory_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;
    private $con;
    private $table = 'posts';
    
    public function __construct($db)
    {
      $this->con = $db;
    }
    
    /**
     * @return mixed
     */
    public function read()
    {
      $query = 'SELECT  c.name as category_name, p.* FROM ' . $this->table . ' p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC';
      $stmt = $this->con->prepare($query);
      $stmt->execute();
      return $stmt;
    }
    
    /**
     *
     */
    public function read_single()
    {
      $query = 'SELECT  c.name as category_name, p.* FROM ' . $this->table . ' p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = ? LIMIT 0,1';
      $stmt = $this->con->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->title = $row['title'];
      $this->body = $row['body'];
      $this->author = $row['author'];
      $this->category_id = $row['category_id'];
      $this->category_name = $row['category_name'];
    }
    
    /**
     * @return bool
     */
    public function create()
    {
      $query = 'INSERT INTO ' . $this->table . ' SET title = :title,body = :body,author = :author,category_id = :category_id';
      $stmt = $this->con->prepare($query);
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':category_id', $this->category_id);
      if ($stmt->execute()) {
        return true;
      } else {
        print_f("Error: %s .\n", $stmt->error);
        return false;
      }
    }
    
    /**
     * @return bool
     */
    public function update()
    {
      $query = 'UPDATE ' . $this->table . ' SET title = :title,body = :body,author = :author,category_id = :category_id WHERE id = :id';
      $stmt = $this->con->prepare($query);
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':category_id', $this->category_id);
      $stmt->bindParam(':id', $this->id);
      if ($stmt->execute()) {
        return true;
      } else {
        print_f("Error: %s .\n", $stmt->error);
        return false;
      }
    }
    
    public function delete()
    {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id= :id';
      $stmt = $this->con->prepare($query);
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':id', $this->id);
      if ($stmt->execute()) {
        return true;
      } else {
        print_f("Error: %s .\n", $stmt->error);
        return false;
      }
    }
  }