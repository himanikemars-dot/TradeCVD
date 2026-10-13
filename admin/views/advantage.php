<?php
require_once dirname(__DIR__, 1) . '/config/init.php';

?>

<div class="layout-px-spacing">

    <!-- CONTENT AREA -->
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12 mb-3">
                    <div class="widget">
                        <div class="widget-content">
                            <form class="text-left validate-form" id="advantageForm" method="post" action="advantage" enctype="multipart/form-data">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-10 offset-1 ">
                                            <div class="input-group">
                                                <label class="mb-1">Title<span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Title" id="title" name="title" require>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 descrDiv">
                                            <div class="input-group">
                                                <label class="mb-1">Description <span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <textarea id="descr" name="descr" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-1 col-5  ">
                                            <div class="input-group">
                                                <label class="mb-1">Heading 1<span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Heading 1" id="heading1" name="heading1" require>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-group">
                                                <label class="mb-1">Heading 2<span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Heading 2" id="heading2" name="heading2" require>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 offset-1 layout-spacing " id="abtDiv">
                                    <div class="widget mt-10">
                                        <div class="widget-content row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-offset-1 col-3">
                                                        <h4 class="">Advantage Detail</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                   
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Title <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Title" id="dettitle" name="dettitle">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Display Order <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Display Order" id="detdisplayorder" name="detdisplayorder" onkeypress="numbonly(event)" onpaste="numbonly(event)" require>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Heading 1 Description <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <textarea id="description1" name="description1" class="form-control" placeholder="Heading 1 Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Heading 2 Description <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <textarea id="description2" name="description2" class="form-control" placeholder="Heading 2 Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mt-4 mb-auto">
                                                        <button type="button" class="col-auto btn btn-primary m-0" id="btnadddetail" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add "><i class="bi bi-plus-lg"></i></button>
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
                                                                        <th class="tbl-name">Title</th>
                                                                        <th class="tbl-name">Display Order</th>
                                                                        <th class="tbl-name">Heading 1 Description</th>
                                                                        <th class="tbl-name">Heading 2 Description</th>
                                                                        <th class="tbl-action">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbldescdetail">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if ((($rightstotalcount) > 0 ? $Pagerights->getAddright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
                                {
                                ?>
                                    <div class="row col-10 offset-1">
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
    <!-- CONTENT AREA -->
</div>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker('refresh');
        $('#advantageForm #descr').froalaEditor();
        filladvantagedetail();
       
    });


    function resetdata() {
        $("#advantageForm").validate().resetForm();
        $('#advantageForm').trigger("reset");
        $('#tbldescdetail').html('');
        Edittimeformnamechange(2);
        filladvantagedetail();
    }

  
    //Fill content
    function filladvantagedetail() {
        var contenttypeid = $('#contenttypeid').val();
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'viewright',
            masterlisting: true
        };

        formdata = new FormData();
        formdata.append("action", "filladvantagedetail");

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfilladvantagedetail, OnErrorfilladvantagedetail);
    }

    function Onsuccessfilladvantagedetail(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        if(resultdata.status==1)
        {
            $('#advantageForm  #descr').froalaEditor('html.set', resultdata.description);
            $('#advantageForm #title').val(resultdata.title);
            $('#advantageForm #heading1').val(resultdata.heading1);
            $('#advantageForm #heading2').val(resultdata.heading2);
            var tbldata='';
            for(var i in resultdata.result)
            {
                var trtmp=parseInt(i)+1;
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+resultdata.result[i].title+'<input type="hidden" name="tbltitle[]" id="tbltitle'+trtmp+'" value="'+resultdata.result[i].title+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.result[i].displayorder+'<input type="hidden" name="tbldisplayorder[]" id="tbldisplayorder'+trtmp+'" value="'+resultdata.result[i].displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.result[i].description1+'<input type="hidden" name="tbldescription1[]" id="tbldescription1'+trtmp+'" value="'+resultdata.result[i].description1+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.result[i].description2+'<input type="hidden" name="tbldescription2[]" id="tbldescription2'+trtmp+'" value="'+resultdata.result[i].description2+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblrow" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';
            }
            $('#tbldescdetail').html(tbldata);
            
        }
        else if(resultdata.status==0)
        {
            $('#advantageForm  #descr').froalaEditor('html.set', '');
            $('#bannersettingForm  #descr').val('');
            $('#bannersettingForm #title').val('');
            $('#advantageForm #heading1').val('');
            $('#advantageForm #heading2').val('');
            $('#tbldescdetail').html('');
        }    


    }

    function OnErrorfilladvantagedetail(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }
    $('body').on('click','#removetblrow', function () {            
        // $(this).parent().parent().remove();
        var thiss = $(this);
		swal({
		  title: "",
		  text: "Are you sure?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#399BFF",
		  confirmButtonText: "OK",
		  closeOnConfirm: true
		},
		function()
		{
						
			alertify('Removed Successfully', 'success');
			thiss.parent().parent().remove();	
			
		});
    });

    

    if ($('#advantageForm').length) {
        $('#advantageForm').validate({
            rules: {
                title: {
                    required: true,
                },
                heading1: {
                    required: true,
                },
                heading2: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required: "Title is required",
                },
                heading1: {
                    required: "Heading 1 is required",
                },
                heading2: {
                    required: "Heading 2 is required",
                },
            },
            submitHandler: function(form) {
                $('#loaderprogress').show();
                var rownumber=$('#tbldescdetail tr').length;
                if(rownumber>0)
                {
                    var descr = $('#descr').froalaEditor('html.get');
                    if(descr)
                    {
                        var pagename = getpagename();
                        formdata = new FormData(form);

                        formdata.append("action", "insertadvantage");
                        formdata.append("descr",descr);
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 1,
                            userpagename: pagename,
                            useraction: 'addright',
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, OnsuccessadvantageDataSubmit, OnErroradvantageDataSubmit);
                    }else{
                        alertify('Please fill Description',0);
                    }
                }else{
                    alertify('Please add advantage detail',0);
                }

            },
        });
    }

    function OnsuccessadvantageDataSubmit(data) {
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#loaderprogress').hide();
        if (resultdata.status == 0) {
            alertify(resultdata.message, '0');
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, '1');
            filladvantagedetail();
        }
    }

    function OnErroradvantageDataSubmit(data) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }


    $('body').on('click', '#btnadddetail', function(){
        var title = $('#dettitle').val();
        var displayorder = $('#detdisplayorder').val();
        var description1 = $('#description1').val();
        var description2 = $('#description2').val();

        if(title && description1 && description2 && displayorder)
        {
            $("#tbldescdetail tr").each(function(){
                var trtmp = $(this).attr('data-index');
                var tbltitle = $('#tbltitle'+trtmp).val();

                if(tbltitle == title)
                {
                    $(this).remove();
                }
            });
            
            var trtmp = $('#tbldescdetail tr:last').attr('data-index') | 0;
            trtmp = parseInt(trtmp+1);

            var tbldata="";	
            tbldata+='<tr data-index="'+trtmp+'">';
            tbldata+='<td class="tbl-name">'+title+'<input type="hidden" name="tbltitle[]" id="tbltitle'+trtmp+'" value="'+title+'" /></td>';
            tbldata+='<td class="tbl-name">'+displayorder+'<input type="hidden" name="tbldisplayorder[]" id="tbldisplayorder'+trtmp+'" value="'+displayorder+'" /></td>';
            tbldata+='<td class="tbl-name">'+description1+'<input type="hidden" name="tbldescription1[]" id="tbldescription1'+trtmp+'" value="'+description1+'" /></td>';
            tbldata+='<td class="tbl-name">'+description2+'<input type="hidden" name="tbldescription2[]" id="tbldescription2'+trtmp+'" value="'+description2+'" /></td>';
            tbldata+='<td class="tbl-action">';
            tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblrow" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
            tbldata+='</td>';
            tbldata+='</tr>';

            $('#tbldescdetail').append(tbldata);
            $('#dettitle').val('');
            $('#description1').val('');
            $('#description2').val('');
            $('#detdisplayorder').val('');
        }
        else
        {
            alertify('Please fill in all required fields',0);
        }
    })

</script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->