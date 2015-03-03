<?php
	include_once("include/header.php");
	$show_id = $_GET['id'];
	
	echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"" .$_SERVER['PHP_SELF']. "?id=" . $show_id . "\">
	<table border=\"0\">
		<tr>
			<td bgcolor=\"#CCCCCC\">Please select a rating </td>
		</tr>
		<tr>
			<td><label>
			<input name=\"rate\" type=\"radio\" value=\"5\" />
			5 - Loved it!</label></td>
		</tr>
		<tr>
			<td><label>
			<input name=\"rate\" type=\"radio\" value=\"4\" />
			4 - Very Good.</label></td>
		</tr>
		<tr>
			<td><label>
			<input name=\"rate\" type=\"radio\" value=\"3\" />
			3 - It's alright.</label></td>
		</tr>
		<tr>
			<td><label>
			<input name=\"rate\" type=\"radio\" value=\"2\" />
			2 - Disliked it.</label></td>
		</tr>
		<tr>
			<td><label>
			<input name=\"rate\" type=\"radio\" value=\"1\" />
			1 - Hated it!</label></td>
		</tr>
		<tr>
			<td><label>
			<input type=\"submit\" name=\"submit\" value=\"submit\" />
			</label></td>
		</tr>
	</table>
	</form>";
	
if (isset($_POST['submit'])) {	
	$uid = Authenticate::get_id();	
	$show_id = $_GET['id'];
	$r = $_POST['rate'];
	
	$result = mysql_query("SELECT * FROM ratings WHERE (ratings.user_id =".$uid.") AND (ratings.show_id =".$show_id.")");
	$row = mysql_fetch_array($result);

	if($row==""){
		  mysql_query("INSERT INTO ratings (user_id, show_id, rating) VALUES (".$uid.",".$show_id.",".$r.")");	}
	else {
		  mysql_query("UPDATE ratings SET rating=".$r." WHERE (ratings.user_id = $uid) AND (ratings.show_id =".$show_id.")");
	}
	header( "Location: showPage.php?id=".$show_id."");
	exit();
}

?>



<?php
	include_once("include/footer.php");
?>