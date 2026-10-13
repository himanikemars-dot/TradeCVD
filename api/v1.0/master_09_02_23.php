<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2) . '/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';
require_once dirname(__DIR__, 2) . '/model/master.php';

if ($isvalidUser['status'] == 1) {

	$status = 0;
	$message = $errmsg['invalidrequest'];

	$imgpath = $config->getImageurl();
	if ($action == 'listbusinesstype') //LIST BUSINESS TYPE
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listbusinesstype = new listbusinesstype();
		$parms = array();
		$qry = "select id,name from tblbusinesstypemaster where isactive=1";
		$listbusinesstype = $DB->getmenual($qry, $parms, 'listbusinesstype');
		if (sizeof($listbusinesstype) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Business Type</option>';
				} else {
					$htmldata .= '<option value="">Select Business Type</option>';
				}
				foreach ($listbusinesstype as $businesstype) {
					$htmldata .= '<option value="' . $businesstype->id . '">' . $businesstype->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listbusinesstype;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcountry') //LIST COUNTRY
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listcountry = new listcountry();
		$parms = array();
		$qry = "select id,country as name from tblcountrymaster";
		$listcountry = $DB->getmenual($qry, $parms, 'listcountry');
		if (sizeof($listcountry) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Country</option>';
				} else {
					$htmldata .= '<option value="">Select Country</option>';
				}
				foreach ($listcountry as $country) {
					$htmldata .= '<option value="' . $country->id . '">' . $country->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcountry;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listphonecode') //LIST COUNTRY
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listphonecode = new listphonecode();
		$parms = array();
		$qry = "select DISTINCT id,country as name,countrycode,phonecode from tblcountrymaster";
		$listphonecode = $DB->getmenual($qry, $parms, 'listphonecode');
		if (sizeof($listphonecode) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Phone Code</option>';
				} else {
					$htmldata .= '<option value="">Select Phone Code</option>';
				}
				foreach ($listphonecode as $phonecode) {
					$htmldata .= '<option value="' . $phonecode->id . '">' . $phonecode->phonecode . '(' . $phonecode->countrycode . ')</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listphonecode;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'liststate') //LIST STATE
	{
		$isall = $IISMethods->sanitize($_POST['isall']);
		$countryid = $IISMethods->sanitize($_POST['countryid']);

		$liststate = new liststate();
		$parms = array(
			':countryid' => $countryid
		);
		$qry = "select id,state as name from tblstatemaster WHERE countryid=:countryid ORDER BY state";
		$liststate = $DB->getmenual($qry, $parms, 'liststate');
		// print_r($liststate);
		if (sizeof($liststate) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All State</option>';
				} else {
					$htmldata .= '<option value="">Select State</option>';
				}
				foreach ($liststate as $state) {
					$htmldata .= '<option value="' . $state->id . '">' . $state->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $liststate;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcity') //LIST CITY
	{
		$isall = $IISMethods->sanitize($_POST['isall']);
		$countryid = $IISMethods->sanitize($_POST['countryid']);
		$stateid = $IISMethods->sanitize($_POST['stateid']);

		$listcity = new listcity();
		$parms = array(
			':countryid' => $countryid,
			':stateid' => $stateid,
		);
		$qry = "select id,city as name from tblcitymaster WHERE countryid=:countryid AND stateid=:stateid ORDER BY city";
		$listcity = $DB->getmenual($qry, $parms, 'listcity');
		if (sizeof($listcity) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All City</option>';
				} else {
					$htmldata .= '<option value="">Select City</option>';
				}
				foreach ($listcity as $city) {
					$htmldata .= '<option value="' . $city->id . '">' . $city->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcity;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listshape') //LIST Diamond Shape
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listshape = new listshape();
		$parms = array();
		$qry = "select id,name,ifnull(img,'') AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All shape</option>';
				} else {
					$htmldata .= '<option value="">Select shape</option>';
				}
				foreach ($listshape as $shape) {
					$htmldata .= '<option value="' . $shape->id . '">' . $shape->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listshape;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listsize') //LIST Diamond size
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listsize = new listsize();
		$parms = array();
		$qry = "select id,name from tblsizemaster WHERE isactive=1 ORDER BY displayorder";
		$listsize = $DB->getmenual($qry, $parms, 'listsize');
		if (sizeof($listsize) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All size</option>';
				} else {
					$htmldata .= '<option value="">Select size</option>';
				}
				foreach ($listsize as $size) {
					$htmldata .= '<option value="' . $size->id . '">' . $size->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listsize;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listdiamondcolor') //LIST Diamond Color
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		if (sizeof($listdiamondcolor) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All diamondcolor</option>';
				} else {
					$htmldata .= '<option value="">Select diamondcolor</option>';
				}
				foreach ($listdiamondcolor as $diamondcolor) {
					$htmldata .= '<option value="' . $diamondcolor->id . '">' . $diamondcolor->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listdiamondcolor;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listclarity') //LIST Diamond Color
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All clarity</option>';
				} else {
					$htmldata .= '<option value="">Select clarity</option>';
				}
				foreach ($listclarity as $clarity) {
					$htmldata .= '<option value="' . $clarity->id . '">' . $clarity->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listclarity;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcut') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listcut = new listcut();
		$parms = array();
		$qry = "select id,name from,displayorder tblcutmaster WHERE isactive=1 ORDER BY displayorder";
		$listcut = $DB->getmenual($qry, $parms, 'listcut');
		if (sizeof($listcut) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All cut</option>';
				} else {
					$htmldata .= '<option value="">Select cut</option>';
				}
				foreach ($listcut as $cut) {
					$htmldata .= '<option value="' . $cut->id . '" data-displayorder="'.$cut->displayorder.'">' . $cut->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcut;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listpolish') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listpolish = new listpolish();
		$parms = array();
		$qry = "select id,name,displayorder from tblpolishmaster WHERE isactive=1 ORDER BY displayorder";
		$listpolish = $DB->getmenual($qry, $parms, 'listpolish');
		if (sizeof($listpolish) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All polish</option>';
				} else {
					$htmldata .= '<option value="">Select polish</option>';
				}
				foreach ($listpolish as $polish) {
					$htmldata .= '<option value="' . $polish->id . '" data-displayorder="'.$polish->displayorder.'">' . $polish->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listpolish;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcondition') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listcondition = new listcondition();
		$parms = array();
		$qry = "select id,name from tblconditionmaster WHERE isactive=1 ORDER BY name";
		$listcondition = $DB->getmenual($qry, $parms, 'listcondition');
		if (sizeof($listcondition) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All condition</option>';
				} else {
					$htmldata .= '<option value="">Select condition</option>';
				}
				foreach ($listcondition as $condition) {
					$htmldata .= '<option value="' . $condition->id . '">' . $condition->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcondition;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listgirdle') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listgirdle = new listgirdle();
		$parms = array();
		$qry = "select id,name from tblgridlemaster WHERE isactive=1 ORDER BY displayorder";
		$listgirdle = $DB->getmenual($qry, $parms, 'listgirdle');
		if (sizeof($listgirdle) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All girdle</option>';
				} else {
					$htmldata .= '<option value="">Select girdle</option>';
				}
				foreach ($listgirdle as $girdle) {
					$htmldata .= '<option value="' . $girdle->id . '">' . $girdle->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listgirdle;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listtreatment') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listtreatment = new listtreatment();
		$parms = array();
		$qry = "select id,name from tbltreatmentmaster WHERE isactive=1 ORDER BY name";
		$listtreatment = $DB->getmenual($qry, $parms, 'listtreatment');
		if (sizeof($listtreatment) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All treatment</option>';
				} else {
					$htmldata .= '<option value="">Select treatment</option>';
				}
				foreach ($listtreatment as $treatment) {
					$htmldata .= '<option value="' . $treatment->id . '">' . $treatment->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listtreatment;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listlab') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listlab = new listlab();
		$parms = array();
		$qry = "select id,name from tbllabmaster WHERE isactive=1 ORDER BY name";
		$listlab = $DB->getmenual($qry, $parms, 'listlab');
		if (sizeof($listlab) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All lab</option>';
				} else {
					$htmldata .= '<option value="">Select lab</option>';
				}
				foreach ($listlab as $lab) {
					$htmldata .= '<option value="' . $lab->id . '">' . $lab->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listlab;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listkeytosymbol') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listkeytosymbol = new listkeytosymbol();
		$parms = array();
		$qry = "select id,name from tblkeytosymbolmaster WHERE isactive=1 ORDER BY name";
		$listkeytosymbol = $DB->getmenual($qry, $parms, 'listkeytosymbol');
		if (sizeof($listkeytosymbol) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All keytosymbol</option>';
				} else {
					$htmldata .= '<option value="">Select keytosymbol</option>';
				}
				foreach ($listkeytosymbol as $keytosymbol) {
					$htmldata .= '<option value="' . $keytosymbol->id . '">' . $keytosymbol->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listkeytosymbol;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listsymmetry') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listsymmetry = new listsymmetry();
		$parms = array();
		$qry = "select id,name,displayorder from tblsymmetrymaster WHERE isactive=1 ORDER BY displayorder";
		$listsymmetry = $DB->getmenual($qry, $parms, 'listsymmetry');
		if (sizeof($listsymmetry) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All symmetry</option>';
				} else {
					$htmldata .= '<option value="">Select symmetry</option>';
				}
				foreach ($listsymmetry as $symmetry) {
					$htmldata .= '<option value="' . $symmetry->id . '" data-displayorder="'.$symmetry->displayorder.'">' . $symmetry->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listsymmetry;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listintensity') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listintensity = new listintensity();
		$parms = array();
		$qry = "select id,name from tblintensitymaster WHERE isactive=1 ORDER BY displayorder";
		$listintensity = $DB->getmenual($qry, $parms, 'listintensity');
		if (sizeof($listintensity) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All intensity</option>';
				} else {
					$htmldata .= '<option value="">Select intensity</option>';
				}
				foreach ($listintensity as $intensity) {
					$htmldata .= '<option value="' . $intensity->id . '">' . $intensity->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listintensity;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcompanycode') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listcompanycode = new listcompanycode();
		$parms = array();
		$qry = "select id,savaniid as name from tblpersonmaster WHERE isactive=1 and isverified=1 and platform=4 and ifnull(savaniid,'')<>'' ORDER BY savaniid";
		$listcompanycode = $DB->getmenual($qry, $parms, 'listcompanycode');
		if (sizeof($listcompanycode) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All companycode</option>';
				} else {
					$htmldata .= '<option value="">Select companycode</option>';
				}
				foreach ($listcompanycode as $listcompanycode) {
					$htmldata .= '<option value="' . $listcompanycode->name . '">' . $listcompanycode->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcompanycode;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'liststocknumbers') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$liststocknumbers = new liststocknumbers();
		$parms = array();
		$qry = "select id,stocknumber as name from diamondlist WHERE isactive=1 and ifnull(stocknumber,'')<>'' ORDER BY stocknumber";
		$liststocknumbers = $DB->getmenual($qry, $parms, 'liststocknumbers');
		if (sizeof($liststocknumbers) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All stocknumbers</option>';
				} else {
					$htmldata .= '<option value="">Select stocknumbers</option>';
				}
				foreach ($liststocknumbers as $liststocknumbers) {
					$htmldata .= '<option value="' . $liststocknumbers->name . '">' . $liststocknumbers->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $liststocknumbers;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listlotnumbers') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listlotnumbers = new listlotnumbers();
		$parms = array();
		$qry = "select id,savanilotnumber as name from diamondlist WHERE isactive=1 ORDER BY savanilotnumber";
		$listlotnumbers = $DB->getmenual($qry, $parms, 'listlotnumbers');
		if (sizeof($listlotnumbers) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All savanilotnumbers</option>';
				} else {
					$htmldata .= '<option value="">Select savanilotnumbers</option>';
				}
				foreach ($listlotnumbers as $listlotnumbers) {
					$htmldata .= '<option value="' . $listlotnumbers->name . '">' . $listlotnumbers->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listlotnumbers;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listovertone') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listovertone = new listovertone();
		$parms = array();
		$qry = "select id,name from tblovertonemaster WHERE isactive=1 ORDER BY name";
		$listovertone = $DB->getmenual($qry, $parms, 'listovertone');
		if (sizeof($listovertone) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All overtone</option>';
				} else {
					$htmldata .= '<option value="">Select overtone</option>';
				}
				foreach ($listovertone as $overtone) {
					$htmldata .= '<option value="' . $overtone->id . '">' . $overtone->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listovertone;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcolor') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listcolor = new listcolor();
		$parms = array();
		$qry = "select id,name from tblcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listcolor = $DB->getmenual($qry, $parms, 'listcolor');
		if (sizeof($listcolor) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All color</option>';
				} else {
					$htmldata .= '<option value="">Select color</option>';
				}
				foreach ($listcolor as $color) {
					$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcolor;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listtradeshow') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listtradeshow = new listtradeshow();
		$parms = array();
		$qry = "select id,name from tbltradeshowmaster WHERE isactive=1 ORDER BY name";
		$listtradeshow = $DB->getmenual($qry, $parms, 'listtradeshow');
		if (sizeof($listtradeshow) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All tradeshow</option>';
				} else {
					$htmldata .= '<option value="">Select tradeshow</option>';
				}
				foreach ($listtradeshow as $tradeshow) {
					$htmldata .= '<option value="' . $tradeshow->id . '">' . $tradeshow->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listtradeshow;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listbrand') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listbrand = new listbrand();
		$parms = array();
		$qry = "select id,title as name,ifnull(img,'') AS img from tblbrandmaster WHERE isactive=1 ORDER BY displayorder";
		$listbrand = $DB->getmenual($qry, $parms, 'listbrand');
		if (sizeof($listbrand) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All brand</option>';
				} else {
					$htmldata .= '<option value="">Select brand</option>';
				}
				foreach ($listbrand as $brand) {
					$htmldata .= '<option value="' . $brand->id . '">' . $brand->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listbrand;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listshade') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listshade = new listshade();
		$parms = array();
		$qry = "select id,name from tblshademaster WHERE isactive=1 ORDER BY displayorder";
		$listshade = $DB->getmenual($qry, $parms, 'listshade');
		if (sizeof($listshade) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All shade</option>';
				} else {
					$htmldata .= '<option value="">Select shade</option>';
				}
				foreach ($listshade as $shade) {
					$htmldata .= '<option value="' . $shade->id . '">' . $shade->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listshade;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listmilky') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listmilky = new listmilky();
		$parms = array();
		$qry = "select id,name,displayorder from tblmilkymaster WHERE isactive=1 ORDER BY displayorder";
		$listmilky = $DB->getmenual($qry, $parms, 'listmilky');
		if (sizeof($listmilky) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All milky</option>';
				} else {
					$htmldata .= '<option value="">Select milky</option>';
				}
				foreach ($listmilky as $milky) {
					$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listmilky;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listeyeclean') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listeyeclean = new listeyeclean();
		$parms = array();
		$qry = "select id,name from tbleyecleanmaster WHERE isactive=1 ORDER BY name";
		$listeyeclean = $DB->getmenual($qry, $parms, 'listeyeclean');
		if (sizeof($listeyeclean) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All eye clean</option>';
				} else {
					$htmldata .= '<option value="">Select eye clean</option>';
				}
				foreach ($listeyeclean as $eyeclean) {
					$htmldata .= '<option value="' . $eyeclean->id . '">' . $eyeclean->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listeyeclean;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listopeninclusion') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listopeninclusion = new listopeninclusion();
		$parms = array();
		$qry = "select id,name from tblopeninclusionmaster WHERE isactive=1 ORDER BY name";
		$listopeninclusion = $DB->getmenual($qry, $parms, 'listopeninclusion');
		if (sizeof($listopeninclusion) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All open inclusion</option>';
				} else {
					$htmldata .= '<option value="">Select open inclusion</option>';
				}
				foreach ($listopeninclusion as $openinclusion) {
					$htmldata .= '<option value="' . $openinclusion->id . '">' . $openinclusion->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listopeninclusion;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listwhiteinclusion') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listwhiteinclusion = new listwhiteinclusion();
		$parms = array();
		$qry = "select id,name from tblwhiteinclusionmaster WHERE isactive=1 ORDER BY name";
		$listwhiteinclusion = $DB->getmenual($qry, $parms, 'listwhiteinclusion');
		if (sizeof($listwhiteinclusion) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All white inclusion</option>';
				} else {
					$htmldata .= '<option value="">Select whiteinclusion</option>';
				}
				foreach ($listwhiteinclusion as $whiteinclusion) {
					$htmldata .= '<option value="' . $whiteinclusion->id . '">' . $whiteinclusion->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listwhiteinclusion;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listblackinclusion') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listblackinclusion = new listblackinclusion();
		$parms = array();
		$qry = "select id,name from tblblackinclusionmaster WHERE isactive=1 ORDER BY name";
		$listblackinclusion = $DB->getmenual($qry, $parms, 'listblackinclusion');
		if (sizeof($listblackinclusion) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All black inclusion</option>';
				} else {
					$htmldata .= '<option value="">Select blackinclusion</option>';
				}
				foreach ($listblackinclusion as $blackinclusion) {
					$htmldata .= '<option value="' . $blackinclusion->id . '">' . $blackinclusion->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listblackinclusion;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listroughdiamondsource') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listroughdiamondsource = new listroughdiamondsource();
		$parms = array();
		$qry = "select id,name from tblroughdiamondsourcemaster WHERE isactive=1 ORDER BY name";
		$listroughdiamondsource = $DB->getmenual($qry, $parms, 'listroughdiamondsource');
		if (sizeof($listroughdiamondsource) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Rough Diamond Source</option>';
				} else {
					$htmldata .= '<option value="">Select roughdiamondsource</option>';
				}
				foreach ($listroughdiamondsource as $roughdiamondsource) {
					$htmldata .= '<option value="' . $roughdiamondsource->id . '">' . $roughdiamondsource->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listroughdiamondsource;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listterms') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listterms = new listterms();
		$parms = array();
		$qry = "select id,name from tbltermsmaster WHERE isactive=1 ORDER BY name";
		$listterms = $DB->getmenual($qry, $parms, 'listterms');
		if (sizeof($listterms) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Terms</option>';
				} else {
					$htmldata .= '<option value="">Select Terms</option>';
				}
				foreach ($listterms as $terms) {
					$htmldata .= '<option value="' . $terms->id . '">' . $terms->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listterms;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listjewelrytype') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listjewelrytype = new listjewelrytype();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,CASE WHEN(img!='') THEN CONCAT(:imgurl,img) ELSE CONCAT(:imgurl,'images/searchpage/ring.svg') END AS img from tbljewelrytypemaster WHERE isactive=1 ORDER BY displayorder";
		$listjewelrytype = $DB->getmenual($qry, $parms, 'listjewelrytype');
		if (sizeof($listjewelrytype) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Type</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Type</option>';
				}
				foreach ($listjewelrytype as $jewelrytype) {
					$htmldata .= '<option value="' . $jewelrytype->id . '">' . $jewelrytype->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listjewelrytype;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listtypestyle') {
		$isall = $IISMethods->sanitize($_POST['isall']);
		$jewelrytypeid = $IISMethods->sanitize($_POST['jewelrytypeid']);

		$listtypestyle = new listtypestyle();
		$parms = array(':jewelrytypeid' => $jewelrytypeid);
		$qry = "select id,name from tbltypestylemaster WHERE isactive=1 AND jewelrytypeid=:jewelrytypeid ORDER BY displayorder";
		$listtypestyle = $DB->getmenual($qry, $parms, 'listtypestyle');
		if (sizeof($listtypestyle) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Type</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Type</option>';
				}
				foreach ($listtypestyle as $typestyle) {
					$htmldata .= '<option value="' . $typestyle->id . '">' . $typestyle->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listtypestyle;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listjewelrycategory') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listjewelrycategory = new listjewelrycategory();
		$parms = array();
		$qry = "select id,name from tbljewelrycategorymaster WHERE isactive=1 ORDER BY displayorder";
		$listjewelrycategory = $DB->getmenual($qry, $parms, 'listjewelrycategory');
		if (sizeof($listjewelrycategory) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listjewelrycategory as $jewelrycategory) {
					$htmldata .= '<option value="' . $jewelrycategory->id . '">' . $jewelrycategory->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listjewelrycategory;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listjewelrycategory') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listjewelrycategory = new listjewelrycategory();
		$parms = array();
		$qry = "select id,name from tbljewelrycategorymaster WHERE isactive=1 ORDER BY displayorder";
		$listjewelrycategory = $DB->getmenual($qry, $parms, 'listjewelrycategory');
		if (sizeof($listjewelrycategory) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listjewelrycategory as $jewelrycategory) {
					$htmldata .= '<option value="' . $jewelrycategory->id . '">' . $jewelrycategory->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listjewelrycategory;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listjewelrycategory') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listjewelrycategory = new listjewelrycategory();
		$parms = array();
		$qry = "select id,name from tbljewelrycategorymaster WHERE isactive=1 ORDER BY displayorder";
		$listjewelrycategory = $DB->getmenual($qry, $parms, 'listjewelrycategory');
		if (sizeof($listjewelrycategory) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listjewelrycategory as $jewelrycategory) {
					$htmldata .= '<option value="' . $jewelrycategory->id . '">' . $jewelrycategory->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listjewelrycategory;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listjewelryquality') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listjewelryquality = new listjewelryquality();
		$parms = array();
		$qry = "select id,name from tbljewelryqualitymaster WHERE isactive=1 ORDER BY name";
		$listjewelryquality = $DB->getmenual($qry, $parms, 'listjewelryquality');
		if (sizeof($listjewelryquality) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listjewelryquality as $jewelryquality) {
					$htmldata .= '<option value="' . $jewelryquality->id . '">' . $jewelryquality->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listjewelryquality;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listmetaltype') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listmetaltype = new listmetaltype();
		$parms = array();
		$qry = "select id,name from tblmetaltypemaster WHERE isactive=1 ORDER BY name";
		$listmetaltype = $DB->getmenual($qry, $parms, 'listmetaltype');
		if (sizeof($listmetaltype) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listmetaltype as $metaltype) {
					$htmldata .= '<option value="' . $metaltype->id . '">' . $metaltype->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listmetaltype;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listmetalcarat') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listmetalcarat = new listmetalcarat();
		$parms = array();
		$qry = "select id,name from tblmetalcaratmaster WHERE isactive=1 ORDER BY displayorder";
		$listmetalcarat = $DB->getmenual($qry, $parms, 'listmetalcarat');
		if (sizeof($listmetalcarat) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listmetalcarat as $metalcarat) {
					$htmldata .= '<option value="' . $metalcarat->id . '">' . $metalcarat->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listmetalcarat;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listgemstonetype') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listgemstonetype = new listgemstonetype();
		$parms = array();
		$qry = "select id,name from tblgemstonetypemaster WHERE isactive=1 ORDER BY displayorder";
		$listgemstonetype = $DB->getmenual($qry, $parms, 'listgemstonetype');
		if (sizeof($listgemstonetype) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Jewelry Category</option>';
				} else {
					$htmldata .= '<option value="">Select Jewelry Category</option>';
				}
				foreach ($listgemstonetype as $gemstonetype) {
					$htmldata .= '<option value="' . $gemstonetype->id . '">' . $gemstonetype->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listgemstonetype;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listdiamondsortby') {
		$isall = $IISMethods->sanitize($_POST['isall']);
		$ismydiamond = $IISMethods->sanitize($_POST['ismydiamond']);

		$listdiamondsortby = new listdiamondsortby();
		$parms = array();
		$qry = "select id,sortby AS name,colname from tbldiamondsortby WHERE isactive=1 ";
		if ($ismydiamond == 1) {
			$qry .= " AND ismydiamond=1";
		}
		$qry .= " ORDER BY displayorder";
		// echo $qry;
		$listdiamondsortby = $DB->getmenual($qry, $parms, 'listdiamondsortby');
		if (sizeof($listdiamondsortby) > 0) {
			if ($responsetype == 'HTML') {
				// if($isall == 1)
				// {
				// 	$htmldata.='<option value="%">All Jewelry Category</option>';
				// }
				// else
				// {
				// 	$htmldata.='<option value="">Select Jewelry Category</option>';
				// }
				foreach ($listdiamondsortby as $diamondsortby) {
					$htmldata .= '<option value="' . $diamondsortby->id . '">' . $diamondsortby->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listdiamondsortby;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listjewellerysortby') {
		$isall = $IISMethods->sanitize($_POST['isall']);
		$isweb = $IISMethods->sanitize($_POST['isweb']);

		$listjewellerysortby = new listjewellerysortby();
		$parms = array();

		$qrydd = " AND isweb=0";
		if ($isweb == 1) {
			$qrydd = " AND isweb=1";
		}
		$qry = "select id,name from tbljewellerysortby WHERE isactive=1 $qrydd ORDER BY displayorder";
		$listjewellerysortby = $DB->getmenual($qry, $parms, 'listjewellerysortby');
		if (sizeof($listjewellerysortby) > 0) {
			if ($responsetype == 'HTML') {
				// if($isall == 1)
				// {
				// 	$htmldata.='<option value="%">All Jewelry Category</option>';
				// }
				// else
				// {
				// 	$htmldata.='<option value="">Select Jewelry Category</option>';
				// }
				foreach ($listjewellerysortby as $jewellerysortby) {
					$htmldata .= '<option value="' . $jewellerysortby->id . '">' . $jewellerysortby->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listjewellerysortby;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listbuyrequestsortby') {
		$isall = $IISMethods->sanitize($_POST['isall']);
		$isweb = $IISMethods->sanitize($_POST['isweb']);

		$listbuyrequestsortby = new listbuyrequestsortby();
		$parms = array();

		$qry = "select id,name from tblbuyrequestsortby WHERE isactive=1 ORDER BY displayorder";
		$listbuyrequestsortby = $DB->getmenual($qry, $parms, 'listbuyrequestsortby');
		if (sizeof($listbuyrequestsortby) > 0) {
			if ($responsetype == 'HTML') {
				// if($isall == 1)
				// {
				// 	$htmldata.='<option value="%">All Jewelry Category</option>';
				// }
				// else
				// {
				// 	$htmldata.='<option value="">Select Jewelry Category</option>';
				// }
				foreach ($listbuyrequestsortby as $buyrequestsortby) {
					$htmldata .= '<option value="' . $buyrequestsortby->id . '">' . $buyrequestsortby->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listbuyrequestsortby;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listsieve') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listsieve = new listsieve();
		$parms = array();
		$qry = "select id,name from tblsievemaster WHERE isactive=1 ORDER BY name";
		$listsieve = $DB->getmenual($qry, $parms, 'listsieve');
		if (sizeof($listsieve) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All sieve</option>';
				} else {
					$htmldata .= '<option value="">Select sieve</option>';
				}
				foreach ($listsieve as $sieve) {
					$htmldata .= '<option value="' . $sieve->id . '">' . $sieve->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listsieve;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listsizecombination') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listsizecombination = new listsizecombination();
		$parms = array();
		$qry = "select id,name from tblsizemaster WHERE isactive=1 ORDER BY displayorder";
		$listsizecombination = $DB->getmenual($qry, $parms, 'listsizecombination');
		if (sizeof($listsizecombination) > 0) {
			if ($responsetype == 'JSON') {
				$response['data'] = $listsizecombination;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	}
	if ($action == 'listprimarycompanytype') //LIST Primary Company TYPE
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$primarycompanytype = new primarycompanytype();
		$parms = array();
		$qry = "select id,name from tblcompanytype where isactive=1";
		$primarycompanytype = $DB->getmenual($qry, $parms, 'primarycompanytype');
		if (sizeof($primarycompanytype) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Primary Company Type</option>';
				} else {
					$htmldata .= '<option value="">Select Primary Company Type</option>';
				}
				foreach ($primarycompanytype as $row) {
					$htmldata .= '<option value="' . $row->id . '">' . $row->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $primarycompanytype;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listcountrycode') //LIST COUNTRY
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listphonecode = new listphonecode();
		$parms = array();
		$qry = "select DISTINCT id,country as name,countrycode,phonecode from tblcountrymaster";
		$listphonecode = $DB->getmenual($qry, $parms, 'listphonecode');
		if (sizeof($listphonecode) > 0) {
			if ($responsetype == 'HTML') {
				foreach ($listphonecode as $phonecode) {
					$htmldata .= '<option value="' . $phonecode->id . '">' . $phonecode->phonecode . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listphonecode;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	}
	if ($action == 'listavailability') //LIST Primary Company TYPE
	{
		$isall = $IISMethods->sanitize($_POST['isall']);

		$availability = new listavailability();
		$parms = array();
		$qry = "select id,name from tblavailabilitymaster where isactive=1";
		$availability = $DB->getmenual($qry, $parms, 'listavailability');
		if (sizeof($availability) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All Availability</option>';
				} else {
					$htmldata .= '<option value="">Select Availability</option>';
				}
				foreach ($availability as $row) {
					$htmldata .= '<option value="' . $row->id . '">' . $row->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $availability;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listdiamondsearchdata') {
		$htmldata = '';
		$htmldata .= '<div id="accordion">';
		$htmldata .= '<div class="card collapse-card">';
		// $htmldata .= '<div class="card-header">';
		$htmldata .= '<a class="card-link card-header" data-toggle="collapse" href="#collapseOne">';
		$htmldata .= 'Basic';
		$htmldata .= '</a>';
		// $htmldata .= '</div>';
		$htmldata .= '<div id="collapseOne" class="collapse show">';

		$listshape = new listshape();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,concat(:imgurl,ifnull(img,'')) AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			$htmldata .= '<div class="form-group shape-group dash-shape shapeDiv serssh">';
			$htmldata .= '<div class="name-filter">Shape</div>';
			$htmldata .= '<div class="row-filter dash-row" id="shapeDivData">';
			$htmldata .= '<div class="filter-container">';
			$p=1;
			foreach ($listshape as $shape) {

				$htmldata .= '<div class="filter custom-checkbox "><input type="checkbox" id="f' . $shape->id . '" data-name="' . $shape->name . '" name="fltshapeid[]" class="dashboard-control custom-control-input fltshapeid" value="' . $shape->id . '"><label for="f' . $shape->id . '" class="custom-control-label with-img">';
				$htmldata .= '<span class="img-wrap"><img  src="' . $shape->img . '" alt="' . $shape->name . '" class="img-responsive"> </span><span class="text-label">' . $shape->name . '</span></label>';
				$htmldata .= '</div>';
				// if($p>13)
				// {
				// 	$htmldata .= '<button type="button" id="btnshapdownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $p++;
			}

			$htmldata .= '<button type="button" id="btnshapdownarrow" class="btn show-more-filters  btnshapshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';
		
			// $htmldata .= '<button type="button" class="btn show-more-filters">';
			// $htmldata .= '	<span class="text">+ 18 More</span>';
			// $htmldata .= '	<span class="text opened">- 18 Less</span>';
			// $htmldata .= '	<span class="arrow-btn">';
			// $htmldata .= '	</span>';
			// $htmldata .= '</button>';
			

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			
		}

		$htmldata .= '<div class="form-group sizeresponsiveset size-group dash-size-group sizeDiv">';
		$htmldata .= '<div class="name-filter">Size</div>';
		$htmldata .= '<div class="row-filter dash-row dset-smoblie">';
		$htmldata .= '<div class="col-12 col-lg-2 col-xl-2 col-md-3 col-sm-3 sizesetall">';
		$htmldata .= '<div class="cut-group">';
		$htmldata .= '<label id="sizfrom">From</label>';
		$htmldata .= '<input type="number" min="0" value="0" class="fromusd inputval" onkeypress="numbonly(event);" onpaste="numbonly(event);" id="fltfromsize" name="fltfromsize" placeholder="Enter Size">';
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-2 col-xl-2 col-md-3 col-sm-3">';
		$htmldata .= '<div class="cut-group">';
		$htmldata .= '<label id="sizto">To</label>';
		$htmldata .= '<input type="number" min="0" value="0" class="fromusd inputval" name="flttosize" id="flttosize" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="Enter Size">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row-filter dash-row col-12 col-md-6 set-searchbar col-lg-8 col-xl-8" id="ssizeDivData">';
		// size code html add (Priyank 31-12-2022)
		$htmldata .= '<div class="row-filter dash-row sizesearset">';
			$htmldata .= ' <div class="filter-container">';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c0" name="fltsizchk[]" data-mainid="0" class="dashboard-control custom-control-input" data-name="0.30-0.39" value="0.30-0.39">';
					$htmldata .= '<label for="c0" class="custom-control-label twolinedata"> 0.30 - 0.39</label>';
					// $htmldata .= '<pre>
					// 			0.30 - 
					// 			0.39
					// 			</pre>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c1" name="fltsizchk[]" data-mainid="1" class="dashboard-control custom-control-input" data-name="0.40-0.49" value="0.40-0.49">';
					$htmldata .= '<label for="c1" class="custom-control-label twolinedata">0.40-0.49</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c2" name="fltsizchk[]" data-mainid="2" class="dashboard-control custom-control-input" data-name="0.50-0.59" value="0.50-0.59">';
					$htmldata .= '<label for="c2" class="custom-control-label twolinedata">0.50-0.59</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c3" name="fltsizchk[]" data-mainid="3" class="dashboard-control custom-control-input" data-name="0.60-0.69" value="0.60-0.69">';
					$htmldata .= '<label for="c3" class="custom-control-label twolinedata">0.60-0.69</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c4" name="fltsizchk[]" data-mainid="4" class="dashboard-control custom-control-input" data-name="0.70-0.79" value="0.70-0.79">';
					$htmldata .= '<label for="c4" class="custom-control-label twolinedata">0.70-0.79</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c5" name="fltsizchk[]" data-mainid="5" class="dashboard-control custom-control-input" data-name="0.80-0.89" value="0.80-0.89">';
					$htmldata .= '<label for="c5" class="custom-control-label twolinedata">0.80-0.89</label>';
				$htmldata .= '</div>';

				$htmldata .= '<button type="button" id="btnshapdownarrow" class="btn show-more-filters">';
				$htmldata .= '	<span class="text">+ More</span>';
				$htmldata .= '	<span class="text opened">- Less</span>';
				$htmldata .= '	<span class="arrow-btn1">';
				// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive"> ';
				$htmldata .= '		+ More ';
				$htmldata .= '	</span>';
				$htmldata .= '</button>';

				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c6" name="fltsizchk[]" data-mainid="6" class="dashboard-control custom-control-input" data-name="0.90-0.99" value="0.90-0.99">';
					$htmldata .= '<label for="c6" class="custom-control-label twolinedata">0.90-0.99</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c7" name="fltsizchk[]" data-mainid="7" class="dashboard-control custom-control-input" data-name="1.00-1.49" value="1.00-1.49">';
					$htmldata .= '<label for="c7" class="custom-control-label twolinedata">1.00-1.49</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
						$htmldata .= ' <input type="checkbox" id="c8" name="fltsizchk[]" data-mainid="8" class="dashboard-control custom-control-input" data-name="1.50-1.99" value="1.50-1.99">';
						$htmldata .= '<label for="c8" class="custom-control-label twolinedata">1.50-1.99</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
					$htmldata .= ' <input type="checkbox" id="c9" name="fltsizchk[]" data-mainid="9" class="dashboard-control custom-control-input" data-name="2.00-2.99" value="2.00-2.99">';
					$htmldata .= '<label for="c9" class="custom-control-label twolinedata">2.00-2.99</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
						$htmldata .= ' <input type="checkbox" id="c10" name="fltsizchk[]" data-mainid="10" class="dashboard-control custom-control-input" data-name="3.00-3.99" value="3.00-3.99">';
						$htmldata .= '<label for="c10" class="custom-control-label twolinedata">3.00-3.99</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
						$htmldata .= ' <input type="checkbox" id="c11" name="fltsizchk[]" data-mainid="11" class="dashboard-control custom-control-input" data-name="4.00-4.99" value="4.00-4.99">';
						$htmldata .= '<label for="c11" class="custom-control-label twolinedata">4.00-4.99</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
						$htmldata .= ' <input type="checkbox" id="c12" name="fltsizchk[]" data-mainid="12" class="dashboard-control custom-control-input" data-name="5.00-5.99" value="5.00-5.99">';
						$htmldata .= '<label for="c12" class="custom-control-label twolinedata">5.00-5.99</label>';
				$htmldata .= '</div>';
				$htmldata .= '<div class="filter width_lable custom-checkbox ">';
						$htmldata .= ' <input type="checkbox" id="c13" name="fltsizchk[]" data-mainid="13" class="dashboard-control custom-control-input" data-name="10.00-10.99" value="10.00-10.99">';
						$htmldata .= '<label for="c13" class="custom-control-label twolinedata">10.00-10.99</label>';
				$htmldata .= '</div>';
			$htmldata .= '</div>';
		$htmldata .= '</div>';

		// $htmldata .= '<button type="button" class="btn show-more-filters">';
		// $htmldata .= '	<span class="text">+ 18 More</span>';
		// $htmldata .= '	<span class="text opened">- 18 Less</span>';
		// $htmldata .= '	<span class="arrow-btn">';
		// $htmldata .= '	</span>';
		// $htmldata .= '</button>';
		// size code html End (Priyank 31-12-2022)
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		
			$htmldata .= '<div class="form-group color-group dash-shape colorDiv">';
				$htmldata .= '<div class="name-filter">Color
								<p class="clscolortype">
									<a class="clscolortag" data-id="1">Fancy</a> | <a class="active clscolortag" data-id="2">White</a>
								</p>
							</div>';
							if (sizeof($listdiamondcolor) > 0) {
								$htmldata .= '<div class="row-filter dash-row clswhitecolor" id="colorDivData">';
									$htmldata .= '<div class="filter-container ">';
									$j=1;
										foreach ($listdiamondcolor as $diamondcolor) {
											$htmldata .= '<div class="filter dimond-claritywi custom-checkbox">';
											$htmldata .= '<input type="checkbox" id="c' . $diamondcolor->id . '" data-name="' . $diamondcolor->name . '" name="fltcolorid[]" class="dashboard-control custom-control-input clscolordetail" value="' . $diamondcolor->id . '">';
											$htmldata .= '<label for="c' . $diamondcolor->id . '" class="custom-control-label">' . $diamondcolor->name . '</label>';
											$htmldata .= '</div>';

											// if($j>14)
											// {
											// 	$htmldata .= '<button type="button" id="btnshapdownarrow" class="btn show-more-filters">';
											// 	$htmldata .= '	<span class="text">+ More</span>';
											// 	$htmldata .= '	<span class="text opened">- Less</span>';
											// 	$htmldata .= '	<span class="arrow-btn1">';
											// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
											// 	$htmldata .= '		+ More';
											// 	$htmldata .= '	</span>';
											// 	$htmldata .= '</button>';
											// }
											// $j++;
										}
										$htmldata .= '<button type="button" id="btncolordownarrow" class="btn show-more-filters  btncolorshowmore d-none">';
										$htmldata .= '	<span class="text">+ More</span>';
										$htmldata .= '	<span class="text opened">- Less</span>';
										$htmldata .= '	<span class="arrow-btn1 shpesm">';
										$htmldata .= '		+ More';
										$htmldata .= '	</span>';
										$htmldata .= '</button>';
									$htmldata .= '</div>';

									
								
								$htmldata .= '</div>';
							}
				$htmldata .= '<div class="row-filter dash-row clsfancycolor d-none" id="colorDivData">';
					// $htmldata .= '<div class="filter-container ">';
					$htmldata .= '<div class="row-filter dash-row">';
					$htmldata .= '<div class="col-12 col-md-12">';
					$htmldata .= '<div class="row">';
						$listintensity = new listintensity();
						$parms = array();
						$qry = "select id,name,displayorder from tblfancyintensitymaster WHERE isactive=1 ORDER BY displayorder";
						$listintensity = $DB->getmenual($qry, $parms, 'listintensity');
						if (sizeof($listintensity) > 0) {
							/* $htmldata .= '<div class="col-12 col-md-2 mb-3 sizesetall intensity-group">';
							$htmldata .= '<label id="intensity">From Intensity</label>';
							$htmldata .= '<select class="form-control select2" name="fltintensity[]" id="fltintensity" multiple="multiple" tabindex="-1" aria-hidden="true">';
							foreach ($listintensity as $intensity) {
								$htmldata .= '<option value="' . $intensity->id . '" data-displayorder="'.$intensity->displayorder.'">' . $intensity->name . '</option>';
							}
							$htmldata .= '</select>';
							$htmldata .= '</div>'; */

							$htmldata .= '<div class="col-12 col-md-2 mb-3 sizesetall intensity-group">';
							$htmldata .= '<label id="intensity">Intensity</label>';
							$htmldata .= '<select class="form-control select2" name="fltfromintensity" id="fltfromintensity"  tabindex="-1" aria-hidden="true">';
							$htmldata .= '<option value="">From</option>';
							foreach ($listintensity as $intensity) {
								$htmldata .= '<option value="' . $intensity->id . '" data-displayorder="'.$intensity->displayorder.'">' . $intensity->name . '</option>';
							}
							$htmldata .= '</select>';
							$htmldata .= '</div>';

							$htmldata .= '<div class="col-12 col-md-2 mb-3 sizesetall intensity-group">';
							$htmldata .= '<label id="intensity">&nbsp;</label>';
							$htmldata .= '<select class="form-control select2" name="flttointensity" id="flttointensity" tabindex="-1" aria-hidden="true">';
							$htmldata .= '<option value="">To</option>';
							/* foreach ($listintensity as $intensity) {
								$htmldata .= '<option value="' . $intensity->id . '" data-displayorder="'.$intensity->displayorder.'">' . $intensity->name . '</option>';
							} */
							$htmldata .= '</select>';
							$htmldata .= '</div>';
						}



						$listovertone = new listovertone();
						$parms = array();
						$qry = "select id,name from tblovertonemaster WHERE isactive=1 ORDER BY name";
						$listovertone = $DB->getmenual($qry, $parms, 'listovertone');
						if (sizeof($listovertone) > 0) {
							$htmldata .= '<div class="col-12 col-md-4 mb-3 sizesetall intensity-group">';
							$htmldata .= '<label id="overtone">Overtone</label>';
							$htmldata .= '<select class="form-control select2" name="fltovertone[]" id="fltovertone" multiple="multiple" tabindex="-1" aria-hidden="true">';
							foreach ($listovertone as $overtone) {
								$htmldata .= '<option value="' . $overtone->id . '">' . $overtone->name . '</option>';
							}
							$htmldata .= '</select>';
							$htmldata .= '</div>';
						}

						$listcolor = new listcolor();
						$parms = array();
						$qry = "select id,name from tblcolormaster WHERE isactive=1 ORDER BY displayorder";
						$listcolor = $DB->getmenual($qry, $parms, 'listcolor');
						if (sizeof($listcolor) > 0) {
							$htmldata .= '<div class="col-12 col-md-4 mb-3 sizesetall intensity-group">';
							$htmldata .= '<label id="color">Color</label>';
							$htmldata .= '<select class="form-control select2" name="fltcolor[]" id="fltcolor" multiple="multiple" tabindex="-1" aria-hidden="true">';
							foreach ($listcolor as $color) {
								$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
							}
							$htmldata .= '</select>';
							$htmldata .= '</div>';
						}


					$htmldata .= '</div>';
					$htmldata .= '</div>';
					$htmldata .= '</div>';
					// $htmldata .= '</div>';
				$htmldata .= '</div>';

			$htmldata .= '</div>';
		
		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {

			$htmldata .= '<div class="form-group clarity-group dash-shape clarityDiv">';
			$htmldata .= '<div class="name-filter">Clarity </div>';
			$htmldata .= '<div class="row-filter dash-row set-dimondcla" id="clarityDivData">';
			$htmldata .= '<div class="filter-container">';
			$l=1;
			foreach ($listclarity as $clarity) {
				$htmldata .= '<div class="filter dimond-claritywi custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="c' . $clarity->id . '" data-name="' . $clarity->name . '" name="fltclarityid[]" class="dashboard-control custom-control-input" value="' . $clarity->id . '">';
				$htmldata .= '<label for="c' . $clarity->id . '" class="custom-control-label">' . $clarity->name . '</label>';
				$htmldata .= '</div>';

				// if($l>13)
				// {
				// 	$htmldata .= '<button type="button" id="btnculetconddownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}

			$htmldata .= '<button type="button" id="btnclaritydownarrow" class="btn show-more-filters  btnclarityshowmore d-none d-md-block d-lg-block d-xl-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$htmldata .= '<div class="form-group multiply-group-filter inclusionsdetailDiv">';
		$htmldata .= '<div class="name-filter">Inclusions</div>';
		$htmldata .= '<div class="row-filter dash-row">';
		$htmldata .= '<div class="col-12 col-md-12">';
		$htmldata .= '<div class="row">';
		$listeyeclean = new listeyeclean();
		$parms = array();
		$qry = "select id,name from tbleyecleanmaster WHERE isactive=1 ORDER BY name";
		$listeyeclean = $DB->getmenual($qry, $parms, 'listeyeclean');
		if (sizeof($listeyeclean) > 0) {
			$htmldata .= '<div class="col-12 col-md-4 mb-3 sizesetall cut-group">';
			$htmldata .= '<label id="eyeclean">Eye Clean';
			$htmldata .= '<!-- <img class="savani-que" src="<?php echo $config->getimageurl() ?>images/adminimg/qusetion.svg" alt="savani" title="savani"> -->';
			$htmldata .= '</label>';
			$htmldata .= '<select class="form-control select2" name="flteyecleanid[]" id="flteyecleanid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listeyeclean as $eyeclean) {
				$htmldata .= '<option value="' . $eyeclean->id . '">' . $eyeclean->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listmilky = new listmilky();
		$parms = array();
		$qry = "select id,name,displayorder from tblmilkymaster WHERE isactive=1 ORDER BY displayorder";
		$listmilky = $DB->getmenual($qry, $parms, 'listmilky');
		if (sizeof($listmilky) > 0) {
			/* $htmldata .= '<div class="col-12 col-md-4 mb-3  cut-group">';
			$htmldata .= '<label id="ppcto">Milky</label>';
			$htmldata .= '<select class="form-control select2" name="fltmilkyid[]" id="fltmilkyid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="col-12 col-md-4 mb-3  cut-group">';
			$htmldata .= '<label id="ppcto">Milky</label>';
			$htmldata .= '<select class="form-control select2" name="fltfrommilkyid" id="fltfrommilkyid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">From</option>';
			foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-4 mb-3  cut-group">';
			$htmldata .= '<label id="ppcto">&nbsp;</label>';
			$htmldata .= '<select class="form-control select2" name="flttomilkyid" id="flttomilkyid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">To</option>';
			/* foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			} */
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listopeninclusion = new listopeninclusion();
		$parms = array();
		$qry = "select id,name from tblopeninclusionmaster WHERE isactive=1 ORDER BY name";
		$listopeninclusion = $DB->getmenual($qry, $parms, 'listopeninclusion');
		if (sizeof($listopeninclusion) > 0) {
			$htmldata .= '<div class="col-12 col-md-4 mb-3 sizesetall cut-group">';
			$htmldata .= '<label id="ppcto">Open Inclusions</label>';
			$htmldata .= '<select class="form-control select2" name="fltopeninclusionid[]" id="fltopeninclusionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listopeninclusion as $openinclusion) {
				$htmldata .= '<option value="' . $openinclusion->id . '">' . $openinclusion->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listwhiteinclusion = new listwhiteinclusion();
		$parms = array();
		$qry = "select id,name from tblwhiteinclusionmaster WHERE isactive=1 ORDER BY name";
		$listwhiteinclusion = $DB->getmenual($qry, $parms, 'listwhiteinclusion');
		if (sizeof($listwhiteinclusion) > 0) {
			$htmldata .= '<div class="col-12 col-md-4  mb-3 sizesetall cut-group">';
			$htmldata .= '<label id="ppcto">White Inclusions</label>';
			$htmldata .= '<select class="form-control select2" name="fltwhiteinclusionid[]" id="fltwhiteinclusionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listwhiteinclusion as $whiteinclusion) {
				$htmldata .= '<option value="' . $whiteinclusion->id . '">' . $whiteinclusion->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listblackinclusion = new listblackinclusion();
		$parms = array();
		$qry = "select id,name from tblblackinclusionmaster WHERE isactive=1 ORDER BY name";
		$listblackinclusion = $DB->getmenual($qry, $parms, 'listblackinclusion');
		if (sizeof($listblackinclusion) > 0) {
			$htmldata .= '<div class="col-12 col-md-4 mb-3 cut-group">';
			$htmldata .= '<label id="ppcto">Black Inclusions</label>';
			$htmldata .= '<select class="form-control select2" name="fltblackinclusionid[]" id="fltblackinclusionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listblackinclusion as $blackinclusion) {
				$htmldata .= '<option value="' . $blackinclusion->id . '">' . $blackinclusion->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$listshade = new listshade();
		$parms = array();
		$qry = "select id,name,isnobgm from tblshademaster WHERE isactive=1 ORDER BY displayorder";
		$listshade = $DB->getmenual($qry, $parms, 'listshade');
		if (sizeof($listshade) > 0) {
			$htmldata .= '<div class="form-group multiply-group-filter shadedetailDiv">';
			$htmldata .= '<div class="name-filter">Shade</div>';
			$htmldata .= '<div class="row-filter dash-row">';
			$htmldata .= '<div class="col-12 col-md-12 setresdi">';
			$htmldata .= '<div class="row">';

			$htmldata .= '<div class="col-12 col-md-4 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion"> Shade</label>';
			$htmldata .= '<select class="form-control select2" name="fltshadeid[]" id="fltshadeid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listshade as $shade) {
				$htmldata .= '<option value="' . $shade->id . '" data-isnobgm="' . $shade->isnobgm . '">' . $shade->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			// $htmldata .= '<div class="d-block mt-auto setpredi">';
			// $htmldata .= '<div class="form-check">';
			// $htmldata .= '<input class="form-check-input" type="radio" name="hascontains" value="1" id="shadecontain" checked>';
			// $htmldata .= '<label class="form-check-label ml-4" for="shadecontain">';
			// $htmldata .= 'Contains';
			// $htmldata .= '</label>';
			// $htmldata .= '</div>';
			// $htmldata .= '<div class="form-check">';
			// $htmldata .= '<input class="form-check-input" type="radio" name="hascontains" value="0" id="dtshadecontain">';
			// $htmldata .= '<label class="form-check-label ml-4" for="dtshadecontain">';
			// $htmldata .= 'Does Not Contain';
			// $htmldata .= '</label>';
			// $htmldata .= '</div>';
			// $htmldata .= '</div>';
			$htmldata .= '<div class="form-check mt-auto textset">';
			$htmldata .= '<input class="form-check-input" type="checkbox" value="1" id="nobgm">';
			$htmldata .= '<label class="form-check-label ml-4" for="nobgm">';
			$htmldata .= '<b class="text-black"> No BGM </b>';
			$htmldata .= '</label>';
			$htmldata .= '</div>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}

		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Finish</div>';
		$htmldata .= '<div class="row-filter dash-row">';
		$htmldata .= '<div class="col-12 col-md-12">';
		$htmldata .= '<div class="row">';
		$listcut = new listcut();
		$parms = array();
		$qry = "select id,name,displayorder from tblcutmaster WHERE isactive=1 ORDER BY displayorder";
		$listcut = $DB->getmenual($qry, $parms, 'listcut');
		if (sizeof($listcut) > 0) {
			/* $htmldata .= '<div class="col-12 col-md-4 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">Cut</label>';
			$htmldata .= '<select class="form-control select2" name="fltcutid[]" id="fltcutid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcut as $cut) {
				$htmldata .= '<option value="' . $cut->id . '" data-displayorder="'.$cut->displayorder.'">' . $cut->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="col-12 col-md-6 col-lg-2 col-xl-2 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">Cut </label>';
			$htmldata .= '<select class="form-control select2" name="fltfromcutid" id="fltfromcutid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">From</option>';
			foreach ($listcut as $cut) {
				$htmldata .= '<option value="' . $cut->id . '" data-displayorder="'.$cut->displayorder.'">' . $cut->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 col-lg-2 col-xl-2 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">&nbsp;</label>';
			$htmldata .= '<select class="form-control select2" name="flttocutid" id="flttocutid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">To</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listpolish = new listpolish();
		$parms = array();
		$qry = "select id,name,displayorder from tblpolishmaster WHERE isactive=1 ORDER BY displayorder";
		$listpolish = $DB->getmenual($qry, $parms, 'listpolish');
		if (sizeof($listpolish) > 0) {
			/* $htmldata .= '<div class="col-12 col-md-4 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">Polish</label>';
			$htmldata .= '<select class="form-control select2" name="fltpolishid[]" id="fltpolishid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listpolish as $polish) {
				$htmldata .= '<option value="' . $polish->id . '" data-displayorder="'.$polish->displayorder.'">' . $polish->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="col-12 col-md-6 col-lg-2 col-xl-2 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">Polish</label>';
			$htmldata .= '<select class="form-control select2" name="fltfrompolishid" id="fltfrompolishid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">From</option>';
			foreach ($listpolish as $polish) {
				$htmldata .= '<option value="' . $polish->id . '" data-displayorder="'.$polish->displayorder.'">' . $polish->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 col-lg-2 col-xl-2 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">&nbsp;</label>';
			$htmldata .= '<select class="form-control select2" name="flttopolishid" id="flttopolishid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">To</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listsymmetry = new listsymmetry();
		$parms = array();
		$qry = "select id,name,displayorder from tblsymmetrymaster WHERE isactive=1 ORDER BY displayorder";
		$listsymmetry = $DB->getmenual($qry, $parms, 'listsymmetry');
		if (sizeof($listsymmetry) > 0) {
			/* $htmldata .= '<div class="col-12 col-md-4 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">Symmetry</label>';
			$htmldata .= '<select class="form-control select2" name="fltsymmetryid[]" id="fltsymmetryid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listsymmetry as $symmetry) {
				$htmldata .= '<option value="' . $symmetry->id . '" data-displayorder="'.$symmetry->displayorder.'">' . $symmetry->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="col-12 col-md-6 col-lg-2 col-xl-2 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">Symmetry</label>';
			$htmldata .= '<select class="form-control select2" name="fltfromsymmetryid" id="fltfromsymmetryid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">From</option>';
			foreach ($listsymmetry as $symmetry) {
				$htmldata .= '<option value="' . $symmetry->id . '" data-displayorder="'.$symmetry->displayorder.'">' . $symmetry->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 col-lg-2 col-xl-2 mb-3  sizesetall  cut-group">';
			$htmldata .= '<label id="openinclusion">&nbsp;</label>';
			$htmldata .= '<select class="form-control select2" name="flttosymmetryid" id="flttosymmetryid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">To</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}

		$htmldata .= '';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="form-group flu-group dash-flu-group1 dash-shape intensityDiv setfilterres">';
		$htmldata .= '<div class="name-filter">Fluorescence Intensity</div>';
		$listintensity = new listintensity();
		$parms = array();
		$qry = "select id,name from tblintensitymaster WHERE isactive=1 ORDER BY displayorder";
		$listintensity = $DB->getmenual($qry, $parms, 'listintensity');
		if (sizeof($listintensity) > 0) {
			$htmldata .= '<div class="row-filter dash-row" id="intensityDivData">';
			$htmldata .= '<div class="filter-container">';
			$l=1;
			foreach ($listintensity as $intensity) {
				
				$htmldata .= '<div class="filter custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="c' . $intensity->id . '" name="fltintensityid[]" data-name="' . $intensity->name . '" class="dashboard-control custom-control-input" value="' . $intensity->id . '">';
				$htmldata .= '<label for="c' . $intensity->id . '" class="custom-control-label">' . $intensity->name . '</label>';
				$htmldata .= '</div>';
				

				// if($l>5)
				// {
				// 	$htmldata .= '<button type="button" id="btnculetconddownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}
			$htmldata .= '<button type="button" id="btnintensitydownarrow" class="btn show-more-filters  btnintensityshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$listcolor = new listcolor();
		$parms = array();
		$qry = "select id,name from tblcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listcolor = $DB->getmenual($qry, $parms, 'listcolor');
		if (sizeof($listcolor) > 0) {
			$htmldata .= '<div class="col-12 col-sm-2 col-md-2 cut-group">';
			$htmldata .= '<label id="ficolor">Color</label>';
			$htmldata .= '<select class="form-control select2" name="fltfluorescencecolorid[]" id="fltfluorescencecolorid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcolor as $color) {
				$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '<div class="form-group color-group dash-shape labDiv">';
		$htmldata .= '<div class="name-filter">Grading Report</div>';
		$htmldata .= '<div class="row-filter dash-row" id="labDivData">';
		$htmldata .= '<div class="filter-container">';
		$listlab = new listlab();
		$parms = array();
		$qry = "select id,name from tbllabmaster WHERE isactive=1 ORDER BY displayorder";
		$listlab = $DB->getmenual($qry, $parms, 'listlab');
		if (sizeof($listlab) > 0) {
			$l=1;
			foreach ($listlab as $lab) {
				$htmldata .= '<div class="filter custom-checkbox"><input type="checkbox" id="c' . $lab->id . '" name="fltlabid[]" data-name="' . $lab->name . '" class="dashboard-control custom-control-input" value="' . $lab->id . '">';
				$htmldata .= '<label for="c' . $lab->id . '" class="custom-control-label">' . $lab->name . '</label>';
				$htmldata .= '</div>';
				// if($l>13)
				// {
				// 	$htmldata .= '<button type="button" id="btnculetconddownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}
			$htmldata .= '<button type="button" id="btngradingdownarrow" class="btn show-more-filters  btngradingshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$listcountry = new listcountry();
		$parms = array();
		$qry = "select id,country as name from tblcountrymaster";
		$listcountry = $DB->getmenual($qry, $parms, 'listcountry');
		if (sizeof($listcountry) > 0) {
			$htmldata .= '<div class="form-group size-group dash-size-group">';
			$htmldata .= '<div class="name-filter">Location</div>';
			$htmldata .= '<div class="row-filter dash-row setrowwi">';
			$htmldata .= '<div class="setwid sizesetall cut-group">';
			$htmldata .= '<label id="llocation">location</label>';
			$htmldata .= '<select class="form-control select2" name="fltlocationid[]" id="fltlocationid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcountry as $country) {
				$htmldata .= '<option value="' . $country->id . '">' . $country->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '<!-- <div class="setwid mt-auto setmt">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" value="1" id="isflexibledelivery">';
			$htmldata .= '<label class="form-check-label ml-4" for="isflexibledelivery">';
			$htmldata .= '<b class="text-black"> Flexible Delivery</b>';
			$htmldata .= '</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div> -->';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Sellers</div>';
		$htmldata .= '<div class="row-filter dash-row setrowwi">';
		$listcompanycode = new listcompanycode();
		$parms = array();
		$qry = "select id,savaniid as name from tblpersonmaster WHERE isactive=1 and isverified=1 and platform=4 and ifnull(savaniid,'')<>'' ORDER BY savaniid";
		$listcompanycode = $DB->getmenual($qry, $parms, 'listcompanycode');
		if (sizeof($listcompanycode) > 0) {
			$htmldata .= '<div class="sizesetall cut-group setwid">';
			$htmldata .= '<label id="ssc">ID/ Company Code</label>';
			$htmldata .= '<select class="form-control select2" name="fltcompanycode" id="fltcompanycode" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">&nbsp;</option>';
			foreach ($listcompanycode as $listcompanycode) {
				$htmldata .= '<option value="' . $listcompanycode->name . '">' . $listcompanycode->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$liststocknumbers = new liststocknumbers();
		$parms = array();
		$qry = "select id,stocknumber as name from diamondlist WHERE isactive=1 and ifnull(stocknumber,'')<>'' ORDER BY stocknumber";
		$liststocknumbers = $DB->getmenual($qry, $parms, 'liststocknumbers');
		if (sizeof($liststocknumbers) > 0) {
			$htmldata .= '<div class="cut-group setwid">';
			$htmldata .= '<label id="ssnumber">Stock Numbers</label>';
			$htmldata .= '<select class="form-control select2" name="fltstocknumbers" id="fltstocknumbers" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">&nbsp;</option>';
			foreach ($liststocknumbers as $liststocknumbers) {
				$htmldata .= '<option value="' . $liststocknumbers->name . '">' . $liststocknumbers->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listlotnumbers = new listlotnumbers();
		$parms = array();
		$qry = "select id,savanilotnumber as name from diamondlist WHERE isactive=1 ORDER BY savanilotnumber";
		$listlotnumbers = $DB->getmenual($qry, $parms, 'listlotnumbers');
		if (sizeof($listlotnumbers) > 0) {
			$htmldata .= '<div class="cut-group setwid">';
			$htmldata .= '<label id="llocation">Lot Numbers</label>';
			$htmldata .= '<select class="form-control select2" name="fltsavanilotnumber" id="fltlotnumbers" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">&nbsp;</option>';
			foreach ($listlotnumbers as $listlotnumbers) {
				$htmldata .= '<option value="' . $listlotnumbers->name . '">' . $listlotnumbers->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$listroughdiamondsource = new listroughdiamondsource();
		$parms = array();
		$qry = "select id,name from tblroughdiamondsourcemaster WHERE isactive=1 ORDER BY name";
		$listroughdiamondsource = $DB->getmenual($qry, $parms, 'listroughdiamondsource');
		if (sizeof($listroughdiamondsource) > 0) {
			$htmldata .= '<div class="form-group size-group dash-size-group">';
			$htmldata .= '<div class="name-filter">Rough source</div>';

			$htmldata .= '<div class="row-filter dash-row">';
			$htmldata .= '<div class="col-12 col-md-12 sizesetall cut-group">';
			$htmldata .= '<select class="form-control select2" name="fltroughsourceid[]" id="fltroughsourceid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listroughdiamondsource as $roughdiamondsource) {
				$htmldata .= '<option value="' . $roughdiamondsource->id . '">' . $roughdiamondsource->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '</div>';
		}

		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="card collapse-card">';
		// $htmldata .= '<div class="card-header">';
		$htmldata .= '<a class="collapsed card-header card-link" data-toggle="collapse" href="#collapseTwo">';
		$htmldata .= 'Preferences';
		$htmldata .= '</a>';
		// $htmldata .= '</div>';
		$htmldata .= '<div id="collapseTwo" class="collapse">';
		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Price';
		$htmldata .= '';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '<div class="row-filter dash-row fltfprice">';
		$htmldata .= '<div class="col-12 col-md-12 col-lg-5 col-xl-5">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="totalfrom">$/CT</label>';
		$htmldata .= '<input type="text" id="fltfromprice" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" class="fromusd inputval" name="fltfromprice" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="totalfrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="flttoprice" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" class="fromusd inputval" name="flttoprice" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="col-12 col-md-12 col-lg-5 col-xl-5 set-padia">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="totalfrom">From (%)</label>';
		$htmldata .= '<input type="text" id="fltfromsavanipercentage" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" maxlength="3" class="fromusd inputval" name="fltfromsavanipercentage" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="totalfrom">To (%)</label>';
		$htmldata .= '<input type="text" id="flttosavanipercentage" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" maxlength="3" class="fromusd inputval" name="flttosavanipercentage" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '<div class="form-group flu-group dash-flu-group dash-shape">';
		$htmldata .= '<div class="name-filter">Media</div>';
		$htmldata .= '<div class="row-filter dash-row" id="mediaDivData">';
		$htmldata .= '<div class="filter-container">';
		$htmldata .= '<div class="col-3 col-md-3 col-sm-6 col-lg-3 col-xl-2 sizesetall">';
		$htmldata .= '<div class="filter custom-checkbox">';
		$htmldata .= '<input type="checkbox" id="Mediaphoto" name="fltmedia[]" data-name="With Photo" class="dashboard-control custom-control-input" value="1">';
		$htmldata .= '<label for="Mediaphoto" class="custom-control-label">';
		$htmldata .= 'With Photo';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-3 col-md-3 col-sm-6 col-lg-3 col-xl-2">';
		$htmldata .= '<div class="filter custom-checkbox">';
		$htmldata .= '<input type="checkbox" id="Mediavideo" name="fltmedia[]" data-name="With Video" class="dashboard-control custom-control-input" value="1">';
		$htmldata .= '<label for="Mediavideo" class="custom-control-label">';
		$htmldata .= 'With Video';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-3 col-md-3 col-sm-6 col-lg-3 col-xl-2">';
		$htmldata .= '<div class="filter custom-checkbox">';
		$htmldata .= '<input type="checkbox" id="MediaReport" name="fltmedia[]" data-name="With Lab Report" class="dashboard-control custom-control-input" value="1">';
		$htmldata .= '<label for="MediaReport" class="custom-control-label">';
		$htmldata .= 'With Lab Report';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="card collapse-card">';
		// $htmldata .= '<div class="card-header">';
		$htmldata .= '<a class="collapsed card-header card-link" data-toggle="collapse" href="#collapseThree">';
		$htmldata .= 'Measurements';
		$htmldata .= '</a>';
		// $htmldata .= '</div>';
		$htmldata .= '<div id="collapseThree" class="collapse">';
		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Percentage</div>';
		$htmldata .= '<div class="row-filter dash-row setrowwi">';
		$htmldata .= '<div class="setwid">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 col-md-6 col-sm-12 cut-group">';
		$htmldata .= '<label id="depthfrom"> Depth(%)</label>';
		$htmldata .= '<input type="text" id="fltfromdepthper" autocomplete="off" value="0" name="fltfromdepthper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">From %</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 col-sm-12 mt-auto cut-group">';
		$htmldata .= '<label id="depthfrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="flttodepthper" autocomplete="off" value="0" name="flttodepthper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">To %</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="setwid">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 col-md-6 col-sm-12 cut-group">';
		$htmldata .= '<label id="tablefrom">Table(%)</label>';
		$htmldata .= '<input type="text" id="fltfromtableper" autocomplete="off" value="0" name="fltfromtableper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">From %</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 col-sm-12 mt-auto cut-group">';
		$htmldata .= '<label id="tablefrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="flttotableper" autocomplete="off" value="0" name="flttotableper" class="fromusd inputper inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">To %</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		
		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Matric </div>';
		$htmldata .= '<div class="row-filter dash-row setrowwi">';
		$htmldata .= '<div class="setwid matricset">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-12 col-lg-6 col-sm-12 cut-group">';
		$htmldata .= '<label id="depthfrom">Length </label>';
		$htmldata .= '<input type="text" id="fltfromlength" autocomplete="off" value="0" name="fltfromlength" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-12 col-lg-6 col-sm-12 mt-auto cut-group">';
		$htmldata .= '<label id="depthfrom">&nbsp; </label>';
		$htmldata .= '<input type="text" id="flttolength" autocomplete="off" value="0" name="flttolength" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="setwid">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-12 col-lg-6 col-sm-12 cut-group">';
		$htmldata .= '<label id="tablefrom">Width</label>';
		$htmldata .= '<input type="text" id="fltfromwidth" autocomplete="off" value="0" name="fltfromwidth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-12 col-lg-6 col-sm-12 mt-auto cut-group">';
		$htmldata .= '<label id="tablefrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="flttowidth" autocomplete="off" value="0" name="flttowidth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="setwid">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-12 col-lg-6 col-sm-12 cut-group">';
		$htmldata .= '<label id="tablefrom">Depth</label>';
		$htmldata .= '<input type="text" id="fltfromdepth" autocomplete="off" value="0" name="fltfromdepth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-12 col-lg-6 col-sm-12 mt-auto cut-group">';
		$htmldata .= '<label id="tablefrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="flttodepth" autocomplete="off" value="0" name="flttodepth" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		$htmldata .= '</div>';
		
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Ratio </div>';
		$htmldata .= '<div class="row-filter dash-row setrowwi">';
		$htmldata .= '<div class="setwid matricset">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="depthfrom">&nbsp; </label>';
		$htmldata .= '<input type="text" id="fltfromratio" autocomplete="off" value="0" name="fltfromratio" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">From</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="depthfrom">&nbsp; </label>';
		$htmldata .= '<input type="text" id="flttoratio" autocomplete="off" value="0" name="flttoratio" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">To</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter"><p><a href="javascript:void(0)" class="clsadvancemeasuretag">Advance<br> Measurements</a></p></div>';
		$htmldata .= '</div>';
		
		// $htmldata .= '<div class="setwid matricset">';
		// 	$htmldata .= '<div class="row">';
		// 	$htmldata .= '<div class="name-filter">&nbsp;</div>';
		// 		$htmldata .= '<div class="col-2 col-md-2 col-sm-2 cut-group">';
		// 			$htmldata .= '<label id="depthfrom">Length </label>';
		// 			$htmldata .= '<input type="text" id="fltfromlength" autocomplete="off" value="0" name="fltfromlength" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		// 			$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		// 		$htmldata .= '</div>';
		// 		$htmldata .= '<div class="col-2 col-md-2 col-sm-2 mt-auto cut-group">';
		// 			$htmldata .= '<label id="depthfrom">&nbsp; </label>';
		// 			$htmldata .= '<input type="text" id="flttolength" autocomplete="off" value="0" name="flttolength" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		// 			$htmldata .= '<label class="inputset set-price-di" type="number">MM</label>';
		// 		$htmldata .= '</div>';	
		// 	$htmldata .= '</div>';	
		// $htmldata .= '</div>';	

		$htmldata .= '<div class="form-group size-group dash-size-group advancemeasurementDiv d-none">';
		$htmldata .= '<div class="name-filter">Crown</div>';
		$htmldata .= '<div class="row-filter dash-row setrowwi">';
		$htmldata .= '<div class="setwid matricset">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="depthfrom">Height % </label>';
		$htmldata .= '<input type="text" id="fltcrownfromheightper" autocomplete="off" value="0" maxlength="3" name="fltcrownfromheightper" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="depthfrom">&nbsp; </label>';
		$htmldata .= '<input type="text" id="fltcrowntoheightper" autocomplete="off" value="0" maxlength="3" name="fltcrowntoheightper" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="setwid">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="tablefrom">Angel</label>';
		$htmldata .= '<input type="text" id="fltcrownfromangel" autocomplete="off" value="0" name="fltcrownfromangel" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="tablefrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="fltcrowntoangel" autocomplete="off" value="0" name="fltcrowntoangel" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="form-group size-group dash-size-group advancemeasurementDiv d-none">';
		$htmldata .= '<div class="name-filter">Pavilion</div>';
		$htmldata .= '<div class="row-filter dash-row setrowwi">';
		$htmldata .= '<div class="setwid matricset">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="depthfrom">Depth % </label>';
		$htmldata .= '<input type="text" id="fltpavilionfromdepthper" autocomplete="off" maxlength="3" value="0" name="fltpavilionfromdepthper" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="depthfrom">&nbsp; </label>';
		$htmldata .= '<input type="text" id="fltpaviliontodepthper" autocomplete="off" maxlength="3" value="0" name="fltpaviliontodepthper" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="setwid">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="tablefrom">Angel</label>';
		$htmldata .= '<input type="text" id="fltpavilionfromangle" autocomplete="off" value="0" name="fltpavilionfromangle" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="tablefrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="fltpaviliontoangle" autocomplete="off" value="0" name="fltpaviliontoangle" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		
		$listgridle = new listgridle();
		$parms = array();
		$qry = "select id,name from tblgridlemaster WHERE isactive=1 ORDER BY displayorder";
		$listgridle = $DB->getmenual($qry, $parms, 'listgridle');
		if (sizeof($listgridle) > 0) {
			$htmldata .= '<div class="form-group dash-shape gridleDiv setfilterres advancemeasurementDiv d-none">';
			$htmldata .= '<div class="name-filter">Girdle</div>';
			$htmldata .= '<div class="row-filter dash-row" id="gridleDivData">';
			$htmldata .= '<div class="filter-container">';
			$g=1;
			foreach ($listgridle as $gridle) {
				
				$htmldata .= '<div class="filter custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="c' . $gridle->id . '" name="fltgridleid[]" data-name="' . $gridle->name . '" class="dashboard-control custom-control-input" value="' . $gridle->id . '">';
				$htmldata .= '<label for="c' . $gridle->id . '" class="custom-control-label">' . $gridle->name . '</label>';
				$htmldata .= '</div>';
				

				// if($g>8)
				// {
				// 	$htmldata .= '<button type="button" id="btngridledownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $g++;
			}
			$htmldata .= '<button type="button" id="btngridledownarrow" class="btn show-more-filters  btngridleshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		
		
		$listculetsize = new listculetsize();
		$parms = array();
		$qry = "select id,name from tblsizemaster WHERE isactive=1 ORDER BY displayorder";
		$listculetsize = $DB->getmenual($qry, $parms, 'listculetsize');
		if (sizeof($listculetsize) > 0) {
			$htmldata .= '<div class="form-group dash-shape culetsizeDiv setfilterres advancemeasurementDiv d-none">';
			$htmldata .= '<div class="name-filter">Culet Size</div>';
			$htmldata .= '<div class="row-filter dash-row" id="culetsizeDivData">';
			$c=1;
			$htmldata .= '<div class="filter-container">';
			foreach ($listculetsize as $culetsize) {
				
				$htmldata .= '<div class="filter custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="c' . $culetsize->id . '" name="fltculetsizeid[]" data-name="' . $culetsize->name . '" class="dashboard-control custom-control-input" value="' . $culetsize->id . '">';
				$htmldata .= '<label for="c' . $culetsize->id . '" class="custom-control-label with-img set-centeradvance">' . $culetsize->name . '</label>';
				$htmldata .= '</div>';
				

				// if($c>12)
				// {
				// 	$htmldata .= '<button type="button" id="btnculetsizedownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $c++;
			}
			$htmldata .= '<button type="button" id="btnculetsizedownarrow" class="btn show-more-filters  btnculetsizeshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 ">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		
		
		$listculetcondition = new listculetcondition();
		$parms = array();
		$qry = "select id,name from tblculetcondition WHERE isactive=1 ORDER BY displayorder";
		$listculetcondition = $DB->getmenual($qry, $parms, 'listculetcondition');
		if (sizeof($listculetcondition) > 0) {
			$htmldata .= '<div class="form-group dash-shape culetconditionDiv setfilterres advancemeasurementDiv d-none">';
			$htmldata .= '<div class="name-filter">Culet Condition</div>';
			$htmldata .= '<div class="row-filter dash-row" id="culetconditionDivData">';
			$htmldata .= '<div class="filter-container">';
			$l=0;
			foreach ($listculetcondition as $culetcondition) {
				
				$htmldata .= '<div class="filter custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="c' . $culetcondition->id . '" name="fltculetconditionid[]" data-name="' . $culetcondition->name . '" class="dashboard-control custom-control-input" value="' . $culetcondition->id . '">';
				$htmldata .= '<label for="c' . $culetcondition->id . '" class="custom-control-label with-img set-centeradvance">' . $culetcondition->name . '</label>';
				$htmldata .= '</div>';
				
				// if($l>8)
				// {
				// 	$htmldata .= '<button type="button" id="btnculetconddownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	// $htmldata .= '		<img src="'.$config->getimageurl().'images/homepage/down-arrow.svg" alt="" class="img-responsive">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}
			$htmldata .= '<button type="button" id="btnculetconditiondownarrow" class="btn show-more-filters  btnculetconditionshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 ">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		
		$htmldata .= '';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$listtreatment = new listtreatment();
		$parms = array();
		$qry = "select id,name from tbltreatmentmaster WHERE isactive=1 ORDER BY name";
		$listtreatment = $DB->getmenual($qry, $parms, 'listtreatment');
		if (sizeof($listtreatment) > 0) {
			$htmldata .= '<div class="card collapse-card treatmentDiv">';
			// $htmldata .= '<div class="card-header">';
				$htmldata .= '<a class="card-link card-header" data-toggle="collapse" href="#collapsefour">';
					$htmldata .= 'Treatment';
				$htmldata .= '</a>';
			// $htmldata .= '</div>';
				$htmldata .= '<div id="collapsefour" class="collapse">';
					$htmldata .= '<div class="form-group multiply-group-filter">';
						$htmldata .= '<div class="name-filter">Display Type</div>';
							$htmldata .= '<div class="row-filter dash-row" id="treatmentDivData">';

								$htmldata .= '<div class="col-12 col-md-12">';
									$htmldata .= '<div class="row">';

										$htmldata .= '<div class="col-md-3 ">';
											$htmldata .= '<div class="form-check">';
												$htmldata .= '<input class="form-check-input" type="radio" value="0" name="treatment" checked="checked" id="notreatment">';
												$htmldata .= '<label class="form-check-label ml-4" for="notreatment">';
												$htmldata .= 'No Treatment';
												$htmldata .= '</label>';
											$htmldata .= '</div>';
										$htmldata .= '</div>';
										$htmldata .= '<div class="col-md-3 ">';
											$htmldata .= '<div class="form-check">';
												$htmldata .= '<input class="form-check-input" type="radio" value="1" name="treatment" id="showtreated">';
												$htmldata .= '<label class="form-check-label ml-4" for="showtreated">';
												$htmldata .= 'Show only treated';
												$htmldata .= '</label>';
											$htmldata .= '</div>';
										$htmldata .= '</div>';

										$htmldata .= '<div class="col-md-6 ">';
											$htmldata .= '<div class="form-check">';
												$htmldata .= '<input class="form-check-input" type="radio" value="2" name="treatment" id="bothtreated">';
												$htmldata .= '<label class="form-check-label ml-4" for="bothtreated">';
												$htmldata .= 'Include treated diamonds in results';
												$htmldata .= '</label>';
											$htmldata .= '</div>';
										$htmldata .= '</div>';
										$htmldata .= '<div class="col-12 row" id="listtreatmentDiv">';
										/* foreach ($listtreatment as $treatment) {
											$htmldata .= '<div class="col-12 col-md-3 cut-group">';
											$htmldata .= '<div class="form-check">';
											$htmldata .= '<input class="form-check-input" type="checkbox" data-name="' . $treatment->name . '" name="flttreatment[]" value="' . $treatment->id . '" id="flttreatment' . $treatment->id . '">';
											$htmldata .= '<label class="form-check-label ml-4" for="flttreatment' . $treatment->id . '"> ' . $treatment->name . '</label>';
											$htmldata .= '</div>';
											$htmldata .= '</div>';
										} */
										$htmldata .= '</div>';

									$htmldata .= '</div>';
								$htmldata .= '</div>';
							$htmldata .= '</div>';
						$htmldata .= '</div>';
				$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$listkeytosymbol = new listkeytosymbol();
		$parms = array();
		$qry = "select id,name from tblkeytosymbolmaster WHERE isactive=1 ORDER BY name";
		$listkeytosymbol = $DB->getmenual($qry, $parms, 'listkeytosymbol');
		if (sizeof($listkeytosymbol) > 0) {
			$htmldata .= '<div class="card collapse-card keytosymbolDiv">';
			// $htmldata .= '<div class="card-header">';
			$htmldata .= '<a class="card-link card-header" data-toggle="collapse" href="#collapsefive">';
			$htmldata .= 'Key to Symbols';
			$htmldata .= '</a>';
			// $htmldata .= '</div>';
			$htmldata .= '<div id="collapsefive" class="collapse">';
			$htmldata .= '<div class="form-group multiply-group-filter">';
			$htmldata .= '<div class="name-filter">Display Type</div>';
			$htmldata .= '<div class="row-filter dash-row" id="keytosymbolDivData">';

			
			

			$htmldata .= '<div class="col-12 col-md-12">';
			$htmldata .= '<div class="row">';
			
			$htmldata .= '<div class="col-md-3 ">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="radio" value="1" name="hascontains" id="containkeysymbol">';
			$htmldata .= '<label class="form-check-label ml-4" for="containkeysymbol">';
			$htmldata .= 'Contains';
			$htmldata .= '</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '<div class="col-md-6 ">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="radio" value="0" name="hascontains" id="dtcontainkeysymbol">';
			$htmldata .= '<label class="form-check-label ml-4" for="dtcontainkeysymbol">';
			$htmldata .= 'Does not contain';
			$htmldata .= '</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			foreach ($listkeytosymbol as $keytosymbol) {
				$htmldata .= '<div class="col-12 col-md-3 cut-group">';
				$htmldata .= '<div class="form-check">';
				$htmldata .= '<input class="form-check-input" type="checkbox" data-name="' . $keytosymbol->name . '" name="fltkeytosymbols[]" value="' . $keytosymbol->id . '" id="fltkeytosymbols' . $keytosymbol->id . '">';
				$htmldata .= '<label class="form-check-label ml-4" for="fltkeytosymbols' . $keytosymbol->id . '"> ' . $keytosymbol->name . '</label>';
				$htmldata .= '</div>';
				$htmldata .= '</div>';
			}

			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}

		$htmldata .= '<div class="card collapse-card">';
		// $htmldata .= '<div class="card-header">';
		$htmldata .= '<a class="card-link card-header" data-toggle="collapse" href="#collapsesix">';
		$htmldata .= 'Advanced';
		$htmldata .= '</a>';
		// $htmldata .= '</div>';
		$htmldata .= '<div id="collapsesix" class="collapse">';
		$listbrand = new listbrand();
		$parms = array();
		$qry = "select id,title as name,ifnull(img,'') AS img from tblbrandmaster WHERE isactive=1 ORDER BY displayorder";
		$listbrand = $DB->getmenual($qry, $parms, 'listbrand');
		if (sizeof($listbrand) > 0) {
			$htmldata .= '<div class="form-group size-group dash-size-group">';
			$htmldata .= '<div class="name-filter">Brand</div>';
			$htmldata .= '<div class="row-filter dash-row" id="brandDivData">';

			$htmldata .= '<div class="col-12 col-md-12">';
			$htmldata .= '<div class="row">';
			foreach ($listbrand as $brand) {
				$htmldata .= '<div class="col-12 col-md-3 cut-group">';
				$htmldata .= '<div class="form-check">';
				$htmldata .= '<input class="form-check-input" type="checkbox" data-name="' . $brand->name . '" name="fltbrand[]" value="' . $brand->id . '" id="fltbrand' . $brand->id . '">';
				$htmldata .= '<label class="form-check-label ml-4" for="fltbrand' . $brand->id . '"> ' . $brand->name . '</label>';
				$htmldata .= '</div>';
				$htmldata .= '</div>';
			}

			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">More Option</div>';
		$htmldata .= '<div class="row-filter dash-row">';
		$htmldata .= '<!-- <div class="col-12 col-md-4 cut-group">';
		$htmldata .= '<label id="rrs">Savani Category Code</label>';
		$htmldata .= '<input type="text" id="from_usd" name="fusd" placeholder="Enter">';
		$htmldata .= '</div> -->';
		$htmldata .= '<div class="col-12 col-md-6 col-lg-4 col-md-4 cut-group">';
		$htmldata .= '<label id="rs">Lab Report Number</label>';
		$htmldata .= '<input type="text" id="fltlabreportnumber" class="fromusd" name="fltlabreportnumber" placeholder="Enter Lab Report Number">';
		$htmldata .= '</div>';
		$htmldata .= '<!--  <div class="col-12 col-md-4 cut-group">';
		$htmldata .= '<label id="ssnumber">Access Code</label>';
		$htmldata .= '<input type="text" id="from_usd" name="fusd" placeholder="Enter">';
		$htmldata .= '</div> -->';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="text-center p-5 setbtnsub">';
		$htmldata .= '<button type="submit" id="btnsearchdiamond" disabled class="btn send-btn dash-serchbtn">Search</button>';
		$htmldata .= '<input type="reset" value="Reset" id="btnresetsearch" class="btn reset-btn dash-reset-btn">';
		$htmldata .= '</div>';

		$response['data'] = $htmldata;
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listsidediamondsearchdata') {
		$htmldata = '';
		$listshape = new listshape();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,concat(:imgurl,ifnull(img,'')) AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			$htmldata .= '<li class="s_shapeDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Shape</h5>';
			$htmldata .= '';
			$htmldata .= '<select class="form-control select2" name="fltshapeid[]" id="s_fltshapeid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listshape as $shape) {
				$htmldata .= '<option value="' . $shape->id . '">' . $shape->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$htmldata .= '<li class="s_sizeDiv">';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Size</h5>';
		$htmldata .= '<!-- <input class="form-check-input" type="checkbox" value="" id="laserdrilled">';
		$htmldata .= '<label class="form-check-label ml-4" for="laserdrilled">';
		$htmldata .= 'specific';
		$htmldata .= '</label> -->';
		$htmldata .= '<div class="row fliterset">';
		$htmldata .= '<div class="col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromsize" placeholder="From">';
		$htmldata .= '</div>';
		$htmldata .= '<h5>-</h5>';
		$htmldata .= '<div class="col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttosize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttosize" placeholder="To">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<div class="col-12 col-md-12">';
		$htmldata .= '<div class="row" id="s_ssizeDivData">';


			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]"  data-name="0.30-0.39" value="0.30-0.39" id="s_fltsizechkid0" data-mainid="0">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid0">0.30-0.39</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="0.40-0.49" value="0.40-0.49" id="s_fltsizechkid1" data-mainid="1">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid1">0.40-0.49</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="0.50-0.59" value="0.50-0.59" id="s_fltsizechkid2" data-mainid="2">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">0.50-0.59</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="0.60-0.69" value="0.60-0.69" id="s_fltsizechkid3" data-mainid="3">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">0.60-0.69</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="0.70-0.79" value="0.70-0.79" id="s_fltsizechkid4" data-mainid="4">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">0.70-0.79</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="0.80-0.89" value="0.80-0.89" id="s_fltsizechkid5" data-mainid="5">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">0.80-0.89</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="0.90-0.99" value="0.90-0.99" id="s_fltsizechkid6" data-mainid="6">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">0.90-0.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="1.00-1.49" value="1.00-1.49" id="s_fltsizechkid7" data-mainid="7">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">1.00-1.49</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="1.50-1.99" value="1.50-1.99" id="s_fltsizechkid8" data-mainid="8">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">1.50-1.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="2.00-2.99" value="2.00-2.99" id="s_fltsizechkid9" data-mainid="9">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">2.00-2.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="3.00-3.99" value="3.00-3.99" id="s_fltsizechkid10" data-mainid="10">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">3.00-3.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="4.00-4.99" value="4.00-4.99" id="s_fltsizechkid11" data-mainid="11">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">4.00-4.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="5.00-5.99" value="5.00-5.99" id="s_fltsizechkid12" data-mainid="12">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">5.00-5.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
			$htmldata .= '<input class="form-check-input" type="checkbox" name="fltsizchk[]" data-name="10.00-10.99" value="10.00-10.99" id="s_fltsizechkid13" data-mainid="13">';
			$htmldata .= '<label class="form-check-label ml-5" for="s_fltsizechkid2">10.00-10.99</label>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';


		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		if (sizeof($listdiamondcolor) > 0) {
			$htmldata .= '<li class="s_colorDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Color</h5>';
			$htmldata .= '<select class="form-control select2" name="fltcolorid[]" id="s_fltcolorid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listdiamondcolor as $diamondcolor) {
				$htmldata .= '<option value="' . $diamondcolor->id . '">' . $diamondcolor->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {
			$htmldata .= '<li class="s_clarityDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Clarity</h5>';
			$htmldata .= '<select class="form-control select2" name="fltclarityid[]" id="s_fltclarityid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listclarity as $clarity) {
				$htmldata .= '<option value="' . $clarity->id . '">' . $clarity->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}

		/* =====================Start Fancy Color========================== */
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Fancy Color</h5>';
		$listintensity = new listintensity();
		$parms = array();
		$qry = "select id,name,displayorder from tblfancyintensitymaster WHERE isactive=1 ORDER BY displayorder";
		$listintensity = $DB->getmenual($qry, $parms, 'listintensity');
		if (sizeof($listintensity) > 0) {
			/* $htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name" class="eyeclenfil"><b>Intensity</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltintensity[]" id="s_fltintensity" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listintensity as $intensity) {
				$htmldata .= '<option value="' . $intensity->id . '" data-displayorder="'.$intensity->displayorder.'" >' . $intensity->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name" class="eyeclenfil"><b>From Intensity</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltfromintensity" id="s_fltfromintensity" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">Select From Intensity</option>';
			foreach ($listintensity as $intensity) {
				$htmldata .= '<option value="' . $intensity->id . '" data-displayorder="'.$intensity->displayorder.'" >' . $intensity->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name" class="eyeclenfil"><b>To Intensity</b></label>';
			$htmldata .= '<select class="form-control select2" name="flttointensity" id="s_flttointensity" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">Select To Intensity</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listovertone = new listovertone();
		$parms = array();
		$qry = "select id,name from tblovertonemaster WHERE isactive=1 ORDER BY name";
		$listovertone = $DB->getmenual($qry, $parms, 'listovertone');
		if (sizeof($listovertone) > 0) {
			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Overtone</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltovertone[]" id="s_fltovertone" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listovertone as $overtone) {
				$htmldata .= '<option value="' . $overtone->id . '">' . $overtone->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listcolor = new listcolor();
		$parms = array();
		$qry = "select id,name from tblcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listcolor = $DB->getmenual($qry, $parms, 'listcolor');
		if (sizeof($listcolor) > 0) {
			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Color</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltcolor[]" id="s_fltcolor" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcolor as $color) {
				$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		/* =====================End Fancy Color============================ */

		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Inclusion</h5>';
		$listeyeclean = new listeyeclean();
		$parms = array();
		$qry = "select id,name from tbleyecleanmaster WHERE isactive=1 ORDER BY name";
		$listeyeclean = $DB->getmenual($qry, $parms, 'listeyeclean');
		if (sizeof($listeyeclean) > 0) {
			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name" class="eyeclenfil"><b>Eye clean</b></label>';
			$htmldata .= '<select class="form-control select2" name="flteyecleanid[]" id="s_flteyecleanid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listeyeclean as $eyeclean) {
				$htmldata .= '<option value="' . $eyeclean->id . '">' . $eyeclean->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listmilky = new listmilky();
		$parms = array();
		$qry = "select id,name,displayorder from tblmilkymaster WHERE isactive=1 ORDER BY displayorder";
		$listmilky = $DB->getmenual($qry, $parms, 'listmilky');
		if (sizeof($listmilky) > 0) {
			/* $htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Milky</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltmilkyid[]" id="s_fltmilkyid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>From Milky</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltfrommilkyid" id="s_fltfrommilkyid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">Select From Milky</option>';
			foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>To Milky</b></label>';
			$htmldata .= '<select class="form-control select2" name="flttomilkyid" id="s_flttomilkyid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">Select To Milky</option>';
			/* foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			} */
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listblackinclusion = new listblackinclusion();
		$parms = array();
		$qry = "select id,name from tblblackinclusionmaster WHERE isactive=1 ORDER BY name";
		$listblackinclusion = $DB->getmenual($qry, $parms, 'listblackinclusion');
		if (sizeof($listblackinclusion) > 0) {
			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Black</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltblackinclusionid[]" id="s_fltblackinclusionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listblackinclusion as $blackinclusion) {
				$htmldata .= '<option value="' . $blackinclusion->id . '">' . $blackinclusion->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listwhiteinclusion = new listwhiteinclusion();
		$parms = array();
		$qry = "select id,name from tblwhiteinclusionmaster WHERE isactive=1 ORDER BY name";
		$listwhiteinclusion = $DB->getmenual($qry, $parms, 'listwhiteinclusion');
		if (sizeof($listwhiteinclusion) > 0) {
			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>White</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltwhiteinclusionid[]" id="s_fltwhiteinclusionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listwhiteinclusion as $whiteinclusion) {
				$htmldata .= '<option value="' . $whiteinclusion->id . '">' . $whiteinclusion->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listopeninclusion = new listopeninclusion();
		$parms = array();
		$qry = "select id,name from tblopeninclusionmaster WHERE isactive=1 ORDER BY name";
		$listopeninclusion = $DB->getmenual($qry, $parms, 'listopeninclusion');
		if (sizeof($listopeninclusion) > 0) {
			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Open</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltopeninclusionid[]" id="s_fltopeninclusionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listopeninclusion as $openinclusion) {
				$htmldata .= '<option value="' . $openinclusion->id . '">' . $openinclusion->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$listshade = new listshade();
		$parms = array();
		$qry = "select id,name from tblshademaster WHERE isactive=1 ORDER BY displayorder";
		$listshade = $DB->getmenual($qry, $parms, 'listshade');
		if (sizeof($listshade) > 0) {
			$htmldata .= '<li>';
			$htmldata .= '<h5 class="d-inline shadeset">Shade</h5>';
			$htmldata .= '<div class="row col-12 setcolrowsear">';
			// $htmldata .= '<!-- <div class="col-md-4 fliterradio">';
			// $htmldata .= '<div class="form-check">';
			// $htmldata .= '<input class="form-check-input" type="radio" value="1" name="hascontains" id="containshade">';
			// $htmldata .= '<label class="form-check-label ml-4" for="containshade">';
			// $htmldata .= 'Contains';
			// $htmldata .= '</label>';
			// $htmldata .= '</div>';
			// $htmldata .= '</div>';
			// $htmldata .= '<div class="col-md-6 fliterradio">';
			// $htmldata .= '<div class="form-check">';
			// $htmldata .= '<input class="form-check-input" type="radio" value="0" name="hascontains" id="dtcontainshade">';
			// $htmldata .= '<label class="form-check-label ml-4" for="dtcontainshade">';
			// $htmldata .= 'Does not contain';
			// $htmldata .= '</label>';
			// $htmldata .= '</div>';
			// $htmldata .= '</div> -->';
			$htmldata .= '<select class="form-control select2" name="fltshadeid[]" id="s_fltshadeid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listshade as $shade) {
				$htmldata .= '<option value="' . $shade->id . '">' . $shade->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '<div class="row cut-group secndsearch">';
			$htmldata .= '<input class="form-check-input s_nobgm" type="checkbox" value="1" id="s_nobgm">';
			$htmldata .= '<label class="form-check-label ml-4" for="s_nobgm">';
			$htmldata .= 'No BGM';
			$htmldata .= '</label>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$htmldata .= '<li>';

		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Finish</h5>';
		$htmldata .= '<!-- <h5> <span>3x&emsp;</span><span>Ex&emsp;</span><span>Vg+&emsp;</span><span>Vg-</span> </h5> -->';
		$listcut = new listcut();
		$parms = array();
		$qry = "select id,name,displayorder from tblcutmaster WHERE isactive=1 ORDER BY displayorder";
		$listcut = $DB->getmenual($qry, $parms, 'listcut');
		if (sizeof($listcut) > 0) {
			/* $htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Cut</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltcutid[]" id="s_fltcutid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcut as $cut) {
				$htmldata .= '<option value="' . $cut->id . '" data-displayorder="'.$cut->displayorder.'">' . $cut->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>From Cut</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltfromcutid" id="s_fltfromcutid"  tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">Select From Cut</option>';
			foreach ($listcut as $cut) {
				$htmldata .= '<option value="' . $cut->id . '" data-displayorder="'.$cut->displayorder.'">' . $cut->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '';
			$htmldata .= '</div>';

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>To Cut</b></label>';
			$htmldata .= '<select class="form-control select2" name="flttocutid" id="s_flttocutid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">Select To Cut</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '';
			$htmldata .= '</div>';
		}
		$listpolish = new listpolish();
		$parms = array();
		$qry = "select id,name,displayorder from tblpolishmaster WHERE isactive=1 ORDER BY displayorder";
		$listpolish = $DB->getmenual($qry, $parms, 'listpolish');
		if (sizeof($listpolish) > 0) {
			/* $htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Polish</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltpolishid[]" id="s_fltpolishid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listpolish as $polish) {
				$htmldata .= '<option value="' . $polish->id . '" data-displayorder="'.$polish->displayorder.'">' . $polish->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>From Polish</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltfrompolishid" id="s_fltfrompolishid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">Select From Polish</option>';
			foreach ($listpolish as $polish) {
				$htmldata .= '<option value="' . $polish->id . '" data-displayorder="'.$polish->displayorder.'">' . $polish->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '';
			$htmldata .= '</div>';

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>To Polish</b></label>';
			$htmldata .= '<select class="form-control select2" name="flttopolishid" id="s_flttopolishid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">Select To Polish</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '';
			$htmldata .= '</div>';
		}
		$listsymmetry = new listsymmetry();
		$parms = array();
		$qry = "select id,name,displayorder from tblsymmetrymaster WHERE isactive=1 ORDER BY displayorder";
		$listsymmetry = $DB->getmenual($qry, $parms, 'listsymmetry');
		if (sizeof($listsymmetry) > 0) {
			/* $htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>Symmetry</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltsymmetryid[]" id="s_fltsymmetryid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listsymmetry as $symmetry) {
				$htmldata .= '<option value="' . $symmetry->id . '" data-displayorder="'.$symmetry->displayorder.'">' . $symmetry->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>'; */

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>From Symmetry</b></label>';
			$htmldata .= '<select class="form-control select2" name="fltfromsymmetryid" id="s_fltfromsymmetryid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">Select From Symmetry</option>';
			foreach ($listsymmetry as $symmetry) {
				$htmldata .= '<option value="' . $symmetry->id . '" data-displayorder="'.$symmetry->displayorder.'">' . $symmetry->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';

			$htmldata .= '<div class="row flis">';
			$htmldata .= '<label for="name"><b>To Symmetry</b></label>';
			$htmldata .= '<select class="form-control select2" name="flttosymmetryid" id="s_flttosymmetryid" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="" data-displayorder="0">Select To Symmetry</option>';
			
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<h5 class="d-inline">Fluorescence</h5>';
		$listintensity = new listintensity();
		$parms = array();
		$qry = "select id,name from tblintensitymaster WHERE isactive=1 ORDER BY displayorder";
		$listintensity = $DB->getmenual($qry, $parms, 'listintensity');
		if (sizeof($listintensity) > 0) {
			$htmldata .= '<div class="flis">';
			$htmldata .= '<h5 for="shapes">Intensity</h5>';
			$htmldata .= '<select class="form-control select2" name="fltintensityid[]" id="s_fltintensityid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listintensity as $intensity) {
				$htmldata .= '<option value="' . $intensity->id . '">' . $intensity->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listcolor = new listcolor();
		$parms = array();
		$qry = "select id,name from tblcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listcolor = $DB->getmenual($qry, $parms, 'listcolor');
		if (sizeof($listcolor) > 0) {
			$htmldata .= '<div class="flis">';
			$htmldata .= '<h5 for="shapes">Color</h5>';
			$htmldata .= '<select class="form-control select2" name="fltfluorescencecolorid[]" id="s_fltfluorescencecolorid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcolor as $color) {
				$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$listlab = new listlab();
		$parms = array();
		$qry = "select id,name from tbllabmaster WHERE isactive=1 ORDER BY displayorder";
		$listlab = $DB->getmenual($qry, $parms, 'listlab');
		if (sizeof($listlab) > 0) {
			$htmldata .= '<li>';
			$htmldata .= '<div class="col-12 cut-group secndsearch">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Grading Report</h5>';
			$htmldata .= '<div class="col-12 col-md-12">';
			$htmldata .= '<div class="row" id="s_labDivData">';
			$htmldata .= '';
			foreach ($listlab as $lab) {
				$htmldata .= '<div class="col-12 col-md-6 cut-group "><div class="form-check">';
				$htmldata .= '<input class="form-check-input" type="checkbox" name="fltlabid[]" data-name="' . $lab->name . '" value="' . $lab->id . '" id="s_fltlabid' . $lab->id . '">';
				$htmldata .= '<label class="form-check-label ml-4" for="s_fltlabid' . $lab->id . '">' . $lab->name . '</label>';
				$htmldata .= '</div>';
				$htmldata .= '</div>';
			}
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listcountry = new listcountry();
		$parms = array();
		$qry = "select id,country as name from tblcountrymaster";
		$listcountry = $DB->getmenual($qry, $parms, 'listcountry');
		if (sizeof($listcountry) > 0) {
			$htmldata .= '<li>';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Location</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltlocationid[]" id="s_fltlocationid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listcountry as $country) {
				$htmldata .= '<option value="' . $country->id . '">' . $country->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listroughdiamondsource = new listroughdiamondsource();
		$parms = array();
		$qry = "select id,name from tblroughdiamondsourcemaster WHERE isactive=1 ORDER BY name";
		$listroughdiamondsource = $DB->getmenual($qry, $parms, 'listroughdiamondsource');
		if (sizeof($listroughdiamondsource) > 0) {
			$htmldata .= '<li>';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Rough source</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltroughsourceid[]" id="s_fltroughsourceid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listroughdiamondsource as $roughdiamondsource) {
				$htmldata .= '<option value="' . $roughdiamondsource->id . '">' . $roughdiamondsource->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<div class="form-check">';
		$listcompanycode = new listcompanycode();
		$parms = array();
		$qry = "select id,savaniid as name from tblpersonmaster WHERE isactive=1 and isverified=1 and platform=4 and ifnull(savaniid,'')<>'' ORDER BY savaniid";
		$listcompanycode = $DB->getmenual($qry, $parms, 'listcompanycode');
		if (sizeof($listcompanycode) > 0) {
			$htmldata .= '<h5 class="d-inline">Sellers</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<h5 for="shapes">ID/ Company Code</h5>';
			$htmldata .= '<select class="form-control select2" name="fltcompanycode" id="s_fltcompanycode" tabindex="-1" aria-hidden="true">';

			$htmldata .= '<option value="">Select ID/ Company Code</option>';
			foreach ($listcompanycode as $listcompanycode) {
				$htmldata .= '<option value="' . $listcompanycode->name . '">' . $listcompanycode->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$liststocknumbers = new liststocknumbers();
		$parms = array();
		$qry = "select id,stocknumber as name from diamondlist WHERE isactive=1 and ifnull(stocknumber,'')<>'' ORDER BY stocknumber";
		$liststocknumbers = $DB->getmenual($qry, $parms, 'liststocknumbers');
		if (sizeof($liststocknumbers) > 0) {
			$htmldata .= '<div class="flis">';
			$htmldata .= '<h5 for="shapes">Stock Numbers</h5>';
			$htmldata .= '<select class="form-control select2" name="fltstocknumbers" id="s_fltstocknumbers" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">Select Stock Numbers</option>';
			foreach ($liststocknumbers as $liststocknumbers) {
				$htmldata .= '<option value="' . $liststocknumbers->name . '">' . $liststocknumbers->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$listlotnumbers = new listlotnumbers();
		$parms = array();
		$qry = "select id,savanilotnumber as name from diamondlist WHERE isactive=1 ORDER BY savanilotnumber";
		$listlotnumbers = $DB->getmenual($qry, $parms, 'listlotnumbers');
		if (sizeof($listlotnumbers) > 0) {
			$htmldata .= '<div class="flis">';
			$htmldata .= '<h5 for="shapes">Lot Numbers</h5>';
			$htmldata .= '<select class="form-control select2" name="fltsavanilotnumber" id="s_fltlotnumbers" tabindex="-1" aria-hidden="true">';
			$htmldata .= '<option value="">Select Lot Numbers</option>';
			foreach ($listlotnumbers as $listlotnumbers) {
				$htmldata .= '<option value="' . $listlotnumbers->name . '">' . $listlotnumbers->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
		}
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Price</h5>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<!-- <h5 class="totalfil">$total</h5> -->';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromprice" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">Usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttoprice" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoprice" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">Usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '</div>';

		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Savani %</h5>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromsavanipercentage" class="fromusd inputval" value="0" maxlength="3" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromsavanipercentage" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttosavanipercentage" class="fromusd inputval" value="0" maxlength="3" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttosavanipercentage" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '</li>';
		$htmldata .= '';
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setmedfli">';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<h5 class="d-inline">Media</h5>';
		$htmldata .= '<div class="col-12 col-md-12">';
		$htmldata .= '<div class="row" id="s_mediaDivData">';
		$htmldata .= '<div class="col-12 col-md-12 cut-group">';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<input class="form-check-input" type="checkbox" name="fltmedia[]" value="1" id="s_Mediaphoto">';
		$htmldata .= '<label class="form-check-label ml-4" for="s_Mediaphoto">';
		$htmldata .= 'With Photo';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-12 cut-group">';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<input class="form-check-input" type="checkbox" name="fltmedia[]" value="1" id="s_Mediavideo">';
		$htmldata .= '<label class="form-check-label ml-4" for="s_Mediavideo">';
		$htmldata .= 'With Video';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-12 cut-group">';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<input class="form-check-input" type="checkbox" name="fltmedia[]" value="1" id="s_MediaReport">';
		$htmldata .= '<label class="form-check-label ml-4" for="s_MediaReport">';
		$htmldata .= 'With Lab Report';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Percentage</h5>';
		$htmldata .= '<h5></h5>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Depth(%)</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromdepthper" class="fromusd inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromdepthper" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttodepthper" class="fromusd  inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttodepthper" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Table(%)</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromtableper" class="fromusd inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromtableper" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttotableper" class="fromusd inputval inputper" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttotableper" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Measurements</h5>';
		$htmldata .= '<h5></h5>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Length</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromlength" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromlength" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttolength" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttolength" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Width</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromwidth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromwidth" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttowidth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttowidth" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Depth</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromdepth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromdepth" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttodepth" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttodepth" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">MM</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Length</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromratio" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromratio" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">From</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttoratio" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoratio" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">To</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '</div>';
		$htmldata .= '</li>';


		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Crown</h5>';
		$htmldata .= '<h5></h5>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Height %</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltcrownfromheightper" class="fromusd inputval" maxlength="3" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltcrownfromheightper" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_fltcrowntoheightper" class="fromusd inputval" maxlength="3" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltcrowntoheightper" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Angel</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltcrownfromangel" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltcrownfromangel" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_fltcrowntoangel" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltcrowntoangel" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';

		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group setinsmag">';
		$htmldata .= '<h5 class="d-inline">Pavilion</h5>';
		$htmldata .= '<h5></h5>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Depth %</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltpavilionfromdepthper" class="fromusd inputval" maxlength="3" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltpavilionfromdepthper" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_fltpaviliontodepthper" class="fromusd inputval" maxlength="3" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltpaviliontodepthper" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row flis">';
		$htmldata .= '<label for="name"><b>Angel</b></label>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltpavilionfromangle" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltpavilionfromangle" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_fltpaviliontoangle" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltpaviliontoangle" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number"></label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';

		$listgridle = new listgridle();
		$parms = array();
		$qry = "select id,name from tblgridlemaster WHERE isactive=1 ORDER BY displayorder";
		$listgridle = $DB->getmenual($qry, $parms, 'listgridle');
		if (sizeof($listgridle) > 0) {
			$htmldata .= '<li class="s_gridleDiv">';
			$htmldata .= '<div class="col-12 cut-group">';

			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Girdle</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltgridleid[]" id="s_fltgridleid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listgridle as $gridle) {
				$htmldata .= '<option value="' . $gridle->id . '">' . $gridle->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}

		$listculetsize = new listculetsize();
		$parms = array();
		$qry = "select id,name from tblsizemaster WHERE isactive=1 ORDER BY displayorder";
		$listculetsize = $DB->getmenual($qry, $parms, 'listculetsize');
		if (sizeof($listculetsize) > 0) {
			$htmldata .= '<li class="s_culetsizeDiv">';
			$htmldata .= '<div class="col-12 cut-group">';

			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Culet Size</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltculetsizeid[]" id="s_fltculetsizeid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listculetsize as $row) {
				$htmldata .= '<option value="' . $row->id . '">' . $row->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}

		$listculetcondition = new listculetcondition();
		$parms = array();
		$qry = "select id,name from tblculetcondition WHERE isactive=1 ORDER BY displayorder";
		$listculetcondition = $DB->getmenual($qry, $parms, 'listculetcondition');
		if (sizeof($listculetcondition) > 0) {
			$htmldata .= '<li class="s_culetsizeDiv">';
			$htmldata .= '<div class="col-12 cut-group">';

			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Culet Condition</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltculetconditionid[]" id="s_fltculetconditionid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listculetcondition as $row) {
				$htmldata .= '<option value="' . $row->id . '">' . $row->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}


		$listtreatment = new listtreatment();
		$parms = array();
		$qry = "select id,name from tbltreatmentmaster WHERE isactive=1 ORDER BY name";
		$listtreatment = $DB->getmenual($qry, $parms, 'listtreatment');
		if (sizeof($listtreatment) > 0) {
			$htmldata .= '<li class="s_treatmentDiv">';
			$htmldata .= '<div class="col-12 cut-group">';

				// $htmldata .= '<div class="col-md-5 fliterradio">';
				// $htmldata .= '<div class="form-check">';
				// $htmldata .= '<input class="form-check-input" type="radio" value="1" name="treatment" id="s_notreatment">';
				// $htmldata .= '<label class="form-check-label ml-4" for="s_notreatment">';
				// $htmldata .= 'No Treatment';
				// $htmldata .= '</label>';
				// $htmldata .= '</div>';
				// $htmldata .= '</div>';
				// $htmldata .= '<div class="col-md-5 fliterradio">';
				// $htmldata .= '<div class="form-check">';
				// $htmldata .= '<input class="form-check-input" type="radio" value="0" name="treatment" id="s_showtreated">';
				// $htmldata .= '<label class="form-check-label ml-4" for="s_showtreated">';
				// $htmldata .= 'Show only treated';
				// $htmldata .= '</label>';
				// $htmldata .= '</div>';
				// $htmldata .= '</div>';
				// $htmldata .= '<div class="col-md-5 fliterradio">';
				// $htmldata .= '<div class="form-check">';
				// $htmldata .= '<input class="form-check-input" type="radio" value="0" name="treatment" id="s_bothtreated">';
				// $htmldata .= '<label class="form-check-label ml-4" for="s_bothtreated">';
				// $htmldata .= 'Include treated diamonds in results';
				// $htmldata .= '</label>';
				// $htmldata .= '</div>';
				// $htmldata .= '</div>';

			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Treatment</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="flttreatment[]" id="s_flttreatment" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listtreatment as $treatment) {
				$htmldata .= '<option value="' . $treatment->id . '">' . $treatment->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listkeytosymbol = new listkeytosymbol();
		$parms = array();
		$qry = "select id,name from tblkeytosymbolmaster WHERE isactive=1 ORDER BY name";
		$listkeytosymbol = $DB->getmenual($qry, $parms, 'listkeytosymbol');
		if (sizeof($listkeytosymbol) > 0) {
			$htmldata .= '<li class="s_keytosymbolDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Key to Symbols</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltkeytosymbols[]" id="s_fltkeytosymbols" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listkeytosymbol as $keytosymbol) {
				$htmldata .= '<option value="' . $keytosymbol->id . '">' . $keytosymbol->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listbrand = new listbrand();
		$parms = array();
		$qry = "select id,title as name,ifnull(img,'') AS img from tblbrandmaster WHERE isactive=1 ORDER BY displayorder";
		$listbrand = $DB->getmenual($qry, $parms, 'listbrand');
		if (sizeof($listbrand) > 0) {
			$htmldata .= '<li class="s_brandDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Brand</h5>';
			$htmldata .= '<div class="flis">';
			$htmldata .= '<select class="form-control select2" name="fltbrand[]" id="s_fltbrand" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listbrand as $brand) {
				$htmldata .= '<option value="' . $brand->id . '">' . $brand->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
			$htmldata .= '<li>';
		}
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<div class="form-check">';
		$htmldata .= '<h5 class="d-inline">Lab Report Number</h5>';
		$htmldata .= '<div class="flis">';
		$htmldata .= '<input type="text" id="s_fltlabreportnumber" class="fromusd" name="fltlabreportnumber" placeholder="Enter Lab Report Number">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';

		$response['data'] = $htmldata;
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listdiamondparcelsearchdata') {

		$htmldata = '';
		$listshape = new listshape();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,concat(:imgurl,ifnull(img,'')) AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			$htmldata .= '<div class="form-group shape-group dash-shape shapeparcelDiv">';
			$htmldata .= '<div class="name-filter">Shape';
			$htmldata .= '</div>';
			$htmldata .= '<div class="row-filter dash-row" id="shapeparcelDivData">';
			$htmldata .= '<div class="filter-container">';
			$htmldata .= '';
			$l=1;
			foreach ($listshape as $shape) {
				$htmldata .= '<div class="filter custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="fltshapeparcelid' . $shape->id . '" data-id="' . $shape->id . '" data-name="' . $shape->name . '" name="fltshapeparcelid[]" class="dashboard-control custom-control-input" value="' . $shape->id . '">';
				$htmldata .= '<label for="fltshapeparcelid' . $shape->id . '" class="custom-control-label with-img">';
				$htmldata .= '<span class="img-wrap"><img src="' . $shape->img . '" alt="' . $shape->name . '" class="img-responsive"> </span>';
				$htmldata .= '<span class="text-label">' . $shape->name . '</span>';
				$htmldata .= '</label>';
				$htmldata .= '</div>';

				// if($l>13)
				// {
				// 	$htmldata .= '<button type="button" id="btnparcelshapedownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}

			$htmldata .= '<button type="button" id="btnparcelshapedownarrow" class="btn show-more-filters  btnparcelshapshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}

		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Size</div>';
		$htmldata .= '<div class="row-filter dash-row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 sizesetall cut-group">';
		$htmldata .= '<label id="sizefrom">From</label>';
		$htmldata .= '<input type="number" id="fltfromparcelsize" class="fromusd inputval" value="0" min="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="fltfromparcelsize" placeholder="From">';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="sizeto">To</label>';
		$htmldata .= '<input type="number" id="flttoparcelsize" class="fromusd inputval" value="0" min="0" name="flttoparcelsize" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		if (sizeof($listdiamondcolor) > 0) {
			$htmldata .= '<div class="form-group color-group dash-shape colorparcelDiv">';
			$htmldata .= '<div class="name-filter">Color</div>';
			$htmldata .= '<div class="row-filter dash-row" id="colorparcelDivData">';
			$htmldata .= '<div class="filter-container">';
			$l=1;
			foreach ($listdiamondcolor as $diamondcolor) {
				$htmldata .= '<div class="filter dimond-claritywi custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="fltcolorparcelid' . $diamondcolor->id . '" data-id="' . $diamondcolor->id . '" data-name="' . $diamondcolor->name . '" name="fltcolorparcelid[]" class="dashboard-control custom-control-input" value="' . $diamondcolor->id . '">';
				$htmldata .= '<label for="fltcolorparcelid' . $diamondcolor->id . '" class="custom-control-label">' . $diamondcolor->name . '</label>';
				$htmldata .= '</div>';
				// if($l>13)
				// {
				// 	$htmldata .= '<button type="button" id="btnparcelcolordownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}

			$htmldata .= '<button type="button" id="btnparcelcolordownarrow" class="btn show-more-filters  btnparcelcolorshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {

			$htmldata .= '<div class="form-group clarity-group dash-shape clarityparcelDiv">';
			$htmldata .= '<div class="name-filter">Clarity</div>';
			$htmldata .= '<div class="row-filter dash-row" id="clarityparcelDivData">';
			$htmldata .= '<div class="filter-container">';
			$l=1;
			foreach ($listclarity as $clarity) {
				$htmldata .= '<div class="filter dimond-claritywi custom-checkbox">';
				$htmldata .= '<input type="checkbox" id="fltclarityparcelid' . $clarity->id . '" data-id="' . $clarity->id . '" data-name="' . $clarity->name . '" name="fltclarityparcelid[]" class="dashboard-control custom-control-input" value="' . $clarity->id . '">';
				$htmldata .= '<label for="fltclarityparcelid' . $clarity->id . '" class="custom-control-label">' . $clarity->name . '</label>';
				$htmldata .= '</div>';
				// if($l>13)
				// {
				// 	$htmldata .= '<button type="button" id="btnparcelclaritydownarrow" class="btn show-more-filters">';
				// 	$htmldata .= '	<span class="text">+ More</span>';
				// 	$htmldata .= '	<span class="text opened">- Less</span>';
				// 	$htmldata .= '	<span class="arrow-btn1">';
				// 	$htmldata .= '		+ More';
				// 	$htmldata .= '	</span>';
				// 	$htmldata .= '</button>';
				// }
				// $l++;
			}

			$htmldata .= '<button type="button" id="btnparcelclaritydownarrow" class="btn show-more-filters  btnparcelclarityshowmore d-none">';
			$htmldata .= '	<span class="text">+ More</span>';
			$htmldata .= '	<span class="text opened">- Less</span>';
			$htmldata .= '	<span class="arrow-btn1 shpesm">';
			$htmldata .= '		+ More';
			$htmldata .= '	</span>';
			$htmldata .= '</button>';

			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$htmldata .= '<div class="form-group multiply-group-filter">';
		$htmldata .= '<div class="name-filter">Piece Per Carat</div>';
		$htmldata .= '<div class="row-filter dash-row">';
		$htmldata .= '<div class="col-12 col-md-12">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 sizesetall  cut-group">';
		$htmldata .= '<label id="ppcfrom">From</label>';
		$htmldata .= '<input type="number" id="fltfrompiecepercarat" class="fromusd inputval" value="0" min="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="fltfrompiecepercarat" placeholder="From">';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="ppcto">To</label>';
		$htmldata .= '<input type="number" id="flttopiecepercarat" class="fromusd inputval" value="0" min="0" name="flttopiecepercarat" onpaste="numbonly(event);" onkeypress="numbonly(event);" placeholder="To">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="form-group size-group dash-size-group">';
		$htmldata .= '<div class="name-filter">Price</div>';
		$htmldata .= '<div class="row-filter dash-row">';

		$htmldata .= '<div class="col-12 col-md-6 col-lg-6 col-xl-4">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="totalfrom">$/CT</label>';
		$htmldata .= '<input type="text" id="fltfrompriceparcel" value="0" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="fltfrompriceparcel" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="totalfrom">&nbsp;</label>';
		$htmldata .= '<input type="text" id="flttopriceparcel" value="0" class="fromusd inputval" onpaste="numbonly(event);" onkeypress="numbonly(event);" name="flttopriceparcel" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 col-lg-5 col-xl-5">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 cut-group">';
		$htmldata .= '<label id="totalfrom">From (%)</label>';
		$htmldata .= '<input type="text" id="fltfromsavanipercentageparcel" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" maxlength="3" class="fromusd inputval" name="fltfromsavanipercentageparcel" placeholder="From">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-6 col-md-6 col-sm-6 mt-auto cut-group">';
		$htmldata .= '<label id="totalfrom">To (%)</label>';
		$htmldata .= '<input type="text" id="flttosavanipercentageparcel" value="0" onpaste="numbonly(event);" onkeypress="numbonly(event);" maxlength="3" class="fromusd inputval" name="flttosavanipercentageparcel" placeholder="To">';
		$htmldata .= '<label class="inputset set-price-di" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$listsieve = new listsieve();
		$parms = array();
		$qry = "select id,name from tblsievemaster WHERE isactive=1 ORDER BY name";
		$listsieve = $DB->getmenual($qry, $parms, 'listsieve');
		if (sizeof($listsieve) > 0) {
			$htmldata .= '<div class="form-group size-group dash-size-group sleeveDiv">';
			$htmldata .= '<div class="name-filter">Sieve`s</div>';
			$htmldata .= '<div class="row-filter dash-row" id="sleeveDivData">';
			$htmldata .= '<div class="col-12 col-md-12 cut-group">';
			$htmldata .= '<select class="form-control select2" name="fltsieveid[]" id="fltsieveid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listsieve as $sieve) {
				$htmldata .= '<option value="' . $sieve->id . '">' . $sieve->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
		}
		$htmldata .= '<div class="text-center p-5 setresup">';
		$htmldata .= '<button type="submit" class="btn send-btn dash-serchbtn" id="btnparceldiamondsearch" disabled="">Search</button>';
		$htmldata .= '<input type="reset" id="btnresetparcelsearch" value="Reset" class="btn reset-btn dash-reset-btn">';
		$htmldata .= '</div>';

		$response['data'] = $htmldata;
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listdiamondsideparcelsearchdata') {

		$htmldata = '';
		$listshape = new listshape();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,concat(:imgurl,ifnull(img,'')) AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			$htmldata .= '<li class="s_shapeDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Shape</h5>';
			$htmldata .= '';
			$htmldata .= '<select class="form-control select2" name="fltshapeparcelid[]" id="s_fltshapeparcelid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listshape as $shape) {
				$htmldata .= '<option value="' . $shape->id . '">' . $shape->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$htmldata .= '<li class="s_sizeDiv">';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Size</h5>';
		$htmldata .= '<div class="row fliterset">';
		$htmldata .= '<div class="col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromparcelsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromparcelsize" placeholder="From">';
		$htmldata .= '</div>';
		$htmldata .= '<h5>-</h5>';
		$htmldata .= '<div class="col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttoparcelsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttoparcelsize" placeholder="To">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		if (sizeof($listdiamondcolor) > 0) {
			$htmldata .= '<li class="s_colorDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Color</h5>';
			$htmldata .= '<select class="form-control select2" name="fltcolorparcelid[]" id="s_fltcolorparcelid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listdiamondcolor as $diamondcolor) {
				$htmldata .= '<option value="' . $diamondcolor->id . '">' . $diamondcolor->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {
			$htmldata .= '<li class="s_clarityDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Clarity</h5>';
			$htmldata .= '<select class="form-control select2" name="fltclarityparcelid[]" id="s_fltclarityparcelid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listclarity as $clarity) {
				$htmldata .= '<option value="' . $clarity->id . '">' . $clarity->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Price</h5>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<!-- <h5 class="totalfil">$total</h5> -->';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfrompriceparcel" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfrompriceparcel" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">Usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttopriceparcel" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttopriceparcel" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">Usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '</div>';

		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Savani %</h5>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<!-- <h5 class="totalfil">$total</h5> -->';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfromsavanipercentageparcel" class="fromusd inputval" value="0"  maxlength="3" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromsavanipercentageparcel" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttosavanipercentageparcel" class="fromusd inputval" value="0"  maxlength="3" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttosavanipercentageparcel" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">%</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '</div>';

		$htmldata .= '</li>';
		$htmldata .= '<li>';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Piece Per Carat</h5>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<!-- <h5 class="totalfil">$total</h5> -->';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_fltfrompiecepercarat" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfrompiecepercarat" placeholder="From">';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_flttopiecepercarat" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttopiecepercarat" placeholder="To">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$listsieve = new listsieve();
		$parms = array();
		$qry = "select id,name from tblsievemaster WHERE isactive=1 ORDER BY name";
		$listsieve = $DB->getmenual($qry, $parms, 'listsieve');
		if (sizeof($listsieve) > 0) {
			$htmldata .= '<li class="s_clarityDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Sieve`s</h5>';
			$htmldata .= '<select class="form-control select2" name="fltsieveid[]" id="s_fltsieveid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listsieve as $sieve) {
				$htmldata .= '<option value="' . $sieve->id . '">' . $sieve->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$response['data'] = $htmldata;
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listmydiamondsearchdata') {
		$htmldata = '';
		$listshape = new listshape();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,concat(:imgurl,ifnull(img,'')) AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			$htmldata .= '<li class="s_mdshapeDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<div class="form-check">';
			$htmldata .= '<h5 class="d-inline">Shape</h5>';
			$htmldata .= '<select class="form-control select2" name="fltshapeid[]" id="s_mdfltshapemdid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listshape as $shape) {
				$htmldata .= '<option value="' . $shape->id . '">' . $shape->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$htmldata .= '<li class="s_mdsizeDiv">';
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Size</h5>';
		$htmldata .= '<div class="row fliterset">';
		$htmldata .= '<div class="col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_mdfltfrommdsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="fltfromsize" placeholder="From">';
		$htmldata .= '</div>';
		$htmldata .= '<h5>-</h5>';
		$htmldata .= '<div class="col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_mdflttomdsize" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" class="fromusd inputval" name="flttosize" placeholder="To">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</li>';
		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		if (sizeof($listdiamondcolor) > 0) {
			$htmldata .= '<li class="s_mdcolorDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Color</h5>';
			$htmldata .= '<select class="form-control select2" name="fltcolorid[]" id="s_mdfltcolormdid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listdiamondcolor as $diamondcolor) {
				$htmldata .= '<option value="' . $diamondcolor->id . '">' . $diamondcolor->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
		}
		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {
			$htmldata .= '<li class="s_mdclarityDiv">';
			$htmldata .= '<div class="col-12 cut-group">';
			$htmldata .= '<h5 class="d-inline">Clarity</h5>';
			$htmldata .= '<select class="form-control select2" name="fltclarityid[]" id="s_mdfltclaritymdid" multiple="" tabindex="-1" aria-hidden="true">';
			foreach ($listclarity as $clarity) {
				$htmldata .= '<option value="' . $clarity->id . '">' . $clarity->name . '</option>';
			}
			$htmldata .= '</select>';
			$htmldata .= '</div>';
			$htmldata .= '</li>';
			$htmldata .= '<li>';
		}
		$htmldata .= '<div class="col-12 cut-group">';
		$htmldata .= '<h5 class="d-inline">Price</h5>';
		$htmldata .= '<div class="row setinputfli">';
		$htmldata .= '<!-- <h5 class="totalfil">$total</h5> -->';
		$htmldata .= '<div class="col-12 col-md-6 cut-group">';
		$htmldata .= '<input type="text" id="s_mdfltfrompricemd" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="fltfromprice" placeholder="From">';
		$htmldata .= '<label class="inputset" type="number">Usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 mt-auto cut-group">';
		$htmldata .= '<input type="text" id="s_mdflttopricemd" class="fromusd inputval" value="0" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="flttoprice" placeholder="To">';
		$htmldata .= '<label class="inputset" type="number">Usd</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '</div>';
		$htmldata .= '</li>';

		$response['data'] = $htmldata;
		$status = 1;
		$message = $errmsg['success'];
	} else if ($action == 'listuploaddiamondformdata') {
		$htmldata = '';
		$htmldata .= '<div class="tab-pane fade show active" id="generalinfoDiv" role="tabpanel" aria-labelledby="nav-generalinfo-tab">';
		$htmldata .= '<!-- one page start upload diamond -->';
		$htmldata .= '<div class="">';
		$htmldata .= '<div class="headingupload">';
		$htmldata .= '<h2>General Information</h2>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 col-md-4 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Stock#</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="stock" class="col-form-label">Stock <span class="text-danger">*</span></label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="stock" name="stock">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-8 uploadset settresd">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Price & Availability</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-4">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 col-lg-8 col-xl-8 col-sm-9 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="price" class="col-form-label">CT Price <span class="text-danger">*</span></label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter CT Price" id="price" name="price">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="col-md-4">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 col-lg-8 col-xl-8 col-sm-9 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="price" class="col-form-label">Savani % </label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" min="0" maxlength="3" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Savani %" id="savanipercentage" name="savanipercentage">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';

		$htmldata .= '<div class="col-md-4">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 col-lg-8 col-xl-8 col-sm-9 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="availabilityid" class="col-form-label">Availability</label>';
		$htmldata .= '<select id="availabilityid" name="availabilityid" class="form-control select2">';
		$availability = new listavailability();
		$parms = array();
		$qry = "select id,name from tblavailabilitymaster where isactive=1";
		$availability = $DB->getmenual($qry, $parms, 'listavailability');
		if (sizeof($availability) > 0) {
			$htmldata .= '<option value="">Select Availability</option>';
			foreach ($availability as $row) {
				$htmldata .= '<option value="' . $row->id . '">' . $row->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-12 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Location</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="countryid" class="col-form-label">Country</label>';
		$htmldata .= '<select id="countryid" name="countryid" class="form-control select2">';
		$listcountry = new listcountry();
		$parms = array();
		$qry = "select id,country as name from tblcountrymaster";
		$listcountry = $DB->getmenual($qry, $parms, 'listcountry');
		if (sizeof($listcountry) > 0) {
			$htmldata .= '<option value="">Select Country</option>';
			foreach ($listcountry as $country) {
				$htmldata .= '<option value="' . $country->id . '">' . $country->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="stateid" class="col-form-label">State</label>';
		$htmldata .= '<select id="stateid" name="stateid" class="form-control select2">';
		$htmldata .= '';
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sharewithemail" class="col-form-label">City </label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter" id="city" name="city">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<br><br><br><br><br><br>';
		$htmldata .= '<div class="row text-center nextuplo">';
		$htmldata .= '<!--  data-next-tab="reportinfoDiv" btnnextdiamonduploadform  -->';
		$htmldata .= '<button type="button" id="btngeneralinfo" class="btn  uploadonenext">Next</button>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<!-- one page end upload diamond -->';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '<div class="tab-pane fade show" id="reportinfoDiv" role="tabpanel" aria-labelledby="nav-reportinfo-tab">';
		$htmldata .= '<!-- two page start upload diamond -->';
		$htmldata .= '<div class="">';
		$htmldata .= '<div class="headingupload">';
		$htmldata .= '<h2>Report Information</h2>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Shape</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="shapeid" class="col-form-label">Shape <span class="text-danger">*</span></label>';
		$htmldata .= '<select id="shapeid" name="shapeid" class="form-control select2">';
		$listshape = new listshape();
		$parms = array(':imgurl' => $config->getImageurl());
		$qry = "select id,name,concat(:imgurl,ifnull(img,'')) AS img from tbldiamondshapemaster WHERE isactive=1 ORDER BY displayorder";
		$listshape = $DB->getmenual($qry, $parms, 'listshape');
		if (sizeof($listshape) > 0) {
			$htmldata .= '<option value="">Select Shape</option>';
			foreach ($listshape as $shape) {
				$htmldata .= '<option value="' . $shape->id . '">' . $shape->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset showae showne">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Size</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="size" class="col-form-label">Size <span class="text-danger">*</span></label>';
		$htmldata .= '<input type="text" class="form-control" onkeypress="numbonly(event);" onpaste="numbonly(event);" autocomplete="off" placeholder="Enter Size" id="size" name="size">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset repose pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Color</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="colorid" class="col-form-label">Color <span class="text-danger">*</span></label>';
		$htmldata .= '<select id="colorid" name="colorid" class="form-control select2">';
		$listdiamondcolor = new listdiamondcolor();
		$parms = array();
		$qry = "select id,name from tbldiamondcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listdiamondcolor = $DB->getmenual($qry, $parms, 'listdiamondcolor');
		if (sizeof($listdiamondcolor) > 0) {
			$htmldata .= '<option value="">Select Color</option>';
			foreach ($listdiamondcolor as $diamondcolor) {
				$htmldata .= '<option value="' . $diamondcolor->id . '">' . $diamondcolor->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Clarity</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sharewithemail" class="col-form-label">Clarity <span class="text-danger">*</span></label>';
		$htmldata .= '<select id="clarityid" name="clarityid" class="form-control select2">';
		$listclarity = new listclarity();
		$parms = array();
		$qry = "select id,name from tblclaritymaster WHERE isactive=1 ORDER BY displayorder";
		$listclarity = $DB->getmenual($qry, $parms, 'listclarity');
		if (sizeof($listclarity) > 0) {
			$htmldata .= '<option value="">Select Clarity</option>';
			foreach ($listclarity as $clarity) {
				$htmldata .= '<option value="' . $clarity->id . '">' . $clarity->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-6 uploadset setpadbto">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Shape</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="cutid" class="col-form-label">Cut</label>';
		$htmldata .= '<select id="cutid" name="cutid" class="form-control select2">';
		$listcut = new listcut();
		$parms = array();
		$qry = "select id,name,displayorder from tblcutmaster WHERE isactive=1 ORDER BY displayorder";
		$listcut = $DB->getmenual($qry, $parms, 'listcut');
		if (sizeof($listcut) > 0) {
			$htmldata .= '<option value="">Select Cut</option>';
			foreach ($listcut as $cut) {
				$htmldata .= '<option value="' . $cut->id . '" data-displayorder="'.$cut->displayorder.'">' . $cut->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="polishid" class="col-form-label">Polish</label>';
		$htmldata .= '<select id="polishid" name="polishid" class="form-control select2">';
		$listpolish = new listpolish();
		$parms = array();
		$qry = "select id,name,displayorder from tblpolishmaster WHERE isactive=1 ORDER BY displayorder";
		$listpolish = $DB->getmenual($qry, $parms, 'listpolish');
		if (sizeof($listpolish) > 0) {
			$htmldata .= '<option value="">Select Polish</option>';
			foreach ($listpolish as $polish) {
				$htmldata .= '<option value="' . $polish->id . '" data-displayorder="'.$polish->displayorder.'">' . $polish->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="symmetryid" class="col-form-label">Symmetry </label>';
		$htmldata .= '<select id="symmetryid" name="symmetryid" class="form-control select2">';
		$listsymmetry = new listsymmetry();
		$parms = array();
		$qry = "select id,name,displayorder from tblsymmetrymaster WHERE isactive=1 ORDER BY displayorder";
		$listsymmetry = $DB->getmenual($qry, $parms, 'listsymmetry');
		if (sizeof($listsymmetry) > 0) {
			$htmldata .= '<option value="">Select Symmetry</option>';
			foreach ($listsymmetry as $symmetry) {
				$htmldata .= '<option value="' . $symmetry->id . '" data-displayorder="'.$symmetry->displayorder.'">' . $symmetry->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Fluorescence</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="intensityid" class="col-form-label">Intensity</label>';
		$htmldata .= '<select id="intensityid" name="intensityid" class="form-control select2">';
		$listintensity = new listintensity();
		$parms = array();
		$qry = "select id,name from tblintensitymaster WHERE isactive=1 ORDER BY displayorder";
		$listintensity = $DB->getmenual($qry, $parms, 'listintensity');
		if (sizeof($listintensity) > 0) {
			$htmldata .= '<option value="">Select Intensity</option>';
			foreach ($listintensity as $intensity) {
				$htmldata .= '<option value="' . $intensity->id . '">' . $intensity->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="fluorescenecolorid" class="col-form-label">Color</label>';
		$htmldata .= '<select id="fluorescenecolorid" name="fluorescenecolorid" class="form-control select2">';
		$listcolor = new listcolor();
		$parms = array();
		$qry = "select id,name from tblcolormaster WHERE isactive=1 ORDER BY displayorder";
		$listcolor = $DB->getmenual($qry, $parms, 'listcolor');
		if (sizeof($listcolor) > 0) {
			$htmldata .= '<option value="">Select Color</option>';
			foreach ($listcolor as $color) {
				$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-6 uploadset setpadbto">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Measurement</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="length" class="col-form-label">Length</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Length" id="length" name="length">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="width" class="col-form-label">Width</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Width" id="width" name="width">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="depth" class="col-form-label">Depth </label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Depth" id="depth" name="depth">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 uploadset ">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6 setpadbto">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Depth(%)</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sharewithemail" class="col-form-label">Depth(%)</label>';
		$htmldata .= '<input type="text" class="form-control inputper" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Depth(%)" id="depthper" name="depthper">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Table(%)</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sharewithemail" class="col-form-label">Table(%)</label>';
		$htmldata .= '<input type="text" class="form-control inputper" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Table(%)" id="tableper" name="tableper">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-6 uploadset setpadbto">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Crown</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="crownangle" class="col-form-label">Angle</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Crown Angle" id="crownangle" name="crownangle">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="crownheight" class="col-form-label">Height</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);"  onpaste="numbonly(event);" placeholder="Enter Crown Height" id="crownheight" name="crownheight">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Pavilion</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="pavilionangle" class="col-form-label">Angle</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" maxlength="10" placeholder="Enter Pavilion Angle" id="pavilionangle" name="pavilionangle">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="pavilionheight" class="col-form-label">Height</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" maxlength="10" placeholder="Enter Pavilion Height" id="pavilionheight" name="pavilionheight">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-8 uploadset setpadbto">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Girdle</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="gridleconditionid" class="col-form-label">Condition</label>';
		$htmldata .= '<select id="gridleconditionid" name="gridleconditionid" class="form-control select2">';
		$listcondition = new listcondition();
		$parms = array();
		$qry = "select id,name from tblgirdleconditionmaster WHERE isactive=1 ORDER BY displayorder";
		$listcondition = $DB->getmenual($qry, $parms, 'listcondition');
		if (sizeof($listcondition) > 0) {
			$htmldata .= '<option value="">Select Condition</option>';
			foreach ($listcondition as $condition) {
				$htmldata .= '<option value="' . $condition->id . '">' . $condition->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="gridleminid" class="col-form-label">Min.</label>';
		$htmldata .= '<select id="gridleminid" name="gridleminid" class="form-control select2">';
		$listgirdle = new listgirdle();
		$parms = array();
		$qry = "select id,name from tblgridlemaster WHERE isactive=1 ORDER BY displayorder";
		$listgirdle = $DB->getmenual($qry, $parms, 'listgirdle');
		if (sizeof($listgirdle) > 0) {
			$htmldata .= '<option value="">Select Min.</option>';
			foreach ($listgirdle as $girdle) {
				$htmldata .= '<option value="' . $girdle->id . '">' . $girdle->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="gridlemaxid" class="col-form-label">Max. </label>';
		$htmldata .= '<select id="gridlemaxid" name="gridlemaxid" class="form-control select2">';
		if (sizeof($listgirdle) > 0) {
			$htmldata .= '<option value="">Select Max.</option>';
			foreach ($listgirdle as $girdle) {
				$htmldata .= '<option value="' . $girdle->id . '">' . $girdle->name . '</option>';
			}
		}
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="gridleper" class="col-form-label">Girdle(%)</label>';
		$htmldata .= '<input type="text" class="form-control inputper" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Girdle(%)" id="gridleper" name="gridleper">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-4 uploadset">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Culet</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="culetconditionid" class="col-form-label">Condition </label>';
		$htmldata .= '<select id="culetconditionid" name="culetconditionid" class="form-control select2">';
		$listcondition = new listcondition();
		$parms = array();
		$qry = "select id,name from tblculetcondition WHERE isactive=1 ORDER BY displayorder";
		$listcondition = $DB->getmenual($qry, $parms, 'listcondition');
		if (sizeof($listcondition) > 0) {
			$htmldata .= '<option value="">Select Condition</option>';
			foreach ($listcondition as $condition) {
				$htmldata .= '<option value="' . $condition->id . '">' . $condition->name . '</option>';
			}
		}
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="culetsizeid" class="col-form-label">Size </label>';
		$htmldata .= '<select id="culetsizeid" name="culetsizeid" class="form-control select2">';
		$listsize = new listsize();
		$parms = array();
		$qry = "select id,name from tblsizemaster WHERE isactive=1 ORDER BY displayorder";
		$listsize = $DB->getmenual($qry, $parms, 'listsize');
		if (sizeof($listsize) > 0) {
			$htmldata .= '<option value="">Select Size</option>';
			foreach ($listsize as $size) {
				$htmldata .= '<option value="' . $size->id . '">' . $size->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-6 col-md-12 uploadset showae setpeddind">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Treatment</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="treatmentid" class="col-form-label">Treatment</label>';
		$htmldata .= '<select id="treatmentid" name="treatmentid[]" multiple class="form-control select2">';
		$listtreatment = new listtreatment();
		$parms = array();
		$qry = "select id,name from tbltreatmentmaster WHERE isactive=1 ORDER BY name";
		$listtreatment = $DB->getmenual($qry, $parms, 'listtreatment');
		if (sizeof($listtreatment) > 0) {
			foreach ($listtreatment as $treatment) {
				$htmldata .= '<option value="' . $treatment->id . '">' . $treatment->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-6 col-md-12 uploadset repose pset ">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6 setpadbto">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Laser Inscription </h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sharewithemail" class="col-form-label">Laser Inscription</label>';
		$htmldata .= '<textarea class="form-control" autocomplete="off" placeholder="Enter Laser Inscription" id="laserinscription" name="laserinscription"></textarea>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Star length</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sharewithemail" class="col-form-label">Star Length</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" onkeypress="numbonly(event);" onpaste="numbonly(event);" placeholder="Enter Star Length" id="starlength" name="starlength">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-2 col-md-4 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Lab</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="labid" class="col-form-label">Lab</label>';
		$htmldata .= '<select id="labid" name="labid" class="form-control select2">';
		$listlab = new listlab();
		$parms = array();
		$qry = "select id,name from tbllabmaster WHERE isactive=1 ORDER BY name";
		$listlab = $DB->getmenual($qry, $parms, 'listlab');
		if (sizeof($listlab) > 0) {
			$htmldata .= '<option value="">Select Lab</option>';
			foreach ($listlab as $lab) {
				$htmldata .= '<option value="' . $lab->id . '">' . $lab->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-6 col-md-8 uploadset showae showne">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod stfancy setflex">';
		$htmldata .= '<h4>Report No.</h4>';
		$htmldata .= '<p>Show on Trade CVD </p>';
		$htmldata .= '<div class="text-right float-right setswitch setswondi">';
		$htmldata .= '<label class="switch">';
		$htmldata .= '<input type="checkbox" name="showonsavanigems" value="1" id="showonsavanigems" />';
		$htmldata .= '<span class="slider round"></span>';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<hr>';
		$htmldata .= '';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="reportnumber" class="col-form-label">Report No.</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter Report No." id="reportnumber" name="reportnumber">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-2 col-md-6 uploadset repose pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Report Date</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="reportdate" class="col-form-label">Report Date</label>';
		$htmldata .= '<input type="text" readonly="" class="form-control" value="'.$IISMethods->getcurrdate().'" placeholder="Enter Report Date" id="reportdate" name="reportdate">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-2 col-md-6 uploadset pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Lab Location</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="lablocation" class="col-form-label">Lab Location</label>';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter Lab Location" id="lablocation" name="lablocation">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-12 uploadset reset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Report Comment</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="reportcomment" class="col-form-label">Report Comment</label>';
		$htmldata .= '<textarea class="form-control" autocomplete="off" placeholder="Enter Report Comment" id="reportcomment" name="reportcomment"></textarea>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-12 uploadset reset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Key to Symbols</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="keytosymbolsid" class="col-form-label">Key To Symbols</label>';
		$htmldata .= '<select id="keytosymbolsid" name="keytosymbolsid[]" multiple class="form-control select2">';
		$listkeytosymbol = new listkeytosymbol();
		$parms = array();
		$qry = "select id,name from tblkeytosymbolmaster WHERE isactive=1 ORDER BY name";
		$listkeytosymbol = $DB->getmenual($qry, $parms, 'listkeytosymbol');
		if (sizeof($listkeytosymbol) > 0) {
			foreach ($listkeytosymbol as $keytosymbol) {
				$htmldata .= '<option value="' . $keytosymbol->id . '">' . $keytosymbol->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-12 uploadset reset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod stfancy reset">';
		$htmldata .= '<h4>Fancy Color</h4>';
		$htmldata .= '<label class="switch">';
		$htmldata .= '<input type="checkbox" name="withfancycolor" value="1" id="withfancycolor">';
		$htmldata .= '<span class="slider round"></span>';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '<hr>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="fancyintensityid" class="col-form-label">Intensity</label>';
		$htmldata .= '<select id="fancyintensityid" disabled name="fancyintensityid" class="form-control withfancycolorData disabled select2">';
		$parms = array();
		$qry = "select id,name,displayorder from tblfancyintensitymaster WHERE isactive=1 ORDER BY displayorder";
		$flistintensity = $DB->getmenual($qry, $parms, 'listintensity');
		if (sizeof($flistintensity) > 0) {
			$htmldata .= '<option value="">Select Intensity</option>';
			foreach ($flistintensity as $intensity) {
				$htmldata .= '<option value="' . $intensity->id . '" data-displayorder="'.$intensity->displayorder.'">' . $intensity->name . '</option>';
			}
		}
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="overtoneid" class="col-form-label">Overtone</label>';
		$htmldata .= '<select id="overtoneid" disabled name="overtoneid[]" multiple class="form-control withfancycolorData disabled select2">';
		$listovertone = new listovertone();
		$parms = array();
		$qry = "select id,name from tblovertonemaster WHERE isactive=1 ORDER BY name";
		$listovertone = $DB->getmenual($qry, $parms, 'listovertone');
		if (sizeof($listovertone) > 0) {
			foreach ($listovertone as $overtone) {
				$htmldata .= '<option value="' . $overtone->id . '">' . $overtone->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="fancycolorid1" class="col-form-label">Color 1</label>';
		$htmldata .= '<select id="fancycolorid1" disabled name="fancycolorid1" class="form-control withfancycolorData disabled select2">';
		if (sizeof($listcolor) > 0) {
			$htmldata .= '<option value="">Select Color</option>';
			foreach ($listcolor as $color) {
				$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-3 col-sm-6 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="fancycolorid2" class="col-form-label">Color 2</label>';
		$htmldata .= '<select id="fancycolorid2" disabled name="fancycolorid2" class="form-control withfancycolorData disabled select2">';
		if (sizeof($listcolor) > 0) {
			$htmldata .= '<option value="">Select Color</option>';
			foreach ($listcolor as $color) {
				$htmldata .= '<option value="' . $color->id . '">' . $color->name . '</option>';
			}
		}
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<br><br><br><br><br><br>';
		$htmldata .= '<div class="row text-center nextuplo">';
		$htmldata .= '<button type="button" id="btnreportinfo" class="btn upnext uploadtw">Next</button>';
		$htmldata .= '<button type="button" data-prev-tab="generalinfoDiv" class="btn npback btnprevdiamonduploadform uploadbacktw">Back</button>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<!-- two page end upload diamond -->';
		$htmldata .= '</div>';
		$htmldata .= '';
		$htmldata .= '<div class="tab-pane fade show" id="otherinfoDiv" role="tabpanel" aria-labelledby="nav-otherinfo-tab">';
		$htmldata .= '<!-- three page start upload diamond -->';
		$htmldata .= '<div class="">';
		$htmldata .= '<div class="headingupload">';
		$htmldata .= '<h2>Other Information</h2>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod stfancy">';
		$htmldata .= '<h4>Matched Pair</h4>';
		$htmldata .= '<label class="switch">';
		$htmldata .= '<input type="checkbox" name="matchedpair" value="1" id="matchedpair">';
		$htmldata .= '<span class="slider round"></span>';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '<hr>';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-8 col-sm-9 ctupsearch stfancy1">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<input type="text" class="form-control matchedpairData disabled" disabled autocomplete="off" placeholder="Enter Stock Number" id="stocknumber" name="stocknumber">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-3 checkrdioupload setcheckrdioupload stfancy1">';
		$htmldata .= '<p>Is Pair Separable</p>';
		$htmldata .= '<label class="switch">';
		$htmldata .= '<input type="checkbox" class="matchedpairData disabled" disabled name="ispairseparable" value="1" id="ispairseparable">';
		$htmldata .= '<span class="slider round"></span>';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset showae showne">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod stfancy">';
		$htmldata .= '<h4>Downlod</h4>';
		$htmldata .= '<label class="switch">';
		$htmldata .= '<input type="checkbox" name="isdownload" value="1" id="isdownload">';
		$htmldata .= '<span class="slider round"></span>';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '<hr>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<p class="textup">Allow approved member to download this diamond via savani link diamond link service or instant inventory.</p>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset repose pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Trade show</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="tradeshowid" name="tradeshowid" class="form-control select2">';
		$listtradeshow = new listtradeshow();
		$parms = array();
		$qry = "select id,name from tbltradeshowmaster WHERE isactive=1 ORDER BY name";
		$listtradeshow = $DB->getmenual($qry, $parms, 'listtradeshow');
		if (sizeof($listtradeshow) > 0) {
			$htmldata .= '<option value="">Select Trade show</option>';
			foreach ($listtradeshow as $tradeshow) {
				$htmldata .= '<option value="' . $tradeshow->id . '">' . $tradeshow->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Brand</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="brandid" name="brandid" class="form-control select2">';
		$listbrand = new listbrand();
		$parms = array();
		$qry = "select id,title as name,ifnull(img,'') AS img from tblbrandmaster WHERE isactive=1 ORDER BY displayorder";
		$listbrand = $DB->getmenual($qry, $parms, 'listbrand');
		if (sizeof($listbrand) > 0) {
			$htmldata .= '<option value="">Select Brand</option>';
			foreach ($listbrand as $brand) {
				$htmldata .= '<option value="' . $brand->id . '">' . $brand->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-8 uploadset setpadbto">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Supplier Comment</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="suppliercomment" class="col-form-label">Comment </label>';
		$htmldata .= '<textarea class="form-control" autocomplete="off" placeholder="Enter Comment" id="suppliercomment" name="suppliercomment"></textarea>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-4 uploadset">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod stfancy">';
		$htmldata .= '<h4>Parcel</h4>';
		$htmldata .= '<label class="switch">';
		$htmldata .= '<input type="checkbox" name="isparcel" value="1" id="isparcel">';
		$htmldata .= '<span class="slider round"></span>';
		$htmldata .= '</label>';
		$htmldata .= '</div>';
		$htmldata .= '<hr>';
		$htmldata .= '<div class="manisecupload ctupsearch">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="numofdiamond" class="col-form-label">Number of Diamond </label>';
		$htmldata .= '<input type="text" class="form-control disabled" disabled onkeypress="numbonly(event);" onpaste="numbonly(event);" autocomplete="off" placeholder="Enter Number of Diamond" id="numofdiamond" name="numofdiamond">';
		$htmldata .= '<h6>Specify Total Size in " Size " Filed</h6>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<br><br><br><br><br><br>';
		$htmldata .= '<div class="row text-center nextuplo">';
		$htmldata .= '<button type="button" data-next-tab="imgreportinfoDiv" class="btn upnext btnnextdiamonduploadform uploadthr">Next</button>';
		$htmldata .= '<button type="button" data-prev-tab="reportinfoDiv" class="btn btnprevdiamonduploadform npback">Back</button>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<!-- three page end upload diamond -->';
		$htmldata .= '</div>';
		$htmldata .= '<div class="tab-pane fade show" id="imgreportinfoDiv" role="tabpanel" aria-labelledby="nav-imgreportinfo-tab">';
		$htmldata .= '<!-- four page start upload diamond -->';
		$htmldata .= '<div class="">';
		$htmldata .= '<div class="headingupload">';
		$htmldata .= '<h2>Image &amp; Report Scan</h2>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-6 col-md-12 uploadset showae">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Report File</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-6 col-sm-6 setpadbto">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group filepreview">';
		$htmldata .= '<input type="file" id="reportfile" class="uploadbtnset form-control" name="reportfile" />';
		$htmldata .= '<h5 class="orsetsearch">Or</h5>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-6 col-sm-6">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter File Link" id="reportfilelink" name="reportfilelink">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row mt-2">';
		$htmldata .= '<div class="col-md-12 col-sm-12 mydiamondreportfileDiv">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-6 col-md-12 uploadset repose pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Diamond Media</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-4 col-sm-4 setpadbto">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group filepreview">';
		$htmldata .= '<input type="file" id="diamondimg" multiple="multiple" class="uploadbtnset form-control" accept="image/png, image/jpg, image/jpeg" name="diamondimg[]" />';
		$htmldata .= '<h5 class="orsetsearch">Or</h5>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter Image Link" id="diamondimglink" name="diamondimglink">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-md-4 col-sm-4">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter Video Link" id="videolink" name="videolink">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row mt-2 mydiamondmediafileDiv">';
		$htmldata .= '<!-- <div class="">';
		$htmldata .= '											';
		$htmldata .= '</div> -->';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-6 col-md-12 uploadset showae">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Sarine Loupe</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12 ctupsearch">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<label for="sarineloupe" class="col-form-label">Sarine Loupe</label>';
		$htmldata .= '<textarea class="form-control" autocomplete="off" placeholder="Enter Sarine Loupe" id="sarineloupe" name="sarineloupe"></textarea>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 uploadset">';
		$htmldata .= '';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<br><br><br><br><br><br>';
		$htmldata .= '<div class="row text-center nextuplo">';
		$htmldata .= '<button type="button" data-next-tab="additionalinfoDiv" class="btn upnext btnnextdiamonduploadform uploadfo">Next</button>';
		$htmldata .= '<button type="button" data-prev-tab="otherinfoDiv" class="btn btnprevdiamonduploadform npback">Back</button>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<!-- four page end upload diamond -->';
		$htmldata .= '</div>';
		$htmldata .= '<div class="tab-pane fade show" id="additionalinfoDiv" role="tabpanel" aria-labelledby="nav-additionalinfo-tab">';
		$htmldata .= '<!-- five page start upload diamond -->';
		$htmldata .= '<div class="">';
		$htmldata .= '<div class="headingupload">';
		$htmldata .= '<h2>Additional Information</h2>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-6 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Seller Spec.</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<textarea class="form-control" autocomplete="off" placeholder="Enter Seller Specification" id="sellerspecification" name="sellerspecification"></textarea>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-2 col-md-6 uploadset showae showne">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Shade</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="shadeid" name="shadeid" class="form-control select2">';
		$listshade = new listshade();
		$parms = array();
		$qry = "select id,name from tblshademaster WHERE isactive=1 ORDER BY displayorder";
		$listshade = $DB->getmenual($qry, $parms, 'listshade');
		if (sizeof($listshade) > 0) {
			$htmldata .= '<option value="">Select Shade</option>';
			foreach ($listshade as $shade) {
				$htmldata .= '<option value="' . $shade->id . '">' . $shade->name . '</option>';
			}
		}
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-2 col-md-4 uploadset repose pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Milky</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="milkyid" name="milkyid" class="form-control select2">';
		$listmilky = new listmilky();
		$parms = array();
		$qry = "select id,name,displayorder from tblmilkymaster WHERE isactive=1 ORDER BY displayorder";
		$listmilky = $DB->getmenual($qry, $parms, 'listmilky');
		if (sizeof($listmilky) > 0) {
			$htmldata .= '<option value="">Select Milky</option>';
			foreach ($listmilky as $milky) {
				$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-2 col-md-4 uploadset pset showne setseno">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Eye Clean</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="eyecleanid" name="eyecleanid" class="form-control select2">';
		$listeyeclean = new listeyeclean();
		$parms = array();
		$qry = "select id,name from tbleyecleanmaster WHERE isactive=1 ORDER BY name";
		$listeyeclean = $DB->getmenual($qry, $parms, 'listeyeclean');
		if (sizeof($listeyeclean) > 0) {
			$htmldata .= '<option value="">Select Eye Clean</option>';
			foreach ($listeyeclean as $eyeclean) {
				$htmldata .= '<option value="' . $eyeclean->id . '">' . $eyeclean->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-lg-3 col-md-4 uploadset pset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Open Inclusions</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="openinclusionsid" name="openinclusionsid[]" multiple class="form-control select2">';
		$listopeninclusion = new listopeninclusion();
		$parms = array();
		$qry = "select id,name from tblopeninclusionmaster WHERE isactive=1 ORDER BY name";
		$listopeninclusion = $DB->getmenual($qry, $parms, 'listopeninclusion');
		if (sizeof($listopeninclusion) > 0) {
			foreach ($listopeninclusion as $openinclusion) {
				$htmldata .= '<option value="' . $openinclusion->id . '">' . $openinclusion->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-6 uploadset setpadbto">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Black inclusions</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="blackinclusionsid" name="blackinclusionsid[]" multiple class="form-control select2">';
		$listblackinclusion = new listblackinclusion();
		$parms = array();
		$qry = "select id,name from tblblackinclusionmaster WHERE isactive=1 ORDER BY name";
		$listblackinclusion = $DB->getmenual($qry, $parms, 'listblackinclusion');
		if (sizeof($listblackinclusion) > 0) {
			foreach ($listblackinclusion as $blackinclusion) {
				$htmldata .= '<option value="' . $blackinclusion->id . '">' . $blackinclusion->name . '</option>';
			}
		}
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 uploadset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>White inclusions</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-md-12">';
		$htmldata .= '<div class="row">';
		$htmldata .= '<div class="col-12 ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="whiteinclusionsid" name="whiteinclusionsid[]" multiple class="form-control select2">';
		$listwhiteinclusion = new listwhiteinclusion();
		$parms = array();
		$qry = "select id,name from tblwhiteinclusionmaster WHERE isactive=1 ORDER BY name";
		$listwhiteinclusion = $DB->getmenual($qry, $parms, 'listwhiteinclusion');
		if (sizeof($listwhiteinclusion) > 0) {
			foreach ($listwhiteinclusion as $whiteinclusion) {
				$htmldata .= '<option value="' . $whiteinclusion->id . '">' . $whiteinclusion->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-12 uploadset reset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Rough Diamond Source</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="roughdiamondsourceid" name="roughdiamondsourceid" class="form-control select2">';
		$listroughdiamondsource = new listroughdiamondsource();
		$parms = array();
		$qry = "select id,name from tblroughdiamondsourcemaster WHERE isactive=1 ORDER BY name";
		$listroughdiamondsource = $DB->getmenual($qry, $parms, 'listroughdiamondsource');
		if (sizeof($listroughdiamondsource) > 0) {
			$htmldata .= '<option value="">Select Rough Diamond Source</option>';
			foreach ($listroughdiamondsource as $roughdiamondsource) {
				$htmldata .= '<option value="' . $roughdiamondsource->id . '">' . $roughdiamondsource->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="row upset">';
		$htmldata .= '<div class="col-12 col-md-6 uploadset reset">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Piece Per Carat</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<input type="text" class="form-control" autocomplete="off" placeholder="Enter Piece Per Carat" id="piecepercarat" name="piecepercarat">';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="col-12 col-md-6 uploadset reset settresd">';
		$htmldata .= '<div class="card">';
		$htmldata .= '<div class="card-body">';
		$htmldata .= '<div class="stockuplod">';
		$htmldata .= '<h4>Sieve`s</h4>';
		$htmldata .= '<hr>';
		$htmldata .= '</div>';
		$htmldata .= '<div class="manisecupload ctupsearch uploadmaset">';
		$htmldata .= '<div class="form-group">';
		$htmldata .= '<select id="sieveid" name="sieveid" class="form-control select2">';
		$listsieve = new listsieve();
		$parms = array();
		$qry = "select id,name from tblsievemaster WHERE isactive=1 ORDER BY name";
		$listsieve = $DB->getmenual($qry, $parms, 'listsieve');
		if (sizeof($listsieve) > 0) {
			$htmldata .= '<option value="">Select Sieve`s</option>';
			foreach ($listsieve as $sieve) {
				$htmldata .= '<option value="' . $sieve->id . '">' . $sieve->name . '</option>';
			}
		}	
		$htmldata .= '</select>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<br><br><br><br><br><br>';
		$htmldata .= '<div class="row text-center nextuplo">';
		$htmldata .= '<button type="submit" id="btnsavediamond" class="btn upnext">Save</button>';
		$htmldata .= '<button type="button" data-prev-tab="imgreportinfoDiv" class="btn btnprevdiamonduploadform npback">Back</button>&nbsp;&nbsp;';
		$htmldata .= '<button type="reset" data-next-tab="generalinfoDiv" id="btnresetdiamondupload" class="btn npback">Reset</button>';
		$htmldata .= '</div>';
		$htmldata .= '</div>';
		$htmldata .= '<!-- five page end upload diamond -->';
		$htmldata .= '</div>';

		$response['data'] = $htmldata;
		$status = 1;
		$message = $errmsg['success'];
	}
	else if ($action == 'listfancytointensity') //LIST Intensity
	{
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);

		$listfancyintensity = new listfancyintensity();
		$parms = array(':displayorder'=>$displayorder);
		$qry = "select id,name,displayorder from tblfancyintensitymaster where isactive=1 AND displayorder >= :displayorder ORDER BY displayorder";
		$listfancyintensity = $DB->getmenual($qry, $parms, 'listfancyintensity');
		if (sizeof($listfancyintensity) > 0) {
			if ($responsetype == 'HTML') {
				
				$htmldata .= '<option value="">To</option>';
				
				foreach ($listfancyintensity as $row) {
					$htmldata .= '<option value="' . $row->id . '" data-displayorder="'.$row->displayorder.'">' . $row->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listfancyintensity;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	}
	else if ($action == 'listtomilky') {
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);

		$listmilky = new listmilky();
		$parms = array(':displayorder'=>$displayorder);
		$qry = "select id,name,displayorder from tblmilkymaster WHERE isactive=1 AND displayorder >= :displayorder ORDER BY displayorder";
		$listmilky = $DB->getmenual($qry, $parms, 'listmilky');
		if (sizeof($listmilky) > 0) {
			if ($responsetype == 'HTML') {
				
				$htmldata .= '<option value="">To</option>';
				foreach ($listmilky as $milky) {
					$htmldata .= '<option value="' . $milky->id . '" data-displayorder="'.$milky->displayorder.'">' . $milky->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listmilky;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} 
	else if ($action == 'listtocut') {
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);

		$listcut = new listcut();
		$parms = array(':displayorder'=>$displayorder);
		$qry = "select id,name,displayorder from tblcutmaster WHERE isactive=1 AND displayorder >= :displayorder ORDER BY displayorder";
		$listcut = $DB->getmenual($qry, $parms, 'listcut');
		if (sizeof($listcut) > 0) {
			if ($responsetype == 'HTML') {
				
				$htmldata .= '<option value="">To</option>';
				foreach ($listcut as $row) {
					$htmldata .= '<option value="' . $row->id . '" data-displayorder="'.$row->displayorder.'">' . $row->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listcut;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} 
	else if ($action == 'listtopolish') {
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);

		$listpolish = new listpolish();
		$parms = array(':displayorder'=>$displayorder);
		$qry = "select id,name,displayorder from tblpolishmaster WHERE isactive=1 AND displayorder >= :displayorder ORDER BY displayorder";
		$listpolish = $DB->getmenual($qry, $parms, 'listpolish');
		if (sizeof($listpolish) > 0) {
			if ($responsetype == 'HTML') {
				
				$htmldata .= '<option value="">To</option>';
				foreach ($listpolish as $row) {
					$htmldata .= '<option value="' . $row->id . '" data-displayorder="'.$row->displayorder.'">' . $row->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listpolish;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} 
	else if ($action == 'listtosymmetry') {
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);

		$listsymmetry = new listsymmetry();
		$parms = array(':displayorder'=>$displayorder);
		$qry = "select id,name,displayorder from tblsymmetrymaster WHERE isactive=1 AND displayorder >= :displayorder ORDER BY displayorder";
		$listsymmetry = $DB->getmenual($qry, $parms, 'listsymmetry');
		if (sizeof($listsymmetry) > 0) {
			if ($responsetype == 'HTML') {
				
				$htmldata .= '<option value="">Select To Symmetry</option>';
				foreach ($listsymmetry as $row) {
					$htmldata .= '<option value="' . $row->id . '" data-displayorder="'.$row->displayorder.'">' . $row->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listsymmetry;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	} 
	else if ($action == 'listdiamondtreat') {
		$isall = $IISMethods->sanitize($_POST['isall']);

		$listtreatment = new listtreatment();
		$parms = array();
		$qry = "SELECT DISTINCT t.id,t.name 
			FROM tbltreatmentmaster t 
			INNER JOIN tbldiamondtreatment dt ON dt.`treatmentid`=t.id 
			WHERE t.isactive=1 
			ORDER BY t.name";
		$listtreatment = $DB->getmenual($qry, $parms, 'listtreatment');
		if (sizeof($listtreatment) > 0) {
			if ($responsetype == 'HTML') {
				if ($isall == 1) {
					$htmldata .= '<option value="%">All treatment</option>';
				} else {
					$htmldata .= '<option value="">Select treatment</option>';
				}
				foreach ($listtreatment as $treatment) {
					$htmldata .= '<option value="' . $treatment->id . '">' . $treatment->name . '</option>';
				}
				$response['data'] = $htmldata;
			} else if ($responsetype == 'JSON') {
				$response['data'] = $listtreatment;
			}
		}
		$status = 1;
		$message = $errmsg['success'];
	}
}


require_once dirname(__DIR__, 2) . '/config/apifoot.php';
