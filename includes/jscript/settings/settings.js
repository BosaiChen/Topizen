/**
 * @ save buttons
 * 		| user info save
 * 		| user int save btn
 * 		| password save btn
 * 		| avatar save btn
 * @ upload user image
 * @ image crop
 */
$(document).ready(function(){
	/**
	 * save buttons
	 */
	//user info save
	$("#user_info_save_btn").click(function(){
		var fullname = $("#full_name").val();
		var self_intro = $("#self_intro").val();
		//check fullname
		if(fullname == ''){
			alert("Please write your fullname");
			return;
		}else if(fullname.length > FULLNAME_MAX){
			alert("Sorry,your fullname is too long");
			return;
		}
		//check self intro
		if(self_intro == ''){
			alert("Please write your description");
			return;
		}else if(self_intro.length > SELF_INTRO_MAX){
			alert("Sorry,your description is too long");
			return;
		}
	});
	
	//user int save btn
	$("#user_int_save_btn").click(function(){
		//check interest
		var int_num = $(".int-rank-item").find('.interest_option').length;
		if(int_num < 3){
			alert("You must choose exactly 3 interests");
			return;
		}
	});
	
	//password save btn
	$("#password_save_btn").click(function(){
		//get passwords
		var old_pwd = $("#old_password").val();
		var new_pwd = $("#new_password").val();
		var new_pwd_conf = $("#confirm_password").val();
		//check old password
		if(old_pwd.length < 8){
			alert("Your password should have at least 8 characters");
			return;
		}
		//check password confirm
		if(new_pwd.length < 8){
			alert("Your password should have at least 8 characters");
			return;
		}else if(new_pwd != new_pwd_conf){
			alert("Your password does not match");
			return;
		}
		//validate current password 
		$.ajax({
			  url: BASE_URL + "/index.php/settings/ajax_match_password",
			  type:"POST",
			  data:"old_password="+old_pwd,
			  dataType:"json",
			  success: function(data){
				 if(data.code=='0'){
					 alert(data.msg);
				 }else if(data.code=='1'){
					 $.ajax({
						  url: BASE_URL + "/index.php/settings/ajax_update_password",
						  type:"POST",
						  data:"new_password="+new_pwd,
						  dataType:"json",
						  success: function(data){
							 switch(data.code){
							 	case '0':alert(data.msg);break;
							 	case '1':alert(data.msg);break;
							 }
						  }
					});
				 }
			  }
		});
		
	});
	
	/**
	 * avatar save btn
	 */
	$("#user_img_save_btn").click(function(){
		$.ajax({
			  url: BASE_URL + "/index.php/user_c/store_images",
			  type:"POST",
			  data:"img_path="+$("#target").attr('src'),
			  dataType:"json",
			  success: function(data){
				  alert(data);
			  }
		});
	});
	
    /**
     * image crop
     */
    var jcrop_api=0;
    function activate_image_crop(){
        $('#target').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            aspectRatio: 1
          },function(){
            // Use the API to get the real image size
            jcrop_api = this;
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the API in the jcrop_api variable
            jcrop_api = this;
          });
     
          function updatePreview(c)
          {
            if (parseInt(c.w) > 0)
            {
              var rx = 100 / c.w;
              var ry = 100 / c.h;
     
              $('#prev_lg').css({
                width: Math.round(rx * boundx) + 'px',
                height: Math.round(ry * boundy) + 'px',
                marginLeft: '-' + Math.round(rx * c.x) + 'px',
                marginTop: '-' + Math.round(ry * c.y) + 'px'
              });
              $('#prev_md').css({
                  width: Math.round(rx * boundx * 0.5) + 'px',
                  height: Math.round(ry * boundy * 0.5) + 'px',
                  marginLeft: '-' + Math.round(rx * c.x *0.5) + 'px',
                  marginTop: '-' + Math.round(ry * c.y *0.5) + 'px'
                });
              $('#prev_sm').css({
                  width: Math.round(rx * boundx * 0.3) + 'px',
                  height: Math.round(ry * boundy * 0.3) + 'px',
                  marginLeft: '-' + Math.round(rx * c.x * 0.3) + 'px',
                  marginTop: '-' + Math.round(ry * c.y * 0.3) + 'px'
                });
            }
          };
    }   
});

