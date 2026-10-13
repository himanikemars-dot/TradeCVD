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
													<th class="tbl-name sorting sorting_asc" data-th="cm.title">Blog Title</th>
													<th class="tbl-name sorting" data-th="cm.authername">Author Name</th>
													<th class="tbl-name sorting " data-th="cm.blogdate">Blog Date</th>
													<th class="text-center">Blog Image</th>
													<th class="text-center">Is Active</th>
													<!-- <th class="text-center">Show On Home ?</th> -->
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
										<form class="row validate-form" id="blogmasterForm" method="post" action="blogmaster" enctype="multipart/form-data">
											<input type="hidden" id="formevent" name="formevent" value='addright'>
											<input type="hidden" id="id" name="id" value=''>	
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Blog Title <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Enter Blog Title" id="title" name="title" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Author Name</label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Enter Auther Name" id="authername" name="authername" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Blog Date <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<input type="text" class="form-control" placeholder="Blog date" id="blogdate" name="blogdate" readonly="readonly" require>
												</div>
											</div>
											<div class="col-6">
												<div class="input-group">
													<label class="mb-1">Short Description <span class="text-danger">*</span></label>
													<label class="ml-auto "></label>
												</div>
												<div class="input-group mb-3">
													<textarea id="shortdescr" name="shortdescr" class="form-control"></textarea>
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


		<!-- Upload blog Image View Modal -->
		<div class="modal animated fade" id="blogImageModal" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel" aria-hidden="true">
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
							<form class="w-100 validate-form1" id="itemupdimageForm" method="post" action="blogmaster" enctype="multipart/form-data">
								<input type="hidden" name="blogid" id="blogid" />                
								<div class="col-12">
									<div class="input-group">
										<label class="mb-1">Blog Image <span class="text-danger">*</span></label>
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
			
        });

		$('#blogdate').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
            format: 'DD/MM/YYYY',
            time: false,
			switchOnClick: true,
        });

		function resetdata()
        {
            $("#blogmasterForm").validate().resetForm();
            $('#blogmasterForm').trigger("reset");
            $('#formevent').val('addright');
            $('.selectpicker').selectpicker('refresh');
			$('#contentdescr').text('');
			$('#contentdescr').froalaEditor('html.set','');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');   
			Edittimeformnamechange(2); 
			$('.descrerr').html('');
        }

		//Edit Start
        function editdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "editblogmaster");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessEditdata,OnErrorEditdata); 
        }

        function OnsuccessEditdata(content)
        {
            var JsonData = JSON.stringify(content);
            var resulteditdata = jQuery.parseJSON(JsonData);
			$('.descrerr').html('');
            $('#id').val(resulteditdata.id);
            $('#title').val(resulteditdata.title);
			$('#authername').val(resulteditdata.authername);
			$('#blogdate').val(resulteditdata.blogdate);
			$('#shortdescr').val(resulteditdata.shortdescr);
			$('#contentdescr').val(resulteditdata.description);
			$('#contentdescr').froalaEditor('html.set',resulteditdata.description);
			
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

		$("#blogmasterForm").submit(function(){
			// var img=$('#file-1').val();
			var descr=$('#contentdescr').val();
			var formevent=$('#formevent').val();
			var isreturn = true;
			// if(formevent=='addright')
			{
				/* if(img=='')
				{
					$('.imgerr').html('Blog Image is required');
					isreturn = false;
				} */
				if(descr == '')
				{
					$('.descrerr').html('Description is required');
					isreturn = false;
				}
			}

			
			return isreturn;
		});
		if($('#blogmasterForm').length){		
            $('#blogmasterForm').validate({
                rules:{
                    title:{
                        required: true,			
                    },
					blogdate:{
						required: true,			
                    },
					shortdescr:{
					   required: true,			
				   },
                },messages:{
                    title:{
                        required:"Blog title is required",
                    },
					blogdate:{
                        required: "Blog date is required",			
                    },
					shortdescr:{
					   required: "Short Description is required",			
				   },
                },
                submitHandler: function(form){

                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertblogmaster");
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
			$('#imgImgModal .modal-title').html('Blog Image');
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
			$('#GeneralModal #GeneralModalLabel').html('Blog Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        function OnErrorviewdescription(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

		/************************ Start For blog Images *****************************/
		//Start Upload blog Images
		function uploaditemimage(id)
		{
			$('#blogImageModal').modal('show');
			$('#blogImageModal #blogid').val(id);

			getitemimages(id);
		}
		//End Upload blog Images

		//Start submit Upload blog Image form
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
					ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessUploadblogImage,OnErrorUploadblogImage)
			
				},
			});
		}
		

		function OnsuccessUploadblogImage(content)
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

				getitemimages(resultdata.blogid);		
			}
        }

		function OnErrorUploadblogImage(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
		//End submit Upload blog Image form


		function getitemimages(blogid)
		{
		
			$('#loaderprogress').show();
			var pagename=getpagename();
			formdata = new FormData();
			formdata.append("action", "getitemimages");
			formdata.append("blogid", blogid);
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
				$('#blogImageModal .viewitemimageblock').html(imgdiv);	
			}
			else if(resultdata.status==1)
			{
				for(var i in resultdata.result)
				{
					
					var id="'"+resultdata.result[i].id+"'";
					var blogid="'"+resultdata.result[i].blogid+"'";

					imgdiv+='<div class="col-md-4 imgblock">';
					imgdiv+='<a class="pull-right delimg" href="javascript:void(0)" onclick="removeitemimage('+id+','+blogid+')" ><i class="bi bi-x-lg"></i></a>';
					imgdiv+='<a href="'+resultdata.result[i].imgpath+'" class="pdfimg" target="_blank"><img height="140" width="135" style="width: 100%;border:1px solid #eee;" src="'+resultdata.result[i].imgpath+'"></a>';
					imgdiv+='<input type="number" name="imgdisplayorder" min="1" id="imgorder'+resultdata.result[i].id+'" value="'+resultdata.result[i].displayorder+'" style="width:70px;height:30px">';
		            imgdiv+='<button class="btnordsave" data-blogid="'+resultdata.result[i].blogid+'"  data-attr="'+resultdata.result[i].id+'" id="btnordsave'+resultdata.result[i].id+'">Save</button>';
					imgdiv+='</div>';
				}

				$('#blogImageModal .viewitemimageblock').html(imgdiv);	
			}
        }

		function OnErrorgetitemimages(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }


		$('body').on('click','.btnordsave',function()
		{

			var imgid=$(this).attr('data-attr');
			var displayorder=$('#imgorder'+imgid).val();
			var blogid=$(this).attr('data-blogid');


			$('#loaderprogress').show();
			var pagename=getpagename();
			formdata = new FormData();
			formdata.append("action", "changeitemimgdiplayorder");
			formdata.append("imgid", imgid);
			formdata.append("displayorder", displayorder);
			formdata.append("blogid", blogid);
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

				getitemimages(resultdata.blogid);		
			}
        }

		function OnErrorupdatedisorder(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }


		function removeitemimage(id,blogid)
		{
			$('#loaderprogress').show();
			var pagename=getpagename();
			formdata = new FormData();
			formdata.append("action", "removeitemimage");
			formdata.append("id", id);
			formdata.append("blogid", blogid);
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

				getitemimages(resultdata.blogid);	
			}
        }

		function OnErrorremoveitemimage(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
		/************************ End For blog Images *****************************/

	</script>	