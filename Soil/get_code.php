<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
$crop = escapehtml($_GET['crop']);
$sql = "SELECT code, variety from coverSeedInventory where crop = '".$crop.
    "' and inInventory > 0 order by code";
$result = $dbcon->query($sql);
echo "<option value=\"N/A\">Not Available</option>";
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
   echo "<option value=\"".$row['code']."\">".$row['code']." (".$row['variety'].")</option>";
}
?>

