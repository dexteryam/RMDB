<?php
	$HEAD = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
	include_once("include/header.php");
	
	function search_box(){
		print "<div>" .
			  "<form name=\"form\" action=\"search.php\" method=\"get\">" .
			  "	<input type=\"text\" name=\"q\" value=\"Search for movie or show title, or a celebrity's name.\"></input>" .
			  "	<input type=\"submit\" id=\"button\"/>" .
			"</form> </div>";
	}
	
	search_box();
	echo "<div class=\"browseBox\">";
	$term = isset($_GET['q'])?$_GET['q']:"";
	if($term && $term != "Search for movie or show title, or a celebrity's name."){
		
	$uid = Authenticate::get_id();
	if ( $uid != "" ) {
		$date = getdate();
		$access_date = $date['year']."-".$date['mon']."-".$date['mday'];
		
		$query = "INSERT INTO search_history (`user_id`, `term`, `date`) VALUES ('$uid', '$term', '$access_date');";
		$result = mysql_query($query);
	}
		
		$result = mysql_query("SELECT * FROM cast");
		while($row = mysql_fetch_array($result))
		{
		  	if($row['name'] == $term){
		  		echo "<a href=\"peoplePage.php?id=".$row['actor_id']."\">".$row['name'].": Homepage</a><br/>";
				echo "<a href=\"quotesCeleb.php?id=".$row['actor_id']."\">".$row['name'].": Quotes</a><br/>";
				echo "<a href=\"goofsCeleb.php?id=".$row['actor_id']."\">".$row['name'].": Goofs</a><br/>";
				echo "<a href=\"triviaCeleb.php?id=".$row['actor_id']."\">".$row['name'].": Trivia</a><br/>";
			}
		}
		
		$result = mysql_query("SELECT * FROM shows");
		while($row = mysql_fetch_array($result))
		{
		  	if($row['name'] == $term){
				echo "<a href=\"showPage.php?id=".$row['id']."\">".$row['name'].": Homepage</a><br/>";
				echo "<a href=\"quotes.php?id=".$row['id']."\">".$row['name'].": Quotes</a><br/>";
				echo "<a href=\"goofs.php?id=".$row['id']."\">".$row['name'].": Goofs</a><br/>";
				echo "<a href=\"trivia.php?id=".$row['id']."\">".$row['name'].": Trivia</a><br/>"; 
			}
		}	
		}
	echo "</div>"

?>

<?php
	include_once("include/footer.php");
?>
