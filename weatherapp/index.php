<?php
	$latitude='9.2994';
	$longitude='8.9949';

	// Parse weather data from Dark Sky Forecast API via JSON
	$key = "89ad93bbc5fa1872b77b9e59c36fe3f7"; // Replace this string with your Dark Sky Forecast API key
	$url = "https://api.darksky.net/forecast/" . $key . "/" . $latitude . "," . $longitude."?exclude=currently,minutely,hourly,flags";
	$json = file_get_contents($url);
	$data = json_decode($json);

	// print_r($data);
	// die();

	// Converts degrees to compass direction for computing wind direction
	function degToCompass($num) {
	    $val = $num / 22.5 + 0.5;
	    $arr = array("N","NNE","NE","ENE","E","ESE", "SE", "SSE","S","SSW","SW","WSW","W","WNW","NW","NNW");
	    return $arr[$val % 16];
	}
?>

<!-- Output weather widget -->
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
    <img src="icons/<?php echo $data->daily->data[0]->icon ?>.gif">
	</a>
  </div>

  <div id="date">
    <?php echo date("D F j, Y", $data->daily->data[0]->time) ?><br>		<!-- Displays bold time -->
	<citystate><?php //echo $city . ", " . $state ?></citystate><br>
	<country><?php //echo $country ?></country>
  </div>
  
  <div id = "details">
    <table>
	<tr>
	<td class="details">
	  Humidity: <?php echo ($data->daily->data[0]->humidity * 100) ?>%<br>
	  Feels like: <?php echo round($Temp) ?>&deg;<br>
	  Chance of rain: <?php echo $data->daily->data[0]->precipProbability ?>%
	</td>
	<td class="details">
	  Pressure: <?php echo number_format((float)($data->daily->data[0]->pressure * 0.001 * 29.53), 2, '.', '') ?> in.<br>
	  Dewpoint: <?php echo $data->daily->data[0]->dewPoint ?>&deg;<br>
	  Wind: <?php //echo $data->daily->data[0]->windSpeed . " mph " . degToCompass($data->daily->windBearing); ?>
	</td>
	<td class="details">
	  Sunset: <?php echo date("g:i A", $data->daily->data[0]->sunsetTime) ?><br>
	  Cloud cover: <?php echo $data->daily->data[0]->cloudCover ?>%<br>
	  Ozone: <?php echo $data->daily->data[0]->ozone ?> DU
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
  			<!-- <th>Conclusion</th> -->
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
  </div>
</body>
</html>
