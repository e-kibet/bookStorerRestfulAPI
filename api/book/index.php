<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("error_log", "../../error.log");

include_once '../../config/dbclass.php';

include_once '../../entities/book.php';

$dbclass = new DBClass();

$connection = $dbclass->getConnection();

$book = new Book($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if($data->category_id && $data->name && $data->author && $data->description && $data->created && $data->modified){
        $input = ['category_id' => $data->category_id,  'name' => $data->name, 'author' => $data->author,  'description' => $data->description, 'created' => $data->created, 'modified' => $data->modified];

if($book->create($input)){
    echo json_encode(["status" => true, "code" => 200,  "message" => "Book has been created"]);
}else{
    echo json_encode(["status" => false, "code" => 201,  "message" => "Error Unable to create the Book"]);
}
}else{
    echo json_encode(["status" => false, "code" => 404,  "message" => "All fields are required"]);
}
    
}else if ($_SERVER['REQUEST_METHOD'] === 'GET'){

$stmt = $book->read();

$count = $stmt->rowCount();
if($count > 0){
    $book = array();
    $book["body"] = array();
    $book["count"] = $count;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $p  = array(
              "id" => $id,
              "name" => $name,
              'category_id' => $category_id,
              'author' => $author,
              "description" => $description,
              "created" => $created,
              "modified" => $modified
        );
        array_push($book["body"], $p);
    }
    echo json_encode($book);
}else {
    echo json_encode(["body" => null, "count" => 0]);
}

}

?>