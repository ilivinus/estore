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
        global $dblink;
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? intval($_GET['page']) : 1;
        $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? intval($_GET['limit']) : 10;

        $offset = ($page - 1) * $limit;

        $query = "SELECT product.*, (SELECT COUNT(*) FROM comment WHERE comment.productId = product.id) AS comments FROM product LIMIT $offset, $limit";
        $result = mysql_query($query, $dblink);
        $products = array();
        while ($row = mysql_fetch_assoc($result)) {
            $products[] = $row;
        }

        mysql_free_result($result);
        header('Content-Type: application/json');
        echo json_encode($products);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}
