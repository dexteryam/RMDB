<?php
	$HEAD = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
	include_once("include/header.php");
?>

	<div class="frame">
		<h1>Need help?</h1>
			<div id="full_width_title_bar" class="question">
				<h1>What is the RMDB?</h1>
			</div>
			<div id="full_width_content_bar">
				RMDB is the Riverside Movie Database, a collection of information 
					              about all movies and television shows.
			</div>
			<br/>
			<div id="full_width_title_bar" class="question">
				<h1>How do I sign up to use RMDB?</h1>
			</div>
			<div id="full_width_content_bar" class="answer">
				Go to the <a href="signup.php">registration page</a> and simply enter in
					              your information and sign up.
			</div>
			<br/>
			<div id="full_width_title_bar" class="question">
				<h1>Does it cost money to use RMDB?</h1>
			</div>
			<div id="full_width_content_bar" class="answer">
				No, the information on RMDB is free to use.
			</div>
			<br/>
			<div id="full_width_title_bar" class="question">
				<h1>How do I use RMDB to find information about movies or TV shows?</h1>
			</div>
			<div id="full_width_content_bar" class="answer">
				Go to the <a href="movie_list.php?order=ASC">movie listing</a> or <a href="tv_list.php?order=ASC">TV listing</a> 
					              and find the movie or TV show you are looking for. Click on that show's link to go to its 
					              information page.
			</div>
			<br/>
			<div id="full_width_title_bar" class="question">
				<h1>How do I use RMDB to find movie showtimes?</h1>
			</div>
			<div id="full_width_content_bar" class="answer">
				Go to the <a href="show_times.php">showtimes page</a> and find the theater you wish
					              to go to, and find the movie under that theater's listing to find the times. 
			</div>
			<br/>
			<div id="full_width_title_bar" class="question">
				<h1>How do I use RMDB to find TV listings?</h1>
			</div>
			<div id="full_width_content_bar" class="answer">
				Go to the <a href="listing.php?order=ASC">TV list</a> and find the show you wish to view.
			</div>
	</div>

<?php
	include_once("include/footer.php");
?>
