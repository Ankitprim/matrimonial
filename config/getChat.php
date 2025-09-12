<?php
include('database.php');
session_start();

if (!isset($_SESSION['user_id'])) exit("Login required");
if (!isset($_POST['id'])) exit("Invalid request");

$myId = $_SESSION['user_id'];
$otherId = intval($_POST['id']);
$lastId = isset($_POST['last_id']) ? intval($_POST['last_id']) : 0;

$obj = new query;

if ($lastId > 0) {
    $messages = $obj->getMessagesAfter($myId, $otherId, $lastId);
} else {
    $messages = $obj->getMessages($myId, $otherId);
}

foreach ($messages as $msg) {
    $class = ($msg['sender_id'] == $myId) ? "sent" : "received";
    echo '<div class="message '.$class.'" data-id="'.$msg['id'].'"><p>'
         . htmlspecialchars($msg['message']) . '</p></div>';
}
