<?php
    include_once("include/header.php");
?>

    <h1>Weekly Recaps</h1>
    <!-- Here we should have a form below to search for a show of your
    choosing -->
    <!-- <form name="show_query" action="tvrecaps.php" method="get" style="width:400px">
    <h1>SEARCH FOR RECAP</h1>
    <input type="text" name="requested_show" />
    <input type="submit" value="Search" id="button"/>
    </form>--!>


    <!-- Ideally at this point, we go into the database and we generate a list
    of all the television shows, then we create a link for each one. That
    link will take the user to a new page where they will see the review for that show. 
    This method doesn't scale well, so it might be better to have
    a search function, so that the user can query the recap of a show of their
    choice. Or, there could be a combination of the two, wherein the most
    popular ones are displayed, and a search function is provided as well. -->
                    <!-- List the TV shows in the shows table -->
<?php

    if( isset($_GET['requested_show']) )
    {
        $requested_show = $_GET['requested_show'];
        /*  Get the id of the show*/
        $query = "SELECT `id` FROM `shows` WHERE `name` = '" . $requested_show . "'";
        $result = mysql_query($query);
        $res_array = mysql_fetch_array($result);
        $show_id = $res_array[0];

        /*  Get the recaps associated with the show_id. */
        $query = "SELECT user_id, content FROM recaps WHERE show_id = " . $show_id;
        $result = mysql_query($query);
        print '<div id="full_width_title_bar">';
        print '<h1>'.$requested_show.'</h1>';
        print '</div>';
        $count = 0;
        while ($res_array = mysql_fetch_array($result)) {
            $count++;
            print '<div id="full_width_content_bar">';
            //  Get the alias from the users table.
            $name_query = "SELECT alias FROM users WHERE id = " . $res_array[0];
            $name_result = mysql_query($name_query);
            $name_result_array = mysql_fetch_array($name_result);
            echo "<p>" . $name_result_array[0] . " wrote: <br/>";
            echo $res_array[1] . "</p>";
            print '</div>';
        }
        if( $count == 0 )
        {
            print '<div id="full_width_content_bar">';
            print 'No Recaps Found';
            print '</div>';
        }
		echo "<a name=\"fb_share\" share_url=\"localhost/tvrecaps.php?requested_show=".$requested_show."\">Share</a>";
    }
    else
    {
        $query = "SELECT `name` FROM `shows` WHERE `type` = 'TV'";
        $result = mysql_query($query);
        print '<div id="full_width_title_bar">';
        print '<h1>Find A Show</h1>';
        print '</div>';
        print '<div id="full_width_content_bar">';
        while ($name = mysql_fetch_array($result)) {
            $showLink = "<li><a href=\"tvrecaps.php?requested_show=" . $name[0] . "\">" . $name[0] . "</a></li>";
            echo $showLink;
        }
        print '</div>';
    }
?>

<?php
    include_once("include/footer.php");
?>
