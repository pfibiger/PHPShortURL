Instructions:
Untar all the files to a web directory.

add these lines to the httpd.conf to enable mod rewrite:

RewriteEngine on
RewriteRule ^/$ /add.php
RewriteRule ^/(\w*)$  /index.php?x=$1
change the variable $urlbase in add.php to reflect the
url you’re hosting the scripts at.
Finally, make sure url-map.php has permissions so that
it’s writeable by PHP.


