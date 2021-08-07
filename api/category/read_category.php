<?php
header("Content-Type: application/json; charset=UTF-8");
include_once '../../config/dbclass.php';
include_once '../../entities/category.php';
ini_set("error_log", "../../error.log");

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$category = new Category($connection);

$stmt = $category->read();
$count = $stmt->rowCount();
if($count > 0){
    $category = array();
    $category["body"] = array();
    $category["count"] = $count;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $p  = array(
              "id" => $id,
              "name" => $name,
              "description" => $description,
              "created" => $created,
              "modified" => $modified
        );
        array_push($category["body"], $p);
    }
    echo json_encode($category);
}else {
    echo json_encode(["body" => null, "count" => 0]);
}

?>