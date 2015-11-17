<?php
$TWITS_TEMPLATE['menu'] = '
{USER_ICON: linkclass=pull-left&imgclass=img-circle}
<div class="media-body">
    <p class="center">
		{USER_REALNAME}<br />
		{USER_LOCATION}<br />
		{USER_DESCRIPTION}<br />
		{USER_URL}
	</p>
	<p class="center">
		Tweets <span class="badge">{USER_TWEETS}</span>
		Following <span class="badge">{USER_FOLLOWING}</span>
		Followers <span class="badge">{USER_FOLLOWERS}</span>
	</p>
</div>
<div class="clearfix"></div>
<hr />
<ul class="media-list">
	{ALL_TWEETS}
</ul>
{NO_TWEET_ACCOUNT}';

$TWITS_TEMPLATE['tweet'] = '
	<li class="media">                                    
		<div class="media-body">
            <span class="text-muted pull-right">
				<small class="text-muted">{DATESTAMP}</small>
            </span>
			<strong class="text-success">@ {USERNAME}</strong>
            <p>
				{STATUS}
			</p>
			<p class="center">
				{REPLY} &bull; {RETWEET} &bull; {FAVORITE}
			</p>
        </div>
	</li>
';
?>
