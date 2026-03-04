<?php

// takes data from the form and inserts it into the database

require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $rating = $_POST["rating"];
    $review_text = $_POST["review_text"];

    try {
        $stmt = $conn->prepare("INSERT INTO reviews (title, author, rating, review_text) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $author, $rating, $review_text]);
        echo "Review submitted successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
