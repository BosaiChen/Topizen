$(document).ready(function(){
	/**
	 * reset button
	 */
	$("#reset_btn").click(function(){
		//check email
		var email = $("#email").val();
		if(email == ''){
			alert('Please enter your email');
			return;
		}else{
			var myRegExp = /[a-z0-9-]{1,30}@[a-z0-9-]{1,65}.[a-z]{3}/ ;
			if(!myRegExp.test(email)){
				alert('Invalid email format');
				return;
			}else{
				var flag=0;
				$.ajax({
					   type: "POST",
					   url: BASE_URL + "/index.php/user_c/check_email",
					   data: "email="+email,
					   async:false,
					   success: function(msg){
						   if(parseInt(msg)==1){//d email
							   alert("This email does not exist");
							   flag=1;
							   return;
						   }
					   }
				});
				if(flag==1)return;
			}
		}
		//ajax send password reset email
		
		//show message
		$(this).parent().remove();
		$("#msg").show();
	});
	
	/**
	 *  enter button listener
	 */
	$("#email").keypress(function(event){
		var keyCode = event.keyCode;
		if(keyCode == 13){
			$("#reset_btn").click();
		}
	});
});