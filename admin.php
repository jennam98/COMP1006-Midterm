<?php

// takes data from the database and displays it in a table
require 'connect.php';

try {
    $stmt = $conn->query("SELECT * FROM reviews");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page - Book Reviews</title>
</head>
<body>
    <h1>Admin Page - Book Reviews</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Rating</th>
            <th>Review Text</th>
        </tr>
        <?php foreach ($reviews as $review): ?>
        <tr>
            <td><?php echo htmlspecialchars($review['id']); ?></td>
            <td><?php echo htmlspecialchars($review['title']); ?></td>
            <td><?php echo htmlspecialchars($review['author']); ?></td>
            <td><?php echo htmlspecialchars($review['rating']); ?></td>
            <td><?php echo htmlspecialchars($review['review_text']); ?></td>

            // add edit and delete buttons for each review
            <td>
                <a href="edit.php?id=<?php echo $review['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $review['id']; ?>" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p>
        <a href="index.php">Go back to Submission Page</a>
    </p>
</body>
</html>