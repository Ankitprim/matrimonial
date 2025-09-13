<?php

include('config/database.php');
define('APPURL', 'http://localhost/metromonial/');
session_start();
$err = '';
if (!isset($_SESSION['user_id'])) {
    header("Location:auth/login.php");
    exit();
}
if (isset($_SESSION["msg"])) {
    echo "<script>alert('{$_SESSION['msg']}'); </script>";
    unset($_SESSION["msg"]);
}
$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

$obj = new query;
$conditionArr = array("user_id" => $user_id, "full_name" => $user_name);
$stmt = $obj->getData("users", "*", $conditionArr);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$eamil = $data[0]['email'];
$phone = $data[0]['phone'];
$age = $data[0]['age'];
$dob = $data[0]['dob'];
$gender = $data[0]['gender'];

// from profiles table
$conditionArr = array("user_id" => $user_id);
$query = $obj->getData("profiles", "*", $conditionArr);
$data = $query->fetchAll(PDO::FETCH_ASSOC);

$image = $data[0]['image'];
$height = $data[0]['height'];
$motherTongue = $data[0]['motherTongue'];
$religion = $data[0]['religion'];
$cast = $data[0]['caste'];
$location = $data[0]['location'];
$education = $data[0]['education'];
$profession = $data[0]['profession'];
$about = $data[0]['aboutMe'];
$looknigFor = $data[0]['lookingFor'];


// from prefrences table
$query = $obj->getData('preferences', '*', $conditionArr);
$data = $query->fetchAll(PDO::FETCH_ASSOC);
$ageRange = $data[0]['ageRange'];
$heightRange = $data[0]['heightRange'];
$religionPrefer = $data[0]['religionPrefer'];
$castePrefer = $data[0]['castePrefer'];
$incomePrefer = $data[0]['incomePrefer'];
$genderPrefer = $data[0]['genderPrefer'];
$motherTonguePrefer = $data[0]['motherTonguePrefer'];
$educationPrefer = $data[0]['educationPrefer'];
$professionPrefer = $data[0]['professionPrefer'];
$locationPrefer = $data[0]['locationPrefer'];

// match card
$stmt = $obj->getMatches($user_id, 50, 0, true);
$match = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($match);

// for Match count
$matchCount = 0;
foreach ($match as $key) {
    $matchCount++;
}

// message 
$conditionArr = ['receiver_id' => $user_id];
$stmt = $obj->getData("messages", "*", $conditionArr);
$msgs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$messages_profiles = $obj->getUserConversations($user_id);
// var_dump($messages_profiles  );


$msgCount = 0;
foreach ($msgs as $msg) {
    $sender_id = $msg['sender_id'];
    $conditionArr = ['user_id' => $sender_id];
    $stmt = $obj->getData("users", "full_name", $conditionArr);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($users);
    // echo $users['full_name'];

    $conditionArr = ['user_id' => $sender_id];
    $stmt = $obj->getData("profiles ", "image", $conditionArr);
    $profiles = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo $profiles['image'];

    // var_dump($users);
    $msgCount++;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimonial Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap JS (required for modals & buttons) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #f7498eff;
            --secondary: #ff6b6b;
            --light: #f8f9fa;
            --dark: #444;
            --gray: #777;
            --light-gray: #e9ecef;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        a {
            text-decoration: none;
        }

        body {
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px 0;
            transition: var(--transition);
            box-shadow: var(--shadow);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transform: translateX(0);
        }

        .logo {
            text-align: center;
        }

        .logo h2 {
            font-size: 1.5rem;
            color: var(--secondary);
        }

        .user-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0px 20px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            margin-bottom: 10px;
        }

        .user-info {
            text-align: center;
        }

        .user-info h3 {
            margin: 5px 0;
        }

        .user-info p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .menu {
            list-style: none;
            padding: 20px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid white;
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 20px;
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .header-actions {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background-color: var(--light-gray);
        }

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            cursor: pointer;
            transition: var(--transition);
        }


        .content-area {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .content-section {
            display: none;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow);
            animation: fadeIn 0.5s ease;
        }

        .content-section.active {
            display: block;
            grid-column: 1 / span 2;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--light-gray);
        }

        /* Dashboard Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .stat-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .stat-card p {
            opacity: 0.9;
        }

        .recent-activities {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary);
        }

        /* Profile Section */
        .profile-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .profile-image-container {
            grid-column: 1 / span 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary);
            margin-bottom: 15px;
        }

        .image-upload-btn {
            padding: 8px 20px;
            background-color: var(--light);
            border-radius: 20px;
            cursor: pointer;
            transition: var(--transition);
        }

        .image-upload-btn:hover {
            background-color: var(--light-gray);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #ff2d87;
        }

        /* Messages Section */
        .messages-container {
            display: flex;
            gap: 20px;
        }

        .conversations {
            width: 300px;
            border-right: 1px solid var(--light-gray);
            padding-right: 20px;
            max-height: 500px;
            overflow-y: auto;
        }

        .conversation {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .conversation:hover {
            background-color: var(--light);
        }

        .conversation.active {
            background-color: rgba(255, 77, 148, 0.1);
        }

        .conversation-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .conversation-info h4 {
            margin-bottom: 5px;
        }

        .conversation-info p {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .chat-area {
            flex: 1;
            display: none;
            flex-direction: column;
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--light-gray);
            padding-bottom: 5px;
        }

        .chat-user-img {
            width: 40px;
            height: 40px;
            border: 1px solid var(--light-gray);
            border-radius: 50%;
            object-fit: cover;
        }


        .chat-messages {
            flex: 1;
            overflow-y: auto;
            max-height: 350px;
            padding: 10px;
            background-color: var(--light);
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .message {
            padding: 10px 15px;
            border-radius: 18px;
            margin-bottom: 10px;
            max-width: 70%;
        }

        .message.received {
            background-color: white;
            align-self: flex-start;
            border-bottom-left-radius: 5px;
        }

        .message.sent {
            background-color: var(--primary);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 5px;
            margin-left: auto;
        }

        .message-input {
            display: flex;
            gap: 10px;
        }

        .message-input input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
        }

        /* Matches Section */
        .matches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .match-card {
            background-color: var(--light);
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .match-card:hover {
            transform: translateY(-5px);
        }

        .match-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .match-info {
            padding: 15px;
        }

        .match-info h3 {
            margin-bottom: 5px;
        }

        .match-info p {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .match-actions {
            display: flex;
            justify-content: space-between;
        }

        .chat-user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .modal-footer input {
            flex: 1;
            margin-right: 5px;

        }
        .modal-footer input:focus{
            border: 1px ;
            box-shadow: 0 0 0 3px rgba(255, 0, 106, 0.5);
        }
        .modal-footer button:active{
            background-color: #ff2d87;
        }

        #profileModal {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 80px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0, 0, 0, 0.6);

        }
        .modal-header{
            border: 0px;
        }
        .modal-body{
            background:linear-gradient(135deg, #ff829dff 0%, rgba(255, 112, 174, 1) 100%) ;
            border-radius: 20px 20px 0px 0px;
        }
        .modal-footer{
            border-top: 2px solid #ff4093ff;
            background:linear-gradient(135deg, #ff829dff 0%, rgba(255, 112, 174, 1) 100%) ;
            border-radius: 0px 0px 0px 20px;

        }
        .modal-footer>.btn-primary{
            background-color: #ff146eff;
        }
        .modal-content {
            background: linear-gradient(135deg, #ff6888ff 0%, #ff4093ff 100%);
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            width: 500px;
            max-width: 90%;
            position: relative;
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 22px;
            cursor: pointer;
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }

            .logo h2,
            .user-info,
            .menu-item span {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 15px;
            }

            .menu-item i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 80px;
            }

            .content-section.active {
                grid-column: 1 / span 2;
            }
        }

        @media (max-width: 768px) {
            .content-area {
                grid-template-columns: 1fr;
            }

            .content-section.active {
                grid-column: 1;
            }

            .profile-form {
                /* grid-template-columns: 1fr; */
                display: block;
            }

            .messages-container {
                flex-direction: column;
            }

            .conversations {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--light-gray);
                padding-right: 0;
                padding-bottom: 20px;
                margin-bottom: 20px;
                max-height: 200px;
            }

        }

        @media (max-width: 576px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .logo h2,
            .user-info,
            .menu-item span {
                display: block;
            }

            .menu-item {
                justify-content: flex-start;
                padding: 12px 20px;
            }

            .menu-item i {
                margin-right: 12px;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }

            .menu-toggle {
                display: flex;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Overlay for closing sidebar on mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">

            <div class="user-profile">
                <img src="uploads/<?php echo $image; ?>" alt="User" class="user-img">
                <div class="user-info">
                    <h3><?php echo $user_name; ?></h3>
                    <p>Premium Member</p>
                </div>
            </div>

            <ul class="menu">
                <a href="<?php echo APPURL; ?>" style="text-decoration:none;color:#fff">
                    <li class="menu-item">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </li>
                </a>
                <li class="menu-item active" data-target="dashboard">
                    <i class="fa-solid fa-grip"></i>
                    <span>Dashboard</span>
                </li>
                <li class="menu-item" data-target="profile">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </li>
                <li class="menu-item" data-target="prefrences">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Prefrences</span>
                </li>
                <li class="menu-item" data-target="messages">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </li>
                <li class="menu-item" data-target="matches">
                    <i class="fas fa-heart"></i>
                    <span>Matches</span>
                </li>
                <li class="menu-item" data-target="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </li>
            </ul>

        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="logo">
                    <h2>Shadi<i class="fa-chisel fa-regular fa-heart"></i></i>vivah</h2>
                </div>

                <div class="header-actions">
                    <a href="auth/logout.php">
                        <div class="logout-btn">
                            <i class="fa-solid fa-right-from-bracket fa-fade"></i>
                        </div>
                    </a>
                    <div class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>

            <div class="content-area">
                <!-- Dashboard Section -->
                <div class="content-section active" id="dashboard">
                    <div class="section-header">
                        <h2>Dashboard</h2>
                        <p>Welcome back, <?php echo $user_name; ?>! Here's your activity summary.</p>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <i class="fa-solid fa-heart fa-bounce"></i>
                            <h3><?php echo $matchCount; ?></h3>
                            <p>New Matches</p>
                        </div>

                        <div class="stat-card">
                            <i class="fa-solid fa-comments fa-shake"></i>
                            <h3><?php echo $msgCount; ?></h3>
                            <p>Total Messages</p>
                        </div>

                        <div class="stat-card">
                            <i class="fa-solid fa-eye fa-fade"></i>
                            <h3>48</h3>
                            <p>Profile Views</p>
                        </div>

                        <div class="stat-card">
                            <i class="fa-solid fa-star fa-beat-fade"></i>
                            <h3>92%</h3>
                            <p>Profile Completion</p>
                        </div>
                    </div>

                    <div class="recent-activities">
                        <h3>Recent Activities</h3>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="activity-details">
                                <h4>New Match</h4>
                                <p>You matched with Michael Chen</p>
                                <small>2 hours ago</small>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="activity-details">
                                <h4>Message Received</h4>
                                <p>David Kim sent you a message</p>
                                <small>5 hours ago</small>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-details">
                                <h4>Profile View</h4>
                                <p>Your profile was viewed by Emma Wilson</p>
                                <small>Yesterday</small>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="activity-details">
                                <h4>Profile Updated</h4>
                                <p>You updated your profile information</p>
                                <small>2 days ago</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="content-section" id="profile">
                    <div class="section-header">
                        <h2>My Profile</h2>
                        <p>Manage your profile information</p>

                    </div>
                    <p style="color:red"><?php echo $err; ?></p>
                    <form method="post" action="config/updateProfile.php" enctype="multipart/form-data">
                        <div class="profile-image-container">
                            <img src="uploads/<?php echo $image ?? 'default.webp'; ?>" alt="Profile"
                                class="profile-image" id="profilePreview">

                            <input type="file" name="image" id="image" accept="image/*" style="display: none;">

                            <label for="image" class="image-upload-btn">
                                <i class="fas fa-camera"></i> Change Photo
                            </label>
                        </div>

                        <div class="profile-form">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="full_name" id="name" value="<?php echo $user_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" value="<?php echo $age; ?>">
                            </div>

                            <div class="form-group">
                                <label for="height">Height (cm)</label>
                                <input type="text" name="height" id="height" value="<?php echo $height; ?>">
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $eamil; ?>">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
                            </div>

                            <div class="form-group">
                                <label for="motherTongue">Mother Tongue</label>
                                <input type="text" id="motherTongue" name="motherTongue"
                                    value="<?php echo $motherTongue; ?>">
                            </div>

                            <div class="form-group">
                                <label for="profession">Profession</label>
                                <input type="text" id="profession" name="profession" value="<?php echo $profession; ?>">
                            </div>

                            <div class="form-group">
                                <label for="education">Education</label>
                                <input type="text" id="education" name="education" value="<?php echo $education; ?>">
                            </div>

                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <input type="text" id="religion" name="religion" value="<?php echo $religion; ?>">
                            </div>
                            <div class="form-group">
                                <label for="caste">Caste</label>
                                <input type="text" id="caste" name="caste" value="<?php echo $cast; ?>">
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" value="<?php echo $location; ?>">
                            </div>

                            <div class="form-group" style="grid-column: 1 / span 2;">
                                <label for="aboutMe">About Me</label>
                                <textarea id="aboutMe" name="aboutMe"><?php echo $about; ?></textarea>
                            </div>

                            <div class="form-group" style="grid-column: 1 / span 2;">
                                <label for="lookingFor">What I'm looking for in a partner</label>
                                <textarea id="lookingFor" name="lookingFor"><?php echo $looknigFor; ?></textarea>
                            </div>

                            <div class="form-group" style="grid-column: 1 / span 2;">
                                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- prefrences -->
                <div class="content-section" id="prefrences">
                    <div class="section-header">
                        <h2>My Prefrences</h2>
                        <p>Manage your prefrences</p>
                    </div>

                    <form class="profile-form" method="post" action="config/updatePrefrences.php">
                        <div class="form-group">
                            <label for="ageRange">Preferred Age Range</label>
                            <input type="text" name="ageRange" id="ageRange" value="<?php echo $ageRange; ?>">
                        </div>

                        <div class="form-group">
                            <label for="heightRange">Height Range (cm.)</label>
                            <input type="text" name="heightRange" id="heightRange" value="<?php echo $heightRange; ?>"
                                placeholder="5.0-6.2">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender Preferance</label>
                            <select id="gender" name="genderPrefer">
                                <option value="<?php echo $genderPrefer; ?>"><?php echo $genderPrefer; ?></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="religionPrefer">Religion Preferance</label>
                            <input type="text" id="religionPrefer" name="religionPrefer"
                                value="<?php echo $religionPrefer; ?>">
                        </div>

                        <div class="form-group">
                            <label for="castePrefer">Caste Preferance</label>
                            <input type="text" id="castePrefer" name="castePrefer" value="<?php echo $castePrefer; ?>">
                        </div>

                        <div class="form-group">
                            <label for="motherToungePrefer">Mother Tounge Preferance</label>
                            <input type="text" id="motherToungePrefer" name="motherToungePrefer"
                                value="<?php echo $motherTonguePrefer; ?>">
                        </div>

                        <div class="form-group">
                            <label for="educationPrefer">Education Preferance</label>
                            <input type="text" id="educationPrefer" name="educationPrefer"
                                value="<?php echo $educationPrefer; ?>">
                        </div>

                        <div class="form-group">
                            <label for="professionPrefer">Profession Prefrences</label>
                            <input type="text" id="professionPrefer" name="professionPrefer"
                                value="<?php echo $professionPrefer; ?>">
                        </div>

                        <div class="form-group">
                            <label for="locationPrefer">Location Preferance</label>
                            <input type="text" id="locationPrefer" name="locationPrefer"
                                value="<?php echo $locationPrefer; ?>">
                        </div>
                        <div class="form-group">
                            <label for="incomePrefer">Income Preferences (per month in INR)</label>
                            <input type="number" id="incomePrefer" name="incomePrefer"
                                value="<?php echo $incomePrefer; ?>" placeholder="25000">
                        </div>


                        <div class="form-group" style="grid-column: 1 / span 2;">
                            <button type="submit" name="updatePrefrences" class="btn btn-primary">Update
                                Preferences</button>
                        </div>
                    </form>
                </div>

                <!-- Messages Section -->
                <div class="content-section" id="messages">
                    <div class="section-header">
                        <h2>Messages</h2>
                        <p>Connect with your matches</p>
                    </div>

                    <div class="messages-container">
                        <div class="conversations">
                            <?php if ($msgCount == 0): ?>
                                <p>No Conversations Yet!</p>
                            <?php else: ?>
                                <?php foreach ($messages_profiles as $p1): ?>

                                    <div class="conversation openChat" data-id="<?php echo $p1['user_id']; ?>"
                                        data-name="<?php echo $p1['full_name']; ?>" data-image="<?php echo $p1['image']; ?>">
                                        <img src="uploads/<?php echo $p1['image']; ?>" alt="User" class="conversation-img">
                                        <div class="conversation-info">
                                            <h4><?php echo $p1['full_name']; ?></h4>
                                            <p><?php echo $p1['message']; ?></p>
                                        </div>
                                    </div>

                                <?php endforeach;
                            endif; ?>

                        </div>

                        <div class="chat-area" style="display:none;"> <!-- hidden by default -->
                            <div class="chat-header">
                                <img id="chatUserImage" src="uploads/default.png" class="chat-user-img">
                                <h3 id="chatUserName"></h3>
                            </div>
                            <div class="chat-messages"></div>
                            <div class="message-input">
                                <input type="text" id="chatMessage" placeholder="Type your message...">
                                <button class="btn btn-primary" id="sendMessage">Send</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Matches Section -->
                <div class="content-section" id="matches">
                    <div class="section-header">
                        <h2>Your Matches</h2>
                        <p>People who match your preferences</p>
                    </div>

                    <div class="matches-grid">
                        <?php foreach ($match as $result): ?>
                            <div class="match-card">
                                <img src="<?php echo APPURL . 'uploads/' . $result['image']; ?>" class="match-img">

                                <div class="match-info">
                                    <h3><?php echo htmlspecialchars($result['full_name']); ?></h3>
                                    <p><?php echo $result['age']; ?> years •
                                        <?php echo htmlspecialchars($result['profession']); ?>
                                    </p>
                                    <p><?php echo htmlspecialchars($result['location']); ?></p>

                                    <div class="match-actions">
                                        <button class="btn btn-primary openMessagePopup"
                                            data-id="<?php echo $result['user_id']; ?>"
                                            data-name="<?php echo htmlspecialchars($result['full_name']); ?>"
                                            data-image="<?php echo $result['image']; ?>">
                                            Message
                                        </button>

                                        <button class="btn btn-secondary view-profile"
                                            data-id="<?php echo $result['user_id']; ?>">
                                            View Profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Message Modal -->
                <div class="modal fade" id="messageModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img id="modalUserImage" src="uploads/default.png" class="chat-user-img">
                                <h5 id="modalUserName" class="modal-title"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div id="chatMessages" style="max-height:300px; overflow-y:auto;"></div>
                            </div>
                            <div class="modal-footer">
                                <input type="text" id="modalChatMessage" class="form-control"
                                    placeholder="Type your message...">
                                <button id="modalSendMessage" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Profile Modal -->
                <div id="profileModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div id="profileData">Loading...</div>
                    </div>
                </div>

                <!-- Other sections would be added similarly -->
                <div class="content-section" id="search">
                    <div class="section-header">
                        <h2>Search</h2>
                        <p>Find your perfect match</p>
                    </div>
                    <p>Search functionality would go here...</p>
                </div>

                <div class="content-section" id="settings">
                    <div class="section-header">
                        <h2>Settings</h2>
                        <p>Customize your experience</p>
                    </div>
                    <p>Settings options would go here...</p>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menu toggle functionality
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('active');
            });

            // Close sidebar when clicking outside on mobile
            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('active');
            });

            // Menu item click functionality
            const menuItems = document.querySelectorAll('.menu-item');
            const contentSections = document.querySelectorAll('.content-section');

            menuItems.forEach(item => {
                item.addEventListener('click', function () {
                    // Remove active class from all menu items and sections
                    menuItems.forEach(i => i.classList.remove('active'));
                    contentSections.forEach(s => s.classList.remove('active'));

                    // Add active class to clicked menu item
                    this.classList.add('active');

                    // Show corresponding content section
                    const targetId = this.getAttribute('data-target');
                    document.getElementById(targetId).classList.add('active');

                    // On mobile, hide sidebar after selection
                    if (window.innerWidth <= 576) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('active');
                    }
                });
            });

            // Conversation click functionality
            const conversations = document.querySelectorAll('.conversation');

            conversations.forEach(convo => {
                convo.addEventListener('click', function () {
                    conversations.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Handle window resize to adjust sidebar
            window.addEventListener('resize', function () {
                if (window.innerWidth > 576) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
    <!-- JavaScript for live preview -->
    <script>
        document.getElementById("image").addEventListener("change", function (event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById("profilePreview").src = URL.createObjectURL(file);
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let chatInterval;
        let lastMessageId = 0;

        $(document).on("click", ".openChat", function () {
            let userId = $(this).data("id");
            let userName = $(this).data("name");
            let userImage = $(this).data("image");

            // Show chat area
            $(".chat-area").show();

            // Scroll to messages section
            $('html, body').animate({
                scrollTop: $("#messages").offset().top
            }, 600);

            // Update chat header
            $("#chatUserName").text(userName);
            $("#chatUserImage").attr("src", "uploads/" + userImage);

            // Clear old messages
            $(".chat-area .chat-messages").html("");
            lastMessageId = 0;

            // Load chat
            loadChat(userId);

            // Refresh every 3 seconds
            clearInterval(chatInterval);
            chatInterval = setInterval(function () {
                loadChat(userId);
            }, 3000);

            // Send message
            $("#sendMessage").off().on("click", function () {
                let msg = $("#chatMessage").val().trim();
                if (msg !== "") {
                    $.post("config/sendMessage.php", { id: userId, message: msg }, function (res) {
                        if (res.trim() === "success") {
                            $("#chatMessage").val("");
                            loadChat(userId);
                        } else {
                            console.error(res);
                        }
                    });
                }
            });
        });

        // Load chat messages
        function loadChat(userId) {
            $.post("config/getChat.php", { id: userId, last_id: lastMessageId }, function (data) {
                if (data.trim() !== "") {
                    $(".chat-area .chat-messages").append(data);
                    $(".chat-area .chat-messages").scrollTop($(".chat-area .chat-messages")[0].scrollHeight);

                    lastMessageId = $(".chat-area .chat-messages .message").last().data("id");
                }
            });
        }

        // Enter key to send
        $("#chatMessage").on("keydown", function (e) {
            if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                $("#sendMessage").click();
            }
        });

    </script>
    <script>
        $(document).ready(function () {

            let chatInterval;
            let lastMessageId = 0;

            // Message Modal
            $(document).on("click", ".openMessagePopup", function () {
                let userId = $(this).data("id");
                let userName = $(this).data("name");
                let userImage = $(this).data("image");

                $("#modalUserName").text(userName);
                $("#modalUserImage").attr("src", "uploads/" + userImage);
                $("#chatMessages").html("");
                lastMessageId = 0;

                loadChatModal(userId);

                clearInterval(chatInterval);
                chatInterval = setInterval(() => { loadChatModal(userId); }, 3000);

                // Show modal using Bootstrap API
                let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();

                // Send message
                $("#modalSendMessage").off("click").on("click", function () {
                    let msg = $("#modalChatMessage").val().trim();
                    if (msg !== "") {
                        $.post("config/sendMessage.php", { id: userId, message: msg }, function (res) {
                            if (res.trim() === "success") {
                                $("#modalChatMessage").val("");
                                loadChatModal(userId);
                            }
                        });
                    }
                });

                // Enter key
                $("#modalChatMessage").off("keydown").on("keydown", function (e) {
                    if (e.key === "Enter" && !e.shiftKey) {
                        e.preventDefault();
                        $("#modalSendMessage").click();
                    }
                });
            });

            // Load chat messages
            function loadChatModal(userId) {
                $.post("config/getChat.php", { id: userId, last_id: lastMessageId }, function (data) {
                    if (data.trim() !== "") {
                        $("#chatMessages").append(data);
                        $("#chatMessages").scrollTop($("#chatMessages")[0].scrollHeight);
                        lastMessageId = $("#chatMessages .message").last().data("id");
                    }
                });
            }

        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("profileModal");
            const closeBtn = document.querySelector(".close");
            const profileData = document.getElementById("profileData");

            // Handle view profile click
            document.querySelectorAll(".view-profile").forEach(btn => {
                btn.addEventListener("click", function () {
                    let userId = this.getAttribute("data-id");
                    profileData.innerHTML = "Loading...";

                    fetch("config/getProfile.php?id=" + userId)
                        .then(res => res.text())
                        .then(data => {
                            profileData.innerHTML = data;
                            modal.style.display = "block";
                        });
                });
            });

            // Close modal
            closeBtn.onclick = function () {
                modal.style.display = "none";
            }
            window.onclick = function (e) {
                if (e.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>