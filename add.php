<HTML>
<HEAD>
<TITLE>url redirector</TITLE>
<link href="url.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<br><br><br><br><br><br><br>
<div id="content">
<?
$urlbase = "http://url.fibiger.org/";
include 'url-map.php';

if (isset($_REQUEST["long"])) {
 $long_url = $_REQUEST["long"];
 if (!preg_match("/(http)|(https)\:\/\//i", $long_url)) {
  $long_url = "http://" . $long_url;
 }
  $lines = file('url-map.php');

  $first = $lines[1];
  $first = rtrim($first);
  $last=array_pop($lines);
  $next_last=array_pop($lines);

  $first = substr($first, 1);

  $i = strlen($first)-1;
  $exit=0;
  while($i>=0 && $exit==0) {
    $value = ord($first[$i]);
    if ($value == 110 || $value == 107) {
      $value++;
    }
    if ((($value > 49) && ($value < 57)) || (($value >= 97) && ($value < 122))) {
      $value++;
      $first[$i] = chr($value);
      $exit = 1;
    }
    elseif ($value == 57) {
      $value = 97;
      $first[$i] = chr($value);
      $exit = 1;
    }
    elseif ($value == 122 && $i==0) {
      $value = 50;
      for ($j=0; $j<strlen($first); $j++) {
      $first[$j] = chr(50);
      }
      $first = $first . "2";
    }
    else { # ($value == 122) {
      $value = 50;
      $first[$i] = chr($value);
      $i--;
    }
  }
  $lines[1] = "#" . $first . "\n";
  $short_url = $first;
  $array_line = "'$short_url' => '$long_url',\n";
  array_push($lines, $array_line);
  array_push($lines, $next_last);
  array_push($lines, $last);

  $handle = fopen('url-map.php', 'wb+');
  $array_string = "";
  foreach ($lines as $individual) {
    $array_string .= $individual;
  }
  fwrite($handle, $array_string);
  fclose($handle);
  print ("<br><br><br>");
  print ("Your shortened URL has been added.<br><br>");
  print ("<a href='$urlbase$short_url'>$urlbase$short_url</a><br>");
  print ("redirects to<br>");
  print ($long_url);
}
else {
  ?>
  <br><br>
  <center>
  <form action="add.php" method="POST">
  Enter the url to shorten:<br><input type="text" name="long" />
  <input type="submit" />
  </form>
  </center>
  <?
}

?>
</div>
</BODY>
</HTML>
