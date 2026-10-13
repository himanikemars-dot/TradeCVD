<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';
require_once dirname(__DIR__, 1) . '/config/productrequesthelper.php';

$datetime = $IISMethods->getdatetime();

$rows = $DB->getmenual(
    "SELECT pr.id, pr.requestno, pr.buyerid, pr.productname
     FROM tblproductrequest pr
     WHERE pr.status = 1 AND pr.isactive = 1 AND pr.expirydate < CURDATE()",
    array());

foreach ($rows as $pr) {
    try {
        $DB->begintransaction();
        prclaim($DB, $pr['id'], 1, array(
            'status' => 5, 'statustext' => 'Expired', 'actiondate' => $datetime,
            'pendingkey' => null, 'update_date' => $datetime, 'timestamp' => $datetime,
        ));
        $DB->committransaction();
    } catch (Exception $e) {
        $DB->rollbacktransaction($e);
    }
}
echo 'done';
?>
