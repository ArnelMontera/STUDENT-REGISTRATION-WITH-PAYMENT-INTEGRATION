<?php 
session_start();

// Check if session data exists (to ensure they arrived from the registration process)
if (!isset($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email'], $_SESSION['payment'])) {
    header("Location: register.php"); // Redirect back to registration if session is missing
    exit;
}

// Store session data
$student = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
$email = $_SESSION['email'];
$mobile = $_SESSION['mobile'];
$dob = $_SESSION['dob'];
$course = $_SESSION['course'];
$subject = $_SESSION['subject'];
$paymentAmount = $_SESSION['payment']; // Store payment amount

// PayPal Client ID
$clientID = "ARhplW_s6eUJFj3d5MCcGTn7sDiH02vjhNAcoxwnVZc2LjQhF0EvyRJL66M0-vBPmOogKTIpe6MKr-7y";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review and Pay</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Review Your Registration</h1>
        <p>Please review the details below before proceeding to payment.</p>

        <table>
            <tr>
                <th>Full Name:</th>
                <td><?php echo htmlspecialchars($student); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
                <th>Mobile:</th>
                <td><?php echo htmlspecialchars($mobile); ?></td>
            </tr>
            <tr>
                <th>Date of Birth:</th>
                <td><?php echo htmlspecialchars($dob); ?></td>
            </tr>
            <tr>
                <th>Course:</th>
                <td><?php echo htmlspecialchars($course); ?></td>
            </tr>
            <tr>
                <th>Subject:</th>
                <td><?php echo htmlspecialchars($subject); ?></td>
            </tr>
            <tr>
                <th>Payment Amount:</th>
                <td><strong>$<?php echo htmlspecialchars($paymentAmount); ?></strong></td>
            </tr>
        </table>

        <p>If everything looks good, you can proceed to payment.</p>

        <!-- PayPal Button (Using PayPal Client ID) -->
        <div id="paypal-button-container"></div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo $clientID; ?>&currency=USD"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $paymentAmount; ?>' // Dynamically set the amount
                        },
                        description: 'Course Payment for <?php echo $student; ?>'
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Payment successful. Thank you!');
                    window.location.href = "thank_you.php"; // Redirect to a thank you page after successful payment
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
