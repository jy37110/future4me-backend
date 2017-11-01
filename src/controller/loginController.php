<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$password = $_GET['psd'];


$userModule = new UserModule();
$result = $userModule->loginCheck($userEmail, $password);

$returnData = new stdClass();
if($result == true){
    $returnData->success = true;
    $returnData->msg = "Your login is successful";
} else {
    $returnData->success = false;
    $returnData->msg = "Your login is failed. The combination of the id and password is invalid";
}
echo json_encode($returnData);
