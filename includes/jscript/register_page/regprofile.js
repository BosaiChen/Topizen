/***
 * @ save button
 * 
 */

$(document).ready(function() {
	
	/**
	 * save button
	 */
	//register complete page 1 save button
	$("#reg_profile_save_btn").click(function(){
		var fullname = $("#fullname").val();
		var self_intro = $("#self_intro").val();
		var domain = $("#domain").val();
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
		//check domain name
		if(domain == ''){
			alert("Please set your domain");
			return;
		}else if(self_intro.length > 100){
			alert("Sorry,your domain is too long");
			return;
		}
		//save info
		$.ajax({
			 url: BASE_URL + "/index.php/user/set_user_base_info",
			 type:"POST",
			 data:{
				 desc:self_intro,
				 fullname:fullname,
				 domain:domain
			 },
			 success: function(data){
				 if(data==1){
					 window.location = BASE_URL + '/regfollows';
				 }
			 }
		});
	});
});