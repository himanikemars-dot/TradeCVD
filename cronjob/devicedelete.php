<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

$datetime=$IISMethods->getdatetime();
$currdate=$IISMethods->getcurrdate();
$devicedeletemin=$config->getDevicedeletemin();

$curdate=date('Y-m-d H:i');
$qry="SELECT * FROM `tbldevice` WHERE DATE_ADD(STR_TO_DATE(entry_date,'%Y-%m-%d %H:%i'), INTERVAL :devicedeletemin MINUTE)<=STR_TO_DATE(:curdate,'%Y-%m-%d %H:%i')";
$params=array(
    ':devicedeletemin'=>$devicedeletemin,
    ':curdate'=>$curdate
);
// print_r($params);
$res=$DB->getmenual($qry,$params);
if(sizeof($res)>0)
{
    foreach($res AS $row)
    {
        $extraparams=array(
            'id'=>$row['id']
        );
        $DB->executedata('d','tbldevice','',$extraparams);  
    }
}
