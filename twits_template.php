<?php
global $sc_style;
$sc_style['NO_TWEET_ACCOUNT']['pre'] = "<div style='text-align:center;'><span class='smalltext'>";
$sc_style['NO_TWEET_ACCOUNT']['post'] = "</span></div>";

$TWITS_MENU = "
<div class='forumheader2'>
	{ALL_TWEETS}
	{NO_TWEET_ACCOUNT}
</div>";

$EACH_TWEET = "
<div style='border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: #000; overflow-x: hidden; overflow-y: hidden;'>
{DATESTAMP}<br />
{USERNAME}: {STATUS}<br />
{REPLY} &bull; {RETWEET} &bull; {FAVORITE}
</div>";
?>