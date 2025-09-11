<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - MatrimonyConnect</title>
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

        /* FAQ Navigation */
        .faq-nav {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 40px;
        }

        .faq-nav h3 {
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

        /* FAQ Content */
        .faq-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 40px;
        }

        .faq-section {
            margin-bottom: 40px;
        }

        .faq-section:last-child {
            margin-bottom: 0;
        }

        .faq-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .faq-icon {
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

        .faq-header:hover .faq-icon {
            background: #ff6b6b;
            transform: scale(1.1);
        }

        .faq-icon i {
            font-size: 1.2rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .faq-header:hover .faq-icon i {
            color: white;
        }

        .faq-title {
            font-size: 1.5rem;
            color: #444;
            transition: all 0.3s ease;
        }

        .faq-header:hover .faq-title {
            color: #ff6b6b;
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
            background: #f9f9f9;
        }

        .faq-item.active .faq-question {
            background: rgba(255, 107, 107, 0.1);
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-item.active .faq-answer {
            padding: 20px;
            max-height: 500px;
        }

        .faq-answer p {
            margin-bottom: 15px;
            color: #555;
        }

        .faq-answer ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        .faq-answer li {
            margin-bottom: 8px;
            position: relative;
            color: #555;
        }

        .faq-answer li::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #ff6b6b;
            border-radius: 50%;
            position: absolute;
            left: -18px;
            top: 8px;
        }

        /* Search Section */
        .search-section {
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            padding: 60px 0;
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .search-box {
            position: relative;
            margin-bottom: 30px;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding-left: 50px;
        }

        .search-input:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .popular-searches {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .search-tag {
            padding: 8px 15px;
            background: #f5f5f5;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #555;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-tag:hover {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            transform: translateY(-3px);
        }

        /* Support Section */
        .support-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            text-align: center;
            margin-top: 50px;
        }

        .support-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .support-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }

        .support-icon i {
            font-size: 2rem;
            color: #ff6b6b;
        }

        .support-title {
            font-size: 1.5rem;
            color: #444;
            margin-bottom: 15px;
        }

        .support-text {
            color: #777;
            margin-bottom: 30px;
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
            
            .faq-nav {
                margin-bottom: 30px;
            }
            
            .nav-links {
                flex-direction: column;
            }
            
            .faq-content {
                padding: 30px 20px;
            }
            
            .faq-header {
                flex-direction: column;
                text-align: center;
            }
            
            .faq-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 480px) {
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .faq-title {
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
    <?php include("include/header.php"); ?>
    <!-- FAQ Section -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Find answers to common questions about our services</p>
            </div>
            
            <!-- FAQ Navigation -->
            <div class="faq-nav">
                <h3>Browse by Category</h3>
                <ul class="nav-links">
                    <li><a href="#account">Account & Profile</a></li>
                    <li><a href="#matching">Matching</a></li>
                    <li><a href="#subscription">Subscription</a></li>
                    <li><a href="#privacy">Privacy & Safety</a></li>
                    <li><a href="#technical">Technical Issues</a></li>
                </ul>
            </div>
            
            <!-- FAQ Content -->
            <div class="faq-content">
                <!-- Account & Profile -->
                <div class="faq-section" id="account">
                    <div class="faq-header">
                        <div class="faq-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h3 class="faq-title">Account & Profile</h3>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            How do I create an account on MatrimonyConnect?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Creating an account is simple! Click on the 'Sign Up' button on our homepage, fill in your basic details like name, email, and password. Verify your email address through the link we send you, and then complete your profile with more information about yourself.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            How can I edit my profile information?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>You can edit your profile at any time by logging into your account and clicking on the 'My Profile' section. From there, you can update your photos, personal information, preferences, and any other details you'd like to share.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            What should I include in my profile to get better matches?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>To get the best matches, we recommend:</p>
                            <ul>
                                <li>Adding clear, recent photos that show your face</li>
                                <li>Writing a genuine description of yourself and your interests</li>
                                <li>Being specific about what you're looking for in a partner</li>
                                <li>Completing all sections of your profile</li>
                                <li>Being honest about your background and preferences</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Matching -->
                <div class="faq-section" id="matching">
                    <div class="faq-header">
                        <div class="faq-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="faq-title">Matching Process</h3>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            How does the matching algorithm work?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Our matching algorithm considers multiple factors including your profile information, preferences, behavior on the platform, and compatibility indicators. The system learns from your interactions (who you view, like, or message) to refine future suggestions. The more active you are, the better our algorithm becomes at suggesting compatible matches.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            Can I search for matches based on specific criteria?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Yes! We offer advanced search filters that allow you to find matches based on specific criteria such as age, location, education, profession, religion, community, and more. You can save your search preferences for quicker access in the future.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            How do I express interest in someone?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>You can express interest in several ways:</p>
                            <ul>
                                <li>Click the 'Like' or 'Interest' button on someone's profile</li>
                                <li>Send a personalized message introducing yourself</li>
                                <li>Use our 'Connect Now' feature for instant messaging</li>
                                <li>Send a virtual gift to show special interest</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Subscription -->
                <div class="faq-section" id="subscription">
                    <div class="faq-header">
                        <div class="faq-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="faq-title">Subscription & Payments</h3>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            What are the benefits of a premium membership?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Our premium membership offers several benefits:</p>
                            <ul>
                                <li>Unlimited messaging with all members</li>
                                <li>Advanced search filters</li>
                                <li>Priority listing in search results</li>
                                <li>View who visited your profile</li>
                                <li>Access to premium matching algorithms</li>
                                <li>Ad-free experience</li>
                                <li>Dedicated customer support</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            How can I upgrade to a premium membership?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>To upgrade to premium, go to your account settings and select 'Membership Plans'. Choose the plan that best suits your needs, then proceed to payment. We accept credit/debit cards, PayPal, and other popular payment methods. Your premium features will be activated immediately after successful payment.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            Can I cancel my subscription anytime?
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, you can cancel your subscription at any time. If you cancel, you'll still have access to premium features until the end of your current billing period. We offer a refund within the first 7 days of subscription if you're not satisfied with our service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="section-title">
                <h2>Can't Find Your Answer?</h2>
                <p>Search our help center or browse popular topics</p>
            </div>
            
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search for questions or topics...">
                </div>
                
                <div class="popular-searches">
                    <span class="search-tag">Profile Verification</span>
                    <span class="search-tag">Message Limits</span>
                    <span class="search-tag">Payment Issues</span>
                    <span class="search-tag">Photo Guidelines</span>
                    <span class="search-tag">Account Deletion</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section>
        <div class="container">
            <div class="support-section">
                <div class="support-content">
                    <div class="support-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="support-title">Still Need Help?</h3>
                    <p class="support-text">Our customer support team is here to assist you with any questions or concerns you may have.</p>
                    <a href="#" class="btn">Contact Support</a>
                </div>
            </div>
        </div>
    </section>

    <?php include("include/footer.php"); ?>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('.nav-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            });
        });

        // FAQ accordion functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const searchTags = document.querySelectorAll('.search-tag');
        
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            
            if (searchTerm.length < 2) {
                // Show all items if search term is too short
                faqItems.forEach(item => {
                    item.style.display = 'block';
                });
                return;
            }
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    // Open matching items
                    item.classList.add('active');
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Search tags functionality
        searchTags.forEach(tag => {
            tag.addEventListener('click', () => {
                searchInput.value = tag.textContent;
                searchInput.dispatchEvent(new Event('keyup'));
                
                // Scroll to results
                document.querySelector('.faq-content').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animate elements on scroll
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.faq-section, .search-container, .support-section');
            
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
            const elements = document.querySelectorAll('.faq-section, .search-container, .support-section');
            elements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'all 0.6s ease';
            });
            
            window.addEventListener('scroll', animateOnScroll);
            // Trigger once on load
            animateOnScroll();
            
            // Open first FAQ item by default for better UX
            if (faqItems.length > 0) {
                faqItems[0].classList.add('active');
            }
        };
    </script>
</body>
</html>