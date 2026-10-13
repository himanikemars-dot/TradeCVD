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
													<th class="tbl-name sorting" data-th="cm.packagename">Package  Name</th>
													<th class="tbl-name sorting" data-th="cm.monthlyprice">Monthly Price</th>
													<th class="tbl-name sorting" data-th="cm.annualyprice">Yearly Price</th>
													<th class="tbl-name sorting" data-th="cm.colorcode">Colorcode</th>
													<th class="tbl-name sorting" data-th="cm.displayorder">Display Order</th>
													<th class="tbl-info text-center tbl-w100">Is Active</th>
													<th class="tbl-info text-center tbl-w100">Is Popular</th>
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
				<div class="col-12 p-4 lg-sidebar" id="rightSidebar">
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
							<div class="col-12">
								<form class="row validate-form" id="packagemasterForm" method="post" action="packagemaster" enctype="multipart/form-data">                                       
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
										<div class="widget">
											<div class="widget-content row">
												
												<input type="hidden" id="formevent" name="formevent" value='addright'>
												<input type="hidden" id="id" name="id" value=''>

												<div class="col-3">
													<div class="input-group">
														<label class="mb-1">Package  Name<span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" id="packagename" autocomplete="off" name="packagename" class="form-control" placeholder="Enter Package Name" />
													</div>
												</div>
												<div class="col-3">
													<div class="input-group">
														<label class="mb-1">Monthly Price <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" id="monthlyprice" onkeypress="numbonly(event)" onpaste="numbonly(event)" autocomplete="off" name="monthlyprice" class="form-control" placeholder="Enter Monthly Price" />
													</div>
												</div>
												<div class="col-3">
													<div class="input-group">
														<label class="mb-1">Yearly Price <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" id="yearlyprice" onkeypress="numbonly(event)" onpaste="numbonly(event)" autocomplete="off" name="yearlyprice" class="form-control" placeholder="Enter Yearly Price" />
													</div>
												</div>
												<div class="col-3">
													<div class="input-group">
														<label class="mb-1">Display Order <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" id="displayorder" onkeypress="numbonly(event)" onpaste="numbonly(event)" autocomplete="off" name="displayorder" class="form-control" placeholder="Enter Display Order" />
													</div>
												</div>
                                            </div>
										</div>
									</div>	
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
										<div class="widget">
											<div class="widget-content row mt-3">
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Diamond Search</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yesdiamondsearch" value="1" name="candiamondsearch">
                                                            <label for="yesdiamondsearch">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nodiamondsearch" value="0" name="candiamondsearch" checked="">
                                                            <label for="nodiamondsearch">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Jewelry Search</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yesjewelrysearch" value="1" name="canjewelrysearch">
                                                            <label for="yesjewelrysearch">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nojewelrysearch" value="0" name="canjewelrysearch" checked="">
                                                            <label for="nojewelrysearch">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Share Diamonds and Jewelry</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yessharediamondjewelry" value="1" name="cansharediamondjewelry">
                                                            <label for="yessharediamondjewelry">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nosharediamondjewelry" value="0" name="cansharediamondjewelry" checked="">
                                                            <label for="nosharediamondjewelry">No</label>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Member to Member Chat</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yesmembertomemberchat" value="1" name="canmembertomemberchat">
                                                            <label for="yesmembertomemberchat">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nomembertomemberchat" value="0" name="canmembertomemberchat" checked="">
                                                            <label for="nomembertomemberchat">No</label>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
											<div class="widget-content row mt-3">
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Buy Requests</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yescanbuyrequests" value="1" name="canbuyrequests">
                                                            <label for="yescanbuyrequests">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nocanbuyrequests" value="0" name="canbuyrequests" checked="">
                                                            <label for="nocanbuyrequests">No</label>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">List Diamonds for Sale</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yescanlistdiamondforsale" value="1" name="canlistdiamondforsale">
                                                            <label for="yescanlistdiamondforsale">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nocanlistdiamondforsale" value="0" name="canlistdiamondforsale" checked="">
                                                            <label for="nocanlistdiamondforsale">No</label>
                                                        </div>
														&nbsp;&nbsp;
														<div class="custom-control custom-checkbox m-0 isnolimitlistdiamondforsaleDiv d-none">
															<input type="checkbox" class="custom-control-input d-none" id="isnolimitlistdiamondforsale" name="isnolimitlistdiamondforsale" value="1">
															<label class="custom-control-label mb-0" for="isnolimitlistdiamondforsale">No Limit</label>
														</div>
                                                    </div>
													
                                                </div>
												<div class="col-3 listdiamondforsalelimitvalueDiv d-none">
													<div class="input-group">
														<label class="mb-1">List Diamonds for Sale Value <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" id="listdiamondforsalelimitvalue" onkeypress="numbonly(event)" onpaste="numbonly(event)" autocomplete="off" name="listdiamondforsalelimitvalue" class="form-control" placeholder="Enter List Diamonds for Sale Value" />
													</div>
												</div>
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">List Jewelry for Sale</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yescanlistjewelryforsale" value="1" name="canlistjewelryforsale">
                                                            <label for="yescanlistjewelryforsale">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nocanlistjewelryforsale" value="0" name="canlistjewelryforsale" checked="">
                                                            <label for="nocanlistjewelryforsale">No</label>
                                                        </div>
                                                    </div>
                                                </div>
												
											</div>
											<div class="widget-content row mt-3">
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Trade CVD XL for Excel</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yescansavanigemsxlexcel" value="1" name="cansavanigemsxlexcel">
                                                            <label for="yescansavanigemsxlexcel">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nocansavanigemsxlexcel" value="0" name="cansavanigemsxlexcel" checked="">
                                                            <label for="nocansavanigemsxlexcel">No</label>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Additional Users Add-on</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yescanadditionaluseraddon" value="1" name="canadditionaluseraddon">
                                                            <label for="yescanadditionaluseraddon">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nocanadditionaluseraddon" value="0" name="canadditionaluseraddon" checked="">
                                                            <label for="nocanadditionaluseraddon">No</label>
                                                        </div>
														&nbsp;&nbsp;
														<div class="custom-control custom-checkbox m-0 isnolimitadditionaluseraddonDiv d-none">
															<input type="checkbox" class="custom-control-input d-none" id="isnolimitadditionaluseraddon" name="isnolimitadditionaluseraddon" value="1">
															<label class="custom-control-label mb-0" for="isnolimitadditionaluseraddon">No Limit</label>
														</div>
                                                    </div>
                                                </div>
												<div class="col-3 additionaluseraddonlimitvalueDiv d-none">
													<div class="input-group">
														<label class="mb-1">Additional Users Add-on Value <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" id="additionaluseraddonlimitvalue" onkeypress="numbonly(event)" onpaste="numbonly(event)" autocomplete="off" name="additionaluseraddonlimitvalue" class="form-control" placeholder="Enter Additional Users Add-on Value" />
													</div>
												</div>
												<div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Priority Customer Support</label>
                                                    </div>
                                                    <div class="input-group mt-2">
                                                        <div class="radio radio-success radio-inline mr-5">
                                                            <input type="radio" id="yescanprioritycustomersupport" value="1" name="canprioritycustomersupport">
                                                            <label for="yescanprioritycustomersupport">Yes</label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="nocanprioritycustomersupport" value="0" name="canprioritycustomersupport" checked="">
                                                            <label for="nocanprioritycustomersupport">No</label>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
											<div class="widget-content row mt-3">
												<div class="col-3">
													<div class="input-group">
														<label class="mb-1">Color Code <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<input type="text" class="form-control w-100 jscolor {hash:true}" name="colorcode" id="colorcode" value="#FFFFFF" placeholder="Enter Color"/>
													</div>
												</div>
											</div>	
										</div>
									</div>	
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
										<div class="widget">
											<div class="widget-content row">
												<div class="col-3">
													<div class="input-group">
														<label class="mb-1">Terms & Condition <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<select class="form-control selectpicker" data-live-search="true" id="termsconditionid" name="termsconditionid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select Terms & Condition</option>
                                                        </select>
													</div>
												</div>
												<div class="col-12">
													<div class="input-group mb-3">
														<textarea class="form-control" placeholder="Terms & Condition" id="termscondition" name="termscondition" rows=3></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
										<div class="widget">
											<div class="widget-content row">
												<div class="col-12">
													<div class="input-group">
														<label class="mb-1">Short Description <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<textarea class="form-control" placeholder="Short Description" id="shortdescr" name="shortdescr" rows=3></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
										<div class="widget">
											<div class="widget-content row">
												<div class="col-12">
													<div class="input-group">
														<label class="mb-1">Description <span class="text-danger">*</span></label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-3">
														<textarea class="form-control" placeholder="Short Description" id="descr" name="descr" rows=3></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>			
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
										<div class="widget">
											<div class="widget-content row">
												<div class="col-12">    
													<div class="ml-auto">
														<div class="input-group mb-0">
															<button type="submit" class="btn btn-primary m-0  ml-auto" id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
															<button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset" onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>	
								</from>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script src="<?php echo $config->getCdnurl(); ?>assets/js/jscolor.js"></script>													
	<script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');
			$('#packagemasterForm #descr').froalaEditor();
			$('#packagemasterForm #shortdescr').froalaEditor();
			$('#packagemasterForm #termscondition').froalaEditor();
			filltermsandconditions();
        });

		
		function resetdata()
        {
			$('#colorcode').css('background-color','#fffff');
            $("#packagemasterForm").validate().resetForm();
            $('#packagemasterForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');  
			Edittimeformnamechange(2); 
			filltermsandconditions();
			showhidelistdiamondforsale();
			showhidecanadditionaluseraddon();
			
        }

		$("input[name='canlistdiamondforsale']").click(function(){
            showhidelistdiamondforsale();
        });

		function showhidelistdiamondforsale()
		{
			$('.isnolimitlistdiamondforsaleDiv').addClass('d-none');
			$('.listdiamondforsalelimitvalueDiv').addClass('d-none');
			var val = $("input[name='canlistdiamondforsale']:checked").val();
			$('#listdiamondforsalelimitvalue').val(0);
			$('#isnolimitlistdiamondforsale').prop('checked',false);
			if(val==1)
			{
				$('.isnolimitlistdiamondforsaleDiv').removeClass('d-none');
				$('.listdiamondforsalelimitvalueDiv').removeClass('d-none');
			}
			
		}

		$('input[name="isnolimitlistdiamondforsale"]').click(function(){
            if($(this).prop("checked") == true){
                $('#listdiamondforsalelimitvalue').val(0);
				$('.listdiamondforsalelimitvalueDiv').addClass('d-none');
            }
            else if($(this).prop("checked") == false){
                $('.listdiamondforsalelimitvalueDiv').removeClass('d-none');
            }
        });



		$("input[name='canadditionaluseraddon']").click(function(){
            showhidecanadditionaluseraddon();
        });

		function showhidecanadditionaluseraddon()
		{
			$('.isnolimitadditionaluseraddonDiv').addClass('d-none');
			$('.additionaluseraddonlimitvalueDiv').addClass('d-none');
			var val = $("input[name='canadditionaluseraddon']:checked").val();
			$('#additionaluseraddonlimitvalue').val(0);
			$('#isnolimitadditionaluseraddon').prop('checked',false);
			if(val==1)
			{
				$('.isnolimitadditionaluseraddonDiv').removeClass('d-none');
				$('.additionaluseraddonlimitvalueDiv').removeClass('d-none');
			}
			
		}

		$('input[name="isnolimitadditionaluseraddon"]').click(function(){
            if($(this).prop("checked") == true){
                $('#additionaluseraddonlimitvalue').val(0);
				$('.additionaluseraddonlimitvalueDiv').addClass('d-none');
            }
            else if($(this).prop("checked") == false){
                $('.additionaluseraddonlimitvalueDiv').removeClass('d-none');
            }
        });



		
		function filltermsandconditions()
        {
			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "filltermsandconditions");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfilltermsandconditions,OnErrorSelectpicker); 
        }

        function Onsuccessfilltermsandconditions(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
			//alert(resultdata.data);
            $('#termsconditionid').html(resultdata.data);
            $('#termsconditionid').selectpicker('refresh');	
        }

		$('body').on('change','#termsconditionid',function(){
			filltermsdata();
		});

		function filltermsdata()
        {
			var termsconditionid=$('#termsconditionid').val();
			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "filltermsdata");
			formdata.append("id", termsconditionid);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfilltermsdata,OnErrorSelectpicker); 
        }

        function Onsuccessfilltermsdata(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
			$('#termscondition').froalaEditor('html.set',resultdata.data);  
        }


		


		
		

		//Edit Start
        function editdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "editpackagemaster");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessEditdata,OnErrorEditdata); 
        }

        function OnsuccessEditdata(content)
        {
            var JsonData = JSON.stringify(content);
            var resulteditdata = jQuery.parseJSON(JsonData);

			$('#id').val(resulteditdata.id);
			$('#packagename').val(resulteditdata.packagename);
			$('#monthlyprice').val(resulteditdata.monthlyprice);
			$('#yearlyprice').val(resulteditdata.annualyprice);
			$('#displayorder').val(resulteditdata.displayorder);

			if(resulteditdata.candiamondsearch==1)
			{
				$('#yesdiamondsearch').prop('checked',true);
			}
			else
			{
				$('#nodiamondsearch').prop('checked',true);
			}
			if(resulteditdata.canjewelrysearch==1)
			{
				$('#yesjewelrysearch').prop('checked',true);
			}
			else
			{
				$('#nojewelrysearch').prop('checked',true);
			}


			if(resulteditdata.cansharediamondjewelry==1)
			{
				$('#yessharediamondjewelry').prop('checked',true);
			}
			else
			{
				$('#nosharediamondjewelry').prop('checked',true);
			}

			if(resulteditdata.canmembertomemberchat==1)
			{
				$('#yesmembertomemberchat').prop('checked',true);
			}
			else
			{
				$('#nomembertomemberchat').prop('checked',true);
			}
			
			if(resulteditdata.canbuyrequests==1)
			{
				$('#yescanbuyrequests').prop('checked',true);
			}
			else
			{
				$('#nocanbuyrequests').prop('checked',true);
			}

			if(resulteditdata.canlistdiamondforsale==1)
			{
				$('#yescanlistdiamondforsale').prop('checked',true);
				$('#listdiamondforsalelimitvalue').val(resulteditdata.listdiamondforsalelimitvalue);
				
				$('.isnolimitlistdiamondforsaleDiv').removeClass('d-none');
				$('.listdiamondforsalelimitvalueDiv').removeClass('d-none');
				if(resulteditdata.isnolimitlistdiamondforsale==1)
				{
					$('#listdiamondforsalelimitvalue').val(0);
					$('#isnolimitlistdiamondforsale').prop('checked',true);
					$('.listdiamondforsalelimitvalueDiv').addClass('d-none');
				}
			}
			else
			{
				$('.listdiamondforsalelimitvalueDiv').addClass('d-none');
				$('.isnolimitlistdiamondforsaleDiv').addClass('d-none');
				$('#nocanlistdiamondforsale').prop('checked',true);
			}

			if(resulteditdata.canlistjewelryforsale==1)
			{
				$('#yescanlistjewelryforsale').prop('checked',true);
			}
			else
			{
				$('#nocanlistjewelryforsale').prop('checked',true);
			}

			if(resulteditdata.cansavanigemsxlexcel==1)
			{
				$('#yescansavanigemsxlexcel').prop('checked',true);
			}
			else
			{
				$('#nocansavanigemsxlexcel').prop('checked',true);
			}

			if(resulteditdata.canadditionaluseraddon==1)
			{
				$('#yescanadditionaluseraddon').prop('checked',true);

				$('#additionaluseraddonlimitvalue').val(resulteditdata.additionaluseraddonlimitvalue);
				$('.isnolimitadditionaluseraddonDiv').removeClass('d-none');
				$('.additionaluseraddonlimitvalueDiv').removeClass('d-none');
				if(resulteditdata.isnolimitadditionaluseraddon==1)
				{
					$('#additionaluseraddonlimitvalue').val(0);
					$('#isnolimitadditionaluseraddon').prop('checked',true);
					$('.additionaluseraddonlimitvalueDiv').addClass('d-none');
				}
			}
			else
			{
				$('.isnolimitadditionaluseraddonDiv').addClass('d-none');
				$('.additionaluseraddonlimitvalueDiv').addClass('d-none');
				$('#nocanadditionaluseraddon').prop('checked',true);
			}

			if(resulteditdata.canprioritycustomersupport==1)
			{
				$('#yescanprioritycustomersupport').prop('checked',true);
			}
			else
			{
				$('#nocanprioritycustomersupport').prop('checked',true);
			}
			$('#colorcode').css('background-color',resulteditdata.colorcode);
			$('#shortdescr').froalaEditor('html.set',resulteditdata.shortdescr);
            $('#descr').froalaEditor('html.set',resulteditdata.descr);

			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "filltermsandconditions");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfilltermsandconditions,OnErrorSelectpicker); 
     
			function Onsuccessfilltermsandconditions(content)
			{
				var JsonData = JSON.stringify(content);
				var resultdata = jQuery.parseJSON(JsonData);
				$('#termsconditionid').html(resultdata.data);
				$('#termsconditionid').val(resulteditdata.termsconditionid);
				$('#termscondition').froalaEditor('html.set',resulteditdata.termscondition);
				$('#termsconditionid').selectpicker('refresh');	
			}

            $('#formevent').val('editright'); 
            $('#btnsubmit').text('<?php echo $config->getUpdateSidebar(); ?>');     

            //Open Side bar
			Edittimeformnamechange(1);
            $("#rightSidebar").toggleClass("active-right-sidebar"); 
            $('.overlay').addClass('show');
            $("body").addClass("overflow-hidden");
        }

        function OnErrorEditdata(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
        //Edit End


		//View Details Start
        function viewpackagedata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "viewpackagedata");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessviewpackagedata,OnErrorviewpackagedata); 
        }

		function Onsuccessviewpackagedata(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#GeneralModal').modal('show');
			$('#GeneralModal .modal-dialog').addClass('modal-xl');
			$('#GeneralModal #GeneralModalLabel').html('Package Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        
        function OnErrorviewpackagedata(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }


		if($('#packagemasterForm').length){		
            $('#packagemasterForm').validate({
                rules:{
                    packagename:{
                        required: true,			
                    },
					monthlyprice:{
						required: true,
						number:true
					},
					yearlyprice:{
						required: true,
						number:true
					},
					displayorder:{
						required: true,
						number:true
					},
					listdiamondforsalelimitvalue:{
						required: true,
						number:true
					},
					additionaluseraddonlimitvalue:{
						required: true,
						number:true
					},
					colorcode:{
						required: true,
					},
					termsconditionid:{
						required: true,
					},

					
                },messages:{
					packagename:{
                        required:"Package Name is required",	
                    },
					monthlyprice:{
						required:"Monthly Price is required",	
					},
					yearlyprice:{
						required:"Yearly Price is required",	
					},
					displayorder:{
						required:"Display Order is required",	
					},
					listdiamondforsalelimitvalue:{
						required:"List Diamonds for Sale Value is required",	
					},
					additionaluseraddonlimitvalue:{
						required:"Additional Users Add-on Value is required",	
					},
					colorcode:{
						required:"Colorcode is required",	
					},
					termsconditionid:{
						required:"Terms & Condition is required",	
					},
                },
                submitHandler: function(form)
				{
					var descr=$('#descr').val();
					var shortdescr=$('#shortdescr').val();
					var termscondition=$('#termscondition').val();

					if(descr!='' || shortdescr!='' || termscondition!='')
					{
						$('#loaderprogress').show();
						var pagename=getpagename();
						var useraction=$('#formevent').val();
						formdata = new FormData(form);
						formdata.append("action", "insertpackagemaster");
						var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
						ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessDataSubmit,OnErrorDataSubmit)
					}
					else
					{
						
					}
						
			
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


		function ispopular(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "ispopular");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessispopular,OnErrorispopular); 
        }

        function Onsuccessispopular(data)
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
        function OnErrorispopular(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

	</script>	