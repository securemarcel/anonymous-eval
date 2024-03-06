<?php

# employee profile shows all comments related to that employee
include "db_info.php"; 
include "header.php";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $id = $_GET["id"];

  $query = "SELECT * FROM employees WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 0) {
    echo "No information found.";
    exit;
  }

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<p class=\"text1\">Name: " . $row["name"] . "</p>";
    echo "<p class=\"text1\">Rating: " . $row["rating"] . "</p>"; # needs to include add_rating.php
  }
  $query1 = "SELECT * FROM employees WHERE id='$id'";
  $result1 = mysqli_query($conn, $query1);

  if(mysqli_num_rows($result1) == 0) {
    echo "No information found.";
    exit;
  }

  while($row = mysqli_fetch_assoc($result1)) {
    echo "<a href=\"add.php?id=".$row["id"]."\"><p class=\"text1\"><button class=\"btn-13\">Add Comment & Rating</button></p></a>";
  }

  $query = "SELECT * FROM comments WHERE employee_id='$id'";
  $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result) == 0) {
    echo "No comments have been found.";
    exit;
  }

  while($row = mysqli_fetch_assoc($result)) {
    echo "<p class=\"text1\">Comment: ".$row["comment"]."</p>";
  }

  


  
?>