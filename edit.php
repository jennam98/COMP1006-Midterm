<?php
 // allows ability to edit reviews from the database and admin page
require 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        $review = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No review ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review - Book Reviews</title>
</head>
<body>
    <h1>Edit Review</h1>

    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($review['id']); ?>">

        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($review['title']); ?>">

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($review['author']); ?>">

        <label for="rating">Rating (1 to 5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo htmlspecialchars($review['rating']); ?>">

        <label for="review_text">Review:</label>
        <textarea id="review_text" name="review_text" rows="6" cols="40"><?php echo htmlspecialchars($review['review_text']); ?></textarea>

        <button type="submit">Update Review</button>
    </form>

    <p>
        <a href="admin.php">Go back to Admin Page</a>
    </p>



