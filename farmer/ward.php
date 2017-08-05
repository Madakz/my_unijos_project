<?php
	include "../includes/db_connect.php";

	header("Content-type: text/xml");

	$lga_id = $_POST['lga'];

	echo "<?xml version=\"1.0\" ?>\n";
	echo "<wards>\n";
	$select = mysql_query("SELECT * FROM ward WHERE LGA_id = '$lga_id'");

		while($row = mysql_fetch_array($select)) {
			echo "<ward>\n\t<id>".$row['id']."</id>\n\t<name>".$row['ward_name']."</name>\n</ward>\n";
		}

	echo "</wards>";
?>