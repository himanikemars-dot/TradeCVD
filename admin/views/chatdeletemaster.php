<?php 
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1).'/config/init.php';


?>
	<div class="layout-px-spacing">
		<!-- CONTENT AREA -->
		<div class="row layout-top-spacing">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12 mb-3">
                    <div class="widget">
                        <div class="widget-content">
                            <form class="row text-left validate-form" id="chatdeletemasterForm" method="post" action="chatdeletemaster" enctype="multipart/form-data">
                                <!-- add contact no -->
                                <div class="col-12 col-md-2 col-lg-2 col-xl-8 offset-2">
                                    <h6 class="inv-main-title mb-3">Chat Delete Days Master</h6>
                                </div>
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Chat Delete Days <span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" id="chatdeletedays" name="chatdeletedays" class="form-control" onkeypress="intonly(event)" onpaste="intonly(event)" placeholder="Enter Chat Delete Days" />
                                    </div>
                                </div>
                               
                                <?php 
                                    if(($rightstotalcount>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
                                    {
                                        ?>
                                        <div class="row col-8 offset-2">
                                            <div class="text-left">
                                                <div class="input-group my-3">
                                                    <button type="submit" class="btn btn-primary m-0" id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
                                                    <button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset" onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>

	<script>
        $(document).ready(function () {
            fillcontent();
        });

		function resetdata()
        {
            $("#chatdeletemasterForm").validate().resetForm();
            $('#chatdeletemasterForm').trigger("reset");
            fillcontent();
            Edittimeformnamechange(2);   
        }


		function fillcontent()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

            formdata = new FormData();
            formdata.append("action", "fillcontent");

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillcontent,OnErrorfillcontent);
        }
        function Onsuccessfillcontent(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#chatdeletedays').val(resultdata.chatdeletedays);
        }

		function OnErrorfillcontent(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        if($('#chatdeletemasterForm').length){		
            $('#chatdeletemasterForm').validate({
                rules:{
                    chatdeletedays:{
                        required: true,
                    },
                },messages:{
                    chatdeletedays:{
                        required: "Chat Delete Days is required",
                    },
                },
                submitHandler: function(form){
                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertchatdeletedays");
                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccesssocialmediasettingDataSubmit,OnErrorsocialmediasettingDataSubmit)

			    },
            });
        }

        function OnsuccesssocialmediasettingDataSubmit(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#loaderprogress').hide();	
            if(resultdata.status==0)
            {
                alertify(resultdata.message, '0');
            }
            else if(resultdata.status==1)
            {
                alertify(resultdata.message, '1');
                fillcontent();
            }
        }

        function OnErrorsocialmediasettingDataSubmit(data)
        {
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

       
	</script>	