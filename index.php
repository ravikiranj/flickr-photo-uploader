<?php
//Add include path
$path = "/home/ravikirn/public_html/hacku-upload/phpFlickr"; 
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

//Include phpFlickr
require_once("/home/ravikirn/public_html/hacku-upload/phpFlickr/phpFlickr.php");

$allowedExtensions = array("jpg","jpeg","gif","png");
$error=0;

$f = null;
if($_POST){
    if(!$_POST['name'] || !$_FILES["file"]["name"]){
        $error=1;
    }else{
        if ($_FILES["file"]["error"] > 0){
            echo "Error: " . $_FILES["file"]["error"] . "<br />";
         }else{
            $dir= dirname($_FILES["file"]["tmp_name"]);
            $newpath=$dir."/".$_FILES["file"]["name"];
            rename($_FILES["file"]["tmp_name"],$newpath);
            //Instantiate phpFlickr
            $status = uploadPhoto($newpath, $_POST["name"]);
            if(!$status) {
                $error = 2;
            }
         }
     }
} 

function uploadPhoto($path, $title) {
    $apiKey       = "d35a8db0fda64f6d9225b6a83c0fbd20";
    $apiSecret    = "832f9d62e4ce8f3a";
    $permissions  = "write";
    $token        = "72157626247765390-3839c704c79a56a8";

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
   <style>
   	#yui-main { margin-right:-30em !important;}

   	#sidebar1, #sidebar2 {  
   	background-color:#FFFFFF;
       border:1px solid #CCCCCC;;margin-bottom:6px;
       padding:10px;}

   	#doc3{margin:auto 0 !important;}
   	#hd{border-bottom: 6px solid purple;height:4.3em;background:#FFFFFF none repeat scroll 0 0;margin-bottom:12px;}
   	#hd_inner{margin:0 auto;max-width:85em;min-width:65em;padding-left:10px;padding-top:8px; }
   	#bd{margin:0 auto;max-width:86em; }
   	#mainbar{background-color:#FFFFFF;
       border:1px solid #CCCCCC;
       padding:20px;}

       body, td, th, textarea, select, h2, h3, h4, h5, h6
       {font: 13px/1.25em arial, sans-serif;}

       #hd {
           padding-top: 25px;
       }

       p
       {margin:12px 0;}

       a
       {text-decoration:none;}

       a:link { color:#004276;text-decoration:none; }

       a:visited
       {color:#5c7996;}

       a:link:hover, a:visited:hover
       {color:#ca0002;}

       a:focus
       {outline:none;}

       body {
       background:#FFF none repeat scroll 0 0;
       color:#000000;
       margin:0;
       padding:0;
       }
   	#about{width:500px;text-align:left; margin:25px;display:none;}

   	#ft_inner{background:#EBEBEB none repeat scroll 0 0;height:2em;margin:auto; padding:3px;margin-top:5px;
       max-width:85em;text-align:center;}
    h2{font-weight:bold;font-size:110%;}
   	h3, h4 {margin:1.4em 0 0 0 !important;}
   	blockquote, ul, ol, dl {    margin:-1em 0 0 1em !important;}
   	</style>
   
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1> <img src="images/yahoo.png" height"50px"><img src="images/hacku.jpg" height="50px" ></h1></div>
   <div id="bd" role="main">
   <div id="mainbar" class="yui-b">	  

<?php

if (isset($_POST['name']) && $error==0) {
    echo "  <h2>Thank you '".$_POST['name']."'. Now, we know you better!</h2>";
}else if($error == 1){
    echo "  <font color='red'>Please provide both name and a file</font>";
}else if($error == 2) {
    echo "  <font color='red'>Unable to upload your photo, please try again</font>";
}else {
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
   <div id="ft" role="contentinfo"><p></p></div>
</div>
</body>
</html>
