<?php
if(isset($_POST['get_thumbnail']))
{
 $url=$_POST['url'];
 $fetch=explode("v=", $url);
 $videoid=$fetch[1];
 echo '<img src="http://img.youtube.com/vi/'.$videoid.'/0.jpg" width="250"/>';
}
?>





// For Thumbnail Quality Type
http://img.youtube.com/vi/'.$videoid.'/default.jpg
http://img.youtube.com/vi/'.$videoid.'/hqdefault.jpg
http://img.youtube.com/vi/'.$videoid.'/mqdefault.jpg
http://img.youtube.com/vi/'.$videoid.'/sddefault.jpg
http://img.youtube.com/vi/'.$videoid.'/maxresdefault.jpg