<?php
	$ROOT = $_SERVER['DOCUMENT_ROOT'].'/';


	include_once('include/db_tools.php');
	include_once('include/tools.php');

	define('FORUM_ROOT','./punbb/');
	require_once FORUM_ROOT.'include/functions.php';
	Db::open();
	
	class Authenticate
	{

		const AUTH_SALT = "0p9o8i7u6y";
		const AUTH_EMAIL_FIELD = "email";
		const AUTH_PASSWORD_FIELD = "password";
		const AUTH_IP_FIELD = "ip_at_login";
		const AUTH_FIELD = "AUTH";

		private static $is_user;
		private static $user_id;
		private static $user_alias;
	
		public static function punbb_authenticate( $username, $password)
		{
			$form_username = $username;
			$form_password = $password;

			$query =
				"SELECT u.id, u.group_id, u.password, u.salt ".
				"FROM punbb_users AS u ".
				"WHERE username = '".mysql_real_escape_string($form_username)."'";
			
			$user_info = Db::query_rows( $query );
			$user_info = $user_info[0];
			$user_id = $user_info['id'];
			$group_id = $user_info['group_id'];
			$db_password_hash = $user_info['password'];
			$salt = $user_info['salt'];
			

			$form_password_hash = forum_hash($form_password, $salt);
			$authorized = $db_password_hash == $form_password_hash;

			if ($authorized)
			{

				$query =
					"DELETE FROM punbb_online ".
					"WHERE ident='".$_SERVER['REMOTE_ADDR']."'";
				Db::delete( $query );

				$expire = time() + 5400;
				forum_setcookie('forum_cookie_c3b112', base64_encode($user_id.'|'.$form_password_hash.'|'.$expire.'|'.sha1($salt.$form_password_hash.forum_hash($expire, $salt))), $expire);
			}
		}

		public static function punbb_kill_session()
		{
			$username = Authenticate::get_alias();
			$query =
					"SELECT id ".
					"FROM punbb_users ".
					"WHERE username = '$username'";

			$user_id = Db::query_value( $query );

			$query =
					"DELETE FROM punbb_online ".
					"WHERE user_id='".$user_id."'";
			Db::delete( $query );

			$expire = time() + 1209600;
			forum_setcookie('forum_cookie_c3b112', base64_encode('1|'.random_key(8, false, true).'|'.$expire.'|'.random_key(8, false, true)), $expire);

			set_tracked_topics(null);
		}


		public static function encrypt( $string )
		{
			return sha1( Authenticate::AUTH_SALT . $string . Authenticate::AUTH_SALT );
		}
		
		private static function is_authentic( $email, $password )
		{
			$email = mysql_real_escape_string($email);
			$password = mysql_real_escape_string(Authenticate::encrypt($password));
			
			$query = "SELECT id FROM users WHERE email='$email' AND password='$password'";
			return Db::results_exist( $query );
		}
		
		private static function begin_session( $email )
		{
			$_SESSION[Authenticate::AUTH_FIELD][Authenticate::AUTH_EMAIL_FIELD] = $email;
			$_SESSION[Authenticate::AUTH_FIELD][Authenticate::AUTH_IP_FIELD] = $_SERVER['REMOTE_ADDR'];
		}

		private static function is_post_authentic()
		{
			if( isset($_POST[Authenticate::AUTH_EMAIL_FIELD]) && isset($_POST[Authenticate::AUTH_PASSWORD_FIELD]) )
				return Authenticate::is_authentic($_POST[Authenticate::AUTH_EMAIL_FIELD], $_POST[Authenticate::AUTH_PASSWORD_FIELD] );
			return false;
		}
		
		private static function is_session_authentic()
		{
			return isset($_SESSION[Authenticate::AUTH_FIELD]) && $_SESSION[Authenticate::AUTH_FIELD]['ip_at_login'] == $_SERVER['REMOTE_ADDR'];
		}
		
		public static function authenticate_user()
		{
			static $has_been_called = false;
			if( $has_been_called )
				return;
			$has_been_called = true;
			
			session_start();
			$is_post_auth = Authenticate::is_post_authentic();
			$is_session_auth = !$is_post_auth && Authenticate::is_session_authentic();
			
			if( $is_post_auth )
				Authenticate::begin_session( $_POST[Authenticate::AUTH_EMAIL_FIELD] );
			
				
			Authenticate::$is_user = $is_post_auth || $is_session_auth;
			Authenticate::$user_id = "";
			if( Authenticate::$is_user )
			{
				$email = mysql_real_escape_string($_SESSION[Authenticate::AUTH_FIELD][Authenticate::AUTH_EMAIL_FIELD]);
				$query = "SELECT id, alias FROM users WHERE email='$email'";
				$result = Db::query_row( $query );
				Authenticate::$user_id = $result['id'];
				Authenticate::$user_alias = $result['alias'];

			}
		}

		public static function was_login_attempted()
		{
			return isset($_POST[Authenticate::AUTH_EMAIL_FIELD]) && isset($_POST[Authenticate::AUTH_PASSWORD_FIELD]);
		}

		public static function redirect_successful_login()
		{
			$login_attempted = Authenticate::was_login_attempted();
			$is_user = Authenticate::is_user();

			if( $login_attempted && $is_user )
			{

				$username = Authenticate::get_alias();
				$username = mysql_real_escape_string($username);
				$password = $_POST[ Authenticate::AUTH_PASSWORD_FIELD ];
				$password = mysql_real_escape_string($password);

				Authenticate::punbb_authenticate( $username, $password );

				$id = Authenticate::get_id();
				$message = "User ($id) logged in.";
				add_to_log($message);
				$url = isset($_GET['url'])?$_GET['url']:"login.php";
				header("Location: ".$url);
				exit();
			}
				
		}
		
		public static function has_login_failed()
		{
			$login_was_attempted = Authenticate::was_login_attempted();
			return !Authenticate::$is_user && $login_was_attempted;
		}
		
		public static function is_user()
		{
			return Authenticate::$is_user;
		}
		
		public static function get_id()
		{
			return Authenticate::$user_id;
		}
		
		public static function get_alias()
		{
			return Authenticate::$user_alias;
		}

        public static function get_email()
        {
            $query = "SELECT email FROM users WHERE id = '" . Authenticate::get_id()."'";
            $email = Db::query_value($query);
            return $email;
        }
		
		public static function kill_session()
		{
			if( !Authenticate::$is_user )
				return;
			
			unset($_SESSION[Authenticate::AUTH_FIELD]);
			Authenticate::punbb_kill_session();
		}
	}
	
?>
