<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbclass.php';

include_once '../../entities/category.php';

$dbclass = new DBClass();

$connection = $dbclass->getConnection();

$category = new Category($connection);

$data = json_decode(file_get_contents("php://input"));

if($data->name && $data->description && $data->created && $data->modified){

$category->name = $data->name;
$category->description = $data->description;
$category->created = $data->created;
$category->modified = $data->modified;

if($category->create()){
    echo '{';
        echo '"message": "Category was created."';
    echo '}';
}else{
    echo '{';
        echo '"message": "Unable to create catetory."';
    echo '}';
}
}else{
    echo '"All the fields are needed!"';
}
?>