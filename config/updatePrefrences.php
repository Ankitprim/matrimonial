<?php
include("../config/database.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/metromonial/");
    exit();
}
$obj = new query;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePrefrences'])) {
    $ageRange = $_POST['ageRange'];
    $heightRange = $_POST['heightRange'];
    $genderPrefer = $_POST['genderPrefer'];
    $religionPrefer = $_POST['religionPrefer'];
    $castePrefer = $_POST['castePrefer'];
    $incomePrefer = $_POST['incomePrefer'];
    $motherTonguePrefer = $_POST['motherToungePrefer'];
    $educationPrefer = $_POST['educationPrefer'];
    $professionPrefer = $_POST['professionPrefer'];
    $locationPrefer = $_POST['locationPrefer'];

    session_start();
    $user_id = $_SESSION['user_id'];

    $data = [
        'ageRange' => $ageRange,
        'heightRange' => $heightRange,
        'religionPrefer' => $religionPrefer,
        'castePrefer' => $castePrefer,
        'incomePrefer' => $incomePrefer,
        'genderPrefer' => $genderPrefer,
        'motherTonguePrefer' => $motherTonguePrefer,
        'educationPrefer' => $educationPrefer,
        'professionPrefer' => $professionPrefer,
        'locationPrefer' => $locationPrefer
    ];
    $conditionArr = ['user_id' => $user_id];
   $query = $obj->updateData("preferences", $data, $conditionArr);

    // Redirect back to the user board or show a success message
    $_SESSION['msg'] = "Preferences updated successfully!";
    header("Location: ../userboard.php");
    exit();
}
?>