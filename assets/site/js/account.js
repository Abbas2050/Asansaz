
jQuery(document).ready(function($) {


    // MY ACCOUNT MENU SLIDER *************************************************************************************************************************

    $(window).on('load resize', function(){
        $("#account-nav").mdtabs({
            color: "#1abc9c",
            height: 3,
            duration: 550,
            leeway : $(window).width() > 767 ? 35 : 0
        });
    });

    if(window.location.hash == '#company-block') {
        setTimeout(function() {
            window.scrollTo(0, 330);
        }, 1);
        $('#company-block').collapse("show");
    }

    $(document).on('submit','#form-change-about, #form-change-company, #form-change-password, #form-change-email, #form-delete-account',function (e) {
         notify.remove();
        var $this = $(this);
		var formData = new FormData(this);
		 //formData.append('file', $('#customerstore-company_logo')[0].files[0]);
		
		if($this.find('.has-error').length) return false;
        e.preventDefault();
		$.ajax({
			method: 'post',
			processData: false,
			contentType: false,
			cache: false,
			data: formData,
			enctype: 'multipart/form-data',
			url: $this.attr('action'),
			dataType: 'JSON',
			success: function (json) {
				if(json.result == 'success'){
					notify.addSuccess(json.msg).show();
				} else if(json.errors) {
					for(var i in json.errors){
						$('#'+$this.attr('id')).yiiActiveForm('updateAttribute', 'customer-'+i.toLowerCase(), json.errors[i]);
					}
				} else if(json.error) {
					notify.addError(json.error).show();
				}
			}
			});
    });

    // trigger modal for delete
    $(document).on('click', '#my-listings .delete-listing', function (e) {
        e.preventDefault();
        $('#modal-post-listing-delete .delete-listing').data('url',$(this).data('url')).data('listing-id',$(this).data('listing-id'));
        $('#modal-post-listing-delete').modal('show');
    });

    // action delete
    $(document).on('click', '#modal-post-listing-delete:visible .delete-listing', function (e) {
        e.preventDefault();
        notify.remove();
        var $this = $(this);
        $.post($this.data('url'),{
            listing_id:$this.data('listing-id'),
        },function (json) {
            if(json.result == 'success') {
                notify.addSuccess(json.msg).show();
                window.location.reload(false);
            } else {
                notify.addError(json.msg).show();
            }
        }, 'json');

    });

    // trigger modal for remove favorite
    $(document).on('click', '#favorites .delete-favorite-listing', function (e) {
        e.preventDefault();
        $('#modal-favorite-delete .delete-favorite').data('url',$(this).data('favorite-url')).data('listing-id',$(this).data('listing-id'));
        $('#modal-favorite-delete').modal('show');
    });

    // action delete
    $(document).on('click', '#modal-favorite-delete:visible .delete-favorite', function (e) {
        e.preventDefault();
        notify.remove();
        var $this = $(this);
        $.post($this.data('url'),{
            listing_id:$this.data('listing-id'),
        },function (json) {
            if(json.result == 'success') {
                notify.addSuccess(json.msg).show();
                setTimeout(function(){ window.location.reload(false); },200);

            } else {
                notify.addError(json.msg).show();
            }
        }, 'json');

    });

    // trigger modal for remove inbox(conversation)
    $(document).on('click', '.delete-conversation-action', function (e) {
        e.preventDefault();
        $('#modal-post-conversation-delete .delete-conversation').data('url', $(this).data('url')).data('conversation-uid', $(this).data('conversation-uid'));
        $('#modal-post-conversation-delete').modal('show');
    });

    // action delete inbox
    $(document).on('click', '#modal-post-conversation-delete:visible .delete-conversation', function (e) {
        e.preventDefault();
        notify.remove();
        var $this = $(this);
        $.post($this.data('url'), {
            conversation_uid: $this.data('conversation-uid'),
        }, function (json) {
            if (json.result == 'success') {
                notify.addSuccess(json.msg).show();
                if (json.url) {
                    window.location.replace(json.url);
                } else {
                    window.location.reload(false);
                }
            } else {
                notify.addError(json.msg).show();
            }
        }, 'json');
    });

    // trigger modal for archive inbox(conversation)
    $(document).on('click', '.archive-conversation-action', function (e) {
        e.preventDefault();
        $('#modal-post-conversation-archive .archive-conversation').data('url', $(this).data('url')).data('conversation-uid', $(this).data('conversation-uid'));
        $('#modal-post-conversation-archive').modal('show');
    });

    // action archive inbox
    $(document).on('click', '#modal-post-conversation-archive:visible .archive-conversation', function (e) {
        e.preventDefault();
        notify.remove();
        var $this = $(this);
        $.post($this.data('url'), {
            conversation_uid: $this.data('conversation-uid'),
        }, function (json) {
            if (json.result == 'success') {
                notify.addSuccess(json.msg).show();
                window.location.reload(false);
            } else {
                notify.addError(json.msg).show();
            }
        }, 'json');
    });

    // trigger modal for block user
    $(document).on('click', '.block-buyer-action', function (e) {
        e.preventDefault();
        $('#modal-post-buyer-block .block-buyer').data('url', $(this).data('url')).data('conversation-uid', $(this).data('conversation-uid'));
        $('#modal-post-buyer-block').modal('show');
    });

    // action block inbox
    $(document).on('click', '#modal-post-buyer-block:visible .block-buyer', function (e) {
        e.preventDefault();
        notify.remove();
        var $this = $(this);
        $.post($this.data('url'), {
            conversation_uid: $this.data('conversation-uid'),
        }, function (json) {
            if (json.result == 'success') {
                notify.addSuccess(json.msg).show();
                window.location.reload(false);
            } else {
                notify.addError(json.msg).show();
            }
        }, 'json');
    });

    // trigger modal for unblock user
    $(document).on('click', '.unblock-buyer-action', function (e) {
        e.preventDefault();
        $('#modal-post-buyer-unblock .unblock-buyer').data('url', $(this).data('url')).data('conversation-uid', $(this).data('conversation-uid'));
        $('#modal-post-buyer-unblock').modal('show');
    });

    // action unblock inbox
    $(document).on('click', '#modal-post-buyer-unblock:visible .unblock-buyer', function (e) {
        e.preventDefault();
        notify.remove();
        var $this = $(this);
        $.post($this.data('url'), {
            conversation_uid: $this.data('conversation-uid'),
        }, function (json) {
            if (json.result == 'success') {
                notify.addSuccess(json.msg).show();
                window.location.reload(false);
            } else {
                notify.addError(json.msg).show();
            }
        }, 'json');
    });


    // open tab from url hash
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollTo = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollTo);
    });
  
	$(document).on('change',"#customer-phone",function(e){
		
	   var value = $(this).val();
	  
	   $("#submit").css("display","none");
		
	   var expression =new RegExp(/^[().+\d -]{7,15}$/);
	   if(expression.test(value))
	   {  
		   var timestamp = new Date().getUTCMilliseconds();
		   $("#phonecode").val("1"+timestamp+"00");
		   var code = $("#phonecode").val();
		   var url  = $(this).attr("data-url"); 
		   $.ajax({
			  type:"POST",
			  url: url,
			  data: { code:code,phone:value, _csrf: yii.getCsrfToken() },
			}).done(function (data) {
                    $("#phoneNumber").html(value);
		            $("#phone-verification").css("display","block");
			});
		   
		    
		
	   }
	});
	$(document).on('click',"#resend",function(e){
		
	   var value = $("#customer-phone").val();
	  
	    $("#submit").css("display","none");
		
	   var expression =new RegExp(/^[().+\d -]{7,15}$/);
	   if(expression.test(value))
	   {  
		   var timestamp = new Date().getUTCMilliseconds();
		   $("#phonecode").val("1"+timestamp+"00");
		   var code = $("#phonecode").val();
		   var url  = $(this).attr("data-url"); 
		   $.ajax({
			  type:"POST",
			  url: url,
			  data: { code:code,phone:value, _csrf: yii.getCsrfToken() },
			}).done(function (data) {
                    
			});
		   
		    
		
	   }
	});
	
	$(document).on('change',"#customer-phoneverified",function(e){
		
	   var value = $(this).val();
	   var code  = $("#phonecode").val(); 	
	   var url   = $(this).attr('data-url');
	       $.ajax({
			  type: "POST",
			  url: url,
			  data: { code:code, value: value, _csrf: yii.getCsrfToken() },
			}).done(function (data) {
				if(data)
				{
                  $("#verificationError").removeClass("has-error").addClass("has-success");
				  $("#customer-phoneverified").siblings(".help-block").html("Phone # is verified successfully");
				  $("#submit").css("display","initial");	
				}
			    else
				{
				    $("#verificationError").addClass("has-error");
					$("#customer-phoneverified").siblings(".help-block").html("Code is incorrect. Please enter the correct code. Otherwise your account will  not be created.");
				}
			});
		   
	});
	
	$(document).on('click', '.show-hide-trigger', function (e) {
        e.preventDefault();
		
       var calling = $(".show-hide-trigger").attr('data-id');
	   var show    = $(".show-hide-trigger").attr('data-ajax');
	
	
	   if(calling == 0){
		  	$(".show-hide-trigger").attr('data-id','1');
		    $(".show-hide-trigger").addClass('show');
			$("#"+show).attr("type",'text');
	   }
		else{
			$(".show-hide-trigger").attr('data-id','0');
			$(".show-hide-trigger").removeClass('show');
			$("#"+show).attr("type",'password');
		}
		
		$("#taxOffice").siblings(".select2-container").css("width",'167px !important');
		
    });
	
      $("input[name='registrationType']").click(function(){
            var radioValue = $("input[name='registrationType']:checked").val();
            if(radioValue == "individual"){
                $(".corporate-input").css("display",'none');
				$(".corporate").css("display",'none');
				$(".individual").css("display",'block');
            }else{
				 $(".corporate-input").css("display",'block');
				 $(".corporate").css("display",'block');
				 $(".individual").css("display",'none'); 
			}
        });
	   $("input[name='companyType']").click(function(){
            var radioValue = $("input[name='companyType']:checked").val();
            if(radioValue == "PERSONAL_INVOICE"){
				
                $("#limitedCompanyName").attr("readonly",'readonly');
				$(".private-company").css("display",'block');
				$(".limited-company").css("display",'none');
            }else{
				$("#limitedCompanyName").removeAttr("readonly");
				$(".private-company").css("display",'none');
				$(".limited-company").css("display",'block'); 
			}
        });
  
	
});