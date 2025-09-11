<?php
include '../config/database.php';
$err = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = new query();
    $conditionArr = ['email' => $email];
    $stmt = $query->getData('users', '*', $conditionArr);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $found = false;
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['full_name'];
            header('Location: ../userboard.php');
            exit();
        }
    }

    if (!$found) {
        // echo "<script>alert('Invalid email or password');</script>";
        $err = "Invalid email or password.";
    }


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MatrimonyConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/main.css">

    <style>
        /* Login Section */
        .login-section {
            padding: 120px 0 80px;
            flex: 1;
            display: flex;
            align-items: center;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 2.2rem;
            color: #ff6b6b;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #777;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .login-icon i {
            font-size: 2rem;
            color: #ff6b6b;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-password {
            color: #ff6b6b;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .divider span {
            padding: 0 15px;
            color: #777;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #ddd;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-btn.facebook {
            color: #3b5998;
        }

        .social-btn.google {
            color: #dd4b39;
        }

        .social-btn.linkedin {
            color: #0077b5;
        }

        .signup-link {
            margin-top: 20px;
            color: #777;
        }

        .signup-link a {
            color: #ff6b6b;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 1.8rem;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .login-header h2 {
                font-size: 1.6rem;
            }

            .login-icon {
                width: 70px;
                height: 70px;
            }

            .login-icon i {
                font-size: 1.7rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fa-solid fa-lock fa-bounce"></i>
                    </div>
                    <h2>Welcome Back</h2>
                    <p>Sign in to continue your journey to find your perfect match</p>
                </div>
                <p style="color:red;"><?php echo $err; ?></p>
                <form id="login-form" method="post">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" name="submit" class="btn">Log In</button>

                    <!-- <div class="divider">
                        <span>Or continue with</span>
                    </div>

                    <div class="social-login">
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-btn linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> -->

                    <div class="signup-link">
                        Don't have an account? <a href="signup.php">Create now</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


</body>

</html>