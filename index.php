<?php
require_once("../../map/meta_config.php");
require_once("libs/funcs.php");
require_once("libs/questions.php");
$signed_in = false;
if (isset($_POST['c_id']))
    {
        $c_id =  $_POST['c_id'];
    }
if (isset($_GET['c_id']))
    {
        $c_id =  $_GET['c_id'];
        
    }


    
if (isset($c_id)) {

    echo("c_id=" . $c_id);
	$company = get_cid($c_id);
    echo("comp=" . $company);
	// clear out any existing session that may exist
    session_start();
    session_destroy();
    session_start();

    if ($company) {
        $_SESSION['signed_in'] = true;
        $signed_in = true;
        $_SESSION['c_id'] = $c_id;
    } else {
        $_SESSION['flash_error'] = "Invalid username or password";
        $_SESSION['signed_in'] = false;
        $signed_in = false;
        $_SESSION['username'] = null;

    }
}
        
if ($signed_in == true)
    {

        
    $smarty->assign('questions', $questions);
	$smarty->assign('answers', $answers);
    $smarty->assign('company', $company);
    $smarty->display('survey.tpl');
    }
else
    {
        $smarty->display('login.tpl');
}

?>
