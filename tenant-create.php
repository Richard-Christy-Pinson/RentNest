<?php
session_start();
// Establishing connection to the database
$servername = "localhost"; // Replace with your server's address if different
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "db_rentnest";   // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // No encryption

    // Prepare SQL query to insert data (use placeholders for binding)
    $stmt = $conn->prepare("INSERT INTO tenant (username, email, phone, password) VALUES (?, ?, ?, ?)");

    // Check if preparation was successful
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters (s = string, i = integer, d = double, b = blob)
    $stmt->bind_param("ssss", $name, $email, $phone, $password);
    
    // Execute the query
    if ($stmt->execute()) {
        // Show JavaScript alert and redirect to login page
        echo "<script>
                alert('Tenant account created successfully!');
                window.location.href = 'tenant-login.html';
              </script>";
    } else {
        // Show an error if query execution failed
        echo "<script>
                alert('Error: " . $stmt->error . "');
              </script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
