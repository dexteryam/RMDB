<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";		
	echo "<h1 id=\"full_width_title_bar\">Reviews</h1>";
		
	$show_id = $_GET['id'];
	$uid = Authenticate::get_id();	
	if($uid != ""){
	
			$result = mysql_query("SELECT * FROM reviews WHERE (user_id =" .$uid. ") AND (show_id =" .$show_id. ")");
			$row = mysql_fetch_array($result);	
			if($row != ""){$review = $row['review'];}
			else{ $review = "Let us know what you thought of this movie.";}
			
			echo "<form name=\"reviews\" method=\"post\" action=\"" .$_SERVER['PHP_SELF']. "?id=" . $show_id . "\">
			      <textarea name=\"review\">".$review."</textarea>
				  <input type=\"submit\" name=\"submit\" value=\"submit\" /> 
				  </form>";
		
			
			if (isset($_POST['submit'])) {	
				$uid = Authenticate::get_id();	
				$show_id = $_GET['id'];
				$r = $_POST['review'];
				
				$result = mysql_query("SELECT * FROM reviews WHERE (user_id =" .$uid. ") AND (show_id =" .$show_id. ")");
				$row = mysql_fetch_array($result);
							
				if($row==""){
					  	mysql_query("INSERT INTO reviews (user_id, show_id, review) VALUES (".$uid.",".$show_id.",\"".$r."\")");	}
				else {
					 	mysql_query("UPDATE reviews SET review=\"".$r."\" WHERE (user_id =" .$uid. ") AND (show_id =".$show_id.")");
				}	
		header( "Location: reviews.php?id=".$show_id."");
		exit();
		}				
	}
		
	$show_id = $_GET['id'];
	$result = mysql_query("SELECT * FROM reviews, users WHERE (reviews.show_id =" .$show_id. ") AND (reviews.user_id = users.id) AND (users.critic = \"N\")");
	echo "<table><h1>User Reviews</h1><tbody>";
	while( $row = mysql_fetch_array($result) )
	{
		echo "<tr>
			  <td class=\"textLeft\">" .
			  "<p class=\"reset bottomBorder\"> " . $row['review'] . "</p>" .
			  "</td>
			  </tr>";
	}
	echo "</tbody></table>";

	$result = mysql_query("SELECT * FROM reviews, users WHERE (reviews.show_id =" .$show_id. ") AND (reviews.user_id = users.id) AND (users.critic = \"Y\")");
	echo "<table><h1>Critic Reviews</h1><tbody>";
	while( $row = mysql_fetch_array($result) )
	{
		echo "<tr>
			  <td class=\"textLeft\">" .
			  "<p class=\"reset bottomBorder\">".$row['alias']. " says: ".
			  $row['review']."</p>" .
			  "</td>
			  </tr>";
	}
	echo "</tbody></table>";

	echo "<div class=\"frame lowNav\">";
	echo "<div class=\"center\">";
	echo "<a href=\"showPage.php?id=" . $show_id . "\">Back</a>";
	echo "</div></div>";


	
?>
<?php
	include_once("include/footer.php");
?>