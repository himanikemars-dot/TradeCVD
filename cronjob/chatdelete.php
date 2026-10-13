<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

$datetime=$IISMethods->getdatetime();
$currdate=$IISMethods->getcurrdate();
$devicedeletemin=$config->getDevicedeletemin();

$curdate=date('Y-m-d H:i');

$qrydays="SELECT chatdeletedays FROM `tblchatdeletemaster` ORDER BY id ASC LIMIT 1";
$resdays=$DB->getmenual($qrydays);
$rowdays=$resdays[0];
$chatdeletedays=$rowdays['chatdeletedays'];

$qry="SELECT * FROM `tblchatmessage` WHERE DATE_ADD(STR_TO_DATE(entry_date,'%Y-%m-%d %H:%i'), INTERVAL :chatdeletedays DAY)<=STR_TO_DATE(:curdate,'%Y-%m-%d %H:%i') AND ischatdelete=0";
$params=array(
    ':chatdeletedays'=>$chatdeletedays,
    ':curdate'=>$curdate,
);
// print_r($params);
$res=$DB->getmenual($qry,$params);
// print_r($res);
if(sizeof($res)>0)
{
    foreach($res AS $row)
    {
        $insdata = array(
            'ischatdelete'=>1,
            'chatdeletedate'=>$IISMethods->getdatetime(),
        );
        
        $extraparams=array(
            'id'=>$row['id']
        );
        $DB->executedata('u','tblchatmessage',$insdata,$extraparams);  
    }
}
