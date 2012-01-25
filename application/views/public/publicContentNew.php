<div id="page_wrap" class="clearfix">
	<nav class="top-nav clearfix">
		<a href="#" id="feature_topic_tab" class="section-header">FEATURE TOPICS FOR TODAY</a>
		<a href="#" id="profile_account_tab" class="section-header">QIANXING LU'S ACCOUNT</a>
	</nav>
	<section id="feature_topics" class="clearfix">
		<section id="top_topic">
			<img src="/includes/images/topic.png" />
			<div>
				<a href="#" class="topic-title">CAMPUS SHOOTING AT UC BERKELEY</a>
				<h4 class="topic-date">11/17/2011</h4>
				<p>A shooting has occurred at University of California, Berkeley¡ªthe home of some of Silicon Valley's upcoming best and brightest. Update: Police say they have a suspect in custody. </p>
			</div>
		</section>
		<aside>
		<?php if($feature_topic!=null):?>
			<ul>
			<?php foreach($feature_topic as $topic):?>
				<li>
					<img src="<?=$topic['bg_img']?>" />
					<div>
						<a href="/topics/<?=$topic['tid']?>" class="topic-title"><?=$topic['title']?></a>
					</div>
				</li>
			<?php endforeach;?>
			</ul>
		<?php endif;?>
		</aside>
	</section>
	<section id="topics">
		<nav class="clearfix">
			<a id="following_topics" href="/explore/topics" class="<?php if($tab_selected=='topics'){?>tab-selected<?php }?>">ALL TOPICS - by popularity or by latest</a>
			<a id="suggested_topics" href="/explore/upcoming" class="<?php if($tab_selected=='voting_topics'){?>tab-selected<?php }?>">UPCOMING TOPICS - <em>add my topics</em></a>
		</nav>
		<?php if($tab_selected=='topics'):?>
			<?php if($topics_list!=null):?>
			<ul id="all_topics" class="topics-list clearfix">
				<?php foreach($topics_list as $topic):?>
				<li>
					<img src="<?=$topic['bg_img']?>" />
					<a href="/topics/<?=$topic['tid']?>" class="topic-tile-overlay"></a>
					<div class="topic-tile-info">
						<h3 class="topic-title"><?=$topic['title']?></h3>
						<p><?=$topic['desc']?></p>
					</div>
				</li>
				<?php endforeach;?>
			</ul>
			<div id="all_topics_load_more" class="load-more-btn">Load more</div>
			<?php endif;?>
		<?php endif;?>
		<?php if($tab_selected=='voting_topics'):?>
			<button id="add_topic_btn" type="button">Suggest a topic</button>
			<?php if($topics_list!=null):?>
			<ul id="voting_topics" class="voting-topics-list clearfix">
				<?php foreach($topics_list as $topic):?>
				<li>
					<div class="topic-voting-badget">
						<em><?=$topic['v_num']?></em>
						<button class="vote-btn" data-tid="<?=$topic['tid']?>">Vote</button>
					</div>
					<div class="topic-voting-meta">
						<a href="/topics/<?=$topic['tid']?>" class="topic-title"><?=$topic['title']?></a>
						<p><?=$topic['desc']?></p>
						<p>
							<strong class="username">Frank Biocca</strong> Created in <?=$topic['chosen_time']?>
						</p>
					</div>
				</li>
				<?php endforeach;?>
			</ul>
			<div id="voting_topics_load_more" class="load-more-btn">Load more</div>
			<?php endif;?>
		<?php endif;?>
	</section><!-- #topics -->
	<section id="famous_topizen">
		<h3 href="javascript:;" class="section-header">FAMOUS TOPIZENS</h3>
		<ul class="topizens">
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
	</section><!-- #following -->
</div><!-- #page_wrap -->


<!-- add topic dialog -->
<section id="add_topic_dialog">
	<h3 class="dialog-section-header">SUGGEST A NEW TOPIC</h3>
	<h4>Post your own topics, we will publish them as officaial topics once others vote for it</h4>
	<input id="suggest_topic_title" type="text" placeholder="Topic Title" />
	<textarea id="suggest_topic_desc" rows="2" placeholder="Short description of the topic" /></textarea>
	<h3 class="dialog-section-header">ASSIGN DOMAINS</h3>
	<h4>You can assign up to three domains to this topic</h4>
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
		<button id="add_topic_done_btn" type="button">Done</button>
</section>
