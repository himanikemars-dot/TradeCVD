<?php require_once dirname(__DIR__, 1) . '/config/init.php';


?>
<div class="layout-px-spacing">
	<!-- CONTENT AREA -->
	<div class="row layout-top-spacing">
		<div class="col-12 layout-spacing" id="layoutContent">
			<div class="widget widget-page">
				<div class="widget-control">
					<div class="row">
						<div class="col-auto mr-auto">
							<h5 class="m-0 menunamelbl" id="customernamelbl"></h5>
						</div>
						<div class="col-auto ml-auto">
							<ul class="list-inline">
								<li><a href="javascript:void(0);" class="btn-tbl content-minimize"><i class="bi bi-dash-lg"></i></a></li>
								<li><a href="javascript:void(0);" class="btn-tbl content-expand"><i class="bi bi-fullscreen"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-12 col-lg-6 mb-2 ml-auto text-right">
							<ul class="page-more-setting">
								<?php

								if ((($rightstotalcount) > 0 ? $Pagerights->getDelright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
								{
								?>

								<?php
								}
								?>
								<li class="tbl-search">
									<div class="input-group">
										<input type="text" name="filter" id="filter" class="form-control control-append" placeholder="Search...">
										<div class="input-group-append">
											<label class="input-group-text" for="selectBrandDate" id="btnfilter" name="btnfilter"><i class="fal fa-search"></i></label>
										</div>
									</div>
								</li>
								<li class="mb-2">
									<a href="javascript:void(0);" class="btn btn-primary m-0" id="openfilter">
										<i class="bi bi-funnel"></i>
									</a>
								</li>

							</ul>
						</div>
					</div>
				</div>
				<div class="widget-content">
					<div class="row min-height-100">
						<div class="col-12 min-height-100">
							<div class="table-responsive main-grid">
								<table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered table-hover table-striped datalisttable">
									<thead>
										<tr>
											<?php
											if ((($rightstotalcount) > 0 ? $Pagerights->getEditright() : 0) == 1 || (sizeof($Pagerights) > 0 ? $Pagerights->getDelright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
											{
											?>
												<!-- <th class="tbl-grid">
															<a href="javascript:void(0);" class="" id="gridMenu" data-toggle="griddropdown" data-target="#tblDropdownContent" aria-haspopup="true" aria-expanded="false"><i class="bi bi-ui-checks-grid"></i></a>
														</th> -->
											<?php
											}
											?>
											<!-- <th class="tbl-check d-none">
														<div class="text-center">
															<div class="custom-control custom-checkbox m-0 w-auto">
																<input type="checkbox" class="custom-control-input" id="tblCheckAll" name="tblCheckAll">
																<label class="custom-control-label mb-n1" for="tblCheckAll">All</label>
															</div>
														</div>
													</th> -->
											<th class="tbl-name sorting" data-th="transactionid">Transaction ID</th>
											<th class="tbl-name sorting" data-th="pname">User</th>
											<th class="tbl-name sorting" data-th="packagename">Package</th>
											<th class="tbl-name sorting" data-th="packagetype">Package Type</th>
											<th class="tbl-name sorting" data-th="packactivatedate">Active Date</th>
											<th class="tbl-name sorting" data-th="expirydate">Expiry Date</th>
											<th class="tbl-name sorting" data-th="totalamt">Amount</th>
											<th class="tbl-name sorting" data-th="entry_date">Entry Date</th>
										</tr>
									</thead>
									<tbody id="datalist">
									</tbody>
								</table>
								<!-- table End -->
							</div>
						</div>
					</div>
				</div>
				<?php require_once 'pagefooter.php'; ?>
			</div>
		</div>

	</div>
	<!-- filterSidebar Start -->
	<div class="col-12 p-0 filter-sidebar" id="filterSidebar">
		<div class="right-sidebar-content">
			<div class="row">
				<div class="col-12 mb-4 sidebar-header">
					<div class="row">
						<div class="col">
							<h5 class="my-2">Filters</h5>
						</div>
						<div class="col-auto pl-0">
							<a href="javascript:void(0)" class="btn btn-danger m-0 rounded-circle btn-close-right-sidebar" id="btnFilterCloseRightSidebar" data-toggle="tooltip" data-placement="top" title="<?php echo $closeSidebar; ?>" data-original-title="<?php echo $closeSidebar; ?>"><i class="bi bi-x-lg"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-12">
					<form class="form" action="" name="fltpackageassigndetailsFrm" id="fltpackageassigndetailsFrm">
						<input type="hidden" name="issidebarflt" id="issidebarflt" value="0" />

						<div class="row">

							<div class="col-6">
								<div class="input-group mb-0">
									<label class="mb-1">From Date</label>
								</div>
								<div class="input-group mb-3 mb-sm-3">
									<input type="text" class="form-control" placeholder="From Date" id="fltfromdate" name="fltfromdate" value="">
								</div>
							</div>


							<div class="col-6">
								<div class="input-group mb-0">
									<label class="mb-1">To Date</label>
								</div>
								<div class="input-group mb-3 mb-sm-3">
									<input type="text" class="form-control" placeholder="To Date" id="flttodate" name="flttodate" value="">
								</div>
							</div>

							<div class="col-12">
								<div class="input-group mb-0">
									<label class="mb-1">Package Type</label>
								</div>
								<div class="input-group mb-3 mb-sm-3">
									<select class="form-control selectpicker" data-live-search="true" data-size="10" data-dropup-auto="false" id="fltpackagetypeid" name="fltpackagetypeid">
										<option value="%">All</option>
										<option value="1">Annually</option>
										<option value="2">Monthly</option>
									</select>
								</div>
							</div>

							<div class="col-12">
								<div class="input-group mb-0">
									<label class="mb-1">Package</label>
								</div>
								<div class="input-group mb-3 mb-sm-3">
									<select class="form-control selectpicker" data-live-search="true" data-size="10" data-dropup-auto="false" id="fltpackageid" name="fltpackageid">
										<option value="%">All</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="input-group mb-0">
									<label class="mb-1">User</label>
								</div>
								<div class="input-group mb-3 mb-sm-3">
									<select class="form-control selectpicker" data-live-search="true" data-size="10" data-dropup-auto="false" id="fltpersonid" name="fltpersonid">
										<option value="%">All</option>
									</select>
								</div>
							</div>

						</div>

					</form>
				</div>
			</div>
		</div>

		<div class="right-sidebar-footer">
			<div class="row">
				<div class="col-auto">
					<div class="input-group mb-0">
						<button type="button" class="btn btn-primary m-0 mr-auto" id="btnfiltersave"><?php echo $config->getApplyFilterSidebar(); ?></button>
					</div>
				</div>
				<div class="col-auto ml-auto">
					<div class="input-group mb-0">
						<button type="button" href="#" class="btn btn-secondary m-0 ml-2" onclick="filterresetdata()" id="btnfilterreset"><?php echo $config->getResetSidebar(); ?></button>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- filterSidebar End -->


</div>



<script>
	$(document).ready(function() {
		$('.selectpicker').selectpicker('refresh');
		fillpackage();
		fillperson();
		
	});

	function viewpackageassigndetails(id) {
		var pagename = getpagename();
		var headersdata = {
			Accept: 'application/json',
			platform: 1,
			userpagename: pagename,
			useraction: 'editright',
			masterlisting: false
		};
		formdata = new FormData();
		formdata.append("action", "viewpackageassigndetails");
		formdata.append("id", id);
		ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessviewpackageassigndetails, OnErrorviewpackageassigndetails);
	}

	function Onsuccessviewpackageassigndetails(data) {
		var JsonData = JSON.stringify(data);
		var resultdata = jQuery.parseJSON(JsonData);
		$('#GeneralModal').modal('show');
		$('#GeneralModal .modal-dialog').addClass('modal-exl');
		$('#GeneralModal #GeneralModalLabel').html('Package Assign Details');
		$('#GeneralModal #Generaldata').html(resultdata.data);
	}

	function OnErrorviewpackageassigndetails(content) {
		ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
	}




	/* FILTERS START */
	$('#fltfromdate').bootstrapMaterialDatePicker({
		weekStart: 0,
		format: 'DD/MM/YYYY',
		time: false,
		switchOnClick: true,
		okText: ""
	}).on('change', function(e, date) {
		$('#flttodate').bootstrapMaterialDatePicker('setMinDate', date);
		$('#flttodate').val($('#fltfromdate').val());
	});


	$('#flttodate').bootstrapMaterialDatePicker({
		weekStart: 0,
		format: 'DD/MM/YYYY',
		time: false,
		switchOnClick: true,
		okText: ""
	});

	$('#flttodate').bootstrapMaterialDatePicker('setMinDate', $('#fltfromdate').val());

	//Filter
	function filterresetdata() {
		$("#fltpackageassigndetailsFrm").validate().resetForm();
		$('#fltpackageassigndetailsFrm').trigger("reset");
		$('#fltpackageassigndetailsFrm .selectpicker').selectpicker('refresh');
		fillperson('flt');
		$('#tableDataList').attr('data-nextpage', 0);
		listdata();
	}

	$('body').on('click', '#btnfiltersave', function() {
		$('#fltpackageassigndetailsFrm #issidebarflt').val(1);

		$("#filterSidebar").removeClass("active-right-sidebar");
		$('.overlay').removeClass('show');
		$("body").removeClass("overflow-hidden");

		$('#tableDataList').attr('data-nextpage', 0);
		setTimeout(function() {
			listdata();
		}, 120);
	});
	/* ******** End Fill Filter ********* */

	function fillpackage()
	{
		var pagename=getpagename();
		var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
		formdata = new FormData();
		formdata.append("action", "fillpackage");
		ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillpackage,OnErrorSelectpicker);
		function Onsuccessfillpackage(content)
		{
			var JsonData = JSON.stringify(content);
			var resultdata = jQuery.parseJSON(JsonData);
			var htmldata='';
			htmldata+='<option value="%">All</option>';
			htmldata+=resultdata.data;
			$('#fltpackageid').html(htmldata);
			$('#fltpackageid').selectpicker('refresh');
			
		}
	}


	function fillperson()
	{
		var pagename=getpagename();
		var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
		formdata = new FormData();
		formdata.append("action", "fillperson");
		ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillperson,OnErrorSelectpicker);
		function Onsuccessfillperson(content)
		{
			var JsonData = JSON.stringify(content);
			var resultdata = jQuery.parseJSON(JsonData);
			var htmldata='';
			htmldata+='<option value="%">All</option>';
			htmldata+=resultdata.data;
			$('#fltpersonid').html(htmldata);
			$('#fltpersonid').selectpicker('refresh');
			
		}
	}
</script>