<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

$datetime=$IISMethods->getdatetime();

$currdate=$IISMethods->getcurrdate();




$sendemailbeforedays=$config->getSendexpiryemailbefore();
$sendemailafterdays=$config->getSendexpiryemailafter();


 $qrypackage="SELECT tmp.*,CASE WHEN (STR_TO_DATE(:currdate2,'%d/%m/%Y') BETWEEN tmp.sendemailbeforedate AND DATE_SUB(tmp.expdate, INTERVAL 1 DAY)) THEN 1 ELSE 0 END AS sendemailbefore
             ,CASE WHEN (STR_TO_DATE(:currdate3,'%d/%m/%Y') BETWEEN DATE_ADD(tmp.expdate, INTERVAL 1 DAY) AND tmp.sendemailafterdate) THEN 1 ELSE 0 END AS sendemailafter
             FROM (SELECT p.id,p.transactionid,p.payment_date,p.packactivatedate,p.expirydate,p.packagename,p.packagetypeid,p.amount,p.discamt,p.paid_amount,p.finalamount,p.code,p.disctype,p.discper,
            IFNULL(p.couponapply,0) AS couponapply,p.checkout_status,p.payment_status,p.totalmonths,pm.email,pm.personname,
            DATE_SUB(STR_TO_DATE(p.`expirydate`,'%d/%m/%Y'), INTERVAL ".$sendemailbeforedays." DAY) AS sendemailbeforedate,
            DATE_ADD(STR_TO_DATE(p.`expirydate`,'%d/%m/%Y'), INTERVAL ".$sendemailafterdays." DAY) AS sendemailafterdate,
            DATEDIFF(STR_TO_DATE(p.`expirydate`,'%d/%m/%Y'),STR_TO_DATE(:currdate1,'%d/%m/%Y')) AS totalexpirydays,
            STR_TO_DATE(p.`expirydate`,'%d/%m/%Y') AS expdate 
            FROM tblpackageassign p
            INNER JOIN tblpersonmaster pm ON pm.id=p.uid
            WHERE p.`status`=1) AS tmp
            WHERE STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN tmp.sendemailbeforedate AND tmp.sendemailafterdate";
            
$parampackage=array(':currdate'=>$currdate,':currdate1'=>$currdate,':currdate2'=>$currdate,':currdate3'=>$currdate);
// print_r($parampackage);
$respackage=$DB->getmenual($qrypackage,$parampackage);
if(sizeof($respackage)>0){

    for($p=0;$p<sizeof($respackage);$p++){
        $rowp=$respackage[$p];

        
        $emailto=$rowp['email'];


        $emailtxt='';
        if($rowp['totalexpirydays']==0){
            $subject='Hi '.$rowp['personname'].', Your Package('.$rowp['packagename'].') has been expired!!';

            $emailtxt.='<tr>';
            $emailtxt.='<td colspan="10"';
            $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
            $emailtxt.='valign="top">';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
            $emailtxt.='Hi '.$rowp['personname'].',</p>';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
            $emailtxt.='Your Package('.$rowp['packagename'].') has been expired.</p>';
            $emailtxt.='</td>';
            $emailtxt.='</tr>';
        }   
        else if($rowp['sendemailbefore']==1){

            $subject='Hi '.$rowp['personname'].', Your Package('.$rowp['packagename'].') will expire on  '.$rowp['expirydate'].'!!';

            $emailtxt.='<tr>';
            $emailtxt.='<td colspan="10"';
            $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
            $emailtxt.='valign="top">';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
            $emailtxt.='Hi '.$rowp['personname'].',</p>';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
            $emailtxt.='Your Package('.$rowp['packagename'].') will expire on  '.$rowp['expirydate'].'.Avoid repeating all processes by clicking <a href="'.$config->getportalbaseurl().'profile" target="_blank">Renew Now</a></p>';
            $emailtxt.='</td>';
            $emailtxt.='</tr>';

        }
        else if($rowp['sendemailafter']==1){

            $subject='Hi '.$rowp['personname'].', Your Package('.$rowp['packagename'].') has been expired on '.$rowp['expirydate'].'!!';

            $emailtxt.='<tr>';
            $emailtxt.='<td colspan="10"';
            $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
            $emailtxt.='valign="top">';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
            $emailtxt.='Hi '.$rowp['personname'].',</p>';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
            $emailtxt.='Your Package('.$rowp['packagename'].') has been expired on '.$rowp['expirydate'].'.</p>';
            $emailtxt.='</td>';
            $emailtxt.='</tr>';
        }
        // echo  $emailtxt.' <br><br> ';
        $datares=$DB->getemailbody($emailto,$subject,$emailtxt,'','','','','');



       
    }

}
    
