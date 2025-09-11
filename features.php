<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - Find Your Perfect Match</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
            background: linear-gradient(135deg, #ff6b6b 0%, #764ba2 100%);
        }

        /* Hero Section */
        .hero {
            padding: 120px 0 80px;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,112C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin: 1rem 0rem;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 1s ease 0.2s forwards;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 1s ease 0.4s forwards;
        }

        /* Features Grid */
        .features-section {
            padding: 80px 0;
            background: white;
            position: relative;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(50px);
        }

        .feature-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon i {
            transform: scale(1.1) rotate(5deg);
        }
        .feature-card h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }

        .feature-card p {
            color: #666;
            text-align: center;
            line-height: 1.6;
        }

        /* Statistics Section */
        .stats-section {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
            color: white;
            padding: 80px 0;
            position: relative;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-card {
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            counter-reset: num var(--num);
        }

        .stat-number::after {
            content: counter(num);
            animation: countUp 2s ease-out forwards;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* CTA Section */
        .cta-section {
            background: white;
            padding: 80px 0;
            text-align: center;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }
        .cta-content>h2{
            font-size: 2rem;
        }
        .cta-content>p{
            margin: 20px 0px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
            color: white;
            padding: 1rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        /* Animations */
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes countUp {
            from { --num: 0; }
            to { --num: var(--final); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .feature-card {
                padding: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

    
    </style>
</head>
<body>
    
    <!-- header section -->
     <?php include 'include/header.php'; ?>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Find Your Perfect Life Partner</h1>
                <p>Discover meaningful connections with our advanced matching system and comprehensive features designed for serious relationships</p>
            </div>
        </div>
    </section>

    <section class="features-section" id="features">
        <div class="container">
            <h2 class="section-title">Why Choose ShadiVivah?</h2>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-hand-sparkles"></i></div>
                    <h3>Smart Matching</h3>
                    <p>Our AI-powered algorithm analyzes compatibility based on values, interests, lifestyle, and relationship goals to find your ideal match.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-lock"></i></div>
                    <h3>Privacy & Security</h3>
                    <p>Your personal information is protected with bank-level security. Control who sees your profile and communicate safely.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-user-check"></i></div>
                    <h3>Verified Profiles</h3>
                    <p>Every profile goes through a thorough verification process including ID verification and background checks for your peace of mind.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-message"></i></div>
                    <h3>Secure Communication</h3>
                    <p>Chat, video call, and connect with potential matches through our secure messaging platform without sharing personal contact details.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-gem"></i></div>
                    <h3>Premium Preferences</h3>
                    <p>Set detailed preferences for education, profession, family background, lifestyle choices, and more to find exactly what you're looking for.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-people-roof"></i></div>
                    <h3>Family Involvement</h3>
                    <p>Involve your family in the process with family accounts, allowing parents and relatives to help in finding the perfect match.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-trophy"></i></div>
                    <h3>Success Stories</h3>
                    <p>Join thousands of couples who found love through our platform. Read real success stories and get inspired for your own journey.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-earth-asia"></i></div>
                    <h3>Global Community</h3>
                    <p>Connect with matches from around the world or within your local community based on your location preferences.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" style="--final: 50000">0</div>
                    <div class="stat-label">Active Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="--final: 1500">0</div>
                    <div class="stat-label">Success Stories</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="--final: 95">0</div>
                    <div class="stat-label">% Profile Verification</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="--final: 50">0</div>
                    <div class="stat-label">Countries</div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Find Your Soulmate?</h2>
                <p>Join millions of people who trust PerfectMatch to help them find meaningful relationships and lasting love.</p>
                <a href="signup.php" class="cta-button">Get Started Today</a>
            </div>
        </div>
    </section>

    <!-- footer -->
     <?php include'include/footer.php';?>

    <script>

        // Intersection Observer for feature cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Animated counter for statistics
        const animateCounters = () => {
            const counters = document.querySelectorAll('.stat-number');
            const speed = 2000; // 2 seconds

            counters.forEach(counter => {
                const target = parseInt(counter.style.getPropertyValue('--final'));
                const increment = target / speed;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment * 16; // 60fps
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.style.setProperty('--num', Math.floor(current));
                }, 16);
            });
        };

        // Start counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        statsObserver.observe(document.querySelector('.stats-section'));

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add some floating animation to feature icons
        document.querySelectorAll('.feature-icon').forEach(icon => {
            icon.style.animation = `float 3s ease-in-out infinite`;
            icon.style.animationDelay = Math.random() * 2 + 's';
        });

        // Add floating keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-10px) rotate(2deg); }
            }
        `;
        document.head.appendChild(style);

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        });
    </script>
</body>
</html>