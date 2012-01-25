<input id="topic_id" type="hidden" value="<?=$topic['tid']?>"/>

<div id="page_wrap" class="clearfix">
	<section id="topic_profile" class="clearfix">
		<section id="topic_info">
			<img src="/includes/images/topic.png" />
			<div>
				<a href="#" class="topic-title"><?=$topic['title']?></a>
				<h4 class="topic-date"><?=$topic['chosen_date']?></h4>
				<p><?=$topic['desc']?></p>
			</div>
		</section>
		<aside>
			<h3 class="section-header">TOPIC CREATED BY</h3>
			<div class="topic-author">
				<?php if($topic['creator']!=null):?>
				<?php foreach($topic['creator'] as $author):?>
				<img src="<?=$author['image']?>" />
				<section>
					<a href="/citizens/<?=$author['domain']?>"><?=$author['fullname']?></a>
					<p><em class="num-highlight">2312</em> ideas</p>
				</section>
				<?php endforeach;?>
				<?php endif;?>
			</div>
			<h3 class="section-header">TOPIC INFORMATION</h3>
			<div class="topic-count">
				Followed by <em><?=$topic['num']['fans']?></em><br />
				<em><?=$topic['num']['post']?></em> ideas<br />
			</div>
			<?php if($is_following):?>
			<button class="unfollow-topic" data-tid="<?=$topic['tid']?>" type="button">I dislike this topic</button>
		<?php else:?>
			<button class="follow-topic" data-tid="<?=$topic['tid']?>" type="button">I like this topic</button>
		<?php endif;?>
		</aside>
	</section>
	<section id="topic_content">
		<nav class="clearfix">
			<a id="begining" href="/topics/<?=$topic['tid']?>/begining" class="section-header <?php if($tab_selected=='begining'):?>tab-selected<?php endif;?>">STORY'S BEGINING</a>
			<a id="development" href="/topics/<?=$topic['tid']?>/development" class="section-header <?php if($tab_selected=='development'):?>tab-selected<?php endif;?>">STORY'S DEVELOPMENT</a>
			<a id="future" href="/topics/<?=$topic['tid']?>/future" class="section-header <?php if($tab_selected=='future'):?>tab-selected<?php endif;?> last">FUTURE AND OPINIONS</a>
		</nav>
		<div>
			<?php if($tab_selected=='begining'):?>
				<button id="add_post" type="button" data-post-type="begining">ADD A BEGINING</button>
			<?php elseif($tab_selected=='development'):?>
				<button id="add_post" type="button" data-post-type="development">ADD A DEVELOPMENT</button>
			<?php elseif($tab_selected=='future'):?>
				<button id="add_post" type="button" data-post-type="future">ADD A FUTURE</button>
			<?php endif;?>
		</div>
		<?php if($posts_list!=null):?>
		<ul class="posts-list">
			<?php foreach($posts_list as $post):?>
			<li data-post-id="<?=$post['pid']?>">
				<img src="<?=$post['author_img']?>" />
				<div>
					<p><?=$post['content']?></p>
					<em class="reply"><?=$post['num']['like']?></em>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		<?php else:?>
			<p class="no-data-txt">U will be the first to post!</p>
		<?php endif;?>
	</section><!-- #topic_content -->
	<section id="topic_organizors">
		<h3 href="javascript:;" class="section-header">TOPIC ORGANIZORS</h3>
		<?php if($topic['contributor']==true):?>
		<ul class="topizens">
			<?php foreach($topic['contributor'] as $contributor):?>
			<li>
				<img src="<?=$contributor['image']?>" />
				<section>
					<a href="/citizens/<?=$contributor['domain']?>"><?=$contributor['fullname']?></a>
					<p><em class="num-highlight">2312</em> ideas</p>
				</section>
			</li>
			<?php endforeach;;?>
		</ul>
		<?php else:?>
		<p class="no-data-txt">No organizors so far</p>
		<?php endif;?>
		<h3 class="section-footer">Organizors promote the topic, bring in more ideas. They will be responsible for the quality of the discussion</h3>
	</section><!-- #topic_organizors -->
</div>



<!-- add post dialog -->
<section id="add_post_dialog">
	<h2 class="topic-title"><?=$topic['title']?></h2>
	<h3 class="topic-date"><?=$topic['chosen_date']?></h3>
	<h3 class="dialog-section-header">
		STORY'S 
		<?php if($tab_selected=='begining'):?>
			BEGINING
		<?php elseif($tab_selected=='development'):?>
			DEVELOPMENT
		<?php elseif($tab_selected=='future'):?>
			FUTURE
		<?php endif;?>
	</h3>
	<h4>Tell us what you know about the begining of the story:<span>history,key reasons and causes</span></h4>
	<textarea id="post_content" rows="5"></textarea>
	<button id="send_post_btn" type="button">Done</button>
</section>

<!-- show post dialog -->
<section id="show_post_dialog">
	<h2 class="topic-title"><?=$topic['title']?></h2>
	<h3 class="topic-date"><?=$topic['chosen_date']?></h3>
	<h3 class="dialog-section-header">
		STORY'S 
		<?php if($tab_selected=='begining'):?>
			BEGINING
		<?php elseif($tab_selected=='development'):?>
			DEVELOPMENT
		<?php elseif($tab_selected=='future'):?>
			FUTURE
		<?php endif;?>
	</h3>
	<div class="single-post">
		<img src="/includes/images/default_medium.png" />
		<div>
			<p>¡°A shooting has occurred at University of California, Berkeley¡ªthe home of some of Silicon Valley's upcoming best and brightest. Syria has faced much criticism over its crackdown that the U.N. says has killed 3,500. But with no sign of compromise, can anyone influence President Bashar Al-Assad? ¡± </p>
			<em class="reply">32 replies</em>
		</div>
	</div>
	<ul class="comments-list">
		<li>
			<img src="/includes/images/default_medium.png" />
			<div>
				<p>¡°A shooting has occurred at University of California, Berkeley¡ªthe home of some of Silicon Valley's upcoming best and brightest. Syria has faced much criticism over its crackdown that the U.N. says has killed 3,500. But with no sign of compromise, can anyone influence President Bashar Al-Assad? ¡± </p>
			</div>
		</li>
	</ul>
	<div class="my-reply">
		<em>MY REPLY</em>
		<textarea id="reply_content"></textarea>
	</div>
	<button id="reply_btn" type="button">Done</button>
</section>