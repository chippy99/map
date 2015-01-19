<?php

require_once("../../../map/meta_config.php");
require_once("../libs/admin_funcs.php");
require_once("../libs/mail.php");
require_once("../libs/questions.php");
require_once("vars.php");
require_once("../libs/graph.php");

require 'Base/src/base.php';
spl_autoload_register( array( 'ezcBase', 'autoload' ) );

//spl_autoload_register( array( 'ezcBase', 'autoload' ) );

if (isset($_GET["opt"])) 
    {
        $opt = htmlspecialchars($_GET["opt"]);
    }
else
    {
        $opt = '0';
    }

if (isset($_POST["Submit"]))
    {
        $sub_opt = $_POST["Submit"];
        switch ($sub_opt)
            {
            case "add_customer":
                $company_name = test_input($_POST["company_name"]);
                $email = test_input($_POST["email"]);
                $contact_name = test_input($_POST["contact_name"]);
                $imed_reply = test_input($_POST["imed_reply"]);
                if (isset($_POST['imed_reply']))
                {
					$imed_reply = true;
				}
				else
				{
					$imed_reply = false;
				}
                $passwd =  generate_password();
                save_customer($company_name, $email, $contact_name, $passwd, $imed_reply);

                break;

            case "edit_customer":
                $company_name = test_input($_POST["company_name"]);
                $email = test_input($_POST["email"]);
                $contact_name = test_input($_POST["contact_name"]);
                $passwd = test_input($_POST['password']);
                $id = test_input($_POST['id']);
                if (isset($_POST['imed_reply']))
                {
					$imed_reply = true;
				}
				else
				{
					$imed_reply = false;
				}
				
                
                update_customer($id, $company_name, $email, $contact_name, $passwd, $imed_reply);
                break;
                             
            
		case "edit_user":
			$first_name = test_input($_POST["first_name"]);			
			$last_name = test_input($_POST["last_name"]);
			$email = test_input($_POST["email"]);
			$org_id = test_input($_POST["org_id"]);
			$id = test_input($_POST["person_id"]);
			update_user($id, $first_name, $last_name, $email);
			header("Location: index.php?opt=user_list&id=" . $org_id);
			break;
		}
			
			
        
    }
    
if (isset($_POST["Invite"]))
{
	$company_name = test_input($_POST["company_name"]);
	$email = test_input($_POST["email"]);
	$contact_name = test_input($_POST["contact_name"]);
	$passwd = test_input($_POST['password']);
	$id = test_input($_POST['id']);
	$subject = "MAP questionnaire login details";
	$mess = return_message($passwd);
	mail_invite($email, $subject, $mess);
	$smarty->assign('message', $mess);
	$smarty->assign('email', $email);
	$smarty->display('invite_sent.tpl');
	$opt = 1;
}
			

if (($opt == "home") or ($opt == '0'))
    {
        $smarty->assign('mypath', $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
        $smarty->assign('cust', list_customers());
        $smarty->assign('opt', 'home');
        $smarty->display('home.tpl');
    }
elseif ($opt == "comp_add")
    {     
        //$smarty->display('home.tpl');
        $smarty->display('add_customer.tpl');
    }
elseif ($opt == "comp_list")
    {
        $cust_id = $_GET["id"];
        $data = get_customer($cust_id);
        $smarty->assign('cust_data', $data);
        $smarty->display('show_customer.tpl');
    }
elseif ($opt == "edit_cust")
    {
        $cust_id =  $_GET["id"];
        $data = get_customer($cust_id);
         $smarty->assign('cust_data', $data);
        $smarty->display('edit_customer.tpl');
    }
elseif ($opt == "edit_user")
    {
        $user_id =  $_GET["user_id"];
        $data = get_user($user_id);
         $smarty->assign('user_data', $data);
        $smarty->display('edit_user.tpl');
    }


elseif ($opt == "del_cust")
    {
        $cust_id =  $_GET["id"];
        delete_customer($cust_id);
		$smarty->assign('cust', list_customers());
		$smarty->assign('opt', 'home');
		$smarty->display('home.tpl');
    }
elseif ($opt == "del_user")
    {
        $user_id =  $_GET["id"];
		$cust_id = $_GET["c_id"];
        delete_user($user_id);
        $data = get_users($cust_id);

		$smarty->assign('user_data', $data);
        $data2 = get_customer($cust_id);
        $smarty->assign('cust_name', $data2['name']);
		$smarty->assign('cust_id', $cust_id);
        $smarty->display('show_users.tpl');
      
    }

elseif ($opt == "user_list")
    {
        $cust_id = $_GET["id"];
        $data = get_users($cust_id);
        
        $smarty->assign('user_data', $data);
        $data2 = get_customer($cust_id);
        $smarty->assign('cust_name', $data2['name']);
		$smarty->assign('cust_id', $cust_id);
        $smarty->display('show_users.tpl');
    }

elseif ($opt == "view_user_result")
    {
        $user_id = $_GET["user_id"];
        $user_data = get_user($user_id);
        $data = get_scores($user_id);
        $smarty->assign('data', $data);
        $bytes = $data['pdf_blob'];
        Header( "Content-type: application/pdf");
        //header("Content-length: ". strlen($bytes) );
        header("Content-Disposition: inline; filename=docname.pdf");
        print $bytes;
        //$smarty->display('show_user_pdf.tpl');
       
    }

elseif ($opt == "view_user_answers")
    {
        $user_id = $_GET["user_id"];
        $user_data = get_user($user_id);
        $company_data = get_customer($user_data['org_id']);
        $data = get_scores($user_id);
        $data['q1'] = reverse_score($data['q1']);
        $data['q2'] = reverse_score($data['q2']);
        $data['q4'] = reverse_score($data['q4']);
        $data['q6'] = reverse_score($data['q6']);
        $data['q9'] = reverse_score($data['q9']);
        $data['q10'] = reverse_score($data['q10']);
        $data['q12'] = reverse_score($data['q12']);
        $data['q14'] = reverse_score($data['q14']);
        $smarty->assign('data', $data);
        $smarty->assign('user_data', $user_data);
        $smarty->assign('company_data', $company_data);
        $smarty->assign('questions', $questions);
        $smarty->assign('answers', $answers);
        $smarty->display('survey_answers.tpl');
       
    }

elseif ($opt == "email_user_result")
    {
        $id = $_GET["user_id"];
        $user_data = get_user($id);
        $data = get_scores($id);
        send_email($user_data['email'],"Result of Map survey","Please find attached the result of your MAP survey.",$data['pdf_blob']);
        $smarty->assign('user_data', $user_data);
       
        $smarty->display('email_sent.tpl');
       
    }

elseif ($opt == "comp_graph")
    {
        $smarty->assign('cust', list_customers());
        $smarty->display('cust_graph_list.tpl');
    }
elseif ($opt == 'show_bar_graph')
    {
        $cust_id = $_GET["id"]; 
        $cust_details = get_customer($cust_id); 
        $data = cust_graph_data($cust_id);
        $cust_name = preg_replace('/\s+/', '', $cust_details['name']);
       
        make_bar_graph($data, $cust_name);
       
       

    }
        
?>


