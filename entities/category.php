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
        $query = "INSERT INTO categories(name, description, created, updated) VALUES (:name, :description, :created, :modified)";
        try{
            $statement = $this->connection->prepare($query);
            $statement = execute(array(
                'name' => $input['name'],
                'description' => $input['description'],
                'created' => $input['created'],
                'modified' => $input['modified']
            )
            );
            return $statement->rowCount();

        }catch(\PDOException $e){
            exit($e->getMessage());
        }

        
    }



}