<?php 
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
                            <form class="text-left validate-form" id="metasettingForm" method="post" action="metasetting" enctype="multipart/form-data">
                                
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Page <span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select name="pageid" id="pageid" class="form-control selectpicker" data-live-search="true"  data-dropup-auto="false" data-size="5">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Page Title<span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-1">
                                        <textarea name="pagetitle" id="pagetitle" class="form-control" placeholder="Enter Page Title" rows="10"></textarea>
                                    </div>
                                    <div id="pagetitle-count" class="mb-3" style="font-weight: normal;">
                                        <span id="pagetitle-current">0</span>
                                        <span id="pagetitle-maximum">/ 100</span>
                                    </div>
                                </div>
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Meta Keywords<span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-1">
                                        <textarea name="metakeywords" id="metakeywords" class="form-control" placeholder="Enter Meta Keywords" rows="10"></textarea>
                                    </div>
                                    <div id="pagetitle-count" class="mb-3">
                                        <span id="pagetitle-current">0</span>
                                        <span id="pagetitle-maximum">/ 250</span>
                                    </div>
                                </div>
                                <div class="col-8 offset-2">
                                    <div class="input-group">
                                        <label class="mb-1">Meta Description<span class="text-danger">*</span></label>
                                        <label class="ml-auto "></label>
                                    </div>
                                    <div class="input-group mb-1">
                                        <textarea name="metadescr" id="metadescr" class="form-control" placeholder="Enter Meta Description" rows="10"></textarea>
                                    </div>
                                    <div id="pagetitle-count" class="mb-3">
                                        <span id="pagetitle-current">0</span>
                                        <span id="pagetitle-maximum">/ 250</span>
                                    </div>
                                </div>

                                <?php 
                                    if(($rightstotalcount>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
                                    {
                                        ?>
                                        <div class="row col-8 offset-2">
                                            <div class="ml-auto">
                                                <div class="input-group mb-0">
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
            $('#metasettingForm #contentdescr').froalaEditor();
            fillpage();
            
        });

		function resetdata()
        {
            $("#metasettingForm").validate().resetForm();
            $('#metasettingForm').trigger("reset");

            Edittimeformnamechange(2);   
            fillpage();
        }

        function fillpage()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};

            formdata = new FormData();
            formdata.append("action", "fillpage");

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillpage,OnErrorSelectpicker);
        }
        function Onsuccessfillpage(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            $('#pageid').html(resultdata.data);
            $('#pageid').selectpicker('refresh');	
            fillcontent();
        }

	
		$('#pageid').on('change', function(){
            fillcontent();
        })

		function fillcontent()
        {
            var pageid = $('#pageid').val();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

            formdata = new FormData();
            formdata.append("action", "fillcontent");
            formdata.append("pageid", pageid);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillcontent,OnErrorfillcontent);
        }
        function Onsuccessfillcontent(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#pagetitle').val(resultdata.title);
            $('#metakeywords').val(resultdata.metakeywords);
            $('#metadescr').val(resultdata.metadescription);
        }

		function OnErrorfillcontent(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

	
        if($('#metasettingForm').length){		
            $('#metasettingForm').validate({
                rules:{
                    pageid:{
                        required: true,
                    },
                    pagetitle:{
                        required: true,
                    },
                    metakeywords:{
                        required: true,
                    },				
                    metadescr:{
                        required: true
                    }
                },
                messages:{
                    pageid:{
                        required: "Please select page",
                    },
                    pagetitle:{
                        required: "Page title is required",
                    },
                    metakeywords:{
                        required: "Meta keywords is required",
                    },
                    metadescr:{
                        required: "Meta description is required",
                    }
                },
                submitHandler: function(form){
                    $('#loaderprogress').show();
                    var descr = $('#contentdescr').froalaEditor('html.get')
                    var pagename=getpagename();
                    formdata = new FormData(form);
                    
                    formdata.append("action", "insertmetasetting");
                    formdata.append("descr", descr);
                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:'addright',masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessmetasettingDataSubmit,OnErrormetasettingDataSubmit)

			    },
            });
        }

        function OnsuccessmetasettingDataSubmit(data)
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

        function OnErrormetasettingDataSubmit(data)
        {
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }


        //  Count character in description 
        $('body').on('input','#pagetitle',function() { 
            titlecharactercount($(this)) 
        });
	
	function titlecharactercount(e)
	{
	  var characterCount = e.val().length,
	      current = $('#pagetitle-current'),
	      maximum = $('#pagetitle-maximum'),
	      theCount = $('#pagetitle-count');
	   
	  current.text(characterCount);
	 
	  /*This isn't entirely necessary, just playin around*/
	  if (characterCount < 65) {
	    current.css('color', '#666');
	  }
	  if (characterCount >= 65) {
	    maximum.css('color', '#8f0001');
	    current.css('color', '#8f0001');
	    theCount.css('font-weight','bold');
	  } else {
	    maximum.css('color','#666');
	    theCount.css('font-weight','normal');
	  }
	  		
	}

	$('body').on('input','#metadescr',function() {
		metadescrcharactercount($(this))
	});
	
	function metadescrcharactercount(e)
	{
	  var characterCount = e.val().length,
	      current = $('#descr-current'),
	      maximum = $('#descr-maximum'),
	      theCount = $('#descr-count');
	   
	  current.text(characterCount);
	  
	  /*This isn't entirely necessary, just playin around*/
	  if (characterCount < 150) {
	    current.css('color', '#666');
	  }

	  if (characterCount >= 150) {
	    maximum.css('color', '#8f0001');
	    current.css('color', '#8f0001');
	    theCount.css('font-weight','bold');
	  } else {
	    maximum.css('color','#666');
	    theCount.css('font-weight','normal');
	  }
	  		
	}

	$('body').on('input','#metakeywords',function() {  
		metakeywordscharctercount($(this))   
	});
	
	function metakeywordscharctercount(e)
	{
	  var characterCount = e.val().length,
	      current = $('#keywords-current'),
	      maximum = $('#keywords-maximum'),
	      theCount = $('#keywords-count');
	   
	  current.text(characterCount);
	 
	  
	  /*This isn't entirely necessary, just playin around*/
	  if (characterCount < 150) {
	    current.css('color', '#666');
	  }

	  if (characterCount >= 150) {
	    maximum.css('color', '#8f0001');
	    current.css('color', '#8f0001');
	    theCount.css('font-weight','bold');
	  } else {
	    maximum.css('color','#666');
	    theCount.css('font-weight','normal');
	  }
	  		
	}


	</script>	