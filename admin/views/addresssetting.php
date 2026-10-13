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
                            <form class="row text-left validate-form" id="addresssettingForm" method="post" action="addresssetting" enctype="multipart/form-data">
                            <div class="col-12 col-md-2 col-lg-2 col-xl-8 offset-2">
                                    <h6 class="inv-main-title mb-3">Address Info</h6>
                                </div>
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Address </label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <textarea name="address" id="address" class="form-control" placeholder="Enter Address" rows="3"></textarea>
                                    </div>
                                </div>
                               
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">E-mail Address <span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <input type="email" id="email"  name="email" class="form-control" placeholder="Enter E-mail Address " required="required" />
                                    </div>
                                </div>

                                <!-- <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">E-mail Address 2<span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <input type="email" id="email2"  name="email2" class="form-control" placeholder="Enter E-mail Address 2" required="required" />
                                    </div>
                                </div> -->

                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Contact No 1 <span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" id="contact1" minlength="8" onkeypress="numbonly(event);" onpaste="return false;" name="contact1" class="form-control" placeholder="Enter Contact No 1" required="required" />
                                    </div>
                                </div>
                               
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Contact No 2 </label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" id="contact2" maxlength="13" minlength="8" onkeypress="numbonly(event)" onpaste="return false" name="contact2" class="form-control" placeholder="Enter Contact No 2" />
                                    </div>
                                </div>

                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Map Link </label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <input type="text" name="maplink" id="maplink" class="form-control" placeholder="Enter Map Link">
                                    </div>
                                </div>

                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Support Contact No </label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" id="supportcontact" maxlength="13" minlength="8" onkeypress="numbonly(event)" onpaste="return false" name="supportcontact" class="form-control" placeholder="Enter Support Contact No" />
                                    </div>
                                </div>

                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Support E-mail Address <span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <input type="email" id="supportemail"  name="supportemail" class="form-control" placeholder="Enter Support E-mail Address"/>
                                    </div>
                                </div>

                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Support whatsapp No </label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" id="supportwhatsappno" maxlength="13" minlength="8" onkeypress="numbonly(event)" onpaste="return false" name="supportwhatsappno" class="form-control" placeholder="Enter Support whatsapp No" />
                                    </div>
                                </div>


                                <!-- <div class="col-8 offset-2 d-none">
                                    <div class="input-group">
                                        <label class="mb-1">Office Hours </label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <input type="text" id="officetime"  name="officetime" class="form-control" placeholder="Enter Office Hours" />
                                    </div>
                                </div> -->

                                <?php 
                                    if(($rightstotalcount>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
                                    {
                                        ?>
                                        <div class="row col-8 offset-2">
                                            <div class="text-left">
                                                <div class="input-group my-2">
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
            $('.selectpicker').selectpicker('refresh');
            $('#addresssettingForm #contentdescr').froalaEditor();
            fillcontent();
        });

		function resetdata()
        {
            $("#addresssettingForm").validate().resetForm();
            $('#addresssettingForm').trigger("reset");
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
            $('#address').val(resultdata.address);
            $('#email').val(resultdata.email);
            $('#email2').val(resultdata.email2);
            $('#contact1').val(resultdata.contact1);
            $('#contact2').val(resultdata.contact2);
            // $('#officetime').val(resultdata.officetime);
            $('#maplink').val(resultdata.maplink);

            $('#supportcontact').val(resultdata.supportcontact);
            $('#supportemail').val(resultdata.supportemail);
            $('#supportwhatsappno').val(resultdata.supportwhatsappno);
        }

		function OnErrorfillcontent(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

		
    
        if($('#addresssettingForm').length){		
            $('#addresssettingForm').validate({
                rules:{
                    /* address:{
                        required: true,			
                    }, */
                    contact1:{
                        required: true,	
                        contact:true	
                    },
                    email:{
                        required: true,		
                        email: true,		
                    },
                    email2:{
                        required: true,	
                        email: true,		
                    },
                    /* maplink:{
                        required: true,		
                    }, */
                },messages:{
                    /* address:{
                        required:"Address is required",
                    }, */
                    contact1:{
                        required:"Contact No 1 is required",
                    },
                    email:{
                        required:"Email Address is required",
                    },
                    email2:{
                        required:"Email Address 2 is required",
                    },
                    /* maplink:{
                        required:"Map Link is required",
                    }, */
                },
                submitHandler: function(form){
                    $('#loaderprogress').show();
                    var descr = $('#contentdescr').froalaEditor('html.get')
                    var pagename=getpagename();
                    formdata = new FormData(form);
                    
                    formdata.append("action", "insertaddresssetting");
                    formdata.append("descr", descr);
                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:'addright',masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessaddresssettingDataSubmit,OnErroraddresssettingDataSubmit)

			    },
            });
        }

        function OnsuccessaddresssettingDataSubmit(data)
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

        function OnErroraddresssettingDataSubmit(data)
        {
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

	</script>	