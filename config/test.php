<?php
include("database.php");
$obj = new query();
$result = $obj->getData("users");   
print_r($result->fetchAll(PDO::FETCH_ASSOC));



?>