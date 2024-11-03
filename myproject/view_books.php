<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <h2>All Books</h2>
    <a href="add_book.php">Add New Book</a><br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
        <?php
        include 'db_connection.php';
        $database = new Database();
        $db = $database->getConnections();

        $query = "SELECT * FROM books";
        $stmt = $db->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['author']) . "</td>";
            echo "<td>" . htmlspecialchars($row['year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
            echo "<td>
                    <a href='update_book.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a href='delete_book.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this book?');\">Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
