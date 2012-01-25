/**
 *@	follow user btn & unfollow
 *@ topic tile slide
 */ 

$(document).ready(function() {
	var user_id = $("#user_id").val();

	/**
	 * follow user btn
	 */
	$('.follow-user').live('click',function(){
		var $this = $(this);
		var following_id=$this.attr('data-uid');
		$.ajax({
			  url: "/relation/follow_user",
			  type:"POST",
			  data:'following_id='+following_id,
			  dataType:"json",
			  success: function(msg){
				  if(msg==true){
					  $this.html('unfollow').removeClass('follow-user').addClass('unfollow-user');
				  }
			  }
		});
	});
	
	/**
	 * unfollow user btn
	 */
	$('.unfollow-user').live('click',function(){
		var $this = $(this);
		var following_id=$this.attr('data-uid');
		$.ajax({
			  url: "/relation/unfollow_user",
			  type:"POST",
			  data:'following_id='+following_id,
			  dataType:"json",
			  success: function(msg){
				  if(msg==true){
					  $this.html('follow').removeClass('unfollow-user').addClass('follow-user');
				  }
			  }
		});
	});
	
	
	/**
	 * -topic tile slide
	 */
	$(".topics-list li .topic-tile-overlay").mouseenter(function(){
		$(this).siblings('div').find('p').slideDown('fast');
	}).mouseout(function(){
		$(this).siblings('div').find('p').slideUp('fast');
	});
	
	
	/**
	 * view all following
	 */
	$("#following .view-all").click(function(){
		$("#following_dialog").dialog({
			width:880,
			modal:true
		});
		$("#following_dialog button").live('click',function(){
			$("#following_dialog").dialog('close');
		});
	});
	
	
	/**
	 * edit profile button
	 */
	$("#profile #edit_profile_btn").click(function(){
		$("#edit_profile_dialog").dialog({
			width:880,
			modal:true
		});
	//	$("#following_dialog button").live('click',function(){
	//		$("#following_dialog").dialog('close');
	//	});
	});
});
