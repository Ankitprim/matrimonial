<?php
include("config/init.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Matches - MatrimonyConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        
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

     
        /* Search Section */
        .search-section {
            padding: 120px 0 50px;
        }

        .search-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .search-tab {
            padding: 12px 25px;
            background: white;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .search-tab.active {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
        }

        .search-tab:hover:not(.active) {
            background: #f5f5f5;
        }

        .search-form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 40px;
        }

        .search-form {
            display: none;
        }

        .search-form.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
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
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }

        .form-footer {
            text-align: center;
        }

        /* Results Section */
        .results-section {
            background: #f5f5f5;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .results-count {
            font-weight: 500;
            color: #555;
        }

        .results-sort {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .results-sort select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .profile-img {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .profile-card:hover .profile-img img {
            transform: scale(1.1);
        }

        .profile-id {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 107, 107, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .profile-details {
            padding: 20px;
        }

        .profile-name {
            font-size: 1.3rem;
            color: #444;
            margin-bottom: 5px;
        }

        .profile-age {
            color: #777;
            margin-bottom: 15px;
        }

        .profile-info {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            color: #555;
        }

        .info-item i {
            color: #ff6b6b;
        }

        .profile-actions {
            display: flex;
            justify-content: space-between;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 10px;
        }

        .pagination-item {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: white;
            color: #555;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination-item.active {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
        }

        .pagination-item:hover:not(.active) {
            background: #f5f5f5;
        }

      
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
            
            .search-tabs {
                overflow-x: auto;
                justify-content: flex-start;
                padding-bottom: 10px;
            }
            
            .search-tab {
                white-space: nowrap;
            }
            
            .results-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .results-sort {
                width: 100%;
                justify-content: flex-end;
            }
        }

        @media (max-width: 480px) {
            
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .search-form-container {
                padding: 20px 15px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .profile-actions .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include("include/header.php");?>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="section-title">
                <h2>Find Your Perfect Match</h2>
                <p>Use our advanced search options to find compatible partners</p>
            </div>
            
            <div class="search-tabs">
                <div class="search-tab active" data-tab="quick">Quick Search</div>
                <div class="search-tab" data-tab="advanced">Advanced Search</div>
                <div class="search-tab" data-tab="location">Location Search</div>
                <div class="search-tab" data-tab="occupation">Occupation Search</div>
                <div class="search-tab" data-tab="id">Search by ID</div>
                <div class="search-tab" data-tab="keyword">Keyword Search</div>
            </div>
            
            <div class="search-form-container">
                <!-- Quick Search Form -->
                <form class="search-form active" id="quick-search">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="quick-gender">I'm looking for</label>
                            <select id="quick-gender" name="gender">
                                <option value="male">Bride</option>
                                <option value="female">Groom</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="quick-age">Age</label>
                            <select id="quick-age" name="age">
                                <option value="18-25">18-25 years</option>
                                <option value="26-30">26-30 years</option>
                                <option value="31-35">31-35 years</option>
                                <option value="36-40">36-40 years</option>
                                <option value="41+">41+ years</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="quick-religion">Religion</label>
                            <select id="quick-religion" name="religion">
                                <option value="">Any Religion</option>
                                <option value="hindu">Hindu</option>
                                <option value="muslim">Muslim</option>
                                <option value="christian">Christian</option>
                                <option value="sikh">Sikh</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn">Find Matches</button>
                    </div>
                </form>
                
                <!-- Advanced Search Form -->
                <form class="search-form" id="advanced-search">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="adv-age-min">Age (Min)</label>
                            <input type="number" id="adv-age-min" name="age-min" min="18" max="80" placeholder="18">
                        </div>
                        
                        <div class="form-group">
                            <label for="adv-age-max">Age (Max)</label>
                            <input type="number" id="adv-age-max" name="age-max" min="18" max="80" placeholder="40">
                        </div>
                        
                        <div class="form-group">
                            <label for="adv-height">Height</label>
                            <select id="adv-height" name="height">
                                <option value="">Any Height</option>
                                <option value="4.5">4'5" (135 cm) or below</option>
                                <option value="5.0">5'0" (152 cm)</option>
                                <option value="5.5">5'5" (165 cm)</option>
                                <option value="6.0">6'0" (183 cm)</option>
                                <option value="6.5">6'5" (196 cm) or above</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="adv-marital">Marital Status</label>
                            <select id="adv-marital" name="marital">
                                <option value="">Any Status</option>
                                <option value="never">Never Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="adv-education">Education</label>
                            <select id="adv-education" name="education">
                                <option value="">Any Education</option>
                                <option value="highschool">High School</option>
                                <option value="bachelor">Bachelor's Degree</option>
                                <option value="master">Master's Degree</option>
                                <option value="doctorate">Doctorate</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="adv-income">Annual Income</label>
                            <select id="adv-income" name="income">
                                <option value="">Any Income</option>
                                <option value="0-5">Less than $50,000</option>
                                <option value="5-10">$50,000 - $100,000</option>
                                <option value="10-20">$100,000 - $200,000</option>
                                <option value="20+">$200,000+</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn">Find Matches</button>
                    </div>
                </form>
                
                <!-- Location Search Form -->
                <form class="search-form" id="location-search">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="loc-country">Country</label>
                            <select id="loc-country" name="country">
                                <option value="">Select Country</option>
                                <option value="usa">United States</option>
                                <option value="india">India</option>
                                <option value="uk">United Kingdom</option>
                                <option value="canada">Canada</option>
                                <option value="australia">Australia</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="loc-state">State/Province</label>
                            <input type="text" id="loc-state" name="state" placeholder="Enter state">
                        </div>
                        
                        <div class="form-group">
                            <label for="loc-city">City</label>
                            <input type="text" id="loc-city" name="city" placeholder="Enter city">
                        </div>
                        
                        <div class="form-group">
                            <label for="loc-distance">Within Distance</label>
                            <select id="loc-distance" name="distance">
                                <option value="10">10 miles</option>
                                <option value="25">25 miles</option>
                                <option value="50">50 miles</option>
                                <option value="100">100 miles</option>
                                <option value="any">Any distance</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn">Find Matches</button>
                    </div>
                </form>
                
                <!-- Other search forms would go here -->
                <form class="search-form" id="occupation-search">
                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <input type="text" id="occupation" name="occupation" placeholder="e.g. Engineer, Doctor, Teacher">
                    </div>
                    
                    <div class="form-group">
                        <label for="industry">Industry</label>
                        <select id="industry" name="industry">
                            <option value="">Any Industry</option>
                            <option value="it">Information Technology</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="finance">Finance</option>
                            <option value="education">Education</option>
                            <option value="engineering">Engineering</option>
                        </select>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn">Find Matches</button>
                    </div>
                </form>
                
                <form class="search-form" id="id-search">
                    <div class="form-group">
                        <label for="profile-id">Profile ID</label>
                        <input type="text" id="profile-id" name="profile-id" placeholder="Enter profile ID">
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn">Find Profile</button>
                    </div>
                </form>
                
                <form class="search-form" id="keyword-search">
                    <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <input type="text" id="keywords" name="keywords" placeholder="Enter keywords (e.g. 'travel', 'music', 'sports')">
                    </div>
                    
                    <div class="form-group">
                        <label for="search-in">Search In</label>
                        <select id="search-in" name="search-in">
                            <option value="all">All Profile Sections</option>
                            <option value="about">About Me</option>
                            <option value="interests">Interests</option>
                            <option value="profession">Profession</option>
                        </select>
                    </div>
                    
                    <div class="form-footer">
                        <button type="submit" class="btn">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="results-section">
        <div class="container">
            <div class="results-header">
                <div class="results-count">Showing 24 matches</div>
                <div class="results-sort">
                    <span>Sort by:</span>
                    <select>
                        <option>Newest First</option>
                        <option>Relevance</option>
                        <option>Age: Low to High</option>
                        <option>Age: High to Low</option>
                    </select>
                </div>
            </div>
            
            <div class="results-grid">
                <!-- Profile Card 1 -->
                <div class="profile-card">
                    <div class="profile-img">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Profile">
                        <div class="profile-id">ID: MC123456</div>
                    </div>
                    <div class="profile-details">
                        <h3 class="profile-name">Priya Sharma</h3>
                        <div class="profile-age">28 years, 5'4"</div>
                        <div class="profile-info">
                            <div class="info-item"><i class="fas fa-graduation-cap"></i> MBA</div>
                            <div class="info-item"><i class="fas fa-briefcase"></i> Marketing Manager</div>
                            <div class="info-item"><i class="fas fa-map-marker-alt"></i> New Delhi, India</div>
                        </div>
                        <div class="profile-actions">
                            <a href="#" class="btn-outline">View Profile</a>
                            <a href="#" class="btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Card 2 -->
                <div class="profile-card">
                    <div class="profile-img">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Profile">
                        <div class="profile-id">ID: MC654321</div>
                    </div>
                    <div class="profile-details">
                        <h3 class="profile-name">Rahul Kapoor</h3>
                        <div class="profile-age">32 years, 5'11"</div>
                        <div class="profile-info">
                            <div class="info-item"><i class="fas fa-graduation-cap"></i> MS Software Eng</div>
                            <div class="info-item"><i class="fas fa-briefcase"></i> Tech Lead</div>
                            <div class="info-item"><i class="fas fa-map-marker-alt"></i> Bangalore, India</div>
                        </div>
                        <div class="profile-actions">
                            <a href="#" class="btn-outline">View Profile</a>
                            <a href="#" class="btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Card 3 -->
                <div class="profile-card">
                    <div class="profile-img">
                        <img src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Profile">
                        <div class="profile-id">ID: MC789012</div>
                    </div>
                    <div class="profile-details">
                        <h3 class="profile-name">Aisha Khan</h3>
                        <div class="profile-age">26 years, 5'3"</div>
                        <div class="profile-info">
                            <div class="info-item"><i class="fas fa-graduation-cap"></i> MD Medicine</div>
                            <div class="info-item"><i class="fas fa-briefcase"></i> Resident Doctor</div>
                            <div class="info-item"><i class="fas fa-map-marker-alt"></i> Mumbai, India</div>
                        </div>
                        <div class="profile-actions">
                            <a href="#" class="btn-outline">View Profile</a>
                            <a href="#" class="btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Card 4 -->
                <div class="profile-card">
                    <div class="profile-img">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Profile">
                        <div class="profile-id">ID: MC345678</div>
                    </div>
                    <div class="profile-details">
                        <h3 class="profile-name">Arjun Patel</h3>
                        <div class="profile-age">30 years, 5'10"</div>
                        <div class="profile-info">
                            <div class="info-item"><i class="fas fa-graduation-cap"></i> Chartered Accountant</div>
                            <div class="info-item"><i class="fas fa-briefcase"></i> Finance Manager</div>
                            <div class="info-item"><i class="fas fa-map-marker-alt"></i> Ahmedabad, India</div>
                        </div>
                        <div class="profile-actions">
                            <a href="#" class="btn-outline">View Profile</a>
                            <a href="#" class="btn">Connect</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pagination">
                <div class="pagination-item active">1</div>
                <div class="pagination-item">2</div>
                <div class="pagination-item">3</div>
                <div class="pagination-item">4</div>
                <div class="pagination-item">></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include("include/footer.php"); ?>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
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
        
        hamburger.addEventListener('click', function() {
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

        // Search tabs functionality
        const searchTabs = document.querySelectorAll('.search-tab');
        const searchForms = document.querySelectorAll('.search-form');
        
        searchTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Update active tab
                searchTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                // Show corresponding form
                searchForms.forEach(form => {
                    form.classList.remove('active');
                    if (form.id === `${tabId}-search`) {
                        form.classList.add('active');
                    }
                });
            });
        });

        // Form submission
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Search functionality would be implemented with backend integration');
            });
        });

        // Animate profile cards on scroll
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.profile-card');
            
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
            const elements = document.querySelectorAll('.profile-card');
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