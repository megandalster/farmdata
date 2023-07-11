<?php

include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/setconfig.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';

echo '<center>';
if ($_SESSION['mobile']) {
   echo '<br clear="all"/>';
   echo '<P>';
}
if ($_SESSION['db'] == "tenmilefarmdb")
    echo "<h1> Welcome to FARMDATA <br>at Tenmile Farm</h1>";
else if ($_SESSION['db'] == "farmdatademodb")
    echo "<h1> Welcome to FARMDATA <br>at Demo Farm</h1>";
else
    echo "<h1> Welcome to FARMDATA <br>at Spiral Path Farm</h1>";
?>
<br clear="all"/>
<img src='apple-touch-icon-180x180.png'>
</center>
</body>


