<?php

/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org)
+----------------------------------------------------------------------------+
*/

$eplug_admin = TRUE;
require_once("../../class2.php");
if (!getperms("4")) { header("location:".e_BASE."index.php"); exit ;}
include_lan(e_PLUGIN."twits_menu/languages/".e_LANGUAGE.".php");
require_once(e_ADMIN."auth.php");

if ($_POST['update_menu']) {
	unset($menu_pref['twits_menu']);
	$menu_pref['twits_menu'] = $_POST['pref'];
	$tmp = addslashes(serialize($menu_pref));
	$sql->db_Update("core", "e107_value='$tmp' WHERE e107_name='menu_pref' ");
	$ns->tablerender("", "<div style=\'text-align:center\'><b>".TWITS_LAN001."</b></div>");
}

$text = "
	<div style='text-align:center'>
	<form action='".e_SELF."?".e_QUERY."' method='post'>
	<table style='width:85%' class='fborder' >

	<tr>
	<td style='width:30%' class='forumheader3'>".TWITS_LAN002."</td>
	<td style='width:70%' class='forumheader3'>
	<input type='text' class='tbox' name='pref[username]' value='".(($menu_pref['twits_menu']['username']) ? $menu_pref['twits_menu']['username'] : "")."' />
	</td>
	</tr>

	<tr>
	<td colspan='2' class='forumheader' style='text-align: center;'><input class='button' type='submit' name='update_menu' value='".TWITS_LAN003."' /></td>
	</tr>
	</table>
	</form>
	</div>
	";

$ns->tablerender(TWITS_LAN004, $text);

require_once(e_ADMIN."footer.php");

?>
