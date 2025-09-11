<?php

define("APPURL", "http://localhost/metromonial");
$user_id = 0;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];

}
?>


<head>
    <link rel="stylesheet" href="<?php echo APPURL; ?>/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<header id="header">
    <div class="container header-container">
        <a href="index.php" class="logo">Shadi<i class="fa-chisel fa-regular fa-heart"></i></i>vivah</a>

        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>

        <ul class="nav-menu" id="nav-menu">
            <li><a href="<?php echo APPURL; ?>">Home</a></li>
            <li><a href="<?php echo APPURL; ?>/contact.php">Contact</a></li>
            <li><a href="<?php echo APPURL; ?>/stories.php">Success Stories</a></li>
            <?php if($user_id > 0): ?>
            <li><a href="<?php echo APPURL; ?>/search.php">Search</a></li>
            <li><a href="<?php echo APPURL; ?>/userboard.php">Dashboard</a></li>
                
            <?php else:  ?>
            <li><a href="<?php echo APPURL; ?>/features.php">Features</a></li>
            <li><a href="<?php echo APPURL; ?>/plan.php">Membership</a></li>
            <?php endif;?>
        </ul>

        <div class="auth-buttons">
            <?php if($user_id > 0): ?>
            <a href="auth/logout.php">Log Out</a>
            <?php else: ?>
            <a href="auth/login.php">Log In</a>
            <a href="auth/signup.php">Sign Up</a>
            <?php endif;?>
        </div>
    </div>
</header>


<script>
    // Header scroll effect
    window.addEventListener('scroll', function () {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    hamburger.addEventListener('click', function () {
        navMenu.classList.toggle('active');
        hamburger.innerHTML = navMenu.classList.contains('active') ?
            '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            hamburger.innerHTML = '<i class="fas fa-bars"></i>';
        });
    });

</script>