<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION["user_id"];
$err = "";
include('../config/database.php');
$obj = new query();


if (isset($_POST['submit'])) {
    $path = "../uploads/";
    $allowed_types = array('jpg', 'jpeg', 'webp','JPG','JPEG','WEBP');
    $path = $path . basename($_FILES['image']['name']);
    $type = pathinfo($path, PATHINFO_EXTENSION);
    if (!file_exists($_FILES['image']['tmp_name'])) {
        $err = "Please select an image";
    } elseif (!in_array($type, $allowed_types)) {
        $err = "Only jpg, jpeg, webp images are allowed";
    } elseif ($_FILES['image']['size'] > 4 * 1024 * 1024) {
        $err = "File size must be less than 4MB";
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            $image = basename($_FILES['image']['name']);
            $height = $_POST['height'];
            $religion = $_POST['religion'];
            $caste = $_POST['caste'];
            $motherTongue = $_POST['motherTongue'];
            $education = $_POST['education'];
            $profession = $_POST['profession'];
            $location = $_POST['location'];
            $aboutMe = $_POST['aboutMe'];
            $lookingFor = $_POST['lookingFor'];

            $obj->insertData('profiles', [
                'user_id' => $user_id,
                'image' => $image,
                'height' => $height,
                'religion' => $religion,
                'caste' => $caste,
                'motherTongue' => $motherTongue,
                'education' => $education,
                'profession' => $profession,
                'location' => $location,
                'aboutMe' => $aboutMe,
                'lookingFor'=> $lookingFor
            ]);

            header("Location: preference.php");
            exit();
        } else {
            $err = "Error in uploading file";
        }
    }

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
                    <h2>Add Your Detials </h2>
                    <p style="color:red"><?php echo $err; ?></p>
                </div>

                <form class="profile-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="text" id="height" name="height">
                    </div>
                    <div class="form-group">
                        <label for="motherTongue">Mother Tongue</label>
                        <input type="text" id="motherTongue" name="motherTongue">
                    </div>
                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <input type="text" id="profession" name="profession">
                    </div>

                    <div class="form-group">
                        <label for="education">Education</label>
                        <input type="text" id="education" name="education">
                    </div>

                    <div class="form-group">
                        <label for="religion">Religion</label>
                        <input type="text" id="religion" name="religion">
                    </div>
                    <div class="form-group">
                        <label for="cast">Caste</label>
                        <input type="text" id="caste" name="caste">
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                    </div>

                    <div class="form-group" style="grid-column: 1 / span 2;">
                        <label for="about">About Me</label>
                        <textarea id="aboutMe" name="aboutMe"></textarea>
                    </div>

                    <div class="form-group" style="grid-column: 1 / span 2;">
                        <label for="lookingFor">What I'm looking for in a partner</label>
                        <textarea id="lookingFor" name="lookingFor"></textarea>
                    </div>

                    <div class="form-group" style="grid-column: 1 / span 2;">
                        <button type="submit" name="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->

</body>

</html>