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

$id = $_GET["id"];
$_SESSION['employee_id'] = $id; // set the session variable

echo "<form action=\"process.php\" method=\"post\" onsubmit=\"return validateForm()\">
    <input type=\"hidden\" name=\"id\" value=\"".$id."\"/>
    <p class=\"text1\">ADD A COMMENT: <input type=\"text\" name=\"comment\" id=\"comment\"/></p>
    <p class=\"text1\">ADD A RATING: <input type=\"number\" min=\"0\" max=\"10\" name=\"rating\" id=\"rating\"/></p>
    <input type=\"submit\" value=\"Submit\"/>
    </form>";
?>

<script>
    function validateForm() {
        if (!checkComment()) {
            return false;
        }
        return true;
    }

    function checkComment() {
        var comment = document.getElementById("comment").value;
        var pattern = /<[^>]*>/;
        if(pattern.test(comment)) {
            alert("HTML tags are not allowed in the comment field.");
            return false;
        }
        return true;
    }
</script>
<?php
// Close the statement
$stmt->close();
$conn->close();
?>
