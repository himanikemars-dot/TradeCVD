<!-- diamond page modal -->
<div class="modal fade diamondpg bd-example-modal-lg " id="ListDiamondDataDetailModalLong" tabindex="-1" role="dialog"
    aria-labelledby="ListDiamondDataDetailModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ListDiamondDataDetailModalLongTitle"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ListDiamondDataDetail">

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
<!-- contect seller btn modal -->
<div class="modal fade contectsearch" id="contactdiamondseller" tabindex="-1" role="dialog"
    aria-labelledby="contactdiamondsellerLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" name="form-diamond-contact-seller" enctype="multipart/form-data"
                    id="form-diamond-contact-seller">
                    <input type="hidden" id="contactsellerdiamondid" name="contactsellerdiamondid">
                    <input type="hidden" id="contactsellerdiamondname" name="contactsellerdiamondname">
                    <input type="hidden" id="contactsellerdiamondsize" name="contactsellerdiamondsize">
                    <h3 class="modal-title text-center" id="contactdiamondsellerLabel">Contact Seller</h3>
                    <p class="text-center diamondnametext"></p>
                    <div class="form-group">
                        <label for="messagetext" class="col-form-label text-bold">Your Message<span class="text-danger price-requiredfield">*</span></label>
                        <textarea class="form-control fromusd bordershow textareasize" name="messagetext" id="messagetext" rows="4"></textarea>
                    </div>
                    <div class="col-12 col-md-12 p-0">
                        <div class="row">
                            <div class="col-12 col-md-4 cut-group formspace">
                            <label class="col-form-label text-bold">Your Offer</label>
                                <input type="text" id="offerprice" class="fromusd bordershow" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="offerprice" placeholder="">
                                <label class="inputset" type="number">$/ct</label>
                            </div>
                            <div class="col-12 col-md-4 mt-auto cut-group formspace">
                                <input type="text" id="savaniper_m" class="fromusd bordershow" onkeypress="minusnumbonly(event);" onpaste="minusnumbonly(event);" name="savaniper_m" placeholder="0.00">
                                <label class="inputset" type="number">Discount(%)</label>
                            </div>
                            <div class="col-12 col-md-4 mt-auto cut-group formspace">
                                <input type="text" id="totalprice_m" class="fromusd bordershow" onkeypress="numbonly(event);" onpaste="numbonly(event);" readonly name="totalprice_m" placeholder="0">
                                <label class="inputset" type="number">$</label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="offer-price" class="col-form-label">Your Offer</label>
                        <input type="text" class="form-control fromusd" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="offerprice" id="offerprice">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="offer-price" class="col-form-label">Chose a transaction Type...</label>
                        <select aria-labelledby="llocation" name="llocation" class="form-control">
                            <option value="0">Cod</option>
                            <option value="1">Card</option>
                            <option value="2">Fair</option>
                            <option value="3">Good</option>
                            <option value="4">Very Good</option>
                            <option value="5">Excellent</option>
                            <option value="6">Ideal</option>
                        </select>
                    </div> -->
                    <br class="d-none">
                    <br>
                    <p class="modelsetcontect">Your message will be delivered to the seller ,where you and the seller can securely finalize negotiations.</p>
                    <!-- <p>Note : Contact seller to your own diamonds will be ignored.</p> -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade contectsearch" id="contactjewelleryseller" tabindex="-1" role="dialog"
    aria-labelledby="contactjewellerysellerLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" name="form-jewellery-contact-seller" enctype="multipart/form-data"
                    id="form-jewellery-contact-seller">
                    <input type="hidden" id="contactsellerjewelleryid" name="contactsellerjewelleryid">
                    <input type="hidden" id="contactsellerjewelleryname" name="contactsellerjewelleryname">
                    <h3 class="modal-title text-center" id="contactjewellerysellerLabel">Contact Seller</h3>
                    <p class="text-center jewellerynametext"></p>
                    <div class="form-group">
                        <label for="jewellerymessagetext" class="col-form-label">Your Message:</label>
                       <!--  <textarea class="form-control  fromusd bordershow textareasize" name="jewellerymessagetext"
                            id="jewellerymessagetext"></textarea> -->
                            <textarea class="form-control fromusd bordershow textareasize" name="jewellerymessagetext" id="jewellerymessagetext" rows="4"></textarea>
                    </div>
                    <div class="col-12 col-md-12 p-0">
                        <div class="row">
                            <div class="col-12 col-md-12 cut-group">
                            <label class="col-form-label text-bold">Your Offer</label>
                                <input type="text" id="jewelleryofferprice" class="fromusd bordershow" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="jewelleryofferprice" placeholder="">
                                <label class="inputset" type="number">$/ct</label>
                            </div>
                            <!-- <div class="col-12 col-md-4 mt-auto cut-group">
                                <input type="text" id="savaniper_m" class="fromusd bordershow" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="savaniper_m" placeholder="0.00">
                                <label class="inputset" type="number">Savani(%)</label>
                            </div>
                            <div class="col-12 col-md-4 mt-auto cut-group">
                                <input type="text" id="totalprice_m" class="fromusd bordershow" onkeypress="numbonly(event);" onpaste="numbonly(event);" readonly name="totalprice_m" placeholder="0">
                                <label class="inputset" type="number">$</label>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="offer-price" class="col-form-label">Your Offer</label>
                        <input type="text" class="form-control fromusd" onkeypress="numbonly(event);"
                            onpaste="numbonly(event);" name="jewelleryofferprice" id="jewelleryofferprice">
                    </div> -->
                    <br>
                    <br>
                    <p class="modelsetcontect">Your message will be delivered to the seller, where you and the seller can securely finalize negotiations.</p>
                    <!-- <p>Note : Contact seller to your own diamonds will be ignored.</p> -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- buy request btn modal -->
<div class="modal fade contectsearch" id="buyrequestrespondModal" tabindex="-1" role="dialog"
    aria-labelledby="buyrequestrespondLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" name="form-buyrequestrespond" enctype="multipart/form-data"
                    id="form-buyrequestrespond">
                    <input type="hidden" id="buyrequestrespondid" name="buyrequestrespondid">
                    <input type="hidden" id="buyrequestrespondname" name="buyrequestrespondname">
                    <h3 class="modal-title text-center" id="buyrequestrespondLabel">Buy Request Respond</h3>
                    <p class="text-center buyrequestrespondtext"></p>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Your Message:</label>
                        <textarea class="form-control fromusd" name="respondtext" id="respondtext"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- share modal -->
<div class="modal fade sharemodal" id="sharediamondsearch" tabindex="-1" aria-labelledby="sharediamondsearch"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="sharediamondsearchtitle">Share Diamond</h5>
                <form action="javascript:void(0);" name="form-diamond-share" enctype="multipart/form-data"
                    id="form-diamond-share">
                    <input type="hidden" id="sharediamondid" name="sharediamondid">
                    <div class="form-group">
                        <label for="sharewithemail" class="col-form-label">Share With:</label>
                        <input type="email" class="form-control" autocomplete="off" placeholder="Enter E-mail Address"
                            id="sharewithemail" name="sharewithemail">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary set-color-button">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- share modal -->
<div class="modal fade sharemodal" id="sharejewellerysearch" tabindex="-1" style="z-index: 9999;"
    aria-labelledby="sharejewellerysearch" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="sharejewellerysearchtitle">Share Jewellery</h5>
                <form action="javascript:void(0);" name="form-jewellery-share" enctype="multipart/form-data"
                    id="form-jewellery-share">
                    <input type="hidden" id="sharejewelleryid" name="sharejewelleryid">
                    <div class="form-group">
                        <label for="sharewithemail" class="col-form-label">Share With:</label>
                        <input type="email" class="form-control" autocomplete="off" placeholder="Enter E-mail Address"
                            id="jsharewithemail" name="jsharewithemail">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn adminbtndark">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- link modal -->
<div class="modal fade sharemodal" id="linksearch" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="linksearch" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="linksearch">Generate Public Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="checkbox" id="psearch" name="psearch" value="psearch">
                <label for="psearch"> don`t show price</label>
                <br>
                <br>
                <div class="row linksearch">
                    <div class="col-md-4 cut-group">
                        <label id="pricefrom">markup %</label>
                        <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="0">
                        <label class="plussearch">+</label>
                    </div>
                    <div class="col-md-4 cut-group">
                        <label id="pricefrom">markup $</label>
                        <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="0">
                        <label class="plussearch">=</label>
                    </div>
                    <div class="col-md-4 cut-group">
                        <label id="pricefrom">Total Price $</label>
                        <input type="text" id="from_usd" class="fromusd" name="fusd" placeholder="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                <button type="button" class="btn btn-primary">continue</button>
            </div>
        </div>
    </div>
</div>

<!-- jewlery page modal image model -->
<div class="modal fade diamondpg bd-example-modal-xll " id="jewellerydetailmodal" tabindex="-1" role="dialog"
    aria-labelledby="jewellerydetailmodal" aria-hidden="true">
    <div class="modal-dialog modal-xll" role="document">
        <div class="modal-content">
            <div class="modal-header hedsetmd">
                <h5 class="modal-title setmodelje jewelllerynametext" id="jwelerymod"></h5>
                <span class="jewelllerystocktext"></span>
                <div class="contectse-set text-center">
                    <!-- <button type="button" class="btn" data-toggle="modal" data-target="#sharediamondsearch"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/share.svg" alt="diamonds" title="diamonds"></button>
                    <button type="button" class="btn" data-toggle="modal" data-target="#linksearch"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/pin.svg" alt="diamonds" title="diamonds"></button>
                    <button type="button" class="btn"><img src="<?php echo $config->getImageurl(); ?>images/searchpage/facebook.svg" alt="diamonds" title="diamonds"></button><br> -->
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ListJewelleryDataDetail">

            </div>
        </div>
    </div>
</div>
<!-- jewlery page modal image model end -->

<!-- buyrequest page modal -->
<div class="modal fade diamondpg buypagemodset bd-example-modal-lg " data-backdrop="static" data-keyboard="false"
    id="buyrequestModal" tabindex="-1" role="dialog" aria-labelledby="buyrequestModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyrequestText"><span class="buyrequestformtext">Add New</span> Buy Request
                </h5>
                <button type="button" class="close" onclick="resetbuyresquestform();" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="buyrequestFormData">
                <form action="javascript:void(0);" name="form-buy-request" enctype="multipart/form-data"
                    id="form-buy-request" novalidate="novalidate">
                    <input type="hidden" name="id" id="id" value="" />
                    <input type="hidden" name="formevent" id="formevent" value="submit" />

                    <div class="setbuyne">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="bodyhead">
                                        <h2>Specify the Details For Your Buy Request</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="sharewithemail" class="col-form-label setnamebuy">Select
                                                    Type <span class="text-danger">*</span></label>
                                                <div class="ctupsearch">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="type"
                                                            value="1" id="ispublic" checked>
                                                        <label class="form-check-label" for="ispublic">
                                                            Public
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="type"
                                                            value="2" id="isanonymous">
                                                        <label class="form-check-label" for="isanonymous">
                                                            Anonymous
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="type"
                                                            value="3" id="isprivate">
                                                        <label class="form-check-label" for="isprivate">
                                                            Private
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 setmby">
                                                <label for="sharewithemail" class="col-form-label setnamebuy">Get
                                                    Notification</label>
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2">
                                                        <div class="setswitch">
                                                            <label class="switch switchsetbuy">
                                                                <input type="checkbox" name="isgetnotification"
                                                                    value="1" id="isgetnotification">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-9 col-xl-4 col-lg-7 col-sm-10" >
                                                        <select aria-labelledby="ppcto" name="ppcto" class="form-control">
                                                            <option value="0">Select</option>
                                                            <option value="1">Poor</option>
                                                            <option value="2">Fair</option>
                                                            <option value="3">Good</option>
                                                            <option value="4">Very Good</option>
                                                            <option value="5">Excellent</option>
                                                            <option value="6">Ideal</option>
                                                        </select>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 setmby">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-10 col-xl-10">
                                                        <label for="expirydate"
                                                            class="col-form-label setnamebuy">Expiration Date <b>(Max: 2
                                                                weeks from now)</b> <span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <input type="text"
                                                                value="<?php echo $IISMethods->getcurrdate(); ?>"
                                                                readonly class="form-control" autocomplete="off"
                                                                placeholder="Select Expiration Date" id="expirydate" name="expirydate">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="sharewithemail" class="col-form-label setnamebuy">Comment
                                                    <b> (Everybody will see this)</b></label>
                                                <div class="form-group">
                                                    <textarea class="form-control" autocomplete="off"
                                                        placeholder="Enter" id="comment" name="comment"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row setrowbuy">
                                <div class="col-12 col-md-6 col-xl-3 col-lg-6 setdpby">
                                    <div class="card">
                                        <div class="card-body">
                                            <label for="shapeid" class="col-form-label setnamebuy">Shape <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" name="shapeid[]" id="shapeid"
                                                multiple="" tabindex="-1" aria-hidden="true">

                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <label for="sharewithemail"
                                                    class="col-form-label setnamebuy">Fluorescence</label>
                                                <div class="setmbuy">
                                                    <div class="row" id="FluorescenceIntensityDiv">

                                                    </div>
                                                </div>
                                            </div>
                                            <label for="colorid" class="col-form-label setnamebuy mt-3">Color</label>
                                            <select class="form-control select2" name="colorid[]" id="colorid"
                                                multiple="" tabindex="-1" aria-hidden="true">

                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <label for="sharewithemail" class="col-form-label setnamebuy">GRADING
                                                    REPORT</label>
                                                <div class="setmbuy">
                                                    <div class="row" id="GradingReportDiv">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3 col-lg-6 setdpby">
                                    <div class="card">
                                        <div class="card-body">
                                            <label for="sharewithemail" class="col-form-label setnamebuy">Size <span
                                                    class="text-danger">*</span></label>
                                            <div class="manisecupload">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromsize" name="fromsize">
                                                                    <!-- <label class="inputset" type="number">usd</label> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="tosize" name="tosize">
                                                                    <!-- <label class="inputset" type="number">usd</label> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <label for="sharewithemail"
                                                class="col-form-label setnamebuy">Measurement</label>
                                            <div class="manisecupload">
                                                <label for="sharewithemail"
                                                    class="col-form-label set-leng">Length</label>
                                                <div class="row set-mm">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromlength" name="fromlength">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="tolength" name="tolength">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="sharewithemail"
                                                    class="col-form-label mt-3 set-leng">Width</label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromwidth" name="fromwidth">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="towidth" name="towidth">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="sharewithemail"
                                                    class="col-form-label mt-3 set-leng">Depth</label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromdepth" name="fromdepth">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="todepth" name="todepth">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="sharewithemail"
                                                    class="col-form-label mt-3 set-leng">Table</label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromtable" name="fromtable">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="totable" name="totable">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="sharewithemail"
                                                    class="col-form-label mt-3 set-leng">Depth(%)</label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control  inputper" value="0"
                                                                        autocomplete="off" onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromdepthper" name="fromdepthper">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control  inputper" value="0"
                                                                        autocomplete="off" onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="todepthper" name="todepthper">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="sharewithemail"
                                                    class="col-form-label mt-3 set-leng">Ratio</label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="From"
                                                                        id="fromratio" name="fromratio">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control "
                                                                        value="0" autocomplete="off"
                                                                        onkeypress="numbonly(event);"
                                                                        onpaste="numbonly(event);" placeholder="To"
                                                                        id="toratio" name="toratio">
                                                                    <label class="inputset" type="number">mm</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3 col-lg-6 setresby">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check pull-right">
                                                <input class="form-check-input" type="checkbox" name="isfancy" value="1"
                                                    id="isfancy">
                                                <label class="form-check-label ml-4" for="isfancy">
                                                    Fancy
                                                </label>
                                            </div>
                                            <label for="sharewithemail" class="col-form-label setnamebuy">Color <span
                                                    class="text-danger">*</span></label>
                                            <div class="manisecupload">
                                                <div class="row nonfancyDiv">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <select class="form-control select2"
                                                                        name="fromcolorid" id="fromcolorid"
                                                                        tabindex="-1" aria-hidden="true">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <select class="form-control select2"
                                                                        name="tocolorid" id="tocolorid" tabindex="-1"
                                                                        aria-hidden="true">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fancyDiv d-none">
                                                    <label for="Intensity" class="col-form-label">Intensity</label>
                                                    <div class="row">
                                                        <!-- <label for="Intensity">Intensity</label> -->

                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="fromintensityid" id="fromintensityid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="tointensityid" id="tointensityid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label for="Overtone" class="col-form-label">Overtone</label>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="overtoneid[]" id="overtoneid"
                                                                            multiple="" tabindex="-1"
                                                                            aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label for="Color" class="col-form-label">Color</label>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="fluorescenecolorid[]"
                                                                            id="fluorescenecolorid" multiple=""
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <label for="sharewithemail"
                                                    class="col-form-label setnamebuy">Inclusions</label>
                                                <div class="setmbuy">
                                                    <div class="col-12 cut-group">
                                                        <h5 class="d-inline"></h5>
                                                        <div class="row">
                                                            <label for="eyecleanid" class="eyeclenfil"><b
                                                                    class="seteyebuy">Eye Clean</b></label>
                                                            <select class="form-control select2" name="eyecleanid[]"
                                                                id="eyecleanid" multiple="" tabindex="-1"
                                                                aria-hidden="true">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="manisecupload">
                                                        <label for="sharewithemail"
                                                            class="col-form-label set-leng mt-3">Milky</label>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <select class="form-control select2"
                                                                                name="frommilkyid" id="frommilkyid"
                                                                                tabindex="-1" aria-hidden="true">

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-12 ctupsearch">
                                                                        <div class="form-group">
                                                                            <select class="form-control select2"
                                                                                name="tomilkyid" id="tomilkyid"
                                                                                tabindex="-1" aria-hidden="true">

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 cut-group">
                                                        <div class="row mt-3">
                                                            <label for="blackinclusionid" class="eyeclenfil"><b
                                                                    class="seteyebuy">Black</b></label>
                                                            <select class="form-control select2"
                                                                name="blackinclusionid[]" id="blackinclusionid"
                                                                multiple="" tabindex="-1" aria-hidden="true">

                                                            </select>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <label for="whiteinclusionid" class="eyeclenfil "><b
                                                                    class="seteyebuy">White</b></label>
                                                            <select class="form-control select2"
                                                                name="whiteinclusionid[]" id="whiteinclusionid"
                                                                multiple="" tabindex="-1" aria-hidden="true">

                                                            </select>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <label for="openinclusionid" class="eyeclenfil "><b
                                                                    class="seteyebuy">Open</b></label>
                                                            <select class="form-control select2"
                                                                name="openinclusionid[]" id="openinclusionid"
                                                                multiple="" tabindex="-1" aria-hidden="true">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3 col-lg-6 setresby">
                                    <div class="card">
                                        <div class="card-body">
                                            <label for="sharewithemail"
                                                class="col-form-label setnamebuy">Clarity</label>
                                            <div class="manisecupload">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <select class="form-control select2"
                                                                        name="fromclarityid" id="fromclarityid"
                                                                        tabindex="-1" aria-hidden="true">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-12 ctupsearch">
                                                                <div class="form-group">
                                                                    <select class="form-control select2"
                                                                        name="toclarityid" id="toclarityid"
                                                                        tabindex="-1" aria-hidden="true">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <label for="price" class="col-form-label setnamebuy">Price($)</label>
                                                <input type="text" class="form-control" value="0"
                                                    autocomplete="off" onkeypress="numbonly(event);"
                                                    onpaste="numbonly(event);" placeholder="Price($)" id="price" name="price">
                                                <label class="inputset" type="number">usd</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <label for="countryid" class="col-form-label setnamebuy">Location <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" name="countryid[]" id="countryid"
                                                    multiple="" tabindex="-1" aria-hidden="true">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <label for="sharewithemail"
                                                    class="col-form-label setnamebuy">Finish</label>
                                                <div class="manisecupload">
                                                    <label for="sharewithemail"
                                                        class="col-form-label set-leng">Cut</label>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="fromcutid" id="fromcutid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="tocutid" id="tocutid" tabindex="-1"
                                                                            aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label for="sharewithemail"
                                                        class="col-form-label set-leng mt-3">Polish</label>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="frompolishid" id="frompolishid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="topolishid" id="topolishid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label for="sharewithemail"
                                                        class="col-form-label set-leng mt-3">Symmetry</label>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="fromsymmetryid" id="fromsymmetryid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="col-12 ctupsearch">
                                                                    <div class="form-group">
                                                                        <select class="form-control select2"
                                                                            name="tosymmetryid" id="tosymmetryid"
                                                                            tabindex="-1" aria-hidden="true">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row setrowbuy">
                                <button type="submit" id="btnbuyrequestsubmit"
                                    class="btn btn-primary mr-2 adminbtndark">Save</button>
                                <button type="reset" id="btnbuyrequestreset" onclick="resetbuyresquestform();"
                                    class="btn btn-primary  adminbtndark mr-2">Reset</button>
                                <button type="button" id="btnbuyrequestcancel" onclick="resetbuyresquestform();"
                                    class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- <div class="modal-footer">
            
            </div> -->
        </div>
    </div>
</div>
<!-- buyrequest page modal end -->

<!-- allrequest page modal -->
<div class="modal fade diamondpg allpagemodset bd-example-modal-lg " id="BuyRequestDetailsModal" tabindex="-1"
    role="dialog" aria-labelledby="BuyRequestDetailsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BuyRequestDetailsText">Buy Request Details</h5>
                <!-- <div class="imgallreq">
                    <img src="http://192.168.1.2/savanigems/assets/images/searchpage/copy.svg" alt="not found all req image" title="not found all req image">
                </div> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="BuyRequestDetailsData">


            </div>
        </div>
    </div>
</div>
<!-- allrequest page modal end -->

<!-- profile adress modal -->
<div class="modal fade setmopf" id="addadress" tabindex="-1" role="dialog" aria-labelledby="addadress"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
        <h5 class="modal-title" id="addadress">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label font-light">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label font-light">Address</label>
                        <textarea class="form-control" autocomplete="off" placeholder="Enter your adress"
                            id="laserinscription" name="laserinscription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label font-light">Mobile</label>
                        <input type="text" class="form-control" id="number" placeholder="+91 123-456-7890">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label font-light">location</label>
                        <input type="text" class="form-control" id="location" placeholder="home">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save </button>
            </div>
        </div>
    </div>
</div>
<!-- profile adress modal end -->

<!-- current plan profile page  -->
<div class="modal fade setprocurr" id="activeplandetailsModal" tabindex="-1" role="dialog"
    aria-labelledby="activeplandetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activeplandetailsModalLabel">Current Plan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="activeplandetailsData">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- current plan profile page  end -->

<!-- byreq new modal start -->
<div class="modal fade byreqtab bd-example-modal" id="Byreq" tabindex="-1" role="dialog" aria-labelledby="Byreqne"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BuyRequestDetailsText">Trade CVD | HL-00014</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="req-new">
                    <div class="setnamealby">Oval ,Cushion, 10 - 19</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="resallby text-left">India,Gujarat,canada</div>
                            <div class="set-data-req">
                                <div class="se-type">
                                    <p>Type :<span> Annonymous</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="se-type">
                                <p> Get Notification : :<span> No</span> </p>
                            </div>
                            <div class="se-type">
                                <p>Request Person :<span> mohit mandlesara</span> </p>
                            </div>
                            <div class="noteallby text-right">
                                <div class="setresalbu"><a href="javascript:void(0);" class="btnsendbuyrequestrespond"
                                        data-buyrequestname="HL-00014 | Oval ,Cushion, 10 - 19"
                                        data-buyrequestid="43A75C27-838B-48D2-AE91-27D0B51D3012">
                                        <div class="imgallreqse">
                                            <img src="http://192.168.1.2/savanigems/assets/images/searchpage/back.svg"
                                                alt="Respond to buy request" title="Respond to buy request">
                                        </div>
                                        <h5>Respond</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="req-info">
                    Request Info
                </div>
                <div class="col-12 buy-id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6 set-sh-buy">
                                            <p>Buy Request#</p>
                                            <p>Shape</p>
                                            <p>Size</p>
                                            <p>Color</p>
                                            <p>Clarity</p>
                                            <p>Cut</p>
                                            <p>Polish</p>
                                            <p>Symmetry</p>
                                            <p>Fluorescence Intensity</p>
                                            <p>Fluorescence Color</p>
                                            <p>Lab</p>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6 setna">
                                            <p>: &nbsp;&nbsp;Oval ,Cushion</p>
                                            <p>: &nbsp;&nbsp;10-19</p>
                                            <p>: &nbsp;&nbsp;grey-pink</p>
                                            <p>: &nbsp;&nbsp;AA-VS1</p>
                                            <p>: &nbsp;&nbsp;Buff-Top-Cabachon</p>
                                            <p>: &nbsp;&nbsp;Good-Good</p>
                                            <p>: &nbsp;&nbsp;6-5</p>
                                            <p>: &nbsp;&nbsp;Faint</p>
                                            <p>: &nbsp;&nbsp;blue,White</p>
                                            <p>: &nbsp;&nbsp;GAT,GIR,Extremely Thin</p>
                                            <p>: &nbsp;&nbsp;$1500</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 setrespr">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6 set-sh-buy ">
                                            <p>Price($)</p>
                                            <p>Eye Clean</p>
                                            <p>Milky</p>
                                            <p>Black Inclusion</p>
                                            <p>White Inclusion</p>
                                            <p>Open Inclusion</p>
                                            <p>Length-Width</p>
                                            <p>Depth-Table</p>
                                            <p>Depth(%)-Ratio</p>
                                            <p>Create Date</p>
                                            <p>Expiration Date</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6 setna">
                                            <p>: &nbsp;&nbsp;HL-00014</p>
                                            <p>: &nbsp;&nbsp;SI1</p>
                                            <p>: &nbsp;&nbsp;foggy-test</p>
                                            <p>: &nbsp;&nbsp;Cavity</p>
                                            <p>: &nbsp;&nbsp;Chip</p>
                                            <p>: &nbsp;&nbsp;white table medium</p>
                                            <p>: &nbsp;&nbsp;(12-13)-(10-20)</p>
                                            <p>: &nbsp;&nbsp;(10-20)-(10-12)</p>
                                            <p>: &nbsp;&nbsp;(10-20)-(10-20)</p>
                                            <p>: &nbsp;&nbsp;15/11/2022</p>
                                            <p>: &nbsp;&nbsp;15/11/2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
        </div>
    </div>
</div>
<!-- byreq new modal start -->

<!-- Delete Confirmation Modal -->
<div class="modal delete-confirmation-modal animated fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body py-lg-0">
                <div class="row mb-4 d-lg-none">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <!--<h5 class="modal-title" id="modalConfirmationLabel">Are you sure!</h5>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 text-center min-height-100 img-trash">
                        <div class="row justify-content-center align-items-center min-height-100">
                            <div class="col-12">
                                <img class="w-100" src="assets/img/trash.png" alt="trash.png" />
                            </div>
                        </div>
                    </div>                         
                    <div class="col-12 col-lg-8 pt-3 py-lg-3">  
                        <div class="row">
                            <div class="col-12 mb-2 mb-lg-4">
                                <button type="button" class="close d-none d-lg-block" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                <h5 class="modal-title text-left" id="modalConfirmationLabel">Are you sure!</h5>
                            </div>
                        </div>                                              
                        <form class="row" id="deleteForm" onsubmit="return false">
                            <input type="hidden" id="drid" name="drid" >
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <label class="mb-1">Type <b>Delete</b> for delete this record.</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="deleteaction" name="deleteaction" class="form-control textuppercase">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" name="confirmdelete" id="confirmdelete" class="btn btn-danger float-right" >Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="profilephotoform" enctype="multipart/form-data" >
                <input class="form-control d-none my-profile-form-control" name="profilepic" id="inp_userprofileimg" accept="image/*"  type="hidden" readonly>
                <input class="form-control d-none my-profile-form-control" name="tempuserprofileimg" id="tempuserprofileimg" accept="image/*"  type="hidden" readonly>
                <div class="modal-body">
                    <div class="col-lg-12 cropHeaderWrapper " align="center">
                        <div id="croppicst" class="croppicDiv"></div>
                            <?php
                            if($LoginInfo->getProfilepic())
                            {
                            ?>
                            <span class="btn btn-danger removeprofilephoto" >Remove Photo</span>
                            <?php
                            }
                            ?>
                            <span class="btn cropimgbtn" id="cropContainerHeaderButtonst">Upload Image</span>
                             <input type="hidden" name="uploadimgurl" id="uploadimgurl" />
                    </div>	        
                </div>
                <div class="modal-footer adminbtndefault" style="border-top: 0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-imgsave adminbtndark">Update Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade packagedetails-modal" id="modalpackagedetails" tabindex="-1" aria-labelledby="modalpackagedetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title">Package Details</h3>
                <button type="button" class="btn-close ion-ios-close-empty" data-dismiss="modal"
                    aria-label="Close"></button>
                <div class="row">
                    <div class="col-12">
                        <div class="packagedetails-modal-content" id="packagedetailsData">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Sieve data Start -->
<div class="modal fade sharemodal" id="addSieveModal" tabindex="-1" aria-labelledby="addSieveModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="">Add Sieve</h5>
                <form action="javascript:void(0);" name="form-add-sieve" enctype="multipart/form-data" id="form-add-sieve">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name * </label>
                        <input type="text" class="form-control" autocomplete="off" placeholder="Enter Name" id="name" name="name">
                    </div>
                    <!-- <div class="form-group">
                        <label for="name" class="col-form-label">Display Order * </label>
                        <input type="text" class="form-control" autocomplete="off" placeholder="Enter Display Order" id="displayorder" onkeypress="numbonly(event);" onpaste="numbonly(event);" name="displayorder">
                    </div> -->
                    <div class="form-group">
                        <!-- <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Cancel</button> -->
                        <button type="submit" class="btn btn-success pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Sieve data End -->