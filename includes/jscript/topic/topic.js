/**
 * @ follow topic button & unfollow
 * @ topizen tab
 * @ send post
 */

$(document).ready(function() {
	/**
	 * follow topic button
	 */
	$('.follow-topic').live('click',function(){
		var $this = $(this);
		var tid=$this.attr('data-tid');
		$.ajax({
			  url: "/relation/follow_topic",
			  type:"POST",
			  data:'tid='+tid,
			  dataType:"json",
			  success: function(msg){
				  if(msg==true){
					  $this.html('unfollow').removeClass('follow-topic').addClass('unfollow-topic');
				  }
			  }
		});
	});
	
	/**
	 * unfollow topic btn
	 */
	$('.unfollow-topic').live('click',function(){
		var $this = $(this);
		var tid=$this.attr('data-tid');
		$.ajax({
			  url: "/relation/unfollow_topic",
			  type:"POST",
			  data:'tid='+tid,
			  dataType:"json",
			  success: function(msg){
				  if(msg==true){
					  $this.html('follow').removeClass('unfollow-topic').addClass('follow-topic');
				  }
			  }
		});
	});
	
	
	
	
	/**
	 * send post
	 */
	$('#send_post_btn').click(function(){
		var postContent = $('#post_content').val();
		//check content
		if(postContent.length == 0){
			alert('Please say some');
			return;
		}
		//save post
		$.ajax({  
	        url: '/post/create_post',  
	        data:{
	        	'topicId':$('#topic_id').val(),
	        	'content':postContent,
	        	'post_type':$('#add_post').attr('data-post-type')
	        },
	        type: 'post',  
	        dataType: 'json',  
	        success: function(responseJSON) {
	        	$('#add_post_dialog').dialog('close');
	        	var post = responseJSON;
	        	var author_image = post.author.image;
	            var author_name = post.author.fullname;
	            var author_domain = post.author.domain;
	            var time = post.time;
	        	if(responseJSON.msg=='success'){
	        		var author_img = '<img src="'+author_image+'" />';
	    			var info_div = $('<div></div>').append('<p>'+postContent+'</p>'+'<em class="type">'+time+'</em>');
	                if($('#topic_content .no-data-txt').length>0){
	                	$('#topic_content .no-data-txt').replaceWith('<ul class="posts-list"></ul>');
	                }
	    			$('<li></li>').append(author_img).append(info_div)
	                .appendTo($('.posts-list'))
	                .hide()  
	                .slideDown(250);  
	        	}
	        }
	    });  
	});
	
	
	/**
	 * add new post
	 */
	$("#add_post").click(function(){
		$("#add_post_dialog").dialog({
			width:900,
			modal:true
		});
	});
	
	/**
	 * show post
	 */
	$(".posts-list li .reply").live('click',function(){
		//get post
		post_id=$(this).parent().parent().attr('data-post-id');
		author_img=$(this).parent().siblings('img').attr('src');
		post_content=$(this).siblings('p').text();
		reply_num=$(this).text();
		//load post
		$('#show_post_dialog .single-post').find('img').attr('src',author_img).end()
										   .find('p').html(post_content).end()
										   .find('.reply').html(reply_num).end()
										   .attr('data-post-id',post_id);
		//load replies
		$.ajax({  
	        url: '/post/ajax_get_reposts',  
	        data:{
	        	'postId':post_id
	        },
	        type: 'post',  
	        dataType: 'json',  
	        success: function(responseJSON) {
	        	if(responseJSON==null){
	        		$('#show_post_dialog .comments-list').replaceWith('<p class="no-data-txt">Be the first to reply!</p>');
	        	}else{
	        		$('#show_post_dialog .comments-list').html('');
	        		var reply = responseJSON;
	        		for(var i=0;i<reply.length;i++){
	        			var reply_content=reply[i].content;
			        	var author_image = reply[i].author_img;
			            var time = reply[i].time;
		        		var author_img = '<img src="'+author_image+'" />';
		    			var info_div = $('<div></div>').append('<p>'+reply_content+'</p>');
		                if($('#show_post_dialog .no-data-txt').length>0){
		                	$('#show_post_dialog .no-data-txt').replaceWith('<ul class="comments-list"></ul>');
		                }
		    			$('<li></li>').append(author_img).append(info_div)
		                .appendTo($('.comments-list'));
	        		}
	        	}
	        	//not open the dialog until all data has been loaded
	        	$("#show_post_dialog").dialog({
	    			width:900,
	    			modal:true
	    		});
	        }
	    }); 
	});
	
	/**
	 * add new reply
	 */
	$('#reply_btn').click(function(){
		reply_content=$('#reply_content').val();
		post_id=$(this).siblings('.single-post').attr('data-post-id');
		//save reply
		$.ajax({  
	        url: '/post/ajax_create_repost',  
	        data:{
	        	'postId':post_id,
	        	'content':reply_content
	        },
	        type: 'post',  
	        dataType: 'json',  
	        success: function(responseJSON) {
	        	var reply = responseJSON;
	        	var author_image = reply.author.image;
	            var author_name = reply.author.fullname;
	            var author_domain = reply.author.domain;
	            var time = reply.time;
	        	if(responseJSON.msg=='success'){
	        		var author_img = '<img src="'+author_image+'" />';
	    			var info_div = $('<div></div>').append('<p>'+reply_content+'</p>');
	                if($('#show_post_dialog .no-data-txt').length>0){
	                	$('#show_post_dialog .no-data-txt').replaceWith('<ul class="comments-list"></ul>');
	                }
	    			$('<li></li>').append(author_img).append(info_div)
	                .appendTo($('.comments-list'))
	                .hide()  
	                .slideDown(250);  
	        	}
	        }
	    }); 
	});
});