<?php session_start();?>
<!--
<body onload="addFieldID();">
<div class="layout">
<div id="main">
-->
<form class="pure-form pure-form-aligned" name='form' method='GET' action='harvestTable.php'>
<input type="hidden" name="tab" value="harvest:harvestReport">
<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/farmdata/connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/authentication.php';
// include $_SERVER['DOCUMENT_ROOT'].'/farmdata/testPureMenu.php';
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/design.php';

?>

<center>
<h2>Harvest Report</h2>
</center>
<fieldset>
<div class='pure-control-group'>
<?php 
echo '<label for="from">From:</label> '; 
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date.php';
// echo "<br clear=\"all\">";
echo "</div>";
echo "<div class='pure-control-group'>";
echo '<label for="to"> To:</label> '; 
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/date_transdate.php';
?>
</div>
<div class='pure-control-group'>
<label for="crop"> Crop:</label>
<!--
<div id="crop2" class ="pure-control-group">
-->
<select name="crop" id="crop" class="mobile-select" onChange="addFieldID();">
<option value = "%"> All </option>
<?php
$result = $dbcon->query("SELECT distinct crop from harvested");
while ($row =  $result->fetch(PDO::FETCH_ASSOC)){
  echo "\n<option value= \"$row[crop]\">$row[crop]</option>";
}
?>
</select>
</div>
<div class='pure-control-group' id="fieldID2">
<label for="fieldID"> Name of Field: </label>
<select id= "fieldID" name="fieldID" class="mobile-select">
<option value="%"> All </option>
<?php
   $result = $dbcon->query("SELECT fieldID from field_GH where active = 1 order by sortOrder");
   while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
      echo "<option value= '".$row1['fieldID']."'>".$row1['fieldID']."</option>";
   }
?>
</select>
</div>
<script type="text/javascript">
 function addFieldID() {
	
	var newdiv = document.getElementById('fieldID2');
	var crop = encodeURIComponent(document.getElementById("crop").value);
	var tyear = document.getElementById("tyear").value;
	var tmonth = document.getElementById("tmonth").value;
	var tday = document.getElementById("tday").value;
        var tdate = tyear + "-" + tmonth + "-" + tday;
	var year = document.getElementById("year").value;
	var month = document.getElementById("month").value;
	var day = document.getElementById("day").value;
        var date = year + "-" + month + "-" + day;
	xmlhttp= new XMLHttpRequest();
	xmlhttp.open("GET", "update_fieldID.php?crop="+crop+"&sdate="+date+"&edate="+tdate, false);
	xmlhttp.send();
	newdiv.innerHTML= "<div class='pure-control-group' id='fieldID2'>" +
         "<label for='fieldID'> Name of Field: </label> " +
         "<select name= 'fieldID' id= 'fieldID' class='mobile-select'> " +
        xmlhttp.responseText+"</select> </div>";
}
</script>
<?php
if ($_SESSION['gens']) {
   echo "<div class='pure-control-group'> ";
   echo '<label for="genSel">Succession #:</label> ';
   echo '<select name="genSel" class="mobile-select">';
   echo '<option value = "%" selected="selected"> All </option>';
   $result = $dbcon->query("SELECT distinct gen from harvested order by gen");
   while ($row1 =  $result->fetch(PDO::FETCH_ASSOC)){
      echo "\n<option value= \"$row1[gen]\">$row1[gen]</option>";
   }
   echo '</select>';
   echo '</div>';
} else {
   echo '<input type="hidden" name="genSel" value="%">';
}
?>

<br clear="all"/>
<br clear="all"/>
<input class="submitbutton pure-button wide" 
 type="submit" name="submit" value="Submit">
<fieldset>
</form>
