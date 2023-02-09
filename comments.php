<?php
require_once './db.php';
require_once './headers.php';

$method = $_SERVER["REQUEST_METHOD"];

// Handle the request based on the method
switch ($method) {
    case "GET":
        handleGetRequest();
        break;
    case "POST":
        handlePostRequest();
        break;
    case "PUT":
        handlePutRequest();
        break;
    case "DELETE":
        handleDeleteRequest();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
        break;
}

// Get all comments
function handleGetRequest()
{
    try {
        global $dblink;
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $query = 'SELECT * FROM comment WHERE productId = ' . $id;
        $result = mysql_query($query, $dblink);
        if (!$result) {
            http_response_code(500);
            echo json_encode(["error" => mysql_error()]);
            exit;
        }

        $comments = array();
        while ($row = mysql_fetch_assoc($result)) {
            $comments[] = $row;
        }
        mysql_free_result($result);
        http_response_code(200);
        echo json_encode($comments);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}

// Add a new comment
function handlePostRequest()
{
    try {
        global $dblink;

        // Validate inputs
        $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);

        $productId = filter_input(INPUT_POST, "productId", FILTER_VALIDATE_INT);

        if ($author === false || $content === false  || $productId === false) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }

        // Insert the comment
        // $stmt = $pdo->prepare("INSERT INTO comment (author, content, createdAt,updatedAt, productId) VALUES (?, ?, ?, ?, ?)");
        // $stmt->execute([$author, $content, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $productId]);
        $query = "INSERT INTO comment (author, content, createdAt, updatedAt, productId) VALUES ('$author', '$content', date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), '$productId')";
        $result = mysql_query($query, $dblink);
        if (!$result) {
            throw new Exception("Failed to insert");
        }
        http_response_code(201);
        echo json_encode(["message" => "Comment added"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}

// Update a comment
function handlePutRequest()
{
    try {
        global $dblink;

        // Validate inputs
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

        $productId = filter_input(INPUT_POST, 'productId', FILTER_VALIDATE_INT);

        // Validate the data
        if ($author === false || $content === false || $productId === false) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data provided']);
            return;
        }

        $query = "UPDATE comment SET author = '$author', content = '$content', updatedAt = '" . date('Y-m-d H:i:s') . "', productId = '$productId' WHERE id = '$id'";
        $result = mysql_query($query, $dblink);
        if (!$result) {
            throw new Exception("Insertion failed");
        }
        $query = "SELECT * FROM comment WHERE id = '$id'";
        $result = mysql_query($query, $dblink);
        $comment = mysql_fetch_assoc($result);

        if (!$comment) {
            http_response_code(404);
            echo json_encode(array('error' => 'Comment not found'));
            return;
        }

        http_response_code(200);
        echo json_encode($comment);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}

function handleDeleteRequest()
{
    try {
        global $dblink;

        // Delete the comment from the database
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $query = "DELETE FROM comment WHERE id = $id";
        $delresult =  mysql_query($query, $dblink);
        if (!$delresult) {
            throw new Exception("Deletion failed");
        }

        // Check if the comment was deleted
        $result = mysql_query("SELECT * FROM comment WHERE id = $id", $dblink);
        if (mysql_num_rows($result) == 0) {
            http_response_code(404);
            echo json_encode(array('error' => 'Comment not found'));
            return;
        }
        http_response_code(204);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}
