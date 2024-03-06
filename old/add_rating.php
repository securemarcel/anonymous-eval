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

// Prepare the statement
$stmt = $conn->prepare("SELECT rating FROM employees WHERE id = ?");
// Bind the parameter to the statement
$stmt->bind_param("i", $id);
// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Fetch the data
while($row = mysqli_fetch_assoc($result))
{
    echo "<form action=\"process_rating.php\" method=\"get\">
    <input type=\"hidden\" name=\"id\" value=\"".$id."\"/>
    <p class=\"text1\">ADD A RATING: <input type=\"number\" min=\"0\" max=\"10\" name=\"rating\"/>
    <input type=\"submit\" value=\"Submit\"/></p>
    </form>";
}
// Close the statement
$stmt->close();
?>
