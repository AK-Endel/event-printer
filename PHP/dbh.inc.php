<?php
$dsn = "mysql:host=127.0.0.1;port=localhost:3306;dbname=phptest";
$dbusername = "root";
$dbpassword = "Tere123456!";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed:( " . $e->getMessage();
}
