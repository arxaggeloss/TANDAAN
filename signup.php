<?php
    require_once "register.php";

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

.separator {
    margin: 20px 0;
}

.social-buttons button {
    width: 100%;
    background-color: #ffffff;
    border: 1px solid #ccc;
    padding: 10px 20px;
    border-radius: 5px;
    margin: 10px 0;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.social-buttons button i {
    margin-right: 10px;
    font-size: 18px;
}


.social-buttons button:hover {
    background-color: #f0f0f0;
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
            <h2>Sign Up</h2>
            <form action="register.php" method="post">
                <input type="text" name="username" placeholder="Username or Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="login-button" type="submit">Sign Up</button>
            </form>
            <p class="signup-link">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
