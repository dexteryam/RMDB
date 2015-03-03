<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>
<div class="frame group">
	<div>
	<?php
		$pid = $_GET['id'];
		$result = mysql_query("SELECT * FROM cast WHERE actor_id = ".$pid );
		while($row = mysql_fetch_array($result))
		  {
		  echo "<h1 id=\"full_width_title_bar\"> Quotes by " . $row['name'] ."</h1>";
echo "</div>";
		  }
	?>
</div>
<div class="frame group">
	<div>
	<?php
		$pid = $_GET['id'];
		$result = mysql_query("SELECT * FROM people_quotes WHERE (person_id = $pid)");
	
		while($row = mysql_fetch_array($result))
		  {
		  echo "<div id=\"full_width_content_bar\">";
		  echo $row['quote'];
		  echo "</div>";
		  }

		echo "</div><div class=\"lowNav\">";
		echo "<a href=\"peoplePage.php?id=" . $pid . "\">Main Page</a>" . 
		" | <a href=\"goofsCeleb.php?id=" . $pid . "\">Goofs</a>" . 
		" | <a href=\"triviaCeleb.php?id=" . $pid . "\">Trivia</a>";
		echo "| <a name=\"fb_share\" share_url=\"localhost/quotesCeleb.php?id=".$pid."\">Share</a>";
		?>
		</p>
	</div>
	
</div>

<?php
	include_once("include/footer.php");
?>
