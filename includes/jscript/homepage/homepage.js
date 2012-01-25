/**
 * @ Enter keystroke listener
 * @ login button
 */
$(document).ready(function(){
	/**
	 * Enter keystroke listener
	 */
	$("#email,#password").keypress(function(event){
		var keyCode = event.keyCode;
		if(keyCode == 13){//press "enter" button
			$("#button_login").click();
		}
	});
	/**
	 * login button
	 */
	$("#button_login").click(function(){
		var email = $("#email").val();
		var password = $("#password").val();
		//var remember = $("#remember_me:checked").val()!=undefined?'1':'0';
		
		//validate email format
		if(email==''){
			alert("Please enter your email");
			return;
		}else{
			var myRegExp = /[a-z0-9-]{1,30}@[a-z0-9-]{1,65}.[a-z]{3}/;
	        if(!myRegExp.test(email)){
	        	alert("Invalid email address");
	        	return;
	        }
		}
		//validate password length
		if(password==''){
			alert("Please enter your password");
			return;
		}else if(password.length<8){
			alert("Password should have at least 8 characters");
			return;
		}
        //log in
		$.ajax({
			type:"POST",
			url:"/index.php/user/log_in",
			data:{
				email:email,
				password:password
			},
			success:function(msg){
				switch(parseInt(msg)){
					case -1://account not exists
						alert("You have not registed");return;
					case -2://incorrect password
						alert("password incorrect");return;
					case -3://need to active
						alert("Please access link in your mail to activate");return;
					default://success
						$("#login_form").submit();
				}
			}
		});
	});
});