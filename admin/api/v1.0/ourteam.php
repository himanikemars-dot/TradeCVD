<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2) . '/config/init.php';
require_once dirname(__DIR__, 3) . '/config/apiconfig.php';
require_once dirname(__DIR__, 2) . '/model/ourteam.php';


if ($isvalidUser['status'] == 1) {
    $status = 0;
    $message = $errmsg['invalidrequest'];

    if ($action == 'insertourteam') {
        $formevent = $IISMethods->sanitize($_POST['formevent']);
        $name = $IISMethods->sanitize($_POST['name']);
        $designation = $IISMethods->sanitize($_POST['designation']);
        $displayorder = $IISMethods->sanitize($_POST['displayorder']);
        $descr = $_POST['descr'];

        $img = $_FILES['img']['name'];

        $id = $IISMethods->sanitize($_POST['id']);
        $datetime = $IISMethods->getdatetime();

        if ($name && $displayorder  && $designation) { //&& $descr
            $insqry = array(
                'name' => $name,
                'displayorder' => $displayorder,
                'description' => $descr,
                'designation' => $designation,
            );

            if ($formevent == 'addright') {
                $qrychk = "SELECT name from tblourteam where name=:name";
                $parms = array(
                    ':name' => $name,
                );
                $result_ary = $DB->getmenual($qrychk, $parms);
                if (sizeof($result_ary) > 0) {
                    $status = 0;
                    $message = $errmsg['isexist'];
                } else {
                    $unqid = $IISMethods->generateuuid();

                    if (($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png')) {
                        $sourcePath = $_FILES['img']['tmp_name'];
                        $targetPath = $IISMethods->uploadallfiles(1, 'ourteam', $img, $sourcePath, $unqid);
                        $insqry['image'] = $targetPath;
                    } else {
                        $status = 0;
                        $message = $errmsg['filetype'];
                    }

                    $insqry['id'] = $unqid;
                    $insqry['timestamp'] = $IISMethods->getdatetime();
                    $insqry['entry_uid'] = $uid;
                    $insqry['entry_date'] = $datetime;

                    $DB->executedata('i', 'tblourteam', $insqry, '');

                    $status = 1;
                    $message = $errmsg['insert'];
                }
            } else if ($formevent == 'editright') {
                $qrychk = "SELECT name from tblourteam where name=:name AND id<>:id";
                $parms = array(
                    ':name' => $name,
                    ':id' => $id,
                );
                $result_ary = $DB->getmenual($qrychk, $parms);
                if (sizeof($result_ary) > 0) {
                    $status = 0;
                    $message = $errmsg['isexist'];
                } else {
                    if (($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png')) {
                        $sourcePath = $_FILES['img']['tmp_name'];
                        $targetPath = $IISMethods->uploadallfiles(1, 'ourteam', $img, $sourcePath, $id);
                        $insqry['image'] = $targetPath;
                    } else {
                        $status = 0;
                        $message = $errmsg['filetype'];
                    }

                    $insqry['update_uid'] = $uid;
                    $insqry['update_date'] = $datetime;

                    $extraparams = array(
                        'id' => $id
                    );
                    $DB->executedata('u', 'tblourteam', $insqry, $extraparams);

                    $status = 1;
                    $message = $errmsg['update'];
                }
            }
        } else {
            $message = $errmsg['reqired'];
        }
    } else if ($action == 'deleteourteam') {
        $id = $IISMethods->sanitize($_POST['id']);
        $bulkid = $_POST['bulkid'];
        $bulk = explode(",", $bulkid);
        if ($id) {

            $qrychk = "select image from tblourteam where id=:id";
            $parms = array(
                ':id' => $id,
            );
            $result_ary = $DB->getmenual($qrychk, $parms);
            $row = $result_ary[0];
            unlink('../../../assets/'.$row['image']);
            $extraparams = array(
                'id' => $id
            );
            $DB->executedata('d', 'tblourteam', '', $extraparams);
            $status = 1;
            $message = $errmsg['delete'];
        } else if (sizeof($bulk) > 0) {
            $usemenu = '';
            for ($i = 0; $i < sizeof($bulk); $i++) {
                $id = $bulk[$i];

                $qrychk = "select image from tblourteam where id=:id";
                $parms = array(
                    ':id' => $id,
                );
                $result_ary = $DB->getmenual($qrychk, $parms);
                $row = $result_ary[0];
                unlink('../../../assets/'.$row['image']);

                $extraparams = array(
                    'id' => $IISMethods->sanitize($id)
                );
                $DB->executedata('d', 'tblourteam', '', $extraparams);
            }
            $status = 1;
            $message = $errmsg['delete'] . ' ' . $usemenu;
        } else {
            $status = 0;
            $message = $errmsg['reqired'];
        }
    } else if ($action == 'editourteam') {
        $id = $IISMethods->sanitize($_POST['id']);
        if ($id) {
            $qrychk = "select id,name,description,displayorder,designation from tblourteam where id=:id";
            $parms = array(
                ':id' => $id,
            );
            $result_ary = $DB->getmenual($qrychk, $parms);

            if (sizeof($result_ary) > 0) {
                $row = $result_ary[0];
                $response['id'] = $IISMethods->sanitize($row['id']);
                $response['displayorder'] = $IISMethods->sanitize($row['displayorder']);
                $response['description'] = $IISMethods->sanitize($row['description'], 'OUT');
                $response['name'] = $IISMethods->sanitize($row['name']);
                $response['designation'] = $IISMethods->sanitize($row['designation']);
            }
            $status = 1;
            $message = $errmsg['success'];
        } else {
            $status = 0;
            $message = $errmsg['reqired'];
        }
    } else if ($action == 'listourteam') {
        $ourteams = new ourteam();
        $qry = "SELECT ts.timestamp as primary_date,ts.id,ts.name,ts.displayorder,ts.isactive,ts.image,ts.description,ts.designation
			  FROM tblourteam ts 
			  WHERE ts.displayorder LIKE :filter or ts.name LIKE :filter or ts.designation LIKE :filter  order by $ordbycolumnname $ordby LIMIT $start, $per_page";
        $parms = array(
            ':filter' => $filter,
        );
        $ourteams = $DB->getmenual($qry, $parms, 'ourteam');

        if ($responsetype == 'HTML') {
            if ($ourteams) {
                $i = 0;
                foreach ($ourteams as $ourteam) {
                    $id = "'" . $ourteam->id . "'";
                    $htmldata .= '<tr data-index="' . $ourteam->id . '">';

                    if ((($rightstotalcount) > 0 ? $Pagerights->getEditright() : 0) == 1 || (sizeof($Pagerights) > 0 ? $Pagerights->getDelright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
                    {
                        $htmldata .= '<td class="tbl-grid">';
                        $htmldata .= '<div class="dropdown table-dropdown">';
                        $htmldata .= '<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
                        $htmldata .= '<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

                        if (((($rightstotalcount) > 0 ? $Pagerights->getEditright() : 0) == 1) || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //admin all right,alleditright - all person data show,selfedit - only self person data show
                        {
                            $htmldata .= '<a class="dropdown-item" href="javascript:void(0);" onclick="editdata(' . $IISMethods->sanitize($id) . ')"><i class="bi bi-pencil"></i> Edit</a>';
                        }
                        if (((($rightstotalcount) > 0 ? $Pagerights->getDelright() : 0) == 1) || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //admin all right,alleditright - all person data show,selfedit - only self person data show
                        {
                            $htmldata .= '<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata(' . $IISMethods->sanitize($id) . ')"><i class="bi bi-trash"></i> Delete</a>';
                        }

                        $htmldata .= '</div>';
                        $htmldata .= '</div>';
                        $htmldata .= '</td>';
                    }
                    $htmldata .= '<td class="tbl-check d-none">';
                    $htmldata .= '<div class="text-center">';
                    $htmldata .= '<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
                    $htmldata .= '<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete' . $ourteam->id . '" value="' . $IISMethods->sanitize($ourteam->id) . '" name="bulkdelete[]">';
                    $htmldata .= '<label class="custom-control-label mb-0" for="bulkdelete' . $ourteam->id . '"></label>';
                    $htmldata .= '</div>';
                    $htmldata .= '</div>';
                    $htmldata .= '</td>';
                    $htmldata .= '<td class="tbl-img">';
                    if ($IISMethods->sanitize($ourteam->image)) {
                        $htmldata .= '<div class="dropdown img-dropdown dropleft">';
                        $htmldata .= '<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewworkouticonimage("' . $IISMethods->sanitize($config->getImageurl() . $ourteam->image) . '")><img src="' . $IISMethods->sanitize($config->getImageurl() . $ourteam->image) . '" class="img-thumbnail"></a>';
                        $htmldata .= '<div class="dropdown-menu img-popover-content" aria-labelledby="tableDropdown3">';
                        $htmldata .= '<a href="javascript:void(0)" onclick=viewimgimage("' . $IISMethods->sanitize($config->getImageurl() . $ourteam->image) . '")><img src="' . $IISMethods->sanitize($config->getImageurl() . $ourteam->image) . '"></a>';
                        $htmldata .= '</div>';
                        $htmldata .= '</div>';
                    } else {
                        $htmldata .= '-';
                    }
                    $htmldata .= '</td>';
                    // $htmldata .= '<td class=""><a href="javascript:void(0)" onclick=viewdescription(' . $IISMethods->sanitize($id) . ')>' . $IISMethods->sanitize($ourteam->designation) . '</a></td>';
                    $htmldata .= '<td class="">' . $IISMethods->sanitize($ourteam->designation) . '</td>';
                    $htmldata .= '<td class="">' . $IISMethods->sanitize($ourteam->name) . '</td>';
                    $htmldata .= '<td class="text-center">' . $IISMethods->sanitize($ourteam->displayorder) . '</td>';
                    if ($ourteam->isactive == 1) {
                        $htmldata .= '<td class="tbl-name text-center"><label class="switch">';
                        $htmldata .= '<input type="checkbox" onclick="isactive(' . $id . ')" checked>';
                        $htmldata .= '<span class="slider round"></span>';
                        $htmldata .= '</label></td>';
                    } else {
                        $htmldata .= '<td class="tbl-name text-center"><label class="switch">';
                        $htmldata .= '<input type="checkbox" onclick="isactive(' . $id . ')">';
                        $htmldata .= '<span class="slider round"></span>';
                        $htmldata .= '</label></td>';
                    }

                    $htmldata .= '</tr>';
                    $i++;
                }
                $status = 1;
                $message = $errmsg['success'];
            } else {
                if ($page <= 0 && sizeof($ourteams) <= 0) {
                    // $htmldata.=file_get_contents($config-> getNoDataFound());
                    if ($filter != '%%') {
                        $htmldata .= file_get_contents($config->getNoDataFound());
                    } else {
                        $htmldata .= file_get_contents($config->getNoDataFoundwoReset());
                    }
                    $message = $errmsg['nodatafound'];
                }
            }
            $response['data'] = $htmldata;
        } else if ($responsetype == 'JSON') {
            $response['data'] = json_encode($ourteams);
        }
        $common_listdata=$ourteams;
    } else if ($action == 'isactive') {
        $id = $IISMethods->sanitize($_POST['id']);
        if ($id) {
            $qrychk = "select isactive from tblourteam where id=:id";
            $parms = array(
                ':id' => $id,
            );
            $result_ary = $DB->getmenual($qrychk, $parms);
            $row = $result_ary[0];
            if ($row['isactive'] == 1) {
                $isactive = 0;
            } else {
                $isactive = 1;
            }
            $insqry['isactive'] = $isactive;
            $extraparams = array(
                'id' => $id
            );
            $DB->executedata('u', 'tblourteam', $insqry, $extraparams);

            $status = 1;
            $message = $errmsg['update'];
        } else {
            $message = $errmsg['reqired'];
        }
    } else if ($action == 'showaboutdescription') {
        $id = $IISMethods->sanitize($_POST['id']);
        if ($id) {
            $qrychk = "SELECT ta.description from tblourteam ta where ta.id = :id";
            $parms = array(
                ':id' => $id,
            );
            $result_ary = $DB->getmenual($qrychk, $parms);
            if (sizeof($result_ary) > 0) {
                $row = $result_ary[0];
                $tbldata = '';
                $tbldata .= '<div class="col-12">';
                $tbldata .= '<div class="table-responsive">';
                $tbldata .= '<div class="col-12 view-data-details">';
                $tbldata .= '<div class="row my-3">';
                $tbldata .= '<div class="col-12 col-md-8 col-lg">';
                $tbldata .= '<div class="row">';

                $tbldata .= '<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
                $tbldata .= '<div class="col-12 col-sm-8 col-lg-12">';
                $tbldata .= '<label class="label-view">' . $row['description'] . '</label>';
                $tbldata .= '</div></div></div>';


                $tbldata .= '</div>';
                $tbldata .= '</div>';
                $tbldata .= '</div>';
                $tbldata .= '</div>';
                $tbldata .= '</div>';
                $tbldata .= '</div>';
            }

            $response['data'] = $tbldata;
            $status = 1;
            $message = $errmsg['success'];
        } else {
            $status = 0;
            $message = $errmsg['reqired'];
        }
    }
}


require_once dirname(__DIR__, 3) . '/config/apifoot.php';
