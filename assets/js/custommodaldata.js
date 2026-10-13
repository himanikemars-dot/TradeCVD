//Add Product
$('body').on('click','.addproduct',function(){
    var htmlform='';
    htmlform+='<form class="col-12 validate-form" id="mproductmasterForm" method="post" action="">';
        htmlform+='<input type="hidden" id="formevent" name="formevent" value="addright">';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group mb-0">';
                htmlform+='<label class="mb-1">Product Name <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3 mb-lg-3">';
                htmlform+='<input type="text" class="form-control" placeholder="Product Name" id="productname" name="productname">';
            htmlform+='</div>';
        htmlform+='</div>';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="ml-auto ">';
                htmlform+='<div class="mb-0 text-right">';
                    htmlform+='<button type="submit" id="btnusertypesubmit" class="btn btn-primary m-0 ml-2">'+btnsave+'</button>';
                htmlform+='</div>';
            htmlform+='</div>';
            
        htmlform+='</div>';
    htmlform+='</form>';

    $('#adddataForm').html(htmlform);
    $('#adddataModal').modal('show');
    $('#adddataModalLabel').html('Add Product');
    var funname=$(this).data('funname');
    
    if($('#adddataModal #mproductmasterForm').length){		
        $('#adddataModal #mproductmasterForm').validate({
            rules:{
                productname:{
                    required: true,			
                }
            },messages:{
                productname:{
                    required:"Product Name is required",
                }
            },
            submitHandler: function(form){
                
                $('#loaderprogress').show();
                var pagename=getpagename();
                var useraction=$('#mproductmasterForm #formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertproduct");
                formdata.append("formname", "#adddataModal #mproductmasterForm");
                formdata.append("funname", funname);
                var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",endpointurl+'productmaster',formdata,headersdata,OnsuccessmodalDataSubmit,OnErrorDataSubmit); 
            },
        });
    }
});
//Add Event Category
$('body').on('click','.addeventcategory',function(){
    var htmlform='';
    htmlform+='<form class="col-12 validate-form" id="meventcategorymasterForm" method="post" action="">';
        htmlform+='<input type="hidden" id="formevent" name="formevent" value="addright">';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group mb-0">';
                htmlform+='<label class="mb-1">Event Category Name <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3 mb-lg-3">';
                htmlform+='<input type="text" class="form-control" placeholder="Event Category Name" id="eventcategoryname" name="eventcategoryname">';
            htmlform+='</div>';
        htmlform+='</div>';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="ml-auto ">';
                htmlform+='<div class="mb-0 text-right">';
                    htmlform+='<button type="submit" id="btnusertypesubmit" class="btn btn-primary m-0 ml-2">'+btnsave+'</button>';
                htmlform+='</div>';
            htmlform+='</div>';
            
        htmlform+='</div>';
    htmlform+='</form>';

    $('#adddataForm').html(htmlform);
    $('#adddataModal').modal('show');
    $('#adddataModalLabel').html('Add Event Category');
    var funname=$(this).data('funname');
    
    if($('#adddataModal #meventcategorymasterForm').length){		
        $('#adddataModal #meventcategorymasterForm').validate({
            rules:{
                eventcategoryname:{
                    required: true,			
                }
            },messages:{
                eventcategoryname:{
                    required:"Event Category Name is required",
                }
            },
            submitHandler: function(form){
                
                $('#loaderprogress').show();
                var pagename=getpagename();
                var useraction=$('#meventcategorymasterForm #formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "inserteventcategory");
                formdata.append("formname", "#adddataModal #meventcategorymasterForm");
                formdata.append("funname", funname);
                var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",endpointurl+'eventcategorymaster',formdata,headersdata,OnsuccessmodalDataSubmit,OnErrorDataSubmit); 
            },
        });
    }
});

// Add state master
$('body').on('click','.addmodalstate',function(){
    var htmlform='';
    htmlform+='<form class="col-12 validate-form" id="mstatemasterForm" method="post" action="">';
        htmlform+='<input type="hidden" id="formevent" name="formevent" value="addright">';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">State Name <span class="text-danger">*</span></label>';
                htmlform+='<label class="ml-auto "></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<input type="text" class="form-control" placeholder="State Name" id="state" name="state" require>';
            htmlform+='</div>';
        htmlform+='</div>';
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">Type <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<select class="form-control selectpicker" data-live-search="true" id="statetypeid" name="statetypeid" data-size="10" data-dropup-auto="false">';
                    htmlform+='<option value="">Select Type</option>';
                    htmlform+='<option value="1" selected>State (Individual)</option>';
                    htmlform+='<option value="2">Central (Union Territory)</option>';
                htmlform+='</select>';
            htmlform+='</div>';
        htmlform+='</div>';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="ml-auto ">';
                htmlform+='<div class="mb-0 text-right">';
                    htmlform+='<button type="submit" id="btnusertypesubmit" class="btn btn-primary m-0 ml-2">'+btnsave+'</button>';
                htmlform+='</div>';
            htmlform+='</div>';
            
        htmlform+='</div>';
    htmlform+='</form>';

    $('#adddataForm').html(htmlform);
    $('#adddataModal').modal('show');
    $('#mstatemasterForm #statetypeid').selectpicker('refresh');
    $('#adddataModalLabel').html('Add State');
    var funname=$(this).data('funname');
    if($('#adddataModal #mstatemasterForm').length){		
        $('#adddataModal #mstatemasterForm').validate({
            rules:{
                state:{
                    required: true,			
                },
                statetypeid:{
                    required: true,			
                }
            },messages:{
                state:{
                    required:"State name is required",
                },
                statetypeid:{
                    required:"Type is required",
                }
            },
            submitHandler: function(form){
                $('#loaderprogress').show();
                var pagename=getpagename();
                var useraction=$('#mstatemasterForm #formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertstate");
                formdata.append("formname", "#adddataModal #mstatemasterForm");
                formdata.append("funname", funname);
                var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",endpointurl+'statemaster',formdata,headersdata,OnsuccessmodalDataSubmit,OnErrorDataSubmit); 
            },
        });
    }
});

//Add city master data
$('body').on('click','.addcity',function(){
    var htmlform='';
    htmlform+='<form class="col-12 validate-form" id="mcitymasterForm" method="post" action="">';
        htmlform+='<input type="hidden" id="formevent" name="formevent" value="addright">';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">City Name<span class="text-danger">*</span></label>';
                htmlform+='<label class="ml-auto "></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<input type="text" class="form-control" placeholder="City Name" id="city" name="city" require>';
            htmlform+='</div>';
        htmlform+='</div>';
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">State <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<select class="form-control selectpicker" data-live-search="true" id="stateid" name="stateid" data-size="10" data-dropup-auto="false">';
                htmlform+='</select>';
            htmlform+='</div>';
        htmlform+='</div>';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="ml-auto ">';
                htmlform+='<div class="mb-0 text-right">';
                    htmlform+='<button type="submit" id="btnusertypesubmit" class="btn btn-primary m-0 ml-2">'+btnsave+'</button>';
                htmlform+='</div>';
            htmlform+='</div>';
            
        htmlform+='</div>';
    htmlform+='</form>';

    $('#adddataForm').html(htmlform);
    
    var pagename=getpagename();
    var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
    formdata = new FormData();
    formdata.append("action", "fillstate");
    ajaxrequest("POST",endpointurl+'master',formdata,headersdata,Onsuccessmfillstate,OnErrormfillstate);
    function Onsuccessmfillstate(content)
    {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#mcitymasterForm #stateid').html(resultdata.data);
        $('#mcitymasterForm #stateid').selectpicker('refresh');	
        
    }
    function OnErrormfillstate(content)
    { 
        ajaxrequest("POST",page404url,'','',OnsuccessRender,OnErrorRender);
    }
    $('#adddataModal').modal('show');
    $('#mcitymasterForm #stateid').selectpicker('refresh');
    $('#adddataModalLabel').html('Add City');
    var funname=$(this).data('funname');
    


    if($('#adddataModal #mcitymasterForm').length){		
        $('#adddataModal #mcitymasterForm').validate({
            rules:{
                city:{
                    required: true,			
                },
                stateid:{
                    required: true,			
                },
            },messages:{
                city:{
                    required:"City name is required",
                },
                stateid:{
                    required:"State is required",
                },
            },
            submitHandler: function(form){
                $('#loaderprogress').show();
                var pagename=getpagename();
                var useraction=$('#mcitymasterForm #formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertcity");
                formdata.append("formname", "#adddataModal #mcitymasterForm");
                formdata.append("funname", funname);
                var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",endpointurl+'citymaster',formdata,headersdata,OnsuccessmodalDataSubmit,OnErrorDataSubmit); 
            },
        });
    }
});


// Add area data
$('body').on('click','.addmodalarea',function(){
    var htmlform='';
    htmlform+='<form class="col-12 validate-form" id="mareamasterForm" method="post" action="">';
        htmlform+='<input type="hidden" id="formevent" name="formevent" value="addright">';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">Area Name<span class="text-danger">*</span></label>	';
                htmlform+='<label class="ml-auto "></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<input type="text" class="form-control" placeholder="Area Name" id="area" name="area" require>';
            htmlform+='</div>';
        htmlform+='</div>';
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">State <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<select class="form-control selectpicker" data-live-search="true" id="stateid" name="stateid" data-size="10" data-dropup-auto="false">';
                htmlform+='</select>';
            htmlform+='</div>';
        htmlform+='</div>';
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">District <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<select class="form-control selectpicker" data-live-search="true" id="districtid" name="districtid" data-size="10" data-dropup-auto="false">';
                htmlform+='</select>';
            htmlform+='</div>';
        htmlform+='</div>';
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group">';
                htmlform+='<label class="mb-1">City <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3">';
                htmlform+='<select class="form-control selectpicker" data-live-search="true" id="cityid" name="cityid" data-size="10" data-dropup-auto="false">';
                htmlform+='</select>';
            htmlform+='</div>';
        htmlform+='</div>';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="ml-auto ">';
                htmlform+='<div class="mb-0 text-right">';
                    htmlform+='<button type="submit" id="btnusertypesubmit" class="btn btn-primary m-0 ml-2">'+btnsave+'</button>';
                htmlform+='</div>';
            htmlform+='</div>';
            
        htmlform+='</div>';
    htmlform+='</form>';

    $('#adddataForm').html(htmlform);
    
    var pagename=getpagename();
    var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
    formdata = new FormData();
    formdata.append("action", "fillstate");
    ajaxrequest("POST",endpointurl+'master',formdata,headersdata,Onsuccessmfillstate,OnErrormfillstate);
    function Onsuccessmfillstate(content)
    {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#mareamasterForm #stateid').html(resultdata.data);
        $('#mareamasterForm #stateid').selectpicker('refresh');	
        fillmareadistrict();
    }
    function OnErrormfillstate(content)
    { 
        ajaxrequest("POST",page404url,'','',OnsuccessRender,OnErrorRender);
    }
    $('#adddataModal').modal('show');
    $('#mareamasterForm #stateid').selectpicker('refresh');
    $('#adddataModalLabel').html('Add Area');
    var funname=$(this).data('funname');
    $('body').on('change','#mareamasterForm #stateid', function () {
        fillmareadistrict();
    });

    function fillmareadistrict()
    {
        var stateid=$('#mareamasterForm #stateid').val();
        if(stateid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "filldistrict");
            formdata.append("stateid", stateid);
            ajaxrequest("POST",endpointurl+'master',formdata,headersdata,Onsuccessfillmareadistrict,OnErrorfillmareadistrict);
        }
        else
        {
            $('#mareamasterForm #districtid').html('');
            $('#mareamasterForm #districtid').selectpicker('refresh');	
        }
    }
    function Onsuccessfillmareadistrict(content)
    {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        if(resultdata.status==1)
        {
            $('#mareamasterForm #districtid').html(resultdata.data);
            $('#mareamasterForm #districtid').selectpicker('refresh');	
            fillareacity();
        }
        else
        {
            $('#mareamasterForm #districtid').html('');
            $('#mareamasterForm #districtid').selectpicker('refresh');
            $('#mareamasterForm #cityid').html('');
            $('#mareamasterForm #cityid').selectpicker('refresh');	
        }
    }
    function OnErrorfillmareadistrict(content)
    { 
        ajaxrequest("POST",page404url,'','',OnsuccessRender,OnErrorRender);
    }

    $('body').on('change','#districtid', function () {
        fillareacity();
    });

    function fillareacity()
    {
        var districtid=$('#mareamasterForm #districtid').val();
        if(districtid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillcity");
            formdata.append("districtid", districtid);
            ajaxrequest("POST",endpointurl+'master',formdata,headersdata,Onsuccessfillareacity,OnErrorfillareacity);
        }
        else
        {
            $('#mareamasterForm #cityid').html('');
            $('#mareamasterForm #cityid').selectpicker('refresh');	
        }
    }
    function Onsuccessfillareacity(content)
    {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        if(resultdata.status==1)
        {
            $('#mareamasterForm #cityid').html(resultdata.data);
            $('#mareamasterForm #cityid').selectpicker('refresh');	
        }
        else
        {
            $('#mareamasterForm #cityid').html('');
            $('#mareamasterForm #cityid').selectpicker('refresh');	
        }
    }
    function OnErrorfillareacity(content)
    { 
        ajaxrequest("POST",page404url,'','',OnsuccessRender,OnErrorRender);
    }
    
    

    if($('#adddataModal #mareamasterForm').length){		
        $('#adddataModal #mareamasterForm').validate({
            rules:{
                area:{
                    required: true,			
                },
                cityid:{
                    required: true,			
                },
                stateid:{
                    required: true,			
                },
                districtid:{
                    required: true,			
                }
            },messages:{
                area:{
                    required:"Area is required",
                },
                cityid:{
                    required:"City is required",
                },
                stateid:{
                    required:"State is required",
                },
                districtid:{
                    required:"District is required",
                }
            },
            submitHandler: function(form){
                $('#loaderprogress').show();
                var pagename=getpagename();
                var useraction=$('#mareamasterForm #formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertarea");
                formdata.append("funname", funname);
                formdata.append("formname", "#adddataModal #mareamasterForm");
                var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",endpointurl+'areamaster',formdata,headersdata,OnsuccessmodalDataSubmit,OnErrorDataSubmit); 
            },
        });
    }
});


//Add Religion Data
$('body').on('click','.addmodalreligion',function(){
    var htmlform='';
    htmlform+='<form class="col-12 validate-form" id="mreligionmasterForm" method="post" action="">';
        htmlform+='<input type="hidden" id="formevent" name="formevent" value="addright">';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group mb-0">';
                htmlform+='<label class="mb-1">Religion <span class="text-danger">*</span></label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3 mb-lg-3">';
                htmlform+='<input type="text" class="form-control" placeholder="Religion" id="religion" name="religion">';
            htmlform+='</div>';
        htmlform+='</div>';
        htmlform+='<div class="col-12">';
            htmlform+='<div class="input-group mb-0">';
                htmlform+='<label class="mb-1">Description </label>';
            htmlform+='</div>';
            htmlform+='<div class="input-group mb-3 mb-sm-3">';
                htmlform+='<textarea type="text" class="form-control" placeholder="Description" id="description" name="description" rows="4"></textarea>';
            htmlform+='</div>';
        htmlform+='</div>';
       
        htmlform+='<div class="col-12">';
            htmlform+='<div class="ml-auto ">';
                htmlform+='<div class="mb-0 text-right">';
                    htmlform+='<button type="submit" id="btnusertypesubmit" class="btn btn-primary m-0 ml-2">'+btnsave+'</button>';
                htmlform+='</div>';
            htmlform+='</div>';
            
        htmlform+='</div>';
    htmlform+='</form>';

    $('#adddataForm').html(htmlform);
    $('#adddataModal').modal('show');
    $('#adddataModalLabel').html('Add Religion');
    var funname=$(this).data('funname');
    if($('#adddataModal #mreligionmasterForm').length){		
        $('#adddataModal #mreligionmasterForm').validate({
            rules:{
                religion:{
                    required: true,			
                },
            },messages:{
                religion:{
                    required:"Religion is required",
                },
            },
            submitHandler: function(form){
                $('#loaderprogress').show();
                var pagename=getpagename();
                var useraction=$('#mreligionmasterForm #formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertreligionmaster");
                formdata.append("funname", funname);
                formdata.append("formname", "#adddataModal #mreligionmasterForm");
                var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false};
                ajaxrequest("POST",endpointurl+'religionmaster',formdata,headersdata,OnsuccessmodalDataSubmit,OnErrorDataSubmit); 
            },
        });
    }
});

function OnsuccessmodalDataSubmit(data)
{
    var JsonData = JSON.stringify(data);
    var resultdata = jQuery.parseJSON(JsonData);
    
    $('#loaderprogress').hide();	
    if(resultdata.status==0)
    {
        alertify(resultdata.message,0);
    }
    else if(resultdata.status==1)
    {
        alertify(resultdata.message,1);
        $(resultdata.formname).validate().resetForm();
        $(resultdata.formname).trigger("reset");
        $('#adddataModal').modal('hide');
       window[resultdata.funname]();
    }
}




