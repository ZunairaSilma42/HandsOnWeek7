<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add a New Book</h2>
    <form action="add_book.php" method="POST">
        <label for="title">Judul Buku:</label><br>
        <input type="text" name="title" required><br><br>

        <label for="author">Penulis:</label><br>
        <input type="text" name="author" required><br><br>

        <label for="year">Tahun Terbit:</label><br>
        <input type="number" name="year" required><br><br>

        <label for="genre">Genre:</label><br>
        <input type="text" name="genre" required><br><br>

        <input type="submit" name="submit" value="Add Book">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        include 'db_connection.php';
        $database = new Database();
        $db = $database->getConnections();

        $query = "INSERT INTO books (title, author, year, genre) VALUES (:title, :author, :year, :genre)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':author', $_POST['author']);
        $stmt->bindParam(':year', $_POST['year']);
        $stmt->bindParam(':genre', $_POST['genre']);

        if ($stmt->execute()) {
            echo "Book added successfully!";
        } else {
            echo "Error adding book.";
        }
    }
    ?>
</body>
</html>
