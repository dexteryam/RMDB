<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<div id="full_width_title_bar">
	<h1>Popular Celebrities</h1>
</div>
<div class="group">

<?php

			date_default_timezone_set('America/Los_Angeles');
			$date = date("Y-m-d");
			
			$result = mysql_query("SELECT * FROM people_popularity WHERE date = '$date' ORDER BY views DESC");

			while($row = mysql_fetch_array($result)){
			$people_id = $row['people_id'];
			$result2 = mysql_query("SELECT * FROM cast WHERE actor_id = '$people_id'");
				while($people = mysql_fetch_array($result2)){
				 echo "<a href=\"peoplePage.php?id=" . $people['actor_id'] . "\">";
				 echo "<div class=\"movie left\">";
				 //echo "<img class=\"mainImg\" src=\"" . $people['url'] . "\"/>";
				 echo "<strong><p>" . $people['name'] . "</p></strong></a>";
				 echo "<p>" . $row['views']  . " Views</p>";
				 echo "</div>";
				}
			}
?>
</div>

<?php
	include_once("include/footer.php");
?>
