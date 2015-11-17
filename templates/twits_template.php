<?php
$TWITS_TEMPLATE['menu'] = '
{NO_TWEET_ACCOUNT}
{USER_ICON: linkclass=pull-left&imgclass=img-circle}
<div class="media-body">
    <p class="center">
		{USER_REALNAME}<br />
		{USER_LOCATION}<br />
		{USER_DESCRIPTION}<br />
		{USER_URL}
	</p>
	<div class="btn-group btn-group-xs" role="group" aria-label="...">
		<button class="btn btn-default" type="button">
			tweets <span class="badge">{USER_TWEETS}</span>
		</button>
		<button class="btn btn-default" type="button">
			following <span class="badge">{USER_FOLLOWING}</span>
		</button>
		<button class="btn btn-default" type="button">
			followers <span class="badge">{USER_FOLLOWERS}</span>
		</button>
	</div>
</div>
<div class="clearfix"></div>
<hr />
<ul class="media-list">
	{ALL_TWEETS}
</ul>';

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
			<p class="right">
				{REPLY} &nbsp; {RETWEET} &nbsp; {FAVORITE}
			</p>
        </div>
		<hr />
	</li>
';
?>
