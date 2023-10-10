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
$email = $_POST['email'];
$phone = $_POST['phone'];
$topics = $_POST['topics'];
$subjects = $_POST['subjects'];
$Availability=$_POST['Availability'];
$age =$_POST['age'];
$school = $_POST['school'];
$degree =$_POST['degree'];

// Prepare and execute the SQL query to insert the data
$sql = "INSERT INTO form_teacher (firstName, lastName, email, phone, topics, subjects, Availability,age, school, degree)
        VALUES ('$firstName', '$lastName', '$email', '$phone', '$topics', '$subjects','$Availability', '$age', '$school', '$degree')";

if ($conn->query($sql) === TRUE) {
    header('Location:homet.html');
} else {
    die("value inserting field " .mysqli_error($conn));
}


// Close the database connection
$conn->close();
?>
