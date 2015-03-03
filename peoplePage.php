<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<div class="frame group">
	<div>
	<?php
		$people_id = $_GET['id'];
			
		if(isset($_POST['submit'])){
			$date = $_POST['birthday'];
			if (!preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)){
				die("Error: Incorrect birthdate format (YYYY-MM-DD) <a href =\"peoplePage.php?id=$people_id\"> Back </a>");
			}
			$query = "UPDATE cast SET birth_date = '$date' WHERE actor_id = $people_id";
			mysql_query($query);
		}

		//Viewcount
		
		date_default_timezone_set('America/Los_Angeles');
		$date = date("Y-m-d");
		
		$result = mysql_query("SELECT * FROM cast WHERE (actor_id = $people_id)");
		while($row = mysql_fetch_array($result)){
			$birthday = $row['birth_date'];
			$bd_month = substr($birthday,5,2);
			$bd_day = substr($birthday,8,2);
			if(date("m") == $bd_month && date("d") == $bd_day){
				echo "<h3> Happy Birthday to ".$row['name']."! </h3>";
			}
			
		}	
	
		$query = "SELECT * FROM people_popularity WHERE date = '$date' AND people_id ='$people_id'";
		$result = Db::query_row($query);
		if($result){
			$views = $result['views'];
			$views+=1;
			echo "Pageviews: ".$views;
			$query = "UPDATE people_popularity SET views = '$views' WHERE people_id='$people_id' AND date='$date'";
			$result = mysql_query($query);
		}
		else{
			$query = "INSERT INTO people_popularity VALUES ('$people_id',1,'$date')";
			$result = mysql_query($query);
			echo "Pageviews: 1";
		}
		
		
		
		$type;
		
		function people_basics()
		{
			global $type;
			$people_id = $_GET['id'];
			$result = mysql_query("SELECT * FROM cast WHERE (actor_id = $people_id)");
			while($row = mysql_fetch_array($result))
			  {
			  	  //$type = $row['type'];
				  //$rDate=$row['release_date'];
				  echo "<h1 id=\"full_width_title_bar\">" . $row['name'] . "</h1>";
				  echo "<div class=\"group\">";
				 // echo "<img class=\"left mainImg\" src=\"" . $row['url'] . "\"/>";
				 if($row['birth_date']=="0000-00-00"){
				 
					echo"No birthdate found. Enter birthdate<br><form method = \"POST\" action = \"peoplePage.php?id=$people_id\">
					
					Submit Birthdate (YYYY-MM-DD): <input type = \"text\" name = \"birthday\">
					<input type = \"submit\" value = \"Submit\" name =\"submit\">
					";
				 }
				 else{
					echo "<p class=\"textLeft\">Date of Birth: ". $row['birth_date'] ." </p>";
				 }
				 // echo "<p class=\"textLeft\">Created by: " . $row['studio'] . "</p>";
				  echo "</div>";
			  }	
		}
		
		
		$people_id = $_GET['id'];	
		

		people_basics();


	?>	
	</div>
	<div class="comments">
		
	</div>
	<div>
		<h2 class="textLeft">Movies:</h2>
		<?php
			$result = mysql_query("SELECT * FROM cast WHERE (actor_id = $people_id)");
		
			while($row = mysql_fetch_array($result))
			  {
			  $show_id = $row['show_id'];
			  $result2 = mysql_query("SELECT * FROM shows WHERE (id = $show_id) AND (type = 'MOVIE')");	
			  $show = mysql_fetch_array($result2);
			  echo "<p class=\"reset textLeft\"><a href = http://localhost/showPage.php?id=".$show_id.">" . $show['name'] . "</a></p>";
			  }
		?>
		
		<h2 class="textLeft">Television:</h2>
		<?php
			$result = mysql_query("SELECT * FROM cast WHERE (actor_id = $people_id)");
		
			while($row = mysql_fetch_array($result))
			  {
			  $show_id = $row['show_id'];
			  $result2 = mysql_query("SELECT * FROM shows WHERE (id = $show_id) AND (type = 'TV')");	
			  $show = mysql_fetch_array($result2);
			  echo "<p class=\"reset textLeft\"><a href = http://localhost/showPage.php?id=".$show_id.">" . $show['name'] . "</a></p>";
			  }
		$pid = $_GET['id'];
		echo "</div><div class=\"lowNav\">";
		echo "<a href=\"quotesCeleb.php?id=" . $pid . "\">Quotes</a>" . 
		" | <a href=\"goofsCeleb.php?id=" . $pid . "\">Goofs</a>" . 
		" | <a href=\"triviaCeleb.php?id=" . $pid . "\">Trivia</a>";
		echo "| <a name=\"fb_share\" share_url=\"localhost/peoplePage.php?id=".$pid."\">Share</a>";
		?>
		</p>
	</div>
	
	</div>
	
</div>

<?php
	include_once("include/footer.php");
?>
