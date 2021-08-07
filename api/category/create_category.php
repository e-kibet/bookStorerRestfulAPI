<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set("error_log", "../../error.log");

include_once '../../config/dbclass.php';

include_once '../../entities/category.php';

$dbclass = new DBClass();

$connection = $dbclass->getConnection();

$category = new Category($connection);

$data = json_decode(file_get_contents("php://input"));

if($data->name && $data->description && $data->created && $data->modified){

$input = ['name' => $data->name, 'description' => $data->description, 'created' => $data->created, 'modified' => $data->modified];

if($category->create($input)){
    echo json_encode(["status" => true, "code" => 200,  "message" => "Category has been created"]);
}else{
    echo json_encode(["status" => false, "code" => 201,  "message" => "Error Unable to create the category"]);
}
}else{
    echo json_encode(["status" => false, "code" => 404,  "message" => "All fields are required"]);
}
?>