<?php
include "db_info.php";
include "header.php";

// Start the session
session_start();

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];
$comment = $_POST["comment"];
$rating = $_POST['rating'];
$username = $_SESSION['username'];

// Insert the comment into the database
$query = "INSERT INTO comments (employee_id, comment, rating, comment_user) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isss", $id, $comment, $rating, $username);
$stmt->execute();

// Calculate the new average rating for the employee
$query = "SELECT AVG(rating) AS avg_rating FROM comments WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$new_rating = $row['avg_rating'];

// Update the employee's rating in the database
$query = "UPDATE employees SET rating = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("di", $new_rating, $id);
$stmt->execute();

echo "Your comment has been added";

$stmt->close();
$conn->close();

?>
<meta http-equiv="refresh" content="0; url='main.php'"/>
