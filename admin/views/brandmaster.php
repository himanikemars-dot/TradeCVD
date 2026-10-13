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
													<th class="tbl-info sorting sorting_asc" data-th="typename">type</th>
													<th class="tbl-info sorting sorting_asc" data-th="b.title">Name</th>
													<th class="tbl-info sorting text-center" data-th="b.displayorder">Display Order</th>
													<th class="tbl-info text-center">Is Active</th>
													<!-- <th class="tbl-info text-center">Brand Image</th> -->
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
										<form class="row validate-form" id="brandmasterForm" method="post" action="brandmaster" enctype="multipart/form-data">
											<input type="hidden" id="formevent" name="formevent" value='addright'>
											<input type="hidden" id="id" name="id" value=''>	
											<div class="col-12">
												<div class="input-group">
													<label class="mb-1">Type<span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<select  class="form-control selectpicker" name="typeid" id="typeid" data-live-search="true" data-size="10" data-dropup-auto="false">
														<option value="">Select Type</option>	
														<option value="1">Diamond</option>
														<option value="2">Jewellery</option>
													</select>
													
												</div>
											</div>
											
											<div class="col-12">
												<div class="input-group">
													<label class="mb-1">Name<span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Enter Name" id="title" name="title" require>
												</div>
											</div>
											
											<div class="col-12">
												<div class="input-group">
													<label class="mb-1">Display Order <span class="text-danger">*</span></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Display Order" id="displayorder"  onkeypress="intonly(event)" onpaste="intonly(event)" name="displayorder" require>
												</div>
											</div>
											<!-- <div class="col-12">
												<div class="input-group">
													<label class="mb-1">Upload Image <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3 ">													
													<div class="filepreview">
														<input class="form-control" type="file" name="img" id="img" accept="image/*">
														<label class="filepreviewbg" for="img">
															<img class="d-none filepreviewimg" id="filepreviewimg" src="assets/img/logo-white.png">
														</label>
													</div>
													<span style="color:#B00" class="imgsizelbl2">** Please upload image in JPG,JPEG,PNG Format</span>
													<p class="imgerr" style="color:#f00;font-weight: bold;"></p>
												</div>
											</div> -->
											
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


		<!-- <div class="modal animated fade" id="imgImgModal" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-12">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
								<h5 class="add-event-title modal-title">Brand Image</h5>
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
		</div> -->
	<script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');
			// $('#contentdescr').froalaEditor();
			var currpagename = getpagename();
			/* if(currpagename == 'ordermaster')
			{
				$('.pos-order').removeClass('d-none');
			}
			else
			{
				$('.pos-order').addClass('d-none');
			} */
			// img.onchange = evt => 
			// {
			// 	const [file] = img.files
			// 	if (file) 
			// 	{
			// 		filepreviewimg.src = URL.createObjectURL(file);
			// 		var imgurlimg = $('#filepreviewimg').attr('src');

			// 		$("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url(" + imgurlimg + ")");
			// 	}else{
			// 		$("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url('')");
			// 	}
			// }
			
        });

		function resetdata()
        {
            $("#brandmasterForm").validate().resetForm();
            $('#brandmasterForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
			$('#contentdescr').text('');
			$('#contentdescr').froalaEditor('html.set','');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');   
			Edittimeformnamechange(2); 
			// $("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url()");
			// $('.imgerr').text('');
        }

		//Edit Start
        function editdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "editbranddetail");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessEditdata,OnErrorEditdata); 
        }

        function OnsuccessEditdata(content)
        {
            var JsonData = JSON.stringify(content);
            var resulteditdata = jQuery.parseJSON(JsonData);

            $('#id').val(resulteditdata.id);
            $('#title').val(resulteditdata.title);
			$('#typeid').val(resulteditdata.type);
			$('#typeid').selectpicker('refresh');
			$('#displayorder').val(resulteditdata.displayorder);
   
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

		// $("#brandmasterForm").submit(function(){
		// 	var img=$('#img').val();
		// 	var formevent=$('#formevent').val();
		// 	if(formevent=='addright')
		// 	{
		// 		if(img=='')
		// 		{
		// 			$('.imgerr').html('Image is required');
		// 			return false;
		// 		}
		// 	}
		// });
		// $("#img").change(function(){
		// 	$('.imgerr').text('');
		// });
		if($('#brandmasterForm').length){		
            $('#brandmasterForm').validate({
                rules:{
					typeid:{
                        required: true,			
                    },
                    title:{
                        required: true,			
                    },
                    displayorder:{
                        required: true,			
                    },
                },messages:{
					typeid:{
                        required:"Type is required",
                    },
                    title:{
                        required:"Name is required",
                    },
                    displayorder:{
                        required:"Display Order is required",
                    },
                },
                submitHandler: function(form){

                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertbranddetail");
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

		// function viewimgimage(imgfullurl)
        // {
		// 	$('#imgImgModal .clscatimg').attr('src',imgfullurl);
		// 	$('#imgImgModal .clscatimglink').attr('href',imgfullurl);
		// 	$('#imgImgModal .modal-title').html('Brand Image');
        //     $('#imgImgModal').modal('show');
        // }

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
			$('#GeneralModal .modal-dialog').addClass('modal-l');
			$('#GeneralModal #GeneralModalLabel').html('Product Service Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        function OnErrorviewdescription(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
	</script>	