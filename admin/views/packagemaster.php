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
									<div class="col-lg-12 col-md-12 col-12 layout-spacing" id="ListPackageFeatures">
										
									</div>	
									<div class="col-lg-12 col-md-12 col-12 layout-spacing">
											
										<div class="widget">
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
			fillpackagefeatures('addright');
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
			fillpackagefeatures('addright');
			filltermsandconditions();
			
	    }

		// LIST PACKAGE FEATURES

		function fillpackagefeatures(formevent,id='')
        {
			// var formevent=$('#formevent').val();
			// var id=$('#id').val();
			var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillpackagefeatures");
			formdata.append("formevent", formevent);
			formdata.append("id",id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillpackagefeatures,OnErrorSelectpicker); 
        }

        function Onsuccessfillpackagefeatures(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
			$('#ListPackageFeatures').html(resultdata.data);  

			var pfid=$(".loginlimit").attr('data-pfid');
			if(pfid==9)
			{
				var checkval=$('input[name="can'+pfid+'"]:checked').val();
				$('.isnolimitDiv'+pfid+'').addClass('d-none');
				$('#isnolimit'+pfid+'').prop('checked',false);
				if(checkval==1) {
					$('.isnolimitDiv'+pfid+'').removeClass('d-none');
				}

				$('.limitvalueDiv'+pfid+'').addClass('d-none');
					$('#limitvalue'+pfid+'').val(0);
					if(checkval==1) {
						$('.limitvalueDiv'+pfid+'').removeClass('d-none');
						$('#limitvalue'+pfid+'').val(0);
					}



				var withinputbox=$(".clsisnolimitchkbox").attr('data-withinputbox');
				var checkboxval=$('input[name="isnolimit'+pfid+'"]:checked').val();
				if(withinputbox==1)
				{
					$('.limitvalueDiv'+pfid+'').removeClass('d-none');
					$('#limitvalue'+pfid+'').val(0);
					if(checkboxval==1)
					{
						$('.limitvalueDiv'+pfid+'').addClass('d-none');
						$('#limitvalue'+pfid+'').val(0);
					}
				}
			}
			

			$('.clsynradiobtn').change(function(){

				var pfid=$(this).attr('data-pfid');
				
				var haslimit=$(this).attr('data-haslimit');
				var withinputbox=$(this).attr('data-withinputbox');
				var checkval=$('input[name="can'+pfid+'"]:checked').val();
				
				if(haslimit==1)
				{
					$('.isnolimitDiv'+pfid+'').addClass('d-none');
					$('#isnolimit'+pfid+'').prop('checked',false);
					if(checkval==1) {
						$('.isnolimitDiv'+pfid+'').removeClass('d-none');
					}
				}
				if(withinputbox==1)
				{
					$('.limitvalueDiv'+pfid+'').addClass('d-none');
					$('#limitvalue'+pfid+'').val(0);
					if(checkval==1) {
						$('.limitvalueDiv'+pfid+'').removeClass('d-none');
						$('#limitvalue'+pfid+'').val(0);
					}
				}
				
			});

			$('.clsisnolimitchkbox').change(function(){
				
				var pfid=$(this).attr('data-pfid');
				var haslimit=$(this).attr('data-haslimit');
				var withinputbox=$(this).attr('data-withinputbox');
				var checkboxval=$('input[name="isnolimit'+pfid+'"]:checked').val();
				if(withinputbox==1)
				{
					$('.limitvalueDiv'+pfid+'').removeClass('d-none');
					$('#limitvalue'+pfid+'').val(0);
					if(checkboxval==1)
					{
						$('.limitvalueDiv'+pfid+'').addClass('d-none');
						$('#limitvalue'+pfid+'').val(0);
					}
				}
					

			});	
        }
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

			fillpackagefeatures('editright',resulteditdata.id);

			$('#colorcode').val(resulteditdata.colorcode);
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
					colorcode:{
						required:"Colorcode is required",	
					},
					termsconditionid:{
						required:"Terms & Condition is required",	
					},
                },
                submitHandler: function(form)
				{
					var descr=$('#descr').froalaEditor('html.get');
					var shortdescr=$('#shortdescr').froalaEditor('html.get');
					var termscondition=$('#termscondition').froalaEditor('html.get');

					if(descr!='' || shortdescr!='' || termscondition!='')
					{
						$('#loaderprogress').show();
						var pagename=getpagename();
						var useraction=$('#formevent').val();
						formdata = new FormData(form);
						formdata.append("action", "insertpackagemaster");
						formdata.append("descr", descr);
						formdata.append("shortdescr", shortdescr);
						formdata.append("termscondition", termscondition);
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