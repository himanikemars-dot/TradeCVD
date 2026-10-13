<?php 
// require_once 'config/init.php';
require_once dirname(__DIR__, 1).'/admin/config/init.php';

$qry="SELECT * FROM `tblusertypemaster`";
$res=getmenual($qry);
$num=$res->rowCount();


session_unset();
?>
   