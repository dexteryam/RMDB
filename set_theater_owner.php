<?php
	include_once("include/header.php");
	
	class Set_Theater_Owner
	{
		
		public static function was_form_submitted()
		{
			return count($_POST) > 0;
		}
		
		public static function is_valid_input()
		{
			$uid = isset($_POST['uid'])?$_POST['uid']:"";
			$tid = isset($_POST['tid'])?$_POST['tid']:"";

			$is_any_empty = ($uid == "") || ($tid == "");

			if( $is_any_empty )
				return false;

			$is_uid = Db::is_user( $uid );
			$is_tid = Db::is_theater( $tid );
			if( !$is_uid || !$is_tid )
				return false;

			return true;
		}

		public static function upload_data()
		{	
			if( !Set_Theater_Owner::is_valid_input() )
				return;

			$uid = mysql_real_escape_string(isset($_POST['uid'])?$_POST['uid']:"");
			$tid = mysql_real_escape_string(isset($_POST['tid'])?$_POST['tid']:"");


			$query = 
				"UPDATE theaters ".
				"SET owner_id='$uid' ".
				"WHERE id='$tid'";
			Db::insert($query);
		}
		

		public static function print_theaters_menu()
		{
			$tids = Db::get_all_theater_ids();

			print "<select name=\"tid\" id=\"default_select\">\n";
			foreach( $tids as $tid )
			{
				$t_info = Db::get_theater_info( $tid );
				$name = $t_info['name'];
				print 
					"	<option value=\"$tid\">$name</option>\n";
			}
			print "</select>\n";	
		}

		public static function print_users_menu()
		{
			$uids = Db::get_all_user_ids();

			print "<select name=\"uid\" id=\"default_select\">\n";
			foreach( $uids as $uid )
			{
				$u_info = Db::get_user_info( $uid );
				$alias = $u_info['alias'];
				print 
					"	<option value=\"$uid\">($uid) $alias</option>\n";
			}
			print "</select>\n";	
		}

		public static function print_form()
		{
			print
			"<form method=\"post\" action=\"set_theater_owner.php\" style=\"width: 400px\">\n".
			"	<h1>SET THEATER OWNER</h1>".
			"	<label>Theater:</label>\n";
			Set_Theater_Owner::print_theaters_menu();
			print
			"	<label>Owner:</label>\n";
			Set_Theater_Owner::print_users_menu();
			print
			"	<input type=\"submit\" id=\"button\"/>".
			"</form>";
		}
	}

	if( Access::user_has_access_level(Access::ADMINISTRATOR) )
	{
		if( Set_Theater_Owner::was_form_submitted() )
		{
			Set_Theater_Owner::upload_data();
			if( Set_Theater_Owner::is_valid_input() )
			{
				print
					'<div id="full_width_content_bar">'.
					"You've assigned the theater a new owner.".
					'</div>';
			}
		}
		Set_Theater_Owner::print_form();
	}
 
	include_once("include/footer.php");
 ?>