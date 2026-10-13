<?php 
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
								<h5 class="my-2">Cut</h5>
							</div>
							<div class="col-auto ml-auto">
								<div class="input-group mb-0">
									<a href="#" class="btn btn-primary m-0 ml-auto" id="openRightSidebar"><i class="bi bi-plus-lg"></i> Add New</a>
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
													<th class="tbl-name sorting sorting_asc" data-th="name">Cut Name</th>
													<th class="tbl-name sorting sorting_asc" data-th="issubcut">Is Sub Cut</th>
													<th class="tbl-name sorting sorting_asc" data-th="maincut">Main Cut Name</th>
													<th class="tbl-name sorting sorting_asc" data-th="displayorder">Display Order</th>
													<th class="tbl-info text-center tbl-w100">Is Active</th>
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
				<div class="col-12 p-4 sm-sidebar" id="rightSidebar">
					<div class="right-sidebar-content">
						<div class="row">   
							<div class="col-12 mb-4 sidebar-header">
								<div class="row">
									<div class="col">
										<h5 class="my-2"><span class="formnamelbl"></span></h5>
									</div>
									<div class="col-auto pl-0">
										<a href="javascript:void(0);" class="btn btn-danger m-0 rounded-circle btn-close-right-sidebar" id="btnCloseRightSidebar" data-toggle="tooltip" data-placement="top" title="<?php echo $config->getCloseSidebar(); ?>" data-original-title="<?php echo $config->getCloseSidebar(); ?>"><i class="bi bi-x-lg"></i></a>
									</div>
								</div>
							</div>                                         
							<div class="col-lg-12 col-md-12 col-12">
								<div class="widget">
									<div class="widget-content">
										<form class="row validate-form" id="cutmasterForm" method="post" action="cutmaster" enctype="multipart/form-data">
											<input type="hidden" id="formevent" name="formevent" value='addright'>
											<input type="hidden" id="id" name="id" value=''>	
											<div class="col-12">
												<div class="input-group">
													<label class="mb-1">Cut Name<span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Enter Cut Name" id="name" name="name" require>
												</div>
											</div>
											<div class="col-12">
                                                <div class="input-group mb-3 mb-lg-3">
                                                    <div class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" class="custom-control-input " id="issubcut" name="issubcut" value="1" >
                                                        <label class="custom-control-label mb-0" for="issubcut">Is Sub Cut</label>
                                                    </div>
                                                </div>
                                            </div>

											<div class="col-12 maincutDiv">
												<div class="input-group">
													<label class="mb-1">Main Cut <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" data-live-search="true" id="maincutid" name="maincutid" data-size="10" data-dropup-auto="false" >
														<option value="">Select Main Cut</option>
													</select>
												</div>
											</div>
											<div class="col-12">
												<div class="input-group">
													<label class="mb-1">Display Order <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Enter Display Order" id="displayorder" name="displayorder"  onkeypress="intonly(event)" onpaste="intonly(event)">
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

		$('#issubcut').on('change',function(){
			$('.maincutDiv').addClass('d-none');
			$('#maincutid').val('');
			$('#maincutid').selectpicker('refresh');
			if($(this).prop('checked')==true)
			{
				$('.maincutDiv').removeClass('d-none');
			}
		})
		
		
		function resetdata()
        {
            $("#cutmasterForm").validate().resetForm();
            $('#cutmasterForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');  
			$('.maincutDiv').addClass('d-none');
			Edittimeformnamechange(2);
			fillmaincut();
        }

		function fillmaincut(maincutid)
        {
			var id=$('#id').val();
			var formevent=$('#formevent').val();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillmaincut");
            formdata.append("id", id);
            
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillmaincut,OnErrorSelectpicker); 
            function Onsuccessfillmaincut(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#maincutid').html(resultdata.data);
				
                $('#maincutid').selectpicker('refresh');
                if(maincutid){
                    $('#maincutid').val(maincutid);
                }
                $('#maincutid').selectpicker('refresh');
            }
        }


		//Edit Start
        function editdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};

            formdata = new FormData();
            formdata.append("action", "editcutmaster");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessSubbrandedit,OnErrorSubbrandedit); 
        }

        function OnsuccessSubbrandedit(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            $('#id').val(resultdata.id);
            $('#name').val(resultdata.name);
            $('#displayorder').val(resultdata.displayorder);
			if(resultdata.issubcut==1)
			{	
				$('.maincutDiv').removeClass('d-none');
				$('#issubcut').prop('checked',true);
				fillmaincut(resultdata.maincutid,resultdata.id);
			}else{
				$('#issubcut').prop('checked',false);
				fillmaincut();
				$('.maincutDiv').addClass('d-none');
				$('#maincutid').val('');
				$('#maincutid').selectpicker('refresh');
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


		if($('#cutmasterForm').length){		
            $('#cutmasterForm').validate({
                rules:{
                    name:{
                        required: true,
                    },
					displayorder:{
                        required: true,
                    },
					maincutid:{
                        required: true,
                    },
                },messages:{
                    name:{
                        required:"Cut Name is required",
                    },
					displayorder:{
                        required:"Display Order is required",
                    },
					maincutid:{
                        required: "Main Cut is required",
                    },
                },
                submitHandler: function(form){

					var maincut='';
					if($('#issubcut').prop('checked')==true)
					{
						maincut=$('#maincutid :selected').text();
					}
                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertcut");
                    formdata.append("maincut", maincut);

                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessDataSubmit,OnErrorDataSubmit)

			    },
            });
        }

		function isactive(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "isactive");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessIsactive,OnErrorIsactive); 
        }

        function OnsuccessIsactive(data)
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
        function OnErrorIsactive(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
	
	</script>	