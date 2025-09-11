<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatrimonyConnect - Find Your Perfect Match</title>
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


        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2100&q=80') no-repeat center center/cover;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            /* padding-top: 80px; */
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            line-height: 3.7rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease;
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

        /* Features Section */
        .features {
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
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

        .feature-card:hover .feature-icon {
            background: #ff6b6b;
            color: white;
        }

        .feature-icon i {
            font-size: 2rem;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon i {
            color: white;
        }

        .feature-card h3 {
            margin-bottom: 15px;
            color: #444;
        }

        /* Success Stories */
        .success-stories {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stories-wrapper {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .stories-container {
            display: flex;
            width: 200%;
            /* Double width for seamless looping */
            animation: scrollStories 30s linear infinite;
        }

        .story-card {
            min-width: 300px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            margin: 0 15px;
            padding: 30px;
            color: #333;
            /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); */
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .stories-container:hover {
            animation-play-state: paused;
        }

        .story-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .couple-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .story-card h4 {
            text-align: center;
            margin-bottom: 10px;
            color: #ff6b6b;
        }

        .story-card p {
            font-style: italic;
            text-align: center;
        }

        @keyframes scrollStories {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* How It Works */
        .how-it-works {
            background: white;
        }

        .process-steps {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .step {
            flex: 1;
            min-width: 250px;
            text-align: center;
            padding: 0 20px;
            position: relative;
            margin-bottom: 30px;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 40px;
            right: 0;
            width: 70%;
            height: 2px;
            /* background: #ff6b6b; */
            opacity: 0.5;
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff6b6b;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }

        .step:hover .step-number {
            background: #ff6b6b;
            color: white;
            transform: scale(1.1);
        }


        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }

            .step:not(:last-child)::after {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .stories-container {
                animation: scrollStoriesMobile 25s linear infinite;
            }

            @keyframes scrollStoriesMobile {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-100%);
                }
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }

            .feature-card {
                padding: 20px;
            }

            .story-card {
                min-width: 250px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'include/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1>Find Your Perfect Life Partner</h1>
            <p>Join thousands of couples who found their soulmates through our trusted matchmaking service</p>
            <?php if(isset($user_name)): ?>
                <h1>Hello, <?php echo $user_name; ?>!</h1>
                <?php else: ?>
                    <a href="auth/signup.php" class=" cta-button">Create Your Profile</a>
            <?php endif;?>    
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Us</h2>
                <p>We provide the best platform to find your perfect match</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure & Private</h3>
                    <p>Your data is protected with advanced security measures and privacy controls.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Smart Matching</h3>
                    <p>Our advanced algorithm finds compatible matches based on your preferences.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <h3>Verified Profiles</h3>
                    <p>All profiles are verified to ensure authenticity and genuine intentions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="success-stories">
        <div class="container">
            <div class="section-title">
                <h2>Success Stories</h2>
                <p>Real couples who found love through our platform</p>
            </div>

            <div class="stories-wrapper">
                <div class="stories-container">
                    <div class="story-card">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Couple" class="couple-img">
                        <h4>Raj & Priya</h4>
                        <p>"We met through MatrimonyConnect and instantly connected. Thank you for helping us find each
                            other!"</p>
                    </div>

                    <div class="story-card">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Couple" class="couple-img">
                        <h4>Amit & Sneha</h4>
                        <p>"The matching algorithm truly understood what we were looking for. We couldn't be happier!"
                        </p>
                    </div>

                    <div class="story-card">
                        <img src="https://images.unsplash.com/photo-1519699047748-de8e457a634e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Couple" class="couple-img">
                        <h4>Karan & Divya</h4>
                        <p>"We were both skeptical about online matchmaking, but MatrimonyConnect proved us wrong!"</p>
                    </div>

                    <div class="story-card">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Couple" class="couple-img">
                        <h4>Vikram & Anjali</h4>
                        <p>"The detailed profiles made it easy to find someone with similar values and goals."</p>
                    </div>

                    <div class="story-card">
                        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Couple" class="couple-img">
                        <h4>Rahul & Meera</h4>
                        <p>"We connected during the pandemic and supported each other through difficult times."</p>
                    </div>

                    <div class="story-card">
                        <img src="https://images.unsplash.com/photo-1516726817505-5ed934c485f9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            alt="Couple" class="couple-img">
                        <h4>Arjun & Neha</h4>
                        <p>"The privacy features made us feel comfortable sharing our information. Highly recommended!"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-title">
                <h2>How It Works</h2>
                <p>Find your perfect match in just 4 simple steps</p>
            </div>

            <div class="process-steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Create Profile</h3>
                    <p>Sign up and create your detailed profile with preferences</p>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Find Matches</h3>
                    <p>Browse through potential matches based on compatibility</p>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Connect</h3>
                    <p>Start conversations with your matches through our secure platform</p>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Meet & Marry</h3>
                    <p>Take your relationship forward and begin your journey together</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>
    <script>

        // Story cards sliding animation control
        const storiesContainer = document.querySelector('.stories-container');

        // Pause animation on hover
        storiesContainer.addEventListener('mouseenter', () => {
            storiesContainer.style.animationPlayState = 'paused';
        });

        // Resume animation when not hovering
        storiesContainer.addEventListener('mouseleave', () => {
            storiesContainer.style.animationPlayState = 'running';
        });

        // For touch devices - pause on touch start
        storiesContainer.addEventListener('touchstart', () => {
            storiesContainer.style.animationPlayState = 'paused';
        });

        // Resume after a short delay when touch ends
        storiesContainer.addEventListener('touchend', () => {
            setTimeout(() => {
                storiesContainer.style.animationPlayState = 'running';
            }, 2000);
        });

        // Animate elements on scroll
        const animateOnScroll = function () {
            const elements = document.querySelectorAll('.feature-card, .step, .story-card');

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
            const elements = document.querySelectorAll('.feature-card, .step');
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