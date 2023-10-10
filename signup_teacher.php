<?php
$Servername = "localhost";
$Username = "root";
$Password = "";
$db = "data";
$conn = mysqli_connect($Servername, $Username, $Password, $db); // Establish database connection


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$Sql = "INSERT INTO sign_up (name, email, password, confirm_password) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $Sql);

mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $confirm_password);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    header('Location:teacher_application.html');

} 
else {
    die("value inserting field " .mysqli_error($conn));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>


