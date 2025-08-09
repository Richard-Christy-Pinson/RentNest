<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'db_rentnest');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the input values
$phone = $_POST['phone'];
$password = $_POST['password'];


// Prepare the query
$sql = $conn->prepare("SELECT username, email FROM tenant WHERE phone = ? AND password = ?");
// Bind parameters
$sql->bind_param('ss', $phone, $password);
$sql->execute();
$sql->store_result();

if ($sql->num_rows > 0) {
    // Bind the result variables
    $sql->bind_result($username, $email);
    $sql->fetch();
    
    // Store session variables
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    header("Location: tenant-index.php");
    exit(); // Always use exit() after header redirection
} else {
    // Login failed
    echo "Invalid phone or password.";
}

$sql->close();
$conn->close();
?>
