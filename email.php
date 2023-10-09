<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = $_POST["student_name"];
    $subject_or_topic = $_POST["subject_or_topic"];
    $email = $_POST["email"];

    // Email addresses for the teacher and admin
    $teacher_email = "teacher@example.com";
    $admin_email = "admin@example.com";

    // Email subject and message
    $subject = "New Student Submission";
    $message = "Student Name: $student_name\n";
    $message .= "Subject or Topic: $subject_or_topic\n";
    $message .= "Student Email: $email\n";

    // Send email to the teacher
    mail($teacher_email, $subject, $message);

    // Send email to the admin
    mail($admin_email, $subject, $message);

    // Redirect to a thank-you page
    header("Location: thank_you.php");
    exit;
}
?>
