<?php
require_once("../../map/meta_config.php");
require_once("libs/funcs.php");
$signed_in = false;
if (isset($_POST['c_id']))
    {
        $c_id =  $_POST['c_id'];
    }
if (isset($_GET['c_id']))
    {
        $c_id =  $_GET['c_id'];
        echo("hi");
    }


    
if (isset($c_id)) {

   
    $company = get_cid($c_id);
   
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

        $questions=array("People can only have a certain amount of intelligence.",
                     "Intelligence is innate and can't change very much.",
                     "You can significantly change a persons' intelligence level.",
                     "To be honest, you can't really change how intelligent a person is.",
                     "You can always substantially change how intelligent you are.",
                     "People can learn new things, but you can't really change their basic intelligence.",
                     "No matter how much intelligence a person has, you can always change it quite a lot.",
                     "People can change even their basic intelligence level considerably.",
                     "People have a certain amount of talent, and you can't really do much to change it.",
                     "Talent in an area is something about a person that cannot be changed very much.",
                     "No matter who you are, you can significantly change the level of talent a person has.",
                     "You cannot really change how much talent a person has.",
                     "You can always substantially change how much talent a person has.",
                     "You can learn new things, but you can't really change your basic level of talent",
                     "No matter how much talent a person has, you can always change it a small amount",
                     "You can change even your basic level of talent considerably");

    $smarty->assign('questions', $questions);
    $smarty->assign('company', $company);
    $smarty->display('survey.tpl');
    }
else
    {
        $smarty->display('login.tpl');
}

?>
