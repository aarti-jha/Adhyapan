<?php
session_start();

// Define database credentials as constants
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "data"); // Change this to your database name

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize user inputs
$name = $_POST['name'];
$password = $_POST['password'];

if (empty($name) || empty($password)) {
    $_SESSION['login_error'] = 'Please enter both username and password.';
    header('Location: login_process_student.php');
    exit();
}

// Prepare and execute the SQL query using a prepared statement
$sql = "SELECT name, password FROM sign_up1 WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        print_r('password verified .....');
        // Authentication successful
        $_SESSION['name'] = $row['name'];
        header('Location: home.html'); // Redirect to a protected page
        exit();
    } else {
        print_r('Authentication failed .....');

        // Authentication failed
        $_SESSION['login_error'] = 'Invalid username or password';
    }
} else {
    // User not found
    $_SESSION['login_error'] = 'Invalid username or password';
    header('Location: login_process_student.php');
    // Redirect the user back to the login page only once if there was an error
}

exit();

$stmt->close();
$conn->close();
