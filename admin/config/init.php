<?php 
require_once dirname(__DIR__, 1).'/config/DBconfig.php';
require_once dirname(__DIR__, 2).'/config/LoginInfo.php';
require_once dirname(__DIR__, 2).'/config/Userrights.php';
require_once dirname(__DIR__, 2).'/config/CompanyInfo.php';
require_once dirname(__DIR__, 2).'/config/ProjectSetting.php';

$useragent=$_SERVER['HTTP_USER_AGENT'];

$DB= new DBconfig();
$LoginInfo = new LoginInfo();
$IISMethods = new IISMethods();
$config = new config();
$CompanyInfo = new CompanyInfo();

$CompanyInfo=$DB->getcompanyinfo($config->getDefaultCmpId(),'CompanyInfo')[0]; 

$ProjectSetting = new ProjectSetting();
$ProjectSetting = $DB->getsettingdata('ProjectSetting')[0];

$errmsg=$config->getErrmsg();
$serviceurl=$config->getEndpointurl();
session_start();


$headerparams=array_change_key_case(getallheaders(),CASE_LOWER);

//echo $LoginInfo->getUid().' ******* '.$LoginInfo->getUtypeid();
//exit;
//echo '<br><br><br><br><br><br>';
//print_r($_SESSION[$config->getSessionName()]);

if($_SESSION[$config->getSessionName()]!='')
{	
	$Userights = new Userrights();
    $LoginInfo=$_SESSION[$config->getSessionName()];
	//echo $LoginInfo->getUid().' ******* '.$LoginInfo->getUtypeid();
	$LoginInfo->setUserrights($DB->getuserright($LoginInfo->getUid(),$LoginInfo->getUtypeid(),$LoginInfo->getCmpid(),'Userrights'));
	//$LoginInfo->setdashUserrights($DB->getdashuserright($LoginInfo->getUid(),$LoginInfo->getUtypeid(),$LoginInfo->getCmpid(),'DashUserrights'));
	$_SESSION[$config->getSessionName()]=$LoginInfo;
	$rightstotalcount = $Userights->getCount();
}

$Pagerights = $IISMethods->getpageaccess($LoginInfo->getUserrights(),$IISMethods->getpagename());

function generateuuid()
{
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0C2f ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
	);
}


?>