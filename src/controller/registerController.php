<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$hashedEmail = password_hash($userEmail, PASSWORD_DEFAULT);

$userModule = new UserModule();
$result = $userModule->registerUser($userEmail, $firstName, $lastName, $password);
$returnData = array();

if($result == 1){
    $returnData['success'] = true;
    $returnData['msg'] = "Your registration is successful";
    $returnData['hashedEmail'] = $hashedEmail;
} else {
    $returnData['success'] = false;
    $returnData['msg'] = "Your registration is failed. The email address you provided is already exist. Please try another email or use this email to login";
}

http_response_code(200);
require '../model/Header.php';

exit(json_encode($returnData));


//$db = new DbContext();
//$dbContext = $db->getDBContext();
//$user = $db->getUser();
//header('Content-Type: application/json');
//echo json_encode($user);
