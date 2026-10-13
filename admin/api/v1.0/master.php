<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/master.php';

if($isvalidUser['status'] == 1)
{
	
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listmaster')   
	{
		$qry="SELECT tm.*,ifnull((SELECT count(id) from tblmenuassign where menutypeid=1 AND parentid=tm.id),0) as totl from tblmenuassign tm 
		where menutypeid=1 AND ifnull((SELECT count(id) from tblmenuassign where menutypeid=1 AND parentid=tm.id),0) > 0 order by timestamp asc";
		$parms = array();
		$result_ary=$DB->getmenual($qry);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];

				//$htmldata.='<div class="masonry-widget">'; 
				$htmldata.='<div class="masonry-widget-item">';
				$htmldata.='<div class="widget">';
				$htmldata.='<div class="widget-heading">';
				$htmldata.='<div class="row">';
				$htmldata.='<div class="col-12">';
				$htmldata.='<h5><i class="'.$row['iconstyle'].' '.$row['iconclass'].' bi-1x"></i> <span> '.$row['textname'].'</span></h5>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='<div class="widget-content">';
				$htmldata.='<div class="row">';
				$htmldata.='<div class="col-12 px-0">';
				$htmldata.='<ul> ';

				$subqry="SELECT * from tblmenuassign where menutypeid=1 AND parentid=:parentid order by timestamp asc";
				$subparms = array(
					':parentid'=>$row['id'],
				);
				$result_subary=$DB->getmenual($subqry,$subparms);
				if(sizeof($result_subary)>0)
				{
					for($j=0;$j<sizeof($result_subary);$j++)
					{
						$subrow=$result_subary[$j];
						$htmldata.='<li><a pagename="'.$subrow['alias'].'" class="MasterMenu" > <i class="'.$subrow['iconstyle'].' '.$subrow['iconclass'].'"></i><span class="card-title" > '.$subrow['textname'].'<spam></a></li>';
					}
				}
				$htmldata.='</ul>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				//$htmldata.='</div>';

			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillshapes')   
	{
		$ismain=$IISMethods->sanitize($_POST['ismain']);
		$qry="SELECT id,`name`,displayorder FROM tbldiamondshapemaster  WHERE isactive=1";
		if($ismain==1)
		{
			$qry.=" AND IFNULL(issubshape,0)=0";
		}
		$qry.="	ORDER BY id";
		
		$parms = array();
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='filljewellerytype')   
	{
		
		$qry="SELECT id,`name`,displayorder FROM tbljewelrytypemaster ORDER BY id";
		
		$parms = array();
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='filldiamondseller') //Fill seller or customer 
	{
		$isselectoption=$IISMethods->sanitize($_POST['isselectoption']);

		$qry="SELECT DISTINCT d.id,d.personname,d.personid 
		FROM `tbldiamond` d 
		INNER JOIN `tblpersonmaster` pm ON pm.id=d.personid
		GROUP BY d.personid";
			
		$parms = array(
		
		);
		// echo $qry;
		// print_r($parms);
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				if($isselectoption == 1)
				{
					$htmldata.='<option value="">Select Seller</option>';
				}
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['personid'].'" data-name="'.$row['personname'].'">'.$row['personname'].'</option>';
				}
				$response['data']=$htmldata;
			}
			$status=1;
			$message=$errmsg['success'];
		}	
	}  
	else if($action=='filljewelleryseller') //Fill seller or customer 
	{
		
		$qry="SELECT DISTINCT j.id,j.personname,j.personid 
		FROM `tbljewellery` j 
		INNER JOIN `tblpersonmaster` pm ON pm.id=j.personid
		GROUP BY j.personid";
			
		$parms = array(
			
		);
		// echo $qry;
		// print_r($parms);
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				if($isselectoption == 1)
				{
					$htmldata.='<option value="">Select Seller</option>';
				}
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['personid'].'" data-name="'.$row['personname'].'">'.$row['personname'].'</option>';
				}
				$response['data']=$htmldata;
			}
			$status=1;
			$message=$errmsg['success'];
		}	
	}  
	else if($action=='fillbuyrequestseller') //Fill seller or customer 
	{
		
		$qry="SELECT DISTINCT br.id,br.personname,br.personid 
		FROM `tblbuyrequest` br 
		INNER JOIN `tblpersonmaster` pm ON pm.id=br.personid
		GROUP BY br.personid";
			
		$parms = array(
			
		);
		// echo $qry;
		// print_r($parms);
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				if($isselectoption == 1)
				{
					$htmldata.='<option value="">Select Seller</option>';
				}
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['personid'].'" data-name="'.$row['personname'].'">'.$row['personname'].'</option>';
				}
				$response['data']=$htmldata;
			}
			$status=1;
			$message=$errmsg['success'];
		}	
	}  
	/*
	else if($action=='fillstate')   
	{
		$qry="SELECT id,state from tblstatemaster";
		$parms = array();
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['state'].'</option>';
				}
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	} 

	else if($action=='fillcity')   
	{
		$stateid=$IISMethods->sanitize($_POST['stateid']);
		$qry="SELECT id,city from tblcitymaster where stateid=:stateid";
		$parms = array(
			':stateid'=>$stateid
		);
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['city'].'</option>';
				}
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
		*/
	else if($action=='fillcmptype') //Use by  (branchmaster)  
	{
		$qry="SELECT id,cmptype from tblcompanytype";
		$result_ary=$DB->getmenual($qry);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['cmptype'].'</option>';
				}
				$response['data']=$htmldata;
			}
		}
		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillpackage') //Use by  (couponmaster)  
	{
		$qry="SELECT id,packagename from tblpackagemaster";
		$result_ary=$DB->getmenual($qry);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{
				$htmldata.='<option value="">Select Package</option>';
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option data-id="'.$row['id'].'" data-type="1" value="'.$row['id'].'_1">'.$row['packagename'].' Monthly</option>';
					$htmldata.='<option data-id="'.$row['id'].'" data-type="2" value="'.$row['id'].'_2">'.$row['packagename'].' Yearly</option>';
				}
				
				
				$response['data']=$htmldata;
			}
		}
		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillcompany') //Fill Company 
	{
		$isall=$IISMethods->sanitize($_POST['isall']);

		$companies=new fillcompany();
		$parms = array(
			
		);
		$qry="SELECT id,companyname FROM tblcompanymaster cm WHERE cm.isactive=1 ";
		$companies=$DB->getmenual($qry,$parms,'fillcompany');
		if(sizeof($companies)>0)
		{
			if($responsetype=='HTML')
			{
				if($isall == 1)
				{
					$htmldata.='<option value="%">All Company</option>';
				}
				foreach($companies as $company)
				{
					$htmldata.='<option value="'.$company->id.'">'.$company->companyname.'</option>';
				}
				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']= $companies;
			}
		}
		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillutype') //service (Empmaster)  
	{
		$issalesheadutype=$IISMethods->sanitize($_POST['issalesheadutype']);
		$issubadminutype=$IISMethods->sanitize($_POST['issubadminutype']);
		$isvendorutype=$IISMethods->sanitize($_POST['isvendorutype']);
		$iscustomerutype=$IISMethods->sanitize($_POST['iscustomerutype']);

		$qry="SELECT id,usertype,IFNULL(hasweblogin,0) as hasweblogin,IFNULL(hasapplogin,0) as hasapplogin from tblusertypemaster WHERE IFNULL(hasadmin,0)=0";
		$utypearr=[];
		$i=0;
		if($issalesheadutype == 1)  //When Sales Head utype
		{
			$utypearr[$i]=":salesheadutype";
			$parms[':salesheadutype']=$config->getSalesHeadutype();
			$i++;
		}
		if($issubadminutype == 1)  //When Sub Admin utype
		{
			$utypearr[$i]=":subadminutype";
			$parms[':subadminutype']=$config->getSubAdminutype();
			$i++;
		}
		if($isvendorutype == 1)  //When Vendor utype
		{
			$utypearr[$i]=":vendorutype";
			$parms[':vendorutype']=$config->getVendorutype();
			$i++;
		}
		if($iscustomerutype == 1)  //When Customer utype
		{
			$utypearr[$i]=":customerutype";
			$parms[':customerutype']=$config->getCustomerutype();
			$i++;
		}
		// $qry.=" AND id in (".implode(',',$utypearr).")";
		$qry.=" ORDER BY usertype";
		$response['qry']=$qry;
		$response['utypearr']=$utypearr;
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'" data-isweblogin="'.$row['hasweblogin'].'" data-isapplogin="'.$row['hasapplogin'].'">'.$row['usertype'].'</option>';
				}
				$response['data']=$htmldata;
			}
		}
		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillperson') //service (Empmaster)  
	{
		if($platform == 1)
		{
			$usertypeid=$config->getPatientId();;
		}
		else
		{
			$usertypeid=$IISMethods->sanitize($_POST['usertypeid']);
		}
		
		$isall=$IISMethods->sanitize($_POST['isall']);

		$qry="SELECT DISTINCT pm.id,pm.personname,pm.contact 
			FROM tblpersonmaster pm 
			INNER JOIN tblpersonutype pu ON pu.pid=pm.id 
			WHERE IFNULL(pm.isdelete,0)=0 AND pu.utypeid like :usertypeid";
		$parms = array(
			':usertypeid'=>$usertypeid,
		);
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				if($isall == 1)
				{
					$htmldata.='<option value="%">All Person</option>';
				}
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['personname'].' ('.$row['contact'].')</option>';
				}
				$response['data']=$htmldata;
			}
			$status=1;
			$message=$errmsg['success'];
		}
		
	}
	else if($action=='fillemployee') //Fill Employee 
	{
		$isselectoption=$IISMethods->sanitize($_POST['isselectoption']);

		$qry="SELECT DISTINCT pm.id,pm.personname,pm.contact 
			FROM `tblpersonmaster` pm 
			INNER JOIN `tblpersonutype` pu ON pu.pid=pm.id 
			INNER JOIN `tblusertypemaster` ut ON ut.id=pu.utypeid 
			WHERE IFNULL(pm.isdelete,0)=0 AND IFNULL(pm.isactive,0)=1 AND pm.id <> :adminuid ";
		$parms = array(
			':adminuid'=>$config->getAdminUserId(),
		);
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				if($isselectoption == 1)
				{
					$htmldata.='<option value="">Select Employee</option>';
				}
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'" data-name="'.$row['personname'].'">'.$row['personname'].' ('.$row['contact'].')</option>';
				}
				$response['data']=$htmldata;
			}
			$status=1;
			$message=$errmsg['success'];
		}	
	}
	
	else if($action == 'fillpage')
	{
		$qry="SELECT id,pagename from tblwebpagemaster WHERE status = :status";
		$parms = array(
			':status'=>1
		);
		$result_ary=$DB->getmenual($qry,$parms);
		if(sizeof($result_ary)>0)
		{
			if($responsetype=='HTML')
			{ 
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row = $result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['pagename'].'</option>';
				}
				$response['data']=$htmldata;
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
	
	else if($action=='listslider')   
	{
		$listsliders=new listslider();

		$qry="SELECT DISTINCT id,title,
			CASE WHEN (IFNULL(sliderimg,'')<>'') THEN CONCAT(:baseimgurl,sliderimg) ELSE '' END AS sliderimg
			FROM `tblslider` WHERE isactive=1 ORDER BY displayorder";
		$parms = array(
			':baseimgurl'=>$config->getImageurl(),
		);
		$listsliders=$DB->getmenual($qry,$parms,'listslider');


		if($responsetype=='HTML')
		{ 
			$htmldata='';
			if(sizeof($listsliders)>0)
			{
				foreach($listsliders as $slider)
				{
					$htmldata.='<option value="'.$slider->id.'">'.$slider->title.'</option>';
				}
				$response['data']=$htmldata;
				
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
		}
		else if($responsetype=='JSON')
		{
			if(sizeof($listsliders)>0)
			{
				$response['data']= $listsliders;

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
	// List About Us Data
	else if($action == 'listaboutusdata')
	{
		$qrychk="SELECT * from tblcontentsetting where contenttypeid=:contenttypeid";
		$parms = array(
			':contenttypeid'=>$config->getAboutUsId(),
		);
		$result_ary=$DB->getmenual($qrychk,$parms);

		if(sizeof($result_ary)>0)
		{
			$row=$result_ary[0];
			
			$response['description']=$row['description'];
			$response['img']=$config->getAboutusDefaultImg();

			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}

	//Fill Register Country
	else if($action=='fillcountry')
	{
		$countries=new fillcountry();

		$qry="SELECT id,country AS name from tblcountrymaster ORDER BY country";
		$parms = array();
		$countries=$DB->getmenual($qry,$parms,'fillcountry');

		$htmldata='';
		if(sizeof($countries)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($countries as $country)
				{
					$htmldata.='<option value="'.$country->id.'">'.$country->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$countries;
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

	//Fill Register State
	else if($action=='fillstate')   
	{
		$states=new fillstate();
		$parms = array();
		$countryid=$IISMethods->sanitize($_POST['countryid']);
		// $qry="SELECT id,state AS name from tblstatemaster where countryid=:countryid ORDER BY state";
		$qry="SELECT id,state AS name from tblstatemaster where 1=1 ";
		
		if($countryid)
		{
			$qry.=" and countryid=:countryid ";
			$parms = array(':countryid'=>$countryid);
		}
		$qry.="ORDER BY state";

		// echo $qry;
		// print_r($parms);
		$states=$DB->getmenual($qry,$parms,'fillstate');

		$htmldata='';
		if(sizeof($states)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($states as $state)
				{
					$htmldata.='<option value="'.$state->id.'">'.$state->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$states;
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
	//Fill Register City
	else if($action=='fillcity')   
	{
		$cities=new fillcity();

		$stateid=$IISMethods->sanitize($_POST['stateid']);
		$cityid=$IISMethods->sanitize($_POST['cityid']);
		$qry="SELECT id,city AS name from tblcitymaster where stateid=:stateid";
		$parms = array(	
			':stateid'=>$stateid
		);
		$cities=$DB->getmenual($qry,$parms,'fillcity');

		$htmldata='';
		if(sizeof($cities)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($cities as $city)
				{
					$htmldata.='<option value="'.$city->id.'">'.$city->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$cities;
			}
			$response['cityid']=$cityid;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action=='fillsupplytype')   
	{
		$supplytypes=new fillsupplytype();

		$qry="SELECT id,typename from tblsupplytypemaster ORDER BY typename";
		$parms = array();
		$supplytypes=$DB->getmenual($qry,$parms,'fillsupplytype');

		$htmldata='';
		if(sizeof($supplytypes)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($supplytypes as $supplytype)
				{
					$htmldata.='<option value="'.$supplytype->id.'">'.$supplytype->typename.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$supplytypes;
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
	else if($action=='fillbrand')   
	{	
		$qry="SELECT id,title from tblbrandmaster WHERE isactive=:isactive ORDER BY title";
		$parms = array(':isactive'=>1);
		$brand=$DB->getmenual($qry,$parms);

		$htmldata='';
		if($brand)
		{
			if($responsetype=='HTML')
			{
				foreach($brand as $row)
				{
					$htmldata.='<option value="'.$row['id'].'">'.$row['title'].'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$brand;
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
	else if($action=='fillattribute')   
	{
		$attributes=new fillattribute();

		$qry="SELECT id,name from tblattributemaster ORDER BY name";
		$parms = array();
		$attributes=$DB->getmenual($qry,$parms,'fillattribute');

		$htmldata='';
		if(sizeof($attributes)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($attributes as $attribute)
				{
					$htmldata.='<option value="'.$attribute->id.'">'.$attribute->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$attributes;
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
	else if($action=='fillcategory')   
	{
		$category=new fillcategory();

		$qry="SELECT id,name from tblcategorymaster WHERE isactive=:isactive  ORDER BY name";
		$parms = array(':isactive'=>1);
		$categorys=$DB->getmenual($qry,$parms,'fillcategory');

		$htmldata='';
		if(sizeof($categorys)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($categorys as $category)
				{
					$htmldata.='<option value="'.$category->id.'">'.$category->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$categorys;
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
	else if($action=='fillattributegroup')   
	{
		$attributegroup=new fillattributegroup();

		$qry="SELECT id,name from tblattributegroupmaster WHERE isactive=:isactive  ORDER BY name";
		$parms = array(':isactive'=>1);
		$attributegroups=$DB->getmenual($qry,$parms,'fillattributegroup');

		$htmldata='';
		if(sizeof($attributegroups)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($attributegroups as $attributegroup)
				{
					$htmldata.='<option value="'.$attributegroup->id.'">'.$attributegroup->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$attributegroups;
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
	else if($action=='fillbuysellprocesstype')   
	{
		$buysellprocesstype=new fillbuysellprocesstype();

		$qry="SELECT id,name from tblbuysellprocesstype WHERE isactive=:isactive  ORDER BY name";
		$parms = array(':isactive'=>1);
		$buysellprocesstypes=$DB->getmenual($qry,$parms,'fillbuysellprocesstype');

		$htmldata='';
		if(sizeof($buysellprocesstypes)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($buysellprocesstypes as $buysellprocesstype)
				{
					$htmldata.='<option value="'.$buysellprocesstype->id.'">'.$buysellprocesstype->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$buysellprocesstypes;
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
	else if($action=='filljewelrytype')   
	{
		$jewelrytype=new filljewelrytype();

		$qry="SELECT id,name from tbljewelrytypemaster WHERE isactive=:isactive  ORDER BY name";
		$parms = array(':isactive'=>1);
		$jewelrytypes=$DB->getmenual($qry,$parms,'filljewelrytype');

		$htmldata='';
		if(sizeof($jewelrytypes)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($jewelrytypes as $jewelrytype)
				{
					$htmldata.='<option value="'.$jewelrytype->id.'">'.$jewelrytype->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$jewelrytypes;
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
	else if($action=='fillquestion')   
	{
		$qry="SELECT id,question from tblindustrybenefitquestionmaster ORDER BY question";
		$parms = array();
		$questions=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($questions)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($questions as $row)
				{
					$htmldata.='<option value="'.$row['id'].'">'.$row['question'].'</option>';
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
	//Fill Department
	else if($action=='filldepartment')   
	{
		$departments=new department();

		$qry="SELECT id,name from tbldepartmentmaster ORDER BY name";
		$parms = array();
		$departments=$DB->getmenual($qry,$parms,'department');

		$htmldata='';
		if(sizeof($departments)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($departments as $department)
				{
					$htmldata.='<option value="'.$department->id.'">'.$department->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$departments;
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
	//Fill Department
	else if($action=='filldesignation')   
	{
		$designations=new designation();

		$qry="SELECT id,name from tbldesignationmaster ORDER BY name";
		$parms = array();
		$designations=$DB->getmenual($qry,$parms,'designation');

		$htmldata='';
		if(sizeof($designations)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($designations as $designation)
				{
					$htmldata.='<option value="'.$designation->id.'">'.$designation->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$designations;
			}

			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}else if($action=='fillmainshape')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$subshape=new shape();

		$qry="SELECT id,name,issubshape from tbldiamondshapemaster WHERE issubshape=:issubshape";

		$parms = array(
			':issubshape'=>0,
		);
		if($id){
			$qry.=" AND id<>:id  ";
			$parms[':id']=$id;
			
		}

		$qry.=" ORDER BY name ";
		$subshape=$DB->getmenual($qry,$parms,'shape');

		
		
		$htmldata='';
		if(sizeof($subshape)>0)
		{
			if($responsetype=='HTML')
			{
				$htmldata.='<option value=""> Select Diamond Main Shape</option>';
				foreach($subshape as $shape)
				{
					$htmldata.='<option value="'.$shape->id.'">'.$shape->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$subshape;
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
	else if($action=='fillmaincut')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$subcut=new cut();

		$qry="SELECT id,name from tblcutmaster WHERE issubcut=:issubcut";

		$parms = array(
			':issubcut'=>0,
		);
		if($id){
			$qry.=" AND id<>:id";
			$parms[':id']=$id;
		}
		$qry.=" ORDER BY name ";
		$subcut=$DB->getmenual($qry,$parms,'cut');
		// echo $qry;

		$htmldata='';
		if(sizeof($subcut)>0)
		{
			if($responsetype=='HTML')
			{
				$htmldata.='<option value=""> Select Main Cut</option>';
				foreach($subcut as $cut)
				{
					$htmldata.='<option value="'.$cut->id.'">'.$cut->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$subcut;
			}

			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}else if($action=='fillmainpolish')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$subpolish=new polish();

		$qry="SELECT id,name from tblpolishmaster WHERE issubpolish=:issubpolish";

		$parms = array(
			':issubpolish'=>0,

		);
		if($id){
			$qry.=" AND id<>:id";
			$parms[':id']=$id;
		}
		$qry.=" ORDER BY name ";
		$subpolish=$DB->getmenual($qry,$parms,'polish');

		$htmldata='';
		if(sizeof($subpolish)>0)
		{
			if($responsetype=='HTML')
			{
				$htmldata.='<option value=""> Select Main Polish</option>';
				foreach($subpolish as $polish)
				{
					$htmldata.='<option value="'.$polish->id.'">'.$polish->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$subpolish;
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
	else if($action=='fillmainsymmetry')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$subsymmetry=new symmetry();

		$qry="SELECT id,name from tblsymmetrymaster WHERE issubsymmetry=:issubsymmetry";

		$parms = array(
			':issubsymmetry'=>0,

		);
		if($id){
			$qry.=" AND id<>:id";
			$parms[':id']=$id;
		}
		$qry.=" ORDER BY name ";
		$subsymmetry=$DB->getmenual($qry,$parms,'symmetry');

		$htmldata='';
		if(sizeof($subsymmetry)>0)
		{
			if($responsetype=='HTML')
			{
				$htmldata.='<option value=""> Select Main Symmetry</option>';
				foreach($subsymmetry as $symmetry)
				{
					$htmldata.='<option value="'.$symmetry->id.'">'.$symmetry->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$subsymmetry;
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
	else if($action=='fillmaineyeclean')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$subeyeclean=new eyeclean();

		$qry="SELECT id,name from tbleyecleanmaster WHERE issubeyeclean=:issubeyeclean";

		$parms = array(
			':issubeyeclean'=>0,

		);
		if($id){
			$qry.=" AND id<>:id";
			$parms[':id']=$id;
		}
		$qry.=" ORDER BY name ";
		$subeyeclean=$DB->getmenual($qry,$parms,'eyeclean');

		$htmldata='';
		if(sizeof($subeyeclean)>0)
		{
			if($responsetype=='HTML')
			{
				$htmldata.='<option value=""> Select Main Eye Clean</option>';
				foreach($subeyeclean as $eyeclean)
				{
					$htmldata.='<option value="'.$eyeclean->id.'">'.$eyeclean->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$subeyeclean;
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
	else if($action=='listclarity')   
	{
		
		$listclarity=new listclarity();

		$qry="SELECT id,name from tblclaritymaster WHERE isactive=:isactive ORDER BY displayorder";

		$parms = array(
			':isactive'=>1,

		);
		
		$listclarity=$DB->getmenual($qry,$parms,'listclarity');

		$htmldata='';
		if(sizeof($listclarity)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($listclarity as $row)
				{
					$htmldata.='<option value="'.$row->id.'">'.$row->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$listclarity;
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
	else if($action=='listcolor')   
	{
		
		$listcolor=new listcolor();

		$qry="SELECT id,name from tbldiamondcolormaster WHERE isactive=:isactive ORDER BY displayorder";

		$parms = array(
			':isactive'=>1,

		);
		
		$listcolor=$DB->getmenual($qry,$parms,'listcolor');

		$htmldata='';
		if(sizeof($listcolor)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($listcolor as $row)
				{
					$htmldata.='<option value="'.$row->id.'">'.$row->name.'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$listcolor;
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

  