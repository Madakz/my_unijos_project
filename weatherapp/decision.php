<?php
include "db_connect.php";

$latitude='9.2994';
$longitude='8.9949';

// Parse weather data from Dark Sky Forecast API via JSON
$key = "89ad93bbc5fa1872b77b9e59c36fe3f7"; // Replace this string with your Dark Sky Forecast API key
$url = "https://api.darksky.net/forecast/" . $key . "/" . $latitude . "," . $longitude."?exclude=currently,minutely,hourly,flags";
$json = file_get_contents($url);
$data = json_decode($json);

// print_r($data);
// die();

?>
<html>
<head>
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="css/weather.css">
</head>
<script type="text/javascript">
	function load()
	{
	setTimeout("window.open(self.location, '_self');", 60480000);  // reload page after 7 days
	}
</script>
<body onload="load()">

<div id="weather">

  <div id="currenttemp">
    <?php 
    	$maxTemp=$data->daily->data[6]->temperatureMax;
    	$minTemp=$data->daily->data[6]->temperatureMin;
    	$Temp=($maxTemp+$minTemp)/2;
    	echo round($Temp) ?>&deg;
  </div>
  
  <div id="highlow">
    <b>H:</b> <?php echo round($data->daily->data[6]->temperatureMax) ?>&deg;<br>
	<b>L:</b> <?php echo round($data->daily->data[6]->temperatureMin) ?>&deg;<br/>
	<b>T:</b> <?php echo round($Temp) ?>&deg;
  </div>
  
  <div id="hourly">
	<a href="javascript:;" id="myBtn"><b>Hourly</b></a>
		<div id="myModal" class="modal">
		  <div class="modal-content">
			  <span class="close">x</span>
			  <hourlytitle>Hourly Forecast</hourlytitle><br>
			  <table>
				<tr>
				<td><b>Time</b></td>
				<td><b>Temp</b></td>
				<td colspan="2"><b>Chance Rain</b></td>
				<?php
				for ($i = 1; $i <= 24; $i++) {
					echo '<tr><td>';
					echo date('gA',$data->hourly->data[$i]->time);
					echo '</td><td>';
					echo round($data->hourly->data[$i]->temperature) . "&deg;";
					echo '</td><td>';
					echo (($data->hourly->data[$i]->precipProbability) * 100) . "%";
					echo '</td><td align="right">';
					echo '<img src="icons/' . $data->hourly->data[$i]->icon . '.gif" title="' . $data->hourly->data[$i]->summary . '">';
					echo '</td></tr>';
				} ?>
		      </table>
		  </div>
		</div>
		<!-- Javasrcipt for popup modal window for hourly forecast -->
		<script>
		var modal = document.getElementById("myModal");
		var btn = document.getElementById("myBtn");
		var span = document.getElementsByClassName("close")[0];
		btn.onclick = function() {
			modal.style.display = "block";
		}
		span.onclick = function() {
			modal.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		</script>
    </div>
  
  <div id="icon">
    <a href="http://forecast.weather.gov/MapClick.php?lat=<?php echo $latitude . '&lon=' . $longitude ?>"
	  target="_blank" title="<?php echo $data->daily->summary ?>">
    <img src="icons/<?php echo $data->daily->data[7]->icon ?>.gif">
	</a>
  </div>

  <div id="date">
    <?php echo date("D F j, Y", $data->daily->data[7]->time) ?><br>		<!-- Displays bold time -->
	<citystate><?php //echo $city . ", " . $state ?></citystate><br>
	<country><?php //echo $country ?></country>
  </div>
  
  <div id = "details">
    <table>
	<tr>
	<td class="details">
	  Humidity: <?php echo ($data->daily->data[6]->humidity * 100) ?>%<br>
	  Feels like: <?php echo round($Temp) ?>&deg;<br>
	  Chance of rain: <?php echo $data->daily->data[6]->precipProbability ?>%
	</td>
	<td class="details">
	  Pressure: <?php echo number_format((float)($data->daily->data[6]->pressure * 0.001 * 29.53), 2, '.', '') ?> in.<br>
	  Dewpoint: <?php echo $data->daily->data[6]->dewPoint ?>&deg;<br>
	  Wind: <?php //echo $data->daily->data[6]->windSpeed . " mph " . degToCompass($data->daily->windBearing); ?>
	</td>
	<td class="details">
	  Sunset: <?php echo date("g:i A", $data->daily->data[0]->sunsetTime) ?><br>
	  Cloud cover: <?php echo $data->daily->data[6]->cloudCover ?>%<br>
	  Ozone: <?php echo $data->daily->data[6]->ozone ?> DU
	</td>
	</table>
  </div>

  <div id="forecast">
    <table>
	  <tr>
	  <td>
	  <?php
	  //make Emphasis here madaki
	  for ($i = 1; $i <= 7; $i++) {
	    echo '<td>';
	    echo date("D", $data->daily->data[$i]->time) . "<br />";
	    echo '<img src="icons/' . $data->daily->data[$i]->icon . '.gif'.'".gif title="' . $data->daily->data[$i]->summary .'"><br>';
	    echo round($data->daily->data[$i]->temperatureMax) . "&deg;/";
	    echo round($data->daily->data[$i]->temperatureMin) . "&deg;";
	    echo '</td>';
	  } ?>
	  </tr>
	</table>
  </div>
  
</div>
<div class="mydata" style="margin-top:400px;">
  	<table border="1px solid-blue">
  		<thead>
  			<th>S/no</th>
  			<th>Time</th>
  			<th>precipProbability</th>
  			<th>precipIntensity</th>
  			<th>summary</th>
  			<th>humidity</th>
  			<th>temperature</th>
  			<th>icon</th>
  			<th>dewPoint</th>
  			<th>cloudCover</th>
  			<th>precipType</th>
  			<th>precipIntensityMax</th>
  			<th>Conclusion</th>
  		</thead>
  		<tbody>
  			<?php
			  //make Emphasis here madaki
			  for ($i = 1; $i <= 7; $i++)
			   {
			    
					  ?>
		  			<tr>
		  				<td><?php echo $i; ?></td>
		  				<td><?php echo date("D F j, Y", $data->daily->data[$i]->time) ?></td>
		  				<td><?php echo $data->daily->data[$i]->precipProbability; ?>%</td>
		  				<td><?php echo $data->daily->data[$i]->precipIntensity; ?></td>
		  				<td><?php echo $data->daily->data[$i]->summary; ?></td>
		  				<td><?php echo $data->daily->data[$i]->humidity; ?></td>
		  				<td><?php 
					    	$maxTemp=$data->daily->data[$i]->temperatureMax;
					    	$minTemp=$data->daily->data[$i]->temperatureMin;
					    	$Temp=($maxTemp+$minTemp)/2;
					    	echo round($Temp) ?>&deg;
					    </td>
		  				<td><?php echo $data->daily->data[$i]->icon; ?></td>
		  				<td><?php echo $data->daily->data[$i]->dewPoint; ?></td>
		  				<td><?php echo $data->daily->data[$i]->cloudCover; ?></td>
		  				<td>
		  					<?php 
		  						if (!array_key_exists('precipType', $data->daily->data[$i])) {
		  							echo 'nil';		  							
		  						}else{
		  							echo $data->daily->data[$i]->precipType;
		  						}
		  					 ?>
		  				</td>
		  				<td>
		  					<?php 
		  						if (!array_key_exists('precipIntensityMax', $data->daily->data[$i])) {
		  							echo 'nil';
		  						}else{
		  							echo $data->daily->data[$i]->precipIntensityMax;
		  						}
		  					 ?>
		  				</td>
		  				<td></td>
		  			</tr>
  			<?php
  				}
  			?>
  		</tbody>
  	</table>
  	<?php
  		$time=date("D F j, Y", $data->daily->data[7]->time);
  		$precipProbability=$data->daily->data[7]->precipProbability;
		$precipIntensity=$data->daily->data[7]->precipIntensity;
		//$summary=$data->daily->data[$i]->summary;
		$humidity=$data->daily->data[7]->humidity;
    	$maxTemp=$data->daily->data[7]->temperatureMax;
    	$minTemp=$data->daily->data[7]->temperatureMin;
    	$temperature=round(($maxTemp+$minTemp)/2);
    	// die($temperature);
		$icon=$data->daily->data[7]->icon;
		$dewPoint=$data->daily->data[7]->dewPoint;
		$cloudCover=$data->daily->data[7]->cloudCover;
		  				
		if (!array_key_exists('precipType', $data->daily->data[7])) {
			$precipType='nil';		  							
		}else{
			$precipType=$data->daily->data[7]->precipType;
		} 

		if (!array_key_exists('precipIntensityMax', $data->daily->data[7])) {
			$precipIntensityMax='nil';
		}else{
			$precipIntensityMax=$data->daily->data[7]->precipIntensityMax;
		}
		
		// decision tree
  		if ($precipProbability>=0.27) {
  			if ($precipIntensity>=0.0005) {
  				if ($humidity>=0.50) {
  					if ($temperature>=70) {
  						if ($dewPoint>=50) {
  							if ($cloudCover>=0.50) {
  								if ($icon=='rain' || $icon == 'partly-cloudy-day' || $icon == 'partly-cloudy-night' || $icon == 'cloudy') {
  									if ($precipType=='rain') {
	  									if ($precipIntensityMax>=0.0050) {
	  										$decision='YES';
	  									}else{
	  										$decision='YES';
	  									}
	  								}
  								}
  							}
  						}
  					}
  				}
  			}
  		}else{
  			$decision='NO';
  		}
  		//end of decision tree.

  		$query=mysql_query("INSERT INTO decision VALUES(NULL, '$time', '$precipProbability', '$precipIntensity', '$humidity', '$temperature', '$icon', '$dewPoint', '$cloudCover', '$precipType', '$precipIntensityMax','$decision')") or die(mysql_error());
  		if ($query) {
  			?>
  				<script type="text/javascript">
  				alert('record stored');
  				</script>
  			<?php
  		}


  		$countYES=mysql_query("SELECT * FROM decision WHERE conclusion='YES'") or die(mysql_error());
  		$countNO=mysql_query("SELECT * FROM decision WHERE conclusion='NO'") or die(mysql_error());

  		$no_of_YES=mysql_num_rows($countYES);
  		$no_of_NOs=mysql_num_rows($countNO);
  		
  		if ($no_of_YES>=$no_of_NOs) {
  			$msg='notify farmers, its the planting';
  			$time=date('d m Y h:i:s');
  			$insert=mysql_query("INSERT INTO decision_msg VALUES(NULL,'$msg','$time')") or die(mysql_error());
  		}

  	?>
  </div>
</body>
</html>
