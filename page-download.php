<?php
    $dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
    if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT resource_name FROM resources WHERE id='$id'";
        

    $the_query = mysqli_query($dbconnect, $sql);
    while($row = mysqli_fetch_array($the_query))
    {
        $name = $row['resource_name'];
    }
    }

    $file = '/home1/cvannor/bossantiques.com/resources/'.$name;

    if(!file_exists($file)){ // file does not exist
        echo $file;
        die('file not found');
    } else {
        $mime_type = mime_content_type($file);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
        header("Cache-Control: public");
        header("Content-Type: $mime_type");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Length:".filesize($file));
        ob_end_flush();
        header("Connection:close");
        readfile($file);
        exit();
        

}
?>
