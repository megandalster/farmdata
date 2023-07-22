<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/Admin/authAdmin.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/stopSubmit.php';
$farm=$_SESSION['db'];
$date = date('Y-m-d-H-i-s');
$file=$farm."-".$date.".sql";

echo '<form name="form" method="post" action="<?php $_PHP_SELF ?>">
<h2>Database Backup</h2>

Backing up and restoring a database from a backup requires system administrator 
privileges.  Please contact your hosting company if your database needs backing up.
</form>';
if (!empty($_POST['done'])) {
  $user = $_SESSION['dbuser'];
  $pass = $_SESSION['dbpass'];
  $file = 'files/'.$farm.'/'.$_POST['filename'];
  $command = "mysqldump -u ".$user." -p ".$pass." ".$farm." > ".$file." 2>&1";

  exec($command, $out, $err);
  if ($err == 0) {
      echo "<script>alert(\"Database Backup Successful!\");</script>\n";
  } else {
      $msg=str_replace("\n", "", file_get_contents($file));
      $msg .= "command = ". $command;
      echo "<script>alert(\"Database was not backed up!\\n".
        "Please contact your hosting company if you need a backup"."\");</script>\n";
      exec("rm ".$file);
  }
}
?>

