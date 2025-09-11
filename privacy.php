<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - MatrimonyConnect</title>
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

        /* Policy Navigation */
        .policy-nav {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 40px;
            position: sticky;
            top: 30px;
            z-index: 100;
        }

        .policy-nav h3 {
            color: #ff6b6b;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .nav-links {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .nav-links li a {
            display: block;
            padding: 10px 20px;
            background: #f5f5f5;
            border-radius: 30px;
            color: #555;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-links li a:hover {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        /* Policy Content */
        .policy-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        .policy-section {
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 1px solid #f0f0f0;
        }

        .policy-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .policy-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            cursor: pointer;
        }

        .policy-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            transition: all 0.3s ease;
        }

        .policy-header:hover .policy-icon {
            background: #ff6b6b;
            transform: scale(1.1);
        }

        .policy-icon i {
            font-size: 1.2rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .policy-header:hover .policy-icon i {
            color: white;
        }

        .policy-title {
            font-size: 1.5rem;
            color: #444;
            transition: all 0.3s ease;
        }

        .policy-header:hover .policy-title {
            color: #ff6b6b;
        }

        .policy-text {
            color: #555;
            margin-left: 70px;
        }

        .policy-text p {
            margin-bottom: 15px;
        }

        .policy-text ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        .policy-text li {
            margin-bottom: 8px;
            position: relative;
        }

        .policy-text li::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #ff6b6b;
            border-radius: 50%;
            position: absolute;
            left: -18px;
            top: 8px;
        }

        .highlight {
            background: rgba(255, 107, 107, 0.1);
            border-left: 4px solid #ff6b6b;
            padding: 20px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
        }

        /* Consent Section */
        .consent-section {
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            padding: 60px 0;
        }

        .consent-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .consent-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .consent-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .consent-icon {
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

        .consent-card:hover .consent-icon {
            background: #ff6b6b;
        }

        .consent-icon i {
            font-size: 1.5rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .consent-card:hover .consent-icon i {
            color: white;
        }

        .consent-card h4 {
            color: #444;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .consent-card p {
            color: #777;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .section-title h2 {
                font-size: 2.2rem;
            }
            
            .policy-text {
                margin-left: 0;
                margin-top: 20px;
            }
        }

        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }
            
            .policy-nav {
                position: static;
                margin-bottom: 30px;
            }
            
            .nav-links {
                flex-direction: column;
            }
            
            .policy-content {
                padding: 30px 20px;
            }
            
            .policy-header {
                flex-direction: column;
                text-align: center;
            }
            
            .policy-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .consent-options {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .policy-title {
                font-size: 1.3rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <?php include'include/header.php'; ?>
    <!-- Privacy Policy Section -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Privacy Policy</h2>
                <p>Your privacy is important to us. Learn how we protect your information.</p>
            </div>
            
            <!-- Policy Navigation -->
            <div class="policy-nav">
                <h3>Jump to Section</h3>
                <ul class="nav-links">
                    <li><a href="#info-collection">Information Collection</a></li>
                    <li><a href="#data-usage">Data Usage</a></li>
                    <li><a href="#data-protection">Data Protection</a></li>
                    <li><a href="#cookies">Cookies</a></li>
                    <li><a href="#user-rights">Your Rights</a></li>
                    <li><a href="#policy-updates">Policy Updates</a></li>
                </ul>
            </div>
            
            <!-- Policy Content -->
            <div class="policy-content">
                <!-- Information Collection -->
                <div class="policy-section" id="info-collection">
                    <div class="policy-header">
                        <div class="policy-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="policy-title">Information We Collect</h3>
                    </div>
                    <div class="policy-text">
                        <p>We collect information that you provide directly to us when using our services, including:</p>
                        <ul>
                            <li>Personal identification information (name, email address, phone number)</li>
                            <li>Profile information (photos, personal descriptions, preferences)</li>
                            <li>Demographic information (age, gender, location)</li>
                            <li>Communication content (messages, interactions with other users)</li>
                            <li>Technical information (IP address, browser type, device information)</li>
                        </ul>
                        <div class="highlight">
                            <p>We only collect information that is necessary for providing and improving our services to help you find meaningful connections.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Data Usage -->
                <div class="policy-section" id="data-usage">
                    <div class="policy-header">
                        <div class="policy-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="policy-title">How We Use Your Information</h3>
                    </div>
                    <div class="policy-text">
                        <p>We use the information we collect for various purposes, including:</p>
                        <ul>
                            <li>Creating and maintaining your account</li>
                            <li>Providing personalized matchmaking services</li>
                            <li>Facilitating communication between users</li>
                            <li>Improving our services and user experience</li>
                            <li>Ensuring platform security and preventing fraud</li>
                            <li>Sending important updates and notifications</li>
                            <li>Conducting research and analysis to enhance our services</li>
                        </ul>
                        <p>We never sell your personal information to third parties for marketing purposes.</p>
                    </div>
                </div>
                
                <!-- Data Protection -->
                <div class="policy-section" id="data-protection">
                    <div class="policy-header">
                        <div class="policy-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="policy-title">Data Protection & Security</h3>
                    </div>
                    <div class="policy-text">
                        <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                        <ul>
                            <li>Encryption of sensitive data</li>
                            <li>Regular security assessments and testing</li>
                            <li>Access controls to limit who can view and use your information</li>
                            <li>Secure server infrastructure with regular updates</li>
                            <li>Employee training on data protection practices</li>
                        </ul>
                        <div class="highlight">
                            <p>While we implement robust security measures, no method of transmission over the Internet or electronic storage is 100% secure. We continuously work to enhance our security practices to protect your information.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Cookies -->
                <div class="policy-section" id="cookies">
                    <div class="policy-header">
                        <div class="policy-icon">
                            <i class="fas fa-cookie-bite"></i>
                        </div>
                        <h3 class="policy-title">Cookies & Tracking Technologies</h3>
                    </div>
                    <div class="policy-text">
                        <p>We use cookies and similar tracking technologies to track activity on our service and hold certain information. Cookies are files with a small amount of data that may include an anonymous unique identifier.</p>
                        <p>We use cookies for:</p>
                        <ul>
                            <li>Authentication and security purposes</li>
                            <li>Remembering your preferences and settings</li>
                            <li>Analyzing site traffic and usage patterns</li>
                            <li>Providing personalized content and recommendations</li>
                        </ul>
                        <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our service.</p>
                    </div>
                </div>
                
                <!-- User Rights -->
                <div class="policy-section" id="user-rights">
                    <div class="policy-header">
                        <div class="policy-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3 class="policy-title">Your Privacy Rights</h3>
                    </div>
                    <div class="policy-text">
                        <p>Depending on your location, you may have the following rights regarding your personal information:</p>
                        <ul>
                            <li><strong>Access:</strong> You can request copies of your personal information.</li>
                            <li><strong>Rectification:</strong> You can request that we correct any information you believe is inaccurate.</li>
                            <li><strong>Erasure:</strong> You can request that we erase your personal information under certain conditions.</li>
                            <li><strong>Restriction:</strong> You can request that we restrict the processing of your personal information.</li>
                            <li><strong>Data Portability:</strong> You can request that we transfer the data we have collected to another organization.</li>
                            <li><strong>Objection:</strong> You can object to our processing of your personal information.</li>
                        </ul>
                        <p>To exercise any of these rights, please contact us using the contact information provided in your account settings.</p>
                    </div>
                </div>
                
                <!-- Policy Updates -->
                <div class="policy-section" id="policy-updates">
                    <div class="policy-header">
                        <div class="policy-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h3 class="policy-title">Policy Updates</h3>
                    </div>
                    <div class="policy-text">
                        <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date at the bottom of this policy.</p>
                        <p>We will also notify you via email and/or a prominent notice on our service prior to the change becoming effective, when required by law.</p>
                        <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
                        <div class="highlight">
                            <p>This policy was last updated on June 15, 2023. We encourage you to periodically review this page for the latest information on our privacy practices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Consent Section -->
    <section class="consent-section">
        <div class="container">
            <div class="section-title">
                <h2>Your Privacy Choices</h2>
                <p>We provide you with choices regarding the personal information you provide to us</p>
            </div>
            
            <div class="consent-options">
                <div class="consent-card">
                    <div class="consent-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h4>Update Your Information</h4>
                    <p>Review and update your personal information at any time through your account settings.</p>
                    <a href="#" class="btn">Manage Profile</a>
                </div>
                
                <div class="consent-card">
                    <div class="consent-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Communication Preferences</h4>
                    <p>Control how we communicate with you and what types of messages you receive.</p>
                    <a href="#" class="btn">Notification Settings</a>
                </div>
                
                <div class="consent-card">
                    <div class="consent-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4>Visibility Settings</h4>
                    <p>Control who can see your profile and personal information on our platform.</p>
                    <a href="#" class="btn">Privacy Settings</a>
                </div>
            </div>
        </div>
    </section>
<!-- footer -->
<?php include 'include/footer.php'; ?>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('.nav-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                window.scrollTo({
                    top: targetElement.offsetTop - 200,
                    behavior: 'smooth'
                });
            });
        });

        // Policy section accordion functionality
        const policyHeaders = document.querySelectorAll('.policy-header');
        
        policyHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const policyText = header.nextElementSibling;
                
                // Toggle the active class
                if (policyText.style.maxHeight) {
                    policyText.style.maxHeight = null;
                    policyText.style.marginTop = null;
                } else {
                    policyText.style.maxHeight = policyText.scrollHeight + 'px';
                    policyText.style.marginTop = '20px';
                }
            });
        });

        // Animate elements on scroll
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.policy-section, .consent-card');
            
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
        window.onload = function() {
            const elements = document.querySelectorAll('.policy-section, .consent-card');
            elements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'all 0.6s ease';
            });
            
            // Initialize policy text heights
            const policyTexts = document.querySelectorAll('.policy-text');
            policyTexts.forEach(text => {
                text.style.maxHeight = text.scrollHeight + 'px';
                text.style.overflow = 'hidden';
                text.style.transition = 'max-height 0.3s ease, margin-top 0.3s ease';
            });
            
            window.addEventListener('scroll', animateOnScroll);
            // Trigger once on load
            animateOnScroll();
        };
    </script>
</body>
</html>