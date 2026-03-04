<?php

// allows ability to delete reviews from the database and admin page
require 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        echo "Review deleted successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No review ID provided.";
}
?>
<p>
    <a href="admin.php">Go back to Admin Page</a>
</p>

