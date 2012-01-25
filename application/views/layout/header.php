<header>
	<div class="inside">
		<a class="sm-logo" href="/explore"></a>
		<form id="search">
			<input type="text" name="keyword" value="search topizen or topic" />
		</form>
		<nav class="clearfix">
			<ul id="main_nav">
				<li><a href="/explore">Home</a></li>
				<li><a href="/citizens/<?=$sess_domain?>">Profile</a></li>
				<li><a href="/topics/suggest">Suggest</a></li>
			</ul>
			<ul id="current_user_nav">
				<li><a class="menu-item-avatar" href="/citizens/<?=$sess_domain?>"><img src="/includes/upload/4eb19bd284409koala.jpg"><span><?=$sess_domain?></span></a></li>
				<li class="menu-item"><a href="/settings">Setting</a></li>
				<li class="menu-item"><a href="/index.php/user/log_out">Sign out</a></li>
			</ul>
		</nav>
		<a href="/citizens/<?=$sess_domain?>" class="personal-entry"></a>
		<a href="/explore" class="public-entry"></a>
	</div>
</header>