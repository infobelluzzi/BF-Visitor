<?php 
require_once('/web/htdocs/www.schoolmakerday.it/home/treasurehunt/src/lib.php');
if( isset($_REQUEST['code'])) {
	$code=$_REQUEST['code']; 
 }
else {
	$code=''; 
}
if($code=='0476de84f9e6a5ba8d4ef4d05959928c') {
	$aut=true;
}
else {
	$aut=false;
}	
if( isset($_REQUEST['id'])) {
	$rid=$_REQUEST['id']; 
	$state=9;
	$game_id=5;
	$update = db_perform_action(sprintf(
		"UPDATE `pwagroups` SET `state` = %d WHERE `game_id` = %d AND `pwagroup_id` = %d",
		$state,
		$game_id,
		$rid
	));
	if($update === false) {
		$msg="errore di aggiornamento $rid";
	}
	else {
		$msg="aggiornato $rid";		
	}
 }
else {
	$msg='id non ricevuto'; 
}
?>	
<!DOCTYPE html>
<html lang="it" class="community-no-js">
<head>
<!-- @date 08 04 2023 dirname(__FILE__) . 
       @author Duilio Peroni
       @copyright https://creativecommons.org/licenses/by-sa/4.0/
-->
<meta charset="UTF-8">
<link rel="manifest" href="/treasurehunt/webclient/manifest.json">
<link rel="apple-touch-icon" href="images/152x152.png">
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="SMD 2023 Code Hunting Game">
<meta name="application-name" content="SMD 2023 Code Hunting Game" />
<meta name="msapplication-TileImage" content="images/144x144.png"> 
<title>SMD 2023 Code Hunting Game Staff Only</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet">
<link href="css/w3.css" rel="stylesheet">
<script src="vendor/jquery/jquery-3.6.0.min.js"></script>
</head>
<body>
</body>
<div class="w3-container w3-center w3-sand">
  <h3 style="font-weight:bold;" class="w3-text-deep-purple ">SMD 2023 Code Hunting Game STAFF ONLY</h3>
</div>
<!-- visibile solo quando autenticato -->
<div style="display:block;"  id="scan" class="w3-row">
<div style='margin-bottom:5px; background-color:lightgray;' class='w3-col  l2 m2 s2  w3-center '>id</div>
<div style='margin-bottom:5px; background-color:lightgray;' class='w3-col  l3 m3 s3  w3-center '>nome</div>
<div style='margin-bottom:5px; background-color:lightgray;' class='w3-col  l1 m1 s1  w3-center '>n</div>
<div style='margin-bottom:5px; background-color:lightgray;' class='w3-col  l2 m2 s2  w3-center '>sta</div>
<div style='margin-bottom:5px; background-color:lightgray;' class='w3-col  l4 m4 s4  w3-center '>consegna</div>
<?php if($aut) { 
	$groups = db_table_query("SELECT `pwagroup_id`,`name`,`state`,`partecipant_count` FROM `pwagroups` WHERE `state`>=8 ORDER BY pwagroup_id ASC");
	$ngroups=count($groups);
	$i=0;
	foreach ($groups as $group) {
		$id=$group[0];
		$name=$group[1];
		$state=$group[2];
		$ncomp=$group[3];
		if ($state==8) {
			$th="<span style='color:green'><b>NC</b></span>";
			$btn="<input type='submit' value='consegna' name='btn$id'>";
		}
		else {
			$th="<span style='color:red'><b>C</b></span>";				
			$btn="&nbsp";
		}	
		echo "<form name='frm$id' action='' method='POST'>";
		echo "<input type='hidden' id='code' name='code' value='0476de84f9e6a5ba8d4ef4d05959928c'>";
		echo "<input type='hidden' id='id' name='id' value='$id'>";
		echo "<div style='margin-bottom:5px' class='w3-col  l2 m2 s2  w3-center '>$id</div>";
		echo "<div style='margin-bottom:5px' class='w3-col  l3 m3 s3  w3-center '>$name</div>";
		echo "<div style='margin-bottom:5px' class='w3-col  l1 m1 s1  w3-center '>$ncomp</div>";
		echo "<div style='margin-bottom:5px' class='w3-col  l2 m2 s2  w3-center '>$th</div>";
		echo "<div style='margin-bottom:5px' class='w3-col  l4 m4 s4  w3-center '>$btn</div>";
		echo "</form>";
		$i++;
	}
?>
</div>
<div  style="display:block;" id="auth" class="w3-row">
  <div id="dbg" class="w3-col  l12 m12 s12  w3-center "><?php echo $msg ?></div>
</div> 
<?php
}
else { ?>
<!-- visibile solo quando non autenticato -->
 <div  style="display:block;" id="notauth" class="w3-row">
  <div class="w3-col  l12 m12 s12  w3-center ">Non autenticato</div>
</div> 
<?php } ?>
<!-- sempre visibile -->
<div id="footer">
<p>Realizzato da School Maker Day con licenza MIT</p>
</div>
</body>
</html>