<?php
require_once './db.php';
require_once './headers.php';

$method = $_SERVER["REQUEST_METHOD"];

// Handle the request based on the method
switch ($method) {
    case "GET":
        handleGetRequest();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
        break;
}

function handleGetRequest()
{
    try {
        global $pdo;
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?? 1;
        $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT) ?? 10;

        $offset = ($page - 1) * $limit;

        $stmt = $pdo->prepare("SELECT product.*, (SELECT COUNT(*) FROM comment WHERE comment.productId = product.id) AS comments FROM product LIMIT :offset, :limit");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($products);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}