<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/metromonial/");
    exit();
}

include("database.php");
$obj = new query();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['update'])) {
    $user_id = $_SESSION["user_id"];
    $uploadDir = "../uploads/";
    $image = null;

    // If user selected a new image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
        $mime_type = mime_content_type($_FILES['image']['tmp_name']);
        
        if (!in_array($mime_type, $allowed_types)) {
            $err = "Only JPG, JPEG, PNG, WEBP images are allowed";
        } elseif ($_FILES['image']['size'] > 4 * 1024 * 1024) {
            $err = "File size must be less than 4MB";
        } else {

            // Unique filename
            $image = time() . "_" . basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $image;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $err = "Error in uploading file";
                $image = null; // don’t overwrite DB if upload failed
            }
        }
    }

    // Profile table update
    $data = [
        'height'       => $_POST['height'],
        'religion'     => $_POST['religion'],
        'caste'        => $_POST['caste'],
        'motherTongue' => $_POST['motherTongue'],
        'education'    => $_POST['education'],
        'profession'   => $_POST['profession'],
        'income'       => $_POST['income'],
        'location'     => $_POST['location'],
        'aboutMe'      => $_POST['aboutMe'],
        'lookingFor'   => $_POST['lookingFor']
    ];
    if ($image) { // only update image if new uploaded
        $data['image'] = $image;
    }
    $conditionArr = ["user_id"=>$user_id];
    $obj->updateData('profiles', $data, $conditionArr);

    // Users table update
    $userData = [
        'full_name' => $_POST["full_name"],
        'age'       => $_POST["age"],
        'dob'       => $_POST["dob"],
        'gender'    => $_POST["gender"],
        'email'     => $_POST["email"],
        'phone'     => $_POST["phone"]
    ];
    $obj->updateData('users', $userData, $conditionArr);
    $_SESSION['msg'] = "Profile updated successfully!";
    header("Location: ../userboard.php");
    exit();
}
?>
