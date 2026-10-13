<?php 
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();
require_once dirname(__DIR__, 1).'/config/init.php';

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
										
										<li class="tbl-search">
											<div class="input-group">
												<input type="text" name="filter" id="filter" class="form-control control-append" placeholder="Search...">
												<div class="input-group-append">
													<label class="input-group-text" for="selectBrandDate" id="btnfilter" name="btnfilter"><i class="fal fa-search"></i></label>
												</div>
											</div>
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
														if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
														{
															?>
															<th class="tbl-grid">
																<a href="javascript:void(0);" class="" id="gridMenu" data-toggle="griddropdown" data-target="#tblDropdownContent" aria-haspopup="true" aria-expanded="false"><i class="bi bi-ui-checks-grid"></i></a>
															</th>
															<?php
														}
													?>
													
													<th class="tbl-name sorting sorting_asc" data-th="pm.savaniid">Savani Id</th>
													<th class="tbl-name sorting" data-th="pm.personname">Full Name</th>
													<th class="tbl-name sorting" data-th="pm.email">Email Address</th>
													<th class="tbl-name sorting" data-th="pm.companyname">Company Name</th>
													<th class="tbl-name sorting" data-th="pm.businesstype">Type Of Business</th>
													<th class="tbl-name sorting" data-th="pm.businessphoneno">Business Phone</th>
													<th class="tbl-name sorting" data-th="pm.countryname">Country</th>
													<th class="tbl-name sorting" data-th="pm.statename">State</th>
													<th class="tbl-name sorting" data-th="pm.cityname">City</th>
													<th class="tbl-name sorting" data-th="pm.pincode">Zip Code</th>
													<th class="tbl-name sorting" data-th="pm.entry_date">Entry_Date</th>
													<th class="tbl-name sorting" data-th="expirydays">Package Remaining Day</th>
													<th class="tbl-name">View Active Package Details</th>
                                                    <th class="tbl-name">Is Active</th>
													<th class="tbl-name">Logout Device</th>
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
		</div>

	<script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');

        });

        //Change Is Active Start
        function changeisactivecustomermaster(id) {
            var pagename = getpagename();
            var headersdata = {
                Accept: 'application/json',
                platform: 1,
                userpagename: pagename,
                useraction: 'editright',
                masterlisting: false
            };
            formdata = new FormData();
            formdata.append("action", "changeisactivecustomermaster");
            formdata.append("id", id);
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccesschangeisactivecustomermaster, OnErrorchangeisactivecustomermaster);
        }

        function Onsuccesschangeisactivecustomermaster(data) {
            $('#preloader').hide();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if (resultdata.status == 0) {
                alertify(resultdata.message, 0);
            } else if (resultdata.status == 1) {
                alertify(resultdata.message, 1);
            }
            $('#tableDataList').attr('data-nextpage', 0);
            listdata();
        }

        function OnErrorchangeisactivecustomermaster(content) {
            ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
        }

		//View Details Start
        function viewcustomerdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "viewcustomerdata");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessviewcustomerdata,OnErrorviewcustomerdata); 
        }

		function Onsuccessviewcustomerdata(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#GeneralModal').modal('show');
			$('#GeneralModal .modal-dialog').addClass('modal-xl');
			$('#GeneralModal #GeneralModalLabel').html('Customer Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        
        function OnErrorviewcustomerdata(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }

		function viewactivepackageassigndetails(id) {
			var pagename = getpagename();
			var headersdata = {
				Accept: 'application/json',
				platform: 1,
				userpagename: pagename,
				useraction: 'editright',
				masterlisting: false
			};
			formdata = new FormData();
			formdata.append("action", "viewactivepackageassigndetails");
			formdata.append("id", id);
			ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessviewactivepackageassigndetails, OnErrorviewactivepackageassigndetails);
		}

		function Onsuccessviewactivepackageassigndetails(data) {
			var JsonData = JSON.stringify(data);
			var resultdata = jQuery.parseJSON(JsonData);
			$('#GeneralModal').modal('show');
			$('#GeneralModal .modal-dialog').addClass('modal-exl');
			$('#GeneralModal #GeneralModalLabel').html('Active Package Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
		}

		function OnErrorviewactivepackageassigndetails(content) {
			ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
		}

		function logoutfromalldevice(id) {
			swal({
				title: "",
				text: "Are you sure logout from all device ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#399BFF",
				confirmButtonText: "OK",
				closeOnConfirm: true
				},
				function()
				{
					var pagename = getpagename();
					var headersdata = {
						Accept: 'application/json',
						platform: 1,
						userpagename: pagename,
						useraction: 'editright',
						masterlisting: false
					};
					formdata = new FormData();
					formdata.append("action", "logoutfromalldevice");
					formdata.append("id", id);
					ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccesslogoutfromalldevice, OnErrorlogoutfromalldevice);
					function Onsuccesslogoutfromalldevice(data) {
						var JsonData = JSON.stringify(data);
						var resultdata = jQuery.parseJSON(JsonData);
						alertify(resultdata.message, 1);
					}

					function OnErrorlogoutfromalldevice(content) {
						ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
					}			
						
					
				});
			
		}

		

	</script>	