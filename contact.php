
<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - MatrimonyConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            color: #333;
            line-height: 1.6;
            background-color: #f9f9f9;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #ff6b6b;
            color: #ff6b6b;
        }

        .btn-outline:hover {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
        }

        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: #444;
        }

        .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 4px;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            border-radius: 2px;
        }

        /* Contact Section */
        .contact-section {
            padding: 100px 0;
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .contact-info {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            height: fit-content;
        }

        .contact-info h3 {
            color: #ff6b6b;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        .contact-details {
            list-style: none;
        }

        .contact-details li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .contact-details li:hover .contact-icon {
            background: #ff6b6b;
            transform: scale(1.1);
        }

        .contact-icon i {
            font-size: 1.2rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .contact-details li:hover .contact-icon i {
            color: white;
        }

        .contact-text h4 {
            color: #444;
            margin-bottom: 5px;
        }

        .contact-text p {
            color: #777;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: #f5f5f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #ff6b6b;
            transform: translateY(-5px);
        }

        .social-links a i {
            color: #555;
            transition: all 0.3s ease;
        }

        .social-links a:hover i {
            color: white;
        }

        /* Contact Form */
        .contact-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        .contact-form h3 {
            color: #ff6b6b;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-footer {
            text-align: center;
            margin-top: 30px;
        }

        /* FAQ Section */
        .faq-section {
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            background: white;
            padding: 20px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: rgba(255, 107, 107, 0.05);
        }

        .faq-question i {
            transition: all 0.3s ease;
        }

        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item.active .faq-question {
            background: rgba(255, 107, 107, 0.1);
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-item.active .faq-answer {
            padding: 20px;
            max-height: 300px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .section-title h2 {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .contact-container {
                grid-template-columns: 1fr;
            }

            .contact-info,
            .contact-form {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .section-title h2 {
                font-size: 1.8rem;
            }

            .contact-details li {
                flex-direction: column;
                text-align: center;
            }

            .contact-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .social-links {
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- header -->
    <?php include('include/header.php'); ?>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Get In Touch</h2>
                <p>We'd love to hear from you. Here's how you can reach us.</p>
            </div>

            <div class="contact-container">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <ul class="contact-details">
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Our Location</h4>
                                <p>123 Matrimony Plaza, Relationship Road<br>Ghazipur   , Uttar Pradesh 400001</p>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Phone Number</h4>
                                <p>+91 98765 43210<br>+91 91234 56789</p>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Email Address</h4>
                                <p>info@shadivivah.com<br>support@shadivivah.com</p>
                            </div>
                        </li>
                    </ul>

                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="What is this regarding?">
                        </div>

                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" placeholder="How can we help you?"
                                required></textarea>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Quick answers to common questions about our services</p>
            </div>

            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        How do I create a profile on MatrimonyConnect?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Creating a profile is simple! Click on the 'Sign Up' button, fill in your basic details,
                            verify your email address, and then complete your profile with more information about
                            yourself, your preferences, and what you're looking for in a partner.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        How can I ensure my privacy and safety?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We take privacy and safety seriously. You can control what information is visible on your
                            profile, who can contact you, and we have a dedicated team that monitors for suspicious
                            activity. Always avoid sharing personal contact information until you're comfortable.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        What should I do if I encounter inappropriate behavior?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>If you encounter any inappropriate behavior, please use the 'Report' button on the user's
                            profile or message immediately. Our team will review the report and take appropriate action,
                            which may include warning or removing the user from our platform.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        How does the matching algorithm work?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Our matching algorithm considers your preferences, interests, background, and behavior on the
                            platform to suggest compatible matches. The more complete your profile and the more you
                            interact with the platform, the better our suggestions become.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php include('include/footer.php'); ?>

    <script>
        // Form validation
        const contactForm = document.getElementById('contactForm');
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');

            // Simple validation
            if (!name.value || !email.value || !message.value) {
                alert('Please fill in all required fields');
                return;
            }

            // In a real application, you would submit the form data to a server here
            alert('Thank you for your message! We will get back to you soon.');
            contactForm.reset();
        });

        // FAQ accordion functionality
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', () => {
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');
            });
        });

        // Animate elements on scroll
        const animateOnScroll = function () {
            const elements = document.querySelectorAll('.contact-info, .contact-form, .faq-item, .map-container');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;

                if (elementPosition < screenPosition) {
                    element.style.opacity = 1;
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Initialize elements for animation
        window.onload = function () {
            const elements = document.querySelectorAll('.contact-info, .contact-form, .faq-item');
            elements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'all 0.6s ease';
            });

            window.addEventListener('scroll', animateOnScroll);
            // Trigger once on load
            animateOnScroll();
        };
    </script>
</body>

</html>