<?php 
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1).'/config/init.php';


?>
	<div class="layout-px-spacing">
		<!-- CONTENT AREA -->
		<div class="row layout-top-spacing">
			<div class="col-12 layout-spacing d-none">
				<div class="widget">
					<div class="widget-heading m-0">
						<div class="row">
							<div class="col">
								<h5 class="my-2">Coupon Master</h5>
							</div>
							<div class="col-auto ml-auto">
								<div class="input-group mb-0">
									<a href="javascript:void(0)" class="btn btn-primary m-0 ml-auto" id="openRightSidebar"><i class="bi bi-plus-lg"></i> Add New</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
										
					
										if(($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
										{
											?>
											<li class="delete-selected tbl-check d-none">
											<!-- <a href="javascript:void(0);" class="btn btn-primary m-0 " data-toggle="modal" data-target="#modalConfirmation"><i class="bi bi-trash"></i></a> -->
												<a href="javascript:void(0);" class="btn btn-primary m-0 btnmultitrash" data-toggle="modal" ><i class="bi bi-trash"></i></a>
											</li>
											<li>
												<div class="dropdown table-setting">
													<button class="dropdown-toggle btn btn-primary" type="button" id="tableSetting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Bulk Delete"><i class="bi bi-check2-circle"></i></button>
													<div class="dropdown-menu" aria-labelledby="tableSetting">
														<a class="dropdown-item select-bulk-delete" href="javascript:void(0);"><i class="bi bi-trash"></i> Bulk Delete</a>
													</div>
												</div>
											</li>
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
										<?php 
										if(($rightstotalcount>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
										{
											?>
											<li>
												<a href="javascript:void(0);" class="btn btn-primary m-0" id="openRightSidebar">Add New</a>
											</li>
											<?php
										}
										?>
										
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
													<th class="tbl-check d-none">
														<div class="text-center">
															<div class="custom-control custom-checkbox m-0 w-auto">
																<input type="checkbox" class="custom-control-input" id="tblCheckAll" name="tblCheckAll">
																<label class="custom-control-label mb-n1" for="tblCheckAll">All</label>
															</div>
														</div>
													</th>
													<th class="sorting " data-th="packagename">Package</th>
													<th class="sorting " data-th="typename">Type</th>
													<th class="sorting " data-th="couponcode">Coupon Code</th>
													<th class="sorting " data-th="discounttype">Discount Type</th>
													<th class="sorting " data-th="couponamt">Coupon Amount</th>
													<th class="">Date</th>
													<th class="tbl-name">Spend Coupon</th>
													<th class="tbl-name">Coupon Used</th>
													<th class="tbl-name">Status</th>
													<th class="tbl-name">Show On Web</th>
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
				<!-- rightSidebar Start -->
				<div class="col-12 p-4 md-sidebar" id="rightSidebar">
					<div class="right-sidebar-content">
						<div class="row">   
							<div class="col-12 mb-4 sidebar-header">
								<div class="row">
									<div class="col">
										<h5 class="my-2"><span class="formnamelbl"></span></h5>
									</div>
									<div class="col-auto pl-0">
										<a href="javascript:void(0)" class="btn btn-danger m-0 rounded-circle btn-close-right-sidebar" id="btnCloseRightSidebar" data-toggle="tooltip" data-placement="top" title="<?php echo $config->getCloseSidebar(); ?>" data-original-title="<?php echo $config->getCloseSidebar(); ?>"><i class="bi bi-x-lg"></i></a>
									</div>
								</div>
							</div>                                         
							<div class="col-lg-12 col-md-12 col-12">
								<div class="widget">
									<div class="widget-content">
										<form class="row validate-form" id="couponmasterForm" method="post" action="couponmaster" enctype="multipart/form-data">
											<input type="hidden" id="formevent" name="formevent" value='addright'>
											<input type="hidden" id="id" name="id" value=''>	
											
											<div class="col-12 ">
												<div class="input-group">
													<label class="mb-1">Package <span class="text-danger"></span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" data-live-search="true" id="packageid" name="packageid" data-size="10" data-dropup-auto="false" >
													
												</select>
												</div>
											</div>

											<div class="col-4">
												<div class="input-group">
													<label class="mb-1">Discount Type <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mt-2">
													<div class="radio radio-success radio-inline mr-5">
														<input type="radio" id="inr" value="1" name="discounttype" checked="">
														<label for="inr"> Rupees </label>
													</div>
													<div class="radio radio-success radio-inline">
														<input type="radio" id="percentage" value="2" name="discounttype">
														<label for="percentage"> Percentage </label>
													</div>
												</div>
											</div>
				
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Coupon Code <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Coupon Code " id="couponcode" name="couponcode" require>
												</div>
											</div>
											<div class="col-2">
												<div class="input-group">
													<label class="mb-1">&nbsp;</label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3 mb-lg-3">													
													<input type="button" id="btncode" name="btncode" onclick="gencode()" value="Generate" class="btn btn-primary">
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1"><span class="counponamttext">Coupon Amount</span> <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" maxlength="10" onkeypress="numbonly(event)" min="1" placeholder="Coupon Amount " id="couponamt" name="couponamt" require>
												</div>
											</div>
											<div class="col-6 d-none">
												<div class="input-group">
													<label class="mb-1">User Type <span class="text-danger"></span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" data-live-search="true" id="usertypeid" name="usertypeid[]" data-size="10" data-dropup-auto="false" multiple="multiple" title="All User Type">
													</select>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Start Date <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Start Date" id="startdate" name="startdate" readonly="readonly">
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Expiry Date <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Expiry Date" id="expirydate" name="expirydate" readonly="readonly">
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Minimum Spend <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" maxlength="10" onkeypress="numbonly(event)" placeholder="Minimum Spend " id="minimumspend" name="minimumspend" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Maximum Spend <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" maxlength="10" onkeypress="numbonly(event)" placeholder="Maximum Spend" id="maximumspend" name="maximumspend" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Usage Limit Per Coupon (Count) </label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" maxlength="7" onkeypress="numbonly(event)" placeholder="Usage Limit Per Coupon (Count)" id="limitpercoupon" name="limitpercoupon" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Usage Limit Per User (Count)</label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" maxlength="7" onkeypress="numbonly(event)" placeholder="Usage Limit Per User (Count)" id="limitperuser" name="limitperuser" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Status <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" data-live-search="true" id="statusid" name="statusid" data-size="10" data-dropup-auto="false">
														<option value="1">Enable</option>
														<option value="0">Disable</option>
													</select>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group mb-3 mb-lg-3">
                                                    <div class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" class="custom-control-input d-none" id="showonweb" name="showonweb" value="1">
                                                        <label class="custom-control-label mb-0" for="showonweb">Show On Web</label>
                                                    </div>
                                                </div>
											</div>
											<div class="col-auto ml-auto">
												<div class="input-group mb-0">
													<button type="submit" class="btn btn-primary m-0" id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
													<button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset" onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
												</div>
											</div>
										</from>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');

			var currpagename = getpagename();
            if(currpagename == 'ordermaster')
            {
                $('.pos-order').removeClass('d-none');
            }
            else
            {
                $('.pos-order').addClass('d-none');
            }
        });
		
		function resetdata()
        {
            $("#couponmasterForm").validate().resetForm();
            $('#couponmasterForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');  
			Edittimeformnamechange(2);   
			fillpackage(); 
        }

		$('#startdate').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
			format: 'DD/MM/YYYY',
			time: false,
			switchOnClick: true,
            okText: ""
        }).on('change', function(e, date)
        {
			$('#expirydate').bootstrapMaterialDatePicker('setMinDate',date);
			$('#expirydate').val($('#startdate').val());

			$('#tableDataList').attr('data-nextpage', 0);
			setTimeout(function(){ 
				//listdata();
			}, 200);
        });


		$('#expirydate').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
			format: 'DD/MM/YYYY',
			time: false,
			switchOnClick: true,
            okText: ""
        }).on('change', function(e, date)
        {
			$('#tableDataList').attr('data-nextpage', 0);
			setTimeout(function(){ 
				//listdata();
			}, 200);
        });

		
		$('input[type=radio][name=discounttype]').change(function() 
        {
			var type = $(this).val();

			if(type == 2)  //Percentage
			{
				$('.counponamttext').text('Coupon Percentage');
				$('#couponamt').attr("placeholder","Coupon Percentage");
			}
			else  //Amount
			{
				$('.counponamttext').text('Coupon Amount');
				$('#couponamt').attr("placeholder","Coupon Amount");
			}

            $('#couponamt').val('')
        });

		function fillpackage(packageid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillpackage");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillpackage,OnErrorSelectpicker);

			function Onsuccessfillpackage(content)
			{
				var JsonData = JSON.stringify(content);
				var resultdata = jQuery.parseJSON(JsonData);
				$('#packageid').html(resultdata.data);
				$('#packageid').val(packageid);
				$('#packageid').selectpicker('refresh');
			}
        }

		// Generate Code
		function gencode()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "grandom");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessgendode,OnErrorgendode); 
        }

        function Onsuccessgendode(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            $('#couponcode').val(resultdata.couponcode);
            $('#couponcode').removeClass("error") ;
            $('#couponcode').parent('div').removeClass('error');  
	        $('#couponcode').parent().find('label.error').html('');

        }  

        function OnErrorgendode(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            $('#code').val('');
        } 

		// change Status
		function changecouponstatus(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "changecouponstatus");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccesschangecouponstatus,OnErrorchangecouponstatus); 
        }

        function Onsuccesschangecouponstatus(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if(resultdata.status==0)
            {
                alertify(resultdata.message,0);
            }
            else if(resultdata.status==1)
            {
                alertify(resultdata.message,1);
            }
            $('#tableDataList').attr('data-nextpage',0); 
            listdata();
        }

        function OnErrorchangecouponstatus(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
		// change showonweb
		function changecouponshowonweb(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "changecouponshowonweb");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccesschangecouponshowonweb,OnErrorchangecouponshowonweb); 
        }

        function Onsuccesschangecouponshowonweb(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if(resultdata.status==0)
            {
                alertify(resultdata.message,0);
            }
            else if(resultdata.status==1)
            {
                alertify(resultdata.message,1);
            }
            $('#tableDataList').attr('data-nextpage',0); 
            listdata();
        }

        function OnErrorchangecouponshowonweb(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
		//View Details Start
        function viewcoupondata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "viewcoupondata");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessviewcoupondata,OnErrorviewcoupondata); 
        }

		function Onsuccessviewcoupondata(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#GeneralModal').modal('show');
			$('#GeneralModal .modal-dialog').addClass('modal-xl');
			$('#GeneralModal #GeneralModalLabel').html('Coupon Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        
        function OnErrorviewcoupondata(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
		//Edit Start
        function editdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "editcouponmaster");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessSubbrandedit,OnErrorSubbrandedit); 
        }

        function OnsuccessSubbrandedit(content)
        {
            var JsonData = JSON.stringify(content);
            var resulteditdata = jQuery.parseJSON(JsonData);

          
			$('#id').val(resulteditdata.id);
			if(resulteditdata.discounttype == 1)
			{
				$('#inr').prop('checked', true);
			}
			else
			{
				$('#percentage').prop('checked', true);
			}
			// $('#packageid').val(resulteditdata.packagename);
			fillpackage(resulteditdata.packageid+'_'+resulteditdata.type);
			
			$('#couponcode').val(resulteditdata.couponcode);
			$('#couponamt').val(resulteditdata.couponamt);
			
			$('#startdate').val(resulteditdata.startdate);
			$('#expirydate').val(resulteditdata.expirydate);
			$('#expirydate').bootstrapMaterialDatePicker('setMinDate', resulteditdata.startdate);
			$('#minimumspend').val(resulteditdata.minispend);
			$('#maximumspend').val(resulteditdata.maxspend);
			$('#limitperuser').val(resulteditdata.limitperuser);
			$('#limitpercoupon').val(resulteditdata.limitpercoupon);

			$('#statusid').val(resulteditdata.statusid);
			$('#statusid').selectpicker('refresh');

			if(resulteditdata.showonweb==1){
				$('#showonweb').prop('checked',true);
			}
			else{
				$('#showonweb').prop('checked',false);
			}

            $('#formevent').val('editright'); 
            $('#btnsubmit').text('<?php echo $config->getUpdateSidebar(); ?>');     

            //Open Side bar
			Edittimeformnamechange(1);
            $("#rightSidebar").toggleClass("active-right-sidebar"); 
            $('.overlay').addClass('show');
            $("body").addClass("overflow-hidden");
        }

        function OnErrorSubbrandedit(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
        //Edit End


		if($('#couponmasterForm').length){		
            $('#couponmasterForm').validate({
                rules:{
                    couponcode:{
                        required: true,
                    },
					// packageid:{
                    //     required: true,
                    // },
					couponamt:{
                        required: true,	
						number: true,
                    },
					
					startdate:{
						required: true,
					},
					expirydate:{
						required: true,
					},
					maximumspend:{
						required: true,
						number: true,
					},
					minimumspend:{
						required: true,
						number: true,
					},
					limitpercoupon:{
						number: true,
					},
					limitperuser:{
						number: true,
					},
                },messages:{
                    couponcode:{
                        required:"Coupon Code is required",
                    },
					// packageid:{
                    //     required:"Package is required",
                    // },
					couponamt:{
                        required: "Coupon Amount is required",
                    },
					
					startdate:{
						required: "Start Date is required",
					},
					expirydate:{
						required: "Expiry Date is required",
					},
					maximumspend:{
						required: "Maximum Spend is required",
					},
					minimumspend:{
						required: "Minimum Spend is required",
					},
                },
                submitHandler: function(form){

					var type = $("#packageid :selected").attr('data-type');
					var packageid='';
					var packagename='';
					if(type>0) 
					{
						 packageid = $("#packageid :selected").attr('data-id');
					
						 packagename = $("#packageid :selected").text();
					}
					
					 
					/* if(type=='' || type==null || type=='undefined'){
						packageid = '';
						type = '';
						packagename = '';
					}
					if(packageid=='undefined' || packageid=='' || packageid==null){
						packageid='';
					} */
                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertcouponmaster");
					formdata.append("mainpackageid", packageid);
					formdata.append("type", type);
					formdata.append("packagename", packagename);

                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessDataSubmit,OnErrorDataSubmit)

			    },
            });
        }

	</script>	