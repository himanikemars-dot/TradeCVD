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
													<th class="tbl-name sorting sorting_asc" data-th="c.category">Category</th>
													<th class="tbl-name sorting" data-th="cm.name">Product Name</th>
													<th class="tbl-name sorting" data-th="cm.brandname">Brand Name</th>
													<th class="">Supply Type</th>
													<th class="text-center">Product Image</th>
													<th class="text-center">Is Active</th>
													<th class="text-center">Show Home?</th>
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
				<div class="col-12 p-4 xl-sidebar" id="rightSidebar">
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
										<form class="row validate-form" id="productmasterForm" method="post" action="productmaster" enctype="multipart/form-data">
											<input type="hidden" id="formevent" name="formevent" value='addright'>
											<input type="hidden" id="id" name="id" value=''>	
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Category<span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" id="categoryid" name="categoryid" data-live-search="true" title="Select Category" data-size="8">
													</select>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Product Name<span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Enter Product Name" id="name" name="name" require>
												</div>
											</div>
											
											
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Supply Type</label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" id="typeid" name="typeid[]" multiple="mutiple" data-live-search="true" title="Select Supply Type" data-size="8">
													</select>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Brand<span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select class="form-control selectpicker" id="brandid" name="brandid" data-live-search="true" title="Select Brand" data-size="8">
													</select>
												</div>
											</div>
											<div class="col-12">
												<div class="input-group">
													<label class="mb-1">Short Description <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<textarea  class="form-control" placeholder="Enter Short Description" id="shortdescr" name="shortdescr" require></textarea>
												</div>
											</div>
											<div class="col-12">
												<div class="col-12 layout-spacing">
													<div class="widget mt-10">
														<div class="widget-content row">
															<div class="col-12 col-sm-12 col-md-12 col-lg-12">
																<div class="row">
																	<div class="col-4">
																		<label class="mb-1">Product Details </label>
																		
																	</div>
																</div>
																<div class="row">
																	<div class="col-4">
																		<div class="input-group mb-0">
																			<label class="mb-1">Attributes <span class="text-danger">*</span></label>
																		</div>
																		<div class="input-group mb-3 mb-sm-3">
																			<select class="form-control selectpicker" name="attributeid" id="attributeid" data-live-serch="true" data-size="8" title="Select Attribute">
																			</select>
																		</div>
																	</div>
																	<div class="col-4">
																		<div class="input-group mb-0">
																			<label class="mb-1">Values <span class="text-danger">*</span></label>
																		</div>
																		<div class="input-group mb-3 mb-sm-3">
																			<input type="text" class="form-control" placeholder="Enter Values" id="value" name="value">
																		</div>
																	</div>
																	
																	<div class="col-auto mt-4 mb-auto">
																		<button type="button" class="col-auto btn btn-primary m-0" id="btnaddattribute" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add "><i class="bi bi-plus-lg"></i></button>
																	</div>
																</div>
															</div>

															<div class="col-12 col-sm-6 col-md-12 col-lg-12">
																<div class="row">
																	<div class="table-responsive pt-2">
																		<div class="col-12 p-0">
																			<table id="tableabtdetail" class="table table-bordered table-hover table-striped">
																				<thead>
																					<tr>
																						<th class="tbl-name">Attribute</th>
																						<th class="tbl-name">Values</th>
																						<th class="tbl-action">Action</th>
																					</tr>
																				</thead>
																				<tbody id="tblabt">
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
													
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 descrDiv">
												<div class="input-group">
													<label class="mb-1">Description <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<textarea id="contentdescr" name="contentdescr" class="form-control"></textarea>
													<p style="color:#f00;font-weight: bold;" class="descrerr"></p>
												</div>
											</div>
											
											<div class="col-12 ml-auto">
												<div class="input-group mb-0">
													<button type="submit" class="btn btn-primary m-0" id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
													<button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset" onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Upload Product Image View Modal -->
		<div class="modal animated fade" id="ProductImageModal" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-12">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
								<h5 class="add-event-title modal-title">Upload Image</h5>
							</div>
						</div>
						<div class="row">
							<form class="w-100 validate-form1" id="itemupdimageForm" method="post" action="productmaster" enctype="multipart/form-data">
								<input type="hidden" name="productid" id="productid" />                
								<div class="col-12">
									<div class="input-group">
										<label class="mb-1">Product Image <span class="text-danger">*</span></label>
										<label class="ml-auto "></label>
									</div>
									<div class="input-group mb-3 mb-lg-3">
										<input type="file" class="form-control d-none" id="itemimg" name="itemimg[]" multiple="multiple" accept="image/*">
										<label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="itemimg">
											<span style="background-image: url(assets/img/salon.jpg);"></span>
											<i class="bi bi-folder2-open d-block pt-1"></i> Browse...
										</label>
										<span style="color:#B00" class="imgsizelbl2">** Please upload image in JPG,JPEG,PNG Format</span>
										<!-- <span style="color:#B00">** Please upload image of size 456px X 307px</span> -->
									</div>
								</div>
								<div class="col-12">    
									<div class="ml-auto">
										<div class="input-group mb-0">
											<button type="submit" class="btn btn-primary m-0  ml-auto" id="btnupditemimage"><?php echo $config->getSaveSidebar(); ?></button>
										</div>
									</div>
								</div>
							</form>	
						</div>
						
							<div class="row viewitemimageblock">
				
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');
			$('#contentdescr').froalaEditor();
			var currpagename = getpagename();
			if(currpagename == 'ordermaster')
			{
				$('.pos-order').removeClass('d-none');
			}
			else
			{
				$('.pos-order').addClass('d-none');
			}
			$('.descrerr').html('');
        });

		function resetdata()
        {
            $("#productmasterForm").validate().resetForm();
            $('#productmasterForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
			$('#contentdescr').text('');
			$('#contentdescr').froalaEditor('html.set','');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');   
			Edittimeformnamechange(2); 
			
			fillsupplytype();
			fillbrand();
			fillattribute();
			fillcategory();
			$('#tblabt').html('');
			$('.descrerr').html('');
        }

		
		function fillcategory()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillcategory");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillcategory,OnErrorSelectpicker);
        }

        function Onsuccessfillcategory(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#categoryid').html(resultdata.data);
            $('#categoryid').selectpicker('refresh');	
        }

		function fillsupplytype()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillsupplytype");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillsupplytype,OnErrorSelectpicker);
        }

        function Onsuccessfillsupplytype(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#typeid').html(resultdata.data);
            $('#typeid').selectpicker('refresh');	
        }

		function fillbrand(brandid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillbrand");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillbrand,OnErrorSelectpicker);
			function Onsuccessfillbrand(content)
			{
				var JsonData = JSON.stringify(content);
				var resultdata = jQuery.parseJSON(JsonData);
				var branddata='';
				branddata+='<option="">Select Brand</option>'
				branddata+=resultdata.data;
				$('#brandid').html(branddata);
				
				$('#brandid').selectpicker('refresh');
				if(brandid)	
				{
					$('#brandid').val(brandid);
					$('#brandid').selectpicker('refresh');
				}
			}
        }

        

		function fillattribute()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillattribute");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillattribute,OnErrorSelectpicker);
        }

        function Onsuccessfillattribute(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
			var attrdata='';
			attrdata+="<option ''>Select Attributes</option>";
			attrdata+=resultdata.data;
            $('#attributeid').html(attrdata);
            $('#attributeid').selectpicker('refresh');	
        }

		// add attribute mapping
		$('#btnaddattribute').on('click', function(){
            var attributeid = $('#attributeid').val();
			var attribute = $('#attributeid :selected').text();
            var values = $('#value').val();

            if(attributeid && values)
            {
                $("#tblabt tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblattributeid = $('#tblattributeid'+trtmp).val();

                    if(tblattributeid == attributeid)
                    {
                        $(this).remove();
                    }
                });
                
                var trtmp = $('#tblabt tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+attribute+'<input type="hidden" name="tblattributeid[]" id="tblattributeid'+trtmp+'" value="'+attributeid+'" /><input type="hidden" name="tblattribute[]" id="tblattribute'+trtmp+'" value="'+attribute+'" /></td>';
                tbldata+='<td class="tbl-name">'+values+'<input type="hidden" name="tblvalues[]" id="tblvalues'+trtmp+'" value="'+values+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblattribute" id="removetblattribute" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblabt').append(tbldata);
                $('#value').val('');
                $('#attributeid').val('');
				$('#attributeid').selectpicker('refresh');
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        })

		$('body').on('click','#removetblattribute', function () {            
            $(this).parent().parent().remove();
        });

		//Edit Start
        function editdata(id)
        {
			fillattribute();
			$('.descrerr').html('');
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "editproductmaster");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessEditdata,OnErrorEditdata); 
        }

        function OnsuccessEditdata(content)
        {
            var JsonData = JSON.stringify(content);
            var resulteditdata = jQuery.parseJSON(JsonData);

            $('#id').val(resulteditdata.id);
            $('#name').val(resulteditdata.name);
			$('#shortdescr').val(resulteditdata.shortdescr);
			$('#buyerfrom').val(resulteditdata.preferbuyer);
			$('#contentdescr').val(resulteditdata.description);
			$('#contentdescr').froalaEditor('html.set',resulteditdata.description);
			
			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillcategory");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccesseditfillcategory,OnErrorseditfillcategory);
        

			function Onsuccesseditfillcategory(content)
			{
				var JsonData = JSON.stringify(content);
				var resultdata = jQuery.parseJSON(JsonData);
				$('#categoryid').html(resultdata.data);
				$('#categoryid').selectpicker('refresh');
				$('#categoryid').val(resulteditdata.categoryid);
				$('#categoryid').selectpicker('refresh');
			}
		
			function OnErrorseditfillcategory(content)
			{ 
				ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
			}

			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillsupplytype");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccesseditfillstore,OnErrorSelectpicker); 

            function Onsuccesseditfillstore(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#typeid').html(resultdata.data);
                if(resulteditdata.storeid !== null)
                {
                    var bt=resulteditdata.typeid.split(",");
                    $('#typeid').selectpicker('val',bt);
                }
                $('#typeid').selectpicker('refresh');	
            }
			fillbrand(resulteditdata.brandid);
			/* var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillbrand");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillbrand,OnErrorSelectpicker);
			function Onsuccessfillbrand(content)
			{
				var brandJsonData = JSON.stringify(content);
				var brandresultdata = jQuery.parseJSON(brandJsonData);
				var branddata='';
				branddata+='<option="">Select Brand</option>'
				branddata+=brandresultdata.data;
				$('#brandid').html(brandresultdata);
				$('#brandid').selectpicker('refresh');	
				
				$('#brandid').val(resulteditdata.brandid);
				$('#brandid').selectpicker('refresh');	
			} */

			var tbldata="";	
			var trtmp = 0;
            for(var i in resulteditdata.datamapping)
			{
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+resulteditdata.datamapping[i].attribute+'<input type="hidden" name="tblattributeid[]" id="tblattributeid'+trtmp+'" value="'+resulteditdata.datamapping[i].attributeid+'" /><input type="hidden" name="tblattribute[]" id="tblattribute'+trtmp+'" value="'+resulteditdata.datamapping[i].attribute+'" /></td>';
                tbldata+='<td class="tbl-name">'+resulteditdata.datamapping[i].attributevalue+'<input type="hidden" name="tblvalues[]" id="tblvalues'+trtmp+'" value="'+resulteditdata.datamapping[i].attributevalue+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblattribute" id="removetblattribute" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';
				trtmp++;
            }
            $('#tblabt').append(tbldata);

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

		$("#productmasterForm").submit(function(){
			var descr=$('#contentdescr').val();
			var attributelength=$('#tblabt tr').length;;
			var formevent=$('#formevent').val();
			var isreturn = true;
			if(formevent=='addright')
			{
				if(descr == '')
				{
					$('.descrerr').html('Description is required');
					isreturn = false;
				}
				
				/* if(attributelength==0)
				{
					alertify('Please fill product detail',0);
					isreturn = false;
				} */
			}

			
			return isreturn;
		});

		if($('#productmasterForm').length){		
            $('#productmasterForm').validate({
                rules:{
                    name:{
                        required: true,			
                    },
					shortdescr:{
						required: true,
					},
					categoryid:{
						required: true,
					},
					brandid:{
						required: true,
					},
                },messages:{
                    name:{
                        required:"Name is required",
                    },
					shortdescr:{
						required: "Short Description is required",
					},
					categoryid:{
						required: "Category is required",
					},
					brandid:{
						required:  "Brand is required",
					},
                },
                submitHandler: function(form){

					var brandname=$('#brandid :selected').text();
                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertproductmaster");
                    formdata.append("brandname", brandname);
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


		function changeshowonhomestatus(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "changeshowonhomestatus");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccesschangeshowonhomestatus,OnErrorchangeshowonhomestatus); 
        }

        function Onsuccesschangeshowonhomestatus(data)
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
        function OnErrorchangeshowonhomestatus(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

		function viewimgimage(imgfullurl)
        {
			$('#imgImgModal .clscatimg').attr('src',imgfullurl);
			$('#imgImgModal .clscatimglink').attr('href',imgfullurl);
			$('#imgImgModal .modal-title').html('Image');
            $('#imgImgModal').modal('show');
        }

		function viewdescription(id)
		{
			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "showaboutdescription");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessviewdescription,OnErrorviewdescription);
		}

		function Onsuccessviewdescription(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#GeneralModal').modal('show');
			$('#GeneralModal .modal-dialog').addClass('modal-xl');
			$('#GeneralModal #GeneralModalLabel').html('Product Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        function OnErrorviewdescription(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

		/************************ Start For Product Images *****************************/
		//Start Upload Product Images
		function uploaditemimage(id)
		{
			$('#ProductImageModal').modal('show');
			$('#ProductImageModal #productid').val(id);

			getitemimages(id);
		}
		//End Upload Product Images

		//Start submit Upload Product Image form
		if($('#itemupdimageForm').length)
		{		
			$('#itemupdimageForm').validate({
				rules:{
					
				},messages:{
					
				},
				submitHandler: function(form){
					$('#loaderprogress').show();
					var pagename=getpagename();
					var useraction=$('#formevent').val();
					formdata = new FormData(form);
					formdata.append("action", "insertitemimages");
					var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
					ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessUploadProductImage,OnErrorUploadProductImage)
			
				},
			});
		}
		

		function OnsuccessUploadProductImage(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

			if(resultdata.status==0)
			{
				alertify(resultdata.message,0);
			}
			else if(resultdata.status==1)
			{
				alertify(resultdata.message,1);

				$("#itemupdimageForm").validate().resetForm();
            	$('#itemupdimageForm').trigger("reset");

				getitemimages(resultdata.productid);		
			}
        }

		function OnErrorUploadProductImage(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
		//End submit Upload Product Image form


		function getitemimages(productid)
		{
		
			$('#loaderprogress').show();
			var pagename=getpagename();
			formdata = new FormData();
			formdata.append("action", "getitemimages");
			formdata.append("productid", productid);
			var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:'',masterlisting:false};
			ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessgetitemimages,OnErrorgetitemimages)
		}

		function Onsuccessgetitemimages(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
			var imgdiv="";
			if(resultdata.status==0)
			{
				$('#ProductImageModal .viewitemimageblock').html(imgdiv);	
			}
			else if(resultdata.status==1)
			{
				for(var i in resultdata.result)
				{
					
					var id="'"+resultdata.result[i].id+"'";
					var productid="'"+resultdata.result[i].productid+"'";

					imgdiv+='<div class="col-md-4 imgblock">';
					imgdiv+='<a class="pull-right delimg" href="javascript:void(0)" onclick="removeitemimage('+id+','+productid+')" ><i class="bi bi-x-lg"></i></a>';
					imgdiv+='<a href="'+resultdata.result[i].imgpath+'" class="pdfimg" target="_blank"><img style="width: 100%;border:1px solid #eee;" src="'+resultdata.result[i].imgpath+'"></a>';
					imgdiv+='<input type="number" name="imgdisplayorder" min="1" id="imgorder'+resultdata.result[i].id+'" value="'+resultdata.result[i].displayorder+'" style="width:70px;height:30px">';
		            imgdiv+='<button class="btnordsave" data-productid="'+resultdata.result[i].productid+'"  data-attr="'+resultdata.result[i].id+'" id="btnordsave'+resultdata.result[i].id+'">Save</button>';
					imgdiv+='</div>';
				}

				$('#ProductImageModal .viewitemimageblock').html(imgdiv);	
			}
        }

		function OnErrorgetitemimages(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }


		$('#ProductImageModal .viewitemimageblock').on('click','.btnordsave',function()
		{

			var imgid=$(this).attr('data-attr');
			var displayorder=$('#imgorder'+imgid).val();
			var productid=$(this).attr('data-productid');


			$('#loaderprogress').show();
			var pagename=getpagename();
			formdata = new FormData();
			formdata.append("action", "changeitemimgdiplayorder");
			formdata.append("imgid", imgid);
			formdata.append("displayorder", displayorder);
			formdata.append("productid", productid);
			var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:'',masterlisting:false};
			ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessupdatedisorder,OnErrorupdatedisorder)
			
		});

		function Onsuccessupdatedisorder(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

			if(resultdata.status==0)
			{
				alertify(resultdata.message,0);
			}
			else if(resultdata.status==1)
			{
				alertify(resultdata.message,1);

				getitemimages(resultdata.productid);		
			}
        }

		function OnErrorupdatedisorder(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }


		function removeitemimage(id,productid)
		{
			$('#loaderprogress').show();
			var pagename=getpagename();
			formdata = new FormData();
			formdata.append("action", "removeitemimage");
			formdata.append("id", id);
			formdata.append("productid", productid);
			var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:'',masterlisting:false};
			ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessremoveitemimage,OnErrorremoveitemimage)
		}

		function Onsuccessremoveitemimage(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

			if(resultdata.status==0)
			{
				alertify(resultdata.message,0);
			}
			else if(resultdata.status==1)
			{
				alertify(resultdata.message,1);

				getitemimages(resultdata.productid);	
			}
        }

		function OnErrorremoveitemimage(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
		/************************ End For Product Images *****************************/

	</script>	