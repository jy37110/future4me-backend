<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];
$returnData = array();
$userModule = new UserModule();
$user = $userModule->getUSer($userEmail);
$loginResult = $userModule->loginCheck($password,$user);

if($loginResult == true){
    $returnData['success'] = true;
    $returnData['msg'] = "Your login is successful";
    $returnData['user'] = $user;
} else {
    $returnData['success'] = false;
    $returnData['msg'] = "Your login is failed. The combination of the id and password is invalid";
}

http_response_code(200);
require '../model/Header.php';

echo json_encode($returnData);
