<?php
    include "db_info.php";
    include "header.php";
    
    // Create connection
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error);
    }

    $employee_id = $_POST["id"];
    $comment = $_POST["comment"];

    $query = "INSERT INTO comments (id, employee_id, comment, timestamp) VALUES (NULL, '".$conn->real_escape_string($employee_id)."', '".$conn->real_escape_string($comment)."', current_timestamp())";

    if ($conn->query($query) === TRUE) {
        echo "Your comment has been added";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    echo "Your comment has been added";
?>
<meta http-equiv="refresh" content="0; url='index.php'"/>
