<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/stripe/stripe-php/init.php';
require_once 'IISMethods.php';
require_once dirname(__DIR__, 1) . '/vendor_2/autoload.php';

// require_once __DIR__.'/vendor/Classes/PHPExcel.php';
// require_once __DIR__.'/vendor/Classes/PHPExcel/IOFactory.php';
// require_once('/vendor/stripe/stripe-php/init.php');
// require  __DIR__ ,1 .'/vendor_2/autoload.php';


require_once 'phpmailer.php';
error_reporting(1);
// use \Stripe\Stripe;
use \Firebase\JWT\JWT;

$config = new config();
\Stripe\Stripe::setApiKey($config->getPaymentApiKey());
$privateKey = file_get_contents(__DIR__ . '/jwt-token-keys/private_sg.pem');
$publicKey = file_get_contents(__DIR__ . '/jwt-token-keys/public_sg.pem');

// ini_set('display_errors', 1);
// error_reporting(E_ALL);
class DB
{

	private $DBName;
	private $DBUser;
	private $DBHost;
	private $DBPass;
	private $DBPort;
	private $DBConn;
	private $DBType;
	private $errmsg;

	public function Connect()
	{
		$config = new config();
		$errmsg = $config->getErrmsg();
		try {
			if ($this->DBType == 'MSSQL') {
				$this->DBConn = new PDO("sqlsrv:Server=" . $this->DBHost . "," . $this->DBPort . ";Database=" . $this->DBName, $this->DBUser, $this->DBPass);
				$this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} else if ($this->DBType == 'MYSQL') {

				$this->DBConn = new PDO("mysql:host=" . $this->DBHost . ";port=" . $this->DBPort . ";dbname=" . $this->DBName, $this->DBUser, $this->DBPass);
			}
		} catch (Exception $e) {
			die(print_r($e->getMessage()));
		}
	}

	public function begintransaction()
	{
		$this->DBConn->beginTransaction();
	}

	public function committransaction()
	{
		$this->DBConn->commit();
	}

	public function rollbacktransaction($e)
	{
		$config = new config();
		$errmsg = $config->getErrmsg();
		$this->DBConn->rollback();
		$errorcode = 0;
		if ($this->DBType == 'MYSQL') // MYSQL DATABSE
		{
			$errorcode = $e->getCode();
		} else if ($this->DBType == 'MSSQL') // MSSQL DATABSE
		{
			$errorcode = $e->errorInfo[1];
		}
		$dberrmsg = $errmsg['dberror'] . $errorcode;
		return $dberrmsg;
	}


	function puthistory($LoginInfo, $headerparams = array())
	{

		$config = new config();
		$IISMethods = new IISMethods();
		/*-------------Start History Table data insert ------------- */
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$logdatetime = $IISMethods->getdatetime();
		$url = $_SERVER['PHP_SELF'];
		$uid =  $LoginInfo->getUid();

		$Seesion_Data = json_encode($_SESSION[$config->getSessionName()], 2);
		if ($headerparams['uid'] != '') {
			$uid = $headerparams['uid'];
			$Seesion_Data = json_encode($headerparams, true);
		}

		$hdata = '';
		foreach ($_REQUEST as $key => $value)
			$hdata .= htmlspecialchars($key) . "|" . htmlspecialchars((string)$value) . ",";

		$unqid = $IISMethods->generateuuid();
		$data = array(
			'id' => $unqid,
			'ipaddress' => $ipaddress,
			'platform' => $useragent,
			'datetime' => $logdatetime,
			'data' => $hdata,
			'url' => $url,
			'uid' => $uid,
			'session' => $Seesion_Data,
		);

		$datakeys = implode(', ', array_map(
			function ($v, $k) {
				return $k;
			},
			$data,
			array_keys($data)
		));

		$dataval = implode(', ', array_map(
			function ($v, $k) {
				return ':' . $k;
			},
			$data,
			array_keys($data)
		));

		$strsql = "INSERT INTO tblhistory ($datakeys) VALUES ($dataval)";

		$this->DBConn->prepare($strsql)->execute($data);

		/*-------------End History Table data insert ------------- */
	}



	function executedata($operation, $tblname, $data1, $extra = array()) // $operation=i,u,d  $tblname=table name    $data=array of data  $extra= extra id parameter with value, 
	{

		$data = is_array($data1) ? $data1 : array();
		$mainary = array();
		if ($this->DBType == 'MYSQL') // MYSQL DATABSE
		{


			//create schema query
			$qryschema = "SELECT EXTRA,COLUMN_NAME,ORDINAL_POSITION,COLUMN_DEFAULT,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,IFNULL(COLUMN_DEFAULT,'') AS DEFAULT_DATA
			FROM information_schema.columns 
			WHERE table_schema = ? AND table_name =? AND EXTRA<>?";

			/********************************************* */
			$result = $this->DBConn->prepare($qryschema);
			$result->execute(array($this->DBName, $tblname, 'auto_increment'));

			while ($row = $result->fetch())  // loop of columns of given table
			{
				if (array_key_exists($row['COLUMN_NAME'], $data)) // check if columns is exist in our array
				{
					$mainary[$row['COLUMN_NAME']] = $data[$row['COLUMN_NAME']];
					if ($row['CHARACTER_MAXIMUM_LENGTH'] > 0) //check if column has maximum length
					{
						$mainary[$row['COLUMN_NAME']] = substr($data[$row['COLUMN_NAME']], 0, $row['CHARACTER_MAXIMUM_LENGTH']);  // get only maximum length data
					}
				} else {
					if ($row['DEFAULT_DATA']) // check if column has default value
					{
						$mainary[$row['COLUMN_NAME']] = $row['DEFAULT_DATA'];
					} else {
						$mainary[$row['COLUMN_NAME']] = $mysqldefaultvalue[$row['DATA_TYPE']];
					}
				}
			}
		} else  if ($this->DBType == 'MSSQL') // MSSQL DATABASE
		{


			$excludedatatype = "timestamp,varbinary,hierarchyid,image,binary,geography,geometry";  //exclude these data type from schema query
			$excludedatatype = explode(',', $excludedatatype); // string to array
			$placeholders = rtrim(str_repeat('?, ', count($excludedatatype)), ', '); // create ? string
			array_unshift($excludedatatype, str_replace('[', '', str_replace(']', '', $tblname))); //  push $tblname in $excludedatatype array in 0th position
			array_unshift($excludedatatype, str_replace('[', '', str_replace(']', '', $tblname))); //  push $tblname in $excludedatatype array in 0th position

			//create schema query
			$qryschema = "select '['+c.COLUMN_NAME+']' as columnname,c.ORDINAL_POSITION,c.COLUMN_DEFAULT,c.IS_NULLABLE,c.DATA_TYPE,c.CHARACTER_MAXIMUM_LENGTH,IFNULL(c.COLUMN_DEFAULT,'') as DEFAULT_DATA 
		from INFORMATION_SCHEMA.COLUMNS c 
		INNER JOIN sys.columns s on OBJECT_NAME(s.object_id) = ? AND s.name=c.COLUMN_NAME
		where c.TABLE_NAME=? AND s.is_computed=0 AND s.is_identity=0 AND c.DATA_TYPE NOT IN ($placeholders)";

			$result = $this->DBConn->prepare($qryschema);
			$result->execute($excludedatatype);

			while ($row = $result->fetch())  // loop of columns of given table
			{

				$COLUMN_NAME = $row['columnname'];
				if (strpos($COLUMN_NAME, '[') !== true) {
					//$COLUMN_NAME='['.$COLUMN_NAME.']';
				}

				if (array_key_exists($COLUMN_NAME, $data)) // check if columns is exist in our array
				{
					$mainary[$COLUMN_NAME] = $data[$COLUMN_NAME];
					if ($row['CHARACTER_MAXIMUM_LENGTH'] > 0) //check if column has maximum length
					{
						$mainary[$COLUMN_NAME] = substr($data[$COLUMN_NAME], 0, $row['CHARACTER_MAXIMUM_LENGTH']);  // get only maximum length data
					}
				} else {
					/*
				if($row['DEFAULT_DATA']) // check if column has default value
				{
					$mainary[$COLUMN_NAME]=$row['DEFAULT_DATA'];
				}
				else
				{
					$mainary[$COLUMN_NAME]=$sqldefaultvalue[$row['DATA_TYPE']];
				}
				*/

					if ($row['IS_NULLABLE'] == 'NO' && $row['DEFAULT_DATA'] == '') // check if column has allow null value
					{
						$mainary[$COLUMN_NAME] = $sqldefaultvalue[$row['DATA_TYPE']];
					} else if ($row['IS_NULLABLE'] == 'NO' && $row['DEFAULT_DATA'] != '') {
						$mainary[$COLUMN_NAME] = $row['DEFAULT_DATA'];
					} else if ($row['IS_NULLABLE'] == 'YES' && $row['DEFAULT_DATA'] != '') {
						//$mainary[$COLUMN_NAME]=$row['DEFAULT_DATA'];
					}
				}
			}
		}
		//return $mainary;	

		$datakeys = implode(', ', array_map(
			function ($v, $k) {
				return $k;
			},
			$mainary,
			array_keys($mainary)
		));


		$dataval = implode(', ', array_map(
			function ($v, $k) {
				return ':' . $k;
			},
			$mainary,
			array_keys($mainary)
		));

		$updatedata = implode(', ', array_map(
			function ($v, $k) {
				return $k . "=?";
			},
			$data,
			array_keys($data)
		));

		if ($operation == 'u' || $operation == 'd') {
			$updatedatacond = implode(' AND ', array_map(
				function ($v, $k) {
					return $k . "=?";
				},
				$extra,
				array_keys($extra)
			));
		}

		$ques = str_repeat('?,', sizeof($mainary)); //create string like '?,?,?,?,?' as per array length for insert values
		$ques = rtrim($ques, ',');
		$newdata = array_values($mainary); // create only values array from associative array
		$sql = "";

		//print_r($updatedatacond);

		if ($operation == 'i') {
			$sql = "INSERT INTO $tblname ($datakeys) VALUES ($ques)";
		} else if ($operation == 'u') {
			$maindata = array_values($data);

			$datacond = array_values($extra);
			$newdata = array_merge($maindata, $datacond);

			$mainary = array_merge($data, $extra);
			//print_R($newdata);
			$sql = "UPDATE $tblname SET $updatedata WHERE $updatedatacond";

			//print_r($mainary);
		} else if ($operation == 'd') {
			$sql = "DELETE FROM $tblname WHERE $updatedatacond";
			$newdata = array_values($extra);
			$mainary = array();
		}

		try {

			$this->DBConn->prepare($sql)->execute($newdata);
			//return $tblname;
			self::insertlogdata($tblname, $sql, $mainary, $operation, '', '');
		} catch (PDOException $e) {

			//return $e;
			$errorcode = 0;
			if ($this->DBType == 'MYSQL') // MYSQL DATABSE
			{
				$errorcode = $e->getCode();
			} else if ($this->DBType == 'MSSQL') // MSSQL DATABSE
			{
				$errorcode = $e->errorInfo[1];
			}
			$dberrmsg = $errmsg['dberror'] . $errorcode;

			self::insertlogdata($tblname, $sql, $mainary, $operation, $errorcode, $e->getMessage());
			throw $e;
			//return $dberrmsg;

		}
	}

	public function insertlogdata($tblname, $sql, $data, $operation, $errorcode, $errormsg)
	{

		//insert data into log table
		$IISMethods = new IISMethods();
		$pagename = explode("/", $_SERVER['PHP_SELF']);
		$cnt = count($pagename) - 1;
		$page = $pagename[$cnt];

		$logdatetime = $IISMethods->getdatetime();
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$ipaddress = $_SERVER['REMOTE_ADDR'];

		$logsql = "INSERT INTO tbllog (id, tblname, strquery, operation,errorcode,errormsg, pagename, platform, ipaddress, username, logdatetime,sessionary) VALUES (:id,:tblname,:strquery,:operation,:errorcode,:errormsg,:pagename,:platform,:ipaddress,:username,:logdatetime,:sessionary)";

		$unqid = $IISMethods->generateuuid();
		$logdata = array(
			'id' => $unqid,
			'tblname' => (string)$tblname,
			'strquery' => $sql . ' | ' . json_encode($data),
			'operation' => (string)$operation,
			'errorcode' => (string)$errorcode,
			'errormsg' => (string)$errormsg,
			'pagename' => (string)$page,
			'platform' => (string)$useragent,
			'ipaddress' => (string)$ipaddress,
			'username' => '', // put username from session
			'logdatetime' => $logdatetime,
			'sessionary' => '', // Put Session Array
		);


		$this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$this->DBConn->prepare($logsql)->execute($logdata);

		//Insert Error Data
		if ($errorcode != '') {
			$logsql = "INSERT INTO tblcruderrorlog (id, tblname, strquery, operation,errorcode,errormsg, pagename, platform, ipaddress, username, logdatetime,sessionary) VALUES (:id,:tblname,:strquery,:operation,:errorcode,:errormsg,:pagename,:platform,:ipaddress,:username,:logdatetime,:sessionary)";

			$unqid = $IISMethods->generateuuid();
			$logdata = array(
				'id' => $unqid,
				'tblname' => (string)$tblname,
				'strquery' => $sql . ' | ' . json_encode($data),
				'operation' => (string)$operation,
				'errorcode' => (string)$errorcode,
				'errormsg' => (string)$errormsg,
				'pagename' => (string)$page,
				'platform' => (string)$useragent,
				'ipaddress' => (string)$ipaddress,
				'username' => '',
				'logdatetime' => $logdatetime,
				'sessionary' => '',
			);
			//print_r($logsql);
			$this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$this->DBConn->prepare($logsql)->execute($logdata);
		}
	}

	function getmenual($str, $params = array(), $class = null)
	{

		if (($this->DBType == 'MYSQL')) // mysql database
		{
			$this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$result = $this->DBConn->prepare($str);
			$result->execute($params);
			if ($class) {
				$result_ary = $result->fetchAll(PDO::FETCH_CLASS, $class);
			} else {
				$result_ary = $result->fetchAll();
			}
			return $result_ary;
		} else if ($this->DBType == 'MSSQL') {
			$result = $this->DBConn->prepare($str);
			$result->execute($params);
			if ($class) {
				$result_ary = $result->fetchAll(PDO::FETCH_CLASS, $class);
			} else {
				$result_ary = $result->fetchAll();
			}
			return $result_ary;
		}
	}



	function getautoid($tblname)
	{

		if ($this->DBType == 'MSSQL') {
			//SELECT IDENT_CURRENT('table_name')+1; 

			$str = "SELECT IDENT_CURRENT('$tblname') as Auto_increment,(Select count(*) from $tblname) as cnt; ";
			$result = $this->DBConn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$result->execute();
			$row = $result->fetch();
			if ($row['Auto_increment'] == '1' && $row['cnt'] == 0) {
				return $row['Auto_increment'];
			} else {
				return $row['Auto_increment'] + 1;
			}
		} else if ($this->DBType == 'MYSQL') {
			$str = "SHOW TABLE STATUS WHERE `Name` = '$tblname'";
			$result = $this->DBConn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$result->execute();
			$row = $result->fetch();
			return $row['Auto_increment'];
		}
	}


	function getjwt($uid, $unqkey, $iss, $useragent, $expmin = 120)
	{
		global $privateKey;
		$IISMethods = new IISMethods();
		$resp = array();
		$status = 0;
		$token = '';

		if ($iss && $uid && $unqkey && $iss && $useragent) {
			$issuedAt   = new DateTimeImmutable();
			$expire     = $issuedAt->modify('+' . $expmin . ' minutes')->getTimestamp();

			$payload = [
				'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
				'iss'  => $iss,                       // Issuer
				'nbf'  => $issuedAt->getTimestamp(),         // Not before
				'exp'  => $expire,                           // Expire
				'uid' => $uid,                     // unique identifier
				'unqkey' => $unqkey,
				'useragent' => $useragent							//unqkey
			];
			//print_r($payload);
			$token = JWT::encode($payload, $privateKey, 'RS256');

			$unqid = $IISMethods->generateuuid();
			$unq_ary = array(
				'id' => $unqid,
				'unqkey' => $unqkey,
				'uid' => $uid,
				'iss' => $iss,
				'useragent' => $useragent,
				'exp' => $expire,
				'timestamp' => $IISMethods->getdatetime(),
				'entry_date' => $IISMethods->getdatetime(),
				'isvalid' => 1
			);
			$this->executedata('i', 'tblexpiry', $unq_ary, '');
			$status = 1;
		}

		$resp['status'] = $status;
		$resp['token'] = $token;
		return $resp;
	}

	function validatejwt($token, $uid, $unqkey, $iss, $useragent)
	{
		global $publicKey;

		$resp = array();
		$status = 0;
		$config = new config();
		$errmsg = $config->getErrmsg();

		try {
			$decoded = JWT::decode($token, $publicKey, ['RS256']);
			$decoded_array = (array) $decoded;


			if ($decoded_array['iss'] == $iss && $decoded_array['uid'] == $uid  && $decoded_array['unqkey'] == $unqkey) {
				//  and useragent=:useragent
				$qrychk = "SELECT id from tblexpiry where unqkey=:unqkey and uid=:uid and iss=:iss and isvalid=:isvalid";
				$parms = array(
					':unqkey' => $unqkey,
					':uid' => $uid,
					':iss' => $iss,
					//':useragent'=>$useragent,
					':isvalid' => 1,
				);
				$result_ary = $this->getmenual($qrychk, $parms);

				if (sizeof($result_ary) > 0) {
					$status = 1;
					$msg = $errmsg['tokenvalidate'];
				} else {
					$status = -1;
					$msg = $errmsg['invalidtoken'];
				}
			} else {
				$msg = $errmsg['invalidtoken'];
			}
		} catch (\Firebase\JWT\ExpiredException $e) {
			$msg = $e->getMessage();
			$issuedAt   = new DateTimeImmutable();
			//Generate For New Token  (1 : Generate New Token, -1 : Logoup App)
			$IISMethods = new IISMethods();
			// $unqkey = IISMethods::generateuuid();
			$unqkey = $IISMethods->generateuuid();
			$key = $this->getjwt($uid, $unqkey, $iss, $useragent);
			$token = '';
			$status = 0;
			if ($key['status'] == 1) {
				$token = $key['token'];
				$status = 1;
				$msg = '';
			} else {
				$msg = $errmsg['invalidtoken'];
			}
			$resp['unqkey'] = $unqkey;
			$resp['key'] = $token;
		} catch (Exception $e) {

			$msg = $e->getMessage();
			$status = -1;
		}

		$resp['status'] = $status;
		$resp['message'] = $msg;

		return $resp;
	}


	function validateuser($auid, $platform, $key, $unqkey, $iss, $useragent, $userpagename, $useraction, $masterlisting, $action, $formdataactionarr)
	{
		$config = new config();
		$IISMethods = new IISMethods();

		$errmsg = $config->getErrmsg();

		$checkuser = array();

		$iskeycheck = $this->validatejwt($key, $auid, $unqkey, $iss, $useragent);

		$status = $iskeycheck['status'];
		$message = $iskeycheck['message'];

		// print_r($iskeycheck);

		if ($iskeycheck['status'] == 1) {
			// echo $auid;
			if (strpos($auid, 'guestuser') !== false)  //For Website User Without login //&& (strpos($action, 'list') !== false || in_array($action,$formdataactionarr))
			{
				$checkuser['status'] = 1;
				$checkuser['message'] = $errmsg['uservalidate'];
			} else {
				$str = "select pm.*,
				IFNULL((SELECT GROUP_CONCAT(DISTINCT pu.utypeid) FROM tblpersonutype pu WHERE pu.pid=pm.id),'') AS usertypeid
				from tblpersonmaster pm 
				where pm.id='$auid' and pm.isactive=1";
				$result = $this->DBConn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
				$result->execute();
				$row = $result->fetch();
				if ($row['isactive'] == 1) {

					if (($userpagename && $useraction) || $masterlisting == 'true') {
						//if($IISMethods->checkutypeexist($config->getAdminutype(),$row['usertypeid'])==0 || strpos($action, 'list') === false || !in_array($action,$formdataactionarr))
						if ($IISMethods->checkutypeexist($config->getAdminutype(), $row['usertypeid']) == 0) {
							$usertypeid = $row['usertypeid'];

							$qryright = "SELECT formname,formnametext,
							CASE WHEN(SUM(viewright)=0) THEN 0 ELSE 1 END AS viewright,
							CASE WHEN(SUM(allviewright)=0) THEN 0 ELSE 1 END AS allviewright,
							CASE WHEN(SUM(selfviewright)=0) THEN 0 ELSE 1 END AS selfviewright,
							CASE WHEN(SUM(addright)=0) THEN 0 ELSE 1 END AS addright,
							CASE WHEN(SUM(alladdright)=0) THEN 0 ELSE 1 END AS alladdright,
							CASE WHEN(SUM(selfaddright)=0) THEN 0 ELSE 1 END AS selfaddright, 
							CASE WHEN(SUM(editright)=0) THEN 0 ELSE 1 END AS editright, 
							CASE WHEN(SUM(alleditright)=0) THEN 0 ELSE 1 END AS alleditright,
							CASE WHEN(SUM(selfeditright)=0) THEN 0 ELSE 1 END AS selfeditright,
							CASE WHEN(SUM(delright)=0) THEN 0 ELSE 1 END AS delright, 
							CASE WHEN(SUM(alldelright)=0) THEN 0 ELSE 1 END AS alldelright,
							CASE WHEN(SUM(selfdelright)=0) THEN 0 ELSE 1 END AS selfdelright,
							CASE WHEN(SUM(printright)=0) THEN 0 ELSE 1 END AS printright,
							CASE WHEN(SUM(allprintright)=0) THEN 0 ELSE 1 END AS allprintright,
							CASE WHEN(SUM(selfprintright)=0) THEN 0 ELSE 1 END AS selfprintright,
							CASE WHEN(SUM(requestright)=0) THEN 0 ELSE 1 END AS requestright,
							CASE WHEN(SUM(changepriceright)=0) THEN 0 ELSE 1 END AS changepriceright from tbluserrights 
							where formname='$userpagename' ";

							/*if(sizeof($reschk)>0)
						{
							$qryright.=" personid='$auid'";
						}	
						else
						{
							$qryright.=" usertypeid IN ('$usertypeid') AND personid =''0''";
						}*/

							$qryright .= " group by formname,formnametext";
							$resright = $this->DBConn->prepare($qryright, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
							$resright->execute();
							$rowright = $resright->fetch();

							if ($rowright[$useraction] == 1 || $masterlisting == true) {
								$checkuser['status'] = 1;
								$checkuser['message'] = $errmsg['uservalidate'];
							} else {
								$checkuser['status'] = 0;
								$checkuser['message'] = $errmsg['userright'];
							}
						} else {
							$checkuser['status'] = 1;
							$checkuser['message'] = $errmsg['uservalidate'];
						}
					} else {

						$checkuser['status'] = 1;
						$checkuser['message'] = $errmsg['uservalidate'];
					}
				} else {
					$checkuser['status'] = 0;
					$checkuser['message'] = $errmsg['deactivate'];
				}
			}
		} else {
			$checkuser['status'] = 0;
			$checkuser['message'] = $errmsg['error'];
		}

		// print_r($checkuser);

		return $checkuser;
	}

	function getdatafromsp($spname, $parms = [], $class = null)
	{
		$strparams = implode(',', array_map(
			function ($v, $k) {
				return "'" . $v . "'";
			},
			$parms,
			array_keys($parms)
		));


		$str = 'CALL ' . $spname . '(' . $strparams . ')';
		$result = $this->DBConn->prepare($str);
		$result->execute();
		if ($class) {
			$result_ary = $result->fetchAll(PDO::FETCH_CLASS, $class);
		} else {
			$result_ary = $result->fetchAll();
		}
		return $result_ary;
	}


	function getuserright($uid, $usertype, $cmpid = '0', $class = null)
	{
		$config = new config();
		$IISMethods = new IISMethods();
		$LoginInfo = new LoginInfo();
		$qrychk = "SELECT id from tbluserrights where personid=:personid ";
		$parms = array(
			':personid' => $uid,
		);
		// print_r($parms);
		$result_ary = self::getmenual($qrychk, $parms);

		//echo 'UID : '.$uid.' | Admin UID : '.$config->getAdminUserId();
		//exit;
		if ($uid == $config->getAdminUserId()) {
			$parms = array();
			$result_ary = self::getmenual('SELECT alias as formname,textname as formnametext,1 as viewright,1 as addright,1 as editright,1 as delright ,1 as printright,1 as requestright,1 as changepriceright from tblmenuassign where menutypeid=1', $parms, $class);
		} else {
			$usertypeidarr = explode(",", $usertype);

			$qryrgh = "SELECT 
				formname,formnametext,
				CASE WHEN(SUM(viewright)=0) THEN 0 ELSE 1 END AS viewright,
				CASE WHEN(SUM(allviewright)=0) THEN 0 ELSE 1 END AS allviewright,
				CASE WHEN(SUM(selfviewright)=0) THEN 0 ELSE 1 END AS selfviewright,
				CASE WHEN(SUM(addright)=0) THEN 0 ELSE 1 END AS addright,
				CASE WHEN(SUM(alladdright)=0) THEN 0 ELSE 1 END AS alladdright,
				CASE WHEN(SUM(selfaddright)=0) THEN 0 ELSE 1 END AS selfaddright, 
				CASE WHEN(SUM(editright)=0) THEN 0 ELSE 1 END AS editright, 
				CASE WHEN(SUM(alleditright)=0) THEN 0 ELSE 1 END AS alleditright,
				CASE WHEN(SUM(selfeditright)=0) THEN 0 ELSE 1 END AS selfeditright,
				CASE WHEN(SUM(delright)=0) THEN 0 ELSE 1 END AS delright, 
				CASE WHEN(SUM(alldelright)=0) THEN 0 ELSE 1 END AS alldelright,
				CASE WHEN(SUM(selfdelright)=0) THEN 0 ELSE 1 END AS selfdelright,
				CASE WHEN(SUM(printright)=0) THEN 0 ELSE 1 END AS printright,
				CASE WHEN(SUM(allprintright)=0) THEN 0 ELSE 1 END AS allprintright,
				CASE WHEN(SUM(selfprintright)=0) THEN 0 ELSE 1 END AS selfprintright,
				CASE WHEN(SUM(requestright)=0) THEN 0 ELSE 1 END AS requestright,
				CASE WHEN(SUM(changepriceright)=0) THEN 0 ELSE 1 END AS changepriceright
				from tbluserrights ";

			if (sizeof($result_ary) > 0) {
				$parms = array();
				$qryrgh .= " where personid ='$uid'";
			} else {
				$parms = array_combine(
					array_map(function ($i) {
						return ':id' . $i;
					}, array_keys($usertypeidarr)),
					$usertypeidarr
				);
				$usertypeidkey = implode(',', array_keys($parms));

				$qryrgh .= " where usertypeid IN ($usertypeidkey) AND personid =''";
				// $qryrgh.=" where usertypeid IN ('$usertype') AND personid ='' "; 
			}
			$qryrgh .= " group by formname,formnametext";


			$qryrgh .= " UNION ALL ";

			$qryrgh .= "SELECT alias AS formname,textname AS formnametext,
				0 AS viewright,0 AS allviewright,0 AS selfviewright,
				0 AS addright,0 AS alladdright,0 AS selfaddright,
				0 AS editright,0 AS alleditright,0 AS selfeditright,
				0 AS delright,0 AS alldelright,0 AS addright,
				0 AS printright,0 AS allprintright,0 AS selfprintright,
				0 AS requestright,
				0 AS changepriceright 
				FROM tblmenuassign";


			if (sizeof($result_ary) > 0) {
				$qryrgh .= " where alias NOT IN ( SELECT formname FROM tbluserrights WHERE personid ='$uid') ";
			} else {
				$parms1 = array_combine(
					array_map(function ($i) {
						return ':id' . $i;
					}, array_keys($usertypeidarr)),
					$usertypeidarr
				);
				$usertypeidkey = implode(',', array_keys($parms1));

				$qryrgh .= " where alias NOT IN ( SELECT formname FROM tbluserrights WHERE usertypeid IN ($usertypeidkey) AND personid ='') ";
			}
			// print_r($result_ary);
			$result_ary = self::getmenual($qryrgh, $parms, $class);
			// echo '<pre>';

			// print_r($result_ary);
			// echo '</pre>';
		}
		return $result_ary;
	}

	function getdashuserright($uid, $usertype, $class = null)
	{

		$config = new config();
		$IISMethods = new IISMethods();
		$LoginInfo = new LoginInfo();
		$qrychk = "SELECT id from tbldashboardrights where personid=:personid ";
		$parms = array(
			':personid' => $uid,
		);

		$result_ary = self::getmenual($qrychk, $parms);

		if ($uid == $config->getAdminUserId()) {
			$parms = array();
			$result_ary = self::getmenual('SELECT uniqname as uniqname,1 AS viewright,1 AS selfviewright,1 AS allviewright FROM tbldashboarddata WHERE 1=1', $parms, $class);
		} else {

			$usertypeidarr = explode(",", $usertype);

			$qryrgh = "SELECT uniqname,
			
			CASE WHEN(SUM(viewright)=0) THEN 0 ELSE 1 END AS viewright,
			CASE WHEN(SUM(allviewright)=0) THEN 0 ELSE 1 END AS allviewright,
			CASE WHEN(SUM(selfviewright)=0) THEN 0 ELSE 1 END AS selfviewright
			FROM tbldashboardrights ";

			if (sizeof($result_ary) > 0) {
				$parms = array();
				$qryrgh .= " where personid ='$uid' AND moduletypeid = 1";
			} else {
				$parms = array_combine(
					array_map(function ($i) {
						return ':id' . $i;
					}, array_keys($usertypeidarr)),
					$usertypeidarr
				);
				$usertypeidkey = implode(',', array_keys($parms));

				$qryrgh .= " where usertypeid IN ($usertypeidkey) AND personid ='' AND moduletypeid = 1";
			}
			$qryrgh .= " group by id";


			$qryrgh .= " UNION ALL ";

			$qryrgh .= "SELECT uniqname,
			0 AS viewright,0 AS allviewright,0 AS selfviewright
			FROM tbldashboarddata";

			if (sizeof($result_ary) > 0) {
				$parms1 = array();
				$qryrgh .= " where uniqname NOT IN ( SELECT uniqname FROM tbldashboardrights WHERE personid ='$uid' AND moduletypeid = 1) ";
			} else {
				$parms1 = array_combine(
					array_map(function ($i) {
						return ':did' . $i;
					}, array_keys($usertypeidarr)),
					$usertypeidarr
				);
				$usertypeidkey = implode(',', array_keys($parms1));

				$qryrgh .= " where uniqname NOT IN ( SELECT uniqname FROM tbldashboardrights WHERE usertypeid IN ($usertypeidkey) AND personid ='' AND moduletypeid = 1) ";
			}


			$mainparams = array_merge($parms, $parms1);

			// echo $qryrgh;
			// print_r($mainparams);
			// exit;
			$result_ary = self::getmenual($qryrgh, $mainparams, $class);
		}



		return $result_ary;
	}


	// get company details 
	function getcompanyinfo($companyid, $class = null)
	{
		$parms = array(
			':id' => $companyid,
		);
		// print_r($parms);

		$result_ary = self::getmenual("SELECT *, IFNULL((SELECT facebook FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1),'') AS facebook,
		IFNULL((SELECT instagram FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1),'') AS instagram,
		IFNULL((SELECT twitter FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1),'') AS twitter,
		IFNULL((SELECT youtube FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1),'') AS youtube,
		IFNULL((SELECT skype FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1),'') AS skype,
		IFNULL((SELECT pintrest FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1), '') AS pintrest,
        IFNULL((SELECT reddit FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1), '') AS reddit,
        IFNULL((SELECT x FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1), '') AS x,
        IFNULL((SELECT linkedin FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1), '') AS linkedin,
        IFNULL((SELECT tiktok FROM `tblsocialsetting` ORDER BY id ASC LIMIT 1), '') AS tiktok,
		IFNULL((SELECT address FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS mainaddress,
		IFNULL((SELECT contact1 FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS maincontact1,
		IFNULL((SELECT contact2 FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS maincontact2,
		IFNULL((SELECT email FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS mainemail,
		IFNULL((SELECT email2 FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS mainemail2,
		IFNULL((SELECT officetime FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS workhour,
		IFNULL((SELECT support_contact FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS support_contact,
		IFNULL((SELECT support_whatsappno FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS support_whatsappno,
		IFNULL((SELECT support_email FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS support_email,
		IFNULL((SELECT maplink FROM `tbladdresssetting` ORDER BY id ASC LIMIT 1),'') AS maplink
		FROM tblcompanymaster where id=:id", $parms, $class);
		//print_r($parms);
		return $result_ary;
	}


	// get Setting details 
	function getsettingdata($class = null)
	{
		$parms = array();

		$result_ary = self::getmenual('select * from tblsetting limit 1', $parms, $class);
		return $result_ary;
	}

	function getpackagewiseuserright($uid, $pfid)
	{
		// echo $uid .' | ';
		$IISMethods = new IISMethods();
		$currdate = $IISMethods->getcurrdate();
		$resdetails = array();
		$query = "SELECT `id`,`packageid`,`uid`
		FROM`tblpackageassign`
		WHERE status=1 AND uid=:uid AND isactive=1 AND STR_TO_DATE(expirydate,'%d/%m/%Y')>=STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY timestamp desc limit 1";
		$params = array(':uid' => $uid, ':currdate' => $currdate);
		// print_r($params);
		$result_ary = self::getmenual($query, $params);
		$rowp = $result_ary[0];

		if (sizeof($result_ary) > 0) {
			$querydetail = "SELECT `id`,`packassignid`,`qty`,`activateddate`,`expirydate`,`str_expirydate`,`isstatus`,`packagetypeid`,`uid`,`packageid`,`status`,`price`,`pfid`,`attributeval`,`isnolimit`,`limitvalue`,`pfname`,`pfprintname`,`displayorder`,`haslimit`,`withinputbox`,`inputboxlabel`,`isupgrade`,`isaddon`,`actualdate`,`deactivedate`,`deactivedatetime`,`reactivepack`,`mainexpirydate`,`entry_uid`,`entry_date`,`update_uid`,`update_date`,`timestamp`
			,case when(isnolimit=1) THEN 'Unlimited' ELSE CONCAT('Limited','(',`limitvalue`,')') END AS limittext
			FROM `tblpackageassigndetail`
			WHERE packassignid=:packassignid AND pfid=:pfid";

			$paramsdetail = array(':packassignid' => $rowp['id'], ':pfid' => $pfid);
			// echo $querydetail;
			// print_r($paramsdetail);
			$resdetails = self::getmenual($querydetail, $paramsdetail);
		}
		$responsearr['attributeval'] = $resdetails[0]['attributeval'];
		$responsearr['isnolimit'] = $resdetails[0]['isnolimit'];
		$responsearr['limitvalue'] = $resdetails[0]['limitvalue'];
		$responsearr['pfprintname'] = $resdetails[0]['pfprintname'];

		// print_r($responsearr);
		return $responsearr;
	}

	function checkpackagewiseuserright($uid)
	{
		$IISMethods = new IISMethods();
		$currdate = $IISMethods->getcurrdate();
		$resdetails = array();
		$query = "SELECT `id`,`packageid`,`uid`,packagetypeid,DATEDIFF(STR_TO_DATE(expirydate,'%d/%m/%Y'), STR_TO_DATE(packactivatedate,'%d/%m/%Y')) AS totaldays
		,DATEDIFF(STR_TO_DATE(expirydate,'%d/%m/%Y'), STR_TO_DATE(:currdate1,'%d/%m/%Y')) AS totalpendingdays,case when (packagetypeid=1) THEN annualyprice ELSE monthlyprice END AS totalamt
		FROM`tblpackageassign`
		WHERE status=1 AND isactive=1 AND uid=:uid AND STR_TO_DATE(expirydate,'%d/%m/%Y')>=STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY timestamp desc limit 1";
		$params = array(':uid' => $uid, ':currdate' => $currdate, ':currdate1' => $currdate);
		//  print_r($params);
		$result_ary = self::getmenual($query, $params);
		$rowp = $result_ary[0];

		$IsPackageExpire = 1;
		//  print_r($result_ary);
		$packgaeprice = 0;
		if (sizeof($result_ary) > 0) {
			$IsPackageExpire = 0;

			$totalamt = round($rowp['totalamt'], 2);
			$perdayrate = $totalamt / $rowp['totaldays'];
			$pendingamt = round($perdayrate * $rowp['totalpendingdays'], 2);

			$usedamt = $totalamt - $pendingamt;

			$qry = "SELECT CASE WHEN(" . $rowp['packagetypeid'] . "=1) THEN annualyprice ELSE monthlyprice END AS price FROM tblpackagemaster WHERE id=:id";
			$param = array(':id' => $rowp['packageid']);
			$res = self::getmenual($qry, $param);
			$rowprice = $res[0];
			$packgaeprice = $rowprice['price'];
			/* $query1="SELECT `id`,`packageid`,`uid`
			FROM`tblpackageassign`
			WHERE status=1 AND uid=:uid AND DATE_SUB(STR_TO_DATE(expirydate,'%d/%m/%Y'),INTERVAL 3 DAY)>=STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY timestamp desc limit 1";
			$params1=array(':uid'=>$uid,':currdate'=>$currdate);
			// print_r($params);
			$result_ary1=self::getmenual($query1,$params1); */
		}
		$responsearr['id'] = (string)$rowp['id'];
		$responsearr['totalamt'] = (float)$totalamt;
		$responsearr['usedamt'] = (float)$usedamt;
		$responsearr['perdayrate'] = (float)$perdayrate;
		$responsearr['pendingamt'] = (float)$pendingamt;
		$responsearr['packgaeprice'] = (float)$packgaeprice;
		$responsearr['packagetypeid'] = (int)$rowp['packagetypeid'];
		$responsearr['packageid'] = (string)$rowp['packageid'];
		$responsearr['IsPackageExpire'] = (int)$IsPackageExpire;
		// print_r($responsearr);
		return $responsearr;
	}

	//Check Patient Package Expired or Not
	function checkpackagestatus($patientid, $class = null)
	{
		$IISMethods = new IISMethods();
		$ispackagefound = 0;

		$qrypkg = "SELECT DISTINCT pa.id,STR_TO_DATE(pa.expirydate,'%d/%m/%Y') AS pkg_expirydate
			FROM `tblpackageassign` pa 
			WHERE pa.status=1 AND pa.iscancel=0 AND pa.patientid=:patientid";
		$pkgparms = array(
			':patientid' => $patientid,
		);
		$respkg = self::getmenual($qrypkg, $pkgparms);
		$numpkg = sizeof($respkg);

		if ($numpkg > 0)  //When Package Found
		{
			$rowpkg = $respkg[0];

			$pkg_expirydate = $rowpkg['pkg_expirydate'];
			$cdate = $IISMethods->getformatcurrdate();

			if (strtotime($pkg_expirydate) >= strtotime($cdate))  //When Package Not Expired
			{
				$ispackagefound = 1;
			} else  //When Package Expired
			{
				$ispackagefound = 2;
			}
		}

		return $ispackagefound;
	}

	//Deduct/Add Patient Meeting Slots
	function deductpatientslots($type, $patientid, $mdate)  //$type 1-Deduct,2-Add
	{
		$IISMethods = new IISMethods();

		$currdate = $IISMethods->getformatcurrdate();   //Y-m-d
		$qrypkg = "SELECT DISTINCT pa.* 
			FROM `tblpackageassign` pa 
			WHERE pa.status=1 AND pa.iscancel=0 AND pa.patientid=:patientid AND STR_TO_DATE(pa.expirydate,'%d/%m/%Y') >= STR_TO_DATE(:mdate,'%d/%m/%Y') ORDER BY pa.orderdate LIMIT 1";
		$pkgparms = array(
			':patientid' => $patientid,
			':mdate' => $mdate,
		);
		$respkg = self::getmenual($qrypkg, $pkgparms);
		$numpkg = sizeof($respkg);

		if ($numpkg > 0)  //When Package Found
		{
			$rowpkg = $respkg[0];

			$rem_noofsession = $rowpkg['rem_noofsession'];

			if ($type == 1)  //For Deduct
			{
				$opr = -1;
			} else if ($type == 2)  //For Add
			{
				$opr = 1;
			}

			$upd_rem_noofsession = $rem_noofsession + $opr;

			$updqry = array(
				'rem_noofsession' => $upd_rem_noofsession,
			);
			// print_r($updqry);
			$extraparams = array(
				'id' => $rowpkg['id']
			);
			self::executedata('u', 'tblpackageassign', $updqry, $extraparams);
		}
	}

	//Insert Patient Daily Water Glass
	function insertpatientdailyplan($type, $patientid, $date)   //type-1(Diet), 2(Workout), 3(Water Glass)
	{
		$IISMethods = new IISMethods();

		$datetime = $IISMethods->getdatetime();
		$currdate = $IISMethods->getcurrdate();

		if ($currdate == $date) {
			if ($type == 1)  //When Daily Diet Plan
			{
				$qrydietchk = "SELECT * FROM `tblpatientdailydietplan` WHERE patientid=:patientid AND STR_TO_DATE(`date`,'%d/%m/%Y') = STR_TO_DATE(:date,'%d/%m/%Y')";
				$chkdietparams = array(
					':patientid' => $patientid,
					':date' => $date,
				);
				$resdietchk = self::getmenual($qrydietchk, $chkdietparams);
				$numdietchk = sizeof($resdietchk);

				if ($numdietchk > 0) {
				} else {
					$qry = "SELECT * FROM(
						SELECT pm.id,tpi.id AS pi_id,tpi.date FROM tblpatientinformation tpi INNER JOIN tblpersonmaster pm ON pm.id=tpi.`patientid` WHERE pm.isactive=1 AND STR_TO_DATE(tpi.date,'%d/%m/%Y') <= STR_TO_DATE(:date,'%d/%m/%Y') AND tpi.`patientid`=:patientid ORDER BY STR_TO_DATE(tpi.date,'%d/%m/%Y') DESC
					) tmp GROUP BY tmp.id";
					$params = array(
						':date' => $date,
						':patientid' => $patientid,
					);
					$res = self::getmenual($qry, $params);
					$row = $res[0];


					$qrydiet = "SELECT * FROM `tblpatientdietplan` WHERE patientdetailid=:patientdetailid";
					$dietparams = array(
						':patientdetailid' => $row['pi_id'],
					);
					$resdiet = self::getmenual($qrydiet, $dietparams);
					$numdiet = sizeof($resdiet);
					if ($numdiet > 0) {

						for ($j = 0; $j < sizeof($resdiet); $j++) {
							$rowdiet = $resdiet[$j];

							$unqid = $IISMethods->generateuuid();
							$insdietqry = array(
								'id' => $unqid,
								'patientid' => $rowdiet['patientid'],
								'patientdetailid' => $rowdiet['patientdetailid'],
								'date' => $IISMethods->getcurrdate(),
								'scheduleid' => $rowdiet['scheduleid'],
								'schedulename' => $rowdiet['schedulename'],
								'scheduletime' => $rowdiet['scheduletime'],
								'foodid' => $rowdiet['foodid'],
								'foodname' => $rowdiet['foodname'],
								'unitid' => $rowdiet['unitid'],
								'unit' => $rowdiet['unit'],
								'f_qty' => $rowdiet['f_qty'],
								'f_protein' => $rowdiet['f_protein'],
								'f_carbs' => $rowdiet['f_carbs'],
								'f_fiber' => $rowdiet['f_fiber'],
								'f_fats' => $rowdiet['f_fats'],
								'f_calories' => $rowdiet['f_calories'],
								'qty' => $rowdiet['qty'],
								'protein' => $rowdiet['protein'],
								'carbs' => $rowdiet['carbs'],
								'fiber' => $rowdiet['fiber'],
								'fats' => $rowdiet['fats'],
								'calories' => $rowdiet['calories'],
								'displayorder' => $rowdiet['displayorder'],
								'comment' => $rowdiet['comment'],
								'isextrafood' => 0,
								'timestamp' => $datetime,
							);

							self::executedata('i', 'tblpatientdailydietplan', $insdietqry, '');
						}
					}
				}
			} else if ($type == 2)  //When Daily Workout Plan
			{
				$qryworkchk = "SELECT * FROM `tblpatientdailyworkout` WHERE patientid=:patientid AND STR_TO_DATE(`date`,'%d/%m/%Y') = STR_TO_DATE(:date,'%d/%m/%Y')";
				$chkworkparams = array(
					':patientid' => $patientid,
					':date' => $date,
				);
				$resworkchk = self::getmenual($qryworkchk, $chkworkparams);
				$numworkchk = sizeof($resworkchk);

				if ($numworkchk > 0) {
				} else {
					$qry = "SELECT * FROM(
						SELECT pm.id,tpi.id AS pi_id,tpi.date FROM tblpatientinformation tpi INNER JOIN tblpersonmaster pm ON pm.id=tpi.`patientid` WHERE pm.isactive=1 AND STR_TO_DATE(tpi.date,'%d/%m/%Y') <= STR_TO_DATE(:date,'%d/%m/%Y') AND tpi.`patientid`=:patientid ORDER BY STR_TO_DATE(tpi.date,'%d/%m/%Y') DESC
					) tmp GROUP BY tmp.id";
					$params = array(
						':date' => $date,
						':patientid' => $patientid,
					);
					$res = self::getmenual($qry, $params);
					$row = $res[0];

					$qrywork = "SELECT DISTINCT pwd.*,pw.patientid,pw.patientdetailid
						FROM tblpatientworkoutplan pw 
						INNER JOIN tblpatientworkoutdetail pwd ON pwd.`patientworkoutid`=pw.id 
						INNER JOIN tblpatientworkoutplandays pwdd ON pwdd.pworkoutdetailid=pwd.id 
						INNER JOIN tbldaysmaster d ON d.id=pwdd.dayid
						WHERE pw.`patientdetailid`=:patientdetailid AND d.no=DATE_FORMAT(STR_TO_DATE(:date,'%d/%m/%Y'),'%w')";
					$workparams = array(
						':patientdetailid' => $row['pi_id'],
						':date' => $date,
					);
					$reswork = self::getmenual($qrywork, $workparams);
					$numwork = sizeof($reswork);
					if ($numwork > 0) {
						for ($j = 0; $j < sizeof($reswork); $j++) {
							$rowwork = $reswork[$j];

							$unqid = $IISMethods->generateuuid();
							$insworkqry = array(
								'id' => $unqid,
								'patientid' => $rowwork['patientid'],
								'patientdetailid' => $rowwork['patientdetailid'],
								'date' => $IISMethods->getcurrdate(),
								'workoutid' => $rowwork['workoutid'],
								'workout' => $rowwork['workout'],
								'unitid' => $rowwork['unitid'],
								'unit' => $rowwork['unit'],
								'sets' => $rowwork['sets'],
								'repeats' => $rowwork['repeats'],
								'displayorder' => $rowwork['displayorder'],
								'comment' => $rowwork['comment'],
								'isextraworkout' => 0,
								'timestamp' => $datetime,
							);

							self::executedata('i', 'tblpatientdailyworkout', $insworkqry, '');
						}
					}
				}
			} else if ($type == 3)  //When Daily Water Glass
			{
				$qrywgchk = "SELECT * FROM `tblpatientdailywaterglass` WHERE patientid=:patientid AND STR_TO_DATE(`date`,'%d/%m/%Y') = STR_TO_DATE(:date,'%d/%m/%Y')";
				$chkwgparams = array(
					':patientid' => $patientid,
					':date' => $date,
				);
				$reswgchk = self::getmenual($qrywgchk, $chkwgparams);
				$numwgchk = sizeof($reswgchk);

				if ($numwgchk > 0) {
				} else {
					$qry = "SELECT * FROM(
						SELECT pm.id,tpi.id AS pi_id,tpi.date FROM tblpatientinformation tpi INNER JOIN tblpersonmaster pm ON pm.id=tpi.`patientid` WHERE pm.isactive=1 AND STR_TO_DATE(tpi.date,'%d/%m/%Y') <= STR_TO_DATE(:date,'%d/%m/%Y') AND tpi.`patientid`=:patientid ORDER BY STR_TO_DATE(tpi.date,'%d/%m/%Y') DESC
					) tmp GROUP BY tmp.id";
					$params = array(
						':date' => $date,
						':patientid' => $patientid,
					);
					$res = self::getmenual($qry, $params);
					$row = $res[0];


					$qrywg = "SELECT * FROM `tblpatientwaterglass` WHERE patientdetailid=:patientdetailid";
					$wgparams = array(
						':patientdetailid' => $row['pi_id'],
					);
					$reswg = self::getmenual($qrywg, $wgparams);
					$numwg = sizeof($reswg);
					if ($numwg > 0) {
						for ($j = 0; $j < sizeof($reswg); $j++) {
							$rowwg = $reswg[$j];

							$unqid = $IISMethods->generateuuid();
							$inswgqry = array(
								'id' => $unqid,
								'patientid' => $rowwg['patientid'],
								'patientdetailid' => $rowwg['patientdetailid'],
								'date' => $IISMethods->getcurrdate(),
								'scheduleid' => $rowwg['scheduleid'],
								'schedulename' => $rowwg['schedulename'],
								'scheduletime' => $rowwg['scheduletime'],
								'qty' => $rowwg['qty'],
								'isextraglass' => 0,
								'timestamp' => $datetime,
							);

							self::executedata('i', 'tblpatientdailywaterglass', $inswgqry, '');
						}
					}
				}
			}
		}
	}


	function numberTowords(float $amount)
	{
		$amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
		// Check if there is any number after decimal
		$amt_hundred = null;
		$count_length = strlen($num);
		$x = 0;
		$string = array();
		$change_words = array(
			0 => '',
			1 => 'One',
			2 => 'Two',
			3 => 'Three',
			4 => 'Four',
			5 => 'Five',
			6 => 'Six',
			7 => 'Seven',
			8 => 'Eight',
			9 => 'Nine',
			10 => 'Ten',
			11 => 'Eleven',
			12 => 'Twelve',
			13 => 'Thirteen',
			14 => 'Fourteen',
			15 => 'Fifteen',
			16 => 'Sixteen',
			17 => 'Seventeen',
			18 => 'Eighteen',
			19 => 'Nineteen',
			20 => 'Twenty',
			30 => 'Thirty',
			40 => 'Forty',
			50 => 'Fifty',
			60 => 'Sixty',
			70 => 'Seventy',
			80 => 'Eighty',
			90 => 'Ninety'
		);
		$here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($x < $count_length) {
			$get_divider = ($x == 2) ? 10 : 100;
			$amount = floor($num % $get_divider);
			$num = floor($num / $get_divider);
			$x += $get_divider == 10 ? 1 : 2;
			if ($amount) {
				$add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
				$amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
				$string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
			' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
			' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
			} else $string[] = null;
		}
		$implode_to_Rupees = implode('', array_reverse($string));
		/* $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
		" . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
		return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise; */
		$get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
		" . $change_words[$amount_after_decimal % 10]) . '' : '';
		return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
	}

	function sendemail_old($emailto, $subject, $data, $files, $bcc, $cc, $sendername, $emailhostid)
	{


		$emailstatus = 0;
		$errormsg = '';
		//$emailto='amit.nanda@instanceit.com';
		$qrysett = "SELECT * FROM tblsmtpconfig ";
		$settparams = array();
		$ressett = self::getmenual($qrysett, $settparams);
		$numsett = sizeof($ressett);
		if ($numsett > 0) {
			$rowsett = $ressett[0];

			$mailhost = $rowsett['hostname'];
			$mailPort = $rowsett['port'];
			$mailusername = $rowsett['emailid'];
			$mailpassword = $rowsett['password'];
			$mailemail = $rowsett['replyemailid'];
			$mailsendername = $rowsett['name'];
			if ($sendername) {
				$mailsendername = $sendername;
			}
			// echo $data;
			if ($data) {
				$email_body = $data;

				//Create a new PHPMailer instance
				$mail = new PHPMailer;
				//Tell PHPMailer to use SMTP
				$mail->isSMTP();
				//Enable SMTP debugging
				// 0 = off (for production use)
				// 1 = client messages
				// 2 = client and server messages
				$mail->SMTPDebug = 0;
				//Ask for HTML-friendly debug output
				$mail->Debugoutput = 'html';
				//Set the hostname of the mail server
				$mail->Host = $mailhost;
				//Set the SMTP port number - likely to be 25, 465 or 587
				$mail->Port = $mailPort;
				//Whether to use SMTP authentication
				$mail->SMTPAuth = true;
				//Username to use for SMTP authentication
				$mail->Username = $mailusername;
				//Password to use for SMTP authentication
				$mail->Password = $mailpassword;

				$mail->SMTPSecure = 'ssl';

				//Set who the message is to be sent from
				$mail->setFrom($mailemail, $mailsendername);
				//Set an alternative reply-to address
				$mail->addReplyTo($mailemail, $mailsendername);


				//Set who the message is to be sent to
				$addresses = explode(',', $emailto);
				foreach ($addresses as $address) {
					$mail->AddAddress(trim($address));
				}
				//$mail->addAddress($emailto, '');
				//$mail->addAddress('inquiry@memighty.com', '');

				// bcc
				// $bccaddresses = explode(',',$bcc);
				// foreach ($bccaddresses as $bccaddress) {
				// 	$mail->AddBCC(trim($bccaddress));
				// }

				// cc 
				// $ccaddresses = explode(',',$cc);
				// foreach ($ccaddresses as $ccaddress) {
				// 	$mail->AddCC(trim($ccaddress));
				// }
				// $mail->AddCC("abhay4768@gmail.com", "bla");               
				// $mail->AddBCC("instanceit@gmail.com", "test");	

				//Set the subject line
				$mail->Subject = $subject;
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				$mail->msgHTML($email_body);
				//Replace the plain text body with one created manually
				//$mail->AltBody = 'This is a plain-text message body';
				//Attach an image file
				// $mail->addAttachment($files);

				$sent = $mail->send();
				// if($files)
				// {
				// 	unlink($files);
				// }

				if (!$sent) {
					$emailstatus = 0;
					$errormsg = $mail->ErrorInfo;
				} else {
					$emailstatus = 1;
					$errormsg = "Success";
				}
			}
		}

		$data = ['emailstatus' => $emailstatus, 'emailerrormsg' => $errormsg];


		return $data;
	}

	function sendemail($emailto, $subject, $data, $files, $bcc, $cc, $sendername, $emailhostid)
	{


		$emailstatus = 0;
		$errormsg = '';
		//$emailto='amit.nanda@instanceit.com';
		$qrysett = "SELECT * FROM tblsmtpconfig ";
		$settparams = array();
		$ressett = self::getmenual($qrysett, $settparams);
		$numsett = sizeof($ressett);
		if ($numsett > 0) {
			$rowsett = $ressett[0];

			$mailhost = $rowsett['hostname'];
			$mailPort = $rowsett['port'];
			$mailusername = $rowsett['emailid'];
			$mailpassword = $rowsett['password'];
			$mailemail = $rowsett['replyemailid'];
			$mailsendername = $rowsett['name'];
			if ($sendername) {
				$mailsendername = $sendername;
			}
			// echo $data;
			if ($data) {
				$email_body = $data;

				$mail = new PHPMailer(true);
				$mail->isSMTP();
				$mail->Host       = $mailhost;
				$mail->SMTPAuth   = true;
				$mail->Username   = $mailusername;
				$mail->Password   = $mailpassword;
				$mail->SMTPSecure = 'ssl'; // or 'tls'
				$mail->Port       = $mailPort; // or 587 for tls

				$mail->setFrom($mailusername, $mailsendername);
				$addresses = explode(',', $emailto);
				foreach ($addresses as $address) {
					$mail->AddAddress(trim($address));
				}

				$mail->Subject = $subject;
				// $mail->Body    = $email_body;
				$mail->msgHTML($email_body);

				$sent = $mail->send();
				// if($files)
				// {
				// 	unlink($files);
				// }

				if (!$sent) {
					$emailstatus = 0;
					$errormsg = $mail->ErrorInfo;
				} else {
					$emailstatus = 1;
					$errormsg = "Success";
				}
			}
		}

		$data = ['emailstatus' => $emailstatus, 'emailerrormsg' => $errormsg];


		return $data;
	}

	function getorderno($seriesid, $type, $idate)
	{
		$date = date('d/m/Y');
		if ($idate)
			$date = $idate;

		$dateyear = substr($date, -4, 4);
		$datemonth = substr($date, -7, 2);

		$tblflag = $type;
		if ($type == 'receipt') {
			$tblflag = 'payment';
		}
		$tablename = 'tbl' . $tblflag;


		$qryyear = "SELECT * FROM tblfinancialyear WHERE STR_TO_DATE(:date,'%d/%m/%Y')  BETWEEN STR_TO_DATE(fromdate,'%d/%m/%Y') AND STR_TO_DATE(todate,'%d/%m/%Y')";
		$yearparams = array(
			':date' => $date,
		);

		$resyear = self::getmenual($qryyear, $yearparams);
		$rowyear = $resyear[0];
		$fdate = $rowyear['fromdate'];
		$tdate = $rowyear['todate'];
		$fd = substr($fdate, 0, 4);
		$td = substr($tdate, 2, 2);

		$qrysr = "SELECT * from tblseriesmaster where id = :seriesid ";
		$srparams = array(
			':seriesid' => $seriesid,
		);
		//print_r($srparams);
		$result_sr = self::getmenual($qrysr, $srparams);
		$rowsr = $result_sr[0];
		$seriesstart = $rowsr['startno'] - 1;
		$seriesend = $rowsr['endno'];
		$serieslen = strlen($seriesend);
		$seriesprefix = $rowsr['prefix'];


		$qrycmp = "SELECT id,companyname,prefix from tblcompanymaster LIMIT 1";
		$cmpparams = array();
		$result_arycmp = self::getmenual($qrycmp, $cmpparams);
		$rowcmp = $result_arycmp[0];

		$qrytb = "SELECT IFNULL(MAX(maxid),0) as maxid FROM $tablename WHERE seriesid=:seriesid";
		$tbparams = array(
			':seriesid' => $seriesid,
		);
		//print_r($tbparams);
		$result_tb = self::getmenual($qrytb, $tbparams);
		$rowtb = $result_tb[0];

		if (sizeof($result_tb) > 0) {
			$iid = $rowtb['maxid'] + 1;
		} else {
			$iid = 1;
		}
		$ordno = '';

		if ($seriesid) {
			$qryele = "SELECT * FROM tblserieselements WHERE seriesid = :seriesid ORDER BY displayorder asc ";
			$eleparams = array(
				':seriesid' => $seriesid,
			);
			//print_r($eleparams);
			$resele = self::getmenual($qryele, $eleparams);
			$ordno = '';
			//while($rowele = $resele -> fetch())
			//echo sizeof($resele);
			for ($i = 0; $i < sizeof($resele); $i++) {
				$rowele = $resele[$i];
				if ($rowele['elementid'] == 1)
					$ordno .= $rowcmp['prefix'];
				else if ($rowele['elementid'] == 2)
					$ordno .= $seriesprefix;
				else if ($rowele['elementid'] == 3)
					$ordno .= $fd . '/' . $td;
				else if ($rowele['elementid'] == 4)
					$ordno .= $fd . '-' . $td;
				else if ($rowele['elementid'] == 5)
					$ordno .= $dateyear;
				else if ($rowele['elementid'] == 6)
					$ordno .= $datemonth;
				else if ($rowele['elementid'] == 7)
					$ordno .= '/';
				else if ($rowele['elementid'] == 8)
					$ordno .= '-';
				else if ($rowele['elementid'] == 9)
					$ordno .= str_pad($iid, $serieslen, '0', STR_PAD_LEFT);
			}
			//echo "hi";
			//$ordno = $rowcmp['prefix'].str_pad($iid,4,'0',STR_PAD_LEFT);
		}
		// echo $ordno;
		return $ordno;
	}

	function getmaxid($seriesid, $flag)
	{
		$tblflag = $flag;
		$tablename = 'tbl' . $tblflag;

		$qryele = "SELECT IFNULL(MAX(maxid),0) as maxid FROM $tablename 
		WHERE seriesid = :seriesid ";

		$eleparams = array(
			':seriesid' => $seriesid,
		);

		$resele = self::getmenual($qryele, $eleparams);
		$rowqt = $resele[0];
		$numrows = sizeof($resele);
		if ($numrows > 0 && $rowqt['maxid'] > 0) {
			$iid = $rowqt['maxid'] + 1;
		} else {
			$iid = 1;
		}
		return $iid;
	}

	function getseriseprefix($seriesid)
	{
		$qry = "SELECT prefix from tblseriesmaster where id = :seriesid";
		$serparams = array(
			':seriesid' => $seriesid,
		);
		$res = self::getmenual($qry, $serparams);
		$rowseries = $res[0];
		return $rowseries['prefix'];
	}

	function getsortbycolname($sortbyid)
	{
		$qry = "SELECT colname from tbldiamondsortby where id = :sortbyid";
		$params = array(
			':sortbyid' => $sortbyid,
		);
		$res = self::getmenual($qry, $params);
		$rowies = $res[0];
		return $rowies['colname'];
	}

	function getsortbyjewcolname($sortbyid)
	{
		$qry = "SELECT colname from tbljewellerysortby where id = :sortbyid";
		$params = array(
			':sortbyid' => $sortbyid,
		);
		$res = self::getmenual($qry, $params);
		$rowies = $res[0];
		return $rowies['colname'];
	}

	// 	function getemailbody($emailto,$subject,$data,$files,$bcc,$cc,$sendername,$emailhostid)
	// 	{
	// 		$config = new config();
	// 		$CompanyInfo = new CompanyInfo();
	// 		$CompanyInfo = self::getcompanyinfo($config->getDefaultCmpId());
	// 		// print_r($CompanyInfo[0]);
	// 		$rowcmp=$CompanyInfo[0];

	// 		$emailtxt='';
	// 		$emailtxt.='<!DOCTYPE html>';

	// 		$emailtxt.='<html>';

	// 		$emailtxt.='<head>';

	// 		$emailtxt.='<title></title>';

	// 		$emailtxt.='</head>';

	// 		$emailtxt.='<body class="clean-body"  style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color:#FFFFFF;">';
	// 		$emailtxt.='<div class="ie-browser">';

	// 		$emailtxt.='<div  style="width:680px;text-align: center;margin-left: auto;margin-right: auto;">';
	// 		$emailtxt.='<table';
	// 		$emailtxt.=' style="border:1px solid #669934;width:680px;margin-top:30px;margin-bottom:30px;text-align: center;margin-left: auto;margin-right: auto;font-family:sans-serif;background-color: #f6f6f6;">';
	// 		$emailtxt.='<tbody>';
	// 		$emailtxt.='<tr>';
	// 		$emailtxt.='<td  style="padding-left: 0px; padding-top:0px; padding-right:0px;padding-bottom:0px;">';
	// 		$emailtxt.='<table width="100%" cellpadding="0" cellspacing="0" border="0"';
	// 		$emailtxt.=' style="border:1px solid #fff;width:650px;margin-top:20px;margin-bottom:20px;text-align: center;margin-left: auto;margin-right: auto;font-family:sans-serif;background-color: #fff;border-collapse: collapse;border-spacing: 0px;">';
	// 		$emailtxt.='<tbody>';
	// 		$emailtxt.='<tr>';
	// 		$emailtxt.='<td';
	// 		$emailtxt.=' style="padding-left: 15px; padding-top:15px; padding-right:15px;padding-bottom:15px;">';
	// 		$emailtxt.='<table width="100%" cellpadding="0" cellspacing="0" border="0"';
	// 		$emailtxt.=' style="background-color:#FFFFFF;font-family:sans-serif;border-collapse: collapse;border-spacing: 0px;">';
	// 		$emailtxt.='<thead>';
	// 		$emailtxt.='<tr>';
	// 		$emailtxt.='<th colspan="10"';
	// 		$emailtxt .= ' style="padding: 10px 0 30px; text-align: center; background-color: #FFFFFF;">';
	// 		$emailtxt .= '<div style="display: block; text-align: center; margin: 0 auto;">';
	// 		$emailtxt .= '<a href="' . $config->getCdnurl() . '" target="_blank" style="display: inline-block; text-decoration: none; outline: none;">';
	// 		$emailtxt .= '<img src="https://tradecvd.com/assets/images/header-sticky.svg" alt="' . $rowcmp['companyname'] . '" width="180" height="60"';
	// 		$emailtxt .= ' style="display: block; width: 180px; max-width: 180px; height: auto; margin: 0 auto; border: 0; outline: none; text-decoration: none;" />';
	// 		$emailtxt .= '</a>';
	// 		$emailtxt.='</div>';
	// 		$emailtxt.='</th>';
	// 		$emailtxt.='</tr>';
	// 		$emailtxt.='</thead>';
	// 		$emailtxt.='<tbody>';

	// 		$emailtxt.=$data;

	// 		$emailtxt.='</tbody>';
	// 		$emailtxt.='<tfoot>';

	// 		$emailtxt.='<tr>';

	// 		$emailtxt.='<td colspan="10"';
	// 		$emailtxt.=' style="padding-right: 10px; padding-left: 10px; padding-top: 20px; padding-bottom: 20px;background:#669934;">';
	// 		$emailtxt.='<p';
	// 		$emailtxt.=' style="font-size: 14px; line-height: 1.5; text-align: center; word-break: break-word; margin: 0;color:#FFFFFF;font-weight:600;">';
	// 		$emailtxt.='If you have any questions about this mail, simply';
	// 		$emailtxt.=' reply to this email';
	// 		$emailtxt.=' or reach out to our support team for help.</p>';
	// 		$emailtxt.='</td>';

	// 		$emailtxt.='</tr>';
	// 		$emailtxt.='<tr>';
	// 		$emailtxt.='<td colspan="5"';
	// 		$emailtxt.=' style="padding-right: 10px; padding-left: 10px; padding-top: 30px; padding-bottom: 30px;border-top: 1px dotted #C4C4C4;background:#f6f6f6;">';
	// 		$emailtxt.='<div';
	// 		$emailtxt.=' style="font-size: 16px; line-height: 1.5;line-height: 20px; color: #333333;">';
	// 		$emailtxt.='<p';
	// 		$emailtxt.=' style="font-size: 16px; line-height: 1.5;line-height: 20px; text-align: left; word-break: break-word; color:#669934;line-height:1.2;margin: 0;">';
	// 		$emailtxt.='<span  style="font-size: 16px;">';
	// 		$emailtxt.='<a href="'.$config->getCdnurl().'"';
	// 		$emailtxt.=' style="text-decoration:none;background-color: transparent; font-size: 16px;color:#669934;font-weight:600;"';
	// 		$emailtxt.='target="_blank">';
	// 		$emailtxt.='<span';
	// 		$emailtxt.=' style="background-color:transparent; font-size:16px; color:#669934; font-weight:600">'.$rowcmp['companyname'].'</span></a>';
	// 		$emailtxt.='</span>';
	// 		$emailtxt.='</p>';
	// 		$emailtxt.='</div>';
	// 		$emailtxt.='</td>';
	// 		$emailtxt.='<td colspan="5"';
	// 		$emailtxt.=' style="padding-right: 10px; padding-left: 10px; padding-top: 30px; padding-bottom: 30px;border-top: 1px dotted #C4C4C4;background:#f6f6f6;">';
	// 		$emailtxt.='<div';
	// 		$emailtxt.=' style="font-size: 16px; line-height: 1.5;line-height: 20px; color: #333333;">';
	// 		$emailtxt.='<p';
	// 		$emailtxt.=' style="font-size: 16px; line-height: 1.5;line-height: 20px; text-align: right; word-break: break-word; color:#669934;line-height:1.2;margin: 0;">';
	// 		$emailtxt.='<span  style="font-size: 16px;">';
	// 		$emailtxt.='<a href="mailto:'.$rowcmp['email1'].'"';
	// 		$emailtxt.=' style="text-decoration:none;background-color: transparent; font-size: 16px;color:#669934;font-weight:600;white-space: nowrap; color:#669934;"';
	// 		$emailtxt.='target="_blank">';
	// 		$emailtxt.='<span';
	// 		$emailtxt.=' style="background-color:transparent; font-size:16px; color:#669934; font-weight:600">'.$rowcmp['email1'].'</span></a>';
	// 		$emailtxt.='</span>';
	// 		$emailtxt.='</p>';
	// 		$emailtxt.='</div>';
	// 		$emailtxt.='</td>';

	// 		$emailtxt.='</tr>';
	// 		$emailtxt.='<tr>';
	// 		$emailtxt.='<td colspan="10"  style="padding-right: 10px; padding-left: 10px; padding-top: 30px; padding-bottom: 30px;border-top: 1px dotted #C4C4C4;">';
	// 		$emailtxt.='<div';
	// 		$emailtxt.=' style="font-size: 16px; line-height: 1.5;line-height: 20px; color: #333333;text-align: end;">';
	// 		$emailtxt.='<span  style="text-align: right;">We are glad you are here!<br>';
	// 		$emailtxt.='<b>'.$rowcmp['companyname'].' Team</b></span>';
	// 		$emailtxt.='</div>';
	// 		$emailtxt.='</td>';
	// 		$emailtxt.='</tr>';
	// 		$emailtxt.='</tfoot>';
	// 		$emailtxt.='</table>';
	// 		$emailtxt.='</td>';
	// 		$emailtxt.='</tr>';
	// 		$emailtxt.='</tbody>';
	// 		$emailtxt.='</table>';
	// 		$emailtxt.='</td>';
	// 		$emailtxt.='</tr>';
	// 		$emailtxt.='</tbody>';
	// 		$emailtxt.='</table>';
	// 		$emailtxt.='</div>';
	// 		$emailtxt.='</div>';
	// 		$emailtxt.='</body>';
	// 		$emailtxt.='</html>';




	// 		//    echo $emailtxt;
	// 		//    exit;
	// 		// return $emailtxt;
	// 		return self::sendemail($emailto,$subject,$emailtxt,$files,$bcc,$cc,$sendername,$emailhostid);
	// 	}

	function getemailbody($emailto, $subject, $data, $files, $bcc, $cc, $sendername, $emailhostid)
	{
		$config = new config();
		$CompanyInfo = new CompanyInfo();
		$CompanyInfo = self::getcompanyinfo($config->getDefaultCmpId());
		$rowcmp = $CompanyInfo[0];

		$data = preg_replace(
			'/(?:Verification(?:\s|&nbsp;|&#160;)+Code)(?:\s|&nbsp;|&#160;)*(?=<strong\b)/i',
			'',
			$data
		);

		ob_start();
?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title><?= htmlspecialchars($subject); ?></title>
		</head>

		<body style="margin: 0; padding: 0; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #f8fafc; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b;">

			<!-- Main Background Table -->
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; padding: 40px 15px;">
				<tr>
					<td align="center">

						<!-- Email Card Container -->
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 580px; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">

							<!-- Top Accent Line -->
							<tr>
								<td style="background-color: #669934; height: 5px; line-height: 5px; font-size: 1px;">&nbsp;</td>
							</tr>

							<!-- Header / Logo -->
							<tr>
								<td align="center" style="padding: 36px 30px 20px 30px;">
									<a href="<?= $config->getCdnurl(); ?>" target="_blank" style="text-decoration: none; display: inline-block;">
										<img src="https://tradecvd.com/assets/images/header-sticky.svg" alt="<?= htmlspecialchars($rowcmp['companyname']); ?>" width="170" style="display: block; width: 170px; max-width: 170px; height: auto; border: 0; outline: none;" />
									</a>
								</td>
							</tr>

							<!-- Dynamic Content ($data) -->
							<tr>
								<td style="padding: 10px 40px 30px 40px;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td style="font-size: 15px; line-height: 1.6; color: #334155;">
												<?= $data; ?>
											</td>
										</tr>
									</table>
								</td>
							</tr>

							<!-- Subtle Help Box -->
							<tr>
								<td style="padding: 0 40px 30px 40px;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; border-radius: 8px; padding: 16px 20px;">
										<tr>
											<td style="font-size: 13px; color: #64748b; text-align: center; line-height: 1.5;">
												If you have any questions or didn't request this email, simply reply to this message or contact our support team.
											</td>
										</tr>
									</table>
								</td>
							</tr>

							<!-- Clean Footer -->
							<tr>
								<td style="background-color: #f8fafc; padding: 24px 40px; border-top: 1px solid #e2e8f0;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<!-- Left Side: Company Name & Note -->
											<td align="left" style="font-size: 13px; color: #64748b; line-height: 1.4;">
												<strong style="color: #1e293b;"><?= htmlspecialchars($rowcmp['companyname']); ?></strong><br>
												We are glad you are here!
											</td>
											<!-- Right Side: Contact Email -->
											<td align="right" style="font-size: 13px; line-height: 1.4;">
												<a href="mailto:<?= htmlspecialchars($rowcmp['email1']); ?>" style="color: #669934; text-decoration: none; font-weight: 600;">
													<?= htmlspecialchars($rowcmp['email1']); ?>
												</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>

						</table>

					</td>
				</tr>
			</table>

		</body>

		</html>
<?php
		$emailtxt = ob_get_clean();

		return self::sendemail($emailto, $subject, $emailtxt, $files, $bcc, $cc, $sendername, $emailhostid);
	}

	function getpagemetadata($typeid)
	{
		$parms = array(
			':id' => $typeid,
		);
		// print_r($parms);

		$result_ary = self::getmenual("SELECT id,pagename,title,metakeywords,metadescription
									FROM tblwebpagemaster where type=:id", $parms);
		//print_r($parms);
		return $result_ary;
	}

	function userwisediamonjewelrylog($typeid, $uid)
	{
		$IISMethods = new IISMethods();
		$datetime = $IISMethods->getdatetime();
		$qrylog = "SELECT DISTINCT id FROM tbluserwisediamonjewelrylog WHERE typeid=:typeid AND uid=:uid";
		$paramslog = array(
			':typeid' => $typeid,
			':uid' => $uid,
		);
		$reslog = self::getmenual($qrylog, $paramslog);
		if (sizeof($reslog) > 0) {
			$rowlog = $reslog[0];
			$logdata = array(
				'entry_date' => $datetime
			);
			$logextraparams = array(
				'id' => $rowlog['id']
			);
			self::executedata('u', 'tbluserwisediamonjewelrylog', $logdata, $logextraparams);
		} else {
			$unqlogid = $IISMethods->generateuuid();
			$logdata = array(
				'id' => $unqlogid,
				'typeid' => $typeid,
				'uid' => $uid,
				'timestamp' => $datetime,
				'entry_date' => $datetime
			);
			self::executedata('i', 'tbluserwisediamonjewelrylog', $logdata, '');
		}
	}

	function getsubshapeid($fltshapeid)
	{

		$subshapeid = '';
		$qrysubshape = "SELECT GROUP_CONCAT(id) as subshapeid FROM tbldiamondshapemaster WHERE mainshapeid IN ('" . $fltshapeid . "') AND ifnull(issubshape,0)=1";
		$paramssubshape = array();
		$ressubshape = self::getmenual($qrysubshape, $paramssubshape);
		if (sizeof($ressubshape) > 0) {
			$subshapeid = $ressubshape[0]['subshapeid'];
		}
		return $subshapeid;
	}

	function getsubcutid($fltcutid)
	{

		$cutid = '';
		$qrysubcut = "SELECT GROUP_CONCAT(id) as cutid FROM tblcutmaster WHERE maincutid IN ('" . $fltcutid . "') AND ifnull(issubcut,0)=1";
		$paramssubcut = array();
		$ressubcut = self::getmenual($qrysubcut, $paramssubcut);
		if (sizeof($ressubcut) > 0) {
			$cutid = $ressubcut[0]['cutid'];
		}
		return $cutid;
	}

	function getsubpolishid($fltpolishid)
	{

		$polishid = '';
		$qrysubpolish = "SELECT GROUP_CONCAT(id) as polishid FROM tblpolishmaster WHERE mainpolishid IN ('" . $fltpolishid . "') AND ifnull(issubpolish,0)=1";
		$paramssubpolish = array();
		$ressubpolish = self::getmenual($qrysubpolish, $paramssubpolish);
		if (sizeof($ressubpolish) > 0) {
			$polishid = $ressubpolish[0]['polishid'];
		}
		return $polishid;
	}

	function getsubsymmetryid($fltsymmetryid)
	{

		$symmetryid = '';
		$qrysubsymmetry = "SELECT GROUP_CONCAT(id) as symmetryid FROM tblsymmetrymaster WHERE mainsymmetryid IN ('" . $fltsymmetryid . "') AND ifnull(issubsymmetry,0)=1";
		$paramssubsymmetry = array();
		$ressubsymmetry = self::getmenual($qrysubsymmetry, $paramssubsymmetry);
		if (sizeof($ressubsymmetry) > 0) {
			$symmetryid = $ressubsymmetry[0]['symmetryid'];
		}
		return $symmetryid;
	}

	function getsubeyecleanid($flteyecleanid)
	{

		$eyecleanid = '';
		$qrysubeyeclean = "SELECT GROUP_CONCAT(id) as eyecleanid FROM tbleyecleanmaster WHERE maineyecleanid IN ('" . $flteyecleanid . "') AND ifnull(issubeyeclean,0)=1";
		$paramssubeyeclean = array();
		$ressubeyeclean = self::getmenual($qrysubeyeclean, $paramssubeyeclean);
		if (sizeof($ressubeyeclean) > 0) {
			$eyecleanid = $ressubeyeclean[0]['eyecleanid'];
		}
		return $eyecleanid;
	}


	function getTotalDiamond($uid)
	{
		$qry = "SELECT SUM(totalprice) AS totaldiamond FROM tbldiamond WHERE personid=:uid";
		$params = array(':uid' => $uid);
		$res = self::getmenual($qry, $params);
		$totaldiamond = $res[0]['totaldiamond'];
		return $totaldiamond;
	}

	function getDeviceInLogin($uid, $useragent)
	{
		$qry = "SELECT id FROM tbldevice WHERE uid=:uid AND useragent=:useragent";
		$params = array(':uid' => $uid, ':useragent' => $useragent);
		$res = self::getmenual($qry, $params);
		$isdevicelogin = 0;
		if (sizeof($res) > 0) {
			$isdevicelogin = 1;
		}
		return $isdevicelogin;
	}


	public function getDBName()
	{
		return $this->DBName;
	}

	public function setDBName($DBName)
	{
		$this->DBName = $DBName;
	}

	public function getDBUser()
	{
		return $this->DBUser;
	}

	public function setDBUser($DBUser)
	{
		$this->DBUser = $DBUser;
	}

	public function getDBHost()
	{
		return $this->DBHost;
	}

	public function setDBHost($DBHost)
	{
		$this->DBHost = $DBHost;
	}

	public function getDBPass()
	{
		return $this->DBPass;
	}

	public function setDBPass($DBPass)
	{
		$this->DBPass = $DBPass;
	}

	public function getDBPort()
	{
		return $this->DBPort;
	}

	public function setDBPort($DBPort)
	{
		$this->DBPort = $DBPort;
	}

	public function getDBType()
	{
		return $this->DBType;
	}

	public function setDBType($DBType)
	{
		$this->DBType = $DBType;
	}

	public function getDBConn()
	{
		return $this->DBConn;
	}

	public function setDBConn($DBConn)
	{
		$this->DBConn = $DBConn;
	}
}
