<?php
	include_once("include/header.php");

	if(isset($_GET) && Access::user_has_access_level(Access::ADMINISTRATOR) ){
		$show_id = $_GET['id'];
		if(isset($_POST['submit'])){
			if(isset($_POST['s1'])){
				$querylist = mysql_query("UPDATE social SET google = 1 WHERE show_id = $show_id");
			}
			else if(!isset($_POST['s1'])){
				$querylist = mysql_query("UPDATE social SET google = 0 WHERE show_id = $show_id");
			}
			if(isset($_POST['s2'])){
				$querylist = mysql_query("UPDATE social SET twitter = 1 WHERE show_id = $show_id");
			}
			else if(!isset($_POST['s2'])){
				$querylist = mysql_query("UPDATE social SET twitter = 0 WHERE show_id = $show_id");
			}
			if(isset($_POST['s3'])){
				$querylist = mysql_query("UPDATE social SET facebook = 1 WHERE show_id = $show_id");
			}
			else if(!isset($_POST['s3'])){
				$querylist = mysql_query("UPDATE social SET facebook = 0 WHERE show_id = $show_id");
			}
			echo "Change sucessful!";
		}
		$query = "SELECT * FROM social WHERE show_id = $show_id";
		$result = Db::query_row($query);
		
	
		
		if(!$result){
			$querylist = mysql_query("INSERT INTO social VALUES ('$show_id',0,0,0)");
		}
		echo "
		<table>
		<form method = \"POST\" action = \"addsocial.php?id=$show_id\">";
		if($result['google']){
			echo"<tr><td>Google+</td><td><input type=\"checkbox\" checked=\"yes\" name=\"s1\" value=\"1\" ></td> </tr>";
		}
		else if(!$result['google']){
			echo"<tr><td>Google+</td><td><input type=\"checkbox\" name=\"s1\" value=\"1\" ></td> </tr>";
		}
		if($result['twitter']){
			echo"<tr><td>Twitter</td><td><input type=\"checkbox\" checked=\"yes\" name=\"s2\" value=\"1\" ></td> </tr>";
		}
		else if(!$result['twitter']){
			echo"<tr><td>Twitter</td><td><input type=\"checkbox\" name=\"s2\" value=\"1\" ></td> </tr>";
		}
		if($result['facebook']){
			echo"<tr><td>facebook</td><td><input type=\"checkbox\" checked=\"yes\" name=\"s3\" value=\"1\" ></td> </tr>";
		}
		else if(!$result['facebook']){
			echo"<tr><td>facebook</td><td><input type=\"checkbox\" name=\"s3\" value=\"1\" ></td> </tr>";
		}		
		
		echo"
		<tr><td><input type = \"submit\" value = \"Submit\" name =\"submit\"></td></tr>
		</table>";
	
		echo"<a href = \"showPage.php?id=$show_id\">Back to Show</a>";
	}


	include_once("include/footer.php");
?>
