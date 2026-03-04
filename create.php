<?php
require 'connect.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method.";
    exit;
}

// santize input
$title = filter_var($title, FILTER_SANITIZE_STRING);
$author = filter_var($author, FILTER_SANITIZE_STRING);
$rating = filter_var($rating, FILTER_SANITIZE_NUMBER_INT);
$review_text = filter_var($review_text, FILTER_SANITIZE_STRING);

try {
    $stmt = $conn->prepare("INSERT INTO reviews (title, author, rating, review_text) VALUES (:title, :author, :rating, :review_text)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':review_text', $review_text);
    
    if($stmt->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Failed to submit review.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

