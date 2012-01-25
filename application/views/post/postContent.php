<?php
/**
*  @FILE_NAME : postContent.php
*  @APPLICATION :  www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: Jun 9, 2011
*  @AUTHOR: Bosai Chen
*  @CONTACT: bchen04@syr.edu
*  @BRIEF_FILE_DESCRIPTION: descriptions here...
*
* Module Operations:
* ==================
* This module blah blah...
*
* Public Interface Usage:
* =================
*
* Maintenance History:
* ====================
* ver 1.0 : Jun 9, 2011
* - first release
*/
?>
<link rel="stylesheet" href="<?php echo base_url();?>includes/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>includes/jscript/plugin/colorbox/colorbox.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/post_page/post_page.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>includes/uploadify/swfobject.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/includes/jscript/plugin/xheditor/xheditor-1.1.8-en.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/includes/jscript/post/post.js"></script>


<div id="post_wrap" class="page-wrap">
	<div class="post-author clearfix">
		<span class="red-bar">Author</span>
		<div class="author-info clearfix">
			<img class="user-img-md lfloat" src="<?=$author["image"]?>" />
			<div class="user-int user-int-lg-pos">
					<img class="int-part" src="/includes/images/int_1.png">
					<img class="int-part" src="/includes/images/int_3.png">
					<img class="int-part" src="/includes/images/int_2.png">
				</div>
			<div class="list-col-gamma">
				<div class="tab-item-row">
					<span class="tab-topizen-user tab-item-user-2"><?=$author["first_name"]?></span> <span
						class="topizen-self-intro">self intro...</span>
				</div>
				<div class="tab-item-row">
					<span class="user-status">Topic owner</span>
					<span class="tab-item-stat"> <span class="tab-item-stat-2">Questions
							<span class=qu"tab-topizen-question-num stat-digit">0</span>
							Expressions <span class="tab-topizen-post-num stat-digit">100</span>
					</span> </span>
				</div>
				<div class="tab-item-row tab-item-topizen-row-3">
					<button class="small-white-btn friend-btn">Follow</button>
				</div>
			</div>
		</div>
	</div>
	<div class="post-content-box">
		<div class="post-title">{post_title}</div>
		<div class="post-topic-date-box">In <span class="topic-title-post"><?=$topic["title"]?></span> ,<span class="date">{start_time} ago</span></div>
		<div class="post-content" state="default">{post_content}</div>
		<div id="post_thumbnail_box" class="clearfix" state="default">
			<div id="post_tmb_pic_box" class="clearfix">
				<span class="post-thumbnail-item">
					<img class="post-img-delete" src="/includes/images/delete_btn.png" title="delete picture" />
					<a rel="post-img-gallery" href="/includes/images/public_video.png" class="thumbnail-outer">
						<img class="post-thumbnail" src="/includes/images/public_video.png" />
					</a>
				</span>
				<span class="post-thumbnail-item">
					<img class="post-img-delete" src="/includes/images/delete_btn.png" title="delete picture" />
					<a rel="post-img-gallery" href="/includes/images/public_video.png" class="thumbnail-outer">
						<img class="post-thumbnail" src="/includes/images/public_video.png" />
					</a>
				</span>
				<span class="post-thumbnail-item">
					<img class="post-img-delete" src="/includes/images/delete_btn.png" title="delete picture" />
					<a rel="post-img-gallery" href="/includes/images/public_video.png" class="thumbnail-outer">
						<img class="post-thumbnail" src="/includes/images/public_video.png" />
					</a>
				</span>
				<span class="post-thumbnail-item">
					<img class="post-img-delete" src="/includes/images/delete_btn.png" title="delete picture" />
					<a rel="post-img-gallery" href="/includes/images/public_video.png" class="thumbnail-outer">
						<img class="post-thumbnail" src="/includes/images/public_video.png" />
					</a>
				</span>
				<span class="post-thumbnail-item">
					<img class="post-img-delete" src="/includes/images/delete_btn.png" title="delete picture" />
					<a rel="post-img-gallery" href="/includes/images/public_video.png" class="thumbnail-outer">
						<img class="post-thumbnail" src="/includes/images/public_video.png" />
					</a>
				</span>
				<span class="post-thumbnail-item">
					<img class="post-img-delete" src="/includes/images/delete_btn.png" title="delete picture" />
					<a rel="post-img-gallery" href="/includes/images/public_video.png" class="thumbnail-outer">
						<img class="post-thumbnail" src="/includes/images/public_video.png" />
					</a>
				</span>
				
			</div>
			<div id="edit_pic_btn_box" style="display:none;">
				<input id="post_pic_edit_uploader" type="file" />
				<a id="pic_edit_cancel_btn" href="javascript:void(0);">Cancel</a>
				<a id="pic_edit_save_btn" href="javascript:void(0);">Save</a>
			</div>
		</div>
	</div>

	<div id="comment_box">
		<div class="comment-title">
			<a class="post-action">I reply</a><span class="post-stat-digit">0</span> - 
			<a class="post-action">I like</a><span class="post-stat-digit">0</span> - 
			<a id="edit_post_btn" href="javascript:void(0);" class="post-action">Edit content</a> - 
			<a id="edit_post_img_btn" href="javascript:void(0);" class="post-action" state="off">Edit picture</a> -
			<a id="delete_post_btn" href="javascript:void(0);" class="post-action" state="off">Delete post</a>
		</div>
		<div class="popular-reply-box clearfix"><span class="red-bar pr-pos">Popular Reply</span>
			<div id="popular_comment" class="top-reply-item">
				<div class="comment-img">hello</div>
				<div class="comment-col-beta">
					<span class="cmt-user">hello</span><span class="cmt-topizen-self-intro">self intro...</span>
					<div class="cmt-txt">hello</div>
					<div class="cmt-stat">
						<span class="cmt-start-time">1 week ago</span>
						<span class="cmt-stat-txt">Like</span><span class="cmt-stat-number cmt-like-num">0</span>
					</div>
				</div>
			</div>
		</div>
		<div class="comment-list"></div>
		<div id="comment_item_temp" class="comment-item" style="display:none">
			<img class="comment-img">
			<span class="cmt-user"></span><span class="cmt-topizen-self-intro">self intro...</span>
				<div class="cmt-txt"></div>
				<div class="cmt-stat">
					<span class="cmt-start-time"></span>
					<span class="cmt-like-btn cmt-stat-txt">Like</span><span class="cmt-stat-number cmt-like-num">0</span>
				</div>
		</div>
	</div>
	<div class="reply-editor-box">
		<div class="reply-author">
			<span class="topizen-name topizen-name-pos-1">Bosai</span><span class="topizen-self-intro">self intro...</span>
		</div>
		<textarea id="reply_editor" class="input-textarea pr-textarea-pos" rows="5" placeholder="Write your reply here"></textarea>
			<div class="reply-button-bar">
				<button id="post_reply_btn" class="small-white-btn">Send</button>
			</div>
	</div>
<div class="post-reply-box"></div>
<div id="post_reply_template" class="post_reply" style="display:none">

</div>
</div>

<!-- ======================= START OF tab display template ================-->
<div id="post_content_editor_box" class="post-content-editor" style="display:none;">
	<div class="xhabout-cover"></div>
	<textarea id="post_content_editor" cols="92" rows="15"></textarea>
	<div id="post_editor_btn_box">
		<a id="post_editor_cancel" href="javascript:void(0);">Cancel</a>
		<a id="post_editor_save" href="javascript:void(0);">Save</a>
	</div>
</div>
