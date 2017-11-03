<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];
$hashedEmail = password_hash($userEmail, PASSWORD_DEFAULT);


$userModule = new UserModule();
$result = $userModule->loginCheck($userEmail, $password);

$returnData = array();

if($result == true){
    $returnData['success'] = true;
    $returnData['msg'] = "Your login is successful";
    $returnData['hashedEmail'] = $hashedEmail;
} else {
    $returnData['success'] = false;
    $returnData['msg'] = "Your login is failed. The combination of the id and password is invalid";
}

http_response_code(200);
require '../model/Header.php';

echo json_encode($returnData);
