<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Tips - MatrimonyConnect</title>
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

        /* Safety Tips */
        .safety-tips {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .tip-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tip-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .tip-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            transition: all 0.5s ease;
        }

        .tip-card:hover::before {
            height: 100%;
        }

        .tip-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .tip-icon {
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

        .tip-card:hover .tip-icon {
            background: #ff6b6b;
        }

        .tip-icon i {
            font-size: 1.2rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .tip-card:hover .tip-icon i {
            color: white;
        }

        .tip-title {
            font-size: 1.3rem;
            color: #444;
            transition: all 0.3s ease;
        }

        .tip-card:hover .tip-title {
            color: #ff6b6b;
        }

        .tip-content {
            color: #555;
        }

        .tip-content p {
            margin-bottom: 15px;
        }

        .tip-content ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        .tip-content li {
            margin-bottom: 8px;
            position: relative;
        }

        .tip-content li::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #ff6b6b;
            border-radius: 50%;
            position: absolute;
            left: -18px;
            top: 8px;
        }

        /* Emergency Section */
        .emergency-section {
            background: linear-gradient(135deg, #ff9a9e 0%, #ff6b6b 100%);
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }

        .emergency-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .emergency-title {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .emergency-text {
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .emergency-contacts {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .emergency-contact {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            min-width: 200px;
            transition: all 0.3s ease;
        }

        .emergency-contact:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        .contact-title {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .contact-info {
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Resources Section */
        .resources-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .resource-card {
            text-align: center;
            padding: 30px;
            background: #f9f9f9;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .resource-card:hover {
            background: rgba(255, 107, 107, 0.1);
            transform: translateY(-5px);
        }

        .resource-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }

        .resource-card:hover .resource-icon {
            background: #ff6b6b;
        }

        .resource-icon i {
            font-size: 1.5rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .resource-card:hover .resource-icon i {
            color: white;
        }

        .resource-title {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 15px;
        }

        .resource-desc {
            color: #777;
            margin-bottom: 20px;
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

            .safety-categories,
            .emergency-section,
            .resources-section {
                padding: 30px 20px;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .emergency-contacts {
                flex-direction: column;
                align-items: center;
            }

            .emergency-contact {
                width: 100%;
                max-width: 300px;
            }
        }

        @media (max-width: 480px) {
            .section-title h2 {
                font-size: 1.8rem;
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .safety-tips {
                grid-template-columns: 1fr;
            }

            .tip-header {
                flex-direction: column;
                text-align: center;
            }

            .tip-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .emergency-title {
                font-size: 1.5rem;
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

    <?php include("include/header.php"); ?>

    <!-- Safety Tips Section -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Safety Tips</h2>
                <p>Your safety is our priority. Follow these guidelines to ensure a secure experience.</p>
            </div>

           
            <!-- Safety Tips Content -->
            <div class="safety-tips">
                <!-- Online Safety Tips -->
                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="tip-title">Protect Your Personal Information</h3>
                    </div>
                    <div class="tip-content">
                        <p>Never share sensitive personal information too quickly:</p>
                        <ul>
                            <li>Keep financial information private</li>
                            <li>Avoid sharing your home address early on</li>
                            <li>Use our secure messaging system initially</li>
                            <li>Be cautious about sharing workplace details</li>
                        </ul>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="tip-title">Use Strong Passwords</h3>
                    </div>
                    <div class="tip-content">
                        <p>Secure your account with these password tips:</p>
                        <ul>
                            <li>Create a unique password for your account</li>
                            <li>Use a combination of letters, numbers, and symbols</li>
                            <li>Enable two-factor authentication if available</li>
                            <li>Never share your password with anyone</li>
                        </ul>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <i class="fas fa-user-secret"></i>
                        </div>
                        <h3 class="tip-title">Stay on the Platform</h3>
                    </div>
                    <div class="tip-content">
                        <p>Keep communications on our platform initially:</p>
                        <ul>
                            <li>Use our messaging system for initial conversations</li>
                            <li>Avoid moving to personal email too quickly</li>
                            <li>Be cautious of requests for financial help</li>
                            <li>Report suspicious behavior immediately</li>
                        </ul>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3 class="tip-title">Video Chat First</h3>
                    </div>
                    <div class="tip-content">
                        <p>Consider video chatting before meeting in person:</p>
                        <ul>
                            <li>Verify the person matches their profile pictures</li>
                            <li>Notice any inconsistencies in their stories</li>
                            <li>Trust your instincts if something feels off</li>
                            <li>Use our secure video chat feature when available</li>
                        </ul>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="tip-title">Choose Public Meeting Places</h3>
                    </div>
                    <div class="tip-content">
                        <p>When meeting for the first time:</p>
                        <ul>
                            <li>Select a public location with other people around</li>
                            <li>Avoid secluded places or private residences</li>
                            <li>Tell a friend or family member about your plans</li>
                            <li>Arrange your own transportation to and from the meeting</li>
                        </ul>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-header">
                        <div class="tip-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="tip-title">Keep Phone Handy</h3>
                    </div>
                    <div class="tip-content">
                        <p>Ensure you can reach help if needed:</p>
                        <ul>
                            <li>Keep your phone charged and with you</li>
                            <li>Have a trusted friend on standby for check-ins</li>
                            <li>Save local emergency numbers in your phone</li>
                            <li>Consider using safety apps that share your location</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Emergency Section -->
            <div class="emergency-section">
                <div class="emergency-content">
                    <h3 class="emergency-title">Emergency Assistance</h3>
                    <p class="emergency-text">If you feel unsafe or encounter suspicious behavior, contact us
                        immediately or use these emergency resources:</p>

                    <div class="emergency-contacts">
                        <div class="emergency-contact">
                            <div class="contact-title">MatrimonyConnect Safety Line</div>
                            <div class="contact-info">1-800-SAFE-MATCH</div>
                        </div>
                        <div class="emergency-contact">
                            <div class="contact-title">Local Emergency</div>
                            <div class="contact-info">112</div>
                        </div>
                        <div class="emergency-contact">
                            <div class="contact-title">Report an Issue</div>
                            <div class="contact-info">safety@shadivivah.com</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Section -->
            <div class="resources-section">
                <div class="section-title">
                    <h2>Additional Resources</h2>
                    <p>Learn more about staying safe in online dating</p>
                </div>

                <div class="resources-grid">
                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4 class="resource-title">Safety Guide</h4>
                        <p class="resource-desc">Download our comprehensive safety guide for online dating</p>
                        <a href="#" class="btn">Download</a>
                    </div>

                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <h4 class="resource-title">FAQ</h4>
                        <p class="resource-desc">Find answers to common safety questions and concerns</p>
                        <a href="#" class="btn">Read More</a>
                    </div>

                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 class="resource-title">Support</h4>
                        <p class="resource-desc">Contact our safety team for personalized assistance</p>
                        <a href="#" class="btn">Get Help</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("include/footer.php"); ?>

    <script>
        

        // Animate elements on scroll
        const animateOnScroll = function () {
            const elements = document.querySelectorAll('.tip-card, .emergency-contact, .resource-card');

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
            const elements = document.querySelectorAll('.tip-card, .emergency-contact, .resource-card');
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