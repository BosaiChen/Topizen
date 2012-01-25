/**
* @ header personal/public entry animation
* @ header profile animation
*/

/*
 * CONSTANTS
 * */
var BASE_URL = 'http://localhost';

var FULLNAME_MAX = 100;
var SELF_INTRO_MAX = 500;





$(document).ready(function(){
	//fix html 5 attr placeholder
	if(!Modernizr.input.placeholder){
		$("input,textarea").each(
			function(){
				var color = $(this).css('color');
				if($(this).val()=="" && $(this).attr("placeholder")!=""){
					$(this).val($(this).attr("placeholder"));
					$(this).focus(function(){
						if($(this).val()==$(this).attr("placeholder")){ 
							$(this).val("").css('color',color);
						};
					});
					$(this).blur(function(){
						if($(this).val()=="") $(this).val($(this).attr("placeholder")).css('color','#aaa');
					});
				}
			});
	}
	
	
	/**
	 * header current user nav animation
	 */
	$("#current_user_nav").mouseover(function(){
		$(this).find('.menu-item').show();
		$(this).find('a').addClass('alt-bg-color');
	}).mouseout(function(){
		$(this).find('.menu-item').hide();
		$(this).find('a').removeClass('alt-bg-color');
	});
	
});