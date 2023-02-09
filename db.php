<?php
// Connect to database
$dbHost = $_ENV['DATABASE_HOST'];
$dbUser = $_ENV['DATABASE_USER'];
$dbPassword = $_ENV['DATABASE_PASSWORD'];
$dbName = $_ENV['DATABASE_NAME'];
$dbPort = $_ENV['DATABASE_PORT'];

$dblink = mysql_connect($dbHost . ":" . $dbPort, $dbUser, $dbPassword);
if (!$dblink) {
    http_response_code(500);
    echo json_encode(["error" => mysql_error()]);
    exit;
}

mysql_select_db($dbName, $dblink);
