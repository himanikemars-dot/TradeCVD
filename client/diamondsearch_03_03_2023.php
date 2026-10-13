<script>
    /* START LIST ALL DIAMOND DATA */
   
    function listdiamonddata(page, form = null) {

        var id = '<?php echo $id; ?>';
        // var form = $('#form-diamond-search').serialize();
        showloader();
        var pagename = getpagename();
        var useraction = $('#formevent').val();
        var diamond_per_page = $('#diamond_per_page').val();
        var sortbyid = $('#sortbyid').val();

        var nextpage = 0;
        if ($('#listdiamondDatatbl').attr('data-nextpage') > 0) {
            nextpage = $('#listdiamondDatatbl').attr('data-nextpage');
        }

        formdata = new FormData(document.getElementById('form-diamond-search'));
        if (form != null) {
            // checksidediamondformelementvalue();
            formdata = new FormData(document.getElementById(form));
        }



        formdata.append("action", "listdiamond");
        formdata.append("nextpage", parseInt(nextpage) + 1);
        formdata.append("fltparcel", 0);
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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesslistdiamond, OnErrorlistdiamond)

        function Onsuccesslistdiamond(data) {
            hideloader();
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '';
            if (resultdata.IsPackageExpire == 1) {
                Notiflix.Report.Warning(resultdata.ExpiryTitle,resultdata.message, false, function(){window.location=resultdata.ExpiryURL;});
            }
            else{
                if (resultdata.status == 0) {
                    // Notiflix.Notify.Failure(resultdata.message);
                    $('#form-diamond-search').addClass('d-none');
                    $('.listdiamondDataDiv').removeClass('d-none');

                    htmldata += '<tr>';
                    htmldata += '<td colspan="16">';
                    htmldata += '<h3>' + resultdata.message + '</h3>';
                    htmldata += '</td>';
                    htmldata += '</tr>';

                    $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                    $('#showdiamondentries').html(0);

                    $('.listdiamondDataDiv .totaldiamonds').html('0 Diamonds ');
                    $('.listdiamondDataDiv .totalprice').html('Total Price : $0');


                } else if (resultdata.status == 1) {
                    $('#form-diamond-search').addClass('d-none');
                    $('.listdiamondDataDiv').removeClass('d-none');
                    if (resultdata.totaldiamond >= 0 && resultdata.totalprice >= 0 && resultdata.totaldiamond != null && resultdata.totalprice != null) {
                        // //console.log('totaldiamond'+resultdata.totaldiamond);
                        // //console.log('totalprice'+resultdata.totalprice);
                        $('.listdiamondDataDiv .totaldiamonds').html(resultdata.totaldiamond + ' Diamonds ');
                        $('.listdiamondDataDiv .totalprice').html('Total Price : $' + resultdata.totalprice);
                    }


                    for (var i in resultdata.data) {
                        var diamonddata = resultdata.data[i];

                        htmldata += '<tr data-toggle="collapse" data-target="#searchdown' + diamonddata.id + '" data-index="'+diamonddata.id+'" class="sdown' + diamonddata.id + ' tbl-highlight-tr">';
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
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.country + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.shape + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.size + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.color + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.clarity + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.cut + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.polish + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.symmetry + '</td>';
                        // htmldata += '<td class="tbl-highlight-td">' + diamonddata.fluorescenecolor + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.intensity + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.lab + '</td>';
                        htmldata+='<td class="tbl-highlight-td">$' + diamonddata.price + '</td>';
                        var diamper='-';
                        if(diamonddata.savanipercentage>0) {
                            diamper='-'+diamonddata.savanipercentage+'%';
                        }
                        htmldata+='<td class="tbl-highlight-td">' + diamper + '</td>';
                        // htmldata += '<td class="tbl-highlight-td">$' + parseFloat(diamonddata.price*diamonddata.size).toFixed(2) + '</td>';
                        htmldata += '<td class="tbl-highlight-td">$' + parseFloat(diamonddata.totalprice).toFixed(2) + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.depthper + '%</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.tableper + '%</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</td>';
                        htmldata += '<td class="tbl-highlight-td">' + diamonddata.stocknumber + '</td>';

                        // htmldata+='<td>G</td>';
                        // htmldata+='<td>-</td>';
                        // htmldata+='<td>1.132</td>';
                        htmldata += '</tr>';

                        htmldata += '<td class="searchPadding">';
                        htmldata += '<div class="collapse" id="searchdown' + diamonddata.id + '">';
                        htmldata += '<div class="col-12 col-md-12 searchddetail">';
                        htmldata += '<div class="text-left searchleft">';
                        htmldata += '<div class="diamondsearch">';
                        htmldata += '<ul>';
                        htmldata += '<li>';
                        // htmldata += '<div class="starimg">';
                        // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                        // htmldata += '</div>';
                        htmldata += '<h4>' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                        htmldata += '</li>';
                        // htmldata += '<li class="setdiamonpgcl"><b>Price &nbsp</b>$' + diamonddata.price + '</li>';
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
                        <?php
                        if ($CanMemberToMemberChat == 1) {
                        ?>
                        if(diamonddata.ismydiamond==1){

                        
                                htmldata += '<div class="searchgreade searchcom">';
                                htmldata += '<button type="button" class="btn searchbtnset contactdiamondseller" data-diamondsize="' + diamonddata.size + '" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + '">Contact Seller</button>';
                                htmldata += '</div>';
                        }       
                        <?php
                        } ?>
                        // htmldata+='<div class="searchgreade searchcom">';
                        // htmldata+='<button type="button" class="btn searchbtnset">Compare</button>';
                        // htmldata+='</div>';
                        htmldata += '<div class="searchgreade searchcom">';
                        htmldata += '<button type="button" class="btn searchbtnset btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '" >Diamond Page</button>';
                        htmldata += '</div>';
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
                        // htmldata += '<h4>Last Update: ' + diamonddata.timestamp + '</h4>';
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
                        htmldata += '<li><b>Fluor.</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                        htmldata += '<li><b>Lab</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.lab + '</span></li>';
                        htmldata += '</ul>';
                        htmldata += '</div>';
                        htmldata += '<div class="col-md-6">';
                        htmldata += '<ul>';
                        // htmldata+='<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $354</span></li>';
                        // htmldata+='<li><b>%Savani</b>: <span class="metalpurity1">&nbsp; -83.9%</span></li>';
                        htmldata += '<li><b>Total</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                        htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depthper + '%</span></li>';
                        htmldata += '<li><b>Table</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '% </span></li>';
                        htmldata += '<li><b>Measurement</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                        htmldata += '<li><b>Vendor Stock No. </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stocknumber + '</span></li>';
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
                        htmldata += '<div class="searchmoredetail3 secathmoredetails_di">';
                        htmldata += '<ul>';
                        htmldata += '<li><b>Lot Diamond #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanilotnumber + '</span></li>';
                        htmldata += '<li><b>Availability</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.availability + '</span></li>';
                        htmldata += '<li><b>Diamond Location</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.country + '</span></li>';
                        htmldata += '<li><b>Stock No #</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.stock + '</span></li>';
                        // htmldata += '<li><b>$/ct</b>: <span class="metalpurity1">&nbsp; $' + diamonddata.price + '</span></li>';
                        // htmldata += '<li><b>Discount (%) </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanipercentage + ' %</span></li>';
                        // htmldata += '<li><b>Total Price </b>: <span class="metalpurity1">&nbsp;$' + parseFloat(diamonddata.price*diamonddata.size).toFixed(2) + ' </span></li>';
                            // priyank 03-01-2023 newcode start
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

                        htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                        htmldata += '<div class="pricecalimg">';
                        htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diogram.svg" alt="diamonds" title="diamonds">';
                        htmldata += '</div>';
                        htmldata += 'Diagram';
                        htmldata += '</button>';
                        htmldata += '<button type="button" class="btn reseacbtn btnshowdiamonddetail" data-diamondid="' + diamonddata.id + '">';
                        htmldata += '<div class="pricecalimg">';
                        htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/video.svg" alt="diamonds" title="diamonds">';
                        htmldata += '</div>';
                        htmldata += 'Video';
                        htmldata += '</button>';
                        htmldata += '</div>';
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
                        htmldata += '<h5><b>ID No</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.savaniid + '</span></h5>';
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
                        htmldata += '<li><b>Phone</b>: <span class="metalpurity1">&nbsp; <a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
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
                    // $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                    if (resultdata.nextpage == 1) {
                        $('.listdiamondDataDiv #listdiamondData').html(htmldata);
                    } else {
                        $('.listdiamondDataDiv #listdiamondData').append(htmldata);
                    }
                    $('#showdiamondentries').html(resultdata.showentries);
                    $('#listdiamondDatatbl').attr('data-nextpage', resultdata.nextpage);
                    if (resultdata.loadmore == 1) {
                        $('#listdiamondDatatbl').attr('data-show', 1);
                    } else {
                        $('#listdiamondDatatbl').attr('data-show', 0);
                    }



                }
            }    


        }

        function OnErrorlistdiamond(content) {

        }
    }

    $('body').on('change', '#diamond_per_page', function() {
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        $("#listdiamondData").animate({
            scrollTop: 0
        }, "slow");
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click','#listdiamondData .tbl-highlight-tr',function(){

        $('#listdiamondData tr').removeClass('active');
        var index=$(this).attr('data-index');
        var ariaexpanded = $(this).attr('aria-expanded');
        $('#listdiamondData .sdown'+index+'').addClass('active');
       
        
        

    });

    $('#listdiamondDatatbl tbody').scroll(function() {
        if ($(this).scrollTop() +
            $(this).innerHeight() >=
            $(this)[0].scrollHeight) {
            // //console.log('Here');
            var dataact = getpagename();
            var show = $('#listdiamondDatatbl').attr('data-show');
            if (dataact && show == 1) {
                listdiamonddata(1, 'form-diamond-side-search');
            }
        }
    });

    $('body').on('click', '.btnshowdiamonddetail', function() {

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
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccessshowdiamonddetail, OnErrorshowdiamonddetail);

        function Onsuccessshowdiamonddetail(data) {
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
                            htmldata += '<div class="col-md-8">';
                            htmldata += '<div class="row">';
                            htmldata += '<div class="col-md-8">';
                            htmldata += '<div class="diamondsearch">';
                            htmldata += '<ul>';
                            htmldata += '<li>';
                            // htmldata += '<div class="starimg">';
                            // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/star.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                            // htmldata += '</div>';
                            htmldata += '<h4>' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '</h4>';
                            htmldata += '</li>';
                            htmldata += '<li><b>$/Ct &nbsp</b>$' + diamonddata.price + '</li>';
                            if(diamonddata.savanipercentage>0)
                            {
                                // htmldata += '<li><b>Savani % </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanipercentage + ' %</span></li>';
                                htmldata += '<li><b>Discount % </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.savanipercentage + ' %</span></li>';
                                // htmldata += '<li><b>Total Price </b>: <span class="metalpurity1">&nbsp; ' + parseFloat(diamonddata.price*diamonddata.savanipercentage).toFixed(2) + ' </span></li>';
                                htmldata += '<li><b>Total Price </b>: <span class="metalpurity1">&nbsp; ' + parseFloat(diamonddata.totalprice).toFixed(2) + ' </span></li>';
                            }

                            htmldata += '<li>' + diamonddata.availability + '</li>';
                            htmldata += '<li>' + diamonddata.lab + ', ' + diamonddata.reportnumber + '</li>';
                            // if (diamonddata.reportfilelink != '' && diamonddata.reportfilelink != null) {
                            //     htmldata += '<li><a href="' + diamonddata.reportfilelink + '" target="_blank">Report Link</a></li>';
                            // }
                            // if (diamonddata.reportfileurl != '' && diamonddata.reportfileurl != null) {
                            //     htmldata += '<li><a href="' + diamonddata.reportfileurl + '" target="_blank"><img src="<?php echo $config->getImageurl(); ?>images/files.png" alt="Report File" height="50" width="50" title="Report File"></a></li>';
                            // }
                            htmldata += '</ul>';
                            // htmldata += '<h3>'+diamonddata.lab+', '+diamonddata.reportnumber+'</h3>';
                            // // if(diamonddata.reportfilelink!='')
                            // // {
                            //     htmldata += '<a href="'+diamonddata.reportfilelink+'" target="_blank">Report Link</a>';
                            // // }


                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '<div class="col-md-4 contectse text-center">';
                            <?php
                            if ($CanMemberToMemberChat == 1) {
                            ?>
                            if(diamonddata.ismydiamond==1){
                                htmldata += '<button type="button" class="btn contactdiamondseller" data-diamondsize="' + diamonddata.size + '" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '">Contact Seller</button><br>';
                            }
                            else{
                                htmldata += '<button type="button" class="btn contactdiamondseller d-none" data-diamondsize="' + diamonddata.size + '" data-diamondid="' + diamonddata.id + '" data-diamondname="' + diamonddata.lab + ',' + diamonddata.shape + ',' + diamonddata.size + ',' + diamonddata.color + ',' + diamonddata.clarity + ',' + diamonddata.cut + ',' + diamonddata.polish + ',' + diamonddata.symmetry + '">Contact Seller</button><br>';
                            }
                           <?php
                            }
                            if ($CanShareDiamond == 1) {
                            ?>
                                htmldata += '<button type="button" class="btn sharediamond" data-diamondid="' + diamonddata.id + '"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/share.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '"></button>';
                            <?php } ?>
                            // htmldata += '<button type="button" class="btn" data-toggle="modal" data-target="#linksearch"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/pin.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '"></button>';
                            // htmldata += '<button type="button" class="btn"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/facebook.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '"></button><br>';
                            // htmldata += '<a href="#" class="text-center">Learn More</a>';
                            htmldata += '</div>';
                            htmldata += '<div class="col-12 searmedia">';
                            htmldata += '<div class="row">';
                            htmldata += '<div class="col-md-4 mediasearch">';
                            // htmldata += '<ul>';
                            // htmldata += '<li><b>media<br><span>No media</span></b></li>';
                            // htmldata += '</ul>';

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
                                htmldata += '<a href="' + diamonddata.videolink + '" target="_blank"><i class="fas fa-play"></i></a>';
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
                                htmldata += '<h5>Report URL</h5>';
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
                            // htmldata += '<h5>Diagram</h5>';
                            // htmldata += '<div class="media">';
                            // htmldata += '<div class="mediaurl">';
                            // htmldata += '<img src="<?php echo $config->getImageurl(); ?>images/searchpage/diagram.svg" alt="' + diamonddata.stock + '" title="' + diamonddata.stock + '">';
                            // htmldata += '</div>';
                            // htmldata += '</div>';
                            htmldata += '</div>';



                            htmldata += '<div class="col-md-8 addsearchdetail">';
                            htmldata += '<div class="card">';
                            htmldata += '<h4>Diamond Details</h4>';
                            htmldata += '<div class="card-body">';
                            htmldata += '<ul>';
                            htmldata += '<li><b>Stock</b>: <span class="metalpurity1" data-tooltip="Tool tip">&nbsp; ' + diamonddata.stock + '</span></li>';
                            htmldata += '<li><b>Intensity</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.intensity + '</span></li>';
                            htmldata += '<li><b>Fluorescene Color</b>: <span class="metalpurity1" >&nbsp; ' + diamonddata.fluorescenecolor + '</span></li>';
                            htmldata += '<li><b>Depth%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depth + '%</span></li>';
                            htmldata += '<li><b>Table%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '%</span></li>';
                            htmldata += '<li><b>Length</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '</span></li>';
                            htmldata += '<li><b>Width</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.width + '</span></li>';
                            htmldata += '<li><b>Depth</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.depth + '</span></li>';
                            // htmldata += '<li><b>Table%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.tableper + '%</span></li>';



                            htmldata += '<li><b>Measurement </b>: <span class="metalpurity1">&nbsp; ' + diamonddata.length + '-' + diamonddata.width + '-' + diamonddata.depth + '</span></li>';
                            // htmldata += '<li><b>Ratio</b>: <span class="metalpurity1">&nbsp; New</span></li>';
                            htmldata += '<li><b>Gridle Condition</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Small to Extremely Large">&nbsp; ' + diamonddata.gridlecondition + '</span></li>';
                            htmldata += '<li><b>Gridle Min</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Extremely Thick">&nbsp; ' + diamonddata.gridlemin + '</span></li>';
                            htmldata += '<li><b>Gridle Max</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridlemax + '</span></li>';
                            htmldata += '<li><b>Gridle%</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.gridleper + '%</span></li>';
                            htmldata += '<li><b>Culet Condition</b>: <span class="metalpurity1"tabindex="0" data-toggle="tooltip" title="Refurbished">&nbsp; ' + diamonddata.culetcondition + '</span></li>';
                            htmldata += '<li><b>Culet Size</b>: <span class="metalpurity1"tabindex="0" data-toggle="tooltip" title="2.25">&nbsp; ' + diamonddata.culetsize + '</span></li>';
                            htmldata += '<li><b>Treatment</b>: <span class="metalpurity1" tabindex="0" data-toggle="tooltip" title="Irradiation and Annealing, Untreated,High Pressure High Temperature">&nbsp; ' + diamonddata.treatment + '</span></li>';
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

                            htmldata += '<li><b>Report Number</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.reportnumber + '</span></li>';
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
                            htmldata += '<li><b>Sleeve Name</b>: <span class="metalpurity1">&nbsp; ' + diamonddata.sievename + '</span></li>';

                            htmldata += '</ul>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';

                            var sellerdetails = diamonddata.persondetail[0];

                            htmldata += '<div class="col-md-4 profilediamnd">';
                            htmldata += '<div class="card">';
                            htmldata += '<div class="card-body">';
                            htmldata += '<div class="sellersearchd">';
                            htmldata += '<h5>Seller Details</h5>';
                            htmldata += '<div class="profileimgset">';
                            // htmldata += '<h3>20%</h3>';
                            htmldata += '<img src="' + sellerdetails.profileimg + '" alt="' + sellerdetails.personname + '" title="' + sellerdetails.personname + '">';
                            htmldata += '</div>';
                            htmldata += '<h2>' + sellerdetails.companyname + '</h2>';
                            htmldata += '<p><b>ID No #</b>' + sellerdetails.savaniid + '</p>';
                            htmldata += '<ul>';
                            htmldata += '<li><b>Location</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.cityname + ',' + sellerdetails.statename + ', ' + sellerdetails.countryname + '</span></li>';
                            htmldata += '<li><b>Contact Person</b>: <span class="metalpurity1">&nbsp; ' + sellerdetails.personname + '</span></li>';
                            htmldata += '<li><b>Phone</b>: <span class="metalpurity1 phonesearch">&nbsp;<a href="tel:' + sellerdetails.phonecode + '' + sellerdetails.businessphoneno + '" >' + sellerdetails.phonecode + ' ' + sellerdetails.businessphoneno + '</a></span></li>';
                            htmldata += '</ul>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '<div class="card">';
                            htmldata += '<div class="card-body">';
                            htmldata += '<div class="Notessearchd">';
                            htmldata += '<ul>';
                            htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            // htmldata += '<li><b>Laser Inscription</b>: <span class="metalpurity1 phonesearch">&nbsp;' + diamonddata.laserinscription + '</span></li>';
                            htmldata += '</ul>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';
                            htmldata += '</div>';



                        }
                    }

                }
                $('#ListDiamondDataDetailModalLong #ListDiamondDataDetail').html(htmldata);
                $('#ListDiamondDataDetailModalLong').modal('show');
            }    

            $('.sharediamond').on('click', function() {
                var id = $(this).attr('data-diamondid');
                $("#form-diamond-share").validate().resetForm();
                $('#form-diamond-share').trigger("reset");
                $('#form-diamond-share #sharediamondid').val(id);
                $('#ListDiamondDataDetailModalLong').modal('hide');
                $('#sharediamondsearch').modal('show');
            });



            if ($('#form-diamond-share').length) {
                $('#form-diamond-share').validate({
                    rules: {
                        sharewithemail: {
                            required: true,
                            email: true
                        },
                    },
                    messages: {
                        sharewithemail: {
                            required: "E-mail Address is required",
                        },
                    },
                    submitHandler: function(form) {

                        showloader();
                        var pagename = getpagename();
                        var useraction = $('#formevent').val();
                        formdata = new FormData(form);
                        formdata.append("action", "sharediamond");
                        var headersdata = {
                            'Accept': 'application/json',
                            platform: 4,
                            userpagename: pagename,
                            useraction: useraction,
                            masterlisting: false
                        };
                        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesssharediamond, OnErrorsharediamond)

                        function Onsuccesssharediamond(data) {
                            hideloader();
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
                                    $('#sharediamondsearch').modal('hide');
                                }
                            }    

                        }

                        function OnErrorsharediamond(content) {

                        }
                    },
                });
            }

        }

        function OnErrorshowdiamonddetail(content) {
            // ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
    });


    $('body').on('change', '#sortbyid', function() {
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* CONTACT DIAMOND SELLER */
    $('body').on('click', '.contactdiamondseller', function() {
        var id = $(this).attr('data-diamondid');
        var diamondname = $(this).attr('data-diamondname');
        var diamondsize = $(this).attr('data-diamondsize');

        $("#form-diamond-contact-seller").validate().resetForm();
        $('#form-diamond-contact-seller').trigger("reset");
        $('#form-diamond-contact-seller #contactsellerdiamondid').val(id);
        $('#form-diamond-contact-seller #contactsellerdiamondname').val(diamondname);
        $('#form-diamond-contact-seller #contactsellerdiamondsize').val(diamondsize);
        $('#form-diamond-contact-seller .diamondnametext').html(diamondname);
        $('#contactdiamondseller').modal('show');
    });
    $('body').on('input','#form-diamond-contact-seller #offerprice',function(){
        var offerprice=parseFloat($(this).val()) || 0;
        var contactsellerdiamondsize=parseFloat($('#contactsellerdiamondsize').val()) || 0;
        var totalprice = offerprice * contactsellerdiamondsize;
        $('#form-diamond-contact-seller #totalprice_m').val(totalprice);

    });
    $('body').on('input','#form-diamond-contact-seller #savaniper_m',function(){
        var savaniper_m=parseFloat($(this).val()) || 0;
        if(savaniper_m>99){
            $(this).val(99);
        }
    });
    if ($('#form-diamond-contact-seller').length) {
        $('#form-diamond-contact-seller').validate({
            rules: {
                messagetext: {
                    required: true,
                },
                offerprice: {
                    number: true
                },
                savaniper_m:{
                    number: true
                },
                totalprice_m:{
                    number: true
                }
            },
            messages: {
                messagetext: {
                    required: "Message is required",
                },
               
            },
            submitHandler: function(form) {

                showloader();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "contactdiamondseller");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 4,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>diamond', formdata, headersdata, Onsuccesscontactdiamondseller, OnErrorcontactdiamondseller)

                function Onsuccesscontactdiamondseller(data) {
                    hideloader();
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
                            $('#contactdiamondseller').modal('hide');
                        }
                    }    

                }

                function OnErrorcontactdiamondseller(content) {

                }
            },
        });
    }

    /* APPLY FILTER */
    $('#btnnewsearch').on('click', function() {
        $("#form-diamond-search").validate().resetForm();
        $('#form-diamond-search').trigger("reset");
        $("#form-diamond-side-search").validate().resetForm();
        $('#form-diamond-side-search').trigger("reset");
        $('#form-diamond-search').removeClass('d-none');
        $('.listdiamondDataDiv').addClass('d-none');
        $('.select2').select2();
        $('#btnsearchdiamond').attr('disabled', true);
    });

    $('#btnresetsearch').on('click', function() {
        $("#form-diamond-search").validate().resetForm();
        $('#form-diamond-search').trigger("reset");
        $('.select2').select2();
        $('#btnsearchdiamond').attr('disabled', true);
    });


    /* SUBMIT FIRST FILTER */

    if ($('#form-diamond-search').length) {
        $('#form-diamond-search').validate({
            rules: {
                fltfromsize: {
                    number: true
                },
                flttosize: {
                    greaterThan: '#fltfromsize',
                    number: true
                },
                fltfromprice: {
                    number: true
                },
                flttoprice: {
                    greaterThan: '#fltfromprice',
                    number: true
                },

                fltfromsavanipercentage: {
                    number: true,
                    maxlength:3
                },
                flttosavanipercentage: {
                    greaterThan: '#fltfromsavanipercentage',
                    number: true,
                    maxlength:3
                },

                fltfromdepthper: {
                    number: true
                },
                flttodepthper: {
                    greaterThan: '#fltfromdepthper',
                    number: true
                },
                fltfromtableper: {
                    number: true
                },
                flttotableper: {
                    greaterThan: '#fltfromtableper',
                    number: true
                },
                fltfromlength: {
                    number: true
                },
                flttolength: {
                    greaterThan: '#fltfromlength',
                    number: true
                },
                fltfromwidth: {
                    number: true
                },
                flttowidth: {
                    greaterThan: '#fltfromwidth',
                    number: true
                },
                fltfromdepth: {
                    number: true
                },
                flttodepth: {
                    greaterThan: '#fltfromdepth',
                    number: true
                },

                fltcrownfromheightper: {
                    number: true
                },
                fltcrowntoheightper: {
                    greaterThan: '#fltcrownfromheightper',
                    number: true
                },
                fltcrownfromangel: {
                    number: true
                },
                fltcrowntoangel: {
                    greaterThan: '#fltcrownfromangel',
                    number: true
                },

                fltpavilionfromdepthper: {
                    number: true
                },
                fltpaviliontodepthper: {
                    greaterThan: '#fltpavilionfromdepthper',
                    number: true
                },
                fltcrownfromangel: {
                    number: true
                },
                fltpaviliontoangle: {
                    greaterThan: '#fltcrownfromangel',
                    number: true
                },
                fltfromratio: {
                    number: true
                },
                flttoratio: {
                    greaterThan: '#fltfromratio',
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

                flttosavanipercentage: {
                    greaterThan: 'To percentage greater than or equal From percentage',
                },

                flttodepthper: {
                    greaterThan: 'To depth(%) greater than or equal From depth(%)',
                },
                flttotableper: {
                    greaterThan: 'To table(%) greater than or equal From table(%)',
                },
                flttolength: {
                    greaterThan: 'To length greater than or equal From length',
                },
                flttowidth: {
                    greaterThan: 'To width greater than or equal From width',
                },
                flttodepth: {
                    greaterThan: 'To depth greater than or equal From depth',
                },
                fltcrowntoheightper: {
                    greaterThan: 'To Height (%) greater than or equal From Height (%)',
                },
                fltcrowntoangel: {
                    greaterThan: 'To Angel greater than or equal From Angel',
                },
                fltpaviliontoangle: {
                    greaterThan: 'To Angel greater than or equal From Angel',
                },
                fltpaviliontodepthper: {
                    greaterThan: 'To Depth(%) greater than or equal From Depth(%)',
                },
                flttoratio: {
                    greaterThan: 'To ratio greater than or equal From ratio',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checkdiamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchdiamondlist(1);
                    $('#listdiamondDatatbl').attr('data-nextpage', 0);
                    listdiamonddata(1, 'form-diamond-search');
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }



    $('body').on('input', '.inputper', function() {
        var per = parseFloat($(this).val());
        if (per > 100) {
            $(this).val(100);
        }
    });

    $('body').on('input', '.inputval', function() {
        var inputval = parseFloat($(this).val());
        if (!inputval) {
            $(this).val(0);
        } /* else {
            $(this).val(0);
        } */
    });


    /* CHECK ALL FIRST FILTERS */

    $('body').on('change', '#form-diamond-search input[type=checkbox]', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });

    $('body').on('input', '#form-diamond-search #fltfromsize,#flttosize,#fltfromprice,#flttoprice,#fltfromsavanipercentage,#flttosavanipercentage,#fltfromdepthper,#flttodepthper,#fltfromdepth,#flttodepth,#fltfromtableper,#flttotableper,#fltfromlength,#flttolength,#fltfromwidth,#flttowidth,#fltlabreportnumber,#fltcrownfromheightper,#fltcrowntoheightper,#fltcrownfromangel,#fltcrowntoangel,#fltpavilionfromdepthper,#fltpaviliontodepthper,#fltpavilionfromangle,#fltpaviliontoangle,#fltfromratio,#flttoratio', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });



    $('body').on('change', '#form-diamond-search .select2', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });


    $('body').on('change', '#form-diamond-search #fltcompanycode,#fltstocknumbers,#fltlotnumbers', function() {
        checkdiamondformelementvalue();
        getfiltersvalue();
    });

    function checkdiamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-search input[type=checkbox]').each(function() {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-search #fltfromsize').val();
        var flttosize = $('#form-diamond-search #flttosize').val();
        if (fltfromsize && flttosize > 0) {
            issearchbtn++;
        }
        var flteyecleanid = $('#form-diamond-search #flteyecleanid').val();
        if(flteyecleanid)
        {
            if (flteyecleanid.length > 0) {
                issearchbtn++;
            }
        }

        /* var fltintensity = $('#form-diamond-search #fltintensity').val();
        if (fltintensity.length > 0) {
            issearchbtn++;
        } */

        var fltfromintensity = $('#form-diamond-search #fltfromintensity :selected').val();
        var flttointensity = $('#form-diamond-search #flttointensity :selected').val();
        if (fltfromintensity!='' && flttointensity!='') {
            issearchbtn++;
        }

        var fltovertone = $('#form-diamond-search #fltovertone').val();
        if(fltovertone)
        {
            if (fltovertone.length > 0) {
                issearchbtn++;
            }
        }

        var fltcolor = $('#form-diamond-search #fltcolor').val();
        if(fltcolor)
        {
            if (fltcolor.length > 0) {
                issearchbtn++;
            }
        }

        /* var fltmilkyid = $('#form-diamond-search #fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            issearchbtn++;
        } */

        var fltfrommilkyid = $('#form-diamond-search #fltfrommilkyid :selected').val();
        var flttomilkyid = $('#form-diamond-search #flttomilkyid :selected').val();
        if (fltfrommilkyid!='' && flttomilkyid!='') {
            issearchbtn++;
        }

        var fltfromcutid = $('#form-diamond-search #fltfromcutid :selected').val();
        var flttocutid = $('#form-diamond-search #flttocutid :selected').val();
        if (fltfromcutid!='' && flttocutid!='') {
            issearchbtn++;
        }

        var fltfrompolishid = $('#form-diamond-search #fltfrompolishid :selected').val();
        var flttopolishid = $('#form-diamond-search #flttopolishid :selected').val();
        if (fltfrompolishid!='' && flttopolishid!='') {
            issearchbtn++;
        }

        var fltfromsymmetryid = $('#form-diamond-search #fltfromsymmetryid :selected').val();
        var flttosymmetryid = $('#form-diamond-search #flttosymmetryid :selected').val();
        if (fltfromsymmetryid!='' && flttosymmetryid!='') {
            issearchbtn++;
        }

        var fltopeninclusionid = $('#form-diamond-search #fltopeninclusionid').val();
        if(fltopeninclusionid)
        {
            if (fltopeninclusionid.length > 0) {
                issearchbtn++;
            }
        }

        var fltwhiteinclusionid = $('#form-diamond-search #fltwhiteinclusionid').val();
        if(fltwhiteinclusionid)
        {
            if (fltwhiteinclusionid.length > 0) {
                issearchbtn++;
            }
        }

        var fltblackinclusionid = $('#form-diamond-search #fltblackinclusionid').val();
        if(fltblackinclusionid)
        {
            if (fltblackinclusionid.length > 0) {
                issearchbtn++;
            }
        }

        var fltshadeid = $('#form-diamond-search #fltshadeid').val();
        if(fltshadeid)
        {
            if (fltshadeid.length > 0) {
                issearchbtn++;
            }
        }
     /*    var fltcutid = $('#form-diamond-search #fltcutid').val();
        if (fltcutid.length > 0) {
            issearchbtn++;
        }
        var fltpolishid = $('#form-diamond-search #fltpolishid').val();
        if (fltpolishid.length > 0) {
            issearchbtn++;
        }
        var fltsymmetryid = $('#form-diamond-search #fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            issearchbtn++;
        } */
        var fltfluorescencecolorid = $('#form-diamond-search #fltfluorescencecolorid').val();
        if(fltfluorescencecolorid)
        {
            if (fltfluorescencecolorid.length > 0) {
                issearchbtn++;
            }
        }
        var fltlocationid = $('#form-diamond-search #fltlocationid').val();
        if(fltlocationid)
        {
            if (fltlocationid.length > 0) {
                issearchbtn++;
            }
        }
        var fltroughsourceid = $('#form-diamond-search #fltroughsourceid').val();
        if(fltroughsourceid)
        {
            if (fltroughsourceid.length > 0) {
                issearchbtn++;
            }
        }

        var fltcompanycode = $('#form-diamond-search #fltcompanycode').val();
        if (fltcompanycode) {
            issearchbtn++;
        }
        var fltstocknumbers = $('#form-diamond-search #fltstocknumbers').val();
        if (fltstocknumbers) {
            issearchbtn++;
        }
        var fltsavanilotnumber = $('#form-diamond-search #fltlotnumbers').val();
        if (fltsavanilotnumber) {
            issearchbtn++;
        }


        var fltfromprice = $('#form-diamond-search #fltfromprice').val();
        var flttoprice = $('#form-diamond-search #flttoprice').val();
        if (fltfromprice && flttoprice > 0) {
            issearchbtn++;
        }

        var fltfromsavanipercentage = $('#form-diamond-search #fltfromsavanipercentage').val();
        var flttosavanipercentage = $('#form-diamond-search #flttosavanipercentage').val();
        if (fltfromsavanipercentage && flttosavanipercentage > 0) {
            issearchbtn++;
        }

        var fltfromdepthper = $('#form-diamond-search #fltfromdepthper').val();
        var flttodepthper = $('#form-diamond-search #flttodepthper').val();
        if (fltfromdepthper && flttodepthper > 0) {
            issearchbtn++;
        }

        var fltfromtableper = $('#form-diamond-search #fltfromtableper').val();
        var flttotableper = $('#form-diamond-search #flttotableper').val();
        if (fltfromtableper && flttotableper > 0) {
            issearchbtn++;
        }

        var fltfromlength = $('#form-diamond-search #fltfromlength').val();
        var flttolength = $('#form-diamond-search #flttolength').val();
        if (fltfromlength && flttolength > 0) {
            issearchbtn++;
        }

        var fltfromwidth = $('#form-diamond-search #fltfromwidth').val();
        var flttowidth = $('#form-diamond-search #flttowidth').val();
        if (fltfromwidth && flttowidth > 0) {
            issearchbtn++;
        }

        var fltfromdepth = $('#form-diamond-search #fltfromdepth').val();
        var flttodepth = $('#form-diamond-search #flttodepth').val();
        if (fltfromdepth && flttodepth > 0) {
            issearchbtn++;
        }
        var fltlabreportnumber = $('#form-diamond-search #fltlabreportnumber').val();
        if (fltlabreportnumber) {
            issearchbtn++;
        }

        var fltcrownfromheightper = $('#form-diamond-search #fltcrownfromheightper').val();
        var fltcrowntoheightper = $('#form-diamond-search #fltcrowntoheightper').val();
        if (fltcrownfromheightper && fltcrowntoheightper > 0) {
            issearchbtn++;
        }

        var fltcrownfromangel = $('#form-diamond-search #fltcrownfromangel').val();
        var fltcrowntoangel = $('#form-diamond-search #fltcrowntoangel').val();
        if (fltcrownfromangel && fltcrowntoangel > 0) {
            issearchbtn++;
        }

        var fltpavilionfromdepthper = $('#form-diamond-search #fltpavilionfromdepthper').val();
        var fltpaviliontodepthper = $('#form-diamond-search #fltpaviliontodepthper').val();
        if (fltpavilionfromdepthper && fltpaviliontodepthper > 0) {
            issearchbtn++;
        }

        var fltpavilionfromangle = $('#form-diamond-search #fltpavilionfromangle').val();
        var fltpaviliontoangle = $('#form-diamond-search #fltpaviliontoangle').val();
        if (fltpavilionfromangle && fltpaviliontoangle > 0) {
            issearchbtn++;
        }
        var fltfromratio = $('#form-diamond-search #fltfromratio').val();
        var flttoratio = $('#form-diamond-search #flttoratio').val();
        if (fltfromratio && flttoratio > 0) {
            issearchbtn++;
        }
        
        $('#form-diamond-search #btnsearchdiamond').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-search #btnsearchdiamond').attr('disabled', false);
        }


       
        // //console.log(issearchbtn);
        return issearchbtn;

    }
    /* GET ALL FILTERS DATA */
    var shapearr = [];
    var shapeidarr = [];
    var fltfromsize = 0;
    var flttosize = 0;
    var sizearr = [];
    var colorarr = [];
    var coloridarr = [];
    var clarityarr = [];
    var clarityidarr = [];
    var flteyecleanarr = [];
    var flteyecleanidarr = [];
    var fltmilkyarr = [];
    var fltmilkyidarr = [];
    var fltblackinclusionarr = [];
    var fltblackinclusionidarr = [];

    var fltwhiteinclusionarr = [];
    var fltwhiteinclusionidarr = [];

    var fltopeninclusionarr = [];
    var fltopeninclusionidarr = [];

    var fltshadearr = [];
    var fltshadeidarr = [];

  

  

    var fltsymmetryarr = [];
    var fltsymmetryidarr = [];

    var intensityarr = [];
    var intensityidarr = [];

    var fltfluorescencecolorarr = [];
    var fltfluorescencecoloridarr = [];

    var labarr = [];

    var fltlocationarr = [];
    var fltlocationidarr = [];

    var fltroughsourcearr = [];
    var fltroughsourceidarr = [];

    var mediaarr = [];

    var treatmentarr = [];
    var treatmentidarr = [];

    var keytosymbolarr = [];
    var keytosymbolidarr = [];

    var brandarr = [];
    var brandidarr = [];

    var fltcompanycodearr = [];
    var fltstocknumbersarr = [];
    var fltsavanilotnumberarr = [];

    var fltfromprice = 0;
    var flttoprice = 0;

    var fltfromsavanipercentage = 0;
    var flttosavanipercentage = 0;

    var fltfromdepthper = 0;
    var flttodepthper = 0;
    var fltfromtableper = 0;
    var flttotableper = 0;
    var fltfromlength = 0;
    var flttolength = 0;
    var fltfromwidth = 0;
    var flttowidth = 0;
    var fltfromdepth = 0;
    var flttodepth = 0;
    var fltlabreportnumber = '';

    var fltfromintensityarr = [];
    var flttointensityarr = [];
    var fltintensityarr = [];
    var fltintensityidarr = [];

    var fltfrommilkyidarr = [];
    var flttomilkyidarr = [];

    var fltfromcutidarr = [];
    var flttocutidarr = [];
    var fltcutarr = [];
    var fltcutidarr = [];

    var fltfrompolishidarr = [];
    var flttopolishidarr = [];
    var fltpolisharr = [];
    var fltpolishidarr = [];

    var fltfromsymmetryidarr = [];
    var flttosymmetryidarr = [];
    var fltsymmetryarr = [];
    var fltsymmetryidarr = [];
    
    // var fltmilkyarr = [];
    // var fltmilkyidarr = [];
    
    

    var fltovertonearr = [];
    var fltovertoneidarr = [];

    var fltcolorarr = [];
    var fltcoloridarr = [];

    var ssizearr = [];
    var ssizeidarr = [];

    var fltcrownfromheightper = 0;
    var fltcrowntoheightper = 0;
    var fltcrownfromangel = 0;
    var fltcrowntoangel = 0;
    var fltpavilionfromdepthper = 0;
    var fltpaviliontodepthper = 0;
    var fltpavilionfromangle = 0;
    var fltpaviliontoangle = 0;

    var fltgridlearr = [];
    var fltgridleidarr = [];
    var fltculetsizearr = [];
    var fltculetsizeidarr = [];
    var fltculetconditionarr = [];
    var fltculetconditionidarr = [];

    var fltfromratio = 0;
    var flttoratio = 0;

    function getfiltersvalue() {
        shapearr = [];
        shapeidarr = [];
        $('#shapeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                shapearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                shapeidarr.push($(this).val());
            }
        });
        // //console.log(shapearr);
        // //console.log(shapeidarr);
        if(shapeidarr)
        {
            if (shapeidarr.length > 0) {
                $("#s_fltshapeid").val(shapeidarr).trigger('change');
                $('#s_fltshapeid').select2();
            } else {
                $("#s_fltshapeid").val(null).trigger('change');
                $('#s_fltshapeid').select2();
            }
        }
        fltfromsize = $('#fltfromsize').val();
        flttosize = $('#flttosize').val();
        $('#s_fltfromsize').val(fltfromsize);
        $('#s_flttosize').val(flttosize);

        sizearr = [];
        $('#sizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                sizearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                $('#s_fltsizeid' + $(this).val() + '').prop('checked', true);
            } else {
                $('#s_fltsizeid' + $(this).val() + '').prop('checked', false);
            }
        });

        colorarr = [];
        coloridarr = [];
        $('#colorDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                colorarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                coloridarr.push($(this).val());
            }
        });
        // //console.log(colorarr);
        // //console.log(coloridarr);
        if(coloridarr)
        {
            if (coloridarr.length > 0) {
                $("#s_fltcolorid").val(coloridarr).trigger('change');
                $('#s_fltcolorid').select2();
            } else {
                $("#s_fltcolorid").val(null).trigger('change');
                $('#s_fltcolorid').select2();
            }
        }

        clarityarr = [];
        clarityidarr = [];
        $('#clarityDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                clarityarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                clarityidarr.push($(this).val());
            }
        });
        // //console.log(clarityarr);
        // //console.log(clarityidarr);
        if(clarityidarr)
        {
            if (clarityidarr.length > 0) {
                $("#s_fltclarityid").val(clarityidarr).trigger('change');
                $('#s_fltclarityid').select2();
            } else {
                $("#s_fltclarityid").val(null).trigger('change');
                $('#s_fltclarityid').select2();
            }
        }

        flteyecleanarr = [];
        flteyecleanidarr = [];
        var flteyecleanid = $('#flteyecleanid').val();
        if(flteyecleanid)
        {
            if (flteyecleanid.length > 0) {
                for (var i = 0; i < flteyecleanid.length; i++) {
                    var eyecleanid = $('#flteyecleanid option[value=' + flteyecleanid[i] + ']').val();
                    var eyeclean = $('#flteyecleanid option[value=' + flteyecleanid[i] + ']').text();
                    flteyecleanarr.push({
                        'id': eyecleanid,
                        'name': eyeclean
                    });
                    flteyecleanidarr.push(eyecleanid);
                }
            }
        }
        // //console.log(flteyecleanarr);
        // //console.log(flteyecleanidarr);
        if (flteyecleanidarr.length > 0) {
            $("#s_flteyecleanid").val(flteyecleanidarr).trigger('change');
            $('#s_flteyecleanid').select2();
        } else {
            $("#s_flteyecleanid").val(null).trigger('change');
            $('#s_flteyecleanid').select2();
        }

        /* fltmilkyarr = [];
        fltmilkyidarr = [];
        var fltmilkyid = $('#fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            for (var i = 0; i < fltmilkyid.length; i++) {
                var milkyid = $('#fltmilkyid option[value=' + fltmilkyid[i] + ']').val();
                var milky = $('#fltmilkyid option[value=' + fltmilkyid[i] + ']').text();
                fltmilkyarr.push({
                    'id': milkyid,
                    'name': milky
                });
                fltmilkyidarr.push(milkyid);
            }
        } 
         if (fltmilkyidarr.length > 0) {
            $("#s_fltmilkyid").val(fltmilkyidarr).trigger('change');
            $('#s_fltmilkyid').select2();
        } else {
            $("#s_fltmilkyid").val(null).trigger('change');
            $('#s_fltmilkyid').select2();
        }
        */
        
        fltfrommilkyarr = [];
        flttomilkyarr = [];
        var fltfrommilkyid = $('#fltfrommilkyid :selected').val();
        var fltfrommilkyidname = $('#fltfrommilkyid option:selected').text();

        var flttomilkyid = $('#flttomilkyid :selected').val();
        var flttomilkyidname = $('#flttomilkyid option:selected').text();

        if (fltfrommilkyid !='' && flttomilkyid !='') {
            fltfrommilkyarr.push({
                'id': fltfrommilkyid,
                'name': fltfrommilkyidname
            });
            $('#s_fltfrommilkyid').val(fltfrommilkyid);
            $('#s_fltfrommilkyid').select2();
           console.log(fltfrommilkyarr);

           flttomilkyarr.push({
                'id': flttomilkyid,
                'name': flttomilkyidname
            });
            $('#s_flttomilkyid').val(flttomilkyid);
            $('#s_flttomilkyid').select2();
            // console.log(flttomilkyarr);
        }

        // //console.log(fltmilkyarr);
        // //console.log(fltmilkyidarr);
       

        fltwhiteinclusionarr = [];
        fltwhiteinclusionidarr = [];
        var fltwhiteinclusionid = $('#fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            for (var i = 0; i < fltwhiteinclusionid.length; i++) {
                var whiteinclusionid = $('#fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').val();
                var whiteinclusion = $('#fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').text();
                fltwhiteinclusionarr.push({
                    'id': whiteinclusionid,
                    'name': whiteinclusion
                });
                fltwhiteinclusionidarr.push(whiteinclusionid);
            }
        }
        // //console.log(fltwhiteinclusionarr);
        // //console.log(fltwhiteinclusionidarr);
        if (fltwhiteinclusionidarr.length > 0) {
            $("#s_fltwhiteinclusionid").val(fltwhiteinclusionidarr).trigger('change');
            $('#s_fltwhiteinclusionid').select2();
        } else {
            $("#s_fltwhiteinclusionid").val(null).trigger('change');
            $('#s_fltwhiteinclusionid').select2();
        }

        fltblackinclusionarr = [];
        fltblackinclusionidarr = [];
        var fltblackinclusionid = $('#fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            for (var i = 0; i < fltblackinclusionid.length; i++) {
                var blackinclusionid = $('#fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').val();
                var blackinclusion = $('#fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').text();
                fltblackinclusionarr.push({
                    'id': blackinclusionid,
                    'name': blackinclusion
                });
                fltblackinclusionidarr.push(blackinclusionid);
            }
        }
        // //console.log(fltblackinclusionarr);
        // //console.log(fltblackinclusionidarr);
        if (fltblackinclusionidarr.length > 0) {
            $("#s_fltblackinclusionid").val(fltblackinclusionidarr).trigger('change');
            $('#s_fltblackinclusionid').select2();
        } else {
            $("#s_fltblackinclusionid").val(null).trigger('change');
            $('#s_fltblackinclusionid').select2();
        }

        fltopeninclusionarr = [];
        fltopeninclusionidarr = [];
        var fltopeninclusionid = $('#fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            for (var i = 0; i < fltopeninclusionid.length; i++) {
                var openinclusionid = $('#fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').val();
                var openinclusion = $('#fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').text();
                fltopeninclusionarr.push({
                    'id': openinclusionid,
                    'name': openinclusion
                });
                fltopeninclusionidarr.push(openinclusionid);
            }
        }
        // //console.log(fltopeninclusionarr);
        // //console.log(fltopeninclusionidarr);
        if (fltopeninclusionidarr.length > 0) {
            $("#s_fltopeninclusionid").val(fltopeninclusionidarr).trigger('change');
            $('#s_fltopeninclusionid').select2();
        } else {
            $("#s_fltopeninclusionid").val(null).trigger('change');
            $('#s_fltopeninclusionid').select2();
        }

        fltshadearr = [];
        fltshadeidarr = [];


        var fltshadeid = $('#fltshadeid').val();
        if (fltshadeid.length > 0) {
            for (var i = 0; i < fltshadeid.length; i++) {
                var shadeid = $('#fltshadeid option[value=' + fltshadeid[i] + ']').val();
                var shade = $('#fltshadeid option[value=' + fltshadeid[i] + ']').text();
                fltshadearr.push({
                    'id': shadeid,
                    'name': shade
                });
                fltshadeidarr.push(shadeid);
            }
        }
        // //console.log(fltshadearr);
        // //console.log(fltshadeidarr);
        if (fltshadeidarr.length > 0) {
            $("#s_fltshadeid").val(fltshadeidarr).trigger('change');
            $('#s_fltshadeid').select2();
        } else {
            $("#s_fltshadeid").val(null).trigger('change');
            $('#s_fltshadeid').select2();
        }


        /* fltcutarr = [];
        fltcutidarr = [];
        var fltcutid = $('#fltcutid').val();
        if (fltcutid.length > 0) {
            for (var i = 0; i < fltcutid.length; i++) {
                var cutid = $('#fltcutid option[value=' + fltcutid[i] + ']').val();
                var cut = $('#fltcutid option[value=' + fltcutid[i] + ']').text();
                fltcutarr.push({
                    'id': cutid,
                    'name': cut
                });
                fltcutidarr.push(cutid);
            }
        }
        // //console.log(fltcutarr);
        // //console.log(fltcutidarr);
        if (fltcutidarr.length > 0) {
            $("#s_fltcutid").val(fltcutidarr).trigger('change');
            $('#s_fltcutid').select2();
        } else {
            $("#s_fltcutid").val(null).trigger('change');
            $('#s_fltcutid').select2();
        } */

        fltfromcutarr = [];
        flttocutarr = [];
        var fltfromcutid = $('#fltfromcutid :selected').val();
        var fltfromcutidname = $('#fltfromcutid option:selected').text();

        var flttocutid = $('#flttocutid :selected').val();
        var flttocutidname = $('#flttocutid option:selected').text();

        if (fltfromcutid !='' && flttocutid !='') {
            fltfromcutarr.push({
                'id': fltfromcutid,
                'name': fltfromcutidname
            });
            $('#s_fltfromcutid').val(fltfromcutid);
            $('#s_fltfromcutid').select2();

           flttocutarr.push({
                'id': flttocutid,
                'name': flttocutidname
            });
            $('#s_flttocutid').val(flttocutid);
            $('#s_flttocutid').select2();
        }

        fltfrompolisharr = [];
        flttopolisharr = [];
        var fltfrompolishid = $('#fltfrompolishid :selected').val();
        var fltfrompolishidname = $('#fltfrompolishid option:selected').text();

        var flttopolishid = $('#flttopolishid :selected').val();
        var flttopolishidname = $('#flttopolishid option:selected').text();

        if (fltfrompolishid !='' && flttopolishid !='') {
            fltfrompolisharr.push({
                'id': fltfrompolishid,
                'name': fltfrompolishidname
            });
            $('#s_fltfrompolishid').val(fltfrompolishid);
            $('#s_fltfrompolishid').select2();

           flttopolisharr.push({
                'id': flttopolishid,
                'name': flttopolishidname
            });
            $('#s_flttopolishid').val(flttopolishid);
            $('#s_flttopolishid').select2();
        }

        fltfromsymmetryarr = [];
        flttosymmetryarr = [];
        var fltfromsymmetryid = $('#fltfromsymmetryid :selected').val();
        var fltfromsymmetryidname = $('#fltfromsymmetryid option:selected').text();

        var flttosymmetryid = $('#flttosymmetryid :selected').val();
        var flttosymmetryidname = $('#flttosymmetryid option:selected').text();

        if (fltfromsymmetryid !='' && flttosymmetryid !='') {
            fltfromsymmetryarr.push({
                'id': fltfromsymmetryid,
                'name': fltfromsymmetryidname
            });
            $('#s_fltfromsymmetryid').val(fltfromsymmetryid);
            $('#s_fltfromsymmetryid').select2();

           flttosymmetryarr.push({
                'id': flttosymmetryid,
                'name': flttosymmetryidname
            });
            $('#s_flttosymmetryid').val(flttosymmetryid);
            $('#s_flttosymmetryid').select2();
        }


       /*  fltintensityarr = [];
        fltintensityidarr = [];
        var fltintensity = $('#fltintensity').val();
        if (fltintensity.length > 0) {
            for (var i = 0; i < fltintensity.length; i++) {
                var intensityid = $('#fltintensity option[value=' + fltintensity[i] + ']').val();
                var intensity = $('#fltintensity option[value=' + fltintensity[i] + ']').text();
                fltintensityarr.push({
                    'id': intensityid,
                    'name': intensity
                });
                fltintensityidarr.push(intensityid);
            }
        }
        if (fltintensityidarr.length > 0) {
            $("#s_fltintensity").val(fltintensityidarr).trigger('change');
            $('#s_fltintensity').select2();
        } else {
            $("#s_fltintensity").val(null).trigger('change');
            $('#s_fltintensity').select2();
        } */

        fltfromintensityarr = [];
        flttointensityarr = [];
        var fltfromintensity = $('#fltfromintensity :selected').val();
        var fltfromintensityname = $('#fltfromintensity option:selected').text();

        var flttointensity = $('#flttointensity :selected').val();
        var flttointensityname = $('#flttointensity option:selected').text();

        if (fltfromintensity !='' && flttointensity !='') {
            fltfromintensityarr.push({
                'id': fltfromintensity,
                'name': fltfromintensityname
            });
            $('#s_fltfromintensity').val(fltfromintensity);
            $('#s_fltfromintensity').select2();
           

            flttointensityarr.push({
                'id': flttointensity,
                'name': flttointensityname
            });
            $('#s_flttointensity').val(flttointensity);
            $('#s_flttointensity').select2();
        }

        fltovertonearr = [];
        fltovertoneidarr = [];
        var fltovertone = $('#fltovertone').val();
        if (fltovertone.length > 0) {
            for (var i = 0; i < fltovertone.length; i++) {
                var overtoneid = $('#fltovertone option[value=' + fltovertone[i] + ']').val();
                var overtone = $('#fltovertone option[value=' + fltovertone[i] + ']').text();
                fltovertonearr.push({
                    'id': overtoneid,
                    'name': overtone
                });
                fltovertoneidarr.push(overtoneid);
            }
        }
        if (fltovertoneidarr.length > 0) {
            $("#s_fltovertone").val(fltovertoneidarr).trigger('change');
            $('#s_fltovertone').select2();
        } else {
            $("#s_fltovertone").val(null).trigger('change');
            $('#s_fltovertone').select2();
        }

        fltcolorarr = [];
        fltcoloridarr = [];
        var fltcolor = $('#fltcolor').val();
        if (fltcolor.length > 0) {
            for (var i = 0; i < fltcolor.length; i++) {
                var colorid = $('#fltcolor option[value=' + fltcolor[i] + ']').val();
                var color = $('#fltcolor option[value=' + fltcolor[i] + ']').text();
                fltcolorarr.push({
                    'id': colorid,
                    'name': color
                });
                fltcoloridarr.push(colorid);
            }
        }
        if (fltcoloridarr.length > 0) {
            $("#s_fltcolor").val(fltcoloridarr).trigger('change');
            $('#s_fltcolor').select2();
        } else {
            $("#s_fltcolor").val(null).trigger('change');
            $('#s_fltcolor').select2();
        }


        /* fltpolisharr = [];
        fltpolishidarr = [];
        var fltpolishid = $('#fltpolishid').val();
        if (fltpolishid.length > 0) {
            for (var i = 0; i < fltpolishid.length; i++) {
                var polishid = $('#fltpolishid option[value=' + fltpolishid[i] + ']').val();
                var polish = $('#fltpolishid option[value=' + fltpolishid[i] + ']').text();
                fltpolisharr.push({
                    'id': polishid,
                    'name': polish
                });
                fltpolishidarr.push(polishid);
            }
        }
        // //console.log(fltpolisharr);
        // //console.log(fltpolishidarr);
        if (fltpolishidarr.length > 0) {
            $("#s_fltpolishid").val(fltpolishidarr).trigger('change');
            $('#s_fltpolishid').select2();
        } else {
            $("#s_fltpolishid").val(null).trigger('change');
            $('#s_fltpolishid').select2();
        } */

       /*  fltsymmetryarr = [];
        fltsymmetryidarr = [];
        var fltsymmetryid = $('#fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            for (var i = 0; i < fltsymmetryid.length; i++) {
                var symmetryid = $('#fltsymmetryid option[value=' + fltsymmetryid[i] + ']').val();
                var symmetry = $('#fltsymmetryid option[value=' + fltsymmetryid[i] + ']').text();
                fltsymmetryarr.push({
                    'id': symmetryid,
                    'name': symmetry
                });
                fltsymmetryidarr.push(symmetryid);
            }
        }
        // //console.log(fltsymmetryarr);
        // //console.log(fltsymmetryidarr);
        if (fltsymmetryidarr.length > 0) {
            $("#s_fltsymmetryid").val(fltsymmetryidarr).trigger('change');
            $('#s_fltsymmetryid').select2();
        } else {
            $("#s_fltsymmetryid").val(null).trigger('change');
            $('#s_fltsymmetryid').select2();
        } */


        intensityarr = [];
        intensityidarr = [];
        $('#intensityDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                intensityarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                intensityidarr.push($(this).val());
            }
        });
        // //console.log(intensityarr);
        // //console.log(intensityidarr);
        if (intensityidarr.length > 0) {
            $("#s_fltintensityid").val(intensityidarr).trigger('change');
            $('#s_fltintensityid').select2();
        } else {
            $("#s_fltintensityid").val(null).trigger('change');
            $('#s_fltintensityid').select2();
        }

        fltfluorescencecolorarr = [];
        fltfluorescencecoloridarr = [];
        var fltfluorescencecolorid = $('#fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            for (var i = 0; i < fltfluorescencecolorid.length; i++) {
                var fluorescencecolorid = $('#fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').val();
                var fluorescencecolor = $('#fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').text();
                fltfluorescencecolorarr.push({
                    'id': fluorescencecolorid,
                    'name': fluorescencecolor
                });
                fltfluorescencecoloridarr.push(fluorescencecolorid);
            }
        }
        // //console.log(fltfluorescencecolorarr);
        // //console.log(fltfluorescencecoloridarr);
        if (fltfluorescencecoloridarr.length > 0) {
            $("#s_fltfluorescencecolorid").val(fltfluorescencecoloridarr).trigger('change');
            $('#s_fltfluorescencecolorid').select2();
        } else {
            $("#s_fltfluorescencecolorid").val(null).trigger('change');
            $('#s_fltfluorescencecolorid').select2();
        }

        labarr = [];
        $('#labDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                labarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                $('#s_fltlabid' + $(this).val() + '').prop('checked', true);
            } else {
                $('#s_fltlabid' + $(this).val() + '').prop('checked', false);
            }
        });


        ssizearr = [];
        ssizeidarr = [];
        $('#ssizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                ssizearr.push({
                    'id': $(this).data('mainid'),
                    'name': $(this).attr('data-name')
                });
                ssizeidarr.push($(this).val());
                $('#s_fltsizechkid' + $(this).data('mainid') + '').prop('checked', true);
            } else {
                $('#s_fltsizechkid' + $(this).data('mainid') + '').prop('checked', false);
            }
        });

        // //console.log(labarr);
        fltlocationarr = [];
        fltlocationidarr = [];
        var fltlocationid = $('#fltlocationid').val();
        if (fltlocationid.length > 0) {
            for (var i = 0; i < fltlocationid.length; i++) {
                var locationid = $('#fltlocationid option[value=' + fltlocationid[i] + ']').val();
                var location = $('#fltlocationid option[value=' + fltlocationid[i] + ']').text();
                fltlocationarr.push({
                    'id': locationid,
                    'name': location
                });
                fltlocationidarr.push(locationid);
            }
        }
        // console.log('Location :  '+fltlocationarr);
        // console.log('Location ID :  '+fltlocationidarr);

        if (fltlocationidarr.length > 0) {
            $("#s_fltlocationid").val(fltlocationidarr).trigger('change');
            $('#s_fltlocationid').select2();
        } else {
            $("#s_fltlocationid").val(null).trigger('change');
            $('#s_fltlocationid').select2();
        }

        fltroughsourcearr = [];
        fltroughsourceidarr = [];
        var fltroughsourceid = $('#fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            for (var i = 0; i < fltroughsourceid.length; i++) {
                var roughsourceid = $('#fltroughsourceid option[value=' + fltroughsourceid[i] + ']').val();
                var roughsource = $('#fltroughsourceid option[value=' + fltroughsourceid[i] + ']').text();
                fltroughsourcearr.push({
                    'id': roughsourceid,
                    'name': roughsource
                });
                fltroughsourceidarr.push(roughsourceid);
            }
        }
        // //console.log(fltroughsourcearr);
        // //console.log(fltroughsourceidarr);
        if (fltroughsourceidarr.length > 0) {
            $("#s_fltroughsourceid").val(fltroughsourceidarr).trigger('change');
            $('#s_fltroughsourceid').select2();
        } else {
            $("#s_fltroughsourceid").val(null).trigger('change');
            $('#s_fltroughsourceid').select2();
        }


        mediaarr = [];
        $('#mediaDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                mediaarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        $('#s_Mediaphoto').prop('checked', false);
        $('#s_Mediavideo').prop('checked', false);
        $('#s_MediaReport').prop('checked', false);
        if ($('#Mediaphoto').prop('checked') == true) {
            $('#s_Mediaphoto').prop('checked', true);
        }
        if ($('#Mediavideo').prop('checked') == true) {
            $('#s_Mediavideo').prop('checked', true);
        }
        if ($('#MediaReport').prop('checked') == true) {
            $('#s_MediaReport').prop('checked', true);
        }

        // //console.log(mediaarr);

        treatmentarr = [];
        treatmentidarr = [];
        $('#treatmentDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                treatmentarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                treatmentidarr.push($(this).val());
            }
        });
        // //console.log(treatmentarr);
        // //console.log(treatmentidarr);
        if (treatmentidarr.length > 0) {
            $("#s_flttreatment").val(treatmentidarr).trigger('change');
            $('#s_flttreatment').select2();
        } else {
            $("#s_flttreatment").val(null).trigger('change');
            $('#s_flttreatment').select2();
        }

        keytosymbolarr = [];
        keytosymbolidarr = [];
        $('#keytosymbolDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                keytosymbolarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                keytosymbolidarr.push($(this).val());
            }
        });
        // //console.log(keytosymbolarr);
        // //console.log(keytosymbolidarr);
        if (keytosymbolidarr.length > 0) {
            $("#s_fltkeytosymbols").val(keytosymbolidarr).trigger('change');
            $('#s_fltkeytosymbols').select2();
        } else {
            $("#s_fltkeytosymbols").val(null).trigger('change');
            $('#s_fltkeytosymbols').select2();
        }

        brandarr = [];
        brandidarr = [];
        $('#brandDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                brandarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                brandidarr.push($(this).val());
            }
        });
        // //console.log(brandarr);
        // //console.log(brandidarr);
        if (brandidarr.length > 0) {
            $("#s_fltbrand").val(brandidarr).trigger('change');
            $('#s_fltbrand').select2();
        } else {
            $("#s_fltbrand").val(null).trigger('change');
            $('#s_fltbrand').select2();
        }


        fltcompanycodearr = [];
        var fltcompanycode = $('#fltcompanycode').val();
        var fltcompanycodename = $('#fltcompanycode option:selected').text();
        if (fltcompanycode) {
            fltcompanycodearr.push({
                'id': fltcompanycode,
                'name': fltcompanycodename
            });
            $('#s_fltcompanycode').val(fltcompanycode);
            $('#s_fltcompanycode').select2();
        }
        // //console.log(fltcompanycodearr);

        fltstocknumbersarr = [];
        var fltstocknumbers = $('#fltstocknumbers').val();
        var fltstocknumbersname = $('#fltstocknumbers option:selected').text();
        if (fltstocknumbers) {
            fltstocknumbersarr.push({
                'id': fltstocknumbers,
                'name': fltstocknumbersname
            });
            $('#s_fltstocknumbers').val(fltstocknumbers);
            $('#s_fltstocknumbers').select2();
        }
        // //console.log(fltstocknumbersarr);

        fltsavanilotnumberarr = [];
        var fltsavanilotnumber = $('#fltlotnumbers').val();
        var fltsavanilotnumbername = $('#fltlotnumbers option:selected').text();
        if (fltsavanilotnumber) {
            fltsavanilotnumberarr.push({
                'id': fltsavanilotnumber,
                'name': fltsavanilotnumbername
            });
            $('#s_fltlotnumbers').val(fltsavanilotnumber);
            $('#s_fltlotnumbers').select2();
        }
        // //console.log(fltsavanilotnumberarr);

        

        fltfromprice = $('#fltfromprice').val();
        $('#s_fltfromprice').val(fltfromprice);
        flttoprice = $('#flttoprice').val();
        $('#s_flttoprice').val(flttoprice);

        fltfromsavanipercentage = $('#fltfromsavanipercentage').val();
        $('#s_fltfromsavanipercentage').val(fltfromsavanipercentage);
        flttosavanipercentage = $('#flttosavanipercentage').val();
        $('#s_flttosavanipercentage').val(flttosavanipercentage);

        fltfromdepthper = $('#fltfromdepthper').val();
        $('#s_fltfromdepthper').val(fltfromdepthper);

        flttodepthper = $('#flttodepthper').val();
        $('#s_flttodepthper').val(flttodepthper);

        fltfromtableper = $('#fltfromtableper').val();
        $('#s_fltfromtableper').val(fltfromtableper);

        flttotableper = $('#flttotableper').val();
        $('#s_flttotableper').val(flttotableper);

        fltfromlength = $('#fltfromlength').val();
        $('#s_fltfromlength').val(fltfromlength);

        flttolength = $('#flttolength').val();
        $('#s_flttolength').val(flttolength);

        fltfromwidth = $('#fltfromwidth').val();
        $('#s_fltfromwidth').val(fltfromwidth);

        flttowidth = $('#flttowidth').val();
        $('#s_flttowidth').val(flttowidth);

        fltfromdepth = $('#fltfromdepth').val();
        $('#s_fltfromdepth').val(fltfromdepth);

        flttodepth = $('#flttodepth').val();
        $('#s_flttodepth').val(flttodepth);

        fltlabreportnumber = $('#fltlabreportnumber').val();
        $('#s_fltlabreportnumber').val(fltlabreportnumber);

        $('#s_nobgm').prop('checked', false);
        if ($('#nobgm').prop('checked') == true) {
            $('#s_nobgm').prop('checked', true);
        }

        $('#containshade').prop('checked', false);
        if ($('#shadecontain').prop('checked') == true) {
            $('#containshade').prop('checked', true);
        }
        $('#dtcontainshade').prop('checked', false);
        if ($('#dtshadecontain').prop('checked') == true) {
            $('#dtcontainshade').prop('checked', true);
        }

        fltcrownfromheightper = $('#fltcrownfromheightper').val();
        $('#s_fltcrownfromheightper').val(fltcrownfromheightper);

        fltcrowntoheightper = $('#fltcrowntoheightper').val();
        $('#s_fltcrowntoheightper').val(fltcrowntoheightper);

        fltcrownfromangel = $('#fltcrownfromangel').val();
        $('#s_fltcrownfromangel').val(fltcrownfromangel);

        fltcrowntoangel = $('#fltcrowntoangel').val();
        $('#s_fltcrowntoangel').val(fltcrowntoangel);

        fltpavilionfromdepthper = $('#fltpavilionfromdepthper').val();
        $('#s_fltpavilionfromdepthper').val(fltpavilionfromdepthper);

        fltpaviliontodepthper = $('#fltpaviliontodepthper').val();
        $('#s_fltpaviliontodepthper').val(fltpaviliontodepthper);

        fltpavilionfromangle = $('#fltpavilionfromangle').val();
        $('#s_fltpavilionfromangle').val(fltpavilionfromangle);

        fltpaviliontoangle = $('#fltpaviliontoangle').val();
        $('#s_fltpaviliontoangle').val(fltpaviliontoangle);


        fltgridlearr = [];
        fltgridleidarr = [];
        $('#gridleDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                fltgridlearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                fltgridleidarr.push($(this).val());
            }
        });
        if (fltgridleidarr.length > 0) {
            $("#s_fltgridleid").val(fltgridleidarr).trigger('change');
            $('#s_fltgridleid').select2();
        } else {
            $("#s_fltgridleid").val(null).trigger('change');
            $('#s_fltgridleid').select2();
        }

        fltculetsizearr = [];
        fltculetsizeidarr = [];
        $('#culetsizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                fltculetsizearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                fltculetsizeidarr.push($(this).val());
            }
        });
        if (fltculetsizeidarr) {
            if (fltculetsizeidarr.length > 0) {

                $("#s_fltculetsizeid").val(fltculetsizeidarr).trigger('change');
                $('#s_fltculetsizeid').select2();
            }
        } else {
            $("#s_fltculetsizeid").val(null).trigger('change');
            $('#s_fltculetsizeid').select2();
        }

        fltculetconditionarr = [];
        fltculetconditionidarr = [];
        $('#culetconditionDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                fltculetconditionarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
                fltculetconditionidarr.push($(this).val());
            }
        });
        if (fltculetconditionidarr) {
            if (fltculetconditionidarr.length > 0) {
                $("#s_fltculetconditionid").val(fltculetconditionidarr).trigger('change');
                $('#s_fltculetconditionid').select2();
            }
        } else {
            $("#s_fltculetconditionid").val(null).trigger('change');
            $('#s_fltculetconditionid').select2();
        }

        fltfromratio = $('#fltfromratio').val();
        $('#s_fltfromratio').val(fltfromratio);
        flttoratio = $('#flttoratio').val();
        $('#s_flttoratio').val(flttoratio);

        checksidediamondformelementvalue();
        getsidebarelementvalue();

    }

    $('body').on('input','#fltfromsavanipercentage',function(){
        var fltfromsavanipercentage=$(this).val();
        if(fltfromsavanipercentage>100)
        {
            $('#fltfromsavanipercentage').val(100);
            $('#s_fltfromsavanipercentage').val(100);
        }
    })

    $('body').on('input','#flttosavanipercentage',function(){
        var flttosavanipercentage=$(this).val();
        if(flttosavanipercentage>100)
        {
            $('#flttosavanipercentage').val(100);
            $('#s_flttosavanipercentage').val(100);
        }
    })

    $('body').on('input','#fltcrownfromheightper',function(){
        var fltcrownfromheightper=$(this).val();
        if(fltcrownfromheightper>100)
        {
            $('#fltcrownfromheightper').val(100);
            $('#s_fltcrownfromheightper').val(100);
        }
    })
    $('body').on('input','#fltcrowntoheightper',function(){
        var fltcrowntoheightper=$(this).val();
        if(fltcrowntoheightper>100)
        {
            $('#fltcrowntoheightper').val(100);
            $('#s_fltcrowntoheightper').val(100);
        }
    })

    $('body').on('input','#fltpavilionfromdepthper',function(){
        var fltpavilionfromdepthper=$(this).val();
        if(fltpavilionfromdepthper>100)
        {
            $('#fltpavilionfromdepthper').val(100);
            $('#s_fltpavilionfromdepthper').val(100);
        }
    })
    $('body').on('input','#fltpaviliontodepthper',function(){
        var fltpaviliontodepthper=$(this).val();
        if(fltpaviliontodepthper>100)
        {
            $('#fltpaviliontodepthper').val(100);
            $('#s_fltpaviliontodepthper').val(100);
        }
    })

    /* LIST SEARCH FILTERS */
    function fillsearchdiamondlist(type) {
        console.log(ssizearr);
        var htmllistdata = '';

        if (shapearr.length > 0) {
            for (var i = 0; i < shapearr.length; i++) {
                var id = shapearr[i].id;
                var name = shapearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeshapeflt  fltshape' + id + ' searchbtnset"><b> Shape : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfromsize && flttosize > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtosize searchbtnset"><b> Size : </b><span>' + fltfromsize + '-' + flttosize + '</span> X</a>';
        }

        if (sizearr.length > 0) {
            for (var i = 0; i < sizearr.length; i++) {
                var id = sizearr[i].id;
                var name = sizearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesizeflt  fltsize' + id + ' searchbtnset"><b> Size : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (colorarr.length > 0) {
            for (var i = 0; i < colorarr.length; i++) {
                var id = colorarr[i].id;
                var name = colorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecolorflt  fltcolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (clarityarr.length > 0) {
            for (var i = 0; i < clarityarr.length; i++) {
                var id = clarityarr[i].id;
                var name = clarityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeclarityflt  fltclarity' + id + ' searchbtnset"><b> Clarity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (flteyecleanarr.length > 0) {
            for (var i = 0; i < flteyecleanarr.length; i++) {
                var id = flteyecleanarr[i].id;
                var name = flteyecleanarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeeyecleanflt  flteyeclean' + id + ' searchbtnset"><b> Eye Clean : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        /* if (fltmilkyarr.length > 0) {
            for (var i = 0; i < fltmilkyarr.length; i++) {
                var id = fltmilkyarr[i].id;
                var name = fltmilkyarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemilkyflt  fltmilky' + id + ' searchbtnset"><b> Milky : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        } */
        
        if (fltfrommilkyarr.length > 0 && flttomilkyarr.length > 0) {
                var id = fltfrommilkyarr[0].id;
                var name = fltfrommilkyarr[0].name+' To '+flttomilkyarr[0].name ;
                // console.log(fltfrommilkyarr[0].name);
                // console.log(name);
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removemilkyflt  fltmilky' + id + ' searchbtnset"><b>Milky : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltblackinclusionarr.length > 0) {
            for (var i = 0; i < fltblackinclusionarr.length; i++) {
                var id = fltblackinclusionarr[i].id;
                var name = fltblackinclusionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeblackinclusionflt  fltblackinclusion' + id + ' searchbtnset"><b> Black Inclusion : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltwhiteinclusionarr.length > 0) {
            for (var i = 0; i < fltwhiteinclusionarr.length; i++) {
                var id = fltwhiteinclusionarr[i].id;
                var name = fltwhiteinclusionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removewhiteinclusionflt  fltwhiteinclusion' + id + ' searchbtnset"><b> White Inclusion : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltopeninclusionarr.length > 0) {
            for (var i = 0; i < fltopeninclusionarr.length; i++) {
                var id = fltopeninclusionarr[i].id;
                var name = fltopeninclusionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeopeninclusionflt  fltopeninclusion' + id + ' searchbtnset"><b> Open Inclusion : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltshadearr.length > 0) {
            for (var i = 0; i < fltshadearr.length; i++) {
                var id = fltshadearr[i].id;
                var name = fltshadearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeshadeflt  fltshade' + id + ' searchbtnset"><b> Shade : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

       /*  if (fltcutarr.length > 0) {
            for (var i = 0; i < fltcutarr.length; i++) {
                var id = fltcutarr[i].id;
                var name = fltcutarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecutflt  fltcut' + id + ' searchbtnset"><b> Cut : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        } */

        if (fltfromcutarr.length > 0 && flttocutarr.length > 0) {
                var id = fltfromcutarr[0].id;
                var name = fltfromcutarr[0].name+' To '+flttocutarr[0].name ;
                // console.log(fltfromcutarr[0].name);
                // console.log(name);
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecutflt  fltcut' + id + ' searchbtnset"><b>Cut : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        /* if (fltintensityarr.length > 0) {
            for (var i = 0; i < fltintensityarr.length; i++) {
                var id = fltintensityarr[i].id;
                var name = fltintensityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removefancyintensityflt  fltfancyintensity' + id + ' searchbtnset"><b> Intensity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        } */

        if (fltfromintensityarr.length > 0 && flttointensityarr.length > 0) {
           
                var id = fltfromintensityarr[0].id;
                var name = fltfromintensityarr[0].name+' To '+flttointensityarr[0].name ;

                if(id!='' && id!='undefined')
                {
                    htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removefancyintensityflt  fltfancyintensity' + id + ' searchbtnset"><b>Fancy Intensity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
                }
            
        }

        if (fltovertonearr.length > 0) {
            for (var i = 0; i < fltovertonearr.length; i++) {
                var id = fltovertonearr[i].id;
                var name = fltovertonearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removefancyovertoneflt  fltfancyovertone' + id + ' searchbtnset"><b> Overtone : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltcolorarr.length > 0) {
            for (var i = 0; i < fltcolorarr.length; i++) {
                var id = fltcolorarr[i].id;
                var name = fltcolorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removefancycolorflt  fltfancycolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        
        /* if (fltpolisharr.length > 0) {
            for (var i = 0; i < fltpolisharr.length; i++) {
                var id = fltpolisharr[i].id;
                var name = fltpolisharr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removepolishflt  fltpolish' + id + ' searchbtnset"><b> Polish : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        } */

        if (fltfrompolisharr.length > 0 && flttopolisharr.length > 0) {
                var id = fltfrompolisharr[0].id;
                var name = fltfrompolisharr[0].name+' To '+flttopolisharr[0].name ;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removepolishflt  fltpolish' + id + ' searchbtnset"><b>Polish : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        /* if (fltsymmetryarr.length > 0) {
            for (var i = 0; i < fltsymmetryarr.length; i++) {
                var id = fltsymmetryarr[i].id;
                var name = fltsymmetryarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesymmetryflt  fltsymmetry' + id + ' searchbtnset"><b> Symmetry : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        } */
        if (fltfromsymmetryarr.length > 0 && flttosymmetryarr.length > 0) {
                var id = fltfromsymmetryarr[0].id;
                var name = fltfromsymmetryarr[0].name+' To '+flttosymmetryarr[0].name ;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesymmetryflt  fltsymmetry' + id + ' searchbtnset"><b>Symmetry : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (intensityarr.length > 0) {
            for (var i = 0; i < intensityarr.length; i++) {
                var id = intensityarr[i].id;
                var name = intensityarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeintensityflt  fltintensity' + id + ' searchbtnset"><b> Intensity : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfluorescencecolorarr.length > 0) {
            for (var i = 0; i < fltfluorescencecolorarr.length; i++) {
                var id = fltfluorescencecolorarr[i].id;
                var name = fltfluorescencecolorarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removefluorescencecolorflt  fltfluorescencecolor' + id + ' searchbtnset"><b> Color : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (labarr.length > 0) {
            for (var i = 0; i < labarr.length; i++) {
                var id = labarr[i].id;
                var name = labarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removelabflt  fltlab' + id + ' searchbtnset"><b> Grading Report : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

       
        if (ssizearr.length > 0) {
            for (var i = 0; i < ssizearr.length; i++) {
                var id = ssizearr[i].id;
                var name = ssizearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removessizeflt  fltssize' + id + ' searchbtnset"><b> Size : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltlocationarr.length > 0) {
            for (var i = 0; i < fltlocationarr.length; i++) {
                var id = fltlocationarr[i].id;
                var name = fltlocationarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removelocationflt  fltlocation' + id + ' searchbtnset"><b> Location : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltroughsourcearr.length > 0) {
            for (var i = 0; i < fltroughsourcearr.length; i++) {
                var id = fltroughsourcearr[i].id;
                var name = fltroughsourcearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeroughsourceflt  fltroughsource' + id + ' searchbtnset"><b> Rough Source : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if ($('#s_Mediaphoto').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '"  class="btn removMediaphotoflt  fltMediaphoto m-1 searchbtnset"><span>With Photo</span> <span class="btn-remove-tag">X</span></a>';
        }
        if ($('#s_MediaReport').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '"  class="btn removeMediaReportflt  fltMediaReport m-1 searchbtnset"><span>With Report</span> <span class="btn-remove-tag">X</span></a>';
        }
        if ($('#s_Mediavideo').prop('checked') == true) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '"  class="btn removeMediavideoflt  fltMediavideo m-1 searchbtnset"><span>With Video</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (treatmentarr.length > 0) {
            for (var i = 0; i < treatmentarr.length; i++) {
                var id = treatmentarr[i].id;
                var name = treatmentarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removetreatmentflt  flttreatment' + id + ' searchbtnset"><b> Treatment : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if (keytosymbolarr.length > 0) {
            for (var i = 0; i < keytosymbolarr.length; i++) {
                var id = keytosymbolarr[i].id;
                var name = keytosymbolarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removekeytosymbolflt  fltkeytosymbol' + id + ' searchbtnset"><b> Key to Symbol : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (brandarr.length > 0) {
            for (var i = 0; i < brandarr.length; i++) {
                var id = brandarr[i].id;
                var name = brandarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removebrandflt  fltbrand' + id + ' searchbtnset"><b> Brand : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltcompanycodearr.length > 0) {
            for (var i = 0; i < fltcompanycodearr.length; i++) {
                var id = fltcompanycodearr[i].id;
                var name = fltcompanycodearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removecompanycodeflt  fltcompanycode' + id + ' searchbtnset"><b> Company Code : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltstocknumbersarr.length > 0) {
            for (var i = 0; i < fltstocknumbersarr.length; i++) {
                var id = fltstocknumbersarr[i].id;
                var name = fltstocknumbersarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1  removestocknumbersflt  fltstocknumbers' + id + ' searchbtnset"><b> Stock Numbers : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltsavanilotnumberarr.length > 0) {
            for (var i = 0; i < fltsavanilotnumberarr.length; i++) {
                var id = fltsavanilotnumberarr[i].id;
                var name = fltsavanilotnumberarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removesavanilotnumberflt  fltsavanilotnumber' + id + ' searchbtnset"><b> Savani Lot Number : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfromprice && flttoprice > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtoprice m-1 searchbtnset"><b> Price : </b><span>$' + fltfromprice + '-$' + flttoprice + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromsavanipercentage && flttosavanipercentage > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtopercentage m-1 searchbtnset"><b> Percentage : </b><span>' + fltfromsavanipercentage + '%  To ' + flttosavanipercentage + '%</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromdepthper && flttodepthper > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtodepthper m-1 searchbtnset"><b> Depth(%) : </b><span>' + fltfromdepthper + '%-' + flttodepthper + '%</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromtableper && flttotableper > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtotableper m-1 searchbtnset"><b> Table(%) : </b><span>' + fltfromtableper + '%-' + flttotableper + '%</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromlength && flttolength > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtolength m-1 searchbtnset"><b> Length : </b><span>' + fltfromlength + '-' + flttolength + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromwidth && flttowidth > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removewidth m-1  searchbtnset"><b> Width : </b><span>' + fltfromwidth + '-' + flttowidth + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltfromdepth && flttodepth > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removedepth m-1 searchbtnset"><b> Depth : </b><span>' + fltfromdepth + '-' + flttodepth + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltlabreportnumber) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removelabreportnumber  m-1 searchbtnset"><b> Lab Report Number : </b><span>' + fltlabreportnumber + '</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltcrownfromheightper && fltcrowntoheightper > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removecrownfromheightper m-1 searchbtnset"><b> Crown Height(%) : </b><span>' + fltcrownfromheightper + '%-' + fltcrowntoheightper + '%</span> <span class="btn-remove-tag">X</span></a>';
        }

        if (fltcrownfromangel && fltcrowntoangel > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removecrownfromangel m-1 searchbtnset"><b> Crown Angel : </b><span>' + fltcrownfromangel + '-' + fltcrowntoangel + '%</span> <span class="btn-remove-tag">X</span></a>';
        }


        if (fltpavilionfromdepthper && fltpaviliontodepthper > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removepavilionfromdepthper m-1 searchbtnset"><b> Pavilion Depth(%) : </b><span>' + fltpavilionfromdepthper + '%-' + fltpaviliontodepthper + '%</span> <span class="btn-remove-tag">X</span></a>';
        }
        if (fltpavilionfromangle && fltpaviliontoangle > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removepavilionfromangle m-1 searchbtnset"><b> Pavilion Angel : </b><span>' + fltpavilionfromangle + '-' + fltpaviliontoangle + '%</span> <span class="btn-remove-tag">X</span></a>';
        }


        if (fltgridlearr.length > 0) {
            for (var i = 0; i < fltgridlearr.length; i++) {
                var id = fltgridlearr[i].id;
                var name = fltgridlearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removegridleflt  fltgridle' + id + ' searchbtnset"><b> Gridle : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if (fltculetsizearr.length > 0) {
            for (var i = 0; i < fltculetsizearr.length; i++) {
                var id = fltculetsizearr[i].id;
                var name = fltculetsizearr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeculetsizeflt  fltculetsize' + id + ' searchbtnset"><b> Culet Size : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }
        if (fltculetconditionarr.length > 0) {
            for (var i = 0; i < fltculetconditionarr.length; i++) {
                var id = fltculetconditionarr[i].id;
                var name = fltculetconditionarr[i].name;
                htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-name="' + name + '" class="btn m-1 removeculetconditionflt  fltculetcondition' + id + ' searchbtnset"><b> Culet Condition : </b><span>' + name + '</span> <span class="btn-remove-tag">X</span></a>';
            }
        }

        if (fltfromratio && flttoratio > 0) {
            htmllistdata += '<a href="javascript:void(0);" data-type="' + type + '" class="btn removefromtoratio searchbtnset"><b> Ratio : </b><span>' + fltfromratio + '  - ' + flttoratio + ' </span> <span class="btn-remove-tag">X</span></a>';
        }

        $('.searchdiamondlistDiv').html(htmllistdata);
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

    /* REMOVE SEARCH FILTERS */
    $('body').on('click', '.removeshapeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltshape' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(shapearr, id);
        shapeidarr.splice($.inArray(id, shapeidarr), 1);
        $("#s_fltshapeid").val(shapeidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtosize', function() {
        var type = $(this).attr('data-type');
        $('#fltfromsize').val(0);
        $('#flttosize').val(0);
        $('#s_fltfromsize').val(0);
        $('#s_flttosize').val(0);
        $(this).remove();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removesizeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltsize' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        $('#s_fltsizeid' + id + '').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removecolorflt', function() {

        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltcolor' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(colorarr, id);
        coloridarr.splice($.inArray(id, coloridarr), 1);
        $("#s_fltcolorid").val(coloridarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeclarityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltclarity' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(clarityarr, id);
        clarityidarr.splice($.inArray(id, clarityidarr), 1);
        $("#s_fltclarityid").val(clarityidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    

    $('body').on('click', '.removeeyecleanflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(flteyecleanarr, id);
        flteyecleanidarr.splice($.inArray(id, flteyecleanidarr), 1);
        $('.flteyeclean' + id + '').remove();
        // $("#flteyecleanid").val(flteyecleanidarr).trigger('change');
        $("#s_flteyecleanid").val(flteyecleanidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* $('body').on('click', '.removemilkyflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltmilkyarr, id);
        fltmilkyidarr.splice($.inArray(id, fltmilkyidarr), 1);
        $('.fltmilky' + id + '').remove();
        // $("#fltmilkyid").val(fltmilkyidarr).trigger('change');
        $("#s_fltmilkyid").val(fltmilkyidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    }); */

    $('body').on('click', '.removemilkyflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltmilkyarr, id);
        fltmilkyarr.splice($.inArray(id, fltmilkyarr), 1);
        $('.fltmilky' + id + '').remove();
        // $("#fltcutid").val(fltintensityidarr).trigger('change');
        $("#s_fltfrommilkyid").val(fltmilkyarr).trigger('change');
        $("#s_flttomilkyid").val(fltmilkyarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeblackinclusionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltblackinclusionarr, id);
        fltblackinclusionidarr.splice($.inArray(id, fltblackinclusionidarr), 1);
        $('.fltblackinclusion' + id + '').remove();
        // $("#fltblackinclusionid").val(fltblackinclusionidarr).trigger('change');
        $("#s_fltblackinclusionid").val(fltblackinclusionidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removewhiteinclusionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltwhiteinclusionarr, id);
        fltwhiteinclusionidarr.splice($.inArray(id, fltwhiteinclusionidarr), 1);
        $('.fltwhiteinclusion' + id + '').remove();
        // $("#fltwhiteinclusionid").val(fltwhiteinclusionidarr).trigger('change');
        $("#s_fltwhiteinclusionid").val(fltwhiteinclusionidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removeopeninclusionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltopeninclusionarr, id);
        fltopeninclusionidarr.splice($.inArray(id, fltopeninclusionidarr), 1);
        $('.fltopeninclusion' + id + '').remove();
        // $("#fltopeninclusionid").val(fltopeninclusionidarr).trigger('change');
        $("#s_fltopeninclusionid").val(fltopeninclusionidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeshadeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltshadearr, id);
        fltshadeidarr.splice($.inArray(id, fltshadeidarr), 1);
        $('.fltshade' + id + '').remove();
        // $("#fltshadeid").val(fltshadeidarr).trigger('change');
        $("#s_fltshadeid").val(fltshadeidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* $('body').on('click', '.removecutflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltcutarr, id);
        fltcutidarr.splice($.inArray(id, fltcutidarr), 1);
        $('.fltcut' + id + '').remove();
        // $("#fltcutid").val(fltcutidarr).trigger('change');
        $("#s_fltcutid").val(fltcutidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    }); */

    $('body').on('click', '.removecutflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltcutarr, id);
        fltcutarr.splice($.inArray(id, fltcutarr), 1);
        $('.fltcut' + id + '').remove();
        // $("#fltcutid").val(fltintensityidarr).trigger('change');
        $("#s_fltfromcutid").val(fltcutarr).trigger('change');
        $("#s_flttocutid").val(fltcutarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* $('body').on('click', '.removepolishflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltpolisharr, id);
        fltpolishidarr.splice($.inArray(id, fltpolishidarr), 1);
        $('.fltpolish' + id + '').remove();
        // $("#fltpolishid").val(fltpolishidarr).trigger('change');
        $("#s_fltpolishid").val(fltpolishidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    }); */

    $('body').on('click', '.removepolishflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltpolisharr, id);
        fltpolisharr.splice($.inArray(id, fltpolisharr), 1);
        $('.fltpolish' + id + '').remove();
        // $("#fltpolishid").val(fltintensityidarr).trigger('change');
        $("#s_fltfrompolishid").val(fltpolisharr).trigger('change');
        $("#s_flttopolishid").val(fltpolisharr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* $('body').on('click', '.removesymmetryflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltsymmetryarr, id);
        fltsymmetryidarr.splice($.inArray(id, fltsymmetryidarr), 1);
        $('.fltsymmetry' + id + '').remove();
        // $("#fltsymmetryid").val(fltsymmetryidarr).trigger('change');
        $("#s_fltsymmetryid").val(fltsymmetryidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    }); */

    $('body').on('click', '.removesymmetryflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltsymmetryarr, id);
        fltsymmetryarr.splice($.inArray(id, fltsymmetryarr), 1);
        $('.fltsymmetry' + id + '').remove();
        // $("#fltsymmetryid").val(fltintensityidarr).trigger('change');
        $("#s_fltfromsymmetryid").val(fltsymmetryarr).trigger('change');
        $("#s_flttosymmetryid").val(fltsymmetryarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeintensityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltintensity' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(intensityarr, id);
        intensityidarr.splice($.inArray(id, intensityidarr), 1);
        $("#s_fltintensityid").val(intensityidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefluorescencecolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltfluorescencecolorarr, id);
        fltfluorescencecoloridarr.splice($.inArray(id, fltfluorescencecoloridarr), 1);
        $('.fltfluorescencecolor' + id + '').remove();
        // $("#fltfluorescencecolorid").val(fltfluorescencecoloridarr).trigger('change');
        $("#s_fltfluorescencecolorid").val(fltfluorescencecoloridarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removelabflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        //console.log(type);
        removeindexfromarr(labarr, id);
        $('.fltlab' + id + '').remove();
        $('#c' + id + '').prop('checked', false);
        $('#s_fltlabid' + id + '').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removessizeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        //console.log(type);
        removeindexfromarr(ssizearr, id);
        $('.fltssize' + id + '').remove();
        console.log('#c' + id + '');
        $('#c' + id + '').prop('checked', false);
        $('#s_fltsizechkid' + id + '').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removelocationflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltlocationarr, id);
        fltlocationidarr.splice($.inArray(id, fltlocationidarr), 1);
        $('.fltlocation' + id + '').remove();
        // $("#form-diamond-search #fltlocationid").val(fltlocationidarr).trigger('change');
        $("#s_fltlocationid").val(fltlocationidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeroughsourceflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltroughsourcearr, id);
        fltroughsourceidarr.splice($.inArray(id, fltroughsourceidarr), 1);
        $('.fltroughsource' + id + '').remove();
        // $("#fltroughsourceid").val(fltroughsourceidarr).trigger('change');
        $("#s_fltroughsourceid").val(fltroughsourceidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removMediaphotoflt', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#Mediaphoto').prop('checked', false);
        $('#s_Mediaphoto').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeMediaReportflt', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#MediaReport').prop('checked', false);
        $('#s_MediaReport').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removeMediavideoflt', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#Mediavideo').prop('checked', false);
        $('#s_Mediavideo').prop('checked', false);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });



    $('body').on('click', '.removetreatmentflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.flttreatment' + id + '').remove();
        $('#flttreatment' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(treatmentarr, id);
        treatmentidarr.splice($.inArray(id, treatmentidarr), 1);
        $("#s_flttreatment").val(treatmentidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removekeytosymbolflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltkeytosymbol' + id + '').remove();
        $('#fltkeytosymbols' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(keytosymbolarr, id);
        keytosymbolidarr.splice($.inArray(id, keytosymbolidarr), 1);
        $("#s_fltkeytosymbols").val(keytosymbolidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removebrandflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltbrand' + id + '').remove();
        $('#fltbrand' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(brandarr, id);
        brandidarr.splice($.inArray(id, brandidarr), 1);
        $("#s_fltbrand").val(brandidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removecompanycodeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltcompanycode' + id + '').remove();
        $('#fltcompanycode').val('');
        $('#fltcompanycode').select2();
        $('#s_fltcompanycode').val('');
        $('#s_fltcompanycode').select2();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removestocknumbersflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltstocknumbers' + id + '').remove();
        $('#fltstocknumbers').val('');
        $('#fltstocknumbers').select2();
        $('#s_fltstocknumbers').val('');
        $('#s_fltstocknumbers').select2();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removesavanilotnumberflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltsavanilotnumber' + id + '').remove();
        $('#fltlotnumbers').val('');
        $('#fltlotnumbers').select2();
        $('#s_fltlotnumbers').val('');
        $('#s_fltlotnumbers').select2();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtoprice', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromprice').val(0);
        $('#flttoprice').val(0);
        $('#s_fltfromprice').val(0);
        $('#s_flttoprice').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtopercentage', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromsavanipercentage').val(0);
        $('#flttosavanipercentage').val(0);
        $('#s_fltfromsavanipercentage').val(0);
        $('#s_flttosavanipercentage').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtodepthper', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromdepthper').val(0);
        $('#flttodepthper').val(0);
        $('#s_fltfromdepthper').val(0);
        $('#s_flttodepthper').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtotableper', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromtableper').val(0);
        $('#flttotableper').val(0);
        $('#s_fltfromtableper').val(0);
        $('#s_flttotableper').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtolength', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromlength').val(0);
        $('#flttolength').val(0);
        $('#s_fltfromlength').val(0);
        $('#s_flttolength').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removewidth', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromwidth').val(0);
        $('#flttowidth').val(0);
        $('#s_fltfromwidth').val(0);
        $('#s_flttowidth').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removedepth', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromdepth').val(0);
        $('#flttodepth').val(0);
        $('#s_fltfromdepth').val(0);
        $('#s_flttodepth').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removelabreportnumber', function() {
        $(this).remove();
        $('#fltlabreportnumber').val('');
        $('#s_fltlabreportnumber').val('');
        // getfiltersvalue();
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    
    $('body').on('click', '.removefancyintensityflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltintensityarr, id);
        fltintensityidarr.splice($.inArray(id, fltintensityidarr), 1);
        $('.fltfancyintensity' + id + '').remove();
        // $("#fltcutid").val(fltintensityidarr).trigger('change');
        $("#s_fltfromintensity").val(fltintensityidarr).trigger('change');
        $("#s_flttointensity").val(fltintensityidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefancyovertoneflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltovertonearr, id);
        fltovertoneidarr.splice($.inArray(id, fltovertoneidarr), 1);
        $('.fltfancyovertone' + id + '').remove();
        // $("#fltcutid").val(fltovertoneidarr).trigger('change');
        $("#s_fltovertone").val(fltovertoneidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefancycolorflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var arrid = removeindexfromarr(fltcolorarr, id);
        fltcoloridarr.splice($.inArray(id, fltcoloridarr), 1);
        $('.fltfancycolor' + id + '').remove();
        // $("#fltcutid").val(fltcoloridarr).trigger('change');
        $("#s_fltcolor").val(fltcoloridarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });


    $('body').on('click', '.removecrownfromheightper', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltcrownfromheightper').val(0);
        $('#fltcrowntoheightper').val(0);
        $('#s_fltcrownfromheightper').val(0);
        $('#s_fltcrowntoheightper').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removecrownfromangel', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltcrownfromangel').val(0);
        $('#fltcrowntoangel').val(0);
        $('#s_fltcrownfromangel').val(0);
        $('#s_fltcrowntoangel').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removefromtoratio', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltfromratio').val(0);
        $('#flttoratio').val(0);
        $('#s_fltfromratio').val(0);
        $('#s_flttoratio').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removepavilionfromdepthper', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltpavilionfromdepthper').val(0);
        $('#fltpaviliontodepthper').val(0);
        $('#s_fltpavilionfromdepthper').val(0);
        $('#s_fltpaviliontodepthper').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removepavilionfromangle', function() {
        var type = $(this).attr('data-type');
        $(this).remove();
        $('#fltpavilionfromangle').val(0);
        $('#fltpaviliontoangle').val(0);
        $('#s_fltpavilionfromangle').val(0);
        $('#s_fltpaviliontoangle').val(0);
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    $('body').on('click', '.removegridleflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltgridle' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltgridlearr, id);
        fltgridleidarr.splice($.inArray(id, fltgridleidarr), 1);
        $("#s_fltgridleid").val(fltgridleidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removeculetsizeflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltculetsize' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltculetsizearr, id);
        fltculetsizeidarr.splice($.inArray(id, fltculetsizeidarr), 1);
        $("#s_fltculetsizeid").val(fltculetsizeidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });
    $('body').on('click', '.removeculetconditionflt', function() {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.fltculetcondition' + id + '').remove();
        $('#f' + id + '').prop('checked', false);
        var arrid = removeindexfromarr(fltculetconditionarr, id);
        fltculetconditionidarr.splice($.inArray(id, fltculetconditionidarr), 1);
        $("#s_fltculetconditionid").val(fltculetconditionidarr).trigger('change');
        $('#listdiamondDatatbl').attr('data-nextpage', 0);
        listdiamonddata(1, 'form-diamond-side-search');
    });

    /* CHECK SIDE BAR FILTERS */

    function checksidediamondformelementvalue() {
        var issearchbtn = 0;
        $('#form-diamond-side-search input[type=checkbox]').each(function() {
            if (this.checked) {
                issearchbtn++;
                return false;
            }
        });
        var fltfromsize = $('#form-diamond-side-search #s_fltfromsize').val();
        var flttosize = $('#form-diamond-side-search #s_flttosize').val();
        if (fltfromsize > 0 && flttosize > 0) {
            issearchbtn++;
        }
        // console.log('size'+issearchbtn);

        var flteyecleanid = $('#form-diamond-side-search #s_flteyecleanid').val();
        if (flteyecleanid.length > 0) {
            issearchbtn++;
        }
        var s_fltshapeid = $('#form-diamond-side-search #s_fltshapeid').val();
        if (s_fltshapeid.length > 0) {
            issearchbtn++;
        }
        var s_fltcolorid = $('#form-diamond-side-search #s_fltcolorid').val();
        if (s_fltcolorid.length > 0) {
            issearchbtn++;
        }
        var s_fltclarityid = $('#form-diamond-side-search #s_fltclarityid').val();
        if (s_fltclarityid.length > 0) {
            issearchbtn++;
        }

        var s_flttreatment = $('#form-diamond-side-search #s_flttreatment').val();
        if (s_flttreatment.length > 0) {
            issearchbtn++;
        }
        var s_fltbrand = $('#form-diamond-side-search #s_fltbrand').val();
        if (s_fltbrand.length > 0) {
            issearchbtn++;
        }
      /*   var s_fltbrand = $('#form-diamond-side-search #s_fltbrand').val();
        if (s_fltbrand.length > 0) {
            issearchbtn++;
        } */

        /* var fltmilkyid = $('#form-diamond-side-search #s_fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            issearchbtn++;
        } */

        var fltfrommilkyid = $('#form-diamond-side-search #s_fltfrommilkyid').val();
        var flttomilkyid = $('#form-diamond-side-search #s_flttomilkyid').val();
        if (flttomilkyid !='' && fltfrommilkyid !='') {
            issearchbtn++;
        }

        var fltopeninclusionid = $('#form-diamond-side-search #s_fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            issearchbtn++;
        }

        var fltwhiteinclusionid = $('#form-diamond-side-search #s_fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            issearchbtn++;
        }
        var fltblackinclusionid = $('#form-diamond-side-search #s_fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            issearchbtn++;
        }

        var fltshadeid = $('#form-diamond-side-search #s_fltshadeid').val();
        if (fltshadeid.length > 0) {
            issearchbtn++;
        }
        /* var fltcutid = $('#form-diamond-side-search #s_fltcutid').val();
        if (fltcutid.length > 0) {
            issearchbtn++;
        } */
        var fltfromcutid = $('#form-diamond-side-search #s_fltfromcutid').val();
        var flttocutid = $('#form-diamond-side-search #s_flttocutid').val();
        if (flttocutid !='' && fltfromcutid !='') {
            issearchbtn++;
        }


        /* var fltpolishid = $('#form-diamond-side-search #s_fltpolishid').val();
        if (fltpolishid.length > 0) {
            issearchbtn++;
        } */
        var fltfrompolishid = $('#form-diamond-side-search #s_fltfrompolishid').val();
        var flttopolishid = $('#form-diamond-side-search #s_flttopolishid').val();
        if (flttopolishid !='' && fltfrompolishid !='') {
            issearchbtn++;
        }

        /* var fltsymmetryid = $('#form-diamond-side-search #s_fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            issearchbtn++;
        } */
        var fltfromsymmetryid = $('#form-diamond-side-search #s_fltfromsymmetryid').val();
        var flttosymmetryid = $('#form-diamond-side-search #s_flttosymmetryid').val();
        if (flttosymmetryid !='' && fltfromsymmetryid !='') {
            issearchbtn++;
        }

        var fltintensityid = $('#form-diamond-side-search #s_fltintensityid').val();
        if (fltintensityid.length > 0) {
            issearchbtn++;
        }
        var fltfluorescencecolorid = $('#form-diamond-side-search #s_fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            issearchbtn++;
        }
        var fltkeytosymbolsid = $('#form-diamond-side-search #s_fltkeytosymbols').val();
        if (fltkeytosymbolsid.length > 0) {
            issearchbtn++;
        }


        var fltlocationid = $('#form-diamond-side-search #s_fltlocationid').val();
        if (fltlocationid.length > 0) {
            issearchbtn++;
        }
        var fltroughsourceid = $('#form-diamond-side-search #s_fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            issearchbtn++;
        }

        var fltcompanycode = $('#form-diamond-side-search #s_fltcompanycode').val();
        if (fltcompanycode) {
            issearchbtn++;
        }
        var fltstocknumbers = $('#form-diamond-side-search #s_fltstocknumbers').val();
        if (fltstocknumbers) {
            issearchbtn++;
        }
        var fltsavanilotnumber = $('#form-diamond-side-search #s_fltlotnumbers').val();
        if (fltsavanilotnumber) {
            issearchbtn++;
        }
        // var fltlotnumbers = $('#form-diamond-side-search #s_fltlotnumbers').val();
        // if (fltlotnumbers) {
        //     issearchbtn++;
        // }

        var fltfromprice = $('#form-diamond-side-search #s_fltfromprice').val();
        var flttoprice = $('#form-diamond-side-search #s_flttoprice').val();
        if (fltfromprice > 0 && flttoprice > 0) {
            issearchbtn++;
        }

        var fltfromsavanipercentage = $('#form-diamond-side-search #s_fltfromsavanipercentage').val();
        var flttosavanipercentage = $('#form-diamond-side-search #s_flttosavanipercentage').val();
        if (fltfromsavanipercentage > 0 && flttosavanipercentage > 0) {
            issearchbtn++;
        }

        var fltfromdepthper = $('#form-diamond-side-search #s_fltfromdepthper').val();
        var flttodepthper = $('#form-diamond-side-search #s_flttodepthper').val();
        if (fltfromdepthper > 0 && flttodepthper > 0) {
            issearchbtn++;
        }

        var fltfromtableper = $('#form-diamond-side-search #s_fltfromtableper').val();
        var flttotableper = $('#form-diamond-side-search #s_flttotableper').val();
        if (fltfromtableper > 0 && flttotableper > 0) {
            issearchbtn++;
        }

        var fltfromlength = $('#form-diamond-side-search #s_fltfromlength').val();
        var flttolength = $('#form-diamond-side-search #s_flttolength').val();
        if (fltfromlength > 0 && flttolength > 0) {
            issearchbtn++;
        }

        var fltfromwidth = $('#form-diamond-side-search #s_fltfromwidth').val();
        var flttowidth = $('#form-diamond-side-search #s_flttowidth').val();
        if (fltfromwidth > 0 && flttowidth > 0) {
            issearchbtn++;
        }

        var fltfromdepth = $('#form-diamond-side-search #s_fltfromdepth').val();
        var flttodepth = $('#form-diamond-side-search #s_flttodepth').val();
        if (fltfromdepth > 0 && flttodepth > 0) {
            issearchbtn++;
        }
        var fltlabreportnumber = $('#form-diamond-side-search #s_fltlabreportnumber').val();
        if (fltlabreportnumber) {
            issearchbtn++;
        }

        /* var fltintensity = $('#form-diamond-side-search #s_fltintensity').val();
        if (fltintensity.length > 0) {
            issearchbtn++;
        } */

        var fltfromintensity = $('#form-diamond-side-search #s_fltfromintensity').val();
        var flttointensity = $('#form-diamond-side-search #s_flttointensity').val();
        if (flttointensity !='' && fltfromintensity !='') {
            issearchbtn++;
        }

        var fltovertone = $('#form-diamond-side-search #s_fltovertone').val();
        if (fltovertone.length > 0) {
            issearchbtn++;
        }
        var fltcolor = $('#form-diamond-side-search #s_fltcolor').val();
        if (fltcolor.length > 0) {
            issearchbtn++;
        }

        var fltcrownfromheightper = $('#form-diamond-side-search #s_fltcrownfromheightper').val();
        var fltcrowntoheightper = $('#form-diamond-side-search #s_fltcrowntoheightper').val();
        if (fltcrownfromheightper > 0 && fltcrowntoheightper > 0) {
            issearchbtn++;
        }

        var fltcrownfromangel = $('#form-diamond-side-search #s_fltcrownfromangel').val();
        var fltcrowntoangel = $('#form-diamond-side-search #s_fltcrowntoangel').val();
        if (fltcrownfromangel > 0 && fltcrowntoangel > 0) {
            issearchbtn++;
        }

        var fltpavilionfromdepthper = $('#form-diamond-side-search #s_fltpavilionfromdepthper').val();
        var fltpaviliontodepthper = $('#form-diamond-side-search #s_fltpaviliontodepthper').val();
        if (fltpavilionfromdepthper > 0 && fltpaviliontodepthper > 0) {
            issearchbtn++;
        }

        var fltpavilionfromangle = $('#form-diamond-side-search #s_fltpavilionfromangle').val();
        var fltpaviliontoangle = $('#form-diamond-side-search #s_fltpaviliontoangle').val();
        if (fltpavilionfromangle > 0 && fltpaviliontoangle > 0) {
            issearchbtn++;
        }

        var fltgridleid = $('#form-diamond-side-search #s_fltgridleid').val();
        if (fltgridleid.length > 0) {
            issearchbtn++;
        }
        var fltculetsizeid = $('#form-diamond-side-search #s_fltculetsizeid').val();
        if (fltculetsizeid.length > 0) {
            issearchbtn++;
        }
        var fltculetconditionid = $('#form-diamond-side-search #s_fltculetconditionid').val();
        if(fltculetconditionid)
        {
            if (fltculetconditionid.length > 0) {
                issearchbtn++;
            }
        }
        var fltfromratio = $('#form-diamond-side-search #s_fltfromratio').val();
        var flttoratio = $('#form-diamond-side-search #s_flttoratio').val();
        if (fltfromratio && flttoratio > 0) {
            issearchbtn++;
        }
        $('#form-diamond-side-search #btnapplydiamondfilter').attr('disabled', true);
        if (issearchbtn > 0) {
            $('#form-diamond-side-search #btnapplydiamondfilter').attr('disabled', false);
        }
        // console.log(issearchbtn);
        return issearchbtn;

    }

    /* GET SIDEBAR FILTERS */
    function getsidebarelementvalue() {
        shapearr = [];
        shapeidarr = [];
        var fltshapeid = $('#s_fltshapeid').val();
        if (fltshapeid.length > 0) {
            for (var i = 0; i < fltshapeid.length; i++) {
                var shapeid = $('#s_fltshapeid option[value=' + fltshapeid[i] + ']').val();
                var shape = $('#s_fltshapeid option[value=' + fltshapeid[i] + ']').text();
                shapearr.push({
                    'id': shapeid,
                    'name': shape
                });
                shapeidarr.push(shapeid);
            }
        }

        fltfromsize = $('#s_fltfromsize').val();
        flttosize = $('#s_flttosize').val();

        sizearr = [];
        $('#s_sizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                sizearr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        colorarr = [];
        coloridarr = [];
        var fltcolorid = $('#s_fltcolorid').val();
        if (fltcolorid.length > 0) {
            for (var i = 0; i < fltcolorid.length; i++) {
                var colorid = $('#s_fltcolorid option[value=' + fltcolorid[i] + ']').val();
                var color = $('#s_fltcolorid option[value=' + fltcolorid[i] + ']').text();
                colorarr.push({
                    'id': colorid,
                    'name': color
                });
                coloridarr.push(colorid);
            }
        }

        clarityarr = [];
        clarityidarr = [];
        var fltclarityid = $('#s_fltclarityid').val();
        if (fltclarityid.length > 0) {
            for (var i = 0; i < fltclarityid.length; i++) {
                var clarityid = $('#s_fltclarityid option[value=' + fltclarityid[i] + ']').val();
                var clarity = $('#s_fltclarityid option[value=' + fltclarityid[i] + ']').text();
                clarityarr.push({
                    'id': clarityid,
                    'name': clarity
                });
                clarityidarr.push(clarityid);
            }
        }

        flteyecleanarr = [];
        flteyecleanidarr = [];
        var flteyecleanid = $('#s_flteyecleanid').val();
        if (flteyecleanid.length > 0) {
            for (var i = 0; i < flteyecleanid.length; i++) {
                var eyecleanid = $('#s_flteyecleanid option[value=' + flteyecleanid[i] + ']').val();
                var eyeclean = $('#s_flteyecleanid option[value=' + flteyecleanid[i] + ']').text();
                flteyecleanarr.push({
                    'id': eyecleanid,
                    'name': eyeclean
                });
                flteyecleanidarr.push(eyecleanid);
            }
        }

       /*  fltmilkyarr = [];
        fltmilkyidarr = [];
        var fltmilkyid = $('#s_fltmilkyid').val();
        if (fltmilkyid.length > 0) {
            for (var i = 0; i < fltmilkyid.length; i++) {
                var milkyid = $('#s_fltmilkyid option[value=' + fltmilkyid[i] + ']').val();
                var milky = $('#s_fltmilkyid option[value=' + fltmilkyid[i] + ']').text();
                fltmilkyarr.push({
                    'id': milkyid,
                    'name': milky
                });
                fltmilkyidarr.push(milkyid);
            }
        } */

        fltfrommilkyarr = [];
        flttomilkyarr = [];

        fltfrommilkyidarr = [];
        flttomilkyidarr = [];

        var fltfrommilkyid = $('#s_fltfrommilkyid :selected').val();
        var fltfrommilkyidname = $('#s_fltfrommilkyid option:selected').text();

        var flttomilkyid = $('#s_flttomilkyid :selected').val();
        var flttomilkyidname = $('#s_flttomilkyid option:selected').text();

        if (fltfrommilkyid!='' && flttomilkyid!='') {
            fltfrommilkyarr.push({
                'id': fltfrommilkyid,
                'name': fltfrommilkyidname
            });
            fltfrommilkyidarr.push(fltfrommilkyid);

            flttomilkyarr.push({
                'id': flttomilkyid,
                'name': flttomilkyidname
            });
            flttomilkyidarr.push(flttomilkyid);
           
        }

        fltblackinclusionarr = [];
        fltblackinclusionidarr = [];
        var fltblackinclusionid = $('#s_fltblackinclusionid').val();
        if (fltblackinclusionid.length > 0) {
            for (var i = 0; i < fltblackinclusionid.length; i++) {
                var blackinclusionid = $('#s_fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').val();
                var blackinclusion = $('#s_fltblackinclusionid option[value=' + fltblackinclusionid[i] + ']').text();
                fltblackinclusionarr.push({
                    'id': blackinclusionid,
                    'name': blackinclusion
                });
                fltblackinclusionidarr.push(blackinclusionid);
            }
        }

        fltwhiteinclusionarr = [];
        fltwhiteinclusionidarr = [];
        var fltwhiteinclusionid = $('#s_fltwhiteinclusionid').val();
        if (fltwhiteinclusionid.length > 0) {
            for (var i = 0; i < fltwhiteinclusionid.length; i++) {
                var whiteinclusionid = $('#s_fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').val();
                var whiteinclusion = $('#s_fltwhiteinclusionid option[value=' + fltwhiteinclusionid[i] + ']').text();
                fltwhiteinclusionarr.push({
                    'id': whiteinclusionid,
                    'name': whiteinclusion
                });
                fltwhiteinclusionidarr.push(whiteinclusionid);
            }
        }

        fltopeninclusionarr = [];
        fltopeninclusionidarr = [];

        var fltopeninclusionid = $('#s_fltopeninclusionid').val();
        if (fltopeninclusionid.length > 0) {
            for (var i = 0; i < fltopeninclusionid.length; i++) {
                var openinclusionid = $('#s_fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').val();
                var openinclusion = $('#s_fltopeninclusionid option[value=' + fltopeninclusionid[i] + ']').text();
                fltopeninclusionarr.push({
                    'id': openinclusionid,
                    'name': openinclusion
                });
                fltopeninclusionidarr.push(openinclusionid);
            }
        }

        fltshadearr = [];
        fltshadeidarr = [];

        var fltshadeid = $('#s_fltshadeid').val();
        if (fltshadeid.length > 0) {
            for (var i = 0; i < fltshadeid.length; i++) {
                var shadeid = $('#s_fltshadeid option[value=' + fltshadeid[i] + ']').val();
                var shade = $('#s_fltshadeid option[value=' + fltshadeid[i] + ']').text();
                fltshadearr.push({
                    'id': shadeid,
                    'name': shade
                });
                fltshadeidarr.push(shadeid);
            }
        }

        /* fltcutarr = [];
        fltcutidarr = [];

        var fltcutid = $('#s_fltcutid').val();
        if (fltcutid.length > 0) {
            for (var i = 0; i < fltcutid.length; i++) {
                var cutid = $('#s_fltcutid option[value=' + fltcutid[i] + ']').val();
                var cut = $('#s_fltcutid option[value=' + fltcutid[i] + ']').text();
                fltcutarr.push({
                    'id': cutid,
                    'name': cut
                });
                fltcutidarr.push(cutid);
            }
        } */

        fltfromcutarr = [];
        flttocutarr = [];

        fltfromcutidarr = [];
        flttocutidarr = [];

        var fltfromcutid = $('#s_fltfromcutid :selected').val();
        var fltfromcutidname = $('#s_fltfromcutid option:selected').text();

        var flttocutid = $('#s_flttocutid :selected').val();
        var flttocutidname = $('#s_flttocutid option:selected').text();

        if (fltfromcutid!='' && flttocutid!='') {
            fltfromcutarr.push({
                'id': fltfromcutid,
                'name': fltfromcutidname
            });
            fltfromcutidarr.push(fltfromcutid);

            flttocutarr.push({
                'id': flttocutid,
                'name': flttocutidname
            });
            flttocutidarr.push(flttocutid);
           
        }

        

        /* Fancy Color filter start */
       
        // fltintensityarr = [];
        // fltintensityidarr = [];
        // var fltintensity = $('#s_fltintensity').val();
        // if (fltintensity.length > 0) {
        //     for (var i = 0; i < fltintensity.length; i++) {
        //         var intensityid = $('#s_fltintensity option[value=' + fltintensity[i] + ']').val();
        //         var intensity = $('#s_fltintensity option[value=' + fltintensity[i] + ']').text();
        //         fltintensityarr.push({
        //             'id': intensityid,
        //             'name': intensity
        //         });
        //         fltintensityidarr.push(intensityid);
        //     }
        // }

        fltfromintensityarr = [];
        flttointensityarr = [];

        fltfromintensityidarr = [];
        flttointensityidarr = [];

        var fltfromintensity = $('#s_fltfromintensity :selected').val();
        var fltfromintensityname = $('#s_fltfromintensity option:selected').text();

        var flttointensity = $('#s_flttointensity :selected').val();
        var flttointensityname = $('#s_flttointensity option:selected').text();

        if (fltfromintensity!='' && flttointensity!='') {
            fltfromintensityarr.push({
                'id': fltfromintensity,
                'name': fltfromintensityname
            });
            fltfromintensityidarr.push(fltfromintensity);

            flttointensityarr.push({
                'id': flttointensity,
                'name': flttointensityname
            });
            flttointensityidarr.push(flttointensity);
           
        }

        fltovertonearr = [];
        fltovertoneidarr = [];
        var fltovertone = $('#s_fltovertone').val();
        if (fltovertone.length > 0) {
            for (var i = 0; i < fltovertone.length; i++) {
                var overtoneid = $('#s_fltovertone option[value=' + fltovertone[i] + ']').val();
                var overtone = $('#s_fltovertone option[value=' + fltovertone[i] + ']').text();
                fltovertonearr.push({
                    'id': overtoneid,
                    'name': overtone
                });
                fltovertoneidarr.push(overtoneid);
            }
        }

        fltcolorarr = [];
        fltcoloridarr = [];
        var fltcolor = $('#s_fltcolor').val();
        if (fltcolor.length > 0) {
            for (var i = 0; i < fltcolor.length; i++) {
                var colorid = $('#s_fltcolor option[value=' + fltcolor[i] + ']').val();
                var color = $('#s_fltcolor option[value=' + fltcolor[i] + ']').text();
                fltcolorarr.push({
                    'id': colorid,
                    'name': color
                });
                fltcoloridarr.push(colorid);
            }
        }
        /* Fancy Color filter end */

        /* fltpolisharr = [];
        fltpolishidarr = [];

        var fltpolishid = $('#s_fltpolishid').val();
        if (fltpolishid.length > 0) {
            for (var i = 0; i < fltpolishid.length; i++) {
                var polishid = $('#s_fltpolishid option[value=' + fltpolishid[i] + ']').val();
                var polish = $('#s_fltpolishid option[value=' + fltpolishid[i] + ']').text();
                fltpolisharr.push({
                    'id': polishid,
                    'name': polish
                });
                fltpolishidarr.push(polishid);
            }
        } */

        fltfrompolisharr = [];
        flttopolisharr = [];

        fltfrompolishidarr = [];
        flttopolishidarr = [];

        var fltfrompolishid = $('#s_fltfrompolishid :selected').val();
        var fltfrompolishidname = $('#s_fltfrompolishid option:selected').text();

        var flttopolishid = $('#s_flttopolishid :selected').val();
        var flttopolishidname = $('#s_flttopolishid option:selected').text();

        if (fltfrompolishid!='' && flttopolishid!='') {
            fltfrompolisharr.push({
                'id': fltfrompolishid,
                'name': fltfrompolishidname
            });
            fltfrompolishidarr.push(fltfrompolishid);

            flttopolisharr.push({
                'id': flttopolishid,
                'name': flttopolishidname
            });
            flttopolishidarr.push(flttopolishid);
           
        }

        /* fltsymmetryarr = [];
        fltsymmetryidarr = [];

        var fltsymmetryid = $('#s_fltsymmetryid').val();
        if (fltsymmetryid.length > 0) {
            for (var i = 0; i < fltsymmetryid.length; i++) {
                var symmetryid = $('#s_fltsymmetryid option[value=' + fltsymmetryid[i] + ']').val();
                var symmetry = $('#s_fltsymmetryid option[value=' + fltsymmetryid[i] + ']').text();
                fltsymmetryarr.push({
                    'id': symmetryid,
                    'name': symmetry
                });
                fltsymmetryidarr.push(symmetryid);
            }
        } */
        fltfromsymmetryarr = [];
        flttosymmetryarr = [];

        fltfromsymmetryidarr = [];
        flttosymmetryidarr = [];

        var fltfromsymmetryid = $('#s_fltfromsymmetryid :selected').val();
        var fltfromsymmetryidname = $('#s_fltfromsymmetryid option:selected').text();

        var flttosymmetryid = $('#s_flttosymmetryid :selected').val();
        var flttosymmetryidname = $('#s_flttosymmetryid option:selected').text();

        if (fltfromsymmetryid!='' && flttosymmetryid!='') {
            fltfromsymmetryarr.push({
                'id': fltfromsymmetryid,
                'name': fltfromsymmetryidname
            });
            fltfromsymmetryidarr.push(fltfromsymmetryid);

            flttosymmetryarr.push({
                'id': flttosymmetryid,
                'name': flttosymmetryidname
            });
            flttosymmetryidarr.push(flttosymmetryid);
           
        }


        intensityarr = [];
        intensityidarr = [];

        var fltintensityid = $('#s_fltintensityid').val();
        if (fltintensityid.length > 0) {
            for (var i = 0; i < fltintensityid.length; i++) {
                var intensityid = $('#s_fltintensityid option[value=' + fltintensityid[i] + ']').val();
                var intensity = $('#s_fltintensityid option[value=' + fltintensityid[i] + ']').text();
                intensityarr.push({
                    'id': intensityid,
                    'name': intensity
                });
                intensityidarr.push(intensityid);
            }
        }

        fltfluorescencecolorarr = [];
        fltfluorescencecoloridarr = [];

        var fltfluorescencecolorid = $('#s_fltfluorescencecolorid').val();
        if (fltfluorescencecolorid.length > 0) {
            for (var i = 0; i < fltfluorescencecolorid.length; i++) {
                var fluorescencecolorid = $('#s_fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').val();
                var fluorescencecolor = $('#s_fltfluorescencecolorid option[value=' + fltfluorescencecolorid[i] + ']').text();
                fltfluorescencecolorarr.push({
                    'id': fluorescencecolorid,
                    'name': fluorescencecolor
                });
                fltfluorescencecoloridarr.push(fluorescencecolorid);
            }
        }

        labarr = [];
        $('#s_labDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                labarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        ssizearr = [];
        $('#s_ssizeDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                ssizearr.push({
                    'id': $(this).data('mainid'),
                    'name': $(this).attr('data-name')
                });
            }
        });

        // console.log(ssizearr);
        fltlocationarr = [];
        fltlocationidarr = [];

        var fltlocationid = $('#s_fltlocationid').val();
        if (fltlocationid.length > 0) {
            for (var i = 0; i < fltlocationid.length; i++) {
                var locationid = $('#s_fltlocationid option[value=' + fltlocationid[i] + ']').val();
                var location = $('#s_fltlocationid option[value=' + fltlocationid[i] + ']').text();
                fltlocationarr.push({
                    'id': locationid,
                    'name': location
                });
                fltlocationidarr.push(locationid);
            }
        }

        fltroughsourcearr = [];
        fltroughsourceidarr = [];

        var fltroughsourceid = $('#s_fltroughsourceid').val();
        if (fltroughsourceid.length > 0) {
            for (var i = 0; i < fltroughsourceid.length; i++) {
                var roughsourceid = $('#s_fltroughsourceid option[value=' + fltroughsourceid[i] + ']').val();
                var roughsource = $('#s_fltroughsourceid option[value=' + fltroughsourceid[i] + ']').text();
                fltroughsourcearr.push({
                    'id': roughsourceid,
                    'name': roughsource
                });
                fltroughsourceidarr.push(roughsourceid);
            }
        }


        mediaarr = [];
        $('#s_mediaDivData input[type=checkbox]').each(function() {
            if (this.checked) {
                mediaarr.push({
                    'id': $(this).val(),
                    'name': $(this).attr('data-name')
                });
            }
        });

        treatmentarr = [];
        treatmentidarr = [];

        var flttreatmentid = $('#s_flttreatment').val();
        if (flttreatmentid.length > 0) {
            for (var i = 0; i < flttreatmentid.length; i++) {
                var treatmentid = $('#s_flttreatment option[value=' + flttreatmentid[i] + ']').val();
                var treatment = $('#s_flttreatment option[value=' + flttreatmentid[i] + ']').text();
                treatmentarr.push({
                    'id': treatmentid,
                    'name': treatment
                });
                treatmentidarr.push(treatmentid);
            }
        }

        keytosymbolarr = [];
        keytosymbolidarr = [];

        var fltkeytosymbolsid = $('#s_fltkeytosymbols').val();
        if (fltkeytosymbolsid.length > 0) {
            for (var i = 0; i < fltkeytosymbolsid.length; i++) {
                var keytosymbolsid = $('#s_fltkeytosymbols option[value=' + fltkeytosymbolsid[i] + ']').val();
                var keytosymbols = $('#s_fltkeytosymbols option[value=' + fltkeytosymbolsid[i] + ']').text();
                keytosymbolarr.push({
                    'id': keytosymbolsid,
                    'name': keytosymbols
                });
                keytosymbolidarr.push(keytosymbolsid);
            }
        }

        brandarr = [];
        brandidarr = [];

        var fltbrandid = $('#s_fltbrand').val();
        if (fltbrandid.length > 0) {
            for (var i = 0; i < fltbrandid.length; i++) {
                var brandid = $('#s_fltbrand option[value=' + fltbrandid[i] + ']').val();
                var brand = $('#s_fltbrand option[value=' + fltbrandid[i] + ']').text();
                brandarr.push({
                    'id': brandid,
                    'name': brand
                });
                brandidarr.push(brandid);
            }
        }

        fltcompanycodearr = [];
        var fltcompanycode = $('#s_fltcompanycode').val();
        var fltcompanycodename = $('#s_fltcompanycode option:selected').text();
        if (fltcompanycode) {
            fltcompanycodearr.push({
                'id': fltcompanycode,
                'name': fltcompanycodename
            });
        }
        // //console.log(fltcompanycodearr);

        fltstocknumbersarr = [];
        var fltstocknumbers = $('#s_fltstocknumbers').val();
        var fltstocknumbersname = $('#s_fltstocknumbers option:selected').text();
        if (fltstocknumbers) {
            fltstocknumbersarr.push({
                'id': fltstocknumbers,
                'name': fltstocknumbersname
            });
        }
        // //console.log(fltstocknumbersarr);

        fltsavanilotnumberarr = [];
        var fltsavanilotnumber = $('#s_fltlotnumbers').val();
        var fltsavanilotnumbername = $('#s_fltlotnumbers option:selected').text();
        if (fltsavanilotnumber) {
            fltsavanilotnumberarr.push({
                'id': fltsavanilotnumber,
                'name': fltsavanilotnumbername
            });
        }
        // //console.log(fltsavanilotnumberarr);

        fltfromprice = $('#s_fltfromprice').val();
        flttoprice = $('#s_flttoprice').val();

        fltfromsavanipercentage = $('#s_fltfromsavanipercentage').val();
        flttosavanipercentage = $('#s_flttosavanipercentage').val();

        fltfromdepthper = $('#s_fltfromdepthper').val();
        flttodepthper = $('#s_flttodepthper').val();
        fltfromtableper = $('#s_fltfromtableper').val();
        flttotableper = $('#s_flttotableper').val();
        fltfromlength = $('#s_fltfromlength').val();
        flttolength = $('#s_flttolength').val();
        fltfromwidth = $('#s_fltfromwidth').val();
        flttowidth = $('#s_flttowidth').val();
        fltfromdepth = $('#s_fltfromdepth').val();
        flttodepth = $('#s_flttodepth').val();
        fltlabreportnumber = $('#s_fltlabreportnumber').val();

        fltcrownfromheightper = $('#s_fltcrownfromheightper').val();
        fltcrowntoheightper = $('#s_fltcrowntoheightper').val();

        fltcrownfromangel = $('#s_fltcrownfromangel').val();
        fltcrowntoangel = $('#s_fltcrowntoangel').val();

        fltpavilionfromdepthper = $('#s_fltpavilionfromdepthper').val();
        fltpaviliontodepthper = $('#s_fltpaviliontodepthper').val();

        fltpavilionfromangle = $('#s_fltpavilionfromangle').val();
        fltpaviliontoangle = $('#s_fltpaviliontoangle').val();

        fltgridlearr = [];
        fltgridleidarr = [];
        var fltgridleid = $('#s_fltgridleid').val();
        if (fltgridleid.length > 0) {
            for (var i = 0; i < fltgridleid.length; i++) {
                var gridleid = $('#s_fltgridleid option[value=' + fltgridleid[i] + ']').val();
                var gridle = $('#s_fltgridleid option[value=' + fltgridleid[i] + ']').text();
                fltgridlearr.push({
                    'id': gridleid,
                    'name': gridle
                });
                fltgridleidarr.push(gridleid);
            }
        }

        fltculetsizearr = [];
        fltculetsizeidarr = [];
        var fltculetsizeid = $('#s_fltculetsizeid').val();
        if(fltculetsizeid)
        {
            if (fltculetsizeid.length > 0) {
                for (var i = 0; i < fltculetsizeid.length; i++) {
                    var culetsizeid = $('#s_fltculetsizeid option[value=' + fltculetsizeid[i] + ']').val();
                    var culetsize = $('#s_fltculetsizeid option[value=' + fltculetsizeid[i] + ']').text();
                    fltculetsizearr.push({
                        'id': culetsizeid,
                        'name': culetsize
                    });
                    fltculetsizeidarr.push(culetsizeid);
                }
            }
        }
        fltculetconditionarr = [];
        fltculetconditionidarr = [];
        var fltculetconditionid = $('#s_fltculetconditionid').val();
        if(fltculetconditionid)
        {
            if (fltculetconditionid.length > 0) {
                for (var i = 0; i < fltculetconditionid.length; i++) {
                    var culetconditionid = $('#s_fltculetconditionid option[value=' + fltculetconditionid[i] + ']').val();
                    var culetcondition = $('#s_fltculetconditionid option[value=' + fltculetconditionid[i] + ']').text();
                    fltculetconditionarr.push({
                        'id': culetconditionid,
                        'name': culetcondition
                    });
                    fltculetconditionidarr.push(culetconditionid);
                }
            }
        }

        fltfromratio = $('#s_fltfromratio').val();
        flttoratio = $('#s_flttoratio').val();
    }

    /* APPLY SIDE BAR FILTERS */
    $('body').on('change', '#form-diamond-side-search input[type=checkbox]', function() {
        // if ($('#s_nobgm').is(":checked")) {
        //     listshade();
        // }
        getsidebarelementvalue();
        checksidediamondformelementvalue();

    });

    $('body').on('input', '#form-diamond-side-search #s_fltfromsize,#s_flttosize,#s_fltfromprice,#s_flttoprice,#s_fltfromsavanipercentage,#s_flttosavanipercentage,#s_fltfromdepthper,#s_flttodepthper,#s_fltfromtableper,#s_flttotableper,#s_fltfromlength,#s_flttolength,#s_fltfromwidth,#s_flttowidth,#s_fltfromdepth,#s_flttodepth,#s_fltlabreportnumber,#s_fltcrownfromheightper,#s_fltcrowntoheightper,#s_fltcrownfromangel,#s_fltcrowntoangel,#s_fltcrowntoangel,#s_fltpavilionfromdepthper,#s_fltpaviliontodepthper,#s_fltpavilionfromangle,#s_fltpaviliontoangle,#s_fltfromratio,#s_flttoratio', function() {
        getsidebarelementvalue();
        checksidediamondformelementvalue();
    });



    $('body').on('change', '#form-diamond-side-search .select2', function() {
        getsidebarelementvalue();
        checksidediamondformelementvalue();
    });


    $('body').on('change', '#form-diamond-side-search #s_fltcompanycode,#s_fltstocknumbers,#s_fltlotnumbers', function() {
        getsidebarelementvalue();
        checksidediamondformelementvalue();
    });

    if ($('#form-diamond-side-search').length) {
        $('#form-diamond-side-search').validate({
            rules: {
                fltfromsize: {
                    number: true
                },
                flttosize: {
                    greaterThan: '#s_fltfromsize',
                    number: true
                },
                fltfromprice: {
                    number: true
                },
                flttoprice: {
                    greaterThan: '#s_fltfromprice',
                    number: true
                },

                fltfromsavanipercentage: {
                    number: true,
                    maxlength:3
                },
                flttosavanipercentage: {
                    greaterThan: '#s_fltfromsavanipercentage',
                    number: true,
                    maxlength:3
                },
                
                fltfromdepthper: {
                    number: true
                },
                flttodepthper: {
                    greaterThan: '#s_fltfromdepthper',
                    number: true
                },
                fltfromtableper: {
                    number: true
                },
                flttotableper: {
                    greaterThan: '#s_fltfromtableper',
                    number: true
                },
                fltfromlength: {
                    number: true
                },
                flttolength: {
                    greaterThan: '#s_fltfromlength',
                    number: true
                },
                fltfromwidth: {
                    number: true
                },
                flttowidth: {
                    greaterThan: '#s_fltfromwidth',
                    number: true
                },
                fltfromdepth: {
                    number: true
                },
                flttodepth: {
                    greaterThan: '#s_fltfromdepth',
                    number: true
                },

                fltcrownfromheightper: {
                    number: true
                },
                fltcrowntoheightper: {
                    greaterThan: '#s_fltcrownfromheightper',
                    number: true
                },
                fltcrownfromangel: {
                    number: true
                },
                fltcrowntoangel: {
                    greaterThan: '#s_fltcrownfromangel',
                    number: true
                },

                fltpavilionfromdepthper: {
                    number: true
                },
                fltpaviliontodepthper: {
                    greaterThan: '#s_fltpavilionfromdepthper',
                    number: true
                },
                fltcrownfromangel: {
                    number: true
                },
                fltpaviliontoangle: {
                    greaterThan: '#s_fltcrownfromangel',
                    number: true
                },
                fltfromratio: {
                    number: true
                },
                flttoratio: {
                    greaterThan: '#s_fltfromratio',
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
                flttosavanipercentage: {
                    greaterThan: 'To percentage greater than or equal From percentage',
                },
                flttodepthper: {
                    greaterThan: 'To depth(%) greater than or equal From depth(%)',
                },
                flttotableper: {
                    greaterThan: 'To table(%) greater than or equal From table(%)',
                },
                flttolength: {
                    greaterThan: 'To length greater than or equal From length',
                },
                flttowidth: {
                    greaterThan: 'To width greater than or equal From width',
                },
                flttodepth: {
                    greaterThan: 'To depth greater than or equal From depth',
                },
                fltcrowntoheightper: {
                    greaterThan: 'To Height (%) greater than or equal From Height (%)',
                },
                fltcrowntoangel: {
                    greaterThan: 'To Angel greater than or equal From Angel',
                },
                fltpaviliontoangle: {
                    greaterThan: 'To Angel greater than or equal From Angel',
                },
                fltpaviliontodepthper: {
                    greaterThan: 'To Depth(%) greater than or equal From Depth(%)',
                },
                flttoratio: {
                    greaterThan: 'To ratio greater than or equal From ratio',
                },
            },
            submitHandler: function(form) {

                var issearchbtn = checksidediamondformelementvalue();
                if (issearchbtn > 0) {
                    fillsearchdiamondlist(2);
                    $('#listdiamondDatatbl').attr('data-nextpage', 0);
                    listdiamonddata(1, 'form-diamond-side-search');
                    $(".wrappernew.toggled").toggleClass("intro");
                } else {
                    alertify('Please select at least one filter', 0);
                }


            },
        });
    }
    
</script>