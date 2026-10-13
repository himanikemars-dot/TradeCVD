<?php 

$key=$IISMethods->sanitize($headerparams['key']);
$unqkey=$IISMethods->sanitize($headerparams['unqkey']);
$iss=$IISMethods->sanitize($headerparams['iss']);
$uid =$IISMethods->sanitize($headerparams['uid']);

$responsetype=$IISMethods->sanitize($headerparams['responsetype']);
$userpagename=$IISMethods->sanitize($headerparams['userpagename']);
$useraction=$IISMethods->sanitize($headerparams['useraction']);
$masterlisting=$IISMethods->sanitize($headerparams['masterlisting']);
$curl=(int)$IISMethods->sanitize($headerparams['curl']);

$platform=$IISMethods->sanitize(4);
if($headerparams['platform'])
{
	$platform=$IISMethods->sanitize($headerparams['platform']);
}

//$response['test_useragent']=$useragent;

if($platform == 1)  //1-Admin Side
{
	$key=$LoginInfo->getKey();
	$unqkey=$LoginInfo->getUnqkey();
	$iss=$LoginInfo->getIss();
	$uid=$LoginInfo->getUid();
}
else if($platform == 4) //4-Website
{
	$key=$LoginInfo->getKey();
	$unqkey=$LoginInfo->getUnqkey();
	$iss=$LoginInfo->getIss();
	$uid=$LoginInfo->getUid();

	$persontype=1;
}
$action=$_POST['action'];
$entrydate=$IISMethods->getdatetime();



$formdataactionarr = array();

//echo $uid.'<br>'.$platform.'<br>'.$unqkey.'<br>'.$iss.'<br>'.$useragent.'<br>'.$key;
//exit;

//echo 'aaa-'.$useragent;


if($uid)
{
	//User Validate
	$isvalidUser=$DB->validateuser($uid,$platform,$key,$unqkey,$iss,$useragent,$userpagename,$useraction,$masterlisting,$action,$formdataactionarr);
	//echo '11';
	$status=$isvalidUser['status'];
	$message=$isvalidUser['message'];

}
else
{
	if($platform == 4)
	{
		$guestuserid = 'guestuser-'.session_id();
		$unqkey= $IISMethods->generateuuid();

		$iss='savanigems-website';
		$LoginInfo->setIss($iss);
		$LoginInfo->setUnqkey($unqkey);

		$key=$DB->getjwt($guestuserid,$unqkey,$iss,$useragent);
		
		if($key['status']==1)
		{

			$LoginInfo->setKey($key['token']);
			$LoginInfo->setUid($guestuserid);
			$LoginInfo->setUtypeid('00000000-0000-0000-0000-000000000000');
			$LoginInfo->setFullname('Guest User');
			$LoginInfo->setIsguestuser(1);

			$_SESSION[$config->getSessionName()]=$LoginInfo;

			$key=$IISMethods->sanitize($key['token']);
			$unqkey=$IISMethods->sanitize($unqkey);
			$iss=$IISMethods->sanitize($iss);
			$uid =$IISMethods->sanitize($guestuserid);

			//User Validate
			$isvalidUser=$DB->validateuser($guestuserid,$platform,$key,$unqkey,$iss,$useragent,$userpagename,$useraction,$masterlisting,$action,$formdataactionarr);
			// print_r($isvalidUser);
			$status=$isvalidUser['status'];
			$message=$isvalidUser['message'];
		}else
		{
			$status=-1;
			$message=$arr_msg['sessiontimeout'];
		}
	}
}

//list Data Use variable
$nextpage =(int)$IISMethods->sanitize($_POST['nextpage']);
$per_page = (int)$IISMethods->sanitize($_POST['perpage']);
if($platform == 2 || $platform == 3)
{
	$per_page = 20;
}
if(!$per_page)
{
	$per_page=20;
}
$page = (int)$IISMethods->sanitize($_POST['nextpage']);
$filter = $IISMethods->sanitize('%'.$_POST['filter'].'%','OUT');
$ordbycolumnname = $IISMethods->sanitize($_POST['ordbycolumnname']);
$ordby = $IISMethods->sanitize($_POST['ordby']);
$page -= 1;
$start = $page * $per_page;
$common_listdata=array();
?>

  