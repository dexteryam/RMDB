<?php
    include_once("include/header.php");

    function print_form()
    {
        print
        '<form method="post" action="" style="width:500px" enctype="multipart/form-data">'.
        '<h1>UPLOAD IMAGE</h1>'.
        '<label>Image</label>'.
        '<input type="file" name="file"/><br/>'.
        '<input type="submit" id="button"/>'.
        '</form>';
    }

    function get_extension($str)
    {
        $i = strrpos($str,".");
        if (!$i) 
            return "";
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }

    function process_form()
    {
        $KB = 1024;
        $MAX_SIZE = 1000*$KB;
        $DESTINATION = "./img/";

        if( count( $_POST ) == 0 )
            return;

        $image=$_FILES['file']['name'];
        if( $image )
        {
            $file_name = stripslashes($image);
            $extension = get_extension( $file_name );
            $is_good_extention = ($extension == "jpg");
            $is_good_extention |= ($extension == "jpeg");
            $is_good_extention |= ($extension == "gif");
            $is_good_extention |= ($extension == "png");
            if( !$is_good_extention )
                return;
            $file_size = filesize($_FILES['file']['tmp_name']);
            if( $file_size > $MAX_SIZE )
                return;


            $path = $DESTINATION.$file_name;
            move_uploaded_file( $_FILES['file']['tmp_name'], $path );
        }


    }

    if(Access::user_has_access_level( Access::SUPER_USER))
    {
        process_form();
        print_form();
    }


?>


<?php
    include_once("include/footer.php");
?>
