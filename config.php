<?php
$eplug_admin = TRUE;
require_once('../../class2.php');
if (!getperms('4')) { header('location:'.e_BASE.'index.php'); exit ;}
include_lan(e_PLUGIN.'twits_menu/languages/'.e_LANGUAGE.'.php');
require_once(e_ADMIN.'auth.php');
include_once(e_HANDLER.'date_handler.php');

$gen = new convert();

if(isset($_POST['updatesettings']))
{
	$pref['twits_header'] 		= $tp->toDB($_POST['header']);
	$pref['twits_username'] 	= $tp->toDB($_POST['username']);
	$pref['twits_dateformat'] 	= $tp->toDB($_POST['dateformat']);
	$pref['twits_tweets']		= intval($_POST['tweets']);
    $pref['twits_retweets'] 	= intval($_POST['retweets']);
    $pref['twits_replies'] 		= intval($_POST['replies']);
	save_prefs();
	$message = TWITS_CONFIG_01;
}

if(isset($message)){ $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>"); }

$text = "
<div style='text-align:center'>
	<form action='".e_SELF."' method='post'>
		<table style='width:85%' class='fborder' >
		
			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_11."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='text' class='tbox' name='header' value='".(($pref['twits_header']) ? $pref['twits_header'] : "")."' />
				</td>
			</tr>
			
			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_02."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='text' class='tbox' name='username' value='".(($pref['twits_username']) ? $pref['twits_username'] : "")."' />
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_03."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='dateformat' class='tbox'>";

foreach(array('long', 'short', 'forum') as $format)
{
	$text.= 		"<option value='".$format."'".($format == $pref['twits_dateformat'] ? " selected" : "").">".$gen->convert_date(time(), $format)." (".$format.")</option>";
}

$text .= "
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_04."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='tweets' class='tbox'>";

for($i = 1; $i <= 5; $i++)
{
	$text .= 		"<option value='".$i."'".($i == $pref['twits_tweets'] ? " selected" : "").">".$i."</option>";
}

$text .= "
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_05."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='replies' class='tbox'>
						<option value='0'".($pref['twits_replies'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_replies'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_08."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='retweets' class='tbox'>
						<option value='0'".($pref['twits_retweets'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_retweets'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan='2' class='forumheader' style='text-align: center;'><input class='button' type='submit' name='updatesettings' value='".TWITS_CONFIG_09."' /></td>
			</tr>
		</table>
	</form>
</div>";

$ns->tablerender(TWITS_CONFIG_10, $text);
require_once(e_ADMIN.'footer.php');
?>