/**
 * @ enter button listener
 * @ reg page 1 save button
 */
$(document).ready(function(){	
	/**
	 *  enter button listener
	 */
	$("#email,#password").keypress(function(event){
		var keyCode = event.keyCode;
		if(keyCode == 13){
			$("#reg_save_btn_1").click();
		}
	});
	
	
	/**
	 * reg page 1 save button
	 */
	$("#reg_save_btn_1").click(function(){
		//check email
		var email = $("#email").val();
		if(email == ''){
			alert('Please enter your email');
			return;
		}else{
			var myRegExp = /[a-z0-9-]{1,30}@[a-z0-9-]{1,65}.[a-z]{1,3}/ ;
			if(!myRegExp.test(email)){
				alert('Invalid email format');
				return;
			}else{
				var flag=0;
				$.ajax({
					   type: "POST",
					   url: "/index.php/user_c/check_email",
					   data: "email="+email,
					   async:false,
					   success: function(msg){
						   if(parseInt(msg)!=1){//duplicate email
							   alert("This email has been registered");
							   flag=1;
							   return;
						   }
					   }
				});
				if(flag==1)return;
			}
		}
		
		//check password
		var pwd_value = $("#password").val();
		if(pwd_value.length=0){
			alert("Please enter your password");
			return;
		}else if(pwd_value.length<8){
			alert("password should have at least 8 characters");
			return;
		}
			//start registration
		$("#register").submit();
	});
});