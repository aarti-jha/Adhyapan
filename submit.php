<?php
// Connect to your database (replace with your database details)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $topics = $_POST["topics"];
    $subjects = $_POST["subjects"];
    $age = isset($_POST["age"]) ? 1 : 0; // 1 if checkbox is checked, 0 otherwise
    $school = $_POST["school"];
    $degree = $_POST["degree"];

    // Upload resume file
    $resumeFileName = $_FILES["resume"]["name"];
    $resumeTmpName = $_FILES["resume"]["tmp_name"];
    $resumePath = "uploads/" . $resumeFileName; // Assuming there's an 'uploads' directory

    move_uploaded_file($resumeTmpName, $resumePath);

    // Insert data into the database
    $sql = "INSERT INTO tutors (first_name, last_name, email, phone, topics, subjects, age, resume, school, degree)
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$topics', '$subjects', '$age', '$resumePath', '$school', '$degree')";

    if ($conn->query($sql) === TRUE) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
