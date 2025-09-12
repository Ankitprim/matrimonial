<?php
include("database.php");
$obj = new query;
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    exit("Login required");
}

if (empty($_POST['id']) || empty($_POST['message'])) {
    exit("Invalid request");
}

$myId = $_SESSION['user_id'];
$otherId = intval($_POST['id']);
$message = trim($_POST['message']);

try {
    if ($message !== '') {
        $data = ['sender_id'=>$myId,'receiver_id'=>$otherId,'message'=>$message];
        $stmt = $obj->insertData("messages",$data);
        echo "success";
    } else {
        echo "Message empty";
    }
} catch (PDOException $e) {
    echo "DB Error: " . $e->getMessage();
}
