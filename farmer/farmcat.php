<?php
	include "../includes/db_connect.php";

	header("Content-type: text/xml");
	echo "<?xml version=\"1.0\" ?>\n";
	echo "<Categories>\n";
	$select = mysql_query("SELECT * FROM farming_category");

		while($row = mysql_fetch_array($select)) {
			echo "<category>\n\t<id>".$row['id']."</id>\n\t<name>".$row['farm_category_name']."</name>\n</category>\n";
		}

	echo "</Categories>";
?>