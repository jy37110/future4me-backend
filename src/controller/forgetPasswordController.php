<?php
include_once '../model/DbContext.php';
include_once '../model/UserModule.php';

$userEmail = $_GET['email'];
$returnData = array();
$userModule = new UserModule();
$user = $userModule->getUSer($userEmail);
if ($user !== false && $user !== []){
    $returnData['success'] = true;
    $returnData['msg'] = "Your request has been sent successfully";
    $hashedPassword = password_hash($user[0]['password'], PASSWORD_DEFAULT);
    $resetURL = "www.madingedu.com/#/resetPassword/" . $userEmail . ";" . $hashedPassword;

    $to = $userEmail;
    $subject = "来自future4me的密码重置邮件";
    $message = "您好，此处省略一万字。。。\n点击一下链接重新设置您的密码\n".$resetURL;
    $headers = 'From: noreply@future4me.net' . "\r\n" .
        'Reply-To: noreply@future4me.net' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to,$subject,$message,$headers);
} else {
    $returnData['success'] = false;
    $returnData['msg'] = "Your email address is not valid";
}

http_response_code(200);
require '../model/Header.php';

echo json_encode($returnData);
