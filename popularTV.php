<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<?php
function avgRating($show_id){
    /*$show_id = $_GET['id'];*/
    $count=0;
    $rSum=0;
    $result = mysql_query("SELECT * FROM ratings WHERE (ratings.show_id =".$show_id.")");
    while($row = mysql_fetch_array($result))
        {
            $rSum += $row['rating'];
            $count++;
        }
        if($count == 0){return 0;}
        else{ return ($rSum / $count); }
}
function updateRating($show_id){
	$rating = avgRating($show_id);
	$addrating = mysql_query("UPDATE shows SET avg_rating = $rating WHERE id='$show_id'");
}
?>

<div id="full_width_title_bar">
	<h1>Popular TV Shows</h1>
</div>
<div class="group">

<?php
	echo "<form method = \"POST\" action = \"popularTV.php\">
		 <select name = \"order\">
		 <option value='null'>-Select Ordering-</option>
		 <option value='top'>Top Rated TV Shows</option>
		 <option value='pop'>Most Popular Today</option>
		 <option value='low'>Lowest Rated TV Shows</option>
		 </select>
		 <input type = \"submit\" value = \"Submit\" name =\"submit\"></form>
		 ";
	
	$result = mysql_query("SELECT * FROM shows WHERE type='TV'");

	while($row = mysql_fetch_array($result)){
		updateRating($row['id']);
	}
	if(isset($_POST['submit'])){
		$order = $_POST['order'];
		if($order == "top"){
			$result = mysql_query("SELECT * FROM shows WHERE type='TV' ORDER BY avg_rating DESC");

			while($row = mysql_fetch_array($result)){
			$show_id = $row['id'];
			$result2 = mysql_query("SELECT * FROM shows WHERE type='TV' AND id = '$show_id'");
				while($movie = mysql_fetch_array($result2)){
				 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
				 echo "<div class=\"movie left\">";
				 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
				 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
				 echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
				 echo "</div>";
				}
			}
		}
		
		if($order == "pop"){
			date_default_timezone_set('America/Los_Angeles');
			$date = date("Y-m-d");
			
			$result = mysql_query("SELECT * FROM popularity WHERE date = '$date' ORDER BY views DESC");

			while($row = mysql_fetch_array($result)){
			$show_id = $row['show_id'];
			$result2 = mysql_query("SELECT * FROM shows WHERE type='TV' AND id = '$show_id'");
				while($movie = mysql_fetch_array($result2)){
				 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
				 echo "<div class=\"movie left\">";
				 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
				 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
				 echo "<p>" . $row['views']  . " Views</p>";
				 echo "</div>";
				}
			}
		}
		
		if($order == "low"){
			$result = mysql_query("SELECT * FROM shows WHERE type='TV' ORDER BY avg_rating ASC");

			while($row = mysql_fetch_array($result)){
			$show_id = $row['id'];
			$result2 = mysql_query("SELECT * FROM shows WHERE type='TV' AND id = '$show_id'");
				while($movie = mysql_fetch_array($result2)){
				 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
				 echo "<div class=\"movie left\">";
				 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
				 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
				 echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
				 echo "</div>";
				}
			}
		}
	
	}
	
	else{
		$result = mysql_query("SELECT * FROM shows WHERE type='TV' ORDER BY avg_rating DESC");

		while($row = mysql_fetch_array($result)){
		$show_id = $row['id'];
		$result2 = mysql_query("SELECT * FROM shows WHERE type='TV' AND id = '$show_id'");
			while($movie = mysql_fetch_array($result2)){
				echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
				echo "<div class=\"movie left\">";
				echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
				echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
				echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
				echo "</div>";
			}
		}
	}
	
	//Old version just in case
	/*
	$result = mysql_query("SELECT * FROM shows WHERE type='MOVIE'");

	while($row = mysql_fetch_array($result))
	  {
	  
	  if( avgRating($row['id']) >= 3 ){
		  echo "<a href=\"showPage.php?id=" . $row['id'] . "\">";
		  echo "<div class=\"movie left\">";
		  echo "<img class=\"mainImg\" src=\"" . $row['url'] . "\"/>";
		  echo "<strong><p>" . $row['name'] . "</p></strong></a>";
		  echo "<p>" . avgRating($row['id'])*20  . "% Positive</p>";
		  echo "</div>";
		  }
	  }*/
?>
</div>

<?php
	include_once("include/footer.php");
?>
