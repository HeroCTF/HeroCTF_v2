<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
if(!isset($_SESSION)){ 
    session_save_path('./OhD4Sessions');
    session_start();
}
$PAGES = ['homepage.php','index.php','login.php','contact.php'];
if(!isset($_REQUEST['page']) or $_REQUEST['page'] === 'index.php' or empty($_REQUEST['page']) or $_REQUEST === 'homepage.php')
    $_REQUEST['page'] = 'homepage.php';
    if(!in_array($_REQUEST['page'],$PAGES) or !strpos($_REQUEST['page'],'sess')){
        $_SESSION['page'] = $_REQUEST['page'];     
    }                            

include $_REQUEST['page'];


$_SESSION['message'] = null;

?>
