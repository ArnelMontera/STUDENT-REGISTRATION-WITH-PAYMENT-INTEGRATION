<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>STUDENT REGISTRATION FORM</h1>
        <form id="registrationForm" action="register.php" method="POST"> <!-- action points to register.php -->
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <select name="day" required>
                    <option value="">Day</option>
                    <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
                </select>
                <select name="month" required>
                    <option value="">Month</option>
                    <?php for ($i = 1; $i <= 12; $i++) echo "<option value='" . str_pad($i, 2, '0', STR_PAD_LEFT) . "'>$i</option>"; ?>
                </select>
                <select name="year" required>
                    <option value="">Year</option>
                    <?php for ($i = date("Y"); $i >= 1900; $i--) echo "<option value='$i'>$i</option>"; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" id="mobile" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <input type="radio" name="gender" value="male" id="male" required> <label for="male">Male</label>
                <input type="radio" name="gender" value="female" id="female"> <label for="female">Female</label>
                <input type="radio" name="gender" value="other" id="other"> <label for="other">Other</label>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" required></textarea>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" required>
            </div>

            <div class="form-group">
                <label for="pin">Pin Code</label>
                <input type="text" name="pin" id="pin" required>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" id="state" required>
            </div>

            <div class="form-group">
                <label for="selectedCourse">Course</label>
                <select name="selectedCourse" id="course" required>
                    <option value="">Select</option>
                    <option value="BSMA">BSMA</option>
                    <option value="BSA">BSA</option>
                    <option value="BSIS">BSIS</option>
                    <option value="BSIT">BSIT</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <select name="subject" id="subject" required>
                    <option value="">Select course first</option>
                </select>
            </div>

            <div class="form-group">
                <label for="payment">Payment</label>
                <input type="text" name="payment" id="payment" readonly>
            </div>

            <div class="buttons">
                <input type="submit" value="Submit">
                <input type="reset" value="Reset">
            </div>
        </form>
    </div>

    <script>
        const subjects = {
            BSMA: ["Math 101", "Statistics", "Accounting Basics"],
            BSA: ["Financial Accounting", "Auditing", "Taxation"],
            BSIS: ["Info Systems", "Database Management", "System Analysis"],
            BSIT: ["Programming 101", "Networking", "Web Development"]
        };

        const payments = {
            BSMA: 300,
            BSA: 400,
            BSIS: 500,
            BSIT: 600
        };

        const courseSelect = document.getElementById("course");
        const subjectSelect = document.getElementById("subject");
        const paymentInput = document.getElementById("payment");

        courseSelect.addEventListener("change", function () {
            const selectedCourse = this.value;

            // Update subject options
            subjectSelect.innerHTML = '<option value="">Select a subject</option>';
            if (subjects[selectedCourse]) {
                subjects[selectedCourse].forEach(subject => {
                    const opt = document.createElement("option");
                    opt.value = subject;
                    opt.textContent = subject;
                    subjectSelect.appendChild(opt);
                });
            }

            // Update payment
            paymentInput.value = payments[selectedCourse] ? payments[selectedCourse] : "";
        });
    </script>
</body>
</html>
