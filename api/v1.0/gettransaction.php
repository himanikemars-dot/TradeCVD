<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

$datetime=$IISMethods->getdatetime();

$stripe = new \Stripe\StripeClient($config->getPaymentApiKey());
$session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
// print_r(json_encode($session));
// print_r($session->id);
$id=$session->id;
$client_reference_id=$session->client_reference_id;
$payment_intent=$session->payment_intent;
$payment_status=$session->payment_status;
$status=$session->status;
$amount_total=$session->amount_total/100;

$unqid = $IISMethods->generateuuid();
$insqry_log=array(					
  'id'=>$unqid,
  'uid'=>$LoginInfo->getUid(),
  'transactionid'=>$client_reference_id,
  'paid_amount'=>$amount_total,
  'payment_id'=>$id,
  'payment_intent'=>$payment_intent,
  'payment_status'=>$payment_status,
  'checkout_status'=>$status,
  'payment_jsonarr'=>json_encode($session,true),
  'payment_date'=>$datetime,
  'entry_date'=>$datetime,
  'timestamp'=>$datetime
);
   

try {
  $qrycheck_order="SELECT id,frompackageassignid,btntype FROM tblpackageassign WHERE uid=:uid AND transactionid=:transactionid AND status=0 AND IFNULL(payment_status,'')='' AND IFNULL(checkout_status,'')=''";
  $paramchk_order=array(':uid'=>$LoginInfo->getUid(),':transactionid'=>$client_reference_id);
  $reschk_order=$DB->getmenual($qrycheck_order,$paramchk_order);
  if(sizeof($reschk_order)>0) {
    $roworder=$reschk_order[0];
    $packageassignid=$roworder['id'];
    $frompackageassignid=$roworder['frompackageassignid'];
    $btntype=$roworder['btntype'];
      try 
      {
          $DB->begintransaction();
          $_status=0;
          $_isactive=0;
          if($payment_status=='paid' && $status=='complete'){
              $_status=1;
              $_isactive=1;
              if($btntype==1)
              {
                $updqry=array(		
                  'ispackageupgrade'=>1,
                  'isactive'=>0,
                  'upgrade_datetime'=>$datetime,
                );
                $updary=array(
                  'id'=>$frompackageassignid,
                );
                $DB->executedata('u','tblpackageassign',$updqry,$updary);
              }
              else if($btntype==2){
                $_isactive=0;
                $updqry=array(		
                  'ispackagerenew'=>1,
                  'renew_datetime'=>$datetime,
                );
                $updary=array(
                  'id'=>$frompackageassignid,
                );
                $DB->executedata('u','tblpackageassign',$updqry,$updary);
              }
          }


          $insqry=array(					
            'status'=>$_status,
            'update_uid'=>$uid,
            'update_date'=>$datetime,
            'paid_amount'=>$amount_total,
            'payment_id'=>$id,
            'payment_intent'=>$payment_intent,
            'payment_status'=>$payment_status,
            'checkout_status'=>$status,
            'payment_jsonarr'=>json_encode($session,true),
            'payment_date'=>$datetime,
            'isactive'=>$_isactive,
          );
          $ary=array(
            'id'=>$packageassignid,
          );
          $DB->executedata('u','tblpackageassign',$insqry,$ary);

          $insdetailqry=array(					
            'status'=>$_status,
            'isstatus'=>$_status,
            'update_uid'=>$LoginInfo->getUid(),
            'update_date'=>$datetime,
          );
          $arydetail=array(
            'packassignid'=>$packageassignid,
          );
          $DB->executedata('u','tblpackageassigndetail',$insdetailqry,$arydetail);


          $IISMethods->removecoupon($LoginInfo);
          
          $insqry_log['error_msg']='Success';
          $insqry_log['status']=$_status;
          $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
          $DB->committransaction();
          $statustext=md5('success');  
          $redirecturl=$config->getWeburl().'transaction?Service_Auth=savanigems&passive=false&tid='.$client_reference_id.'&tmpl=default&tmpcache=true&method=op&continue='.$statustext.'';

          if($_status==1){

            $qrypackge="SELECT p.id,p.transactionid,p.payment_date,p.packactivatedate,p.expirydate,p.packagename,p.packagetypeid,p.amount,p.discamt,p.paid_amount,p.finalamount,p.code,p.disctype,p.discper,
                        ifnull(p.couponapply,0) AS couponapply,p.checkout_status,p.payment_status,p.totalmonths,pm.email,pm.personname 
                        FROM tblpackageassign p
                        inner join tblpersonmaster pm on pm.id=p.uid
                        WHERE p.id=:id";
            $parampackge=array(':id'=>$packageassignid);
			      $respackge=$DB->getmenual($qrypackge,$parampackge);
            $roworder=$respackge[0];

            $packagetypetext='';
            if($roworder['packagetypeid']==1){
              $packagetypetext='Annually';
            }
            else if($roworder['packagetypeid']==2){
              $packagetypetext='Monthly';
            }
            if($roworder['totalmonths']>1){
              $packagemonthstext=$roworder['totalmonths'].' Months';
            }
            else {
              $packagemonthstext=$roworder['totalmonths'].' Month';
            }

            $emailtxt.='<tr>';
            $emailtxt.='<td colspan="10"';
            $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
            $emailtxt.='valign="top">';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
            $emailtxt.='Hi '.$roworder['personname'].',</p>';
            $emailtxt.='<p';
            $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
            $emailtxt.='Your Transaction Successfully Completed.</p>';
            $emailtxt.='</td>';
            $emailtxt.='</tr>';
            $emailtxt.='<tr>';
            $emailtxt.='    <td colspan="10"';
            $emailtxt.='      style="width:100%;vertical-align:top;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;background:#f6f6f6;border:1px solid #669934;border-left:1px solid #669934;">';
            $emailtxt.='      <div>';
            $emailtxt.='        <i>';
            $emailtxt.='          <p';
            $emailtxt.='            style="text-align:left;font-size: 18px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='            Summary';
            $emailtxt.='          </p>';
            $emailtxt.='        </i>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
            $emailtxt.='          Transaction ID#: <strong style="color:#000000;">'.$roworder['transactionid'].'</strong>';
            $emailtxt.='        </p>';
            $emailtxt.='      </div>';
            $emailtxt.='      <div>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
            $emailtxt.='          Transaction Date: <strong style="color:#000000;">'.$roworder['payment_date'].'</strong>';
            $emailtxt.='        </p>';
            $emailtxt.='      </div>';
            $emailtxt.='      <div>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
            $emailtxt.='          Activation Date : <strong style="color:#000000;">'.$roworder['packactivatedate'].'</strong>';
            $emailtxt.='        </p>';
            $emailtxt.='      </div>';

            $emailtxt.='      <div>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
            $emailtxt.='          Expiration Date : <strong style="color:#000000;"> '.$roworder['expirydate'].' </strong>';
            $emailtxt.='        </p>';
            $emailtxt.='      </div>';

            $emailtxt.='      <div>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
            $emailtxt.='          Package Amount : <strong style="color:#000000;">$ '.$roworder['amount'].'</strong>';
            $emailtxt.='        </p>';
            $emailtxt.='      </div>';

            if($roworder['couponapply']==1)
            {
              $emailtxt.='      <div>';
              $emailtxt.='        <p';
              $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
              $emailtxt.='          Coupon Code : <strong style="color:#000000;">'.$roworder['code'].'-';
                if($roworder['disctype']==1)
								{
									$emailtxt.='$ '.$roworder['discamt'].'';
								}
								else if($roworder['disctype']==2){
									$emailtxt.='$ '.$roworder['discamt'].'('.$roworder['discper'].'% Off)';
								}
              $emailtxt.=' Applied.</strong></p>';
              $emailtxt.='      </div>';
            }
          

            $emailtxt.='      <div>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 14px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#333333;font-weight:normal;margin:0;">';
            $emailtxt.='          Amount : <strong style="color:#000000;">$ '.$roworder['paid_amount'].'</strong>';
            $emailtxt.='        </p>';
            $emailtxt.='      </div>';
            $emailtxt.='    </td>';
            $emailtxt.='  </tr>';
            $emailtxt.='  <tr>';
            $emailtxt.='    <td colspan="10"';
            $emailtxt.='      style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
            $emailtxt.='      valign="top">';
            $emailtxt.='      <p style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
            $emailtxt.='        Transaction Details';
            $emailtxt.='      </p>';
            $emailtxt.='    </td>';
            $emailtxt.='  </tr>';
            $emailtxt.='  <tr>';
            $emailtxt.='    <td colspan="4"';
            $emailtxt.='      style="width:40%;vertical-align:top;padding-top:20px;padding-bottom:20px;background:#f6f6f6;border-bottom:1px solid #669934;padding-left:10px;">';
            $emailtxt.='      <p';
            $emailtxt.='        style="text-align:left;font-size:13px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='        Package Name';
            $emailtxt.='      </p>';
            $emailtxt.='    </td>';
            $emailtxt.='    <td colspan="3"';
            $emailtxt.='      style="width:150px;vertical-align:top;padding-top:20px;padding-bottom:20px;background:#f6f6f6;border-bottom:1px solid #669934;padding-left:10px;">';
            $emailtxt.='      <p';
            $emailtxt.='        style="text-align:left;font-size:13px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='        Validity';
            $emailtxt.='      </p>';
            $emailtxt.='    </td>';
            $emailtxt.='    <td colspan="3"';
            $emailtxt.='      style="width:30%;vertical-align:top;padding-top:20px;padding-bottom:20px;background:#f6f6f6;border-bottom:1px solid #669934;padding-left:10px;">';
            $emailtxt.='      <p';
            $emailtxt.='        style="text-align:left;font-size:13px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='        Amount';
            $emailtxt.='      </p>';
            $emailtxt.='    </td>';
            $emailtxt.='  </tr>';
            $emailtxt.='  <tr>';
            $emailtxt.='    <td colspan="4"';
            $emailtxt.='      style="width:40%;vertical-align:top;padding-top:20px;padding-bottom:20px;background:#FFFFFF;border-bottom:1px solid #f6f6f6;padding-left:10px;">';
            $emailtxt.='      <i>';
            $emailtxt.='        <p';
            $emailtxt.='          style="text-align:left;font-size: 18px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='          '.$roworder['packagename'].' ';
            $emailtxt.='        </p>';
            $emailtxt.='      </i>';
            $emailtxt.='    </td>';
            $emailtxt.='    <td colspan="3"';
            $emailtxt.='      style="width:150px;vertical-align:top;padding-top:20px;padding-bottom:20px;background:#FFFFFF;border-bottom:1px solid #f6f6f6;padding-left:10px;">';
            $emailtxt.='      <p';
            $emailtxt.='        style="text-align:left;font-size: 18px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='        '.$packagemonthstext.'';
            $emailtxt.='      </p>';
            $emailtxt.='    </td>';
            $emailtxt.='    <td colspan="3"';
            $emailtxt.='      style="width:30%;vertical-align:top;padding-top:20px;padding-bottom:20px;background:#FFFFFF;border-bottom:1px solid #f6f6f6;padding-left:10px;">';
            $emailtxt.='      <p';
            $emailtxt.='        style="text-align:left;font-size:18px; line-height: 1.5;line-height: 20px; word-break: break-word;color:#669934;font-weight:600;margin:0;">';
            $emailtxt.='        $ '.$roworder['paid_amount'].'';
            $emailtxt.='      </p>';
            $emailtxt.='    </td>';
            $emailtxt.='  </tr>';
            $emailtxt.='  <tr>';
            $emailtxt.='    <td colspan="10"';
            $emailtxt.='      style="word-break: break-word; vertical-align: top;text-align: left;width:100%;padding-top:0px;padding-bottom:20px;"';
            $emailtxt.='      valign="top">';
            $emailtxt.='      <div class="col-12 " style="background-color:#fff;display: block;margin-left: auto;margin-right: auto;">';
            $emailtxt.='        <ul>';
            $emailtxt.='          <li class="membership-packages-price">';
            $emailtxt.='            <h4>Package Detail </h4>';
            $emailtxt.='          </li>';
            $emailtxt.='          <li class="membership-packages-price">';
            $emailtxt.='            <h5>Package Name : '.$roworder['packagename'].'</h5>';
            $emailtxt.='          </li>';

            $emailtxt.='          <li>Duration : '.$roworder['packactivatedate'].' To '.$roworder['expirydate'].'';
            $emailtxt.='          </li>';

            $qry="SELECT `id`,`packassignid`,`qty`,`activateddate`,`expirydate`,`str_expirydate`,`isstatus`,`packagetypeid`,`uid`,`packageid`,`status`,`price`,`pfid`,`attributeval`,`isnolimit`,`limitvalue`,`pfname`,`pfprintname`,`displayorder`,`haslimit`,`withinputbox`,`inputboxlabel`,`isupgrade`,`isaddon`,`actualdate`,`deactivedate`,`deactivedatetime`,`reactivepack`,`mainexpirydate`,`entry_uid`,`entry_date`,`update_uid`,`update_date`,`timestamp`
                    FROM `tblpackageassigndetail` 
              where packassignid=:id AND attributeval=1";
            $parms = array(
              ':id'=>$packageassignid,
            );
            $items=$DB->getmenual($qry,$parms);
            if($items)
            {
              for($i=0;$i<sizeof($items);$i++)
              {
                  $rowpd=$items[$i];

                $emailtxt.='<li>'.$rowpd['pfname'].'';
                    if($rowpd['haslimit']==1)
                    {
                        if($rowpd['isnolimit']==1)
                        {
                            $emailtxt.=' (Unlimited)';
                        }	
                        else
                        {
                            $emailtxt.=' (Limited | '.$rowpd['limitvalue'].')';
                        }
                    }	
                $emailtxt.='</li>';
              }  

            }  


            $emailtxt.='        </ul>';
            $emailtxt.='      </div>';
            $emailtxt.='    </td>';
            $emailtxt.='  </tr>';


            $subject=''.$roworder['packagename'].' ('.$roworder['transactionid'].') - Transaction Success';
            $emailto=$roworder['email'];

            $datares=$DB->getemailbody($emailto,$subject,$emailtxt,'','','','','');
          }

      }
      catch (Exception $e) 
      {
          $insqry_log['error_msg']='Failed | DB Error:'.$e;
          $insqry_log['status']=$_status;
          $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
          $DB->rollbacktransaction($e);

          $statustext=md5('failure');  
          $redirecturl=$config->getWeburl().'transaction?Service_Auth=savanigems&passive=false&tid='.$client_reference_id.'&tmpl=default&tmpcache=true&method=op&continue='.$statustext.'';
         
      }
  }
  else{
    $insqry_log['error_msg']='Failed | Invalid Request.';
    $insqry_log['status']=0;
    $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
    $statustext=md5('failure');  
    $redirecturl=$config->getWeburl().'transaction?Service_Auth=savanigems&passive=false&tid='.$client_reference_id.'&tmpl=default&tmpcache=true&method=op&continue='.$statustext.'';
  

  }
} catch (Error $e) {
  $insqry_log['error_msg']='Failed | Gateway Error :'.$e->getMessage();
  $insqry_log['status']=0;
  $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
  $statustext=md5('failure');  
  $redirecturl=$config->getWeburl().'transaction?Service_Auth=savanigems&passive=false&tid='.$client_reference_id.'&tmpl=default&tmpcache=true&method=op&continue='.$statustext.'';

}
header('Location:'.$redirecturl.'');
