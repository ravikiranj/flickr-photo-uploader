<?php

//Include phpFlickr
require_once("phpFlickr/phpFlickr.php");

$error=0;
$f = null;
if($_POST){
    /* Check if both name and file are filled in */
    if(!$_POST['name'] || !$_FILES["file"]["name"]){
        $error=1;
    }else{
        /* Check if there is no file upload error */
        if ($_FILES["file"]["error"] > 0){
            echo "Error: " . $_FILES["file"]["error"] . "<br />";
        }else if($_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/png" && $_FILES["file"]["type"] != "image/gif"){
            /* Filter all bad file types */
            $error = 3;
        }else if(intval($_FILES["file"]["size"]) > 525000){
            /* Filter all files greater than 512 KB */
            $error = 4;
        }else{
            $dir= dirname($_FILES["file"]["tmp_name"]);
            $newpath=$dir."/".$_FILES["file"]["name"];
            rename($_FILES["file"]["tmp_name"],$newpath);
            /* Call uploadPhoto on success to upload photo to flickr */
            $status = uploadPhoto($newpath, $_POST["name"]);
            if(!$status) {
                $error = 2;
            }
         }
     }
} 

function uploadPhoto($path, $title) {
    $apiKey = "3b7d4ab3e54988c4e6fd59d9e40ca28c";
    $apiSecret = "84d2e480c8e3c926";
    $permissions  = "write";
    $token        = "72157626228984291-4635fa88a6fed8f5";

    $f = new phpFlickr($apiKey, $apiSecret, true);
    $f->setToken($token);
    return $f->async_upload($path, $title);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>HackerPics</title>
   
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="style.css" type="text/css">
   <style>
   	</style>
   
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Photo Uploader Using Flickr</h1></div>
   <div id="bd" role="main">
   <div id="mainbar" class="yui-b">	  

<?php
if (isset($_POST['name']) && $error==0) {
    echo "  <h2>Your file has been uploaded to <a href='http://www.flickr.com/photos/61074807@N08/' target='_blank'>rkj_flickr's photo stream</a></h2>";
}else {
    if($error == 1){
        echo "  <font color='red'>Please provide both name and a file</font>";
    }else if($error == 2) {
        echo "  <font color='red'>Unable to upload your photo, please try again</font>";
    }else if($error == 3){
        echo "  <font color='red'>Please upload JPG, JPEG, PNG or GIF image ONLY</font>";
    }else if($error == 4){
        echo "  <font color='red'>Image size greater than 512KB, Please upload an image under 512KB</font>";
    }
?>
  <h2>Upload your Pic!</h2>
  <form  method="post" accept-charset="utf-8" enctype='multipart/form-data'>
    <p>Name: &nbsp; <input type="text" name="name" value="" ></p>
    <p>Picture: <input type="file" name="file"/></p>
   <p><input type="submit" value="Submit"></p>
  </form>
  <?php
}
?>
	    </div>
    </div>
    <div id="ft"><p></p></div>
</div>
</body>
</html>
