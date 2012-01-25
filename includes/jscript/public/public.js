/**
 * @ feature topic
 * 		| feature topic slider
 * @ all topics load more
 * @ voting topics load more
 * @ topic tile slide
 * @ vote topic
 */

$(document).ready(function(){	
	/**
	 * feature topic
	 */
	/* feature topic slider */
	$('#ft_slides').slides({
		container:'ft-slides-container',
		play:5000,
		effect: 'fade'
	});
	
	var topicHandler = function(topicsJSON) {  
        $.each(topicsJSON,function(i,topic) {    
            var tid = topic.tid;
            var title = topic.title;
            var desc = topic.desc;
            var bg_img = topic.bg_img;
            var date = topic.chosen_date;
            var time = topic.chosen_time;
            
            var topic_img = '<img src="'+bg_img+'" />';
			var overlay_div = '<a href="/topics/'+tid+'" class="topic-tile-overlay"></a>';
            var info_div = $('<div></div>').append('<h3 class="topic-title">'+title+'</h3><p>'+desc+'</p>').attr('class','topic-tile-info');
			
            $('<li></li>').append(topic_img).append(overlay_div).append(info_div)
            .appendTo($('#all_topics'))
            .hide()  
            .slideDown(250,function() {  
                if(i == 0) {  
                //    $.scrollTo($('div#' + id));  
                }  
            });  
        });  
    };  



	/**
	 * all topics load more
	 */
	$("#all_topics_load_more").click(function(){
		$.ajax({  
	        url: '/public_c/ajax_get_topics',  
	        data: {  
	            'start': public_topics_start,  
	            'desiredTopics': public_topics_num_per_load  
	        },  
	        type: 'post',  
	        dataType: 'json',  
	        cache: false,  
	        success: function(responseJSON) {  
	            //reset the message  
	        //    loadMore.text('Load More');  
	            //increment the current status  
	          //  start += desiredPosts;  
	            //add in the new posts  
	         //   postHandler(responseJSON);  
	        	topicHandler(responseJSON);
	        	public_topics_start=public_topics_start+public_topics_num_per_load;
	        },  
	        //failure class  
	        error: function() {  
	            //reset the message  
	          //  loadMore.text('Oops! Try Again.');  
	        },  
	        //complete event  
	        complete: function() {  
	            //remove the spinner  
	        //    loadMore.removeClass('activate');  
	        }  
	    });  
		
	});
	
	
	var votingTopicHandler = function(topicsJSON) {  
        $.each(topicsJSON,function(i,topic) {    
            var tid = topic.tid;
            var title = topic.title;
            var desc = topic.desc;
            var bg_img = topic.bg_img;
            var date = topic.chosen_date;
            var v_num= topic.v_num;
            var time = topic.chosen_time;
            
            var badget_div = $('<div></div>').append('<em>'+v_num+'</em>').attr('class','topic-voting-badget');
            var info_div = $('<div></div>').append('<a href="/topics/'+tid+'" class="topic-title">'+title+'</a>').append('<p>'+desc+'</p>')
            							   .append('<p><strong class="username">Frank Biocca</strong> Created in'+time+'</p>').attr('class','topic-voting-meta');
            $('<li></li>').append(badget_div).append(info_div)
            .appendTo($('#voting_topics'))
            .hide()  
            .slideDown(250,function() {  
                if(i == 0) {  
                //    $.scrollTo($('div#' + id));  
                }  
            });  
        });  
    };  
	/**
	 * voting topics load more
	 */
	$("#voting_topics_load_more").click(function(){
		$.ajax({  
	        url: '/public_c/ajax_get_voting_topics',  
	        data: {  
	            'start': public_voting_topics_start,  
	            'desiredTopics': public_voting_topics_num_per_load  
	        },  
	        type: 'post',  
	        dataType: 'json',  
	        cache: false,  
	        success: function(responseJSON) {  
	            //reset the message  
	        //    loadMore.text('Load More');  
	            //increment the current status  
	          //  start += desiredPosts;  
	            //add in the new posts  
	         //   postHandler(responseJSON);  
	        	votingTopicHandler(responseJSON);
	        	public_voting_topics_start=public_voting_topics_start+public_voting_topics_num_per_load;
	        },  
	        //failure class  
	        error: function() {  
	            //reset the message  
	          //  loadMore.text('Oops! Try Again.');  
	        },  
	        //complete event  
	        complete: function() {  
	            //remove the spinner  
	        //    loadMore.removeClass('activate');  
	        }  
	    });  
		
	});
	
	/**
	 * add my topics
	 */
	$("#add_topic_btn").click(function(){
		$("#add_topic_dialog").dialog({
			width:900,
			modal:true
		});
	});
	
	$('#add_topic_done_btn').click(function(){
		var title=$('#suggest_topic_title').val();
		var desc=$('#suggest_topic_desc').val();
		if(title.length==0 || desc.length==0){
			alert('Please write the title or desc');
			return;
		}
		$.ajax({  
	        url: '/topic/add_topic',  
	        data: {  
	            'title': title,  
	            'desc': desc
	        },  
	        type: 'post',  
	        dataType: 'json', 
	        success: function(responseJSON) {  
	            if(responseJSON.msg=='success'){
	            	alert('done');
	            }
	        }
	    }); 
		
	});
	
	
	/**
	 * -topic tile slide
	 */
	$(".topics-list li .topic-tile-overlay").live('mouseenter',function(){
		$(this).siblings('div').find('p').slideDown('fast');
	}).live('mouseout',function(){
		$(this).siblings('div').find('p').slideUp('fast');
	});
	
	/**
	 * vote topic
	 */
	$('#voting_topics .vote-btn').live('click',function(){
		var tid=parseInt($(this).attr('data-tid'));
		var v_num_div=$(this).siblings('em');
		$.ajax({
			url:'/topic/vote_topic',
			data:'tid='+tid,
			type:'post',
			dataType:'json',
			success:function(responseJSON){
				if(responseJSON.msg=='success'){
	            	v_num_div.text(v_num_div.text()+1);
	            }
			}
		});
	});
});
