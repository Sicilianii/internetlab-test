<?php
include('config.php');
try {
    // подключаемся к серверу
    $conn = new PDO(DB_HOST, DB_USER, DB_PASS, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $conn;
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
