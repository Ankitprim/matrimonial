<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimonial Success Stories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background-color: #f9f7f7;
            color: #333;
            line-height: 1.6;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1964&q=80') center/cover no-repeat;
            color: white;
            text-align: center;
            padding: 10rem 2rem 5rem;
            margin-bottom: 3rem;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            animation: fadeInDown 1s ease;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease;
        }

      
        /* Success Stories Grid */
        .stories-container {
            max-width: 1200px;
            margin: 0 auto 4rem;
            padding: 0 1.5rem;
        }

        .stories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .story-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            opacity: 1;
            transform: translateY(0px);
        }


        .story-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .story-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .story-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .story-card:hover .story-image img {
            transform: scale(1.1);
        }

        .story-content {
            padding: 1.5rem;
        }

        .couple-name {
            color: #ff6b6b;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }

        .wedding-date {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .story-excerpt {
            margin-bottom: 1.5rem;
            height: 80px;
            overflow: hidden;
        }

        .read-more {
            display: inline-block;
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .read-more:hover {
            color: #b44b75;
        }

        /* Testimonials Section */
        .testimonials {
            background: linear-gradient(135deg, #ff6b6b, #b44b75);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .testimonials-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .testimonials h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .testimonial-slider {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 2rem;
            padding: 1rem;
            scrollbar-width: none;
            /* Firefox */
        }

        .testimonial-slider::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Edge */
        }

        .testimonial {
            scroll-snap-align: start;
            flex: 0 0 80%;
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .testimonial-author {
            font-weight: 600;
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
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .stories-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .testimonial {
                flex: 0 0 85%;
            }
        }

        @media (max-width: 480px) {

            .hero {
                padding: 3rem 1rem;
            }

            .stories-grid {
                grid-template-columns: 1fr;
            }

            .testimonial {
                flex: 0 0 95%;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'include/header.php'; ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Love Stories That Inspire</h1>
            <p>Discover how thousands of couples found their perfect match through our platform</p>
        </div>
    </section>


    <!-- Success Stories Grid -->
    <section class="stories-container">
        <div class="stories-grid">
            <!-- Story 1 -->
            <div class="story-card" data-category="recent">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
                        alt="Couple 1">
                </div>
                <div class="story-content">
                    <h3 class="couple-name">Rahul & Priya</h3>
                    <p class="wedding-date">Married: January 15, 2023</p>
                    <p class="story-excerpt">We met through MatrimonyMatch and instantly connected over our love for
                        travel and adventure...</p>
                    <a href="#" class="read-more">Read Full Story <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Story 2 -->
            <div class="story-card" data-category="long-term">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
                        alt="Couple 2">
                </div>
                <div class="story-content">
                    <h3 class="couple-name">Amit & Sneha</h3>
                    <p class="wedding-date">Married: June 8, 2020</p>
                    <p class="story-excerpt">After three years of marriage, we're happier than ever. MatrimonyMatch
                        helped us find our perfect compatibility...</p>
                    <a href="#" class="read-more">Read Full Story <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Story 4 -->
            <div class="story-card" data-category="recent">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1516726817505-f5ed825624d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
                        alt="Couple 4">
                </div>
                <div class="story-content">
                    <h3 class="couple-name">Vikram & Meera</h3>
                    <p class="wedding-date">Married: February 14, 2023</p>
                    <p class="story-excerpt">We never believed in arranged marriages until we found each other on
                        MatrimonyMatch. It was destiny...</p>
                    <a href="#" class="read-more">Read Full Story <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Story 5 -->
            <div class="story-card" data-category="long-term">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
                        alt="Couple 5">
                </div>
                <div class="story-content">
                    <h3 class="couple-name">Sanjay & Lakshmi</h3>
                    <p class="wedding-date">Married: December 3, 2018</p>
                    <p class="story-excerpt">Five years and two beautiful children later, we're still grateful to
                        MatrimonyMatch for bringing us together...</p>
                    <a href="#" class="read-more">Read Full Story <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Story 6 -->
            <div class="story-card" data-category="international">
                <div class="story-image">
                    <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?ixlib=rb-4.0.3&auto=format&fit=crop&w=700&q=80"
                        alt="Couple 6">
                </div>
                <div class="story-content">
                    <h3 class="couple-name">Michael & Sunita</h3>
                    <p class="wedding-date">Married: August 10, 2021</p>
                    <p class="story-excerpt">From different continents but matched perfectly through MatrimonyMatch's
                        advanced compatibility system...</p>
                    <a href="#" class="read-more">Read Full Story <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="testimonials-container">
            <h2>What Couples Say</h2>
            <div class="testimonial-slider">
                <div class="testimonial">
                    <p class="testimonial-text">"shadiVivah made the process so simple. We were matched based on
                        genuine compatibility, not just superficial factors."</p>
                    <p class="testimonial-author">- Raj & Anjali, Married 2 years</p>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"As someone living abroad, I was skeptical about finding a partner from
                        my culture. shadiVivah exceeded all my expectations!"</p>
                    <p class="testimonial-author">- Neha & Sameer, Married 1 year</p>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"The detailed profiles and verification process gave us confidence. We
                        knew we could trust the platform to find genuine matches."</p>
                    <p class="testimonial-author">- Arjun & Divya, Married 3 years</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>

    <script>
        // Function to check if element is in viewport for scroll animations
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Function to handle scroll animations
        function handleScrollAnimations() {
            const storyCards = document.querySelectorAll('.story-card');

            storyCards.forEach(card => {
                if (isInViewport(card)) {
                    card.classList.add('visible');
                }
            });
        }

        // Filter functionality
        function setupFilters() {
            const filterButtons = document.querySelectorAll('.filter-btn');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));

                    // Add active class to clicked button
                    button.classList.add('active');

                    const filter = button.getAttribute('data-filter');
                    const storyCards = document.querySelectorAll('.story-card');

                    storyCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                        } else {
                            if (card.getAttribute('data-category') === filter) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Set up filter functionality
            setupFilters();

            // Initial check for elements in viewport
            handleScrollAnimations();

            // Add scroll event listener for animations
            window.addEventListener('scroll', handleScrollAnimations);

            // Auto scroll testimonials
            const testimonialSlider = document.querySelector('.testimonial-slider');
            let scrollAmount = 0;
            let scrollDirection = 1;

            setInterval(() => {
                scrollAmount += scrollDirection * 300;

                if (scrollAmount >= testimonialSlider.scrollWidth - testimonialSlider.clientWidth) {
                    scrollDirection = -1;
                } else if (scrollAmount <= 0) {
                    scrollDirection = 1;
                }

                testimonialSlider.scrollTo({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }, 2000);
        });
    </script>
</body>

</html>