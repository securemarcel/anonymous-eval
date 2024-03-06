<?php
include "db_info.php";
include "header.php";
session_start();

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 # List all employees
$sql = "SELECT id, name FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p class=\"text1\">Name: " . $row["name"]. " ";
        echo "<a href=\"profile.php?id=".$row["id"]."\"><button class=\"btn-13\"><span class=\"material-symbols-outlined\">
        start</span></button></a><br>";
    }

} else {
    echo "There are no employees in the database!";
}

$conn->close();

 # profile for every employee


?>
