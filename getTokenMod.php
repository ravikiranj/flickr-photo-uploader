<?php
    /* Last updated with phpFlickr 1.4
     *
     * If you need your app to always login with the same user (to see your private
     * photos or photosets, for example), you can use this file to login and get a
     * token assigned so that you can hard code the token to be used.  To use this
     * use the phpFlickr::setToken() function whenever you create an instance of 
     * the class.
     */
//Set include path instead of messing up open_basedir in php.ini
$path = "/home/ravikirn/public_html/hacku-upload/phpFlickr";
set_include_path(get_include_path() . PATH_SEPARATOR . $path); 

//Include phpFlickr
require_once("/home/ravikirn/public_html/hacku-upload/phpflickr/phpFlickr.php");

    $f = new phpFlickr("d35a8db0fda64f6d9225b6a83c0fbd20", "832f9d62e4ce8f3a");
    
    //change this to the permissions you will need
    if(!$_GET['frob']) {
        $f->auth("write");
    }else {
        $tokenArgs = $f->auth_getToken($_GET['frob']);
        echo "<pre>"; var_dump($tokenArgs); echo "</pre>";
    }
    //Received token = 72157626247765390-3839c704c79a56a8    
    echo "Copy this token into your code: " . $_SESSION['phpFlickr_auth_token'];
    
?>
