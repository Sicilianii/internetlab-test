<?php

$PDO = include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $statement = $PDO->prepare('SELECT * FROM users where id=:id');
    $statement->execute(['id' => $_GET['id']]);
    $result = $statement->fetchObject() ?: null;

    if ($result) {
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Database error"));
    }
} else {
    echo json_encode(["status" => 405, "message" => 'Ого! Ты ошибься...']);
}