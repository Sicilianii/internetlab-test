<?php
$PDO = include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $body = [];

    parse_str(file_get_contents("php://input"), $body);

    $name = $body["name"];
    $email = $body["email"];
    $password = md5($body["password"]);
    $result = null;

    if (!empty($name) && !empty($email) && !empty($password)) {
        $statement = $PDO->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $result = $statement->execute(["name" => $name, "email" => $email, "password" => $password]);
    }
    if ($result) {
        http_response_code(201);
        echo json_encode(array("id" => $PDO->lastInsertId()));
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Database error"));
    }
} else {
    echo json_encode( ["status" => 405 , "message" => 'Ого! Ты ошибься...']);
}