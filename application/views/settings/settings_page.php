<ul id="main_tab" class="tab clearfix">
	<li>
		<a href="/settings/account" <?php if($tab_selected=='account'):?> class="selected"<?php endif;?>>Profile</a>
	</li>
	<li>
		<a href="/settings/picture" <?php if($tab_selected=='picture'):?> class="selected" <?php endif;?>>Picture</a>
	</li>
	<li>
		<a href="/settings/password" <?php if($tab_selected=='password'):?> class="selected" <?php endif;?>>Password</a>
	</li>
</ul>
<section class="tab-content"> 
	<?php if($tab_selected=='account'){?>
	<section id="account">
		<form method="post">
			<label for="full_name">Full Name</label>
			<input class="input-field" id="full_name" value="<?=$user['fullname']?>" />
			<label for="self_intro">Introduce Yourself:</label>
			<textarea id="self_intro" rows="5"><?=$user['desc']?></textarea>
			<label for="domain">Your Domain</label>
			http://www.topizen.com/citizens/<input class="input-field" id="domain" value="<?=$sess_domain?>" />
			<button id="user_info_save_btn" type="button" class="blue-btn">Save</button>
		</form>
	</section>
	<?php }elseif($tab_selected=='picture'){?>
	<section id="picture_tab">
		<img id="target" src="/includes/images/img_upload_default.png">
		<input id="ep_img_upload_btn" type="file">
		<button id="user_img_save_btn" type="button" class="blue-btn">Save</button>
		</section>
	
	<?php }elseif($tab_selected=='password'){?>
		<section id="password_tab">
			<label for="old_password">Old Password</label>
			<input id="old_password" />
			<label for="new_password">New Password</label>
			<input id="new_password"/>
			<label for="confirm_password">Confirm Password</label>
			<input id="confirm_password" />
			<button id="password_save_btn" type="button" class="blue-btn">Save</button>
			</div>
		</section>
	<?php }?>
</section>