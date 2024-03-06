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

echo "<form action=\"process_comment.php\" method=\"post\" onsubmit=\"return checkComment()\">
    <input type=\"hidden\" name=\"id\" value=\"".$id."\"/>
    <p class=\"text1\">ADD A COMMENT: <input type=\"text\" name=\"comment\" id=\"comment\" oninput=\"checkComment()\"/>
    <input type=\"submit\" value=\"Submit\"/></p>
    </form>";

echo "<form action=\"process_rating.php\" method=\"get\">
    <input type=\"hidden\" name=\"id\" value=\"".$id."\"/>
    <p class=\"text1\">ADD A RATING: <input type=\"number\" min=\"0\" max=\"10\" name=\"rating\"/>
    <input type=\"submit\" value=\"Submit\"/></p>
    </form>";



// // Prepare the statement
// $stmt = $conn->prepare("SELECT comment FROM comments WHERE id = ?");
// // Bind the parameter to the statement
// $stmt->bind_param("s", $id);
// // Execute the statement
// $stmt->execute();
// $result = $stmt->get_result();

// // Fetch the data
// while($row = mysqli_fetch_assoc($result))
// {
//     echo "<form action=\"process_comment.php\" method=\"post\" onsubmit=\"return checkComment()\">
//     <input type=\"hidden\" name=\"id\" value=\"".$id."\"/>
//     <p class=\"text1\">ADD A COMMENT: <input type=\"text\" name=\"comment\" id=\"comment\" oninput=\"checkComment()\"/>
//     <input type=\"submit\" value=\"Submit\"/></p>
//     </form>";
// }
?>
<script>
    function checkComment() {
        var comment = document.getElementById("comment").value;
        var pattern = /<[^>]*></;
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
?>
