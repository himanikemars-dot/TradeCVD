<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';

$phpself = $_POST['phpself'];
$mastertype = $_POST['mastertype'];
if($phpself){
	$redirecturl=$config->getWeburl().'lock-screen?session=timeout&targeturl='.$phpself.'&type='.$mastertype;
}else{
	$redirecturl=$config->getWeburl().'';
}
//if($isvalidUser['status'] == 1) 
//{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='logout')
	{
		if($platform==1)  //For Admin Panel
		{
			session_unset();
		}
		else if($platform==2 || $platform==3) //For Application
		{
			$macaddress = $IISMethods->sanitize($_POST['macaddress']);
			$os=$IISMethods->sanitize($_POST['os']);
		}

		$ary=array(
			'isvalid'=>0,
			'update_date'=>$IISMethods->getdatetime(),
		);
		$extra = array(
			'unqkey'=>$unqkey,
			'uid'=>$uid,
			'iss'=>$iss,
			'useragent'=>$useragent,
		);
		$DB->executedata('u','tblexpiry',$ary,$extra);

		if($platform==2 || $platform==3)  //For Application
		{
			$extraparams=array(
				'macaddress'=>$macaddress,
				'os'=>$os
			);
			$DB->executedata('d','tbldevice','',$extraparams);
		}

		$status=1;
		$message=$errmsg['logoutsuccess'];		
	}
//}
$response['redirecturl'] = $redirecturl;
$response['message'] = $message;
$response['status'] = $status;
$json_response = json_encode($response);
echo "$json_response";    
?>

  