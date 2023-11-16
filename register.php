<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "tandaandb";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the registration form
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // You should hash the password before storing it in the database for security.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Perform the SQL query to insert the user data into the database
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
