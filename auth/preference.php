<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION["user_id"];

include('../config/database.php');
$obj = new query();
if (isset($_POST['submit'])) {
    $age_range = $_POST['age_range'];
    $height_range = $_POST['height_range'];
    $genderPrefer = $_POST['genderPrefer'];
    $religionPrefer = $_POST['religionPrefer'];
    $castePrefer = $_POST['castePrefer'];
    $incomePrefer = $_POST['incomePrefer'];
    $motherTonguePrefer = $_POST['motherToungePrefer'];
    $educationPrefer = $_POST['educationPrefer'];
    $professionPrefer = $_POST['professionPrefer'];
    $locationPrefer = $_POST['locationPrefer'];

    $obj->insertData('preferences', [
        'user_id' => $user_id,
        'ageRange' => $age_range,
        'heightRange' => $height_range,
        'religionPrefer' => $religionPrefer,
        'castePrefer' => $castePrefer,
        'incomePrefer' => $incomePrefer,
        'genderPrefer' => $genderPrefer,
        'motherTonguePrefer' => $motherTonguePrefer,
        'educationPrefer' => $educationPrefer,
        'professionPrefer' => $professionPrefer,
        'locationPrefer' => $locationPrefer
    ]);

    header("Location: ../userboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - MatrimonyConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/create_form.css">
    <link rel="stylesheet" href="../css/profile_form.css">
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Account Creation Section -->
    <section class="account-creation">
        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h2>Add Your Preferences</h2>
                </div>
                <form class="profile-form" method="post">
                    <div class="form-group">
                        <label for="ageRange">Preferred Age Range</label>
                        <input type="text" name="age_range" id="ageRange" value="">
                    </div>

                    <div class="form-group">
                        <label for="heightRange">Height Range (ft.)</label>
                        <input type="text" name="height_range" id="heightRange" value="" placeholder="5.0-6.2">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender Prefrences</label>
                        <select id="gender" name="genderPrefer">
                            <option value="">Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="religionPrefer">Religion Preferance</label>
                        <input type="text" id="religionPrefer" name="religionPrefer" value="">
                    </div>

                    <div class="form-group">
                        <label for="castePrefer">Caste Preferance</label>
                        <input type="text" id="castePrefer" name="castePrefer" value="">
                    </div>

                    <div class="form-group">
                        <label for="motherToungePrefer">Mother Tounge Preferance</label>
                        <input type="text" id="motherToungePrefer" name="motherToungePrefer" value="">
                    </div>

                    <div class="form-group">
                        <label for="educationPrefer">Education Preferance</label>
                        <input type="text" id="educationPrefer" name="educationPrefer" value="">
                    </div>

                    <div class="form-group">
                        <label for="professionPrefer">Profession Prefrences</label>
                        <input type="text" id="professionPrefer" name="professionPrefer" value="">
                    </div>

                    <div class="form-group">
                        <label for="locationPrefer">Location Preferance</label>
                        <input type="text" id="locationPrefer" name="locationPrefer" value="">
                    </div>
                    <div class="form-group">
                        <label for="incomePrefer">Income Preferences (per month in INR)</label>
                        <input type="number" id="incomePrefer" name="incomePrefer" value="" placeholder="25000">
                    </div>


                    <div class="form-group" style="grid-column: 1 / span 2;">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->

</body>

</html>