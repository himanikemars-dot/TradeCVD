<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = $config->getPaymentEndPointKey();

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

$session = $event->data->object;
$id=$session->id;
$client_reference_id=$session->client_reference_id;
$payment_intent=$session->payment_intent;
$payment_status=$session->payment_status;
$status=$session->status;
$amount_total=$session->amount_total/100;
$datetime=$IISMethods->getdatetime();
//
$qrychk="SELECT id from tblpackageassign where transactionid=:transactionid AND status=0 AND payment_status<>'paid' AND checkout_status<>'complete'";
$parms = array(
':transactionid'=>$client_reference_id
);
$result_ary=$DB->getmenual($qrychk,$parms);
if(sizeof($result_ary)>0) 
{
    $row=$result_ary[0];
    $unqid = $IISMethods->generateuuid();
    $insqry_log=array(					
        'id'=>$unqid,
        'uid'=>$row['uid'],
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

    $_status=0;
    if($payment_status=='paid' && $status=='complete'){
      $_status=1;
    }
    $insqry=array(					
        'status'=>$_status,
        'update_uid'=>$row['uid'],
        'update_date'=>$datetime,
        'paid_amount'=>$amount_total,
        'payment_id'=>$id,
        'payment_intent'=>$payment_intent,
        'payment_status'=>$payment_status,
        'checkout_status'=>$status,
        'payment_jsonarr'=>json_encode($session,true),
        'payment_date'=>$datetime,
    );
   

    $insdetailqry=array(					
        'status'=>$_status,
        'isstatus'=>$_status,
        'update_uid'=>$row['uid'],
        'update_date'=>$datetime,
    );
   
    // Handle the event
    switch ($event->type) {
        case 'checkout.session.async_payment_failed':
            $ary=array(
            'id'=>$row['id'],
            );
            $DB->executedata('u','tblpackageassign',$insqry,$ary);

            $arydetail=array(
                'packassignid'=>$row['id'],
            );
            $DB->executedata('u','tblpackageassigndetail',$insdetailqry,$arydetail);

            $insqry_log['status']=$_status;
            $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
        case 'checkout.session.async_payment_succeeded':
            $ary=array(
             'id'=>$row['id'],
            );
            $DB->executedata('u','tblpackageassign',$insqry,$ary);

            $arydetail=array(
                'packassignid'=>$row['id'],
            );
            $DB->executedata('u','tblpackageassigndetail',$insdetailqry,$arydetail);

            $insqry_log['status']=$_status;
            $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
        case 'checkout.session.completed':
            $ary=array(
             'id'=>$row['id'],
            );
            $DB->executedata('u','tblpackageassign',$insqry,$ary);

            $arydetail=array(
                'packassignid'=>$row['id'],
            );
            $DB->executedata('u','tblpackageassigndetail',$insdetailqry,$arydetail);

            $insqry_log['status']=$_status;
            $DB->executedata('i','tblpaymenttransactionlog',$insqry_log,'');
        
        default:
        echo 'Received unknown event type ' . $event->type;
    }

    http_response_code(200);
}

