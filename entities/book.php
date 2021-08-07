<?php
class Book{
    private $connection;

    private $table = "books";

     public $id;
     public $name;
     public $description;
     public $created; 
     public $modified;
     
     public function __construct($connection){
        $this->connection = $connection;
    }

    public function create(Array $input){
        $query = "INSERT INTO books(`category_id`, `name`,  `author`, `description`, `created`) VALUES(:category_id, :name, :author, :description, :created)";
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'category_id' => $input['category_id'],
                'name' => $input['name'],
                'author' => $input['author'],
                'description' => $input['description'],
                'created' => $input['created']
            ]
            );
            $last_id = $this->connection->lastInsertId();
            return $last_id;

        }catch(\PDOException $e){
            exit($e->getMessage());
            return 0;
        }
    }

    public function read(){
        $query = "SELECT * FROM books";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }


}