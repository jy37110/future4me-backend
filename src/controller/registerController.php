<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];

$userModule = new UserModule();
$result = $userModule->registerUser($userEmail, $firstName, $lastName, $password);
echo('1');
$returnData = new stdClass();
if($result == 1){
    $returnData->success = true;
    $returnData->msg = "Your registration is successful";
} else {
    $returnData->success = false;
    $returnData->msg = "Your registration is failed. The information for this registration is invalid";
}
echo json_encode($returnData);
echo('2');


//$db = new DbContext();
//$dbContext = $db->getDBContext();
//$user = $db->getUser();
//header('Content-Type: application/json');
//echo json_encode($user);
