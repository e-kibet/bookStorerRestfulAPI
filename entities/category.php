<?php
class Category{
    private $connection;

    private $table = "categories";

     public $id;
     public $name;
     public $description;
     public $created; 
     public $modified;
     
     public function __construct($connection){
        $this->connection = $connection;
    }

    public function create(Array $input){
        $query = "INSERT INTO categories(`name`, `description`, `created`) VALUES(:name, :description, :created)";
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'name' => $input['name'],
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
        $query = "SELECT * FROM categories";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }


}