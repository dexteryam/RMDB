<?php
	include_once("include/header.php");

	function get_most_recent_show_id()
	{
		$query =
		"SELECT MAX(id) ".
		"FROM shows";

		return Db::query_value( $query );
	}

	if( Access::user_has_access_level( Access::SUPER_USER ) ){	
		
		if(isset($_POST['submit'])){
			$name = $_POST['title'];
			$date = $_POST['date'];
			$popularity = 0;
			$url = $_POST['url'];
			$description = $_POST['description'];
			$studio = $_POST['studio'];

			if($_POST['type'] == "MOVIE"){
				$type = 1;
			}
			if($_POST['type'] == "TV"){
				$type = 2;
			}
			
			//Error checking
			if (!preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)){
				die("Error: Incorrect date format <a href =\"addShow.php\"> Back </a>");
			}
			if(!checkdate($parts[2],$parts[3],$parts[1])){
				die("Error: Invalid date <a href =\"addShow.php\"> Back </a>");
			}
			if(strlen($description) > 200){
				die("Error: Description exceeds 300 characters <a href =\"addShow.php\"> Back </a>");
			}
			if(strlen($studio) > 30){
				die("Error: Studio name exceeds 30 characters <a href =\"addShow.php\"> Back </a>");
			}
			if(strlen($url) > 60){
				die("Error: Image url exceeds 60 characters <a href =\"addShow.php\"> Back </a>");
			}
			if(strlen($name) > 60){
				die("Error: Name exceeds 60 characters <a href =\"addShow.php\"> Back </a>");
			}
			
			$query = "SELECT * FROM shows WHERE name = '$name'";
			$check = mysql_query($query);
			$count = mysql_num_rows($check);
			if($count){
				die( "Error: Show already exists <a href =\"addShow.php\"> Back </a>");
			}
			
			
			$result = mysql_query("INSERT INTO 
			shows (name,release_date,popularity,url,description,studio,type)
			VALUES ('$name','$date','$popularity','$url','$description','$studio','$type')");
			if($result){			
				if($type == 2){
					print "Show has been added <a href =\"tv_list.php?order=ASC\">Return to Show List</a>";
				}
				else if($type == 1){
					print"Movie has been added <a href =\"movie_list.php?order=ASC\">Return to Movie List</a>";
				}
				$show_id = get_most_recent_show_id();
				$text = "<br/><a href=\"add_to_show.php?show_id=$show_id\">Add more content to entry.</a>";
				die($text);
			}
			else{
				die("Error");
			}	
		}
		echo"<table>
			<form method = \"POST\" action = \"addShow.php\">
			<tr><td>Show Title:</td> <td><input type = \"text\" name = \"title\"></td></tr>
			<tr><td>Date(yyyy-mm-dd):</td> <td><input type = \"text\" name = \"date\"></td></tr>
			<tr><td>Studio:</td> <td><input type = \"text\" name = \"studio\"></td></tr>
			<tr><td>Image:</td> <td> 
			<select name =\"url\">"; 
			$result = mysql_query("SELECT * FROM shows");
			$num_rows = mysql_num_rows($result);		
			//Loops displays all images
			if ($handle = opendir('./img')) {
				while (false !== ($entry = readdir($handle))) {
					if (!is_dir($entry) && $entry != "." && $entry != ".." && !is_dir("./img/".$entry)) {
						echo "<option value =img/".$entry.">".$entry."</option>";
					}
				}
				closedir($handle);
			}
			echo "</select></td></tr>";
			
			
			
			
			echo "<tr><td>Type:</td> <td><select name = \"type\">
			  <option value=TV>TV</option>
			  <option value=MOVIE>MOVIE</option></td></tr>
			<tr><td>Description:</td> <td><textarea rows=\"1\" cols=\"1\" name = \"description\">Enter description here...</textarea></td></tr>
			<tr><td><input type = \"submit\" value = \"Submit\" name =\"submit\"></td></tr></table>
			";
	}
	include_once("include/footer.php");
?>	