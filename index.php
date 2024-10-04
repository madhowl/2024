<?php
// --------- display all errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// --------------


//include_once './inc/function.php';
require('vendor/autoload.php');

$front = new \App\Controllers\FrontEndController();
$front->index();




