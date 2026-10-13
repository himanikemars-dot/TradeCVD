<script>
    /* *************************PARCEL DIAMOND******************************* */

    function checkparceldiamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-parcel-search input[type=checkbox]').each(function() {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-parcel-search #fltfromparcelsize').val();
        var flttosize = $('#form-diamond-parcel-search #flttoparcelsize').val();
        if (fltfromsize && flttosize > 0) {
            issearchbtn++;
        }else  if (fltfromsize > 0) {
            issearchbtn++;
        }

        var fltfrompiecepercarat = $('#form-diamond-parcel-search #fltfrompiecepercarat').val();
        var flttopiecepercarat = $('#form-diamond-parcel-search #flttopiecepercarat').val();
        if (fltfrompiecepercarat && flttopiecepercarat > 0) {
            issearchbtn++;
        }

        var fltfrompriceparcel = $('#form-diamond-parcel-search #fltfrompriceparcel').val();
        var flttopriceparcel = $('#form-diamond-parcel-search #flttopriceparcel').val();
        if (fltfrompriceparcel && flttopriceparcel > 0) {
            issearchbtn++;
        }

        var fltfromsavanipercentageparcel = $('#form-diamond-parcel-search #fltfromsavanipercentageparcel').val();
        var flttosavanipercentageparcel = $('#form-diamond-parcel-search #flttosavanipercentageparcel').val();
        if (fltfromsavanipercentageparcel && flttosavanipercentageparcel > 0) {
            issearchbtn++;
        }

        // var fltsieveid = $('#form-diamond-parcel-search #flttosieveid').val();
        // if (fltsieveid.length > 0) {
        //     issearchbtn++;
        // }
       
        var fltfromsieveid = $('#form-diamond-parcel-search #fltfromsieveid :selected').val();
        var flttosieveid = $('#form-diamond-parcel-search #flttosieveid :selected').val();
        if (fltfromsieveid!='' && flttosieveid!='') {
            issearchbtn++;
        }
       

        $('#form-diamond-parcel-search #btnparceldiamondsearch').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-parcel-search #btnparceldiamondsearch').attr('disabled', false);
        }
        // //console.log(issearchbtn);
        return issearchbtn;

    }

    $('body').on('change', '#form-diamond-parcel-search input[type=checkbox]', function() {
        checkparceldiamondformelementvalue();
        getparcelfiltersvalue();
    });
    $('body').on('change', '#form-diamond-parcel-search  .select2', function() {
        checkparceldiamondformelementvalue();
        getparcelfiltersvalue();
    });

    $('body').on('input', '#form-diamond-parcel-search #fltfromparcelsize,#flttoparcelsize,#fltfrompiecepercarat,#flttopiecepercarat,#fltfrompriceparcel,#flttopriceparcel,#fltfromsavanipercentageparcel,#flttosavanipercentageparcel', function() {
        checkparceldiamondformelementvalue();
        getparcelfiltersvalue();
    });

    /* MANAGE FILTERS */
    var shapeparcelarr = [];
    var shapeparcelidarr = [];

    var colorparcelarr = [];
    var colorparcelidarr = [];

    var clarityparcelarr = [];
    var clarityparcelidarr = [];

    // var sieveparcelarr = [];
    // var sieveparcelidarr = [];

    var fltfromparcelsize = 0;
    var flttoparcelsize = 0;
    var fltfrompiecepercarat = 0;
    var flttopiecepercarat = 0;
    var fltfrompriceparcel = 0;
    var flttopriceparcel = 0;
   
    var fltsievearr = [];

    var fltfromsievearr = [];
    var flttosievearr = [];

    var fltfromsieveidarr = [];
    var  flttosieveidarr = [];


    var fltfromsavanipercentageparcel = 0;
    var flttosavanipercentageparcel = 0;



    function getparcelfiltersvalue() {
        shapeparcelarr = [];
        shapeparcelidarr = [];

        $('#shapeparcelDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                shapeparcelarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                shapeparcelidarr.push($(this).val());
            }
        });

        if (shapeparcelidarr.length > 0) {
            $("#s_fltshapeparcelid").val(shapeparcelidarr).trigger('change');
            $('#s_fltshapeparcelid').select2();
        } else {
            $("#s_fltshapeparcelid").val(null).trigger('change');
            $('#s_fltshapeparcelid').select2();
        }

        fltfromsievearr = [];
        flttosievearr = [];

        fltfromsieveidarr = [];
        flttosieveidarr = [];

        var fltfromsieveid = $('#fltfromsieveid :selected').val();
        var fltfromsieveidname = $('#fltfromsieveid option:selected').text();

        var flttosieveid = $('#flttosieveid :selected').val();
        var flttosieveidname = $('#flttosieveid option:selected').text();

        if (fltfromsieveid!='' && flttosieveid!='') {
            fltfromsievearr.push({
                'id': fltfromsieveid,
                'name': fltfromsieveidname
            });
            // fltfromsieveidarr.push(fltfromsieveid);
            $('#s_fltfromsieveid').val(fltfromsieveid);
            $('#s_fltfromsieveid').select2();
            flttosievearr.push({
                'id': flttosieveid,
                'name': flttosieveidname
            });
            // flttosieveidarr.push(flttosieveid);
            $('#s_flttosieveid').val(flttosieveid);
            $('#s_flttosieveid').select2();
        }


       

        colorparcelarr = [];
        colorparcelidarr = [];
        $('#colorparcelDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                colorparcelarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                colorparcelidarr.push($(this).val());
            }
        });

        if (colorparcelidarr.length > 0) {
            $("#s_fltcolorparcelid").val(colorparcelidarr).trigger('change');
            $('#s_fltcolorparcelid').select2();
        } else {
            $("#s_fltcolorparcelid").val(null).trigger('change');
            $('#s_fltcolorparcelid').select2();
        }

        clarityparcelarr = [];
        clarityparcelidarr = [];
        $('#clarityparcelDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                clarityparcelarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                clarityparcelidarr.push($(this).val());
            }
        });

        if (clarityparcelidarr.length > 0) {
            $("#s_fltclarityparcelid").val(clarityparcelidarr).trigger('change');
            $('#s_fltclarityparcelid').select2();
        } else {
            $("#s_fltclarityparcelid").val(null).trigger('change');
            $('#s_fltclarityparcelid').select2();
        }



        // sieveparcelarr = [];
        // sieveparcelidarr = [];
        // var fltsieveid = $('#fltsieveid').val();
        // if (fltsieveid.length > 0) {
        //     for (var i = 0; i < fltsieveid.length; i++) {
        //         var sieveid = $('#fltsieveid option[value=' + fltsieveid[i] + ']').val();
        //         var sieve = $('#fltsieveid option[value=' + fltsieveid[i] + ']').text();
        //         sieveparcelarr.push({
        //             'id': sieveid,
        //             'name': sieve
        //         });
        //         sieveparcelidarr.push(sieveid);
        //     }
        // }

        // if (sieveparcelidarr.length > 0) {
        //     $("#s_fltsieveid").val(sieveparcelidarr).trigger('change');
        //     $('#s_fltsieveid').select2();
        // } else {
        //     $("#s_fltsieveid").val(null).trigger('change');
        //     $('#s_fltsieveid').select2();
        // }

        fltfromparcelsize = $('#fltfromparcelsize').val();
        $('#s_fltfromparcelsize').val(fltfromparcelsize);
        flttoparcelsize = $('#flttoparcelsize').val();
        $('#s_flttoparcelsize').val(flttoparcelsize);
        fltfrompiecepercarat = $('#fltfrompiecepercarat').val();
        $('#s_fltfrompiecepercarat').val(fltfrompiecepercarat);
        flttopiecepercarat = $('#flttopiecepercarat').val();
        $('#s_flttopiecepercarat').val(flttopiecepercarat);
        fltfrompriceparcel = $('#fltfrompriceparcel').val();
        $('#s_fltfrompriceparcel').val(fltfrompriceparcel);
        flttopriceparcel = $('#flttopriceparcel').val();
        $('#s_flttopriceparcel').val(flttopriceparcel);

        fltfromsavanipercentageparcel = $('#fltfromsavanipercentageparcel').val();
        $('#s_fltfromsavanipercentageparcel').val(fltfromsavanipercentageparcel);
        flttosavanipercentageparcel = $('#flttosavanipercentageparcel').val();
        $('#s_flttosavanipercentageparcel').val(flttosavanipercentageparcel);

        

        checksideparceldiamondformelementvalue();
        getparcelsidebarelementvalue();
    }


    $('body').on('change', '#form-diamond-parcel-side-search  .select2', function() {
        checksideparceldiamondformelementvalue();
        getparcelsidebarelementvalue();
    });

    $('body').on('input', '#form-diamond-parcel-side-search #s_fltfromparcelsize,#s_flttoparcelsize,#s_fltfrompiecepercarat,#s_flttopiecepercarat,#s_fltfrompriceparcel,#s_flttopriceparcel', function() {
        checksideparceldiamondformelementvalue();
        getparcelsidebarelementvalue();
    });

    function checksideparceldiamondformelementvalue() {
        var issearchbtn = 0;
        var fltshapeparcelid = $('#form-diamond-parcel-side-search #s_fltshapeparcelid').val();
        if (fltshapeparcelid!='') {
            issearchbtn++;
        }

        var fltcolorparcelid = $('#form-diamond-parcel-side-search #s_fltcolorparcelid').val();
        if (fltcolorparcelid!='') {
            issearchbtn++;
        }

        var fltclarityparcelid = $('#form-diamond-parcel-side-search #s_fltclarityparcelid').val();
        if (fltclarityparcelid!='') {
            issearchbtn++;
        }

        var fltfromparcelsize = $('#form-diamond-parcel-side-search #s_fltfromparcelsize').val();
        var flttoparcelsize = $('#form-diamond-parcel-side-search #s_flttoparcelsize').val();
        if (fltfromparcelsize && flttoparcelsize > 0) {
            issearchbtn++;
        }

        var fltfrompriceparcel = $('#form-diamond-parcel-side-search #s_fltfrompriceparcel').val();
        var flttopriceparcel = $('#form-diamond-parcel-side-search #s_flttopriceparcel').val();
        if (fltfrompriceparcel && flttopriceparcel > 0) {
            issearchbtn++;
        }

        var fltfromsavanipercentageparcel = $('#form-diamond-parcel-side-search #s_fltfromsavanipercentageparcel').val();
        var flttosavanipercentageparcel = $('#form-diamond-parcel-side-search #s_flttosavanipercentageparcel').val();
        if (fltfromsavanipercentageparcel && flttosavanipercentageparcel > 0) {
            issearchbtn++;
        }

        var fltfrompiecepercarat = $('#form-diamond-parcel-side-search #s_fltfrompiecepercarat').val();
        var flttopiecepercarat = $('#form-diamond-parcel-side-search #s_flttopiecepercarat').val();
        if (fltfrompiecepercarat && flttopiecepercarat > 0) {
            issearchbtn++;
        }

        // var fltsieveid = $('#form-diamond-parcel-side-search #s_fltsieveid').val();
        // if (fltsieveid.length > 0) {
        //     issearchbtn++;
        // }
        // console.log(issearchbtn);
        var fltfromsieveid = $('#form-diamond-parcel-side-search #s_fltfromsieveid').val();
        var flttosieveid = $('#form-diamond-parcel-side-search #s_flttosieveid').val();
        if (fltfromsieveid !='' && flttosieveid !='') {
            // console.log(issearchbtn);
            issearchbtn++;
        }
       

        $('#form-diamond-parcel-side-search #btnapplyparceldiamondfilter').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-parcel-side-search #btnapplyparceldiamondfilter').attr('disabled', false);
        }



        return issearchbtn;
    }

    function getparcelsidebarelementvalue() {
        shapeparcelarr = [];
        shapeparcelidarr = [];

        var fltshapeparcelid = $('#s_fltshapeparcelid').val();
        if (fltshapeparcelid.length > 0) {
            for (var i = 0; i < fltshapeparcelid.length; i++) {
                var shapeid = $('#s_fltshapeparcelid option[value=' + fltshapeparcelid[i] + ']').val();
                var shape = $('#s_fltshapeparcelid option[value=' + fltshapeparcelid[i] + ']').text();
                shapeparcelarr.push({
                    'id': shapeid,
                    'name': shape
                });
                shapeparcelidarr.push(shapeid);
            }
        }

        colorparcelarr = [];
        colorparcelidarr = [];

        var fltcolorparcelid = $('#s_fltcolorparcelid').val();
        if (fltcolorparcelid.length > 0) {
            for (var i = 0; i < fltcolorparcelid.length; i++) {
                var colorid = $('#s_fltcolorparcelid option[value=' + fltcolorparcelid[i] + ']').val();
                var color = $('#s_fltcolorparcelid option[value=' + fltcolorparcelid[i] + ']').text();
                colorparcelarr.push({
                    'id': colorid,
                    'name': color
                });
                colorparcelidarr.push(colorid);
            }
        }

        clarityparcelarr = [];
        clarityparcelidarr = [];

        var fltclarityparcelid = $('#s_fltclarityparcelid').val();
        if (fltclarityparcelid.length > 0) {
            for (var i = 0; i < fltclarityparcelid.length; i++) {
                var clarityid = $('#s_fltclarityparcelid option[value=' + fltclarityparcelid[i] + ']').val();
                var clarity = $('#s_fltclarityparcelid option[value=' + fltclarityparcelid[i] + ']').text();
                clarityparcelarr.push({
                    'id': clarityid,
                    'name': clarity
                });
                clarityparcelidarr.push(clarityid);
            }
        }

        // sieveparcelarr = [];
        // sieveparcelidarr = [];

        // var fltsieveid = $('#s_fltsieveid').val();
        // if (fltsieveid.length > 0) {
        //     for (var i = 0; i < fltsieveid.length; i++) {
        //         var sieveid = $('#s_fltsieveid option[value=' + fltsieveid[i] + ']').val();
        //         var sieve = $('#s_fltsieveid option[value=' + fltsieveid[i] + ']').text();
        //         sieveparcelarr.push({
        //             'id': sieveid,
        //             'name': sieve
        //         });
        //         sieveparcelidarr.push(sieveid);
        //     }
        // }

        fltfromsievearr = [];
        flttosievearr = [];

        fltfromsieveidarr = [];
        flttosieveidarr = [];

        var fltfromsieveid = $('#s_fltfromsieveid :selected').val();
        var fltfromsieveidname = $('#s_fltfromsieveid option:selected').text();

        var flttosieveid = $('#s_flttosieveid :selected').val();
        var flttosieveidname = $('#s_flttosieveid option:selected').text();

        if (fltfromsieveid!='' && flttosieveid!='') {
            fltfromsievearr.push({
                'id': fltfromsieveid,
                'name': fltfromsieveidname
            });
            fltfromsieveidarr.push(fltfromsieveid);

            flttosievearr.push({
                'id': flttosieveid,
                'name': flttosieveidname
            });
            flttosieveidarr.push(flttosieveid);
           
        }

        
        fltfromparcelsize = $('#s_fltfromparcelsize').val();
        flttoparcelsize = $('#s_flttoparcelsize').val();
        fltfrompiecepercarat = $('#s_fltfrompiecepercarat').val();
        flttopiecepercarat = $('#s_flttopiecepercarat').val();
        fltfrompriceparcel = $('#s_fltfrompriceparcel').val();
        flttopriceparcel = $('#s_flttopriceparcel').val();

        fltfromsavanipercentageparcel = $('#s_fltfromsavanipercentageparcel').val();
        flttosavanipercentageparcel = $('#s_flttosavanipercentageparcel').val();
        
        

    }

    if ($('#form-diamond-parcel-search').length) {
        $('#form-diamond-parcel-search').validate({
            rules: {
                fltfromparcelsize: {
                    number: true
                },
                flttoparcelsize: {
                    // greaterThan: '#fltfromparcelsize',
                    number: true
                },
                fltfrompiecepercarat: {
                    number: true
                },
                flttopiecepercarat: {
                    // greaterThan: '#fltfrompiecepercarat',
                    number: true
                },
                fltfrompriceparcel: {
                    number: true
                },
                flttopriceparcel: {
                    // greaterThan: '#fltfrompriceparcel',
                    number: true
                },

                fltfromsavanipercentageparcel: {
                    number: true
                },
                flttosavanipercentageparcel: {
                    // greaterThan: '#fltfromsavanipercentageparcel',
                    number: true
                },
                
            },
            messages: {
                flttoparcelsize: {
                    // greaterThan: 'To size greater than or equal From size',
                },
                flttopiecepercarat: {
                    // greaterThan: 'To piece per carat greater than or equal From piece per carat',
                },
                flttopriceparcel: {
                    // greaterThan: 'To price greater than or equal From price',
                },
                flttosavanipercentageparcel: {
                    // greaterThan: 'To percentage greater than or equal From percentage',
                },
                flttoratio: {
                    // greaterThan: 'To ratio greater than or equal From ratio',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checkparceldiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchparceldiamondlist(1);
                    $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
                    listparceldiamonddata(1, 'form-diamond-parcel-search');
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }

    if ($('#form-diamond-parcel-side-search').length) {
        $('#form-diamond-parcel-side-search').validate({
            rules: {
                fltfromparcelsize: {
                    number: true
                },
                flttoparcelsize: {
                    // greaterThan: '#s_fltfromparcelsize',
                    number: true
                },
                fltfrompiecepercarat: {
                    number: true
                },
                flttopiecepercarat: {
                    // greaterThan: '#s_fltfrompiecepercarat',
                    number: true
                },
                fltfrompriceparcel: {
                    number: true
                },
                flttopriceparcel: {
                    // greaterThan: '#s_fltfrompriceparcel',
                    number: true
                },

                fltfromsavanipercentageparcel: {
                    number: true
                },
                flttosavanipercentageparcel: {
                    // greaterThan: '#s_fltfromsavanipercentageparcel',
                    number: true
                },

               
            },
            messages: {
                flttoparcelsize: {
                    // greaterThan: 'To size greater than or equal From size',
                },
                flttopiecepercarat: {
                    // greaterThan: 'To piece per carat greater than or equal From piece per carat',
                },
                flttopriceparcel: {
                    // greaterThan: 'To price greater than or equal From price',
                },
                flttosavanipercentageparcel: {
                    // greaterThan: 'To percentage greater than or equal From percentage',
                },
                
            },
            submitHandler: function(form) {

                var issearchbtn = checksideparceldiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchparceldiamondlist(2);
                    $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
                    listparceldiamonddata(1, 'form-diamond-parcel-side-search');
                    $(".wrappernew.toggled").toggleClass("intro");
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }


    function listparceldiamonddata(page, form = null) {


        var id = '<?php echo $id; ?>';
        // var form = $('#form-diamond-search').serialize();
        // showloader();
        $('.chart-loading').show();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#parceldiamond_per_page').val();
        var sortbyid = $('#parcelsortbyid').val();

        var nextpage = 0;
        if ($('#listparceldiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listparceldiamondDatatbl').attr('data-nextpage');
        }

        formdata = new FormData(document.getElementById('form-diamond-parcel-search'));
        if (form != null) {
            formdata = new FormData(document.getElementById(form));
            checksideparceldiamondformelementvalue();
        }



        formdata.append("action", "listdiamond");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltparcel", 1);
        formdata.append("fltmanagemydiamond", 0);
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistparceldiamond, OnErrorlistparceldiamond)

        function Onsuccesslistparceldiamond(data) {
            // hideloader();
            
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#parcelpaginationDiv').html('');
            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
            }
            else{
                if (resultdata.status == 0) {
                    // Notiflix.Notify.Failure(resultdata.message);
                    $('#form-diamond-parcel-search').addClass('d-none');
                    $('.listdiamondparcelDataDiv').removeClass('d-none');

                    htmldata += '<tr>';
                    htmldata += '<td colspan="16">';
                    htmldata += '<h3>' + resultdata.message + '</h3>';
                    htmldata += '</td>';
                    htmldata += '</tr>';

                    $('.listdiamondparcelDataDiv #listparceldiamondData').html(htmldata);
                    $('#showparceldiamondentries').html(0);

                    $('.listdiamondparcelDataDiv .totalparceldiamonds').html('0 Diamonds ');
                    $('.listdiamondparcelDataDiv .totalparcelprice').html('Total Price : $0');


                } else if (resultdata.status == 1) {
                    $('#form-diamond-parcel-search').addClass('d-none');
                    $('.listdiamondparcelDataDiv').removeClass('d-none');
                    if (resultdata.totaldiamond >= 0 && resultdata.totalprice >= 0 && resultdata.totaldiamond != null && resultdata.totalprice != null) {
                        // //console.log('totaldiamond'+resultdata.totaldiamond);
                        // //console.log('totalprice'+resultdata.totalprice);
                        $('.listdiamondparcelDataDiv .totalparceldiamonds').html(resultdata.totaldiamond + ' Diamonds ');
                        $('.listdiamondparcelDataDiv .totalparcelprice').html('Total Price : $' + resultdata.totalprice);
                    }


                    for (var i in resultdata.data) {
                        var diamonddata = resultdata.data[i];
                        var ariaexpand="false";
                        var datacollapsed="collapsed";

                        htmldata += '<tr data-toggle="collapse" data-target="#searchdown' + diamonddata.id + '" data-index="'+diamonddata.id+'" aria-expanded="'+ariaexpand+'" class="sdown' + diamonddata.id + ' tbl-highlight-tr clasaccordian '+datacollapsed+'">';
                        htmldata += '<td class="tbl-highlight-td">';
                        // htmldata += '<div class="form-check">';
                        // htmldata += '<input class="form-check-input sbox" type="checkbox" value="' + diamonddata.id + '" id="selectdiamondid' + diamonddata.id + '">';
                        // htmldata += '<label class="form-check-label searchcheckbox" for="selectdiamondid' + diamonddata.id + '">';

                        // htmldata += '</label>';
                        // htmldata += '</div>';
                        // htmldata += '' + diamonddata.personname + '';
                        if (diamonddata.persondetail[0].companyname.length > 7){
                            htmldata += diamonddata.persondetail[0].companyname.substring(0,6)+'...';
                        } else{
                            htmldata += '' +  diamonddata.persondetail[0].companyname + '';
                        }
                        htmldata += '</td>';
                        // htmldata+='<td>';
                        // htmldata+='<div class="searchreating">100%</div>';
                        // htmldata+='</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.savanilotnumber + '</td>';
                        // htmldata += '<td class="tbl-highlight-td">' + diamonddata.shape + '</td>';
                        htmldata += '<td class="tbl-highlight-td">';
                            if(diamonddata.shape.length>7)
                            {
                                htmldata += diamonddata.shape.substring(0,7)+'...' ; 
                            }else{
                                htmldata += diamonddata.shape ; 
                            }
                         htmldata += '</td>';
                        htmldata += '<td class="tbl-highlight-td">Parcel</td>';
                        // htmldata += '<td class="tbl-highlight-td">' + diamonddata.size + '</td>';
                        var avgsize=((parseFloat(diamonddata.sievename) + parseFloat(diamonddata.tosievename))/2);
                        // htmldata += '<td class="tbl-highlight-td">' + avgsize + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.sievename + ' - ' + diamonddata.tosievename + '</td>';
                        
                        // htmldata += '<td class="tbl-highlight-td">' + diamonddata.color + '</td>';
                        htmldata += '<td class="tbl-highlight-td">';
                        if(diamonddata.color.length>7)
                        {
                            htmldata += diamonddata.color.substring(0,6)+'...';
                        }else{
                            htmldata += diamonddata.color;
                        }
                         htmldata += '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.clarity + '</td>';
                        // htmldata += '<td class="tbl-highlight-td">' + diamonddata.price + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.numofdiamond + '</td>';
                        // htmldata += '<td>' + diamonddata.cut + '</td>';
                        // htmldata += '<td>' + diamonddata.polish + '</td>';
                        // htmldata += '<td>' + diamonddata.symmetry + '</td>';
                        // htmldata += '<td>' + diamonddata.fluorescenecolor + '</td>';
                        // htmldata += '<td>' + diamonddata.lab + '</td>';
                        // htmldata+='<td>$354</td>';
                        // htmldata+='<td>-83.9%</td>';
                        htmldata += '<td class="tbl-highlight-td">$' + diamonddata.price + '</td>';
                        htmldata += '<td class="tbl-highlight-td">$' + diamonddata.totalprice + '</td>';
                        var ppc=parseFloat(1/avgsize).toFixed(4) ;
                        htmldata += '<td class="tbl-highlight-td">' + ppc + '</td>';
                        // htmldata += '<td>' + diamonddata.depthper + '%</td>';
                        // htmldata += '<td>' + diamonddata.tableper + '%</td>';
                        // htmldata += '<td>' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                        // htmldata += '<td>' + diamonddata.stocknumber + '</td>';
                        // htmldata+='<td>G</td>';
                        // htmldata+='<td>-</td>';
                        // htmldata+='<td>1.132</td>';
                        htmldata += '</tr>';

                        htmldata += '<td class="searchPadding">';
                        htmldata += '<div class="collapse" id="searchdown' + diamonddata.id + '">';
                        htmldata += '<div class="col-12 col-md-12 searchddetail search-pagedeta">';
                        htmldata += '<div class="text-left searchleft">';
                        htmldata += '<div class="diamondsearch">';
                        htmldata += '<ul>';
                        htmldata += '<li>';
                        // htmldata += '<div class="starimg">';
                        // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                        // htmldata += '</div>';
                        htmldata += '<h4>' + diamonddata.shape + ', ' + diamonddata.sievename + '-' + diamonddata.tosievename + ', ' + diamonddata.color + ', ' + diamonddata.clarity + '</h4>';
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
                        htmldata += '<div class="searchgreade searchcom">';
                        <?php
                        if ($CanMemberToMemberChat == 1) {
                        ?>
                            if(diamonddata.ismydiamond==1){
                                htmldata += '<button type="button" class="btn searchbtnset contactdiamondseller allbtn-small" data-diamondsize="' + diamonddata.size + '" data-diamondid="' + diamonddata.id + '" data-diamondname="'+ diamonddata.stock +',' + diamonddata.shape + ',' + diamonddata.sievename + ' - ' + diamonddata.tosievename + ',' + diamonddata.color + ',' + diamonddata.clarity + '">Contact Seller</button>';
                            }
                            <?php
                        } ?>
                        htmldata += '</div>';
                        // htmldata+='<div class="searchgreade searchcom">';
                        // htmldata+='<button type="button" class="btn searchbtnset">Compare</button>';
                        // htmldata+='</div>';
                        // htmldata += '<div class="searchgreade searchcom">';
                        // htmldata += '<button type="button" class="btn searchbtnset btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '" >Diamond Page</button>';
                        // htmldata += '</div>';
                        // htmldata+='<div class="searchgreade searchcom">';
                        // htmldata+='<button type="button" class="btn searchbtnset">More</button>';
                        // htmldata+='</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
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
                        htmldata += '<li><b>Avg. Size</b>: <span class="metalpurity1">&nbsp; ' + avgsize + '</span></li>';
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
                        htmldata+='<li><b>PPC</b>: <span class="metalpurity1">&nbsp; '+ppc+'</span></li>';
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
                        // htmldata += '<li><b>$/Ct</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                        htmldata += '<div class="row dimondpricedata">';
                            htmldata += '<div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 set_dis_deta dis_newprice">';
                                htmldata += '<li><b>Price</b></li>';
                            htmldata += '</div>';
                            htmldata += '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 set_dis_deta">';
                                htmldata += '<li><b>$/ct</b></li>';
                                htmldata += '<span class="metalpurity1">$' + diamonddata.price + '</span>';
                            htmldata += '</div>';
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
                        htmldata += '<li class="hidephoneno1" data-id="'+diamonddata.id+'"><b>Phone</b>: <span class="metalpurity1" title="Click To Unlock">&nbsp; ***** ***** <i class="fas fa-lock"></i></span></li>';
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
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</div>';
                        htmldata += '</td>';





                    }
                    $('.listdiamondparcelDataDiv #listparceldiamondData').html(htmldata);
                    $('#parcelpaginationDiv').html(resultdata.pagedata);

                    var tbody_height = $(document).height()-$('header').height()-$('.parceldiamond-footer-page').height()-$('#listparceldiamondDatatbl thead').height()-$('.parceldiamond-header-page').height();
                    $('#listparceldiamondDatatbl tbody').css('max-height',tbody_height);


                   /*  if (resultdata.nextpage == 1) {
                        $('.listdiamondparcelDataDiv #listparceldiamondData').html(htmldata);
                    } else {
                        $('.listdiamondparcelDataDiv #listparceldiamondData').append(htmldata);
                    } */
                    $('#showparceldiamondentries').html(resultdata.showentries);
                    $('#listparceldiamondDatatbl').attr('data-nextpage', resultdata.nextpage);
                    if (resultdata.loadmore == 1) {
                        $('#listparceldiamondDatatbl').attr('data-show', 1);
                    } else {
                        $('#listparceldiamondDatatbl').attr('data-show', 0);
                    }

                    $('.hidephoneno1').on('click',function(){
                        
                        var id =$(this).data('id');
                        
                        $(this).addClass('d-none');
                        $('.showphoneno'+id).removeClass('d-none');
                    });

                }else if(resultdata.status == -1)
                {
                    $('#btnlogout').trigger('click');
                }
            }    
            $('.chart-loading').hide();

        }

        function OnErrorlistparceldiamond(content) {

        }
    }

    $('body').on('click','#parcelpaginationDiv .pagination li.active',function(){
		var page = $(this).attr('p');

        $('#listparceldiamondDatatbl').attr('data-nextpage', parseInt(page)-1);
         listparceldiamonddata(page, 'form-diamond-parcel-side-search');
        
	}); 
                          
    $('body').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page){
            if(page != 0 && page <= no_of_pages){
                listparceldiamonddata(page, 'form-diamond-parcel-side-search');
                $('#listparceldiamondDatatbl').attr('data-nextpage', page);
            }else{
                sweetAlert('','Enter a PAGE between 1 to '+no_of_pages);
                $('.goto').val("").focus();
                return false;
            }
        }
                            
    });
    $('body').on('click','#listparceldiamondData .tbl-highlight-tr',function(){

        /* $('#listparceldiamondData tr').removeClass('active');
        var index=$(this).attr('data-index');
        var ariaexpanded = $(this).attr('aria-expanded');
        $('#listparceldiamondData .sdown'+index+'').addClass('active'); */

        if($(this).hasClass('active'))
        {
            /* $(this).removeClass('active');
            $('#listdiamondData tr .searchPadding .collapse').removeClass('show'); */
        }
        else{
            // $('#listparceldiamondData tr').removeClass('active');
            // $('#listparceldiamondData tr .searchPadding .collapse').removeClass('show');
            var index=$(this).attr('data-index');
            var ariaexpanded = $(this).attr('aria-expanded');
            $('#listparceldiamondData .sdown'+index+'').addClass('active');
        }
    });
    $('body').on('input','#fltfromsavanipercentageparcel',function(){
        var fltfromsavanipercentageparcel=$(this).val();
        if(fltfromsavanipercentageparcel>100)
        {
            $('#fltfromsavanipercentageparcel').val(100);
            $('#s_fltfromsavanipercentageparcel').val(100);
        }
    })

    $('body').on('input','#flttosavanipercentageparcel',function(){
        var flttosavanipercentageparcel=$(this).val();
        if(flttosavanipercentageparcel>100)
        {
            $('#flttosavanipercentageparcel').val(100);
            $('#s_flttosavanipercentageparcel').val(100);
        }
    })
    
    $('body').on('change', '#parcelsortbyid', function() {
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        $("#listparceldiamondData").animate({
            scrollTop: 0
        }, "slow");
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('change', '#parceldiamond_per_page', function() {
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        $("#listparceldiamondData").animate({
            scrollTop: 0
        }, "slow");
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    /* $('#listparceldiamondDatatbl tbody').scroll(function() {
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            var dataact = getpagename();
            var show = $('#listparceldiamondDatatbl').attr('data-show');
            if (dataact && show == 1) {
                listparceldiamonddata(1, 'form-diamond-parcel-side-search');
            }
        }
    }); */


    // function list
    function fillsearchparceldiamondlist(type) {
        var htmllistdata = '';

        if (shapeparcelarr.length > 0) {
            for (var i = 0; i < shapeparcelarr.length; i++) {
                var id = shapeparcelarr[i].id;
                var name = shapeparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelshapeflt  fltparcelshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (colorparcelarr.length > 0) {
            for (var i = 0; i < colorparcelarr.length; i++) {
                var id = colorparcelarr[i].id;
                var name = colorparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelcolorflt  fltparcelcolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (clarityparcelarr.length > 0) {
            for (var i = 0; i < clarityparcelarr.length; i++) {
                var id = clarityparcelarr[i].id;
                var name = clarityparcelarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelclarityflt  fltparcelclarity' + id + ' searchbtnset"><b> Clarity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        // if (sieveparcelarr.length > 0) {
        //     for (var i = 0; i < sieveparcelarr.length; i++) {
        //         var id = sieveparcelarr[i].id;
        //         var name = sieveparcelarr[i].name;
        //         htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeparcelsieveflt  fltparcelsieve' + id + ' searchbtnset"><b> Sieve`s : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
        //     }
        // }

        if (fltfromparcelsize && flttoparcelsize > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtosize searchbtnset"><b> Size : </b><span>' + fltfromparcelsize + '-' + flttoparcelsize + '</span> <span class="btn-remove-tag">X</span></a>';
        }else  if (fltfromparcelsize && !flttoparcelsize) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtosize searchbtnset"><b> Size : </b><span>' + fltfromparcelsize  + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfrompiecepercarat && flttopiecepercarat > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtopiecepercarat searchbtnset"><b> Piece Per Carat : </b><span>' + fltfrompiecepercarat + '-' + flttopiecepercarat + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfrompriceparcel && flttopriceparcel > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtoprice searchbtnset"><b> Price : </b><span>$' + fltfrompriceparcel + '-$' + flttopriceparcel + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromsavanipercentageparcel && flttosavanipercentageparcel > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removeparcelfromtosavanipercentage searchbtnset"><b> Savani % : </b><span>' + fltfromsavanipercentageparcel + ' % - ' + flttosavanipercentageparcel + ' %</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromsievearr.length > 0 && flttosievearr.length > 0) {
                var id = fltfromsievearr[0].id;
                var name = fltfromsievearr[0].name+' To '+flttosievearr[0].name ;
                // console.log(fltfromsievearr[0].name);
                // console.log(name);
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesieveflt  fltsieve' + id + ' searchbtnset"><b>Sieve : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        $('.searchparceldiamondlistDiv').html(htmllistdata);
        getparcelsidebarelementvalue();
        // fillparceldiamondsearchelementvalue();
    }

    function removeindexfromarr(arrname, id) {
        // var _index;
        // var arrid = [];
        // $.each(arrname, function(i, value) {
        //     if (value.id == id) {
        //         _index = i;
        //     } else {
        //         arrid.push(value.id);
        //     }
        // });
        // arrname.splice(_index, 1);
        // return arrid;
    }

    $('body').on('click', '.removeparcelshapeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelshape' + id + '').remove();
        // $('#fltshapeparcelid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(shapeparcelarr, id);
        shapeparcelidarr.splice($.inArray(id, shapeparcelidarr), 1);
        $("#s_fltshapeparcelid").val(shapeparcelidarr).trigger('change');
       
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelcolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelcolor' + id + '').remove();
        // $('#fltcolorparcelid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(colorparcelarr, id);
        colorparcelidarr.splice($.inArray(id, colorparcelidarr), 1);
        $("#s_fltcolorparcelid").val(colorparcelidarr).trigger('change');
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelclarityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltparcelclarity' + id + '').remove();
        // $('#fltclarityparcelid' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(clarityparcelarr, id);
        clarityparcelidarr.splice($.inArray(id, clarityparcelidarr), 1);
        $("#s_fltclarityparcelid").val(clarityparcelidarr).trigger('change');
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });



    // $('body').on('click', '.removeparcelsieveflt', function() {
    //     var id = $(this).attr('data-id');
    //     var type = $(this).attr('data-type');
    //     $('.fltparcelsieve' + id + '').remove();
    //     var arrid = removeindexfromarr(sieveparcelarr, id);
    //     sieveparcelidarr.splice($.inArray(id, sieveparcelidarr), 1);
    //     $("#fltsieveid").val(sieveparcelidarr).trigger('change');
    //     $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
    //     listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    // });

    $('body').on('click', '.removesieveflt', function() {
       
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltsievearr, id);
        fltsievearr.splice($.inArray(id, fltsievearr), 1);
        $('.fltsieve' + id + '').remove();
        // $("#fltsieveid").val(fltintensityidarr).trigger('change');
        $("#s_fltfromsieveid").val(fltsievearr).trigger('change');
        $("#s_flttosieveid").val(fltsievearr).trigger('change');
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });


    $('body').on('click', '.removeparcelfromtosize', function() {
        var type = $(this).attr('data-type');
        $('#fltfromparcelsize').val(0);
        $('#flttoparcelsize').val(0);
        $('#s_fltfromparcelsize').val(0);
        $('#s_flttoparcelsize').val(0);
        $(this).remove();
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelfromtopiecepercarat', function() {
        var type = $(this).attr('data-type');
        $('#fltfrompiecepercarat').val(0);
        $('#flttopiecepercarat').val(0);
        $('#s_fltfrompiecepercarat').val(0);
        $('#s_flttopiecepercarat').val(0);
        $(this).remove();
       
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelfromtoprice', function() {
        var type = $(this).attr('data-type');
        $('#fltfrompriceparcel').val(0);
        $('#flttopriceparcel').val(0);
        $('#s_fltfrompriceparcel').val(0);
        $('#s_flttopriceparcel').val(0);
        $(this).remove();
       
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });

    $('body').on('click', '.removeparcelfromtosavanipercentage', function() {
        var type = $(this).attr('data-type');
        $('#fltfromsavanipercentageparcel').val(0);
        $('#flttosavanipercentageparcel').val(0);
        $('#s_fltfromsavanipercentageparcel').val(0);
        $('#s_flttosavanipercentageparcel').val(0);
        $(this).remove();
       
        $('#listparceldiamondDatatbl').attr('data-nextpage', 0);
        listparceldiamonddata(1, 'form-diamond-parcel-side-search');
    });


    $('#btnnewparcelsearch').on('click', function() {
        $("#form-diamond-parcel-search").validate().resetForm();
        $('#form-diamond-parcel-search').trigger("reset");
        // $("#form-diamond-side-search").validate().resetForm();
        // $('#form-diamond-side-search').trigger("reset");
        $('#form-diamond-parcel-search').removeClass('d-none');
        $('.listdiamondparcelDataDiv').addClass('d-none');
        $('.select2').select2();
        $('#btnparceldiamondsearch').attr('disabled', true);

    });
    $('#btnmodifyparcelsearch').on('click',function(){
        $('#form-diamond-parcel-search').removeClass('d-none');
        $('.listdiamondparcelDataDiv').addClass('d-none');
    })

    $('#btnresetparcelsearch').on('click', function() {
        $("#form-diamond-parcel-search").validate().resetForm();
        $('#form-diamond-parcel-search').trigger("reset");
        $('.select2').select2();
        $('#btnparceldiamondsearch').attr('disabled', true);
    });

    
    
</script>