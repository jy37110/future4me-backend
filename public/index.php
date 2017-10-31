<?php
include '../src/model/DbContext.php';
$db = new DbContext();
$dbContext = $db->getDBContext();
$user = $db->getUser();
//$data = /** whatever you're serializing **/;
header('Content-Type: application/json');
echo json_encode($user);
//print_r($user);