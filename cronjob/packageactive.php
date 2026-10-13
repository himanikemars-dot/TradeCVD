<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

$datetime=$IISMethods->getdatetime();
$currdate=$IISMethods->getcurrdate();

$qryperson="SELECT pm.`id` 
FROM `tblpersonmaster` pm
INNER JOIN `tblpersonutype` pu ON pu.`pid`=pm.`id`
WHERE pu.`utypeid`=:utypeid AND pm.`isactive`=1 AND pm.`isdelete`<>1
GROUP BY pm.id";
$paramperson=array(':utypeid'=>$config->getcustomerutypeid());
$resperson=$DB->getmenual($qryperson,$paramperson);
if(sizeof($resperson)>0){

    for($p=0;$p<sizeof($resperson);$p++){
        $rowp=$resperson[$p];
        $qrycheckcurpack="SELECT id FROM tblpackageassign WHERE uid=:uid AND status=1 AND isactive=1 AND STR_TO_DATE(expirydate,'%d/%m/%Y')<STR_TO_DATE(:currdate,'%d/%m/%Y')";
        $paramcheckcurpack=array(':uid'=>$rowp['id'],':currdate'=>$currdate);
        // print_r($paramcheckcurpack);
        $rescheckcurpack=$DB->getmenual($qrycheckcurpack,$paramcheckcurpack);
        if(sizeof($rescheckcurpack)>0) {
            for($pc=0;$pc<sizeof($rescheckcurpack);$pc++){
                $rowpc=$rescheckcurpack[$pc];
                $updqry=array(					
                    'isactive'=>0,
                );
                $aryupd=array(
                    'id'=>$rowpc['id'],
                );
                $DB->executedata('u','tblpackageassign',$updqry,$aryupd);
            }
            
        }
        $qrycheckall="SELECT id FROM tblpackageassign WHERE uid=:uid AND status=1 AND isactive=0 AND (STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(packactivatedate,'%d/%m/%Y') AND STR_TO_DATE(expirydate,'%d/%m/%Y')) ORDER BY STR_TO_DATE(packactivatedate,'%d/%m/%Y') ASC LIMIT 1";
        $paramcheckall=array(':uid'=>$rowp['id'],':currdate'=>$currdate);
        $rescheckall=$DB->getmenual($qrycheckall,$paramcheckall);
        if(sizeof($rescheckall)>0) 
        {
            for($pl=0;$pl<sizeof($rescheckall);$pl++){
                $rowpl=$rescheckall[$pl];
                $updqry1=array(					
                    'isactive'=>1,
                );
                $aryupd1=array(
                    'id'=>$rowpl['id'],
                );
                $DB->executedata('u','tblpackageassign',$updqry1,$aryupd1);
            }
        }
    }

}
    
