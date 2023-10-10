<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $tname = $_POST['tname'];

    // Validate and sanitize input
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $subject = filter_var($subject, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $tname = filter_var($tname, FILTER_SANITIZE_STRING);

    // Connect to MySQL using prepared statement
    $conn = new mysqli('localhost', 'root', '', 'data');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch the teacher's email from the 'teachers' table using a prepared statement
    $teacherQuery = "SELECT email FROM form_teacher WHERE firstName = ?";
    $stmt = $conn->prepare($teacherQuery);
    $stmt->bind_param("s", $tname);
    $stmt->execute();
    $teacherResult = $stmt->get_result();

    if ($teacherResult && $teacherResult->num_rows > 0) {
        $teacherData = $teacherResult->fetch_assoc();
        $teacherEmail = $teacherData['email'];

        // Generate a dynamic Jitsi Meet link
        $jitsiMeetLink = generateJitsiMeetLink();

        // Insert student data into the 'students' table using a prepared statement
        $studentInsertQuery = "INSERT INTO students (name, subject, jisti_meet_link, email) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($studentInsertQuery);
        $stmt->bind_param("ssss", $name, $subject, $jitsiMeetLink, $email);
        if ($stmt->execute()) {
            // Send an email to the teacher (you'll need to configure SMTP settings)
            $subject = "New Student Request with Jitsi Meet Link";
            $message = "A new student request:\n\nName: $name\nSubject: $subject\nEmail: $email\nJisti Meet Link: $jitsiMeetLink";
            mail($teacherEmail, $subject, $message);

            echo json_encode(['success' => true]);
            print_r("error");
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Teacher not found for the subject']);
    }

    $conn->close();
}

function generateJitsiMeetLink() {
    $roomName = uniqid("student_meeting_");
    $jitsiMeetLink = "https://meet.jit.si/$roomName";

    return $jitsiMeetLink;
}
?>
