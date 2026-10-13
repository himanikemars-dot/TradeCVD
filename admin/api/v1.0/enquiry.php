<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/enquiry.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listenquiry')   
	{
		$enquiry=new enquiry();
		$qry="select e.timestamp as primary_date,e.id,e.productname,e.productid,e.categoryid,e.firstname,e.lastname ,e.email,e.contact,e.companyname,e.entry_date,DATE_FORMAT(e.entry_date,'%d/%m/%Y %h:%i %p')  AS edate 
			FROM tblenquiry e 
		where e.productname like :filter or e.firstname like :filter or e.lastname like :filter or e.email like :filter or e.contact like :filter or e.companyname like :filter  or DATE_FORMAT(e.entry_date,'%d/%m/%Y %h:%i %p') like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$enquiry=$DB->getmenual($qry,$parms,'enquiry');
		
		if($responsetype=='HTML')
		{
			if($enquiry)
			{
				$i=0;
				foreach($enquiry as $enq)
				{
					$id="'".$enq->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						/* $htmldata.='<td class="tbl-grid">';
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
						$htmldata.='</td>'; */
					}
					/* $htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($enq->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>'; */
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($enq->firstname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($enq->lastname).'</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewenquirymessage('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($enq->contact).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($enq->email).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($enq->productname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($enq->companyname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($enq->edate).'</td>';
					
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($enquiry)<=0)
				{
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
			$response['data']= json_encode($enquiry);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($enquiry)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($enquiry); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($enquiry);
		$response['showentries']=$showentries;
	}    

	else if($action=='viewenquirymessage')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT e.message
					FROM tblenquiry e
					WHERE e.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$tbldata='';
				$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-12 text-dot-right">';
				$tbldata.='<label class="label-view"><b>'.$row['message'].'</b></label>';
				$tbldata.='</div>';
				$tbldata.='</div></div>';
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


}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  