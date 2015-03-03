<?php
	$HEAD = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
	include_once("include/header.php");
?>

<div class="frame group">
<?php

	$uid = Authenticate::get_id();
	if ( $uid == "" ) {
		echo "You are not logged in.<br />";
	}
	else{
		$result = mysql_query("SELECT * FROM users WHERE (id = $uid)");
		while($row = mysql_fetch_array($result))
		  {
		  echo "<h1 id=\"full_width_title_bar\">" . $row['alias'] . "</h1>";
		  echo "<div id=\"full_width_content_bar\">Contact at " . $row['email'] . "</div>";
		  echo "<div id=\"full_width_content_bar\">Spare ribs shoulder adipisicing meatball beef ribs, drumstick velit t-bone. Capicola meatloaf qui, non mollit do pork enim ham hock in shankle duis. Exercitation shank nisi drumstick, in ut elit deserunt tongue culpa mollit. Nostrud brisket sirloin, et esse dolore turkey labore hamburger aute spare ribs pig fatback tongue. Pariatur sint frankfurter filet mignon voluptate, tail adipisicing minim pork chop.</div>";
		  }
		echo "<a href=\"browseHistory.php\">Browser History</a>";
		echo " | <a href=\"searchHistory.php\">Search History</a>";
	}
?>
</div>

<?php
	include_once("include/footer.php");
?>
