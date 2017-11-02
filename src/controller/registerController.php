<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];

$userModule = new UserModule();
$result = $userModule->registerUser($userEmail, $firstName, $lastName, $password);
$returnData = array();


if($result == 1){
    $returnData['success'] = true;
    $returnData['msg'] = "Your registration is successful";
} else {
    $returnData['success'] = false;
    $returnData['msg'] = "Your registration is failed. The email address you provided is already exist";
}

http_response_code(200);
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

exit(json_encode($returnData));


//$db = new DbContext();
//$dbContext = $db->getDBContext();
//$user = $db->getUser();
//header('Content-Type: application/json');
//echo json_encode($user);
