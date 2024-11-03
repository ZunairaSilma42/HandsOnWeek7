<?php
include 'db_connection.php';

$database = new Database();
$db = $database->getConnections();

// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Optional: Fetch the book to confirm it exists
    $query = "SELECT * FROM books WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Book not found.";
        exit;
    }

    // Delete the book
    $delete_query = "DELETE FROM books WHERE id = :id";
    $delete_stmt = $db->prepare($delete_query);
    $delete_stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($delete_stmt->execute()) {
        echo "Book deleted successfully!";
        echo "<br><a href='view_books.php'>Back to Book List</a>";
        exit;
    } else {
        echo "Error deleting book.";
    }
} else {
    echo "No book ID provided.";
    exit;
}
?>
