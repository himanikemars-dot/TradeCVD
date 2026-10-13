<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

$expday=$config->getDiamondjewelryexpday();
$date=date('Y-m-d');
$qrysel = "SELECT id,uid,typeid 
        FROM tbluserwisediamonjewelrylog 
        WHERE STR_TO_DATE(entry_date,'%Y-%m-%d') <= DATE_SUB(:date, INTERVAL :expday DAY)";
$param = array(
    ':date'=>$date,
    ':expday'=>$expday
);

$res = $DB->getmenual($qrysel, $param);
if(sizeof($res)>0)
{
    foreach($res AS $row)
    {
        if($row['typeid']==1)
        {
            $extraparams=array(
                'entry_uid'=>$row['uid']
            );
            $updata=array(
                'isactive'=>0
            );
            $DB->executedata('u', 'tbldiamond', $updata, $extraparams);
        }else if($row['typeid']==2)
        {
            $extraparams=array(
                'entry_uid'=>$row['uid']
            );
            $updata=array(
                'isactive'=>0
            );
            $DB->executedata('u', 'tbljewellery', $updata, $extraparams);
        }
    }
}