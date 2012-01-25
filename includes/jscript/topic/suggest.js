/**
 * @ suggest post
 */

$(document).ready(function() {
	/**
	 * suggest topic
	 */
	$('#suggest_btn').click(function(){
		var title = $('#topic_title').val();
		var desc = $('#topic_desc').val();
		//check title and desc
		if(title.length == 0){
			alert('Please write the title');
			return;
		}else if(desc.length == 0){
			alert('Please write the description');
			return;
		}
		//save post
		$.ajax({  
	        url: '/topic/add_topic',  
	        data:{
	        	'title':title,
	        	'desc':desc
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
});