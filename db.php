<?php
// Connect to database
$dbHost = $_ENV['DATABASE_HOST'];
$dbUser = $_ENV['DATABASE_USER'];
$dbPassword = $_ENV['DATABASE_PASSWORD'];
$dbName = $_ENV['DATABASE_NAME'];
$dbPort = $_ENV['DATABASE_PORT'];

$dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbName . ";port=" . $dbPort;

try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
