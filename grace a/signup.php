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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username or email already exists
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            // User is registered, set session variables
            $_SESSION["username"] = $username;
            $_SESSION["loggedin"] = true;
            header("Location: 2.html"); // Redirect to the desired page after sign-up
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!-- HTML sign-up form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SCRIPT"]);?>">
    Name: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Sign Up">
</form>