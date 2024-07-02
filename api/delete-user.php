<?php
$PDO = include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

if($_SERVER["REQUEST_METHOD"] === "DELETE") {

    $statement = $PDO->prepare('DELETE FROM users where id=:id');
    $result = $statement->execute(['id' => $_GET['id']]);

    if ($result) {
        http_response_code(201);
        echo json_encode(array("message" => 'User deleted.'));
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Database error"));
    }
} else {
    echo json_encode( ["status" => 405 , "message" => 'Ого! Ты ошибься...']);
}