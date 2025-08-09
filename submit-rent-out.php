<?php
// Start the session to access session variables
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the dates and property ID
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];
    $propertyId = $_POST['property_id'];

    // Ensure tenant_username exists in the session
    if (!isset($_SESSION['username'])) {
        echo "<script>
                alert('You must be logged in to rent a property.');
                window.location.href = 'tenant-login.html';
              </script>";
        exit();
    }

    // Database connection details
    $servername = "localhost"; 
    $username = "root";        
    $password = "";            
    $dbname = "db_rentnest";  

    // Create the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query
    $sql = "UPDATE property SET rent_from = ?, rent_to = ?, tenant_username = ?, status = 2 WHERE p_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters (sssi = string, string, string, integer)
        $stmt->bind_param("sssi", $fromDate, $toDate, $_SESSION['username'], $propertyId);

        // Execute the statement
        if ($stmt->execute()) {
            // If the query was successful
            echo "<script>
                    alert('Property rental dates updated successfully!');
                    window.location.href = 'property-list.php';
                  </script>";
        } else {
            // If there was an error executing the query
            echo "<script>
                    alert('Error updating property rental dates.');
                  </script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
