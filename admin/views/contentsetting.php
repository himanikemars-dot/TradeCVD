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
                            <form class="text-left validate-form" id="contentsettingForm" method="post" action="contentsetting" enctype="multipart/form-data">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-10 offset-1">
                                            <div class="input-group">
                                                <label class="mb-1">Content Type <span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select class="form-control selectpicker" name="contenttypeid" id="contenttypeid" data-size="8" data-dropup-auto="false" data-live-search="true">
                                                    <option value="">Select Content Type</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 TitleDiv d-none">
                                            <div class="input-group">
                                                <label class="mb-1">Title<span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Title" id="title" name="title" require>
                                            </div>
                                        </div>
                                        <div class="col-5  offset-1 ImgDiv d-none">
                                            <div class="input-group">
                                                <label class="mb-1">Upload Image</label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3 mb-lg-3">
                                                <div class="filepreview">
                                                    <input class="form-control" type="file" name="img" id="img" accept="image/*">
                                                    <label class="filepreviewbg" for="img">
                                                        <img class="d-none filepreviewimg" id="filepreviewimg" src="assets/img/logo-white.png">
                                                    </label>
                                                </div>
                                                <span style="color:#B00" class="imgsizelbl2">** Please upload image in JPG,JPEG,PNG Format size 1920 X 1280</span>
                                                <p class="imgerr" style="color:#f00;font-weight: bold;"></p>
                                            </div>
                                        </div>
                                        <div class="col-3  offset-1 ImgDiv d-none">
                                            <div class="input-group mb-3 mb-lg-3">
                                                <img src="" class="mt-1 mb-3" id="imgpreview" class="d-none" style="height: 100px; max-width: 100%;background-color: #cce4e72e;" />
                                                <p class="img-remove"></p>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 descrDiv">
                                            <div class="input-group">
                                                <label class="mb-1">Description <span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <textarea id="contentdescr" name="contentdescr" class="form-control"></textarea>
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
        $('#contentsettingForm #contentdescr').froalaEditor();
        fillcontenttype();
        $('#sbcolor').css('background-color', '#FFFFFF');
        img.onchange = evt => {
            const [file] = img.files
            if (file) {
                filepreviewimg.src = URL.createObjectURL(file);
                var imgurlimg = $('#filepreviewimg').attr('src');

                $("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url(" + imgurlimg + ")");
            }
            else
            {
                $("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url('')");
            }
        }
    });


    function resetdata() {
        $("#contentsettingForm").validate().resetForm();
        $('#contentsettingForm').trigger("reset");
        $('#sbcolor').css('background-color', '#FFFFFF');
        Edittimeformnamechange(2);
        fillcontenttype();
        contentsettingtypewise();
        $('#imgpreview').addClass('d-none');
        $('.img-remove').addClass('d-none');
    }

    function fillcontenttype() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'viewright',
            masterlisting: true,
            responsetype: 'HTML'
        };
        formdata = new FormData();
        formdata.append("action", "fillcontenttype");
        formdata.append("selectoption", 0);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillcontenttype, OnErrorSelectpicker);
    }

    function Onsuccessfillcontenttype(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#contenttypeid').html(resultdata.data);
        $('#contenttypeid').selectpicker('refresh');
        fillcontent()
    }

    function contentsettingtypewise()
    {
        var contenttypeid=$('#contenttypeid option:selected').attr('data-typeid');
        $('.TitleDiv').addClass('d-none');
        $('.ImgDiv').addClass('d-none');
        if(contenttypeid==5 || contenttypeid==13 || contenttypeid==14)
        {
            $('.TitleDiv').removeClass('d-none');
            $('.ImgDiv').removeClass('d-none');
        }
        else if(contenttypeid==18 || contenttypeid==19  || contenttypeid==23 || contenttypeid==24)
        {
            $('.TitleDiv').removeClass('d-none');
        }
        else if(contenttypeid==20)
        {
            $('.ImgDiv').removeClass('d-none');
        }
        

    }


    $('body').on('change', '#contenttypeid', function() {
        contentsettingtypewise();
        fillcontent();
    });

    //Fill content
    function fillcontent() {
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
        formdata.append("action", "fillcontent");
        formdata.append("contenttypeid", contenttypeid);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillcontent, OnErrorfillcontent);
    }

    function Onsuccessfillcontent(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        if(resultdata.status==1)
        {
            var contenttypeid = resultdata.contenttypeid;
            $('#contentsettingForm  #contentdescr').froalaEditor('html.set', resultdata.description);
            $('#contentsettingForm #title').val(resultdata.title);
            $('#imgpreview').addClass('d-none');
            $('.img-remove').addClass('d-none');
            if(resultdata.img!='')
            {
                $('.img-remove').removeClass('d-none');
                $('.img-remove').html('<a href="javascript:void(0);" class="remove-img" data-id="' + resultdata.id + '">Remove</a>');
                $('#imgpreview').removeClass('d-none');
                $('#imgpreview').attr('src',resultdata.imgurl);
            }
        }
        else if(resultdata.status==0)
        {
            $('#contentsettingForm  #contentdescr').froalaEditor('html.set','');
            $('#imgpreview').addClass('d-none');
            $('#imgpreview').attr('src', '');
            $('.img-remove').addClass('d-none');
            $('#bannersettingForm  #contentdescr').val('');
            $('#bannersettingForm #title').val('');
        }    


    }

    function OnErrorfillcontent(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }


    $('body').on('click', '.remove-img', function() {
        var id = $(this).attr('data-id');
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false
        };
        formdata = new FormData();
        formdata.append("action", "removeimage");
        formdata.append("id", id);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessremoveimage, OnErrorremoveimage);

    });


    function Onsuccessremoveimage(data) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        if (resultdata.status == 0) {
            alertify(resultdata.message, 0);
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, 1);

            $('#imgpreview').attr('src', '');
            $('.img-remove').addClass('d-none');
        }
    }

    function OnErrorremoveimage(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }


    if ($('#contentsettingForm').length) {
        $('#contentsettingForm').validate({
            rules: {
                contenttypeid: {
                    required: true,
                },
            },
            messages: {
                contenttypeid: {
                    required: "Content type is required",
                },
            },
            submitHandler: function(form) {
                $('#loaderprogress').show();
                var descr = $('#contentdescr').froalaEditor('html.get')
                var pagename = getpagename();
                formdata = new FormData(form);

                formdata.append("action", "insertcontentsetting");
                formdata.append("descr",descr);
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 1,
                    userpagename: pagename,
                    useraction: 'addright',
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, OnsuccessContentSettingDataSubmit, OnErrorContentSettingDataSubmit)

            },
        });
    }

    function OnsuccessContentSettingDataSubmit(data) {
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#loaderprogress').hide();
        if (resultdata.status == 0) {
            alertify(resultdata.message, '0');
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, '1');
            fillcontent();
        }
    }

    function OnErrorContentSettingDataSubmit(data) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }
</script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->