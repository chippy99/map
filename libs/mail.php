<?php
require_once('/home/metaluci/public_html/map/PHPMailer/class.phpmailer.php');
include("/home/metaluci/public_html/map/PHPMailer/class.smtp.php");

function send_email($to, $subject, $message, $pdf) {

    $mail = new PHPMailer(true);
    $mail->IsSMTP();

    try {

        $mail->Host       = 'meta-lucid.com'; // SMTP server
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        //$mail->Host       = 'smtp.gmail.com'; // sets the SMTP server
        //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
        $mail->Username   = 'map.no-reply@meta-lucid.com'; // SMTP account username
        $mail->Password   = '12meta34';        // SMTP account password
        $mail->AddAddress($to);

        $mail->SetFrom('map-no-reply@meta-lucid.com');
        //$mail->AddReplyTo('no-reply@nayacinema.com.np', '');
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
        $mail->MsgHTML($message);
        $mail->AddStringAttachment($pdf, 'meta-lucid_map_result.pdf', 'base64', 'application/pdf');

        $mail->Send();
    } catch (phpmailerException $e) {

        echo $e->errorMessage(); //Pretty error messages from PHPMailer

    } catch (Exception $e) {

        echo $e->getMessage(); //Boring error messages from anything else!

    }

}
function mail_invite($to, $subject, $message) {
    $mail = new PHPMailer();
    $mail->IsSMTP();

	$mail->Host       = 'meta-lucid.com'; // SMTP server
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->Username   = 'map.no-reply@meta-lucid.com'; // SMTP account username
    $mail->Password   = '12meta34';        // SMTP account password
    $mail->AddAddress($to);
    $mail->SetFrom("map.no-reply@meta-lucid.com", "MAP Application Server");

    $mail->SetFrom('map-no-reply@meta-lucid.com');
    //$mail->AddReplyTo('no-reply@nayacinema.com.np', '');
    $mail->IsHTML(false);
    $mail->Subject = $subject;
    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
    $mail->MsgHTML($message);
       
    if (!$mail->Send())
    {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
    
}

?>
