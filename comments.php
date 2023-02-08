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
        global $pdo;
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $query = 'SELECT * FROM comment WHERE productId = :id';
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        global $pdo;

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
        $stmt = $pdo->prepare("INSERT INTO comment (author, content, createdAt,updatedAt, productId) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$author, $content, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $productId]);

        http_response_code(201);
        echo json_encode(["message" => "Comment added"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}

// Update a comment
function handlePutRequest()
{
    try {
        global $pdo;

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
        // Update the comment in the database
        $query = 'UPDATE comment SET author = :author, content = :content, updatedAt = :updatedAt, productId = :productId WHERE id = :id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':author', $author, PDO::PARAM_STR);
        $statement->bindValue(':content', $content, PDO::PARAM_STR);
        $statement->bindValue(':updatedAt', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $statement->bindValue(':productId', $productId, PDO::PARAM_INT);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Return the updated comment
        $query = 'SELECT * FROM comment WHERE id = :id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $comment = $statement->fetch(PDO::FETCH_ASSOC);

        if ($comment === false) {
            http_response_code(404);
            echo json_encode(['error' => 'Comment not found']);
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
        global $pdo;

        // Delete the comment from the database
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $query = 'DELETE FROM comment WHERE id = :id';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Check if the comment was deleted
        if ($statement->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Comment not found']);
            return;
        }

        http_response_code(204);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }
}
