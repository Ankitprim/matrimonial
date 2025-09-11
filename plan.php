<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Plans - MatrimonyConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
       
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

       
        /* Membership Plans Section */
        .membership-plans {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
        }

        .plans-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .plan-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px 30px;
            width: 100%;
            max-width: 350px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .plan-card.featured {
            transform: scale(1.05);
            border: 2px solid #ff6b6b;
            z-index: 1;
        }

        .plan-card.featured::before {
            content: 'Most Popular';
            position: absolute;
            top: 15px;
            right: -30px;
            background: #ff6b6b;
            color: white;
            padding: 5px 30px;
            font-size: 0.8rem;
            font-weight: 600;
            transform: rotate(45deg);
        }

        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .plan-card.featured:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .plan-icon {
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

        .plan-card:hover .plan-icon {
            background: #ff6b6b;
            color: white;
        }

        .plan-icon i {
            font-size: 2rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .plan-card:hover .plan-icon i {
            color: white;
        }

        .plan-name {
            font-size: 1.5rem;
            color: #444;
            margin-bottom: 15px;
        }

        .plan-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ff6b6b;
            margin-bottom: 20px;
        }

        .plan-duration {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 30px;
        }

        .plan-features {
            list-style: none;
            margin-bottom: 30px;
            text-align: left;
        }

        .plan-features li {
            margin-bottom: 12px;
            padding-left: 25px;
            position: relative;
        }

        .plan-features li::before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #ff6b6b;
            position: absolute;
            left: 0;
        }

        .plan-features li.disabled {
            color: #999;
        }

        .plan-features li.disabled::before {
            content: '\f00d';
            color: #999;
        }

        /* FAQ Section */
        .faq-section {
            background: white;
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
        }

        .faq-question {
            background: #f9f9f9;
            padding: 20px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: #f0f0f0;
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
            
            .plan-card.featured {
                transform: scale(1);
                order: -1;
            }
            
            .plan-card.featured:hover {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }
            
            .plan-price {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .plan-card {
                padding: 30px 20px;
            }
            
            .plan-name {
                font-size: 1.3rem;
            }
            
            .plan-price {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
        <?php include'include/header.php'; ?>

    <!-- Membership Plans Section -->
    <section class="membership-plans">
        <div class="container">
            <div class="section-title">
                <h2>Choose Your Membership Plan</h2>
                <p>Select the plan that best suits your needs to find your perfect match</p>
            </div>
            
            <div class="plans-container">
                <div class="plan-card">
                    <div class="plan-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="plan-name">Basic</h3>
                    <div class="plan-price">₹99</div>
                    <div class="plan-duration">per month</div>
                    
                    <ul class="plan-features">
                        <li>Create your profile</li>
                        <li>Browse limited profiles</li>
                        <li>Send 5 interests per day</li>
                        <li>Basic match suggestions</li>
                        <li class="disabled">View contact details</li>
                        <li class="disabled">Priority customer support</li>
                        <li class="disabled">Advanced search filters</li>
                    </ul>
                    
                    <a href="#" class="btn">Get Started</a>
                </div>
                
                <div class="plan-card featured">
                    <div class="plan-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="plan-name">Premium</h3>
                    <div class="plan-price">₹199</div>
                    <div class="plan-duration">per month</div>
                    
                    <ul class="plan-features">
                        <li>Create your profile</li>
                        <li>Browse unlimited profiles</li>
                        <li>Send unlimited interests</li>
                        <li>Advanced match suggestions</li>
                        <li>View contact details</li>
                        <li>Priority customer support</li>
                        <li>Advanced search filters</li>
                    </ul>
                    
                    <a href="#" class="btn">Get Started</a>
                </div>
                
                <div class="plan-card">
                    <div class="plan-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3 class="plan-name">Elite</h3>
                    <div class="plan-price">₹299</div>
                    <div class="plan-duration">per month</div>
                    
                    <ul class="plan-features">
                        <li>All Premium features</li>
                        <li>Profile highlighting</li>
                        <li>Featured in search results</li>
                        <li>Dedicated relationship manager</li>
                        <li>Verified profile badge</li>
                        <li>Exclusive events access</li>
                        <li>Personalized matchmaking</li>
                    </ul>
                    
                    <a href="#" class="btn">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Find answers to common questions about our membership plans</p>
            </div>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        What payment methods do you accept?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        We accept all major credit cards, debit cards, PayPal, and bank transfers. All payments are processed securely through our encrypted payment gateway.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Can I change my plan later?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes, you can upgrade your plan at any time. When upgrading, you'll only pay the prorated difference for the remainder of your billing cycle. Downgrades will take effect at the start of your next billing cycle.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        Is there a cancellation fee?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        No, there are no cancellation fees. You can cancel your subscription at any time, and you'll continue to have access to your plan benefits until the end of your current billing period.
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        How do I get help if I have issues?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Premium and Elite members have access to priority customer support via phone, email, and live chat. Basic members can contact our support team via email, and we typically respond within 24 hours.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
   <?php include'include/footer.php'; ?>

    <script>
      
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

        // Animate plan cards on scroll
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.plan-card');
            
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
            const elements = document.querySelectorAll('.plan-card');
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