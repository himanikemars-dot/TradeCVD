<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2) . '/config/init.php';
require_once dirname(__DIR__, 3) . '/config/apiconfig.php';
require_once dirname(__DIR__, 2) . '/model/testimonial.php';


if ($isvalidUser['status'] == 1) {
	$status = 0;
	$message = $errmsg['invalidrequest'];

	if ($action == 'inserttestimonial') {
		$formevent = $IISMethods->sanitize($_POST['formevent']);
		$typeid = $IISMethods->sanitize($_POST['typeid']);
		$company = $IISMethods->sanitize($_POST['company']);
		$name = $IISMethods->sanitize($_POST['name']);
		$designation = $IISMethods->sanitize($_POST['designation']);
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);
		$descr = $_POST['descr'];

		$img = $_FILES['img']['name'];

		$id = $IISMethods->sanitize($_POST['id']);
		$datetime = $IISMethods->getdatetime();

		if ($typeid && $company && $name && $displayorder && $descr && $designation) {
			if ($typeid == 1) {
				$typetext = 'Buyer';
			} else if ($typeid == 2) {
				$typetext = 'Seller';
			} else if ($typeid == 3) {
				$typetext = 'Other';
			}
			$insqry = array(
				'typeid' => $typeid,
				'typetext' => $typetext,
				'company' => $company,
				'name' => $name,
				'displayorder' => $displayorder,
				'description' => $descr,
				'designation' => $designation,
			);

			if ($formevent == 'addright') {
				$qrychk = "SELECT name from tbltestimonial where name=:name AND company=:company AND typeid=:typeid";
				$parms = array(
					':typeid' => $typeid,
					':name' => $name,
					':company' => $company
				);
				$result_ary = $DB->getmenual($qrychk, $parms);
				if (sizeof($result_ary) > 0) {
					$status = 0;
					$message = $errmsg['isexist'];
				} else {
					$unqid = $IISMethods->generateuuid();

					/* 	if($img)
					{ */
					if (($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png')) {
						$sourcePath = $_FILES['img']['tmp_name'];
						$targetPath = $IISMethods->uploadallfiles(1, 'testimonial', $img, $sourcePath, $unqid);
						$insqry['image'] = $targetPath;
					} else {
						$status = 0;
						$message = $errmsg['filetype'];
					}

					$insqry['id'] = $unqid;
					$insqry['timestamp'] = $IISMethods->getdatetime();
					$insqry['entry_uid'] = $uid;
					$insqry['entry_date'] = $datetime;

					$DB->executedata('i', 'tbltestimonial', $insqry, '');

					$status = 1;
					$message = $errmsg['insert'];
					/* 	}
					else
					{ */
					/* $insqry['id']=$unqid;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;
		
						$DB->executedata('i','tbltestimonial',$insqry,''); */

					// $status=0;
					// $message=$errmsg['insert'];
					// $message=$errmsg['reqired'];
					// }
				}
			} else if ($formevent == 'editright') {
				$qrychk = "SELECT name from tbltestimonial where name=:name AND company=:company AND typeid=:typeid  AND id<>:id";
				$parms = array(
					':typeid' => $typeid,
					':name' => $name,
					':company' => $company,
					':id' => $id,
				);
				$result_ary = $DB->getmenual($qrychk, $parms);
				if (sizeof($result_ary) > 0) {
					$status = 0;
					$message = $errmsg['isexist'];
				} else {
					/* if($img)
					{ */
					if (($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png')) {
						$sourcePath = $_FILES['img']['tmp_name'];
						$targetPath = $IISMethods->uploadallfiles(1, 'testimonial', $img, $sourcePath, $id);
						$insqry['image'] = $targetPath;

						/* $insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tbltestimonial',$insqry,$extraparams);

							$status=1;
							$message=$errmsg['update']; */
					} else {
						$status = 0;
						$message = $errmsg['filetype'];
					}
					/* }
					else
					{ */
					$insqry['update_uid'] = $uid;
					$insqry['update_date'] = $datetime;

					$extraparams = array(
						'id' => $id
					);
					$DB->executedata('u', 'tbltestimonial', $insqry, $extraparams);

					$status = 1;
					$message = $errmsg['update'];
					// }
				}
			}
		} else {
			$message = $errmsg['reqired'];
		}
	} else if ($action == 'deletetestimonial') {
		$id = $IISMethods->sanitize($_POST['id']);
		$bulkid = $_POST['bulkid'];
		$bulk = explode(",", $bulkid);
		if ($id) {
			$extraparams = array(
				'id' => $id
			);
			$DB->executedata('d', 'tbltestimonial', '', $extraparams);
			$status = 1;
			$message = $errmsg['delete'];
		} else if (sizeof($bulk) > 0) {
			$usemenu = '';
			for ($i = 0; $i < sizeof($bulk); $i++) {
				$id = $bulk[$i];
				$extraparams = array(
					'id' => $IISMethods->sanitize($id)
				);
				$DB->executedata('d', 'tbltestimonial', '', $extraparams);
			}
			$status = 1;
			$message = $errmsg['delete'] . ' ' . $usemenu;
		} else {
			$status = 0;
			$message = $errmsg['reqired'];
		}
	} else if ($action == 'edittestimonial') {
		$id = $IISMethods->sanitize($_POST['id']);
		if ($id) {
			$qrychk = "select id,typeid,company,name,description,displayorder,designation from tbltestimonial where id=:id";
			$parms = array(
				':id' => $id,
			);
			$result_ary = $DB->getmenual($qrychk, $parms);

			if (sizeof($result_ary) > 0) {
				$row = $result_ary[0];
				$response['id'] = $IISMethods->sanitize($row['id']);
				$response['typeid'] = $IISMethods->sanitize($row['typeid']);
				$response['company'] = $IISMethods->sanitize($row['company']);
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
	} else if ($action == 'listtestimonial') {
		$testimonials = new testimonial();
		$qry = "SELECT ts.timestamp as primary_date,ts.typeid,ts.typetext,ts.id,ts.company,ts.name,ts.displayorder,ts.isactive,ts.image,ts.description,ts.designation
			  FROM tbltestimonial ts 
			  WHERE ts.company like :filter OR ts.typetext like :filter OR ts.displayorder LIKE :filter or ts.name LIKE :filter or ts.designation LIKE :filter  order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter' => $filter,
		);
		$testimonials = $DB->getmenual($qry, $parms, 'testimonial');

		if ($responsetype == 'HTML') {
			if ($testimonials) {
				$i = 0;
				foreach ($testimonials as $testimonial) {
					$id = "'" . $testimonial->id . "'";
					$htmldata .= '<tr data-index="' . $testimonial->id . '">';

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
					$htmldata .= '<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete' . $testimonial->id . '" value="' . $IISMethods->sanitize($testimonial->id) . '" name="bulkdelete[]">';
					$htmldata .= '<label class="custom-control-label mb-0" for="bulkdelete' . $testimonial->id . '"></label>';
					$htmldata .= '</div>';
					$htmldata .= '</div>';
					$htmldata .= '</td>';
					$htmldata .= '<td class="tbl-img">';
					if ($IISMethods->sanitize($testimonial->image)) {
						$htmldata .= '<div class="dropdown img-dropdown dropleft">';
						// $htmldata .= '<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewimgimage("' . $IISMethods->sanitize($config->getImageurl() . $testimonial->image) . '")><img src="' . $IISMethods->sanitize($config->getImageurl() . $testimonial->image) . '" class="img-thumbnail"></a>';
						// $htmldata .= '<div class="dropdown-menu img-popover-content" aria-labelledby="tableDropdown3">';
						$htmldata .= '<a href="javascript:void(0)" onclick=viewimgimage("' . $IISMethods->sanitize($config->getImageurl() . $testimonial->image) . '")><img src="' . $IISMethods->sanitize($config->getImageurl() . $testimonial->image) . '"></a>';
						// $htmldata .= '</div>';
						$htmldata .= '</div>';
					} else {
						$htmldata .= '-';
					}
					$htmldata .= '</td>';
					$htmldata .= '<td class="">' . $IISMethods->sanitize($testimonial->typetext) . '</td>';
					$htmldata .= '<td class=""><a href="javascript:void(0)" onclick=viewdescription(' . $IISMethods->sanitize($id) . ')>' . $IISMethods->sanitize($testimonial->company) . '</a></td>';
					$htmldata .= '<td class="">' . $IISMethods->sanitize($testimonial->designation) . '</td>';
					$htmldata .= '<td class="">' . $IISMethods->sanitize($testimonial->name) . '</td>';
					$htmldata .= '<td class="text-center">' . $IISMethods->sanitize($testimonial->displayorder) . '</td>';
					if ($testimonial->isactive == 1) {
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
				if ($page <= 0 && sizeof($testimonials) <= 0) {
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
			$response['data'] = json_encode($testimonials);
		}

		$common_listdata=$testimonials;
	} else if ($action == 'isactive') {
		$id = $IISMethods->sanitize($_POST['id']);
		if ($id) {
			$qrychk = "select isactive from tbltestimonial where id=:id";
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
			$DB->executedata('u', 'tbltestimonial', $insqry, $extraparams);

			$status = 1;
			$message = $errmsg['update'];
		} else {
			$message = $errmsg['reqired'];
		}
	} else if ($action == 'showaboutdescription') {
		$id = $IISMethods->sanitize($_POST['id']);
		if ($id) {
			$qrychk = "SELECT ta.description from tbltestimonial ta where ta.id = :id";
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
