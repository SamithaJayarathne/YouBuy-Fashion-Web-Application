<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT* FROM `users` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `users` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jayarathnesamitha2003@gmail.com';
            $mail->Password = 'lutzchuboizjsqrl';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('jayarathnesamitha2003@gmail.com', 'Reset Password');
            $mail->addReplyTo('jayarathnesamitha2003@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'YouBuy Fashion.lk Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:blue;">Your verification code is '.$code.' Use This for update your new password</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo ("Verification Code Sending Failed.");
            }else{
                echo ("success");
            }

    }else{
        echo ("Invalid Email Address.");
    }

}else{
    echo ("Please enter your Email Address First.");
}

?>