<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/faq.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertfaqmaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$faqgroupid=$IISMethods->sanitize($_POST['faqgroupid']);
		$faqgroupname=$IISMethods->sanitize($_POST['faqgroupname']);
		$question=trim($IISMethods->sanitize($_POST['question']));
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);
		$answer = $_POST['answer'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($question && $answer)
		{			
			$insqry=array(	
				'faqgroupid'=>$faqgroupid,
				'faqgroupname'=>$faqgroupname,				
				'question'=>$question,
				'answer'=>$answer,
				'displayorder'=>$displayorder
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT question from tblfaqmaster where faqgroupid=:faqgroupid AND question=:question";
				$parms = array(
					':question'=>$question,
					':faqgroupid'=>$faqgroupid
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$unqid = $IISMethods->generateuuid();
					
					$insqry['id']=$unqid;	
					$insqry['isactive']=1;	
					$insqry['timestamp']=$IISMethods->getdatetime();
					$insqry['entry_uid']=$uid;	
					$insqry['entry_date']=$datetime;

					$DB->executedata('i','tblfaqmaster',$insqry,'');

					$status=1;
					$message=$errmsg['insert'];
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT question from tblfaqmaster where faqgroupid=:faqgroupid AND question=:question and id<>:id";
				$parms = array(
					':question'=>$question,
					':faqgroupid'=>$faqgroupid,
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$insqry['update_uid']=$uid;	
					$insqry['update_date']=$datetime;

					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('u','tblfaqmaster',$insqry,$extraparams);

					$status=1;
					$message=$errmsg['update'];
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletefaqmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('d','tblfaqmaster','',$extraparams);
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
				$DB->executedata('d','tblfaqmaster','',$extraparams);
				
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
	else if($action=='editfaqmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,question,answer,displayorder,faqgroupid from tblfaqmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['question']=$IISMethods->sanitize($row['question']);
				$response['answer']=$IISMethods->sanitize($row['answer'],'OUT');
				$response['displayorder'] = $IISMethods->sanitize($row['displayorder']);
				$response['faqgroupid'] = $IISMethods->sanitize($row['faqgroupid']);
			}
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listfaqmaster')   
	{
		$faqs=new faq();
		$qry="select cm.timestamp as primary_date,cm.id,cm.question,cm.isactive,cm.displayorder,cm.answer,cm.faqgroupname from tblfaqmaster cm 
		where cm.question like :filter OR cm.displayorder like :filter OR cm.faqgroupname like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$faqs=$DB->getmenual($qry,$parms,'faq');
		
		if($responsetype=='HTML')
		{
			if($faqs)
			{
				$i=0;
				foreach($faqs as $faq)
				{
					$id="'".$faq->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if((($rightstotalcount>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if((($rightstotalcount>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}

					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($faq->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($faq->faqgroupname).'</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick="showmessage('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($faq->question).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($faq->displayorder).'</td>';
					if($faq->isactive == 1)
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="isactive('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="isactive('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
					
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($faqs)<=0)
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
			$response['data']= json_encode($faqs);
		}

		$common_listdata=$faqs;
	}    

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblfaqmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			$row=$result_ary[0];
			if($row['isactive']==1)
			{
				$isactive=0;
			}
			else
			{
				$isactive=1;
			}
			$insqry['isactive']=$isactive;	
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('u','tblfaqmaster',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='showanswer')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT ta.answer from tblfaqmaster ta where ta.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$tbldata='';
				$tbldata.='<div class="col-12">';
				$tbldata.='<div class="table-responsive">';
				$tbldata.='<div class="col-12 view-data-details">';
				$tbldata.='<div class="row my-3">';
				$tbldata.='<div class="col-12 col-md-8 col-lg">';
				$tbldata.='<div class="row">';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-12">';
					$tbldata.='<label class="label-view">'.$row['answer'].'</label>';
					$tbldata.='</div></div></div>';
					

				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';										
				$tbldata.='</div>';

			}

			$response['data']=$tbldata;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	} 
	else if($action=='fillfaqgroup')   
	{
		$qry="select id,name from tblfaqgroupmaster WHERE isactive=:isactive ORDER BY name";
		$parms = array(':isactive'=>1);
		$questions=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($questions)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($questions as $row)
				{
					$htmldata.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$questions;
			}

			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	} 
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';

?>

  