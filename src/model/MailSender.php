<?php
class MailSender {
    private $_to, $_subject, $_message, $_headers;
    public function __construct($to, $subject="来自future4me的密码重置邮件", $message)
    {
        $this->_to = $to;
        $this->_subject = $subject;
        $this->_message = $message;
        $this->_headers = 'From: noreply@future4me.net' . "\r\n" .
            'Reply-To: noreply@future4me.net' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    }

    public function send(){
        mail($this->_to,$this->_subject,$this->_message,$this->_headers);
    }

    public function __set($headers){
        $this->_headers = $headers;
    }
}