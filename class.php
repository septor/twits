<?php
function parseContent($text)
{
	$text = strip_tags($text);
	$text = preg_replace("/(https?:\/\/[^\s\)]+)/", "<a href='\\1'>\\1</a>", $text);
	$text = preg_replace("/\#([^\s\ \:\.\;\-\,\!\)\(\"]+)/", "<a href='http://search.twitter.com/search?q=%23\\1'>#\\1</a>", $text);
	$text = preg_replace("/\@([^\s\ \:\.\;\-\,\!\)\(\"]+)/", "<a href='http://twitter.com/\\1'>@\\1</a>", $text);
	return $text;
}
?>