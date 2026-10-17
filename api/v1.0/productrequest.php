<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2) . '/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';
require_once dirname(__DIR__, 2) . '/config/productrequesthelper.php';
require_once dirname(__DIR__, 2) . '/model/productrequest.php';

// 4 - Member to Member Chat
$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'];
$candevicelogin = $DB->getDeviceInLogin($LoginInfo->getUid(), $_SERVER['HTTP_USER_AGENT']);

define('PR_EXPIRY_DAYS', 7);

if ($isvalidUser['status'] == 1) {
    if ($candevicelogin == 1) {
        $status = 0;
        $message = $errmsg['invalidrequest'];
        $datetime = $IISMethods->getdatetime();   // 'Y-m-d H:i:s' (IISMethods.php:331)

        $CheckUserRights = $DB->checkpackagewiseuserright($uid);
        $response['IsPackageExpire'] = $CheckUserRights['IsPackageExpire'];
        if ($CheckUserRights['IsPackageExpire'] == 1) {
            $message = $config->getPackageExpiredMessage();
            $response['ExpiryTitle'] = $config->getPackageExpiredTitle();
            $response['ExpiryURL'] = $config->getPackageExpiredURL();
        } else if ($LoginInfo->getIsguestuser() == 1) {
            $message = $errmsg['permissionrequired'];
        } else {

            /* =====================================================
             * ACTION 1 : addproductrequest  (Contact Seller → Request)
             * ===================================================== */
            if ($action == 'addproductrequest' || $action == 'adddiamondrequest') {
                $isdiamondrequest = ($action == 'adddiamondrequest');
                $productlabel = $isdiamondrequest ? 'Diamond' : 'Jewellery';
                $productname = '';
                if ($isdiamondrequest) {
                    $productid = $IISMethods->sanitize($_POST['contactsellerdiamondid']);
                    $messagetext = $IISMethods->sanitize($_POST['messagetext']);
                    $offerprice = $IISMethods->sanitize($_POST['offerprice']);
                    $producttype = 1;
                } else {
                    $productid   = $IISMethods->sanitize($_POST['contactsellerjewelleryid']);
                    $productname = $IISMethods->sanitize($_POST['contactsellerjewelleryname']);
                    $messagetext = $IISMethods->sanitize($_POST['jewellerymessagetext']);
                    $offerprice  = $IISMethods->sanitize($_POST['jewelleryofferprice']);
                    $producttype = 2;
                }
                if ($isdiamondrequest && $offerprice === '') {
                    $offerprice = 0;
                }

                if ($CanMemberToMemberChat != 1) {
                    $message = $errmsg['permissionrequired'];
                } else if (!$productid || !$messagetext || (!$isdiamondrequest && $offerprice === '')) {
                    $message = $errmsg['required'];
                } else {
                    if ($isdiamondrequest) {
                        $qrychk = "SELECT d.id, d.personid, pm.personname, pm.email,
                                          d.stock, d.shape, d.size, d.color, d.clarity
                                   FROM diamondlist d
                                   INNER JOIN tblpersonmaster pm ON pm.id = d.personid
                                   WHERE d.id = :id AND d.isactive = 1";
                    } else {
                        $qrychk = "SELECT d.id, d.personid, pm.personname, pm.email
                                   FROM jewellerylist d
                                   INNER JOIN tblpersonmaster pm ON pm.id = d.personid
                                   WHERE d.id = :id AND d.isactive = 1";
                    }
                    $reschk = $DB->getmenual($qrychk, array(':id' => $productid));

                    if (sizeof($reschk) == 0) {
                        $message = $isdiamondrequest ? $errmsg['nodiamondfound'] : $errmsg['nojewelleryfound'];
                    } else if ($reschk[0]['personid'] == $uid) {                       // F4 guard
                        $message = $errmsg['ownproductrequest'];
                    } else {
                        $seller = $reschk[0];
                        if ($isdiamondrequest) {
                            $productname = trim(implode(' ', array_filter(array(
                                $seller['stock'], $seller['shape'], $seller['size'] ? $seller['size'] . 'ct' : '',
                                $seller['color'], $seller['clarity'],
                            ))));
                        }
                        $pendingkey = $uid . '|' . ($isdiamondrequest ? 'diamond|' : '') . $productid;

                        $qrydup = "SELECT id FROM tblproductrequest WHERE pendingkey = :pk";
                        $resdup = $DB->getmenual($qrydup, array(':pk' => $pendingkey));

                        if (sizeof($resdup) > 0) {
                            $message = $errmsg['productrequestpending'];
                        } else {
                            $resbuyer = $DB->getmenual("SELECT personname, email FROM tblpersonmaster WHERE id = :id", array(':id' => $uid));
                            $buyer = $resbuyer[0];

                            $resmax = $DB->getmenual("SELECT IFNULL(MAX(maxid),0) + 1 AS nextid FROM tblproductrequest", array());
                            $maxid = (int)$resmax[0]['nextid'];
                            $requestno = 'PR-' . str_pad($maxid, 6, '0', STR_PAD_LEFT);

                            $requestid = $IISMethods->generateuuid();

                            try {
                                $DB->begintransaction();

                                $insdata = array(
                                    'id'          => $requestid,
                                    'requestno'   => $requestno,
                                    'maxid'       => $maxid,
                                    'buyerid'     => $uid,
                                    'buyername'   => $buyer['personname'],
                                    'sellerid'    => $seller['personid'],
                                    'sellername'  => $seller['personname'],
                                    'producttype' => $producttype,
                                    'productid'   => $productid,
                                    'productname' => $productname,
                                    'message'     => $messagetext,
                                    'offerprice'  => $offerprice,
                                    'status'      => 1,
                                    'statustext'  => 'Pending',
                                    'expirydate'  => date('Y-m-d', strtotime('+' . PR_EXPIRY_DAYS . ' days')),
                                    'pendingkey'  => $pendingkey,
                                    'isactive'    => 1,
                                    'entry_uid'   => $uid,
                                    'entry_date'  => $datetime,
                                    'timestamp'   => $datetime,
                                );
                                prexec($DB, 'i', 'tblproductrequest', $insdata);

                                $DB->committransaction();

                                $status = 1;
                                $message = $errmsg['productrequestsent'];
                                $response['result'] = array('requestid' => $requestid, 'requestno' => $requestno);

                                prsendmail($DB, $config, $seller['email'],
                                    'New Product Request ' . $requestno . ' from ' . $buyer['personname'],
                                    $seller['personname'],
                                    'You have received a new product request',
                                    array('Request No' => $requestno, $productlabel => $productname,
                                          'Message' => $messagetext, 'Offer Price' => ((float)$offerprice > 0 ? '$' . $offerprice : '-'),
                                          'Send By' => $buyer['personname'], 'Date Time' => $datetime),
                                    'buyrequest?tab=seller_productrequest', 'To Approve / Cancel Request');
                            } catch (Exception $e) {
                                $DB->rollbacktransaction($e);
                                $status = 0;
                                $message = $errmsg['dbtransactionerror'];
                            }
                        }
                    }
                }
            }

            /* =====================================================
             * ACTION 2 : listproductrequest
             *   box = received (seller) | sent (buyer)
             * ===================================================== */
            else if ($action == 'listproductrequest') {
                $box = $IISMethods->sanitize($_POST['box']);
                $view = $IISMethods->sanitize($_POST['view']);
                $fltstatus = (int)$IISMethods->sanitize($_POST['fltstatus']);

                $qry = "SELECT pr.id, pr.requestno, pr.buyerid, pr.buyername, pr.sellerid, pr.sellername,
                               pr.producttype, pr.productid, pr.productname, pr.message, pr.offerprice,
                               CASE WHEN pr.buyerid = :uid_requesttype THEN 'my_buy_request' ELSE 'buyer_request' END AS requesttype,
                               CASE WHEN pr.producttype = 1 THEN
                                   IFNULL((SELECT CONCAT(:imgurl_d, di.image)
                                           FROM tbldiamondimages di
                                           WHERE di.diamondid = pr.productid
                                           ORDER BY di.timestamp DESC
                                           LIMIT 1), :defaultdiamondimgurl)
                               ELSE
                                   IFNULL((SELECT CONCAT(:imgurl_j, ji.image)
                                           FROM tbljewelleryimages ji
                                           WHERE ji.jewelleryid = pr.productid
                                           ORDER BY ji.timestamp DESC
                                           LIMIT 1), :defaultjewelleryimgurl)
                               END AS productimage,
                               pr.status, pr.statustext, IFNULL(pr.groupid,'') AS groupid,
                               DATE_FORMAT(pr.entry_date,'%d/%m/%Y %h:%i %p') AS createdate,
                               CASE WHEN (pr.sellerid = :uid_canapprove AND pr.status = 1) THEN 1 ELSE 0 END AS canapprove,
                               CASE WHEN (pr.sellerid = :uid_cancancel AND pr.status = 1) THEN 1 ELSE 0 END AS cancancel,
                               CASE WHEN (pr.status = 2 AND pr.groupid IS NOT NULL AND pr.groupid <> '') THEN 1 ELSE 0 END AS canopenchat
                        FROM tblproductrequest pr
                        WHERE pr.isactive = 1 ";
                $params = array(
                    ':uid_canapprove' => $uid,
                    ':uid_cancancel' => $uid,
                    ':uid_requesttype' => $uid,
                    ':uid2' => $uid,
                    ':imgurl_d' => $config->getImageurl(),
                    ':imgurl_j' => $config->getImageurl(),
                    ':defaultdiamondimgurl' => $config->getDefualtDiamondImageurl(),
                    ':defaultjewelleryimgurl' => $config->getDefualtJewelleryImageurl(),
                );

                if ($view == 'buyer_myrequest' || $view == 'buyer_status') {
                    $qry .= " AND pr.buyerid = :uid2 ";
                } else if ($view == 'seller_productrequest') {
                    $qry .= " AND pr.sellerid = :uid2 AND pr.status = 1 ";
                } else if ($view == 'seller_status') {
                    $qry .= " AND pr.sellerid = :uid2 AND pr.status IN (2,3,4,5) ";
                } else if ($view == 'trade_status') {
                    $qry .= " AND (pr.buyerid = :uid2 OR (pr.sellerid = :uid2 AND pr.status IN (2,3,4,5))) ";
                } else if ($view == 'trade_allrequest') {
                    $qry .= " AND (pr.buyerid = :uid2 OR (pr.sellerid = :uid2 AND pr.status = 1)) ";
                } else if ($box == 'sent') {
                    $qry .= " AND pr.buyerid = :uid2 ";
                } else {
                    $qry .= " AND pr.sellerid = :uid2 ";
                }
                if ($fltstatus > 0) {
                    $qry .= " AND pr.status = :fltstatus ";
                    $params[':fltstatus'] = $fltstatus;
                }
                // $start, $per_page apiconfig.php:103-118 ma (int) cast thayela chhe
                $prstart   = ((int)$start > 0) ? (int)$start : 0;
                $prperpage = ((int)$per_page > 0) ? (int)$per_page : 20;
                $qry .= " ORDER BY pr.entry_date DESC LIMIT " . $prstart . ", " . $prperpage;

                $rows = $DB->getmenual($qry, $params, 'listproductrequest');

                foreach ($rows as $r) {
                    $r->chatlink = '';
                    if ($r->canopenchat == 1) {
                        $isbuyerview = ($view == 'buyer_myrequest' || $view == 'buyer_status' || $view == 'trade_status' || $view == 'trade_allrequest' || $box == 'sent') && $r->buyerid == $uid;
                        $r->chatlink = $isbuyerview
                            ? prchatlink($r->groupid, $r->sellerid, 2, $r->productid, $r->producttype)
                            : prchatlink($r->groupid, $r->buyerid, 1, $r->productid, $r->producttype);
                    }
                }
                if (sizeof($rows) > 0) {
                    $response['result'] = $rows;
                    $status = 1;
                    $message = $errmsg['success'];
                } else {
                    $status = 0;
                    $message = $errmsg['nodatafound'];
                }
                $common_listdata = $rows;   // apifoot.php pagination
            }
            else if ($action == 'approveproductrequest') {
                $requestid = $IISMethods->sanitize($_POST['requestid']);

                $qrypr = "SELECT pr.*, b.email AS buyeremail, s.email AS selleremail
                          FROM tblproductrequest pr
                          INNER JOIN tblpersonmaster b ON b.id = pr.buyerid
                          INNER JOIN tblpersonmaster s ON s.id = pr.sellerid
                          WHERE pr.id = :id AND pr.isactive = 1";
                $respr = $DB->getmenual($qrypr, array(':id' => $requestid));

                if (!$requestid || sizeof($respr) == 0) {
                    $message = $errmsg['productrequestnotfound'];
                } else {
                    $pr = $respr[0];
                    $buyerid  = $pr['buyerid'];
                    $sellerid = $pr['sellerid'];

                    if ($sellerid != $uid) {
                        $message = $errmsg['unauthorizedaction'];
                    } else if ($pr['status'] == 2 && $pr['groupid']) {
                        $status = 1;
                        $message = $errmsg['productrequestapproved'];
                        $response['result'] = array(
                            'groupid' => $pr['groupid'], 'personid' => $buyerid,
                            'chattype' => 1, 'productid' => $pr['productid'],
                            'chatlink' => prchatlink($pr['groupid'], $buyerid, 1, $pr['productid'], $pr['producttype']),
                        );
                    } else if ($pr['status'] != 1) {
                        $message = $errmsg['productrequestprocessed'];
                    } else if ($CanMemberToMemberChat != 1) {
                        $message = $errmsg['permissionrequired'];
                    } else {
                        $productlabel = ((int)$pr['producttype'] == 1) ? 'Diamond' : 'Jewellery';
                        $producttable = ((int)$pr['producttype'] == 1) ? 'diamondlist' : 'jewellerylist';
                        $reschkp = $DB->getmenual("SELECT id FROM " . $producttable . " WHERE id = :id AND isactive = 1", array(':id' => $pr['productid']));
                        if (sizeof($reschkp) == 0) {
                            $message = $errmsg['productnotavailable'];
                        } else {
                           
                            $resgrp = $DB->getmenual(
                                "SELECT id FROM tblchatgroup WHERE personid = :personid AND uid = :uid AND chattype = 2 AND issupport = 1",
                                array(':personid' => $sellerid, ':uid' => $buyerid));
                            $isnewgroup = (sizeof($resgrp) == 0);
                            $groupid = $isnewgroup ? $IISMethods->generateuuid() : $resgrp[0]['id'];

                            $uniqname = uniqid();
                            $ismainmsg = 1;
                            if (!$isnewgroup) {
                                $productcolumn = ((int)$pr['producttype'] == 1) ? 'diamondid' : 'jewelleryid';
                                $resun = $DB->getmenual(
                                    "SELECT uniqname FROM tblchatmessage WHERE groupid = :groupid AND " . $productcolumn . " = :jid AND issupport = 1 AND chattype = 2 LIMIT 1",
                                    array(':groupid' => $groupid, ':jid' => $pr['productid']));
                                if (sizeof($resun) > 0) {
                                    $uniqname = $resun[0]['uniqname'];
                                    $ismainmsg = 0;
                                }
                            }

                            $lastseenexists = array();
                            foreach (array($buyerid, $sellerid) as $pid) {
                                $r = $DB->getmenual("SELECT id FROM tbllastseen WHERE uid = :uid AND groupid = :groupid",
                                    array(':uid' => $pid, ':groupid' => $groupid));
                                $lastseenexists[$pid] = (sizeof($r) > 0);
                            }

                            $seedmsgid = $IISMethods->generateuuid();

                            try {
                                $DB->begintransaction();

                                $claimed = prclaim($DB, $requestid, 1, array(
                                    'status' => 2, 'statustext' => 'Approved', 'actiondate' => $datetime,
                                    'pendingkey' => null,
                                    'groupid' => $groupid, 'chatuniqname' => $uniqname, 'seedchatmsgid' => $seedmsgid,
                                    'update_uid' => $uid, 'update_date' => $datetime, 'timestamp' => $datetime,
                                ));
                                if ($claimed == 0) {
                                    throw new Exception('alreadyprocessed');
                                }
                                if ($isnewgroup) {
                                    prexec($DB, 'i', 'tblchatgroup', array(
                                        'id' => $groupid, 'personid' => $sellerid, 'uid' => $buyerid,
                                        'name' => $pr['productname'], 'persontype' => 1,
                                        'entry_uid' => $uid, 'entry_date' => $datetime, 'timestamp' => $datetime,
                                        'issupport' => 1, 'chattype' => 2,
                                    ));
                                    prexec($DB, 'i', 'tblchatmembers', array(
                                        'id' => $IISMethods->generateuuid(), 'groupid' => $groupid,
                                        'personid' => $sellerid, 'iscustomer' => 1,
                                        'entry_uid' => $uid, 'entry_date' => $datetime, 'timestamp' => $datetime,
                                    ));
                                }

                                foreach (array($buyerid, $sellerid) as $pid) {
                                    if ($lastseenexists[$pid]) {
                                        prexec($DB, 'u', 'tbllastseen', array('entry_date' => $datetime),
                                            array('groupid' => $groupid, 'uid' => $pid));
                                    } else {
                                        prexec($DB, 'i', 'tbllastseen', array(
                                            'id' => $IISMethods->generateuuid(), 'uid' => $pid, 'groupid' => $groupid,
                                            'entry_uid' => $uid, 'entry_date' => $datetime, 'timestamp' => $datetime,
                                        ));
                                    }
                                    prexec($DB, 'i', 'tblchathistory', array(
                                        'id' => $IISMethods->generateuuid(), 'uid' => $pid, 'groupid' => $groupid,
                                        'entry_uid' => $uid, 'entry_date' => $datetime, 'timestamp' => $datetime,
                                    ));
                                }
                                $chatmessage = array(
                                    'id' => $seedmsgid, 'uniqname' => $uniqname, 'groupid' => $groupid,
                                    'message' => $pr['message'],
                                    'uid' => $buyerid,
                                    'sendpersonid' => $sellerid,
                                    'type' => 1, 'filetype' => 0, 'fmsgid' => '', 'rplymsgid' => '',
                                    'issupport' => 1, 'ismainmsg' => $ismainmsg,
                                    'productrequestid' => $requestid,
                                    'entry_uid' => $buyerid,
                                    'entry_date' => $pr['entry_date'], 
                                    'timestamp' => $datetime,
                                );
                                if ((int)$pr['producttype'] == 1) {
                                    $chatmessage = array_merge($chatmessage, array(
                                        'diamondid' => $pr['productid'],
                                        'diamondname' => $pr['productname'],
                                        'diamondofferprice' => $pr['offerprice'],
                                        'persontype' => 1, 'chattype' => 2, 'responsetype' => 1,
                                    ));
                                } else {
                                    $chatmessage = array_merge($chatmessage, array(
                                        'jewelleryid' => $pr['productid'],
                                        'jewelleryname' => $pr['productname'],
                                        'jewelleryofferprice' => $pr['offerprice'],
                                        'persontype' => 1, 'chattype' => 2, 'responsetype' => 3,
                                    ));
                                }
                                prexec($DB, 'i', 'tblchatmessage', $chatmessage);

                                prexec($DB, 'u', 'tblpersonmaster', array(
                                    'chatmsgid' => $seedmsgid, 'lastchatmsg' => $pr['message'],
                                    'msgfiletype' => 0, 'lastchat_date' => $datetime,
                                ), array('id' => $sellerid));

                                $buyerchatlink  = prchatlink($groupid, $sellerid, 2, $pr['productid'], $pr['producttype']);
                                $sellerchatlink = prchatlink($groupid, $buyerid, 1, $pr['productid'], $pr['producttype']);

                                $DB->committransaction();

                                $status = 1;
                                $message = $errmsg['productrequestapproved'];
                                $response['result'] = array(
                                    'groupid' => $groupid, 'personid' => $buyerid, 'personname' => $pr['buyername'],
                                    'uniqname' => $uniqname, 'productid' => $pr['productid'],
                                    'chattype' => 1, 'chatlink' => $sellerchatlink,
                                );

                                prsendmail($DB, $config, $pr['buyeremail'],
                                    'Your request ' . $pr['requestno'] . ' has been approved',
                                    $pr['buyername'],
                                    'Your request has been approved. Check your dashboard chat.',
                                    array('Request No' => $pr['requestno'], $productlabel => $pr['productname'],
                                          'Seller' => $pr['sellername'], 'Date Time' => $datetime),
                                    $buyerchatlink, 'To Open Chat');
                            } catch (Exception $e) {
                                if ($e->getMessage() == 'alreadyprocessed') {
                                    $DB->getDBConn()->rollback();
                                    $message = $errmsg['productrequestprocessed'];
                                } else {
                                    $DB->rollbacktransaction($e);
                                    $message = $errmsg['dbtransactionerror'];
                                }
                                $status = 0;
                            }
                        }
                    }
                }
            }

            else if ($action == 'cancelproductrequest') {
                $requestid = $IISMethods->sanitize($_POST['requestid']);
                $reason = $IISMethods->sanitize($_POST['cancelreason']);

                $qrypr = "SELECT pr.*, b.email AS buyeremail, s.email AS selleremail
                          FROM tblproductrequest pr
                          INNER JOIN tblpersonmaster b ON b.id = pr.buyerid
                          INNER JOIN tblpersonmaster s ON s.id = pr.sellerid
                          WHERE pr.id = :id AND pr.isactive = 1";
                $respr = $DB->getmenual($qrypr, array(':id' => $requestid));

                if (!$requestid || sizeof($respr) == 0) {
                    $message = $errmsg['productrequestnotfound'];
                } else {
                    $pr = $respr[0];
                    $isseller = ($pr['sellerid'] == $uid);
                    $productlabel = ((int)$pr['producttype'] == 1) ? 'Diamond' : 'Jewellery';

                    if (!$isseller) {
                        $message = $errmsg['unauthorizedaction'];
                    } else if ($pr['status'] != 1) {
                        $message = $errmsg['productrequestprocessed'];
                    } else {
                        $newstatus = 3;
                        $newtext   = 'Cancelled by Seller';

                        try {
                            $DB->begintransaction();

                            $claimed = prclaim($DB, $requestid, 1, array(
                                'status' => $newstatus, 'statustext' => $newtext,
                                'cancelreason' => $reason, 'actiondate' => $datetime,
                                'pendingkey' => null,
                                'update_uid' => $uid, 'update_date' => $datetime, 'timestamp' => $datetime,
                            ));
                            if ($claimed == 0) {
                                throw new Exception('alreadyprocessed');
                            }

                            $DB->committransaction();

                            $status = 1;
                            $message = $errmsg['productrequestcancelled'];

                            if ($isseller) {
                                prsendmail($DB, $config, $pr['buyeremail'],
                                    'Your request ' . $pr['requestno'] . ' has been cancelled',
                                    $pr['buyername'], 'Your request has been cancelled',
                                    array('Request No' => $pr['requestno'], $productlabel => $pr['productname'],
                                          'Reason' => ($reason ? $reason : '-'), 'Date Time' => $datetime),
                                    'buyrequest?tab=buyer_status', 'To View Your Requests');
                            } else {
                                prsendmail($DB, $config, $pr['selleremail'],
                                    'Request ' . $pr['requestno'] . ' cancelled by buyer',
                                    $pr['sellername'], 'Request has been cancelled by the buyer',
                                    array('Request No' => $pr['requestno'], $productlabel => $pr['productname'],
                                          'Buyer' => $pr['buyername'], 'Date Time' => $datetime),
                                    'buyrequest?tab=seller_status', 'To View Requests');
                            }
                        } catch (Exception $e) {
                            if ($e->getMessage() == 'alreadyprocessed') {
                                $DB->getDBConn()->rollback();
                                $message = $errmsg['productrequestprocessed'];
                            } else {
                                $DB->rollbacktransaction($e);
                                $message = $errmsg['dbtransactionerror'];
                            }
                            $status = 0;
                        }
                    }
                }
            }
        }
    } else {
        $status = -1;
        $message = "Device Logout";
    }
}

require_once dirname(__DIR__, 2) . '/config/apifoot.php';
?>
