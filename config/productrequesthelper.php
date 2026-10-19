<?php
/**
 * Product Request + Notification helpers.
 * Existing DB.php ને અડ્યા વગર strict-write + notification + email.
 */

function prexec($DB, $operation, $tblname, $data, $extra = array())
{
    $DB->getDBConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB->executedata($operation, $tblname, $data, $extra);
}


function prclaim($DB, $requestid, $fromstatus, $upd)
{
    $set = array();
    $vals = array();
    foreach ($upd as $k => $v) {
        $set[] = $k . '=?';
        $vals[] = $v;
    }
    $vals[] = $requestid;
    $vals[] = $fromstatus;

    $conn = $DB->getDBConn();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("UPDATE tblproductrequest SET " . implode(', ', $set) . " WHERE id=? AND status=? AND isactive=1");
    $stmt->execute($vals);
    return $stmt->rowCount();
}

/** Chat deep-link (relative, portalbaseurl પાછળ લાગશે) */
function prchatlink($groupid, $personid, $chattype, $productid, $producttype = 2)
{
    return 'chat?groupid=' . urlencode($groupid)
        . '&personid=' . urlencode($personid)
        . '&chattype=' . (int)$chattype
        . '&productid=' . urlencode($productid)
        . '&producttype=' . (int)$producttype;
}

function prsendmail($DB, $config, $emailto, $subject, $hello, $heading, $lines, $linkurl, $linktext)
{
    if (!$emailto) {
        return;
    }
    $emailtxt  = '<tr><td colspan="10" style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;" valign="top">';
    $emailtxt .= '<p style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">Hello, ' . $hello . '</p>';
    $emailtxt .= '<p style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">' . $heading . '</p>';
    $emailtxt .= '</td></tr>';
    $emailtxt .= '<tr><td colspan="10" style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;" valign="top">';
    $emailtxt .= '<div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';
    foreach ($lines as $label => $val) {
        $emailtxt .= '<p style="padding:10px;"><b>' . $label . ' :</b> ' . $val . '</p>';
    }
    $emailtxt .= '<p style="padding:10px;"><strong><a href="' . $config->getportalbaseurl() . $linkurl . '">Click Here</a> ' . $linktext . '</strong></p>';
    $emailtxt .= '</div></td></tr>';

    try {
        $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');
    } catch (Exception $e) {
    }
}
?>
