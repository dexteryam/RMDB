<?php
	include_once("include/header.php");
	
	class Add_Theaters
	{
		
		public static function was_form_submitted()
		{
			return count($_POST) > 0;
		}
		
		public static function is_valid_input()
		{
			$name = isset($_POST['name'])?$_POST['name']:"";
			$phone_number = isset($_POST['phone_number'])?$_POST['phone_number']:"";
			$city = isset($_POST['city'])?$_POST['city']:"";
			$state = isset($_POST['state'])?$_POST['state']:"";
			$address = isset($_POST['address'])?$_POST['address']:"";
			$zipcode = isset($_POST['zipcode'])?$_POST['zipcode']:"";

			$is_any_empty = ($name == "") || ($phone_number == "") || ($city == "");
			$is_any_empty |= ($state == "") || ($address == "") || ($zipcode == "");

			if( $is_any_empty )
				return false;

			if( !is_numeric($zipcode) )
				return false;

			return true;
		}

		public static function upload_data()
		{	
			if( !Add_Theaters::is_valid_input() )
				return;

			$name = mysql_real_escape_string($_POST['name']);
			$phone_number = mysql_real_escape_string($_POST['phone_number']);
			$city = mysql_real_escape_string($_POST['city']);
			$state = mysql_real_escape_string($_POST['state']);
			$address = mysql_real_escape_string($_POST['address']);
			$zipcode = mysql_real_escape_string($_POST['zipcode']);

			$lat_lng = get_lat_lng( $zipcode );
			$lat = $lat_lng['lat'];
			$lng = $lat_lng['lng'];

			$query = "INSERT INTO theaters (name, phone_number, city, state, address, zipcode, lat, lng) VALUES ('$name','$phone_number','$city','$state','$address','$zipcode', '$lat', '$lng')";
			Db::insert($query);
		}
		

		public static function print_form()
		{

			$error = "";
			if( Add_Theaters::was_form_submitted() )
			{
				if( !Add_Theaters::is_valid_input() )
					$error = 
						'<div id="error">'.
						'	You entered invalid data.'.
						'</div>';
			}

			$name = isset($_POST['name'])?$_POST['name']:"";
			$phone_number = isset($_POST['phone_number'])?$_POST['phone_number']:"";
			$city = isset($_POST['city'])?$_POST['city']:"";
			$state = isset($_POST['state'])?$_POST['state']:"";
			$address = isset($_POST['address'])?$_POST['address']:"";
			$zipcode = isset($_POST['zipcode'])?$_POST['zipcode']:"";

			if( Add_Theaters::was_form_submitted() && Add_Theaters::is_valid_input() )
			{
				$name = "";
				$phone_number = "";
				$city = "";
				$state = "";
				$address = "";
				$zipcode = "";
			}

			print
			"<form method=\"post\" action=\"add_theater.php\" style=\"width: 400px\">\n".
			"	<h1>ADD THEATER</h1>".
			$error.
			"	<label>Name:</label>\n".
			"	<input type=\"text\" name=\"name\" value=\"$name\" maxlength=\"60\"/>\n".
			"	<label>Phone Number:</label>\n".
			"	<input type=\"text\" name=\"phone_number\" value=\"$phone_number\" maxlength=\"20\"/>\n".
			"	<label>City:</label>\n".
			"	<input type=\"text\" name=\"city\" value=\"$city\" maxlength=\"60\"/>\n".
			"	<label>State:</label>\n".
			"	<input type=\"text\" name=\"state\" value=\"$state\" maxlength=\"2\"/>\n".
			"	<label>Address:</label>\n".
			"	<input type=\"text\" name=\"address\" value=\"$address\" maxlength=\"80\"/>\n".
			"	<label>Zipcode:</label>\n".
			"	<input type=\"text\" name=\"zipcode\" value=\"$zipcode\" maxlength=\"5\"/><br/>\n".
			"	<input type=\"submit\" id=\"button\"/>".
			"</form>";
		}
	}

	if( Access::user_has_access_level(Access::SUPER_USER) )
	{
		if( Add_Theaters::was_form_submitted() )
		{
			Add_Theaters::upload_data();
			if( Add_Theaters::is_valid_input() )
			{
				print
					'<div id="full_width_content_bar">'.
					"You've added a new theater to the database.".
					'</div>';
			}
		}
		Add_Theaters::print_form();
	}
 
	include_once("include/footer.php");
 ?>