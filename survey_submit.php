<?php
require_once("../../map/meta_config.php");
require_once("libs/funcs.php");
require_once("libs/pdf.php");
require_once("libs/mail.php");


if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $c_id = test_input($_POST["c_id"]);
        $organisation = test_input($_POST["c_org"]);
        $email = test_input($_POST["c_email"]);
        $fname = test_input($_POST["c_fname"]);
        $sname = test_input($_POST["c_sname"]);
        $q1 = test_input($_POST["q1"]);
        $q2 = test_input($_POST["q2"]);
        $q3 = test_input($_POST["q3"]);
        $q4 = test_input($_POST["q4"]);
        $q5 = test_input($_POST["q5"]);
        $q6 = test_input($_POST["q6"]);
        $q7 = test_input($_POST["q7"]);
        $q8 = test_input($_POST["q8"]);
        $q9 = test_input($_POST["q9"]);
        $q10 = test_input($_POST["q10"]);
        $q11 = test_input($_POST["q11"]);
        $q12 = test_input($_POST["q12"]);
        $q13 = test_input($_POST["q13"]);
        $q14 = test_input($_POST["q14"]);
        $q15 = test_input($_POST["q15"]);
        $q16 = test_input($_POST["q16"]);


        $q1 = reverse_score($q1);
        $q2 = reverse_score($q2);
        $q4 = reverse_score($q4);
        $q6 = reverse_score($q6);
        $q9 = reverse_score($q9);
        $q10 = reverse_score($q10);
        $q12 = reverse_score($q12);
        $q14 = reverse_score($q14);

        $person_data = array(
                             "c_id"=>$c_id,
                             "organisation"=>$organisation,
                             "email"=>$email,
                             "fname"=>$fname,
                             "sname"=>$sname);
        
        $scores_data = array( $q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$q15,$q16);
        $score = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10 + $q11 + $q12 + $q13 + $q14 + $q15 + $q16;
        $rating = get_rating($score);
        $pdf_blob =  make_pdf($fname . " " . $sname, $score);
        save_map_form($person_data, $scores_data, $score, $pdf_blob);
        $mail_it = get_imed_mail($c_id);
        if ($mail_it['imed_reply'] == 1)    
        {
			send_email($email,"Result of Map questionnaire","Please find attached the result of your MAP questionnaire.",$pdf_blob);
		}
        
        //session_destroy();
        $smarty->assign('name', $fname . " " . $sname);
        $smarty->assign('emailed', $mail_it['imed_reply']);
        $smarty->display('saved_success.tpl');


    }
else
    {
        //error case
    }

?>
