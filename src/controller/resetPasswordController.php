<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];
$newPassword = $_GET['newPsd'];

$returnData = array();
$userModule = new UserModule();
$user = $userModule->getUSer($userEmail);
$verifyResult = $userModule->verifyResetPassword($password,$user);

if($verifyResult == true){
    $userModule->reconnectDB();
    $queryRes = $userModule->resetPassword($user[0]['id'], password_hash($newPassword, PASSWORD_DEFAULT));
    $returnData['success'] = $queryRes;
    $returnData['msg'] = "Your password has been reset correctly";
} else {
    $returnData['success'] = false;
    $returnData['msg'] = "Your credential is invalid";
}

http_response_code(200);
require '../model/Header.php';

echo json_encode($returnData);
