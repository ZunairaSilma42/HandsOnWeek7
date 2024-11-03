<?php
include 'db_connection.php';

$database = new Database();
$db = $database->getConnections();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM books WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Book not found.";
        exit;
    }
} else {
    echo "No book ID provided.";
    exit;
}

if (isset($_POST['submit'])) {
    $new_title = $_POST['title'];

    $update_query = "UPDATE books SET title = :title WHERE id = :id";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bindParam(':title', $new_title);
    $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo "Book title updated successfully!";
        echo "<br><a href='view_books.php'>Back to Book List</a>";
        exit;
    } else {
        echo "Error updating book.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Book Title</title>
</head>
<body>
    <h2>Update Book Title</h2>
    <form action="update_book.php?id=<?php echo $id; ?>" method="POST">
        <label for="title">New Judul Buku:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br><br>
        <input type="submit" name="submit" value="Update Title">
    </form>
    <br>
    <a href="view_books.php">Back to Book List</a>
</body>
</html>
