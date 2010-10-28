<?
#add these lines to your httpd conf to use mod_rewrite to allow
#urls like http://url.fibiger.org/XXXXX to work correctly
#   RewriteEngine on
#   RewriteRule ^/$ /add.php
#   RewriteRule ^/(\w*)$  /index.php?x=$1

$shorturl = $_REQUEST["x"];
include 'url-map.php';
if ($long_url = $map[$shorturl]) {
  header("Location: $long_url");
}
else {
  ?>
  <HTML>
  <HEAD>
  <TITLE>url redirector</TITLE>
  <link href="url.css" rel="stylesheet" type="text/css">
  </HEAD>
  <BODY>
  <br><br><br><br><br><br><br>
  <div id="content">
  <?
  print ("I'm sorry, that url does not exist. please check the value<br>and try again.");
  print ("<br><br>or <a href='add.php'>add</a> a new shortened url");
}

?>
</div>
</BODY>
</HTML>
