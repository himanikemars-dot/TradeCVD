<?php
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
											<div class="input-group mb-3 mb-sm-12">
												<select class="form-control selectpicker" data-live-search="true" data-size="10" data-dropup-auto="false" id="fltshapeid" name="fltshapeid">
													<option value="%">All Shape</option>
												</select>
											</div>
										</li>
										<li class="tbl-search">
											<div class="input-group mb-3 mb-sm-12">
												<select class="form-control selectpicker" data-live-search="true" data-size="10" data-dropup-auto="false" id="fltclarityid" name="fltclarityid">
													<option value="%">All Clarity</option>
												</select>
											</div>
										</li>
										<li class="tbl-search">
											<div class="input-group mb-3 mb-sm-12">
												<select class="form-control selectpicker" data-live-search="true" data-size="10" data-dropup-auto="false" id="fltcolorid" name="fltcolorid">
													<option value="%">All Color</option>
												</select>
											</div>
										</li>
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
													<th class="tbl-name sorting" data-th="shapename">Shape Name</th>
													<th class="tbl-name sorting" data-th="size">Size</th>
													<th class="tbl-name sorting" data-th="clarityname">Clarity Name</th>
													<th class="tbl-name sorting" data-th="colorname">Color Name</th>
													<th class="tbl-name sorting" data-th="finalprice">Price</th>
													<th class="tbl-name sorting" data-th="dt">Date</th>
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
										<form class="row validate-form" id="diamondrateupdateForm" method="post" action="diamondrateupdate" enctype="multipart/form-data">
											<input type="hidden" id="formevent" name="formevent" value='addright'>
											<input type="hidden" id="id" name="id" value=''>	
											<div class="col-12">
                                                <div class="input-group">
                                                    <label class="mb-1">Shape <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select class="form-control selectpicker" data-live-search="true" id="shapeid" name="shapeid[]" data-size="10" multiple="multiple" data-dropup-auto="false" title="Select Shape">
                                                    
                                                    </select>
                                                </div>
                                            </div>
											
											<div class="col-12">
                                                <div class="input-group">
                                                    <label class="mb-1">Upload Diamond Details <span class="text-danger">*</span></label>
                                                    <label class="ml-auto "></label>
                                                </div>
                                                <div class="input-group mb-3 mb-lg-3">
                                                    <input class="form-control" type="hidden" name="hcsvfile" id="hcsvfile" >
                                                    <input id="csvfile" type="file" name="csvfile" class="form-control d-none"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"/>
                                                    <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="csvfile">
                                                        <span style="background-image: url(assets/img/salon.jpg);"></span>
                                                        <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                                    </label>
                                                    <span style="color:#B00" class="imgsizelbl2 imgerr"></span>
                                                    <span style="color:#B00" class="imgsizelbl2"><a download href="<?php $config->getImageurl() ?>assets/files/diamondrateupdate.xlsx">Click here </a> to download excel format</span>
                                                </div>
                                            </div>
                                            
											<div class="col-12 ml-auto">
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
		<div class="modal animated fade" id="BenefitImageModal" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-12">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
								<h5 class="add-event-title modal-title">Image</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-12 text-center">                                                
								<a href="javascript:void(0)" class="clscatimglink" target="_blank"><img src="" alt="seaticon" class="img-thumbnail clscatimg"/></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
	<script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');
			$('#descr').froalaEditor();

            fillshape();
            listclarity();
			
			
        });
		

		function resetdata()
        {
            $("#diamondrateupdateForm").validate().resetForm();
            $('#diamondrateupdateForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');   
			Edittimeformnamechange(2); 
        }

        function fillshape(shapeid)
        {
            $('#loaderprogress').show();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillshapes");
            formdata.append("ismain", 1);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillshape,OnErrorSelectpicker); 
            function Onsuccessfillshape(content)
            {
                $('#loaderprogress').hide();
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#shapeid').html(resultdata.data);
                $('#shapeid').selectpicker('refresh');
                
                if(shapeid){
                    $('#shapeid').val(shapeid);
                    var bt=shapeid.split(",");
                    $('#shapeid').selectpicker('val',bt);
                }
                else{
                    $('#shapeid').val('');
                }
                $('#shapeid').selectpicker('refresh');

				var htmldata='';
				htmldata+='<option value="%">All Shape</option>';
				htmldata+=resultdata.data;
				$('#fltshapeid').html(htmldata);
				$('#fltshapeid').selectpicker('refresh');
            }
        }

		function listclarity()
        {
            $('#loaderprogress').show();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "listclarity");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccesslistclarity,OnErrorSelectpicker); 
            function Onsuccesslistclarity(content)
            {
                $('#loaderprogress').hide();
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);

				var htmldata='';
				htmldata+='<option value="%">All Clarity</option>';
				htmldata+=resultdata.data;
				$('#fltclarityid').html(htmldata);
				$('#fltclarityid').selectpicker('refresh');
            }

			listcolor();
        }

		function listcolor()
        {
            $('#loaderprogress').show();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "listcolor");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccesslistcolor,OnErrorSelectpicker); 
            function Onsuccesslistcolor(content)
            {
                $('#loaderprogress').hide();
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);

				var htmldata='';
				htmldata+='<option value="%">All Color</option>';
				htmldata+=resultdata.data;
				$('#fltcolorid').html(htmldata);
				$('#fltcolorid').selectpicker('refresh');
            }
        }

		$('#fltshapeid,#fltclarityid,#fltcolorid').on('change',function(){
			$('#tableDataList').attr('data-nextpage',0); 
        	listdata();
		});
		

		$("#diamondrateupdateForm").submit(function(){
			var csvfile=$('#csvfile').val();
			var formevent=$('#formevent').val();
			if(formevent=='addright')
			{
				if(csvfile=='')
				{
					$('.imgerr').html('File is required');
					return false;
				}
			}
		});
		$('#csvfile').on('change',function(){
			$('.imgerr').html('');
		})
		if($('#diamondrateupdateForm').length){		
            $('#diamondrateupdateForm').validate({
                rules:{
					'shapeid[]':{
                        required: true,			
                    },
                },messages:{
					'shapeid[]':{
                        required: "Shape is required",			
                    },
                },
                submitHandler: function(form){

                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertdiamondrateupdate");
                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessDataSubmit,OnErrorDataSubmit)

			    },
            });
        }

		function viewimgimage(imgfullurl)
        {
			$('#BenefitImageModal .clscatimg').attr('src',imgfullurl);
			$('#BenefitImageModal .clscatimglink').attr('href',imgfullurl);
			$('#BenefitImageModal .clscatimg').addClass('bg-web-dark');
            $('#BenefitImageModal').modal('show');
        }
	</script>	