<?php
/*

    INIT
    Basic configuration settings

*/

// connect to database
$server='localhost';
$user='root';
$pass='';
$db='shop';

$database=new mysqli($server,$user,$pass,$db);

// error reporting
mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors', 1);

// setup constants
define('SITE_NAME', 'Online Store');
define('SITE_PATH','http://shop/');
define('IMAGE_PATH','http://shop/resources/images/');

// create objects
include('app/models/m_template.php');
$template= new Template();

session_start();