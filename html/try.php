<?php
require 'vendor/autoload.php';
require 'PHPMailerAutoload.php';
$user="raulcostea77@gmail.com";
	$key = $user.date('mY');			
		$key = md5($key);
$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'postmaster@sandbox4ee96bafb8bc42ac890d19f804ec904e.mailgun.org';   // SMTP username
$mail->Password = 'e4d1ca6ba195a78aa8ed34fc53d50718';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is 
$mail->From = 'postmaster@sandbox4ee96bafb8bc42ac890d19f804ec904e.mailgun.org';
$mail->FromName = 'Support';
$mail->addAddress($user);                 // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->Subject = 'Confirm your account at Dream Team';
$mail->Body    = "Welcome!

					Thank-you for creating an account.

					Please confirm your account by copy and pasting the link below into your browsers address bar.

					{SITEPATH}/confirm.php?email=".$user."&key=".$key."

					Thanks!";
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}




/*require 'vendor/autoload.php';
use Mailgun\Mailgun;
$client = new \Http\Adapter\Guzzle6\Client();
# Instantiate the client.
$mailgun = new Mailgun('key-9f63a951b1242e72e5ac3030fc086794',$client);
$domain = "sandbox4ee96bafb8bc42ac890d19f804ec904e.mailgun.org";
$mailgun->setSslEnabled('false');
# Make the call to the client.
$result=$mailgun->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandbox4ee96bafb8bc42ac890d19f804ec904e.mailgun.org>',
                        'to'      => 'Raul <raulcostea77@gmail.com>',
                        'subject' => 'Hello Raul',
                        'text'    => 'Congratulations Raul, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));

$id = $result->http_response_body->id;
echo $id;
*/
?>