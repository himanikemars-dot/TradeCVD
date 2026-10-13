<script>
    /************** UPLOAD DIAMOND CSV *********************/

    function fillcontentsetting() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: '',
            masterlisting: false
        };

        formdata = new FormData();
        formdata.append("action", "listcontentsetting");
        formdata.append("typeid", 26);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + 'contentsetting', formdata, headersdata, Onsuccessfillcontentsetting, OnErrorfillcontentsetting);
    }

    function Onsuccessfillcontentsetting(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        var htmldata = '';
        if (resultdata.status == 0) {
            htmldata += '<div class="col-exs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 text-center" >';
            htmldata += '<h3>No Data Found!</h3>';
            htmldata += '</div>';
            $('#diamondcsvuploaddetail').html(htmldata);
        } else if (resultdata.status == 1) {
            $('#diamondcsvuploaddetail').html(resultdata.result[0].description);
        }

    }

    function OnErrorfillcontentsetting(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }

    function getselectedfilename() {
        var isfileselected = 0;
        $('#btndiamondcsvupload').attr('disabled', true);
        $('#form-diamond-csv-upload .selectedfilenameText').html('No File Selected.');
        var filename = $('#diamondcsvfile').val().replace(/C:\\fakepath\\/i, '');
        if (filename != '' && filename != null) {
            $('#form-diamond-csv-upload .selectedfilenameText').html(filename);
            $('#btndiamondcsvupload').attr('disabled', false);
            isfileselected = 1;
        }
        return isfileselected;
    }
    $("#diamondcsvfile").change(function() {
        getselectedfilename();
    });

    if ($('#form-diamond-csv-upload').length) {
        $('#form-diamond-csv-upload').validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function(form) {

                var isfileselected = getselectedfilename();
                if (isfileselected > 0) {

                    // showloader();
                    $('.chart-loading').show();
                    $('#btndiamondcsvupload').attr('disabled', true);
                    var pagename = getpagename();
                    var useraction = $('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "uploaddiamondcsv");
                    var headersdata = {
                        'Accept': 'application/json',
                        platform: 4,
                        userpagename: pagename,
                        useraction: useraction,
                        masterlisting: false
                    };
                    ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessuploaddiamondcsv, OnErroruploaddiamondcsv)

                    function Onsuccessuploaddiamondcsv(data) {
                        // hideloader();
                        $('.chart-loading').hide();
                        var JsonData = JSON.stringify(data);
                        var resultdata = jQuery.parseJSON(JsonData);
                        if (resultdata.IsPackageExpire == 1) {
                            Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
                        }
                        else{ 
                            if (resultdata.status == 0) {
                                Notiflix.Notify.Failure(resultdata.message);

                            } else if (resultdata.status == 1) {
                                Notiflix.Notify.Success(resultdata.message);
                                resetdiamondcsvupload();

                            }else if(resultdata.status == -1)
                            {
                                $('#btnlogout').trigger('click');
                            }
                        }   

                    }

                    function OnErroruploaddiamondcsv(content) {

                    }

                } else {
                    alertify('Please select csv file', 0);
                }


            },
        });
    }

    function resetdiamondcsvupload() {
        $("#form-diamond-csv-upload").validate().resetForm();
        $('#form-diamond-csv-upload').trigger("reset");
        getselectedfilename();
    }
    $('#btnresetdiamondcsvupload').click(function() {
        resetdiamondcsvupload();
    });

    // $(".uploadonenext").click(function() {
    //     $(".uploadfir").hide();
    // });
    // $(".uploadonenext").click(function() {
    //     $(".uploadtwo").show();
    // });


    // $(".uploadtw").click(function() {
    //     $(".uploadtwo").hide();
    // });
    // $(".uploadtw").click(function() {
    //     $(".uploadth").show();
    // });

    // $(".uploadthr").click(function() {
    //     $(".uploadth").hide();
    // });
    // $(".uploadthr").click(function() {
    //     $(".uploadfour").show();
    // });

    // $(".uploadfo").click(function() {
    //     $(".uploadfour").hide();
    // });
    // $(".uploadfo").click(function() {
    //     $(".uploadfi").show();
    // });


    

   

    

    function liststate(stateid = '', editcountryid = '') {

        var countryid = $('#countryid').val();
        if (editcountryid) {
            countryid = editcountryid;
        }
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "liststate");

        formdata.append("countryid", countryid);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccessliststate, OnErrorliststate);

        function Onsuccessliststate(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            htmldata += '<option value="">Select State</option>';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                if (resultdata.data) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {
                            htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                        }
                    }
                }

            }
            $('#stateid').html(htmldata);
            if (stateid) {
                $('#stateid').val(stateid);
            }
            //console.log(htmldata);
            $('#stateid').select2();

        }

        function OnErrorliststate(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    

    /* UPLOAD DIAMOND DATA */

    if ($('#form-diamond-upload').length) {
        $('#form-diamond-upload').validate({
            ignore: [],
            invalidHandler: function() {
                setTimeout(function() {
                    //$('.uploaddiamondtabs .tab-link a small.required').remove();
                    $('.uploaddiamondtabs .tab-link').removeClass('errortabbg');
                    var validatePane = $('.tab-content .tab-pane:has(input.error,select.error)').each(function() {
                        var id = $(this).attr('id');
                        //$('.uploaddiamondtabs .tab-link').find('a[href^="#' + id + '"]').append(' <small class="required">***</small>');
                        $('.uploaddiamondtabs .tab-link').find('a[href^="#' + id + '"]').parent().addClass('errortabbg');
                    });
                });            
            },
            rules: {
                stock: {
                    required: true
                },
                price: {
                    required: true,
                    number: true
                },
                shapeid: {
                    required: true,
                },
                // size: {
                //     required: true,
                //     number: true
                // },
                colorid: {
                    required: true,
                },
                clarityid: {
                    required: true,
                },
            },
            messages: {
                stock: {
                    required: 'Stock is required',
                },
                price: {
                    required: 'Price is required',
                },
                shapeid: {
                    required: 'Shape is required',
                },
                // size: {
                //     required: 'Size is required',
                // },
                colorid: {
                    required: 'Color is required',
                },
                clarityid: {
                    required: 'Clarity is required',
                },
            },
            submitHandler: function(form) {

                // showloader();
                //alert();
                $('.uploaddiamondtabs .tab-link').removeClass('errortabbg');
                $('#btnsavediamond').attr('disabled',true);
                $('.chart-loading').show();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "uploaddiamond");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessuploaddiamond, OnErroruploaddiamond)

                function Onsuccessuploaddiamond(data) {
                    // hideloader();
                    $('.chart-loading').hide();
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);
                    $('#btnsavediamond').attr('disabled',false);
                    if (resultdata.IsPackageExpire == 1) {
                        Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
                    }
                    else{ 
                        if (resultdata.status == 0) {
                            Notiflix.Notify.Failure(resultdata.message);
                        } else if (resultdata.status == 1) {
                            Notiflix.Notify.Success(resultdata.message);
                            $('.searchmydiamondlistDiv').html('');
                            checkmydiamondformelementvalue();
                            $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                            $('#v-pills-3-tab').click();
                            resetdiamonduploadform();

                        }else if(resultdata.status == -1)
                        {
                            $('#btnlogout').trigger('click');
                        }
                    } 

                }

                function OnErroruploaddiamond(content) {

                }
                

            },
        });
    }

    function resetdiamonduploadform() {
        $("#form-diamond-upload").validate().resetForm();
        $('#form-diamond-upload').trigger("reset");
        $('#form-diamond-upload .select2').select2();
        $('#form-diamond-upload #formevent').val('submit');
        $('.diamonduploadesirmodetext').html('Upload');
        $('#form-diamond-upload #id').val('');
        $('#form-diamond-upload #btnsavediamond').html('Save');
        $('.uploaddiamondtabs li').attr('disabled', true);
        $('.uploaddiamondtabs li').addClass('disabled');
        $('.uploaddiamondtabs li a').addClass('disabled');
        $('.uploaddiamondtabs li a').attr('disabled', true);
        openprvioustab('generalinfoDiv');
        checkfancycolorflag();
        checkmatchpairflag();
        checkisparcelflag();
       
    }
    
    $('#btnresetdiamondupload').on('click', function() {
        resetdiamonduploadform();
    });

    


    function openprvioustab(prevtab) {
        $('.uploaddiamondtabs .li' + prevtab).addClass('active');
        $('.uploaddiamondtabs .li' + prevtab + ' a').click();
        var type = $('.uploaddiamondtabs .li' + prevtab).attr('data-tab');

        $('.uploaddiamondtabs .li' + prevtab).attr('disabled', false);
        $('.uploaddiamondtabs .li' + prevtab).removeClass('disabled');
        $('.uploaddiamondtabs .li' + prevtab + ' a').removeClass('disabled');
        $('.uploaddiamondtabs .li' + prevtab + ' a').attr('disabled', false);
        if (type == 1) {
            $('.uploaddiamondtabs .lireportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        } else if (type == 2) {
            $('.uploaddiamondtabs .liotherinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        } else if (type == 3) {
            $('.uploaddiamondtabs .liimgreportinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').removeClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        } else if (type == 4) {
            $('.uploaddiamondtabs .liadditionalinfoDiv').removeClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').removeClass('active');
        }
    }

   

    function opennexttab(nexttab) {


        // $('.uploaddiamondtabs .li'+nexttab).addClass('active');
        // $('.uploaddiamondtabs .li'+nexttab+' a').click();

        var type = $('.uploaddiamondtabs .li' + nexttab).attr('data-tab');
        // //console.log(type);
        $("#nav-tabContent-DiamondUploadFormDiv .tab-pane").each(function() {
            $(this).removeClass('active');
        });

        $('.uploaddiamondtabs .li' + nexttab).attr('disabled', false);
        $('.uploaddiamondtabs .li' + nexttab).removeClass('disabled');
        $('.uploaddiamondtabs .li' + nexttab + ' a').removeClass('disabled');
        $('.uploaddiamondtabs .li' + nexttab + ' a').attr('disabled', false);

        if (type == 1) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');
            $('#nav-tabContent-DiamondUploadFormDiv #generalinfoDiv').addClass('active');

        } else if (type == 2) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');


            $('#nav-tabContent-DiamondUploadFormDiv #reportinfoDiv').addClass('active');
        } else if (type == 3) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').addClass('active');

            $('#nav-tabContent-DiamondUploadFormDiv #otherinfoDiv').addClass('active');
        } else if (type == 4) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').addClass('active');

            $('#nav-tabContent-DiamondUploadFormDiv #imgreportinfoDiv').addClass('active');
        } else if (type == 5) {
            $('.uploaddiamondtabs .ligeneralinfoDiv').addClass('active');
            $('.uploaddiamondtabs .ligeneralinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .lireportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .lireportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liotherinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liotherinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liimgreportinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liimgreportinfoDiv a').addClass('active');

            $('.uploaddiamondtabs .liadditionalinfoDiv').addClass('active');
            $('.uploaddiamondtabs .liadditionalinfoDiv a').addClass('active');

            $('#nav-tabContent-DiamondUploadFormDiv #additionalinfoDiv').addClass('active');
        }

    }

    function checkgeneralinfofields() {
        var stock = $('#stock').val();
        var price = $('#price').val();
        var savanipercentage=$('#savanipercentage').val();
        var totalprice=$('#totalprice').val();

        var sieveid=$('#sieveid').val();
        var tosieveid=$('#tosieveid').val();
        var numofdiamond=$('#numofdiamond').val();

        var fromsievename=$('#fromsievename').val();
        var tosievename=$('#tosievename').val();

        $('#generalinfoDiv input[type=text].requiredfield').each(function(){
            console.log($(this).attr('id'));
            var id = $(this).attr('id');
            var inputval = $('#'+id).val();
            if(!inputval)
            {
                $('.'+id+'-requiredfield').html('<b class="text-danger">Required *</b>');
                // $('#'+id).effect("shake", { times:3 }, 300);
            }
            else{
                $('.'+id+'-requiredfield').html('*');
            }
        });
        $('#generalinfoDiv select.requiredfield').each(function(){
            console.log($(this).attr('id'));
            var id = $(this).attr('id');
            var selectval = $('#'+id).val();
            if(!selectval)
            {
                $('.'+id+'-requiredfield').html('<b class="text-danger">Required *</b>');
                // $('#'+id).effect("shake", { times:3 }, 300);
            }
            else{
                $('.'+id+'-requiredfield').html('*');
            }
        });

        var isparcel=0;
        if($('#isparcel').prop('checked')==true){
            isparcel=1;
        }

        var isvalid = 0;
        if (stock && price && totalprice) {
            if(isparcel==1)
            {
                if(((sieveid && tosieveid) || (fromsievename &&tosievename)) && numofdiamond){
                    isvalid = 1;
                }
            }
            else{
                isvalid = 1;
            }
        }
        return isvalid;
    }

   

    function checkreportinfofields() {
        var shapeid = $('#shapeid').val();
        var size = $('#size').val();
        // var sieveid = $('#sieveid :selected').val();
        var colorid = $('#colorid').val();
        var clarityid = $('#clarityid').val();

        $('#reportinfoDiv select.requiredfield').each(function(){
            // console.log($(this).attr('id'));
            var id = $(this).attr('id');
            var selectval = $('#'+id).val();
            if(!selectval)
            {
                $('.'+id+'-requiredfield').html('<b class="text-danger">Required *</b>');
                // $('#'+id).effect("shake", { times:3 }, 300);
            }
            else{
                $('.'+id+'-requiredfield').html('*');
            }
        });

        var isvalid = 0;
        //&& (size || sieveid )
        if (shapeid  && colorid && clarityid) {
            isvalid = 1;
        }
        return isvalid;
    }

    


    

    function checkfancycolorflag() {
        if ($('#withfancycolor').prop('checked') == true) {
            $('.withfancycolorData').attr('disabled', false);
            $('.withfancycolorData').removeClass('disabled');
            $('.withfancycolorData').val(null).trigger('change');
        } else {
            $('.withfancycolorData').attr('disabled', true);
            $('.withfancycolorData').addClass('disabled');
            $('.withfancycolorData').val(null).trigger('change');
        }
    }


    function checkmatchpairflag() {
        if ($('#matchedpair').prop('checked') == true) {
            $('.matchedpairData').attr('disabled', false);
            $('.matchedpairData').removeClass('disabled');
            $('#ispairseparable').prop('checked', false);
            $('#stocknumber').val('');
        } else {
            $('.matchedpairData').attr('disabled', true);
            $('.matchedpairData').addClass('disabled');
            $('#ispairseparable').prop('checked', false);
            $('#stocknumber').val('');
        }
    }

   

    function checkisparcelflag() {
        var formevent=$('#formevent').val();
        if ($('#isparcel').prop('checked') == true) {
            $('#numofdiamond').attr('disabled', false);
            $('#numofdiamond').removeClass('disabled');
            $('#numofdiamond').val('');
            $('.frmsieveDiv').removeClass('hidden');
            $('.frmsizeDiv').addClass('hidden');
            $('#iscustomsieve').prop('checked',false);
            $('.nocustomDiv').removeClass('d-none');
            $('.customsieveDiv').addClass('d-none');
            $('#fromsievename').val('');
            $('#tosievename').val('');
            $('#size').val('');
        } else {
            $('#numofdiamond').attr('disabled', true);
            $('#numofdiamond').addClass('disabled');
            $('#numofdiamond').val('');
            $('.frmsieveDiv').addClass('hidden');
            $('.frmsizeDiv').removeClass('hidden');
            $('#sieveid').val('');
            $('#sieveid').select2();
            $('#tosieveid').val('');
            $('#tosieveid').select2();
            $('#iscustomsieve').prop('checked',false);
            $('.nocustomDiv').removeClass('d-none');
            $('.customsieveDiv').addClass('d-none');
            $('#fromsievename').val('');
            $('#tosievename').val('');
        }
        totalpricecalculate();
    }
    $('body').on('input','#numofdiamond,#size,#price,#savanipercentage',function(){
        totalpricecalculate();

    })

    $('body').on('change','#iscustomsieve',function(){
        if($('#isparcel').prop('checked') == true)
        {
            $('#fromsievename').val('');
            $('#tosievename').val('');
            $('.nocustomDiv').removeClass('d-none');
            $('.customsieveDiv').addClass('d-none');
            if($('#iscustomsieve').prop('checked') == true)
            {
                $('.nocustomDiv').addClass('d-none');
                $('.customsieveDiv').removeClass('d-none');
                $('#sieveid').val('');
                $('#sieveid').select2();
                $('#tosieveid').val('');
                $('#tosieveid').select2();
            }
        }
    })
    function totalpricecalculate()
    {
        if ($('#isparcel').prop('checked') == true) {
            var numofdiamond=parseFloat($('#numofdiamond').val()) || 0;
        }else{
            var numofdiamond=parseFloat($('#size').val())  || 0;
        }
        // console.log(numofdiamond);
        var price=parseFloat($('#price').val())  || 0;
        var savanipercentage=parseFloat($('#savanipercentage').val()) || 0;

        var totprice=numofdiamond*(price+(price*savanipercentage)/100);
        // console.log(totprice);
        $('#totalprice').val(totprice);
    }

    function listmydiamonddata(page, form = null,isstart=0) {

        var id = '<?php echo $id; ?>';
        // var form = $('#form-diamond-search').serialize();
        // showloader();
        $('.chart-loading').show();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#my_diamond_per_page').val();
        var sortbyid = $('#mydiamondsortbyid').val();

        var nextpage = 0;
        if ($('#listmydiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listmydiamondDatatbl').attr('data-nextpage');
        }
        if (form != null) {
            var formdata = new FormData(document.getElementById(form));
        } else {
            var formdata = new FormData();
        }
        formdata.append("action", "listdiamond");
        if(isstart==1){
            formdata.append("nextpage",1);
        }else{
            formdata.append("nextpage", parseInt(nextpage) + 1);
        }
           

        formdata.append("fltparcel", 0);
        formdata.append("fltmanagemydiamond", 1);
        formdata.append("perpage", diamond_per_page);
        formdata.append("sortbyid", sortbyid);

        if (id) {
            formdata.append("id", id);
        }
        var headersdata = {
            'Accept': 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: useraction,
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistmydiamond, OnErrorlistmydiamond)

        function Onsuccesslistmydiamond(data) {
            // hideloader();
            $('.chart-loading').hide();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
            }
            else{ 
                if (resultdata.status == 0) {

                    htmldata += '<tr>';
                    htmldata += '<td colspan="16">';
                    htmldata += '<h3>' + resultdata.message + '</h3>';
                    htmldata += '</td>';
                    htmldata += '</tr>';

                    $('.listmydiamondDataDiv #listmydiamondData').html(htmldata);
                    $('#showdiamondentries').html(0);

                    $('.listmydiamondDataDiv .totaldiamonds').html('0 Diamonds ');
                    $('.listmydiamondDataDiv .totalprice').html('Total Price : $0');


                } else if (resultdata.status == 1) {
                    $('.listmydiamondDataDiv .totalmydiamonds').html('0 Diamonds ');
                    $('.listmydiamondDataDiv .totalmyprice').html('Total Price : $0');
                    if (resultdata.totaldiamond >= 0 && resultdata.totalprice >= 0 && resultdata.totaldiamond != null && resultdata.totalprice != null) {
                        // //console.log('totaldiamond'+resultdata.totaldiamond);
                        // //console.log('totalprice'+resultdata.totalprice);
                        $('.listmydiamondDataDiv .totalmydiamonds').html(resultdata.totaldiamond + ' Diamonds ');
                        $('.listmydiamondDataDiv .totalmyprice').html('Total Price : $' + resultdata.totalprice);
                    }

                    if(resultdata.lastupdateddate!='')
                    {
                        $('.listmydiamondDataDiv .lastupdateddt').html('| Last Updated Date : ' + resultdata.lastupdateddate+' &nbsp;&nbsp;<a href="javascript:void(0)" onclick="refreshlastupdateddate(\''+resultdata.lastupdateddateid+'\')"><i class="fas fa-sync"></i></a>');
                    }
                    for (var i in resultdata.data) {
                        var diamonddata = resultdata.data[i];

                        htmldata += '<tr data-index="'+diamonddata.id+'" data-toggle="collapse" data-target="#searchdown' + diamonddata.id + '" data-index="'+diamonddata.id+'" class="sdown' + diamonddata.id + ' tbl-highlight-tr">';
                        // htmldata += '<tr data-index="'+diamonddata.id+'" >';
                        // htmldata += '<td>';
                        // // htmldata += '<div class="form-check">';
                        // // htmldata += '<input class="form-check-input sbox" type="checkbox" value="' + diamonddata.id + '" id="selectdiamondid' + diamonddata.id + '">';
                        // // htmldata += '<label class="form-check-label searchcheckbox" for="selectdiamondid' + diamonddata.id + '">';

                        // // htmldata += '</label>';
                        // // htmldata += '</div>';
                        // htmldata += '' + diamonddata.personname + '';
                        // htmldata += '</td>';
                        // htmldata+='<td>';
                        // htmldata+='<div class="searchreating">100%</div>';
                        // htmldata+='</td>';

                        htmldata+='<td class="tbl-check d-none " data-index="'+diamonddata.id+'">';
                        htmldata+='<div class="text-center">';
                        htmldata+='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
                        htmldata+='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'+diamonddata.id+'" value="'+diamonddata.id+'" name="bulkdelete[]">';
                        htmldata+='<label class="set-lable-datadelete custom-control-label mb-0" for="bulkdelete'+diamonddata.id+'"></label>';
                        htmldata+='</div>';
                        htmldata+='</div>';
                        htmldata+='</td>';
                        // htmldata += '<td class="tbl-highlight-td"><a href="javascript:void(0)" data-toggle="collapse" title="info" data-target="#searchdown' + diamonddata.id + '" data-index="'+diamonddata.id+'" class="sdown' + diamonddata.id + ' tbl-highlight-tr"><i class="fas fa-info 2x"></i></a>&nbsp;&nbsp;' + diamonddata.country + '</td>';
                        if(diamonddata.country.length > 7){
                            htmldata += '<td class="tbl-highlight-td">' + diamonddata.country.substring(0,6)+'... </td>';
                        }else{
                            htmldata += '<td class="tbl-highlight-td">' + diamonddata.country + '</td>';
                        }
                        htmldata += '<td class="tbl-highlight-td">';
                            if(diamonddata.shape.length>7)
                            {
                                htmldata += diamonddata.shape.substring(0,6)+'...';
                            }else{
                                htmldata += diamonddata.shape;
                            }
                        htmldata += '</td>';
                        if(diamonddata.isparcel==1)
                        {
                            var avgsize=((parseFloat(diamonddata.sievename) + parseFloat(diamonddata.tosievename))/2);
                            htmldata += '<td class="tbl-highlight-td">' + diamonddata.sievename + '-'+diamonddata.tosievename+'</td>';
                        }else{
                            htmldata += '<td class="tbl-highlight-td">' + diamonddata.size + '</td>';
                        }
                        htmldata += '<td class="tbl-highlight-td">';
                        if(diamonddata.withfancycolor==1)
                        {
                            var fancydetail=diamonddata.fancyintensity+','+diamonddata.overtone+','+diamonddata.fancycolor1+','+diamonddata.fancycolor2;
                            if (fancydetail.length > 7) {
                                htmldata += fancydetail.substring(0, 7) + '...';
                            } else {
                                htmldata += fancydetail;
                            }
                        }else{
                            if(diamonddata.color.length>7)
                            {
                                htmldata += diamonddata.color.substring(0,6)+'...';
                            }else{
                                htmldata += diamonddata.color;
                            }
                        }
                         htmldata += '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.clarity + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.cut + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.polish + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.symmetry + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.intensity + '</td>';
                        if(diamonddata.lab.length>7)
                        {
                            htmldata += '<td class="tbl-highlight-td">' + diamonddata.lab.substring(0,7)+'... </td>';
                        }else{
                            htmldata += '<td class="tbl-highlight-td">' + diamonddata.lab + '</td>';
                        }
                        htmldata+='<td class="tbl-highlight-td">$' + diamonddata.price + '</td>';
                        var diamper='-';
                        if(diamonddata.savanipercentage!='') {
                            // diamper='-'+diamonddata.savanipercentage+'%';
                            diamper=diamonddata.savanipercentage+'%';
                        }
                        htmldata+='<td class="tbl-highlight-td">' + diamper + '</td>';
                        // htmldata += '<td class="tbl-highlight-td">$' + parseFloat(diamonddata.price*diamonddata.size).toFixed(2) + '</td>';
                        htmldata += '<td class="tbl-highlight-td">$' + parseFloat(diamonddata.totalprice).toFixed(2) + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.depthper + '%</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.tableper + '%</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.stock + '</td>';
                        htmldata += '<td class="text-center tbl-highlight-td">';
                        if(diamonddata.isactive==1)
                        {
                            htmldata += ' Active ';
                        }else{
                            htmldata += ' Inactive ';
                        }
                        htmldata +='</td>';
                        // htmldata += '<td>';
                        // htmldata += '<a class="btn" href="javascript:void(0);" class="editmydiamond" data-diamondid="' + diamonddata.id + '"><i class="fas fa-edit"></i></a>';
                        // htmldata += '<a class="btn" href="javascript:void(0);" class="deletemydiamond" data-diamondid="' + diamonddata.id + '"><i class="fas fa-trash-alt"></i></a>';
                        // htmldata += '</td>';
                        // htmldata+='<td>G</td>';
                        // htmldata+='<td>-</td>';
                        // htmldata+='<td>1.132</td>';
                        htmldata += '</tr>';

                        htmldata += '<td class="searchPadding">';
                        htmldata += '<div class="collapse" id="searchdown' + diamonddata.id + '">';
                        htmldata += '<div class="col-12 col-md-12 searchddetail flex-detan">';
                        htmldata += '<div class="text-left searchleft">';
                        htmldata += '<div class="diamondsearch">';
                        htmldata += '<ul>';
                        htmldata += '<li>';
                        // htmldata += '<div class="starimg">';
                        // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                        // htmldata += '</div>';
                        if(diamonddata.isparcel==1)
                        {
                            htmldata += '<h4>' + diamonddata.shape + ', ' + diamonddata.sievename + '-' + diamonddata.tosievename + ' , ' + diamonddata.color + ', ' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                        }
                        else{
                            htmldata += '<h4>' + diamonddata.shape + ', ' + diamonddata.size + ' , ' + diamonddata.color + ', ' + diamonddata.clarity + ', ' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';

                        }
                        htmldata += '</li>';
                        // htmldata += '<li><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
                        // htmldata += '<li>' + diamonddata.availability + '</li>';
                        // htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                        if (diamonddata.reportfilelink != '') {
                            htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                        }
                        htmldata += '</ul>';
                        // htmldata += '<h3>'+diamonddata.lab+', '+diamonddata.reportnumber+'</h3>';
                        // // if(diamonddata.reportfilelink!='')
                        // // {
                        //     htmldata += '<a href="'+diamonddata.reportfilelink+'" target="_blank">Report Link</a>';
                        // // }


                        htmldata += '</div>';
                        // htmldata+='<div class="searchgreade">';
                        // htmldata+='<button type="button" class="btn searchbtnset">$/ct<br><b>$ 380</b></button>';
                        // htmldata+='</div>';
                        // htmldata+='<div class="searchgreade">';
                        // htmldata+='<button type="button" class="btn searchbtnset">Savani%<br><b>-83.23%</b></button>';
                        // htmldata+='</div>';
                        // htmldata += '<div class="searchgreade">';
                        // htmldata += '<button type="button" class="btn searchbtnset">Total<br><b>$' + diamonddata.price + '</b></button>';
                        // htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '<div class="text-right searchright">';
                        // htmldata += '<div class="searchgreade searchcom">';
                        // htmldata += '<button type="button" class="btn searchbtnset contactdiamondseller" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + '">Contact Seller</button>';
                        // htmldata += '</div>';
                        htmldata += '<div class="searchgreade mr-1 searchcom">';
                        htmldata += '<a href="javascript:void(0);" class="btn editmydiamond searchbtnset" data-diamondid="' + diamonddata.id + '"><i class="fas fa-edit"></i>&nbsp;Edit</a>';
                        htmldata += '</div>';
                        htmldata += '<div class="searchgreade mr-1 searchcom">';
                        htmldata += '<a href="javascript:void(0);" class="btn deletemydiamond searchbtnset" data-diamondid="' + diamonddata.id + '"><i class="fas fa-trash-alt"></i>&nbsp;Delete</a>';
                        htmldata += '</div>';
                        if(diamonddata.isparcel!=1)
                        {
                            htmldata += '<div class="searchgreade searchcom">';
                            htmldata += '<button type="button" class="btn searchbtnset btnshowmydiamonddetail" data-diamondid="' + diamonddata.id + '" >Diamond Page</button>';
                            htmldata += '</div>';
                        }
                        // htmldata+='<div class="searchgreade searchcom">';
                        // htmldata+='<button type="button" class="btn searchbtnset">More</button>';
                        // htmldata+='</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';

                            if(diamonddata.isparcel==1)
                            {
                                var avgsize=((parseFloat(diamonddata.sievename) + parseFloat(diamonddata.tosievename))/2);
                                var ppc=parseFloat(1/avgsize) ;
                                htmldata += '<div class="col-12 searchddetail">';
                                htmldata += '<div class="row">';
                                htmldata += '<div class="col-md-6 searchddetail1">';
                                htmldata += '<div class="card">';
                                htmldata += '<div class="card-body">';
                                htmldata += '<div class="headset">';
                                htmldata += '<h5 class="text-left">';
                                htmldata += '   Diamond Details';
                                htmldata += '</h5>';
                                htmldata += '<h4>Last Update: ' + diamonddata.dt + '</h4>';
                                htmldata += '</div>';
                                htmldata += '<div class="searchmoredetail">';
                                htmldata += '<div class="row">';
                                htmldata += '<div class="col-md-6">';
                                htmldata += '<ul>';
                                htmldata += '<li><b>Shape</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shape + '</span></li>';
                                htmldata += '<li><b>Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.sievename + ' - ' + diamonddata.tosievename + '</span></li>';
                                
                                // htmldata += '<li><b>Avg. Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.size + '</span></li>';
                                htmldata += '<li><b>Avg. Size</b>: <span class="metalpurity1">&nbsp; ' + parseFloat(avgsize).toFixed(4) + '</span></li>';
                                htmldata += '<li><b>Avg. Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.color + '</span></li>';
                                htmldata += '<li><b>Avg. Clarity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '</span></li>';
                                // htmldata += '<li><b>Cut</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.cut + '</span></li>';
                                // htmldata += '<li><b>Polish</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.polish + '</span></li>';
                                // htmldata += '<li><b>Symm</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.symmetry + '</span></li>';
                                // htmldata += '<li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                                // htmldata += '<li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lab + '</span></li>';
                                htmldata += '</ul>';
                                htmldata += '</div>';
                                htmldata += '<div class="col-md-6">';
                                htmldata += '<ul>';
                                // htmldata+='<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>';
                                // htmldata+='<li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>';
                                // htmldata += '<li><b>Total</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                                // htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depthper + '%</span></li>';
                                // htmldata += '<li><b>Table</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '% </span></li>';
                                // htmldata += '<li><b>Measurement</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                                // htmldata += '<li><b>Vendor Stock No. </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                                // htmldata+='<li><b>Status</b>: <span class="metalpurity1">&nbsp; G</span></li>';
                                // htmldata+='<li><b>Media</b>: <span class="metalpurity1">&nbsp; -</span></li>';
                                // htmldata+='<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; 1.132</span></li>';
                                htmldata+='<li><b>Type</b>: <span class="metalpurity1">&nbsp; Parcel</span></li>';
                                htmldata+='<li><b>Total Carat</b>: <span class="metalpurity1">&nbsp; '+diamonddata.numofdiamond+'</span></li>';
                                htmldata+='<li><b>PPC</b>: <span class="metalpurity1">&nbsp; '+parseFloat(ppc).toFixed(4)+'</span></li>';
                                htmldata += '</ul>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '<div class="col-md-3 searchddetail2">';
                                htmldata += '<div class="row">';
                                htmldata += '<div class="col-md-12 detail1search">';
                                htmldata += '<div class="headset">';
                                htmldata += '<h5 class="text-left">';
                                htmldata += 'Price';
                                htmldata += '</h5>';
                                htmldata += '<div class="pricecalimg">';
                                // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/pricecal.svg" alt="' + diamonddata.savanilotnumber + '" title="' + diamonddata.savanilotnumber + '">';
                                htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '<div class="searchmoredetail3">';
                                htmldata += '<ul>';
                                htmldata += '<li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanilotnumber + '</span></li>';
                                htmldata += '<li><b>Availability</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.availability + '</span></li>';
                                htmldata += '<li><b>Diamond Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.country + '</span></li>';
                                htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                                if(diamonddata.isparcel!=1)
                                {
                                    htmldata += '<li><b>$/Ct</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                                }
                                htmldata += '<div class="row dimondpricedata">';
                                    htmldata += '<div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 set_dis_deta dis_newprice">';
                                        htmldata += '<li><b>Price</b></li>';
                                    htmldata += '</div>';
                                    if(diamonddata.isparcel!=1)
                                    {
                                        htmldata += '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 set_dis_deta">';
                                            htmldata += '<li><b>$/ct</b></li>';
                                            htmldata += '<span class="metalpurity1">$' + diamonddata.price + '</span>';
                                        htmldata += '</div>';
                                    }
                                    htmldata += '<div class="col-xl-4 col-lg-3 col-md-6 col-sm-12 set_dis_deta">';
                                        htmldata += '<li><b>Discount (%)</b></li>';
                                        htmldata += '<span class="metalpurity1">' + diamonddata.savanipercentage + ' %</span>';
                                    htmldata += '</div>';
                                    htmldata += '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 set_dis_deta">';
                                        htmldata += '<li><b>Total</b></li>';
                                        // htmldata += '<span class="metalpurity1">$' + parseFloat(diamonddata.price*diamonddata.size).toFixed(2) + ' </span>';
                                        htmldata += '<span class="metalpurity1">$' + parseFloat(diamonddata.totalprice).toFixed(2) + ' </span>';
                                    htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '</ul>';
                                htmldata += '</div>';

                                // htmldata+='<div class="headset">';
                                // // htmldata+='<h5 class="text-left">';
                                // // htmldata+='<li>$/ct</li>';
                                // // htmldata+='<li>$/ct</li>';
                                // // htmldata+='<li>$/ct</li>';
                                // // htmldata+='</h5>';
                                // // htmldata+='<div class="cashname">';
                                // // // htmldata+='<ul>';
                                // // // htmldata+='<li> <b>cash</b></li>';
                                // // // htmldata+='<li>$350</li>';
                                // // // htmldata+='<li>-56%</li>';
                                // // // htmldata+='<li>$230</li>';
                                // // // htmldata+='</ul>';
                                // // // htmldata+='<ul>';
                                // // // htmldata+='<li> <b>Price</b></li>';
                                // // // htmldata+='<li>$410</li>';
                                // // // htmldata+='<li>-56.20%</li>';
                                // // // htmldata+='<li>$850</li>';
                                // // // htmldata+='</ul>';
                                // // htmldata+='</div>';
                                // htmldata+='</div>';
                                htmldata += '</div>';



                                // htmldata += '<div class="col-md-12 mediaset">';
                                // htmldata += '<h4>Media</h4>';

                                // var disabledreport = 'disabled';
                                // var linkreport = 'javascript:void(0);';
                                // var targetreport = '';
                                // if (diamonddata.reportfilelink != '') {
                                //     disabledreport = '';
                                //     linkreport = diamonddata.reportfilelink;
                                //     targetreport = '_blank';
                                // }

                                // htmldata += '<a class="btn reseacbtn ' + disabledreport + '" ' + disabledreport + ' href="' + linkreport + '" target="' + targetreport + '" data-diamondid="' + diamonddata.id + '">';
                                // htmldata += '<div class="pricecalimg">';
                                // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/report.svg" alt="diamonds" title="diamonds">';
                                // htmldata += '</div>';
                                // htmldata += 'Report';
                                // htmldata += '</a>';

                                // htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                                // htmldata += '<div class="pricecalimg">';
                                // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diogram.svg" alt="diamonds" title="diamonds">';
                                // htmldata += '</div>';
                                // htmldata += 'Diagram';
                                // htmldata += '</button>';
                                // htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                                // htmldata += '<div class="pricecalimg">';
                                // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                                // htmldata += '</div>';
                                // htmldata += 'Video';
                                // htmldata += '</button>';
                                // htmldata += '</div>';
                                htmldata += '</div>';
                                htmldata += '</div>';

                                var sellerdetails = diamonddata.persondetail[0];

                                htmldata += '<div class="col-md-3 searchddetail2">';
                                htmldata += '<div class="row sedetil">';
                                htmldata += '<div class="col-md-12 detail1search">';
                                htmldata += '<div class="headset">';
                                htmldata += '<h5 class="text-left">';
                                htmldata += 'Seller Details';
                                htmldata += '</h5>';
                                htmldata += '</div>';
                                htmldata += '<div class="row setpro">';
                                htmldata += '<div class="col-md-10 col-lg-10 col-xl-10 ">';
                                htmldata += ' <ul class="d-flex justify-content-between align-items-center">';
                                htmldata += '<li>';
                                htmldata += '<div class="profileimg">';
                                htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                                htmldata += '</div>';
                                htmldata += '</li>';
                                htmldata += '<li>';
                                htmldata += '<div class="desc ">';
                                htmldata += '<h4>' + sellerdetails.companyname + '</h4>';
                                htmldata += '<h5><b>ID No </b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';
                                htmldata += '</div>';
                                htmldata += '</li>';
                                htmldata += '</ul>';
                                htmldata += '</div>';
                                // htmldata+='<div class="col-md-5 afprofile">';
                                // htmldata+='<ul class="d-flex justify-content-between align-items-center">';
                                // htmldata+='<li>';
                                // htmldata+='<div class="sideimg">';
                                // htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/searchpage/review.svg" alt="diamonds" title="diamonds">';
                                // htmldata+='</div>';
                                // htmldata+='</li>';
                                // htmldata+='<li>';
                                // htmldata+='<div class="desc">';
                                // htmldata+='<h6>no reating yet</h6>';
                                // htmldata+='</div>';
                                // htmldata+='</li>';
                                // htmldata+='</ul>';
                                // htmldata+='</div>';
                                htmldata += '</div>';
                                htmldata += '<div class="searchmoredetail3">';
                                htmldata += '<ul>';
                                htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.countryname + '</span></li>';
                                htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                                htmldata += '<li class="hidephoneno" data-id="'+diamonddata.id+'"><b>Phone</b>: <span class="metalpurity1" title="Click To Unlock">&nbsp; ***** ***** <i class="fas fa-lock"></i></span></li>';
                                htmldata += '<li class="showphoneno'+diamonddata.id+' d-none"><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                                htmldata += '</ul>';
                                htmldata += '</div>';

                                htmldata += '</div>';

                                // htmldata += '<div class="col-md-12 noteset">';
                                // // htmldata += '<div class="writset">';
                                // // htmldata += '<textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>';
                                // // htmldata += '</div>';

                                // htmldata += '<div class="colsave">';
                                // htmldata += '<ul>';

                                // htmldata += '<li>';
                                // htmldata += '<div class="colorset">';
                                // htmldata += '<input type="color" class="scolor" id="colorpicker" value="#0000ff">';
                                // htmldata += '</div>';
                                // htmldata += '<p>if you want to change color top here</p>';
                                // htmldata += '</li>';

                                // htmldata += '<li>';
                                // htmldata += '<button type="button" class="btn searchbtnset">save</button>';
                                // htmldata += '</li>';
                                // htmldata += '</ul>';
                                // htmldata += '</div>';
                                // htmldata += '</div>';

                                htmldata += '</div>';
                                htmldata += '</div>';

                              
                            }else{
                                htmldata += '<div class="col-12 searchddetail setdi">';
                                    htmldata += '<div class="row">';
                                        htmldata += '<div class="col-md-6 searchddetail1">';
                                            htmldata += '<div class="card">';
                                                htmldata += '<div class="card-body">';
                                                    htmldata += '<div class="headset">';
                                                        htmldata += '<h5 class="text-left">';
                                                            htmldata += '   Diamond Details';
                                                        htmldata += '</h5>';
                                                        htmldata += '<h4>Last Update: ' + diamonddata.dt + '</h4>';
                                                    htmldata += '</div>';
                                                    htmldata += '<div class="searchmoredetail">';
                                                        htmldata += '<div class="row">';
                                                            htmldata += '<div class="col-md-6">';
                                                                htmldata += '<ul>';
                                                                    htmldata += '<li><b>Shape</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shape + '</span></li>';
                                                                    htmldata += '<li><b>Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.size + '</span></li>';
                                                                    htmldata += '<li><b>Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.color + '</span></li>';
                                                                    htmldata += '<li><b>Clarity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '</span></li>';
                                                                    htmldata += '<li><b>Cut</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.cut + '</span></li>';
                                                                    htmldata += '<li><b>Polish</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.polish + '</span></li>';
                                                                    htmldata += '<li><b>Symm</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.symmetry + '</span></li>';

                                                                htmldata += '</ul>';
                                                            htmldata += '</div>';
                                                            htmldata += '<div class="col-md-6">';
                                                                htmldata += '<ul>';
                                                                    // htmldata+='<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>';
                                                                    // htmldata+='<li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>';
                                                                    htmldata += '<li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.intensity + '</span></li>';
                                                                    htmldata += '<li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lab + '</span></li>';
                                                                    // htmldata += '<li><b>Total</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                                                                    htmldata += '<li><b>Depth (%)</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depthper + '%</span></li>';
                                                                    htmldata += '<li><b>Table (%)</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '% </span></li>';
                                                                    htmldata += '<li><b>Measurement</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                                                                    htmldata += '<li><b class="max-100">Vendor’s matching Pair stock No. </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';

                                                                    if(diamonddata.withfancycolor==1)
                                                                    {
                                                                        htmldata += '<li><b>Fancy Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancyintensity + '</span></li>';
                                                                        htmldata += '<li><b>Fancy Overtone</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.overtone + '</span></li>';
                                                                        htmldata += '<li><b>Fancy Color 1</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor1 + '</span></li>';
                                                                        htmldata += '<li><b>Fancy Color 2</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor2 + '</span></li>';
                                                                    }

                                                                    // htmldata+='<li><b>Status</b>: <span class="metalpurity1">&nbsp; G</span></li>';
                                                                    // htmldata+='<li><b>Media</b>: <span class="metalpurity1">&nbsp; -</span></li>';
                                                                    // htmldata+='<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; 1.132</span></li>';
                                                                htmldata += '</ul>';
                                                            htmldata += '</div>';
                                                        htmldata += '</div>';
                                                    htmldata += '</div>';
                                                htmldata += '</div>';
                                            htmldata += '</div>';
                                        htmldata += '</div>';
                                        htmldata += '<div class="col-md-5 searchddetail2">';
                                            htmldata += '<div class="row">';
                                                htmldata += '<div class="col-md-12 detail1search">';
                                                    htmldata += '<div class="headset">';
                                                        htmldata += '<h5 class="text-left">';
                                                            htmldata += 'Price';
                                                        htmldata += '</h5>';
                                                        htmldata += '<div class="pricecalimg">';
                                                            // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/pricecal.svg" alt="' + diamonddata.savanilotnumber + '" title="' + diamonddata.savanilotnumber + '">';
                                                        htmldata += '</div>';
                                                    htmldata += '</div>';
                                                    htmldata += '<div class="searchmoredetail3">';
                                                        htmldata += '<ul>';
                                                            htmldata += '<li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanilotnumber + '</span></li>';
                                                            htmldata += '<li><b>Availability</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.availability + '</span></li>';
                                                            htmldata += '<li><b>Diamond Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.country + '</span></li>';
                                                            htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                                                            // htmldata += '<li><b>Discount (%) </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanipercentage + ' %</span></li>';
                                                            // htmldata += '<li><b>Total Price </b>: <span class="metalpurity1">&nbsp;$' + parseFloat(diamonddata.price*diamonddata.size).toFixed(2) + ' </span></li>';
                                                            // priyank 03-01-2023 newcode start
                                                            htmldata += '<div class="row dimondpricedata">';
                                                                htmldata += '<div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 set_dis_deta dis_newprice">';
                                                                    htmldata += '<li><b>Price</b></li>';
                                                                htmldata += '</div>';
                                                                htmldata += '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 set_dis_deta">';
                                                                    htmldata += '<li><b>$/ct</b></li>';
                                                                    htmldata += '<span class="metalpurity1">$' + diamonddata.price + '</span>';
                                                                htmldata += '</div>';
                                                                htmldata += '<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 set_dis_deta">';
                                                                    htmldata += '<li><b>Discount (%)</b></li>';
                                                                    htmldata += '<span class="metalpurity1">' + diamonddata.savanipercentage + ' %</span>';
                                                                htmldata += '</div>';
                                                                htmldata += '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 set_dis_deta">';
                                                                    htmldata += '<li><b>Total Price</b></li>';
                                                                    // htmldata += '<span class="metalpurity1">$' + parseFloat(diamonddata.price*diamonddata.size).toFixed(2) + ' </span>';
                                                                    htmldata += '<span class="metalpurity1">$' + parseFloat(diamonddata.totalprice).toFixed(2) + ' </span>';
                                                                htmldata += '</div>';
                                                            htmldata += '</div>';
                                                        htmldata += '</ul>';
                                                    htmldata += '</div>';

                                                    // htmldata+='<div class="headset">';
                                                    // // htmldata+='<h5 class="text-left">';
                                                    // // htmldata+='<li>$/ct</li>';
                                                    // // htmldata+='<li>$/ct</li>';
                                                    // // htmldata+='<li>$/ct</li>';
                                                    // // htmldata+='</h5>';
                                                    // // htmldata+='<div class="cashname">';
                                                    // // // htmldata+='<ul>';
                                                    // // // htmldata+='<li> <b>cash</b></li>';
                                                    // // // htmldata+='<li>$350</li>';
                                                    // // // htmldata+='<li>-56%</li>';
                                                    // // // htmldata+='<li>$230</li>';
                                                    // // // htmldata+='</ul>';
                                                    // // // htmldata+='<ul>';
                                                    // // // htmldata+='<li> <b>Price</b></li>';
                                                    // // // htmldata+='<li>$410</li>';
                                                    // // // htmldata+='<li>-56.20%</li>';
                                                    // // // htmldata+='<li>$850</li>';
                                                    // // // htmldata+='</ul>';
                                                    // // htmldata+='</div>';
                                                    // htmldata+='</div>';
                                                htmldata += '</div>';



                                                htmldata += '<div class="col-md-12 mediaset">';
                                                    htmldata += '<h4>Media</h4>';

                                                    var disabledreport = 'disabled';
                                                    var linkreport = 'javascript:void(0);';
                                                    var targetreport = '';
                                                    if (diamonddata.reportfilelink != '') {
                                                        disabledreport = '';
                                                        linkreport = diamonddata.reportfilelink;
                                                        targetreport = '_blank';
                                                    }

                                                    htmldata += '<a class="btn reseacbtn ' + disabledreport + '" ' + disabledreport + ' href="' + linkreport + '" target="' + targetreport + '" data-diamondid="' + diamonddata.id + '">';
                                                        htmldata += '<div class="pricecalimg">';
                                                            htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/report.svg" alt="diamonds" title="diamonds">';
                                                        htmldata += '</div>';
                                                        htmldata += 'Report';
                                                    htmldata += '</a>';

                                                    htmldata += '<button type="button" class="btn reseacbtn btnshowmydiamonddetail" data-diamondid="' + diamonddata.id + '">';
                                                        htmldata += '<div class="pricecalimg">';
                                                            htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diogram.svg" alt="diamonds" title="diamonds">';
                                                        htmldata += '</div>';
                                                        htmldata += 'Diagram';
                                                    htmldata += '</button>';
                                                    if(diamonddata.videolink!='')
                                                    {
                                                        htmldata += '<a href="'+diamonddata.videolink+'" target="_blank" class="btn reseacbtn" data-diamondid="' + diamonddata.id + '">';
                                                        htmldata += '<div class="pricecalimg">';
                                                        htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                                                        htmldata += '</div>';
                                                        htmldata += 'Video';
                                                        htmldata += '</a>';
                                                    }
                                                    else{
                                                        htmldata += '<a href="javascript:void(0);" disabled class="btn disabled reseacbtn" data-diamondid="' + diamonddata.id + '">';
                                                        htmldata += '<div class="pricecalimg">';
                                                        htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                                                        htmldata += '</div>';
                                                        htmldata += 'Video';
                                                        htmldata += '</a>';
                                                    }
                                                htmldata += '</div>';
                                            htmldata += '</div>';
                                        htmldata += '</div>';

                                        var sellerdetails = diamonddata.persondetail[0];

                                        // htmldata += '<div class="col-md-3 searchddetail2">';
                                        // htmldata += '<div class="row sedetil">';
                                        // htmldata += '<div class="col-md-12 detail1search">';
                                        // htmldata += '<div class="headset">';
                                        // htmldata += '<h5 class="text-left">';
                                        // htmldata += 'Seller Details';
                                        // htmldata += '</h5>';
                                        // htmldata += '</div>';
                                        // htmldata += '<div class="row setpro">';
                                        // htmldata += '<div class="col-md-7 ">';
                                        // htmldata += ' <ul class="d-flex justify-content-between align-items-center">';
                                        // htmldata += '<li>';
                                        // htmldata += '<div class="profileimg">';
                                        // htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                                        // htmldata += '</div>';
                                        // htmldata += '</li>';
                                        // htmldata += '<li>';
                                        // htmldata += '<div class="desc ">';
                                        // htmldata += '<h4>' + sellerdetails.companyname + '</h4>';
                                        // htmldata += '<h5><b>Savani ID</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';
                                        // htmldata += '</div>';
                                        // htmldata += '</li>';
                                        // htmldata += '</ul>';
                                        // htmldata += '</div>';
                                        // htmldata+='<div class="col-md-5 afprofile">';
                                        // htmldata+='<ul class="d-flex justify-content-between align-items-center">';
                                        // htmldata+='<li>';
                                        // htmldata+='<div class="sideimg">';
                                        // htmldata+='<img src="<?php echo $config->getImageurl(); ?>images/searchpage/review.svg" alt="diamonds" title="diamonds">';
                                        // htmldata+='</div>';
                                        // htmldata+='</li>';
                                        // htmldata+='<li>';
                                        // htmldata+='<div class="desc">';
                                        // htmldata+='<h6>no reating yet</h6>';
                                        // htmldata+='</div>';
                                        // htmldata+='</li>';
                                        // htmldata+='</ul>';
                                        // htmldata+='</div>';
                                        // htmldata += '</div>';
                                        // htmldata += '<div class="searchmoredetail3">';
                                        // htmldata += '<ul>';
                                        // htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.countryname + '</span></li>';
                                        // htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                                        // htmldata += '<li><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                                        // htmldata += '</ul>';
                                        // htmldata += '</div>';

                                        // htmldata += '</div>';

                                        // htmldata += '<div class="col-md-12 noteset">';
                                        // // htmldata += '<div class="writset">';
                                        // // htmldata += '<textarea class="form-control" rows="4" placeholder=" Write a personal note...." id="comment"></textarea>';
                                        // // htmldata += '</div>';

                                        // htmldata += '<div class="colsave">';
                                        // htmldata += '<ul>';

                                        // htmldata += '<li>';
                                        // htmldata += '<div class="colorset">';
                                        // htmldata += '<input type="color" class="scolor" id="colorpicker" value="#0000ff">';
                                        // htmldata += '</div>';
                                        // htmldata += '<p>if you want to change color top here</p>';
                                        // htmldata += '</li>';

                                        // htmldata += '<li>';
                                        // htmldata += '<button type="button" class="btn searchbtnset">save</button>';
                                        // htmldata += '</li>';
                                        // htmldata += '</ul>';
                                        // htmldata += '</div>';
                                        // htmldata += '</div>';

                                    htmldata += '</div>';
                                htmldata += '</div>';
                            }
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</td>';


                        


                    }


                    $('.listmydiamondDataDiv #listmydiamondData').html(htmldata);
                    $('#mypaginationDiv').html(resultdata.pagedata);
                   /*  if (resultdata.nextpage == 1) {
                        $('.listmydiamondDataDiv #listmydiamondData').html(htmldata);
                    } else {
                        $('.listmydiamondDataDiv #listmydiamondData').append(htmldata);
                    } */
                    
                    $('#showmydiamondentries').html(resultdata.showentries);
                    $('#listmydiamondDatatbl').attr('data-nextpage', resultdata.nextpage);
                    if (resultdata.loadmore == 1) {
                        $('#listmydiamondDatatbl').attr('data-show', 1);
                    } else {
                        $('#listmydiamondDatatbl').attr('data-show', 0);
                    }

                    var tbody_height = $(document).height()-$('header').height()-$('.mydiamond-footer-page').height()-$('#listmydiamondDatatbl thead').height()-$('.mydiamond-header').height();
                    $('#listmydiamondDatatbl tbody').css('max-height',tbody_height);

                    $('.deletemydiamond').on('click', function() {
                        var id = $(this).attr('data-diamondid');
                        Notiflix.Confirm.Show(false, 'Are you want to delete this data?', false, false, function() {
                            // showloader();
                            
                            $('.chart-loading').show();
                            var pagename = getpagename();
                            var useraction = $('#formevent').val();
                            deleteformdata = new FormData();
                            deleteformdata.append("action", "deletediamond");
                            deleteformdata.append("id", id);
                            var headersdata = {
                                'Accept': 'application/json',
                                platform: 4,
                                userpagename: pagename,
                                useraction: useraction,
                                masterlisting: false
                            };
                            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', deleteformdata, headersdata, Onsuccessdeletediamond, OnErrordeletediamond)

                            function Onsuccessdeletediamond(data) {
                                // hideloader();
                                $('.chart-loading').hide();
                                var JsonData = JSON.stringify(data);
                                var resultdeletedata = jQuery.parseJSON(JsonData);

                                if (resultdeletedata.status == 0) {
                                    Notiflix.Notify.Failure(resultdeletedata.message);
                                } else if (resultdeletedata.status == 1) {
                                    Notiflix.Notify.Success(resultdeletedata.message);
                                    $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                                    listmydiamonddata(1);
                                }else if(resultdeletedata.status == -1)
                                {
                                    $('#btnlogout').trigger('click');
                                }

                            }

                            function OnErrordeletediamond(content) {

                            }

                        }, function() {

                        });
                    });

                    $('.editmydiamond').on('click', function() {
                        var id = $(this).attr('data-diamondid');

                        // showloader();
                        $('.chart-loading').show();
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        editformdata = new FormData();
                        editformdata.append("action", "listdiamond");
                        editformdata.append("id", id);
                        editformdata.append("nextpage", 1);
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', editformdata, headersdata, Onsuccesseditdiamond, OnErroreditdiamond)

                        function Onsuccesseditdiamond(data) {
                            // hideloader();
                            $('.chart-loading').hide();
                            var JsonData = JSON.stringify(data);
                            var resulteditdata = jQuery.parseJSON(JsonData);

                            if (resulteditdata.status == 0) {
                                Notiflix.Notify.Failure(resulteditdata.message);
                            } else if (resulteditdata.status == 1) {
                                $('#v-pills-2-tab').click();
                                $('#nav-h-tab').click();

                                $('#form-diamond-upload #btngeneralinfo').removeClass('d-none');
                                 $('#form-diamond-upload #btnsavediamond').removeClass('d-none');
                                $('#form-diamond-upload #id').val(id);
                                $('#form-diamond-upload #formevent').val('update');
                                $('#form-diamond-upload #btnsavediamond').html('Update');

                                $('.uploaddiamondtabs li').attr('disabled', false);
                                $('.uploaddiamondtabs li').removeClass('disabled');
                                $('.uploaddiamondtabs li a').removeClass('disabled');
                                $('.uploaddiamondtabs li a').attr('disabled', false);
                                $('.diamonduploadesirmodetext').html('Edit');

                                for (var i in resulteditdata.data) {
                                    var editdata = resulteditdata.data[i];
                                    $('#form-diamond-upload #stock').val(editdata.stock);
                                    $('#form-diamond-upload #price').val(editdata.price);
                                    $('#form-diamond-upload #totalprice').val(editdata.totalprice);
                                    $('#form-diamond-upload #savanipercentage').val(editdata.savanipercentage);
                                    $('#form-diamond-upload #availabilityid').val(editdata.availabilityid);
                                    $('#form-diamond-upload #availabilityid').select2();
                                    $('#form-diamond-upload #countryid').val(editdata.countryid);
                                    $('#form-diamond-upload #countryid').select2();
                                    liststate(editdata.stateid, editdata.countryid);
                                    $('#form-diamond-upload #city').val(editdata.city);
                                    $('#form-diamond-upload #shapeid').val(editdata.shapeid);
                                    $('#form-diamond-upload #shapeid').select2();
                                    // $('#form-diamond-upload #size').val(editdata.size);

                                    $('#form-diamond-upload #colorid').val(editdata.colorid);
                                    $('#form-diamond-upload #colorid').select2();

                                    $('#form-diamond-upload #clarityid').val(editdata.clarityid);
                                    $('#form-diamond-upload #clarityid').select2();

                                    $('#form-diamond-upload #cutid').val(editdata.cutid);
                                    $('#form-diamond-upload #cutid').select2();

                                    $('#form-diamond-upload #polishid').val(editdata.polishid);
                                    $('#form-diamond-upload #polishid').select2();

                                    $('#form-diamond-upload #symmetryid').val(editdata.symmetryid);
                                    $('#form-diamond-upload #symmetryid').select2();

                                    $('#form-diamond-upload #intensityid').val(editdata.intensityid);
                                    $('#form-diamond-upload #intensityid').select2();

                                    $('#form-diamond-upload #fluorescenecolorid').val(editdata.fluorescenecolorid);
                                    $('#form-diamond-upload #fluorescenecolorid').select2();

                                    $('#form-diamond-upload #length').val(editdata.length);
                                    $('#form-diamond-upload #width').val(editdata.width);
                                    $('#form-diamond-upload #depth').val(editdata.depth);

                                    $('#form-diamond-upload #depthper').val(editdata.depthper);
                                    $('#form-diamond-upload #tableper').val(editdata.tableper);

                                    $('#form-diamond-upload #crownangle').val(editdata.crownangle);
                                    $('#form-diamond-upload #crownheight').val(editdata.crownheight);

                                    $('#form-diamond-upload #pavilionangle').val(editdata.pavilionangle);
                                    $('#form-diamond-upload #pavilionheight').val(editdata.pavilionheight);
                                    
                                    $('#form-diamond-upload #gridleconditionid').val(editdata.gridleconditionid);
                                    $('#form-diamond-upload #gridleconditionid').select2();

                                    $('#form-diamond-upload #gridleminid').val(editdata.gridleminid);
                                    $('#form-diamond-upload #gridleminid').select2();

                                    $('#form-diamond-upload #gridlemaxid').val(editdata.gridlemaxid);
                                    $('#form-diamond-upload #gridlemaxid').select2();


                                    $('#form-diamond-upload #gridleper').val(editdata.gridleper);

                                    $('#form-diamond-upload #culetconditionid').val(editdata.culetconditionid);
                                    $('#form-diamond-upload #culetconditionid').select2();

                                    $('#form-diamond-upload #culetsizeid').val(editdata.culetsizeid);
                                    $('#form-diamond-upload #culetsizeid').select2();

                                    if (editdata.treatmentid) {
                                        $("#form-diamond-upload #treatmentid").val(editdata.treatmentid.split(',')).trigger('change');
                                        $('#form-diamond-upload #treatmentid').select2();
                                    }
                                
                                    $('#form-diamond-upload #laserinscription').val(editdata.laserinscription);
                                    $('#form-diamond-upload #starlength').val(editdata.starlength);
                                    $('#form-diamond-upload #labid').val(editdata.labid);
                                    $('#form-diamond-upload #labid').select2();
                                
                                    if (editdata.showonsavanigems == 1) {
                                        $('#showonsavanigems').prop('checked', true);
                                    } else {
                                        $('#showonsavanigems').prop('checked', false);
                                    }
                                    $('#form-diamond-upload #reportnumber').val(editdata.reportnumber);
                                    $('#form-diamond-upload #reportdate').val(editdata.reportdate);
                                    $('#form-diamond-upload #lablocation').val(editdata.lablocation);
                                    $('#form-diamond-upload #reportcomment').val(editdata.reportcomment);
                                    if (editdata.keytosymbolsid) {
                                        // var keytosymbolsid=editdata.keytosymbolsid.split(',');
                                        $("#form-diamond-upload #keytosymbolsid").val(editdata.keytosymbolsid.split(',')).trigger('change');
                                        // $("#form-diamond-upload #keytosymbolsid").val(keytosymbolsid);
                                        $('#form-diamond-upload #keytosymbolsid').select2();
                                    }
                                    

                                    if (editdata.withfancycolor == 1) {
                                        $('#withfancycolor').prop('checked', true);
                                        checkfancycolorflag();
                                        $('#form-diamond-upload #fancyintensityid').val(editdata.fancyintensityid);
                                        $('#form-diamond-upload #fancyintensityid').select2();

                                        $("#form-diamond-upload #overtoneid").val(editdata.overtoneid.split(',')).trigger('change');
                                        $('#form-diamond-upload #overtoneid').select2();

                                        $('#form-diamond-upload #fancycolorid1').val(editdata.fancycolorid1);
                                        $('#form-diamond-upload #fancycolorid1').select2();

                                        $('#form-diamond-upload #fancycolorid2').val(editdata.fancycolorid2);
                                        $('#form-diamond-upload #fancycolorid2').select2();

                                    } else {
                                        $('#withfancycolor').prop('checked', false);
                                        checkfancycolorflag();
                                    }

                                    if (editdata.matchedpair == 1) {
                                        $('#matchedpair').prop('checked', true);
                                        checkmatchpairflag();
                                        $('#form-diamond-upload #stocknumber').val(editdata.stocknumber);
                                        if (editdata.ispairseparable == 1) {
                                            $('#ispairseparable').prop('checked', true);
                                        } else {
                                            $('#ispairseparable').prop('checked', false);
                                        }
                                    } else {
                                        $('#matchedpair').prop('checked', false);
                                        checkmatchpairflag();
                                    }

                                    if (editdata.isdownload == 1) {
                                        $('#isdownload').prop('checked', true);
                                    } else {
                                        $('#isdownload').prop('checked', false);
                                    }
                                    $('#form-diamond-upload #tradeshowid').val(editdata.tradeshowid);
                                    $('#form-diamond-upload #tradeshowid').select2();

                                    $('#form-diamond-upload #brandid').val(editdata.brandid);
                                    $('#form-diamond-upload #brandid').select2();

                                    $('#form-diamond-upload #suppliercomment').val(editdata.suppliercomment);

                                    if (editdata.isparcel == 1) {
                                        $('#isparcel').prop('checked', true);
                                        
                                        $('#form-diamond-upload #sieveid').val(editdata.sieveid);
                                        $('#form-diamond-upload #sieveid').select2();

                                        $('#form-diamond-upload #tosieveid').val(editdata.tosieveid);
                                        $('#form-diamond-upload #tosieveid').select2();

                                        $('#form-diamond-upload #numofdiamond').val(editdata.numofdiamond);
                                        $('#numofdiamond').attr('disabled', false);
                                        $('#numofdiamond').removeClass('disabled');
                                        $('.frmsieveDiv').removeClass('hidden');
                                        $('.frmsizeDiv').addClass('hidden');
                                        $('#size').val('');
                                        // checkisparcelflag();
                                        // totalpricecalculate();
                                        if(editdata.ismixsize == 1)
                                        {
                                            $('#iscustomsieve').prop('checked', true);
                                        
                                            $('#form-diamond-upload #fromsievename').val(editdata.sievename);
                                            $('#form-diamond-upload #tosievename').val(editdata.tosievename);

                                            $('#form-diamond-upload .nocustomDiv').addClass('hidden');
                                            $('#form-diamond-upload .customsieveDiv').removeClass('d-none');

                                            $('#form-diamond-upload #numofdiamond').val(editdata.numofdiamond);
                                        }
                                    } else {
                                        $('#isparcel').prop('checked', false);
                                        
                                        $('#form-diamond-upload #size').val(editdata.size);
                                        $('#numofdiamond').attr('disabled', true);
                                        $('#numofdiamond').addClass('disabled');
                                        $('#numofdiamond').val('');
                                        $('.frmsieveDiv').addClass('hidden');
                                        $('.frmsizeDiv').removeClass('hidden');
                                        // checkisparcelflag(); 
                                        // totalpricecalculate();
                                    }
                                    $('#form-diamond-upload #reportfilelink').val(editdata.reportfilelink);
                                    $('#form-diamond-upload #diamondimglink').val(editdata.diamondimglink);
                                    $('#form-diamond-upload #videolink').val(editdata.videolink);
                                    $('#form-diamond-upload #sarineloupe').val(editdata.sarineloupe);
                                    $('#form-diamond-upload #sellerspecification').val(editdata.sellerspecification);

                                    $('#form-diamond-upload #shadeid').val(editdata.shadeid);
                                    $('#form-diamond-upload #shadeid').select2();

                                    $('#form-diamond-upload #milkyid').val(editdata.milkyid);
                                    $('#form-diamond-upload #milkyid').select2();

                                    $('#form-diamond-upload #eyecleanid').val(editdata.eyecleanid);
                                    $('#form-diamond-upload #eyecleanid').select2();

                                    if (editdata.openinclusionsid) {

                                        $("#form-diamond-upload #openinclusionsid").val(editdata.openinclusionsid.split(',')).trigger('change');
                                        $('#form-diamond-upload #openinclusionsid').select2();
                                    }
                                    if (editdata.blackinclusionsid) {
                                    
                                        $("#form-diamond-upload #blackinclusionsid").val(editdata.blackinclusionsid.split(',')).trigger('change');
                                        $('#form-diamond-upload #blackinclusionsid').select2();
                                    }
                                    if (editdata.whiteinclusionsid) {
                                        $("#form-diamond-upload #whiteinclusionsid").val(editdata.whiteinclusionsid.split(',')).trigger('change');
                                        $('#form-diamond-upload #whiteinclusionsid').select2();
                                    }
                                    $('#form-diamond-upload #roughdiamondsourceid').val(editdata.roughdiamondsourceid);
                                    $('#form-diamond-upload #roughdiamondsourceid').select2();
                                    $('#form-diamond-upload #piecepercarat').val(editdata.piecepercarat);
                                    // $('#form-diamond-upload #sieveid').val(editdata.sieveid);
                                    // $('#form-diamond-upload #sieveid').select2();

                                    var htmlreportfile = '';
                                    if (editdata.reportfile != '' && editdata.reportfile != null) {
                                        htmlreportfile += '<a href="' + editdata.reportfileurl + '" target="_blank">';
                                        htmlreportfile += '<img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="80" width="80" title="Report File">';
                                        htmlreportfile += '</a>';
                                        htmlreportfile += '<p><a href="javascript:void(0);" data-diamondid="' + editdata.id + '" title="Remove Report File" class="btn btn-danger mt-1 ml-1 removemydiamondreportfile"><i class="fas fa-trash-alt"></i></a></p>';
                                    }
                                    $('.mydiamondreportfileDiv').html(htmlreportfile);

                                    if ((editdata.diamondimagedetail).length > 0) {
                                        var mediadata = '';
                                        for (var h in editdata.diamondimagedetail) {
                                            mediadata += '<div class="col-md-3 col-sm-3  mt-2">';
                                            mediadata += '<a href="<?php echo $config->getImageurl(); ?>' + editdata.diamondimagedetail[h].image + '" target="_blank">';
                                            mediadata += '<img src="<?php echo $config->getImageurl(); ?>' + editdata.diamondimagedetail[h].image + '" alt="Diamond Media Image" title="Diamond Media Image">';
                                            mediadata += '</a>';
                                            mediadata += '<p><a href="javascript:void(0);" data-diamondid="' + editdata.diamondimagedetail[h].diamondid + '" data-id="' + editdata.diamondimagedetail[h].id + '" title="Remove Diamond Media " class="btn btn-danger mt-1 ml-1 removemydiamondmediaimage"><i class="fas fa-trash-alt"></i></a></p>';
                                            mediadata += '</div>';
                                        }
                                        $('.mydiamondmediafileDiv').html(mediadata);
                                    }


                                }

                            }else if(resulteditdata.status == -1)
                            {
                                $('#btnlogout').trigger('click');
                            }

                        }

                        function OnErroreditdiamond(content) {

                        }

                    });

                    $('.hidephoneno').on('click',function(){
                                    var id =$(this).data('id');
                                    $(this).addClass('d-none');
                                    $('.showphoneno'+id).removeClass('d-none');
                                })
                    


                }else if(resultdata.status == -1)
                {
                    $('#btnlogout').trigger('click');
                }
            }    


        }

        function OnErrorlistmydiamond(content) {

        }
    }
    $('body').on('click','.bulkdelete',function(){
        var dataindex=$(this).val();
        console.log(dataindex);
        $(".sdown"+dataindex).addClass('collapsed');
        $(".sdown"+dataindex).attr('aria-expanded',false);
        setTimeout(() => {
            $('#searchdown'+dataindex).removeClass('show');
        }, 400);
        // $(this).trigger('click',false);
        
    })
    //bulk delete Start
    $('body').on('click', '.select-bulk-delete', function() {    
        $('.tbl-check').removeClass('d-none'); 
        $(this).addClass('active-bulk-delete');    
        /* $(".delete-selected").toggleClass("d-none");
        $('.table tr .tbl-check').attr('hidden', function(index, attr){
            return attr == 'hidden' ? null : 'hidden';
        });*/
    });

    $('body').on('click', '.active-bulk-delete', function() {  
        $(this).removeClass('active-bulk-delete');      
        $('.tbl-check').addClass('d-none'); 
    });

    $('body').on('click', '#tblCheckAll', function() {            
        if($(this).prop("checked") == true) {
            $(this).prop('checked', true);
            $(this).closest("table").find('.tbl-check .custom-control-input').prop('checked', true);
        } else {
            $(this).prop('checked', false);
            $(this).closest("table").find('.tbl-check .custom-control-input').prop('checked', false);
        }
    });
    $('#modalConfirmation').on('hide.bs.modal', function () {
        $('#deleteaction').val('')
    })


    $('body').on('click','.btnmultitrash',function(){
    var onchklength = $('[name="bulkdelete[]"]:checked').length;
        if(onchklength > 0)
        {
                $('#modalConfirmation').modal('show');
        }
        else
        {
                
                Notiflix.Notify.Failure('Please select atleast one checkbox');
        }
    
    });
    $('#modalConfirmation').on('shown.bs.modal', function() { 
        $('#modalConfirmation #deleteaction').focus();
    });

    $('#deleteaction').keypress(function (e) {
        if (e.which == 13) {
        $('#confirmdelete').click();
        }
    });

    $('body').on('click', '#confirmdelete', function() {

        var deleteaction = $('#deleteaction').val();
        if (deleteaction == 'delete' || deleteaction == 'Delete' || deleteaction == 'DELETE') 
        {
            var id = $('#drid').val();
            
            var bulkid = '';
            if (id == '') 
            {
                var bulkid = new Array();
               
                $('#listmydiamondData tr').each(function() {
                    var trtmp = $(this).attr('data-index');
                    if ($('#bulkdelete' + trtmp).is(':checked')) {
                        bulkid.push($('#bulkdelete' + trtmp).val());
                    }
                });
            }

            if(bulkid.length > 0)
            {
                var pagename=getpagename();
                var headersdata = { Accept: 'application/json', platform: 4,userpagename:pagename,useraction:'delright',masterlisting:false };
        
                formdata = new FormData();
                formdata.append("action", "deletemydiamond");
                formdata.append("id", id);
                formdata.append("bulkid", bulkid);

                ajaxrequest("POST", endpointurl + pagename, formdata, headersdata, OnsuccessDelete, OnErrorDelete);
                $('#drid').val('');
                $('#deleteaction').val('');
                
                $('#modalConfirmation').modal('hide');
                // $('#loaderprogress').show();
                $('.chart-loading').show();
                
            }
        } 
        else 
        {
            Notiflix.Notify.Failure('Type Delete to Confirm');
        }
    });

    function OnsuccessDelete(content) {
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#loaderprogress').hide();
        if (resultdata.status == 0) {
            Notiflix.Notify.Failure(resultdata.message);
        } else if (resultdata.status == 1) {
            Notiflix.Notify.Success(resultdata.message);
        }
        
        listmydiamonddata(1);
        $('.tbl-check').addClass('d-none');
        $('.select-bulk-delete').removeClass('active-bulk-delete'); 
    }

    function OnErrorDelete(content) {
        ajaxrequest("POST", page404url, '', '', OnsuccessRender, OnErrorRender);
    }
    //bulk delete End
    function refreshlastupdateddate(id)
    {
        Notiflix.Confirm.Show(false, 'Are you want to update date?', false, false, function() {
            var pagename = getpagename();
            var useraction = '';
            formdata = new FormData();
            formdata.append("action", "diamondlastupdateddatechange");
            formdata.append("id", id);

            var headersdata = {
                'Accept': 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: useraction,
                masterlisting: false
            };
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, OnsuccessdeletereportfileData, OnErrordeletereportfile)

            function OnsuccessdeletereportfileData(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                // $('.preloader').hide();
                
                if (resultdata.status == 0) {
                    Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    Notiflix.Notify.Success(resultdata.message);
                    $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                    listmydiamonddata(1);

                }else if(resultdata.status == -1)
                {
                    $('#btnlogout').trigger('click');
                }
                  

            }

            function OnErrordeletereportfile(content) {
                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
            }

        }, function() {

        });
    }
    $('body').on('click','#listmydiamondData .tbl-highlight-tr',function(){

       /*  $('#listmydiamondData tr').removeClass('active');
        $('#listmydiamondData tr .searchPadding .collapse').removeClass('show');
        var index=$(this).attr('data-index');
        var ariaexpanded = $(this).attr('aria-expanded');
        $('#listmydiamondData .sdown'+index+'').addClass('active'); */

        if($(this).hasClass('active'))
        {
            /* $(this).removeClass('active');
            $('#listdiamondData tr .searchPadding .collapse').removeClass('show'); */
        }
        else{
            $('#listmydiamondData tr').removeClass('active');
            $('#listmydiamondData tr .searchPadding .collapse').removeClass('show');
            var index=$(this).attr('data-index');
            var ariaexpanded = $(this).attr('aria-expanded');
            $('#listmydiamondData .sdown'+index+'').addClass('active');
        }
    });
    $('body').on('click', '.removemydiamondreportfile', function() {
        var diamondid = $(this).attr('data-diamondid');

        Notiflix.Confirm.Show(false, 'Are you want to delete this file?', false, false, function() {
            var pagename = getpagename();
            var useraction = '';
            formdata = new FormData();
            formdata.append("action", "deletereportfile");
            formdata.append("diamondid", diamondid);

            var headersdata = {
                'Accept': 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: useraction,
                masterlisting: false
            };
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, OnsuccessdeletereportfileData, OnErrordeletereportfile)

            function OnsuccessdeletereportfileData(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                // $('.preloader').hide();
                if (resultdata.IsPackageExpire == 1) {
                    Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
                }
                else{ 
                    if (resultdata.status == 0) {
                        // alertify(resultdata.message,0);
                        Notiflix.Notify.Failure(resultdata.message);
                    } else if (resultdata.status == 1) {
                        Notiflix.Notify.Success(resultdata.message);
                        $('.mydiamondreportfileDiv').html('');

                    }else if(resultdata.status == -1)
                    {
                        $('#btnlogout').trigger('click');
                    }
                }   

            }

            function OnErrordeletereportfile(content) {
                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
            }
        }, function() {

        });
    });

    $('body').on('click', '.removemydiamondmediaimage', function() {
        var diamondid = $(this).attr('data-diamondid');
        var id = $(this).attr('data-id');

        Notiflix.Confirm.Show(false, 'Are you want to delete this file?', false, false, function() {
            var pagename = getpagename();
            var useraction = '';
            formdata = new FormData();
            formdata.append("action", "deletediamondmediaimage");
            formdata.append("diamondid", diamondid);
            formdata.append("id", id);

            var headersdata = {
                'Accept': 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: useraction,
                masterlisting: false
            };
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, OnsuccessdeletereportfileData, OnErrordeletereportfile)

            function OnsuccessdeletereportfileData(data) {
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                // $('.preloader').hide();
                if (resultdata.IsPackageExpire == 1) {
                    Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
                }
                else{ 
                    if (resultdata.status == 0) {
                        // alertify(resultdata.message,0);
                        Notiflix.Notify.Failure(resultdata.message);
                    } else if (resultdata.status == 1) {
                        Notiflix.Notify.Success(resultdata.message);
                        var mediadata = '';
                        if ((resultdata.result).length > 0) {

                            for (var h in resultdata.result) {
                                mediadata += '<div class="col-md-3  col-sm-3 mt-2">';
                                mediadata += '<a href="<?php echo $config->getImageurl(); ?>' + resultdata.result[h].image + '" target="_blank">';
                                mediadata += '<img src="<?php echo $config->getImageurl(); ?>' + resultdata.result[h].image + '" alt="Diamond Media Image" title="Diamond Media Image">';
                                mediadata += '</a>';
                                mediadata += '<p><a href="javascript:void(0);" data-diamondid="' + resultdata.result[h].diamondid + '" data-id="' + resultdata.result[h].id + '" title="Remove Diamond Media " class="btn btn-danger mt-1 ml-1 removemydiamondmediaimage"><i class="fas fa-trash-alt"></i></a></p>';
                                mediadata += '</div>';
                            }
                        }
                        $('.mydiamondmediafileDiv').html(mediadata);

                    }else if(resultdata.status == -1)
                    {
                        $('#btnlogout').trigger('click');
                    }
                }    

            }

            function OnErrordeletereportfile(content) {
                ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
            }

        }, function() {

        });

    });

    $('body').on('change', '#my_diamond_per_page', function() {
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        $("#listmydiamondData").animate({
            scrollTop: 0
        }, "slow");
        listmydiamonddata(1);
    });

    $('body').on('change', '#mydiamondsortbyid', function() {
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        $("#listmydiamondData").animate({
            scrollTop: 0
        }, "slow");
        listmydiamonddata(1);
    });

    // $('#listmydiamondDatatbl tbody').scroll(function() {
    //     // alert();
    //     // //console.log('scrollTop:' + $(this).scrollTop());
    //     // //console.log('innerHeight:' + $(this).innerHeight());
    //     // //console.log('scrollHeight:' + $(this)[0].scrollHeight);
    //     // 
    //     if ($(this).scrollTop() +
    //         $(this).innerHeight() >=
    //         $(this)[0].scrollHeight) {
    //         // //console.log('Here');
    //         var dataact = getpagename();
    //         var show = $('#listmydiamondDatatbl').attr('data-show');
    //         // //console.log('dataact:' + dataact);
    //         // //console.log('show:' + show);
    //         if (dataact && show == 1) {
    //             listmydiamonddata(1);
    //         }
    //     }
    // });

    $('body').on('click','.pagination li.active',function(){
		var page = $(this).attr('p');

        $('#listmydiamondDatatbl').attr('data-nextpage', parseInt(page)-1);
        listmydiamonddata(page);
	}); 
                          
    $('body').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page){
            if(page != 0 && page <= no_of_pages){
                listmydiamonddata(page);
                $('#listmydiamondDatatbl').attr('data-nextpage', page);
            }else{
                sweetAlert('','Enter a PAGE between 1 to '+no_of_pages);
                $('.goto').val("").focus();
                return false;
            }
        }
                            
    });



    /* ******Sort By*******  */

    function listmydiamondsortby() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listdiamondsortby");
        formdata.append("ismydiamond", 1);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>master', formdata, headersdata, Onsuccesslistmydiamondsortby, OnErrorlistmydiamondsortby);

        function Onsuccesslistmydiamondsortby(data) {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.status == 0) {
                // Notiflix.Notify.Failure(resultdata.message);
            } else if (resultdata.status == 1) {
                var htmldata = '<option value="">Select Sort By</option>';
                if (resultdata.data.length > 0) {
                    for (var i in resultdata.data) {
                        htmldata += '<option value="' + resultdata.data[i].id + '">' + resultdata.data[i].name + '</option>';
                    }
                }

            }
            $('#mydiamondsortbyid').html(htmldata);
        }

        function OnErrorlistmydiamondsortby(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    }

    /* APPLY MY DIAMOND FILTERS */
    var mdshapearr = [];
    var mdfltfromsize = 0;
    var mdflttosize = 0;
    var mdcolorarr = [];
    var mdclarityarr = [];
    var mdfltfromprice = 0;
    var mdflttoprice = 0;

    function getmydiamondfiltersvalue() {

        mdshapearr = [];
        var s_mdfltshapemdid = $('#s_mdfltshapemdid').val();
        if (s_mdfltshapemdid.length > 0) {
            for (var i = 0; i < s_mdfltshapemdid.length; i++) {
                var shapeid = $('#s_mdfltshapemdid option[value=' + s_mdfltshapemdid[i] + ']').val();
                var shape = $('#s_mdfltshapemdid option[value=' + s_mdfltshapemdid[i] + ']').text();
                mdshapearr.push({
                    'id': shapeid,
                    'name': shape
                });

            }
        }
        mdfltfromsize = $('#s_mdfltfrommdsize').val();
        mdflttosize = $('#s_mdflttomdsize').val();

        mdcolorarr = [];
        var s_mdfltcolormdid = $('#s_mdfltcolormdid').val();
        if (s_mdfltcolormdid.length > 0) {
            for (var i = 0; i < s_mdfltcolormdid.length; i++) {
                var colorid = $('#s_mdfltcolormdid option[value=' + s_mdfltcolormdid[i] + ']').val();
                var color = $('#s_mdfltcolormdid option[value=' + s_mdfltcolormdid[i] + ']').text();
                mdcolorarr.push({
                    'id': colorid,
                    'name': color
                });

            }
        }

        mdclarityarr = [];
        var s_mdfltclaritymdid = $('#s_mdfltclaritymdid').val();
        if (s_mdfltclaritymdid.length > 0) {
            for (var i = 0; i < s_mdfltclaritymdid.length; i++) {
                var clarityid = $('#s_mdfltclaritymdid option[value=' + s_mdfltclaritymdid[i] + ']').val();
                var clarity = $('#s_mdfltclaritymdid option[value=' + s_mdfltclaritymdid[i] + ']').text();
                mdclarityarr.push({
                    'id': clarityid,
                    'name': clarity
                });

            }
        }
        mdfltfromprice = $('#s_mdfltfrompricemd').val();
        mdflttoprice = $('#s_mdflttopricemd').val();
    }

    $('body').on('change', '#form-mydiamond-side-search .select2', function() {
        getmydiamondfiltersvalue();
        checkmydiamondformelementvalue();
    });

    $('body').on('input', '#form-mydiamond-side-search #s_mdfltfrommdsize,#s_mdflttomdsize,#s_mdfltfrompricemd,#s_mdflttopricemd', function() {
        getmydiamondfiltersvalue();
        checkmydiamondformelementvalue();
    });

    function checkmydiamondformelementvalue() {
        var issearchbtn = 0;
        var s_mdfltshapemdid = $('#form-mydiamond-side-search #s_mdfltshapemdid').val();
        if (s_mdfltshapemdid.length > 0) {
            issearchbtn++;
        }
        s_mdfltfrommdsize = $('#s_mdfltfrommdsize').val();
        s_mdflttomdsize = $('#s_mdflttomdsize').val();
        if (s_mdfltfrommdsize && s_mdflttomdsize > 0) {
            issearchbtn++;
        }

        var s_mdfltcolormdid = $('#form-mydiamond-side-search #s_mdfltcolormdid').val();
        if (s_mdfltcolormdid.length > 0) {
            issearchbtn++;
        }

        var s_mdfltclaritymdid = $('#form-mydiamond-side-search #s_mdfltclaritymdid').val();
        if (s_mdfltclaritymdid.length > 0) {
            issearchbtn++;
        }

        s_mdfltfrompricemd = $('#s_mdfltfrompricemd').val();
        s_mdflttopricemd = $('#s_mdflttopricemd').val();
        if (s_mdfltfrompricemd && s_mdflttopricemd > 0) {
            issearchbtn++;
        }

        $('#form-mydiamond-side-search #btnapplymydiamonddiamondfilter').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-mydiamond-side-search #btnapplymydiamonddiamondfilter').attr('disabled', false);
        }
        // //console.log(issearchbtn);
        return issearchbtn;
    }

    if ($('#form-mydiamond-side-search').length) {
        $('#form-mydiamond-side-search').validate({
            rules: {
                fltfromsize: {
                    number: true
                },
                flttosize: {
                    greaterThan: '#s_mdfltfrommdsize',
                    number: true
                },
                fltfromprice: {
                    number: true
                },
                flttoprice: {
                    greaterThan: '#s_mdflttopricemd',
                    number: true
                },

            },
            messages: {
                flttosize: {
                    greaterThan: 'To size greater than or equal From size',
                },
                flttoprice: {
                    greaterThan: 'To price greater than or equal From price',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checkmydiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchmydiamondlist(2);
                    $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                    listmydiamonddata(1, 'form-mydiamond-side-search');
                    $(".listmydiamondDataDiv .wrappernew.toggled").toggleClass("intro");
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }

    function fillsearchmydiamondlist(type) {
        var htmllistdata = '';

        if (mdshapearr.length > 0) {
            for (var i = 0; i < mdshapearr.length; i++) {
                var id = mdshapearr[i].id;
                var name = mdshapearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemdshapeflt  mdfltshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (mdfltfromsize && mdflttosize > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removemdfromtosize searchbtnset"><b> Size : </b><span>' + mdfltfromsize + '-' + mdflttosize + '</span> <span class="btn-remove-tag">X</span></a>';
        }



        if (mdcolorarr.length > 0) {
            for (var i = 0; i < mdcolorarr.length; i++) {
                var id = mdcolorarr[i].id;
                var name = mdcolorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemdcolorflt  mdfltcolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (mdclarityarr.length > 0) {
            for (var i = 0; i < mdclarityarr.length; i++) {
                var id = mdclarityarr[i].id;
                var name = mdclarityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemdclarityflt  mdfltclarity' + id + ' searchbtnset"><b> Clarity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if (mdfltfromprice && mdflttoprice > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removemdfromtoprice m-1 searchbtnset"><b> Price : </b><span>$' + mdfltfromprice + '-$' + mdflttoprice + '</span> <span class="btn-remove-tag">X</span></a>';
        }
        $('.searchmydiamondlistDiv').html(htmllistdata);
    }
    function removeindexfromarrmd(arrname, id) {
        var _index;
        var arrid = [];
        $.each(arrname, function(i, value) {
            if (value.id == id) {
                _index = i;
            } else {
                arrid.push(value.id);
            }
        });
        arrname.splice(_index, 1);
        return arrid;
    }

    $('body').on('click', '.removemdshapeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.mdfltshape' + id + '').remove();
        var arrid = removeindexfromarrmd(mdshapearr, id);
        $("#s_mdfltshapemdid").val(arrid).trigger('change');
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdfromtosize', function() {
        var type = $(this).attr('data-type');
        $('#s_mdfltfrommdsize').val(0);
        $('#s_mdflttomdsize').val(0);
        $(this).remove();
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdcolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.mdfltcolor' + id + '').remove();
        var arrid = removeindexfromarrmd(mdcolorarr, id);
        $("#s_mdfltcolormdid").val(arrid).trigger('change');
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdclarityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.mdfltclarity' + id + '').remove();
        var arrid = removeindexfromarrmd(mdclarityarr, id);
        $("#s_mdfltclaritymdid").val(arrid).trigger('change');
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });

    $('body').on('click', '.removemdfromtoprice', function() {
        var type = $(this).attr('data-type');
        $('#s_mdfltfrompricemd').val(0);
        $('#s_mdflttopricemd').val(0);
        $(this).remove();
        $('#listmydiamondDatatbl').attr('data-nextpage', 0);
        listmydiamonddata(1, 'form-mydiamond-side-search');
    });


    $('body').on('click', '.btnshowmydiamonddetail', function() {
        
        $('.chart-loading').show();
        var diamondid = $(this).attr('data-diamondid');
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 4,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
        formdata = new FormData();
        formdata.append("action", "listdiamond");
        formdata.append("id", diamondid);
        formdata.append("nextpage", 1);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessshowmydiamonddetail, OnErrorshowmydiamonddetail);

        function Onsuccessshowmydiamonddetail(data) {
            $('.chart-loading').hide();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                    Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
                }
                else{
                if (resultdata.status == 0) {
                    // Notiflix.Notify.Failure(resultdata.message);
                } else if (resultdata.status == 1) {
                    if (resultdata.data.length > 0) {
                        for (var i in resultdata.data) {

                            var diamonddata = resultdata.data[i];

                            var title = diamonddata.cmpname + ' | Lot # ' + diamonddata.savanilotnumber;
                            $('#ListDiamondDataDetailModalLongTitle').html(title);

                            htmldata += '<div class="col-12">';
                            htmldata += '<div class="row">';
                            htmldata += '<div class="col-md-12">';
                            htmldata += '<div class="row">';
                            htmldata += '<div class="col-md-8">';
                            htmldata += '<div class="diamondsearch">';
                            htmldata += '<ul>';
                            htmldata += '<li>';
                            // htmldata += '<div class="starimg">';
                            // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                            // htmldata += '</div>';
                            if(diamonddata.isparcel==1)
                            {
                                htmldata += '<h4>' + diamonddata.shape + ', ' + diamonddata.sievename + '-' + diamonddata.tosievename + ', ' + diamonddata.color + ', ' + diamonddata.clarity + ', ' + diamonddata.cut + ', ' + diamonddata.polish + ', ' + diamonddata.symmetry + '</h4>';

                            }
                            else{
                                htmldata += '<h4>' + diamonddata.shape + ', ' + diamonddata.size + ', ' + diamonddata.color + ', ' + diamonddata.clarity + ', ' + diamonddata.cut + ', ' + diamonddata.polish + ', ' + diamonddata.symmetry + '</h4>';

                            }
                            htmldata += '</li>';
                            htmldata += '<li><b>$/Ct &nbsp</b> : $' + diamonddata.price + '</li>';
                            
                            if(diamonddata.savanipercentage!='')
                            {
                                htmldata += '<li><b>Discount (%) &nbsp</b> : ' + diamonddata.savanipercentage + '%</li>';
                            }
                            htmldata += '<li><b>Total Price &nbsp</b> : $' + diamonddata.totalprice + '</li>';
                            htmldata += '<li><b>Availability &nbsp</b> : ' + diamonddata.availability + '</li>';
                            htmldata += '<li> <b>LAB &nbsp</b> : ' + diamonddata.lab + '</li>';
                            htmldata += '<li> <b>Certi number &nbsp</b> : ' + diamonddata.reportnumber + '</li>';
                            // if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                            //     htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                            // }
                            // if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                            //     htmldata += '<li><a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a></li>';
                            // }
                            htmldata += '</ul>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            // htmldata += '<div class="col-md-4 contectse text-center">';
                            // htmldata += '</div>';
                            htmldata += '<div class="col-12 searmedia">';
                            htmldata += '<div class="row">';
                            htmldata += '<div class="col-md-4 mediasearch">';

                            htmldata += '<h5>Media</h5>';
                            htmldata += '<div class="media">';
                            if (diamonddata.diamondimagedetail.length > 0) {
                                for (var im in diamonddata.diamondimagedetail) {
                                    htmldata += '<div class="mediaurl mr-2">';
                                    htmldata += '<a href="<?php echo $config->getImageurl(); ?>' + diamonddata.diamondimagedetail[im].image + '" target="_blank">';
                                    htmldata += '<img src="<?php echo $config->getImageurl(); ?>' + diamonddata.diamondimagedetail[im].image + '" alt="' + diamonddata.stock + '" width="100%" title="' + diamonddata.stock + '">';
                                    htmldata += '</a>';
                                    htmldata += '</div>';
                                }

                            } else {

                                htmldata += ' <b<span>No Media</span></b>';
                            }

                            htmldata += '</div>';

                            if (diamonddata.diamondimglink != '' && diamonddata.diamondimglink != null) {
                                htmldata += '<h5>Image URL</h5>';
                                htmldata += '<div class="media">';
                                htmldata += '<div class="mediaurl mr-2">';
                                htmldata += '<a href="' + diamonddata.diamondimglink + '" target="_blank">';
                                htmldata += '<i class="fas fa-image"></i>';
                                htmldata += '</a>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                            }
                            if (diamonddata.videolink != '' && diamonddata.videolink != null) {
                                htmldata += '<h5>Media URL</h5>';
                                htmldata += '<div class="media">';
                                htmldata += '<div class="mediaurl">';
                                htmldata += '<a href="' + diamonddata.videolink + '" target="_blank"><i class="fas fa-play"></i>';
                                htmldata += '</div>';
                                htmldata += '</div>'; 
                            } 
                            if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                                htmldata += '<h5>Report File</h5>';
                                htmldata += '<div class="media">';
                                htmldata += '<div class="mediaurl">';
                                htmldata += '<a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                            }
                            if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                                htmldata += '<h5>Report File URL</h5>';
                                htmldata += '<div class="media">';
                                htmldata += '<div class="mediaurl">';
                                htmldata += '<a href="' + diamonddata.reportfilelink + '" target="_blank"><i class="fas fa-link"></i></a>';
                                htmldata += '</div>';
                                htmldata += '</div>';
                            }
                            if (diamonddata.keytosymbols != '' && diamonddata.keytosymbols != null) {
                                htmldata += '<ul>';
                                // htmldata += '<li><b>plot<br><span>No lot</span></b></li>';
                                htmldata += '<li><b>Key To symbols<br><span>' + diamonddata.keytosymbols + '</span></b></li>';
                                htmldata += '</ul>';
                            }

                            htmldata += '</div>';


                            htmldata += '<div class="col-md-8 addsearchdetail">';
                            htmldata += '<div class="card">';
                            htmldata += '<h4>Diamond Details</h4>';
                            htmldata += '<div class="card-body">';
                            htmldata += '<ul>';
                            htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                            htmldata += '<li><b>Fluorescence Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.intensity + '</span></li>';
                            htmldata += '<li><b>Fluorescene Color</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                            htmldata += '<li><b>Total Depth%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depth + '%</span></li>';
                            htmldata += '<li><b>Table%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '%</span></li>';
                            htmldata += '<li><b>Measurement </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                            // htmldata += '<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; New</span></li>';
                            htmldata += '<li><b>Gridle Condition</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlecondition + '</span></li>';
                            htmldata += '<li><b>Gridle Min</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlemin + '</span></li>';
                            htmldata += '<li><b>Gridle Max</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlemax + '</span></li>';
                            htmldata += '<li><b>Gridle%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridleper + '%</span></li>';
                            htmldata += '<li><b>Culet Condition</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.culetcondition + '</span></li>';
                            htmldata += '<li><b>Culet Size</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.culetsize + '</span></li>';
                            htmldata += '<li><b>Treatment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.treatment + '</span></li>';
                            htmldata += '<li><b>Crown</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.crownangle + ',' + diamonddata.crownheight + '</span></li>';
                            htmldata += '<li><b>Pavilion.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.pavilionangle + ',' + diamonddata.pavilionheight + '</span></li>';
                            htmldata += '<li><b>Star length</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.starlength + '</span></li>';
                            // htmldata += '</ul>';
                            // htmldata += '<ul>';
                            // htmldata += '<h5>Diamond details</h5>';
                            // // htmldata += '<li><b>BGM</b>: <span class="metalpurity1">&nbsp; No BGM</span></li>';
                            htmldata += '<li><b>Shade</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.shade + '</span></li>';
                            htmldata += '<li><b>Eye Clean</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.eyeclean + '</span></li>';
                            htmldata += '<li><b>Open Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.openinclusions + '</span></li>';
                            htmldata += '<li><b>Black Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.blackinclusions + '</span></li>';
                            htmldata += '<li><b>White Inclusions</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.whiteinclusions + '</span></li>';
                            htmldata += '<li><b>Milky</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.milky + '</span></li>';
                            htmldata += '<li><b>Clarity(Eye Clean)</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '(' + diamonddata.eyeclean + ')</span></li>';
                            htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                            htmldata += '<li><b>Supplier Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.suppliercomment + '</span></li>';

                            htmldata += '<li><b>Report Date</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportdate + '</span></li>';
                            htmldata += '<li><b>Lab Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lablocation + '</span></li>';
                            htmldata += '<li><b>Report Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportcomment + '</span></li>';
                            htmldata += '<li><b>Fancy Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancyintensity + '</span></li>';
                            htmldata += '<li><b>Overtone</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.overtone + '</span></li>';
                            htmldata += '<li><b>Fancy Color 1</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor1 + '</span></li>';
                            htmldata += '<li><b>Fancy Color 2</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor2 + '</span></li>';
                            htmldata += '<li><b>Stock Number</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                            htmldata += '<li><b>Trade Show</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tradeshow + '</span></li>';
                            htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                            htmldata += '<li><b>Rough Diamond Source</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.roughdiamondsource + '</span></li>';
                            htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            htmldata += '</ul>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            // htmldata += '<div class="Notessearchd">';
                            // htmldata += '<ul>';
                            // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            // // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            // htmldata += '</ul>';
                            // htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';

                            // htmldata += '<div class="col-md-4 addsearchdetail">';
                            // htmldata += '<div class="card">';
                            // htmldata += '<h4>Diamond Details</h4>';
                            // htmldata += '<div class="card-body">';
                            // htmldata += '<ul>';

                            // htmldata += '<li><b>Milky</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.milky + '</span></li>';
                            // htmldata += '<li><b>Clarity(Eye Clean)</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.clarity + '(' + diamonddata.eyeclean + ')</span></li>';
                            // htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                            // htmldata += '<li><b>Supplier Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.suppliercomment + '</span></li>';

                            // htmldata += '<li><b>Report Date</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportdate + '</span></li>';
                            // htmldata += '<li><b>Lab Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lablocation + '</span></li>';
                            // htmldata += '<li><b>Report Comment</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportcomment + '</span></li>';
                            // htmldata += '<li><b>Fancy Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancyintensity + '</span></li>';
                            // htmldata += '<li><b>Overtone</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.overtone + '</span></li>';
                            // htmldata += '<li><b>Fancy Color 1</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor1 + '</span></li>';
                            // htmldata += '<li><b>Fancy Color 2</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fancycolor2 + '</span></li>';
                            // htmldata += '<li><b>Stock Number</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
                            // htmldata += '<li><b>Trade Show</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tradeshow + '</span></li>';
                            // htmldata += '<li><b>Brand</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.brand + '</span></li>';
                            // htmldata += '<li><b>Rough Diamond Source</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.roughdiamondsource + '</span></li>';
                            // htmldata += '<li><b>Sleeve Name</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.sievename + '</span></li>';
                            // htmldata += '</ul>';
                            // htmldata += '</div>';
                            // htmldata += '</div>';
                            
                            // htmldata += '</div>';
                            // htmldata += '<div class="col-md-4 profilediamnd">';
                            // htmldata += '<div class="card">';
                            // htmldata += '<div class="card-body">';

                            // htmldata += '<div class="sellersearchd">';
                            // htmldata += '<h5>Seller Details</h5>';

                            // htmldata += '<div class="profileimgset">';
                            // htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                            // htmldata += '</div>';

                            // htmldata += '<h2>' + sellerdetails.companyname + '</h2>';
                            // htmldata += '<p><b>Savani ID #</b>' + sellerdetails.savaniid + '</p>';
                            // htmldata += '<ul>';
                            // htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.cityname + ',' + sellerdetails.statename + ', ' + sellerdetails.countryname + '</span></li>';
                            // htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                            // htmldata += '<li><b>Phone</b>: <span class="metalpurity1 phonesearch">&nbsp;<a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                            // htmldata += '</ul>';
                            // htmldata += '</div>';
                            // htmldata += '</div>';
                            // htmldata += '</div>';
                            // htmldata += '<div class="card">';
                            // htmldata += '<div class="card-body">';
                            // htmldata += '<div class="Notessearchd">';
                            // htmldata += '<ul>';
                            // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            // // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            // htmldata += '</ul>';
                            // htmldata += '</div>';

                            // htmldata += '</div>';

                            // htmldata += '</div>';
                            // htmldata += '</div>';
                            // htmldata += '</div>';

                            htmldata += '</div>';



                        }
                    }

                }else if(resultdata.status == -1)
                {
                    $('#btnlogout').trigger('click');
                }
                    $('#ListDiamondDataDetailModalLong #ListDiamondDataDetail').html(htmldata);
                    $('#ListDiamondDataDetailModalLong').modal('show');
                }    

        }

        function OnErrorshowmydiamonddetail(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    });
    var mmd = '<?php echo $_REQUEST['mmd']; ?>';
    // alert(mmd);
    if(mmd==1)
    {
        setTimeout(() => {
            $('#Diamond-pills-tab  #v-pills-3-tab').click();
            removefilterurl();
        }, 500);
        
    }


    $('.btndiamondupdateprice').on('click',function(){
        Notiflix.Confirm.Show(false, 'Are you sure, you want to update the diamond rate ?', false, false, function() {
            $('.chart-loading').show();
            
            var pagename = getpagename();
            var headersdata = {
                Accept: 'application/json',
                platform: 4,
                userpagename: pagename,
                useraction: 'editright',
                masterlisting: false,
                responsetype: 'JSON'
            };
            formdata = new FormData();
            formdata.append("action", "updatediamondprice");
            ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessupdatediamondprice, OnErrorupdatediamondprice);

            function Onsuccessupdatediamondprice(data) {
                $('.chart-loading').hide();
                var JsonData = JSON.stringify(data);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata = '';
                    if (resultdata.IsPackageExpire == 1) {
                        Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
                    }
                    else{
                        if (resultdata.status == 0) {
                            Notiflix.Notify.Failure(resultdata.message);
                        } else if (resultdata.status == 1) {
                            Notiflix.Notify.Success(resultdata.message);
                            $('#listmydiamondDatatbl').attr('data-nextpage', 0);
                            listmydiamonddata(1);
                        }else if(resultdata.status == -1)
                        {
                            $('#btnlogout').trigger('click');
                        }
                    }    

            }

            function OnErrorupdatediamondprice(content) {
                // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
            }
        });
    })
</script>