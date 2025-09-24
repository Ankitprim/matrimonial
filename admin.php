<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShadiVivah Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Variables for theming */
        :root {
            --primary-color: #e40968;
            --secondary-color: #e40968;
            --accent-color: #e74c3c;
            --text-color: #333;
            --text-light: #777;
            --bg-color: #f9f9f9;
            --card-bg: #ffffff;
            --sidebar-bg: #e40968;
            --header-bg: #ffffff;
            --border-color: #e0e0e0;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 8px;
            --sidebar-width: 250px;
            --header-height: 70px;
        }

        /* Dark mode variables */
        [data-theme="dark"] {
            --primary-color: #e40968;
            --secondary-color: #e40968;
            --text-color: #f0f0f0;
            --text-light: #b0b0b0;
            --bg-color: #433737;
            --card-bg: #000000;
            --sidebar-bg: #a8054c;
            --header-bg: #1e1e1e;
            --border-color: #333;
        }

        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            transition: var(--transition);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        button {
            cursor: pointer;
            border: none;
            outline: none;
            font-family: inherit;
        }

        /* Layout */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 1000;
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close-sidebar {
            background: none;
            color: white;
            font-size: 1.5rem;
            display: block;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            transition: var(--transition);
            cursor: pointer;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu-item i {
            margin-right: 1rem;
            width: 20px;
            text-align: center;
        }

        /* Main content */
        .main-content {
            flex: 1;
            margin-left: 0;
            transition: var(--transition);
            width: 100%;
        }

        /* Header */
        .header {
            background-color: var(--header-bg);
            box-shadow: var(--shadow);
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .toggle-sidebar {
            background: none;
            color: var(--text-color);
            font-size: 1.2rem;
        }

        .search-bar {
            display: none;
            align-items: center;
            background-color: var(--bg-color);
            border-radius: 30px;
            padding: 0.5rem 1rem;
            width: 100%;
            max-width: 300px;
        }

        .search-bar input {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: var(--text-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            position: relative;
        }

        .user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.5rem;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        
        /* Content area */
        .content {
            padding: 1.5rem;
        }

        .page-title {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Dashboard stats */
        .stats-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
        }

        .stat-info p {
            color: var(--text-light);
        }

        /* Chart containers */
        .chart-container {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .chart-title {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .chart-placeholder {
            height: 300px;
            background-color: var(--bg-color);
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
        }

        /* Tables */
        .table-container {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            overflow-x: auto;
        }

        .table-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            font-weight: 600;
            background-color: var(--bg-color);
        }

        .status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status.active {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }

        .status.blocked {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--danger-color);
        }

        .status.pending {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--warning-color);
        }

        .status.deleted {
            background-color: rgba(149, 165, 166, 0.2);
            color: #95a5a6;
        }

        .action-btn {
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            margin-right: 0.5rem;
            font-size: 0.8rem;
            transition: var(--transition);
            margin-bottom: 0.3rem;
        }

        .btn-view {
            background-color: rgba(52, 152, 219, 0.2);
            color: #3498db;
        }

        .btn-edit {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }

        .btn-block {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--warning-color);
        }

        .btn-delete {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--danger-color);
        }

        .btn-restore {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }

        .btn-approve {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }

        .btn-reject {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--danger-color);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
        }

        .pagination button {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0.3rem;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: var(--transition);
        }

        .pagination button.active {
            background-color: var(--primary-color);
            color: white;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: var(--transition);
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: var(--transition);
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary-color);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .color-picker {
            width: 50px;
            height: 40px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
        }

        .file-input-container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .file-input-label {
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            cursor: pointer;
        }

        .file-name {
            color: var(--text-light);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .close-modal {
            background: none;
            color: var(--text-color);
            font-size: 1.5rem;
        }

        /* Theme toggle */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            z-index: 100;
            cursor: pointer;
        }

        /* Admin Profile Section */
        .profile-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .profile-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-right: 1rem;
        }

        .profile-info h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: var(--text-light);
        }

        /* Payment Status */
        .payment-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .payment-status.paid {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }

        .payment-status.pending {
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--warning-color);
        }

        .payment-status.failed {
            background-color: rgba(231, 76, 60, 0.2);
            color: var(--danger-color);
        }

        /* User Details in Modal */
        .user-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-label {
            font-weight: 600;
        }

        /* Testimonial Content in Modal */
        .testimonial-content {
            padding: 1rem;
            background-color: var(--bg-color);
            border-radius: var(--border-radius);
            margin-top: 1rem;
        }

        /* Responsive styles */
        @media (min-width: 480px) {
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .form-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .profile-section {
                grid-template-columns: repeat(2, 1fr);
            }

            .user-details {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: var(--sidebar-width);
            }
            .toggle-sidebar{
                display: none;
            }
            
            .close-sidebar {
                display: none;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .profile-section {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .toggle-sidebar{
                display: none;
            }
            .stats-container {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .charts-container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .user-details {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Page sections */
        .page {
            display: none;
        }

        .page.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>ShadiVivah</h2>
                <button class="close-sidebar"><i class="fas fa-times"></i></button>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li><a href="#" class="menu-item active" data-page="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#" class="menu-item" data-page="users"><i class="fas fa-users"></i> Users</a></li>
                    <li><a href="#" class="menu-item" data-page="payments"><i class="fas fa-credit-card"></i> Payments</a></li>
                    <li><a href="#" class="menu-item" data-page="testimonials"><i class="fas fa-comment"></i> Testimonials</a></li>
                    <li><a href="#" class="menu-item" data-page="analytics"><i class="fas fa-chart-bar"></i> Analytics</a></li>
                    <li><a href="#" class="menu-item" data-page="trash"><i class="fas fa-trash"></i> Trash</a></li>
                    <li><a href="#" class="menu-item" data-page="settings"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="#" class="menu-item" id="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <button class="toggle-sidebar"><i class="fas fa-bars"></i></button>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-profile">
                    <div class="user-img">AJ</div>
                    <span>Admin User</span>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content">
                <!-- Dashboard Page -->
                <section id="dashboard" class="page active">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                        <button class="btn-primary">Generate Report</button>
                    </div>

                    <!-- Stats Cards -->
                    <div class="stats-container">
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #3498db;">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3>15,248</h3>
                                <p>Total Users</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #2ecc71;">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="stat-info">
                                <h3>1,248</h3>
                                <p>Active Testimonials</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #f39c12;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <h3>324</h3>
                                <p>Pending Reviews</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background-color: #e74c3c;">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-info">
                                <h3>1,024</h3>
                                <p>Monthly Sign-ups</p>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="charts-container">
                        <div class="chart-container">
                            <h3 class="chart-title">User Growth</h3>
                            <div class="chart-placeholder">
                                <p>Line Chart Placeholder</p>
                            </div>
                        </div>
                        <div class="chart-container">
                            <h3 class="chart-title">Monthly Activity</h3>
                            <div class="chart-placeholder">
                                <p>Bar Chart Placeholder</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Users Page -->
                <section id="users" class="page">
                    <div class="page-title">
                        <h1>User Management</h1>
                        <button class="btn-primary">Add New User</button>
                    </div>

                    <div class="table-container">
                        <div class="table-header">
                            <h3>All Users</h3>
                            <div class="search-bar" style="width: 200px;">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search users..." id="user-search">
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                <!-- User rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                        <div class="pagination">
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">Next</button>
                        </div>
                    </div>
                </section>

                <!-- Payments Page -->
                <section id="payments" class="page">
                    <div class="page-title">
                        <h1>Payment Management</h1>
                        <button class="btn-primary">Export Payments</button>
                    </div>

                    <div class="table-container">
                        <div class="table-header">
                            <h3>All Payments</h3>
                            <div class="search-bar" style="width: 200px;">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search payments..." id="payment-search">
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>User Id</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="payments-table-body">
                                <!-- Payment rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                        <div class="pagination">
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">Next</button>
                        </div>
                    </div>
                </section>

                <!-- Testimonials Page -->
                <section id="testimonials" class="page">
                    <div class="page-title">
                        <h1>Testimonials</h1>
                        <button class="btn-primary">View Approved</button>
                    </div>

                    <div class="table-container">
                        <div class="table-header">
                            <h3>Pending Testimonials</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Reviewer</th>
                                    <th>Date</th>
                                    <th>Content Preview</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="testimonials-table-body">
                                <!-- Testimonial rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Analytics Page -->
                <section id="analytics" class="page">
                    <div class="page-title">
                        <h1>Analytics</h1>
                        <button class="btn-primary">Export Data</button>
                    </div>

                    <div class="charts-container">
                        <div class="chart-container">
                            <h3 class="chart-title">Testimonials by Category</h3>
                            <div class="chart-placeholder">
                                <p>Pie Chart Placeholder</p>
                            </div>
                        </div>
                        <div class="chart-container">
                            <h3 class="chart-title">User Sign-ups Over Time</h3>
                            <div class="chart-placeholder">
                                <p>Line Chart Placeholder</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Trash Page -->
                <section id="trash" class="page">
                    <div class="page-title">
                        <h1>Trash</h1>
                        <button class="btn-primary" id="empty-trash">Empty Trash</button>
                    </div>

                    <div class="table-container">
                        <div class="table-header">
                            <h3>Deleted Users</h3>
                            <div class="search-bar" style="width: 200px;">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search trash..." id="trash-search">
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Deleted Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="trash-table-body">
                                <!-- Deleted user rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                        <div class="pagination">
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">Next</button>
                        </div>
                    </div>
                </section>

                <!-- Settings Page -->
                <section id="settings" class="page">
                    <div class="page-title">
                        <h1>Settings</h1>
                    </div>

                    <!-- Admin Profile Section -->
                    <div class="profile-section">
                        <div class="profile-card">
                            <div class="profile-header">
                                <div class="profile-img">AJ</div>
                                <div class="profile-info">
                                    <h3>Admin User</h3>
                                    <p>Administrator</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="admin-name">Full Name</label>
                                <input type="text" id="admin-name" class="form-control" value="Admin User">
                            </div>
                            <div class="form-group">
                                <label for="admin-email">Email Address</label>
                                <input type="email" id="admin-email" class="form-control" value="admin@ShadiVivah.com">
                            </div>
                            <button class="btn-primary">Update Profile</button>
                        </div>

                        <div class="profile-card">
                            <h3>Change Password</h3>
                            <div class="form-group">
                                <label for="current-password">Current Password</label>
                                <input type="password" id="current-password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" id="new-password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" class="form-control">
                            </div>
                            <button class="btn-primary">Change Password</button>
                        </div>

                        <div class="profile-card">
                            <h3>Security Settings</h3>
                            <div class="form-group">
                                <label>Two-Factor Authentication</label>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Login Notifications</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Session Timeout</label>
                                <select class="form-control">
                                    <option>15 minutes</option>
                                    <option selected>30 minutes</option>
                                    <option>1 hour</option>
                                    <option>2 hours</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <h3 class="chart-title">Site Configuration</h3>
                        <form id="settings-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="site-title">Site Title</label>
                                    <input type="text" id="site-title" class="form-control" value="ShadiVivah" required>
                                </div>
                                <div class="form-group">
                                    <label for="admin-email">Admin Email</label>
                                    <input type="email" id="admin-email" class="form-control" value="admin@ShadiVivah.com" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Site Logo</label>
                                <div class="file-input-container">
                                    <label for="logo-upload" class="file-input-label">Choose File</label>
                                    <span class="file-name">No file chosen</span>
                                    <input type="file" id="logo-upload" class="form-control" style="display: none;">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="theme-color">Theme Color</label>
                                <input type="color" id="theme-color" class="color-picker" value="#e40968">
                            </div>
                            
                            <div class="form-group">
                                <label>Email Notifications</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <button type="submit" class="btn-primary">Save Settings</button>
                        </form>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- View User Modal -->
    <div class="modal" id="view-user-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>User Details</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="user-details" id="user-details-content">
                <!-- User details will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- View Testimonial Modal -->
    <div class="modal" id="view-testimonial-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Testimonial Details</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div id="testimonial-details-content">
                <!-- Testimonial details will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="edit-user-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <form id="edit-user-form">
                <div class="form-group">
                    <label for="edit-name">Name</label>
                    <input type="text" id="edit-name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input type="email" id="edit-email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit-status">Status</label>
                    <select id="edit-status" class="form-control">
                        <option value="active">Active</option>
                        <option value="blocked">Blocked</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Theme Toggle -->
    <div class="theme-toggle" id="theme-toggle">
        <i class="fas fa-moon"></i>
    </div>

    <script>
        // Sample data for users, payments, testimonials, and trash
        const usersData = [
            { id: 1, name: "John Doe", email: "john@example.com", status: "active", joinDate: "2023-01-15", lastLogin: "2023-10-20", membership: "Premium" },
            { id: 2, name: "Jane Smith", email: "jane@example.com", status: "active", joinDate: "2023-02-10", lastLogin: "2023-10-18", membership: "Basic" },
            { id: 3, name: "Robert Johnson", email: "robert@example.com", status: "blocked", joinDate: "2023-03-05", lastLogin: "2023-09-15", membership: "Premium" },
            { id: 4, name: "Emily Davis", email: "emily@example.com", status: "active", joinDate: "2023-04-20", lastLogin: "2023-10-22", membership: "Basic" },
            { id: 5, name: "Michael Wilson", email: "michael@example.com", status: "active", joinDate: "2023-05-12", lastLogin: "2023-10-21", membership: "Premium" },
            { id: 6, name: "Sarah Brown", email: "sarah@example.com", status: "blocked", joinDate: "2023-06-08", lastLogin: "2023-09-10", membership: "Basic" },
            { id: 7, name: "David Miller", email: "david@example.com", status: "active", joinDate: "2023-07-25", lastLogin: "2023-10-19", membership: "Premium" },
            { id: 8, name: "Lisa Taylor", email: "lisa@example.com", status: "active", joinDate: "2023-08-30", lastLogin: "2023-10-23", membership: "Basic" }
        ];

        const paymentsData = [
            { id: 1, userId: 1, userName: "John Doe", amount: "$49.99", date: "2023-10-15", status: "paid" },
            { id: 2, userId: 3, userName: "Robert Johnson", amount: "$99.99", date: "2023-10-10", status: "pending" },
            { id: 3, userId: 5, userName: "Michael Wilson", amount: "$49.99", date: "2023-10-05", status: "paid" },
            { id: 4, userId: 7, userName: "David Miller", amount: "$99.99", date: "2023-09-28", status: "failed" },
            { id: 5, userId: 2, userName: "Jane Smith", amount: "$49.99", date: "2023-09-20", status: "paid" }
        ];

        const testimonialsData = [
            { id: 1, reviewer: "Alex Johnson", date: "2023-05-15", content: "Great platform! Found my perfect match within a month. The user interface is intuitive and the matching algorithm is spot on. I would highly recommend this service to anyone looking for a serious relationship." },
            { id: 2, reviewer: "Maria Garcia", date: "2023-05-10", content: "The matching algorithm is excellent. Highly recommend! I've tried other dating sites before, but this one really understands what I'm looking for. The customer support is also very responsive and helpful." },
            { id: 3, reviewer: "James Wilson", date: "2023-05-05", content: "User-friendly interface and helpful customer support. I was hesitant to try online dating, but this platform made it easy and comfortable. The verification process ensures that you're interacting with real people." },
            { id: 4, reviewer: "Sophia Lee", date: "2023-04-28", content: "Met my partner here. Couldn't be happier! We've been together for six months now and things are going great. The platform's compatibility matching really works - we have so much in common!" }
        ];

        const trashData = [
            { id: 9, name: "Thomas Anderson", email: "thomas@example.com", deletedDate: "2023-09-15" },
            { id: 10, name: "Jessica Parker", email: "jessica@example.com", deletedDate: "2023-08-22" },
            { id: 11, name: "Kevin Martinez", email: "kevin@example.com", deletedDate: "2023-07-30" }
        ];

        // DOM Elements
        const sidebar = document.querySelector('.sidebar');
        const toggleSidebarBtn = document.querySelector('.toggle-sidebar');
        const closeSidebarBtn = document.querySelector('.close-sidebar');
        const menuItems = document.querySelectorAll('.menu-item');
        const pages = document.querySelectorAll('.page');
        const userDropdownToggle = document.getElementById('user-dropdown-toggle');
        const userDropdown = document.querySelector('.user-dropdown');
        const themeToggle = document.getElementById('theme-toggle');
        const usersTableBody = document.getElementById('users-table-body');
        const paymentsTableBody = document.getElementById('payments-table-body');
        const testimonialsTableBody = document.getElementById('testimonials-table-body');
        const trashTableBody = document.getElementById('trash-table-body');
        const userSearch = document.getElementById('user-search');
        const paymentSearch = document.getElementById('payment-search');
        const trashSearch = document.getElementById('trash-search');
        const viewUserModal = document.getElementById('view-user-modal');
        const viewTestimonialModal = document.getElementById('view-testimonial-modal');
        const editUserModal = document.getElementById('edit-user-modal');
        const closeModalBtns = document.querySelectorAll('.close-modal');
        const editUserForm = document.getElementById('edit-user-form');
        const settingsForm = document.getElementById('settings-form');
        const logoUpload = document.getElementById('logo-upload');
        const fileName = document.querySelector('.file-name');
        const logoutBtns = document.querySelectorAll('#logout-btn, #logout-btn-dropdown');
        const emptyTrashBtn = document.getElementById('empty-trash');
        const userDetailsContent = document.getElementById('user-details-content');
        const testimonialDetailsContent = document.getElementById('testimonial-details-content');

        // Initialize the dashboard
        function initDashboard() {
            // Populate tables
            renderUsersTable(usersData);
            renderPaymentsTable(paymentsData);
            renderTestimonialsTable(testimonialsData);
            renderTrashTable(trashData);
            
            // Set up event listeners
            setupEventListeners();
            
            // Check for saved theme preference
            checkThemePreference();
        }

        // Set up all event listeners
        function setupEventListeners() {
            // Sidebar toggle
            toggleSidebarBtn.addEventListener('click', toggleSidebar);
            closeSidebarBtn.addEventListener('click', toggleSidebar);
            
            // Menu item clicks
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetPage = this.getAttribute('data-page');
                    switchPage(targetPage);
                    
                    // Update active menu item
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Close sidebar on mobile after selection
                    if (window.innerWidth < 768) {
                        toggleSidebar();
                    }
                });
            });
            
            
            // Theme toggle
            themeToggle.addEventListener('click', toggleTheme);
            
            // Search functionality
            userSearch.addEventListener('input', () => filterUsers(userSearch.value));
            paymentSearch.addEventListener('input', () => filterPayments(paymentSearch.value));
            trashSearch.addEventListener('input', () => filterTrash(trashSearch.value));
            
            // Modal close
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });
            
            // Edit user form submission
            editUserForm.addEventListener('submit', handleEditUser);
            
            // Settings form submission
            settingsForm.addEventListener('submit', handleSettingsSave);
            
            // File upload display
            logoUpload.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;
                } else {
                    fileName.textContent = 'No file chosen';
                }
            });
            
            // Logout buttons
            logoutBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('Logout functionality would be implemented here');
                });
            });
            
            // Empty trash button
            emptyTrashBtn.addEventListener('click', emptyTrash);
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                // Close modals when clicking outside
                if (e.target.classList.contains('modal')) {
                    closeAllModals();
                }
            });
        }

        // Toggle sidebar visibility
        function toggleSidebar() {
            sidebar.classList.toggle('active');
        }

        // Switch between pages
        function switchPage(pageId) {
            pages.forEach(page => {
                page.classList.remove('active');
            });
            document.getElementById(pageId).classList.add('active');
        }

        // Toggle between light and dark theme
        function toggleTheme() {
            const isDark = document.body.getAttribute('data-theme') === 'dark';
            if (isDark) {
                document.body.removeAttribute('data-theme');
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('theme', 'light');
            } else {
                document.body.setAttribute('data-theme', 'dark');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Check for saved theme preference
        function checkThemePreference() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.setAttribute('data-theme', 'dark');
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            }
        }

        // Render users table
        function renderUsersTable(users) {
            usersTableBody.innerHTML = '';
            
            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td><span class="status ${user.status}">${user.status}</span></td>
                    <td>
                        <button class="action-btn btn-view" data-id="${user.id}">View</button>
                      <!---  <button class="action-btn btn-edit" data-id="${user.id}">Edit</button> -->
                        <button class="action-btn ${user.status === 'active' ? 'btn-block' : 'btn-edit'}" data-id="${user.id}">
                            ${user.status === 'active' ? 'Block' : 'Unblock'}
                        </button>
                        <button class="action-btn btn-delete" data-id="${user.id}">Delete</button>
                    </td>
                `;
                usersTableBody.appendChild(row);
            });
            
            // Add event listeners to action buttons
            document.querySelectorAll('.btn-view').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = parseInt(this.getAttribute('data-id'));
                    openViewUserModal(userId);
                });
            });
            
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = parseInt(this.getAttribute('data-id'));
                    openEditModal(userId);
                });
            });
            
            document.querySelectorAll('.btn-block, .btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = parseInt(this.getAttribute('data-id'));
                    toggleUserStatus(userId);
                });
            });
            
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = parseInt(this.getAttribute('data-id'));
                    deleteUser(userId);
                });
            });
        }

        // Render payments table
        function renderPaymentsTable(payments) {
            paymentsTableBody.innerHTML = '';
            
            payments.forEach(payment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${payment.id}</td>
                    <td>${payment.id}</td>
                    <td>${payment.userName}</td>
                    <td>${payment.amount}</td>
                    <td>${payment.date}</td>
                    <td><span class="payment-status ${payment.status}">${payment.status}</span></td>
                `;
                paymentsTableBody.appendChild(row);
            });
        }

        // Render testimonials table
        function renderTestimonialsTable(testimonials) {
            testimonialsTableBody.innerHTML = '';
            
            testimonials.forEach(testimonial => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${testimonial.reviewer}</td>
                    <td>${testimonial.date}</td>
                    <td>${testimonial.content.substring(0, 50)}...</td>
                    <td>
                        <button class="action-btn btn-view" data-id="${testimonial.id}">View</button>
                        <button class="action-btn btn-approve" data-id="${testimonial.id}">Approve</button>
                        <button class="action-btn btn-reject" data-id="${testimonial.id}">Reject</button>
                    </td>
                `;
                testimonialsTableBody.appendChild(row);
            });
            
            // Add event listeners to action buttons
            document.querySelectorAll('.btn-view').forEach(btn => {
                btn.addEventListener('click', function() {
                    const testimonialId = parseInt(this.getAttribute('data-id'));
                    openViewTestimonialModal(testimonialId);
                });
            });
            
            document.querySelectorAll('.btn-approve').forEach(btn => {
                btn.addEventListener('click', function() {
                    const testimonialId = parseInt(this.getAttribute('data-id'));
                    approveTestimonial(testimonialId);
                });
            });
            
            document.querySelectorAll('.btn-reject').forEach(btn => {
                btn.addEventListener('click', function() {
                    const testimonialId = parseInt(this.getAttribute('data-id'));
                    rejectTestimonial(testimonialId);
                });
            });
        }

        // Render trash table
        function renderTrashTable(trash) {
            trashTableBody.innerHTML = '';
            
            trash.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id}</td>
                    <td>${item.name}</td>
                    <td>${item.email}</td>
                    <td>${item.deletedDate}</td>
                    <td>
                        <button class="action-btn btn-restore" data-id="${item.id}">Restore</button>
                        <button class="action-btn btn-delete" data-id="${item.id}">Permanently Delete</button>
                    </td>
                `;
                trashTableBody.appendChild(row);
            });
            
            // Add event listeners to action buttons
            document.querySelectorAll('.btn-restore').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = parseInt(this.getAttribute('data-id'));
                    restoreUser(itemId);
                });
            });
        }

        // Filter users based on search input
        function filterUsers(searchTerm) {
            const filteredUsers = usersData.filter(user => 
                user.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
                user.email.toLowerCase().includes(searchTerm.toLowerCase())
            );
            renderUsersTable(filteredUsers);
        }

        // Filter payments based on search input
        function filterPayments(searchTerm) {
            const filteredPayments = paymentsData.filter(payment => 
                payment.userName.toLowerCase().includes(searchTerm.toLowerCase()) || 
                payment.amount.toLowerCase().includes(searchTerm.toLowerCase()) ||
                payment.status.toLowerCase().includes(searchTerm.toLowerCase())
            );
            renderPaymentsTable(filteredPayments);
        }

        // Filter trash based on search input
        function filterTrash(searchTerm) {
            const filteredTrash = trashData.filter(item => 
                item.name.toLowerCase().includes(searchTerm.toLowerCase()) || 
                item.email.toLowerCase().includes(searchTerm.toLowerCase())
            );
            renderTrashTable(filteredTrash);
        }

        // Open view user modal
        function openViewUserModal(userId) {
            const user = usersData.find(u => u.id === userId);
            if (user) {
                userDetailsContent.innerHTML = `
                    <div class="detail-item">
                        <span class="detail-label">ID:</span>
                        <span>${user.id}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Name:</span>
                        <span>${user.name}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email:</span>
                        <span>${user.email}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status:</span>
                        <span class="status ${user.status}">${user.status}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Join Date:</span>
                        <span>${user.joinDate}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Last Login:</span>
                        <span>${user.lastLogin}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Membership:</span>
                        <span>${user.membership}</span>
                    </div>
                `;
                viewUserModal.classList.add('active');
            }
        }

        // Open view testimonial modal
        function openViewTestimonialModal(testimonialId) {
            const testimonial = testimonialsData.find(t => t.id === testimonialId);
            if (testimonial) {
                testimonialDetailsContent.innerHTML = `
                    <div class="detail-item">
                        <span class="detail-label">Reviewer:</span>
                        <span>${testimonial.reviewer}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date:</span>
                        <span>${testimonial.date}</span>
                    </div>
                    <div class="testimonial-content">
                        <p>${testimonial.content}</p>
                    </div>
                `;
                viewTestimonialModal.classList.add('active');
            }
        }

        // Open edit user modal
        function openEditModal(userId) {
            const user = usersData.find(u => u.id === userId);
            if (user) {
                document.getElementById('edit-name').value = user.name;
                document.getElementById('edit-email').value = user.email;
                document.getElementById('edit-status').value = user.status;
                editUserModal.classList.add('active');
            }
        }

        // Close all modals
        function closeAllModals() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.classList.remove('active');
            });
        }

        // Handle edit user form submission
        function handleEditUser(e) {
            e.preventDefault();
            const name = document.getElementById('edit-name').value;
            const email = document.getElementById('edit-email').value;
            const status = document.getElementById('edit-status').value;
            
            // In a real app, you would send this data to the server
            alert(`User updated:\nName: ${name}\nEmail: ${email}\nStatus: ${status}`);
            closeAllModals();
        }

        // Toggle user status (active/blocked)
        function toggleUserStatus(userId) {
            const user = usersData.find(u => u.id === userId);
            if (user) {
                user.status = user.status === 'active' ? 'blocked' : 'active';
                renderUsersTable(usersData);
                alert(`User ${user.name} has been ${user.status === 'active' ? 'unblocked' : 'blocked'}`);
            }
        }

        // Delete user (move to trash)
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                const user = usersData.find(u => u.id === userId);
                if (user) {
                    // Add to trash
                    trashData.push({
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        deletedDate: new Date().toISOString().split('T')[0]
                    });
                    
                    // Remove from users
                    const index = usersData.findIndex(u => u.id === userId);
                    if (index !== -1) {
                        usersData.splice(index, 1);
                        renderUsersTable(usersData);
                        renderTrashTable(trashData);
                        alert('User moved to trash');
                    }
                }
            }
        }

        // Restore user from trash
        function restoreUser(userId) {
            const item = trashData.find(t => t.id === userId);
            if (item) {
                // Add back to users
                usersData.push({
                    id: item.id,
                    name: item.name,
                    email: item.email,
                    status: "active",
                    joinDate: new Date().toISOString().split('T')[0],
                    lastLogin: new Date().toISOString().split('T')[0],
                    membership: "Basic"
                });
                
                // Remove from trash
                const index = trashData.findIndex(t => t.id === userId);
                if (index !== -1) {
                    trashData.splice(index, 1);
                    renderUsersTable(usersData);
                    renderTrashTable(trashData);
                    alert('User restored from trash');
                }
            }
        }

        // Empty trash
        function emptyTrash() {
            if (confirm('Are you sure you want to permanently delete all items in trash? This action cannot be undone.')) {
                trashData.length = 0;
                renderTrashTable(trashData);
                alert('Trash emptied successfully');
            }
        }

        // Approve testimonial
        function approveTestimonial(testimonialId) {
            // In a real app, you would update the testimonial status on the server
            alert(`Testimonial ${testimonialId} approved`);
            // Remove from pending list
            const index = testimonialsData.findIndex(t => t.id === testimonialId);
            if (index !== -1) {
                testimonialsData.splice(index, 1);
                renderTestimonialsTable(testimonialsData);
            }
        }

        // Reject testimonial
        function rejectTestimonial(testimonialId) {
            if (confirm('Are you sure you want to reject this testimonial?')) {
                // In a real app, you would update the testimonial status on the server
                alert(`Testimonial ${testimonialId} rejected`);
                // Remove from pending list
                const index = testimonialsData.findIndex(t => t.id === testimonialId);
                if (index !== -1) {
                    testimonialsData.splice(index, 1);
                    renderTestimonialsTable(testimonialsData);
                }
            }
        }

        // Handle settings form submission
        function handleSettingsSave(e) {
            e.preventDefault();
            const siteTitle = document.getElementById('site-title').value;
            const adminEmail = document.getElementById('admin-email').value;
            const themeColor = document.getElementById('theme-color').value;
            
            // In a real app, you would send this data to the server
            alert('Settings saved successfully');
            
            // Update theme color in CSS variables
            document.documentElement.style.setProperty('--primary-color', themeColor);
            document.documentElement.style.setProperty('--secondary-color', adjustColor(themeColor, 20));
        }

        // Helper function to adjust color brightness
        function adjustColor(color, amount) {
            return '#' + color.replace(/^#/, '').replace(/../g, color => ('0'+Math.min(255, Math.max(0, parseInt(color, 16) + amount)).toString(16)).substr(-2));
        }

        // Initialize the dashboard when DOM is loaded
        document.addEventListener('DOMContentLoaded', initDashboard);
    </script>
</body>
</html>