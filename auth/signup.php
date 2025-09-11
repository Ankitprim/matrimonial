<?php
include('../config/database.php');
$obj = new query();
$err = "";
if (isset($_POST['submit']) && isset($_POST['fullname']) & isset($_POST['email']) & isset($_POST['password'])) {

    if ($_POST['password'] !== $_POST['confirm-password']) {
        $err = "Password and Confirm Password do not match.";

    } else {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];

        $obj->insertData('users', [
            'full_name' => $fullname,
            'email' => $email,
            'password' => $hash_password,
            'gender' => $gender,
            'dob' => $dob
        ]);

        // get data for next step
        $conditionArr = ['email' => $email];
        $stmt = $obj->getData('users', '*', $conditionArr);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $found = false;
        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['full_name'];
                header('Location: profile.php');
                exit();
            }
        }

    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - MatrimonyConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/create_form.css">
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Account Creation Section -->
    <section class="account-creation">
        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h2>Create Your Account</h2>
                    <p>Join thousands of couples who found their soulmates</p>
                    <p style="color:red;"><?php echo $err; ?></p>
                </div>

                <form id="signup-form" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" id="fullname" name="fullname" placeholder="Enter your full name"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Create a strong password"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password"
                                placeholder="Confirm your password" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" required>
                        </div>

                    </div>


                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy
                                Policy</a></label>
                    </div>


                    <div class="form-footer">
                        <button type="submit" name="submit" class="btn">Next</button>
                        <p>Already have an account? <a href="login.php">Log In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->

</body>

</html>