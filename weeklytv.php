<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<div id="full_width_title_bar">
	<h1>Movies on Tonight</h1>
</div>
<div class="group">
<?php
	date_default_timezone_set('America/Los_Angeles');
	$date = getdate();
	echo $date['weekday'] ." ". $date['month'] ." ". $date['mday'];
	$dayOfWeek = $date['weekday'];
	
	$result = mysql_query("SELECT DISTINCT(shows.name), listing.show_id, listing.weekday, listing.hour, listing.min, shows.type FROM listing, shows WHERE listing.weekday = \"".$dayOfWeek."\" AND shows.type = \"TV\" GROUP BY shows.name");
	while($row = mysql_fetch_array($result))
	  {
		  echo "<a href=\"showPage.php?id=" . $row['show_id'] . "\">";
		  echo "<strong><p class=\"textLeft\">" . $row['name'] . "</strong> on at ". $row['hour'].":". $row['min']. "</p></a>";
	  }
?>
</div>

<?php
	include_once("include/footer.php");
?>
