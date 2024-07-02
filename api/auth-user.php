<?php
$PDO = include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $body = [];

    parse_str(file_get_contents("php://input"), $body);

    $email = $body["email"];
    $password = md5($body["password"]);
    $result = null;

    if (!empty($email) && !empty($password)) {
        $statement = $PDO->prepare(
            'SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1'
        );
        $statement->execute([
            'email' => $email,
            'password' => md5($password)
        ]);

        $result = $statement->fetchObject() ?: null;
    }
    if ($result) {
        http_response_code(201);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Database error"));
    }
} else {
    echo json_encode( ["status" => 405 , "message" => 'Ого! Ты ошибься...']);
}