<?php 
require_once dirname(__DIR__, 1).'/config/sqldumper.php';
require_once dirname(__DIR__, 1).'/config/init.php';



$todaydt=date('Y-m-d');
$days_ago = date('Y-m-d', strtotime('-5 days', strtotime($todaydt)));
unlink("../savanigems_db_backup/dbbackup_".$days_ago.".sql.gz");

try {
	
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => $DB->getDBHost(),
		'username' => $DB->getDBUser(),
		'password' => $DB->getDBPass(),
		'db_name' => $DB->getDBName(),
	));
	
	$filename="../savanigems_db_backup/dbbackup_".$todaydt.".sql.gz";
	
	// dump the database to gzipped file
	//error_reporting(1);
	$world_dumper->dump($filename);
	//error_reporting(1);
	//echo '13';
	
	
	$cdate = date('Y-m-d');    
		
	//executedata('d','tbllog','',"DATE_FORMAT(logdatetime,'%Y-%m-%d') <= DATE_SUB('$cdate', INTERVAL 30 DAY)");
	//executedata('d','tblhistory','',"DATE_FORMAT(logdatetime,'%Y-%m-%d') <= DATE_SUB('$cdate', INTERVAL 30 DAY)");	
		
	$selquery ="SELECT * FROM `tbldatabackup` WHERE DATE_FORMAT(datetime,'%Y-%m-%d') <= '$days_ago'";
    $getrow = $DB->getmenual($selquery);
    // while($row1 = $getrow->fetch())
	foreach($getrow AS $row1)
    {
       $path = ($row1['path']);
       unlink($path);
    }
    $extraparams=array(
		"DATE_FORMAT(datetime,'%Y-%m-%d')<"=>$days_ago
	);
    // executedata('d','tbldatabackup','',"DATE_FORMAT(datetime,'%Y-%m-%d') <= '$days_ago'");
    $DB->executedata('d','tbldatabackup','',$extraparams);
	
    $zip_file_name = "savanigems_db_backup/dbbackup_".$todaydt.".sql.gz";
    $date = date('Y-m-d H:i:s');
	$unqid = $IISMethods->generateuuid();
	$backupdata = array(
		'id'=>$unqid,
		'uid'=>1,
		'path'=>$zip_file_name,
		'datetime'=>$date
	);
	//print_r($backupdata);
	$DB->executedata('i','tbldatabackup',$backupdata,'');
	
			
} catch(Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}