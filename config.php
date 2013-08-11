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
	$pref['twits_header'] 					= $tp->toDB($_POST['header']);
	$pref['twits_username'] 				= $tp->toDB($_POST['username']);
	$pref['twits_show_realname']			= intval($_POST['show_realname']);
	$pref['twits_show_screenname']			= intval($_POST['show_screenname']);
	$pref['twits_show_usericon']			= intval($_POST['show_usericon']);
	$pref['twits_show_userlocation']		= intval($_POST['show_userlocation']);
	$pref['twits_show_userurl']				= intval($_POST['show_userurl']);
	$pref['twits_dateformat'] 				= $tp->toDB($_POST['dateformat']);
	$pref['twits_tweets']					= intval($_POST['tweets']);
    $pref['twits_retweets'] 				= intval($_POST['retweets']);
    $pref['twits_replies'] 					= intval($_POST['replies']);
    $pref['twits_cachetime']				= intval($_POST['cachetime']);
    $pref['twits_oauth_access_token']		= $tp->toDB($_POST['oauth_access_token']);
    $pref['twits_oauth_access_token_secret']= $tp->toDB($_POST['oauth_access_token_secret']);
    $pref['twits_consumer_key'] 			= $tp->toDB($_POST['consumer_key']);
    $pref['twits_consumer_secret'] 			= $tp->toDB($_POST['consumer_secret']);
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
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_19."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='text' class='tbox' name='oauth_access_token' value='".(($pref['twits_oauth_access_token']) ? $pref['twits_oauth_access_token'] : "")."' />
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_20."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='text' class='tbox' name='oauth_access_token_secret' value='".(($pref['twits_oauth_access_token_secret']) ? $pref['twits_oauth_access_token_secret'] : "")."' />
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_21."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='text' class='tbox' name='consumer_key' value='".(($pref['twits_consumer_key']) ? $pref['twits_consumer_key'] : "")."' />
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_22."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='text' class='tbox' name='consumer_secret' value='".(($pref['twits_consumer_secret']) ? $pref['twits_consumer_secret'] : "")."' />
				</td>
			</tr>
			
			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_13."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='show_realname' class='tbox'>
						<option value='0'".($pref['twits_show_realname'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_show_realname'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_14."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='show_screenname' class='tbox'>
						<option value='0'".($pref['twits_show_screenname'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_show_screenname'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_15."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='show_usericon' class='tbox'>
						<option value='0'".($pref['twits_show_usericon'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_show_usericon'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_16."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='show_userlocation' class='tbox'>
						<option value='0'".($pref['twits_show_userlocation'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_show_userlocation'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_17."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='show_userurl' class='tbox'>
						<option value='0'".($pref['twits_show_userurl'] == "0" ? " selected" : "").">".TWITS_CONFIG_06."</option>
						<option value='1'".($pref['twits_show_userurl'] == "1" ? " selected" : "").">".TWITS_CONFIG_07."</option>
					</select>
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_03."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='dateformat' class='tbox'>";

foreach(array('long', 'short', 'forum', 'ago') as $format)
{
	if($format == "ago")
	{
		$text.= 		"<option value='".$format."'".($format == $pref['twits_dateformat'] ? " selected" : "").">".TWITS_CONFIG_12." (".$format.")</option>";
	}
	else
	{
		$text.= 		"<option value='".$format."'".($format == $pref['twits_dateformat'] ? " selected" : "").">".$gen->convert_date(time(), $format)." (".$format.")</option>";
	}
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
				<td style='width:30%' class='forumheader3'>".TWITS_CONFIG_18."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='cachetime' class='tbox'>";

for($i = 10; $i <= 60; $i++)
{
	$text .= 		"<option value='".$i."'".($i == $pref['twits_cachetime'] ? " selected" : "").">".$i."</option>";
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