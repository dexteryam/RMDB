<?php
	include_once("include/header.php");
	include_once("lib/recaptcha/recaptchalib.php");

	class Signup_Form
	{
		//I AM NOT USING CONSTANTS HERE BECAUSE SOME OF THESE VARIABLES ARE DEFINED
		//AS THE CONCATENATION OF OTHER VARIABLES AND PHP DOESN'T ALLOW THE ASSIGNMENT
		//OF EXPRESSIONS TO CONSTANTS.	

		//Length definitions
		private static $MIN_PASSWORD_LENGTH;
		private static $MIN_ALIAS_LENGTH;
		private static $MAX_ALIAS_LENGTH;

		//Field definitions
		private static $FIELD_ALIAS;
		private static $FIELD_EMAIL;
		private static $FIELD_CONFIRM_EMAIL;
		private static $FIELD_PASSWORD;
		private static $FIELD_CONFIRM_PASSWORD;

		//Error enumeration
		private static $ERROR_INVALID_FORM;
		private static $ERROR_ALIAS_LENGTH;
		private static $ERROR_ALIAS_UNIQUE;
		private static $ERROR_PASSWORD_LENGTH;
		private static $ERROR_PASSWORD_MATCH;
		private static $ERROR_EMAIL_UNIQUE;
		private static $ERROR_EMAIL_MATCH;
		private static $ERROR_EMAIL_INVALID;
		private static $ERROR_CAPTCHA;

		//Error text
		private static $ERROR_TEXT_INVALID_FORM;
		private static $ERROR_TEXT_ALIAS_LENGTH;
		private static $ERROR_TEXT_ALIAS_UNIQUE;
		private static $ERROR_TEXT_PASSWORD_LENGTH;
		private static $ERROR_TEXT_PASSWORD_MATCH;
		private static $ERROR_TEXT_EMAIL_UNIQUE;
		private static $ERROR_TEXT_EMAIL_MATCH;
		private static $ERROR_TEXT_EMAIL_INVALID;
		private static $ERROR_TEXT_CAPTCHA;

		public static function define_constants()
		{
			//Length definitions
			Signup_Form::$MIN_PASSWORD_LENGTH = 6;
			Signup_Form::$MIN_ALIAS_LENGTH = 3;
			Signup_Form::$MAX_ALIAS_LENGTH = 40;

			//Field definitions
			Signup_Form::$FIELD_ALIAS = "signup_alias";
			Signup_Form::$FIELD_EMAIL = "signup_email";
			Signup_Form::$FIELD_CONFIRM_EMAIL = "signup_confirm_email";
			Signup_Form::$FIELD_PASSWORD = "signup_password";
			Signup_Form::$FIELD_CONFIRM_PASSWORD = "signup_confirm_password";

			//Error enumeration
			Signup_Form::$ERROR_INVALID_FORM = 0;
			Signup_Form::$ERROR_ALIAS_LENGTH = 1;
			Signup_Form::$ERROR_ALIAS_UNIQUE = 2;
			Signup_Form::$ERROR_PASSWORD_LENGTH = 3;
			Signup_Form::$ERROR_PASSWORD_MATCH = 4;
			Signup_Form::$ERROR_EMAIL_UNIQUE = 5;
			Signup_Form::$ERROR_EMAIL_MATCH = 6;
			Signup_Form::$ERROR_EMAIL_INVALID = 7;
			Signup_Form::$ERROR_CAPTCHA = 8;

			//Error text
			Signup_Form::$ERROR_TEXT_INVALID_FORM = "You did not use the signup form created by us.";
			Signup_Form::$ERROR_TEXT_ALIAS_LENGTH = "You must enter an alias between ".
									   Signup_Form::$MIN_ALIAS_LENGTH.
									   " and ".Signup_Form::$MAX_ALIAS_LENGTH.
									   " characters long.";

			Signup_Form::$ERROR_TEXT_ALIAS_UNIQUE = "The alias you entered has been used before.";
			Signup_Form::$ERROR_TEXT_PASSWORD_LENGTH = "You must enter a password of ".Signup_Form::$MIN_PASSWORD_LENGTH." characters.";
			Signup_Form::$ERROR_TEXT_PASSWORD_MATCH = "The passwords entered did not match.";
			Signup_Form::$ERROR_TEXT_EMAIL_UNIQUE = "The email you entered has been used before.";
			Signup_Form::$ERROR_TEXT_EMAIL_MATCH = "The emails you entered did not match.";
			Signup_Form::$ERROR_TEXT_EMAIL_INVALID = "The email you entered was not a valid format.";
			Signup_Form::$ERROR_TEXT_CAPTCHA = "You failed the captcha.";
		}

		private static function is_email_unique( $email )
		{
			$email = mysql_real_escape_string( $email );
			$query = "SELECT id FROM users WHERE UPPER(email)=UPPER('$email')";
			return !Db::results_exist( $query );
		}
		
		private static function is_alias_unique( $alias )
		{
			$alias = mysql_real_escape_string( $alias );
			$query = "SELECT id FROM users WHERE UPPER(alias)=UPPER('$alias')";
			return !Db::results_exist( $query );
		}
		
		private static function has_passed_captcha()
		{
			$private_key = "6Leh2MwSAAAAABpO7rEIh4Fym1mzFPLwoSwmwPvg";
			$response = recaptcha_check_answer ($private_key,
			                            		$_SERVER["REMOTE_ADDR"],
			                            		$_POST["recaptcha_challenge_field"],
			                            		$_POST["recaptcha_response_field"]);

			return $response->is_valid;
		}

		public static function get_signup_errors()
		{
			$errors = array();
			$all_fields_are_set = isset($_POST[Signup_Form::$FIELD_ALIAS]);
			$all_fields_are_set &= isset($_POST[Signup_Form::$FIELD_EMAIL]);
			$all_fields_are_set &= isset($_POST[Signup_Form::$FIELD_CONFIRM_EMAIL]);
			$all_fields_are_set &= isset($_POST[Signup_Form::$FIELD_PASSWORD]);
			$all_fields_are_set &= isset($_POST[Signup_Form::$FIELD_CONFIRM_PASSWORD]);
			
			//Someone tried submitting a malformed form.
			if( !$all_fields_are_set )
			{
				$errors[Signup_Form::$ERROR_INVALID_FORM] = Signup_Form::$ERROR_TEXT_INVALID_FORM;
				return $errors;
			}
			
			$alias = $_POST[Signup_Form::$FIELD_ALIAS];
			$email = $_POST[Signup_Form::$FIELD_EMAIL];
			$confirm_email = $_POST[Signup_Form::$FIELD_CONFIRM_EMAIL];
			$password = $_POST[Signup_Form::$FIELD_PASSWORD];
			$confirm_password = $_POST[Signup_Form::$FIELD_CONFIRM_PASSWORD];

			if( strlen($alias) < Signup_Form::$MIN_ALIAS_LENGTH || strlen($alias) > Signup_Form::$MAX_ALIAS_LENGTH )
				$errors[Signup_Form::$ERROR_ALIAS_LENGTH] = Signup_Form::$ERROR_TEXT_ALIAS_LENGTH;
			if( !Signup_Form::is_alias_unique( $alias ) )
				$errors[Signup_Form::$ERROR_ALIAS_UNIQUE] = Signup_Form::$ERROR_TEXT_ALIAS_UNIQUE;
				
			if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
				$errors[Signup_Form::$ERROR_EMAIL_INVALID] = Signup_Form::$ERROR_TEXT_EMAIL_INVALID;
			if( !Signup_Form::is_email_unique( $email ) )
				$errors[Signup_Form::$ERROR_EMAIL_UNIQUE] = Signup_Form::$ERROR_TEXT_EMAIL_UNIQUE;
			if( $email != $confirm_email )
				$errors[Signup_Form::$ERROR_EMAIL_MATCH] = Signup_Form::$ERROR_TEXT_EMAIL_MATCH;
			
				
			if( strlen($password) < Signup_Form::$MIN_PASSWORD_LENGTH )
				$errors[Signup_Form::$ERROR_PASSWORD_LENGTH] = Signup_Form::$ERROR_TEXT_PASSWORD_LENGTH;
			if( $password != $confirm_password )
				$errors[Signup_Form::$ERROR_PASSWORD_MATCH] = Signup_Form::$ERROR_TEXT_PASSWORD_MATCH;

			if( !Signup_Form::has_passed_captcha() )
				$errors[Signup_Form::$ERROR_CAPTCHA] = Signup_Form::$ERROR_TEXT_CAPTCHA;
				
				
			return $errors;
		}
		
		public static function print_errors( $errors )
		{
			if( !isset( $errors ) )
				return;

			foreach( $errors as $error )
				print $error."<br/>";
		}
		
		public static function was_form_submitted()
		{
			return count($_POST) > 0;
		}
		
		public static function upload_new_user()
		{
			$alias = mysql_real_escape_string($_POST[Signup_Form::$FIELD_ALIAS]);
			$email = mysql_real_escape_string($_POST[Signup_Form::$FIELD_EMAIL]);
			$dirty_pass = $_POST[Signup_Form::$FIELD_PASSWORD];
			$password = Authenticate::encrypt($dirty_pass);

			$message = "New user ($alias) signed up.";
			add_to_log($message);

			$query = "INSERT INTO users (alias, email, password) VALUES ('$alias','$email','$password')";
			Db::insert($query);

			$salt = random_key(12);
			$password_hash = mysql_real_escape_string(forum_hash($dirty_pass, $salt));
			$salt = mysql_real_escape_string( $salt );

			$user_info = 
			array(
				'username'				=>	$alias,
				'group_id'				=>	'3',
				'salt'					=>	$salt,
				'password'				=>	'test',
				'password_hash'			=>	$password_hash,
				'email'					=>	$email,
				'email_setting'			=>	'1',
				'timezone'				=>	'0',
				'dst'					=>	'0',
				'language'				=>	'English',
				'style'					=>	'Oxygen',
				'registered'			=>	time(),
				'registration_ip'		=>	$_SERVER['REMOTE_ADDR'],
				'activate_key'			=>	NULL,
				'require_verification'	=>	false,
				'notify_admins'			=>	false);

			$query =
			'INSERT INTO punbb_users (username, group_id, password, email, email_setting, timezone, dst, language, style, registered, registration_ip, last_visit, salt, activate_key) '.
			'VALUES ('.
			"'".$user_info['username']."',".
			"'".$user_info['group_id']."',".
			"'".$user_info['password_hash']."',".
			"'".$user_info['email']."',".
			"'".$user_info['email_setting']."',".
			"'".floatval($user_info['timezone'])."',".
			"'".$user_info['dst']."',".
			"'".$user_info['language']."',".
			"'".$user_info['style']."',".
			"'".$user_info['registered']."',".
			"'".$user_info['registration_ip']."',".
			"'".$user_info['registered']."',".
			"'".$user_info['salt']."',".
			"'".$user_info['activate_key']."')";

			Db::insert( $query );

		}
		

		public static function print_form( $errors )
		{
			$alias = isset( $_POST[Signup_Form::$FIELD_ALIAS] )?$_POST[Signup_Form::$FIELD_ALIAS]:"";
			$email = isset( $_POST[Signup_Form::$FIELD_EMAIL] )?$_POST[Signup_Form::$FIELD_EMAIL]:"";
			$confirm_email = isset( $_POST[Signup_Form::$FIELD_CONFIRM_EMAIL] )?$_POST[Signup_Form::$FIELD_CONFIRM_EMAIL]:"";

			$alias_error = "";
			$email_error = "";
			$password_error = "";
			$captcha_error = "";

			//Alias Errors
			if( array_key_exists( Signup_Form::$ERROR_ALIAS_UNIQUE, $errors ) )
			{
				$alias = "";
				$alias_error = $errors[Signup_Form::$ERROR_ALIAS_UNIQUE];
			}
			else if( array_key_exists( Signup_Form::$ERROR_ALIAS_LENGTH, $errors ) )
				$alias_error = $errors[Signup_Form::$ERROR_ALIAS_LENGTH];
			
			//Email Errors
			if( array_key_exists( Signup_Form::$ERROR_EMAIL_UNIQUE, $errors ) )
			{
				$email = "";
				$confirm_email = "";
				$email_error = $errors[Signup_Form::$ERROR_EMAIL_UNIQUE];
			}
			else if( array_key_exists( Signup_Form::$ERROR_EMAIL_MATCH, $errors ) )
			{
				$confirm_email = "";
				$email_error = $errors[Signup_Form::$ERROR_EMAIL_MATCH];
			}
			else if( array_key_exists( Signup_Form::$ERROR_EMAIL_INVALID, $errors ) )
			{
				$email = "";
				$confirm_email = "";
				$email_error = $errors[Signup_Form::$ERROR_EMAIL_INVALID];
			}

			//Password Errors
			if( array_key_exists( Signup_Form::$ERROR_PASSWORD_LENGTH, $errors ) )
				$password_error = $errors[Signup_Form::$ERROR_PASSWORD_LENGTH];
			else if( array_key_exists( Signup_Form::$ERROR_PASSWORD_MATCH, $errors ) )
				$password_error = $errors[Signup_Form::$ERROR_PASSWORD_MATCH];

			//Captcha Error
			if( array_key_exists( Signup_Form::$ERROR_CAPTCHA, $errors ) )
				$captcha_error = $errors[Signup_Form::$ERROR_CAPTCHA];


			
			$recaptcha_publickey = "6Leh2MwSAAAAAMAiRE0tqLhYsbSTKsEtVwNbed3s"; // you got this from the signup page
	
			print
			"<form method=\"post\" action=\"signup.php\" style=\"width: 400px\">\n".
			"	<h1>SIGNUP</h1>".
			"	<label>Alias:</label>\n".
			"	<div id=\"error\">$alias_error</div>\n".
			"	<input type=\"text\" name=\"".Signup_Form::$FIELD_ALIAS."\" value=\"$alias\"/>\n".
			"	<label>Email:</label>\n".
			" 	<div id=\"error\">$email_error</div>\n".
			"	<input type=\"text\" name=\"".Signup_Form::$FIELD_EMAIL."\" value=\"$email\"/>\n".
			"	<label>Confirm Email:</label>\n".
			"	<input type=\"text\" name=\"".Signup_Form::$FIELD_CONFIRM_EMAIL."\" value=\"$confirm_email\"/>\n".
			"	<label>Password:</label>\n".
			"	<div id=\"error\">$password_error</div>\n".
			"	<input type=\"password\" name=\"".Signup_Form::$FIELD_PASSWORD."\"/>\n".
			"	<label>Confirm Password:</label>\n".
			"	<input type=\"password\" name=\"".Signup_Form::$FIELD_CONFIRM_PASSWORD."\"/><br/>\n".
			recaptcha_get_html($recaptcha_publickey).
			"<div id=\"error\">".$captcha_error."</div><br/>".
			"	<input type=\"submit\" id=\"button\"/>".
			"</form>";
		}
	}
	Signup_Form::define_constants();

	$signed_up = false;
	$errors = array();
	if( Signup_Form::was_form_submitted() )
	{
		$errors = Signup_Form::get_signup_errors();

		if( count( $errors ) == 0 )
		{
			Signup_Form::upload_new_user();
			$signed_up = true;
		}
	}


	if( !$signed_up )
		Signup_Form::print_form( $errors );
	else
		print "You have successfully signed up. You may now login.";
 

	include_once("include/footer.php");
 ?>