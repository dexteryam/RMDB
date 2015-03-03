<?php
	include_once("include/header.php");
	
	class Set_Access_Level
	{
		
		public static function was_form_submitted()
		{
			return count($_POST) > 0;
		}
		
		public static function is_valid_input()
		{
			$uid = isset($_POST['uid'])?$_POST['uid']:"";
			$level = isset($_POST['level'])?$_POST['level']:"";
			$critic = isset($_POST['critic'])?$_POST['critic']:"";
			
			$is_any_empty = ($uid == "") || ($level == "") || ($critic == "");

			if( $is_any_empty )
				return false;

			$is_uid = Db::is_user( $uid );
			if( !$is_uid )
				return false;

			return true;
		}

		public static function upload_data()
		{	
			if( !Set_Access_Level::is_valid_input() )
				return;

			$uid = mysql_real_escape_string(isset($_POST['uid'])?$_POST['uid']:"");
			$level = mysql_real_escape_string(isset($_POST['level'])?$_POST['level']:"");
			$critic = mysql_real_escape_string(isset($_POST['critic'])?$_POST['critic']:"");

			$query = 
				"UPDATE users ".
				"SET level='$level', critic='$critic' ".
				"WHERE id='$uid'";
			Db::insert($query);
		}
		

		public static function print_levels_menu()
		{
			$levels = Db::get_all_theater_ids();

			print 
			"<select name=\"level\" id=\"default_select\">\n".
			"	<option value=\"USER\">USER</option>\n".
			"	<option value=\"SUPER_USER\">SUPER USER</option>\n".
			"	<option value=\"ADMINISTRATOR\">ADMINISTRATOR</option>\n".
			"</select>\n";	
		}

		public static function print_users_menu()
		{
			$uids = Db::get_all_user_ids();

			print "<select name=\"uid\" id=\"default_select\">\n";
			foreach( $uids as $uid )
			{
				if( $uid == Authenticate::get_id() )
					continue;
				$u_info = Db::get_user_info( $uid );
				$alias = $u_info['alias'];
				print 
					"	<option value=\"$uid\">($uid) $alias</option>\n";
			}
			print "</select>\n";	
		}
		
		public static function print_critic_option()
		{
			print "<select name=\"critic\" id=\"default_select\">";
			print 
					"	<option value=\"N\">No</option>\n" .
					"	<option value=\"Y\">Yes</option>\n";
			print "</select><br/>";
		}

		public static function print_form()
		{
			print
			"<form method=\"post\" action=\"set_access_level.php\" style=\"width: 400px\">\n".
			"	<h1>SET ACCESS LEVEL</h1>".
			"	<label>User:</label>\n";
			Set_Access_Level::print_users_menu();
			print
			"	<label>Level:</label>\n";
			Set_Access_Level::print_levels_menu();
			print
			"   <label>Is this user a critic?</label>";
			Set_Access_Level::print_critic_option();
			print
			"	<input type=\"submit\" id=\"button\"/>".
			"</form>";
		}
	}

	if( Access::user_has_access_level(Access::ADMINISTRATOR) )
	{
		if( Set_Access_Level::was_form_submitted() )
		{
			Set_Access_Level::upload_data();
			if( Set_Access_Level::is_valid_input() )
			{
				print
					'<div id="full_width_content_bar">'.
					"You've assigned the user a new access level.".
					'</div>';
			}
		}
		Set_Access_Level::print_form();
	}
 
	include_once("include/footer.php");
 ?>