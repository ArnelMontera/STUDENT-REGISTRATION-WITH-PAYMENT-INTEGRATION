<?php
session_start(); // Start session to pass data to the next page

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srf";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $dob = trim($_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']);
    $gender = trim($_POST['gender'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $pin = trim($_POST['pin'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $course = trim($_POST['selectedCourse'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $payment = (int)trim($_POST['payment'] ?? 0);

    // Validate the input fields
    if (!$firstName) $errors[] = "First name is required.";
    if (!$lastName) $errors[] = "Last name is required.";
    if (!$email) $errors[] = "Email is required.";
    if (!$mobile) $errors[] = "Mobile number is required.";
    if (!$dob) $errors[] = "Date of birth is required.";

    // If there are no errors, proceed with inserting into the database
    if (empty($errors)) {
        // Prepare the SQL query to insert the data into the database
        $stmt = $conn->prepare("INSERT INTO students 
            (first_name, last_name, dob, email, mobile, gender, address, city, pin, state, course, subject, payment) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssssssi", $firstName, $lastName, $dob, $email, $mobile, $gender, $address, $city, $pin, $state, $course, $subject, $payment);

        // Execute the statement
        if ($stmt->execute()) {
            // Store the user info in session for payment page
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['mobile'] = $mobile;
            $_SESSION['dob'] = $dob;
            $_SESSION['course'] = $course;
            $_SESSION['subject'] = $subject;
            $_SESSION['payment'] = $payment;

            // Redirect to the payment page after successful registration
            header("Location: payment.php");
            exit;
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        // Display all errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

$conn->close();
?>
