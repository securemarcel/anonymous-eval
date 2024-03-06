<?php
session_start(); // start the session

if (isset($_SESSION['username'])) {
    // If user is already logged in, redirect to the dashboard page
    header("Location: main.php");
    exit;
}

include "db_info.php";
include "header.php";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check if the username and password are valid
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // If username and password are valid, set session variables
        $_SESSION['username'] = $username;

        // Redirect to the dashboard page
        header("Location: index.php");
        exit;
    } else {
        // If username and password are not valid, show an error message
        echo '<p class="error">Invalid username or password.</p>';
    }
}

// Close the database connection
$conn->close();

// Display the login form
echo '<form method="post">';
echo '<label for="username">Username:</label>';
echo '<input type="text" id="username" name="username" required><br><br>';
echo '<label for="password">Password:</label>';
echo '<input type="password" id="password" name="password" required><br><br>';
echo '<input type="submit" value="Login">';
echo '</form>';

include "footer.php";
?>
