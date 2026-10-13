<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/diamondrateupdate.php';


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

// require_once dirname(__DIR__, 3).'/config/vendor/Classes/PHPExcel.php';
// require_once dirname(__DIR__, 3).'/config/vendor/Classes/PHPExcel/IOFactory.php';




if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	// if($action=='insertdiamondrateupdate')   
	// {
	// 	$formevent=$IISMethods->sanitize($_POST['formevent']);
	// 	$shapeid=$_POST['shapeid'];
	// 	$img=$_FILES['csvfile']['name'];

	// 	$id=$IISMethods->sanitize($_POST['id']);
	// 	$datetime=$IISMethods->getdatetime();
	// 	if($shapeid && ($img || $formevent=='editright'))
	// 	{			
	// 		$insqry=array();

	// 		if($formevent=='addright')
	// 		{
	// 			$datetime = $IISMethods->getdatetime();
	// 			$filename = $_FILES['csvfile']['tmp_name'];
	// 			$ext = pathinfo($_FILES["csvfile"]["name"], PATHINFO_EXTENSION);
	// 			$unqid = $IISMethods->generateuuid();
	// 			$uimagePath1 = $IISMethods->uploadallfiles(1, 'drate', $_FILES['csvfile']['name'], $_FILES['csvfile']['tmp_name'], $unqid);
				
	// 			$inputFileName =   dirname(__DIR__, 3).'/assets/'. $uimagePath1;
	// 			// echo $inputFileName; exit;	
	// 			//$inputFileName = 'taskexcel1587204348.xlsx';

	// 			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	// 			// echo $inputFileType; exit;
	// 			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	// 			// print_r($objReader); exit;
	// 			// $objReader->setReadDataOnly(true); //optional
	// 			// $objPHPExcel = $objReader->load('../../assets/'.$inputFileName);
	// 			$objPHPExcel = $objReader->load($inputFileName);
	// 			// print_r($objPHPExcel); exit;
	// 			if ($objPHPExcel) 
	// 			{
	// 				$objWorksheet = $objPHPExcel->getActiveSheet();
	// 				$sheet = $objPHPExcel->getSheet(0);
	// 				$highestRow = $sheet->getHighestRow();
	// 				$highestColumn = $sheet->getHighestColumn();
					
	// 				$j = 0;
	// 				$i = 1;
	// 				$cnt_ins = 0;
	// 				$cnt_upd = 0;
	// 				$cnt_err = 0;
	// 				$itemData = $sheet->rangeToArray('A1:' . $highestColumn . 1, null, true, false);
	// 				$size = trim($itemData[0][0]); // Stock # 
	// 				$exsize=explode('-',$size);
	// 				$fromsize=$exsize[0];
	// 				$tosize=$exsize[1];
					
	// 				for($p=1;$p<=sizeof($itemData[0]);$p++)
	// 				{
	// 					if($itemData[0][$p]!='')
	// 					{
	// 						// echo $itemData[0][$p].'|';
	// 						for ($row =1 ; $row <= ($highestRow); $row++) {

							
	// 							$itemData1 = $sheet->rangeToArray('A' . ($row+1) . ':' . $highestColumn . ($row+1), null, true, false);

	// 							// echo $itemData[0][$p].'|';

	// 							// print_r($itemData1[0]); exit;
	// 								$clarityqry="SELECT id,name FROM tblclaritymaster WHERE name=:clarityid";
	// 								$clarityparams=array(':clarityid'=>$itemData[0][$p]);
	// 								$clarityres=$DB->getmenual($clarityqry,$clarityparams);
	// 								$clarityid='';
	// 								if(sizeof($clarityres)>0)
	// 								{
	// 									$clarityrow=$clarityres[0];
	// 									$clarityname=$clarityrow['name'];
	// 									$clarityid=$clarityrow['id'];
	// 								}
	// 								if($clarityid)
	// 								{
										
	// 									for($k=1;$k<=sizeof($itemData1[0]);$k++)
	// 									{
	// 										$colorid='';
											
	// 										$colorqry="SELECT id,name FROM tbldiamondcolormaster WHERE name=:colorname";
	// 										$colorparams=array(':colorname'=>$itemData1[0][0]);
	// 										$colorres=$DB->getmenual($colorqry,$colorparams);
	// 										if(sizeof($colorres)>0)
	// 										{
	// 											$colorid=$colorres[0]['id'];
	// 											$colorname=$colorres[0]['name'];
	// 										}
	// 										// echo $p."==".$k.'|';
	// 										if($colorid && $itemData1[0][$k]!='' && $itemData1[0][$k]>0 && $p==$k)
	// 										{
	// 											for($q=0;$q<sizeof($shapeid);$q++)
	// 											{

	// 												$qrychk="SELECT id FROM tbldiamondratedetail WHERE size=:size AND shapeid=:shapeid AND colorid=:colorid AND clarityid=:clarityid";
	// 												$paramschk=array(
	// 													':size'=>$size,
	// 													':shapeid'=>$shapeid[$q],
	// 													':colorid'=>$colorid,
	// 													':clarityid'=>$clarityid
	// 												);
	// 												$reschk=$DB->getmenual($qrychk,$paramschk);
	// 												if(sizeof($reschk)>0)
	// 												{
	// 													$rowchk=$reschk[0];
	// 													$nameqry="SELECT 
	// 														IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shapename";
	// 													$nameparams=array(
	// 														':shapeid'=>$shapeid[$q]
	// 													);
	// 													$nameres=$DB->getmenual($nameqry,$nameparams);
	// 													$namerow=$nameres[0];

	// 													$extraparams=array(
	// 														'id'=>$rowchk['id']
	// 													);
	// 													$updata=array(
	// 														'price'=>$itemData1[0][$k],
	// 														'finalprice' =>($itemData1[0][$k]*100),
	// 														'update_uid' => $uid,
	// 														'update_date' => $datetime,
	// 													);
	// 													$DB->executedata('u', 'tbldiamondratedetail', $updata, $extraparams);

	// 													$id = $IISMethods->generateuuid();
	// 													$insqry = array(
	// 														'id'=>$id,
	// 														'shapeid' => $shapeid[$q],
	// 														'shapename' => $namerow['shapename'],
	// 														'fromsize' => $fromsize,
	// 														'tosize' => $tosize,
	// 														'size' => $size,
	// 														'colorid' => $colorid,
	// 														'colorname' => $colorname,
	// 														'clarityid' => $clarityid,
	// 														'clarityname' => $clarityname,
	// 														'price' =>$itemData1[0][$k],
	// 														'finalprice' =>($itemData1[0][$k]*100),
	// 														'timestamp' => $datetime,
	// 														'entry_uid' => $uid,
	// 														'entry_date' => $datetime,
															
	// 													);
														
	// 													$DB->executedata('i', 'tbldiamondratedetaillog', $insqry, '');
	// 												}
	// 												else
	// 												{
	// 													$nameqry="SELECT 
	// 															IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shapename";
	// 													$nameparams=array(
	// 														':shapeid'=>$shapeid[$q]
	// 													);
	// 													$nameres=$DB->getmenual($nameqry,$nameparams);
	// 													$namerow=$nameres[0];
	// 													$id = $IISMethods->generateuuid();
	// 													$insqry = array(
	// 														'id'=>$id,
	// 														'shapeid' => $shapeid[$q],
	// 														'shapename' => $namerow['shapename'],
	// 														'fromsize' => $fromsize,
	// 														'tosize' => $tosize,
	// 														'size' => $size,
	// 														'colorid' => $colorid,
	// 														'colorname' => $colorname,
	// 														'clarityid' => $clarityid,
	// 														'clarityname' => $clarityname,
	// 														'price' =>$itemData1[0][$k],
	// 														'finalprice' =>($itemData1[0][$k]*100),
	// 														'timestamp' => $datetime,
	// 														'entry_uid' => $uid,
	// 														'entry_date' => $datetime,
															
	// 													);
	// 													$DB->executedata('i', 'tbldiamondratedetail', $insqry, '');
	// 													$DB->executedata('i', 'tbldiamondratedetaillog', $insqry, '');
	// 												}
	// 											}
												
	// 										}
	// 									}
	// 								}
									
	// 						}
	// 					}
	// 				}

					
	// 				$status = 1;
	// 				$message = $errmsg['insert'];
	// 				// unlink($inputFileName);
	// 			} else {
	// 				$status = 0;
	// 				$message = $errmsg['filesel'];
	// 			}
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$message=$errmsg['reqired'];
	// 	}
	// }
	if($action=='insertdiamondrateupdate')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);

		// ini_set('display_errors', 1);
		// error_reporting(E_ALL);
		$shapeid=$_POST['shapeid'];
		$img=$_FILES['csvfile']['name'];

		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($shapeid && ($img || $formevent=='editright'))
		{			
			$insqry=array();

			if($formevent=='addright')
			{
				$datetime = $IISMethods->getdatetime();
				$filename = $_FILES['csvfile']['tmp_name'];
				$ext = pathinfo($_FILES["csvfile"]["name"], PATHINFO_EXTENSION);
				$unqid = $IISMethods->generateuuid();
				$uimagePath1 = $IISMethods->uploadallfiles(1, 'drate', $_FILES['csvfile']['name'], $_FILES['csvfile']['tmp_name'], $unqid);
				
				$inputFileName =   dirname(__DIR__, 3).'/assets/'. $uimagePath1;


				// $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				// // echo $inputFileType; exit;
				// $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				// $objPHPExcel = $objReader->load($inputFileName);

				$inputFileType = IOFactory::identify($inputFileName);
				$objReader = IOFactory::createReader($inputFileType);
				$objPHPExcel = IOFactory :: load($inputFileName);

				if ($objPHPExcel) 
				{
					$objWorksheet = $objPHPExcel->getActiveSheet();
					$sheet = $objPHPExcel->getSheet(0);
					$highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn();
					
					$j = 0;
					$i = 1;
					$cnt_ins = 0;
					$cnt_upd = 0;
					$cnt_err = 0;
					$itemData = $sheet->rangeToArray('A1:' . $highestColumn . 1, null, true, false);
					$size = trim($itemData[0][0]); // Stock # 
					$exsize=explode('-',$size);
					$fromsize=$exsize[0];
					$tosize=$exsize[1];
					
					for($p=1;$p<=sizeof($itemData[0]);$p++)
					{
						if($itemData[0][$p]!='')
						{
							for ($row =1 ; $row <= ($highestRow); $row++) 
							{
								$itemData1 = $sheet->rangeToArray('A' . ($row+1) . ':' . $highestColumn . ($row+1), null, true, false);

								// echo $itemData[0][$p].'|';

								// print_r($itemData1[0]); exit;
									$clarityqry="SELECT id,name FROM tblclaritymaster WHERE name=:clarityid";
									$clarityparams=array(':clarityid'=>$itemData[0][$p]);
									$clarityres=$DB->getmenual($clarityqry,$clarityparams);
									$clarityid='';
									if(sizeof($clarityres)>0)
									{
										$clarityrow=$clarityres[0];
										$clarityname=$clarityrow['name'];
										$clarityid=$clarityrow['id'];
									}
									if($clarityid)
									{
										
										for($k=1;$k<=sizeof($itemData1[0]);$k++)
										{
											$colorid='';
											
											$colorqry="SELECT id,name FROM tbldiamondcolormaster WHERE name=:colorname";
											$colorparams=array(':colorname'=>$itemData1[0][0]);
											$colorres=$DB->getmenual($colorqry,$colorparams);
											if(sizeof($colorres)>0)
											{
												$colorid=$colorres[0]['id'];
												$colorname=$colorres[0]['name'];
											}
											// echo $p."==".$k.'|';
											if($colorid && $itemData1[0][$k]!='' && $itemData1[0][$k]>0 && $p==$k)
											{
												for($q=0;$q<sizeof($shapeid);$q++)
												{

													$qrychk="SELECT id FROM tbldiamondratedetail WHERE size=:size AND shapeid=:shapeid AND colorid=:colorid AND clarityid=:clarityid";
													$paramschk=array(
														':size'=>$size,
														':shapeid'=>$shapeid[$q],
														':colorid'=>$colorid,
														':clarityid'=>$clarityid
													);
													$reschk=$DB->getmenual($qrychk,$paramschk);
													if(sizeof($reschk)>0)
													{
														$rowchk=$reschk[0];
														$nameqry="SELECT 
															IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shapename";
														$nameparams=array(
															':shapeid'=>$shapeid[$q]
														);
														$nameres=$DB->getmenual($nameqry,$nameparams);
														$namerow=$nameres[0];

														$extraparams=array(
															'id'=>$rowchk['id']
														);
														$updata=array(
															'price'=>$itemData1[0][$k],
															'finalprice' =>($itemData1[0][$k]*100),
															'update_uid' => $uid,
															'update_date' => $datetime,
														);
														$DB->executedata('u', 'tbldiamondratedetail', $updata, $extraparams);

														$id = $IISMethods->generateuuid();
														$insqry = array(
															'id'=>$id,
															'shapeid' => $shapeid[$q],
															'shapename' => $namerow['shapename'],
															'fromsize' => $fromsize,
															'tosize' => $tosize,
															'size' => $size,
															'colorid' => $colorid,
															'colorname' => $colorname,
															'clarityid' => $clarityid,
															'clarityname' => $clarityname,
															'price' =>$itemData1[0][$k],
															'finalprice' =>($itemData1[0][$k]*100),
															'timestamp' => $datetime,
															'entry_uid' => $uid,
															'entry_date' => $datetime,
															
														);
														
														$DB->executedata('i', 'tbldiamondratedetaillog', $insqry, '');
													}
													else
													{
														$nameqry="SELECT 
																IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shapename";
														$nameparams=array(
															':shapeid'=>$shapeid[$q]
														);
														$nameres=$DB->getmenual($nameqry,$nameparams);
														$namerow=$nameres[0];
														$id = $IISMethods->generateuuid();
														$insqry = array(
															'id'=>$id,
															'shapeid' => $shapeid[$q],
															'shapename' => $namerow['shapename'],
															'fromsize' => $fromsize,
															'tosize' => $tosize,
															'size' => $size,
															'colorid' => $colorid,
															'colorname' => $colorname,
															'clarityid' => $clarityid,
															'clarityname' => $clarityname,
															'price' =>$itemData1[0][$k],
															'finalprice' =>($itemData1[0][$k]*100),
															'timestamp' => $datetime,
															'entry_uid' => $uid,
															'entry_date' => $datetime,
															
														);
														$DB->executedata('i', 'tbldiamondratedetail', $insqry, '');
														$DB->executedata('i', 'tbldiamondratedetaillog', $insqry, '');
													}
												}
												
											}
										}
									}
									
							}
						}
					}

					
					$status = 1;
					$message = $errmsg['insert'];
				} else {
					$status = 0;
					$message = $errmsg['filesel'];
				}
			}
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listdiamondrateupdate')   
	{
		$fltshapeid=$IISMethods->sanitize($_POST['fltshapeid']);
		$fltclarityid=$IISMethods->sanitize($_POST['fltclarityid']);
		$fltcolorid=$IISMethods->sanitize($_POST['fltcolorid']);
		$diamondrates=new diamondrate();
		$qry="SELECT ts.timestamp AS primary_date,ts.id,ts.shapeid,ts.shapename,ts.size,ts.colorname,ts.clarityname,ts.finalprice,CASE 
		WHEN LENGTH(ts.update_date) > 0 
		THEN DATE_FORMAT(STR_TO_DATE(ts.update_date, '%Y-%m-%d %H:%i:%s'), '%d/%m/%Y %h:%i %p') 
		ELSE DATE_FORMAT(STR_TO_DATE(ts.entry_date, '%Y-%m-%d %H:%i:%s'), '%d/%m/%Y %h:%i %p') 
		END AS dt
		FROM `tbldiamondratedetail` ts 
		WHERE ts.shapeid LIKE :shapeid AND ts.colorid LIKE :colorid AND ts.clarityid LIKE :clarityid AND (ts.shapename LIKE :filter OR ts.size LIKE :filter OR ts.colorname LIKE :filter OR ts.clarityname LIKE :filter OR ts.finalprice LIKE :filter) ";
		$parms = array(
			':shapeid'=>$fltshapeid,
			':colorid'=>$fltcolorid,
			':clarityid'=>$fltclarityid,
			':filter'=>$filter,
		);
		
		$qry.=" GROUP BY ts.id order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		
		// echo $qry;
		$diamondrates=$DB->getmenual($qry,$parms,'diamondrate');
		if($responsetype=='HTML')
		{
			if($diamondrates)
			{
				$i=0;
				foreach($diamondrates as $diamondrate)
				{
					$id="'".$diamondrate->id."'";
					$htmldata.='<tr data-index="'.$diamondrate->id.'">';

					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if(((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if(((($rightstotalcount)>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
					// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
					
					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$diamondrate->id.'" value="'.$IISMethods->sanitize($diamondrate->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$diamondrate->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';


					$htmldata.='<td class="">'.$IISMethods->sanitize($diamondrate->shapename).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($diamondrate->size).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($diamondrate->clarityname).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($diamondrate->colorname).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($diamondrate->finalprice).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($diamondrate->dt).'</td>';
					

					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($diamondrates)<=0)
				{
					// $htmldata.=file_get_contents($config-> getNoDataFound());
					if($filter!='%%')
					{
						$htmldata.=file_get_contents($config->getNoDataFound());
					}else{
						$htmldata.=file_get_contents($config->getNoDataFoundwoReset());
					}
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($diamondrates);
		}

		$common_listdata=$diamondrates;
	}    
	
	else if($action=='deletediamondrateupdate')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('d','tbldiamondratedetail','',$extraparams);
			$status=1;
			$message=$errmsg['delete'];
			
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];
				
				$extraparams=array(
					'id'=>$IISMethods->sanitize($id)
				);
				$DB->executedata('d','tbldiamondratedetail','',$extraparams);
				
			}
			$status=1;
			$message=$errmsg['delete'].' '.$usemenu;
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>
