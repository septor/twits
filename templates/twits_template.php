<?php
$TWITS_TEMPLATE['menu'] = '
<div class="forumheader2">
	<span class="smalltext">
	{USER_ICON}{USER_REALNAME}<br />
	{USER_LOCATION}<br />
	{USER_URL}<br />
	{USER_SCREENNAME}<br />
	{ALL_TWEETS}<br />
	{NO_TWEET_ACCOUNT}
	</span>
</div>';

$TWITS_TEMPLATE['tweet'] = '
<div style="border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: #000; overflow-x: hidden; overflow-y: hidden;">
	<span class="smalltext">
	{USERNAME}: {STATUS}<br />
	{DATESTAMP} &bull; {REPLY} &bull; {RETWEET} &bull; {FAVORITE}
	</span>
</div>'';
?>
