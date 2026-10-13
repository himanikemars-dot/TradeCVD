<?php 
// $response['key']=(string)$isvalidUser['key'];
// $response['unqkey']=(string)$isvalidUser['unqkey'];
// if($platform==1 && $isvalidUser['key']!='' && $isvalidUser['unqkey']!=''){ //for web
// 	$LoginInfo->setKey((string)$isvalidUser['key']);
// 	$LoginInfo->setUnqkey((string)$isvalidUser['unqkey']);
// }
// $response['url'] = (string)$targeturl;
// $response['message'] = $message;
// $response['status'] = $status;
// // print_r($response);
// $json_response = json_encode($response);
// // print_r($json_response);
// echo "$json_response";  


$response['key']=(string)$isvalidUser['key'];
$response['unqkey']=(string)$isvalidUser['unqkey'];

if($platform==1 && $isvalidUser['key']!='' && $isvalidUser['unqkey']!='')
{ //for web
	$LoginInfo->setKey((string)$isvalidUser['key']);
	$LoginInfo->setUnqkey((string)$isvalidUser['unqkey']);
}

/**------------------------------------Pagenation------------------------------------- */
$response['nextpage']=$nextpage;
$showdata=0;
$showentries=0;
$totallistdatacount=0;
if($common_listdata)
{
	if(sizeof($common_listdata)==$per_page)
	{ 
		$showdata=1; 
		$showentries=($nextpage*$per_page);
	}
	else
	{ 
		$showdata=0; 
		$showentries=(($nextpage-1)*($per_page))+ sizeof($common_listdata); 
	}
	$totallistdatacount=count($common_listdata);
	// echo $totallistdatacount;
}
else
{
	$showdata=0; 
	$showentries=(($nextpage-1)*($per_page)); 
}

$response['loadmore']=$showdata;
$response['datasize']=$totallistdatacount;
$response['showentries']=$showentries;
/**------------------------------------Pagenation------------------------------------- */

$response['url'] = (string)$targeturl;
$response['message'] = $message;
$response['status'] = $status;
// print_r($response);
$json_response = json_encode($response);
// print_r($json_response);
echo "$json_response";  
?>

  