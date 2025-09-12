<?php
include('database.php');
session_start();

if (!isset($_POST['id']))
  exit("Invalid request");

$userId = intval($_POST['id']);
$obj = new query;
$conditionArr = array("user_id" => $userId);

// Get user info
$stmt = $obj->getData("users", "*", $conditionArr);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Get profile info
$stmt = $obj->getData("profiles", "*", $conditionArr);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($profile); 
// print_r($profile);


if (!$user || !$profile) {
  echo "User not found!";
  exit;
}
?>
<html>
<h1>hello <?php echo $user['full_name'];?></h1>
</html>