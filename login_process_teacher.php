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
$username = $_POST['name'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = 'Please enter both username and password.';
    header('Location: login_process_teacher.php');
    exit();
}

// Prepare and execute the SQL query using a prepared statement
$sql = "SELECT name, password FROM sign_up WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        // Authentication successful
        $_SESSION['name'] = $row['name'];
        header('Location: homet.html'); // Redirect to a protected page
        exit();
    } else {
        // Authentication failed
        $_SESSION['login_error'] = 'Invalid username or password';
        header('Location: login_process_teacher.php');
        exit();
    }
} else {
    // User not found
    $_SESSION['login_error'] = 'Invalid username or password';
    header('Location: login_process_teacher.php');
    exit();
}

$stmt->close();
$conn->close();
?>
