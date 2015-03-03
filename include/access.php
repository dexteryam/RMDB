<?php
	/*
		USAGE:
		if( Access::user_has_access_level( Access::SUPER_USER ) )
			do_something();

		Possible arguments:
			Access::LURKER;
			Access::USER;
			Access::SUPER_USER;
			Access::ADMINISTRATOR;
	*/

	class Access
	{
		//Enumeration
		//IF MODIFIED MODIFY IS_VALID_LEVEL FUNCTION.
		const LURKER = 0;
		const USER = 1;
		const SUPER_USER = 2;
		const ADMINISTRATOR = 3;


		private static function is_valid_level( $level )
		{
			return ( $level >= Access::LURKER ) && ( $level <= Access::ADMINISTRATOR );
		}

		private static function get_users_access_level( $user_id )
		{
			$user_id = mysql_real_escape_string( $user_id );
			$query = "SELECT level FROM users WHERE id = '$user_id'";

			$access_level = Db::query_value( $query );
			switch( $access_level )
			{
				case "USER":
					$access_level = Access::USER;
				break;
				case "SUPER_USER":
					$access_level = Access::SUPER_USER;
				break; 
				case "ADMINISTRATOR":
					$access_level = Access::ADMINISTRATOR;
				break; 
				default:
					$access_level = Access::LURKER;
				break;
			}
			return $access_level;
		}

		public static function user_has_access_level( $level )
		{
			if( !Access::is_valid_level( $level ) )
				return false;

			if( !Authenticate::is_user() )
				return $level == Access::LURKER;

			$user_id = Authenticate::get_id();
			$users_Access_level = Access::get_users_access_level( $user_id );

			return $users_Access_level >= $level;
		}

		public static function is_theater_owner()
		{
			$owner_id = Authenticate::get_id();
			$query = 
					"SELECT id ".
					"FROM theaters ".
					"WHERE owner_id='$owner_id'";

			return Db::results_exist( $query );
		}
	};
?>
