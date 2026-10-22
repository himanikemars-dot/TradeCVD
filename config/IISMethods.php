<?php

//require_once (__DIR__.'/jwt/jwttoken.php');

class IISMethods
{

	public function __construct() {}

	function toString($string)
	{
		try {
			return strval($string);
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}

	function toInt($string)
	{
		try {
			return intval($string);
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}

	function toDouble($string)
	{
		try {
			return floatval($string);
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}


	function toDate()
	{
		try {
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}


	function toBoolean()
	{
		try {
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}

	function TitleCase($string, $type)
	{
		try {
			if ($type == 'U') {
				return strtoupper($string);
			} else if ($type == 'L') {
				return strtolower($string);
			}
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}

	function toSum($data)
	{
		try {
			$sum = 0;
			for ($i = 0; $i < count($data); $i++) {
				$sum = $sum + $data[$i];
			}
			return $sum;
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}

	function RandomOTP($limit)
	{
		try {
			$key = '';
			$keys = array_merge(range(0, 9));

			for ($i = 0; $i < $limit; $i++) {
				$key .= $keys[array_rand($keys)];
			}
			return $key;
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}

	function RandomString($limit)
	{
		try {
			$key = '';
			$keys = array_merge(range('A', 'Z'));

			for ($i = 0; $i < $limit; $i++) {
				$key .= $keys[array_rand($keys)];
			}
			return $key;
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}


	function sanitize($string, $type = 'IN')
	{
		try {
			if ($type == 'OUT') {
				//return htmlentities($string, ENT_QUOTES, 'UTF-8');
				return html_entity_decode($string);
			} else {
				return htmlentities($string, ENT_QUOTES, 'UTF-8');
			}
		} catch (Exception $e) {
			//die(print_r($e->getMessage()));
		}
	}


	function SendSMS($mobileno, $smstext)
	{
		$smstext = urlencode($smstext);
		if ($mobileno && $smstext) {
			//file_get_contents('http://sms.instanceit.in/SecureApi.aspx?usr=bizcompas&KEY=D2E8DE1F-DDEF-488F-AC93-88EC8AB3DB20&smstype=TextSMS&TO='.$mobileno.'&msg='.$smstext.'&rout=Transactional&FROM=BIZCOM');					
		}
	}

	function generateuuid()
	{
		$uuid = sprintf(
			'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0C2f) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0x2Aff),
			mt_rand(0, 0xffD3),
			mt_rand(0, 0xff4B)
		);

		$uuid = strtoupper($uuid);

		return $uuid;
	}

	function checkutypeexist($singleutype, $fullutype)
	{
		$arrstring = explode(',', $fullutype);
		if (in_array($singleutype, $arrstring)) {
			$isutypeexist = 1;
		} else {
			$isutypeexist = 0;
		}
		return $isutypeexist;
	}

	function getpageaccess($userrights, $pagename)
	{
		$neededObject = array_filter(
			$userrights,
			function ($e) use (&$pagename) {
				return $e->getFormname() == $pagename;
			}
		);
		//return reset($neededObject);

		if (sizeof($neededObject) > 0) {
			return reset($neededObject);
		} else {
			return $neededObject;
		}
	}


	function getdashpageaccess($userrights, $pagename)
	{
		$neededObject = array_filter(
			$userrights,
			function ($e) use (&$pagename) {
				return $e->getUniqname() == $pagename;
			}
		);

		if (sizeof($neededObject) > 0) {
			return reset($neededObject);
		} else {
			return $neededObject;
		}
	}



	//Upload All Files
	function uploadallfiles($type, $foldername, $filename, $tmpfilename, $unqid, &$uploadError = null) //$type = 1 for images and 2 for other files
	{

		$uploadError = '';
		$year = date('Y');
		$month = date('m');
		$time = time();

		$uploadDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'uploads';
		$allowedMimeTypes = array(
			"image/jpeg",
			"image/png",
			"image/gif",
			"image/webp",
			"application/pdf",
			"application/vnd.ms-excel",
			"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
			"image/svg",
			"image/svg+xml",
		);

		if (!is_file($tmpfilename) || !is_readable($tmpfilename)) {
			$uploadError = 'PHP temporary upload file is missing or unreadable.';
			return '';
		}

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		if ($finfo === false) {
			$uploadError = 'PHP fileinfo extension could not be initialized.';
			return '';
		}
		$mime = finfo_file($finfo, $tmpfilename);
		finfo_close($finfo);
		if ($mime === false) {
			$uploadError = 'Could not determine the uploaded file MIME type.';
			return '';
		}

		$checkfileextary = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'xls', 'xlsx','svg');
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$lowext = strtolower($ext);

		if (in_array($lowext, $checkfileextary)) {
			// Check if MIME type is valid for the allowed file types
			if (in_array($mime, $allowedMimeTypes)) {

				$uploadDirectory .= DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $foldername;
				if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0777, true) && !is_dir($uploadDirectory)) {
					$uploadError = 'Could not create upload directory. Check PHP write permissions for assets/uploads.';
					return '';
				}

				$imgFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

				//$imgfolderurl = $config->getImageurl().'uploads/'.$year.'/'.$month.'/'.$foldername.'/';

				$baseimgpath = 'uploads/' . $year . '/' . $month . '/' . $foldername;
				//$targetPath = '';
				$targetPath = 'uploads/' . $year . '/' . $month . '/' . $foldername . '/' . $foldername . $unqid . $time . '.' . $imgFileType;
				$targetFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $targetPath);
				$iscopyimg = 0;
				if ($iscopyimg == 1) {
					$uploadSuccess = copy($tmpfilename, $targetFile);
				} else {
					$uploadSuccess = move_uploaded_file($tmpfilename, $targetFile);
				}

				if (!$uploadSuccess) {
					$uploadError = 'Could not save the uploaded file. Check PHP write permissions for assets/uploads.';
					return '';
				}

				return $targetPath;
			} else {
				$uploadError = 'Unsupported uploaded MIME type: ' . $mime;
				return '';
			}
		} else {
			$uploadError = 'Unsupported file extension: ' . $lowext;
			return '';
		}
	}


	//Get Page Name
	function getpagename()
	{
		$rightpagename = basename($_SERVER['PHP_SELF']);

		// $rightpagename = $_SERVER['PHP_SELF'];
		// $pagename = explode("/",$rightpagename);

		// $pagename = $pagename[sizeof($pagename)-1];

		// $pagename = explode(".",$pagename);
		// $pagename = $pagename[sizeof($pagename)-2];


		$pagename = explode(".", $rightpagename);
		$pagename = $pagename[sizeof($pagename) - 2];

		return $pagename;
	}


	//Get Data From Curl
	function getcurl($url, $method = 'GET', $payload, $header)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_POSTFIELDS => $payload,
			CURLOPT_HTTPHEADER => $header
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$jsondata = json_decode($response, true);

		return $jsondata;
	}


	function getdatetime()
	{
		return date('Y-m-d H:i:s');
	}

	function getcurrdate()
	{
		return date('d/m/Y');
	}

	function getformatcurrdate()
	{
		return date('Y-m-d');
	}


	//--------------------------- Android Notification ----------------------------
	function androidnotification($deviceid, $message, $title, $clickaction, $notidata)
	{
		define('API_ACCESS_KEY', 'AAAAbh0eemo:APA91bGYpfWgqJWedivdG2nMGwtqYb37bVIIAvP7xaCX64EaaWjDRouX6gKvkJX7omdP1ayjRWP5_D9fv3T529lbGavOdvBEDGior_sqs9kCkxiJ-svVHnklITKYEKEf--nuxaexE9RM');


		$msg = array(
			'body' 	=> $message,
			'title'	=> $title,
			'click_action' => $clickaction,
			//'icon'	=> 'images/bell.png',
			'icon'	=> 'myicon',/*Default Icon*/
			'sound' => 'mySound'/*Default sound*/
		);

		/*	  
		$data = array
			(
				"clickflag" => $clickflag,
				"pagename"=>$pagename,
				"actionname"=>$actionname,
				"id" => $id,
			);
		*/

		$fields = array(
			'registration_ids' => $deviceid,
			'notification' => $msg,
			'data' => $notidata
		);
		$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);


		#Send Reponse To FireBase Server
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		//echo $result;
		curl_close($ch);
		//$data1 = json_encode( $fields );

		//print_r($data1);
	}

	function removecoupon($LoginInfo)
	{
		$IISMethods = new IISMethods();
		$config = new config();
		$LoginInfo = $_SESSION[$config->getSessionName()];

		$LoginInfo->setcouponapply(0);
		$LoginInfo->setcouponapply(0);
		$LoginInfo->setcouponid('');
		$LoginInfo->setcouponcode('');
		$LoginInfo->setcoupontype('');
		$LoginInfo->setcouponamount(0);


		return $LoginInfo;
	}
}
