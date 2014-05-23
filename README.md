flickr-photo-uploader
=====================
  * Setup your flickr account and create a new app.
  * Generate the API Key and Secret.
  * Download phpFlickr library from https://github.com/dan-coulter/phpflickr
  * Modify your app settings by making the callbackURL point to "getToken.php" in phpFlickr folder.
  * Fill in the missing details of getToken.php, make sure you include appropriate files (Add dir's to open_basedir setting in php.ini if required).   
  * From the browser, hit getToken.php, this will display the "token" generated from the "frob". Paste this token in "uploadPhoto" function of index.php &  all further Flickr API calls will be valid and any upload done will be done to your account by general public.
  * For further help check the README file in phpFlickr library.
