<?php
	$HEAD = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
	include_once("include/header.php");
?>

<div class="browseBox frame group">
<?php
	echo "<a href=\"userProfile.php\"><p class=\"center\">Back to profile.</p></a><br/>";
	$uid = Authenticate::get_id();
	if ( $uid == "" ) {
		echo "You are not logged in.<br />";
	}
	else{
		$result = mysql_query("SELECT * FROM search_history WHERE (user_id = $uid) ORDER BY date") ;
		while($row = mysql_fetch_array($result))
		{
			if( $row['term'] != $_SERVER['REQUEST_URI']){
		  	echo "<a href=\"search.php?q=".$row['term']."\">". $row['term'] . "</a><br/>";
			}
		}
	}
?>
</div>

<?php
	include_once("include/footer.php");
?>
