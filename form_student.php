<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$educationLevel =$_POST['educationLevel'];
$age = $_POST['age'];

// Prepare and execute the SQL query to insert the data
$sql = "INSERT INTO form_student(firstName, lastName, address, educationLevel,age)
        VALUES ('$firstName', '$lastName', '$address', '$educationLevel', '$age')";

if ($conn->query($sql) === TRUE) {
    header('Location:home.html');
} else {
    die("value inserting field " .mysqli_error($conn));
}

// Close the database connection
$conn->close();
?>
