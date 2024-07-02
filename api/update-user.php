<?php
$PDO = include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

if($_SERVER["REQUEST_METHOD"] == "PUT") {
    $body = [];

    parse_str(file_get_contents("php://input"), $body);

    $name = $body["name"];
    $email = $body["email"];
    $password = md5($body["password"]);
    $result = null;

    if (!empty($name) && !empty($email) && !empty($password)) {
        $statement = $PDO->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
        $result = $statement->execute(["name" => $name, "email" => $email, "password" => $password, "id" => $_GET['id']]);
    }
    if ($result) {
        http_response_code(201);
        echo json_encode(array("id" => 'Success update'));
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Rejected update"));
    }
} else {
    echo json_encode( ["status" => 405 , "message" => 'Ого! Ты ошибься...']);
}