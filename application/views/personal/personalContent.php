<input id="uid" type="hidden" value="<?=$user_info['uid']?>" />
<input id="domain" type="hidden" value="<?=$domain?>" />
<a href="/orginazor" class="admin-nav">Go to your topic editing page</a>
<div id="page_wrap" class="clearfix">
	<section id="main">
		<section id="posts">
			<a href="/settings" class="section-header"><?=$user_info['fullname']?>'S ACCOUNT</a>
			<div id="posts_list">
			<?php if(!empty($posts_list['item'])):?>
				<ul class="posts">
				<?php foreach($posts_list['item'] as $post):?>
					<li>
						<a href="/citizens/<?=$post['author']['domain']?>"><img src="<?=$post['author']['image']?>" /></a>
						<section>
							<a href="/citizens/<?=$post['author']['domain']?>"><?=$post['author']['domain']?></a>
							<p><?=$post['content']?></p>
							<p><?=$post['time']?></p>
						</section>
					</li>	
				<?php endforeach;?>
				</ul>
				<?php else:?>
					<p class="no-data-txt">We expect you to be the first</p>
				<?php endif;?>
			</div>
		</section><!-- #posts -->
		<section id="topics">
			<nav>
				<a id="following_topics" href="/citizens/<?=$domain?>/my_topics" class="<?php if($tab_selected=='my_topics'){?>tab-selected<?php }?>">MY TOPICS</a>
				<a id="suggested_topics" href="#" class="">I SUGGESTED (23)</a>
			</nav>
			<?php if($tab_selected=='my_topics'):?>
			<ul class="topics-list">
				<?php if($topics_list!=NULL):?>
				<?php foreach($topics_list as $topic):?>
				<li>
					<img src="<?=$topic['bg_img']?>" />
					<div class="topic-tile-overlay"></div>
					<div class="topic-tile-info">
						<h3 class="topic-title"><?=$topic['title']?></h3>
						<p><?=$topic['desc']?></p>
					</div>
				</li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
			<?php endif;?>
		</section><!-- #topics -->
	</section>
	<aside>
		<section id="profile">
			<img src="<?=$user_info['image']?>" />
			<div>
				Followed by <em>2132</em><br />
				<em>21312</em> ideas<br />
				<button id="edit_profile_btn">Edit</button>
			</div>
			<?php if($on_my_page==false):?>
				<?php if($is_following):?>
					<button class="unfollow-user" data-uid="<?=$user_info['uid']?>" type="button">Unfollow</button>
				<?php else:?>
					<a href="#" class="follow-user-btn">
					  <span></span>
					  <em>FOLLOW THI PERSONAL</em>
					</a>
					<button class="follow-user" data-uid="<?=$user_info['uid']?>" type="button">Follow</button>
				<?php endif;?>
			<?php endif;?>
		</section><!-- #profile -->
		<section id="following">
			<h3 href="javascript:;" class="section-header">I AM FOLLOWING<span>(<?=$followings_list['count']?>)</span></h3>
			<?php if(isset($followings_list)):?>
			<ul class="topizens">
				<?php foreach($followings_list['item'] as $user):?>
					<li>
						<img src="<?=$user['image']?>" />
						<section>
							<a href="/citizens/<?=$user['domain']?>"><?=$user['fullname']?></a>
							<p><em class="num-highlight">2312</em> ideas</p>
						</section>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="view-all">VIEW ALL ( <?=$followings_list['count']?> )</div>
			<?php else:?>
				<p class="no-data-txt"><?=$domain?> hasn't followed anyone yet</p>
			<?php endif;?>
		</section><!-- #following -->
	</aside>
</div>



<!-- following dialog -->
<section id="following_dialog">
	<h3 class="dialog-section-header">I AM FOLLOWING (23)</h3>
	<ul class="topizens clearfix">
		<li>
			<img src="/includes/images/default_medium.png" />
			<section>
				<a href="/citizens/bosai">Bosai Chen</a>
				<p><em class="num-highlight">2312</em> ideas</p>
			</section>
		</li>
		<li>
			<img src="/includes/images/default_medium.png" />
			<section>
				<a href="/citizens/bosai">Bosai Chen</a>
				<p><em class="num-highlight">2312</em> ideas</p>
			</section>
		</li>
		<li>
			<img src="/includes/images/default_medium.png" />
			<section>
				<a href="/citizens/bosai">Bosai Chen</a>
				<p><em class="num-highlight">2312</em> ideas</p>
			</section>
		</li>
		<li>
			<img src="/includes/images/default_medium.png" />
			<section>
				<a href="/citizens/bosai">Bosai Chen</a>
				<p><em class="num-highlight">2312</em> ideas</p>
			</section>
		</li>
		<li>
			<img src="/includes/images/default_medium.png" />
			<section>
				<a href="/citizens/bosai">Bosai Chen</a>
				<p><em class="num-highlight">2312</em> ideas</p>
			</section>
		</li>
	</ul>
	<button type="button">OK</button>
</section>

<!-- edit profile dialog -->
<section id="edit_profile_dialog">
	<ul class="clearfix">
		<li>BASIC INFORMATION</li>
		<li>TOPIC AREAS</li>
		<li>ACCOUNT INFORMATION</li>
	</ul>
	<section id="basic_info" style="display:none">
		<input type="text" placeholder="Your name" />
		<button type="button">Done</button>
	</section>
	<section id="topic_area" style="display:block">
		<h4>You can select 3 main topic areas that interest you</h4>
		<ul class="topic-domains clearfix">
			<li>
				<span class="politics-sqr"></span>
				<strong>Politics</strong>
			</li>
			<li>
				<span class="biz-sqr"></span>
				<strong>Business</strong>
			</li>
			<li>
				<span class="culture-sqr"></span>
				<strong>Culture</strong>
			</li>
			<li>
				<span class="edu-sqr"></span>
				<strong>Education</strong>
			</li>
			<li>
				<span class="sports-sqr"></span>
				<strong>Sports</strong>
			</li>
			<li>
				<span class="tech-sqr"></span>
				<strong>Techno.</strong>
			</li>
			<li>
				<span class="fashion-sqr"></span>
				<strong>Fashion</strong>
			</li>
			<li>
				<span class="living-sqr"></span>
				<strong>Living</strong>
			</li>
			<li>
				<span class="celebrity-sqr"></span>
				<strong>Celebrity</strong>
			</li>
		</ul>
	</section>
	
	<section id="account_info" style="display:none">
		<div>
			<input type="text" placeholder="Email Address"/>
			<button type="button">Save</button>
		</div>
		<input type="text" placeholder="Old password"/>
		<input type="text" placeholder="New password"/>
		<input type="text" placeholder="Confirm new password"/>
		<button type="button">Save</button>
	</section>
	
</section>