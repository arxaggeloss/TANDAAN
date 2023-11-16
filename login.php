<?php
session_start(); // Start the session (if not already started)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);

if (isset($_SESSION['user_id'])) {
    // The user is already logged in, so redirect to the main page
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection parameters
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "tandaandb";

    // Create a connection to the database
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to check if the user exists
    $check_user_query = "SELECT * FROM user WHERE username = '$username'";
    $user_result = $conn->query($check_user_query);

    if ($user_result->num_rows == 1) {
        $user_row = $user_result->fetch_assoc();
    
        // Output some debugging information
        echo "Password from form: " . $password . "<br>";
        echo "Password from database: " . $user_row['password'] . "<br>";
    
        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $user_row['password'])) {
            // Login successful
            // Set a session variable to remember the user's login status
            $_SESSION['user_id'] = $user_row['id'];
            header("Location: index.html"); // Redirect to the main page
            exit();
        } else {
            // Password is incorrect
            echo "Login failed. Please check your password.";
        }
    } else {
        // User does not exist
        echo "User not found. Please check your username.";
    }

    // Close the database connection
    $conn->close();
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Page 1</title>
</head>
<body>
  <video autoplay loop muted playsinline id="background-video">
    <source src="IMAGES/BG VID.mp4" type="video/mp4">
</video>
    <div class="page-content">
      <style>
      .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
    position: relative; 
    z-index: 1;
}

.login-tab {    
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    width: 300px;
    padding: 20px;
    text-align: center;
}

.login-tab h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.login-tab input {
    width: 90%; 
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-button {
    background-color: #578F52;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.login-button:hover {
    background-color: #4C7E49;
}

.signup-link {
    margin-top: 20px;
}
#background-video {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Maintain aspect ratio while covering the container */
    z-index: -1; /* Place it behind other content */
    pointer-events: none;
}
      </style>
      <div class="login-container">
        <div class="login-tab">
            <h2>Login</h2>
            <form id="loginForm" action="login.php" method="post">
                <input type="text" name="username" placeholder="Username or Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="login-button">Login</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </div>
    </div>
</body>
</html>
