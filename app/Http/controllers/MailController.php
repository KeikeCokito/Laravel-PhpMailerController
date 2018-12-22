<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{

	public function sendEmail (Request $request) {

        // the constants below takes their values from database table email_config
        $Host = 'smtp.gmail.com';
        $Username = 'ma7.tahir.77@gmail.com';
        $Password = '******';
        $SMTPSecure = 'tls';
        $Port = '587';
        $setFrom = ['ma7.tahir.77@gmail.com', 'it\'s me'];
        $Address = ['tahir.7badr@gmail.com', 'you who are received my email'];
        $ReplyTo = ['keike0cokito0@gmail.com', 'replayto'];
        $addCC = 'davonte.emmeri@gmail.com';
        
        // the request should be post validate the param befor send email
        $Subject = 'see you soon';
        $Body = 'i\'m the body nice to be formated html';
        

        $mail = new PHPMailer(true);                        // Passing `true` enables exceptions

        try {
            $mail->SMTPDebug = 0;                           // Enable verbose debug output
            $mail->isSMTP();                                // Set mailer to use SMTP
            $mail->Host = $Host; 				            // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                         // Enable SMTP authentication
            $mail->Username = $Username;                    // SMTP username
            $mail->Password = $Password;                    // SMTP password
            $mail->SMTPSecure = $SMTPSecure;                // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $Port;                            // TCP port to connect to


            $mail->setFrom($setFrom[0], $setFrom[1]);
            $mail->addAddress($Address[0], $Address[1]);	// Add a recipient, Name is optional
            $mail->addReplyTo($ReplyTo[0], $ReplyTo[1]);
            $mail->addCC($addCC);
            // $mail->addBCC('his-her-email@gmail.com');

            $mail->isHTML(true); 							 // Set email format to HTML
            $mail->Subject = $Subject;
            $mail->Body    = $Body;  

            $mail->send();
            return response()->json(['ok' => '1']);
        } catch (Exception $e) {
            return response()->json(['ok' => '0', 'message' => $e->getMessage()]);
        }
        
    } 
}