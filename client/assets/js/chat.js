  // if it is not touch device

    // Chat user list
    if($('.chat-application .chat-user-list').length > 0){
        var chat_user_list = new PerfectScrollbar(".chat-user-list");
      }
  
       // Chat user list
       if($('.new-customer-sidebar .new-chat-user-list').length > 0){
        var chat_user_list = new PerfectScrollbar(".new-chat-user-list");
      }
    
      // Chat user profile
      if($('.chat-application .profile-sidebar-area .scroll-area').length > 0){
        var chat_user_list = new PerfectScrollbar(".profile-sidebar-area .scroll-area");
      }
  
      // Chat area
      if($('.chat-application .user-chats').length > 0){
        var chat_user = new PerfectScrollbar(".user-chats", {
          wheelPropagation: false
        });
      }
    
      // User profile right area
      if($('.chat-application .user-profile-sidebar-area').length > 0){
        var user_profile = new PerfectScrollbar(".user-profile-sidebar-area");
      }
  
  
      // Chat mediadoc list
      if($('.chat-mediadoc-list').length > 0){
        var chat_mediadoc_list = new PerfectScrollbar(".chat-mediadoc-list");
      }
  
      // Chat saved reply list
      if($('.chat-savedreply-list').length > 0){
        var chat_savedreply_list = new PerfectScrollbar(".chat-savedreply-list");
      }
  
      // Chat notes list
      if($('.chat-notes-list').length > 0){
        var chat_notes_list = new PerfectScrollbar(".chat-notes-list");
      }
  
      // Broadcast list
      if($('.new-broadcast-sidebar .new-broadcast-list').length > 0){
        var broadcast_list = new PerfectScrollbar(".new-broadcast-list");
      }
      
  
  
    // if it is a touch device
    else {
      $(".chat-user-list").css("overflow", "scroll");
      $(".profile-sidebar-area .scroll-area").css("overflow", "scroll");
      $(".user-chats").css("overflow", "scroll");
      $(".user-profile-sidebar-area").css("overflow", "scroll");
    }
  
  
    // Chat Profile sidebar toggle
    // $('.chat-application .sidebar-profile-toggle').on('click',function(){
    //   $('.chat-profile-sidebar').addClass('show');
    //   $('.chat-overlay').addClass('show');
    // });
  
    // // User Profile sidebar toggle
    // $('.chat-application .user-profile-toggle').on('click',function(){
    //   $('.user-profile-sidebar').addClass('show');
    //   $('.chat-overlay').addClass('show');
    // });
  
    // Update status by clickin on Radio
    $('.chat-application .user-status input:radio[name=userStatus]').on('change', function(){
      var $className = "avatar-status-"+this.value;
      $(".header-profile-sidebar .avatar span").removeClass();
      $(".sidebar-profile-toggle .avatar span").removeClass();
      $(".header-profile-sidebar .avatar span").addClass($className+" avatar-status-lg");
      $(".sidebar-profile-toggle .avatar span").addClass($className);
    });
  
    // On Profile close click
    $(".chat-application .close-icon").on('click',function(){
      $('.chat-profile-sidebar').removeClass('show');
      $('.user-profile-sidebar').removeClass('show');
      if(!$(".sidebar-content").hasClass("show")){
        $('.chat-overlay').removeClass('show');
      }
    });
  
    // On sidebar close click
    $(".chat-application .sidebar-close-icon").on('click',function(){
      $('.sidebar-content').removeClass('show');
      $('.chat-overlay').removeClass('show');
    });
  
    // On overlay click
    $(".chat-application .chat-overlay").on('click',function(){
      $('.app-content .sidebar-content').removeClass('show');
      $('.chat-application .chat-overlay').removeClass('show');
      $('.chat-profile-sidebar').removeClass('show');
      $('.user-profile-sidebar').removeClass('show');
    });
  
    // Add class active on click of Chat users list
    // $(".chat-application .chat-user-list ul li").on('click', function(){
    //   if($('.chat-user-list ul li').hasClass('active')){
    //     $('.chat-user-list ul li').removeClass('active');
    //   }
    //   $(this).addClass("active");
    //   $(this).find(".badge").remove();
    //   if($('.chat-user-list ul li').hasClass('active')){
    //     $('.start-chat-area').addClass('d-none');
    //     $('.active-chat').removeClass('d-none');
    //   }
    //   else{
    //     $('.start-chat-area').removeClass('d-none');
    //     $('.active-chat').addClass('d-none');
    //   }
    // });
  
    // autoscroll to bottom of Chat area
    var chatContainer = $(".user-chats");
    $(".chat-users-list-wrapper li").on("click", function () {
      chatContainer.animate({ scrollTop: chatContainer[0].scrollHeight }, 400)
    });
  
    // Favorite star click
    $(".chat-application .favorite i").on("click", function(e) {
      $(this).parent('.favorite').toggleClass("warning");
      e.stopPropagation();
    });
  
    // Main menu toggle should hide app menu
    $('.chat-application .menu-toggle').on('click',function(e){
      $('.app-content .sidebar-left').removeClass('show');
      $('.chat-application .chat-overlay').removeClass('show');
    });
  
    // Chat sidebar toggle
    // if ($(window).width() < 992) {
    //   $('.chat-application .sidebar-toggle').on('click',function(){
    //     $('.app-content .sidebar-content').addClass('show');
    //     $('.chat-application .chat-overlay').addClass('show');
    //   });
    // }

    if ($(window).width() < 992) {
      $('.content-right').addClass('mobile-chat-right-d-none');
      $('.sidebar-left').removeClass('mobile-chat-left-d-none');
      // $('body').on('click','.btn-set-clos',function(){
      //     $('#users-list ul li.active a').trigger('click');
      // });
    }


    // For chat sidebar on small screen
    if ($(window).width() > 992) {
      if($('.chat-application .chat-overlay').hasClass('show')){
        $('.chat-application .chat-overlay').removeClass('show');
      }
    }
  
    // Scroll Chat area
    $(".user-chats").scrollTop($(".user-chats").height());
  
    // Filter
   /*  $(".chat-application #chat-search").on("input", function() {
      var value = $(this).val();
      if(value!=""){
        $(".chat-user-list .chat-users-list-wrapper li").each(function() {
          $(this).toggle($(this).filter('[data-saleorderno*="' + value + '"], [data-enquiryno*="' + value + '"], [data-wa_id*="' + value + '"], [data-quotationno*="' + value + '"], [data-personname*="' + value + '"]').length > 0);
          
        });
  
      }
      else{
        $(".chat-user-list .chat-users-list-wrapper li").show();
      }
      // getchats(1,1,'lastchat_dateiso','',value);
      
    }); */
  
  
    $(window).on("resize", function() {
      // remove show classes from sidebar and overlay if size is > 992
      if ($(window).width() > 992) {
        if($('.chat-application .chat-overlay').hasClass('show')){
          $('.app-content .sidebar-left').removeClass('show');
          $('.chat-application .chat-overlay').removeClass('show');
        }
      }
    
      // Chat sidebar toggle
      if ($(window).width() < 992) {
        if($('.chat-application .chat-profile-sidebar').hasClass('show')){
          $('.chat-profile-sidebar').removeClass('show');
        }
        $('.chat-application .sidebar-toggle').on('click',function(){
          $('.app-content .sidebar-content').addClass('show');
          $('.chat-application .chat-overlay').addClass('show');
        });
      }
    }); 
  
  
  var slim;
  $('body').on('click','.media-selection',function(){
      $('#addmediaForm #mediatype').prop('disabled',false);
      $('#media-selection #selmediatype').prop('disabled',false);
  
      var disablemediatype = $(this).attr("data-disablemediatype") || 0;
      $('#addmediaForm #disabledmediatype').val(disablemediatype);
      if (disablemediatype==1) {
          $('#addmediaForm #mediatype').prop('disabled',true);
          $('#media-selection #selmediatype').prop('disabled',true);
      }
      $('#addmediaForm').trigger('reset');
      $('.media-selection-view-sidebar').addClass('show');
      $('.theme-sidebar-overlay').addClass('show');
      $('#addmediaForm #mediatype').val(1);
      // $('.select2').select2();
  
      $('.hideondocument').removeClass('hidden');
      $('.showondocument').addClass('hidden');
      $('.showonvideo').addClass('hidden');
      $('.custom-file-label').text('Choose Image');
      $('#mediaimg').val('');
      
      $('#mtype').val($(this).attr('data-type'));
      if($(this).attr('data-mediatype')){
          $('#mediatype').val($(this).attr('data-mediatype')).trigger('change');
          $('#whatsappmediatype').val($(this).attr('data-mediatype'));
      }
      
      $('#mediafield').val($(this).attr('data-field'));
      var multipleimg = $(this).attr('data-multipleimg') || 0;
      $('#multipleimg').val(multipleimg);
      var ratio1 = $(this).attr('data-ratio');
      //Slim.destroy(element);
      $('.slim').remove();
      $('#silmdiv').html('<input type="file" name="mediaimg" id="mediaimg"/>');
      $('#mediadocument').attr("accept", ".pdf,.csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/plain");
      setTimeout(() => {
          var element = document.getElementById('mediaimg');
          // slim = new Slim(element, {
          //     ratio: ratio1
          // });
  
          new Slim(element, {
              ratio: ratio1,
              instantEdit : true,
              label: 'Drop your image here.',
              buttonConfirmLabel: 'Ok'
          });
          var field = $(this).attr('data-field');
          if(field=='brikkinpropertybrochure'){
              $('#mediadocument').attr("accept", ".pdf");
          }
      }, 100);
  });
  
  function resetslim(){
    $('.slim').remove();
    $('#silmdiv').html('<input type="file" name="mediaimg" id="mediaimg"/>');
    // $('.slim-btn-remove').trigger('click');
  }
  
  $('body').on('click','.media-delete', function () {
    var field = $(this).attr('data-field');
    $('.'+field+'-div').addClass('hidden');
    $('.'+field+'-preview').attr('src','');
    $('#'+field+'').val('');
  });
  
  $('body').on('click', '.media-selection-view-sidebar-close', function(){
    $('.media-selection-view-sidebar').removeClass('show');
    $('.theme-sidebar-overlay').removeClass('show');
    resetslim();
  });
  
  $('body').on('click','#selectmediabtn', function(){
    $('#addmediaForm #mediatype').prop('disabled',false);
    $('#media-selection #selmediatype').prop('disabled',false);
    var disablemediatype = $('#addmediaForm #disabledmediatype').val() || 0;
    if (disablemediatype==1) {
        $('#addmediaForm #mediatype').prop('disabled',true);
        $('#selectmedia #selmediatype').prop('disabled',true);
    }
    var mediatype1=$('#addmediaForm #mediatype :selected').val();
   
    $('#selmediatype').val(mediatype1);
    $('.select2').select2();
    viewmedia();
  }); 
  
  $('body').on('click','.mediaimage-click', function(){
    alert();
    $('.mediaimage-click').removeClass('active');
    var selmediatype=$('#selmediatype :selected').val();
    var htmldata="";
    var path=$(this).attr('data-path');
    var mediatitle=$(this).attr('data-mediatitle');
    var mediaalt=$(this).attr('data-mediaalt');
    var caption=$(this).attr('data-caption');
    var entry_date=$(this).attr('data-entry_date');
    htmldata+='<div>';
    var webselmediatype=$('#webselmediatype :selected').val();
    if(selmediatype==3)
    {
        htmldata+='<video width="250" controls="controls" preload="metadata">';
        htmldata+='<source src="'+path+'" type="video/mp4">';
        htmldata+='</video>';
    }else if(selmediatype==2 || webselmediatype==2)
    {   
        htmldata+= '<img class="mt-1 mediasingleimage" src="'+weburl+'assets/images/filepdf.png"></img><hr>';
    }else{
        htmldata+= '<img class="mt-1 mediasingleimage" src="'+path+'"></img><hr>';
    }
    htmldata+='<h6>Title</h6> <p>'+ mediatitle +'</p>';
    htmldata+='<h6>Media Alt</h6><p>'+ mediaalt +'</p>';
    htmldata+='<h6>Media Caption</h6><p>'+caption +'</p>';
    htmldata+='<h6>Created At</h6> <p>'+entry_date+'</p><hr>';
    htmldata+='</div>';
    htmldata+='<div class="col-xs-12 pb-10 col-sm-12 col-md-12 col-lg-12 col-form full-width text-right"> <a href="javascript:void(0)" id="mediasingleselect" name="mediasingleselect" class="btn btn-primary">Add</a> </div>';
    $('#loadsinglemedia').html(htmldata);
    $(this).addClass('active');
  });
  $('body').on('click','.chatheaderdata', function(){
      $('.view-customer-sidebar').addClass('show');
  
      var contactno=$('#chatcontactno').html();
      // getclientdetails(contactno);
      
      // getchatmedia(1,1);
  
  
      $('#chattags').tagEditor('destroy');
      $('#chattags').tagEditor({
        forceLowercase: false, 
        removeDuplicates:false,
        onChange: function(field, editor, tags) {
            //Insert Chat Tags
            insertchattags();
        },
      });
  });
  
  function getclientdetails(contactno)
  {
      $('.loading').show();
      jqXHR = $.ajax({
          url : "whatsappgetdata.php",
          type : "POST",
          dataType: "json",
          data: {action:'getclientdetails',contactno:contactno},
          success : function(data) 
          {  
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);	
            $('.loading').hide();
            if(resultdata.status == 0) 
            {
                // alertify(resultdata.message,'error');
            }
            else if(resultdata.status == 1) 
            {
                $('.customername').html(resultdata.name);
                $('.customernumber').html(resultdata.mobileno);
                $('.roundd').attr('data-letters',resultdata.shortname);
  
                $('#chattags').tagEditor('destroy');
                $('#chattags').tagEditor({ 
                  initialTags: resultdata.chattags,
                  forceLowercase: false, 
                  removeDuplicates:false,
                  onChange: function(field, editor, tags) {
                      //Insert Chat Tags
                      insertchattags();
                  }, 
                });
  
  
                //List Chat Notes
                getchatnotes(1);
  
                //List Chat Saved Reply
                getchatsavedreply(1);
            }
          }
      }); 
  }
  
    
  $('body').on('click','#mediasingleselect', function(){
    var path = $('.mediaimage-click.active').attr('data-path');
    var shortpath = $('.mediaimage-click.active').attr('data-shortpath');
    var mediafield = $('#mediafield').val();
    var selmediatype = $('#selmediatype').val();
    if(mediafield && path){
        $('#'+mediafield).val(shortpath);
        $('.'+mediafield+'-div').removeClass('hidden');
        $('#'+mediafield+'-preview').attr('src',"");
        $('#'+mediafield+'-preview').attr('src',path);
        $('#mediapath-new-preview').addClass('hidden');
        
        if(selmediatype==1){
            $('#mediapath-new-preview').attr('src',path);
            $('#mediapath-new-preview').removeClass('hidden');
            $('#mediadocclickhere').addClass('hidden');
        }else{
            $('#mediadocclickhere').removeClass('hidden');
            $('#mediadocclickhere').attr('href',path);
        }
  
        $('.media-selection-view-sidebar').removeClass('show');
        $('.theme-sidebar-overlay').removeClass('show');     
        $('.'+mediafield+'-viewmodal').attr('data-imagepath',path);
        $('.'+mediafield+'-viewmodal').removeClass('hidden');
        $('.'+mediafield+'-viewmodal').trigger('click');
    }
    $('.chat-app-input').addClass('hidden');
    $('.chat-app-media').removeClass('hidden');
  })
  
  
  $('body').on('change','#mediatype',function(){
    if($(this).val()==1){
        $('.hideondocument').removeClass('hidden');
        $('.showondocument').addClass('hidden');
        $('.showonvideo').addClass('hidden');
        $('.custom-file-label').text('Choose Image');
        $('#mediaimg').val('');
        
    }else if($(this).val()==2){
        $('.hideondocument').addClass('hidden'); 
        $('.showondocument').removeClass('hidden');
        $('.custom-file-label').text('Choose Document');
        $('#mediadocument').val('');
    }else if($(this).val()==3){
        $('.hideondocument').addClass('hidden'); 
        $('.showondocument').addClass('hidden');
        $('.showonvideo').removeClass('hidden');
        $('.custom-file-label').text('Choose Video');
        $('#mediadocument').val('');
    }
  });
  
  $("textarea").keydown(function(e){
    // Enter was pressed without shift key
    if (e.keyCode == 13 && !e.shiftKey)
    { 
      //alert();
        // prevent default behavior
        e.preventDefault();
        enter_chat();
    }
    });
  
    $('#addmediaForm').on('submit',function (e) {
      var mediaimg = document.getElementById("mediaimg").files[0];
      var mediavideo = document.getElementById("mediavideo").files[0];
      var mediadocument = document.getElementById("mediadocument").files[0];
      var mediatype=$('#mediatype').val();
      if((mediaimg && mediatype == 1) || (mediavideo && mediatype == 3) || (mediadocument && mediatype == 2))
      {
        //alert();
        var fd= document.getElementById('addmediaForm');
        var form_data = new FormData(fd);
        
        form_data.append("action", 'addmedia');
        form_data.append("mediaimg", mediaimg);
        $('.loading').show();
        jqXHR = $.ajax({
          url : "whatsappgetdata.php",
          type : "POST",
          dataType: "json",
          cache: false,
          contentType: false,
          processData: false,
          data : form_data,
          // data:$('#customerForm').serialize()+'&action=insertcustomerfromso',
          success : function(data) 
          {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('.loading').hide();
            if(resultdata.status == 0) 
            {
              alertify(resultdata.message, 'error');	
            }
            else if(resultdata.status == 1)
            {
              if(resultdata.mediafield){
                var selmediatype = $('#selmediatype').val();
                $('#'+resultdata.mediafield).val(resultdata.mediapath);
                $('.'+resultdata.mediafield+'-div').removeClass('hidden');
                $('#'+resultdata.mediafield+'-preview').attr('src',resultdata.fullmediapath);
                $('#mediapath-new-preview').attr('src',"");
                $('#mediapath-new-preview').addClass('hidden');
                if(selmediatype==1){
                      $('#mediapath-new-preview').attr('src',resultdata.fullmediapath);
                      $('#mediapath-new-preview').removeClass('hidden');
                }
                $('.'+resultdata.mediafield+'-viewmodal').attr('data-imagepath',resultdata.fullmediapath);
                $('.'+resultdata.mediafield+'-viewmodal').trigger('click');
                $('.'+resultdata.mediafield+'-viewmodal').removeClass('hidden');   
              }
              $('.chat-app-input').addClass('hidden');
              $('.chat-app-media').removeClass('hidden');
            }
            $('.media-selection-view-sidebar').removeClass('show');
            $('.theme-sidebar-overlay').removeClass('show');
            resetslim();
            $('.main-loading').hide();
           
          }
        });	
        e.preventDefault();
      }else{
  
      }
      
    });
  
  
    $('body').on('click', '.view-customer-sidebar-close', function(){
      $('.view-customer-sidebar').removeClass('show');
      $('.theme-sidebar-overlay').removeClass('show');
      resetslim();
    });
  
  
    function alertify(alertmsg,alertdiv)
    {
        $('#'+alertdiv+'alert').find('p').html(alertmsg);
        $('#'+alertdiv+'alert').fadeToggle(350);
        //$('#'+alertdiv+'alert').delay(4000).fadeOut('slow');
        setTimeout(function(){ $('#'+alertdiv+'alert').slideUp( 400 ); }, 4000);
    }