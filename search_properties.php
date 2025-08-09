<?php    
session_start(); 

// Get the search parameters
$property_type = isset($_GET['property_type']) ? $_GET['property_type'] : '';
$district = isset($_GET['district']) ? $_GET['district'] : '';

// Connect to the database
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "db_rentnest";  



// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query to search properties based on type and district
$sql = "SELECT * FROM property WHERE property_type=? AND district=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $property_type, $district);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row; // Store each row in an array
    }
}
// Convert the $data array to JSON format
$json_data = json_encode($data);

// Output the JSON to JavaScript and log it to the console
// echo "<script>console.log($json_data);</script>";

// Store the properties in the session
$_SESSION['properties'] = $data;
// Check if any properties are found
if ($result->num_rows > 0) {

    echo "<script>window.location.href = 'property-list.php';</script>";

} else {
    echo "<p>No properties found for your search criteria.</p>";
}

// Close the connection
$conn->close();
?>
