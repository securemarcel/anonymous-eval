<?php
	include "db_info.php";
	include "header.php";

	// Create connection
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error);
    }  

	$id = $_GET["id"];
	$new_rating = $_GET['rating'];

	$result = mysqli_query($conn, "SELECT rating FROM employees WHERE id='$id'");

	$row = mysqli_fetch_assoc($result);
	$current_rating = $row['rating'];
	$average_rating = ($current_rating + $new_rating) / 2;

	$query = "UPDATE employees SET rating = '$average_rating' WHERE id='$id'";
	$result = mysqli_query($conn, $query);

	echo "Your rating has been added";
?>
<meta http-equiv="refresh" content="0; url='index.php'"/>
