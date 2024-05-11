<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User is valid, set session variables
        $_SESSION["username"] = $username;
        $_SESSION["loggedin"] = true;
        header("Location: 2.html"); // Redirect to the desired page after login
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!-- HTML login form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SCRIPT"]);?>">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Login">
</form>